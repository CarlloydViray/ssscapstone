<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\UsersImport;
use App\Exports\UsersExport;
use DateTime;
use Maatwebsite\Excel\Validators\ValidationException;


class misUserManagement extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $campus_code = session('campus_code');
        $user_id = session('user_id');

        if ($campus_code == 'MAIN') {
            $users = DB::table('users')
                ->select('users.*', 'departments.dept_desc')
                ->join('departments', 'users.dept_code', '=', 'departments.dept_code')
                ->where('users.user_type', '!=', 'ADMIN')
                ->get();

            $departments = DB::table('departments')
                ->where('campus_code', '!=', 'MAIN')
                ->get();

            $campuses = DB::table('campus')
                ->where('campus_code', '!=', 'MAIN')
                ->get();
        } else {
            $users = DB::table('users')
                ->select('users.*', 'departments.dept_desc')
                ->join('departments', 'users.dept_code', '=', 'departments.dept_code')
                ->where('users.user_type', '!=', 'ADMIN')
                ->where('users.user_id', '!=', $user_id)
                ->where('users.campus_code', '=', $campus_code)
                ->get();

            $departments = DB::table('departments')
                ->where('campus_code', '=', $campus_code)
                ->get();

            $campuses = DB::table('campus')
                ->where('campus_code', '!=', 'MAIN')
                ->where('campus_code', '=', $campus_code)
                ->get();
        }

        return view('mis.misUsersManagementPage', ['users' => $users, 'departments' => $departments, 'campuses' => $campuses]);
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

        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'address' => 'required',
            'email' => 'required|email',
            'number' => 'required',
            'userBirthday' => 'required|date',
            'sex' => 'required',
            'usertype' => 'required',
            'dept_code' => 'required',
            'username' => 'required',
            'status' => 'required',
            'campus_code' => 'required',
            'password' => 'required|min:8',
            'password2' => 'required|same:password',
        ]);



        if ($validator->fails()) {
            return redirect()
                ->route('misUsersManagementResource.index')
                ->withErrors($validator, 'userValidation')
                ->withInput()
                ->with('warning', ' Password Validation Error');
        } else {

            $first_name = $request->input('first_name');
            $last_name = $request->input('last_name');
            $number = $request->input('number');
            $email = $request->input('email');
            $address = $request->input('address');
            $userBirthday = $request->input('userBirthday');
            $sex = $request->input('sex');
            $usertype = $request->input('usertype');
            $dept_code = $request->input('dept_code');
            $status = $request->input('status');
            $campus_code = $request->input('campus_code');
            $username = $request->input('username');
            $password = $request->input('password');

            $users = DB::table('users')
                ->select('users.*', 'departments.dept_desc')
                ->join('departments', 'users.dept_code', '=', 'departments.dept_code') // Assuming a join with the 'departments' table based on 'dept_code'
                ->where('user_firstName', '=', $first_name)
                ->where('user_lastName', '=', $last_name)
                ->where('user_address', '=', $address)
                ->where('user_birthday', '=', $userBirthday)
                ->where('user_sex', '=', $sex)
                ->where('user_username', '=', $username)
                ->get();

            if ($users->isEmpty()) {

                DB::table('users')->insert([
                    'user_username' => $username,
                    'user_password' => Hash::make($password),
                    'user_type' => $usertype,
                    'user_email' => $email,
                    'user_number' => $number,
                    'user_firstName' => $first_name,
                    'user_lastName' => $last_name,
                    'user_sex' => $sex,
                    'user_birthday' => $userBirthday,
                    'user_address' => $address,
                    'dept_code' => $dept_code,
                    'user_status' =>  $status,
                    'campus_code' => $campus_code,
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
            } else {
                return redirect()
                    ->route('misUsersManagementResource.index')
                    ->with('warning', 'User already exists!');
            }
        }
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

        $campus_code = session('campus_code');
        $user_type = session('user_type');
        if ($campus_code == 'MAIN') {

            $departments = DB::table('departments')
                ->where('dept_desc', '!=', 'ADMIN')
                ->get();

            $campuses = DB::table('campus')
                ->where('campus_code', '!=', 'MAIN')
                ->get();
        } else {
            $departments = DB::table('departments')
                ->where('campus_code', '=', $campus_code)
                ->get();

            $campuses = DB::table('campus')
                ->where('campus_code', '!=', 'MAIN')
                ->where('campus_code', '=', $campus_code)
                ->get();
        }

        return view('mis.misUsersManagementEditPage', ['users' => $users, 'departments' => $departments, 'campuses' => $campuses]);
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

        return redirect()->route('misUsersManagementResource.index')->with('success', 'User Deleted');
    }

    public function filterCampusUser(Request $request)
    {
        $campus_code = $request->input('campus');


        $filteredUsers = DB::table('users')
            ->select('users.*', 'departments.dept_desc')
            ->join('departments', 'users.dept_code', '=', 'departments.dept_code')
            ->where('users.user_type', '!=', 'ADMIN')
            ->where('users.campus_code', '=', $campus_code)
            ->get();

        return response()->json(['filteredUsers' => $filteredUsers]);
    }

    public function allUsers()
    {
        $campus_code = session('campus_code');
        if ($campus_code == 'MAIN') {
            $allCampus = DB::table('users')
                ->select('users.*', 'departments.dept_desc')
                ->join('departments', 'users.dept_code', '=', 'departments.dept_code')
                ->where('users.user_type', '!=', 'ADMIN')
                ->get();
        } else {
            $allCampus = DB::table('users')
                ->select('users.*', 'departments.dept_desc')
                ->join('departments', 'users.dept_code', '=', 'departments.dept_code')
                ->where('users.user_type', '!=', 'ADMIN')
                ->where('users.campus_code', '=', $campus_code)
                ->get();
        }


        return response()->json($allCampus);
    }

    public function getDepartments($campusCode, $userType)
    {

        $departments = DB::table('departments')
            ->where('campus_code', $campusCode)
            ->where('dept_type', $userType)
            ->get();

        return response()->json(['departments' => $departments]);
    }

    public function import()
    {
        try {
            Excel::import(new UsersImport, request()->file('file'));
        } catch (ValidationException $e) {
            $failures = $e->failures(); // Get validation failures
            // Handle validation failures, you can log them or display an error message

            return redirect()->back()->withErrors($failures)->withInput();
        } catch (\Exception $e) {
            // Handle other exceptions
            return redirect()->back()->with('error', 'An error occurred during the import.');
        }

        return redirect()->back()->with('success', 'Import completed successfully.');
    }

    public function export()
    {
        return Excel::download(new UsersExport, 'users_' . now() . '.xlsx');
    }
}
