<?php

namespace App\Http\Controllers;

use App\Models\IctEquipment;
use Illuminate\Http\Request;

class IctEquipmentController extends Controller
{
    public function index(Request $request)
    {
        $query = IctEquipment::query();

        if ($request->filled('search')) {
            $search = $request->search;

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

        $equipment = IctEquipment::create($data);

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

    /**
     * Import ICT Equipment by category
     */
    public function importIctEquipment(Request $request)
{
    $request->validate([
        'csv_file' => 'required|mimes:csv,txt',
        'category' => 'required|in:laptop,printer,desktop'
    ]);

    $file = fopen($request->file('csv_file'), 'r');
    $rawHeader = fgetcsv($file);
    $header = array_map('trim', $rawHeader);

    $category = $request->category;

    // category-specific required headers
    $requiredHeaders = match($category) {
        'laptop' => ['Equipment ID', 'Description', 'Category', 'Brand', 'Model', 'Asset #', 'Serial #', 'Location', 'Assigned To', 'Purchase Date', 'Warranty Expiry', 'Condition', 'Note'],
        'printer' => ['Equipment ID', 'Description', 'Category', 'Brand', 'Model', 'Network IP', 'Asset #', 'Serial #', 'Location', 'Assigned To', 'Purchase Date', 'Warranty Expiry', 'Condition', 'Note'],
        'desktop' => ['Equipment ID', 'Description', 'Category', 'PC_MAKE', 'PC_MODEL', 'Asset #', 'PC_SN', 'MONITOR_SN', 'AVR_SN', 'WIFI ADAPTER_SN', 'KEYBOARD_SN', 'MOUSE_SN', 'Location', 'Assigned To', 'Purchase Date', 'Warranty Expiry', 'Condition', 'Note'],
    };

    $missingHeaders = array_diff($requiredHeaders, $header);
    if (!empty($missingHeaders)) {
        return back()->withErrors(["Missing required column(s): " . implode(', ', $missingHeaders)]);
    }

    $rows = [];
    while (($line = fgetcsv($file)) !== false) {
        $rows[] = array_combine($header, $line);
    }
    fclose($file);

    $inserted = [];

    foreach ($rows as $row) {
        $data = [
            'equipment_id'   => $row['Equipment ID'] ?? null,
            'item_description' => $row['Description'] ?? null,
            'category'       => $category, // force category
            'brand'          => $row['Brand'] ?? null,
            'model'          => $row['Model'] ?? null,
            'asset_number'   => $row['Asset #'] ?? null,
            'serial_number'  => $row['Serial #'] ?? null,
            'location'       => $row['Location'] ?? null,
            'assigned_to'    => $row['Assigned To'] ?? null,
            'purchase_date'  => $row['Purchase Date'] ?? null,
            'warranty_expiry'=> $row['Warranty Expiry'] ?? null,
            'condition'      => $row['Condition'] ?? null,
            'note'           => $row['Note'] ?? null,
        ];

        // Handle desktop-specific fields
        if ($category === 'desktop') {
            $data['pc_make']        = $row['PC_MAKE'] ?? null;
            $data['model']          = $row['PC_MODEL'] ?? null;
            $data['pc_sn']          = $row['PC_SN'] ?? null;
            $data['monitor_sn']     = $row['MONITOR_SN'] ?? null;
            $data['avr_sn']         = $row['AVR_SN'] ?? null;
            $data['wifi_adapter_sn']= $row['WIFI ADAPTER_SN'] ?? null;
            $data['keyboard_sn']    = $row['KEYBOARD_SN'] ?? null;
            $data['mouse_sn']       = $row['MOUSE_SN'] ?? null;
        }

        // Handle printer-specific fields
        if ($category === 'printer') {
            $data['network_ip'] = $row['Network IP'] ?? null;
        }

        $inserted[] = $data;
    }

    IctEquipment::insert($inserted);

    return back()->with('success', ucfirst($category) . ' equipment imported successfully.');
}

    

    /**
     * Export ICT Equipment by category
     */
    public function exportIctEquipment(Request $request)
{
    $request->validate([
        'category' => 'required|in:laptop,printer,desktop'
    ]);

    $category = $request->category;
    $equipments = IctEquipment::where('category', $category)->get();

    $fileName = "{$category}_equipment_" . now()->format('Y-m-d_H-i-s') . '.csv';

    $headers = [
        "Content-Type" => "text/csv",
        "Content-Disposition" => "attachment; filename=\"$fileName\"",
        "Pragma" => "no-cache",
        "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
        "Expires" => "0"
    ];

    // 🔹 Category-specific headers
    switch ($category) {
        case 'printer':
            $columns = [
                'Equipment ID',
                'Description',
                'Category',
                'Brand',
                'Model',
                'Network IP',
                'Asset #',
                'Serial #',
                'Location',
                'Assigned To',
                'Purchase Date',
                'Warranty Expiry',
                'Condition',
                'Note'
            ];
            break;

        case 'desktop':
            $columns = [
                'Equipment ID',
                'Description',
                'Category',
                'PC_MAKE',
                'PC_MODEL',
                'Asset #',
                'PC_SN',
                'MONITOR_SN',
                'AVR_SN',
                'WIFI ADAPTER_SN',
                'KEYBOARD_SN',
                'MOUSE_SN',
                'Location',
                'Assigned To',
                'Purchase Date',
                'Warranty Expiry',
                'Condition',
                'Note'
            ];
            break;

        case 'laptop':
        default:
            $columns = [
                'Equipment ID',
                'Description',
                'Category',
                'Brand',
                'Model',
                'Asset #',
                'Serial #',
                'Location',
                'Assigned To',
                'Purchase Date',
                'Warranty Expiry',
                'Condition',
                'Note'
            ];
            break;
    }

    $callback = function () use ($equipments, $columns, $category) {
        $file = fopen('php://output', 'w');
        fputcsv($file, $columns);

        foreach ($equipments as $equip) {
            switch ($category) {
                case 'printer':
                    $row = [
                        $equip->equipment_id,
                        $equip->item_description,
                        $equip->category,
                        $equip->brand,
                        $equip->model,
                        $equip->network_ip,
                        $equip->asset_number,
                        $equip->serial_number,
                        $equip->location,
                        $equip->assigned_to,
                        $equip->purchase_date,
                        $equip->warranty_expiry,
                        $equip->condition,
                        $equip->note ?? ''
                    ];
                    break;

                case 'desktop':
                    $row = [
                        $equip->equipment_id,
                        $equip->item_description,
                        $equip->category,
                        $equip->pc_make,
                        $equip->model,
                        $equip->asset_number,
                        $equip->pc_sn,
                        $equip->monitor_sn,
                        $equip->avr_sn,
                        $equip->wifi_adapter_sn,
                        $equip->keyboard_sn,
                        $equip->mouse_sn,
                        $equip->location,
                        $equip->assigned_to,
                        $equip->purchase_date,
                        $equip->warranty_expiry,
                        $equip->condition,
                        $equip->note ?? ''
                    ];
                    break;

                case 'laptop':
                default:
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
                    break;
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
