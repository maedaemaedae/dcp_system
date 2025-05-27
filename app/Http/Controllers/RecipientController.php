<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\School;
use App\Models\RegionalOffice;
use App\Models\DivisionOffice;
use App\Imports\DivisionsImport;
use App\Models\Recipient;
use App\Models\Package;
use App\Models\PackageType;
use Maatwebsite\Excel\Facades\Excel;

class RecipientController extends Controller
{
    public function index()
    {
        $recipients = Recipient::with([
            'package.packageType',
            'school.division.regionalOffice',
            'division.regionalOffice'
        ])->get();

        $schools = School::all();
        $divisions = DivisionOffice::all();
        $packages = Package::with('packageType')->get();
        $regionalOffices = RegionalOffice::all();

        return view('recipients.index', compact(
            'recipients', 'schools', 'divisions', 'packages', 'regionalOffices'
        ));
    }

    // SCHOOL CRUD
    public function storeSchool(Request $request)
    {
        $validated = $request->validate([
            'school_id' => 'required|numeric|unique:schools,school_id',
            'division_id' => 'required|exists:division_offices,division_id',
            'school_name' => 'required|string',
            'school_address' => 'required|string',
            'has_internet' => 'required|boolean',
            'internet_provider' => 'nullable|string',
            'electricity_provider' => 'nullable|string'
            
        ]);

        School::create($validated);
        return back()->with('success', 'School added successfully.');
    }

    public function updateSchool(Request $request, $id)
    {
        $school = School::findOrFail($id);

        $validated = $request->validate([
            'division_id' => 'required|exists:division_offices,division_id',
            'school_name' => 'required|string',
            'school_address' => 'required|string',
            'has_internet' => 'required|boolean',
            'internet_provider' => 'nullable|string',
            'electricity_provider' => 'nullable|string'
        ]);

        $school->update($validated);
        return back()->with('success', 'School updated successfully.');
    }

    public function destroySchool($id)
    {
        School::destroy($id);
        return back()->with('success', 'School deleted successfully.');
    }

    // DIVISION CRUD
    public function storeDivision(Request $request)
    {
        $validated = $request->validate([
            'division_id' => 'required|numeric|unique:division_offices,division_id',
            'division_name' => 'required|string',
            'regional_office_id' => 'required|exists:regional_offices,ro_id'
        ]);

        DivisionOffice::create($validated);
        return back()->with('success', 'Division added successfully.');
    }

    public function updateDivision(Request $request, $id)
    {
        $division = DivisionOffice::findOrFail($id);

        $validated = $request->validate([
            'division_name' => 'required|string',
            'regional_office_id' => 'required|exists:regional_offices,ro_id'
        ]);

        $division->update($validated);
        return back()->with('success', 'Division updated successfully.');
    }

    public function destroyDivision($id)
    {
        DivisionOffice::destroy($id);
        return back()->with('success', 'Division deleted successfully.');
    }

    // CSV Upload
    public function uploadCsv(Request $request)
    {
        $request->validate([
            'csv_file' => 'required|file|mimes:csv,txt',
            'type' => 'required|in:school,division'
        ]);

        if ($request->type === 'school') {
            Excel::import(new SchoolsImport, $request->file('csv_file'));
        } else {
            Excel::import(new DivisionsImport, $request->file('csv_file'));
        }

        return back()->with('success', 'CSV uploaded successfully.');
    }

    // Recipient Table CRUD
    public function store(Request $request)
    {
        $validated = $request->validate([
            'package_id' => 'required|exists:packages,id',
            'recipient_type' => 'required|in:school,division',
            'recipient_id' => 'required|integer',
            'notes' => 'nullable|string|max:500',
        ]);

        Recipient::create($validated);

        return back()->with('success', 'Recipient added successfully.');
    }

    public function update(Request $request, $id)
    {
        $recipient = Recipient::findOrFail($id);

        $validated = $request->validate([
            'package_id' => 'required|exists:packages,id',
            'recipient_type' => 'required|in:school,division',
            'recipient_id' => 'required|integer',
            'notes' => 'nullable|string|max:500',
        ]);

        $recipient->update($validated);

        return back()->with('success', 'Recipient updated successfully.');
    }

    public function destroy($id)
    {
        Recipient::destroy($id);
        return back()->with('success', 'Recipient deleted successfully.');
    }


}
