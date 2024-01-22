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
        Schema::create('rooms', function (Blueprint $table) {
            $table->string('room_code')->unique();
            $table->string('campus_code', 20)->nullable();
            $table->foreign('campus_code')
                ->references('campus_code')
                ->on('campus')
                ->onDelete('set null');
            $table->string('room_desc');
            $table->integer('room_capacity');
            $table->string('room_location');
            $table->timestamps();
        });

       
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};
