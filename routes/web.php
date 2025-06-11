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

//Under Experimentation pa*
// Pagination
//Route::get('/recipients/paginate', [RecipientController::class, 'paginateRecipients'])->name('recipients.paginate');
//Route::get('/schools/paginate', [RecipientController::class, 'paginateSchools'])->name('schools.paginate');
//Route::get('/divisions/paginate', [RecipientController::class, 'paginateDivisions'])->name('divisions.paginate');


// For Pagination
Route::get('/recipients/paginate/regional-offices', [RecipientController::class, 'paginateRegionalOffices'])->name('recipients.paginate.regional-offices');
Route::get('/recipients/paginate/divisions', [RecipientController::class, 'paginateDivisions'])->name('recipients.paginate.divisions');
Route::get('/recipients/paginate/schools', [RecipientController::class, 'paginateSchools'])->name('recipients.paginate.schools');
Route::get('/recipients/paginate/recipients', [RecipientController::class, 'paginateRecipients'])->name('recipients.paginate.recipients');



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
    Route::resource('division-offices', DivisionOfficeController::class);
    Route::resource('inventory', InventoryController::class);
    Route::resource('package-types', PackageTypeController::class);
    Route::resource('projects', ProjectController::class);

    // ✅ Package creation (used by package modal)
    Route::post('/packages', [PackageController::class, 'store'])->name('packages.store');
    Route::put('/packages/{id}', [PackageController::class, 'update'])->name('packages.update');
    Route::delete('/packages/{id}', [PackageController::class, 'destroy'])->name('packages.destroy');

    // ✅ Deliveries (limited to index/edit/update)
    Route::get('/superadmin/deliveries', [DeliveryController::class, 'index'])->name('superadmin.deliveries.index');
    Route::post('/superadmin/deliveries/assign', [DeliveryController::class, 'assign'])->name('superadmin.deliveries.assign');
    Route::get('/superadmin/deliveries/list', [DeliveryController::class, 'list'])->name('superadmin.deliveries.list');
    Route::put('/superadmin/deliveries/{id}/status', [DeliveryController::class, 'updateStatus'])->name('superadmin.deliveries.updateStatus');

    //Regional Office
    Route::post('/regional-offices/import-csv', [RegionalOfficeController::class, 'importRegionalOffices'])
    ->name('regional-offices.import.csv');
    
    // ✅ Recipients
    Route::get('/recipients', [RecipientController::class, 'index'])->name('recipients.index');
    Route::post('/recipients', [RecipientController::class, 'store'])->name('recipients.store');
    Route::put('/recipients/{id}', [RecipientController::class, 'update'])->name('recipients.update');
    Route::post('/recipients/import-csv', [RecipientController::class, 'importRecipients'])->name('recipients.import.csv');
    Route::delete('/recipients/recipient/{id}', [RecipientController::class, 'destroy'])->name('recipients.destroy');
    

    // ✅ Custom Regional/Division/School CRUD
    Route::post('/recipients/school', [RecipientController::class, 'storeSchool'])->name('recipients.school.store');
    Route::put('/recipients/school/{id}', [RecipientController::class, 'updateSchool'])->name('recipients.school.update');
    Route::delete('/recipients/school/{id}', [RecipientController::class, 'destroySchool'])->name('recipients.school.destroy');
    Route::post('/schools/import', [RecipientController::class, 'importSchools'])->name('schools.import');
    
    Route::post('/recipients/division', [RecipientController::class, 'storeDivision'])->name('recipients.division.store');
    Route::put('/recipients/division/{id}', [RecipientController::class, 'updateDivision'])->name('recipients.division.update');
    Route::delete('/recipients/division/{id}', [RecipientController::class, 'destroyDivision'])->name('division.destroy');
    Route::post('/divisions/import', [RecipientController::class, 'importDivisions'])->name('divisions.import');
    
    Route::post('/regional-offices', [RegionalOfficeController::class, 'store'])->name('regional-offices.store');
    Route::put('/regional-offices/{id}', [RegionalOfficeController::class, 'update'])->name('regional-offices.update');
    Route::delete('/regional-offices/{id}', [RegionalOfficeController::class, 'destroy'])->name('regional-offices.destroy');

});

Route::middleware(['auth', 'supplier'])->group(function () {
    Route::get('/supplier/deliveries', [DeliveryController::class, 'supplierView'])->name('supplier.deliveries');
    Route::put('/supplier/deliveries/{id}/confirm', [DeliveryController::class, 'confirmDelivery'])->name('supplier.deliveries.confirm');
});

// For Email Validation
Route::post('/check-email-register', function (Illuminate\Http\Request $request) {
    $exists = \App\Models\User::where('email', $request->email)->exists();
    return response()->json(['exists' => $exists]);
})->name('check.email-register');

Route::post('/login', [AuthenticatedSessionController::class, 'store'])->name('login');

require __DIR__.'/auth.php';
