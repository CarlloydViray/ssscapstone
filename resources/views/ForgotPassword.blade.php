<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"> -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <link rel="icon" href="../assets/logo/favicon-16x16.png" type="image/x-icon">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />

    <title>Forgot Password</title>
</head>

<style>

</style>

<body>
    @if (session('error'))
        <div class="alert alert-danger rounded alert-dismissible fade show">
            <center>
                {{ session('error') }}

            </center>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="container  ">
        <div class="row  d-flex align-items-center justify-content-center vh-100">
            <div class="col-md-7 ">
                <div class="container">
                    <center>
                <img src="/assets/logo/PSUlabel1.png" alt="SSS Logo"class=" logo  mb-3 p-1 "
                            style="width:250px;">
                    </center>
                    <h1 class="p-2 fw-bold"
                        style="color: #082B54; font-family: Times New Roman; font-size: 40px;margin: 0 auto;">
                        Account Recovery</h1>
                    <p class=""
                        style="color: #082B54; font-family: Times New Roman; font-size: 20px; margin-left:10px;">We will
                        send a link to your email address , use that link to reset your password.</p>
                    <div class="card rounded mb-4  w-100" style="margin: 0 auto;">
                        @error('username')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <div class="card-body p-5 shadow rounded">
                            @error('password')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror

                            <form action="/forgot-password-post" method="post">
                                @csrf
                                <div class="form-outline">
                                    <label for="username" style="color: #082B54; font-size:20px;"
                                        class="form-label fw-bold">
                                        Email Address:</label>
                                    <input type="text" style="height:40px; border-bottom: 2px solid #082B54; border-top:0px;border-left:0px;border-right:0px;"
                                        class="form-control  rounded form-control-lg" id="email"
                                        placeholder="Enter Email Address" name="user_email" required />
                                    @error('user_email')
                                        <span class="text-danger"style="font-size: 15px;" >{{ $message }}</span>
                                    @enderror
                                </div>
                                <center>
                                    <br>
                                    <button type="submit" style="background-color: #082b54;color: white; font-size: 15px height:50px;"
                                        class="btn btn-lg fw-bold p-3 rounded shadow-lg w-75">SUBMIT</button>
                                </center>
                            </form>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5">
                            <hr class="mt-5">
                        </div>
                        <div class="col-md-2 text-center d-flex justify-content-center">
                            <p class=" text-center mt-4 p-3">OR</p>
                        </div>
                        <div class="col-md-5">
                            <hr class="mt-5">
                        </div>
                    </div>
                    <center>
                        <a href="/" class="btn text-light w-100  mt-4  p-3 text-lg fw-bold"
                            style=" background-color: #082B54; color: #F3D370; font-size: 15px;">GO TO LOGIN</a>
                    </center>
                </div>
            </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

</html>
