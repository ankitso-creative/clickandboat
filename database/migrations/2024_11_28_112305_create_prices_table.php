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
            $table->string('price');
            $table->string('over_night_price')->nullable();
            $table->string('one_half_day')->nullable();
            $table->string('two_day')->nullable();
            $table->string('three_day')->nullable();
            $table->string('four_day')->nullable();
            $table->string('five_day')->nullable();
            $table->string('six_day')->nullable();
            $table->string('one_week')->nullable();
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
