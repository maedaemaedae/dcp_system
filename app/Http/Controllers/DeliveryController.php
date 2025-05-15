<?php

namespace App\Http\Controllers;

use App\Models\Delivery;
use Illuminate\Http\Request;

class DeliveryController extends Controller
{
    public function index()
    {
        $deliveries = \App\Models\Delivery::with(['school', 'package.packageType'])->get();

        return view('deliveries.index', compact('deliveries'));
    }

    public function edit(Delivery $delivery)
    {
        return view('deliveries.edit', compact('delivery'));
    }

    public function update(Request $request, Delivery $delivery)
    {
        $validated = $request->validate([
            'status' => 'required|string',
            'delivery_date' => 'nullable|date',
            'arrival_date' => 'nullable|date',
            'remarks' => 'nullable|string',
        ]);

        $delivery->update($validated);

        return redirect()->route('deliveries.index')->with('success', 'Delivery updated successfully.');
    }
}
