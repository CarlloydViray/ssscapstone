<?php

namespace App\Imports;

use App\Models\Department;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Hash;

class DepartmentImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        Department::updateOrInsert(
            ['dept_code' => $row['dept_code']],
            [
                'dept_desc' => $row['dept_desc'],
                'dept_type' => $row['dept_type'],
                'campus_code' => $row['campus_code'],
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
    }
}
