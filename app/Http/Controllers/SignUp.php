<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class SignUp extends Controller
{
    public function createAcc(Request $request)
    {
        //add custom message please
        $this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'required',
            'address' => 'required',
            'userBirthday' => 'required|date',
            'sex' => 'required',
            'usertype' => 'required',
            'dept_code' => 'required',
            'username' => 'required',
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
        $username = $request->input('username');
        $password = $request->input('password');

        DB::table('users')->insert([
            'username' => $username,
            'password' => Hash::make($password),
            'user_type' => $usertype,
            'user_firstName' => $first_name,
            'user_lastName' => $last_name,
            'sex' => $sex,
            'birthday' => $userBirthday,
            'address' => $address,
            'dept_code' => $dept_code,
        ]);

        return redirect('/')->with('success', 'Account Created Successfully');
    }
}
