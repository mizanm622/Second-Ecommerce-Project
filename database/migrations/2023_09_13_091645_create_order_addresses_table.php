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
        Schema::create('order_addresses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('order_id');
            $table->string('total')->nullable();
            $table->string('subtotal')->nullable();
            $table->string('discount_amount')->nullable();
            $table->string('coupon_code')->nullable();
            $table->string('delivery_charge')->nullable();
            $table->string('tax')->nullable();
            $table->integer('status')->default(0);
            $table->integer('tracking')->default(0);
            $table->string('payment_by')->nullable();
            $table->string('payment_code')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('extra_phone')->nullable();
            $table->string('town')->nullable();
            $table->string('city')->nullable();
            $table->string('zip')->nullable();
            $table->text('address')->nullable();
            $table->string('country')->nullable();
            $table->string('order_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_addresses');
    }
};
