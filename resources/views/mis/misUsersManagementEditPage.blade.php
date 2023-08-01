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
                <h1>Edit User</h1>
            </div>
        </div>

        @foreach ($users as $user)
            <form action="{{ $user->user_id }}" method="POST" enctype="multipart/form-data">
                @csrf


                <div class="mb-3">
                    <label for="first_name" class="form-label">First Name</label>
                    <input type="text" name="first_name" id="first_name" class="form-control"
                        placeholder="Input First name" value="{{ $user->user_firstName }}">
                    @error('first_name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="last_name" class="form-label">Last Name</label>
                    <input type="text" name="last_name" id="last_name" class="form-control"
                        placeholder="Input Last name" value="{{ $user->user_lastName }}">
                    @error('last_name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="address" class="form-label">Address</label>
                    <input type="text" name="address" id="address" class="form-control" placeholder="Input Address"
                        value="{{ $user->user_address }}">
                    @error('address')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="userBirthday" class="form-label">Birthday</label>
                    <input type="date" name="userBirthday" id="userBirthday" class="form-control"
                        value="{{ $user->user_birthday }}">
                    @error('userBirthday')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">Sex</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="sex" id="male" value="Male"
                            {{ $user->user_sex === 'Male' ? 'checked' : '' }}>
                        <label class="form-check-label" for="male">Male</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="sex" id="female" value="Female"
                            {{ $user->user_sex === 'Female' ? 'checked' : '' }}>
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
                        <option value="mis" {{ $user->user_type === 'mis' ? 'selected' : '' }}>MIS</option>
                        <option value="chair" {{ $user->user_type === 'chair' ? 'selected' : '' }}>
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
                            <option value="{{ $department->dept_code }}"
                                {{ $user->dept_code === $department->dept_code ? 'selected' : '' }}>
                                {{ $department->dept_desc }}
                            </option>
                        @endforeach
                    </select>
                    @error('dept_code')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" name="username" id="username" class="form-control"
                        placeholder="Input Username" value="{{ $user->user_username }}">
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
                <div class="mb-3">
                    <input type="submit" class="btn btn-success btn-block" value="Update"><br><br>
                    <a href="/misUsersManagementResource" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        @endforeach
    </div>
</body>

</html>
<?php

}
?>
