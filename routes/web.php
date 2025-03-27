<?php

use App\Livewire\Drivers\Create;
use App\Livewire\Drivers\Edit;
use App\Livewire\Drivers\Index;
use App\Livewire\Users\UsersListing;
use App\Livewire\Vehicles\VehicleListing;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {
    // VEHICLES
    Route::get('vehicle', VehicleListing::class)->name('vehicle');

    // DRIVERS
    Route::prefix('drivers')->name('driver.')->group(function () {
        Route::get('/', Index::class)->name('index');
        Route::get('/create', Create::class)->name('create');
        Route::get('/{driver}/edit', Edit::class)->name('edit');
        // Route::get('/{driver}', Show::class)->name('show');
        // Route::put('/{driver}', Edit::class)->name('update');
        // Route::delete('/{driver}', Edit::class)->name('destroy');
    });

    // USERS
    Route::get('users', UsersListing::class)->name('user');
});

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

require __DIR__ . '/auth.php';
