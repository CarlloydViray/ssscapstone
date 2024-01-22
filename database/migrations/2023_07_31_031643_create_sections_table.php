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
        Schema::create('sections', function (Blueprint $table) {
            $table->id('section_id');
            $table->string('section_desc');
            $table->string('campus_code', 20)->nullable();
            $table->foreign('campus_code')
                ->references('campus_code')
                ->on('campus')
                ->onDelete('set null');
            $table->string('dept_code')->nullable();
            $table->foreign('dept_code')
                ->references('dept_code')
                ->on('departments')
                ->onDelete('set null');
            $table->unsignedBigInteger('schoolyear_id')->nullable();
            $table->foreign('schoolyear_id')->references('schoolyear_id')->on('schoolyear')->onDelete('set null');
            $table->string('section_yearLevel');
            $table->string('section_semester');
            $table->string('section_capacity');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sections');
    }
};
