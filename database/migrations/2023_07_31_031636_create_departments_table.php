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
        Schema::create('departments', function (Blueprint $table) {
            $table->string('dept_code')->primary();
            $table->string('dept_desc');
            $table->string('dept_type');
            $table->string('campus_code', 20)->nullable();
            $table->foreign('campus_code')
                ->references('campus_code')
                ->on('campus')
                ->onDelete('set null');
            $table->timestamps();
        });

        DB::table('departments')->insert([
            [
                'dept_code' => 'ADMIN',
                'dept_desc' => 'ADMIN',
                'dept_type' => 'ADMIN',
                'campus_code' => 'MAIN',
                'created_at' => now(),
                'updated_at' => now(),
            ],


        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('departments');
    }
};
