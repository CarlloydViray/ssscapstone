<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>


    <title>Signup</title>
</head>

<body>
    <div class="container mt-5 text-center">
        <h1>Sign Up</h1>

    </div>
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-6">
                <form action="signup" method="post">
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
                            <input class="form-check-input" type="radio" name="sex" id="male" value="Male"
                                {{ old('sex') === 'Male' ? 'checked' : '' }}>
                            <label class="form-check-label" for="male">Male</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="sex" id="female" value="Female"
                                {{ old('sex') === 'Female' ? 'checked' : '' }}>
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
                            <option value="chair" {{ old('usertype') == 'chair' ? 'selected' : '' }}>Department Chair
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
                                    {{ old('dept_code') == $department->dept_code ? 'selected' : '' }}>
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
                    <div class="mb-3">
                        <input type="submit" value="Create Account" name="create" class="btn btn-primary">
                    </div>
                </form>

                <a href="/login">Go back to the login page</a>
            </div>
        </div>
    </div>

</body>


</html>
