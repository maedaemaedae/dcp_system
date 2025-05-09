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