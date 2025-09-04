<?php

namespace App\Http\Controllers;

use App\Models\IctEquipment;
use Illuminate\Http\Request;
use App\Models\Desktop;
use App\Models\Laptop;
use App\Models\Printer;

class IctEquipmentController extends Controller
{
    public function dashboard()
    {
    $totalEquipments = \App\Models\Laptop::count() + \App\Models\Printer::count() + \App\Models\Desktop::count();
        $inUseCount = \App\Models\Laptop::where('condition', 'IN USE')->count()
            + \App\Models\Printer::where('condition', 'IN USE')->count()
            + \App\Models\Desktop::where('condition', 'IN USE')->count();
        $forRepairCount = \App\Models\Laptop::where('condition', 'FOR REPAIR')->count()
            + \App\Models\Printer::where('condition', 'FOR REPAIR')->count()
            + \App\Models\Desktop::where('condition', 'FOR REPAIR')->count();
        $laptopCount = \App\Models\Laptop::count();
        $printerCount = \App\Models\Printer::count();
        $desktopCount = \App\Models\Desktop::count();

        // Category chart: sum from all models
        $categoryCounts = collect([
            [
                'category' => 'Laptop',
                'count' => \App\Models\Laptop::count(),
            ],
            [
                'category' => 'Printer',
                'count' => \App\Models\Printer::count(),
            ],
            [
                'category' => 'Desktop',
                'count' => \App\Models\Desktop::count(),
            ],
        ]);

        // Location chart: sum from all models
        $locationCounts = collect()
            ->merge(\App\Models\Laptop::select('location')
                ->selectRaw('COUNT(*) as count')
                ->groupBy('location')
                ->get())
            ->merge(\App\Models\Printer::select('location')
                ->selectRaw('COUNT(*) as count')
                ->groupBy('location')
                ->get())
            ->merge(\App\Models\Desktop::select('location')
                ->selectRaw('COUNT(*) as count')
                ->groupBy('location')
                ->get())
            ->groupBy('location')
            ->map(function($group) {
                return [
                    'location' => $group->first()['location'],
                    'count' => $group->sum('count'),
                ];
            })
            ->values();

        return view('ict-equipment.dashboard', compact(
            'totalEquipments',
            'inUseCount',
            'forRepairCount',
            'laptopCount',
            'printerCount',
            'desktopCount',
            'categoryCounts',
            'locationCounts'
        ));
    }


   public function index(Request $request)
{
    $query = IctEquipment::query();

    // 🔍 Search filter
    if ($request->filled('search')) {
        $search = $request->search;
        $columns = \Schema::getColumnListing((new IctEquipment)->getTable());

        $query->where(function ($q) use ($columns, $search) {
            foreach ($columns as $column) {
                $q->orWhere($column, 'like', "%{$search}%");
            }
        });
    }

    $category = $request->get('category');
    $condition = $request->get('condition');

    // Default all equipments (with condition filter if exists)
   // Default all equipments (with condition filter if exists)
if ($condition) {
    $query->where('condition', $condition);
}

$equipments = $query->orderBy('created_at', 'desc')->paginate(10);
// ✅ Keep all query params in pagination links
$equipments->appends(request()->query());

// Category-specific queries (with condition filter if any)
$laptops  = Laptop::when($condition, fn($q) => $q->where('condition', $condition))
                  ->orderBy('created_at', 'desc')
                  ->paginate(2, ['*'], 'laptop_page')
                  ->appends(request()->query());

$printers = Printer::when($condition, fn($q) => $q->where('condition', $condition))
                   ->orderBy('created_at', 'desc')
                   ->paginate(2, ['*'], 'printer_page')
                   ->appends(request()->query());

$desktops = Desktop::when($condition, fn($q) => $q->where('condition', $condition))
                   ->orderBy('created_at', 'desc')
                   ->paginate(2, ['*'], 'desktop_page')
                   ->appends(request()->query());


    // 🔑 Detect active category (from pagination or dropdown)
    if ($request->has('laptop_page')) {
        $category = 'laptop';
    } elseif ($request->has('printer_page')) {
        $category = 'printer';
    } elseif ($request->has('desktop_page')) {
        $category = 'desktop';
    }

    // ✅ AJAX: return only partials
    if ($request->ajax()) {
        if ($category === 'laptop') {
            return view('ict-equipment.partials.laptop-table', compact('laptops', 'category', 'condition'));
        }
        if ($category === 'printer') {
            return view('ict-equipment.partials.printer-table', compact('printers', 'category', 'condition'));
        }
        if ($category === 'desktop') {
            return view('ict-equipment.partials.desktop-table', compact('desktops', 'category', 'condition'));
        }
    }

    // Full page
    return view('ict-equipment.index', [
        'equipments' => $equipments,
        'laptops' => $laptops,
        'printers' => $printers,
        'desktops' => $desktops,
        'selectedCategory' => $category,
        'selectedCondition' => $condition,
    ]);
}




