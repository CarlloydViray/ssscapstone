<?php

namespace App\Imports;

use App\Models\Campus;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Hash;

class csImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        Campus::updateOrInsert(
            [
                'curriculum_id' => $row['curriculum_id'],
                'subject_code' => $row['subject_code']
            ],
            [
                'cs_semesterOffered' => $row['cs_semesterOffered'],
                'cs_yearLevel' => $row['cs_yearLevel'],
                'created_at' => now(),
                'updated_at' => now(),
            ]


        );
    }
}
