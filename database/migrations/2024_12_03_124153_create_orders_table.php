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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('listing_id')->constrained()->onDelete('cascade');
            $table->string('payment_intent_id')->nullable();
            $table->string('rental_type')->nullable();
            $table->string('additional_options')->nullable();
            $table->string('multi_risk')->nullable();
            $table->string('assistance')->nullable();
            $table->string('insured_price')->nullable();
            $table->string('check_in');
            $table->string('check_out');
            $table->string('sub_total');
            $table->string('service_fees')->nullable();
            $table->string('extra_fees')->nullable();
            $table->string('total');
            $table->string('amount_paid');
            $table->string('pending_amount')->nullable();
            $table->string('payment_status')->nullable();
            $table->string('currency')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
