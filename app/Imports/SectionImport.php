<?php

namespace App\Imports;

use App\Models\Section;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Hash;

class SectionImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {

        Section::updateOrInsert(
            [
                'section_desc' => $row['section_desc'],
                'campus_code' => $row['campus_code'],
                'dept_code' => $row['dept_code'],
                'schoolyear_id' => $row['schoolyear_id']
            ],
            [
                'section_yearlevel' => $row['section_yearlevel'],
                'section_semester' => $row['section_semester'],
                'section_capacity' => $row['section_capacity'],
                'created_at' => now(),
                'updated_at' => now(),
            ]

        );
    }
}
