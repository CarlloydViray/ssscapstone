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
        Schema::create('users', function (Blueprint $table) {
            $table->id('user_id');
            $table->string('dept_code', 20);
            $table->foreign('dept_code')->references('dept_code')->on('departments');
            $table->string('username');
            $table->string('password');
            $table->string('user_type');
            $table->string('user_firstName');
            $table->string('user_lastName');
            $table->string('sex');
            $table->date('birthday');
            $table->string('address');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
