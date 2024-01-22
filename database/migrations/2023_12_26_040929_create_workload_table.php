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
        Schema::create('workload', function (Blueprint $table) {
            $table->id('workload_id');
            $table->string('subject_code')->nullable();
            $table->foreign('subject_code')
                ->references('subject_code')
                ->on('subjects')->onDelete('set null');
            $table->unsignedBigInteger('faculty_id')->nullable();
            $table->foreign('faculty_id')->references('faculty_id')->on('faculty')->onDelete('set null');
            $table->unsignedBigInteger('section_id')->nullable();
            $table->foreign('section_id')->references('section_id')->on('sections')->onDelete('set null');
            $table->string('campus_code', 20)->nullable();
            $table->foreign('campus_code')
                ->references('campus_code')
                ->on('campus')
                ->onDelete('set null');
            $table->decimal('workload_lab')->nullable();
            $table->decimal('workload_lec')->nullable();
            $table->decimal('workload_teachingLoad')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('workload');
    }
};
