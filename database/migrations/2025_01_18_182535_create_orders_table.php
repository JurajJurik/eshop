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

            $table->unsignedBigInteger('invoice_number')->unique();
            $table->foreignId('user_id')->nullable()->constrained();
            $table->string('name');
            $table->string('email');
            $table->string('currency');
            $table->json('products');
            $table->json('quantity');
            $table->smallInteger('total_price_without_VAT');
            $table->smallInteger('total_price');
            $table->json('order_address');
            $table->json('shipping_address')->nullable();
            $table->string('shipping_method')->nullable();
            $table->string('order_status');
            $table->string('coupon')->nullable();
            $table->string('invoice_path')->nullable();


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
