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
            'ro_address' => 'nullable|string|max:255',
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
            'ro_address' => 'required|string|max:255',
            'person_in_charge' => 'required|string|max:255',
            'email' => 'nullable|email',
            'contact_no' => 'nullable|string|max:255',
        ]);

        $regionalOffice->update([
            'ro_office' => $request->ro_office,
            'person_in_charge' => $request->person_in_charge,
            'ro_address' => $request->ro_address,
            'email' => $request->email,
            'contact_no' => $request->contact_no,
            'modified_by' => auth()->user()->name ?? 'System',
            'modified_date' => now(),
        ]);

        return back()->with('success', 'Regional office updated successfully.');
    }

    public function importRegionalOffices(Request $request)
    {
        $request->validate(['csv_file' => 'required|mimes:csv,txt']);

        $file = fopen($request->file('csv_file'), 'r');
        $header = fgetcsv($file);
        $rows = [];

        while (($line = fgetcsv($file)) !== false) {
            $rows[] = array_combine($header, $line);
        }

        fclose($file);

        foreach ($rows as $row) {
            $data = [
                'ro_id'            => trim($row['RO ID'] ?? ''),
                'ro_office'        => trim($row['RO Office'] ?? ''),
                'ro_address'       => trim($row['RO Address'] ?? ''),
                'person_in_charge' => trim($row['Person In Charge'] ?? ''),
                'email'            => trim($row['Email'] ?? ''),
                'contact_no'       => trim($row['Contact No'] ?? ''),
                'created_by'       => auth()->id(), // ✅ fallback from Seeder
                'created_date'     => now(),
            ];

            // Skip if required fields are missing
            if (empty($data['ro_id']) || empty($data['ro_office']) || empty($data['email'])) {
                continue;
            }

            if (\App\Models\RegionalOffice::where('ro_id', $data['ro_id'])->exists()) {
                continue;
            }

            \App\Models\RegionalOffice::create($data);
        }

        return back()->with('success', 'Regional offices imported successfully.');
    }

    public function destroy($id)
    {
        $regionalOffice = RegionalOffice::findOrFail($id);
        $regionalOffice->delete();

        return back()->with('success', 'Regional office deleted successfully.');
    }
}
