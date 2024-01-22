<?php

namespace App\Exports;

use App\Models\Department;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class DepartmentExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $campus_code = session('campus_code');

        $query = Department::select(
            'dept_code',
            'dept_desc',
            'dept_type',
            'campus_code',
            'created_at',
            'updated_at'
        )->where('dept_code', '!=', 'ADMIN');

        if ($campus_code != 'MAIN') {
            $query->where('campus_code', $campus_code);
        }

        // Call get() once after applying all conditions
        $departments = $query->get();

        return $departments;
    }
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function headings(): array
    {
        return [
            'dept_code',
            'dept_desc',
            'dept_type',
            'campus_code',
            'created_at',
            'updated_at'
        ];
    }
}
