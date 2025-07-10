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
use App\Models\School;
use App\Models\Recipient;
use App\Models\Delivery;
use App\Models\DeliveredItem;
use Illuminate\Support\Facades\DB;

class SuperAdminController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();

        $schoolCount = DB::table('schools')->count();
        $recipientCount = DB::table('recipients')->count();
        $deliveredItemCount = DB::table('delivered_items')->sum('quantity_delivered');
        $pendingDeliveries = DB::table('deliveries')->where('status', '!=', 'delivered')->count();
        $deliveredPackages = DB::table('deliveries')->where('status', 'delivered')->count();

        // Package Type Distribution
        $packageTypeData = DB::table('package_types')
            ->leftJoin('packages', 'package_types.id', '=', 'packages.package_type_id')
            ->select('package_types.package_code', DB::raw('COUNT(packages.id) as packages_count'))
            ->groupBy('package_types.package_code')
            ->get();

        // Schools per Division
        $divisionSchoolCounts = DB::table('division_offices as d')
            ->join('schools as s', 's.division_id', '=', 'd.division_id')
            ->select('d.division_name as division', DB::raw('COUNT(s.school_id) as total'))
            ->groupBy('d.division_name')
            ->get();

        $pending = DB::table('deliveries')->where('status', 'pending')->count();
        $partial = DB::table('deliveries')->where('status', 'partial')->count(); // if you plan to add later
        $delivered = DB::table('deliveries')->where('status', 'delivered')->count();
        $cancelled = DB::table('deliveries')->where('status', 'cancelled')->count(); // optional


        return view('superadmin.dashboard', compact(
            'user',
            'schoolCount',
            'recipientCount',
            'deliveredItemCount',
            'pendingDeliveries',
            'deliveredPackages',
            'packageTypeData',
            'divisionSchoolCounts',
            'pending', 'partial', 'delivered', 'cancelled'
        ));
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
        $roles = Role::all();

        return view('superadmin.users.index', compact('users', 'roles'));
    }

    public function updateUserRole(Request $request, $userId)
    {
        if (auth()->id() == $userId) {
            return redirect()->back()->with('error', 'You cannot change your own role.');
        }

        $request->validate([
            'role_id' => 'required|exists:roles,role_id',
        ]);

        $user = User::findOrFail($userId);
        $user->role_id = $request->role_id;
        $user->save();

        return redirect()->back()->with('success', 'Role updated successfully!');
    }

    public function indexProjects()
    {
        $projects = Project::with('packages')->orderByDesc('id')->get();
        $packageTypes = PackageType::all();
        $divisions = DivisionOffice::all();
        $packages = Package::whereNull('project_id')->get();

        return view('projects.index', compact('projects', 'packages', 'packageTypes', 'divisions'));
    }
}
