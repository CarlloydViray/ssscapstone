<?php

namespace App\Http\Controllers;

use App\Exports\RoomExport;
use App\Imports\RoomImport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Validators\ValidationException;

class misRoomManagement extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $campus_code = session('campus_code');
        if ($campus_code == 'MAIN') {
            $rooms = DB::table('rooms')->get();

            $campuses = DB::table('campus')
                ->where('campus_code', '!=', 'MAIN')
                ->get();
        } else {
            $rooms = DB::table('rooms')
                ->where('campus_code', '=', $campus_code)
                ->get();

            $campuses = DB::table('campus')
                ->where('campus_code', '!=', 'MAIN')
                ->where('campus_code', '=', $campus_code)
                ->get();
        }
        return view('mis.misRoomManagementPage', ['rooms' => $rooms, 'campuses' => $campuses]);
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
            'room_code' => 'required|max:20',
            'room_desc' => 'required',
            'room_capacity' => 'required|numeric',
            'room_location' => 'required',
            'campus_code' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->route('misRoomManagementResource.index')
                ->withErrors($validator, 'roomValidation')
                ->with('warning', 'Validation Error');
        } else {

            $roomCode = $request->input('room_code');


            $existingRoom = DB::table('rooms')
                ->where('room_code', $roomCode)
                ->first();

            if ($existingRoom) {
                return redirect()->route('misRoomManagementResource.index')->with('warning', 'Room Code Already Exists');
            } else {

                $room_desc = $request->input('room_desc');
                $room_capacity = $request->input('room_capacity');
                $room_location = $request->input('room_location');
                $campus_code = $request->input('campus_code');

                DB::table('rooms')->insert([
                    'room_code' => $roomCode,
                    'room_desc' => $room_desc,
                    'room_capacity' => $room_capacity,
                    'room_location' => $room_location,
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
                    'action' => 'INSERTED Room: ' . $room_desc,

                ]);
            }

            return redirect()->route('misRoomManagementResource.index')->with('success', 'Room Added Successfully');
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
        $rooms = DB::table('rooms')
            ->where('room_code', $id)
            ->get();

        $campuses = DB::table('campus')
            ->where('campus_code', '!=', 'MAIN')
            ->get();


        return view('mis.misRoomManagementEditPage', ['rooms' => $rooms, 'campuses' => $campuses]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'room_code' => 'required|max:20',
            'room_desc' => 'required',
            'room_capacity' => 'required|numeric',
            'room_location' => 'required',
            'campus_code' => 'required',
        ]);

        $roomCode = $request->input('room_code');
        $room_desc = $request->input('room_desc');
        $room_capacity = $request->input('room_capacity');
        $room_location = $request->input('room_location');
        $campus_code = $request->input('campus_code');

        DB::table('rooms')->where('room_code', $id)->update([
            'room_code' => $roomCode,
            'room_desc' => $room_desc,
            'room_capacity' => $room_capacity,
            'room_location' => $room_location,
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
            'action' => 'UPDATED Room: ' . $room_desc,

        ]);

        return redirect()->route('misRoomManagementResource.index')->with('success', 'Room Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $roomDel = DB::table('rooms')->where('room_code', $id)->first();
        $roomDel_desc = $roomDel->room_desc;

        $user_id = session('user_id');
        $user = DB::table('users')->where('user_id', $user_id)->first();
        $departmentdesc = DB::table('departments')->where('dept_code', $user->dept_code)->value('dept_desc');

        DB::table('histories')->insert([
            'user_id' => $user->user_id,
            'user_firstName' => $user->user_firstName,
            'user_lastName' => $user->user_lastName,
            'department' => $departmentdesc,
            'user_type' => $user->user_type,
            'action' => 'DELETED Room: ' . $roomDel_desc,
        ]);

        DB::delete('DELETE FROM rooms WHERE room_code = ?', [$id]);

        return redirect()->route('misRoomManagementResource.index')->with('success', 'Room Deleted Successfully');
    }

    public function filterCampusRooms(Request $request)
    {
        $campus_code = $request->input('campus');


        $filteredRooms = DB::table('rooms')
            ->where('campus_code', '=', $campus_code)
            ->get();

        return response()->json(['filteredRooms' => $filteredRooms]);
    }

    public function allRooms()
    {
        $allRooms = DB::table('rooms')->get();


        return response()->json($allRooms);
    }

    public function import()
    {
        try {
            Excel::import(new RoomImport, request()->file('file'));
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
        return Excel::download(new RoomExport, 'rooms_' . now() . '.xlsx');
    }
}
