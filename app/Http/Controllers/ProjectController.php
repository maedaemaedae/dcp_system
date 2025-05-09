<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Package;
use App\Models\ProjectSchoolAssignment;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'package_types' => 'required|array',
            'package_types.*' => 'exists:package_types,id',
            'school_ids' => 'required|array',
            'school_ids.*' => 'exists:schools,school_id',
            'target_delivery_date' => 'required|date',
            'target_arrival_date' => 'required|date',
        ]);

        // 1. Create the project
        $project = Project::create([
            'name' => $validated['name'],
            'target_delivery_date' => $validated['target_delivery_date'],
            'target_arrival_date' => $validated['target_arrival_date'],
        ]);

        // 2. Add packages to the project
        foreach ($validated['package_types'] as $typeId) {
            Package::create([
                'package_type_id' => $typeId,
                'project_id' => $project->id,
            ]);
        }

        // 3. Assign schools
        foreach ($validated['school_ids'] as $schoolId) {
            ProjectSchoolAssignment::create([
                'project_id' => $project->id,
                'school_id' => $schoolId,
            ]);
        }

        return redirect()->route('projects.index')->with('success', 'Project created successfully.');
    }
    
        public function index()
    {
        $projects = Project::with('packages')->get();
        $packageTypes = \App\Models\PackageType::all();
        $divisions = \App\Models\DivisionOffice::all();
        $packages = \App\Models\Package::whereNull('project_id')->get();

        return view('projects.index', compact('projects', 'packages', 'packageTypes', 'divisions'));
    }

}
