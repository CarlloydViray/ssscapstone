<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use App\Models\Designations;
use Maatwebsite\Excel\Concerns\WithHeadings;

class DesignationExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $query = Designations::select(
            'designation_id',
            'designation_name',
            'designation_units',
            'created_at',
            'updated_at'
        );

        $designations = $query->get();

        return $designations;
    }

    /**
     * Write code on Method
     *
     * @return response()
     */

    public function headings(): array
    {
        return [
            'designation_id',
            'designation_name',
            'designation_units',
            'created_at',
            'updated_at'
        ];
    }
}
