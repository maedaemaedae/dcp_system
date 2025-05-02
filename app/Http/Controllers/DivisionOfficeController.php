<?php

namespace App\Http\Controllers;

use App\Models\DivisionOffice;
use App\Models\RegionalOffice;
use Illuminate\Http\Request;

class DivisionOfficeController extends Controller
{

    public function index()
    {
        $divisions = DivisionOffice::with('regionalOffice')->get();
        $regionalOffices = RegionalOffice::all();
    
        return view('divisionoffices.index', compact('divisions', 'regionalOffices'));
    }
    

    public function create()
    {
        $regionalOffices = RegionalOffice::all();
        return view('divisionoffices.create', compact('regionalOffices'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'division_name' => 'required|string|max:255',
            'person_in_charge' => 'required|string|max:255',
            'email' => 'nullable|email',
            'contact_no' => 'nullable|string|max:255',
            'regional_office_id' => 'required|exists:regional_offices,ro_id',
        ]);

        DivisionOffice::create([
            'division_name' => $request->division_name,
            'person_in_charge' => $request->person_in_charge,
            'email' => $request->email,
            'contact_no' => $request->contact_no,
            'regional_office_id' => $request->regional_office_id,
            'created_by' => auth()->user()->name ?? 'System',
            'created_date' => now(),
        ]);

        return redirect()->route('division-offices.index')->with('success', 'Division Office added successfully.');
    }

    public function edit($id)
    {
        $division = DivisionOffice::findOrFail($id);
        $regionalOffices = RegionalOffice::all();
        return view('divisionoffices.edit', compact('division', 'regionalOffices'));
    }

    public function update(Request $request, $id)
    {
        $division = DivisionOffice::findOrFail($id);

        $request->validate([
            'division_name' => 'required|string|max:255',
            'person_in_charge' => 'required|string|max:255',
            'email' => 'nullable|email',
            'contact_no' => 'nullable|string|max:255',
            'regional_office_id' => 'required|exists:regional_offices,ro_id',
        ]);

        $division->update([
            'division_name' => $request->division_name,
            'person_in_charge' => $request->person_in_charge,
            'email' => $request->email,
            'contact_no' => $request->contact_no,
            'regional_office_id' => $request->regional_office_id,
            'modified_by' => auth()->user()->name ?? 'System',
            'modified_date' => now(),
        ]);

        return redirect()->route('division-offices.index')->with('success', 'Division Office updated successfully.');
    }

    public function destroy($id)
    {
        $division = DivisionOffice::findOrFail($id);
        $division->delete();

        return redirect()->route('division-offices.index')->with('success', 'Division Office deleted.');
    }
}
