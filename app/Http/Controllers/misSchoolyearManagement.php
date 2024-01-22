<?php

namespace App\Http\Controllers;

use App\Exports\FacultyExport;
use App\Exports\SchoolyearExport;
use App\Imports\FacultyImport;
use App\Imports\SchoolyearImport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Validators\ValidationException;

class misSchoolyearManagement extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $campus_code = session('campus_code');
        if ($campus_code == 'MAIN') {
            $schoolyears = DB::table('schoolyear')
                ->get();

            $campuses = DB::table('campus')
                ->where('campus_code', '!=', 'MAIN')
                ->get();
        } else {
            $schoolyears = DB::table('schoolyear')
                ->where('campus_code', '=', $campus_code)
                ->get();

            $campuses = DB::table('campus')
                ->where('campus_code', '!=', 'MAIN')
                ->where('campus_code', '=', $campus_code)
                ->get();
        }



        return view('mis.misSchoolyearManagementPage', ['schoolyears' => $schoolyears, 'campuses' => $campuses]);
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
            'schoolyear_sy' => 'required',
            'campus_code' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->route('misSchoolyearManagementResource.index')
                ->withErrors($validator, 'schoolyearValidation')
                ->with('warning', 'Validation Error');
        } else {

            $schoolyear_sy = $request->input('schoolyear_sy');
            $campus_code = $request->input('campus_code');

            $schoolyears = DB::table('schoolyear')
                ->where('campus_code', '=', $campus_code)
                ->where('schoolyear_sy', '=', $schoolyear_sy)
                ->get();

            if ($schoolyears->isEmpty()) {

                DB::table('schoolyear')->insert([
                    'schoolyear_sy' => $schoolyear_sy,
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
                    'action' => 'INSERTED Schoolyear: ' . $schoolyear_sy . ' ' .  $campus_code,

                ]);


                return redirect()->route('misSchoolyearManagementResource.index')->with('success', 'School Year Added Successfully');
            } else {
                return redirect()
                    ->route('misSchoolyearManagementResource.index')
                    ->with('warning', 'Schoolyear already exists in the campus');
            }
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
        $schoolyears = DB::table('schoolyear')
            ->where('schoolyear_id', $id)
            ->get();

        $campuses = DB::table('campus')
            ->where('campus_code', '!=', 'MAIN')
            ->get();


        return view('mis.misSchoolyearManagementEditPage', ['schoolyears' => $schoolyears, 'campuses' => $campuses]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'schoolyear_sy' => 'required',
            'campus_code' => 'required',
        ]);

        $schoolyear_sy = $request->input('schoolyear_sy');
        $campus_code = $request->input('campus_code');


        DB::table('schoolyear')->where('schoolyear_id', $id)->update([
            'schoolyear_sy' => $schoolyear_sy,
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
            'action' => 'UPDATED Schoolyear: ' . $schoolyear_sy . ' ' .  $campus_code,

        ]);

        return redirect()->route('misSchoolyearManagementResource.index')->with('success', 'School Year Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $schoolyearDel = DB::table('schoolyear')->where('schoolyear_id', $id)->first();
        $schoolyearDel_sy = $schoolyearDel->schoolyear_sy;
        $schoolyearDel_campus_code = $schoolyearDel->campus_code;

        $user_id = session('user_id');
        $user = DB::table('users')->where('user_id', $user_id)->first();
        $departmentdesc = DB::table('departments')->where('dept_code', $user->dept_code)->value('dept_desc');

        DB::table('histories')->insert([
            'user_id' => $user->user_id,
            'user_firstName' => $user->user_firstName,
            'user_lastName' => $user->user_lastName,
            'department' => $departmentdesc,
            'user_type' => $user->user_type,
            'action' => 'DELETED Room: ' . $schoolyearDel_sy . ' -- ' . $schoolyearDel_campus_code,
        ]);

        DB::delete('DELETE FROM schoolyear WHERE schoolyear_id = ?', [$id]);

        return redirect()->route('misSchoolyearManagementResource.index')->with('success', 'School Year Deleted Successfully');
    }

    public function filterCampusSchoolyear(Request $request)
    {
        $campus_code = $request->input('campus');


        $filteredSchoolyears = DB::table('schoolyear')
            ->where('campus_code', '=', $campus_code)
            ->get();

        return response()->json(['filteredSchoolyears' => $filteredSchoolyears]);
    }

    public function allSchoolyear()
    {
        $allSchoolyears = DB::table('schoolyear')
            ->get();


        return response()->json($allSchoolyears);
    }
    public function import()
    {
        try {
            Excel::import(new SchoolyearImport, request()->file('file'));
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
        return Excel::download(new SchoolyearExport, 'faculty_' . now() . '.xlsx');
    }
}
