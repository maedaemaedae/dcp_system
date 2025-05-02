<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AdminController extends Controller
{
    public function manageUsers(Request $request)
    {
        $query = User::with('role');

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        $users = $query->get();

        return view('admin.users.index', compact('users'));
    }

    public function editUser(Request $request, $id)
    {
        $user = User::with('role')->findOrFail($id);
    
        if (in_array($user->role->role_name ?? '', ['super_admin', 'admin'])) {
            return redirect()->route('admin.users')->with('error', 'You are not allowed to edit this user.');
        }
    
        return view('admin.users.edit', compact('user'));
    }
    

    public function updateUser(Request $request, $id)
    {
        $user = User::with('role')->findOrFail($id);
    
        if (in_array($user->role->role_name ?? '', ['super_admin', 'admin'])) {
            return redirect()->route('admin.users')->with('error', 'You are not allowed to update this user.');
        }
    
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
        ]);
    
        $user->update($request->only(['name', 'email']));
    
        return redirect()->route('admin.users')->with('success', 'User updated.');
    }
    
}