    public function store(Request $request)
{
    \Log::info('Store method called with data:', $request->all());

    // ✅ pick validation rules per category
        $rules = match ($request->category) {
            'desktop' => [
                'equipment_id'     => 'required|string',
                'item_description' => 'required|string',
                'pc_make'          => 'required|string',
                'pc_model'         => 'required|string',
                'asset_number'     => 'required|string',
                'pc_sn'            => 'required|string|unique:desktops,pc_sn',
                'monitor_sn'       => 'nullable|string',
                'avr_sn'           => 'nullable|string',
                'wifi_adapter_sn'  => 'nullable|string',
                'keyboard_sn'      => 'nullable|string',
                'mouse_sn'         => 'nullable|string',
                'location'         => 'required|string',
                'assigned_to'      => 'required|string',
                'purchase_date'    => 'required|date',
                'warranty_expiry'  => 'required|date',
                'condition'        => 'required|in:IN USE,FOR REPAIR',
                'note'             => 'nullable|string',
            ],
            'printer' => [
                'equipment_id'     => 'required|string',
                'item_description' => 'required|string',
                'brand'            => 'required|string',
                'model'            => 'required|string',
                'network_ip'       => 'nullable|string',
                'asset_number'     => 'required|string',
                'serial_number'    => 'required|string|unique:printers,serial_number',
                'location'         => 'required|string',
                'assigned_to'      => 'required|string',
                'purchase_date'    => 'required|date',
                'warranty_expiry'  => 'required|date',
                'condition'        => 'required|in:IN USE,FOR REPAIR',
                'note'             => 'nullable|string',
            ],
            'laptop' => [
                'equipment_id'     => 'required|string',
                'item_description' => 'required|string',
                'brand'            => 'required|string',
                'model'            => 'required|string',
                'asset_number'     => 'required|string',
                'serial_number'    => 'required|string|unique:laptops,serial_number',
                'location'         => 'required|string',
                'assigned_to'      => 'required|string',
                'purchase_date'    => 'required|date',
                'warranty_expiry'  => 'required|date',
                'condition'        => 'required|in:IN USE,FOR REPAIR',
                'note'             => 'nullable|string',
            ],
            default => [],
        };

    $validated = $request->validate($rules);

    // ✅ save to the right table
    $model = match ($request->category) {
        'desktop' => Desktop::class,
        'printer' => Printer::class,
        'laptop'  => Laptop::class,
        default   => null,
    };

    if (!$model) {
        return back()->withErrors(['Invalid category.']);
    }

    $equipment = $model::create($validated);

    return redirect()->route('ict-equipment.index')
        ->with('success', ucfirst($request->category).' added successfully.');
}


    public function edit($id)
    {
        $equipment = IctEquipment::findOrFail($id);
        return view('ict-equipment.edit', compact('equipment'));
    }

