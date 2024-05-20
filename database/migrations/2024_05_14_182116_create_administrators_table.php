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
        Schema::create('administrators', function (Blueprint $table) {
            $table->id();
            $table->string('AdministratorName');
            $table->string('AdministratorSurname');
            $table->string('Username');
            $table->string('Password');
            $table->string('Country');
            $table->string('City');
            $table->string('Address');
            $table->string('PostalCode');
            $table->string('Email');
            $table->string('PhoneNumber');
            $table->string('AdministratorImage')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('administrators');
    }
};
