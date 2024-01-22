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

    <title>Login</title>
</head>

<style>
    body {
        overflow: hidden;
    }

    .form-control:focus {
        border-color: #F3D370;
        box-shadow: 0 0 5px rgba(243, 211, 112, 0.5);
        background-color: rgba(243, 211, 112, 0.5);
    }


    .logo {
        width: 300px;

    }

    .demo-bg {
        margin-left: 0px;
        margin-bottom: 100px;
        opacity: 0.3;
        position: absolute;
        left: 0;
        top: 0;
        width: 650px;
        height: 700px;
    }

    .bg-brown {
        width: 500px;
        height: 300px;
        border-top-left-radius: 20px;
        border-top-right-radius: 20px;
        border-bottom-left-radius: 20px;
        border-bottom-right-radius: 20px;
    }

    .scrollable-form {
        overflow-y: auto;
        max-height: 95vh;
        padding: 15px;
        position: relative;
        transition: margin-left 0.5s;
    }
</style>

<body class="scrollable-form">
    @if (session('success'))
        <div class="alert rounded alert-success alert-dismissible fade show">
            <center>
                {{ session('success') }}

            </center>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger rounded alert-dismissible fade show">
            <center>
                {{ session('error') }}

            </center>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="card-body">
        @error('password')
            <span class="text-danger rounded">{{ $message }}</span>
        @enderror
        <div class="container ">
            <div class="row  d-flex align-items-center justify-content-center vh-100">
                <div class="col-md-12 ">

                    <div class="text-center">
                        <img src="/assets/logo/PSUlabel1.png" alt="SSS Logo"class=" logo   img-fluid"
                            style="width:250px;">
                        <br><br>
                        <h1 class="p-2 fw-bold" style="color: #082B54; font-family: Times New Roman; font-size: 40px;">
                            Class Scheduling System</h1>
                    </div>
                    <div class="card shadow bg-brown  shadow" style="margin: 0 auto;">
                        @error('username')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <div class="card-body">
                            @error('password')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            <form action="/" method="post">
                                @csrf
                                <div class="form-outline mt-4 mb-4">
                                    <label for="username" style="color: #082B54;" class="form-label fw-bold">USERNAME
                                        :</label>
                                    <input type="text" class="form-control  rounded form-control-lg border-0"
                                        id="username" placeholder="Enter Username" name="username" required />
                                    <hr>
                                    @error('username')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-outline">
                                    <label for="password" style="color: #082B54;" class="form-label fw-bold">PASSWORD
                                        :</label>
                                    <input type="password" class="form-control form-control-lg border-0" id="password"
                                        placeholder="Enter Password" name="password" required />
                                    <hr>
                                    @error('password')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <center>
                                    <br>
                                    <button type="submit" style="background-color: #082b54;color: #F3D370; height:50px"
                                        class="btn btn-lg fw-bold mb-2 rounded shadow-lg w-100">LOGIN</button>
                                        </center>
                                        
                            </form>
                        </div>
                        <br><br>
                        <center>
                        <a href="/forgot-password" class="mt-4 mt-5 fw-bold" style="font-size: 15px; text-decoration: none; color: #082b54;">Forgot Password?</a>
                                </center>
                    </div>
                </div>
            </div>
        </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

</html>
