<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('curricular_subjects', function (Blueprint $table) {
            $table->id('cs_id');
            $table->unsignedBigInteger('curriculum_id')->nullable();
            $table->foreign('curriculum_id')->references('curriculum_id')->on('curriculum')->onDelete('set null');
            $table->string('subject_code')->nullable();
            $table->foreign('subject_code')->references('subject_code')->on('subjects')->onDelete('set null');
            $table->string('cs_semesterOffered');
            $table->string('cs_yearLevel');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('curricular_subjects');
    }
};
