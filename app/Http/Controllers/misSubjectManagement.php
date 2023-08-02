<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class misSubjectManagement extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subject = DB::table('subjects')->get();


        return view('mis.misSubjectManagementPage', ['subjects' => $subject]);
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
            'subject_code' => 'required|max:20',
            'subject_desc' => 'required',
            'subject_units' => 'required',
        ]);


        $subjectCode = $request->input('subject_code');

        $existingSubject = DB::table('subjects')
            ->where('subject_code', $subjectCode)
            ->first();

        if ($existingSubject) {
            return redirect()->route('misSubjectManagementResource.index')->with('warning', 'Subject Code Already Exists');
        } else {
            $subjectDesc = $request->input('subject_desc');
            $subjectUnits = $request->input('subject_units');

            DB::table('subjects')->insert([
                'subject_code' => $subjectCode,
                'subject_desc' => $subjectDesc,
                'subject_units' => $subjectUnits,
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
                'action' => 'INSERTED Subject: ' . $subjectDesc,

            ]);
        }

        return redirect()->route('misSubjectManagementResource.index')->with('success', 'Subject Added Successfully');
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
        $subject = DB::table('subjects')
            ->where('subject_code', $id)
            ->get();


        return view('mis.misSubjectManagementEditPage', ['subjects' => $subject]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $this->validate($request, [
            'subject_code' => 'required|max:20',
            'subject_desc' => 'required',
            'subject_units' => 'required',
        ]);

        $subjectCode = $request->input('subject_code');
        $subjectDesc = $request->input('subject_desc');
        $subjectUnits = $request->input('subject_units');

        DB::table('subjects')->where('subject_code', $id)->update([
            'subject_code' => $subjectCode,
            'subject_desc' => $subjectDesc,
            'subject_units' => $subjectUnits,
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
            'action' => 'UPDATED Subject: ' . $subjectDesc,

        ]);

        return redirect()->route('misSubjectManagementResource.index')->with('success', 'Curriculum Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $subjectDel = DB::table('subjects')->where('subject_code', $id)->first();
        $subjectDel_desc = $subjectDel->subject_code;
        $user_id = session('user_id');
        $user = DB::table('users')->where('user_id', $user_id)->first();
        $departmentdesc = DB::table('departments')->where('dept_code', $user->dept_code)->value('dept_desc');

        DB::table('histories')->insert([
            'user_id' => $user->user_id,
            'user_firstName' => $user->user_firstName,
            'user_lastName' => $user->user_lastName,
            'department' => $departmentdesc,
            'user_type' => $user->user_type,
            'action' => 'DELETED subject: ' . $subjectDel_desc,
        ]);

        DB::delete('DELETE FROM subjects WHERE subject_code = ?', [$id]);

        return redirect()->route('misSubjectManagementResource.index')->with('success', 'Subject Deleted Successfully');
    }
}
