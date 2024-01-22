<?php

namespace App\Exports;

use App\Models\Campus;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CampusExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {

        $campus_code = session('campus_code');

        $query = Campus::select(
            'campus_code',
            'campus_location',
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
            'campus_code',
            'campus_location',
            'created_at',
            'updated_at',
        ];
    }
}
