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
    <script>
        //ajax dont modify
        $(document).ready(function() {
            // Listen for form submission
            $("form").submit(function(e) {
                e.preventDefault(); // Prevent form from submitting traditionally

                // Get selected values from the form
                var schoolyear_id = $("#schoolyear").val();
                var yearLevel = $("#yearLevel").val();
                var section_semester = $("#semester").val();

                // Send an Ajax request to fetch filtered data
                $.ajax({
                    type: "POST",
                    url: "{{ route('filterSectionsRoute') }}", // Update with your actual route name
                    data: {
                        _token: "{{ csrf_token() }}",
                        schoolyear_id: schoolyear_id,
                        yearLevel: yearLevel,
                        section_semester: section_semester,
                    },
                    success: function(data) {
                        // Clear existing table rows

                        $("#users tbody").empty();

                        //Populate the table with the fetched data
                        $.each(data, function(index, section) {
                            var row = "<tr>";
                            row += "<td>" + section.section_id + "</td>";
                            row += "<td>" + section.section_desc + "</td>";
                            row += "<td>" + section.schoolyear_sy + "</td>";
                            row += "<td>Year " + section.section_yearLevel + "</td>";
                            row += "<td>" + section.section_semester + "</td>";
                            row += "<td>" + section.section_capacity + "</td>";

                            row += "<td><a href='/sectionScheduleManage/" + section
                                .section_id +
                                "' class='btn btn-success'>EDIT SCHEDULE</a></td>";
                            row += "</tr>";

                            $("#users tbody").append(row);
                        });
                    },
                });
            });

            $("#showAllSectionsBtn").click(function() {
                $.ajax({
                    type: "POST",
                    url: "{{ route('allSectionsRoute') }}",
                    data: {
                        _token: "{{ csrf_token() }}",
                    },
                    success: function(data) {
                        $("#users tbody").empty();

                        $.each(data, function(index, section) {
                            var row = "<tr>";
                            row += "<td>" + section.section_id + "</td>";
                            row += "<td>" + section.section_desc + "</td>";
                            row += "<td>" + section.schoolyear_sy + "</td>";
                            row += "<td>Year " + section.section_yearLevel + "</td>";
                            row += "<td>" + section.section_semester + "</td>";
                            row += "<td>" + section.section_capacity + "</td>";
                            row += "<td><a href='/sectionScheduleManage/" + section
                                .section_id +
                                "' class='btn btn-success'>EDIT SCHEDULE</a></td>";
                            row += "</tr>";

                            $("#users tbody").append(row);
                        });
                    },
                });
            });
        });
    </script>
    <title>Section Schedule</title>


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
    <button class="darkmode shadow-lg  btn-primary p-4" title=" Dark Mode" onclick="toggleDarkMode()">
        <i class="fa-solid fa-moon"></i>
    </button>
    <div class="container contains">
        <div class="dark"></div>
    </div>
    <div id="mySidebar" class="sidebar shadow-lg">
        <center>
            <img src="../assets/logo/PSUlabel1.png" alt="SSS Logo" class=" logo mt-2 img-fluid" style="width:100px;">
            <h1 class="title1 p-2">PSU</h2>
        </center>
        <a href="chairMainPage" class="link fw-bold"><i class="fa fa-tachometer"
                aria-hidden="true"></i>&nbsp;&nbsp;Dashboard</a>
        <a href="chairSectionSchedule" class="link active fw-bold"><i
                class="fa-solid fa-clipboard"></i>&nbsp;&nbsp;Section
            Schedules</a>
        <a href="chairFacultySchedule" class="link fw-bold"><i class="fa-solid fa-users"></i>&nbsp;&nbsp;Faculty
            Schedules</a>
        <a href="chairRoomSchedule" class="link fw-bold"><i class="fa-solid fa-house"></i>&nbsp;&nbsp;Room
            Schedules</a>
        <a href="chairWorkload" class="   fw-bold"><i class="fa-solid fa-briefcase"></i>&nbsp;&nbsp;Faculty Workload</a>
        <hr class= "bg-white fw-bold">
        <a href="myAccPage" class="    fw-bold"><i class="fa-solid fa-user"></i>&nbsp;&nbsp;My
            Account</a>
        <a href="/logout" class="   fw-bold"><i class="fa-solid fa-right-from-bracket"></i>&nbsp;&nbsp;Logout</a>

    </div>

    <div id="main" class="content  scrollable-form">
        <div class="navbar shadow-lg rounded">
            <div class="navbar-title">
                <h1 class="title fw-bold p-3">SECTION SCHEDULE</h3>
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

        <div class="container-fluid scrollable-form  mt-5 p-4 main">
            <div class="row shadow p-5">
                <div class="col-md-9 p-5">
                    <div class="col">
                        <div class="row">
                            <div class="col">
                                <table id="users" class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Section Name</th>
                                            <th>School Year</th>
                                            <th>Year Level</th>
                                            <th>Semester</th>
                                            <th>Capacity</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($sections as $section)
                                            <tr>
                                                <td>{{ $section->section_id }}</td>
                                                <td>{{ $section->section_desc }}</td>
                                                <td>{{ $section->schoolyear_sy }}</td>
                                                <td>Year {{ $section->section_yearLevel }}</td>
                                                <td>{{ $section->section_semester }}</td>
                                                <td>{{ $section->section_capacity }}</td>

                                                <td>
                                                    <a href="/sectionScheduleManage/{{ $section->section_id }}"
                                                        class="btn btn-success fw-bold">
                                                        EDIT SCHEDULE
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
                <div class="col-md-3  mt-5 shadow  p-5">
                    <form action="" method="POST">
                        @csrf
                        <div class="form-group fw-bold">
                            <label for="schoolyear">School Year:</label>
                            <select class="form-control  fw-bold mb-3 mt-2" id="schoolyear" name="schoolyear_id">
                                @foreach ($sections->unique('schoolyear_sy') as $section)
                                    <option value="{{ $section->schoolyear_id }}">
                                        {{ $section->schoolyear_sy }}
                                    </option>
                                @endforeach
                            </select>

                            <label for="yearLevel">Year Level:</label>
                            <select class="form-control  fw-bold mb-3 mt-2" id="yearLevel" name="yearLevel">
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

                            <label for="semester">Semester:</label>
                            <select class="form-control  fw-bold  mt-2" id="semester" name="section_semester">
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
                            <button type="submit" class="btn w-100 mb-3 fw-bold btn-primary">LOAD</button>
                            <button type="button" id="showAllSectionsBtn"
                                class="btn customs fw-bold w-100 btn-transparent"
                                style="border: 2px solid #007BFF; color: #007BFF">Show All
                                Sections</button>

                        </div>
                    </form>
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
