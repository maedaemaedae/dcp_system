<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\School;
use App\Models\Division;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    public function index()
    {
        $inventories = Inventory::with(['school', 'division'])->latest()->get();
        return view('superadmin.inventory.index', compact('inventories'));
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
        ]);

        Inventory::create($request->all());

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
        ]);

        $inventory->update($request->all());

        return redirect()->route('inventory.index')->with('success', 'Inventory updated.');
    }

    public function destroy(Inventory $inventory)
    {
        $inventory->delete();
        return redirect()->route('inventory.index')->with('success', 'Inventory deleted.');
    }
}
