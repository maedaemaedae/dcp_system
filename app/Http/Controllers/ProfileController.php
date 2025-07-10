<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current-password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    /**
     * Upload and update the user's profile photo.
     */
    public function uploadPhoto(Request $request)
    {
        $request->validate([
            'profile_photo' => 'required|image|mimes:jpg,jpeg,png|max:10000',
        ]);

        $user = auth()->user();

        // Delete old photo if it exists
        if ($user->profile_photo_path && Storage::disk('public')->exists($user->profile_photo_path)) {
            Storage::disk('public')->delete($user->profile_photo_path);
        }

        // Save new photo with user ID in filename
        $extension = $request->file('profile_photo')->getClientOriginalExtension();
        $filename = 'user_' . $user->id . '.' . $extension;
        $path = $request->file('profile_photo')->storeAs('profile-photos', $filename, 'public');

        // Update user record
        $user->profile_photo_path = $path;
        $user->save();

        // Refresh session data
        auth()->setUser($user->fresh());

        // Return JSON if requested via AJAX
        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'photo_url' => asset('storage/' . $path),
                'message' => 'Profile photo updated successfully!',
            ]);
        }

        // Fallback for regular form submission
        return redirect()
            ->route('profile.edit', ['#profile-photo'])
            ->with('success', 'Profile photo updated successfully!');
    }
}
