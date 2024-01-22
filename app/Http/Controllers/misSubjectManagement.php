<?php

namespace App\Http\Controllers;

use App\Exports\SubjectExport;
use App\Imports\SubjectImport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Database\QueryException;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Validators\ValidationException;

class misSubjectManagement extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $campus_code = session('campus_code');

        if ($campus_code == 'MAIN') {
            $subjects = DB::table('subjects')
                ->get();

            $campuses = DB::table('campus')
                ->where('campus_code', '!=', 'MAIN')
                ->get();
        } else {

            $subjects = DB::table('subjects')
                ->where('campus_code', '=', $campus_code)
                ->get();

            $campuses = DB::table('campus')
                ->where('campus_code', '!=', 'MAIN')
                ->where('campus_code', '=', $campus_code)
                ->get();
        }

        return view('mis.misSubjectManagementPage', ['subjects' => $subjects, 'campuses' => $campuses]);
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
            'subject_code' => 'required|max:20',
            'subject_desc' => 'required',
            'subject_lab' => 'required|numeric|between:0,6',
            'subject_lec' => 'required|numeric|between:0,6',
            'campus_code' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->route('misSubjectManagementResource.index')
                ->withErrors($validator, 'subjectValidation')
                ->withInput()
                ->with('warning', 'Validation Error');
        } else {
            $subjectCode = $request->input('subject_code');

            $existingSubject = DB::table('subjects')
                ->where('subject_code', $subjectCode)
                ->first();

            if ($existingSubject) {
                return redirect()->route('misSubjectManagementResource.index')->with('warning', 'Subject Code Already Exists');
            } else {
                $subjectDesc = $request->input('subject_desc');
                $subject_lab = $request->input('subject_lab');
                $subject_lec = $request->input('subject_lec');
                $campus_code = $request->input('campus_code');

                DB::table('subjects')->insert([
                    'subject_code' => $subjectCode,
                    'subject_desc' => $subjectDesc,
                    'subject_lab' => $subject_lab,
                    'subject_lec' => $subject_lec,
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
                    'action' => 'INSERTED Subject: ' . $subjectDesc,

                ]);
            }

            return redirect()->route('misSubjectManagementResource.index')->with('success', 'Subject Added Successfully');
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
            $subject = DB::table('subjects')
                ->where('subject_code', $id)
                ->get();

            $campuses = DB::table('campus')
                ->where('campus_code', '!=', 'MAIN')
                ->get();
        } else {
            $subject = DB::table('subjects')
                ->where('subject_code', $id)
                ->get();

            $campuses = DB::table('campus')
                ->where('campus_code', '!=', 'MAIN')
                ->where('campus_code', '=', $campus_code)
                ->get();
        }


        return view('mis.misSubjectManagementEditPage', ['subjects' => $subject, 'campuses' => $campuses]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $this->validate($request, [
                'subject_code' => 'required|max:20',
                'subject_desc' => 'required',
                'subject_lab' => 'required|numeric',
                'subject_lec' => 'required|numeric',
            ]);

            $subjectCode = $request->input('subject_code');
            $subjectDesc = $request->input('subject_desc');
            $subject_lab = $request->input('subject_lab');
            $subject_lec = $request->input('subject_lec');

            DB::table('subjects')->where('subject_code', $id)->update([
                'subject_code' => $subjectCode,
                'subject_desc' => $subjectDesc,
                'subject_lab' => $subject_lab,
                'subject_lec' => $subject_lec,
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
        } catch (QueryException $e) {
            $errorCode = $e->errorInfo[1];
            if ($errorCode == 1451) {
                // Handle foreign key constraint violation
                return redirect()->route('misSubjectManagementResource.index')->with('error', 'Cannot update the subject code. It is referenced by other records.');
            }

            // Handle other database-related errors if needed
            return redirect()->back()->with('error', 'An error occurred while updating the subject.');
        }
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

    public function filterCampusSubjects(Request $request)
    {
        $campus_code = $request->input('campus');


        $filteredSubjects = DB::table('subjects')
            ->where('campus_code', '=', $campus_code)
            ->get();


        return response()->json(['filteredSubjects' => $filteredSubjects]);
    }

    public function allSubjects()
    {

        $allSubjects = DB::table('subjects')
            ->get();

        return response()->json($allSubjects);
    }

    public function import()
    {
        try {
            Excel::import(new SubjectImport, request()->file('file'));
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
        return Excel::download(new SubjectExport, 'subjects_' . now() . '.xlsx');
    }
}
