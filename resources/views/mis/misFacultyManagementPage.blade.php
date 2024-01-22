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
    <title>Faculty Management</title>
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

<style>
    .scrollable-form {
        overflow-y: auto;
        max-height: 95vh;
        padding: 15px;
        position: relative;
        transition: margin-left 0.5s;
    }
</style>
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
            <h3 class="title1">PSU</h2>
        </center>
        @php
            $userType = session('user_type');
        @endphp

        <a href="misMainPage" class="link fw-bold"><i class="fa fa-tachometer"
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
        <a href="misFacultyManagement" class="active fw-bold"><i class="fa-solid fa-users"></i>&nbsp;&nbsp;Faculty
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

    <div id="main" class="content scrollable-form">
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
                <h1 class="title fw-bold p-3">FACULTY MANAGEMENT</h3>
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

        <div class="container-fluid shadow rounded mt-5 p-5 ">
            <button type="button" class="btn fw-bold p-3 btn-lg btn-primary" data-bs-toggle="modal"
                data-bs-target="#userModal"><i class="fa fa-plus" aria-hidden="true"></i> Add
                Faculty</button>
            <a class="btn btn-danger btn-lg ms-3  p-3 fw-bold float-end" href="{{ route('faculty.export') }}"><i
                    class="fa-solid fa-lg  fa-file-export"></i> &nbsp; Export Faculty Data</a>
            <button type="button" class="btn p-3 float-end ms-3 btn-lg fw-bold btn-primary" data-bs-toggle="modal"
                data-bs-target="#import"><i class="fa-solid fa-lg fa-file-import"> </i> &nbsp; Import Faculty
                Data</button>
            <div class="row mt-5">
                <div class="col">
                    <table id="users" class="table table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Campus</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Department</th>
                                <th>Position</th>
                                <th>Birth Date</th>
                                <th>Sex</th>
                                <th>Address</th>
                                <th>Status</th>
                                <th>Created At</th>
                                <th>Updated At</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($faculties as $faculty)
                                <tr class="fw-bold" style="font-size: 10px;">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $faculty->campus_code }}</td>
                                    <td>{{ $faculty->faculty_firstName }}</td>
                                    <td>{{ $faculty->faculty_lastName }}</td>
                                    <td>{{ $faculty->dept_code }}</td>
                                    <td>{{ $faculty->designation_name }}</td>
                                    <td>{{ $faculty->faculty_birthDate }}</td>
                                    <td>{{ $faculty->faculty_sex }}</td>
                                    <td>{{ $faculty->faculty_address }}</td>
                                    <td
                                        class="{{ $faculty->faculty_status === 'active' ? 'text-success' : 'text-danger' }}">
                                        {{ $faculty->faculty_status }}</td>
                                    <td>{{ date('M d, Y h:i A', strtotime($faculty->created_at)) }}</td>
                                    <td>{{ date('M d, Y h:i A', strtotime($faculty->updated_at)) }}</td>
                                    <td>
                                        <form
                                            action="{{ route('misFacultyManagementResource.destroy', $faculty->faculty_id) }}"
                                            role="alert" method="post" alert-title="Delete Faculty?"
                                            alert-text="Deleting this data will result in setting other dependent data to null.
                                            The data will be hidden from all pages, but it will still be retained in the database."
                                            alert-btn-cancel="Cancel" alert-btn-yes="Yes">
                                            <div class="text-center">
                                                @csrf
                                                @method('DELETE')
                                                <a class="btn btn-warning"
                                                    href="/edit/faculty/{{ $faculty->faculty_id }}">
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
                        <button type="button" id="showAllFacultiesBtn"
                            class="btn customs p-3 fw-bold w-100 btn-transparent"
                            style="border: 2px solid #007BFF; color: #007BFF">Show All
                            Faculties </button>
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
                    <h5 class="modal-title fw-bold" id="userModalLabel">ADD NEW FACULTY</h5>
                    <button type="button" class="btn-close btn-lg" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('misFacultyManagementResource.store') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row forms">
                            @if ($userType !== 'mis')
                                <div class="col-md-12 col-sm-12 col-12 p-3">
                                    <label for="campusName" class="form-label">Campus<span
                                            style="color: red;">*</span></label>
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
                                    <label for="campusName" class="form-label">Campus <span style="color: #fc2421;">
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
                                <input type="text" name="faculty_firstName" id="first_name" class="form-control"
                                    placeholder="Input First name" value="{{ old('faculty_firstName') }}" required>
                                @error('faculty_firstName', 'facultyValidation')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Last Name Input -->
                            <div class="col-md-6 col-sm-12 col-12 p-3">
                                <label for="last_name" class="form-label">Last Name <span style="color: #fc0905;">
                                        *</span></label>
                                <input type="text" name="faculty_lastName" id="last_name" class="form-control"
                                    placeholder="Input Last name" value="{{ old('faculty_lastName') }}" required>
                                @error('faculty_lastName', 'facultyValidation')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Department Dropdown -->
                            <div class="col-md-6 col-sm-12 col-12 p-3">
                                <label for="curriculum" class="form-label">Department <span style="color: #fc0905;">
                                        *</span></label>
                                <select name="dept_code" id="curriculum" class="form-control" required>
                                    <option value="">Select Department</option>
                                    @foreach ($departments as $department)
                                        <option value="{{ $department->dept_code }}"
                                            {{ old('dept_code') == $department->dept_code ? 'selected' : '' }}>
                                            {{ $department->campus_code . ' -- ' . $department->dept_desc }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('dept_code', 'facultyValidation')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Designation Dropdown -->
                            <div class="col-md-6 col-sm-12 col-12 p-3">
                                <label for="curriculum" class="form-label">Designation <span style="color: #fc0905;">
                                        *</span></label>
                                <select name="designation_id" id="curriculum" class="form-control" required>
                                    <option value="">Select Designation</option>
                                    @foreach ($designations as $designation)
                                        <option value="{{ $designation->designation_id }}"
                                            {{ old('designation_id') == $designation->designation_id ? 'selected' : '' }}>
                                            {{ $designation->designation_name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('designation_id', 'facultyValidation')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Birthday Input -->
                            <div class="col-md-6 col-sm-12 col-12 p-3">
                                <label for="userBirthday" class="form-label">Birthday <span style="color: #fc0905;">
                                        *</span></label>
                                <input type="date" name="faculty_birthDate" id="userBirthday"
                                    class="form-control" value="{{ old('faculty_birthDate') }}" required>
                                @error('faculty_birthDate', 'facultyValidation')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Status Dropdown -->
                            <div class="col-md-3 col-sm-12 col-12 p-3">
                                <label for="userstatus" class="form-label">Status <span style="color: #fc0905;">
                                        *</span></label>
                                <select name="status" id="userstatus" class="form-control" required>
                                    <option value="">Select User Status</option>
                                    <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active
                                    </option>
                                    <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>
                                        Inactive</option>
                                </select>
                                @error('status', 'facultyValidation')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Sex Radio Buttons -->
                            <div class="col-md-3 col-sm-12 col-12 p-3">
                                <label class="form-label">Sex <span style="color: #fc0905;"> *</span></label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="faculty_sex" id="male"
                                        value="Male" {{ old('faculty_sex') === 'Male' ? 'checked' : '' }} required>
                                    <label class="form-check-label" for="male">Male</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="faculty_sex" id="female"
                                        value="Female" {{ old('faculty_sex') === 'Female' ? 'checked' : '' }}
                                        required>
                                    <label class="form-check-label" for="female">Female</label>
                                </div>
                                @error('faculty_sex', 'facultyValidation')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Address Input -->
                            <div class="col-md-12 col-sm-12 col-12 p-3">
                                <label for="address" class="form-label">Address <span style="color: #fc0905;">
                                        *</span></label>
                                <textarea name="faculty_address" id="address" class="form-control" placeholder="Input Address" required>{{ old('faculty_address') }}</textarea>
                                @error('faculty_address', 'facultyValidation')
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
                    <h5 class="modal-title fw-bold"id="userModalLabel">IMPORT FACULTY DATA</h5>
                    <button type="button" class="btn-close btn-lg" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Your form content goes here -->
                    <form action="{{ route('faculty.import') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row forms">
                            <div class="col-md-12 col-sm-12 col-12 p-3">
                                <label class="form-label fw-bold">Upload File</label>
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
    </div>
    <footer class="text-center text-lg-start">
        <div class="text-center fw-bold p-3">Pangasinan State University • San Vicente • Urdaneta City • Pangasinan
            •
            (075) 542 5133<br>
            © 2023 Copyright:
        </div>
    </footer>
</body>
<script>
    $(document).ready(function() {

        $('#campusName').change(function() {
            var campusCode = $('#campusName').val();

            console.log(campusCode);


            $.ajax({
                url: '/get-departments_faculty/' + campusCode,
                type: 'GET',
                success: function(data) {
                    console.log(data.departments);
                    $('#curriculum').empty().append(
                        '<option value="">Select Department</option>');
                    $.each(data.departments, function(key, value) {
                        $('#curriculum').append('<option value="' + value
                            .dept_code +
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
                    url: "{{ route('filterCampusFacultyRoute') }}",
                    data: {
                        _token: "{{ csrf_token() }}",
                        campus: campus,

                    },
                    success: function(data) {
                        $("#users tbody").empty();
                        console.log(data.filteredFaculties);

                        if (data.filteredFaculties.length > 0) {
                            $.each(data.filteredFaculties, function(index, faculty) {
                                var createdDate = new Date(faculty.created_at);
                                var updatedDate = new Date(faculty.updated_at);

                                var statusClass = faculty.faculty_status ===
                                    'active' ? 'text-success' : 'text-danger';

                                var newRow =
                                    '<tr class="fw-bold" style="font-size: 10px;">' +
                                    '<td>' + (index + 1) + '</td>' +
                                    '<td>' + faculty.campus_code + '</td>' +
                                    '<td>' + faculty.faculty_firstName + '</td>' +
                                    '<td>' + faculty.faculty_lastName + '</td>' +
                                    '<td>' + faculty.dept_code + '</td>' +
                                    '<td>' + faculty.faculty_position + '</td>' +
                                    '<td>' + faculty.faculty_birthDate + '</td>' +
                                    '<td>' + faculty.faculty_sex + '</td>' +
                                    '<td>' + faculty.faculty_address + '</td>' +
                                    '<td class="' + statusClass + '">' + faculty
                                    .faculty_status + '</td>' +
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
                                    '<form action="/misFacultyManagementResource/' +
                                    faculty.faculty_id + '" ' +
                                    'role="alert" method="post" alert-title="Delete Faculty?" ' +
                                    'alert-text="Deleting this data will result in setting other dependent data to null.The data will be hidden from all pages,but it will still be retained in the database. " ' +
                                    'alert-btn-cancel="Cancel" alert-btn-yes="Yes">' +
                                    '<div class="text-center">' +
                                    '<input type="hidden" name="_token" value="' +
                                    $('meta[name="csrf-token"]').attr('content') +
                                    '">' +
                                    '<input type="hidden" name="_method" value="DELETE">' +
                                    '<a class="btn btn-warning" href="/edit/faculty/' +
                                    faculty.faculty_id + '">' +
                                    '<i class="fa-solid fa-pen-to-square"></i> </a>' +
                                    '<button type="submit" class="btn btn-danger"><i class="fa-solid fa-trash"></i> </button>' +
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

        $("#showAllFacultiesBtn").click(function() {
            $.ajax({
                type: "POST",
                url: "{{ route('allFacultyRoute') }}",
                data: {
                    _token: "{{ csrf_token() }}",
                },
                success: function(data) {
                    $("#users tbody").empty();
                    console.log(data);

                    if (data.length > 0) {
                        $.each(data, function(index, faculty) {
                            var createdDate = new Date(faculty.created_at);
                            var updatedDate = new Date(faculty.updated_at);

                            var statusClass = faculty.faculty_status ===
                                'active' ? 'text-success' : 'text-danger';

                            var newRow =
                                '<tr class="fw-bold" style="font-size: 10px;">' +
                                '<td>' + (index + 1) + '</td>' +
                                '<td>' + faculty.campus_code + '</td>' +
                                '<td>' + faculty.faculty_firstName + '</td>' +
                                '<td>' + faculty.faculty_lastName + '</td>' +
                                '<td>' + faculty.dept_code + '</td>' +
                                '<td>' + faculty.faculty_position + '</td>' +
                                '<td>' + faculty.faculty_birthDate + '</td>' +
                                '<td>' + faculty.faculty_sex + '</td>' +
                                '<td>' + faculty.faculty_address + '</td>' +
                                '<td class="' + statusClass + '">' + faculty
                                .faculty_status + '</td>' +
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
                                '<form action="/misFacultyManagementResource/' +
                                faculty.faculty_id + '" ' +
                                'role="alert" method="post" alert-title="Delete Faculty?" ' +
                                'alert-text="Deleting this data will result in setting other dependent data to null. The data will be hidden from all pages, but it will still be retained in the database." ' +
                                'alert-btn-cancel="Cancel" alert-btn-yes="Yes">' +
                                '<div class="text-center">' +
                                '<input type="hidden" name="_token" value="' +
                                $('meta[name="csrf-token"]').attr('content') +
                                '">' +
                                '<input type="hidden" name="_method" value="DELETE">' +
                                '<a class="btn btn-warning" href="/edit/faculty/' +
                                faculty.faculty_id + '">' +
                                '<i class="fa-solid fa-pen-to-square"></i> </a>' +
                                '<button type="submit" class="btn btn-danger"><i class="fa-solid fa-trash"></i> </button>' +
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

</html>
<?php

}
?>
