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
        Schema::create('service_providers', function (Blueprint $table) {
            $table->id();
            $table->string('Name')->nullable();
            $table->string('Country')->nullable();
            $table->string('City')->nullable();
            $table->string('Address')->nullable();
            $table->string('PostalCode')->nullable();
            $table->longText('ShortDescription')->nullable();
            $table->string('Email')->nullable();
            $table->string('PhoneNumber')->nullable();
            $table->integer('AverageSalonRating')->nullable();
            $table->unsignedBigInteger('AdministratorID')->nullable();
            $table->unsignedBigInteger('OpeningTimeID')->nullable();
            $table->string('Status')->nullable();
            $table->integer('RatingsNumber')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_providers');
    }
};
