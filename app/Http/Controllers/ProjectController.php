<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\PackageType;
use App\Models\Package;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
     public function index(Request $request)
    {
    $projects = Project::with('packages.packageType')->orderBy('created_at', 'desc')->paginate(3, ['*'], 'projects_page');
    $packages = Package::with(['project', 'packageType'])->orderBy('created_at', 'desc')->paginate(3, ['*'], 'packages_page');
    $packageTypes = PackageType::with('contents')->orderBy('created_at', 'desc')->paginate(3, ['*'], 'package_types_page');
    $allPackageTypes = PackageType::with('contents')->orderBy('created_at', 'desc')->get();

    if ($request->ajax()) {
        if ($request->type === 'projects') {
            return view('projects.partials.projects-table', compact('projects', 'packageTypes'))->render();
        }
        if ($request->type === 'packages') {
            return view('projects.partials.packages-card', compact('packages'))->render();
        }
        if ($request->type === 'package_types') {
            return view('projects.partials.package-types-card', compact('packageTypes'))->render();
        }
    }

    return view('projects.index', compact('projects', 'packages', 'packageTypes', 'allPackageTypes'));
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
