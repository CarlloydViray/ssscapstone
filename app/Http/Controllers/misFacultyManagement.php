<?php

namespace App\Http\Controllers;

use App\Exports\FacultyExport;
use App\Imports\FacultyImport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Validators\ValidationException;

class misFacultyManagement extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $campus_code = session('campus_code');
        $dept_code = session('dept_code');

        if ($campus_code == 'MAIN') {
            $faculties = DB::table('faculty')
                ->join('departments', 'faculty.dept_code', '=', 'departments.dept_code')
                ->join('campus', 'departments.campus_code', '=', 'campus.campus_code')
                ->join('designations', 'faculty.designation_id', '=', 'designations.designation_id')
                ->get();

            $departments = DB::table('departments')
                ->where('dept_desc', '!=', 'ADMIN')
                ->where('dept_type', '!=', 'mis')
                ->get();

            $campuses = DB::table('campus')
                ->where('campus_code', '!=', 'MAIN')
                ->get();
        } else {
            $faculties = DB::table('faculty')
                ->join('departments', 'faculty.dept_code', '=', 'departments.dept_code')
                ->join('campus', 'departments.campus_code', '=', 'campus.campus_code')
                ->join('designations', 'faculty.designation_id', '=', 'designations.designation_id')
                ->where('faculty.campus_code', '=', $campus_code)
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

        $designations = DB::table('designations')
            ->get();

        return view('mis.misFacultyManagementPage', ['faculties' => $faculties, 'departments' => $departments, 'campuses' => $campuses, 'designations' => $designations]);
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
            'faculty_firstName' => 'required',
            'faculty_lastName' => 'required',
            'dept_code' => 'required',
            'designation_id' => 'required',
            'faculty_birthDate' => 'required|date',
            'faculty_sex' => 'required',
            'faculty_address' => 'required',
            'campus_code' => 'required',
            'status' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->route('misFacultyManagementResource.index')
                ->withErrors($validator, 'facultyValidation')
                ->with('warning', 'Validation Error');
        } else {
            $faculty_firstName = $request->input('faculty_firstName');
            $faculty_lastName = $request->input('faculty_lastName');
            $dept_code = $request->input('dept_code');
            $designation_id = $request->input('designation_id');
            $faculty_birthDate = $request->input('faculty_birthDate');
            $faculty_sex = $request->input('faculty_sex');
            $faculty_address = $request->input('faculty_address');
            $campus_code = $request->input('campus_code');
            $status = $request->input('status');

            DB::table('faculty')->insert([
                'faculty_firstName' => $faculty_firstName,
                'faculty_lastName' => $faculty_lastName,
                'dept_code' => $dept_code,
                'designation_id' => $designation_id,
                'faculty_birthDate' => $faculty_birthDate,
                'faculty_sex' => $faculty_sex,
                'faculty_address' => $faculty_address,
                'campus_code' => $campus_code,
                'faculty_status' =>  $status,
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
            ->join('campus', 'departments.campus_code', '=', 'campus.campus_code')
            ->where('faculty.faculty_id', '=', $id)
            ->select('faculty.*', 'campus.campus_code as campus_code_campus')
            ->get();


        $departments = DB::table('departments')
            ->where('dept_desc', '!=', 'ADMIN')
            ->get();

        $campuses = DB::table('campus')
            ->where('campus_code', '!=', 'MAIN')
            ->get();

        $designations = DB::table('designations')
            ->get();

        return view('mis.misFacultyManagementEditPage', ['faculties' => $faculties, 'departments' => $departments, 'campuses' => $campuses, 'designations' => $designations]);
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
            'faculty_birthDate' => 'required|date',
            'faculty_sex' => 'required',
            'faculty_address' => 'required',
            'status' => 'required',
            'campus_code' => 'required',
            'designation_id' => 'required',
        ]);

        $faculty_firstName = $request->input('faculty_firstName');
        $faculty_lastName = $request->input('faculty_lastName');
        $dept_code = $request->input('dept_code');
        $faculty_birthDate = $request->input('faculty_birthDate');
        $faculty_sex = $request->input('faculty_sex');
        $faculty_address = $request->input('faculty_address');
        $status = $request->input('status');
        $campus_code = $request->input('campus_code');
        $designation_id = $request->input('designation_id');


        DB::table('faculty')->where('faculty_id', $id)->update([
            'faculty_firstName' => $faculty_firstName,
            'faculty_lastName' => $faculty_lastName,
            'dept_code' => $dept_code,
            'faculty_birthDate' => $faculty_birthDate,
            'designation_id' => $designation_id,
            'faculty_sex' => $faculty_sex,
            'faculty_address' => $faculty_address,
            'faculty_status' =>  $status,
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

        return redirect()->route('misFacultyManagementResource.index')->with('success', 'Faculty Deleted');
    }

    public function filterCampusFaculty(Request $request)
    {
        $campus_code = $request->input('campus');


        $filteredFaculties = DB::table('faculty')
            ->join('departments', 'faculty.dept_code', '=', 'departments.dept_code')
            ->join('campus', 'departments.campus_code', '=', 'campus.campus_code')
            ->where('campus.campus_code', '=',  $campus_code)
            ->get();

        return response()->json(['filteredFaculties' => $filteredFaculties]);
    }

    public function allFaculty()
    {

        $allFaculties = DB::table('faculty')
            ->join('departments', 'faculty.dept_code', '=', 'departments.dept_code')
            ->join('campus', 'departments.campus_code', '=', 'campus.campus_code')
            ->get();


        return response()->json($allFaculties);
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
        // try {

        // } catch (ValidationException $e) {
        //     $failures = $e->failures(); // Get validation failures
        //     // Handle validation failures, you can log them or display an error message

        //     return redirect()->back()->withErrors($failures)->withInput();
        // } catch (\Exception $e) {
        //     // Handle other exceptions
        //     return redirect()->back()->with('error', 'An error occurred during the import.');
        // }
        Excel::import(new FacultyImport, request()->file('file'));
        return redirect()->back()->with('success', 'Import completed successfully.');
    }

    public function export()
    {
        return Excel::download(new FacultyExport, 'faculty_' . now() . '.xlsx');
    }
}
