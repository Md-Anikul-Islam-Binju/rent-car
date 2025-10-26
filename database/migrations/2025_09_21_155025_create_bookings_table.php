<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('service_id')->nullable();
            $table->unsignedBigInteger('fleet_id')->nullable();
            $table->date('date')->nullable();
            $table->time('time')->nullable();
            $table->integer('no_of_adults')->nullable();
            $table->integer('baby_seat')->default(0);
            $table->integer('booster_seat')->default(0);
            $table->string('pickup_location')->nullable();
            $table->string('drop_location')->nullable();
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->text('notes')->nullable();
            $table->string('total_kilometers')->nullable();
            $table->boolean('is_duration_trip')->default(0);
            $table->boolean('is_round_trip')->default(0);
            $table->string('total_amount')->nullable();
            $table->string('payment_status')->default('unpaid'); // unpaid, paid, refunded
            $table->time('flight_arrival_time')->nullable();
            $table->string('flight_number')->nullable();

            $table->time('flight_departure')->nullable();
            $table->string('duration')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
