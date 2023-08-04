<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class misSectionManagement extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sections = DB::table('sections')
            ->join('departments', 'sections.dept_code', '=', 'departments.dept_code')
            ->select('sections.*', 'departments.dept_desc')
            ->get();

        $departments = DB::table('departments')->get();

        return view('mis.misSectionManagementPage', ['sections' => $sections, 'departments' => $departments]);
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
            'section_desc' => 'required|max:20',
            'dept_code' => 'required',
            'section_academicYear' => 'required',
            'section_yearLevel' => 'required',
            'section_semester' => 'required',
        ]);

        $section_desc = $request->input('section_desc');
        $dept_code = $request->input('dept_code');
        $section_academicYear = $request->input('section_academicYear');
        $section_yearLevel = $request->input('section_yearLevel');
        $section_semester = $request->input('section_semester');

        DB::table('sections')->insert([
            'section_desc' => $section_desc,
            'dept_code' => $dept_code,
            'section_academicYear' => $section_academicYear,
            'section_yearLevel' => $section_yearLevel,
            'section_semester' => $section_semester,
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
            'action' => 'INSERTED Section: ' . $section_desc,

        ]);


        return redirect()->route('misSectionManagementResource.index')->with('success', 'Section Added Successfully');
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
        $sections = DB::table('sections')
            ->where('section_id', $id)
            ->get();

        $departments = DB::table('departments')
            ->get();

        return view('mis.misSectionManagementEditPage', ['sections' => $sections, 'departments' => $departments]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'section_desc' => 'required|max:20',
            'dept_code' => 'required',
            'section_academicYear' => 'required',
            'section_yearLevel' => 'required',
            'section_semester' => 'required',
        ]);

        $section_desc = $request->input('section_desc');
        $dept_code = $request->input('dept_code');
        $section_academicYear = $request->input('section_academicYear');
        $section_yearLevel = $request->input('section_yearLevel');
        $section_semester = $request->input('section_semester');

        DB::table('sections')->where('section_id', $id)->update([
            'section_desc' => $section_desc,
            'dept_code' => $dept_code,
            'section_academicYear' => $section_academicYear,
            'section_yearLevel' => $section_yearLevel,
            'section_semester' => $section_semester,
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
            'action' => 'UPDATED Section: ' . $section_desc,

        ]);

        return redirect()->route('misSectionManagementResource.index')->with('success', 'Section Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $sectionDel = DB::table('sections')->where('section_id', $id)->first();
        $sectionDel_desc = $sectionDel->section_desc;

        $user_id = session('user_id');
        $user = DB::table('users')->where('user_id', $user_id)->first();
        $departmentdesc = DB::table('departments')->where('dept_code', $user->dept_code)->value('dept_desc');

        DB::table('histories')->insert([
            'user_id' => $user->user_id,
            'user_firstName' => $user->user_firstName,
            'user_lastName' => $user->user_lastName,
            'department' => $departmentdesc,
            'user_type' => $user->user_type,
            'action' => 'DELETED Section: ' . $sectionDel_desc,
        ]);

        DB::delete('DELETE FROM sections WHERE section_id = ?', [$id]);

        return redirect()->route('misSectionManagementResource.index')->with('success', 'Section Deleted Successfully');
    }
}
