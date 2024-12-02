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
        Schema::create('products', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->char('short_description', length: 150);
            $table->text('description');
            $table->string('manufacturer');
            $table->string('platform');
            $table->string('serial_number');
            $table->unsignedInteger('price');
            $table->unsignedInteger('price_with_VAT');
            $table->text('image')->nullable();
            $table->string('category');
            $table->string('subcategory');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
