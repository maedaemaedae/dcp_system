<?php

namespace App\Http\Controllers;

use App\Models\School;
use App\Models\DivisionOffice;
use Illuminate\Http\Request;

class RecipientController extends Controller
{
    public function index(Request $request)
    {
        $query = School::with(['division','internet', 'electricity']);

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('school_name', 'LIKE', "%{$search}%")
                  ->orWhere('school_id', 'LIKE', "%{$search}%")
                  ->orWhere('school_address', 'LIKE', "%{$search}%")
                  ->orWhere('school_head', 'LIKE', "%{$search}%")
                  ->orWhere('level', 'LIKE', "%{$search}%")
                  ->orWhereHas('division', function ($sub) use ($search) {
                      $sub->where('division_name', 'LIKE', "%{$search}%");
                  })
                  ->orWhereHas('internet', function ($sub) use ($search) {
                      $sub->where('isp', 'LIKE', "%{$search}%")
                          ->orWhere('type_of_isp', 'LIKE', "%{$search}%")
                          ->orWhere('fund_source', 'LIKE', "%{$search}%");
                  })
                  ->orWhereHas('electricity', function ($sub) use ($search) {
                      $sub->where('electricity_source', 'LIKE', "%{$search}%");
                  });
            });
        }

        $schools = $query->get();
        $divisions = DivisionOffice::all();

        return view('recipients.index', compact('schools', 'divisions'));
    }

    public function create()
    {
        $divisions = DivisionOffice::all();
        return view('recipients.create', compact('divisions'));
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
        ]);

        $school = School::create(array_merge($validated, [
            'created_by' => auth()->user()->name ?? 'Seeder',
            'created_date' => now(),
        ]));

        $school->internet()->create($request->only([
            'connected_to_internet', 'isp', 'type_of_isp', 'fund_source'
        ]));

        $school->electricity()->create($request->only([
            'electricity_source'
        ]));

        return redirect()->route('recipients.index')->with('success', 'School added successfully.');
    }

    public function update(Request $request, $school_id)
    {
        $validated = $request->validate([
            'school_name' => 'required|string|max:255',
            'school_address' => 'required|string|max:255',
            'school_head' => 'required|string|max:255',
            'level' => 'required|string|max:50',
            'division_id' => 'required|exists:division_offices,division_id',
        ]);

        $school = School::findOrFail($school_id);

        $school->update(array_merge($validated, [
            'modified_by' => auth()->user()->name ?? 'Seeder',
            'modified_date' => now(),
        ]));

        $school->internet()->updateOrCreate(
            ['school_id' => $school->school_id],
            $request->only(['connected_to_internet', 'isp', 'type_of_isp', 'fund_source'])
        );

        $school->electricity()->updateOrCreate(
            ['school_id' => $school->school_id],
            $request->only(['electricity_source'])
        );

        return redirect()->route('recipient.index')->with('success', 'School updated successfully.');
    }

    public function destroy($school_id)
    {
        $school = School::findOrFail($school_id);
        $school->delete();

        return redirect()->route('recipients.index')->with('success', 'School deleted successfully.');
    }
}
