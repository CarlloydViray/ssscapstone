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
<style>
    td {
        font-size: 20px;
    }

    .scrollable-form {
        overflow-y: auto;
        max-height: 95vh;
        padding: 15px;
        position: relative;
        transition: margin-left 0.5s;
    }
</style>

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
    <title>Faculty Workload</title>
</head>
<style>
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

    p {
        color: gray;
    }

    .bottom {
        position: fixed;
        bottom: 0;
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
<style>
    .scrollable-form {
        overflow-y: auto;
        max-height: 95vh;
        padding: 15px;
        position: relative;
        transition: margin-left 0.5s;
    }
</style>

<body>
    <button class="darkmode shadow-lg  btn-primary p-4" title=" Dark Mode" onclick="toggleDarkMode()">
        <i class="fa-solid fa-moon"></i>
    </button>
    <div class="container contains">
        <div class="dark"></div>
    </div>
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

    <div id="mySidebar" class="sidebar shadow-lg">
        <center>
            <img src="../assets/logo/PSUlabel1.png" alt="SSS Logo" class=" logo mt-2 img-fluid" style="width:100px;">
            <h1 class="title1 p-2">PSU</h2>
        </center>
        <a href="chairMainPage" class="link  fw-bold"><i class="fa fa-tachometer"
                aria-hidden="true"></i>&nbsp;&nbsp;Dashboard</a>
        <a href="chairSectionSchedule" class="   fw-bold"><i class="fa-solid fa-clipboard"></i>&nbsp;&nbsp;Section
            Schedules</a>
        <a href="chairFacultySchedule" class="   fw-bold"><i class="fa-solid fa-users"></i>&nbsp;&nbsp;Faculty
            Schedules</a>
        <a href="chairRoomSchedule" class="   fw-bold"><i class="fa-solid fa-house"></i>&nbsp;&nbsp;Room Schedules</a>
        <a href="chairWorkload" class=" active  fw-bold"><i class="fa-solid fa-briefcase"></i>&nbsp;&nbsp;Faculty
            Workload</a>
        <hr class= "bg-white fw-bold">
        <a href="myAccPage" class="    fw-bold"><i class="fa-solid fa-user"></i>&nbsp;&nbsp;My
            Account</a>
        <a href="/logout" class="   fw-bold"><i class="fa-solid fa-right-from-bracket"></i>&nbsp;&nbsp;Logout</a>

    </div>

    <div id="main" class="content scrollable-form">
        <div class="navbar shadow-lg rounded">
            <div class="navbar-title">
                <h1 class="title p-3 fw-bold">School Year {{ $currentSchoolYear }}</h3>
            </div>
            <div class="navbar-info">
                <div class="row align-items-center p-4">
                    <div class="col  user-name">
                        <span>
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
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid shadow rounded p-5 ">
            <div class="row mt-5">
                <div class="col">

                    <div class="row mt-5">
                        <div class="col">
                            <a href="/chairAllFacultyWorkloadPage" class="btn mb-5 fw-bold p-3 btn-success">
                                SHOW ALL WORKLOAD
                            </a>
                            <table id="users" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Faculty</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($workloads->unique('faculty_id') as $workload)
                                        <tr>
                                            <td>
                                                {{ $workload->faculty_firstName }} {{ $workload->faculty_lastName }}
                                            </td>
                                            <td>
                                                <a href="/facultyWorkloadManage/{{ $workload->faculty_id }}"
                                                    class="btn btn-success">
                                                    SHOW WORKLOAD
                                                </a>
                                            </td>


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
