<?php

namespace App\Models;

use App\RepairSpecialty;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RepairShop extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'cnpj',
        'location',
        'specialties',
        'is_active',
        'created_by',
    ];

    protected $casts = [
        'specialties' => 'string',
        'is_active' => 'boolean',
    ];
}
