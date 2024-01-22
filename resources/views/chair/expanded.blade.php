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
    <link rel="icon" href="../assets/logo/favicon-16x16.png" type="image/x-icon">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/mis_edit.css') }}">

    <title>School Year Edit</title>
</head>
    <style>


        .table-sched {
            border-collapse: collapse;
            width: 100%;
            margin: 20px;
            align-items:center;
        }

        .border{
            border: 3px solid blue;
            padding: 5px;
            font-size: 20px;
        }
        .text {
            color: #082b54;
            padding: 20px;
            font-weight: bold;
            font-size: 15px;
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

        .active th{
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
    background-color:  #2D3436;
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

     document.addEventListener("DOMContentLoaded", function () {
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
    <a href="/chairSectionScheduleResource" class="fw-bold link p-5" >
            <i class="fa-solid fa-arrow-left"></i> Back
        </a>
            <div class="navbar-info" style=" width: 330px;">
            <div class="row">
            <div class="col-md-6 mt-3 user-name">

                        <center>
                        <div class="row">
                             <h5 class=" title">
                                    {{ session('user_firstName') . ' ' . session('user_lastName') }}</h5>                           
                        </div>
                        <div class="row">                          
                                <h6 class="title">
                                    {{ session('dept_code') }}</h6>
                        </div>
                        <div class="row">
                           <h6 class=" title">
                                    {{ session('campus_code') }}</h6>                         
                        </div>
                            </center>
                        </div>
            </div>
        </div>
</div>

    <br>
    
    <div class="container p-5 mb-5 rounded" style="margin-top: 120px;">
    
    <div class="container-fluid edit-user-container">
            <div class="container-fluid">
                <h1 class="edit-user-title">{{ $sections->section_desc }} - SCHEDULE</h1>
            </div>
        </div>

    <div class="row mb-5  d-flex justify-content-center">
            <div class="col  d-flex justify-content-center "  style="border: 2px;">
<table class=" text-center shadow-lg table-sched"id="scheduleTable">
                        <thead>
                            <tr class="border ">
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
                                            {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
                                        @endif
                                    @endforeach

                                </td>



                                <td class="border text">
                                    @foreach ($section_schedules as $schedule)
                                        @if ($schedule->day == 'Tuesday' && $schedule->start_time < '08:30' && $schedule->end_time > '08:00')
                                            {{ $schedule->subject_desc }}<br>
                                            {{ $schedule->room_desc }}<br>
                                            {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
                                        @endif
                                    @endforeach
                                </td>


                                <td class="border text">
                                    @foreach ($section_schedules as $schedule)
                                        @if ($schedule->day == 'Wednesday' && $schedule->start_time < '08:30' && $schedule->end_time > '08:00')
                                            {{ $schedule->subject_desc }}<br>
                                            {{ $schedule->room_desc }}<br>
                                            {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
                                        @endif
                                    @endforeach
                                </td>


                                <td class="border text">
                                    @foreach ($section_schedules as $schedule)
                                        @if ($schedule->day == 'Thursday' && $schedule->start_time < '08:30' && $schedule->end_time > '08:00')
                                            {{ $schedule->subject_desc }}<br>
                                            {{ $schedule->room_desc }}<br>
                                            {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
                                        @endif
                                    @endforeach
                                </td>

                                <td class="border text">
                                    @foreach ($section_schedules as $schedule)
                                        @if ($schedule->day == 'Friday' && $schedule->start_time < '08:30' && $schedule->end_time > '08:00')
                                            {{ $schedule->subject_desc }}<br>
                                            {{ $schedule->room_desc }}<br>
                                            {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
                                        @endif
                                    @endforeach
                                </td>


                                <td class="border text">
                                    @foreach ($section_schedules as $schedule)
                                        @if ($schedule->day == 'Saturday' && $schedule->start_time < '08:30' && $schedule->end_time > '08:00')
                                            {{ $schedule->subject_desc }}<br>
                                            {{ $schedule->room_desc }}<br>
                                            {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
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
                                            {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
                                        @endif
                                    @endforeach

                                </td>



                                <td class="border text">
                                    @foreach ($section_schedules as $schedule)
                                        @if ($schedule->day == 'Tuesday' && $schedule->start_time < '09:00' && $schedule->end_time > '08:30')
                                            {{ $schedule->subject_desc }}<br>
                                            {{ $schedule->room_desc }}<br>
                                            {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
                                        @endif
                                    @endforeach
                                </td>


                                <td class="border text">
                                    @foreach ($section_schedules as $schedule)
                                        @if ($schedule->day == 'Wednesday' && $schedule->start_time < '09:00' && $schedule->end_time > '08:30')
                                            {{ $schedule->subject_desc }}<br>
                                            {{ $schedule->room_desc }}<br>
                                            {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
                                        @endif
                                    @endforeach
                                </td>


                                <td class="border text">
                                    @foreach ($section_schedules as $schedule)
                                        @if ($schedule->day == 'Thursday' && $schedule->start_time < '09:00' && $schedule->end_time > '08:30')
                                            {{ $schedule->subject_desc }}<br>
                                            {{ $schedule->room_desc }}<br>
                                            {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
                                        @endif
                                    @endforeach
                                </td>

                                <td class="border text">
                                    @foreach ($section_schedules as $schedule)
                                        @if ($schedule->day == 'Friday' && $schedule->start_time < '09:00' && $schedule->end_time > '08:30')
                                            {{ $schedule->subject_desc }}<br>
                                            {{ $schedule->room_desc }}<br>
                                            {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
                                        @endif
                                    @endforeach
                                </td>


                                <td class="border text">
                                    @foreach ($section_schedules as $schedule)
                                        @if ($schedule->day == 'Saturday' && $schedule->start_time < '09:00' && $schedule->end_time > '08:30')
                                            {{ $schedule->subject_desc }}<br>
                                            {{ $schedule->room_desc }}<br>
                                            {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
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
                                            {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
                                        @endif
                                    @endforeach
                                </td>

                                <td class="border text">
                                    @foreach ($section_schedules as $schedule)
                                        @if ($schedule->day == 'Tuesday' && $schedule->start_time < '09:30' && $schedule->end_time > '09:00')
                                            {{ $schedule->subject_desc }}<br>
                                            {{ $schedule->room_desc }}<br>
                                            {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
                                        @endif
                                    @endforeach
                                </td>

                                <td class="border text">
                                    @foreach ($section_schedules as $schedule)
                                        @if ($schedule->day == 'Wednesday' && $schedule->start_time < '09:30' && $schedule->end_time > '09:00')
                                            {{ $schedule->subject_desc }}<br>
                                            {{ $schedule->room_desc }}<br>
                                            {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
                                        @endif
                                    @endforeach
                                </td>


                                <td class="border text">
                                    @foreach ($section_schedules as $schedule)
                                        @if ($schedule->day == 'Thursday' && $schedule->start_time < '09:30' && $schedule->end_time > '09:00')
                                            {{ $schedule->subject_desc }}<br>
                                            {{ $schedule->room_desc }}<br>
                                            {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
                                        @endif
                                    @endforeach
                                </td>

                                <td class="border text">
                                    @foreach ($section_schedules as $schedule)
                                        @if ($schedule->day == 'Friday' && $schedule->start_time < '09:30' && $schedule->end_time > '09:00')
                                            {{ $schedule->subject_desc }}<br>
                                            {{ $schedule->room_desc }}<br>
                                            {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
                                        @endif
                                    @endforeach
                                </td>


                                <td class="border text">
                                    @foreach ($section_schedules as $schedule)
                                        @if ($schedule->day == 'Saturday' && $schedule->start_time < '09:30' && $schedule->end_time > '09:00')
                                            {{ $schedule->subject_desc }}<br>
                                            {{ $schedule->room_desc }}<br>
                                            {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
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
                                            {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
                                        @endif
                                    @endforeach
                                </td>

                                <td class="border text">
                                    @foreach ($section_schedules as $schedule)
                                        @if ($schedule->day == 'Tuesday' && $schedule->start_time < '10:00' && $schedule->end_time > '09:30')
                                            {{ $schedule->subject_desc }}<br>
                                            {{ $schedule->room_desc }}<br>
                                            {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
                                        @endif
                                    @endforeach
                                </td>

                                <td class="border text">
                                    @foreach ($section_schedules as $schedule)
                                        @if ($schedule->day == 'Wednesday' && $schedule->start_time < '10:00' && $schedule->end_time > '09:30')
                                            {{ $schedule->subject_desc }}<br>
                                            {{ $schedule->room_desc }}<br>
                                            {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
                                        @endif
                                    @endforeach
                                </td>


                                <td class="border text">
                                    @foreach ($section_schedules as $schedule)
                                        @if ($schedule->day == 'Thursday' && $schedule->start_time < '10:00' && $schedule->end_time > '09:30')
                                            {{ $schedule->subject_desc }}<br>
                                            {{ $schedule->room_desc }}<br>
                                            {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
                                        @endif
                                    @endforeach
                                </td>

                                <td class="border text">
                                    @foreach ($section_schedules as $schedule)
                                        @if ($schedule->day == 'Friday' && $schedule->start_time < '10:00' && $schedule->end_time > '09:30')
                                            {{ $schedule->subject_desc }}<br>
                                            {{ $schedule->room_desc }}<br>
                                            {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
                                        @endif
                                    @endforeach
                                </td>


                                <td class="border text">
                                    @foreach ($section_schedules as $schedule)
                                        @if ($schedule->day == 'Saturday' && $schedule->start_time < '10:00' && $schedule->end_time > '09:30')
                                            {{ $schedule->subject_desc }}<br>
                                            {{ $schedule->room_desc }}<br>
                                            {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
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
                                            {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
                                        @endif
                                    @endforeach
                                </td>

                                <td class="border text">
                                    @foreach ($section_schedules as $schedule)
                                        @if ($schedule->day == 'Tuesday' && $schedule->start_time < '10:30' && $schedule->end_time > '10:00')
                                            {{ $schedule->subject_desc }}<br>
                                            {{ $schedule->room_desc }}<br>
                                            {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
                                        @endif
                                    @endforeach
                                </td>

                                <td class="border text">
                                    @foreach ($section_schedules as $schedule)
                                        @if ($schedule->day == 'Wednesday' && $schedule->start_time < '10:30' && $schedule->end_time > '10:00')
                                            {{ $schedule->subject_desc }}<br>
                                            {{ $schedule->room_desc }}<br>
                                            {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
                                        @endif
                                    @endforeach
                                </td>


                                <td class="border text">
                                    @foreach ($section_schedules as $schedule)
                                        @if ($schedule->day == 'Thursday' && $schedule->start_time < '10:30' && $schedule->end_time > '10:00')
                                            {{ $schedule->subject_desc }}<br>
                                            {{ $schedule->room_desc }}<br>
                                            {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
                                        @endif
                                    @endforeach
                                </td>

                                <td class="border text">
                                    @foreach ($section_schedules as $schedule)
                                        @if ($schedule->day == 'Friday' && $schedule->start_time < '10:30' && $schedule->end_time > '10:00')
                                            {{ $schedule->subject_desc }}<br>
                                            {{ $schedule->room_desc }}<br>
                                            {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
                                        @endif
                                    @endforeach
                                </td>


                                <td class="border text">
                                    @foreach ($section_schedules as $schedule)
                                        @if ($schedule->day == 'Saturday' && $schedule->start_time < '10:30' && $schedule->end_time > '10:00')
                                            {{ $schedule->subject_desc }}<br>
                                            {{ $schedule->room_desc }}<br>
                                            {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
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
                                            {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
                                        @endif
                                    @endforeach
                                </td>

                                <td class="border text">
                                    @foreach ($section_schedules as $schedule)
                                        @if ($schedule->day == 'Tuesday' && $schedule->start_time < '11:00' && $schedule->end_time > '10:30')
                                            {{ $schedule->subject_desc }}<br>
                                            {{ $schedule->room_desc }}<br>
                                            {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
                                        @endif
                                    @endforeach
                                </td>

                                <td class="border text">
                                    @foreach ($section_schedules as $schedule)
                                        @if ($schedule->day == 'Wednesday' && $schedule->start_time < '11:00' && $schedule->end_time > '10:30')
                                            {{ $schedule->subject_desc }}<br>
                                            {{ $schedule->room_desc }}<br>
                                            {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
                                        @endif
                                    @endforeach
                                </td>


                                <td class="border text">
                                    @foreach ($section_schedules as $schedule)
                                        @if ($schedule->day == 'Thursday' && $schedule->start_time < '11:00' && $schedule->end_time > '10:30')
                                            {{ $schedule->subject_desc }}<br>
                                            {{ $schedule->room_desc }}<br>
                                            {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
                                        @endif
                                    @endforeach
                                </td>

                                <td class="border text">
                                    @foreach ($section_schedules as $schedule)
                                        @if ($schedule->day == 'Friday' && $schedule->start_time < '11:00' && $schedule->end_time > '10:30')
                                            {{ $schedule->subject_desc }}<br>
                                            {{ $schedule->room_desc }}<br>
                                            {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
                                        @endif
                                    @endforeach
                                </td>


                                <td class="border text">
                                    @foreach ($section_schedules as $schedule)
                                        @if ($schedule->day == 'Saturday' && $schedule->start_time < '11:00' && $schedule->end_time > '10:30')
                                            {{ $schedule->subject_desc }}<br>
                                            {{ $schedule->room_desc }}<br>
                                            {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
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
                                            {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
                                        @endif
                                    @endforeach
                                </td>

                                <td class="border text">
                                    @foreach ($section_schedules as $schedule)
                                        @if ($schedule->day == 'Tuesday' && $schedule->start_time < '11:30' && $schedule->end_time > '11:00')
                                            {{ $schedule->subject_desc }}<br>
                                            {{ $schedule->room_desc }}<br>
                                            {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
                                        @endif
                                    @endforeach
                                </td>

                                <td class="border text">
                                    @foreach ($section_schedules as $schedule)
                                        @if ($schedule->day == 'Wednesday' && $schedule->start_time < '11:30' && $schedule->end_time > '11:00')
                                            {{ $schedule->subject_desc }}<br>
                                            {{ $schedule->room_desc }}<br>
                                            {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
                                        @endif
                                    @endforeach
                                </td>

                                <td class="border text">
                                    @foreach ($section_schedules as $schedule)
                                        @if ($schedule->day == 'Thursday' && $schedule->start_time < '11:30' && $schedule->end_time > '11:00')
                                            {{ $schedule->subject_desc }}<br>
                                            {{ $schedule->room_desc }}<br>
                                            {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
                                        @endif
                                    @endforeach
                                </td>

                                <td class="border text">
                                    @foreach ($section_schedules as $schedule)
                                        @if ($schedule->day == 'Friday' && $schedule->start_time < '11:30' && $schedule->end_time > '11:00')
                                            {{ $schedule->subject_desc }}<br>
                                            {{ $schedule->room_desc }}<br>
                                            {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
                                        @endif
                                    @endforeach
                                </td>

                                <td class="border text">
                                    @foreach ($section_schedules as $schedule)
                                        @if ($schedule->day == 'Saturday' && $schedule->start_time < '11:30' && $schedule->end_time > '11:00')
                                            {{ $schedule->subject_desc }}<br>
                                            {{ $schedule->room_desc }}<br>
                                            {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
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
                                            {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
                                        @endif
                                    @endforeach
                                </td>

                                <td class="border text">
                                    @foreach ($section_schedules as $schedule)
                                        @if ($schedule->day == 'Tuesday' && $schedule->start_time < '12:00' && $schedule->end_time > '11:30')
                                            {{ $schedule->subject_desc }}<br>
                                            {{ $schedule->room_desc }}<br>
                                            {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
                                        @endif
                                    @endforeach
                                </td>

                                <td class="border text">
                                    @foreach ($section_schedules as $schedule)
                                        @if ($schedule->day == 'Wednesday' && $schedule->start_time < '12:00' && $schedule->end_time > '11:30')
                                            {{ $schedule->subject_desc }}<br>
                                            {{ $schedule->room_desc }}<br>
                                            {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
                                        @endif
                                    @endforeach
                                </td>

                                <td class="border text">
                                    @foreach ($section_schedules as $schedule)
                                        @if ($schedule->day == 'Thursday' && $schedule->start_time < '12:00' && $schedule->end_time > '11:30')
                                            {{ $schedule->subject_desc }}<br>
                                            {{ $schedule->room_desc }}<br>
                                            {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
                                        @endif
                                    @endforeach
                                </td>


                                <td class="border text">
                                    @foreach ($section_schedules as $schedule)
                                        @if ($schedule->day == 'Friday' && $schedule->start_time < '12:00' && $schedule->end_time > '11:30')
                                            {{ $schedule->subject_desc }}<br>
                                            {{ $schedule->room_desc }}<br>
                                            {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
                                        @endif
                                    @endforeach
                                </td>

                                <td class="border text">
                                    @foreach ($section_schedules as $schedule)
                                        @if ($schedule->day == 'Saturday' && $schedule->start_time < '12:00' && $schedule->end_time > '11:30')
                                            {{ $schedule->subject_desc }}<br>
                                            {{ $schedule->room_desc }}<br>
                                            {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
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
                                            {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
                                        @endif
                                    @endforeach
                                </td>


                                <td class="border text">
                                    @foreach ($section_schedules as $schedule)
                                        @if ($schedule->day == 'Tuesday' && $schedule->start_time < '12:30' && $schedule->end_time > '12:00')
                                            {{ $schedule->subject_desc }}<br>
                                            {{ $schedule->room_desc }}<br>
                                            {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
                                        @endif
                                    @endforeach
                                </td>

                                <td class="border text">
                                    @foreach ($section_schedules as $schedule)
                                        @if ($schedule->day == 'Wednesday' && $schedule->start_time < '12:30' && $schedule->end_time > '12:00')
                                            {{ $schedule->subject_desc }}<br>
                                            {{ $schedule->room_desc }}<br>
                                            {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
                                        @endif
                                    @endforeach
                                </td>

                                <td class="border text">
                                    @foreach ($section_schedules as $schedule)
                                        @if ($schedule->day == 'Thursday' && $schedule->start_time < '12:30' && $schedule->end_time > '12:00')
                                            {{ $schedule->subject_desc }}<br>
                                            {{ $schedule->room_desc }}<br>
                                            {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
                                        @endif
                                    @endforeach
                                </td>

                                <td class="border text">
                                    @foreach ($section_schedules as $schedule)
                                        @if ($schedule->day == 'Friday' && $schedule->start_time < '12:30' && $schedule->end_time > '12:00')
                                            {{ $schedule->subject_desc }}<br>
                                            {{ $schedule->room_desc }}<br>
                                            {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
                                        @endif
                                    @endforeach
                                </td>

                                <td class="border text">
                                    @foreach ($section_schedules as $schedule)
                                        @if ($schedule->day == 'Saturday' && $schedule->start_time < '12:30' && $schedule->end_time > '12:00')
                                            {{ $schedule->subject_desc }}<br>
                                            {{ $schedule->room_desc }}<br>
                                            {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
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
                                            {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
                                        @endif
                                    @endforeach
                                </td>

                                <td class="border text">
                                    @foreach ($section_schedules as $schedule)
                                        @if ($schedule->day == 'Tuesday' && $schedule->start_time < '13:00' && $schedule->end_time > '12:30')
                                            {{ $schedule->subject_desc }}<br>
                                            {{ $schedule->room_desc }}<br>
                                            {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
                                        @endif
                                    @endforeach
                                </td>

                                <td class="border text">
                                    @foreach ($section_schedules as $schedule)
                                        @if ($schedule->day == 'Wednesday' && $schedule->start_time < '13:00' && $schedule->end_time > '12:30')
                                            {{ $schedule->subject_desc }}<br>
                                            {{ $schedule->room_desc }}<br>
                                            {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
                                        @endif
                                    @endforeach
                                </td>

                                <td class="border text">
                                    @foreach ($section_schedules as $schedule)
                                        @if ($schedule->day == 'Thursday' && $schedule->start_time < '13:00' && $schedule->end_time > '12:30')
                                            {{ $schedule->subject_desc }}<br>
                                            {{ $schedule->room_desc }}<br>
                                            {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
                                        @endif
                                    @endforeach
                                </td>

                                <td class="border text">
                                    @foreach ($section_schedules as $schedule)
                                        @if ($schedule->day == 'Friday' && $schedule->start_time < '13:00' && $schedule->end_time > '12:30')
                                            {{ $schedule->subject_desc }}<br>
                                            {{ $schedule->room_desc }}<br>
                                            {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
                                        @endif
                                    @endforeach
                                </td>

                                <td class="border text">
                                    @foreach ($section_schedules as $schedule)
                                        @if ($schedule->day == 'Saturday' && $schedule->start_time < '13:00' && $schedule->end_time > '12:30')
                                            {{ $schedule->subject_desc }}<br>
                                            {{ $schedule->room_desc }}<br>
                                            {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
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
                                            {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
                                        @endif
                                    @endforeach
                                </td>

                                <td class="border text">
                                    @foreach ($section_schedules as $schedule)
                                        @if ($schedule->day == 'Tuesday' && $schedule->start_time < '13:30' && $schedule->end_time > '13:00')
                                            {{ $schedule->subject_desc }}<br>
                                            {{ $schedule->room_desc }}<br>
                                            {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
                                        @endif
                                    @endforeach
                                </td>

                                <td class="border text">
                                    @foreach ($section_schedules as $schedule)
                                        @if ($schedule->day == 'Wednesday' && $schedule->start_time < '13:30' && $schedule->end_time > '13:00')
                                            {{ $schedule->subject_desc }}<br>
                                            {{ $schedule->room_desc }}<br>
                                            {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
                                        @endif
                                    @endforeach
                                </td>

                                <td class="border text">
                                    @foreach ($section_schedules as $schedule)
                                        @if ($schedule->day == 'Thursday' && $schedule->start_time < '13:30' && $schedule->end_time > '13:00')
                                            {{ $schedule->subject_desc }}<br>
                                            {{ $schedule->room_desc }}<br>
                                            {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
                                        @endif
                                    @endforeach
                                </td>

                                <td class="border text">
                                    @foreach ($section_schedules as $schedule)
                                        @if ($schedule->day == 'Friday' && $schedule->start_time < '13:30' && $schedule->end_time > '13:00')
                                            {{ $schedule->subject_desc }}<br>
                                            {{ $schedule->room_desc }}<br>
                                            {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
                                        @endif
                                    @endforeach
                                </td>

                                <td class="border text">
                                    @foreach ($section_schedules as $schedule)
                                        @if ($schedule->day == 'Saturday' && $schedule->start_time < '13:30' && $schedule->end_time > '13:00')
                                            {{ $schedule->subject_desc }}<br>
                                            {{ $schedule->room_desc }}<br>
                                            {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
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
                                            {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
                                        @endif
                                    @endforeach
                                </td>

                                <td class="border text">
                                    @foreach ($section_schedules as $schedule)
                                        @if ($schedule->day == 'Tuesday' && $schedule->start_time < '14:00' && $schedule->end_time > '13:30')
                                            {{ $schedule->subject_desc }}<br>
                                            {{ $schedule->room_desc }}<br>
                                            {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
                                        @endif
                                    @endforeach
                                </td>

                                <td class="border text">
                                    @foreach ($section_schedules as $schedule)
                                        @if ($schedule->day == 'Wednesday' && $schedule->start_time < '14:00' && $schedule->end_time > '13:30')
                                            {{ $schedule->subject_desc }}<br>
                                            {{ $schedule->room_desc }}<br>
                                            {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
                                        @endif
                                    @endforeach
                                </td>

                                <td class="border text">
                                    @foreach ($section_schedules as $schedule)
                                        @if ($schedule->day == 'Thursday' && $schedule->start_time < '14:00' && $schedule->end_time > '13:30')
                                            {{ $schedule->subject_desc }}<br>
                                            {{ $schedule->room_desc }}<br>
                                            {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
                                        @endif
                                    @endforeach
                                </td>

                                <td class="border text">
                                    @foreach ($section_schedules as $schedule)
                                        @if ($schedule->day == 'Friday' && $schedule->start_time < '14:00' && $schedule->end_time > '13:30')
                                            {{ $schedule->subject_desc }}<br>
                                            {{ $schedule->room_desc }}<br>
                                            {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
                                        @endif
                                    @endforeach
                                </td>

                                <td class="border text">
                                    @foreach ($section_schedules as $schedule)
                                        @if ($schedule->day == 'Saturday' && $schedule->start_time < '14:00' && $schedule->end_time > '13:30')
                                            {{ $schedule->subject_desc }}<br>
                                            {{ $schedule->room_desc }}<br>
                                            {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
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
                                            {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
                                        @endif
                                    @endforeach
                                </td>

                                <td class="border text">
                                    @foreach ($section_schedules as $schedule)
                                        @if ($schedule->day == 'Tuesday' && $schedule->start_time < '14:30' && $schedule->end_time > '14:00')
                                            {{ $schedule->subject_desc }}<br>
                                            {{ $schedule->room_desc }}
                                            <br>
                                            {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
                                        @endif
                                    @endforeach
                                </td>

                                <td class="border text">
                                    @foreach ($section_schedules as $schedule)
                                        @if ($schedule->day == 'Wednesday' && $schedule->start_time < '14:30' && $schedule->end_time > '14:00')
                                            {{ $schedule->subject_desc }}<br>
                                            {{ $schedule->room_desc }}
                                            <br>
                                            {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
                                        @endif
                                    @endforeach
                                </td>

                                <td class="border text">
                                    @foreach ($section_schedules as $schedule)
                                        @if ($schedule->day == 'Thursday' && $schedule->start_time < '14:30' && $schedule->end_time > '14:00')
                                            {{ $schedule->subject_desc }}<br>
                                            {{ $schedule->room_desc }}
                                            <br>
                                            {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
                                        @endif
                                    @endforeach
                                </td>

                                <td class="border text">
                                    @foreach ($section_schedules as $schedule)
                                        @if ($schedule->day == 'Friday' && $schedule->start_time < '14:30' && $schedule->end_time > '14:00')
                                            {{ $schedule->subject_desc }}<br>
                                            {{ $schedule->room_desc }}
                                            <br>
                                            {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
                                        @endif
                                    @endforeach
                                </td>

                                <td class="border text">
                                    @foreach ($section_schedules as $schedule)
                                        @if ($schedule->day == 'Saturday' && $schedule->start_time < '14:30' && $schedule->end_time > '14:00')
                                            {{ $schedule->subject_desc }}<br>
                                            {{ $schedule->room_desc }}
                                            <br>
                                            {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
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
                                            {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
                                        @endif
                                    @endforeach
                                </td>

                                <td class="border text">
                                    @foreach ($section_schedules as $schedule)
                                        @if ($schedule->day == 'Tuesday' && $schedule->start_time < '15:00' && $schedule->end_time > '14:30')
                                            {{ $schedule->subject_desc }}<br>
                                            {{ $schedule->room_desc }}
                                            <br>
                                            {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
                                        @endif
                                    @endforeach
                                </td>

                                <td class="border text">
                                    @foreach ($section_schedules as $schedule)
                                        @if ($schedule->day == 'Wednesday' && $schedule->start_time < '15:00' && $schedule->end_time > '14:30')
                                            {{ $schedule->subject_desc }}<br>
                                            {{ $schedule->room_desc }}
                                            <br>
                                            {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
                                        @endif
                                    @endforeach
                                </td>

                                <td class="border text">
                                    @foreach ($section_schedules as $schedule)
                                        @if ($schedule->day == 'Thursday' && $schedule->start_time < '15:00' && $schedule->end_time > '14:30')
                                            {{ $schedule->subject_desc }}<br>
                                            {{ $schedule->room_desc }}
                                            <br>
                                            {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
                                        @endif
                                    @endforeach
                                </td>

                                <td class="border text">
                                    @foreach ($section_schedules as $schedule)
                                        @if ($schedule->day == 'Friday' && $schedule->start_time < '15:00' && $schedule->end_time > '14:30')
                                            {{ $schedule->subject_desc }}<br>
                                            {{ $schedule->room_desc }}
                                            <br>
                                            {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
                                        @endif
                                    @endforeach
                                </td>

                                <td class="border text">
                                    @foreach ($section_schedules as $schedule)
                                        @if ($schedule->day == 'Saturday' && $schedule->start_time < '15:00' && $schedule->end_time > '14:30')
                                            {{ $schedule->subject_desc }}<br>
                                            {{ $schedule->room_desc }}
                                            <br>
                                            {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
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
                                            {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
                                        @endif
                                    @endforeach
                                </td>

                                <td class="border text">
                                    @foreach ($section_schedules as $schedule)
                                        @if ($schedule->day == 'Tuesday' && $schedule->start_time < '15:30' && $schedule->end_time > '15:00')
                                            {{ $schedule->subject_desc }}<br>
                                            {{ $schedule->room_desc }}
                                            <br>
                                            {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
                                        @endif
                                    @endforeach
                                </td>

                                <td class="border text">
                                    @foreach ($section_schedules as $schedule)
                                        @if ($schedule->day == 'Wednesday' && $schedule->start_time < '15:30' && $schedule->end_time > '15:00')
                                            {{ $schedule->subject_desc }}<br>
                                            {{ $schedule->room_desc }}
                                            <br>
                                            {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
                                        @endif
                                    @endforeach
                                </td>

                                <td class="border text">
                                    @foreach ($section_schedules as $schedule)
                                        @if ($schedule->day == 'Thursday' && $schedule->start_time < '15:30' && $schedule->end_time > '15:00')
                                            {{ $schedule->subject_desc }}<br>
                                            {{ $schedule->room_desc }}
                                            <br>
                                            {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
                                        @endif
                                    @endforeach
                                </td>

                                <td class="border text">
                                    @foreach ($section_schedules as $schedule)
                                        @if ($schedule->day == 'Friday' && $schedule->start_time < '15:30' && $schedule->end_time > '15:00')
                                            {{ $schedule->subject_desc }}<br>
                                            {{ $schedule->room_desc }}
                                            <br>
                                            {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
                                        @endif
                                    @endforeach
                                </td>

                                <td class="border text">
                                    @foreach ($section_schedules as $schedule)
                                        @if ($schedule->day == 'Saturday' && $schedule->start_time < '15:30' && $schedule->end_time > '15:00')
                                            {{ $schedule->subject_desc }}<br>
                                            {{ $schedule->room_desc }}
                                            <br>
                                            {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
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
                                            {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
                                        @endif
                                    @endforeach
                                </td>

                                <td class="border text">
                                    @foreach ($section_schedules as $schedule)
                                        @if ($schedule->day == 'Tuesday' && $schedule->start_time < '16:00' && $schedule->end_time > '15:30')
                                            {{ $schedule->subject_desc }}<br>
                                            {{ $schedule->room_desc }}
                                            <br>
                                            {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
                                        @endif
                                    @endforeach
                                </td>

                                <td class="border text">
                                    @foreach ($section_schedules as $schedule)
                                        @if ($schedule->day == 'Wednesday' && $schedule->start_time < '16:00' && $schedule->end_time > '15:30')
                                            {{ $schedule->subject_desc }}<br>
                                            {{ $schedule->room_desc }}
                                            <br>
                                            {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
                                        @endif
                                    @endforeach
                                </td>

                                <td class="border text">
                                    @foreach ($section_schedules as $schedule)
                                        @if ($schedule->day == 'Thursday' && $schedule->start_time < '16:00' && $schedule->end_time > '15:30')
                                            {{ $schedule->subject_desc }}<br>
                                            {{ $schedule->room_desc }}
                                            <br>
                                            {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
                                        @endif
                                    @endforeach
                                </td>

                                <td class="border text">
                                    @foreach ($section_schedules as $schedule)
                                        @if ($schedule->day == 'Friday' && $schedule->start_time < '16:00' && $schedule->end_time > '15:30')
                                            {{ $schedule->subject_desc }}<br>
                                            {{ $schedule->room_desc }}
                                            <br>
                                            {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
                                        @endif
                                    @endforeach
                                </td>

                                <td class="border text">
                                    @foreach ($section_schedules as $schedule)
                                        @if ($schedule->day == 'Saturday' && $schedule->start_time < '16:00' && $schedule->end_time > '15:30')
                                            {{ $schedule->subject_desc }}<br>
                                            {{ $schedule->room_desc }}
                                            <br>
                                            {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
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
                                            {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
                                        @endif
                                    @endforeach
                                </td>

                                <td class="border text">
                                    @foreach ($section_schedules as $schedule)
                                        @if ($schedule->day == 'Tuesday' && $schedule->start_time < '16:30' && $schedule->end_time > '16:00')
                                            {{ $schedule->subject_desc }}<br>
                                            {{ $schedule->room_desc }}
                                            <br>
                                            {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
                                        @endif
                                    @endforeach
                                </td>

                                <td class="border text">
                                    @foreach ($section_schedules as $schedule)
                                        @if ($schedule->day == 'Wednesday' && $schedule->start_time < '16:30' && $schedule->end_time > '16:00')
                                            {{ $schedule->subject_desc }}<br>
                                            {{ $schedule->room_desc }}
                                            <br>
                                            {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
                                        @endif
                                    @endforeach
                                </td>

                                <td class="border text">
                                    @foreach ($section_schedules as $schedule)
                                        @if ($schedule->day == 'Thursday' && $schedule->start_time < '16:30' && $schedule->end_time > '16:00')
                                            {{ $schedule->subject_desc }}<br>
                                            {{ $schedule->room_desc }}
                                            <br>
                                            {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
                                        @endif
                                    @endforeach
                                </td>

                                <td class="border text">
                                    @foreach ($section_schedules as $schedule)
                                        @if ($schedule->day == 'Friday' && $schedule->start_time < '16:30' && $schedule->end_time > '16:00')
                                            {{ $schedule->subject_desc }}<br>
                                            {{ $schedule->room_desc }}
                                            <br>
                                            {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
                                        @endif
                                    @endforeach
                                </td>

                                <td class="border text">
                                    @foreach ($section_schedules as $schedule)
                                        @if ($schedule->day == 'Saturday' && $schedule->start_time < '16:30' && $schedule->end_time > '16:00')
                                            {{ $schedule->subject_desc }}<br>
                                            {{ $schedule->room_desc }}
                                            <br>
                                            {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
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
                                            {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
                                        @endif
                                    @endforeach
                                </td>

                                <td class="border text">
                                    @foreach ($section_schedules as $schedule)
                                        @if ($schedule->day == 'Tuesday' && $schedule->start_time < '17:00' && $schedule->end_time > '16:30')
                                            {{ $schedule->subject_desc }}<br>
                                            {{ $schedule->room_desc }}
                                            <br>
                                            {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
                                        @endif
                                    @endforeach
                                </td>

                                <td class="border text">
                                    @foreach ($section_schedules as $schedule)
                                        @if ($schedule->day == 'Wednesday' && $schedule->start_time < '17:00' && $schedule->end_time > '16:30')
                                            {{ $schedule->subject_desc }}<br>
                                            {{ $schedule->room_desc }}
                                            <br>
                                            {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
                                        @endif
                                    @endforeach
                                </td>

                                <td class="border text">
                                    @foreach ($section_schedules as $schedule)
                                        @if ($schedule->day == 'Thursday' && $schedule->start_time < '17:00' && $schedule->end_time > '16:30')
                                            {{ $schedule->subject_desc }}<br>
                                            {{ $schedule->room_desc }}
                                            <br>
                                            {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
                                        @endif
                                    @endforeach
                                </td>

                                <td class="border text">
                                    @foreach ($section_schedules as $schedule)
                                        @if ($schedule->day == 'Friday' && $schedule->start_time < '17:00' && $schedule->end_time > '16:30')
                                            {{ $schedule->subject_desc }}<br>
                                            {{ $schedule->room_desc }}
                                            <br>
                                            {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
                                        @endif
                                    @endforeach
                                </td>

                                <td class="border text">
                                    @foreach ($section_schedules as $schedule)
                                        @if ($schedule->day == 'Saturday' && $schedule->start_time < '17:00' && $schedule->end_time > '16:30')
                                            {{ $schedule->subject_desc }}<br>
                                            {{ $schedule->room_desc }}
                                            <br>
                                            {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
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
                                            {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
                                        @endif
                                    @endforeach
                                </td>

                                <td class="border text">
                                    @foreach ($section_schedules as $schedule)
                                        @if ($schedule->day == 'Tuesday' && $schedule->start_time < '17:30' && $schedule->end_time > '17:00')
                                            {{ $schedule->subject_desc }}<br>
                                            {{ $schedule->room_desc }}
                                            <br>
                                            {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
                                        @endif
                                    @endforeach
                                </td>

                                <td class="border text">
                                    @foreach ($section_schedules as $schedule)
                                        @if ($schedule->day == 'Wednesday' && $schedule->start_time < '17:30' && $schedule->end_time > '17:00')
                                            {{ $schedule->subject_desc }}<br>
                                            {{ $schedule->room_desc }}
                                            <br>
                                            {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
                                        @endif
                                    @endforeach
                                </td>

                                <td class="border text">
                                    @foreach ($section_schedules as $schedule)
                                        @if ($schedule->day == 'Thursday' && $schedule->start_time < '17:30' && $schedule->end_time > '17:00')
                                            {{ $schedule->subject_desc }}<br>
                                            {{ $schedule->room_desc }}
                                            <br>
                                            {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
                                        @endif
                                    @endforeach
                                </td>

                                <td class="border text">
                                    @foreach ($section_schedules as $schedule)
                                        @if ($schedule->day == 'Friday' && $schedule->start_time < '17:30' && $schedule->end_time > '17:00')
                                            {{ $schedule->subject_desc }}<br>
                                            {{ $schedule->room_desc }}
                                            <br>
                                            {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
                                        @endif
                                    @endforeach
                                </td>

                                <td class="border text">
                                    @foreach ($section_schedules as $schedule)
                                        @if ($schedule->day == 'Saturday' && $schedule->start_time < '17:30' && $schedule->end_time > '17:00')
                                            {{ $schedule->subject_desc }}<br>
                                            {{ $schedule->room_desc }}
                                            <br>
                                            {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
                                        @endif
                                    @endforeach
                                </td>
                            </tr>

                            <tr class="text-center border">
                                <td class="border text">05:30<br>06:00</td>
                                <td class="border text">
                                    @foreach ($section_schedules as $schedule)
                                        @if ($schedule->day == 'Monday' && $schedule->start_time < '18:00' && $schedule->end_time > '17:30')
                                            {{ $schedule->subject_desc }}<br>
                                            {{ $schedule->room_desc }}<br>
                                            {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
                                        @endif
                                    @endforeach
                                </td>

                                <td class="border text">
                                    @foreach ($section_schedules as $schedule)
                                        @if ($schedule->day == 'Tuesday' && $schedule->start_time < '18:00' && $schedule->end_time > '17:30')
                                            {{ $schedule->subject_desc }}<br>
                                            {{ $schedule->room_desc }}
                                            <br>
                                            {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
                                        @endif
                                    @endforeach
                                </td>

                                <td class="border text">
                                    @foreach ($section_schedules as $schedule)
                                        @if ($schedule->day == 'Wednesday' && $schedule->start_time < '18:00' && $schedule->end_time > '17:30')
                                            {{ $schedule->subject_desc }}<br>
                                            {{ $schedule->room_desc }}
                                            <br>
                                            {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
                                        @endif
                                    @endforeach
                                </td>

                                <td class="border text">
                                    @foreach ($section_schedules as $schedule)
                                        @if ($schedule->day == 'Thursday' && $schedule->start_time < '18:00' && $schedule->end_time > '17:30')
                                            {{ $schedule->subject_desc }}<br>
                                            {{ $schedule->room_desc }}
                                            <br>
                                            {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
                                        @endif
                                    @endforeach
                                </td>

                                <td class="border text">
                                    @foreach ($section_schedules as $schedule)
                                        @if ($schedule->day == 'Friday' && $schedule->start_time < '18:00' && $schedule->end_time > '17:30')
                                            {{ $schedule->subject_desc }}<br>
                                            {{ $schedule->room_desc }}
                                            <br>
                                            {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
                                        @endif
                                    @endforeach
                                </td>

                                <td class="border text">
                                    @foreach ($section_schedules as $schedule)
                                        @if ($schedule->day == 'Saturday' && $schedule->start_time < '18:00' && $schedule->end_time > '17:30')
                                            {{ $schedule->subject_desc }}<br>
                                            {{ $schedule->room_desc }} <br>

                                            {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
                                        @endif
                                    @endforeach
                                </td>
                            </tr>


                    </table>


                </div>
                <div class="mt-5 d-flex justify-content-center">
                    <form action="{{ url('sectionSchedulePDFVIEW/' . $sections->section_id) }}" method="GET">

                        @csrf
                        <button type="submit" class="fw-bold btn text-center p-4 bg-success text-light rounded"
                            style="font-size:20px; width: 500px;">
                            EXPORT PDF
                        </button>
                    </form>
                </div>
            </div>
            </div>
            
        <center>
                <div  style="width:1800px;">
            <hr>
            <div class="container-fluid mt-3 edit-user-container">
                <div class="container-fluid">
                    <h1 class="edit-user-title">{{ $sections->section_desc }} - ADD SCHEDULE</h1>
                </div>
            </div>   
            <div class="row mb-5">
            <div class="col-md-10">
                    <input type="hidden" id="sectionId" value="{{ $sections->section_id }}">
                    <table id="subjectTable" class="table table-striped">
                        <thead class="text">
                            <tr>
                                <th class="text">Subject Code</th>
                                <th class="text">Subject</th>
                                <th class="text">Year Level</th>
                                <th class="text">Semester</th>
                                <th class="text">Day</th>
                                <th class="text">Time In</th>
                                <th class="text">Time Out</th>
                                <th class="text">Faculty</th>
                                <th class="text">Room</th>
                                <th class="text">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="text1">
                        </tbody>

                    </table>
                </div>
                
                <div class="col-md-2 rounded shadow-lg p-4">
                    <form action="" method="POST">
                        @csrf
                        <div class="form-group rounded">
                            <label  class="text1" for="curriculum">Curriculum:</label>
                            <select class="form-control  mb-4" id="curriculum" name="curriculum">
                                @foreach ($curriculums as $curriculum)
                                    <option value="{{ $curriculum->curriculum_id }}">
                                        {{ $curriculum->curriculum_idYear }} - {{ $curriculum->curriculum_desc }}
                                    </option>
                                @endforeach
                            </select>

                            <label  class="text1" for="yearLevel">Year Level:</label>
                            <select class="form-control mb-4" id="yearLevel" name="yearLevel">
                                <option value="1">
                                    1st Year
                                </option>
                                <option value="2">
                                    2nd Year
                                </option>
                                <option value="3">
                                    3rd Year
                                </option>
                                <option value="4">
                                    4th Year
                                </option>
                            </select>

                            <label  class="text1" for="semester">Semester:</label>
                            <select class="form-control  mb-3" id="semester" name="semester">
                                <option value="1st semester">
                                    1st Semester
                                </option>
                                <option value="2nd semester">
                                    2nd Semester
                                </option>
                                <option value="summer">
                                    Summer
                                </option>
                            </select>
                            <br>
                            <button type="submit" class="ex btn  w-100 fw-bold p-3 btn-primary">LOAD</button>


                        </div>
                    </form>
                </div>
            </div>
            <br> <hr>
            </div>
                <div class="container">
            
            <div class="container-fluid mt-5 edit-user-container">
            <div class="container-fluid">
                <h1 class="edit-user-title">{{ $sections->section_desc }} - MANAGE</h1>
            </div>
        </div>
        <div class="col mb-5 mt-5">
            <table id="users" class="table table-striped" style="width:100%">
                <thead>
                    <tr >
                        <th >Subject</th>
                        <th>Room</th>
                        <th>Faculty</th>
                        <th>Day</th>
                        <th>Start Time</th>
                        <th>End Time</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                @foreach ($section_schedules as $section_schedule)
                    <tr class="fw-bold">
                        <td>{{ $section_schedule->subject_desc }}</td>
                        <td>{{ $section_schedule->room_desc }}</td>
                        <td>{{ $section_schedule->faculty_firstName }} {{ $section_schedule->faculty_lastName }}</td>
                        <td>{{ $section_schedule->day }}</td>
                        <td>{{ date('h:i A', strtotime($section_schedule->start_time)) }}</td>
                        <td>{{ date('h:i A', strtotime($section_schedule->end_time)) }}</td>
                        <td>
                            <form action="{{ route('deleteSchedule', $section_schedule->sectionSchedule_id) }}" role="alert" method="post" 
                                    alert-title="Delete Campus" alert-text="Do you really want to delete this record?"
                                    alert-btn-cancel="Cancel" alert-btn-yes="Yes">
                                    <div class="text-center">
                                     @csrf
                                     @method('DELETE')
                                    <button type="submit" class="btn w-100 fw-bold p-3 delete-button btn-danger"><i class="fa-solid fa-trash"></i> Delete</button>
                                    </div>
                                    </form>


                        </td>
                    </tr>
                @endforeach
                </tbody>

            </table>
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
    @include('sweetalert::alert')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script> 
 
    <script>
    $(document).ready(function() {
        $("form").submit(function(e) {
            if ($(this).find('.ex').length > 0) {
            var curriculum = $("#curriculum").val();
            var yearLevel = $("#yearLevel").val();
            var semester = $("#semester").val();

            e.preventDefault();

            $.ajax({
                type: "POST",
                url: "{{ route('filterSubjectsRoute') }}",
                data: {
                    _token: "{{ csrf_token() }}",
                    curriculum: curriculum,
                    yearLevel: yearLevel,
                    semester: semester,
                },
                    success: function(data) {
                        $("#subjectTable tbody").empty();

                        $.each(data.filteredSubjects, function(index, subject) {
                            var row = "<tr class='text1'>";
                            row += "<td class=''>" + subject.subject_code + "</td>";
                            row += "<td class=''>" + subject.subject_desc + "</td>";
                            row += "<td class=''>" + subject.cs_yearLevel + "</td>";
                            row += "<td class=''>" + subject.cs_semesterOffered + "</td>";
                            row += '<form method="POST">';
                            // Days dropdown
                            row += '<td><select class="form-control" name="day">';
                            row += "<option value=''>--Select Day--</option>";
                            row += "<option value='Monday'>Monday</option>";
                            row += "<option value='Tuesday'>Tuesday</option>";
                            row += "<option value='Wednesday'>Wednesday</option>";
                            row += "<option value='Thursday'>Thursday</option>";
                            row += "<option value='Friday'>Friday</option>";

                            row += "<option value='Saturday'>Saturday</option>";
                            row += '</select></td>';
                            // Time in dropdown
                            row += '<td><select class="form-control" name="startTime">';
                            row += "<option value=''>--Select Start Time--</option>";
                            for (let hour = 8; hour <= 19; hour++) {
                                for (let min = 0; min < 60; min += 30) {
                                    let time = ('0' + hour).slice(-2) + ':' + ('0' +
                                        min).slice(-2);
                                    let displayTime = (hour > 12 ? hour - 12 : hour) +
                                        ':' + ('0' + min).slice(-2) + (hour >= 12 ?
                                            ' PM' : ' AM');
                                    row += '<option value="' + time + '">' +
                                        displayTime + '</option>';
                                }
                            }
                            row += '</select></td>';
                            // Time out dropdown
                            row += '<td><select class="form-control"  name="endTime">';
                            row += "<option value=''>--Select End Time--</option>";
                            for (let hour = 8; hour <= 19; hour++) {
                                for (let min = 0; min < 60; min += 30) {
                                    let time = ('0' + hour).slice(-2) + ':' + ('0' +
                                        min).slice(-2);
                                    let displayTime = (hour > 12 ? hour - 12 : hour) +
                                        ':' + ('0' + min).slice(-2) + (hour >= 12 ?
                                            ' PM' : ' AM');
                                    row += '<option value="' + time + '">' +
                                        displayTime + '</option>';
                                }
                            }
                            row += '</select></td>';

                            // Faculty
                            row += '<td><select class="form-control" name="facultyId">';
                            row += "<option value=''>--Select Faculty--</option>";
                            $.each(data.faculties, function(index, faculty) {
                                row += "<option value='" + faculty.faculty_id +
                                    "'>" +
                                    faculty.faculty_firstName + ' ' + faculty
                                    .faculty_lastName + ' -> ' + faculty
                                    .dept_desc + "</option>";
                            });
                            row += "</select></td>";

                            // Room
                            row += '<td><select class="form-control" name="roomId">';
                            row += "<option value=''>--Select Room--</option>";
                            $.each(data.rooms, function(index, room) {
                                row += "<option value='" + room.room_code +
                                    "'>" +
                                    room.room_desc + ' -> ' + room
                                    .room_location + "</option>";
                            });
                            row += "</select></td>";
                            row +=
                                "<td><button class='btn fw-bold btn-success addToSchedule'>Add  Schedule</button></td>";
                            row +=
                                "</form></td>"; // Closing the form tag outside the row
                            row += "</tr>"; // Closing the row tag
                            $("#subjectTable tbody").append(row);
                        });

                        // Add event listener to validate end time
                        $("select[name='endTime']").change(function() {
                            var startTime = $(this).closest("tr").find(
                                "select[name='startTime']").val();
                            var endTime = $(this).val();

                            if (startTime && endTime) {
                                if (endTime <= startTime) {
                                    alert(
                                        "End time cannot be earlier than or equal to start time."
                                    );
                                    $(this).val(""); // Clear the selected value
                                }
                            }
                        });
                    },
                });
            }
        });

        $(document).on('click', '.addToSchedule', function() {
            var row = $(this).closest("tr"); // Get the closest row
            var sectionId = $("#sectionId").val();
            var subjectCode = row.find("td:eq(0)").text();
            var day = row.find("select[name='day']").val();
            var startTime = row.find("select[name='startTime']").val();
            var endTime = row.find("select[name='endTime']").val();
            var facultyId = row.find("select[name='facultyId']").val();
            var roomId = row.find("select[name='roomId']").val();

            // Log the data to the console
            console.log("Section Id: " + sectionId);
            console.log("Subject Code: " + subjectCode);
            console.log("Day: " + day);
            console.log("Start Time: " + startTime);
            console.log("End Time: " + endTime);
            console.log("Faculty ID: " + facultyId);
            console.log("Room ID: " + roomId);

            $.ajax({
                type: "POST",
                url: "{{ route('addToSchedule') }}", // Replace with the actual route
                data: {
                    _token: "{{ csrf_token() }}",
                    subjectCode: subjectCode,
                    sectionId: sectionId,
                    day: day,
                    startTime: startTime,
                    endTime: endTime,
                    facultyId: facultyId,
                    roomId: roomId
                },
                success: function(data) {
                    if (data.conflictingSchedules && data.conflictingSchedules.length > 0) {
                        var conflictingSchedules = data.conflictingSchedules;
                        var formattedMessage =
                            'There is a scheduling conflict.\n \n';

                        conflictingSchedules.forEach(function(schedule) {
                            var startTime = formatTime(schedule.start_time);
                            var endTime = formatTime(schedule.end_time);
                            formattedMessage +=
                                'Section: ' + schedule.section_desc + '\n' +
                                'Faculty: ' + schedule.faculty_name + '\n' +
                                'Room: ' + schedule.room_desc + '\n' +
                                'Day: ' + schedule.day + '\n' +
                                'Start Time: ' + startTime + '\n' +
                                'End Time: ' + endTime + '\n ' +
                                '______________________' + '\n \n';
                        });

                        alert(formattedMessage);
                    } else {
                        console.log("Schedule added successfully");

                        console.log(data.checkSec);
                        location.reload();
                        alert("Schedule added successfully");
                    }
                },
                error: function(error) {
                    // Handle error response here
                    console.error(error);
                }
            });
        });

        $(document).on('click', '.delete-button', function() {
            var form = $(this).closest("form");
            var url = form.attr('action');
            var sectionScheduleId = url.split('/').pop();

            if (confirm("Are you sure you want to delete this schedule?")) {
                $.ajax({
                    type: "DELETE",
                    url: "/delete-schedule/" + sectionScheduleId,
                    data: form.serialize(), // You might need to adjust the data if required
                    success: function(response) {
                        // Handle the success response here
                        console.log("Delete request sent successfully.");
                        console.log(response.section_schedulesDel);
                        // You can perform any additional actions after the successful deletion.

                        location.reload(); // Reload the page after successful deletion
                        alert("Schedule Deleted successfully");
                    },
                    error: function(error) {
                        // Handle any errors that occur during the AJAX request
                        console.error("Error occurred during the delete request:", error);
                    }
                });
            }
        });

        function formatTime(time) {
            var splitTime = time.split(':');
            var hours = splitTime[0];
            var minutes = splitTime[1];
            var suffix = hours >= 12 ? 'PM' : 'AM';
            hours = hours % 12 || 12;
            return hours + ':' + minutes + ' ' + suffix;
        }
    });
</script>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    $(document).ready(function () {
        // Make an AJAX request when the document is ready
        $.ajax({
            url: "/section/{{ $sections->section_id }}/get-schedule", // Adjust the URL
            type: "GET",
            dataType: "json",
            success: function (scheduleData) {
                // Iterate over the schedule data and update the table cells
                scheduleData.forEach(function (schedule) {
                    var day = schedule.day.toLowerCase();
                    var time = schedule.time;

                    // Find the corresponding table cell and update its content
                    $("#scheduleTable td[data-day='" + day + "'][data-time='" + time + "']").text(schedule.subject_name);
                });
            },
            error: function (xhr, status, error) {
                console.error(error);
            }
        });
    });
</script>
</body>



</html>

<?php

}
?>
