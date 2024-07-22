<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\StateController;
use App\Http\Controllers\DistrictController;
use App\Http\Controllers\SubDistrictController;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Users Management
Route::middleware('auth')->group(function () {
    //Route::resource('users', UserController::class);
    Route::resource('users', UserController::class)->except(['show']);
    Route::get('users/export', [UserController::class, 'export'])->name('users.export');

    // Roles Management
    Route::resource('roles', RoleController::class)->except(['show']);

    // Regions Management
    Route::resource('states', StateController::class)->except(['show']);
    Route::resource('districts', DistrictController::class)->except(['show']);
    Route::resource('subdistricts', SubDistrictController::class)->except(['show']);
});

require __DIR__.'/auth.php';
