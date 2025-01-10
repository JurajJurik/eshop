<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Query\Expression;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();

            $table->unsignedTinyInteger('rating');
            $table->json('advantages');
            $table->json('disadvantages');
            $table->text('description')->nullable();
            //$table->json('photos_path')->nullable();
            $table->unsignedSmallInteger('helpful')->default(0);

            $table->timestamps();

            $table->foreignId('product_id')->constrained()->cascadeOnDelete();
            //$table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
