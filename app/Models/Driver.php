<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    use HasFactory;

    public $fillable = [
        'name',
        'cpf',
        'rg',
        'number_cnh',
        'category_cnh',
        'first_cnh',
        'register',
        'link',
        'validity_cnh',
    ];

    protected $casts = [
        'first_cnh' => 'date',
        'validity_cnh' => 'date',
    ];

    public function getCnhWillExpireSoonAttribute()
    {
        if (!$this->validity_cnh) {
            return false;
        }

        return $this->validity_cnh->isFuture() && $this->validity_cnh->isBefore(Carbon::now()->addMonths(3));
    }
}
