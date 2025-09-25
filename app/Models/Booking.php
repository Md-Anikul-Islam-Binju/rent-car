<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
    protected $fillable = [
        'service_id',
        'fleet_id',
        'date',
        'time',
        'no_of_adults',
        'no_of_children',
        'pickup_location',
        'drop_location',

        'name',
        'email',
        'phone',
        'notes',
        'total_kilometers',



    ];
}
