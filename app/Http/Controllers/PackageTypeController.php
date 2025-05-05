<?php

namespace App\Http\Controllers;

use App\Models\PackageType;
use App\Models\PackageContent;
use App\Models\Inventory;
use Illuminate\Http\Request;

class PackageTypeController extends Controller
{
    public function index()
    {
        $packages = PackageType::with('contents.inventory')->get();
        $inventoryItems = Inventory::all(); // this is what your modals need
    
        return view('packages.index', compact('packages', 'inventoryItems'));
    }
    public function create()
    {
        $inventoryItems = Inventory::all();
        return view('packages.create', compact('inventoryItems'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'package_code' => 'required|unique:package_types',
            'description' => 'nullable|string',
            'items' => 'array',
            'items.*.item_id' => 'required|exists:inventory,item_id',
            'items.*.quantity' => 'required|integer|min:1',
        ]);

        $package = PackageType::create([
            'package_code' => $request->package_code,
            'description' => $request->description,
        ]);

        foreach ($request->items as $item) {
            PackageContent::create([
                'package_type_id' => $package->id,
                'item_id' => $item['item_id'],
                'quantity' => $item['quantity'],
            ]);
        }

        return redirect()->route('package-types.index')->with('success', 'Package created successfully.');
    }

    public function edit(PackageType $package_type)
    {
        $inventoryItems = Inventory::all();
        $packageContents = $package_type->contents()->with('inventory')->get();

        return view('packages.edit', compact('package_type', 'inventoryItems', 'packageContents'));
    }

    public function update(Request $request, PackageType $package_type)
    {
        $request->validate([
            'package_code' => 'required|unique:package_types,package_code,' . $package_type->id,
            'description' => 'nullable|string',
            'items' => 'array',
            'items.*.item_id' => 'required|exists:inventory,item_id',
            'items.*.quantity' => 'required|integer|min:1',
        ]);

        $package_type->update([
            'package_code' => $request->package_code,
            'description' => $request->description,
        ]);

        // Clear and re-add contents
        $package_type->contents()->delete();

        foreach ($request->items as $item) {
            PackageContent::create([
                'package_type_id' => $package_type->id,
                'item_id' => $item['item_id'],
                'quantity' => $item['quantity'],
            ]);
        }

        return redirect()->route('package-types.index')->with('success', 'Package updated successfully.');
    }

    public function destroy(PackageType $package_type)
    {
        $package_type->contents()->delete();
        $package_type->delete();

        return redirect()->route('package-types.index')->with('success', 'Package deleted successfully.');
    }
}
