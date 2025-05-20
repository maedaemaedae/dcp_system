<?php

namespace App\Http\Controllers;

use App\Models\Delivery;
use Illuminate\Http\Request;

class DeliveryController extends Controller
{

    public function index(Request $request)
    {
        $search = $request->input('search');

        $deliveries = \App\Models\Delivery::with(['project', 'school', 'package.packageType'])
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

        return view('deliveries.index', compact('deliveries', 'search'));
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
