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
        Schema::create('curriculum', function (Blueprint $table) {
            $table->id('curriculum_id');
            $table->string('curriculum_idYear');
            $table->string('curriculum_desc');
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
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('curriculum');
    }
};
