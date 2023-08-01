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
            $table->string('dept_code', 20)->primary();
            $table->string('dept_desc');
            $table->timestamps();
        });

        // Insert data into the 'departments' table
        DB::table('departments')->insert([
            ['dept_code' => 'ADMIN', 'dept_desc' => 'ADMIN'],
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
