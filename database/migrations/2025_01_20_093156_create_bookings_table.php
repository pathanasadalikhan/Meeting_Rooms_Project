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
        Schema::create('BookingRooms_Table', function (Blueprint $table) {
            $table->id();
            $table->string('unique_id');
            $table->string('room_id');
            $table->integer('capacity');
            $table->date('booking_date');
            $table->enum('booking_status', ['available', 'booked']);
            $table->timestamp('start_time');
            $table->timestamp('end_time');
            $table->timestamps();

            $table->foreign('unique_id')->references('unique_id')->on('employees');
            $table->foreign('room_id')->references('room_id')->on('Rooms_Table');
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('BookingRooms_Table');
    }
};
