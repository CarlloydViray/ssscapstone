<?php

namespace App\Exports;

use App\Models\Schoolyear;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SchoolyearExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {

        $campus_code = session('campus_code');

        $query = Schoolyear::select(
            'campus_code',
            'schoolyear_sy',
        )->where('campus_code', '!=', 'MAIN');

        if ($campus_code != 'MAIN') {
            $query->where('campus_code', $campus_code);
        }

        $result = $query->get();

        return $result;
    }
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function headings(): array
    {
        return [
            'campus_code',
            'schoolyear_sy',
            'created_at',
            'updated_at',
        ];
    }
}
