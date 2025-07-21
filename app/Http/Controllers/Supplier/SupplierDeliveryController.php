<?php

namespace App\Http\Controllers\Supplier;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Delivery;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;

class SupplierDeliveryController extends Controller
{
    public function index()
    {
        $deliveries = Delivery::where('supplier_id', Auth::id())->with(['recipient.school', 'recipient.division', 'recipient.package.packageType'])->get();


        $deliveries = Delivery::with([
            'recipient.school',
            'recipient.division',
            'recipient.package.packageType'
        ])->orderBy('created_at', 'desc')->get();

        return view('supplier.deliveries.index', compact('deliveries'));
    }

    public function confirm(Request $request, $id)
    {
        $request->validate([
            'proof_file' => 'required|mimes:pdf|max:2048',
        ]);

        $delivery = Delivery::findOrFail($id);

        // Upload the file
        $path = $request->file('proof_file')->store('delivery-proofs', 'public');

        // Update delivery record
        $delivery->proof_file = $path;
        $delivery->status = 'delivered';
        $delivery->save();

        return redirect()->route('supplier.deliveries.index')->with('success', 'Delivery confirmed and inventory recorded.');
    }
}
