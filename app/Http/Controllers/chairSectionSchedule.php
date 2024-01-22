<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use PDF;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Dompdf\Dompdf;

class chairSectionSchedule extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $campus_code = session('campus_code');
        $dept_code = session('dept_code');

        $sections = DB::table('sections')
            ->join('schoolyear', 'sections.schoolyear_id', '=', 'schoolyear.schoolyear_id')
            ->where('sections.campus_code', '=', $campus_code)
            ->where('sections.dept_code', '=', $dept_code)
            ->orderByDesc('schoolyear.schoolyear_sy')
            ->get();


        return view('chair.chairSectionSchedulePage', ['sections' => $sections]);
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
    }

    public function manage(string $id)
    {
        // Get the current date and time
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



        $campus_code = session('campus_code');
        $dept_code = session('dept_code');

        $sections = DB::table('sections')
            ->join('schoolyear', 'sections.schoolyear_id', '=', 'schoolyear.schoolyear_id')
            ->where('section_id', '=', $id)
            ->first();

        $sectionSchoolyear = $sections->schoolyear_sy;

        $curriculums = DB::table('curriculum')
            ->where('campus_code', '=', $campus_code)
            ->where('dept_code', '=', $dept_code)
            ->get();


        $section_schedules = DB::table('section_schedule')
            ->join('faculty', 'section_schedule.faculty_id', '=', 'faculty.faculty_id')
            ->join('rooms', 'section_schedule.room_code', '=', 'rooms.room_code')
            ->join('subjects', 'section_schedule.subject_code', '=', 'subjects.subject_code')
            ->where('section_schedule.section_id', '=', $id)
            ->get();

        $daysOfWeek = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];

        $timeSlots = [];

        // Set the start and end times
        $startTime = strtotime('08:00');
        $endTime = strtotime('17:30');

        // Create time slots in 30-minute intervals
        while ($startTime <= $endTime) {
            $timeSlot['start'] = date('H:i', $startTime);
            $startTime += 1800; // Add 30 minutes
            $timeSlot['end'] = date('H:i', $startTime);
            $timeSlots[] = $timeSlot;
        }

        $section_yearLevel = $sections->section_yearLevel;
        $section_semester = $sections->section_semester;


        $subjects = DB::table('curricular_subjects')
            ->join('subjects', 'curricular_subjects.subject_code', '=', 'subjects.subject_code')
            ->join('curriculum', 'curricular_subjects.curriculum_id', '=', 'curriculum.curriculum_id')
            ->where('curriculum.campus_code', $campus_code)
            ->where('curriculum.dept_code', $dept_code)
            ->where('curricular_subjects.cs_yearLevel', $section_yearLevel)
            ->where('curricular_subjects.cs_semesterOffered', $section_semester)
            ->orderBy('curriculum.curriculum_idYear', 'desc')
            ->get();


        $faculties = DB::table('faculty')
            ->join('departments', 'faculty.dept_code', '=', 'departments.dept_code')
            ->where('faculty.campus_code', '=', $campus_code)
            ->get();

        $rooms = DB::table('rooms')
            ->where('campus_code', '=', $campus_code)
            ->get();


        $lecture_options = ['2.00', '2.25', '2.50', '2.75', '3.00'];


        return view('chair.chairSectionScheduleManage', ['faculties' => $faculties, 'rooms' => $rooms, 'subjects' => $subjects, 'sections' => $sections, 'curriculums' => $curriculums, 'section_schedules' => $section_schedules, 'daysOfWeek' => $daysOfWeek, 'timeSlots' => $timeSlots, 'currentSchoolYear' => $currentSchoolYear, 'sectionSchoolyear' => $sectionSchoolyear, 'lecture_options' => $lecture_options]);
    }


    public function sampleview(string $id)
    {

        $sections = DB::table('sections')
            ->join('schoolyear', 'sections.schoolyear_id', '=', 'schoolyear.schoolyear_id')
            ->join('campus', 'sections.campus_code', '=', 'campus.campus_code')
            ->where('section_id', '=', $id)
            ->first();


        $sectionName = $sections->section_desc;
        $semester = $sections->section_semester;
        $schoolyearSy = $sections->schoolyear_sy;
        $campus = strtoupper($sections->campus_location);



        $section_schedules = DB::table('section_schedule')
            ->join('faculty', 'section_schedule.faculty_id', '=', 'faculty.faculty_id')
            ->join('rooms', 'section_schedule.room_code', '=', 'rooms.room_code')
            ->join('subjects', 'section_schedule.subject_code', '=', 'subjects.subject_code')
            ->where('section_schedule.section_id', '=', $id)
            ->get();



        return view('chair.chairSectionSchedulePDF', ['sections' => $sections, 'section_schedules' => $section_schedules, 'schoolyearSy' => $schoolyearSy, 'campus' => $campus]);
    }

    public function pdfexport(string $id)
    {

        $sections = DB::table('sections')
            ->join('schoolyear', 'sections.schoolyear_id', '=', 'schoolyear.schoolyear_id')
            ->join('campus', 'sections.campus_code', '=', 'campus.campus_code')
            ->where('section_id', '=', $id)
            ->first();


        $sectionName = $sections->section_desc;
        $semester = $sections->section_semester;
        $schoolyearSy = $sections->schoolyear_sy;
        $campus = strtoupper($sections->campus_location);



        $section_schedules = DB::table('section_schedule')
            ->join('faculty', 'section_schedule.faculty_id', '=', 'faculty.faculty_id')
            ->join('rooms', 'section_schedule.room_code', '=', 'rooms.room_code')
            ->join('subjects', 'section_schedule.subject_code', '=', 'subjects.subject_code')
            ->where('section_schedule.section_id', '=', $id)
            ->get();

        $pdf = PDF::loadView('chair.chairSectionSchedulePDF', ['sections' => $sections, 'section_schedules' => $section_schedules, 'schoolyearSy' => $schoolyearSy, 'campus' => $campus])->setPaper('a4', 'landscape');

        return $pdf->stream($sectionName . '_' . $semester . '_' . $schoolyearSy . '_' . $campus . '.pdf');
    }

    public function filterSubjects(Request $request)
    {
        $curriculum = $request->input('curriculum');
        $yearLevel = $request->input('yearLevel');
        $semester = $request->input('semester');
        $campus_code = session('campus_code');

        // Query the database to filter sections based on selected criteria
        $filteredSubjects = DB::table('curricular_subjects')
            ->join('subjects', 'curricular_subjects.subject_code', '=', 'subjects.subject_code')
            ->where('curricular_subjects.curriculum_id', $curriculum)
            ->where('curricular_subjects.cs_yearLevel', $yearLevel)
            ->where('curricular_subjects.cs_semesterOffered', $semester)
            ->get();

        $faculties = DB::table('faculty')
            ->join('departments', 'faculty.dept_code', '=', 'departments.dept_code')
            ->where('faculty.campus_code', '=', $campus_code)
            ->get();

        $rooms = DB::table('rooms')
            ->where('campus_code', '=', $campus_code)
            ->get();



        return response()->json(['filteredSubjects' => $filteredSubjects, 'faculties' => $faculties, 'rooms' => $rooms]);
    }


    public function filterSections(Request $request)
    {


        $campus_code = session('campus_code');
        $dept_code = session('dept_code');



        $campus_code = session('campus_code');
        $schoolyear_id = $request->input('schoolyear_id');
        $yearLevel = $request->input('yearLevel');
        $section_semester = $request->input('section_semester'); // corrected parameter name

        // Query the database to filter sections based on selected criteria

        $filterSections = DB::table('sections')
            ->join('schoolyear', 'sections.schoolyear_id', '=', 'schoolyear.schoolyear_id')
            ->where('sections.schoolyear_id', $schoolyear_id)
            ->where('sections.section_yearLevel', $yearLevel)
            ->where('sections.section_semester', $section_semester)
            ->where('sections.campus_code', '=', $campus_code)
            ->where('sections.dept_code', '=', $dept_code)
            ->orderByDesc('schoolyear.schoolyear_sy')
            ->get();

        return response()->json($filterSections);
    }

    public function showAllSections()
    {
        $campus_code = session('campus_code');
        $dept_code = session('dept_code');

        $allSections =  DB::table('sections')
            ->join('schoolyear', 'sections.schoolyear_id', '=', 'schoolyear.schoolyear_id')
            ->where('sections.campus_code', $campus_code)
            ->where('sections.dept_code', '=', $dept_code)
            ->orderByDesc('schoolyear.schoolyear_sy')
            ->get();

        return response()->json($allSections);
    }

    public function debug()
    {
        $campus_code = session('campus_code');

        $filterSections = DB::table('sections')
            ->join('schoolyear', 'sections.schoolyear_id', '=', 'schoolyear.schoolyear_id')
            ->where('sections.schoolyear_id', '1')
            ->where('sections.section_yearLevel', '1')
            ->where('sections.section_semester', '1st semester')
            ->where('sections.campus_code', $campus_code)

            ->get();


        dd($filterSections);
    }

    public function getSchedule($sectionId)
    {
        dd("Fetching schedule for section ID: $sectionId");

        $scheduleData = DB::table('sections')
            ->where('section_id', $sectionId)
            ->get();

        dd($scheduleData);

        return response()->json($scheduleData);
    }
}
