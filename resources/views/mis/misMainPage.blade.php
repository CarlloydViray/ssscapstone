<?php
if (session('user_id') == null) {
    ?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>Login Required</title>
</head>

<body>
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-6">
                <div class="alert alert-warning text-center">
                    <h4>Please log in to access this page.</h4>
                    <p>Redirecting to login page</p>
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- JavaScript to redirect to the login page after 3 seconds -->
    <script>
        setTimeout(function() {
            window.location.href = "/";
        }, 3000); // 3000 milliseconds = 3 seconds
    </script>
</body>

</html>
<?php
}

 else{

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="../assets/logo/favicon-32x32.png" type="image/x-icon">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    {{-- datatable bootsrap --}}
    {{-- css --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/mis_panel.css') }}">

    {{-- script --}}
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#users').DataTable();
        });
    </script>
    <title>Dashboard</title>
</head>
<style>
    td {
        font-size: 17px;
    }

    .scrollable-form {
        overflow-y: auto;
        max-height: 95vh;
        padding: 15px;
        position: relative;
        transition: margin-left 0.5s;
    }

    .radius-10 {
        border-radius: 10px !important;
    }

    .border-info {
        border-left: 5px solid #0dcaf0 !important;
    }

    .border-danger {
        border-left: 5px solid #fd3550 !important;
    }

    .border-success {
        border-left: 5px solid #15ca20 !important;
    }

    .border-warning {
        border-left: 5px solid #ffc107 !important;
    }

    p {
        color: gray;
    }


    .card {
        position: relative;
        display: flex;
        flex-direction: column;
        min-width: 0;
        word-wrap: break-word;
        background-color: #fff;
        background-clip: border-box;
        border: 0px solid rgba(0, 0, 0, 0);
        border-radius: .25rem;
        margin-bottom: 1.5rem;
        box-shadow: 0 2px 6px 0 rgb(218 218 253 / 65%), 0 2px 6px 0 rgb(206 206 238 / 54%);
    }

    .bg-gradient-scooter {
        background: #17ead9;
        background: -webkit-linear-gradient(45deg, #17ead9, #6078ea) !important;
        background: linear-gradient(45deg, #17ead9, #6078ea) !important;
    }

    .widgets-icons-2 {
        width: 56px;
        height: 56px;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: #ededed;
        font-size: 27px;
        border-radius: 10px;
    }

    .rounded-circle {
        border-radius: 50% !important;
    }

    .text-white {
        color: #fff !important;
    }

    .ms-auto {
        margin-left: auto !important;
    }

    .bg-gradient-bloody {
        background: #f54ea2;
        background: -webkit-linear-gradient(45deg, #f54ea2, #ff7676) !important;
        background: linear-gradient(45deg, #f54ea2, #ff7676) !important;
    }

    .bg-gradient-ohhappiness {
        background: #00b09b;
        background: -webkit-linear-gradient(45deg, #00b09b, #96c93d) !important;
        background: linear-gradient(45deg, #00b09b, #96c93d) !important;
    }

    .bg-gradient-blooker {
        background: #ffdf40;
        background: -webkit-linear-gradient(45deg, #ffdf40, #ff8359) !important;
        background: linear-gradient(45deg, #ffdf40, #ff8359) !important;
    }

    h4 {
        color: #082b54;
    }
</style>
<script>
    function toggleDarkMode() {
        let darkmode = document.querySelector('.dark');
        darkmode.classList.toggle("active");

        const body = document.body;
        body.classList.toggle('active');
        const darkModeButton = document.querySelector('.darkmode');
        if (darkmode.classList.contains("active")) {
            localStorage.setItem("darkMode", "dark");
            darkModeButton.style.backgroundColor = "white";
            darkModeButton.style.color = "#2D3436";
            darkModeButton.title = "Light Mode";
        } else {
            localStorage.removeItem("darkMode");
            darkModeButton.style.backgroundColor = " #2D3436";
            darkModeButton.style.color = "white";
            darkModeButton.title = "Dark Mode";
        }
    }

    document.addEventListener("DOMContentLoaded", function() {
        const darkmode = document.querySelector('.dark');
        const darkModeButton = document.querySelector('.darkmode');

        if (localStorage.getItem("darkMode") === "dark") {
            const body = document.body;
            body.classList.toggle('active');
            darkmode.classList.add("active");
            darkModeButton.style.backgroundColor = "white";
            darkModeButton.style.color = "black";
            darkModeButton.title = "Toggle Light Mode";
        }
    });
    const savedDarkMode = localStorage.getItem("darkMode");

    if (savedDarkMode === "dark") {
        let darkmode = document.querySelector('.dark');
        darkmode.classList.add("active");
    }
</script>

<body>
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <div class="container">
                <center>
                    {{ session('success') }}
                </center>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    @endif
    @if (session('warning'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <div class="container">
                <center>
                    {{ session('warning') }}
                </center>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    @endif
    <button class="darkmode btn shadow-lg  btn-primary p-4" title=" Dark Mode" onclick="toggleDarkMode()">
        <i class="fa-solid fa-moon"></i>
    </button>
    <div class="container contains">
        <div class="dark"></div>
    </div>
    <div id="mySidebar" class="sidebar shadow-lg">
        @php
            $userType = session('user_type');

        @endphp
        <center>
            <img src="../assets/logo/PSUlabel1.png" alt="SSS Logo" class=" logo mt-2 img-fluid" style="width:100px;">
            <h3 class="title1">PSU</h2>
        </center>

        <a href="misMainPage" class="link active fw-bold"><i class="fa fa-tachometer"
                aria-hidden="true"></i>&nbsp;&nbsp;Dashboard</a>
        <a href="misUsersManagement" class="   fw-bold"><i class="fa-solid fa-users"></i>&nbsp;&nbsp;Users
            Management</a>

        @if ($userType !== 'mis')
            <a href="misCampusManagement" class="fw-bold"><i class="fa-solid fa-school"></i>&nbsp;&nbsp;Campus
                Management</a>
        @endif

        <a href="misDepartmentManagement" class=" fw-bold"><i class="fa-solid fa-sitemap"></i>&nbsp;&nbsp;Departments
            Management</a>
        <a href="misDesignationManagement" class=" fw-bold"><i
                class="fa-solid fa-bars-progress"></i>&nbsp;&nbsp;Designation
            Management</a>
        <a href="misFacultyManagement" class=" fw-bold"><i class="fa-solid fa-users"></i>&nbsp;&nbsp;Faculty
            Management</a>
        <a href="misSchoolyearManagement" class=" fw-bold"><i class="fa-solid fa-calendar-days"></i>&nbsp;&nbsp;School
            Year Management</a>
        <a href="misCurriculumManagement" class=" fw-bold"><i class="fa-solid fa-table-list"></i>&nbsp;&nbsp;Curricula
            Management</a>
        <a href="misSubjectManagement" class=" fw-bold"><i class="fa-solid fa-book-open"></i>&nbsp;&nbsp;Subjects
            Management</a>
        <a href="misCurricularSubjectsManagement" class="  fw-bold"><i
                class="fa-solid fa-book-open"></i>&nbsp;&nbsp;Curricular Subjects Management</a>
        <a href="misRoomManagement" class=" fw-bold"><i class="fa-solid fa-house"></i>&nbsp;&nbsp;Rooms Management</a>
        <a href="misSectionManagement" class=" fw-bold"><i class="fa-solid fa-clipboard"></i>&nbsp;&nbsp;Sections
            Management</a>
        <a href="misCRUDHistory" class=" fw-bold"><i class="fa-solid fa-clock-rotate-left"></i>&nbsp;&nbsp;System
            Logs</a>
        @if ($userType !== 'admin')
            <hr class= "bg-white fw-bold">
            <a href="myAccPage" class="   fw-bold"><i class="fa-solid fa-user"></i>&nbsp;&nbsp;My
                Account</a>
            <a href="/logout" class="   fw-bold"><i class="fa-solid fa-right-from-bracket"></i>&nbsp;&nbsp;Logout</a>
        @endif

        @if ($userType === 'admin')
            <a href="/logout" class="   fw-bold"><i class="fa-solid fa-right-from-bracket"></i>&nbsp;&nbsp;Logout</a>
        @endif
    </div>

    <div id="main" class=" content scrollable-form">
        <div class="navbar shadow-lg rounded">
            <div class="navbar-title">
                <h1 class="title fw-bold p-3"> School Year {{ $currentSchoolYear }}</h3>
            </div>
            <div class="navbar-info">
                <div class="row p-4">
                    <div class="col-md-7 mt-3 user-name">
                        <span>
                            <center>
                                <h5 class=" title">
                                    {{ session('user_firstName') . ' ' . session('user_lastName') }}</h5>
                                <h6 class=" title">
                                    {{ session('campus_code') }}</h6>
                            </center>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div>
            <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
            <div class="row row-cols-1 p-5 mb-5 mt-5 row-cols-md-2 row-cols-xl-4">
                <div class="col w-50">
                    <div class="card p-5 radius-10 border-start border-0 border-3 border-primary">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div>
                                    <h4 class="mb-0 fw-bold  text-secondary">School Year {{ $currentSchoolYear }}</p>
                                        <h4 class="my-1 text-primary">{{ $totalCourses }}</h4>
                                        <p class="mb-0 font-13">No. of Schedules </p>
                                </div>
                                <div class="widgets-icons-2 rounded-circle bg-primary text-white ms-auto"><i
                                        class="fa-regular fa-calendar"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col w-50">
                    <div class="card p-5 radius-10 border-start border-0 border-3 border-danger">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div>
                                    <h4 class="mb-0 fw-bold  text-secondary">Room</p>
                                        <h4 class="my-1 text-danger">
                                            @forelse ($roomDistribution as $roomDesc => $courseCount)
                                                {{ $roomDesc }} - {{ $courseCount }}
                                                {{ Str::plural('schedule', $courseCount) }}
                                                <br>
                                            @empty
                                                No schedules available
                                            @endforelse
                                        </h4>
                                        <p class="mb-0 font-13">No. of Schedules</p>
                                </div>
                                <div class="widgets-icons-2 rounded-circle bg-danger text-white ms-auto"><i
                                        class="fa-solid fa-house-user"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col w-50">
                    <div class="card p-5 radius-10 border-start border-0 border-3 border-success">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div>
                                    <h4 class="mb-0 fw-bold  text-secondary">Faculty</p>
                                        <h4 class="my-1 text-success">
                                            @forelse ($facultyWorkload as $facultyName => $courseCount)
                                                {{ $facultyName }} - {{ $courseCount }}
                                                {{ Str::plural('schedule', $courseCount) }}
                                                <br>
                                            @empty
                                                No schedules available
                                            @endforelse
                                        </h4>
                                        <p class="mb-0 font-13">No. of Schedules</p>
                                </div>
                                <div class="widgets-icons-2 rounded-circle bg-success text-white ms-auto"><i
                                        class="fa-solid fa-user-large"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col w-50">
                    <div class="card p-5 radius-10 border-start border-0 border-3 border-warning">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div>
                                    <h4 class="mb-0 fw-bold text-secondary">Daily Schedule</p>
                                        <h4 class="my-1 text-warning">
                                            @forelse ($scheduleByDay as $day => $courseCount)
                                                {{ $day }} - {{ $courseCount }}
                                                {{ Str::plural('schedule', $courseCount) }}
                                                <br>
                                            @empty
                                                No schedules available
                                            @endforelse
                                        </h4>
                                        <p class="mb-0 font-13">No. of Schedules</p>
                                </div>
                                <div class="widgets-icons-2 rounded-circle bg-warning text-white ms-auto"><i
                                        class="fa-solid fa-rectangle-list"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col w-50">
                    <div class="card p-5 radius-10 border-start border-0 border-3 border-info">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div>
                                    <h4 class="mb-0 fw-bold text-secondary">Department</p>
                                        <h4 class="my-1 text-info">
                                            @forelse ($departmentCourses as $deptDesc => $courseCount)
                                                {{ $deptDesc }} - {{ $courseCount }}
                                                {{ Str::plural('schedule', $courseCount) }}
                                                <br>
                                            @empty
                                                No schedules available
                                            @endforelse
                                        </h4>
                                        <p class="mb-0 font-13">No. of Schedules</p>
                                </div>
                                <div class="widgets-icons-2 rounded-circle bg-info text-white ms-auto"><i
                                        class="fa-solid fa-building"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col w-50">
                    <div class="card p-5 radius-10 border-start border-0 border-3 border-secondary">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div>
                                    <h4 class="mb-0 fw-bold text-secondary">Room
                                        Utilized</p>
                                        <h4 class="my-1 text-secondary"> {{ $totalRooms }} out of
                                            {{ $allRooms }}
                                            Rooms Utilized OR
                                            {{ number_format($roomUtilization, 2) }}% Room
                                            Utilization </h4>
                                        <p class="mb-0 font-13">No. of Rooms Utilized</p>
                                        <br>
                                </div>
                                <div class="widgets-icons-2 rounded-circle bg-secondary text-white ms-auto"><i
                                        class="fa-solid fa-house-user"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col w-100">
                    <div class="card p-5 radius-10 border-start border-0 border-3 border-dark">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div>
                                    <h4 class="mb-0 fw-bold text-secondary">Campus</p>
                                        <h4 class="my-1 text-dark">
                                            @forelse ($campusCourses as $campus => $courseCount)
                                                {{ $campus }} - {{ $courseCount }}
                                                {{ Str::plural('schedule', $courseCount) }}
                                                <br>
                                            @empty
                                                No schedules available
                                            @endforelse
                                        </h4>
                                        <p class="mb-0 font-13">No. of Schedules</p>
                                </div>
                                <div class="widgets-icons-2 rounded-circle bg-dark text-white ms-auto"><i
                                        class="fa-solid fa-building"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <br><br><br><br><br><br>
        </div>
    </div>
    <footer class="text-center text-lg-start">
        <div class="text-center fw-bold p-3">Pangasinan State University • San Vicente • Urdaneta City • Pangasinan •
            (075) 542 5133<br>
            © 2023 Copyright:
        </div>
    </footer>
</body>

</html>
<?php
 }
 ?>
