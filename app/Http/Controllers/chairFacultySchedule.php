<?php

namespace App\Http\Controllers;

use PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class chairFacultySchedule extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $campus_code = session('campus_code');
        $dept_code = session('dept_code');

        $faculties = DB::table('faculty')
            ->join('designations', 'faculty.designation_id', '=', 'designations.designation_id')
            ->where('campus_code', '=', $campus_code)
            ->where('dept_code', '=',  $dept_code)
            ->get();


        return view('chair.chairFacultySchedulePage', ['faculties' => $faculties]);
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
        //
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

        $faculties = DB::table('faculty')
            ->where('campus_code', '=', $campus_code)
            ->where('dept_code', '=',  $dept_code)
            ->where('faculty_id', '=', $id)
            ->first();


        $section_schedules = DB::table('section_schedule')
            ->join('faculty', 'section_schedule.faculty_id', '=', 'faculty.faculty_id')
            ->join('rooms', 'section_schedule.room_code', '=', 'rooms.room_code')
            ->join('subjects', 'section_schedule.subject_code', '=', 'subjects.subject_code')
            ->join('sections', 'section_schedule.section_id', '=', 'sections.section_id')
            ->join('schoolyear', 'sections.schoolyear_id', '=', 'schoolyear.schoolyear_id')
            ->where('section_schedule.faculty_id', '=', $id)
            ->get();


        return view('chair.chairFacultyScheduleManage', ['faculties' => $faculties, 'section_schedules' => $section_schedules]);
    }

    public function view(string $id, string $facultyId)
    {
        $section_schedules = DB::table('section_schedule')
            ->join('faculty', 'section_schedule.faculty_id', '=', 'faculty.faculty_id')
            ->join('subjects', 'section_schedule.subject_code', '=', 'subjects.subject_code')
            ->join('rooms', 'section_schedule.room_code', '=', 'rooms.room_code')
            ->join('sections', 'section_schedule.section_id', '=', 'sections.section_id')
            ->where('sections.schoolyear_id', '=', $id)
            ->where('section_schedule.faculty_id', '=', $facultyId)
            ->get();


        //dd($section_schedules);
        return view('chair.chairFacultyScheduleView', ['section_schedules' => $section_schedules]);
    }

    public function sampleview(string $id, string $facultyId)
    {

        $section_schedules = DB::table('section_schedule')
            ->join('faculty', 'section_schedule.faculty_id', '=', 'faculty.faculty_id')
            ->join('subjects', 'section_schedule.subject_code', '=', 'subjects.subject_code')
            ->join('rooms', 'section_schedule.room_code', '=', 'rooms.room_code')
            ->join('sections', 'section_schedule.section_id', '=', 'sections.section_id')
            ->join('schoolyear', 'sections.schoolyear_id', '=', 'schoolyear.schoolyear_id')
            ->join('campus', 'sections.campus_code', '=', 'campus.campus_code')
            ->where('sections.schoolyear_id', '=', $id)
            ->where('section_schedule.faculty_id', '=', $facultyId)
            ->get();


        $campus = strtoupper($section_schedules->first()->campus_location);
        $facultyName = $section_schedules->first()->faculty_firstName . ',' . $section_schedules->first()->faculty_lastName;
        $semester = $section_schedules->first()->section_semester;
        $schoolyearSy = $section_schedules->first()->schoolyear_sy;


        //dd($section_schedules);
        return view('chair.chairFacultySchedulePDF', ['section_schedules' => $section_schedules, 'campus' => $campus, 'facultyName' => $facultyName, 'semester' => $semester, 'schoolyearSy' => $schoolyearSy]);
    }

    public function pdfview(string $id, string $facultyId)
    {



        $section_schedules = DB::table('section_schedule')
            ->join('faculty', 'section_schedule.faculty_id', '=', 'faculty.faculty_id')
            ->join('subjects', 'section_schedule.subject_code', '=', 'subjects.subject_code')
            ->join('rooms', 'section_schedule.room_code', '=', 'rooms.room_code')
            ->join('sections', 'section_schedule.section_id', '=', 'sections.section_id')
            ->join('schoolyear', 'sections.schoolyear_id', '=', 'schoolyear.schoolyear_id')
            ->join('campus', 'sections.campus_code', '=', 'campus.campus_code')
            ->where('sections.schoolyear_id', '=', $id)
            ->where('section_schedule.faculty_id', '=', $facultyId)
            ->get();


        $campus = strtoupper($section_schedules->first()->campus_location);
        $facultyName = $section_schedules->first()->faculty_firstName . ',' . $section_schedules->first()->faculty_lastName;
        $semester = $section_schedules->first()->section_semester;
        $schoolyearSy = $section_schedules->first()->schoolyear_sy;



        $pdf = PDF::loadView('chair.chairFacultySchedulePDF', ['section_schedules' => $section_schedules, 'campus' => $campus, 'facultyName' => $facultyName, 'semester' => $semester, 'schoolyearSy' => $schoolyearSy])->setPaper('a4', 'landscape');

        return $pdf->stream($facultyName . '_' . $semester . '_' . $schoolyearSy . '_' . $campus . '.pdf');
    }
}
