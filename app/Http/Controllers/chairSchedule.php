<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class chairSchedule extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $campus_code = session('campus_code');
        if ($campus_code == 'MAIN') {
            $faculties = DB::table('faculty')
                ->join('departments', 'faculty.dept_code', '=', 'departments.dept_code')
                ->join('campus', 'departments.campus_code', '=', 'campus.campus_code')
                ->select('faculty.*', 'campus.campus_code as campus_code_campus')
                ->get();

            $departments = DB::table('departments')
                ->where('dept_desc', '!=', 'ADMIN')
                ->get();

            $campuses = DB::table('campus')
                ->where('campus_code', '!=', 'MAIN')
                ->get();
        } else {
            $faculties = DB::table('faculty')
                ->join('departments', 'faculty.dept_code', '=', 'departments.dept_code')
                ->join('campus', 'departments.campus_code', '=', 'campus.campus_code')
                ->select('faculty.*', 'campus.campus_code as campus_code_campus')
                ->where('faculty.campus_code', '=', $campus_code)
                ->get();

            $departments = DB::table('departments')
                ->where('dept_desc', '!=', 'ADMIN')
                ->where('campus_code', '=', $campus_code)
                ->get();

            $campuses = DB::table('campus')
                ->where('campus_code', '!=', 'MAIN')
                ->where('campus_code', '=', $campus_code)
                ->get();
        }

        return view('mis.misFacultyManagementPage', ['faculties' => $faculties, 'departments' => $departments, 'campuses' => $campuses]);
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
        $section_schedulesDel = DB::table('section_schedule')
            ->join('sections', 'section_schedule.section_id', '=', 'sections.section_id')
            ->where('section_schedule.sectionSchedule_id', $id)
            ->first();

        $section_schedulesDel_desc = $section_schedulesDel->section_desc;
        $user_id = session('user_id');
        $user = DB::table('users')->where('user_id', $user_id)->first();
        $departmentdesc = DB::table('departments')->where('dept_code', $user->dept_code)->value('dept_desc');

        DB::table('histories')->insert([
            'user_id' => $user->user_id,
            'user_firstName' => $user->user_firstName,
            'user_lastName' => $user->user_lastName,
            'department' => $departmentdesc,
            'user_type' => $user->user_type,
            'action' => 'DELETED Schedule of: ' . $section_schedulesDel_desc,
        ]);

        $delCheck = DB::table('section_schedule')
            ->where('sectionSchedule_id', $id)
            ->first();

        DB::table('workload')
            ->where('subject_code', $delCheck->subject_code)
            ->where('section_id', $delCheck->section_id)
            ->where('faculty_id', $delCheck->faculty_id)
            ->delete();


        DB::delete('DELETE FROM section_schedule WHERE sectionSchedule_id = ?', [$id]);


        return response()->json(['section_schedulesDel' => $section_schedulesDel], 200);
    }

    public function addToSchedule(Request $request)
    {
        $campus_code = session('campus_code');

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



        // Access the data sent from the JavaScript code
        $subjectCode = $request->input('subjectCode');
        $sectionId = $request->input('sectionId');
        $day = $request->input('day');
        $startTime = $request->input('startTime');
        $endTime = $request->input('endTime');
        $facultyId = $request->input('facultyId');
        $roomId = $request->input('roomId');

        $subject_lec =  DB::table('subjects')
            ->where('subject_code', $subjectCode)
            ->select('subject_lec')
            ->first();


        $subject_lab =  DB::table('subjects')
            ->where('subject_code', $subjectCode)
            ->select('subject_lab')
            ->first();

        $roomCheck = DB::table('rooms')
            ->where('room_code', $roomId)
            ->first(); // Retrieve a single record

        $sectionCheck = DB::table('sections')
            ->where('section_id', $sectionId)
            ->first(); // Retrieve a single record

        if ($sectionCheck->section_capacity > $roomCheck->room_capacity) {
            return response()->json(['sectionCapacityExceedsRoomCapacity' => true]);
        } else {

            if ($conflictingSchedules = $this->hasScheduleConflict($day, $startTime, $endTime, $facultyId, $roomId, $currentSchoolYear)) {
                $conflictingSchedulesData = [];


                foreach ($conflictingSchedules as $conflictingSchedule) {
                    // Add the condition to check the current school year

                    $faculty = DB::table('faculty')
                        ->where('faculty_id', $conflictingSchedule->faculty_id)
                        ->first();

                    $room = DB::table('rooms')
                        ->where('room_code', $conflictingSchedule->room_code)
                        ->first();

                    $section = DB::table('sections')
                        ->where('section_id', $conflictingSchedule->section_id)
                        ->first();

                    if ($faculty &&  $room && $section) {
                        $conflictingSchedulesData[] = [
                            'faculty_name' => $faculty->faculty_firstName . ' ' . $faculty->faculty_lastName,
                            'room_desc' => $room->room_desc,
                            'section_desc' => $section->section_desc,
                            'day' => $conflictingSchedule->day,
                            'start_time' => $conflictingSchedule->start_time,
                            'end_time' => $conflictingSchedule->end_time
                        ];
                    }
                }
                return response()->json(['conflictingSchedules' => $conflictingSchedulesData]);
            }

            // Insert a new schedule record in the database
            DB::table('section_schedule')->insert([
                'subject_code' => $subjectCode,
                'section_id' => $sectionId,
                'faculty_id' => $facultyId,
                'room_code' => $roomId,
                'day' => $day,
                'start_time' => $startTime,
                'end_time' => $endTime,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Check if the record already exists
            $existingRecord = DB::table('workload')
                ->where('subject_code', $subjectCode)
                ->where('campus_code', $campus_code)
                ->where('section_id', $sectionId)
                ->where('faculty_id', $facultyId)
                ->first();

            // If the record does not exist, insert a new one
            if (!$existingRecord) {
                DB::table('workload')->insert([
                    'subject_code' => $subjectCode,
                    'campus_code' => $campus_code,
                    'section_id' => $sectionId,
                    'faculty_id' => $facultyId,
                    'workload_lec' => floatval($subject_lec->subject_lec),
                    'workload_lab' => floatval($subject_lab->subject_lab),
                    'workload_teachingLoad' => floatval($subject_lec->subject_lec) + floatval($subject_lab->subject_lab),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            $existingLoading = DB::table('loading')
                ->where('faculty_id', $facultyId)
                ->first();

            if (!$existingLoading) {


                $schoolyearAHH = DB::table('schoolyear')
                    ->where('schoolyear.schoolyear_sy', $currentSchoolYear)
                    ->first();

                DB::table('loading')->insert([
                    'faculty_id' => $facultyId,
                    'campus_code' => $campus_code,
                    'schoolyear_id' => $schoolyearAHH->schoolyear_id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }



            $sectionDesc = DB::table('sections')
                ->where('section_id', $sectionId)
                ->value('section_desc');



            $user_id = session('user_id');
            $user = DB::table('users')->where('user_id', $user_id)->first();
            $departmentdesc = DB::table('departments')->where('dept_code', $user->dept_code)->value('dept_desc');

            DB::table('histories')->insert([
                'user_id' => $user->user_id,
                'user_firstName' => $user->user_firstName,
                'user_lastName' => $user->user_lastName,
                'department' => $departmentdesc,
                'user_type' => $user->user_type,
                'action' => 'INSERTED Schedule of: ' . $sectionDesc,
            ]);



            return response()->json(['message' => 'Schedule added successfully', 'checkSec' =>  $sectionDesc], 200);
        }
    }

    private function hasScheduleConflict($day, $startTime, $endTime, $facultyId, $roomId, $schoolYear)
    {
        $conflictingSchedules = DB::table('section_schedule')
            ->join('sections', 'section_schedule.section_id', '=', 'sections.section_id')
            ->join('schoolyear', 'sections.schoolyear_id', '=', 'schoolyear.schoolyear_id')
            ->where('section_schedule.day', $day)
            ->where('schoolyear.schoolyear_sy', $schoolYear)
            ->where(function ($query) use ($startTime, $endTime, $facultyId, $roomId) {
                $query->where(function ($q) use ($startTime, $endTime) {
                    $q->where('section_schedule.start_time', '<', $endTime)
                        ->where('section_schedule.end_time', '>', $startTime);
                })
                    ->where(function ($q) use ($facultyId, $roomId) {
                        $q->where('section_schedule.faculty_id', $facultyId)
                            ->orWhere('section_schedule.room_code', $roomId);
                    });
            })
            ->get();

        return $conflictingSchedules->toArray();
    }
}
