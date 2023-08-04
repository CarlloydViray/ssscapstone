<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class misCurricularSubjectsManagement extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $c_subjects = DB::table('curricular_subjects')
            ->join('curriculum', 'curricular_subjects.curriculum_id', '=', 'curriculum.curriculum_id')
            ->join('subjects', 'curricular_subjects.subject_code', '=', 'subjects.subject_code')
            ->get();

        $curriculums = DB::table('curriculum')->get();

        $subjects = DB::table('subjects')->get();


        return view('mis.misCurricularSubjectsManagementPage', ['c_subjects' => $c_subjects, 'curriculums' => $curriculums, 'subjects' => $subjects]);
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
            'curriculum_id' => 'required',
            'subject_code' => 'required',
            'cs_semesterOffered' => 'required',
            'cs_yearLevel' => 'required',
        ]);

        $curriculum_id = $request->input('curriculum_id');
        $subject_code = $request->input('subject_code');
        $cs_semesterOffered = $request->input('cs_semesterOffered');
        $cs_yearLevel = $request->input('cs_yearLevel');

        $curriculums = DB::table('curriculum')
            ->where('curriculum_id', $curriculum_id)
            ->first();

        $curriculumDesc = $curriculums->curriculum_desc;

        DB::table('curricular_subjects')->insert([
            'curriculum_id' => $curriculum_id,
            'subject_code' => $subject_code,
            'cs_semesterOffered' => $cs_semesterOffered,
            'cs_yearLevel' => $cs_yearLevel,
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
            'action' => 'INSERTED Subject: ' . $curriculumDesc,

        ]);


        return redirect()->route('misCSubjectsManagementResource.index')->with('success', 'Curricular Subject Added Successfully');
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
        $c_subjects = DB::table('curricular_subjects')
            ->where('cs_id', $id)
            ->get();

        $curriculums = DB::table('curriculum')->get();

        $subjects = DB::table('subjects')->get();


        return view('mis.misCurricularSubjectsManagementEditPage', ['c_subjects' => $c_subjects, 'curriculums' => $curriculums, 'subjects' => $subjects]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'curriculum_id' => 'required',
            'subject_code' => 'required',
            'cs_semesterOffered' => 'required',
            'cs_yearLevel' => 'required',
        ]);

        $curriculum_id = $request->input('curriculum_id');
        $subject_code = $request->input('subject_code');
        $cs_semesterOffered = $request->input('cs_semesterOffered');
        $cs_yearLevel = $request->input('cs_yearLevel');

        DB::table('curricular_subjects')->where('cs_id', $id)->update([
            'curriculum_id' => $curriculum_id,
            'subject_code' => $subject_code,
            'cs_semesterOffered' => $cs_semesterOffered,
            'cs_yearLevel' => $cs_yearLevel,
            'updated_at' => now(),
        ]);

        $curriculums = DB::table('curriculum')
            ->where('curriculum_id', $curriculum_id)
            ->first();

        $curriculumDesc = $curriculums->curriculum_desc;

        $user_id = session('user_id');
        $user = DB::table('users')->where('user_id', $user_id)->first();
        $departmentdesc = DB::table('departments')->where('dept_code', $user->dept_code)->value('dept_desc');

        DB::table('histories')->insert([
            'user_id' => $user->user_id,
            'user_firstName' => $user->user_firstName,
            'user_lastName' => $user->user_lastName,
            'department' => $departmentdesc,
            'user_type' => $user->user_type,
            'action' => 'UPDATED Curricular Subject: ' . $curriculumDesc,

        ]);

        return redirect()->route('misCSubjectsManagementResource.index')->with('success', 'Curricular Subject Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $CSDel = DB::table('curricular_subjects')->where('cs_id', $id)->first();
        $CSDel_id = $CSDel->cs_id;
        $user_id = session('user_id');
        $user = DB::table('users')->where('user_id', $user_id)->first();
        $departmentdesc = DB::table('departments')->where('dept_code', $user->dept_code)->value('dept_desc');

        DB::table('histories')->insert([
            'user_id' => $user->user_id,
            'user_firstName' => $user->user_firstName,
            'user_lastName' => $user->user_lastName,
            'department' => $departmentdesc,
            'user_type' => $user->user_type,
            'action' => 'DELETED Curricular Subject ID: ' . $CSDel_id,
        ]);

        DB::delete('DELETE FROM curricular_subjects WHERE cs_id = ?', [$id]);

        return redirect()->route('misCSubjectsManagementResource.index')->with('success', 'Curricular Subject Deleted Successfully');
    }
}
