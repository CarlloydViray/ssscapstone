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
    
    <title>Room Schedule</title>
</head>
<style>
    .active thead {
    background-color: white;
    color: #2D3436;
  }

  .activee #users tbody tr:hover,
  .active #users tbody tr:nth-child(odd):hover,
  .active #users tbody tr:nth-child(even):hover {
    transform: scale(1.02);
    transition: background-color 0.3s, transform 0.1s;
    background-color:  #2D3436;
  }

  .active #users tbody tr td,
  .active #users tbody tr:nth-child(odd) td,
  .active #users tbody tr:nth-child(even) td {
    color: white;
  }

  .active td {
    color:   #2D3436;
  }
  thead {
    background-color: #082b54;
    color: #F3D370;
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
        <a href="/chairRoomScheduleResource" class="fw-bold link p-5 title1">
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
        <div class="container shadow p-1  mb-5  rounded" style="margin-top: 170px;">
                <h1 class="edit-user-title edit-user-container">{{ $rooms->room_code }}</h1>
                <div class="container rounded mt-5 p-5">
            <div class="col">
                <table id="users" class="table table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>School Year</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($section_schedules->unique('schoolyear_sy') as $section_schedule)
                            <tr class="fw-bold">
                                <td>{{ $section_schedule->schoolyear_sy }}</td>
                                <td>
                                    <a href="/roomScheduleView/{{ $section_schedule->sectionSchedule_id }}/{{ $rooms->room_code }}"class="btn btn-success">VIEW SCHEDULE</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
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



<footer
          class="text-center text-lg-start">
    <div class="text-center fw-bold p-3">Pangasinan State University • San Vicente • Urdaneta City • Pangasinan • (075) 542 5133<br>
      © 2023 Copyright:
    </div>
  </footer>

</body>



</html>

<?php

}
?>
