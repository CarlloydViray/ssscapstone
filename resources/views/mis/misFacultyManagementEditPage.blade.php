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

    {{-- datatable bootsrap --}}
    {{-- css --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/mis_edit.css') }}">

    {{-- script --}}
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#users').DataTable();
        });
    </script>

    <title>Faculty Management Edit</title>
</head>
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
            <a href="/misFacultyManagementResource" class="fw-bold link p-5""><i class="fa-solid fa-arrow-left"></i>
                Back</a>

            <div class="navbar-info" style=" width: 330px;">
                <div class="row">
                    <div class="col-md-6 mt-3 user-name">
                        <span>
                            <center>
                                <h5 class=" title">
                                    {{ session('user_firstName') . '' . session('user_lastName') }}</h5>
                                <h6 class=" title">
                                    {{ session('campus_code') }}</h6>
                            </center>
                        </span>
                    </div>
                    <div class="col">
                        <img src="/assets/logo/PSUlabel1.png" alt="SSS Logo" class="logo" style="width:70px;">
                    </div>
                </div>
            </div>

        </div>
        <div class="container  shadow-lg w-50  mb-5 rounded" style="width:500px; margin-top:170px;">

            <div class="container-fluid edit-user-container">
                <div class="container-fluid">
                    <h1 class="edit-user-title">EDIT FACULTY</h1>
                </div>
            </div>
            <div class="container" style="margin-left:0;">

                @foreach ($faculties as $faculty)
                    <form action="{{ $faculty->faculty_id }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-12 p-3">
                                <label for="campusName" class="form-label">Campus</label>
                                <select name="campus_code" id="campusName" class="form-control">
                                    <option value="">Select Campus</option>
                                    @foreach ($campuses as $campus)
                                        @if ($faculty->campus_code == $campus->campus_code)
                                            <option value="{{ $campus->campus_code }}" selected>
                                                {{ $campus->campus_code . ' -- ' . $campus->campus_location }}
                                            </option>
                                        @endif
                                    @endforeach
                                </select>
                                @error('campus_code')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="row">
                                <div class="col-md-6 col-sm-12 col-12 p-3">
                                    <label for="first_name" class="form-label">First Name</label>
                                    <input type="text" name="faculty_firstName" id="first_name" class="form-control"
                                        placeholder="Input First name" value="{{ $faculty->faculty_firstName }}">
                                    @error('faculty_firstName')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6 col-sm-12 col-12 p-3">
                                    <label for="first_name" class="form-label">Last Name</label>
                                    <input type="text" name="faculty_lastName" id="first_name" class="form-control"
                                        placeholder="Input First name" value="{{ $faculty->faculty_lastName }}">
                                    @error('faculty_lastName')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 col-sm-12 col-12 p-3">
                                    <label for="curriculum" class="form-label">Department</label>
                                    <select name="dept_code" id="curriculum" class="form-control">
                                        <option value="">Select Department</option>
                                        @foreach ($departments->where('campus_code', $faculty->campus_code) as $department)
                                            <option value="{{ $department->dept_code }}"
                                                @if ($faculty->dept_code == $department->dept_code) selected @endif>
                                                {{ $department->campus_code . ' -- ' . $department->dept_desc }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('curriculum_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>


                                <div class="col-md-6 col-sm-12 col-12 p-3">
                                    <label for="curriculum" class="form-label">Designation</label>
                                    <select name="designation_id" id="curriculum" class="form-control" required>
                                        <option value="">Select Designation</option>
                                        @foreach ($designations as $designation)
                                            <option value="{{ $designation->designation_id }}"
                                                {{ $faculty->designation_id == $designation->designation_id ? 'selected' : '' }}>
                                                {{ $designation->designation_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('designation_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror

                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 col-sm-12 col-12 p-3">
                                    <label for="userBirthday" class="form-label">Birthday</label>
                                    <input type="date" name="faculty_birthDate" id="userBirthday"
                                        class="form-control" value="{{ $faculty->faculty_birthDate }}">
                                    @error('faculty_birthDate')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-6 col-sm-12 col-12 p-3">
                                    <label class="form-label">Sex</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="faculty_sex"
                                            id="male" value="Male"
                                            {{ $faculty->faculty_sex === 'Male' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="male">Male</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="faculty_sex"
                                            id="female" value="Female"
                                            {{ $faculty->faculty_sex === 'Female' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="female">Female</label>
                                    </div>
                                    @error('faculty_sex')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-12">
                                    <label for="userstatus" class="form-label">Status</label>
                                    <select name="status" id="userstatus" class="form-control">
                                        <option value="">Select User Status</option>
                                        <option value="active"
                                            {{ $faculty->faculty_status == 'active' ? 'selected' : '' }}>Active
                                        </option>
                                        <option value="inactive"
                                            {{ $faculty->faculty_status == 'inactive' ? 'selected' : '' }}>
                                            Inactive</option>
                                    </select>
                                    @error('status')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-12 p-3">
                                    <label for="address" class="form-label">Address</label>
                                    <input type="text" name="faculty_address" id="address" class="form-control"
                                        placeholder="Input Address" value="{{ $faculty->faculty_address }}">
                                    @error('faculty_address')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 col-sm-12 col-12">
                                    <input type="submit" style="margin-left:200px;"
                                        class="btn w-100  mb-4 p-3 fw-bold mt-3 btn-primary btn-block" value="UPDATE">
                                </div>
                            </div>

                    </form>
                @endforeach
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
