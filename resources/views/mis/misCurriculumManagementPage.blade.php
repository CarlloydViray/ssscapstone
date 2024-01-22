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
    <title>Curricula Management</title>
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
            <img src="../assets/logo/PSUlabel1.png" alt="SSS Logo" class=" logo mt-2  mb-1 img-fluid"
                style="width:100px;">
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
        <a href="misFacultyManagement" class=" fw-bold"><i class="fa-solid fa-users"></i>&nbsp;&nbsp;Faculty
            Management</a>
        <a href="misSchoolyearManagement" class=" fw-bold"><i class="fa-solid fa-calendar-days"></i>&nbsp;&nbsp;School
            Year Management</a>
        <a href="misCurriculumManagement" class="active fw-bold"><i
                class="fa-solid fa-table-list"></i>&nbsp;&nbsp;Curricula
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
                <h1 class="title fw-bold p-3"> CURRICULA MANAGEMENT</h3>
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
            <button type="button" class="btn p-3 fw-bold btn-lg btn-primary" data-bs-toggle="modal"
                data-bs-target="#userModal"><i class="fa fa-plus" aria-hidden="true"></i> Add
                Curriculum</button>


            <a class="btn btn-danger btn-lg ms-3  p-3 fw-bold float-end" href="{{ route('curriculum.export') }}"><i
                    class="fa-solid fa-lg  fa-file-export"></i> &nbsp; Export Curricula Data</a>
            <button type="button" class="btn p-3 float-end ms-3 btn-lg fw-bold btn-primary" data-bs-toggle="modal"
                data-bs-target="#import"><i class="fa-solid fa-lg fa-file-import"> </i> &nbsp; Import Curricula
                Data</button>



            <div class="row mt-5">
                <div class="col">
                    <table id="users" class="table table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Curricula ID</th>
                                <th>Campus</th>
                                <th>Curricula Description</th>
                                <th>Department Description</th>
                                <th>Created At</th>
                                <th>Updated At</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($curriculums as $curriculum)
                                <tr class="fw-bold" style="font-size: 10px;">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $curriculum->curriculum_idYear }}</td>
                                    <td>{{ $curriculum->campus_code }}</td>
                                    <td>{{ $curriculum->curriculum_desc }}</td>
                                    <td>{{ $curriculum->dept_desc }}</td>
                                    <td>{{ date('M d, Y h:i A', strtotime($curriculum->created_at)) }}</td>
                                    <td>{{ date('M d, Y h:i A', strtotime($curriculum->updated_at)) }}</td>
                                    <td>
                                        <form
                                            action="{{ route('misCurriculumManagementResource.destroy', $curriculum->curriculum_id) }}"
                                            role="alert" method="post" alert-title="Delete Curriculum?"
                                            alert-text="Deleting this data will result in setting other dependent data to null.
                                            The data will be hidden from all pages, but it will still be retained in the database."
                                            alert-btn-cancel="Cancel" alert-btn-yes="Yes">
                                            <div class="text-center">
                                                @csrf
                                                @method('DELETE')
                                                <a class="btn btn-warning"
                                                    href="/edit/curriculum/{{ $curriculum->curriculum_id }}">
                                                    <i class="fa-solid fa-pen-to-square"></i></a>
                                                <button type="submit" class="btn btn-danger"><i
                                                        class="fa-solid fa-trash"></i></button>
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
                                <select class="form-control  mb14" id="campus" name="campus">
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
                        <button type="button" id="showAllCurriculumBtn"
                            class="btn customs p-3 fw-bold w-100 btn-transparent"
                            style="border: 2px solid #007BFF; color: #007BFF">Show All
                            Curriculum </button>
                    </div>
                @endif
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="userModal" tabindex="-1" aria-labelledby="userModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title fw-bold" id="userModalLabel">ADD NEW CURRICULUM</h5>
                        <button type="button" class="btn-close btn-lg" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Your form content goes here -->
                        <form action="{{ route('misCurriculumManagementResource.store') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row forms">
                                @if ($userType !== 'mis')
                                    <div class="col-md-12 col-sm-12 col-12 p-3">
                                        <label for="campusName" class="form-label">Campus <span
                                                style="color: #fc0905;"> *</span></label>
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
                                        <label for="campusName" class="form-label">Campus <span
                                                style="color: #fc0905;"> *</span></label>
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


                                <div class="col-md-6 col-sm-12 col-12 p-3">
                                    <label for="curriculumID" class="form-label">Curriculum ID (Year) <span
                                            style="color: #fc0905;"> *</span></label>
                                    <input type="number" min=0 name="curriculum_idYear" id="curriculumID"
                                        class="form-control" placeholder="Input Year"
                                        value="{{ old('curriculum_idYear') }}" required>
                                    @error('curriculum_idYear', 'curriculumValidation')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-6 col-sm-12 col-12 p-3">
                                    <label for="department" class="form-label">Department <span
                                            style="color: #fc0905;"> *</span></label>
                                    <select name="department" id="department" class="form-control" required>
                                        <option value="">Select Department</option>
                                        @foreach ($departments as $departmentItem)
                                            <option value="{{ $departmentItem->dept_code }}"
                                                @if (old('department') == $departmentItem->dept_code) selected @endif>
                                                {{ $departmentItem->campus_code . ' -- ' . $departmentItem->dept_desc }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('department', 'curriculumValidation')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>


                                <div class="col-md-12 col-sm-12 col-12 p-3">
                                    <label for="curriculumDesc" class="form-label">Curriculum Description <span
                                            style="color: #fc0905;"> *</span></label>
                                    <textarea name="curriculum_desc" id="curriculumDesc" class="form-control" placeholder="Input Curriculum Description"
                                        required>{{ old('curriculum_desc') }}</textarea>
                                    @error('curriculum_desc', 'curriculumValidation')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-lg fw-bold btn-secondary"
                                    data-bs-dismiss="modal">Close</button>
                                <input type="submit" value="Add" name="create"
                                    class="btn  btn-lg fw-bold btn-primary">
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
                        <h5 class="modal-title fw-bold"id="userModalLabel">IMPORT CURRICULUM DATA</h5>
                        <button type="button" class="btn-close btn-lg" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Your form content goes here -->
                        <form action="{{ route('curriculum.import') }}" method="POST"
                            enctype="multipart/form-data">
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
        <div class="text-center fw-bold p-3">Pangasinan State University • San Vicente • Urdaneta City • Pangasinan •
            (075) 542 5133<br>
            © 2023 Copyright:
        </div>
    </footer>

    <script>
        $(document).ready(function() {

            $('#campusName').change(function() {
                var campusCode = $('#campusName').val();

                console.log(campusCode);


                $.ajax({
                    url: '/get-departments_curriculum/' + campusCode,
                    type: 'GET',
                    success: function(data) {
                        console.log(data.departments);
                        $('#department').empty().append(
                            '<option value="">Select Department</option>');
                        $.each(data.departments, function(key, value) {
                            $('#department').append('<option value="' + value
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
                        url: "{{ route('filterCampusCurriculumRoute') }}",
                        data: {
                            _token: "{{ csrf_token() }}",
                            campus: campus,

                        },
                        success: function(data) {
                            $("#users tbody").empty();
                            console.log(data.filteredCurriculums);

                            if (data.filteredCurriculums.length > 0) {
                                $.each(data.filteredCurriculums, function(index, curriculum) {
                                    var createdDate = new Date(curriculum.created_at);
                                    var updatedDate = new Date(curriculum.updated_at);

                                    var newRow =
                                        '<tr class="fw-bold" style="font-size: 10px;">' +
                                        '<td>' + (index + 1) + '</td>' +
                                        '<td>' + curriculum.curriculum_idYear +
                                        '</td>' +
                                        '<td>' + curriculum.campus_code + '</td>' +
                                        '<td>' + curriculum.curriculum_desc + '</td>' +
                                        '<td>' + curriculum.dept_desc + '</td>' +
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
                                        '<form action="/misCurriculumManagementResource/' +
                                        curriculum.curriculum_id + '" ' +
                                        'role="alert" method="post" alert-title="Delete Curriculum?" ' +
                                        'alert-text="Deleting this data will result in setting other dependent data to null.The data will be hidden from all pages, but it will still be retained in the database." ' +
                                        'alert-btn-cancel="Cancel" alert-btn-yes="Yes">' +
                                        '<div class="text-center">' +
                                        '<input type="hidden" name="_token" value="' +
                                        $('meta[name="csrf-token"]').attr('content') +
                                        '">' +
                                        '<input type="hidden" name="_method" value="DELETE">' +
                                        '<a class="btn btn-warning" href="/edit/curriculum/' +
                                        curriculum.curriculum_id + '">' +
                                        '<i class="fa-solid fa-pen-to-square"></i></a>' +
                                        '<button type="submit" class="btn btn-danger"><i class="fa-solid fa-trash"></i></button>' +
                                        '</div>' +
                                        '</form>' +
                                        '</td>' +
                                        '</tr>';


                                    $("#users tbody").append(newRow);
                                });
                            } else {
                                var noDataMessage =
                                    '<tr><td colspan="8" class="text-center">No data found</td></tr>';
                                $("#users tbody").append(noDataMessage);
                            }
                        },

                    });
                }
            });

            $("#showAllCurriculumBtn").click(function() {
                $.ajax({
                    type: "POST",
                    url: "{{ route('allCurriculumRoute') }}",
                    data: {
                        _token: "{{ csrf_token() }}",
                    },
                    success: function(data) {
                        $("#users tbody").empty();
                        console.log(data);

                        if (data.length > 0) {
                            $.each(data, function(index, curriculum) {
                                var createdDate = new Date(curriculum.created_at);
                                var updatedDate = new Date(curriculum.updated_at);

                                var newRow =
                                    '<tr class="fw-bold" style="font-size: 10px;">' +
                                    '<td>' + (index + 1) + '</td>' +
                                    '<td>' + curriculum.curriculum_idYear +
                                    '</td>' +
                                    '<td>' + curriculum.campus_code + '</td>' +
                                    '<td>' + curriculum.curriculum_desc + '</td>' +
                                    '<td>' + curriculum.dept_desc + '</td>' +
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
                                    '<form action="/misCurriculumManagementResource/' +
                                    curriculum.curriculum_id + '" ' +
                                    'role="alert" method="post" alert-title="Delete Curriculum?" ' +
                                    'alert-text="Deleting this data will result in setting other dependent data to null.The data will be hidden from all pages, but it will still be retained in the database." ' +
                                    'alert-btn-cancel="Cancel" alert-btn-yes="Yes">' +
                                    '<div class="text-center">' +
                                    '<input type="hidden" name="_token" value="' +
                                    $('meta[name="csrf-token"]').attr('content') +
                                    '">' +
                                    '<input type="hidden" name="_method" value="DELETE">' +
                                    '<a class="btn btn-warning" href="/edit/curriculum/' +
                                    curriculum.curriculum_id + '">' +
                                    '<i class="fa-solid fa-pen-to-square"></i></a>' +
                                    '<button type="submit" class="btn btn-danger"><i class="fa-solid fa-trash"></i></button>' +
                                    '</div>' +
                                    '</form>' +
                                    '</td>' +
                                    '</tr>';


                                $("#users tbody").append(newRow);
                            });
                        } else {
                            var noDataMessage =
                                '<tr><td colspan="8" class="text-center">No data found</td></tr>';
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
