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
        Schema::create('listings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('type');
            $table->string('harbour');
            $table->string('city');
            $table->string('professional');
            $table->string('manufacturer');
            $table->string('model');
            $table->string('skipper')->nullable();
            $table->string('capacity')->nullable();
            $table->float('length')->nullable();
            $table->string('company_name');
            $table->string('website')->nullable();
            $table->string('boat_name');
            $table->string('title')->nullable();
            $table->string('description')->nullable();
            $table->string('onboard_capacity')->nullable();
            $table->string('cabins')->nullable();
            $table->string('berths')->nullable();
            $table->string('bathrooms')->nullable();
            $table->string('construction_year')->nullable();
            $table->string('fuel')->nullable();
            $table->string('renovated')->nullable();
            $table->string('speed')->nullable();
            $table->string('slug');
            $table->integer('status')->default('0');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('listings');
    }
};
