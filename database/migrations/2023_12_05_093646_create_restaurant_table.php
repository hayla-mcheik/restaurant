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
        Schema::create('restaurant', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained('restaurant_categories')->onDelete('cascade');
            $table->text('image')->nullable();
            $table->text('coverimage')->nullable();
            $table->string('name')->nullable();
            $table->string('slug')->nullable();
            $table->string('address')->nullable();
            $table->string('map')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('openninghours')->nullable();
            $table->string('deliverytime')->nullable();
            $table->boolean('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('restaurant');
    }
};
