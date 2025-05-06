<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\PackageType;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    // Display list of projects
    public function index()
    {
        $projects = Project::with('packageTypes')->get();
        return view('projects.index', compact('projects'));
    }

    // Show form to create new project
    public function create()
    {
        $packageTypes = PackageType::all();
        return view('projects.create', compact('packageTypes'));
    }

    // Store new project and attach package types
    public function store(Request $request)
    {
        $validated = $request->validate([
            'school_id' => 'required|exists:schools,id',
            'project_name' => 'required|string|max:255',
            'year' => 'required|integer',
            'description' => 'nullable|string',
            'created_by' => 'nullable|string|max:255',
            'package_type_ids' => 'required|array',
            'package_type_ids.*' => 'exists:package_types,id',
        ]);

        $project = Project::create([
            'school_id' => $validated['school_id'],
            'project_name' => $validated['project_name'],
            'year' => $validated['year'],
            'description' => $validated['description'],
            'created_by' => $validated['created_by'],
            'created_date' => now(),
        ]);

        $project->packageTypes()->attach($validated['package_type_ids']);

        return redirect()->route('projects.index')->with('success', 'Project created successfully.');
    }

    // Show a single project's details
    public function show($id)
    {
        $project = Project::with('packageTypes')->findOrFail($id);
        return view('projects.show', compact('project'));
    }

    // Edit form for existing project
    public function edit($id)
    {
        $project = Project::findOrFail($id);
        $packageTypes = PackageType::all();
        $selectedTypes = $project->packageTypes->pluck('id')->toArray();

        return view('projects.edit', compact('project', 'packageTypes', 'selectedTypes'));
    }

    // Update existing project details
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'school_id' => 'required|exists:schools,id',
            'project_name' => 'required|string|max:255',
            'year' => 'required|integer',
            'description' => 'nullable|string',
            'created_by' => 'nullable|string|max:255',
            'package_type_ids' => 'required|array',
            'package_type_ids.*' => 'exists:package_types,id',
        ]);

        $project = Project::findOrFail($id);
        $project->update([
            'school_id' => $validated['school_id'],
            'project_name' => $validated['project_name'],
            'year' => $validated['year'],
            'description' => $validated['description'],
            'created_by' => $validated['created_by'],
        ]);

        $project->packageTypes()->sync($validated['package_type_ids']);

        return redirect()->route('projects.index')->with('success', 'Project updated successfully.');
    }

    // Delete project
    public function destroy($id)
    {
        $project = Project::findOrFail($id);
        $project->packageTypes()->detach();
        $project->delete();

        return redirect()->route('projects.index')->with('success', 'Project deleted successfully.');
    }
}
