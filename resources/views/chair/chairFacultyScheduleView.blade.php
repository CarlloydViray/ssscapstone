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
    <link rel="icon" href="/assets/logo/favicon-16x16.png" type="image/x-icon">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/mis_edit.css') }}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    {{-- datatable bootsrap --}}
    {{-- css --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">

    {{-- script --}}
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
    <title>Faculty Schedule</title>
</head>
<style>
    <style>.table-sched {
        border-collapse: collapse;
        width: 100%;
        margin: 20px;
        align-items: center;
    }

    .border {
        border: 3px solid blue;
        width: 100px; /* Adjust the width as needed */
        height: 70px;

    }

    .text {
        color: #082b54;
        font-weight: bold;

    }

    .text1 {
        color: #082b54;
        font-weight: bold;
        font-size: 15px;
    }

    .active .text1 {
        color: white;
    }

    .active .text {
        color: white;
    }


    th {
        background-color: transparent;

    }

    .active th {
        background-color: none;
        color: white;
    }

    .text-center {
        text-align: center;
    }

    .link {
        decoration: none;
    }

    #subjectTable tbody tr:hover,
    #subjectTable tbody tr:nth-child(odd):hover,
    #subjectTable tbody tr:nth-child(even):hover {
        background-color: #082b54;
        transform: scale(1.02);
        transition: background-color 0.3s, transform 0.1s;
    }

    #subjectTable tbody tr:hover td,
    #subjectTable tbody tr:nth-child(odd):hover td,
    #subjectTable tbody tr:nth-child(even):hover td {
        color: #F3D370;
    }

    .activee #subjectTable tbody tr:hover,
    .active #subjectTable tbody tr:nth-child(odd):hover,
    .active #subjectTable tbody tr:nth-child(even):hover {
        transform: scale(1.02);
        transition: background-color 0.3s, transform 0.1s;
        background-color: #2D3436;
    }

    .active #subjectTable tbody tr td,
    .active #subjectTable tbody tr:nth-child(odd) td,
    .active #subjectTable tbody tr:nth-child(even) td {
        color: white;
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
    <button class="darkmode shadow-lg  btn-primary p-4" title=" Dark Mode" onclick="toggleDarkMode()">
        <i class="fa-solid fa-moon"></i></button>
    <div class="container contains">
        <div class="dark"></div>
    </div>
    <div class="scrollable-form">
        <div class="navbar shadow-lg fixed-top">
            <a href="/facultyScheduleManage/{{ $section_schedules->first()->faculty_id }}"
                class="fw-bold title link p-5" style="font-size:20px;">
                <i class="fa-solid fa-arrow-left"></i> Back</a>
            <div class="navbar-info" style=" width: 330px;">
                <div class="row">
                    <div class="col-md-6 mt-3 user-name">

                        <center>
                            <div class="row">
                                <h5 class=" title">
                                    {{ session('user_firstName') . ' ' . session('user_lastName') }}</h5>
                            </div>
                            <div class="row">
                                <h6 class="title">{{ session('dept_code') }}</h6>
                            </div>
                            <div class="row">
                                <h6 class=" title">{{ session('campus_code') }}</h6>
                            </div>
                        </center>
                    </div>
                </div>
            </div>
        </div>
        <br><br>
        <div class="container-fluid shadow-lg  mb-3  rounded" style="margin-top: 170px;">
            <h1 class="edit-user-title edit-user-container">
                {{ $section_schedules->first()->faculty_firstName . ' ' . $section_schedules->first()->faculty_lastName }}
                - SCHEDULE</h1>
            <div class="container-fluid rounded  p-5">
                <div class="col">



                    <div class="container-fluid mb-5">
                        <div class="col  d-flex justify-content-center " style="border: 2px;">
                            <table style="width:100%" class=" text-center mb-5 shadow table-sched"id="scheduleTable">
                                <thead>
                                    <tr class="border" style="background-color:#082b54; color:#F3D370;">
                                        <th class="border">TIME</th>
                                        <th class="border">MONDAY</th>
                                        <th class="border">TUESDAY</th>
                                        <th class="border">WEDNESDAY</th>
                                        <th class="border">THURSDAY</th>
                                        <th class="border">FRIDAY</th>
                                        <th class="border">SATURDAY</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <tr class="border">
                                        <td class="border text">08:00<br>08:30</td>
                                        <td class="border text">
                                            @foreach ($section_schedules as $schedule)
                                                @if ($schedule->day == 'Monday' && $schedule->start_time < '08:30' && $schedule->end_time > '08:00')
                                                    {{ $schedule->subject_desc }}<br>
                                                    {{ $schedule->room_desc }}<br>
                                                    {{ $schedule->section_desc }}
                                                @endif
                                            @endforeach

                                        </td>



                                        <td class="border text">
                                            @foreach ($section_schedules as $schedule)
                                                @if ($schedule->day == 'Tuesday' && $schedule->start_time < '08:30' && $schedule->end_time > '08:00')
                                                    {{ $schedule->subject_desc }}<br>
                                                    {{ $schedule->room_desc }}<br>
                                                    {{ $schedule->section_desc }}
                                                @endif
                                            @endforeach
                                        </td>


                                        <td class="border text">
                                            @foreach ($section_schedules as $schedule)
                                                @if ($schedule->day == 'Wednesday' && $schedule->start_time < '08:30' && $schedule->end_time > '08:00')
                                                    {{ $schedule->subject_desc }}<br>
                                                    {{ $schedule->room_desc }}<br>
                                                    {{ $schedule->section_desc }}
                                                @endif
                                            @endforeach
                                        </td>


                                        <td class="border text">
                                            @foreach ($section_schedules as $schedule)
                                                @if ($schedule->day == 'Thursday' && $schedule->start_time < '08:30' && $schedule->end_time > '08:00')
                                                    {{ $schedule->subject_desc }}<br>
                                                    {{ $schedule->room_desc }}<br>
                                                    {{ $schedule->section_desc }}
                                                @endif
                                            @endforeach
                                        </td>

                                        <td class="border text">
                                            @foreach ($section_schedules as $schedule)
                                                @if ($schedule->day == 'Friday' && $schedule->start_time < '08:30' && $schedule->end_time > '08:00')
                                                    {{ $schedule->subject_desc }}<br>
                                                    {{ $schedule->room_desc }}<br>
                                                    {{ $schedule->section_desc }}
                                                @endif
                                            @endforeach
                                        </td>


                                        <td class="border text">
                                            @foreach ($section_schedules as $schedule)
                                                @if ($schedule->day == 'Saturday' && $schedule->start_time < '08:30' && $schedule->end_time > '08:00')
                                                    {{ $schedule->subject_desc }}<br>
                                                    {{ $schedule->room_desc }}<br>
                                                    {{ $schedule->section_desc }}
                                                @endif
                                            @endforeach
                                        </td>
                                    </tr>

                                    <tr class="border">

                                        <td class="border text">08:30<br>09:00</td>

                                        <td class="border text">
                                            @foreach ($section_schedules as $schedule)
                                                @if ($schedule->day == 'Monday' && $schedule->start_time < '09:00' && $schedule->end_time > '08:30')
                                                    {{ $schedule->subject_desc }}<br>
                                                    {{ $schedule->room_desc }}<br>
                                                    {{ $schedule->section_desc }}
                                                @endif
                                            @endforeach

                                        </td>



                                        <td class="border text">
                                            @foreach ($section_schedules as $schedule)
                                                @if ($schedule->day == 'Tuesday' && $schedule->start_time < '09:00' && $schedule->end_time > '08:30')
                                                    {{ $schedule->subject_desc }}<br>
                                                    {{ $schedule->room_desc }}<br>
                                                    {{ $schedule->section_desc }}
                                                @endif
                                            @endforeach
                                        </td>


                                        <td class="border text">
                                            @foreach ($section_schedules as $schedule)
                                                @if ($schedule->day == 'Wednesday' && $schedule->start_time < '09:00' && $schedule->end_time > '08:30')
                                                    {{ $schedule->subject_desc }}<br>
                                                    {{ $schedule->room_desc }}<br>
                                                    {{ $schedule->section_desc }}
                                                @endif
                                            @endforeach
                                        </td>


                                        <td class="border text">
                                            @foreach ($section_schedules as $schedule)
                                                @if ($schedule->day == 'Thursday' && $schedule->start_time < '09:00' && $schedule->end_time > '08:30')
                                                    {{ $schedule->subject_desc }}<br>
                                                    {{ $schedule->room_desc }}<br>
                                                    {{ $schedule->section_desc }}
                                                @endif
                                            @endforeach
                                        </td>

                                        <td class="border text">
                                            @foreach ($section_schedules as $schedule)
                                                @if ($schedule->day == 'Friday' && $schedule->start_time < '09:00' && $schedule->end_time > '08:30')
                                                    {{ $schedule->subject_desc }}<br>
                                                    {{ $schedule->room_desc }}<br>
                                                    {{ $schedule->section_desc }}
                                                @endif
                                            @endforeach
                                        </td>


                                        <td class="border text">
                                            @foreach ($section_schedules as $schedule)
                                                @if ($schedule->day == 'Saturday' && $schedule->start_time < '09:00' && $schedule->end_time > '08:30')
                                                    {{ $schedule->subject_desc }}<br>
                                                    {{ $schedule->room_desc }}<br>
                                                    {{ $schedule->section_desc }}
                                                @endif
                                            @endforeach
                                        </td>
                                    </tr>



                                    <tr class=" border">
                                        <td class="border text">09:00<br>09:30</td>
                                        <td class="border text">
                                            @foreach ($section_schedules as $schedule)
                                                @if ($schedule->day == 'Monday' && $schedule->start_time < '09:30' && $schedule->end_time > '09:00')
                                                    {{ $schedule->subject_desc }}<br>
                                                    {{ $schedule->room_desc }}<br>
                                                    {{ $schedule->section_desc }}
                                                @endif
                                            @endforeach
                                        </td>

                                        <td class="border text">
                                            @foreach ($section_schedules as $schedule)
                                                @if ($schedule->day == 'Tuesday' && $schedule->start_time < '09:30' && $schedule->end_time > '09:00')
                                                    {{ $schedule->subject_desc }}<br>
                                                    {{ $schedule->room_desc }}<br>
                                                    {{ $schedule->section_desc }}
                                                @endif
                                            @endforeach
                                        </td>

                                        <td class="border text">
                                            @foreach ($section_schedules as $schedule)
                                                @if ($schedule->day == 'Wednesday' && $schedule->start_time < '09:30' && $schedule->end_time > '09:00')
                                                    {{ $schedule->subject_desc }}<br>
                                                    {{ $schedule->room_desc }}<br>
                                                    {{ $schedule->section_desc }}
                                                @endif
                                            @endforeach
                                        </td>


                                        <td class="border text">
                                            @foreach ($section_schedules as $schedule)
                                                @if ($schedule->day == 'Thursday' && $schedule->start_time < '09:30' && $schedule->end_time > '09:00')
                                                    {{ $schedule->subject_desc }}<br>
                                                    {{ $schedule->room_desc }}<br>
                                                    {{ $schedule->section_desc }}
                                                @endif
                                            @endforeach
                                        </td>

                                        <td class="border text">
                                            @foreach ($section_schedules as $schedule)
                                                @if ($schedule->day == 'Friday' && $schedule->start_time < '09:30' && $schedule->end_time > '09:00')
                                                    {{ $schedule->subject_desc }}<br>
                                                    {{ $schedule->room_desc }}<br>
                                                    {{ $schedule->section_desc }}
                                                @endif
                                            @endforeach
                                        </td>


                                        <td class="border text">
                                            @foreach ($section_schedules as $schedule)
                                                @if ($schedule->day == 'Saturday' && $schedule->start_time < '09:30' && $schedule->end_time > '09:00')
                                                    {{ $schedule->subject_desc }}<br>
                                                    {{ $schedule->room_desc }}<br>
                                                    {{ $schedule->section_desc }}
                                                @endif
                                            @endforeach
                                        </td>
                                    </tr>

                                    <tr class=" border">
                                        <td class="border text">09:30<br>10:00</td>
                                        <td class="border text">
                                            @foreach ($section_schedules as $schedule)
                                                @if ($schedule->day == 'Monday' && $schedule->start_time < '10:00' && $schedule->end_time > '09:30')
                                                    {{ $schedule->subject_desc }}<br>
                                                    {{ $schedule->room_desc }}<br>
                                                    {{ $schedule->section_desc }}
                                                @endif
                                            @endforeach
                                        </td>

                                        <td class="border text">
                                            @foreach ($section_schedules as $schedule)
                                                @if ($schedule->day == 'Tuesday' && $schedule->start_time < '10:00' && $schedule->end_time > '09:30')
                                                    {{ $schedule->subject_desc }}<br>
                                                    {{ $schedule->room_desc }}<br>
                                                    {{ $schedule->section_desc }}
                                                @endif
                                            @endforeach
                                        </td>

                                        <td class="border text">
                                            @foreach ($section_schedules as $schedule)
                                                @if ($schedule->day == 'Wednesday' && $schedule->start_time < '10:00' && $schedule->end_time > '09:30')
                                                    {{ $schedule->subject_desc }}<br>
                                                    {{ $schedule->room_desc }}<br>
                                                    {{ $schedule->section_desc }}
                                                @endif
                                            @endforeach
                                        </td>


                                        <td class="border text">
                                            @foreach ($section_schedules as $schedule)
                                                @if ($schedule->day == 'Thursday' && $schedule->start_time < '10:00' && $schedule->end_time > '09:30')
                                                    {{ $schedule->subject_desc }}<br>
                                                    {{ $schedule->room_desc }}<br>
                                                    {{ $schedule->section_desc }}
                                                @endif
                                            @endforeach
                                        </td>

                                        <td class="border text">
                                            @foreach ($section_schedules as $schedule)
                                                @if ($schedule->day == 'Friday' && $schedule->start_time < '10:00' && $schedule->end_time > '09:30')
                                                    {{ $schedule->subject_desc }}<br>
                                                    {{ $schedule->room_desc }}<br>
                                                    {{ $schedule->section_desc }}
                                                @endif
                                            @endforeach
                                        </td>


                                        <td class="border text">
                                            @foreach ($section_schedules as $schedule)
                                                @if ($schedule->day == 'Saturday' && $schedule->start_time < '10:00' && $schedule->end_time > '09:30')
                                                    {{ $schedule->subject_desc }}<br>
                                                    {{ $schedule->room_desc }}<br>
                                                    {{ $schedule->section_desc }}
                                                @endif
                                            @endforeach
                                        </td>
                                    </tr>

                                    <tr class="border">
                                        <td class="border text">10:00<br>10:30</td>
                                        <td class="border text">
                                            @foreach ($section_schedules as $schedule)
                                                @if ($schedule->day == 'Monday' && $schedule->start_time < '10:30' && $schedule->end_time > '10:00')
                                                    {{ $schedule->subject_desc }}<br>
                                                    {{ $schedule->room_desc }}<br>
                                                    {{ $schedule->section_desc }}
                                                @endif
                                            @endforeach
                                        </td>

                                        <td class="border text">
                                            @foreach ($section_schedules as $schedule)
                                                @if ($schedule->day == 'Tuesday' && $schedule->start_time < '10:30' && $schedule->end_time > '10:00')
                                                    {{ $schedule->subject_desc }}<br>
                                                    {{ $schedule->room_desc }}<br>
                                                    {{ $schedule->section_desc }}
                                                @endif
                                            @endforeach
                                        </td>

                                        <td class="border text">
                                            @foreach ($section_schedules as $schedule)
                                                @if ($schedule->day == 'Wednesday' && $schedule->start_time < '10:30' && $schedule->end_time > '10:00')
                                                    {{ $schedule->subject_desc }}<br>
                                                    {{ $schedule->room_desc }}<br>
                                                    {{ $schedule->section_desc }}
                                                @endif
                                            @endforeach
                                        </td>


                                        <td class="border text">
                                            @foreach ($section_schedules as $schedule)
                                                @if ($schedule->day == 'Thursday' && $schedule->start_time < '10:30' && $schedule->end_time > '10:00')
                                                    {{ $schedule->subject_desc }}<br>
                                                    {{ $schedule->room_desc }}<br>
                                                    {{ $schedule->section_desc }}
                                                @endif
                                            @endforeach
                                        </td>

                                        <td class="border text">
                                            @foreach ($section_schedules as $schedule)
                                                @if ($schedule->day == 'Friday' && $schedule->start_time < '10:30' && $schedule->end_time > '10:00')
                                                    {{ $schedule->subject_desc }}<br>
                                                    {{ $schedule->room_desc }}<br>
                                                    {{ $schedule->section_desc }}
                                                @endif
                                            @endforeach
                                        </td>


                                        <td class="border text">
                                            @foreach ($section_schedules as $schedule)
                                                @if ($schedule->day == 'Saturday' && $schedule->start_time < '10:30' && $schedule->end_time > '10:00')
                                                    {{ $schedule->subject_desc }}<br>
                                                    {{ $schedule->room_desc }}<br>
                                                    {{ $schedule->section_desc }}
                                                @endif
                                            @endforeach
                                        </td>
                                    </tr>

                                    <tr class=" border">
                                        <td class="border text">10:30<br>11:00</td>
                                        <td class="border text">
                                            @foreach ($section_schedules as $schedule)
                                                @if ($schedule->day == 'Monday' && $schedule->start_time < '11:00' && $schedule->end_time > '10:30')
                                                    {{ $schedule->subject_desc }}<br>
                                                    {{ $schedule->room_desc }}<br>
                                                    {{ $schedule->section_desc }}
                                                @endif
                                            @endforeach
                                        </td>

                                        <td class="border text">
                                            @foreach ($section_schedules as $schedule)
                                                @if ($schedule->day == 'Tuesday' && $schedule->start_time < '11:00' && $schedule->end_time > '10:30')
                                                    {{ $schedule->subject_desc }}<br>
                                                    {{ $schedule->room_desc }}<br>
                                                    {{ $schedule->section_desc }}
                                                @endif
                                            @endforeach
                                        </td>

                                        <td class="border text">
                                            @foreach ($section_schedules as $schedule)
                                                @if ($schedule->day == 'Wednesday' && $schedule->start_time < '11:00' && $schedule->end_time > '10:30')
                                                    {{ $schedule->subject_desc }}<br>
                                                    {{ $schedule->room_desc }}<br>
                                                    {{ $schedule->section_desc }}
                                                @endif
                                            @endforeach
                                        </td>


                                        <td class="border text">
                                            @foreach ($section_schedules as $schedule)
                                                @if ($schedule->day == 'Thursday' && $schedule->start_time < '11:00' && $schedule->end_time > '10:30')
                                                    {{ $schedule->subject_desc }}<br>
                                                    {{ $schedule->room_desc }}<br>
                                                    {{ $schedule->section_desc }}
                                                @endif
                                            @endforeach
                                        </td>

                                        <td class="border text">
                                            @foreach ($section_schedules as $schedule)
                                                @if ($schedule->day == 'Friday' && $schedule->start_time < '11:00' && $schedule->end_time > '10:30')
                                                    {{ $schedule->subject_desc }}<br>
                                                    {{ $schedule->room_desc }}<br>
                                                    {{ $schedule->section_desc }}
                                                @endif
                                            @endforeach
                                        </td>


                                        <td class="border text">
                                            @foreach ($section_schedules as $schedule)
                                                @if ($schedule->day == 'Saturday' && $schedule->start_time < '11:00' && $schedule->end_time > '10:30')
                                                    {{ $schedule->subject_desc }}<br>
                                                    {{ $schedule->room_desc }}<br>
                                                    {{ $schedule->section_desc }}
                                                @endif
                                            @endforeach
                                        </td>
                                    </tr>


                                    <tr class="border">
                                        <td class="border text">11:00<br>11:30</td>
                                        <td class="border text">
                                            @foreach ($section_schedules as $schedule)
                                                @if ($schedule->day == 'Monday' && $schedule->start_time < '11:30' && $schedule->end_time > '11:00')
                                                    {{ $schedule->subject_desc }}<br>
                                                    {{ $schedule->room_desc }}<br>
                                                    {{ $schedule->section_desc }}
                                                @endif
                                            @endforeach
                                        </td>

                                        <td class="border text">
                                            @foreach ($section_schedules as $schedule)
                                                @if ($schedule->day == 'Tuesday' && $schedule->start_time < '11:30' && $schedule->end_time > '11:00')
                                                    {{ $schedule->subject_desc }}<br>
                                                    {{ $schedule->room_desc }}<br>
                                                    {{ $schedule->section_desc }}
                                                @endif
                                            @endforeach
                                        </td>

                                        <td class="border text">
                                            @foreach ($section_schedules as $schedule)
                                                @if ($schedule->day == 'Wednesday' && $schedule->start_time < '11:30' && $schedule->end_time > '11:00')
                                                    {{ $schedule->subject_desc }}<br>
                                                    {{ $schedule->room_desc }}<br>
                                                    {{ $schedule->section_desc }}
                                                @endif
                                            @endforeach
                                        </td>

                                        <td class="border text">
                                            @foreach ($section_schedules as $schedule)
                                                @if ($schedule->day == 'Thursday' && $schedule->start_time < '11:30' && $schedule->end_time > '11:00')
                                                    {{ $schedule->subject_desc }}<br>
                                                    {{ $schedule->room_desc }}<br>
                                                    {{ $schedule->section_desc }}
                                                @endif
                                            @endforeach
                                        </td>

                                        <td class="border text">
                                            @foreach ($section_schedules as $schedule)
                                                @if ($schedule->day == 'Friday' && $schedule->start_time < '11:30' && $schedule->end_time > '11:00')
                                                    {{ $schedule->subject_desc }}<br>
                                                    {{ $schedule->room_desc }}<br>
                                                    {{ $schedule->section_desc }}
                                                @endif
                                            @endforeach
                                        </td>

                                        <td class="border text">
                                            @foreach ($section_schedules as $schedule)
                                                @if ($schedule->day == 'Saturday' && $schedule->start_time < '11:30' && $schedule->end_time > '11:00')
                                                    {{ $schedule->subject_desc }}<br>
                                                    {{ $schedule->room_desc }}<br>
                                                    {{ $schedule->section_desc }}
                                                @endif
                                            @endforeach
                                        </td>



                                    </tr>
                                    <tr class="text-center border">
                                        <td class="border text">11:30<br>12:00</td>
                                        <td class="border text">
                                            @foreach ($section_schedules as $schedule)
                                                @if ($schedule->day == 'Monday' && $schedule->start_time < '12:00' && $schedule->end_time > '11:30')
                                                    {{ $schedule->subject_desc }}<br>
                                                    {{ $schedule->room_desc }}<br>
                                                    {{ $schedule->section_desc }}
                                                @endif
                                            @endforeach
                                        </td>

                                        <td class="border text">
                                            @foreach ($section_schedules as $schedule)
                                                @if ($schedule->day == 'Tuesday' && $schedule->start_time < '12:00' && $schedule->end_time > '11:30')
                                                    {{ $schedule->subject_desc }}<br>
                                                    {{ $schedule->room_desc }}<br>
                                                    {{ $schedule->section_desc }}
                                                @endif
                                            @endforeach
                                        </td>

                                        <td class="border text">
                                            @foreach ($section_schedules as $schedule)
                                                @if ($schedule->day == 'Wednesday' && $schedule->start_time < '12:00' && $schedule->end_time > '11:30')
                                                    {{ $schedule->subject_desc }}<br>
                                                    {{ $schedule->room_desc }}<br>
                                                    {{ $schedule->section_desc }}
                                                @endif
                                            @endforeach
                                        </td>

                                        <td class="border text">
                                            @foreach ($section_schedules as $schedule)
                                                @if ($schedule->day == 'Thursday' && $schedule->start_time < '12:00' && $schedule->end_time > '11:30')
                                                    {{ $schedule->subject_desc }}<br>
                                                    {{ $schedule->room_desc }}<br>
                                                    {{ $schedule->section_desc }}
                                                @endif
                                            @endforeach
                                        </td>


                                        <td class="border text">
                                            @foreach ($section_schedules as $schedule)
                                                @if ($schedule->day == 'Friday' && $schedule->start_time < '12:00' && $schedule->end_time > '11:30')
                                                    {{ $schedule->subject_desc }}<br>
                                                    {{ $schedule->room_desc }}<br>
                                                    {{ $schedule->section_desc }}
                                                @endif
                                            @endforeach
                                        </td>

                                        <td class="border text">
                                            @foreach ($section_schedules as $schedule)
                                                @if ($schedule->day == 'Saturday' && $schedule->start_time < '12:00' && $schedule->end_time > '11:30')
                                                    {{ $schedule->subject_desc }}<br>
                                                    {{ $schedule->room_desc }}<br>
                                                    {{ $schedule->section_desc }}
                                                @endif
                                            @endforeach
                                        </td>
                                    </tr>


                                    <tr class="text-center border">
                                        <td class="border text">12:00<br>12:30</td>
                                        <td class="border text">
                                            @foreach ($section_schedules as $schedule)
                                                @if ($schedule->day == 'Monday' && $schedule->start_time < '12:30' && $schedule->end_time > '12:00')
                                                    {{ $schedule->subject_desc }}<br>
                                                    {{ $schedule->room_desc }}<br>
                                                    {{ $schedule->section_desc }}
                                                @endif
                                            @endforeach
                                        </td>


                                        <td class="border text">
                                            @foreach ($section_schedules as $schedule)
                                                @if ($schedule->day == 'Tuesday' && $schedule->start_time < '12:30' && $schedule->end_time > '12:00')
                                                    {{ $schedule->subject_desc }}<br>
                                                    {{ $schedule->room_desc }}<br>
                                                    {{ $schedule->section_desc }}
                                                @endif
                                            @endforeach
                                        </td>

                                        <td class="border text">
                                            @foreach ($section_schedules as $schedule)
                                                @if ($schedule->day == 'Wednesday' && $schedule->start_time < '12:30' && $schedule->end_time > '12:00')
                                                    {{ $schedule->subject_desc }}<br>
                                                    {{ $schedule->room_desc }}<br>
                                                    {{ $schedule->section_desc }}
                                                @endif
                                            @endforeach
                                        </td>

                                        <td class="border text">
                                            @foreach ($section_schedules as $schedule)
                                                @if ($schedule->day == 'Thursday' && $schedule->start_time < '12:30' && $schedule->end_time > '12:00')
                                                    {{ $schedule->subject_desc }}<br>
                                                    {{ $schedule->room_desc }}<br>
                                                    {{ $schedule->section_desc }}
                                                @endif
                                            @endforeach
                                        </td>

                                        <td class="border text">
                                            @foreach ($section_schedules as $schedule)
                                                @if ($schedule->day == 'Friday' && $schedule->start_time < '12:30' && $schedule->end_time > '12:00')
                                                    {{ $schedule->subject_desc }}<br>
                                                    {{ $schedule->room_desc }}<br>
                                                    {{ $schedule->section_desc }}
                                                @endif
                                            @endforeach
                                        </td>

                                        <td class="border text">
                                            @foreach ($section_schedules as $schedule)
                                                @if ($schedule->day == 'Saturday' && $schedule->start_time < '12:30' && $schedule->end_time > '12:00')
                                                    {{ $schedule->subject_desc }}<br>
                                                    {{ $schedule->room_desc }}<br>
                                                    {{ $schedule->section_desc }}
                                                @endif
                                            @endforeach
                                        </td>
                                    </tr>


                                    <tr class="text-center border">
                                        <td class="border text">12:30<br>1:00</td>
                                        <td class="border text">
                                            @foreach ($section_schedules as $schedule)
                                                @if ($schedule->day == 'Monday' && $schedule->start_time < '13:00' && $schedule->end_time > '12:30')
                                                    {{ $schedule->subject_desc }}<br>
                                                    {{ $schedule->room_desc }}<br>
                                                    {{ $schedule->section_desc }}
                                                @endif
                                            @endforeach
                                        </td>

                                        <td class="border text">
                                            @foreach ($section_schedules as $schedule)
                                                @if ($schedule->day == 'Tuesday' && $schedule->start_time < '13:00' && $schedule->end_time > '12:30')
                                                    {{ $schedule->subject_desc }}<br>
                                                    {{ $schedule->room_desc }}<br>
                                                    {{ $schedule->section_desc }}
                                                @endif
                                            @endforeach
                                        </td>

                                        <td class="border text">
                                            @foreach ($section_schedules as $schedule)
                                                @if ($schedule->day == 'Wednesday' && $schedule->start_time < '13:00' && $schedule->end_time > '12:30')
                                                    {{ $schedule->subject_desc }}<br>
                                                    {{ $schedule->room_desc }}<br>
                                                    {{ $schedule->section_desc }}
                                                @endif
                                            @endforeach
                                        </td>

                                        <td class="border text">
                                            @foreach ($section_schedules as $schedule)
                                                @if ($schedule->day == 'Thursday' && $schedule->start_time < '13:00' && $schedule->end_time > '12:30')
                                                    {{ $schedule->subject_desc }}<br>
                                                    {{ $schedule->room_desc }}<br>
                                                    {{ $schedule->section_desc }}
                                                @endif
                                            @endforeach
                                        </td>

                                        <td class="border text">
                                            @foreach ($section_schedules as $schedule)
                                                @if ($schedule->day == 'Friday' && $schedule->start_time < '13:00' && $schedule->end_time > '12:30')
                                                    {{ $schedule->subject_desc }}<br>
                                                    {{ $schedule->room_desc }}<br>
                                                    {{ $schedule->section_desc }}
                                                @endif
                                            @endforeach
                                        </td>

                                        <td class="border text">
                                            @foreach ($section_schedules as $schedule)
                                                @if ($schedule->day == 'Saturday' && $schedule->start_time < '13:00' && $schedule->end_time > '12:30')
                                                    {{ $schedule->subject_desc }}<br>
                                                    {{ $schedule->room_desc }}<br>
                                                    {{ $schedule->section_desc }}
                                                @endif
                                            @endforeach
                                        </td>
                                    </tr>
                                    <tr class="text-center border">
                                        <td class="border text">01:00<br>01:30</td>
                                        <td class="border text">
                                            @foreach ($section_schedules as $schedule)
                                                @if ($schedule->day == 'Monday' && $schedule->start_time < '13:30' && $schedule->end_time > '13:00')
                                                    {{ $schedule->subject_desc }}<br>
                                                    {{ $schedule->room_desc }}<br>
                                                    {{ $schedule->section_desc }}
                                                @endif
                                            @endforeach
                                        </td>

                                        <td class="border text">
                                            @foreach ($section_schedules as $schedule)
                                                @if ($schedule->day == 'Tuesday' && $schedule->start_time < '13:30' && $schedule->end_time > '13:00')
                                                    {{ $schedule->subject_desc }}<br>
                                                    {{ $schedule->room_desc }}<br>
                                                    {{ $schedule->section_desc }}
                                                @endif
                                            @endforeach
                                        </td>

                                        <td class="border text">
                                            @foreach ($section_schedules as $schedule)
                                                @if ($schedule->day == 'Wednesday' && $schedule->start_time < '13:30' && $schedule->end_time > '13:00')
                                                    {{ $schedule->subject_desc }}<br>
                                                    {{ $schedule->room_desc }}<br>
                                                    {{ $schedule->section_desc }}
                                                @endif
                                            @endforeach
                                        </td>

                                        <td class="border text">
                                            @foreach ($section_schedules as $schedule)
                                                @if ($schedule->day == 'Thursday' && $schedule->start_time < '13:30' && $schedule->end_time > '13:00')
                                                    {{ $schedule->subject_desc }}<br>
                                                    {{ $schedule->room_desc }}<br>
                                                    {{ $schedule->section_desc }}
                                                @endif
                                            @endforeach
                                        </td>

                                        <td class="border text">
                                            @foreach ($section_schedules as $schedule)
                                                @if ($schedule->day == 'Friday' && $schedule->start_time < '13:30' && $schedule->end_time > '13:00')
                                                    {{ $schedule->subject_desc }}<br>
                                                    {{ $schedule->room_desc }}<br>
                                                    {{ $schedule->section_desc }}
                                                @endif
                                            @endforeach
                                        </td>

                                        <td class="border text">
                                            @foreach ($section_schedules as $schedule)
                                                @if ($schedule->day == 'Saturday' && $schedule->start_time < '13:30' && $schedule->end_time > '13:00')
                                                    {{ $schedule->subject_desc }}<br>
                                                    {{ $schedule->room_desc }}<br>
                                                    {{ $schedule->section_desc }}
                                                @endif
                                            @endforeach
                                        </td>
                                    </tr>
                                    <tr class="text-center border">
                                        <td class="border text">01:30<br>02:00</td>
                                        <td class="border text">
                                            @foreach ($section_schedules as $schedule)
                                                @if ($schedule->day == 'Monday' && $schedule->start_time < '14:00' && $schedule->end_time > '13:30')
                                                    {{ $schedule->subject_desc }}<br>
                                                    {{ $schedule->room_desc }}<br>
                                                    {{ $schedule->section_desc }}
                                                @endif
                                            @endforeach
                                        </td>

                                        <td class="border text">
                                            @foreach ($section_schedules as $schedule)
                                                @if ($schedule->day == 'Tuesday' && $schedule->start_time < '14:00' && $schedule->end_time > '13:30')
                                                    {{ $schedule->subject_desc }}<br>
                                                    {{ $schedule->room_desc }}<br>
                                                    {{ $schedule->section_desc }}
                                                @endif
                                            @endforeach
                                        </td>

                                        <td class="border text">
                                            @foreach ($section_schedules as $schedule)
                                                @if ($schedule->day == 'Wednesday' && $schedule->start_time < '14:00' && $schedule->end_time > '13:30')
                                                    {{ $schedule->subject_desc }}<br>
                                                    {{ $schedule->room_desc }}<br>
                                                    {{ $schedule->section_desc }}
                                                @endif
                                            @endforeach
                                        </td>

                                        <td class="border text">
                                            @foreach ($section_schedules as $schedule)
                                                @if ($schedule->day == 'Thursday' && $schedule->start_time < '14:00' && $schedule->end_time > '13:30')
                                                    {{ $schedule->subject_desc }}<br>
                                                    {{ $schedule->room_desc }}<br>
                                                    {{ $schedule->section_desc }}
                                                @endif
                                            @endforeach
                                        </td>

                                        <td class="border text">
                                            @foreach ($section_schedules as $schedule)
                                                @if ($schedule->day == 'Friday' && $schedule->start_time < '14:00' && $schedule->end_time > '13:30')
                                                    {{ $schedule->subject_desc }}<br>
                                                    {{ $schedule->room_desc }}<br>
                                                    {{ $schedule->section_desc }}
                                                @endif
                                            @endforeach
                                        </td>

                                        <td class="border text">
                                            @foreach ($section_schedules as $schedule)
                                                @if ($schedule->day == 'Saturday' && $schedule->start_time < '14:00' && $schedule->end_time > '13:30')
                                                    {{ $schedule->subject_desc }}<br>
                                                    {{ $schedule->room_desc }}<br>
                                                    {{ $schedule->section_desc }}
                                                @endif
                                            @endforeach
                                        </td>
                                    </tr>
                                    <tr class="text-center border">
                                        <td class="border text">02:00<br>02:30</td>
                                        <td class="border text">
                                            @foreach ($section_schedules as $schedule)
                                                @if ($schedule->day == 'Monday' && $schedule->start_time < '14:30' && $schedule->end_time > '14:00')
                                                    {{ $schedule->subject_desc }}<br>
                                                    {{ $schedule->room_desc }}<br>
                                                    {{ $schedule->section_desc }}
                                                @endif
                                            @endforeach
                                        </td>

                                        <td class="border text">
                                            @foreach ($section_schedules as $schedule)
                                                @if ($schedule->day == 'Tuesday' && $schedule->start_time < '14:30' && $schedule->end_time > '14:00')
                                                    {{ $schedule->subject_desc }}<br>
                                                    {{ $schedule->room_desc }}
                                                    <br>
                                                    {{ $schedule->section_desc }}
                                                @endif
                                            @endforeach
                                        </td>

                                        <td class="border text">
                                            @foreach ($section_schedules as $schedule)
                                                @if ($schedule->day == 'Wednesday' && $schedule->start_time < '14:30' && $schedule->end_time > '14:00')
                                                    {{ $schedule->subject_desc }}<br>
                                                    {{ $schedule->room_desc }}
                                                    <br>
                                                    {{ $schedule->section_desc }}
                                                @endif
                                            @endforeach
                                        </td>

                                        <td class="border text">
                                            @foreach ($section_schedules as $schedule)
                                                @if ($schedule->day == 'Thursday' && $schedule->start_time < '14:30' && $schedule->end_time > '14:00')
                                                    {{ $schedule->subject_desc }}<br>
                                                    {{ $schedule->room_desc }}
                                                    <br>
                                                    {{ $schedule->section_desc }}
                                                @endif
                                            @endforeach
                                        </td>

                                        <td class="border text">
                                            @foreach ($section_schedules as $schedule)
                                                @if ($schedule->day == 'Friday' && $schedule->start_time < '14:30' && $schedule->end_time > '14:00')
                                                    {{ $schedule->subject_desc }}<br>
                                                    {{ $schedule->room_desc }}
                                                    <br>
                                                    {{ $schedule->section_desc }}
                                                @endif
                                            @endforeach
                                        </td>

                                        <td class="border text">
                                            @foreach ($section_schedules as $schedule)
                                                @if ($schedule->day == 'Saturday' && $schedule->start_time < '14:30' && $schedule->end_time > '14:00')
                                                    {{ $schedule->subject_desc }}<br>
                                                    {{ $schedule->room_desc }}
                                                    <br>
                                                    {{ $schedule->section_desc }}
                                                @endif
                                            @endforeach
                                        </td>
                                    </tr>

                                    <tr class="text-center border">
                                        <td class="border text">02:30<br>03:00</td>
                                        <td class="border text">
                                            @foreach ($section_schedules as $schedule)
                                                @if ($schedule->day == 'Monday' && $schedule->start_time < '15:00' && $schedule->end_time > '14:30')
                                                    {{ $schedule->subject_desc }}<br>
                                                    {{ $schedule->room_desc }}<br>
                                                    {{ $schedule->section_desc }}
                                                @endif
                                            @endforeach
                                        </td>

                                        <td class="border text">
                                            @foreach ($section_schedules as $schedule)
                                                @if ($schedule->day == 'Tuesday' && $schedule->start_time < '15:00' && $schedule->end_time > '14:30')
                                                    {{ $schedule->subject_desc }}<br>
                                                    {{ $schedule->room_desc }}
                                                    <br>
                                                    {{ $schedule->section_desc }}
                                                @endif
                                            @endforeach
                                        </td>

                                        <td class="border text">
                                            @foreach ($section_schedules as $schedule)
                                                @if ($schedule->day == 'Wednesday' && $schedule->start_time < '15:00' && $schedule->end_time > '14:30')
                                                    {{ $schedule->subject_desc }}<br>
                                                    {{ $schedule->room_desc }}
                                                    <br>
                                                    {{ $schedule->section_desc }}
                                                @endif
                                            @endforeach
                                        </td>

                                        <td class="border text">
                                            @foreach ($section_schedules as $schedule)
                                                @if ($schedule->day == 'Thursday' && $schedule->start_time < '15:00' && $schedule->end_time > '14:30')
                                                    {{ $schedule->subject_desc }}<br>
                                                    {{ $schedule->room_desc }}
                                                    <br>
                                                    {{ $schedule->section_desc }}
                                                @endif
                                            @endforeach
                                        </td>

                                        <td class="border text">
                                            @foreach ($section_schedules as $schedule)
                                                @if ($schedule->day == 'Friday' && $schedule->start_time < '15:00' && $schedule->end_time > '14:30')
                                                    {{ $schedule->subject_desc }}<br>
                                                    {{ $schedule->room_desc }}
                                                    <br>
                                                    {{ $schedule->section_desc }}
                                                @endif
                                            @endforeach
                                        </td>

                                        <td class="border text">
                                            @foreach ($section_schedules as $schedule)
                                                @if ($schedule->day == 'Saturday' && $schedule->start_time < '15:00' && $schedule->end_time > '14:30')
                                                    {{ $schedule->subject_desc }}<br>
                                                    {{ $schedule->room_desc }}
                                                    <br>
                                                    {{ $schedule->section_desc }}
                                                @endif
                                            @endforeach
                                        </td>
                                    </tr>


                                    <tr class="text-center border">
                                        <td class="border text">03:00<br>03:30</td>
                                        <td class="border text">
                                            @foreach ($section_schedules as $schedule)
                                                @if ($schedule->day == 'Monday' && $schedule->start_time < '15:30' && $schedule->end_time > '15:00')
                                                    {{ $schedule->subject_desc }}<br>
                                                    {{ $schedule->room_desc }}<br>
                                                    {{ $schedule->section_desc }}
                                                @endif
                                            @endforeach
                                        </td>

                                        <td class="border text">
                                            @foreach ($section_schedules as $schedule)
                                                @if ($schedule->day == 'Tuesday' && $schedule->start_time < '15:30' && $schedule->end_time > '15:00')
                                                    {{ $schedule->subject_desc }}<br>
                                                    {{ $schedule->room_desc }}
                                                    <br>
                                                    {{ $schedule->section_desc }}
                                                @endif
                                            @endforeach
                                        </td>

                                        <td class="border text">
                                            @foreach ($section_schedules as $schedule)
                                                @if ($schedule->day == 'Wednesday' && $schedule->start_time < '15:30' && $schedule->end_time > '15:00')
                                                    {{ $schedule->subject_desc }}<br>
                                                    {{ $schedule->room_desc }}
                                                    <br>
                                                    {{ $schedule->section_desc }}
                                                @endif
                                            @endforeach
                                        </td>

                                        <td class="border text">
                                            @foreach ($section_schedules as $schedule)
                                                @if ($schedule->day == 'Thursday' && $schedule->start_time < '15:30' && $schedule->end_time > '15:00')
                                                    {{ $schedule->subject_desc }}<br>
                                                    {{ $schedule->room_desc }}
                                                    <br>
                                                    {{ $schedule->section_desc }}
                                                @endif
                                            @endforeach
                                        </td>

                                        <td class="border text">
                                            @foreach ($section_schedules as $schedule)
                                                @if ($schedule->day == 'Friday' && $schedule->start_time < '15:30' && $schedule->end_time > '15:00')
                                                    {{ $schedule->subject_desc }}<br>
                                                    {{ $schedule->room_desc }}
                                                    <br>
                                                    {{ $schedule->section_desc }}
                                                @endif
                                            @endforeach
                                        </td>

                                        <td class="border text">
                                            @foreach ($section_schedules as $schedule)
                                                @if ($schedule->day == 'Saturday' && $schedule->start_time < '15:30' && $schedule->end_time > '15:00')
                                                    {{ $schedule->subject_desc }}<br>
                                                    {{ $schedule->room_desc }}
                                                    <br>
                                                    {{ $schedule->section_desc }}
                                                @endif
                                            @endforeach
                                        </td>
                                    </tr>

                                    <tr class="text-center border">
                                        <td class="border text">03:30<br>04:00</td>
                                        <td class="border text">
                                            @foreach ($section_schedules as $schedule)
                                                @if ($schedule->day == 'Monday' && $schedule->start_time < '16:00' && $schedule->end_time > '15:30')
                                                    {{ $schedule->subject_desc }}<br>
                                                    {{ $schedule->room_desc }}<br>
                                                    {{ $schedule->section_desc }}
                                                @endif
                                            @endforeach
                                        </td>

                                        <td class="border text">
                                            @foreach ($section_schedules as $schedule)
                                                @if ($schedule->day == 'Tuesday' && $schedule->start_time < '16:00' && $schedule->end_time > '15:30')
                                                    {{ $schedule->subject_desc }}<br>
                                                    {{ $schedule->room_desc }}
                                                    <br>
                                                    {{ $schedule->section_desc }}
                                                @endif
                                            @endforeach
                                        </td>

                                        <td class="border text">
                                            @foreach ($section_schedules as $schedule)
                                                @if ($schedule->day == 'Wednesday' && $schedule->start_time < '16:00' && $schedule->end_time > '15:30')
                                                    {{ $schedule->subject_desc }}<br>
                                                    {{ $schedule->room_desc }}
                                                    <br>
                                                    {{ $schedule->section_desc }}
                                                @endif
                                            @endforeach
                                        </td>

                                        <td class="border text">
                                            @foreach ($section_schedules as $schedule)
                                                @if ($schedule->day == 'Thursday' && $schedule->start_time < '16:00' && $schedule->end_time > '15:30')
                                                    {{ $schedule->subject_desc }}<br>
                                                    {{ $schedule->room_desc }}
                                                    <br>
                                                    {{ $schedule->section_desc }}
                                                @endif
                                            @endforeach
                                        </td>

                                        <td class="border text">
                                            @foreach ($section_schedules as $schedule)
                                                @if ($schedule->day == 'Friday' && $schedule->start_time < '16:00' && $schedule->end_time > '15:30')
                                                    {{ $schedule->subject_desc }}<br>
                                                    {{ $schedule->room_desc }}
                                                    <br>
                                                    {{ $schedule->section_desc }}
                                                @endif
                                            @endforeach
                                        </td>

                                        <td class="border text">
                                            @foreach ($section_schedules as $schedule)
                                                @if ($schedule->day == 'Saturday' && $schedule->start_time < '16:00' && $schedule->end_time > '15:30')
                                                    {{ $schedule->subject_desc }}<br>
                                                    {{ $schedule->room_desc }}
                                                    <br>
                                                    {{ $schedule->section_desc }}
                                                @endif
                                            @endforeach
                                        </td>
                                    </tr>

                                    <tr class="text-center border">
                                        <td class="border text">04:00<br>04:30</td>
                                        <td class="border text">
                                            @foreach ($section_schedules as $schedule)
                                                @if ($schedule->day == 'Monday' && $schedule->start_time < '16:30' && $schedule->end_time > '16:00')
                                                    {{ $schedule->subject_desc }}<br>
                                                    {{ $schedule->room_desc }}<br>
                                                    {{ $schedule->section_desc }}
                                                @endif
                                            @endforeach
                                        </td>

                                        <td class="border text">
                                            @foreach ($section_schedules as $schedule)
                                                @if ($schedule->day == 'Tuesday' && $schedule->start_time < '16:30' && $schedule->end_time > '16:00')
                                                    {{ $schedule->subject_desc }}<br>
                                                    {{ $schedule->room_desc }}
                                                    <br>
                                                    {{ $schedule->section_desc }}
                                                @endif
                                            @endforeach
                                        </td>

                                        <td class="border text">
                                            @foreach ($section_schedules as $schedule)
                                                @if ($schedule->day == 'Wednesday' && $schedule->start_time < '16:30' && $schedule->end_time > '16:00')
                                                    {{ $schedule->subject_desc }}<br>
                                                    {{ $schedule->room_desc }}
                                                    <br>
                                                    {{ $schedule->section_desc }}
                                                @endif
                                            @endforeach
                                        </td>

                                        <td class="border text">
                                            @foreach ($section_schedules as $schedule)
                                                @if ($schedule->day == 'Thursday' && $schedule->start_time < '16:30' && $schedule->end_time > '16:00')
                                                    {{ $schedule->subject_desc }}<br>
                                                    {{ $schedule->room_desc }}
                                                    <br>
                                                    {{ $schedule->section_desc }}
                                                @endif
                                            @endforeach
                                        </td>

                                        <td class="border text">
                                            @foreach ($section_schedules as $schedule)
                                                @if ($schedule->day == 'Friday' && $schedule->start_time < '16:30' && $schedule->end_time > '16:00')
                                                    {{ $schedule->subject_desc }}<br>
                                                    {{ $schedule->room_desc }}
                                                    <br>
                                                    {{ $schedule->section_desc }}
                                                @endif
                                            @endforeach
                                        </td>

                                        <td class="border text">
                                            @foreach ($section_schedules as $schedule)
                                                @if ($schedule->day == 'Saturday' && $schedule->start_time < '16:30' && $schedule->end_time > '16:00')
                                                    {{ $schedule->subject_desc }}<br>
                                                    {{ $schedule->room_desc }}
                                                    <br>
                                                    {{ $schedule->section_desc }}
                                                @endif
                                            @endforeach
                                        </td>
                                    </tr>

                                    <tr class="text-center border">
                                        <td class="border text">04:30<br>05:00</td>
                                        <td class="border text">
                                            @foreach ($section_schedules as $schedule)
                                                @if ($schedule->day == 'Monday' && $schedule->start_time < '17:00' && $schedule->end_time > '16:30')
                                                    {{ $schedule->subject_desc }}<br>
                                                    {{ $schedule->room_desc }}<br>
                                                    {{ $schedule->section_desc }}
                                                @endif
                                            @endforeach
                                        </td>

                                        <td class="border text">
                                            @foreach ($section_schedules as $schedule)
                                                @if ($schedule->day == 'Tuesday' && $schedule->start_time < '17:00' && $schedule->end_time > '16:30')
                                                    {{ $schedule->subject_desc }}<br>
                                                    {{ $schedule->room_desc }}
                                                    <br>
                                                    {{ $schedule->section_desc }}
                                                @endif
                                            @endforeach
                                        </td>

                                        <td class="border text">
                                            @foreach ($section_schedules as $schedule)
                                                @if ($schedule->day == 'Wednesday' && $schedule->start_time < '17:00' && $schedule->end_time > '16:30')
                                                    {{ $schedule->subject_desc }}<br>
                                                    {{ $schedule->room_desc }}
                                                    <br>
                                                    {{ $schedule->section_desc }}
                                                @endif
                                            @endforeach
                                        </td>

                                        <td class="border text">
                                            @foreach ($section_schedules as $schedule)
                                                @if ($schedule->day == 'Thursday' && $schedule->start_time < '17:00' && $schedule->end_time > '16:30')
                                                    {{ $schedule->subject_desc }}<br>
                                                    {{ $schedule->room_desc }}
                                                    <br>
                                                    {{ $schedule->section_desc }}
                                                @endif
                                            @endforeach
                                        </td>

                                        <td class="border text">
                                            @foreach ($section_schedules as $schedule)
                                                @if ($schedule->day == 'Friday' && $schedule->start_time < '17:00' && $schedule->end_time > '16:30')
                                                    {{ $schedule->subject_desc }}<br>
                                                    {{ $schedule->room_desc }}
                                                    <br>
                                                    {{ $schedule->section_desc }}
                                                @endif
                                            @endforeach
                                        </td>

                                        <td class="border text">
                                            @foreach ($section_schedules as $schedule)
                                                @if ($schedule->day == 'Saturday' && $schedule->start_time < '17:00' && $schedule->end_time > '16:30')
                                                    {{ $schedule->subject_desc }}<br>
                                                    {{ $schedule->room_desc }}
                                                    <br>
                                                    {{ $schedule->section_desc }}
                                                @endif
                                            @endforeach
                                        </td>
                                    </tr>

                                    <tr class="text-center border">
                                        <td class="border text">05:00<br>05:30</td>
                                        <td class="border text">
                                            @foreach ($section_schedules as $schedule)
                                                @if ($schedule->day == 'Monday' && $schedule->start_time < '15:00' && $schedule->end_time > '17:00')
                                                    {{ $schedule->subject_desc }}<br>
                                                    {{ $schedule->room_desc }}<br>
                                                    {{ $schedule->section_desc }}
                                                @endif
                                            @endforeach
                                        </td>

                                        <td class="border text">
                                            @foreach ($section_schedules as $schedule)
                                                @if ($schedule->day == 'Tuesday' && $schedule->start_time < '17:30' && $schedule->end_time > '17:00')
                                                    {{ $schedule->subject_desc }}<br>
                                                    {{ $schedule->room_desc }}
                                                    <br>
                                                    {{ $schedule->section_desc }}
                                                @endif
                                            @endforeach
                                        </td>

                                        <td class="border text">
                                            @foreach ($section_schedules as $schedule)
                                                @if ($schedule->day == 'Wednesday' && $schedule->start_time < '17:30' && $schedule->end_time > '17:00')
                                                    {{ $schedule->subject_desc }}<br>
                                                    {{ $schedule->room_desc }}
                                                    <br>
                                                    {{ $schedule->section_desc }}
                                                @endif
                                            @endforeach
                                        </td>

                                        <td class="border text">
                                            @foreach ($section_schedules as $schedule)
                                                @if ($schedule->day == 'Thursday' && $schedule->start_time < '17:30' && $schedule->end_time > '17:00')
                                                    {{ $schedule->subject_desc }}<br>
                                                    {{ $schedule->room_desc }}
                                                    <br>
                                                    {{ $schedule->section_desc }}
                                                @endif
                                            @endforeach
                                        </td>

                                        <td class="border text">
                                            @foreach ($section_schedules as $schedule)
                                                @if ($schedule->day == 'Friday' && $schedule->start_time < '17:30' && $schedule->end_time > '17:00')
                                                    {{ $schedule->subject_desc }}<br>
                                                    {{ $schedule->room_desc }}
                                                    <br>
                                                    {{ $schedule->section_desc }}
                                                @endif
                                            @endforeach
                                        </td>

                                        <td class="border text">
                                            @foreach ($section_schedules as $schedule)
                                                @if ($schedule->day == 'Saturday' && $schedule->start_time < '17:30' && $schedule->end_time > '17:00')
                                                    {{ $schedule->subject_desc }}<br>
                                                    {{ $schedule->room_desc }}
                                                    <br>
                                                    {{ $schedule->section_desc }}
                                                @endif
                                            @endforeach
                                        </td>
                                    </tr>
                                </tbody>


                            </table>
                        </div>
                    </div>


                    <div class="d-flex  mb-5 justify-content-center">
                        <form
                            action="{{ url('facultySchedulePDF', [$section_schedules->first()->schoolyear_id, $section_schedules->first()->faculty_id]) }}"
                            method="POST" formtarget="_blank" target="_blank">
                            @csrf
                            <button type="submit"
                                class="btn fw-bold text-center p-4 bg-success text-light rounded"
                                style="width: 500px;">
                                EXPORT PDF
                            </button>
                        </form>
                    </div>

