<?php

namespace App\Http\Controllers\Supplier;

use App\Http\Controllers\Controller;
use App\Models\Delivery;

class DeliveryController extends Controller
{
    public function index()
    {
        $deliveries = Delivery::with(['project', 'school', 'package'])->get();

        return view('supplier.deliveries.index', compact('deliveries'));
    }

        public function edit($id)
    {
        $delivery = Delivery::with(['project', 'school', 'package'])->findOrFail($id);
        return view('supplier.deliveries.edit', compact('delivery'));
    }

    public function update(Request $request, $id)
    {
        $delivery = Delivery::findOrFail($id);

        $request->validate([
            'status' => 'required|string',
            'delivery_date' => 'nullable|date',
            'arrival_date' => 'nullable|date',
            'remarks' => 'nullable|string',
        ]);

        $delivery->update($request->only([
            'status', 'delivery_date', 'arrival_date', 'remarks'
        ]));

        return redirect()->route('supplier.deliveries.index')->with('success', 'Delivery updated successfully.');
    }
}

