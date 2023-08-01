<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class misUserManagement extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = DB::table('users')
            ->select('users.*', 'departments.dept_desc')
            ->join('departments', 'users.dept_code', '=', 'departments.dept_code')
            ->get();

        $departments = DB::table('departments')->get();

        return view('mis.misUsersManagementPage', ['users' => $users, 'departments' => $departments]);
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
            'user_username' => $username,
            'user_password' => Hash::make($password),
            'user_type' => $usertype,
            'user_firstName' => $first_name,
            'user_lastName' => $last_name,
            'user_sex' => $sex,
            'user_birthday' => $userBirthday,
            'user_address' => $address,
            'dept_code' => $dept_code,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $user_id = session('user_id');
        $user = DB::table('users')->where('user_id', $user_id)->first();
        $departmentdesc = DB::table('departments')->where('dept_code', $user->dept_code)->value('dept_desc');

        DB::table('histories')->insert([
            'user_id' => $user->user_id,
            'user_firstName' => $user->user_firstName,
            'user_lastName' => $user->user_lastName,
            'department' => $departmentdesc,
            'user_type' => $user->user_type,
            'action' => 'INSERTED user account with username: ' . $username . '. Full name: ' .  $first_name . ' ' . $last_name,

        ]);

        return redirect()->route('misUsersManagementResource.index')->with('success', 'User Added Successfully');
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
        $users = DB::table('users')
            ->select('users.*', 'departments.dept_desc')
            ->join('departments', 'users.dept_code', '=', 'departments.dept_code')
            ->where('users.user_id', $id)
            ->get();

        $departments = DB::table('departments')->get();

        return view('mis.misUsersManagementEditPage', ['users' => $users, 'departments' => $departments]);
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

        DB::table('users')->where('user_id', $id)->update([
            'user_username' => $username,
            'user_password' => Hash::make($password),
            'user_type' => $usertype,
            'user_firstName' => $first_name,
            'user_lastName' => $last_name,
            'user_sex' => $sex,
            'user_birthday' => $userBirthday,
            'user_address' => $address,
            'dept_code' => $dept_code,
            'updated_at' => now(),
        ]);

        $user_id = session('user_id');
        $user = DB::table('users')->where('user_id', $user_id)->first();
        $departmentdesc = DB::table('departments')->where('dept_code', $user->dept_code)->value('dept_desc');

        DB::table('histories')->insert([
            'user_id' => $user->user_id,
            'user_firstName' => $user->user_firstName,
            'user_lastName' => $user->user_lastName,
            'department' => $departmentdesc,
            'user_type' => $user->user_type,
            'action' => 'UPDATED user account with username: ' . $username . '. Full name: ' .  $first_name . ' ' . $last_name,
        ]);



        return redirect()->route('misUsersManagementResource.index')->with('success', 'User Credentials Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {


        $userDel = DB::table('users')->where('user_id', $id)->first();
        $userDel_username = $userDel->user_username;
        $userDel_firstName = $userDel->user_firstName;
        $userDel_lastName = $userDel->user_lastName;
        $user_id = session('user_id');
        $user = DB::table('users')->where('user_id', $user_id)->first();
        $departmentdesc = DB::table('departments')->where('dept_code', $user->dept_code)->value('dept_desc');

        DB::table('histories')->insert([
            'user_id' => $user->user_id,
            'user_firstName' => $user->user_firstName,
            'user_lastName' => $user->user_lastName,
            'department' => $departmentdesc,
            'user_type' => $user->user_type,
            'action' => 'DELETED user account with username: ' . $userDel_username . '. Full name: ' .  $userDel_firstName . ' ' . $userDel_lastName,
        ]);

        DB::delete('DELETE FROM users WHERE user_id = ?', [$id]);

        return redirect()->route('misUsersManagementResource.index')->with('warning', 'User Deleted');
    }
}
