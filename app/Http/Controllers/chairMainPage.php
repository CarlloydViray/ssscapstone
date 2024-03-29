<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class chairMainPage extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $campus_code = session('campus_code');
        $dept_code = session('dept_code');

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

        $schoolYearId = DB::table('schoolyear')
            ->where('schoolyear_sy', '=', $currentSchoolYear)
            ->value('schoolyear_id');

        // Filter section schedule data
        $scheduleData = DB::table('section_schedule')
            ->join('sections', 'section_schedule.section_id', '=', 'sections.section_id')
            ->where('sections.campus_code', '=', $campus_code)
            ->where('sections.dept_code', '=', $dept_code)
            ->where('sections.schoolyear_id', '=', $schoolYearId)
            ->get();

        // Filter faculty data
        $facultyData = DB::table('section_schedule')
            ->join('faculty', 'section_schedule.faculty_id', '=', 'faculty.faculty_id')
            ->join('sections', 'section_schedule.section_id', '=', 'sections.section_id')
            ->where('faculty.campus_code', '=', $campus_code)
            ->where('faculty.dept_code', '=', $dept_code)
            ->where('sections.schoolyear_id', '=', $schoolYearId)
            ->get();

        // Filter room data
        $roomData = DB::table('section_schedule')
            ->join('rooms', 'section_schedule.room_code', '=', 'rooms.room_code')
            ->join('sections', 'section_schedule.section_id', '=', 'sections.section_id')
            ->where('rooms.campus_code', '=', $campus_code)
            ->where('sections.schoolyear_id', '=', $schoolYearId)
            ->get();

        //Total number of courses scheduled.
        $totalCourses = count($scheduleData);

        //Distribution of courses across different rooms.
        $roomDistribution = $roomData->groupBy('room_desc')->map->count();

        //Faculty Workload:
        //Number of classes each faculty member is assigned.
        //Average workload per faculty member.
        $facultyWorkload = $facultyData->groupBy(function ($item) {
            return $item->faculty_firstName . ' ' . $item->faculty_lastName;
        })->map->count();
        
        //Time-Based Analytics:
        //Schedule distribution throughout the day/week.
        //Identify peak hours for classes.
        $scheduleByDay = $scheduleData->groupBy('day')->map->count();

        return view('chair.chairMainPage', [
            'currentSchoolYear' => $currentSchoolYear,
            'totalCourses' => $totalCourses,
            'roomDistribution' => $roomDistribution,
            'facultyWorkload' => $facultyWorkload,
            'scheduleByDay' => $scheduleByDay,

        ]);
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
}
