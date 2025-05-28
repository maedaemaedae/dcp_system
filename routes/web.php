<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\RecipientController;
use App\Http\Controllers\RegionalOfficeController;
use App\Http\Controllers\DivisionOfficeController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\PackageTypeController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\Auth\OtpVerificationController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\DeliveryController;
use App\Http\Controllers\Supplier\DeliveryController as SupplierDeliveryController;
use App\Models\Delivery;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| These routes are loaded by the RouteServiceProvider and all of them
| will be assigned to the "web" middleware group.
|--------------------------------------------------------------------------
*/

use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'index'])->name('home');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// ✅ Move OTP routes OUTSIDE auth middleware (must be public)
Route::get('/verify-otp', [OtpVerificationController::class, 'showOtpForm'])->name('otp.verify.page');
Route::post('/verify-otp', [OtpVerificationController::class, 'verifyOtp'])->name('otp.verify');
Route::get('/resend-otp', [OtpVerificationController::class, 'resendOtp'])->name('resend.otp');


// ✅ Profile routes for all authenticated users
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ✅ Super Admin routes
Route::middleware(['auth', 'superadmin'])->group(function () {

    // Dashboard and user management
    Route::get('/superadmin/dashboard', [SuperAdminController::class, 'dashboard'])->name('superadmin.dashboard');
    Route::get('/superadmin/users', [SuperAdminController::class, 'manageUsers'])->name('superadmin.users');
    Route::post('/superadmin/users/{user}/role', [SuperAdminController::class, 'updateUserRole'])->name('superadmin.users.updateRole');

    // ✅ Resource routes
    Route::resource('regional-offices', RegionalOfficeController::class);
    Route::resource('division-offices', DivisionOfficeController::class);
    Route::resource('inventory', InventoryController::class);
    Route::resource('package-types', PackageTypeController::class);
    Route::resource('projects', ProjectController::class);

    // ✅ Package creation (used by package modal)
    Route::post('/packages', [PackageController::class, 'store'])->name('packages.store');

    // ✅ Deliveries (limited to index/edit/update)
    Route::resource('deliveries', DeliveryController::class)->only(['index', 'edit', 'update']);

    // ✅ Recipients
    Route::get('/recipients', [RecipientController::class, 'index'])->name('recipients.index');
    Route::post('/recipients', [RecipientController::class, 'store'])->name('recipients.store');
    Route::put('/recipients/{id}', [RecipientController::class, 'update'])->name('recipients.update');
    Route::delete('/recipients/{id}', [RecipientController::class, 'destroy'])->name('recipients.destroy');

    // ✅ Custom School/Division CRUD
    Route::post('/recipients/school', [RecipientController::class, 'storeSchool'])->name('recipients.school.store');
    Route::put('/recipients/school/{id}', [RecipientController::class, 'updateSchool'])->name('recipients.school.update');
    Route::delete('/recipients/school/{id}', [RecipientController::class, 'destroySchool'])->name('recipients.school.destroy');

    Route::post('/recipients/division', [RecipientController::class, 'storeDivision'])->name('recipients.division.store');
    Route::put('/recipients/division/{id}', [RecipientController::class, 'updateDivision'])->name('recipients.division.update');
    Route::delete('/recipients/division/{id}', [RecipientController::class, 'destroyDivision'])->name('recipients.division.destroy');

    // ✅ CSV Upload
    Route::post('/recipients/upload-csv', [RecipientController::class, 'uploadCsv'])->name('recipients.uploadCsv');
});


Route::middleware(['auth', 'role:supplier'])
    ->prefix('supplier')
    ->name('supplier.')
    ->group(function () {
        Route::get('/deliveries', [SupplierDeliveryController::class, 'index'])->name('deliveries.index');
        Route::get('/deliveries/{delivery}/edit', [SupplierDeliveryController::class, 'edit'])->name('deliveries.edit');
        Route::put('/deliveries/{delivery}', [SupplierDeliveryController::class, 'update'])->name('deliveries.update');
    });

// ✅ Include Laravel Breeze / Fortify / Auth routes
require __DIR__.'/auth.php';
