<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class OtpVerificationController extends Controller
{
    public function showOtpForm()
    {
        return view('auth.verify-otp');
    }

    public function verifyOtp(Request $request)
    {
        $request->validate([
            'otp' => 'required|numeric',
        ]);

        $user = User::where('otp', $request->otp)->first();

        if (!$user) {
            return back()->with('error', 'Invalid OTP. Please try again.');
        }

        $user->otp = null;
        $user->email_verified_at = now();
        $user->save();

        Auth::login($user);

        return redirect()->route('dashboard')->with('success', 'Your account has been activated!');
    }
}
