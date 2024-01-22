<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Faculty extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'faculty';

    protected $fillable = [
        'campus_code',
        'dept_code',
        'faculty_firstName',
        'faculty_lastName',
        'faculty_birthDate',
        'faculty_address',
        'faculty_sex',
        'faculty_status',
    ];
}
