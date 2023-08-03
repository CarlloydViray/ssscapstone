<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class misDepartmentManagement extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $departments = DB::table('departments')
            ->where('dept_desc', '!=', 'ADMIN')
            ->get();

        return view('mis.misDepartmentManagementPage', ['departments' => $departments]);
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
            'dept_code' => 'required|max:20',
            'dept_desc' => 'required',
        ]);


        $dept_code = $request->input('dept_code');

        $existingDepartment = DB::table('departments')
            ->where('dept_code', $dept_code)
            ->first();

        if ($existingDepartment) {
            return redirect()->route('misDepartmentManagementResource.index')->with('warning', 'Department Code Already Exists');
        } else {

            $dept_desc = $request->input('dept_desc');


            DB::table('departments')->insert([
                'dept_code' => $dept_code,
                'dept_desc' => $dept_desc,
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
                'action' => 'INSERTED Department: ' . $dept_desc,

            ]);
        }

        return redirect()->route('misDepartmentManagementResource.index')->with('success', 'Department Added Successfully');
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
        $departments = DB::table('departments')
            ->where('dept_code', $id)
            ->get();

        return view('mis.misDepartmentManagementEditPage', ['departments' => $departments]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'dept_code' => 'required|max:20',
            'dept_desc' => 'required',
        ]);

        $dept_code = $request->input('dept_code');
        $dept_desc = $request->input('dept_desc');


        DB::table('departments')->where('dept_code', $id)->update([
            'dept_code' => $dept_code,
            'dept_desc' => $dept_desc,
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
            'action' => 'UPDATED Department: ' . $dept_desc,

        ]);

        return redirect()->route('misDepartmentManagementResource.index')->with('success', 'Department Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $departmentDel = DB::table('departments')->where('dept_code', $id)->first();
        $departmentDel_desc = $departmentDel->dept_desc;

        $user_id = session('user_id');
        $user = DB::table('users')->where('user_id', $user_id)->first();
        $departmentdesc = DB::table('departments')->where('dept_code', $user->dept_code)->value('dept_desc');

        DB::table('histories')->insert([
            'user_id' => $user->user_id,
            'user_firstName' => $user->user_firstName,
            'user_lastName' => $user->user_lastName,
            'department' => $departmentdesc,
            'user_type' => $user->user_type,
            'action' => 'DELETED Room: ' . $departmentDel_desc,
        ]);

        DB::delete('DELETE FROM departments WHERE dept_code = ?', [$id]);

        return redirect()->route('misDepartmentManagementResource.index')->with('success', 'Department Deleted Successfully');
    }
}
