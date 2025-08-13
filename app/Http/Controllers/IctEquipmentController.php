<?php

namespace App\Http\Controllers;

use App\Models\IctEquipment;
use Illuminate\Http\Request;

class IctEquipmentController extends Controller
{
    public function index()
    {
        $equipments = IctEquipment::all();
        return view('ict-equipment.index', compact('equipments'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'equipment_id' => 'required|string',
            'item_description' => 'required|string',
            'category' => 'required|string',
            'brand' => 'required|string',
            'model' => 'required|string',
            'asset_number' => 'required|string',
            'serial_number' => 'required|string|unique:ict_equipment,serial_number',
            'location' => 'required|string',
            'assigned_to' => 'required|string',
            'purchase_date' => 'required|date',
            'warranty_expiry' => 'required|date',
            'condition' => 'required|in:IN USE,FOR REPAIR',
            'note' => 'nullable|string',
        ]);

        IctEquipment::create($request->all());

        return redirect()->route('ict-equipment.index')->with('success', 'ICT Equipment added successfully.');
    }

    public function edit($id)
    {
        $equipment = IctEquipment::findOrFail($id);
        return view('ict-equipment.edit', compact('equipment'));
    }

    public function update(Request $request, $id)
    {
        $equipment = IctEquipment::findOrFail($id);

        $request->validate([
            'equipment_id' => 'required|string',
            'item_description' => 'required|string',
            'category' => 'required|string',
            'brand' => 'required|string',
            'model' => 'required|string',
            'asset_number' => 'required|string',
            'serial_number' => 'required|string|unique:ict_equipment,serial_number,' . $id,
            'location' => 'required|string',
            'assigned_to' => 'required|string',
            'purchase_date' => 'required|date',
            'warranty_expiry' => 'required|date',
            'condition' => 'required|in:IN USE,FOR REPAIR',
            'note' => 'nullable|string',
        ]);

        $equipment->update($request->all());

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Equipment updated successfully.',
                'equipment' => $equipment
            ]);
        }

        return redirect()->route('ict-equipment.index')
            ->with('success', 'Equipment updated successfully.');
    }

    public function importIctEquipment(Request $request)
    {
        $request->validate(['csv_file' => 'required|mimes:csv,txt']);

        $file = fopen($request->file('csv_file'), 'r');
        $rawHeader = fgetcsv($file);
        $header = array_map('trim', $rawHeader);

        $requiredHeaders = [
            'Equipment ID', 'Description', 'Category', 'Brand', 'Model',
            'Asset #', 'Serial #', 'Location', 'Assigned To',
            'Purchase Date', 'Warranty Expiry', 'Condition', 'Note'
        ];

        $missingHeaders = array_diff($requiredHeaders, $header);
        if (!empty($missingHeaders)) {
            $missingList = implode(', ', $missingHeaders);
            return back()->withErrors(["Missing required column(s): {$missingList}"])->with('upload_source', 'ict_equipment');
        }

        $rows = [];
        $errors = [];
        $inserted = [];

        while (($line = fgetcsv($file)) !== false) {
            $rows[] = array_combine($header, $line);
        }
        fclose($file);

        foreach ($rows as $index => $row) {
            $rowNum = $index + 2;

            $equipment_id   = trim($row['Equipment ID'] ?? '');
            $description    = trim($row['Description'] ?? '');
            $category       = trim($row['Category'] ?? '');
            $brand          = trim($row['Brand'] ?? '');
            $model          = trim($row['Model'] ?? '');
            $asset_number   = trim($row['Asset #'] ?? '');
            $serial_number  = trim($row['Serial #'] ?? '');
            $location       = trim($row['Location'] ?? '');
            $assigned_to    = trim($row['Assigned To'] ?? '');
            $purchase_date  = trim($row['Purchase Date'] ?? '');
            $warranty_exp   = trim($row['Warranty Expiry'] ?? '');
            $condition      = trim($row['Condition'] ?? '');
            $note           = trim($row['Note'] ?? '');

            // Required validation
            if (!$equipment_id || !$description || !$category || !$brand || !$model ||
                !$asset_number || !$serial_number || !$location || !$assigned_to || !$purchase_date || !$warranty_exp || !$condition) {
                $errors[] = "Row {$rowNum}: Missing required values.";
                continue;
            }

            // Unique serial number check
            if (IctEquipment::where('serial_number', $serial_number)->exists()) {
                $errors[] = "Row {$rowNum}: Serial number '{$serial_number}' already exists.";
                continue;
            }

            // Valid condition check
            if (!in_array($condition, ['IN USE', 'FOR REPAIR'])) {
                $errors[] = "Row {$rowNum}: Condition must be 'IN USE' or 'FOR REPAIR'.";
                continue;
            }

            $inserted[] = [
                'equipment_id'   => $equipment_id,
                'item_description' => $description,
                'category'       => $category,
                'brand'          => $brand,
                'model'          => $model,
                'asset_number'   => $asset_number,
                'serial_number'  => $serial_number,
                'location'       => $location,
                'assigned_to'    => $assigned_to,
                'purchase_date'  => $purchase_date,
                'warranty_expiry'=> $warranty_exp,
                'condition'      => $condition,
                'note'           => $note ?: null,
            ];
        }

        if (!empty($errors)) {
            return back()->withErrors($errors)->with('upload_source', 'ict_equipment');
        }

        IctEquipment::insert($inserted);

        return back()->with('success', 'ICT Equipment imported successfully.');
    }

    public function exportIctEquipment()
    {
        $fileName = 'ict_equipment_' . now()->format('Y-m-d_H-i-s') . '.csv';
        $equipments = IctEquipment::all();

        $headers = [
            "Content-Type" => "text/csv",
            "Content-Disposition" => "attachment; filename=\"$fileName\"",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        ];

        $columns = [
            'Equipment ID', 'Description', 'Category', 'Brand', 'Model',
            'Asset #', 'Serial #', 'Location', 'Assigned To',
            'Purchase Date', 'Warranty Expiry', 'Condition', 'Note'
        ];

        $callback = function () use ($equipments, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($equipments as $equip) {
                fputcsv($file, [
                    $equip->equipment_id,
                    $equip->item_description,
                    $equip->category,
                    $equip->brand,
                    $equip->model,
                    $equip->asset_number,
                    $equip->serial_number,
                    $equip->location,
                    $equip->assigned_to,
                    $equip->purchase_date,
                    $equip->warranty_expiry,
                    $equip->condition,
                    $equip->note ?? ''
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function destroy($id)
    {
        $equipment = IctEquipment::findOrFail($id);
        $equipment->delete();

        return redirect()->route('ict-equipment.index')
            ->with('success', 'Equipment deleted successfully.');
    }

}
