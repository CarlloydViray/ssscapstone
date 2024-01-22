<?php

namespace App\Imports;

use App\Models\Schoolyear;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Hash;

class SchoolyearImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        Schoolyear::updateOrInsert(
            ['campus_code' => $row['campus_code']],
            [
                'schoolyear_sy' => $row['schoolyear_sy'],
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
    }
}
