<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class myAccController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user_id = session('user_id');
        $campus_code = session('campus_code');

        $user = DB::table('users')
            ->join('departments', 'users.dept_code', '=', 'departments.dept_code')
            ->where('user_id', $user_id)
            ->first();


        $department = DB::table('departments')
            ->where('campus_code', '=', $campus_code)
            ->first();

        $campus = DB::table('campus')
            ->where('campus_code', '!=', 'MAIN')
            ->where('campus_code', '=', $campus_code)
            ->first();

        return view('myAccPage', ['user' => $user, 'department' => $department, 'campus' => $campus]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'required',
            'address' => 'required',
            'userBirthday' => 'required|date',
            'email' => 'required|email',
            'number' => 'required',
            'sex' => 'required',
            'usertype' => 'required',
            'dept_code' => 'required',
            'campus_code' => 'required',
            'username' => 'required',
            'status' => 'required',
            'password' => 'required|min:8',
            'password2' => 'required|same:password',
        ]);

        $first_name = $request->input('first_name');
        $last_name = $request->input('last_name');
        $address = $request->input('address');
        $userBirthday = $request->input('userBirthday');
        $sex = $request->input('sex');
        $usertype = $request->input('usertype');
        $dept_code = $request->input('dept_code');
        $campus_code = $request->input('campus_code');
        $username = $request->input('username');
        $password = $request->input('password');
        $status = $request->input('status');
        $number = $request->input('number');
        $email = $request->input('email');


        DB::table('users')->where('user_id', $id)->update([
            'user_username' => $username,
            'user_password' => Hash::make($password),
            'user_type' => $usertype,
            'user_firstName' => $first_name,
            'user_lastName' => $last_name,
            'user_sex' => $sex,
            'user_email' => $email,
            'user_number' => $number,
            'user_birthday' => $userBirthday,
            'user_address' => $address,
            'campus_code' => $campus_code,
            'dept_code' => $dept_code,
            'user_status' =>  $status,
            'updated_at' => now(),
        ]);

        return redirect()->route('myAccResource.index')->with('success', 'User Credentials Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
