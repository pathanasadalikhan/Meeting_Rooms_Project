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
        Schema::create('employees', function (Blueprint $table) {
            $table->string('unique_id')->primary(); // Unique ID as primary key
            $table->string('EmpName');
            $table->bigInteger('MobileNumber');
            $table->string('position');
            $table->string('email')->unique();
            $table->string('password');
            $table->date('joining_date');
            $table->string('image');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Employees');
    }
};
