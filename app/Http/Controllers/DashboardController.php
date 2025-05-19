<?php

namespace App\Http\Controllers;
use App\Models\Inventory;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
{
     $nameTotals = Inventory::select('item_name', DB::raw('SUM(quantity) as total_quantity'))
        ->groupBy('item_name')
        ->orderBy('item_name')
        ->get();

    return view('superadmin.dashboard', [
        'user' => Auth::user(),
        'nameTotals' => $nameTotals
    ]);
}
}
