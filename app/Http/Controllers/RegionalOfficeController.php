<?php

namespace App\Http\Controllers;

use App\Models\RegionalOffice;
use Illuminate\Http\Request;

class RegionalOfficeController extends Controller
{
    public function index()
    {
        $regionalOffices = RegionalOffice::all();
        return view('regionaloffices.index', compact('regionalOffices'));
    }

    public function create()
    {
        return view('regionaloffices.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'ro_office' => 'required|string|max:255',
            'person_in_charge' => 'required|string|max:255',
            'email' => 'nullable|email',
            'contact_no' => 'nullable|string|max:255',
        ]);

        RegionalOffice::create([
            'ro_office' => $request->ro_office,
            'person_in_charge' => $request->person_in_charge,
            'email' => $request->email,
            'contact_no' => $request->contact_no,
            'created_by' => auth()->user()->name ?? 'System',
            'created_date' => now(),
        ]);

        return redirect()->route('regional-offices.index')->with('success', 'Regional Office added successfully.');
    }

    public function edit($id)
    {
        $regionalOffice = RegionalOffice::findOrFail($id);
        return view('regionaloffices.edit', compact('regionalOffice'));
    }

    public function update(Request $request, $id)
    {
        $regionalOffice = RegionalOffice::findOrFail($id);

        $request->validate([
            'ro_office' => 'required|string|max:255',
            'person_in_charge' => 'required|string|max:255',
            'email' => 'nullable|email',
            'contact_no' => 'nullable|string|max:255',
        ]);

        $regionalOffice->update([
            'ro_office' => $request->ro_office,
            'person_in_charge' => $request->person_in_charge,
            'email' => $request->email,
            'contact_no' => $request->contact_no,
            'modified_by' => auth()->user()->name ?? 'System',
            'modified_date' => now(),
        ]);

        return redirect()->route('regional-offices.index')->with('success', 'Regional Office updated successfully.');
    }

    public function destroy($id)
    {
        $regionalOffice = RegionalOffice::findOrFail($id);
        $regionalOffice->delete();

        return redirect()->route('regional-offices.index')->with('success', 'Regional Office deleted.');
    }
}
