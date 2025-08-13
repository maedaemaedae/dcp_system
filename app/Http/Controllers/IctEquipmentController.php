<?php

namespace App\Http\Controllers;

use App\Models\IctEquipment;
use Illuminate\Http\Request;

class IctEquipmentController extends Controller
{
    public function index()
    {
        $equipments = IctEquipment::all();
        return view('ict-equipment.index', compact('equipments'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'equipment_id' => 'required|string',
            'item_description' => 'required|string',
            'category' => 'required|string',
            'brand' => 'required|string',
            'model' => 'required|string',
            'asset_number' => 'required|string',
            'serial_number' => 'required|string|unique:ict_equipment,serial_number',
            'location' => 'required|string',
            'assigned_to' => 'required|string',
            'purchase_date' => 'required|date',
            'warranty_expiry' => 'required|date',
            'condition' => 'required|in:IN USE,FOR REPAIR',
            'note' => 'nullable|string',
        ]);

        IctEquipment::create($request->all());

        return redirect()->route('ict-equipment.index')->with('success', 'ICT Equipment added successfully.');
    }

    public function edit($id)
    {
        $equipment = IctEquipment::findOrFail($id);
        return view('ict-equipment.edit', compact('equipment'));
    }

    public function update(Request $request, $id)
    {
        $equipment = IctEquipment::findOrFail($id);
        $equipment->update($request->all());

        return redirect()->route('ict-equipment.index')
            ->with('success', 'Equipment updated successfully.');
    }

    public function destroy($id)
    {
        $equipment = IctEquipment::findOrFail($id);
        $equipment->delete();

        return redirect()->route('ict-equipment.index')
            ->with('success', 'Equipment deleted successfully.');
    }

}
