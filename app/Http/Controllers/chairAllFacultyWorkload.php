<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Dompdf\Dompdf;
use PDF;

class chairAllFacultyWorkload extends Controller
{
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


        $facultyMembers = DB::table('faculty')
            ->where('campus_code', '=', $campus_code)
            ->where('dept_code', '=', $dept_code)
            ->get();

        $workloads = [];
        foreach ($facultyMembers as $facultyMember) {
            $workloads[$facultyMember->faculty_id] = DB::table('workload')
                ->join('faculty', 'workload.faculty_id', '=', 'faculty.faculty_id')
                ->join('subjects', 'workload.subject_code', '=', 'subjects.subject_code')
                ->join('sections', 'workload.section_id', '=', 'sections.section_id')
                ->join('schoolyear', 'sections.schoolyear_id', '=', 'schoolyear.schoolyear_id')
                ->where('faculty.faculty_id', '=', $facultyMember->faculty_id)
                ->where('schoolyear.schoolyear_sy', '=', $currentSchoolYear)
                ->where('faculty.campus_code', '=', $campus_code)
                ->where('faculty.dept_code', '=', $dept_code)
                ->select('workload.*', 'faculty.*', 'sections.*', 'subjects.*')
                ->get();
        }

        $loadings = [];
        foreach ($facultyMembers as $facultyMember) {
            $loadings[$facultyMember->faculty_id] = DB::table('loading')
                ->join('faculty', 'loading.faculty_id', '=', 'faculty.faculty_id')
                ->join('schoolyear', 'loading.schoolyear_id', '=', 'schoolyear.schoolyear_id')
                ->join('designations', 'faculty.designation_id', '=', 'designations.designation_id')
                ->where('loading.faculty_id', '=', $facultyMember->faculty_id)
                ->where('loading.campus_code', '=', $campus_code)
                ->where('schoolyear.schoolyear_sy', '=', $currentSchoolYear)
                ->select('loading.*', 'faculty.*', 'designations.*')
                ->get();
        }

        $uniqueSubjectsCount = [];
        foreach ($facultyMembers as $facultyMember) {
            $workloadsDB = DB::table('workload')
                ->join('faculty', 'workload.faculty_id', '=', 'faculty.faculty_id')
                ->join('subjects', 'workload.subject_code', '=', 'subjects.subject_code')
                ->join('sections', 'workload.section_id', '=', 'sections.section_id')
                ->join('schoolyear', 'sections.schoolyear_id', '=', 'schoolyear.schoolyear_id')
                ->where('faculty.faculty_id', '=', $facultyMember->faculty_id)
                ->where('schoolyear.schoolyear_sy', '=', $currentSchoolYear)
                ->where('faculty.campus_code', '=', $campus_code)
                ->where('faculty.dept_code', '=', $dept_code)
                ->select('workload.*', 'faculty.*', 'sections.*', 'subjects.*')
                ->get();

            $uniqueSubjectsCount[$facultyMember->faculty_id] = $workloadsDB->unique('subject_code')->count();
        }

        //dd($facultyMembers, $workloads, $loadings, $uniqueSubjectsCount);

        return view('chair.chairAllFacultyWorkloadPage',  ['currentSchoolYear' => $currentSchoolYear, 'workloads' => $workloads, 'loadings' => $loadings, 'facultyMembers' => $facultyMembers, 'uniqueSubjectsCount' => $uniqueSubjectsCount]);
    }

    public function pdfexport()
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


        $facultyMembers = DB::table('faculty')
            ->where('campus_code', '=', $campus_code)
            ->where('dept_code', '=', $dept_code)
            ->get();

        $workloads = [];
        foreach ($facultyMembers as $facultyMember) {
            $workloads[$facultyMember->faculty_id] = DB::table('workload')
                ->join('faculty', 'workload.faculty_id', '=', 'faculty.faculty_id')
                ->join('subjects', 'workload.subject_code', '=', 'subjects.subject_code')
                ->join('sections', 'workload.section_id', '=', 'sections.section_id')
                ->join('schoolyear', 'sections.schoolyear_id', '=', 'schoolyear.schoolyear_id')
                ->where('faculty.faculty_id', '=', $facultyMember->faculty_id)
                ->where('schoolyear.schoolyear_sy', '=', $currentSchoolYear)
                ->where('faculty.campus_code', '=', $campus_code)
                ->where('faculty.dept_code', '=', $dept_code)
                ->select('workload.*', 'faculty.*', 'sections.*', 'subjects.*')
                ->get();
        }

        $loadings = [];
        foreach ($facultyMembers as $facultyMember) {
            $loadings[$facultyMember->faculty_id] = DB::table('loading')
                ->join('faculty', 'loading.faculty_id', '=', 'faculty.faculty_id')
                ->join('schoolyear', 'loading.schoolyear_id', '=', 'schoolyear.schoolyear_id')
                ->join('designations', 'faculty.designation_id', '=', 'designations.designation_id')
                ->where('loading.faculty_id', '=', $facultyMember->faculty_id)
                ->where('loading.campus_code', '=', $campus_code)
                ->where('schoolyear.schoolyear_sy', '=', $currentSchoolYear)
                ->select('loading.*', 'faculty.*', 'designations.*')
                ->get();
        }

        $uniqueSubjectsCount = [];
        foreach ($facultyMembers as $facultyMember) {
            $workloadsDB = DB::table('workload')
                ->join('faculty', 'workload.faculty_id', '=', 'faculty.faculty_id')
                ->join('subjects', 'workload.subject_code', '=', 'subjects.subject_code')
                ->join('sections', 'workload.section_id', '=', 'sections.section_id')
                ->join('schoolyear', 'sections.schoolyear_id', '=', 'schoolyear.schoolyear_id')
                ->where('faculty.faculty_id', '=', $facultyMember->faculty_id)
                ->where('schoolyear.schoolyear_sy', '=', $currentSchoolYear)
                ->where('faculty.campus_code', '=', $campus_code)
                ->where('faculty.dept_code', '=', $dept_code)
                ->select('workload.*', 'faculty.*', 'sections.*', 'subjects.*')
                ->get();

            $uniqueSubjectsCount[$facultyMember->faculty_id] = $workloadsDB->unique('subject_code')->count();
        }

        $campus = DB::table('campus')
        ->where('campus_code', '=', $campus_code)
        ->get();

    $dept = DB::table('departments')
        ->where('dept_code', '=', $dept_code)
        ->get();

        //dd($facultyMembers, $workloads, $loadings, $uniqueSubjectsCount);

        $pdf = PDF::loadView('chair.chairAllFacultyWorkloadPagePDF',  ['campus' => $campus,'dept' => $dept,'currentSchoolYear' => $currentSchoolYear, 'workloads' => $workloads, 'loadings' => $loadings, 'facultyMembers' => $facultyMembers, 'uniqueSubjectsCount' => $uniqueSubjectsCount])->setPaper('a4', 'landscape');

        return $pdf->stream($campus . $dept . $currentSchoolYear . '_workloads_' . json_encode($workloads) . '_loadings_' . json_encode($loadings) . '_facultyMembers_' . json_encode($facultyMembers) . '_uniqueSubjectsCount_' . json_encode($uniqueSubjectsCount) . '.pdf');

    
    }
}
