<?php

namespace App\Http\Controllers;

use App\Exports\DepartmentExport;
use App\Imports\DepartmentImport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\QueryException;
use Maatwebsite\Excel\Validators\ValidationException;
use Maatwebsite\Excel\Facades\Excel;


class misDepartmentManagement extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $campus_code = session('campus_code');
        $dept_code = session('dept_code');
        if ($campus_code == 'MAIN') {

            $campuses = DB::table('campus')
                ->where('campus_code', '!=', 'MAIN')
                ->get();


            $departments = DB::table('departments')
                ->where('dept_code', '!=', 'ADMIN')
                ->get();
        } else {
            $departments = DB::table('departments')
                ->where('dept_code', '!=', 'ADMIN')
                ->where('campus_code', '=', $campus_code)
                ->where('dept_code', '!=', $dept_code)
                ->get();

            $campuses = DB::table('campus')
                ->where('campus_code', '!=', 'MAIN')
                ->where('campus_code', '=', $campus_code)
                ->get();
        }



        return view('mis.misDepartmentManagementPage', ['departments' => $departments, 'campuses' => $campuses]);
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
            'dept_code' => 'required',
            'dept_desc' => 'required',
            'dept_type' => 'required',
            'campus_code' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->route('misDepartmentManagementResource.index')
                ->withErrors($validator, 'departmentValidation')
                ->with('warning', 'Validation Error');
        } else {

            $dept_code = $request->input('dept_code');


            $existingDepartment = DB::table('departments')
                ->where('dept_code', $dept_code)
                ->first();

            if ($existingDepartment) {
                return redirect()->route('misDepartmentManagementResource.index')->with('warning', 'Department Code Already Exists');
            } else {

                $dept_type = $request->input('dept_type');
                $dept_desc = $request->input('dept_desc');
                $campus_code = $request->input('campus_code');

                DB::table('departments')->insert([
                    'dept_code' => $dept_code,
                    'dept_desc' => $dept_desc,
                    'dept_type' => $dept_type,
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
                    'action' => 'INSERTED Department: ' . $dept_desc,
                ]);
            }
            return redirect()->route('misDepartmentManagementResource.index')->with('success', 'Department Added Successfully');
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
        $departments = DB::table('departments')
            ->where('dept_code', $id)
            ->get();

        $campuses = DB::table('campus')
            ->where('campus_code', '!=', 'MAIN')
            ->get();

        return view('mis.misDepartmentManagementEditPage', ['departments' => $departments, 'campuses' => $campuses]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $this->validate($request, [
                'dept_code' => 'required',
                'dept_desc' => 'required',
                'campus_code' => 'required',
            ]);

            $dept_code = $request->input('dept_code');

            $existingDepartment = DB::table('departments')
                ->where('dept_code', $dept_code)
                ->where('dept_code', '!=', $dept_code) // Exclude the current department's ID
                ->first();

            if ($existingDepartment) {
                return redirect()->route('misDepartmentManagementResource.index')->with('warning', 'Department Code Already Exists');
            } else {
                $dept_desc = $request->input('dept_desc');
                $campus_code = $request->input('campus_code');
                $dept_type = $request->input('dept_type');

                DB::table('departments')->where('dept_code', $id)->update([
                    'dept_code' => $dept_code,
                    'dept_desc' => $dept_desc,
                    'dept_type' => $dept_type,
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
                    'action' => 'UPDATED Department: ' . $dept_desc,
                ]);

                return redirect()->route('misDepartmentManagementResource.index')->with('success', 'Department Updated Successfully');
            }
        } catch (QueryException $e) {
            $errorCode = $e->errorInfo[1];
            if ($errorCode == 1451) {
                // Handle foreign key constraint violation
                return redirect()->route('misDepartmentManagementResource.index')->with('error', 'Cannot update the department code. It is referenced by other records.');
            }

            // Handle other database-related errors if needed
            return redirect()->back()->with('error', 'An error occurred while updating the department.');
        }
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

    public function filterCampusDepartment(Request $request)
    {
        $campus_code = $request->input('campus');
        $dept_type = $request->input('type');

        $filteredDepartments = DB::table('departments')
            ->where('dept_code', '!=', 'ADMIN')
            ->where('campus_code', '=', $campus_code)
            ->where('dept_type', '=', $dept_type)
            ->get();

        return response()->json(['filteredDepartments' => $filteredDepartments]);
    }

    public function allDepartments()
    {
        $campus_code = session('campus_code');
        $dept_code = session('dept_code');
        if ($campus_code == 'MAIN') {

            $allDepartments = DB::table('departments')
                ->where('dept_code', '!=', 'ADMIN')
                ->get();
        } else {
            $allDepartments = DB::table('departments')
                ->where('dept_code', '!=', 'ADMIN')
                ->where('campus_code', '=', $campus_code)
                ->where('dept_code', '!=', $dept_code)
                ->get();
        }

        return response()->json($allDepartments);
    }

    public function import()
    {
        try {
            Excel::import(new DepartmentImport, request()->file('file'));
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
        return Excel::download(new DepartmentExport, 'departments_' . now() . '.xlsx');
    }
}
