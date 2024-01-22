<?php

namespace App\Imports;

use App\Models\Faculty;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Hash;

class FacultyImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        Faculty::updateOrInsert(
            [
                'campus_code' => $row['campus_code'],
                'dept_code' => $row['dept_code'],
                'faculty_firstname' => $row['faculty_firstname'],
                'faculty_lastname' => $row['faculty_lastname'],
            ],
            [
                'faculty_birthdate' => $row['faculty_birthdate'],
                'faculty_address' => $row['faculty_address'],
                'faculty_sex' => $row['faculty_sex'],
                'faculty_status' => $row['faculty_status'],
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
    }
}
