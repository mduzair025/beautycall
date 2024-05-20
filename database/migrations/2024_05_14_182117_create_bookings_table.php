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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->time('BeginTime')->nullable();
            $table->date('Date')->nullable();
            $table->string('BookingStatus')->nullable();
            $table->unsignedBigInteger('ServiceProviderID')->nullable();
            $table->unsignedBigInteger('ServiceID')->nullable();
            $table->unsignedBigInteger('BookingRatingID')->nullable();
            $table->unsignedBigInteger('UserID')->nullable();
            $table->time('FinishTime')->nullable();
            $table->unsignedBigInteger('StaffID')->nullable();
            $table->string('Deleted', 11)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
