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
        Schema::create('loading', function (Blueprint $table) {
            $table->id('loading_id');
            $table->unsignedBigInteger('faculty_id')->nullable();
            $table->foreign('faculty_id')->references('faculty_id')->on('faculty')->onDelete('set null');
            $table->string('campus_code', 20)->nullable();
            $table->foreign('campus_code')
                ->references('campus_code')
                ->on('campus')
                ->onDelete('set null');
            $table->unsignedBigInteger('schoolyear_id')->nullable();
            $table->foreign('schoolyear_id')->references('schoolyear_id')->on('schoolyear')->onDelete('set null');
            $table->decimal('loading_designation')->nullable();
            $table->decimal('loading_research')->nullable();
            $table->decimal('loading_extension')->nullable();
            $table->decimal('loading_totalUnitsDeloading')->nullable();
            $table->decimal('loading_totalWorkLoadUnits')->nullable();
            $table->decimal('loading_prepTeaching')->nullable();
            $table->decimal('loading_prepDesignation')->nullable();
            $table->string('loading_remarks')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loading');
    }
};
