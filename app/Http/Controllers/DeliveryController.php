<?php

namespace App\Http\Controllers;

use App\Models\Recipient;
use App\Models\User;
use App\Models\Delivery;
use Illuminate\Http\Request;

class DeliveryController extends Controller
{
    public function index()
    {
        $recipients = Recipient::with(['package.packageType', 'school', 'division'])
            ->doesntHave('deliveries') // ✅ uses hasMany relationship
            ->get();

        $suppliers = User::whereHas('role', fn($q) => $q->where('role_name', 'supplier'))->get();

        return view('superadmin.deliveries.index', compact('recipients', 'suppliers'));
    }

    public function assign(Request $request)
    {
        $request->validate([
            'recipient_id' => 'required|exists:recipients,id',
            'supplier_id' => 'required|exists:users,id',
            'target_delivery' => 'nullable|date',
        ]);

        Delivery::create([
            'recipient_id' => $request->recipient_id,
            'supplier_id' => $request->supplier_id,
            'status' => 'pending',
            'target_delivery' => $request->target_delivery,
            'created_by' => auth()->id(),
        ]);

        return back()->with('success', 'Delivery assignment recorded.');
    }
}
