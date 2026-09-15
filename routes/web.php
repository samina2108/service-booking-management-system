<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ActivityLogController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});


// Dashboard - Admin + Normal User
Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

        // Services
    Route::resource('services', ServiceController::class);

    // Customers
    Route::resource('customers', CustomerController::class);

    // Bookings
    Route::resource('bookings', BookingController::class);

});


// Admin Only Routes
Route::middleware(['auth', 'admin'])->group(function () {

    // // Services
    // Route::resource('services', ServiceController::class);

    // // Customers
    // Route::resource('customers', CustomerController::class);

    // // Bookings
    // Route::resource('bookings', BookingController::class);

    // Booking Status
    Route::patch(
        '/bookings/{booking}/status',
        [BookingController::class, 'updateStatus']
    )->name('bookings.updateStatus');

    // Booking Invoice
    Route::get(
        '/bookings/{booking}/invoice',
        [BookingController::class, 'invoice']
    )->name('bookings.invoice');

    // User Management
    Route::get('/users', [UserController::class, 'index'])
        ->name('users.index');

    Route::patch('/users/{user}/role', [UserController::class, 'updateRole'])
        ->name('users.updateRole');

    Route::delete('/users/{user}', [UserController::class, 'destroy'])
        ->name('users.destroy');

    Route::get('/activity-logs', [ActivityLogController::class, 'index'])
    ->name('activity_logs.index');

    Route::get('/activity-logs/export', [ActivityLogController::class, 'export'])
    ->name('activity_logs.export');

    Route::get('/activity-logs/{activityLog}', [ActivityLogController::class, 'show'])
    ->name('activity_logs.show');

    Route::delete('/activity-logs/{activityLog}', [ActivityLogController::class, 'destroy'])
    ->name('activity_logs.destroy');

    Route::get('/profile', [ProfileController::class, 'edit'])
    ->name('profile.edit');

Route::patch('/profile', [ProfileController::class, 'update'])
    ->name('profile.update');

Route::delete('/profile', [ProfileController::class, 'destroy'])
    ->name('profile.destroy');
    
});


require __DIR__.'/auth.php';