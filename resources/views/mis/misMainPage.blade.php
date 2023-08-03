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
    <title>MIS PAGE</title>
</head>

<body>

    <body>
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                <center>
                    {{ session('success') }}

                </center>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <br><br>
        <center>
            <h1>MIS CONTROL PANEL
            </h1>
        </center>
        <ul>
            <li>
                <form action="misUsersManagement" method="post">
                    @csrf
                    <button type="submit">Users Management</button>
                </form>
            </li><br>

            <li>
                <form action="misDepartmentManagement" method="post">
                    @csrf
                    <button type="submit">Departments Management</button>
                </form>
            </li><br>

            <li>
                <form action="misCurriculumManagement" method="post">
                    @csrf
                    <button type="submit">Curriculums Management</button>
                </form>
            </li><br>

            <li>
                <form action="misSubjectManagement" method="post">
                    @csrf
                    <button type="submit">Subjects Management</button>
                </form>
            </li><br>

            <li>
                <form action="misRoomManagement" method="post">
                    @csrf
                    <button type="submit">Rooms Management</button>
                </form>
            </li><br>

            <li>
                <form action="misSectionManagement" method="post">
                    @csrf
                    <button type="submit">Sections/Blocks Management</button>
                </form>
            </li><br>

            <li>
                <form action="misCRUDHistory" method="post">
                    @csrf
                    <button type="submit">CRUD History</button>
                </form>

            </li><br>
            <li>
                <a href="/logout"><button>Logout</button></a>
            </li><br>
        </ul>


    </body>
</body>

</html>
<?php

 }?>
