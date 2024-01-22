<?php

namespace App\Exports;

use App\Models\Faculty;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class FacultyExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {

        $campus_code = session('campus_code');

        $query = Faculty::select(
            'campus_code',
            'dept_code',
            'faculty_firstName',
            'faculty_lastName',
            'faculty_birthDate',
            'faculty_address',
            'faculty_sex',
            'faculty_status',
            'created_at',
            'updated_at'
        )->where('campus_code', '!=', 'MAIN');

        if ($campus_code != 'MAIN') {
            $query->where('campus_code', $campus_code);
        }

        // Call get() once after applying all conditions
        $faculty = $query->get();

        return $faculty;
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
            'dept_code',
            'faculty_firstName',
            'faculty_lastName',
            'faculty_birthDate',
            'faculty_address',
            'faculty_sex',
            'faculty_position',
            'faculty_status',
            'created_at',
            'updated_at'
        ];
    }
}
