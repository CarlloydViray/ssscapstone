<?php

namespace App\Exports;

use App\Models\Room;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class RoomExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {

        $campus_code = session('campus_code');

        $query = Room::select(
            'room_code',
            'campus_code',
            'room_desc',
            'room_capacity',
            'room_location',
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
            'room_code',
            'campus_code',
            'room_desc',
            'room_capacity',
            'room_location',
            'created_at',
            'updated_at',
        ];
    }
}