<hr>
                    <div class="container">
            <div class="container mt-5 edit-user-container">
                <div class="container-fluid">
                    <h1 class="edit-user-title">SCHEDULE TABLE</h1>
                </div>
            </div>
            <div class="col mb-5 mt-5">
                <table id="users" class="table table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>Subject</th>
                            <th>Room</th>
                            <th>Section</th>
                            <th>Day</th>
                            <th>Start Time</th>
                            <th>End Time</th>
                        </tr>
                    </thead>
                    @foreach ($section_schedules as $section_schedule)
                        <tr class="fw-bold">
                            <td>{{ $section_schedule->subject_desc }}</td>
                            <td>{{ $section_schedule->room_desc }}</td>
                            <td>{{ $schedule->section_desc }}</td>
                            <td>{{ $section_schedule->day }}</td>
                            <td>{{ date('h:i A', strtotime($section_schedule->start_time)) }}</td>
                            <td>{{ date('h:i A', strtotime($section_schedule->end_time)) }}</td>
                        </tr>
                    @endforeach
                    </tbody>

                </table>
            </div>


        </div>
                </div>
            </div>

</div>
</div>


            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

            {{-- datatable bootsrap --}}
            {{-- css --}}
            <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">

            {{-- script --}}
            <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
            <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
            <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>

            <script>
                $(document).ready(function() {
                    $('#users').DataTable();
                });
            </script>



<footer>
    <div class="fw-bold p-3">Pangasinan State University • San Vicente • Urdaneta City • Pangasinan • (075) 542 5133<br>
      © 2023 Copyright:
</div>
  </footer>

</body>



</html>

<?php

}
?>
