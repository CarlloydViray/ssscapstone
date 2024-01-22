<?php

namespace App\Exports;

use App\Models\Section;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SectionExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {

        $campus_code = session('campus_code');

        $query = Section::select(
            'section_desc',
            'campus_code',
            'dept_code',
            'schoolyear_id',
            'section_yearLevel',
            'section_semester',
            'section_capacity',
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
            'section_desc',
            'campus_code',
            'dept_code',
            'schoolyear_id',
            'section_yearLevel',
            'section_semester',
            'section_capacity',
            'created_at',
            'updated_at',
        ];
    }
}
