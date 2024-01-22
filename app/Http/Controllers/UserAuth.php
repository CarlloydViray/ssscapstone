<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserAuth extends Controller
{
    public function login(Request $req)
    {

        $this->validate($req, [
            'username' => 'required',
            'password' => 'required',

        ]);
        $username = $req->input('username');
        $password = $req->input('password');

        $user = DB::table('users')->where('user_username', $username)->first();

        if ($user) {
            if (Hash::check($password, $user->user_password)) {
                if ($user->user_status == 'active') {
                    if ($user->user_type === 'mis' || $user->user_type === 'admin') {
                        $req->session()->put('user_type', $user->user_type);
                        $req->session()->put('user_id', $user->user_id);
                        $req->session()->put('user_firstName', $user->user_firstName);
                        $req->session()->put('user_lastName', $user->user_lastName);
                        $req->session()->put('campus_code', $user->campus_code);
                        $req->session()->put('dept_code', $user->dept_code);

                        return redirect('misMainPage')->with('success', 'Log in successful');
                    } elseif ($user->user_type === 'chair') {
                        $req->session()->put('user_type', $user->user_type);
                        $req->session()->put('user_id', $user->user_id);
                        $req->session()->put('user_firstName', $user->user_firstName);
                        $req->session()->put('user_lastName', $user->user_lastName);
                        $req->session()->put('dept_code', $user->dept_code);
                        $req->session()->put('campus_code', $user->campus_code);

                        $department = DB::table('departments')->where('dept_code', $user->dept_code)->first();

                        $req->session()->put('dept_desc', $department->dept_desc);

                        return redirect('chairMainPage')->with('success', 'Log in successful');
                    } else {
                        // Role not specified or invalid
                        return redirect('/')->with('error', 'Authentication successful! Invalid role specified!');
                    }
                } else {
                    return redirect('/')->with('error', 'User account deactivated');
                }
            } else {
                // Password does not match
                return redirect('/')->with('error', 'Incorrect Username or Password');
            }
        } else {
            // User record does not exist
            return redirect('/')->with('error', 'User does not exist');
        }
    }


    public function misDashboardRoute()
    {
        return redirect()->route('misDashboardResource.index');
    }


    public function misUsersManagementRoute()
    {
        return redirect()->route('misUsersManagementResource.index');
    }

    public function misCRUDHistoryRoute()
    {
        return redirect()->route('misCRUDHistoryResource.index');
    }

    public function misCurriculumManagementRoute()
    {
        return redirect()->route('misCurriculumManagementResource.index');
    }

    public function misSubjectManagementRoute()
    {
        return redirect()->route('misSubjectManagementResource.index');
    }

    public function misRoomManagementRoute()
    {
        return redirect()->route('misRoomManagementResource.index');
    }

    public function misDepartmentManagementRoute()
    {
        return redirect()->route('misDepartmentManagementResource.index');
    }

    public function misSectionManagementRoute()
    {
        return redirect()->route('misSectionManagementResource.index');
    }

    public function misCurricularSubjectsManagementRoute()
    {
        return redirect()->route('misCSubjectsManagementResource.index');
    }

    public function misFacultyManagementRoute()
    {
        return redirect()->route('misFacultyManagementResource.index');
    }

    public function misDesignationManagementRoute()
    {
        return redirect()->route('misDesignationManagementResource.index');
    }

    public function misCampusManagementRoute()
    {
        return redirect()->route('misCampusManagementResource.index');
    }

    public function misSchoolyearManagementRoute()
    {
        return redirect()->route('misSchoolyearManagementResource.index');
    }

    public function misMainPageRoute()
    {
        return redirect()->route('chairMainPageResource.index');
    }
    public function chairSectionScheduleRoute()
    {
        return redirect()->route('chairSectionScheduleResource.index');
    }

    public function chairFacultyScheduleRoute()
    {
        return redirect()->route('chairFacultyScheduleResource.index');
    }

    public function chairRoomScheduleRoute()
    {
        return redirect()->route('chairRoomScheduleResource.index');
    }

    public function myAccRoute()
    {
        return redirect()->route('myAccResource.index');
    }

    public function chairWorkloadRoute()
    {
        return redirect()->route('chairWorkloadResource.index');
    }

    public function chairAllFacultyWorkloadRoute()
    {
        return redirect()->route('chairAllFacultyWorkloadResource.index');
    }
}
