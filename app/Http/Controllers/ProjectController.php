<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\PackageType;
use App\Models\Package;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::with('packages.packageType')->get();
        $packageTypes = PackageType::all();
        $packages = Package::with(['packageType', 'project'])->get(); // 🔹 this is missing

        return view('projects.index', compact('projects', 'packageTypes', 'packages'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'target_delivery_date' => 'nullable|date',
            'target_arrival_date' => 'nullable|date',
        ]);

        Project::create($validated);

        return back()->with('success', 'Project created successfully.');
    }

    public function update(Request $request, $id)
    {
        $project = Project::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'target_delivery_date' => 'nullable|date',
            'target_arrival_date' => 'nullable|date',
        ]);

        $project->update($validated);

        return back()->with('success', 'Project updated successfully.');
    }

    public function destroy($id)
    {
        Project::destroy($id);

        return back()->with('success', 'Project deleted successfully.');
    }

}
