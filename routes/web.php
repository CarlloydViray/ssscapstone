<?php

use App\Http\Controllers\chairAllFacultyWorkload;
use App\Http\Controllers\chairMainPage;
use App\Http\Controllers\chairSchedule;
use App\Http\Controllers\chairFacultySchedule;
use App\Http\Controllers\chairRoomSchedule;
use App\Http\Controllers\chairSectionSchedule;
use App\Http\Controllers\chairWorkload;
use App\Http\Controllers\misCampusManagement;
use App\Http\Controllers\misCRUDHistory;
use App\Http\Controllers\misCurricularSubjectsManagement;
use App\Http\Controllers\misCurriculumManagement;
use App\Http\Controllers\misDashboard;
use App\Http\Controllers\misDepartmentManagement;
use App\Http\Controllers\misFacultyManagement;
use App\Http\Controllers\misRoomManagement;
use App\Http\Controllers\misSchoolyearManagement;
use App\Http\Controllers\misSectionManagement;
use App\Http\Controllers\misSubjectManagement;
use App\Http\Controllers\misUserManagement;
use App\Http\Controllers\myAccController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserAuth;
use App\Http\Controllers\ForgotPassword;
use App\Http\Controllers\misDesignationManagement;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('loginPage');
});

Route::post('/', [UserAuth::class, 'login']);
Route::view('debug', 'debug');
Route::view('chairMainPage', 'chair.chairMainPage');
Route::view('misMainPage', 'mis.misMainPage');


Route::get('/logout', function () {
    if (session()->has('user_id')) {
        session()->pull('user_id');
    }
    return redirect('/')->with('success', 'Log out successful');
});

//my acc page 

route::resource('myAccResource', myAccController::class);
Route::get('myAccPage', [UserAuth::class, 'myAccRoute']);
Route::post('edit/myAcc/{id}', [myAccController::class, 'update']);



//mis dashboard

route::resource('misDashboardResource', misDashboard::class);
Route::get('misMainPage', [UserAuth::class, 'misDashboardRoute']);

//mis user mgmnt

route::resource('misUsersManagementResource', misUserManagement::class);
Route::get('misUsersManagement', [UserAuth::class, 'misUsersManagementRoute']);

Route::get('edit/users/{id}', [misUserManagement::class, 'edit']);
Route::post('edit/users/{id}', [misUserManagement::class, 'update']);
Route::delete('delete/users/{id}', [misUserManagement::class, 'destroy']);

Route::post('/filter-campus-users', [misUserManagement::class, 'filterCampusUser'])->name('filterCampusUserRoute');
Route::post('/show-all-campus-users', [misUserManagement::class, 'allUsers'])->name('allUsersRoute');

Route::get('/get-departments_user/{campusCode}/{userType}', [misUserManagement::class, 'getDepartments']);

Route::post('users-import',  [misUserManagement::class, 'import'])->name('users.import');
Route::get('users-export',  [misUserManagement::class, 'export'])->name('users.export');

//mis crud history

route::resource('misCRUDHistoryResource', misCRUDHistory::class);
Route::get('misCRUDHistory', [UserAuth::class, 'misCRUDHistoryRoute']);


//mis curriculum mgmnt

route::resource('misCurriculumManagementResource', misCurriculumManagement::class);
Route::get('misCurriculumManagement', [UserAuth::class, 'misCurriculumManagementRoute']);

Route::get('edit/curriculum/{id}', [misCurriculumManagement::class, 'edit']);
Route::post('edit/curriculum/{id}', [misCurriculumManagement::class, 'update']);
Route::get('delete/curriculum/{id}', [misCurriculumManagement::class, 'destroy']);

Route::post('/filter-campus-curriculum', [misCurriculumManagement::class, 'filterCampusCurriculum'])->name('filterCampusCurriculumRoute');
Route::post('/show-all-campus-curriculum', [misCurriculumManagement::class, 'allCurriculum'])->name('allCurriculumRoute');

Route::get('/get-departments_curriculum/{campusCode}', [misCurriculumManagement::class, 'getDepartments']);

