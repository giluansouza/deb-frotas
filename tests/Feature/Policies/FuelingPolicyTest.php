<?php

use App\Models\Fueling;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

use function Pest\Laravel\actingAs;

uses(RefreshDatabase::class);

beforeEach(function () {
    // Criação de usuários com papéis
    $this->admin = User::factory()->create()->assignRole('admin');
    $this->fleetManager = User::factory()->create()->assignRole('fleet_manager');
    $this->unitManager = User::factory()->create()->assignRole('unit_manager');
    $this->driver = User::factory()->create()->assignRole('driver');
    $this->garage = User::factory()->create()->assignRole('garage_manager');

    // Simula um abastecimento feito pelo motorista
    $this->fueling = Fueling::factory()->create([
        'driver_id' => $this->driver->id,
    ]);
});

test('admins and fleet managers can view any fueling', function () {
    expect($this->admin->can('viewAny', Fueling::class))->toBeTrue();
    expect($this->fleetManager->can('viewAny', Fueling::class))->toBeTrue();
});

test('unit managers, drivers and garage managers cannot viewAny', function () {
    expect($this->unitManager->can('viewAny', Fueling::class))->toBeFalse();
    expect($this->driver->can('viewAny', Fueling::class))->toBeFalse();
    expect($this->garage->can('viewAny', Fueling::class))->toBeFalse();
});

test('admin and fleet manager can view, create and update fuelings', function () {
    foreach ([$this->admin, $this->fleetManager] as $user) {
        expect($user->can('view', $this->fueling))->toBeTrue();
        expect($user->can('create', Fueling::class))->toBeTrue();
        expect($user->can('update', $this->fueling))->toBeTrue();
        expect($user->can('delete', $this->fueling))->toBeFalse(); // sempre false
    }
});

test('driver can view only their own fuelings', function () {
    expect($this->driver->can('view', $this->fueling))->toBeTrue();
});

test('driver cannot create, update or delete fuelings', function () {
    expect($this->driver->can('create', Fueling::class))->toBeFalse();
    expect($this->driver->can('update', $this->fueling))->toBeFalse();
    expect($this->driver->can('delete', $this->fueling))->toBeFalse();
});

test('unit and garage managers cannot manage fuelings', function () {
    foreach ([$this->unitManager, $this->garage] as $user) {
        expect($user->can('view', $this->fueling))->toBeFalse();
        expect($user->can('create', Fueling::class))->toBeFalse();
        expect($user->can('update', $this->fueling))->toBeFalse();
        expect($user->can('delete', $this->fueling))->toBeFalse();
    }
});
