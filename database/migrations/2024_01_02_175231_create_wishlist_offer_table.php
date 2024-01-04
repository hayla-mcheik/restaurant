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
        Schema::create('wishlist_offer', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('wishlist_model_id');
            $table->unsignedBigInteger('offer_id');
            $table->timestamps();

            $table->foreign('wishlist_model_id')->references('id')->on('wishlist')->onDelete('cascade');
            $table->foreign('offer_id')->references('id')->on('offers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wishlist_offer');
    }
};
