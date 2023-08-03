<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class misRoomManagement extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rooms = DB::table('rooms')->get();

        return view('mis.misRoomManagementPage', ['rooms' => $rooms]);
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
        ]);

        if ($validator->fails()) {


            return redirect()->route('misRoomManagementResource.index')->with('warning', 'Please Input all fields');
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

                DB::table('rooms')->insert([
                    'room_code' => $roomCode,
                    'room_desc' => $room_desc,
                    'room_capacity' => $room_capacity,
                    'room_location' => $room_location,
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


        return view('mis.misRoomManagementEditPage', ['rooms' => $rooms]);
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
        ]);

        $roomCode = $request->input('room_code');
        $room_desc = $request->input('room_desc');
        $room_capacity = $request->input('room_capacity');
        $room_location = $request->input('room_location');

        DB::table('rooms')->where('room_code', $id)->update([
            'room_code' => $roomCode,
            'room_desc' => $room_desc,
            'room_capacity' => $room_capacity,
            'room_location' => $room_location,
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
}
