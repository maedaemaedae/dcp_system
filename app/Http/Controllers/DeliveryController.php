<?php

namespace App\Http\Controllers;

use App\Models\Recipient;
use App\Models\User;
use App\Models\Delivery;
use App\Models\PackageContent;
use App\Models\Inventory;
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
            'supplier_id'  => 'required|exists:users,id',
            'target_delivery' => 'nullable|date',
        ]);

        $recipient = Recipient::findOrFail($request->recipient_id); // ✅ define it here

        Delivery::create([
            'recipient_id'    => $request->recipient_id,
            'supplier_id'     => $request->supplier_id,
            'quantity'        => $recipient->quantity, // ✅ now safe to use
            'status'          => 'pending',
            'target_delivery' => $request->target_delivery,
            'created_by'      => auth()->id(),
        ]);

        return back()->with('success', 'Delivery assignment recorded.');
    }


    public function list()
    {
        $deliveries = Delivery::with(['recipient.school', 'recipient.division', 'recipient.package.packageType', 'supplier', 'creator'])
            ->latest()
            ->get();

        return view('superadmin.deliveries.list', compact('deliveries'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,delivered,cancelled',
        ]);

        $delivery = Delivery::findOrFail($id);
        $delivery->status = $request->status;
        $delivery->save();

        return redirect()->route('superadmin.deliveries.list')->with('success', 'Delivery status updated.');
    }

    public function supplierView()
    {
        $deliveries = Delivery::with(['recipient.school', 'recipient.division', 'recipient.package.packageType'])
            ->where('supplier_id', auth()->id())
            ->latest()
            ->get();

        return view('supplier.deliveries.index', compact('deliveries'));
    }

    public function confirmDelivery(Request $request, $id)
    {
        $request->validate([
            'proof_file' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $delivery = Delivery::with('recipient.package.packageType', 'recipient.school', 'recipient.division')
            ->where('id', $id)
            ->where('supplier_id', auth()->id())
            ->where('status', 'pending')
            ->firstOrFail();

        // Store proof file
        $path = $request->file('proof_file')->store('proofs', 'public');

        // Determine recipient location
        $recipient = $delivery->recipient;
        $schoolId = $recipient->recipient_type === 'school' ? optional($recipient->school)->school_id : null;
        $divisionId = $recipient->recipient_type === 'division' ? optional($recipient->division)->division_id : null;

        // Fetch contents of the package
        $packageTypeId = $recipient->package->package_type_id;
        $contents = PackageContent::where('package_type_id', $packageTypeId)->get();

        // Create inventory records based on package contents
        foreach ($contents as $content) {
            Inventory::create([
                'school_id'    => $schoolId,
                'division_id'  => $divisionId,
                'item_name'    => $content->item_name,
                'quantity'     => $content->quantity * $delivery->quantity,
                'status'       => 'in use',
                'remarks'      => $content->description,
            ]);
        }

        // Finalize the delivery
        $delivery->proof_file = $path;
        $delivery->status = 'delivered';
        $delivery->save();

        return redirect()->route('supplier.deliveries')->with('success', 'Delivery confirmed and inventory recorded.');
    }

}
