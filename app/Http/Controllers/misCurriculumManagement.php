<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class misCurriculumManagement extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $curriculum = DB::table('curriculum')->get();


        return view('mis.misCurriculumManagementPage', ['curriculums' => $curriculum]);
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
            'curriculum' => 'required',
        ]);

        $curriculum = $request->input('curriculum');

        DB::table('curriculum')->insert([
            'curriculum_desc' => $curriculum,
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
            'action' => 'INSERTED Curriculum with curriculum description: ' . $curriculum,

        ]);

        return redirect()->route('misCurriculumManagementResource.index')->with('success', 'Curriculum Added Successfully');
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
        $curriculum = DB::table('curriculum')
            ->where('curriculum_id', $id)
            ->get();


        return view('mis.misCurriculumManagementEditPage', ['curriculums' => $curriculum]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'curriculum' => 'required',
        ]);

        $curriculum = $request->input('curriculum');

        DB::table('curriculum')->where('curriculum_id', $id)->update([
            'curriculum_desc' => $curriculum,
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
            'action' => 'UPDATED curriculum with curriculum description: ' . $curriculum,
        ]);



        return redirect()->route('misCurriculumManagementResource.index')->with('success', 'Curriculum Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $curriculumDel = DB::table('curriculum')->where('curriculum_id', $id)->first();
        $curriculumDel_desc = $curriculumDel->curriculum_desc;
        $user_id = session('user_id');
        $user = DB::table('users')->where('user_id', $user_id)->first();
        $departmentdesc = DB::table('departments')->where('dept_code', $user->dept_code)->value('dept_desc');

        DB::table('histories')->insert([
            'user_id' => $user->user_id,
            'user_firstName' => $user->user_firstName,
            'user_lastName' => $user->user_lastName,
            'department' => $departmentdesc,
            'user_type' => $user->user_type,
            'action' => 'DELETED curriculum: ' . $curriculumDel_desc,
        ]);

        DB::delete('DELETE FROM curriculum WHERE curriculum_id = ?', [$id]);

        return redirect()->route('misCurriculumManagementResource.index')->with('success', 'Curriculum Deleted Successfully');
    }
}
