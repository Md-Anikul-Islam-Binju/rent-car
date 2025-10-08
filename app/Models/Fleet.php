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



        'checking_bag',
        'carry_bag',

        'image',
        'base_fare',
        'per_kilometer_fare',
        'per_kilometer_fare_duration_wise',
        'details',
        'short_details',
        'status',

    ];
}
