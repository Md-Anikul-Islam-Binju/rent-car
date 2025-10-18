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
        Schema::create('fleets', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('slug')->nullable();
            $table->string('model')->nullable();
            $table->string('number')->nullable();
            $table->integer('total_seats')->nullable();



            $table->integer('checking_bag')->nullable();
            $table->integer('carry_bag')->nullable();

            $table->string('image')->nullable();
            $table->string('base_fare')->nullable();
            $table->string('short_details')->nullable();
            $table->string('per_kilometer_fare')->nullable();
            $table->string('per_kilometer_fare_duration_wise')->nullable();
            $table->text('details')->nullable();
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fleets');
    }
};
