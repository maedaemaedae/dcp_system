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
}

