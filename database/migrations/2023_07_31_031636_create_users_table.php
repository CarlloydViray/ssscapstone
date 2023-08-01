<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;



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
            $table->string('user_username');
            $table->string('user_password');
            $table->string('user_type');
            $table->string('user_firstName');
            $table->string('user_lastName');
            $table->string('user_sex');
            $table->date('user_birthday');
            $table->string('user_address');
            $table->timestamps();
        });

        $hashedPassword = Hash::make('admin123');

        DB::table('users')->insert([
            [
                'dept_code' => 'ADMIN',
                'user_username' => 'admin',
                'user_password' => $hashedPassword,
                'user_type' => 'admin',
                'user_firstName' => 'John',
                'user_lastName' => 'Doe',
                'user_sex' => 'Male',
                'user_birthday' => '1990-01-01',
                'user_address' => '123 Main Street',
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
