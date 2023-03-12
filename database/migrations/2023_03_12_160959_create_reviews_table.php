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
        Schema::create('reviews', function (Blueprint $table) {
            $table->id('reviews_id');
            $table->integer('rate');
            $table->string('comment');
            $table->unsignedBigInteger('service_id');
            $table->foreign('service_id')->references('service_id')->on('services');
            $table->unsignedBigInteger('tourist_id');
            $table->foreign('tourist_id')->references('tourist_id')->on('tourists');
            $table->timestamps();
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
