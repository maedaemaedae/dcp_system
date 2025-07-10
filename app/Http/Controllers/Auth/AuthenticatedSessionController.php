<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
        if (!auth()->user()->is_activated) {
            auth()->logout();
            return redirect()->route('otp.verify.page')->with('error', 'Please verify your account first.');
        }
    }
    

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();
    
        $request->session()->regenerate();
    
        $user = $request->user();
    
        if ($user->role && $user->role->role_name === 'super_admin') {
            return redirect()->route('superadmin.dashboard');
        }
    
        $user = $request->user();

        if ($user->role && $user->role->role_name === 'super_admin') {
            return redirect()->route('superadmin.dashboard');
        }

        return redirect()->intended(RouteServiceProvider::HOME);

    }
    
    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

     //For Role Based Login
    protected function authenticated(Request $request, $user)
{
    if ($user->role === 'supplier') {
        return redirect()->route('supplier.deliveries.index');
    }

    if ($user->role === 'superadmin') {
        return redirect()->route('dashboard');
    }

    return redirect('/'); // fallback
}
}
