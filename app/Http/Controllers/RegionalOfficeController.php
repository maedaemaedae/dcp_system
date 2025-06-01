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
        $validated = $request->validate([
            'ro_id' => 'required|integer|unique:regional_offices,ro_id',
            'ro_office' => 'required|string|max:255',
            'person_in_charge' => 'required|string|max:255',
            'email' => 'nullable|email',
            'contact_no' => 'nullable|string|max:20',
        ]);
    
        RegionalOffice::create(array_merge($validated, [
            'created_by' => auth()->user()->name ?? 'Seeder',
            'created_date' => now(),
        ]));
    
       return back()->with('success', 'Regional office added successfully.');
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

        return back()->with('success', 'Regional office updated successfully.');
    }

    public function destroy($id)
    {
        $regionalOffice = RegionalOffice::findOrFail($id);
        $regionalOffice->delete();

        return back()->with('success', 'Regional office deleted successfully.');
    }
}
