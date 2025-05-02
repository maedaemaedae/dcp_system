<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;

class SuperAdminController extends Controller
{
    public function dashboard()
    {
        return view('superadmin.dashboard', [
            'user' => Auth::user()
        ]);
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
}
