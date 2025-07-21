<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\School;
use App\Models\DivisionOffice;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    
   public function index(Request $request)
{
    $search = $request->input('search');

    // School Inventories - with deliveredItems + ordering
    $schoolInventories = School::with([
        'inventories' => function ($query) {
            $query->orderBy('created_at', 'desc')
                  ->with(['deliveredItems.packageContent']);
        }
    ])
    ->when($search, function ($query, $search) {
        $query->where('school_name', 'like', "%{$search}%");
    })
    ->get();

    // Division Inventories - with deliveredItems + ordering
    $divisionInventories = DivisionOffice::with([
        'inventories' => function ($query) {
            $query->orderBy('created_at', 'desc')
                  ->with(['deliveredItems.packageContent']);
        }
    ])
    ->when($search, function ($query, $search) {
        $query->where('division_name', 'like', "%{$search}%");
    })
    ->get();

    // Compute quantities (still needed)
    foreach ($schoolInventories as $school) {
        foreach ($school->inventories as $inventory) {
            $inventory->computed_quantity = $inventory->deliveredItems
                ->filter(fn($item) => $item->packageContent->item_name === $inventory->item_name)
                ->sum('quantity_delivered');
        }
    }

    foreach ($divisionInventories as $division) {
        foreach ($division->inventories as $inventory) {
            $inventory->computed_quantity = $inventory->deliveredItems
                ->filter(fn($item) => $item->packageContent->item_name === $inventory->item_name)
                ->sum('quantity_delivered');
        }
    }

    // Sort by latest inventory date
        $schoolInventories = $schoolInventories->sortByDesc(function ($school) {
            return optional($school->inventories->first())->created_at;
        })->values();

        $divisionInventories = $divisionInventories->sortByDesc(function ($division) {
            return optional($division->inventories->first())->created_at;
        })->values();

    return view('superadmin.inventory.index', compact('schoolInventories', 'divisionInventories'));
}




    public function create()
    {
        $schools = School::all();
        $divisions = Division::all();
        return view('superadmin.inventory.create', compact('schools', 'divisions'));
    }

    public function store(Request $request)
    {
    $request->validate([
        'item_name' => 'required|string|max:255',
        'quantity' => 'required|integer|min:1',
        'status' => 'required|string',
        'remarks' => 'nullable|string',
        'school_id' => 'nullable|exists:schools,school_id',
        'division_id' => 'nullable|exists:division_offices,division_id',
        'recipient_id' => 'required|exists:recipients,id', 
    ]);

        Inventory::create($request->only([
            'item_name',
            'quantity',
            'status',
            'remarks',
            'school_id',
            'division_id',
            'recipient_id' // ✅ include recipient_id
        ]));


        return redirect()->route('inventory.index')->with('success', 'Inventory item added.');
    }

    public function edit(Inventory $inventory)
    {
        $schools = School::all();
        $divisions = Division::all();
        return view('superadmin.inventory.edit', compact('inventory', 'schools', 'divisions'));
    }

    public function update(Request $request, Inventory $inventory)
    {
        $request->validate([
            'item_name' => 'required|string|max:255',
            'quantity' => 'required|integer|min:1',
            'status' => 'required|string',
            'remarks' => 'nullable|string',
            'school_id' => 'nullable|exists:schools,school_id',
            'division_id' => 'nullable|exists:division_offices,division_id',
            'recipient_id' => 'required|exists:recipients,id',
        ]);

        $inventory->update($request->only([
            'item_name',
            'quantity',
            'status',
            'remarks',
            'school_id',
            'division_id',
            'recipient_id' // ✅
        ]));

        return redirect()->route('inventory.index')->with('success', 'Inventory updated.');
    }

    public function destroy(Inventory $inventory)
    {
        $inventory->delete();
        return redirect()->route('inventory.index')->with('success', 'Inventory deleted.');
    }

    public function markAsRead(Request $request)
{
    $id = $request->input('id');
    $type = $request->input('type');

    if ($type === 'school') {
        $school = \App\Models\School::find($id);
        if ($school) {
            $school->has_updates = false;
            $school->save();
        }
    } elseif ($type === 'division') {
        $division = \App\Models\DivisionOffice::find($id);
        if ($division) {
            $division->has_updates = false;
            $division->save();
        }
    }

    return response()->json(['status' => 'ok']);
}

}