Route::post('curriculum-import',  [misCurriculumManagement::class, 'import'])->name('curriculum.import');
Route::get('curriculum-export',  [misCurriculumManagement::class, 'export'])->name('curriculum.export');

//mis subjects mgmnt

route::resource('misSubjectManagementResource', misSubjectManagement::class);
Route::get('misSubjectManagement', [UserAuth::class, 'misSubjectManagementRoute']);

Route::get('edit/subject/{id}', [misSubjectManagement::class, 'edit']);
Route::post('edit/subject/{id}', [misSubjectManagement::class, 'update']);
Route::get('delete/subject/{id}', [misSubjectManagement::class, 'destroy']);

Route::post('/filter-campus-subjects', [misSubjectManagement::class, 'filterCampusSubjects'])->name('filterCampusSubjectsRoute');
Route::post('/show-all-campus-subjects', [misSubjectManagement::class, 'allSubjects'])->name('allSubjectsRoute');

Route::post('subject-import',  [misSubjectManagement::class, 'import'])->name('subject.import');
Route::get('subject-export',  [misSubjectManagement::class, 'export'])->name('subject.export');

//mis rooms mgmnt

route::resource('misRoomManagementResource', misRoomManagement::class);
Route::get('misRoomManagement', [UserAuth::class, 'misRoomManagementRoute']);

Route::get('edit/room/{id}', [misRoomManagement::class, 'edit']);
Route::post('edit/room/{id}', [misRoomManagement::class, 'update']);
Route::get('delete/room/{id}', [misRoomManagement::class, 'destroy']);

Route::post('/filter-campus-rooms', [misRoomManagement::class, 'filterCampusRooms'])->name('filterCampusRoomsRoute');
Route::post('/show-all-campus-rooms', [misRoomManagement::class, 'allRooms'])->name('allRoomsRoute');

Route::post('room-import',  [misRoomManagement::class, 'import'])->name('room.import');
Route::get('room-export',  [misRoomManagement::class, 'export'])->name('room.export');

//mis departments mgmnt

route::resource('misDepartmentManagementResource', misDepartmentManagement::class);
Route::get('misDepartmentManagement', [UserAuth::class, 'misDepartmentManagementRoute']);

Route::get('edit/department/{id}', [misDepartmentManagement::class, 'edit']);
Route::post('edit/department/{id}', [misDepartmentManagement::class, 'update']);
Route::get('delete/department/{id}', [misDepartmentManagement::class, 'destroy']);

Route::post('/filter-campus-department', [misDepartmentManagement::class, 'filterCampusDepartment'])->name('filterCampusDepartmentRoute');
Route::post('/show-all-campus-department', [misDepartmentManagement::class, 'allDepartments'])->name('allDepartmentsRoute');

Route::post('department-import',  [misDepartmentManagement::class, 'import'])->name('department.import');
Route::get('department-export',  [misDepartmentManagement::class, 'export'])->name('department.export');

//mis sections mgmnt

route::resource('misSectionManagementResource', misSectionManagement::class);
Route::get('misSectionManagement', [UserAuth::class, 'misSectionManagementRoute']);

Route::get('edit/section/{id}', [misSectionManagement::class, 'edit']);
Route::post('edit/section/{id}', [misSectionManagement::class, 'update']);
Route::get('delete/section/{id}', [misSectionManagement::class, 'destroy']);

Route::post('/filter-campus-sections', [misSectionManagement::class, 'filterCampusSections'])->name('filterCampusSectionsRoute');
Route::post('/show-all-campus-sections', [misSectionManagement::class, 'allSections'])->name('allSectionsRouteALL');

Route::get('/get-departments-and-schoolyears/{campusCode}', [misSectionManagement::class, 'getDepartmentsAndSchoolYears']);

Route::post('section-import',  [misSectionManagement::class, 'import'])->name('section.import');
Route::get('section-export',  [misSectionManagement::class, 'export'])->name('section.export');

//mis curricular subjects mgmnt

route::resource('misCSubjectsManagementResource', misCurricularSubjectsManagement::class);
Route::get('misCurricularSubjectsManagement', [UserAuth::class, 'misCurricularSubjectsManagementRoute']);

