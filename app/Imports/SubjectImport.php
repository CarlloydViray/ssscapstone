<?php

namespace App\Imports;

use App\Models\Subject;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Hash;

class SubjectImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        Subject::updateOrInsert(
            [
                'campus_code' => $row['campus_code'],
                'subject_code' => $row['subject_code']
            ],
            [
                'subject_desc' => $row['subject_desc'],
                'subject_units' => $row['subject_units'],
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
    }
}
