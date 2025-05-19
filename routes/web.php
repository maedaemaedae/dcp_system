<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\SchoolController;
use App\Http\Controllers\RegionalOfficeController;
use App\Http\Controllers\DivisionOfficeController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\PackageTypeController;
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

// ✅ Group all Super Admin routes under auth + super_admin
Route::middleware(['auth', 'superadmin'])->group(function () {
    Route::get('/superadmin/dashboard', [SuperAdminController::class, 'dashboard'])->name('superadmin.dashboard');
    Route::get('/superadmin/users', [SuperAdminController::class, 'manageUsers'])->name('superadmin.users');
    Route::post('/superadmin/users/{user}/role', [SuperAdminController::class, 'updateUserRole'])->name('superadmin.users.updateRole');
    Route::resource('schools',SchoolController::class);
    Route::resource('regional-offices', RegionalOfficeController::class);
    Route::resource('division-offices', DivisionOfficeController::class);
    Route::resource('inventory', InventoryController::class);
    Route::resource('package-types', PackageTypeController::class);
    Route::get('/projects/create', [SuperAdminController::class, 'createProjectForm'])->name('superadmin.projects.create');
    Route::post('/projects/store', [SuperAdminController::class, 'storeProject'])->name('superadmin.projects.store');
    Route::get('/superadmin/projects', [SuperAdminController::class, 'indexProjects'])->name('superadmin.projects.index');
    Route::resource('projects', ProjectController::class);
    Route::resource('deliveries', DeliveryController::class)->only(['index', 'edit', 'update']);
});

// ✅ Group all Admin routes under auth + admin
Route::middleware(['auth', 'verified', 'role:admin'])->prefix('admin')->group(function () {
    Route::get('/users', [App\Http\Controllers\AdminController::class, 'manageUsers'])->name('admin.users');
    Route::get('/users/{id}/edit', [App\Http\Controllers\AdminController::class, 'editUser'])->name('admin.users.edit');
    Route::post('/users/{id}', [App\Http\Controllers\AdminController::class, 'updateUser'])->name('admin.users.update');
});



Route::middleware(['auth', 'verified', 'role:admin'])->prefix('admin')->group(function () {
    Route::get('regional-offices', [RegionalOfficeController::class, 'index'])->name('admin.regional-offices.index');
    Route::get('division-offices', [DivisionOfficeController::class, 'index'])->name('admin.division-offices.index');
    Route::get('schools', [SchoolController::class, 'index'])->name('admin.schools.index');
    Route::get('inventory', [InventoryController::class, 'index'])->name('admin.inventory.index');
    Route::get('package-types', [PackageTypeController::class, 'index'])->name('admin.package-types.index');
});

Route::middleware(['auth', 'role:supplier'])->prefix('supplier')->name('supplier.')->group(function () {
    Route::get('/deliveries', [SupplierDeliveryController::class, 'index'])->name('deliveries.index');
    Route::get('/supplier/deliveries/{delivery}/edit', [SupplierDeliveryController::class, 'edit'])->name('supplier.deliveries.edit');
    Route::put('/deliveries/{delivery}', [SupplierDeliveryController::class, 'update'])->name('deliveries.update');
});

// ✅ Include Laravel Breeze / Fortify / Auth routes
require __DIR__.'/auth.php';
