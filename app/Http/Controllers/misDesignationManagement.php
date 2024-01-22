<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\DesignationImport;
use App\Exports\DesignationExport;
use Maatwebsite\Excel\Validators\ValidationException;

class misDesignationManagement extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $designations = DB::table('designations')
            ->get();

        return view('mis.misDesignationManagementPage', ['designations' => $designations]);
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
            'designation_name' => 'required|max:20',
            'designation_units' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->route('misDesignationManagementResource.index')
                ->withErrors($validator, 'designationValidation')
                ->with('warning', 'Validation Error');
        } else {
            $designation_name = $request->input('designation_name');
            $designation_units = $request->input('designation_units');


            DB::table('designations')->insert([
                'designation_name' => $designation_name,
                'designation_units' => $designation_units,
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
                'action' => 'INSERTED Designation: ' . $designation_name,

            ]);

            return redirect()->route('misDesignationManagementResource.index')->with('success', 'Designation Added Successfully');
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
        $designations = DB::table('designations')
            ->where('designation_id', $id)
            ->get();

        return view('mis.misDesignationManagementEditPage', ['designations' => $designations]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'designation_name' => 'required|max:20',
            'designation_units' => 'required|numeric',
        ]);

        $designation_name = $request->input('designation_name');
        $designation_units = $request->input('designation_units');

        DB::table('designations')->where('designation_id', $id)->update([
            'designation_name' => $designation_name,
            'designation_units' => $designation_units,
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
            'action' => 'UPDATED Designation: ' . $designation_name,

        ]);

        return redirect()->route('misDesignationManagementResource.index')->with('success', 'Designation Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $designationDel = DB::table('designations')->where('designation_id', $id)->first();
        $designationDel_name = $designationDel->designation_name;

        $user_id = session('user_id');
        $user = DB::table('users')->where('user_id', $user_id)->first();
        $departmentdesc = DB::table('departments')->where('dept_code', $user->dept_code)->value('dept_desc');

        DB::table('histories')->insert([
            'user_id' => $user->user_id,
            'user_firstName' => $user->user_firstName,
            'user_lastName' => $user->user_lastName,
            'department' => $departmentdesc,
            'user_type' => $user->user_type,
            'action' => 'DELETED Designation: ' . $designationDel_name,
        ]);

        DB::delete('DELETE FROM designations WHERE designation_id = ?', [$id]);

        return redirect()->route('misDesignationManagementResource.index')->with('success', 'Designation Deleted Successfully');
    }

    public function import()
    {
        try {
            Excel::import(new DesignationImport, request()->file('file'));
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
        return Excel::download(new DesignationExport, 'designation_' . now() . '.xlsx');
    }
}
