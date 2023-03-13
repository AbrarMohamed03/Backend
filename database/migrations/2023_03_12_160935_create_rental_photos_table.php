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
        Schema::create('rental_photos', function (Blueprint $table) {
            $table->id();
            $table->string('path');
            $table->unsignedBigInteger('rental_id');
            $table->foreign('rental_id')->references('id')->on('rentals');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rental_photos');
    }
};
