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
        Schema::create('faculty', function (Blueprint $table) {
            $table->id('faculty_id');
            $table->string('dept_code');
            $table->foreign('dept_code')->references('dept_code')->on('departments');
            $table->string('faculty_firstName');
            $table->string('faculty_lastName');
            $table->date('faculty_birthDate');
            $table->string('faculty_address');
            $table->string('faculty_sex');
            $table->string('faculty_position');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('faculty');
    }
};
