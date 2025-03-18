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
        Schema::create('prices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('listing_id')->constrained()->onDelete('cascade');
            $table->foreignId('season_price_id')->constrained()->onDelete('cascade')->nullable();
            $table->float('price');
            $table->float('over_night_price')->nullable();
            $table->float('one_half_day')->nullable();
            $table->float('two_day')->nullable();
            $table->float('three_day')->nullable();
            $table->float('four_day')->nullable();
            $table->float('five_day')->nullable(); 
            $table->float('six_day')->nullable();
            $table->float('one_week')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prices');
    }
};
