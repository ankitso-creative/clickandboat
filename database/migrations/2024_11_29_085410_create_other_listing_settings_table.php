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
        Schema::create('other_listing_settings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('listing_id')->constrained()->onDelete('cascade');
            $table->string('engine_type');
            $table->string('horsepower');
            $table->string('width')->nullable();
            $table->string('draft')->nullable();
            $table->string('offshore')->nullable();
            $table->string('crew_members')->nullable();
            $table->string('horsepower_tender')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('other_listing_settings');
    }
};
