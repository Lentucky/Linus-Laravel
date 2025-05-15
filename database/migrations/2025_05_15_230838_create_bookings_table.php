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
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); //FK to users
            $table->foreignId('showtime_id')->constrained()->onDelete('cascade'); //FK to showtimes
            $table->foreignId('seat_id')->constrained()->onDelete('cascade'); //FK to seats
            $table->enum('status', ['confirmed', 'cancelled'])->default('confirmed');
            $table->string('booking_code')->unique();
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
