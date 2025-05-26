<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\School;
use App\Models\RegionalOffice;
use App\Models\DivisionOffice;
use App\Imports\SchoolsImport;
use App\Imports\DivisionsImport;
use App\Models\DcpRecipientSchoolStv;
use App\Models\DcpRecipientSchoolL4t;
use App\Models\DcpRecipientDivisionOffice;
use Maatwebsite\Excel\Facades\Excel;

class RecipientController extends Controller
{
    public function index()
    {
        $regionalOffices = RegionalOffice::all();
        $schools = School::with('division.regionalOffice')->get();
        $divisions = DivisionOffice::with('regionalOffice')->get();
        $stvRecipients = DcpRecipientSchoolStv::with('school')->get();
        $l4tRecipients = DcpRecipientSchoolL4t::with('school')->get();
        $divisionRecipients = DcpRecipientDivisionOffice::with('division')->get();

    return view('recipients.index', [
        'schools' => $schools,
        'divisions' => $divisions,
        'regionalOffices' => $regionalOffices,
        'stvRecipients' => $stvRecipients,
        'l4tRecipients' => $l4tRecipients,
        'divisionRecipients' => $divisionRecipients,
        'divisionListJson' => $divisions->toJson(),
        'schoolListJson' => $schools->toJson(),
    ]);
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

    //Recipient CRUD
    public function storeStvRecipient(Request $request)
    {
        $validated = $request->validate([
            'region_id' => 'required|exists:regional_offices,ro_id',
            'division_id' => 'required|exists:division_offices,division_id',
            'school_id' => 'required|exists:schools,school_id',
            'school_name' => 'nullable|string|max:255',
            'school_address' => 'nullable|string|max:255',
            'quantity' => 'nullable|integer',
            'contact_person' => 'nullable|string|max:255',
            'position' => 'nullable|string|max:255',
            'contact_number' => 'nullable|string|max:50',
        ]);

        DcpRecipientSchoolStv::create($validated);

        return redirect()->route('recipients.index')->with('success', 'STV recipient added successfully!');
    }

    public function updateStvRecipient(Request $request, $id)
    {
        $recipient = DcpRecipientSchoolStv::findOrFail($id);

        $validated = $request->validate([
            'region_id' => 'required|exists:regional_offices,ro_id',
            'division_id' => 'required|exists:division_offices,division_id',
            'school_id' => 'required|exists:schools,school_id',
            'school_name' => 'nullable|string|max:255',
            'school_address' => 'nullable|string|max:255',
            'quantity' => 'nullable|integer',
            'contact_person' => 'nullable|string|max:255',
            'position' => 'nullable|string|max:255',
            'contact_number' => 'nullable|string|max:50',
        ]);

        $recipient->update($validated);

        return redirect()->route('recipients.index')->with('success', 'STV recipient updated successfully!');
    }

    public function storeL4tRecipient(Request $request)
    {
        $validated = $request->validate([
            'region_id' => 'required|exists:regional_offices,ro_id',
            'division_id' => 'required|exists:division_offices,division_id',
            'school_id' => 'required|exists:schools,school_id',
            'school_name' => 'nullable|string|max:255',
            'school_address' => 'nullable|string|max:255',
            'quantity' => 'nullable|integer',
            'contact_person' => 'nullable|string|max:255',
            'position' => 'nullable|string|max:255',
            'contact_number' => 'nullable|string|max:50',
        ]);

        DcpRecipientSchoolL4t::create($validated);

        return redirect()->route('recipients.index')->with('success', 'L4T recipient added successfully!');
    }

    public function updateL4tRecipient(Request $request, $id)
    {
        $recipient = DcpRecipientSchoolL4t::findOrFail($id);

        $validated = $request->validate([
            'region_id' => 'required|exists:regional_offices,ro_id',
            'division_id' => 'required|exists:division_offices,division_id',
            'school_id' => 'required|exists:schools,school_id',
            'school_name' => 'nullable|string|max:255',
            'school_address' => 'nullable|string|max:255',
            'quantity' => 'nullable|integer',
            'contact_person' => 'nullable|string|max:255',
            'position' => 'nullable|string|max:255',
            'contact_number' => 'nullable|string|max:50',
        ]);

        $recipient->update($validated);

        return redirect()->route('recipients.index')->with('success', 'L4T recipient updated successfully!');
    }

    public function storeDivisionRecipient(Request $request)
    {
        $validated = $request->validate([
            'region_id' => 'nullable|exists:regional_offices,ro_id',
            'division_id' => 'required|exists:division_offices,division_id',
            'quantity' => 'nullable|integer',
            'office' => 'nullable|string|max:255',
            'sdo_address' => 'nullable|string|max:255',
            'contact_person' => 'nullable|string|max:255',
            'position' => 'nullable|string|max:255',
            'contact_number' => 'nullable|string|max:50',
        ]);

        DcpRecipientDivisionOffice::create($validated);

        return redirect()->route('recipients.index')->with('success', 'Division recipient added successfully!');
    }

    public function updateDivisionRecipient(Request $request, $id)
    {
        $recipient = DcpRecipientDivisionOffice::findOrFail($id);

        $validated = $request->validate([
            'region_id' => 'nullable|exists:regional_offices,ro_id',
            'division_id' => 'required|exists:division_offices,division_id',
            'office' => 'nullable|string|max:255',
            'sdo_address' => 'nullable|string|max:255',
            'quantity' => 'nullable|integer',
            'contact_person' => 'nullable|string|max:255',
            'position' => 'nullable|string|max:255',
            'contact_number' => 'nullable|string|max:50',
        ]);

        $recipient->update($validated);

        return redirect()->route('recipients.index')->with('success', 'Division recipient updated successfully!');
    }


}
