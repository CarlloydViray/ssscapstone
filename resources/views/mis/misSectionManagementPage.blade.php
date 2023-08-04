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

    <title>MIS Section Management</title>
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
                    <h5 class="modal-title" id="userModalLabel">Add New Section</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Your form content goes here -->
                    <form action="{{ route('misSectionManagementResource.store') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="sectionDesc" class="form-label">Section Description</label>
                            <input type="text" name="section_desc" id="sectionDesc" class="form-control"
                                placeholder="Input Section Description" value="{{ old('section_desc') }}">
                            @error('section_desc')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="dept_name" class="form-label">Section Department</label>
                            <select name="dept_code" id="dept_name" class="form-control">
                                <option value="">Select Department</option>
                                @foreach ($departments as $department)
                                    @if ($department->dept_code !== 'ADMIN')
                                        <option value="{{ $department->dept_code }}"
                                            {{ old('dept_code') == $department->dept_code ? 'selected' : '' }}>
                                            {{ $department->dept_desc }}
                                        </option>
                                    @endif
                                @endforeach
                            </select>
                            @error('dept_code')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="sectionAcademicYear" class="form-label">Section Academic Year</label>
                            <select name="section_academicYear" id="sectionAcademicYear" class="form-control">
                                @php
                                    $currentYear = now()->year;
                                    $selectedYear = old('section_academicYear') !== null ? (int) old('section_academicYear') : $currentYear;
                                    $futureYears = max(1, $selectedYear - $currentYear + 1); // Calculate the number of future years based on the selected or current year
                                @endphp
                                @for ($year = $currentYear; $year <= $currentYear + $futureYears; $year++)
                                    @php
                                        $nextYear = $year + 1;
                                        $academicYear = "$year-$nextYear";
                                    @endphp
                                    <option value="{{ $academicYear }}"
                                        @if ($selectedYear == $year) selected @endif>
                                        {{ $academicYear }}</option>
                                @endfor
                            </select>

                            <small class="form-text text-muted">Please select the academic year from the list.</small>
                            @error('section_academicYear')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="sectionYearLevel" class="form-label">Section Year Level</label>
                            <select name="section_yearLevel" id="sectionYearLevel" class="form-control">
                                <option value="1"{{ old('section_yearLevel') == '1' ? ' selected' : '' }}>1st Year
                                </option>
                                <option value="2"{{ old('section_yearLevel') == '2' ? ' selected' : '' }}>2nd Year
                                </option>
                                <option value="3"{{ old('section_yearLevel') == '3' ? ' selected' : '' }}>3rd Year
                                </option>
                                <option value="4"{{ old('section_yearLevel') == '4' ? ' selected' : '' }}>4th Year
                                </option>
                                <option value="5"{{ old('section_yearLevel') == '5' ? ' selected' : '' }}>5th Year
                                </option>
                                <option value="6"{{ old('section_yearLevel') == '6' ? ' selected' : '' }}>6th Year
                                </option>
                            </select>
                            <small class="form-text text-muted">Please select the year level from the list.</small>
                            @error('section_yearLevel')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Section Semester</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="section_semester"
                                    id="semester1" value="1st semester"
                                    {{ old('section_semester') === '1st semester' ? 'checked' : '' }}>
                                <label class="form-check-label" for="semester1">
                                    1st semester
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="section_semester"
                                    id="semester2" value="2nd semester"
                                    {{ old('section_semester') === '2nd semester' ? 'checked' : '' }}>
                                <label class="form-check-label" for="semester2">
                                    2nd semester
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="section_semester"
                                    id="summer" value="summer"
                                    {{ old('section_semester') === 'summer' ? 'checked' : '' }}>
                                <label class="form-check-label" for="summer">
                                    Summer
                                </label>
                            </div>
                            @error('section_semester')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <input type="submit" value="Create Section" name="create" class="btn btn-primary">
                </div>
                </form>
            </div>
        </div>
    </div>
    <br>
    <div class="container-fluid">
        <div class="row">
            <div class="col text-center mt-5">
                <h1>Department Management</h1>
                <a href="/misMainPage" class="btn btn-secondary">Go back to Home Page</a>
                <!-- Add User button -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#userModal">
                    Add Section
                </button>
            </div>
        </div>
        <br>
        <div class="row mt-5">
            <div class="col">
                <table id="users" class="table table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>Section ID</th>
                            <th>Department Description</th>
                            <th>Section Description</th>
                            <th>Section Academic Year</th>
                            <th>Section Year Level</th>
                            <th>Section Semester</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    @foreach ($sections as $section)
                        <tr>
                            <td>{{ $section->section_id }}</td>
                            <td>{{ $section->dept_desc }}</td>
                            <td>{{ $section->section_desc }}</td>
                            <td>{{ $section->section_academicYear }}</td>
                            <td>{{ $section->section_yearLevel }}</td>
                            <td>{{ $section->section_semester }}</td>
                            <td>{{ $section->created_at }}</td>
                            <td>{{ $section->updated_at }}</td>
                            <td>
                                <form
                                    action="{{ route('misSectionManagementResource.destroy', $section->section_id) }}"
                                    method="post">
                                    <a class="btn btn-warning"
                                        href="/edit/section/{{ $section->section_id }}">Edit</a>
                                    <a class="btn btn-danger" href="/delete/section/{{ $section->section_id }}"
                                        onclick="return confirm('Are you sure you want to delete this record?')">Delete</a>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Section ID</th>
                            <th>Department Description</th>
                            <th>Section Description</th>
                            <th>Section Academic Year</th>
                            <th>Section Year Level</th>
                            <th>Section Semester</th>
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
