<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\CampusImport;
use App\Exports\CampusExport;
use Maatwebsite\Excel\Validators\ValidationException;

class misCampusManagement extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $campuses = DB::table('campus')
            ->where('campus_code', '!=', 'MAIN')
            ->get();



        return view('mis.misCampusManagementPage', ['campuses' => $campuses]);
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
            'campus_code' => 'required|max:20',
            'campus_location' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->route('misCampusManagementResource.index')
                ->withErrors($validator, 'campusValidation')
                ->withInput()
                ->with('warning', 'Validation Error');
        } else {

            $campus_code = $request->input('campus_code');

            $existingCampus = DB::table('campus')
                ->where('campus_code', $campus_code)
                ->first();

            if ($existingCampus) {
                return redirect()->route('misCampusManagementResource.index')->with('warning', 'Campus Code Already Exists');
            } else {

                $campus_location = $request->input('campus_location');


                DB::table('campus')->insert([
                    'campus_code' => $campus_code,
                    'campus_location' => $campus_location,
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
                    'action' => 'INSERTED Campus: ' . $campus_code,

                ]);
            }
            return redirect()->route('misCampusManagementResource.index')->with('success', 'Campus Added Successfully');
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
        $campuses = DB::table('campus')
            ->where('campus_code', $id)
            ->get();

        return view('mis.misCampusManagementEditPage', ['campuses' => $campuses]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'campus_code' => 'required|max:20',
            'campus_location' => 'required',
        ]);

        $campus_code = $request->input('campus_code');

        $existingCampus = DB::table('campus')
            ->where('campus_code', $campus_code)
            ->first();

        if ($existingCampus) {
            return redirect()->route('misCampusManagementResource.index')->with('warning', 'Campus Code Already Exists');
        } else {

            $campus_location = $request->input('campus_location');


            DB::table('campus')->where('campus_code', $id)->update([
                'campus_code' => $campus_code,
                'campus_location' => $campus_location,
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
                'action' => 'UPDATED Campus: ' . $campus_code,

            ]);

            return redirect()->route('misCampusManagementResource.index')->with('success', 'Campus Updated Successfully');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $campusDel = DB::table('campus')->where('campus_code', $id)->first();
        $campusDel_desc = $campusDel->campus_code;

        $user_id = session('user_id');
        $user = DB::table('users')->where('user_id', $user_id)->first();
        $departmentdesc = DB::table('departments')->where('dept_code', $user->dept_code)->value('dept_desc');

        DB::table('histories')->insert([
            'user_id' => $user->user_id,
            'user_firstName' => $user->user_firstName,
            'user_lastName' => $user->user_lastName,
            'department' => $departmentdesc,
            'user_type' => $user->user_type,
            'action' => 'DELETED Campus: ' . $campusDel_desc,
        ]);

        DB::delete('DELETE FROM campus WHERE campus_code = ?', [$id]);

        return redirect()->route('misCampusManagementResource.index')->with('success', 'Campus Deleted Successfully');
    }


    public function import()
    {
        try {
            Excel::import(new CampusImport, request()->file('file'));
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
        return Excel::download(new CampusExport, 'campus_' . now() . '.xlsx');
    }
}
