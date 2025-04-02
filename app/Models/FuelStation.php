<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FuelStation extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'cnpj',
        'location',
        'is_active',
        'created_by',
    ];
}
