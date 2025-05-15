<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Package;
use App\Models\ProjectSchoolAssignment;
use Illuminate\Http\Request;
use App\Models\Delivery;
use App\Models\School;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::with(['packages.packageType', 'schools'])->get();
        $packageTypes = \App\Models\PackageType::all();
        $divisions = \App\Models\DivisionOffice::all();
        $packages = \App\Models\Package::whereNull('project_id')->get();

        return view('projects.index', compact('projects', 'packages', 'packageTypes', 'divisions'));
    }

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

        $project = Project::create([
            'name' => $validated['name'],
            'target_delivery_date' => $validated['target_delivery_date'],
            'target_arrival_date' => $validated['target_arrival_date'],
            'status' => 'Pending'
        ]);

        // Attach packages to project
        foreach ($validated['package_types'] as $typeId) {
            Package::create([
                'package_type_id' => $typeId,
                'project_id' => $project->id,
            ]);
        }

        // Attach schools to project
        foreach ($validated['school_ids'] as $schoolId) {
            ProjectSchoolAssignment::create([
                'project_id' => $project->id,
                'school_id' => $schoolId,
            ]);
        }

        // ✅ Auto-create deliveries
        $projectPackages = Package::where('project_id', $project->id)->get();

        foreach ($validated['school_ids'] as $schoolId) {
            foreach ($projectPackages as $package) {
                Delivery::create([
                    'project_id' => $project->id,
                    'school_id' => $schoolId,
                    'package_id' => $package->id,
                    'status' => 'Pending',
                ]);
            }
        }

        return redirect()->route('projects.index')->with('success', 'Project created successfully.');
    }


    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'target_delivery_date' => 'required|date',
            'target_arrival_date' => 'required|date',
            'status' => 'required|in:Pending,In Progress,Delivered,Cancelled',
            'package_types' => 'required|array',
            'package_types.*' => 'exists:package_types,id',
            'school_ids' => 'required|array',
            'school_ids.*' => 'exists:schools,school_id',
        ]);

        $project = Project::findOrFail($id);

        $project->update([
            'name' => $validated['name'],
            'target_delivery_date' => $validated['target_delivery_date'],
            'target_arrival_date' => $validated['target_arrival_date'],
            'status' => $validated['status'],
        ]);

        Package::where('project_id', $project->id)->delete();
        foreach ($validated['package_types'] as $typeId) {
            Package::create([
                'package_type_id' => $typeId,
                'project_id' => $project->id,
            ]);
        }

        ProjectSchoolAssignment::where('project_id', $project->id)->delete();
        foreach ($validated['school_ids'] as $schoolId) {
            ProjectSchoolAssignment::create([
                'project_id' => $project->id,
                'school_id' => $schoolId,
            ]);
        }

        return redirect()->route('projects.index')->with('success', 'Project updated successfully.');
    }

        public function showDeliveries($id)
    {
        $project = Project::findOrFail($id);
        $deliveries = PackageDelivery::with(['school', 'packageType'])
                        ->where('project_id', $id)
                        ->get();

        return view('deliveries.deliveries', compact('deliveries', 'project'));
    }

        public function destroy($id)
    {
        $project = Project::findOrFail($id);

        // Delete related packages
        Package::where('project_id', $project->id)->delete();

        // Delete school assignments
        ProjectSchoolAssignment::where('project_id', $project->id)->delete();

        // Delete the project
        $project->delete();

        return redirect()->route('projects.index')->with('success', 'Project deleted successfully.');
    }

}
