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

    <title>MIS Users Management Edit</title>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col text-center mt-5">
                <h1>Edit Faculty</h1>
            </div>
        </div>

        @foreach ($faculties as $faculty)
            <form action="{{ $faculty->faculty_id }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="first_name" class="form-label">First Name</label>
                    <input type="text" name="faculty_firstName" id="first_name" class="form-control"
                        placeholder="Input First name" value="{{ $faculty->faculty_firstName }}">
                    @error('faculty_firstName')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="first_name" class="form-label">Last Name</label>
                    <input type="text" name="faculty_lastName" id="first_name" class="form-control"
                        placeholder="Input First name" value="{{ $faculty->faculty_lastName }}">
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
                                @if ($faculty->dept_code == $department->dept_code) selected @endif>
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
                        <option value="Professor" {{ $faculty->faculty_position == 'Professor' ? 'selected' : '' }}>
                            Professor</option>
                        <option value="Associate Professor"
                            {{ $faculty->faculty_position == 'Associate Professor' ? 'selected' : '' }}>Associate
                            Professor</option>
                        <option value="Assistant Professor"
                            {{ $faculty->faculty_position == 'Assistant Professor' ? 'selected' : '' }}>Assistant
                            Professor</option>
                        <option value="Instructor" {{ $faculty->faculty_position == 'Instructor' ? 'selected' : '' }}>
                            Instructor</option>
                        <!-- Add more options as needed -->
                    </select>
                    @error('faculty_position')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="userBirthday" class="form-label">Birthday</label>
                    <input type="date" name="faculty_birthDate" id="userBirthday" class="form-control"
                        value="{{ $faculty->faculty_birthDate }}">
                    @error('faculty_birthDate')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">Sex</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="faculty_sex" id="male" value="Male"
                            {{ $faculty->faculty_sex === 'Male' ? 'checked' : '' }}>
                        <label class="form-check-label" for="male">Male</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="faculty_sex" id="female" value="Female"
                            {{ $faculty->faculty_sex === 'Female' ? 'checked' : '' }}>
                        <label class="form-check-label" for="female">Female</label>
                    </div>
                    @error('faculty_sex')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="address" class="form-label">Address</label>
                    <input type="text" name="faculty_address" id="address" class="form-control"
                        placeholder="Input Address" value="{{ $faculty->faculty_address }}">
                    @error('faculty_address')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <input type="submit" class="btn btn-success btn-block" value="Update"><br><br>
                    <a href="/misFacultyManagementResource" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        @endforeach
    </div>
</body>

</html>
<?php

}
?>
