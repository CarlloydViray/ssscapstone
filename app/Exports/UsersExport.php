<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UsersExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $campus_code = session('campus_code');

        $query = User::select(
            'user_username',
            'user_type',
            'campus_code',
            'dept_code',
            'user_email',
            'user_number',
            'user_firstName',
            'user_lastName',
            'user_sex',
            'user_birthday',
            'user_address',
            'user_status',
            'created_at',
            'updated_at'
        )->where('campus_code', '!=', 'MAIN');

        if ($campus_code != 'MAIN') {
            $query

                ->where('campus_code', $campus_code);
        }

        // Call get() once after applying all conditions
        $users = $query->get();

        return $users;
    }
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function headings(): array
    {
        return [
            'user_username',
            'user_type',
            'campus_code',
            'dept_code',
            'user_email',
            'user_number',
            'user_firstName',
            'user_lastName',
            'user_sex',
            'user_birthday',
            'user_address',
            'user_status',
            'created_at',
            'updated_at',
        ];
    }
}
