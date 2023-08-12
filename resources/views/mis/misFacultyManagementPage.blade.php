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

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    {{-- datatable bootsrap --}}
    {{-- css --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
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

    <title>MIS Faculty Management</title>
</head>

<body>
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
    <!-- Modal -->
    <div class="modal fade" id="userModal" tabindex="-1" aria-labelledby="userModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="userModalLabel">Add New Faculty</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Your form content goes here -->
                    <form action="{{ route('misFacultyManagementResource.store') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="first_name" class="form-label">First Name</label>
                            <input type="text" name="faculty_firstName" id="first_name" class="form-control"
                                placeholder="Input First name" value="{{ old('faculty_firstName') }}">
                            @error('faculty_firstName')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="first_name" class="form-label">Last Name</label>
                            <input type="text" name="faculty_lastName" id="first_name" class="form-control"
                                placeholder="Input First name" value="{{ old('faculty_lastName') }}">
                            @error('faculty_lastName')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="curriculum" class="form-label">Department</label>
                            <select name="dept_code" id="curriculum" class="form-control">
                                <option value="">Select Department</option>
                                @foreach ($departments as $department)
                                    <option value="{{ $department->dept_code }}"
                                        @if (old('dept_code') == $department->dept_code) selected @endif>
                                        {{ $department->dept_desc }}
                                    </option>
                                @endforeach
                            </select>
                            @error('curriculum_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="curriculum" class="form-label">Position</label>
                            <select name="faculty_position" id="curriculum" class="form-control">
                                <option value="">Select Position</option>
                                <option value="Professor"
                                    {{ old('faculty_position') == 'Professor' ? 'selected' : '' }}>Professor</option>
                                <option value="Associate Professor"
                                    {{ old('faculty_position') == 'Associate Professor' ? 'selected' : '' }}>Associate
                                    Professor</option>
                                <option value="Assistant Professor"
                                    {{ old('faculty_position') == 'Assistant Professor' ? 'selected' : '' }}>Assistant
                                    Professor</option>
                                <option value="Instructor"
                                    {{ old('faculty_position') == 'Instructor' ? 'selected' : '' }}>Instructor</option>
                                <!-- Add more options as needed -->
                            </select>
                            @error('faculty_position')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="userBirthday" class="form-label">Birthday</label>
                            <input type="date" name="faculty_birthDate" id="userBirthday" class="form-control"
                                value="{{ old('faculty_birthDate') }}">
                            @error('faculty_birthDate')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Sex</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="faculty_sex" id="male"
                                    value="Male" {{ old('faculty_sex') === 'Male' ? 'checked' : '' }}>
                                <label class="form-check-label" for="male">Male</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="faculty_sex" id="female"
                                    value="Female" {{ old('faculty_sex') === 'Female' ? 'checked' : '' }}>
                                <label class="form-check-label" for="female">Female</label>
                            </div>
                            @error('faculty_sex')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">Address</label>
                            <input type="text" name="faculty_address" id="address" class="form-control"
                                placeholder="Input Address" value="{{ old('faculty_address') }}">
                            @error('faculty_address')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <input type="submit" value="Create Subject" name="create" class="btn btn-primary">
                </div>
            </div>

            </form>
        </div>
    </div>
    </div>
    <br>
    <div class="container-fluid">
        <div class="row">
            <div class="col text-center mt-5">
                <h1>Faculty Management</h1>
                <a href="/misMainPage" class="btn btn-secondary">Go back to Home Page</a>
                <!-- Add User button -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#userModal">
                    Add Faculty
                </button>
            </div>
        </div>
        <br>
        <div class="row mt-5">
            <div class="col">
                <table id="users" class="table table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>Faculty ID</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Department</th>
                            <th>Position</th>
                            <th>Birth Date</th>
                            <th>Sex</th>
                            <th>Address</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    @foreach ($faculties as $faculty)
                        <tr>
                            <td>{{ $faculty->faculty_id }}</td>
                            <td>{{ $faculty->faculty_firstName }}</td>
                            <td>{{ $faculty->faculty_lastName }}</td>
                            <td>{{ $faculty->dept_desc }}</td>
                            <td>{{ $faculty->faculty_position }}</td>
                            <td>{{ $faculty->faculty_birthDate }}</td>
                            <td>{{ $faculty->faculty_sex }}</td>
                            <td>{{ $faculty->faculty_address }}</td>
                            <td>{{ $faculty->created_at }}</td>
                            <td>{{ $faculty->updated_at }}</td>
                            <td>
                                <form
                                    action="{{ route('misCSubjectsManagementResource.destroy', $faculty->faculty_id) }}"
                                    method="post">
                                    <a class="btn btn-warning"
                                        href="/edit/faculty/{{ $faculty->faculty_id }}">Edit</a>
                                    <a class="btn btn-danger" href="/delete/faculty/{{ $faculty->faculty_id }}"
                                        onclick="return confirm('Are you sure you want to delete this record?')">Delete</a>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Faculty ID</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Department</th>
                            <th>Position</th>
                            <th>Birth Date</th>
                            <th>Sex</th>
                            <th>Address</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                            <th>Actions</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
    <br><br>
</body>

</html>
<?php

}
?>
