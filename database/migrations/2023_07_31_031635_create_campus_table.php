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
        Schema::create('campus', function (Blueprint $table) {
            $table->string('campus_code', 20)->primary();
            $table->string('campus_location');
            $table->timestamps();
        });

        DB::table('campus')->insert([
            [
                'campus_code' => 'MAIN', 'campus_location' => 'Main ADMIN', 'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('campus');
    }
};
