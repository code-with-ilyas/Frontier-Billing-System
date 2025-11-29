<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\HeadController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\VehicleController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', function () {
    return view('home');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('customers', CustomerController::class);
Route::resource('products', ProductController::class);
Route::resource('sales', SaleController::class)->except(['show']);

// Sales routes
Route::get('/sales/report', [SaleController::class, 'report'])->name('sales.report');
Route::get('/head-products/{headId}', [SaleController::class, 'headProducts']);
Route::get('/sales/form', [SaleController::class, 'form'])->name('sales.form');
Route::get('/sales/view', [SaleController::class, 'view'])->name('sales.view');
Route::get('/saved-bills', [SaleController::class, 'savedBills'])->name('saved.bills');
Route::get('/vehicle-bills', [SaleController::class, 'vehicleBills'])->name('vehicle.bills');

// Vehicle routes - FIXED: Only one route
Route::get('/get-vehicles/{customer_name}', [VehicleController::class, 'getVehiclesByCustomer']);

// Head routes
Route::get('heads/report', [HeadController::class, 'report'])->name('heads.report');
Route::get('heads/create', [HeadController::class, 'create'])->name('heads.create');
Route::post('heads/store', [HeadController::class, 'store'])->name('heads.store');
Route::get('heads/{customerName}/edit', [HeadController::class, 'edit'])->name('heads.edit');
Route::put('heads/{customerName}/update', [HeadController::class, 'updateByCustomer'])->name('heads.updateByCustomer');
Route::put('heads/{head}', [HeadController::class, 'update'])->name('heads.update');
Route::delete('heads/{head}', [HeadController::class, 'destroy'])->name('heads.destroy');

Route::resource('vehicles', VehicleController::class);

require __DIR__ . '/auth.php';