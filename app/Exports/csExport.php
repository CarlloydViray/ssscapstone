<?php

namespace App\Exports;

use App\Models\CurricularSubject;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class csExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $campus_code = session('campus_code');

        $query = CurricularSubject::select(
            'curricular_subjects.curriculum_id',
            'curricular_subjects.subject_code',
            'curricular_subjects.cs_semesterOffered',
            'curricular_subjects.cs_yearLevel',
            'curricular_subjects.created_at',
            'curricular_subjects.updated_at'
        )
            ->join('curriculum', 'curricular_subjects.curriculum_id', '=', 'curriculum.curriculum_id');

        if ($campus_code != 'MAIN') {
            $query->where('curriculum.campus_code', $campus_code);
        }

        $results = $query->get();

        return $results;
    }
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function headings(): array
    {
        return [
            'curriculum_id',
            'subject_code',
            'cs_semesterOffered',
            'cs_yearLevel',
            'created_at',
            'updated_at',
        ];
    }
}
