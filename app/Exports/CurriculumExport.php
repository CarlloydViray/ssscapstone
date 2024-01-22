<?php

namespace App\Exports;

use App\Models\Curriculum;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CurriculumExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {

        $campus_code = session('campus_code');

        $query = Curriculum::select(
            'curriculum_idYear',
            'curriculum_desc',
            'campus_code',
            'dept_code',
            'created_at',
            'updated_at'
        )->where('campus_code', '!=', 'MAIN');

        if ($campus_code != 'MAIN') {
            $query->where('campus_code', $campus_code);
        }

        // Call get() once after applying all conditions
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
            'curriculum_idYear',
            'curriculum_desc',
            'campus_code',
            'dept_code',
            'created_at',
            'updated_at',
        ];
    }
}