Route::get('edit/cs/{id}', [misCurricularSubjectsManagement::class, 'edit']);
Route::post('edit/cs/{id}', [misCurricularSubjectsManagement::class, 'update']);
Route::get('delete/cs/{id}', [misCurricularSubjectsManagement::class, 'destroy']);

Route::post('/filter-campus-cs', [misCurricularSubjectsManagement::class, 'filterCampusCS'])->name('filterCampusCSRoute');
Route::post('/show-all-campus-cs', [misCurricularSubjectsManagement::class, 'allCS'])->name('allCSsRoute');

Route::post('cs-import',  [misCurricularSubjectsManagement::class, 'import'])->name('cs.import');
Route::get('cs-export',  [misCurricularSubjectsManagement::class, 'export'])->name('cs.export');

//mis faculty mgmnt

route::resource('misFacultyManagementResource', misFacultyManagement::class);
Route::get('misFacultyManagement', [UserAuth::class, 'misFacultyManagementRoute']);

Route::get('edit/faculty/{id}', [misFacultyManagement::class, 'edit']);
Route::post('edit/faculty/{id}', [misFacultyManagement::class, 'update']);
Route::get('delete/faculty/{id}', [misFacultyManagement::class, 'destroy']);

Route::post('/filter-campus-faculty', [misFacultyManagement::class, 'filterCampusFaculty'])->name('filterCampusFacultyRoute');
Route::post('/show-all-campus-faculty', [misFacultyManagement::class, 'allFaculty'])->name('allFacultyRoute');

Route::get('/get-departments_faculty/{campusCode}', [misFacultyManagement::class, 'getDepartments']);

Route::post('faculty-import',  [misFacultyManagement::class, 'import'])->name('faculty.import');
Route::get('faculty-export',  [misFacultyManagement::class, 'export'])->name('faculty.export');

//mis designation mgmnt

route::resource('misDesignationManagementResource', misDesignationManagement::class);
Route::get('misDesignationManagement', [UserAuth::class, 'misDesignationManagementRoute']);

Route::get('edit/designation/{id}', [misDesignationManagement::class, 'edit']);
Route::post('edit/designation/{id}', [misDesignationManagement::class, 'update']);
Route::get('delete/designation/{id}', [misDesignationManagement::class, 'destroy']);

Route::post('designation-import',  [misDesignationManagement::class, 'import'])->name('designation.import');
Route::get('designation-export',  [misDesignationManagement::class, 'export'])->name('designation.export');

//mis campus mgmnt

route::resource('misCampusManagementResource', misCampusManagement::class);
Route::get('misCampusManagement', [UserAuth::class, 'misCampusManagementRoute']);

Route::get('edit/campus/{id}', [misCampusManagement::class, 'edit']);
Route::post('edit/campus/{id}', [misCampusManagement::class, 'update']);
Route::get('delete/campus/{id}', [misCampusManagement::class, 'destroy']);

Route::post('campus-import',  [misCampusManagement::class, 'import'])->name('campus.import');
Route::get('campus-export',  [misCampusManagement::class, 'export'])->name('campus.export');

//mis schoolyear mgmnt

route::resource('misSchoolyearManagementResource', misSchoolyearManagement::class);
Route::get('misSchoolyearManagement', [UserAuth::class, 'misSchoolyearManagementRoute']);

Route::get('edit/schoolyear/{id}', [misSchoolyearManagement::class, 'edit']);
Route::post('edit/schoolyear/{id}', [misSchoolyearManagement::class, 'update']);
Route::get('delete/schoolyear/{id}', [misSchoolyearManagement::class, 'destroy']);

Route::post('/filter-campus-schoolyear', [misSchoolyearManagement::class, 'filterCampusSchoolyear'])->name('filterCampusSchoolyearRoute');
Route::post('/show-all-campus-schoolyear', [misSchoolyearManagement::class, 'allSchoolyear'])->name('allSchoolyearRoute');

Route::post('schoolyear-import',  [misSchoolyearManagement::class, 'import'])->name('schoolyear.import');
Route::get('schoolyear-export',  [misSchoolyearManagement::class, 'export'])->name('schoolyear.export');

