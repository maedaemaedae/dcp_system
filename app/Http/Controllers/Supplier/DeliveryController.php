<?php

namespace App\Http\Controllers\Supplier;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Delivery;

class DeliveryController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $deliveries = Delivery::with(['project', 'school', 'package.packageType'])
            ->get()
            ->filter(function ($delivery) use ($search) {
                if (!$search) return true;

                $search = strtolower($search);

                return str_contains(strtolower($delivery->school->school_name ?? ''), $search)
                    || str_contains(strtolower($delivery->package->packageType->name ?? ''), $search)
                    || str_contains(strtolower($delivery->status ?? ''), $search)
                    || str_contains(strtolower($delivery->project->name ?? ''), $search);
            });

        $deliveries = $deliveries->sortBy(function ($delivery) {
            return $delivery->project->name ?? '';
        });

        return view('supplier.deliveries.index', compact('deliveries', 'search'));
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
