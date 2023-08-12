<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class misFacultyManagement extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $faculties = DB::table('faculty')
            ->join('departments', 'faculty.dept_code', '=', 'departments.dept_code')
            ->get();

        $departments = DB::table('departments')
            ->where('dept_desc', '!=', 'ADMIN')
            ->get();

        return view('mis.misFacultyManagementPage', ['faculties' => $faculties, 'departments' => $departments]);
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
            'faculty_firstName' => 'required',
            'faculty_lastName' => 'required',
            'dept_code' => 'required',
            'faculty_position' => 'required',
            'faculty_birthDate' => 'required|date',
            'faculty_sex' => 'required',
            'faculty_address' => 'required',
        ]);


        $faculty_firstName = $request->input('faculty_firstName');
        $faculty_lastName = $request->input('faculty_lastName');
        $dept_code = $request->input('dept_code');
        $faculty_position = $request->input('faculty_position');
        $faculty_birthDate = $request->input('faculty_birthDate');
        $faculty_sex = $request->input('faculty_sex');
        $faculty_address = $request->input('faculty_address');

        DB::table('faculty')->insert([
            'faculty_firstName' => $faculty_firstName,
            'faculty_lastName' => $faculty_lastName,
            'dept_code' => $dept_code,
            'faculty_position' => $faculty_position,
            'faculty_birthDate' => $faculty_birthDate,
            'faculty_sex' => $faculty_sex,
            'faculty_address' => $faculty_address,
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
            'action' => 'INSERTED Faculty. Full name: ' .  $faculty_firstName . ' ' . $faculty_lastName,

        ]);

        return redirect()->route('misFacultyManagementResource.index')->with('success', 'Faculty Added Successfully');
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
        $faculties = DB::table('faculty')
            ->join('departments', 'faculty.dept_code', '=', 'departments.dept_code')
            ->where('faculty.faculty_id', $id)
            ->get();

        $departments = DB::table('departments')
            ->where('dept_desc', '!=', 'ADMIN')
            ->get();

        return view('mis.misFacultyManagementEditPage', ['faculties' => $faculties, 'departments' => $departments]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'faculty_firstName' => 'required',
            'faculty_lastName' => 'required',
            'dept_code' => 'required',
            'faculty_position' => 'required',
            'faculty_birthDate' => 'required|date',
            'faculty_sex' => 'required',
            'faculty_address' => 'required',
        ]);


        $faculty_firstName = $request->input('faculty_firstName');
        $faculty_lastName = $request->input('faculty_lastName');
        $dept_code = $request->input('dept_code');
        $faculty_position = $request->input('faculty_position');
        $faculty_birthDate = $request->input('faculty_birthDate');
        $faculty_sex = $request->input('faculty_sex');
        $faculty_address = $request->input('faculty_address');

        DB::table('faculty')->where('faculty_id', $id)->update([
            'faculty_firstName' => $faculty_firstName,
            'faculty_lastName' => $faculty_lastName,
            'dept_code' => $dept_code,
            'faculty_position' => $faculty_position,
            'faculty_birthDate' => $faculty_birthDate,
            'faculty_sex' => $faculty_sex,
            'faculty_address' => $faculty_address,
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
            'action' => 'UPDATED Faculty. Full name: ' .  $faculty_firstName . ' ' . $faculty_lastName,
        ]);



        return redirect()->route('misFacultyManagementResource.index')->with('success', 'Faculty Credentials Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $facultyDel = DB::table('faculty')->where('faculty_id', $id)->first();
        $facultyDel_firstName = $facultyDel->faculty_firstName;
        $facultyDel_lastName = $facultyDel->faculty_lastName;
        $user_id = session('user_id');
        $user = DB::table('users')->where('user_id', $user_id)->first();
        $departmentdesc = DB::table('departments')->where('dept_code', $user->dept_code)->value('dept_desc');

        DB::table('histories')->insert([
            'user_id' => $user->user_id,
            'user_firstName' => $user->user_firstName,
            'user_lastName' => $user->user_lastName,
            'department' => $departmentdesc,
            'user_type' => $user->user_type,
            'action' => 'DELETED Faculty. Full name: ' .  $facultyDel_firstName . ' ' . $facultyDel_lastName,
        ]);

        DB::delete('DELETE FROM faculty WHERE faculty_id = ?', [$id]);

        return redirect()->route('misFacultyManagementResource.index')->with('warning', 'Faculty Deleted');
    }
}
