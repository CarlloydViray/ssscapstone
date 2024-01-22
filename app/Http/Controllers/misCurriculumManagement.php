<?php

namespace App\Http\Controllers;

use App\Exports\CurriculumExport;
use App\Imports\CurriculumImport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Validators\ValidationException;

class misCurriculumManagement extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $campus_code = session('campus_code');
        $dept_code = session('dept_code');

        if ($campus_code == 'MAIN') {
            $curriculums = DB::table('curriculum')
                ->join('departments', 'curriculum.dept_code', '=', 'departments.dept_code')
                ->get();

            $departments = DB::table('departments')
                ->where('dept_desc', '!=', 'ADMIN')
                ->where('dept_type', '!=', 'mis')
                ->get();

            $campuses = DB::table('campus')
                ->where('campus_code', '!=', 'MAIN')
                ->get();
        } else {
            $curriculums = DB::table('curriculum')
                ->join('departments', 'curriculum.dept_code', '=', 'departments.dept_code')
                ->where('curriculum.campus_code', '=', $campus_code)
                ->get();


            $departments = DB::table('departments')
                ->where('dept_desc', '!=', 'ADMIN')
                ->where('campus_code', '=', $campus_code)
                ->where('dept_type', '!=', 'mis')
                ->where('dept_code', '!=', $dept_code)
                ->get();

            $campuses = DB::table('campus')
                ->where('campus_code', '!=', 'MAIN')
                ->where('campus_code', '=', $campus_code)
                ->get();
        }



        return view('mis.misCurriculumManagementPage', ['curriculums' => $curriculums, 'departments' => $departments, 'campuses' => $campuses]);
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
            'curriculum_desc' => 'required',
            'curriculum_idYear' => 'required|numeric',
            'campus_code' => 'required',
            'department' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()
                ->route('misCurriculumManagementResource.index')
                ->withErrors($validator, 'curriculumValidation')
                ->with('warning', 'Validation Error');
        } else {

            $curriculum_desc = $request->input('curriculum_desc');
            $department = $request->input('department');
            $curriculum_idYear = $request->input('curriculum_idYear');
            $campus_code = $request->input('campus_code');

            DB::table('curriculum')->insert([
                'curriculum_desc' => $curriculum_desc,
                'curriculum_idYear' => $curriculum_idYear,
                'dept_code' => $department,
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
                'action' => 'INSERTED Curriculum with curriculum description: ' . $curriculum_desc,

            ]);

            return redirect()->route('misCurriculumManagementResource.index')->with('success', 'Curriculum Added Successfully');
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
        $dept_code = session('dept_code');

        if ($campus_code == 'MAIN') {
            $curriculums = DB::table('curriculum')
                ->where('curriculum_id', $id)
                ->get();

            $departments = DB::table('departments')
                ->where('dept_desc', '!=', 'ADMIN')
                ->where('dept_type', '!=', 'mis')
                ->get();

            $campuses = DB::table('campus')
                ->where('campus_code', '!=', 'MAIN')
                ->get();
        } else {
            $curriculums = DB::table('curriculum')
                ->where('curriculum_id', $id)
                ->get();


            $departments = DB::table('departments')
                ->where('dept_desc', '!=', 'ADMIN')
                ->where('campus_code', '=', $campus_code)
                ->where('dept_code', '!=', $dept_code)
                ->where('dept_type', '!=', 'mis')
                ->get();

            $campuses = DB::table('campus')
                ->where('campus_code', '!=', 'MAIN')
                ->where('campus_code', '=', $campus_code)
                ->get();
        }



        return view('mis.misCurriculumManagementEditPage', ['curriculums' => $curriculums, 'departments' => $departments, 'campuses' => $campuses]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'curriculum_desc' => 'required',
            'curriculum_idYear' => 'required|numeric',
            'campus_code' => 'required',
            'department' => 'required'
        ]);

        $curriculum_desc = $request->input('curriculum_desc');
        $department = $request->input('department');
        $curriculum_idYear = $request->input('curriculum_idYear');
        $campus_code = $request->input('campus_code');

        DB::table('curriculum')->where('curriculum_id', $id)->update([
            'curriculum_desc' => $curriculum_desc,
            'curriculum_idYear' => $curriculum_idYear,
            'dept_code' => $department,
            'campus_code' => $campus_code,
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
            'action' => 'UPDATED curriculum with curriculum description: ' . $curriculum_desc . ' -- ' . $campus_code,
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

    public function filterCampusCurriculum(Request $request)
    {
        $campus_code = $request->input('campus');

        $filteredCurriculums = DB::table('curriculum')
            ->join('departments', 'curriculum.dept_code', '=', 'departments.dept_code')
            ->where('curriculum.campus_code', '=', $campus_code)
            ->get();

        return response()->json(['filteredCurriculums' => $filteredCurriculums]);
    }

    public function allCurriculum()
    {
        $allCurriculums = DB::table('curriculum')
            ->join('departments', 'curriculum.dept_code', '=', 'departments.dept_code')
            ->get();


        return response()->json($allCurriculums);
    }

    public function getDepartments($campusCode)
    {

        $departments = DB::table('departments')
            ->where('campus_code', $campusCode)
            ->where('dept_type', '!=', 'mis')
            ->get();

        return response()->json(['departments' => $departments]);
    }

    public function import()
    {
        try {
            Excel::import(new CurriculumImport, request()->file('file'));
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
        return Excel::download(new CurriculumExport, 'curriculum_' . now() . '.xlsx');
    }
}
