<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\OtpMail;



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
        $user->is_activated = 1; // ← you should also mark as activated if your project requires
        $user->save();

        Auth::login($user);

        return redirect()->route('dashboard')->with('success', 'Your account has been activated!');
    }



public function resendOtp(Request $request)
{
    $email = session('otp_email');

    if (!$email) {
        return redirect()->route('login')->with('error', 'Session expired. Please login again.');
    }

    $user = User::where('email', $email)->first();

    if (!$user) {
        return redirect()->route('login')->with('error', 'User not found.');
    }

    if ($user->is_activated) {
        return redirect()->route('dashboard')->with('success', 'Your account is already activated.');
    }

    // Generate new OTP
    $otp = rand(100000, 999999);
    $user->otp = $otp;
    $user->save();

    // ✅ Send using your custom Mailable
    Mail::to($user->email)->send(new OtpMail($otp));

    return back()->with('success', 'A new OTP has been sent to your email.');
}
}