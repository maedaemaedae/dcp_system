<?php

namespace App\Http\Controllers;

use App\Models\School;
use App\Models\Division;
use App\Models\Municipality;
use Illuminate\Http\Request;

class SchoolController extends Controller
{
    public function index()
    {
        $schools = School::with(['division', 'municipality'])->get();
        return view('schools.index', compact('schools'));
    }

    public function create()
    {
        // Get the fixed division: Region IV-B MIMAROPA
        $division = Division::where('division_name', 'Region IV-B MIMAROPA')->firstOrFail();

        // Fetch all municipalities (assumed to be under Region IV-B MIMAROPA)
        $municipalities = Municipality::all();

        return view('schools.create', compact('division', 'municipalities'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'school_name' => 'required|string|max:255',
            'school_address' => 'required',
            'school_head' => 'required',
            'level' => 'required|in:Elementary,High School',
            'division_id' => 'required|exists:divisions,division_id',
            'municipality_id' => 'required|exists:municipalities,municipality_id',
        ]);

        School::create([
            'school_name' => $request->school_name,
            'school_address' => $request->school_address,
            'school_head' => $request->school_head,
            'level' => $request->level,
            'division_id' => $request->division_id,
            'municipality_id' => $request->municipality_id,
            'created_by' => auth()->user()->name,
            'created_date' => now(),
        ]);

        return redirect()->route('schools.index')->with('success', 'School created successfully.');
    }
}
