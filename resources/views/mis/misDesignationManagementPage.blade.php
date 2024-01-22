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
    <title>Designations Management</title>
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
            <img src="../assets/logo/PSUlabel1.png" alt="SSS Logo" class=" logo mt-2 img-fluid" style="width:100px;">
            <h3 class="title1">PSU</h2>
        </center>
        @php
            $userType = session('user_type');
        @endphp
        <a href="misMainPage" class="link  fw-bold"><i class="fa fa-tachometer"
                aria-hidden="true"></i>&nbsp;&nbsp;Dashboard</a>
        <a href="misUsersManagement" class="   fw-bold"><i class="fa-solid fa-users"></i>&nbsp;&nbsp;Users
            Management</a>

        @if ($userType !== 'mis')
            <a href="misCampusManagement" class="fw-bold"><i class="fa-solid fa-school"></i>&nbsp;&nbsp;Campus
                Management</a>
        @endif

        <a href="misDepartmentManagement" class=" fw-bold"><i class="fa-solid fa-sitemap"></i>&nbsp;&nbsp;Departments
            Management</a>
        <a href="misDesignationManagement" class="active fw-bold"><i
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
        <a href="misCurricularSubjectsManagement" class="  fw-bold"><i
                class="fa-solid fa-book-open"></i>&nbsp;&nbsp;Curricular Subjects Management</a>
        <a href="misRoomManagement" class=" fw-bold"><i class="fa-solid fa-house"></i>&nbsp;&nbsp;Rooms
            Management</a>
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
                <h1 class="title fw-bold p-3"> DESIGNATIONS MANAGEMENT</h3>
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
            <button type="button" class="btn btn-lg  p-3 fw-bold btn-primary" data-bs-toggle="modal"
                data-bs-target="#userModal"><i class="fa fa-plus" aria-hidden="true"></i> Add
                Designation</button>

            <a class="btn btn-danger btn-lg ms-3  p-3 fw-bold float-end"href="{{ route('designation.export') }}"><i
                    class="fa-solid fa-lg  fa-file-export"></i> &nbsp; Export Designations Data</a>
            <button type="button" class="btn p-3 float-end ms-3 btn-lg fw-bold btn-primary" data-bs-toggle="modal"
                data-bs-target="#import"><i class="fa-solid fa-lg fa-file-import"> </i> &nbsp; Import Designations
                Data</button>

            <div class="row mt-5">
                <div class="col">
                    <table id="users" class="table table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Designation Name</th>
                                <th>Designation Units</th>
                                <th>Created At</th>
                                <th>Updated At</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($designations as $designation)
                                <tr class="fw-bold" style="font-size: 10px;">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $designation->designation_name }}</td>
                                    <td>{{ $designation->designation_units }}</td>
                                    <td>{{ $designation->created_at }}</td>
                                    <td>{{ $designation->updated_at }}</td>
                                    <td>
                                        <form
                                            action="{{ route('misDesignationManagementResource.destroy', $designation->designation_id) }}"
                                            role="alert" method="post" alert-title="Delete Designation?"
                                            alert-text="Deleting this data will result in setting other dependent data to null.
                                            The data will be hidden from all pages, but it will still be retained in the database."
                                            alert-btn-cancel="Cancel" alert-btn-yes="Yes">
                                            <div class="text-center">
                                                @csrf
                                                @method('DELETE')
                                                <a class="btn btn-warning"
                                                    href="/edit/designation/{{ $designation->designation_id }}">
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


            </div>
        </div>

    </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="userModal" tabindex="-1" aria-labelledby="userModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold" id="userModalLabel">ADD NEW DESIGNATION</h5>
                    <button type="button" class="btn-close btn-lg"data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <form action="{{ route('misDesignationManagementResource.store') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="row forms">

                        <div class="col-md-12 col-sm-12 col-12 p-3">
                            <label for="designation_name" class="form-label">Desination Name <span
                                    style="color: #fc0905;">
                                    *</span></label>
                            <input type="text" name="designation_name" id="designation_name" class="form-control"
                                placeholder="Input Desination Name" value="{{ old('designation_name') }}" required>
                            @error('designation_name', 'designationValidation')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-12 col-sm-12 col-12 p-3">
                            <label for="designation_units" class="form-label">Desination Units <span
                                    style="color: #fc0905;">
                                    *</span></label>
                            <input type="number" step="0.01" class="form-control" id="designation_units"
                                name="designation_units" placeholder="0.00" value="{{ old('designation_units') }}"
                                required>
                            @error('designation_units', 'designationValidation')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-lg fw-bold btn-secondary"
                            data-bs-dismiss="modal">Close</button>
                        <input type="submit" value="Add" name="create" class="btn btn-lg fw-bold btn-primary">
                    </div>
                </form>
                <div class="modal-body">
                    <!-- Your form content goes here -->

                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="import" tabindex="-1" aria-labelledby="userModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold"id="userModalLabel">IMPORT CURRICULAR SUBJECT DATA</h5>
                    <button type="button" class="btn-close btn-lg" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Your form content goes here -->
                    <form action="{{ route('room.import') }}" method="POST" enctype="multipart/form-data">
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



    <footer class="text-center text-lg-start">
        <div class="text-center fw-bold p-3">Pangasinan State University • San Vicente • Urdaneta City • Pangasinan •
            (075) 542 5133<br>
            © 2023 Copyright:
        </div>
    </footer>

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
