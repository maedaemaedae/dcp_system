<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\PackageType;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::with('packages.packageType')->get();
        $packageTypes = PackageType::all();

        return view('projects.index', compact('projects', 'packageTypes'));
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
}
