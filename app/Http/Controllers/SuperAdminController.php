<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Models\Project;
use App\Models\Package;
use App\Models\PackageType;
use App\Models\DivisionOffice;
use App\Models\Inventory;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;


class SuperAdminController extends Controller
{
    public function dashboard(Request $request)
  {$chartType = $request->input('chart_type', 'item_type');
    $selectedPackageId = $request->input('package_type_id');
    $selectedProjectId = $request->input('project_id');
    $projectView = $request->input('project_view', 'schools');
    $selectedProjectPackageId = $request->input('project_package_id');

    $packageTypes = \App\Models\PackageType::all();
    $projects = \App\Models\Project::all();

    // Item type distribution
    $nameTotals = \App\Models\Inventory::select('item_name', DB::raw('SUM(quantity) as total_quantity'))
        ->groupBy('item_name')->orderBy('item_name')->get();

    // Individual package donut
    $packageChartData = [];
    if ($chartType === 'package' && $selectedPackageId) {
        $packageChartData = DB::table('package_contents')
            ->join('inventory', 'package_contents.item_id', '=', 'inventory.item_id')
            ->where('package_contents.package_type_id', $selectedPackageId)
            ->select('inventory.item_name', DB::raw('SUM(package_contents.quantity) as total_quantity'))
            ->groupBy('inventory.item_name')
            ->get();
    }

    // Project-wide views
    $schools = [];
    $projectPackages = [];
    $projectChartData = [];

    if ($chartType === 'project' && $selectedProjectId) {
        $schools = DB::table('project_school_assignments')
            ->join('schools', 'project_school_assignments.school_id', '=', 'schools.school_id')
            ->where('project_id', $selectedProjectId)
            ->select('schools.school_id as id', 'schools.school_name')
            ->get();

        $projectPackages = DB::table('packages')
            ->join('package_types', 'packages.package_type_id', '=', 'package_types.id')
            ->where('project_id', $selectedProjectId)
            ->select('packages.id', 'package_types.package_code')
            ->get();

        if ($projectView === 'packages') {
            $projectChartData = DB::table('package_contents')
                ->join('packages', 'packages.package_type_id', '=', 'package_contents.package_type_id')
                ->join('package_types', 'package_types.id', '=', 'packages.package_type_id')
                ->join('inventory', 'package_contents.item_id', '=', 'inventory.item_id')
                ->where('packages.project_id', $selectedProjectId)
                ->select(
                    'package_types.package_code',
                    'inventory.item_name',
                    DB::raw('SUM(package_contents.quantity) as total_quantity')
                )
                ->groupBy('package_types.package_code', 'inventory.item_name')
                ->get();
        }
    }

    // Delivery status donut chart
    $deliveryStatusCounts = DB::table('deliveries')
        ->select('status', DB::raw('COUNT(*) as count'))
        ->groupBy('status')
        ->pluck('count', 'status');

    // Delivery tracking table
    $deliveryData = DB::table('deliveries')
        ->join('schools', 'deliveries.school_id', '=', 'schools.school_id')
        ->join('package_types', 'deliveries.package_id', '=', 'package_types.id')
        ->select(
            'deliveries.id',
            'schools.school_name as school',
            'package_types.package_code as package',
            'deliveries.status',
            'deliveries.delivery_date',
            'deliveries.arrival_date',
            'deliveries.remarks'
        )
        ->orderBy('delivery_date', 'desc')
        ->get();

    return view('superadmin.dashboard', compact(
        'chartType',
        'nameTotals',
        'packageTypes',
        'packageChartData',
        'selectedPackageId',
        'projects',
        'selectedProjectId',
        'schools',
        'projectPackages',
        'projectChartData',
        'projectView',
        'deliveryStatusCounts',
        'deliveryData'
    ));
}
public function downloadChartReport(Request $request)
{
    $chartType = $request->input('chart_type', 'item_type');

    if ($chartType === 'item_type') {
        $nameTotals = Inventory::select('item_name', DB::raw('SUM(quantity) as total_quantity'))
            ->groupBy('item_name')
            ->orderBy('item_name')
            ->get();

        $pdf = Pdf::loadView('pdf.chart-item-type', compact('nameTotals'));
        return $pdf->download('item_type_distribution.pdf');
    }

    // You can extend for 'package' or 'project' types too
}

    public function manageUsers(Request $request)
    {
        $query = User::with('role');
    
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhereHas('role', function ($q2) use ($search) {
                      $q2->where('role_name', 'like', "%{$search}%");
                  });
            });
        }

        $users = $query->get();
        $roles = Role::all(); // ✅ This is what your view needs

        return view('superadmin.users.index', compact('users', 'roles'));
    }

    public function updateUserRole(Request $request, $userId)
    {
        if (auth()->id() == $userId) {
            return redirect()->back()->with('error', 'You cannot change your own role.');
        }

        $request->validate([
            'role_id' => 'required|exists:roles,role_id', // ✅ Validate the new role_id
        ]);

        $user = User::findOrFail($userId);
        $user->role_id = $request->role_id; // ✅ Directly assign role_id
        $user->save();

        return redirect()->back()->with('success', 'Role updated successfully!');
    }


    public function indexProjects()
    {
        $projects = Project::with('packages')->orderByDesc('id')->get();
        $packageTypes = PackageType::all(); // ✅ Add this
        $divisions = DivisionOffice::all(); // ✅ Needed for dropdown
        $packages = Package::whereNull('project_id')->get();
    
        return view('projects.index', compact('projects', 'packages', 'packageTypes', 'divisions'));
    }
}
