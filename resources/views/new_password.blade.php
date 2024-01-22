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

    <title>Reset Password</title>
</head>

<style>

</style>

<body>
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
                        Secure Your Account</h1>
                    <p class=""
                        style="color: #082B54; font-size: 15px; margin-left:10px;">To enhance the security of your account, please proceed to reset your password.</p>
                    <div class="card rounded mb-4  w-100" style="margin: 0 auto;">
                        @error('username')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <div class="card-body p-5 shadow rounded">
                            <form action="{{ route('reset.password.post') }}" method="post">
                                @csrf
                                <input type="hidden" name="token" value="{{ $token }}">
                                <div class="form-outline">
                                    <label for="username" style="color: #082B54; font-size:20px;"
                                        class="form-label fw-bold">
                                        Email Address:</label>
                                    <input type="email"
                                        class="form-control mb-4  rounded form-control-lg" style="height:40px; border-bottom: 2px solid #082B54; border-top:0px;border-left:0px;border-right:0px;" id="password"
                                        placeholder="Enter Email" name="user_email" required />
                                    <label for="username" style="color: #082B54; font-size:20px;"
                                        class="form-label fw-bold">
                                        New Password:</label>
                                    <input type="password"
                                        class="form-control mb-4 rounded form-control-lg" style="height:40px; border-bottom: 2px solid #082B54; border-top:0px;border-left:0px;border-right:0px;" id="password"
                                        placeholder="Enter New Password" name="password" required />
                              
                                    @error('password')
                                        <span class="text-danger" style="font-size: 15px;">{{ $message }}</span>
                                    @enderror
                                    <label for="username" style="color: #082B54; font-size:20px;"
                                        class="form-label fw-bold">
                                        Confirm Password:</label>
                                    <input type="password" style="height:40px; border-bottom: 2px solid #082B54; border-top:0px;border-left:0px;border-right:0px;"
                                        class="form-control mb-4 rounded form-control-lg " id="email"
                                        placeholder="Enter Confirm Password" name="password2" required />
                                
                                    @error('password2')
                                        <span class="text-danger"style="font-size: 15px;">{{ $message }}</span>
                                    @enderror
                                </div>
                                <center>
                                    <br>
                                    <button type="submit" style=" background-color: #082B54; color: white; font-size: 18px;"
                                        class="btn btn-lg fw-bold mb-3 p-3 text-lg rounded shadow-lg w-100">RESET</button>
                                    
                                    <a href="/forgot-password" class="btn  w-100 mt-4  p-3 text-lg fw-bold"
                            style=" border: 3px solid #082B54; color: #082B54; font-size: 18px;">CANCEL</a>
                                </center>
                            </form>
                        </div>
                    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

</html>
