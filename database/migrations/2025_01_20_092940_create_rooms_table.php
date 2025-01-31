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
        Schema::create('Rooms_Table', function (Blueprint $table) {
            $table->string('room_id')->primary();
            $table->string('room_name');
            $table->integer('capacity');
            $table->string('room_image');
            $table->timestamps();
        });
    }

    /**/home/pathan/MeetingRoom1/public/Employees_images/
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Rooms_Table');
    }
};
