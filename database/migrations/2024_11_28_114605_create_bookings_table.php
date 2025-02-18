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
            $table->foreignId('listing_id')->constrained()->onDelete('cascade');
            $table->string('cancellation_conditions');
            $table->string('check_in');
            $table->string('check_out');
            $table->string('check_in_rental')->nullable();
            $table->string('check_out_rental')->nullable();
            $table->string('fuel_cost');
            $table->string('boat_licence');
            $table->string('night_fees');
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
