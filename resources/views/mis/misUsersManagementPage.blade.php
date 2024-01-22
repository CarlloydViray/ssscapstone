<?php
if (session('user_id') == null) {
    ?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <title>Login Required</title>
    <link rel="icon" href="{!! asset('images/gcm_ico.ico') !!}" />
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
    <script>
        setTimeout(function() {
            window.location.href = "/";
        }, 3000);
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
    <title>Users Management</title>
</head>

<style>
    .scrollable-form {
        overflow-y: auto;
        max-height: 95vh;
        padding: 15px;
        position: relative;
        transition: margin-left 0.5s;
    }

    .form-label.required::after {
        content: ' *';
        color: red;
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
</style>

<body class="">
    <button class="darkmode shadow-lg  btn-primary p-4" title=" Dark Mode" onclick="toggleDarkMode()">
        <i class="fa-solid fa-moon"></i>
    </button>
    <div class="container contains">
        <div class="dark"></div>
    </div>

    <div id="mySidebar" class=" container sidebar shadow-lg">
        <center>
            <img src="../assets/logo/PSUlabel1.png" alt="SSS Logo" class=" logo mt-2 img-fluid" style="width:100px;">
            <h3 class="title1">PSU</h2>
        </center>
        @php
            $userType = session('user_type');
        @endphp

        <a href="misMainPage" class="link fw-bold"><i class="fa fa-tachometer"
                aria-hidden="true"></i>&nbsp;&nbsp;Dashboard</a>
        <a href="misUsersManagement" class=" active  fw-bold"><i class="fa-solid fa-users"></i>&nbsp;&nbsp;Users
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
        <a href="misCurricularSubjectsManagement" class=" fw-bold"><i
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


    <div id="main" class="content scrollable-form  rounded">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="navbar shadow-lg rounded">

            <div class="navbar-title">
                <h1 class="title fw-bold p-3"> USERS MANAGEMENT</h3>
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


        <div class="rounded p-5 ">
            <button type="button" class="btn p-3 btn-lg fw-bold btn-primary " data-bs-toggle="modal"
                data-bs-target="#userModal"><i class="fa fa-plus" aria-hidden="true"></i>
                Add User
            </button>
            <a class="btn btn-danger btn-lg ms-3  p-3 fw-bold float-end" href="{{ route('users.export') }}"><i
                    class="fa-solid fa-lg  fa-file-export"></i> &nbsp; Export User Data</a>
            <button type="button" class="btn p-3 float-end ms-3 btn-lg fw-bold btn-primary" data-bs-toggle="modal"
                data-bs-target="#import"><i class="fa-solid fa-lg fa-file-import"> </i> &nbsp; Import User
                Data</button>



            <div class="row mt-5">
                <div class="col">
                    <table id="users" class="table table-striped" style="width:100% border: 0;">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Campus</th>
                                <th>Department</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Email</th>
                                <th>Number</th>
                                <th>Address</th>
                                <th>Birthday</th>
                                <th>Sex</th>
                                <th>Username</th>
                                <th>Type</th>
                                <th>Status</th>
                                <th>Created At</th>
                                <th>Updated At</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr class="fw-bold" style="font-size: 10px;">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $user->campus_code }}</td>
                                    <td>{{ $user->dept_desc }}</td>
                                    <td>{{ $user->user_firstName }}</td>
                                    <td>{{ $user->user_lastName }}</td>
                                    <td>{{ $user->user_email }}</td>
                                    <td>{{ $user->user_number }}</td>
                                    <td>{{ $user->user_address }}</td>
                                    <td>{{ $user->user_birthday }}</td>
                                    <td>{{ $user->user_sex }}</td>
                                    <td>{{ $user->user_username }}</td>
                                    <td>{{ $user->user_type }}</td>
                                    <td
                                        class="{{ $user->user_status === 'active' ? 'text-success' : 'text-danger' }}">
                                        {{ $user->user_status }}</td>
                                    <td>{{ date('M d, Y h:i A', strtotime($user->created_at)) }}</td>
                                    <td>{{ date('M d, Y h:i A', strtotime($user->updated_at)) }}</td>

                                    <td>
                                        <form
                                            action="{{ route('misUsersManagementResource.destroy', $user->user_id) }}"
                                            role="alert" method="post" alert-title="Delete Campus"
                                            alert-text="Do you really want to delete this record?"
                                            alert-btn-cancel="Cancel" alert-btn-yes="Yes">
                                            <div class="text-center">
                                                @csrf
                                                @method('DELETE')
                                                <a class="btn btn-warning" href="/edit/users/{{ $user->user_id }}">
                                                    <i class="fa-solid fa-pen-to-square"></i> </a>
                                                <button type="submit" class="btn btn-danger"><i
                                                        class="fa-solid fa-trash"></i> </button>
                                            </div>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @if ($userType !== 'mis')
                    <div class="col-md-2 rounded shadow-lg p-4">
                        <form action="" method="POST">
                            @csrf
                            <div class="form-group rounded">
                                <label class="text1 fw-bold mb-1" for="curriculum">Campus:</label>
                                <select class="form-control  mb-1" id="campus" name="campus">
                                    <option value="">--Select Campus--</option>
                                    @foreach ($campuses as $campus)
                                        <option value="{{ $campus->campus_code }}">
                                            {{ $campus->campus_code . ' -- ' . $campus->campus_location }}
                                        </option>
                                    @endforeach
                                </select>
                                <br>
                                <button type="submit" class="ex btn  w-100 fw-bold p-3 btn-primary">LOAD</button>
                            </div>
                        </form>
                        <br>
                        <button type="button" id="showAllUsersBtn"
                            class="btn customs p-3 fw-bold w-100 btn-transparent"
                            style="border: 2px solid #007BFF; color: #007BFF">Show All
                            Users </button>
                    </div>
                @endif
            </div>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="userModal" tabindex="-1" aria-labelledby="userModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold" id="userModalLabel">ADD NEW USER</h5>
                    <button type="button" class="btn-close btn-lg" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Your form content goes here -->
                    <form action="{{ route('misUsersManagementResource.store') }}" method="POST"
                        enctype="multipart/form-data" id="userForm">
                        @csrf

                        <div class="row forms">
                            @if ($userType !== 'mis')
                                <div class="col-md-12 col-sm-12 col-12 p-3">
                                    <label for="campusName" class="form-label">Campus <span style="color: #fc0905;">
                                            *</span></label>
                                    <select name="campus_code" id="campusName" class="form-control" required>
                                        <option value="">Select Campus</option>
                                        @foreach ($campuses as $campus)
                                            <option value="{{ $campus->campus_code }}"
                                                {{ old('campus_code') == $campus->campus_code ? 'selected' : '' }}>
                                                {{ $campus->campus_code . ' -- ' . $campus->campus_location }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('campus_code', 'userValidation')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            @else
                                <div class="col-md-12 col-sm-12 col-12 p-3">
                                    <label for="campusName" class="form-label">Campus <span style="color: #fc0905;">
                                            *</span></label>
                                    <select name="campus_code" id="campusName" class="form-control" required>
                                        <option value="{{ $campuses->first()->campus_code }}" selected>
                                            {{ $campuses->first()->campus_code . ' -- ' . $campuses->first()->campus_location }}
                                        </option>
                                    </select>
                                    @error('campus_code', 'userValidation')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            @endif
                            <!-- First Name Input -->
                            <div class="col-md-6 col-sm-12 col-12 p-3">
                                <label for="first_name" class="form-label">First Name <span style="color: #fc0905;">
                                        *</span></label>
                                <input type="text" name="first_name" id="first_name" class="form-control"
                                    placeholder="Input First name" value="{{ old('first_name') }}" required>
                                @error('first_name', 'userValidation')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Last Name Input -->
                            <div class="col-md-6 col-sm-12 col-12 p-3">
                                <label for="last_name" class="form-label">Last Name <span style="color: #fc0905;">
                                        *</span></label>
                                <input type="text" name="last_name" id="last_name" class="form-control"
                                    placeholder="Input Last name" value="{{ old('last_name') }}" required>
                                @error('last_name', 'userValidation')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Email Input -->
                            <div class="col-md-12 col-sm-12 col-12 p-3">
                                <label for="email" class="form-label">Email <span style="color: #fc0905;">
                                        *</span></label>
                                <input type="email" name="email" id="email" class="form-control"
                                    placeholder="Input Email" value="{{ old('email') }}" required>
                                @error('email', 'userValidation')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Phone Number Input -->
                            <div class="col-md-12 col-sm-12 col-12 p-3">
                                <label for="number" class="form-label">Phone Number<span
                                        style="color: red;">*</span></label>
                                <input type="number" name="number" id="number" class="form-control"
                                    placeholder="Input Phone Number" value="{{ old('number') }}" required>
                                @error('number', 'userValidation')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Address Input -->
                            <div class="col-md-12 col-sm-12 col-12 p-3">
                                <label for="address" class="form-label">Address <span style="color: #fc0905;">
                                        *</span></label>
                                <input type="text" name="address" id="address" class="form-control"
                                    placeholder="Input Address" value="{{ old('address') }}" required>
                                @error('address', 'userValidation')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Birthday Input -->
                            <div class="col-md-6 col-sm-12 col-12 p-3">
                                <label for="userBirthday" class="form-label">Birthday <span style="color: #fc0905;">
                                        *</span></label>
                                <input type="date" name="userBirthday" id="userBirthday" class="form-control"
                                    value="{{ old('userBirthday') }}" required>
                                @error('userBirthday', 'userValidation')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Sex Radio Buttons -->
                            <div class="col-md-6 col-sm-12 col-12 p-3">
                                <label class="form-label">Sex <span style="color: #fc0905;"> *</span></label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="sex" id="male"
                                        value="Male" {{ old('sex') === 'Male' ? 'checked' : '' }}required>
                                    <label class="form-check-label" for="male">Male</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="sex" id="female"
                                        value="Female" {{ old('sex') === 'Female' ? 'checked' : '' }}required>
                                    <label class="form-check-label" for="female">Female</label>
                                </div>
                                @error('sex', 'userValidation')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- UserType Dropdown -->
                            <div class="col-md-4 col-sm-12 col-12 p-3">
                                <label for="usertype" class="form-label">Type <span style="color: #fc0905;">
                                        *</span></label>
                                <select name="usertype" id="usertype" class="form-control" required>
                                    <option value="">Select User Type</option>
                                    <option value="mis" {{ old('usertype') == 'mis' ? 'selected' : '' }}>MIS
                                    </option>
                                    <option value="chair" {{ old('usertype') == 'chair' ? 'selected' : '' }}>
                                        Department Chair
                                    </option>
                                </select>
                                @error('usertype', 'userValidation')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Department Dropdown -->
                            <div class="col-md-4 col-sm-12 col-12 p-3">
                                <label for="dept_name" class="form-label">Department <span style="color: #fc0905;">
                                        *</span></label>
                                <select name="dept_code" id="dept_name" class="form-control" required>
                                    <option value="">Select Department</option>
                                    @foreach ($departments as $department)
                                        <option value="{{ $department->dept_code }}"
                                            {{ old('dept_code') == $department->dept_code ? 'selected' : '' }}>
                                            {{ $department->campus_code . ' -- ' . $department->dept_desc }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('dept_code', 'userValidation')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- User Status Dropdown -->
                            <div class="col-md-4 col-sm-12 col-12 p-3">
                                <label for="userstatus" class="form-label">Status <span style="color: #fc0905;">
                                        *</span></label>
                                <select name="status" id="userstatus" class="form-control" required>
                                    <option value="">Select User Status</option>
                                    <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active
                                    </option>
                                    <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>
                                        Inactive</option>
                                </select>
                                @error('status', 'userValidation')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Username Input -->
                            <div class="col-md-12 col-sm-12 col-12 p-3">
                                <label for="username" class="form-label">Username <span style="color: #fc0905;">
                                        *</span></label>
                                <input type="text" name="username" id="username" class="form-control"
                                    placeholder="Input Username" value="{{ old('username') }}" required>
                                @error('username', 'userValidation')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Password Input -->
                            <div class="col-md-12 col-sm-12 col-12 p-3">
                                <label for="password" class="form-label">Password <span style="color: #fc0905;">
                                        *</span></label>
                                <div class="input-group">
                                    <input type="password" required name="password" id="password"
                                        class="form-control" placeholder="Input Password">
                                    <button type="button" class="btn btn-outline-secondary" id="togglePassword">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                                            <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0" />
                                            <path
                                                d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8m8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7" />
                                        </svg>
                                    </button>
                                </div>
                                @error('password', 'userValidation')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Re-Type Password Input -->
                            <div class="col-md-12 col-sm-12 col-12 p-3">
                                <label for="password2" class="form-label">Re-Type Password <span
                                        style="color: #fc0905;"> *</span></label>
                                <input type="password" name="password2" id="password2" class="form-control"
                                    placeholder="Re-Type Password">
                                @error('password2', 'userValidation')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-lg fw-bold btn-secondary"
                                data-bs-dismiss="modal">Close</button>
                            <input type="submit" value="Add" name="create"
                                class="btn btn-lg fw-bold btn-primary">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!--Import Modal -->
    <div class="modal fade" id="import" tabindex="-1" aria-labelledby="userModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold"id="userModalLabel">IMPORT USER DATA</h5>
                    <button type="button" class="btn-close btn-lg" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Your form content goes here -->
                    <form action="{{ route('users.import') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row forms">
                            <div class="col-md-12 col-sm-12 col-12 p-3">
                                <label class="form-label fw-bold">Upload File<span
                                        style="color: red;">*</span></label>
                                <input type="file" name="file" class="form-control" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-lg fw-bold btn-secondary"
                                data-bs-dismiss="modal">Close</button>
                            <button class="btn btn-lg fw-bold btn-primary">Import</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>







    </div>

    @include('sweetalert::alert')

    <footer class="text-center text-lg-start">
        <div class="text-center fw-bold p-3">Pangasinan State University • San Vicente • Urdaneta City • Pangasinan •
            (075) 542 5133<br>
            © 2023 Copyright:
        </div>
    </footer>

    <script>
        $(document).ready(function() {
            // Add event listeners to both the campus and usertype dropdowns
            $('#campusName, #usertype').change(function() {
                var campusCode = $('#campusName').val(); // Get selected campus code
                var userType = $('#usertype').val(); // Get selected user type+

                console.log(campusCode);
                console.log(userType);

                // Make an AJAX request to fetch departments based on the selected campus and user type
                $.ajax({
                    url: '/get-departments_user/' + campusCode + '/' +
                        userType, // Replace with your actual route
                    type: 'GET',
                    success: function(data) {
                        // Clear and update the department dropdown
                        $('#dept_name').empty().append(
                            '<option value="">Select Department</option>');
                        $.each(data.departments, function(key, value) {
                            $('#dept_name').append('<option value="' + value.dept_code +
                                '">' + value.campus_code + ' -- ' + value
                                .dept_desc + '</option>');
                        });
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $("form").submit(function(e) {
                if ($(this).find('.ex').length > 0) {
                    var campus = $("#campus").val();
                    console.log("Selected Campus: " + campus);
                    e.preventDefault();

                    $.ajax({
                        type: "POST",
                        url: "{{ route('filterCampusUserRoute') }}",
                        data: {
                            _token: "{{ csrf_token() }}",
                            campus: campus,
                        },
                        success: function(data) {
                            console.log(data);
                            $("#users tbody").empty();
                            if (data.filteredUsers.length > 0) {
                                $.each(data.filteredUsers, function(index, user) {

                                    var createdDate = new Date(user.created_at);
                                    var updatedDate = new Date(user.updated_at);

                                    var newRow =
                                        '<tr class="fw-bold" style="font-size: 10px;">' +
                                        '<td>' + (index + 1) + '</td>' +
                                        '<td>' + user.campus_code + '</td>' +
                                        '<td>' + user.dept_desc + '</td>' +
                                        '<td>' + user.user_firstName + '</td>' +
                                        '<td>' + user.user_lastName + '</td>' +
                                        '<td>' + user.user_email + '</td>' +
                                        '<td>' + user.user_number + '</td>' +
                                        '<td>' + user.user_address + '</td>' +
                                        '<td>' + user.user_birthday + '</td>' +
                                        '<td>' + user.user_sex + '</td>' +
                                        '<td>' + user.user_username + '</td>' +
                                        '<td>' + user.user_type + '</td>' +
                                        '<td class="' + (user.user_status === 'active' ?
                                            'text-success' : 'text-danger') + '">' +
                                        user.user_status + '</td>' +
                                        '<td>' + createdDate.toLocaleString('en-US', {
                                            month: 'short',
                                            day: 'numeric',
                                            year: 'numeric',
                                            hour: 'numeric',
                                            minute: 'numeric',
                                            hour12: true
                                        }) + '</td>' +
                                        '<td>' + updatedDate.toLocaleString('en-US', {
                                            month: 'short',
                                            day: 'numeric',
                                            year: 'numeric',
                                            hour: 'numeric',
                                            minute: 'numeric',
                                            hour12: true
                                        }) + '</td>' +
                                        '<td>' +
                                        '<form action="/misUsersManagementResource.destroy/' +
                                        user.user_id +
                                        '" role="alert" method="post" alert-title="Delete Campus" alert-text="Do you really want to delete this record?" alert-btn-cancel="Cancel" alert-btn-yes="Yes">' +
                                        '<div class="text-center">' +
                                        '<input type="hidden" name="_token" value="' +
                                        $('meta[name="csrf-token"]').attr('content') +
                                        '">' +
                                        '<input type="hidden" name="_method" value="DELETE">' +
                                        '<a class="btn btn-warning" href="/edit/users/' +
                                        user.user_id +
                                        '"><i class="fa-solid fa-pen-to-square"></i></a>' +
                                        '<button type="submit" class="btn btn-danger"><i class="fa-solid fa-trash"></i></button>' +
                                        '</div>' +
                                        '</form>' +
                                        '</td>' +
                                        '</tr>';

                                    $("#users tbody").append(newRow);
                                });
                            } else {
                                var noDataMessage =
                                    '<tr><td colspan="13" class="text-center">No data found</td></tr>';
                                $("#users tbody").append(noDataMessage);
                            }

                        },
                    });
                }
            });

            $("#showAllUsersBtn").click(function() {
                $.ajax({
                    type: "POST",
                    url: "{{ route('allUsersRoute') }}",
                    data: {
                        _token: "{{ csrf_token() }}",
                    },
                    success: function(data) {
                        $("#users tbody").empty();


                        if (data.length > 0) {
                            $.each(data, function(index, user) {

                                var createdDate = new Date(user.created_at);
                                var updatedDate = new Date(user.updated_at);


                                var newRow =
                                    '<tr class="fw-bold" style="font-size: 10px;">' +
                                    '<td>' + (index + 1) + '</td>' +
                                    '<td>' + user.campus_code + '</td>' +
                                    '<td>' + user.dept_desc + '</td>' +
                                    '<td>' + user.user_firstName + '</td>' +
                                    '<td>' + user.user_lastName + '</td>' +
                                    '<td>' + user.user_email + '</td>' +
                                    '<td>' + user.user_number + '</td>' +
                                    '<td>' + user.user_address + '</td>' +
                                    '<td>' + user.user_birthday + '</td>' +
                                    '<td>' + user.user_sex + '</td>' +
                                    '<td>' + user.user_username + '</td>' +
                                    '<td>' + user.user_type + '</td>' +
                                    '<td class="' + (user.user_status === 'active' ?
                                        'text-success' : 'text-danger') + '">' +
                                    user
                                    .user_status + '</td>' +
                                    '<td>' + createdDate.toLocaleString('en-US', {
                                        month: 'short',
                                        day: 'numeric',
                                        year: 'numeric',
                                        hour: 'numeric',
                                        minute: 'numeric',
                                        hour12: true
                                    }) + '</td>' +
                                    '<td>' + updatedDate.toLocaleString('en-US', {
                                        month: 'short',
                                        day: 'numeric',
                                        year: 'numeric',
                                        hour: 'numeric',
                                        minute: 'numeric',
                                        hour12: true
                                    }) + '</td>' +
                                    '<td>' +
                                    '<form action="/misUsersManagementResource/' +
                                    user
                                    .user_id +
                                    '" role="alert" method="post" alert-title="Delete Campus" alert-text="Do you really want to delete this record?" alert-btn-cancel="Cancel" alert-btn-yes="Yes">' +
                                    '<div class="text-center">' +
                                    '<input type="hidden" name="_token" value="' +
                                    $(
                                        'meta[name="csrf-token"]').attr('content') +
                                    '">' +
                                    '<input type="hidden" name="_method" value="DELETE">' +
                                    '<a class="btn btn-warning" href="/edit/users/' +
                                    user.user_id +
                                    '"><i class="fa-solid fa-pen-to-square"></i></a>' +
                                    '<button type="submit" class="btn btn-danger"><i class="fa-solid fa-trash"></i></button>' +
                                    '</div>' +
                                    '</form>' +
                                    '</td>' +
                                    '</tr>';

                                $("#users tbody").append(newRow);
                            });
                        } else {
                            var noDataMessage =
                                '<tr><td colspan="13" class="text-center">No data found</td></tr>';
                            $("#users tbody").append(noDataMessage);
                        }
                    },
                });
            });
        });
    </script>
</body>

</html>

@include('sweetalert::alert')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
    $(document).ready(function() {
        $("form[role='alert']").submit(function(event) {
            event.preventDefault();
            Swal.fire({
                title: $(this).attr('alert-title'),
                text: $(this).attr('alert-text'),
                icon: 'warning',
                allowOutsideClick: false,
                showCancelButton: true,
                cancelButtonText: $(this).attr('alert-btn-cancel'),
                reverseButtons: false,
                confirmButtonText: $(this).attr('alert-btn-yes'),
            }).then((result) => {
                if (result.isConfirmed) {
                    event.target.submit();

                }
            });

        });

    });
</script>

<script>
    @if (session('success'))
        Swal.fire({
            title: 'Success',
            text: '{{ session('success') }}',
            icon: 'success',
            showConfirmButton: false,
            timer: 3000,
            toast: false,
            position: 'center',
            customClass: {
                title: 'swal-title',
                content: 'swal-text',
            },
        });
    @endif
</script>

<script>
    @if (session('warning'))
        Swal.fire({
            title: 'Warning',
            text: '{{ session('warning') }}',
            icon: 'warning',
            showConfirmButton: false,
            timer: 3000,
            toast: false,
            position: 'center',
            customClass: {
                title: 'swal-title',
                content: 'swal-text',
            },
        });
    @endif
</script>

<script>
    @if (session('warning'))
        Swal.fire({
            title: 'Warning',
            text: '{{ session('warning') }}',
            icon: 'warning',
            showConfirmButton: false,
            timer: 3000,
            toast: false,
            position: 'center',
            customClass: {
                title: 'swal-title',
                content: 'swal-text',
            },
        });
    @endif
</script>

<script>
    document.getElementById('togglePassword').addEventListener('click', function() {
        // Toggle visibility for password
        var passwordInput = document.getElementById('password');
        var passwordType = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', passwordType);

        // Toggle visibility for password2
        var passwordInput2 = document.getElementById('password2');
        var passwordType2 = passwordInput2.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput2.setAttribute('type', passwordType2);
    });
</script>
<?php

}
?>
