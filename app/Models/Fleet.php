<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fleet extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'model',
        'number',
        'total_seats',
        'total_bag',
        'image',
        'per_kilometer_fare',
        'per_kilometer_fare_duration_wise',
        'details',
        'status',

    ];
}
