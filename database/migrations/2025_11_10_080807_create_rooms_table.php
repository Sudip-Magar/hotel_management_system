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
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->string('room_number')->unique();
            $table->foreignId('category_id')->constrained('room_categories')->cascadeOnDelete();
            $table->foreignId('guest_type_id')->constrained('guest_types')->cascadeOnDelete();
            $table->enum('status', ['available', 'occupied', 'maintenance', 'cleaning'])->default('available');
            $table->integer('max_guest'); // actual capacity of this room
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};
