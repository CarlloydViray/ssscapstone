<?php

namespace App\Imports;

use App\Models\Curriculum;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Hash;

class CurriculumImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        Curriculum::updateOrInsert(
            [
                'campus_code' => $row['campus_code'],
                'curriculum_idYear' => $row['curriculum_idYear'],
            ],
            [
                'curriculum_idYear' => $row['curriculum_idYear'],
                'curriculum_desc' => $row['curriculum_desc'],
                'dept_code' => $row['dept_code'],
                'campus_code' => $row['campus_code'],
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
    }
}
