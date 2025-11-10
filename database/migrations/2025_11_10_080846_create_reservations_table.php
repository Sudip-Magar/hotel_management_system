<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('room_id')->constrained('rooms')->cascadeOnDelete();

            $table->date('check_in');
            $table->date('check_out');

            $table->integer('total_nights');
            $table->decimal('total_price', 10, 2);

            $table->enum('payment_status', ['pending', 'paid'])->default('pending');
            $table->enum('booking_status', ['booked', 'checked_in', 'checked_out', 'cancelled'])->default('booked');

            $table->string('guest_name')->nullable();  // for walk-in booking
            $table->string('guest_phone')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
