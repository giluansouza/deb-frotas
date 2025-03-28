<?php

use App\Livewire\Drivers\Create;
use App\Livewire\Drivers\Edit;
use App\Livewire\Drivers\Index;
use App\Livewire\Users\UsersListing;
use App\Livewire\Vehicles\Index as VehiclesIndex;
use App\Livewire\Vehicles\Create as VehiclesCreate;
use App\Livewire\Vehicles\Edit as VehiclesEdit;
use App\Livewire\VehicleKilometers\Index as VkmIndex;
use App\Livewire\VehicleKilometers\Create as VkmCreate;
use App\Livewire\VehicleKilometers\Edit as VkmEdit;
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
    Route::prefix('vehicles')->name('vehicle.')->group(function () {
        Route::get('/', VehiclesIndex::class)->name('index');
        Route::get('/create', VehiclesCreate::class)->name('create');
        Route::get('/{vehicle}/edit', VehiclesEdit::class)->name('edit');
    });

    Route::prefix('vehicles-km')->name('vkm.')->group(function () {
        Route::get('/', VkmIndex::class)->name('index');
        Route::get('/create', VkmCreate::class)->name('create');
        Route::get('/{vehicle}/edit', VkmEdit::class)->name('edit');
    });

    // DRIVERS
    Route::prefix('drivers')->name('driver.')->group(function () {
        Route::get('/', Index::class)->name('index');
        Route::get('/create', Create::class)->name('create');
        Route::get('/{driver}/edit', Edit::class)->name('edit');
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
