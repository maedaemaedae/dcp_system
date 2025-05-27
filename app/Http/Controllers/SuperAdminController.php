
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

        $users = $query->paginate(10);

        return view('superadmin.users', compact('users'));
    }

    public function updateUserRole(Request $request, User $user)
    {
        $validated = $request->validate([
            'role_id' => 'required|exists:roles,id',
        ]);

        $user->update([
            'role_id' => $validated['role_id']
        ]);

        return back()->with('success', 'User role updated successfully.');
    }
}
