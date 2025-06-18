<?php

namespace App\Http\Controllers;

use App\Models\PackageType;
use Illuminate\Http\Request;

class PackageTypeController extends Controller
{

    public function index()
    {
        $packageTypes = \App\Models\PackageType::with('contents')->get();
        $projects = \App\Models\Project::with('packages.packageType')->get(); // ✅ required
        $packages = \App\Models\Package::with(['packageType', 'project'])->get(); // ✅ for top table

        return view('projects.index', compact('packageTypes', 'projects', 'packages'));
    }


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

        $type = PackageType::create([
            'package_code' => $validated['package_code'],
            'description' => $validated['description'],
        ]);

        foreach ($validated['items'] as $item) {
            $type->contents()->create($item);
        }

        return back()->with('success', 'Package type created successfully.');
    }
}