//chair mainPage

route::resource('chairMainPageResource', chairMainPage::class);
Route::get('chairMainPage', [UserAuth::class, 'misMainPageRoute']);

//chair section schedule

route::resource('chairSectionScheduleResource', chairSectionSchedule::class);
Route::get('chairSectionSchedule', [UserAuth::class, 'chairSectionScheduleRoute']);

Route::get('sectionScheduleManage/{id}', [chairSectionSchedule::class, 'manage']);
Route::get('sectionSchedulepdfManage/{id}', [chairSectionSchedule::class, 'sampleview']);

Route::get('sectionSchedulePDFVIEW/{id}', [chairSectionSchedule::class, 'pdfexport']);


Route::post('/filter-subjects', [chairSectionSchedule::class, 'filterSubjects'])->name('filterSubjectsRoute');

Route::post('/filter', [chairSectionSchedule::class, 'filterSections'])->name('filterSectionsRoute');

Route::post('/show-all-sections', [chairSectionSchedule::class, 'showAllSections'])->name('allSectionsRoute');

//DEBUG
Route::post('/debug', [chairSectionSchedule::class, 'debug'])->name('debug');

//storing schedule
Route::post('/addToSchedule', [chairSchedule::class, 'addToSchedule'])->name('addToSchedule');

//deleting schedule
Route::delete('/delete-schedule/{sectionScheduleId}', [chairSchedule::class, 'destroy'])->name('deleteSchedule');

Route::get('/section/{sectionId}/get-schedule', [chairSchedule::class, 'getSchedule'])->name('scheduleData');


//chair faculty schedule

route::resource('chairFacultyScheduleResource', chairFacultySchedule::class);
Route::get('chairFacultySchedule', [UserAuth::class, 'chairFacultyScheduleRoute']);

Route::get('facultyScheduleManage/{id}', [chairFacultySchedule::class, 'manage']);

Route::get('facultyScheduleView/{id}/{facultyId}', [chairFacultySchedule::class, 'view']);
Route::get('facultySchedulepdfView/{id}/{facultyId}', [chairFacultySchedule::class, 'sampleview']);
Route::post('facultySchedulePDF/{id}/{facultyId}', [chairFacultySchedule::class, 'pdfview']);



//chair room schedule

route::resource('chairRoomScheduleResource', chairRoomSchedule::class);
Route::get('chairRoomSchedule', [UserAuth::class, 'chairRoomScheduleRoute']);

Route::get('chairRoomManage/{id}', [chairRoomSchedule::class, 'manage']);

Route::get('roomScheduleView/{id}/{room_code}', [chairRoomSchedule::class, 'view']);
Route::get('roomSchedulepdfView/{id}/{facultyId}', [chairRoomSchedule::class, 'sampleview']);
Route::post('roomSchedulePDF/{id}/{facultyId}', [chairRoomSchedule::class, 'pdfview']);

//forgot password
Route::get('/forgot-password', [ForgotPassword::class, 'forgotpassword'])->name('forgot.password');
Route::post('/forgot-password-post', [ForgotPassword::class, 'forgotpasswordpost']);
Route::get('/reset-password/{token}', [ForgotPassword::class, 'resetpassword'])->name('reset.password');

Route::post('/reset-password-post', [ForgotPassword::class, 'resetpasswordpost'])->name('reset.password.post');


//chair faculty workload

route::resource('chairWorkloadResource', chairWorkload::class);
Route::get('chairWorkload', [UserAuth::class, 'chairWorkloadRoute']);

Route::get('facultyWorkloadManage/{id}', [chairWorkload::class, 'manage']);
Route::post('facultyWorkloadPDF/{id}', [chairWorkload::class, 'pdfexport']);

//chair all faculty workload

route::resource('chairAllFacultyWorkloadResource', chairAllFacultyWorkload::class);
Route::get('chairAllFacultyWorkloadPage', [UserAuth::class, 'chairAllFacultyWorkloadRoute']);
Route::post('allfacultyWorkloadPDF', [chairAllFacultyWorkload::class, 'pdfexport']);
