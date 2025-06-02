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
        $recipients = Recipient::with(['package.packageType', 'creator', 'modifier'])
            ->get()
            ->map(function ($recipient) {
                $recipient->school_office_name = $recipient->recipient_type === 'school'
                    ? optional($recipient->school)->school_name
                    : optional($recipient->division)->division_name;

                $recipient->address = $recipient->recipient_type === 'school'
                    ? optional($recipient->school)->school_address
                    : optional($recipient->division)->sdo_address;

                $recipient->region = $recipient->recipient_type === 'school'
                    ? optional($recipient->school->division)->regionalOffice->ro_office ?? null
                    : optional($recipient->division)->regionalOffice->ro_office ?? null;

                $recipient->division_name = $recipient->recipient_type === 'school'
                    ? optional($recipient->school->division)->division_name
                    : optional($recipient->division)->division_name;

                return $recipient;
            });

        $schools = \App\Models\School::with('division.regionalOffice')->get();
        $divisions = \App\Models\DivisionOffice::with('regionalOffice')->get();
        $regionalOffices = \App\Models\RegionalOffice::all(); // ✅ ADD THIS
        $packages = \App\Models\Package::with('packageType')->get();

        return view('recipients.index', compact('recipients', 'schools', 'divisions', 'regionalOffices', 'packages'));
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

    public function storeDivision(Request $request)
    {
        $validated = $request->validate([
            'division_id' => 'required|numeric|unique:division_offices,division_id',
            'division_name' => 'required|string|max:255',
            'regional_office_id' => 'required|exists:regional_offices,ro_id',
            'office' => 'nullable|string|max:255',
            'sdo_address' => 'nullable|string|max:255',
        ]);

        DivisionOffice::create(array_merge($validated, [
            'created_at' => auth()->user()->name ?? 'Seeder',
            'created_at' => now(),
        ]));

        return back()->with('success', 'Division added successfully.');
    }

    public function updateDivision(Request $request, $id)
    {
        $division = DivisionOffice::findOrFail($id);

        $validated = $request->validate([
            'division_name' => 'required|string|max:255',
            'regional_office_id' => 'required|exists:regional_offices,ro_id',
            'office' => 'nullable|string|max:255',
            'sdo_address' => 'nullable|string|max:255',
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
            'contact_person' => 'required|string|max:255',
            'position' => 'nullable|string|max:255',
            'contact_number' => 'nullable|string|max:50',
            'notes' => 'nullable|string|max:500',
        ]);

        $validated['created_by'] = auth()->id();

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
