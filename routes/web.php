<?php

use App\Livewire\Dashboard;
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
use App\Livewire\Fueling\Index as FuelingIndex;
use App\Livewire\Fueling\Create as FuelingCreate;
use App\Livewire\Fueling\Edit as FuelingEdit;
use App\Livewire\Settings\FuelStation\Index as FuelStationIndex;
use App\Livewire\Settings\FuelStation\Create as FuelStationCreate;
use App\Livewire\Settings\FuelStation\Edit as FuelStationEdit;
use App\Livewire\Maintenance\Index as MaintenanceIndex;
use App\Livewire\Maintenance\Create as MaintenanceCreate;
use App\Livewire\Maintenance\Edit as MaintenanceEdit;
use App\Livewire\Settings\RepairShop\Index as RepairShopIndex;
use App\Livewire\Settings\RepairShop\Create as RepairShopCreate;
use App\Livewire\Settings\RepairShop\Edit as RepairShopEdit;
use App\Livewire\Settings\Users\Index as UserIndex;
use App\Livewire\Settings\Users\Create as UserCreate;
use App\Livewire\VehicleUsage\AuthorizeTable;
use App\Livewire\VehicleUsage\Dispatch;
use App\Livewire\VehicleUsage\RequestForm;
use App\Livewire\VehicleUsage\ReturnForm;
use App\Livewire\VehicleUsage\Index as VehicleUsageIndex;
use App\Livewire\Reports\Index as ReportsIndex;
use App\Livewire\Reports\FuelReport;
use App\Livewire\Reports\MaintenanceReport;
use App\Livewire\Reports\VehiclesReport;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/termos-de-servico', function () {
    return view('terms-of-service');
})->name('terms');

Route::get('/politica-de-privacidade', function () {
    return view('privacy-policy');
})->name('privacy');

Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/inicio', Dashboard::class)->name('dashboard');

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
        Route::get('/create/{user?}', Create::class)->name('create');
        Route::get('/{driver}/edit', Edit::class)->name('edit');
    });

    // FUELING
    Route::prefix('fuelings')->name('fueling.')->group(function () {
        Route::get('/', FuelingIndex::class)->name('index');
        Route::get('/create', FuelingCreate::class)->name('create');
        Route::get('/{fueling}/edit', FuelingEdit::class)->name('edit');
    });

    // MAINTENANCE
    Route::prefix('maintenances')->name('maintenance.')->group(function () {
        Route::get('/', MaintenanceIndex::class)->name('index');
        Route::get('/create', MaintenanceCreate::class)->name('create');
        Route::get('/{maintenance}/edit', MaintenanceEdit::class)->name('edit');
    });

    // VEHICLES USAGE
    Route::prefix('vehicle-usage')->name('vehicle-usage.')->group(function () {
        Route::get('/request', RequestForm::class)->name('request');
        Route::get('/authorize', AuthorizeTable::class)->name('authorize');
        Route::get('/dispatch', Dispatch::class)->name('dispatch');
        Route::get('/return', ReturnForm::class)->name('return');
        Route::get('/', VehicleUsageIndex::class)->name('index');
    });

    // REPORTS
    Route::prefix('reports')->name('reports.')->middleware('can:viewReports')->group(function () {
        Route::get('/', ReportsIndex::class)->name('index');
        Route::get('/fuel', FuelReport::class)->name('fuel');
        Route::get('/vehicles', VehiclesReport::class)->name('vehicles');
        Route::get('/maintenance', MaintenanceReport::class)->name('maintenance');
    });
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::prefix('settings')->group(function () {
        Route::get('/users', UserIndex::class)->name('user.index');
        Route::get('/users/create', UserCreate::class)->name('user.create');
        Route::get('/users/{user}/edit', UserIndex::class)->name('user.edit');

        Route::get('/fuelstations', FuelStationIndex::class)->name('fuelstation.index');
        Route::get('/fuelstations/create', FuelStationCreate::class)
            ->name('fuelstation.create');
        Route::get('/fuelstations/{fuelstation}/edit', FuelStationEdit::class)
            ->name('fuelstation.edit');

        Route::get('/repairshops', RepairShopIndex::class)->name('repairshop.index');
        Route::get('/repairshops/create', RepairShopCreate::class)->name('repairshop.create');
        Route::get('/repairshops/{repairshop}/edit', RepairShopEdit::class)->name('repairshop.edit');
    });
});

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

require __DIR__ . '/auth.php';
