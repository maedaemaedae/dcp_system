<?php

namespace App\Http\Controllers;

use App\Models\IctEquipment;
use Illuminate\Http\Request;

class IctEquipmentController extends Controller
{
    /**
     * ✅ Category-specific CSV headers
     */
    private function getCategoryHeaders($category)
    {
        $commonHeaders = [
            'Equipment ID', 'Description', 'Category', 'Brand', 'Model',
            'Asset #', 'Serial #', 'Location', 'Assigned To',
            'Purchase Date', 'Warranty Expiry', 'Condition', 'Note'
        ];

        $desktopHeaders = array_merge($commonHeaders, [
            'PC Make', 'PC Model', 'PC SN', 'Monitor SN',
            'AVR SN', 'WiFi Adapter SN', 'Keyboard SN', 'Mouse SN'
        ]);

        $printerHeaders = array_merge($commonHeaders, [
            'Network IP'
        ]);

        $laptopHeaders = $commonHeaders;

        return match($category) {
            'desktop' => $desktopHeaders,
            'printer' => $printerHeaders,
            'laptop'  => $laptopHeaders,
            default   => $commonHeaders,
        };
    }

    public function index(Request $request)
    {
        $query = IctEquipment::query();

        if ($request->filled('search')) {
            $search = $request->search;

            // ✅ Search across all columns in the table
            $columns = \Schema::getColumnListing((new IctEquipment)->getTable());

            $query->where(function ($q) use ($columns, $search) {
                foreach ($columns as $column) {
                    $q->orWhere($column, 'like', "%{$search}%");
                }
            });
        }

        $equipments = $query->orderBy('created_at', 'desc')->paginate(10);
        $equipments->appends($request->only('search'));

        $laptops = IctEquipment::where('category', 'laptop')->orderBy('created_at', 'desc')->get();
        $printers = IctEquipment::where('category', 'printer')->orderBy('created_at', 'desc')->get();
        $desktops = IctEquipment::where('category', 'desktop')->orderBy('created_at', 'desc')->get();

        \Log::info('Equipment counts:', [
            'laptops' => $laptops->count(),
            'printers' => $printers->count(),
            'desktops' => $desktops->count(),
            'all_equipment' => $equipments->total()
        ]);

        return view('ict-equipment.index', compact('equipments', 'laptops', 'printers', 'desktops'));
    }

