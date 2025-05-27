<?php

namespace App\Http\Controllers;

use App\Models\Package;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'package_code' => 'required|string|max:50|unique:package_types,package_code',
            'description' => 'nullable|string|max:255',
            'items' => 'required|array',
            'items.*.item_name' => 'required|string|max:255',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.description' => 'nullable|string|max:255',
        ]);

        $type = \App\Models\PackageType::create([
            'package_code' => $validated['package_code'],
            'description' => $validated['description'],
        ]);

        foreach ($validated['items'] as $item) {
            $type->contents()->create($item);
        }

        return back()->with('success', 'Package type created successfully.');
    }

}
