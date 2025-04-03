<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;

    protected $fillable = [
        'plate',
        'renavam',
        'brand',
        'model',
        'year_manufacture',
        'year_model',
        'type',
        'fuel_type',
        'tank_capacity',
        'administrative_unit',
        'ownership',
        'conservation_state',
        'visual_identity',
    ];

    public function monthlyKilometers()
    {
        return $this->hasMany(VehicleMonthlyKilometer::class);
    }

    public function fuelings()
    {
        return $this->hasMany(Fueling::class);
    }

    public function maintenance()
    {
        return $this->hasMany(Maintenance::class);
    }
}
