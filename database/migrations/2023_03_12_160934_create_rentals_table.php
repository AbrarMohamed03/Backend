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
        Schema::create('rentals', function (Blueprint $table) {
            $table->id('rental_id');
            $table->string('name');
            $table->string('type');
            $table->string('desc');
            $table->string('adress');
            $table->integer('bedrooms');
            $table->integer('bathrooms');
            $table->integer('max_persons');
            $table->float('price_per_night');
            
            $table->unsignedBigInteger('service_id');
            $table->foreign('service_id')->references('service_id')->on('services');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rentals');
    }
};
