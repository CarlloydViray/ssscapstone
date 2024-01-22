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

    <title>Users Management Edit</title>
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
        <i class="fa-solid fa-moon"></i>
    </button>
    <div class="container contains">
        <div class="dark"></div>
    </div>
    <div class="scrollable-form">
        <div class="navbar shadow-lg fixed-top">
            <a href="/misUsersManagementResource" class="fw-bold link p-5"><i class="fa-solid fa-arrow-left"></i>
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

        <div class="container content   shadow-lg w-50  mb-5 rounded">
            <div class="container-fluid edit-user-container shadow-lg rounded">
                <h1 class="edit-user-title">EDIT USER</h1>
            </div>
            <div class="container" style="margin-left:150px;">
                @foreach ($users as $user)
                    <form action="{{ $user->user_id }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row p-3">
                            <div class="row">
                                <div class="col-md-8 col-sm-12 col-12 p-3">
                                    <label for="campusName" class="form-label">Campus</label>
                                    <select name="campus_code" id="campusName" class="rounded form-control">
                                        <option value="">Select Campus</option>
                                        @foreach ($campuses as $campus)
                                            <option value="{{ $campus->campus_code }}" selected>
                                                {{ $campus->campus_code . ' -- ' . $campus->campus_location }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('campus_code')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="row">
                                <div class="col-md-4 col-sm-12 col-12 p-3">
                                    <label for="first_name" class="form-label">First Name</label>
                                    <input type="text" name="first_name" id="first_name" class="form-control"
                                        placeholder="Input First name" value="{{ $user->user_firstName }}">
                                </div>
                                @error('first_name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror


                                <div class="col-md-4 col-sm-12 col-12 p-3">
                                    <label for="last_name" class="form-label">Last Name</label>
                                    <input type="text" name="last_name" id="last_name" class="form-control"
                                        placeholder="Input Last name" value="{{ $user->user_lastName }}">
                                </div>
                                @error('last_name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="row">
                                <div class="col-md-4 col-sm-12 col-12 p-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" name="email" id="email" class="form-control"
                                        placeholder="Input First name" value="{{ $user->user_email }}">
                                </div>
                                @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror


                                <div class="col-md-4 col-sm-12 col-12 p-3">
                                    <label for="number" class="form-label">Phone Number</label>
                                    <input type="text" name="number" id="number" class="form-control"
                                        placeholder="Input Last name" value="{{ $user->user_number }}">
                                </div>
                                @error('number')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>



                            <div class="row">
                                <div class="col-md-4 col-sm-12 col-12 p-3">
                                    <label for="userBirthday" class="form-label">Birthday</label>
                                    <input type="date" name="userBirthday" id="userBirthday" class="form-control"
                                        value="{{ $user->user_birthday }}">
                                </div>
                                @error('userBirthday')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror


                                <div class="col-md-2 col-sm-12 col-12 p-3">
                                    <label class="form-label">Sex</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="sex" id="male"
                                            value="Male" {{ $user->user_sex === 'Male' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="male">Male</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="sex" id="female"
                                            value="Female" {{ $user->user_sex === 'Female' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="female">Female</label>
                                    </div>
                                </div>
                                @error('sex')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>


                            <div class="row">
                                <div class="col-md-8 col-sm-12 col-12 p-3">
                                    <label for="address" class="form-label">Address</label>
                                    <input type="text" name="address" id="address" class="form-control"
                                        placeholder="Input Address" value="{{ $user->user_address }}">
                                </div>
                                @error('address')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="row">
                                <div class="col-md-8 col-sm-12 col-12 p-3">
                                    <label for="dept_name" class="form-label">Department</label>
                                    <select name="dept_code" id="dept_name" class="form-control">
                                        <option value="">Select Department</option>
                                        @foreach ($departments as $department)
                                            <option value="{{ $department->dept_code }}"
                                                {{ $users[0]->dept_desc == $department->dept_desc ? 'selected' : '' }}>
                                                {{ $department->campus_code . ' -- ' . $department->dept_desc }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('dept_code')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>





                            <div class="row">
                                <div class="col-md-4 col-sm-12 col-12 p-3">
                                    <label for="usertype" class="form-label">Type</label>
                                    <select name="usertype" id="usertype" class="form-control">
                                        <option value="">Select User Type</option>
                                        <option value="mis" {{ $user->user_type === 'mis' ? 'selected' : '' }}>MIS
                                        </option>
                                        <option value="chair" {{ $user->user_type === 'chair' ? 'selected' : '' }}>
                                            Department Chair
                                        </option>
                                    </select>
                                </div>
                                @error('usertype')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror



                                <div class="col-md-4 col-sm-12 col-12 p-3">
                                    <label for="userstatus" class="form-label">Status</label>
                                    <select name="status" id="userstatus" class="form-control">
                                        <option value="">Select User Status</option>
                                        <option value="active" {{ $user->user_status == 'active' ? 'selected' : '' }}>
                                            Active
                                        </option>
                                        <option value="inactive"
                                            {{ $user->user_status == 'inactive' ? 'selected' : '' }}>
                                            Inactive</option>
                                    </select>
                                </div>
                                @error('status')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>


                            <div class="row">
                                <div class="col-md-8 col-sm-12 col-12 p-3">
                                    <label for="username" class="form-label">Username</label>
                                    <input type="text" name="username" id="username" class="form-control"
                                        placeholder="Input Username" value="{{ $user->user_username }}">
                                    @error('username')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-8 col-sm-12 col-12 p-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" name="password" id="password" class="form-control"
                                        placeholder="Input Password">
                                    @error('password')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-8 col-sm-12 col-12 p-3">
                                    <label for="password2" class="form-label">Re-Type Password</label>
                                    <input type="password" name="password2" id="password2" class="form-control"
                                        placeholder="Re-Type Password">
                                    @error('password2')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                        </div>
            </div>
            <center>
                <div class="col-md-6 col-sm-12 col-12 p-3">
                    <input type="submit" class="btn btn-lg w-100 p-2 mb-3 fw-bold mt-3 mb-3 btn-lg btn-primary btn-block"
                        value="UPDATE">
                </div>
            </center>
            </form>
            @endforeach
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
