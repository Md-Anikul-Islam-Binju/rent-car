<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'service_id',
        'fleet_id',
        'date',
        'time',
        'no_of_adults',

        'baby_seat',
        'booster_seat',


        'pickup_location',
        'drop_location',

        'name',
        'email',
        'phone',
        'notes',
        'total_kilometers',
        'is_duration_trip',

        'is_round_trip',
        'total_amount',
        'payment_status',




    ];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function fleet()
    {
        return $this->belongsTo(Fleet::class);
    }
}
