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
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('ServiceName')->nullable();
            $table->unsignedBigInteger('ServiceCategoryID')->nullable();
            $table->integer('Price')->nullable();
            $table->integer('TimeDurationHours')->nullable();
            $table->integer('TimeDurationMinutes')->nullable();
            $table->longText('ShortDescription')->nullable();
            $table->unsignedBigInteger('ServiceProviderID')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
