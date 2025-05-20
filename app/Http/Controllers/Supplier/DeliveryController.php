<?php

namespace App\Http\Controllers\Supplier;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Delivery;

class DeliveryController extends Controller
{
    public function index()
    {
        $deliveries = Delivery::with(['school', 'package.packageType'])->get();

        return view('supplier.deliveries.index', compact('deliveries'));
    }

    public function edit(Delivery $delivery)
    {
        return view('supplier.deliveries.edit', compact('delivery'));
    }

    public function update(Request $request, Delivery $delivery)
    {
        $validated = $request->validate([
            'status' => 'required|string',
            'delivery_date' => 'nullable|date',
            'arrival_date' => 'nullable|date',
            'remarks' => 'nullable|string',
            'proof' => 'required|file|mimes:jpg,jpeg,png,pdf|max:10240', // Require proof file
        ]);

        $path = $request->file('proof')->store('public/proofs');
        $delivery->proof_path = $path;
        $delivery->save();

        $delivery->update($validated);

        return redirect()->route('supplier.deliveries.index')->with('success', 'Delivery updated successfully.');
    }
}
