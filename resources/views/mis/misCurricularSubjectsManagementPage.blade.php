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

    <title>MIS Curricular Subjects Management</title>
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
                    <h5 class="modal-title" id="userModalLabel">Add New Curricular Subjects</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Your form content goes here -->
                    <form action="{{ route('misCSubjectsManagementResource.store') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="curriculum" class="form-label">Curriculum Description</label>
                            <select name="curriculum_id" id="curriculum" class="form-control">
                                <option value="">Select Curriculum</option>
                                @foreach ($curriculums as $curriculum)
                                    <option value="{{ $curriculum->curriculum_id }}"
                                        @if (old('curriculum_id') == $curriculum->curriculum_id) selected @endif>
                                        {{ $curriculum->curriculum_desc }}
                                    </option>
                                @endforeach
                            </select>
                            @error('curriculum_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="subject" class="form-label">Subject Description</label>
                            <select name="subject_code" id="subject" class="form-control">
                                <option value="">Select Subject</option>
                                @foreach ($subjects as $subject)
                                    <option value="{{ $subject->subject_code }}"
                                        @if (old('subject_code') == $subject->subject_code) selected @endif>
                                        {{ $subject->subject_desc }}
                                    </option>
                                @endforeach
                            </select>
                            @error('subject_code')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Semester</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="cs_semesterOffered" id="semester1"
                                    value="1st semester"
                                    {{ old('cs_semesterOffered') === '1st semester' ? 'checked' : '' }}>
                                <label class="form-check-label" for="semester1">
                                    1st semester
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="cs_semesterOffered" id="semester2"
                                    value="2nd semester"
                                    {{ old('cs_semesterOffered') === '2nd semester' ? 'checked' : '' }}>
                                <label class="form-check-label" for="semester2">
                                    2nd semester
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="cs_semesterOffered" id="summer"
                                    value="summer" {{ old('cs_semesterOffered') === 'summer' ? 'checked' : '' }}>
                                <label class="form-check-label" for="summer">
                                    Summer
                                </label>
                            </div>
                            @error('cs_semesterOffered')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="csYearLevel" class="form-label">Year Level</label>
                            <select name="cs_yearLevel" id="csYearLevel" class="form-control">
                                <option value="">Select Year Level</option>
                                <option value="1"{{ old('cs_yearLevel') == '1' ? ' selected' : '' }}>1st
                                    Year
                                </option>
                                <option value="2"{{ old('cs_yearLevel') == '2' ? ' selected' : '' }}>2nd
                                    Year
                                </option>
                                <option value="3"{{ old('cs_yearLevel') == '3' ? ' selected' : '' }}>3rd
                                    Year
                                </option>
                                <option value="4"{{ old('cs_yearLevel') == '4' ? ' selected' : '' }}>4th
                                    Year
                                </option>
                                <option value="5"{{ old('cs_yearLevel') == '5' ? ' selected' : '' }}>5th
                                    Year
                                </option>
                                <option value="6"{{ old('cs_yearLevel') == '6' ? ' selected' : '' }}>6th
                                    Year
                                </option>
                            </select>
                            @error('cs_yearLevel')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <input type="submit" value="Create Subject" name="create" class="btn btn-primary">
                </div>
                </form>
            </div>
        </div>
    </div>
    <br>
    <div class="container-fluid">
        <div class="row">
            <div class="col text-center mt-5">
                <h1>Curricular Subjects Management</h1>
                <a href="/misMainPage" class="btn btn-secondary">Go back to Home Page</a>
                <!-- Add User button -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#userModal">
                    Add Curricular Subjects
                </button>
            </div>
        </div>
        <br>
        <div class="row mt-5">
            <div class="col">
                <table id="users" class="table table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>Curricular Subject ID</th>
                            <th>Curriculum</th>
                            <th>Subject</th>
                            <th>Semester Offered</th>
                            <th>Year Level</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    @foreach ($c_subjects as $c_subject)
                        <tr>
                            <td>{{ $c_subject->cs_id }}</td>
                            <td>{{ $c_subject->curriculum_desc }}</td>
                            <td>{{ $c_subject->subject_desc }}</td>
                            <td>{{ $c_subject->cs_semesterOffered }}</td>
                            <td>{{ $c_subject->cs_yearLevel }}</td>
                            <td>{{ $c_subject->created_at }}</td>
                            <td>{{ $c_subject->updated_at }}</td>
                            <td>
                                <form
                                    action="{{ route('misCSubjectsManagementResource.destroy', $c_subject->cs_id) }}"
                                    method="post">
                                    <a class="btn btn-warning" href="/edit/cs/{{ $c_subject->cs_id }}">Edit</a>
                                    <a class="btn btn-danger" href="/delete/cs/{{ $c_subject->cs_id }}"
                                        onclick="return confirm('Are you sure you want to delete this record?')">Delete</a>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Curricular Subject ID</th>
                            <th>Curriculum</th>
                            <th>Subject</th>
                            <th>Semester Offered</th>
                            <th>Year Level</th>
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
