
<?php

namespace App\Http\Controllers;

use App\Models\Package;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'project_id' => 'required|exists:projects,id',
            'package_type_id' => 'required|exists:package_types,id',
            'batch' => 'nullable|string|max:100',
            'lot' => 'nullable|string|max:100',
            'description' => 'nullable|string|max:500',
        ]);

        Package::create($validated);

        return back()->with('success', 'Package created successfully.');
    }
}
