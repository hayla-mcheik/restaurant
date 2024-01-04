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
            $table->foreignId('user_id')->constrained();
            $table->string('name')->nullable();
            $table->string('slug')->nullable();
            $table->string('address')->nullable();
            $table->string('map')->nullazble();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('openninghours')->nullable();
            $table->string('closinghours')->nullable();
            $table->string('deliverytime')->nullable();
            $table->tinyInteger('status')->nullable()->default(0);
            $table->tinyInteger('popular')->nullable()->default(0);
            $table->text('image')->nullable();
            $table->text('coverimage')->nullable();
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
