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

    <title>MIS Users Management</title>
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
                    <h5 class="modal-title" id="userModalLabel">Add New User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Your form content goes here -->
                    <form action="{{ route('misUsersManagementResource.store') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="first_name" class="form-label">First Name</label>
                            <input type="text" name="first_name" id="first_name" class="form-control"
                                placeholder="Input First name" value="{{ old('first_name') }}">
                            @error('first_name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="last_name" class="form-label">Last Name</label>
                            <input type="text" name="last_name" id="last_name" class="form-control"
                                placeholder="Input Last name" value="{{ old('last_name') }}">
                            @error('last_name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">Address</label>
                            <input type="text" name="address" id="address" class="form-control"
                                placeholder="Input Address" value="{{ old('address') }}">
                            @error('address')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="userBirthday" class="form-label">Birthday</label>
                            <input type="date" name="userBirthday" id="userBirthday" class="form-control"
                                value="{{ old('userBirthday') }}">
                            @error('userBirthday')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Sex</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="sex" id="male"
                                    value="Male" {{ old('sex') === 'Male' ? 'checked' : '' }}>
                                <label class="form-check-label" for="male">Male</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="sex" id="female"
                                    value="Female" {{ old('sex') === 'Female' ? 'checked' : '' }}>
                                <label class="form-check-label" for="female">Female</label>
                            </div>
                            @error('sex')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="usertype" class="form-label">Type</label>
                            <select name="usertype" id="usertype" class="form-control">
                                <option value="">Select User Type</option>
                                <option value="mis" {{ old('usertype') == 'mis' ? 'selected' : '' }}>MIS
                                </option>
                                <option value="chair" {{ old('usertype') == 'chair' ? 'selected' : '' }}>
                                    Department Chair
                                </option>
                            </select>
                            @error('usertype')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="dept_name" class="form-label">Department</label>
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
                            <label for="username" class="form-label">Username</label>
                            <input type="text" name="username" id="username" class="form-control"
                                placeholder="Input Username" value="{{ old('username') }}">
                            @error('username')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" name="password" id="password" class="form-control"
                                placeholder="Input Password">
                            @error('password')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="password2" class="form-label">Re-Type Password</label>
                            <input type="password" name="password2" id="password2" class="form-control"
                                placeholder="Re-Type Password">
                            @error('password2')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <input type="submit" value="Create Account" name="create" class="btn btn-primary">
                </div>
                </form>
            </div>
        </div>
    </div>
    <br>
    <div class="container-fluid">
        <div class="row">
            <div class="col text-center mt-5">
                <h1>Users Management</h1>
                <a href="/misMainPage" class="btn btn-secondary">Go back to Home Page</a>
                <!-- Add User button -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#userModal">
                    Add User
                </button>
            </div>
        </div>
        <br>
        <div class="row mt-5">
            <div class="col">
                <table id="users" class="table table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Department</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Address</th>
                            <th>Birthday</th>
                            <th>Sex</th>
                            <th>Username</th>
                            <th>Type</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->user_id }}</td>
                            <td>{{ $user->dept_desc }}</td>
                            <td>{{ $user->user_firstName }}</td>
                            <td>{{ $user->user_lastName }}</td>
                            <td>{{ $user->user_address }}</td>
                            <td>{{ $user->user_birthday }}</td>
                            <td>{{ $user->user_sex }}</td>
                            <td>{{ $user->user_username }}</td>
                            <td>{{ $user->user_type }}</td>
                            <td>{{ $user->created_at }}</td>
                            <td>{{ $user->updated_at }}</td>
                            <td>
                                <form action="{{ route('misUsersManagementResource.destroy', $user->user_id) }}"
                                    method="post">
                                    <a class="btn btn-warning" href="/edit/users/{{ $user->user_id }}">Edit</a>
                                    <a class="btn btn-danger" href="/delete/users/{{ $user->user_id }}"
                                        onclick="return confirm('Are you sure you want to delete this record?')">Delete</a>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Department</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Address</th>
                            <th>Birthday</th>
                            <th>Sex</th>
                            <th>Username</th>
                            <th>Type</th>
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
