<?php

namespace App\Imports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Hash;

class UsersImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        User::updateOrInsert(
            [
                'user_username' => $row['user_username'],
                'user_email' => $row['user_email'],
            ],
            [
                'user_password' => Hash::make($row['user_password']),
                'user_type' => $row['user_type'],
                'campus_code' => $row['campus_code'],
                'dept_code' => $row['dept_code'],
                'user_number' => $row['user_number'],
                'user_firstname' => $row['user_firstname'],
                'user_lastname' => $row['user_lastname'],
                'user_sex' => $row['user_sex'],
                'user_birthday' => $row['user_birthday'],
                'user_address' => $row['user_address'],
                'user_status' => $row['user_status'],
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
    }
}
