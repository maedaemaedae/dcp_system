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

    public function manageUsers()
    {
        $users = User::with('role')->get();

        return view('superadmin.users.index', compact('users'));
    }

    public function updateUserRole(Request $request, $userId)
    {
        if (auth()->id() == $userId) {
            return redirect()->back()->with('error', 'You cannot change your own role.');
        }
        
        $request->validate([
            'role_name' => 'required|string',
        ]);

        Role::updateOrCreate(
            ['user_id' => $userId],
            ['role_name' => $request->role_name]
        );

        return redirect()->back()->with('success', 'Role updated successfully!');
    }
}
