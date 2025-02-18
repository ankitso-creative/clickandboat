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
        Schema::create('equipments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('listing_id')->constrained()->onDelete('cascade');
            $table->longText('outdoor_equipment')->nullable();
            $table->longText('extra_comfrot')->nullable();
            $table->longText('navigation_equipment')->nullable();
            $table->longText('kitchen')->nullable();
            $table->longText('leisure_activities')->nullable();
            $table->longText('onboard_energy')->nullable();
            $table->longText('water_sports')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('equipments');
    }
};
