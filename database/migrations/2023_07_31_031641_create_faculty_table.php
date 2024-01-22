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
        Schema::create('faculty', function (Blueprint $table) {
            $table->id('faculty_id');
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
            $table->unsignedBigInteger('designation_id')->nullable();
            $table->foreign('designation_id')
                ->references('designation_id')
                ->on('designations')
                ->onDelete('set null');
            $table->string('faculty_firstName');
            $table->string('faculty_lastName');
            $table->date('faculty_birthDate');
            $table->string('faculty_address');
            $table->string('faculty_sex');
            $table->string('faculty_status');
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
