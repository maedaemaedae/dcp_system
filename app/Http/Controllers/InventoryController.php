<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InventoryController extends Controller
{
    public function index()
    {
        $items = Inventory::all();
        return view('inventory.index', compact('items'));
    }

    public function create()
    {
        return view('inventory.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'item_name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        Inventory::create([
            'item_name' => $request->item_name,
            'description' => $request->description,
            'created_by' => Auth::user()->name ?? 'System',
            'created_date' => now(),
        ]);

        return redirect()->route('inventory.index')->with('success', 'Item Added Successfully.');
    }

    public function edit($id)
    {
        $item = Inventory::findOrFail($id);
        return view('inventory.edit', compact('item'));
    }

    public function update(Request $request, $id)
    {
        $item = Inventory::findOrFail($id);

        $request->validate([
            'item_name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $item->update([
            'item_name' => $request->item_name,
            'description' => $request->description,
            'modified_by' => Auth::user()->name ?? 'System',
            'modified_date' => now(),
        ]);

        return redirect()->route('inventory.index')->with('success', 'Item Updated Successfully.');
    }

    public function destroy($id)
    {
        $item = Inventory::findOrFail($id);
        $item->delete();

        return redirect()->route('inventory.index')->with('success', 'Item Deleted Successfully.');
    }
}
