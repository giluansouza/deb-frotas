<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehicleMonthlyKilometer extends Model
{
    use HasFactory;

    protected $table = 'vehicle_monthly_kilimeters';

    protected $fillable = [
        'vehicle_id',
        'year',
        'month',
        'initial_km',
        'final_km',
    ];

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    public function getMonthNameAttribute()
    {
        return Carbon::createFromDate($this->year, $this->month, 1)->locale('pt_BR')->monthName;
    }
}
