<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Dompdf\Dompdf;
use PDF;


class chairWorkload extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $campus_code = session('campus_code');
        $dept_code = session('dept_code');

        $currentDateTime = now();

        // Extract the year from the current date
        $currentYear = $currentDateTime->year;

        // Assuming the school year starts in September, adjust the start month as needed
        $startMonth = 9; // September

        // Determine the start year of the school year
        if ($currentDateTime->month < $startMonth) {
            $startYear = $currentYear - 1;
        } else {
            $startYear = $currentYear;
        }

        // Construct the current school year
        $currentSchoolYear = $startYear . '-' . ($startYear + 1);

        $workloads = DB::table('workload')
            ->join('faculty', 'workload.faculty_id', '=', 'faculty.faculty_id')
            ->join('subjects', 'workload.subject_code', '=', 'subjects.subject_code')
            ->join('sections', 'workload.section_id', '=', 'sections.section_id')
            ->join('schoolyear', 'sections.schoolyear_id', '=', 'schoolyear.schoolyear_id')
            ->where('schoolyear.schoolyear_sy', '=', $currentSchoolYear)
            ->where('faculty.campus_code', '=', $campus_code)
            ->where('faculty.dept_code', '=', $dept_code)
            ->select('workload.*', 'faculty.*', 'sections.*', 'subjects.*')
            ->get();




        return view('chair.chairWorkloadPage', ['currentSchoolYear' => $currentSchoolYear, 'workloads' => $workloads]);
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
            'loading_designation' => 'numeric',
            'loading_research' => 'numeric',
            'loading_extension' => 'numeric',
            'loading_prepTeaching' => 'numeric',
            'loading_prepDesignation' => 'numeric',
        ]);

        $loading_designation = $request->input('loading_designation');
        $loading_research = $request->input('loading_research');
        $loading_extension = $request->input('loading_extension');
        $loading_prepTeaching = $request->input('loading_prepTeaching');
        $loading_prepDesignation = $request->input('loading_prepDesignation');
        $loading_id = $request->input('loading_id');
        $totalTeachingUnitsSum = $request->input('totalTeachingUnitsSum');
        $prepChecker = $request->input('prepChecker');

        $totalWorkLoadUnits = $loading_designation + $loading_research + $loading_extension + $totalTeachingUnitsSum;

        $remarks = '';

        if ($totalWorkLoadUnits < $prepChecker) {
            $remarks = 'UNDERLOAD';
        } else if ($totalWorkLoadUnits == $prepChecker) {
            $remarks = 'REGULAR';
        } else {
            $remarks = 'OVERLOAD';
        }

        //dd($prepChecker, $totalWorkLoadUnits, $remarks);


        DB::table('loading')->where('loading_id', $loading_id)->update([
            'loading_designation' => $loading_designation,
            'loading_research' => $loading_research,
            'loading_extension' => $loading_extension,
            'loading_prepTeaching' => $loading_prepTeaching,
            'loading_prepDesignation' => $loading_prepDesignation,
            'loading_totalUnitsDeloading' => $loading_designation + $loading_research + $loading_extension,
            'loading_totalWorkLoadUnits' => $totalWorkLoadUnits,
            'loading_remarks' => $remarks,
            'updated_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Faculty Load Computed');
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function manage(string $id)
    {
        $campus_code = session('campus_code');
        $dept_code = session('dept_code');

        $currentDateTime = now();

        // Extract the year from the current date
        $currentYear = $currentDateTime->year;

        // Assuming the school year starts in September, adjust the start month as needed
        $startMonth = 9; // September

        // Determine the start year of the school year
        if ($currentDateTime->month < $startMonth) {
            $startYear = $currentYear - 1;
        } else {
            $startYear = $currentYear;
        }

        // Construct the current school year
        $currentSchoolYear = $startYear . '-' . ($startYear + 1);

        $workloads = DB::table('workload')
            ->join('faculty', 'workload.faculty_id', '=', 'faculty.faculty_id')
            ->join('subjects', 'workload.subject_code', '=', 'subjects.subject_code')
            ->join('sections', 'workload.section_id', '=', 'sections.section_id')
            ->join('schoolyear', 'sections.schoolyear_id', '=', 'schoolyear.schoolyear_id')
            ->where('faculty.faculty_id', '=', $id)
            ->where('schoolyear.schoolyear_sy', '=', $currentSchoolYear)
            ->where('faculty.campus_code', '=', $campus_code)
            ->where('faculty.dept_code', '=', $dept_code)
            ->select('workload.*', 'faculty.*', 'sections.*', 'subjects.*')
            ->get();

        $loadings = DB::table('loading')
            ->join('faculty', 'loading.faculty_id', '=', 'faculty.faculty_id')
            ->join('schoolyear', 'loading.schoolyear_id', '=', 'schoolyear.schoolyear_id')
            ->where('loading.faculty_id', '=', $id)
            ->where('loading.campus_code', '=', $campus_code)
            ->where('schoolyear.schoolyear_sy', '=', $currentSchoolYear)
            ->select('loading.*', 'faculty.*')
            ->get();

        $faculties = DB::table('faculty')
            ->join('designations', 'faculty.designation_id', '=', 'designations.designation_id')
            ->where('faculty.faculty_id', '=', $id)
            ->get()->first();


        $uniqueSubjectsCount = $workloads->unique('subject_code')->count();

        //dd($uniqueSubjectsCount);

        return view('chair.chairWorkloadManagePage',  ['currentSchoolYear' => $currentSchoolYear, 'workloads' => $workloads, 'loadings' => $loadings, 'faculties' => $faculties, 'uniqueSubjectsCount' => $uniqueSubjectsCount]);
    }

    public function pdfexport(string $id)
    {

        $campus_code = session('campus_code');
        $dept_code = session('dept_code');

        $currentDateTime = now();

        // Extract the year from the current date
        $currentYear = $currentDateTime->year;

        // Assuming the school year starts in September, adjust the start month as needed
        $startMonth = 9; // September

        // Determine the start year of the school year
        if ($currentDateTime->month < $startMonth) {
            $startYear = $currentYear - 1;
        } else {
            $startYear = $currentYear;
        }

        // Construct the current school year
        $currentSchoolYear = $startYear . '-' . ($startYear + 1);

        $workloads = DB::table('workload')
            ->join('faculty', 'workload.faculty_id', '=', 'faculty.faculty_id')
            ->join('subjects', 'workload.subject_code', '=', 'subjects.subject_code')
            ->join('sections', 'workload.section_id', '=', 'sections.section_id')
            ->join('schoolyear', 'sections.schoolyear_id', '=', 'schoolyear.schoolyear_id')
            ->where('faculty.faculty_id', '=', $id)
            ->where('schoolyear.schoolyear_sy', '=', $currentSchoolYear)
            ->where('faculty.campus_code', '=', $campus_code)
            ->where('faculty.dept_code', '=', $dept_code)
            ->select('workload.*', 'faculty.*', 'sections.*', 'subjects.*')
            ->get();

        $loadings = DB::table('loading')
            ->join('faculty', 'loading.faculty_id', '=', 'faculty.faculty_id')
            ->join('schoolyear', 'loading.schoolyear_id', '=', 'schoolyear.schoolyear_id')
            ->where('loading.faculty_id', '=', $id)
            ->where('loading.campus_code', '=', $campus_code)
            ->where('schoolyear.schoolyear_sy', '=', $currentSchoolYear)
            ->select('loading.*', 'faculty.*')
            ->get();


        $totalTeachingLoad = $workloads->sum(function ($workload) {
            return $workload->subject_lec + $workload->subject_lab;
        });

        $campus = DB::table('campus')
            ->where('campus_code', '=', $campus_code)
            ->get();

        $dept = DB::table('departments')
            ->where('dept_code', '=', $dept_code)
            ->get();




        $pdf = PDF::loadView('chair.chairWorkloadPDF', ['campus' => $campus, 'dept' => $dept, 'currentSchoolYear' => $currentSchoolYear, 'workloads' => $workloads, 'loadings' => $loadings, 'totalTeachingLoad' => $totalTeachingLoad])->setPaper('a4', 'landscape');

        return $pdf->stream($currentSchoolYear . '_' . $workloads . '_' . $loadings . '_' . $totalTeachingLoad . '.pdf');
    }
}
