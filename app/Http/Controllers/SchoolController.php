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
        $division = Division::where('division_name', 'Region IV-B MIMAROPA')->firstOrFail();
        $municipalities = Municipality::all();
        return view('schools.create', compact('division', 'municipalities'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'school_id' => 'required|unique:schools,school_id',
            'school_name' => 'required|string|max:255',
            'school_address' => 'required',
            'school_head' => 'required',
            'level' => 'required|in:Elementary,High School',
            'division_id' => 'required|exists:divisions,division_id',
            'municipality_id' => 'required|exists:municipalities,municipality_id',
        ]);

        School::create([
            'school_id' => $request->school_id,
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

    public function edit(School $school)
    {
        $division = Division::where('division_name', 'Region IV-B MIMAROPA')->firstOrFail();
        $municipalities = Municipality::all();
        return view('schools.edit', compact('school', 'division', 'municipalities'));
    }

    public function update(Request $request, School $school)
    {
        $request->validate([
            'school_id' => 'required|unique:schools,school_id,' . $school->school_id . ',school_id',
            'school_name' => 'required|string|max:255',
            'school_address' => 'required',
            'school_head' => 'required',
            'level' => 'required|in:Elementary,High School',
            'division_id' => 'required|exists:divisions,division_id',
            'municipality_id' => 'required|exists:municipalities,municipality_id',
        ]);

        $school->update([
            'school_id' => $request->school_id,
            'school_name' => $request->school_name,
            'school_address' => $request->school_address,
            'school_head' => $request->school_head,
            'level' => $request->level,
            'division_id' => $request->division_id,
            'municipality_id' => $request->municipality_id,
        ]);

        return redirect()->route('schools.index')->with('success', 'School updated successfully.');
    }

    public function destroy(School $school)
    {
        $school->delete();
        return redirect()->route('schools.index')->with('success', 'School deleted successfully.');
    }
}
