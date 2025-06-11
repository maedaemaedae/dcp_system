<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Municipality;
use App\Models\School;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/municipalities/{divisionId}', function ($divisionId) {
    return Municipality::where('division_id', $divisionId)->get();
});

Route::get('/schools/{municipalityId}', function ($municipalityId) {
    return School::where('municipality_id', $municipalityId)->get();
});

Route::post('/custom-login', function (Request $request) {
    $request->validate([
        'email' => 'required|email',
        'password' => 'required'
    ]);

    $user = \App\Models\User::where('email', $request->email)->first();

    if (!$user) {
        return response()->json([
            'success' => false,
            'error' => 'email_not_found'
        ], 404);
    }

    if (!Hash::check($request->password, $user->password)) {
        return response()->json([
            'success' => false,
            'error' => 'incorrect_password'
        ], 401);
    }

    Auth::login($user);

    return response()->json([
        'success' => true,
        'redirect' => route('dashboard')
    ]);
});