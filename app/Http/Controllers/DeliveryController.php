<?php

namespace App\Http\Controllers;

use App\Models\Recipient;
use App\Models\User;
use App\Models\Delivery;
use App\Models\PackageContent;
use App\Models\Inventory;
use App\Models\DeliveredItem;
use Illuminate\Http\Request;

class DeliveryController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $recipients = Recipient::with(['school', 'division', 'package.packageType'])
            ->whereDoesntHave('deliveries')
            ->when($search, function ($query, $search) {
                $query->whereHas('school', fn($q) =>
                    $q->where('school_name', 'like', "%{$search}%"))
                    ->orWhereHas('division', fn($q) =>
                        $q->where('division_name', 'like', "%{$search}%"));
            })
            ->get();

        $suppliers = User::where('role_id', '6')->get(); // ✅ using users table

        return view('superadmin.deliveries.index', compact('recipients', 'suppliers'));
    }

    public function assign(Request $request)
    {
        $request->validate([
            'recipient_id'     => 'required|exists:recipients,id',
            'supplier_id'      => 'required|exists:users,id',
            'target_delivery'  => 'nullable|date',
        ]);

        $recipient = \App\Models\Recipient::with('package.contents')->findOrFail($request->recipient_id);

        $delivery = Delivery::create([
            'recipient_id'    => $recipient->id,
            'supplier_id'     => $request->supplier_id,
            'quantity'        => $recipient->quantity,
            'status'          => 'pending',
            'target_delivery' => $request->target_delivery,
            'created_by'      => auth()->id(),
        ]);

        // ✅ Create DeliveredItem entries
        foreach ($recipient->package->contents as $content) {
            \App\Models\DeliveredItem::create([
                'delivery_id'         => $delivery->id,
                'package_content_id'  => $content->id,
                'quantity_delivered' => $content->quantity * $recipient->quantity,
            ]);
        }

        return back()->with('success', 'Delivery assignment recorded.');
    }


    public function bulkAssignSupplier(Request $request)
    {
        $request->validate([
            'supplier_id'      => 'required|exists:users,id',
            'recipient_ids'    => 'required|array',
            'recipient_ids.*'  => 'exists:recipients,id',
            'target_delivery'  => 'nullable|date',
        ]);

        foreach ($request->recipient_ids as $recipient_id) {
            $recipient = \App\Models\Recipient::with('package.contents')->findOrFail($recipient_id);

            $delivery = Delivery::create([
                'recipient_id'    => $recipient->id,
                'supplier_id'     => $request->supplier_id,
                'quantity'        => $recipient->quantity,
                'status'          => 'pending',
                'target_delivery' => $request->target_delivery,
                'created_by'      => auth()->id(),
            ]);

            // ✅ Create DeliveredItem entries
            foreach ($recipient->package->contents as $content) {
                \App\Models\DeliveredItem::create([
                    'delivery_id'         => $delivery->id,
                    'package_content_id'  => $content->id,
                    'quantity_delivered' => $content->quantity * $recipient->quantity,
                ]);
            }
        }

        return back()->with('success', 'Deliveries assigned to selected recipients.');
    }



    public function unassign($id)
    {
        $delivery = \App\Models\Delivery::findOrFail($id);
        $delivery->delete(); // ✅ delete the delivery instead of nulling supplier_id

        return back()->with('success', 'Delivery unassigned and returned to unassigned list.');
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

        // Fetch package contents by type
        $packageTypeId = $recipient->package->package_type_id;
        $contents = PackageContent::where('package_type_id', $packageTypeId)->get();

        // Create or update inventory entries
        foreach ($contents as $content) {
            // Create or find the inventory entry for this item + recipient
            $inventory = Inventory::firstOrCreate([
                'item_name'    => $content->item_name,
                'school_id'    => $schoolId,
                'division_id'  => $divisionId,
                'recipient_id' => $delivery->recipient_id,
            ], [
                'status'  => 'in use',
                'remarks' => $content->description,
            ]);

            // Compute total quantity from all DeliveredItems for this recipient + item
            $total = \App\Models\DeliveredItem::whereHas('delivery', function ($q) use ($delivery) {
                $q->where('recipient_id', $delivery->recipient_id);
            })->whereHas('packageContent', function ($q) use ($content) {
                $q->where('item_name', $content->item_name);
            })->sum('quantity_delivered');

            $inventory->update(['quantity' => $total]);

        }

        // Finalize the delivery
        $delivery->proof_file = $path;
        $delivery->status = 'delivered';
        $delivery->save();

        return redirect()->route('supplier.deliveries')->with('success', 'Delivery confirmed and inventory recorded.');
    }


}
