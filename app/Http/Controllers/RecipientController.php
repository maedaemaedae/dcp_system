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
    // Paginated Recipients
    $recipients = Recipient::with([
        'package.packageType',
        'creator',
        'modifier',
        'school.division.regionalOffice',
        'division.regionalOffice'
    ])
    ->orderBy('created_at', 'desc')
    ->paginate(10)
    ->through(function ($recipient) {
        $recipient->school_office_name = $recipient->recipient_type === 'school'
            ? optional($recipient->school)->school_name
            : optional($recipient->division)->division_name;

        $recipient->address = $recipient->recipient_type === 'school'
            ? optional($recipient->school)->school_address
            : optional($recipient->division)->sdo_address;

        $recipient->region = $recipient->recipient_type === 'school'
            ? optional(optional($recipient->school)->division)->regionalOffice->ro_office ?? null
            : optional($recipient->division)->regionalOffice->ro_office ?? null;

        $recipient->division_name = $recipient->recipient_type === 'school'
            ? optional(optional($recipient->school)->division)->division_name
            : optional($recipient->division)->division_name;

        return $recipient;
    });

    // Paginated Schools
    $schools = School::with('division.regionalOffice')
        ->orderBy('created_at', 'desc')
        ->paginate(10);

    // Paginated Divisions
    $divisions = DivisionOffice::with('regionalOffice')
        ->orderBy('created_at', 'desc')
        ->paginate(10);

    // Paginated Regional Offices
    $regionalOffices = RegionalOffice::orderBy('created_at', 'desc')
        ->paginate(10);

    // Paginated Packages
    $packages = Package::with('packageType')
        ->orderBy('created_at', 'desc')
        ->paginate(10);

    return view('recipients.index', compact(
        'recipients',
        'schools',
        'divisions',
        'regionalOffices',
        'packages'
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

    //CSV Upload
   public function importDivisions(Request $request)
{
    $request->validate(['csv_file' => 'required|mimes:csv,txt']);

    $file = fopen($request->file('csv_file'), 'r');
    $rawHeader = fgetcsv($file);
$header = array_map('trim', $rawHeader);
$requiredHeaders = ['Region', 'Division ID', 'Division Name'];

$missingHeaders = array_diff($requiredHeaders, $header);

if (!empty($missingHeaders)) {
    $missingList = implode(', ', $missingHeaders);
    return back()->withErrors(["Missing required column(s): {$missingList}"])->with('upload_source', 'divisions');
}
    $rows = [];
    $errors = [];
    $inserted = [];

    while (($line = fgetcsv($file)) !== false) {
        $rows[] = array_combine($header, $line);
    }

    fclose($file);

    foreach ($rows as $index => $row) {
        $region          = trim($row['Region']);
        $divisionId      = trim($row['Division ID']);
        $divisionName    = trim($row['Division Name']);
        $office          = trim($row['Office']);
        $sdoAddress      = trim($row['SDO Address']);

        $rowNum = $index + 2; // +2 accounts for 0-based index + header

        if (!$divisionId || !$divisionName || !$region) {
            $errors[] = "Row {$rowNum}: Missing required fields.";
            continue;
        }

        $regional_office_id = RegionalOffice::where('ro_office', $region)->value('ro_id');

        if (!$regional_office_id) {
            $errors[] = "Row {$rowNum}: Region '{$region}' not found in regional offices.";
            continue;
        }

        if (DivisionOffice::where('division_id', $divisionId)->exists()) {
            $errors[] = "Row {$rowNum}: Division ID '{$divisionId}' already exists.";
            continue;
        }

        $inserted[] = [
            'division_id'        => $divisionId,
            'division_name'      => $divisionName,
            'office'             => $office,
            'sdo_address'        => $sdoAddress,
            'regional_office_id' => $regional_office_id,
        ];
    }

    if (!empty($errors)) {
        return back()->withErrors($errors)->withInput();
    }

    DivisionOffice::insert($inserted);

    return back()->with('success', 'Divisions imported successfully.');
}


    public function importSchools(Request $request)
{
    $request->validate(['csv_file' => 'required|mimes:csv,txt']);

    $file = fopen($request->file('csv_file'), 'r');
    $rawHeader = fgetcsv($file);
    $header = array_map('trim', $rawHeader);
    $requiredHeaders = ['Division', 'School ID', 'School Name', 'School Address'];

    $missingHeaders = array_diff($requiredHeaders, $header);
    if (!empty($missingHeaders)) {
        $missingList = implode(', ', $missingHeaders);
        return back()->withErrors(["Missing required column(s): {$missingList}"])->with('upload_source', 'schools');
    }

    $rows = [];
    $errors = [];
    $inserted = [];

    while (($line = fgetcsv($file)) !== false) {
        $rows[] = array_combine($header, $line);
    }

    fclose($file);

    foreach ($rows as $index => $row) {
        $rowNum = $index + 2;
        $division_name = trim($row['Division'] ?? '');
        $school_id     = trim($row['School ID'] ?? '');
        $school_name   = trim($row['School Name'] ?? '');
        $address       = trim($row['School Address'] ?? '');
        $internet      = strtolower(trim($row['Connected to Internet?'] ?? 'no')) === 'yes' ? 1 : 0;
        $isp           = trim($row['ISP'] ?? '');
        $electricity   = trim($row['Electricity'] ?? '');

        if (!$division_name || !$school_id || !$school_name) {
            $errors[] = "Row {$rowNum}: Missing required values.";
            continue;
        }

        $division_id = DivisionOffice::where('division_name', $division_name)->value('division_id');
        if (!$division_id) {
            $errors[] = "Row {$rowNum}: Division '{$division_name}' not found.";
            continue;
        }

        if (School::where('school_id', $school_id)->exists()) {
            $errors[] = "Row {$rowNum}: School ID '{$school_id}' already exists.";
            continue;
        }

        $inserted[] = [
            'school_id' => $school_id,
            'division_id' => $division_id,
            'school_name' => $school_name,
            'school_address' => $address,
            'has_internet' => $internet,
            'internet_provider' => $isp,
            'electricity_provider' => $electricity,
        ];
    }

    if (!empty($errors)) {
        return back()->withErrors($errors)->with('upload_source', 'schools');
    }

    School::insert($inserted);

    return back()->with('success', 'Schools imported successfully.');
}


   public function importRecipients(Request $request)
{
    $request->validate(['csv_file' => 'required|mimes:csv,txt']);

    $file = fopen($request->file('csv_file'), 'r');
    $rawHeader = fgetcsv($file);
    $header = array_map('trim', $rawHeader);
    $requiredHeaders = ['Recipient Type', 'Recipient ID', 'Package ID', 'Contact Person', 'Position', 'Contact Number', 'Quantity'];

    $missingHeaders = array_diff($requiredHeaders, $header);
    if (!empty($missingHeaders)) {
        $missingList = implode(', ', $missingHeaders);
        return back()->withErrors(["Missing required column(s): {$missingList}"])->with('upload_source', 'recipients');
    }

    $rows = [];
    $errors = [];
    $inserted = [];

    while (($line = fgetcsv($file)) !== false) {
        $rows[] = array_combine($header, $line);
    }

    fclose($file);

    foreach ($rows as $index => $row) {
        $rowNum = $index + 2;
        $recipientType   = strtolower(trim($row['Recipient Type'] ?? ''));
        $recipientId     = trim($row['Recipient ID'] ?? '');
        $packageId       = trim($row['Package ID'] ?? '');
        $contactPerson   = trim($row['Contact Person'] ?? '');
        $position        = trim($row['Position'] ?? '');
        $contactNumber   = trim($row['Contact Number'] ?? '');
        $quantity        = trim($row['Quantity'] ?? '');

        if (!$recipientType || !$recipientId || !$packageId || !$contactPerson || !$position || !$contactNumber || !$quantity) {
            $errors[] = "Row {$rowNum}: Missing required values.";
            continue;
        }

        if (!Package::find($packageId)) {
            $errors[] = "Row {$rowNum}: Package ID '{$packageId}' does not exist.";
            continue;
        }

        $isValidRecipient = match ($recipientType) {
            'school' => School::where('school_id', $recipientId)->exists(),
            'division' => DivisionOffice::where('division_id', $recipientId)->exists(),
            default => false,
        };

        if (!$isValidRecipient) {
            $errors[] = "Row {$rowNum}: Invalid recipient ID '{$recipientId}' for type '{$recipientType}'.";
            continue;
        }

        $inserted[] = [
            'recipient_type'  => $recipientType,
            'recipient_id'    => $recipientId,
            'package_id'      => $packageId,
            'contact_person'  => $contactPerson,
            'position'        => $position,
            'contact_number'  => $contactNumber,
            'quantity'        => $quantity,
            'created_by'      => auth()->id(),
        ];
    }

    if (!empty($errors)) {
        return back()->withErrors($errors)->with('upload_source', 'recipients');
    }

    Recipient::insert($inserted);

    return back()->with('success', 'Recipients imported successfully.');
}


    // Recipient Table CRUD
    public function store(Request $request)
    {
        $validated = $request->validate([
            'package_id'     => 'required|exists:packages,id',
            'recipient_type' => 'required|in:school,division',
            'recipient_id'   => 'required|integer',
            'contact_person' => 'required|string|max:255',
            'position'       => 'nullable|string|max:255',
            'contact_number' => 'nullable|string|max:50',
            'quantity'       => 'required|integer|min:1', // ✅ Add this line
        ]);

        $validated['created_by'] = auth()->id();

        Recipient::create($validated);

        return back()->with('success', 'Recipient added successfully.');
    }


    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'contact_person' => 'required|string|max:255',
            'position' => 'nullable|string|max:255',
            'contact_number' => 'nullable|string|max:50',
            'quantity' => 'required|integer|min:1',
        ]);

        $recipient = Recipient::findOrFail($id);

        $recipient->update([
            'contact_person' => $validated['contact_person'],
            'position' => $validated['position'],
            'contact_number' => $validated['contact_number'],
            'quantity' => $validated['quantity'],
        ]);
        \Log::info('Recipient updated', $validated);
        return redirect()->route('recipients.index')->with('success', 'Recipient updated successfully.');
    }


    public function destroy($id)
    {
        Recipient::destroy($id);
        return back()->with('success', 'Recipient deleted successfully.');
    }


}