    public function store(Request $request)
    {
        \Log::info('Store method called with data:', $request->all());

        if ($request->category === 'desktop') {
            if ($request->filled('pc_sn')) {
                $request->merge(['serial_number' => $request->pc_sn]);
            }
            if ($request->filled('pc_make')) {
                $request->merge(['brand' => $request->pc_make]);
            }
        }

        $request->validate([
            'equipment_id' => 'required|string',
            'item_description' => 'required|string',
            'category' => 'required|string',
            'brand' => 'required|string',
            'model' => 'nullable|string',
            'asset_number' => 'required|string',
            'serial_number' => 'required|string|unique:ict_equipment,serial_number',
            'location' => 'required|string',
            'assigned_to' => 'required|string',
            'purchase_date' => 'required|date',
            'warranty_expiry' => 'required|date',
            'condition' => 'required|in:IN USE,FOR REPAIR',
            'note' => 'nullable|string',
            'network_ip' => 'nullable|string',
            'pc_make' => 'nullable|string',
            'pc_model' => 'nullable|string',
            'pc_sn' => 'nullable|string',
            'monitor_sn' => 'nullable|string',
            'avr_sn' => 'nullable|string',
            'wifi_adapter_sn' => 'nullable|string',
            'keyboard_sn' => 'nullable|string',
            'mouse_sn' => 'nullable|string',
        ]);

        $data = $request->only([
            'equipment_id', 'item_description', 'category', 'brand', 'model',
            'asset_number', 'serial_number', 'location', 'assigned_to',
            'purchase_date', 'warranty_expiry', 'condition', 'note',
            'network_ip', 'pc_make', 'pc_sn', 'monitor_sn',
            'avr_sn', 'wifi_adapter_sn', 'keyboard_sn', 'mouse_sn'
        ]);

        if ($request->category === 'desktop' && $request->filled('pc_model')) {
            $data['pc_build'] = $request->pc_model;
            $data['model'] = $request->pc_model;
        }

        \Log::info('ICT Equipment data being inserted:', $data);

        $equipment = IctEquipment::create($data);

        \Log::info('ICT Equipment created:', $equipment->toArray());

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

        $category = 'laptop';
        if (in_array('PC Make', $header)) {
            $category = 'desktop';
        } elseif (in_array('Network IP', $header)) {
            $category = 'printer';
        }

        $requiredHeaders = $this->getCategoryHeaders($category);

        $missingHeaders = array_diff($requiredHeaders, $header);
        if (!empty($missingHeaders)) {
            $missingList = implode(', ', $missingHeaders);
            return back()->withErrors(["Missing required column(s): {$missingList}"])->with('upload_source', 'ict_equipment');
        }

        $rows = [];
        while (($line = fgetcsv($file)) !== false) {
            $rows[] = array_combine($header, $line);
        }
        fclose($file);

        $inserted = [];
        $errors = [];

        foreach ($rows as $index => $row) {
            $rowNum = $index + 2;

            $equipment_id   = trim($row['Equipment ID'] ?? '');
            $description    = trim($row['Description'] ?? '');
            $categoryField  = trim($row['Category'] ?? $category);
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

            if (!$equipment_id || !$description || !$categoryField || !$brand || !$asset_number || !$serial_number) {
                $errors[] = "Row {$rowNum}: Missing required values.";
                continue;
            }

            if (IctEquipment::where('serial_number', $serial_number)->exists()) {
                $errors[] = "Row {$rowNum}: Serial number '{$serial_number}' already exists.";
                continue;
            }

            if (!in_array($condition, ['IN USE', 'FOR REPAIR'])) {
                $errors[] = "Row {$rowNum}: Condition must be 'IN USE' or 'FOR REPAIR'.";
                continue;
            }

            $data = [
                'equipment_id'   => $equipment_id,
                'item_description' => $description,
                'category'       => $categoryField,
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

            if ($category === 'desktop') {
                $data['pc_make']        = $row['PC Make'] ?? null;
                $data['pc_model']       = $row['PC Model'] ?? null;
                $data['pc_sn']          = $row['PC SN'] ?? null;
                $data['monitor_sn']     = $row['Monitor SN'] ?? null;
                $data['avr_sn']         = $row['AVR SN'] ?? null;
                $data['wifi_adapter_sn']= $row['WiFi Adapter SN'] ?? null;
                $data['keyboard_sn']    = $row['Keyboard SN'] ?? null;
                $data['mouse_sn']       = $row['Mouse SN'] ?? null;
            }

            if ($category === 'printer') {
                $data['network_ip']     = $row['Network IP'] ?? null;
            }

            $inserted[] = $data;
        }

        if (!empty($errors)) {
            return back()->withErrors($errors)->with('upload_source', 'ict_equipment');
        }

        IctEquipment::insert($inserted);

        return back()->with('success', 'ICT Equipment imported successfully.');
    }

    public function exportIctEquipment(Request $request)
    {
        $category = $request->get('category', 'all');
        $fileName = 'ict_equipment_' . $category . '_' . now()->format('Y-m-d_H-i-s') . '.csv';

        $query = IctEquipment::query();
        if ($category !== 'all') {
            $query->where('category', $category);
        }
        $equipments = $query->get();

        $headers = [
            "Content-Type" => "text/csv",
            "Content-Disposition" => "attachment; filename=\"$fileName\"",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        ];

        $columns = $this->getCategoryHeaders($category === 'all' ? 'laptop' : $category);

        $callback = function () use ($equipments, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($equipments as $equip) {
                $row = [
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
                ];

                if ($equip->category === 'desktop') {
                    $row = array_merge($row, [
                        $equip->pc_make,
                        $equip->pc_model,
                        $equip->pc_sn,
                        $equip->monitor_sn,
                        $equip->avr_sn,
                        $equip->wifi_adapter_sn,
                        $equip->keyboard_sn,
                        $equip->mouse_sn
                    ]);
                }

                if ($equip->category === 'printer') {
                    $row = array_merge($row, [
                        $equip->network_ip
                    ]);
                }

                fputcsv($file, $row);
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

    public function getPartial($partial)
    {
        $allowedPartials = ['create-laptop-fields', 'create-printer-fields', 'create-desktop-fields'];
        
        if (!in_array($partial, $allowedPartials)) {
            abort(404);
        }

        return view("ict-equipment.partials.{$partial}");
    }
}
