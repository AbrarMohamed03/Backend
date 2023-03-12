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
            $table->id('order_id');
            $table->date('order_date');

            $table->unsignedBigInteger('tourist_id');
            $table->foreign('tourist_id')->references('tourist_id')->on('tourists');

            $table->unsignedBigInteger('service_id');
            $table->foreign('service_id')->references('service_id')->on('services');

            $table->unsignedBigInteger('status_id');
            $table->foreign('status_id')->references('status_id')->on('order_statuses');
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
