<?php

namespace App\Http\Controllers;

use App\Models\DivisionOffice;
use Illuminate\Http\Request;

class DivisionOfficeController extends Controller
{
    public function index()
    {
        $divisions = \App\Models\DivisionOffice::with('regionalOffice')->get();
        return view('divisionoffices.index', compact('divisions'));
    }
    
    public function create()
    {
        return view('divisions.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'division_id' => 'required|integer|unique:division_offices,division_id',
            'division_name' => 'required|string|max:255',
            'regional_office_id' => 'required|exists:regional_offices,ro_id',
            'person_in_charge' => 'required|string|max:255',
            'email' => 'nullable|email',
            'contact_no' => 'nullable|string|max:20',
        ]);
    
        DivisionOffice::create(array_merge($validated, [
            'created_by' => auth()->user()->name ?? 'Seeder',
            'created_date' => now(),
        ]));
    
        return redirect()->route('divisionoffices.index')->with('success', 'Division Office Added Successfully.');
    }
    
}
