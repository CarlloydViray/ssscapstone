<?php

namespace App\Http\Controllers;

use App\Exports\csExport;
use App\Imports\csImport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Validators\ValidationException;

class misCurricularSubjectsManagement extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $campus_code = session('campus_code');
        $campuses = DB::table('campus')
            ->where('campus_code', '!=', 'MAIN')
            ->get();



        if ($campus_code == 'MAIN') {
            $c_subjects = DB::table('curricular_subjects')
                ->join('curriculum', 'curricular_subjects.curriculum_id', '=', 'curriculum.curriculum_id')
                ->join('subjects', 'curricular_subjects.subject_code', '=', 'subjects.subject_code')
                ->get();

            $curriculums = DB::table('curriculum')->get();

            $subjects = DB::table('subjects')->get();
        } else {

            $c_subjects = DB::table('curricular_subjects')
                ->join('curriculum', 'curricular_subjects.curriculum_id', '=', 'curriculum.curriculum_id')
                ->join('subjects', 'curricular_subjects.subject_code', '=', 'subjects.subject_code')
                ->where('curriculum.campus_code', '=', $campus_code)
                ->get();

            $curriculums = DB::table('curriculum')
                ->where('campus_code', '=', $campus_code)
                ->get();

            $subjects = DB::table('subjects')
                ->where('campus_code', '=', $campus_code)
                ->get();
        }





        return view('mis.misCurricularSubjectsManagementPage', ['c_subjects' => $c_subjects, 'curriculums' => $curriculums, 'subjects' => $subjects, 'campuses' => $campuses]);
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
            'curriculum_id' => 'required',
            'subject_code' => 'required|array', // 'subject_code' should be an array
            'subject_code.*' => 'exists:subjects,subject_code',
            'cs_semesterOffered' => 'required',
            'cs_yearLevel' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->route('misCSubjectsManagementResource.index')
                ->withErrors($validator, 'curricularValidation')
                ->withInput()
                ->with('warning', 'Validation Error');
        } else {
            $curriculum_id = $request->input('curriculum_id');
            $subject_codes = $request->input('subject_code');
            $cs_semesterOffered = $request->input('cs_semesterOffered');
            $cs_yearLevel = $request->input('cs_yearLevel');

            $curriculums = DB::table('curriculum')
                ->where('curriculum_id', $curriculum_id)
                ->first();

            $curriculumDesc = $curriculums->curriculum_desc;

            // Insert each selected subject_code separately
            foreach ($subject_codes as $subject_code) {
                DB::table('curricular_subjects')->insert([
                    'curriculum_id' => $curriculum_id,
                    'subject_code' => $subject_code,
                    'cs_semesterOffered' => $cs_semesterOffered,
                    'cs_yearLevel' => $cs_yearLevel,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

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

            return redirect()->route('misCSubjectsManagementResource.index')->with('success', 'Curricular Subject(s) Added Successfully');
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



        $campus_code = session('campus_code');

        if ($campus_code == 'MAIN') {

            $c_subjects = DB::table('curricular_subjects')
                ->where('cs_id', $id)
                ->get();


            $curriculums = DB::table('curriculum')->get();


            $subjects = DB::table('subjects')->get();
        } else {

            $c_subjects = DB::table('curricular_subjects')
                ->where('cs_id', $id)
                ->get();

            $curriculums = DB::table('curriculum')
                ->where('campus_code', '=', $campus_code)
                ->get();

            $subjects = DB::table('subjects')
                ->where('campus_code', '=', $campus_code)
                ->get();
        }



        // dd($c_subjects);

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

    public function filterCampusCS(Request $request)
    {
        $campus_code = $request->input('campus');
        $semester = $request->input('semester');
        $yearLevel = $request->input('yearLevel');


        $filtered_cs = DB::table('curricular_subjects')
            ->join('curriculum', 'curricular_subjects.curriculum_id', '=', 'curriculum.curriculum_id')
            ->join('subjects', 'curricular_subjects.subject_code', '=', 'subjects.subject_code')
            ->where('curriculum.campus_code', '=', $campus_code)
            ->where('curricular_subjects.cs_semesterOffered', '=', $semester)
            ->where('curricular_subjects.cs_yearLevel', '=', $yearLevel)
            ->get();

        return response()->json(['$filtered_cs' => $filtered_cs]);
    }

    public function allCS()
    {
        $all_cs = DB::table('curricular_subjects')
            ->join('curriculum', 'curricular_subjects.curriculum_id', '=', 'curriculum.curriculum_id')
            ->join('subjects', 'curricular_subjects.subject_code', '=', 'subjects.subject_code')

            ->get();


        return response()->json($all_cs);
    }

    public function import()
    {
        try {
            Excel::import(new csImport, request()->file('file'));
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
        return Excel::download(new csExport, 'curricularSubs_' . now() . '.xlsx');
    }
}
