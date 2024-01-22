<?php

namespace App\Http\Controllers;

use App\Exports\SectionExport;
use App\Imports\SectionImport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Validators\ValidationException;


class misSectionManagement extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $campus_code = session('campus_code');
        $dept_code = session('dept_code');

        if ($campus_code == 'MAIN') {
            $sections = DB::table('sections')
                ->join('departments', 'sections.dept_code', '=', 'departments.dept_code')
                ->select('sections.*', 'departments.dept_desc')
                ->get();

            $departments = DB::table('departments')
                ->where('campus_code', '!=', 'MAIN')
                ->where('dept_type', '!=', 'mis')
                ->get();

            $campuses = DB::table('campus')
                ->where('campus_code', '!=', 'MAIN')
                ->get();

            $schoolyears = DB::table('schoolyear')->get();
        } else {
            $sections = DB::table('sections')
                ->join('departments', 'sections.dept_code', '=', 'departments.dept_code')
                ->select('sections.*', 'departments.dept_desc')
                ->where('sections.campus_code', '=', $campus_code)
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

            $schoolyears = DB::table('schoolyear')
                ->where('campus_code', '=', $campus_code)
                ->get();
        }



        return view('mis.misSectionManagementPage', ['sections' => $sections, 'departments' => $departments, 'campuses' => $campuses, 'schoolyears' => $schoolyears]);
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
            'section_desc' => 'required|max:20',
            'dept_code' => 'required',
            'schoolyear_id' => 'required',
            'section_yearLevel' => 'required',
            'section_semester' => 'required',
            'section_capacity' => 'required|numeric',
            'campus_code' => 'required',
        ]);

        if ($validator->fails()) {


            return redirect()
                ->route('misSectionManagementResource.index')
                ->withErrors($validator, 'sectionValidation')
                ->with('warning', 'Validation Error');
        } else {
            $section_desc = $request->input('section_desc');
            $dept_code = $request->input('dept_code');
            $schoolyear_id = $request->input('schoolyear_id');
            $section_yearLevel = $request->input('section_yearLevel');
            $section_semester = $request->input('section_semester');
            $campus_code = $request->input('campus_code');
            $section_capacity = $request->input('section_capacity');

            DB::table('sections')->insert([
                'section_desc' => $section_desc,
                'dept_code' => $dept_code,
                'schoolyear_id' => $schoolyear_id,
                'section_yearLevel' => $section_yearLevel,
                'section_semester' => $section_semester,
                'section_capacity' => $section_capacity,
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
                'action' => 'INSERTED Section: ' . $section_desc,

            ]);

            return redirect()->route('misSectionManagementResource.index')->with('success', 'Section Added Successfully');
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
        $sections = DB::table('sections')
            ->where('section_id', $id)
            ->get();

        $departments = DB::table('departments')
            ->get();

        $schoolyears = DB::table('schoolyear')->get();

        $campuses = DB::table('campus')
            ->where('campus_code', '!=', 'MAIN')
            ->get();

        return view('mis.misSectionManagementEditPage', ['sections' => $sections, 'departments' => $departments, 'campuses' => $campuses, 'schoolyears' => $schoolyears]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'section_desc' => 'required|max:20',
            'dept_code' => 'required',
            'schoolyear_id' => 'required',
            'section_yearLevel' => 'required',
            'section_semester' => 'required',
            'section_capacity' => 'required|numeric',
            'campus_code' => 'required',
        ]);

        $section_desc = $request->input('section_desc');
        $dept_code = $request->input('dept_code');
        $schoolyear_id = $request->input('schoolyear_id');
        $section_yearLevel = $request->input('section_yearLevel');
        $section_semester = $request->input('section_semester');
        $campus_code = $request->input('campus_code');
        $section_capacity = $request->input('section_capacity');

        DB::table('sections')->where('section_id', $id)->update([
            'section_desc' => $section_desc,
            'dept_code' => $dept_code,
            'schoolyear_id' => $schoolyear_id,
            'section_yearLevel' => $section_yearLevel,
            'section_semester' => $section_semester,
            'section_capacity' => $section_capacity,
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
            'action' => 'UPDATED Section: ' . $section_desc . ' -- ' . $campus_code,

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

    public function filterCampusSections(Request $request)
    {
        $campus_code = $request->input('campus');
        $semester = $request->input('semester');
        $yearLevel = $request->input('yearLevel');


        $filteredSections = DB::table('sections')
            ->join('departments', 'sections.dept_code', '=', 'departments.dept_code')
            ->select('sections.*', 'departments.dept_desc')
            ->where('sections.campus_code', '=', $campus_code)
            ->where('sections.section_semester', '=', $semester)
            ->where('sections.section_yearLevel', '=', $yearLevel)
            ->get();

        return response()->json(['filteredSections' => $filteredSections]);
    }

    public function allSections()
    {
        $allSections = DB::table('sections')
            ->join('departments', 'sections.dept_code', '=', 'departments.dept_code')
            ->select('sections.*', 'departments.dept_desc')
            ->get();


        return response()->json($allSections);
    }

    public function getDepartmentsAndSchoolYears($campusCode)
    {
        $departments = DB::table('departments')
            ->where('dept_desc', '!=', 'ADMIN')
            ->where('campus_code', '=', $campusCode)
            ->where('dept_type', '!=', 'mis')
            ->get();
        $schoolyears = DB::table('schoolyear')
            ->where('campus_code', '=', $campusCode)
            ->get();

        return response()->json(['departments' => $departments, 'schoolyears' => $schoolyears]);
    }

    public function import()
    {
        try {
        
        } catch (ValidationException $e) {
            $failures = $e->failures(); // Get validation failures
            // Handle validation failures, you can log them or display an error message

            return redirect()->back()->withErrors($failures)->withInput();
        } catch (\Exception $e) {
            // Handle other exceptions
            return redirect()->back()->with('error', 'An error occurred during the import.');
        }
        Excel::import(new SectionImport, request()->file('file'));
        return redirect()->back()->with('success', 'Import completed successfully.');
    }

    public function export()
    {
        return Excel::download(new SectionExport, 'section_' . now() . '.xlsx');
    }
}
