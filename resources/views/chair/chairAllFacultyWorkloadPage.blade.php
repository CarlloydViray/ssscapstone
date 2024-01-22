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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    {{-- datatable bootsrap --}}
    {{-- css --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">

    {{-- script --}}
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
    <title>Faculty Workload</title>
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
        background-color: #2D3436;
    }

    .active #users tbody tr td,
    .active #users tbody tr:nth-child(odd) td,
    .active #users tbody tr:nth-child(even) td {
        color: white;
    }

    .active td {
        color: #2D3436;
    }

    thead {
        background-color: #082b54;
        color: #F3D370;
    }

    .form-control2 {
        height: 30px;
        padding: 3px;
    }

    .hidden-input {
        display: none;
        /* Hide the input visually */
    }

    .visible-value {
        padding: 5px;
        /* Set the padding as needed */
        display: inline-block;
        line-height: 20px;
        /* Set the line height equal to the container height */
        vertical-align: middle;
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
            <a href="/chairWorkloadResource" class="fw-bold title link p-5" style="font-size:20px;">
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
        <div class="container shadow  mb-3  rounded" style="margin-top: 170px;">
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
            <div class="d-flex  mb-3 mt-4 justify-content-end">
                <form action="{{ url('/allfacultyWorkloadPDF') }}" method="POST" formtarget="_blank" target="_blank">
                    @csrf
                    <button type="submit" class="btn fw-bold text-center mt-4  mb-4 p-4 bg-success text-light rounded"
                        style="width: 200px;">
                        EXPORT PDF
                    </button>
                </form>
            </div>
            @foreach ($facultyMembers as $facultyMember)
                <h1 class="edit-user-title edit-user-container">
                    {{ $facultyMember->faculty_firstName . ' ' . $facultyMember->faculty_lastName }}</h1>
                <div class="container rounded mt-2 p-5">
                    <div class="col">
                        @foreach ($loadings[$facultyMember->faculty_id] as $loading)
                            <table id="users1" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Designation</th>
                                        <th>Research</th>
                                        <th>Extension</th>
                                        <th>Total Units of Deloading</th>
                                        <th>Total Work Load Units</th>
                                        <th>Teaching Preparation</th>
                                        <th>Designation Preparation</th>
                                        <th>Remarks</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <input type="number" step="0.01" class="form-control"
                                                id="loading_designation" name="loading_designation" placeholder="0.00"
                                                value="{{ $loading->designation_units }}" readonly>
                                        </td>
                                        <td>
                                            <input type="number" step="0.01" class="form-control"
                                                id="loading_designation" name="loading_designation" placeholder="0.00"
                                                value="{{ $loading->loading_research ?? 0.0 }}" readonly>
                                        </td>

                                        <td>
                                            <input type="number" step="0.01" class="form-control"
                                                id="loading_designation" name="loading_designation" placeholder="0.00"
                                                value="{{ $loading->loading_extension ?? 0.0 }}" readonly>
                                        </td>

                                        <td>
                                            <input type="number" step="0.01" class="form-control"
                                                id="loading_prepTeaching" name="loading_prepTeaching"
                                                placeholder="0.00"
                                                value="{{ $loading->loading_totalUnitsDeloading ?? 0.0 }}"readonly>

                                        </td>
                                        <td>
                                            <input type="number" step="0.01" class="form-control"
                                                id="loading_prepTeaching" name="loading_prepTeaching"
                                                placeholder="0.00"
                                                value="{{ $loading->loading_totalWorkLoadUnits ?? 0.0 }}" readonly>

                                        </td>
                                        <td>
                                            <input type="text" class="form-control" id="loading_prepTeaching"
                                                name="loading_prepTeaching" placeholder="0.00"
                                                value="{{ number_format($uniqueSubjectsCount[$facultyMember->faculty_id] ?? 0, 2, '.', '') }}"
                                                readonly>
                                        </td>

                                        <td>
                                            <input type="number" step="0.01" class="form-control"
                                                id="loading_prepDesignation" name="loading_prepDesignation"
                                                placeholder="0.00"
                                                value="{{ $loading->loading_prepDesignation ?? 0.0 }}" readonly>

                                        </td>
                                        <td><strong class="form-control">
                                                <input type="hidden" name="prepChecker" class="hidden-input">
                                                <span class="visible-value">{{ $loading->loading_remarks }}</span>
                                            </strong>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        @endforeach
                    </div>
                </div>

                <table id="users" class="table mt-5 table-striped">
                    <thead>
                        <tr>
                            <th>Section</th>
                            <th>Course Code</th>
                            <th>Course Title</th>
                            <th>Lecture Units</th>
                            <th>Laboratory Units</th>
                            <th>Lecture Hours</th>
                            <th>Laboratory Hours</th>
                            <th>Total Teaching Units</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $totalTeachingUnitsSum = 0;
                        @endphp

                        @foreach ($workloads[$facultyMember->faculty_id] as $workload)
                            @php

                                $lectureUnits = $workload->subject_lec * 1;
                                $labUnits = $workload->subject_lab * 3;
                                $totalTeachingUnits = $lectureUnits + $labUnits * 0.75;

                                // Add the current row's total to the sum
                                $totalTeachingUnitsSum += $totalTeachingUnits;
                            @endphp
                            <tr>
                                <td>{{ $workload->section_desc }}</td>
                                <td>{{ $workload->subject_code }}</td>
                                <td>{{ $workload->subject_desc }}</td>
                                <td>{{ $workload->subject_lec }}</td>
                                <td>{{ $workload->subject_lab }}</td>
                                <td>{{ $lectureUnits }}</td>
                                <td>{{ $labUnits }}</td>
                                <td>{{ $totalTeachingUnits }}</td>
                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="7"><strong>Total Teaching Load Units</strong></td>
                            <td><strong>{{ $totalTeachingUnitsSum }}</strong></td>
                        </tr>
                        <input type="hidden" name="totalTeachingUnitsSum" value="{{ $totalTeachingUnitsSum }}">
                        </form>
                    </tbody>
                </table>
                <br>
                <hr>
                <br><br>
            @endforeach
        </div>
    </div>






    <footer>
        <div class="fw-bold p-3">Pangasinan State University • San Vicente • Urdaneta City • Pangasinan • (075) 542
            5133<br>
            © 2023 Copyright:
        </div>
    </footer>
</body>

</html>

<?php

}
?>
