<?php

namespace App\Imports;

use App\Models\Designations;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class DesignationImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        Designations::Insert(
            [
                'designation_name' => $row['designation_name'],
                'designation_units' => $row['designation_units'],
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
    }
}
