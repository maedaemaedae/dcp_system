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
        $totalQuantity = Inventory::sum('quantity');

        $nameTotals = Inventory::select('item_name', \DB::raw('SUM(quantity) as total_quantity'))
            ->groupBy('item_name')
            ->orderBy('item_name')
            ->get();
         
        return view('inventory.index', compact('items', 'nameTotals', 'totalQuantity'));
            
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
            'quantity' => 'required|integer|min:0',
        ]);

        Inventory::create([
            'item_name' => $request->item_name,
            'description' => $request->description,
            'quantity' => $request->quantity,
            'created_by' => Auth::user()->name,
            'created_date' => now(),
        ]);

        return redirect()->route('inventory.index')->with('success', 'Item added successfully.');
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
            'quantity' => 'required|integer|min:0',
        ]);

        $item->update([
            'item_name' => $request->item_name,
            'description' => $request->description,
            'quantity' => $request->quantity,
            'modified_by' => Auth::user()->name ?? 'System',
            'modified_date' => now(),
        ]);

        return redirect()->route('inventory.index')->with('success', 'Item updated successfully.');
    }

    public function destroy($id)
    {
        $item = Inventory::findOrFail($id);
        $item->delete();

        return redirect()->route('inventory.index')->with('success', 'Item deleted.');
    }
}
