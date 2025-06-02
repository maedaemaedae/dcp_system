<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Package;
use App\Models\PackageType;
use App\Models\Project;
use Illuminate\Support\Facades\Log;

class PackageController extends Controller
{
    public function index()
    {
        $projects = Project::with('packages.packageType')->get();
        $packageTypes = PackageType::with('contents')->get();
        $packages = Package::with(['packageType', 'project'])->get();

        return view('projects.index', compact('projects', 'packageTypes', 'packages'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'project_id' => 'required|exists:projects,id',
            'package_type_id' => 'required|exists:package_types,id',
            'batch' => 'nullable|string|max:100',
            'lot' => 'nullable|string|max:100',
            'description' => 'nullable|string|max:500',
        ]);

        Log::info('PACKAGE STORE HIT', $validated);

        $package = Package::create([
            'project_id' => $validated['project_id'],
            'package_type_id' => $validated['package_type_id'],
            'batch' => $validated['batch'],
            'lot' => $validated['lot'],
            'description' => $validated['description'],
        ]);

        Log::info('PACKAGE CREATED', ['id' => $package->id]);

        return back()->with('success', 'Package created successfully.');
    }

    public function update(Request $request, $id)
    {
        $package = Package::findOrFail($id);

        $validated = $request->validate([
            'project_id' => 'required|exists:projects,id',
            'package_type_id' => 'required|exists:package_types,id',
            'batch' => 'nullable|string|max:100',
            'lot' => 'nullable|string|max:100',
            'description' => 'nullable|string|max:500',
        ]);

        $package->update($validated);

        return back()->with('success', 'Package updated successfully.');
    }

    public function destroy($id)
    {
        Package::destroy($id);

        return back()->with('success', 'Package deleted successfully.');
    }

}
