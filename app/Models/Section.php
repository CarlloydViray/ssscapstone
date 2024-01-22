<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Section extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'sections';

    protected $fillable = [
        'section_desc',
        'campus_code',
        'dept_code',
        'schoolyear_id',
        'section_yearLevel',
        'section_semester',
        'section_capacity',
    ];
}
