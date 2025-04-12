<?php

namespace App\Models;

use App\DriverStatus;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Driver extends Model
{
    use HasFactory, SoftDeletes;

    public $fillable = [
        'name',
        'cpf',
        'rg',
        'number_cnh',
        'category_cnh',
        'register',
        'link',
        'first_cnh',
        'validity_cnh',
        'status',
        'user_id',
    ];

    protected $casts = [
        'first_cnh' => 'date',
        'validity_cnh' => 'date',
        'status' => DriverStatus::class,
    ];

    public function getCnhWillExpireSoonAttribute()
    {
        if (!$this->validity_cnh) {
            return false;
        }

        return $this->validity_cnh->isFuture() && $this->validity_cnh->isBefore(Carbon::now()->addMonths(3));
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