    public function update(Request $request, $category, $id)
{
    // pick correct model based on category
    $model = match ($category) {
        'laptop'  => Laptop::class,
        'printer' => Printer::class,
        'desktop' => Desktop::class,
        default   => null,
    };

    if (!$model) {
        return back()->withErrors(['Invalid category.']);
    }

    $equipment = $model::findOrFail($id);

    // validation rules can differ per category
    $rules = match ($category) {
        'laptop' => [
            'equipment_id'   => 'required|string',
            'item_description' => 'required|string',
            'brand'          => 'required|string',
            'model'          => 'required|string',
            'asset_number'   => 'required|string',
            'serial_number'  => 'required|string|unique:laptops,serial_number,' . $id,
            'location'       => 'required|string',
            'assigned_to'    => 'required|string',
            'purchase_date'  => 'required|date',
            'warranty_expiry'=> 'required|date',
            'condition'      => 'required|in:IN USE,FOR REPAIR',
            'note'           => 'nullable|string',
        ],
        'printer' => [
            'equipment_id'   => 'required|string',
            'item_description' => 'required|string',
            'brand'          => 'required|string',
            'model'          => 'required|string',
            'network_ip'     => 'nullable|string',
            'asset_number'   => 'required|string',
            'serial_number'  => 'required|string|unique:printers,serial_number,' . $id,
            'location'       => 'required|string',
            'assigned_to'    => 'required|string',
            'purchase_date'  => 'required|date',
            'warranty_expiry'=> 'required|date',
            'condition'      => 'required|in:IN USE,FOR REPAIR',
            'note'           => 'nullable|string',
        ],
        'desktop' => [
            'equipment_id'   => 'required|string',
            'item_description' => 'required|string',
            'pc_make'        => 'required|string',
            'pc_model'       => 'required|string',
            'asset_number'   => 'required|string',
            'pc_sn'          => 'required|string|unique:desktops,pc_sn,' . $id,
            'monitor_sn'     => 'nullable|string',
            'avr_sn'         => 'nullable|string',
            'wifi_adapter_sn'=> 'nullable|string',
            'keyboard_sn'    => 'nullable|string',
            'mouse_sn'       => 'nullable|string',
            'location'       => 'required|string',
            'assigned_to'    => 'required|string',
            'purchase_date'  => 'required|date',
            'warranty_expiry'=> 'required|date',
            'condition'      => 'required|in:IN USE,FOR REPAIR',
            'note'           => 'nullable|string',
        ],
        default => [],
    };

    $validated = $request->validate($rules);

    $equipment->update($validated);

    if ($request->ajax()) {
        return response()->json([
            'success' => true,
            'message' => ucfirst($category) . ' updated successfully.',
            'equipment' => $equipment
        ]);
    }

    return redirect()->route('ict-equipment.index')
        ->with('success', ucfirst($category) . ' updated successfully.');
}


