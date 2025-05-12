<?php

namespace App\Http\Controllers;

use App\Models\School;
use App\Models\DivisionOffice;
use App\Models\Municipality;
use Illuminate\Http\Request;

class SchoolController extends Controller
{
    public function index(Request $request)
    {
        $query = School::with(['division', 'municipality']);

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('school_name', 'LIKE', "%{$search}%")
                  ->orWhere('school_id', 'LIKE', "%{$search}%")
                  ->orWhere('school_address', 'LIKE', "%{$search}%");
            });
        }

        $schools = $query->get();
        $divisions = DivisionOffice::all();
        $municipalities = Municipality::all();

        return view('schools.index', compact('schools', 'divisions', 'municipalities'));
    }

    public function create()
    {
        $divisions = DivisionOffice::all();
        $municipalities = Municipality::all();
        return view('schools.create', compact('divisions', 'municipalities'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'school_id' => 'required|integer|unique:schools,school_id',
            'school_name' => 'required|string|max:255',
            'school_address' => 'required|string|max:255',
            'school_head' => 'required|string|max:255',
            'level' => 'required|string|max:50',
            'division_id' => 'required|exists:division_offices,division_id',
            'municipality_id' => 'required|exists:municipalities,municipality_id',
        ]);

        School::create(array_merge($validated, [
            'created_by' => auth()->user()->name ?? 'Seeder',
            'created_date' => now(),
        ]));

        return redirect()->route('schools.index')->with('success', 'School Added Successfully.');
    }

    public function update(Request $request, $school_id)
    {
        $validated = $request->validate([
            'school_name' => 'required|string|max:255',
            'school_address' => 'required|string|max:255',
            'school_head' => 'required|string|max:255',
            'level' => 'required|string|max:50',
            'division_id' => 'required|exists:division_offices,division_id',
            'municipality_id' => 'required|exists:municipalities,municipality_id',
        ]);

        $school = School::findOrFail($school_id);

        $school->update(array_merge($validated, [
            'modified_by' => auth()->user()->name ?? 'Seeder',
            'modified_date' => now(),
        ]));

        return redirect()->route('schools.index')->with('success', 'School Updated Successfully.');
    }

    public function destroy($school_id)
    {
        $school = School::findOrFail($school_id);
        $school->delete();

        return redirect()->route('schools.index')->with('success', 'School Deleted Successfully.');
    }
}
