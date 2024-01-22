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
        Schema::create('section_schedule', function (Blueprint $table) {
            $table->id('sectionSchedule_id');
            $table->string('subject_code')->nullable();
            $table->foreign('subject_code')
                ->references('subject_code')
                ->on('subjects')->onDelete('set null');
            $table->unsignedBigInteger('faculty_id')->nullable();
            $table->foreign('faculty_id')->references('faculty_id')->on('faculty')->onDelete('set null');
            $table->unsignedBigInteger('section_id')->nullable();
            $table->foreign('section_id')->references('section_id')->on('sections')->onDelete('set null');
            $table->string('room_code')->nullable();
            $table->foreign('room_code')
                ->references('room_code')
                ->on('rooms')->onDelete('set null');
            $table->string('day');
            $table->string('start_time');
            $table->string('end_time');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('section_schedule');
    }
};