    /**
     * Import ICT Equipment by category
     */
    public function importIctEquipment(Request $request, $category = null)
{
    // Accept category from route parameter only
    if (!in_array($category, ['laptop', 'printer', 'desktop'])) {
        return back()->withErrors(["Invalid category."]);
    }

    $request->validate([
        'csv_file' => 'required|mimes:csv,txt',
    ]);

    $file = fopen($request->file('csv_file'), 'r');
    $rawHeader = fgetcsv($file);
    $header = array_map(fn($h) => strtolower(trim($h)), $rawHeader);

    // category-specific required headers
    $requiredHeaders = match($category) {
        'laptop' => ['equipment id', 'description', 'category', 'brand', 'model', 'asset #', 'serial #', 'location', 'assigned to', 'purchase date', 'warranty expiry', 'condition', 'note'],
        'printer' => ['equipment id', 'description', 'category', 'brand', 'model', 'network ip', 'asset #', 'serial #', 'location', 'assigned to', 'purchase date', 'warranty expiry', 'condition', 'note'],
        'desktop' => ['equipment id', 'description', 'category', 'pc_make', 'pc_model', 'asset #', 'pc_sn', 'monitor_sn', 'avr_sn', 'wifi adapter_sn', 'keyboard_sn', 'mouse_sn', 'location', 'assigned to', 'purchase date', 'warranty expiry', 'condition', 'note'],
    };

    $missingHeaders = array_diff($requiredHeaders, $header);
    if (!empty($missingHeaders)) {
        return back()->withErrors(["Missing required column(s): " . implode(', ', $missingHeaders)]);
    }

    $headerIndexes = array_flip($header);
    $rows = [];
    while (($line = fgetcsv($file)) !== false) {
        $rowAssoc = [];
        foreach ($headerIndexes as $col => $idx) {
            $rowAssoc[$col] = $line[$idx] ?? null;
        }
        $rows[] = $rowAssoc;
    }
    fclose($file);

    $inserted = [];
    $matchedRows = 0;

    foreach ($rows as $row) {
        $rowCategory = strtolower(trim($row['category'])); // keep row category separate
    
        if ($rowCategory !== $category) {
            continue; // skip rows that don’t match the selected category
        }
    
        $matchedRows++; // ✅ count matched rows
    
        if ($category === 'desktop') {
            Desktop::create([
                'equipment_id'    => $row['equipment id'],
                'item_description'=> $row['description'],
                'category'        => 'Desktop',
                'pc_make'         => $row['pc_make'] ?? null,
                'pc_model'        => $row['pc_model'] ?? null,
                'asset_number'    => $row['asset #'] ?? null,
                'pc_sn'           => $row['pc_sn'] ?? null,
                'monitor_sn'      => $row['monitor_sn'] ?? null,
                'avr_sn'          => $row['avr_sn'] ?? null,
                'wifi_adapter_sn' => $row['wifi adapter_sn'] ?? null,
                'keyboard_sn'     => $row['keyboard_sn'] ?? null,
                'mouse_sn'        => $row['mouse_sn'] ?? null,
                'location'        => $row['location'],
                'assigned_to'     => $row['assigned to'],
                'purchase_date'   => $row['purchase date'],
                'warranty_expiry' => $row['warranty expiry'],
                'condition'       => $row['condition'],
                'note'            => $row['note'] ?? null,
            ]);
        } elseif ($category === 'laptop') {
            Laptop::create([
                'equipment_id'    => $row['equipment id'],
                'item_description'=> $row['description'],
                'category'        => 'Laptop',
                'brand'           => $row['brand'],
                'model'           => $row['model'],
                'asset_number'    => $row['asset #'],
                'serial_number'   => $row['serial #'],
                'location'        => $row['location'],
                'assigned_to'     => $row['assigned to'],
                'purchase_date'   => $row['purchase date'],
                'warranty_expiry' => $row['warranty expiry'],
                'condition'       => $row['condition'],
                'note'            => $row['note'] ?? null,
            ]);
        } elseif ($category === 'printer') {
            Printer::create([
                'equipment_id'    => $row['equipment id'],
                'item_description'=> $row['description'],
                'category'        => 'Printer',
                'brand'           => $row['brand'],
                'model'           => $row['model'],
                'network_ip'      => $row['network ip'] ?? null,
                'asset_number'    => $row['asset #'],
                'serial_number'   => $row['serial #'],
                'location'        => $row['location'],
                'assigned_to'     => $row['assigned to'],
                'purchase_date'   => $row['purchase date'],
                'warranty_expiry' => $row['warranty expiry'],
                'condition'       => $row['condition'],
                'note'            => $row['note'] ?? null,
            ]);
        }
    }
    

    if ($matchedRows === 0) {
        return back()->withErrors(["No rows matched the selected category for import."]);
    }
    
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
    $equipments = match($category) {
        'laptop'  => Laptop::all(),
        'printer' => Printer::all(),
        'desktop' => Desktop::all(),
    };
    

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
                        $equip->pc_model,
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


public function destroy(Request $request, $category, $id)
{
    // pick correct model based on category
    $model = match ($category) {
        'laptop'  => Laptop::class,
        'printer' => Printer::class,
        'desktop' => Desktop::class,
        default   => null,
    };

    if (!$model) {
        return back()->withErrors(['Invalid category.']);
    }

    $equipment = $model::findOrFail($id);
    $equipment->delete();

    if ($request->ajax()) {
        return response()->json([
            'success' => true,
            'message' => ucfirst($category) . ' deleted successfully.'
        ]);
    }

    // Preserve all query params (category, condition, page, etc.)
    $params = $request->query(); 
    $params['category'] = $category; // enforce current category

    return redirect()
        ->route('ict-equipment.index', $params)
        ->with('success', ucfirst($category) . ' deleted successfully.');
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
