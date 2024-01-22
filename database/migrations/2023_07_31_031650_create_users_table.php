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
            $table->string('user_username');
            $table->string('user_number');
            $table->string('user_email');
            $table->string('user_password');
            $table->string('user_type');
            $table->string('user_firstName');
            $table->string('user_lastName');
            $table->string('user_sex');
            $table->date('user_birthday');
            $table->string('user_address');
            $table->string('user_status');
            $table->timestamps();
        });

        $hashedPassword = Hash::make('admin123');
        DB::table('users')->insert([
            [
                'user_username' => 'admin',
                'user_password' => $hashedPassword,
                'user_type' => 'admin',
                'campus_code' => 'MAIN',
                'dept_code' => 'ADMIN',
                'user_email' => 'psu.css@gmail.com',
                'user_number' => '00000',
                'user_firstName' => 'PSU',
                'user_lastName' => 'MAIN CAMPUS',
                'user_sex' => 'Male',
                'user_birthday' => '1990-01-01',
                'user_address' => 'Main Admin',
                'user_status' => 'active',
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
        Schema::dropIfExists('users');
    }
};
