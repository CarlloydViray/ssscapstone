<?php

namespace App\Imports;

use App\Models\Room;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Hash;

class RoomImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        Room::updateOrInsert(
            [
                'campus_code' => $row['campus_code'],
                'room_code' => $row['room_code']
            ],
            [
                'room_desc' => $row['room_desc'],
                'room_capacity' => $row['room_capacity'],
                'room_location' => $row['room_location'],
                'created_at' => now(),
                'updated_at' => now(),
            ]


        );
    }
}
