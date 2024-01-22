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
    <link rel="icon" href="/assets/logo/favicon-16x16.png" type="image/x-icon">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    {{-- datatable bootsrap --}}
    {{-- css --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/mis_edit.css') }}">

    {{-- script --}}
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#users').DataTable();
        });
    </script>

    <title> Curricular Subject Management Edit</title>
</head>
<script>
     function toggleDarkMode() {
        let darkmode = document.querySelector('.dark');
        darkmode.classList.toggle("active");

        const body = document.body;
        body.classList.toggle('active');
        const darkModeButton = document.querySelector('.darkmode');
         if (darkmode.classList.contains("active")) {
             localStorage.setItem("darkMode", "dark");
             darkModeButton.style.backgroundColor = "white";
             darkModeButton.style.color = "#2D3436";
             darkModeButton.title = "Light Mode";
         } else {
             localStorage.removeItem("darkMode");
             darkModeButton.style.backgroundColor = " #2D3436";
             darkModeButton.style.color = "white";
             darkModeButton.title = "Dark Mode";
         }
     }

     document.addEventListener("DOMContentLoaded", function () {
  const darkmode = document.querySelector('.dark');
  const darkModeButton = document.querySelector('.darkmode');
  
  if (localStorage.getItem("darkMode") === "dark") {
    const body = document.body;
    body.classList.toggle('active');
    darkmode.classList.add("active");
    darkModeButton.style.backgroundColor = "white";
    darkModeButton.style.color = "black";
    darkModeButton.title = "Toggle Light Mode";
  }
});
const savedDarkMode = localStorage.getItem("darkMode");

if (savedDarkMode === "dark") {
  let darkmode = document.querySelector('.dark');
  darkmode.classList.add("active");
}
</script>

<body>
<button class="darkmode shadow-lg  btn-primary p-4" title=" Dark Mode" onclick="toggleDarkMode()">
<i class="fa-solid fa-moon"></i></button>
<div class="container contains">
<div class="dark"></div>
</div>
<div class="scrollable-form">
    <div class="navbar shadow-lg fixed-top">
        <a href="/misCSubjectsManagementResource" class="fw-bold link p-5"><i class="fa-solid fa-arrow-left"></i>
            Back</a>

            <div class="navbar-info" style=" width: 330px;">
            <div class="row">
            <div class="col-md-6 mt-3 user-name">
                        <span>
                        <center>
                             <h5 class=" title">
                                    {{ session('user_firstName') . '' . session('user_lastName') }}</h5>
                            <h6 class=" title">
                                    {{ session('campus_code') }}</h6>
                            </center>
                        </span>
                        </div>
                <div class="col">
                    <img src="/assets/logo/PSUlabel1.png" alt="SSS Logo" class="logo" style="width:70px;">
                </div>
            </div>
        </div>
</div>

    </head>

    <body>
        <div class="container  shadow-lg w-50  mb-5 rounded" style="width:500px; margin-top:170px;">

            <div class="container-fluid edit-user-container">
                <div class="container-fluid">
                    <h1 class="edit-user-title">EDIT CURRICULAR SUBJECT</h1>
                </div>
            </div>
            <div class="container" style="margin-left:150px;">

                @foreach ($c_subjects as $c_subject)
                    <form action="{{ $c_subject->cs_id }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-8 col-sm-12 col-12 p-3">
                                <label for="curriculum" class="form-label">Curriculum Description</label>
                                <select name="curriculum_id" id="curriculum" class="form-control">
                                    <option value="">Select Curriculum</option>
                                    @foreach ($curriculums as $curriculum)
                                        <option value="{{ $curriculum->curriculum_id }}"
                                            @if ($curriculum->curriculum_id == $curriculum->curriculum_id) selected @endif>
                                            {{ $curriculum->curriculum_desc }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('curriculum_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-md-6 col-sm-12 col-12 p-3">
                                <label for="subject" class="form-label">Subject Description</label>
                                <select name="subject_code" id="subject" class="form-control">
                                    <option value="">Select Subject</option>
                                    @foreach ($subjects as $subject)
                                        <option value="{{ $subject->subject_code }}"
                                            @if ($subject->subject_code == $subject->subject_code) selected @endif>
                                            {{ $subject->subject_desc }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('subject_code')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-4 col-sm-12 col-12 p-3">
                                <label class="form-label">Semester</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="cs_semesterOffered"
                                        id="semester1" value="1st semester"
                                        {{ $c_subject->cs_semesterOffered === '1st semester' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="semester1">
                                        1st semester
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="cs_semesterOffered"
                                        id="semester2" value="2nd semester"
                                        {{ $c_subject->cs_semesterOffered === '2nd semester' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="semester2">
                                        2nd semester
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="cs_semesterOffered"
                                        id="summer" value="summer"
                                        {{ $c_subject->cs_semesterOffered === 'summer' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="summer">
                                        Summer
                                    </label>
                                </div>
                                @error('cs_semesterOffered')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>



                        <div class="row">
                            <div class="col-md-8 col-sm-12 col-12 p-3">
                                <label for="csYearLevel" class="form-label">Year Level</label>
                                <select name="cs_yearLevel" id="csYearLevel" class="form-control">
                                    <option value="">Select Year Level</option>
                                    <option value="1"{{ $c_subject->cs_yearLevel == '1' ? ' selected' : '' }}>1st
                                        Year
                                    </option>
                                    <option value="2"{{ $c_subject->cs_yearLevel == '2' ? ' selected' : '' }}>2nd
                                        Year
                                    </option>
                                    <option value="3"{{ $c_subject->cs_yearLevel == '3' ? ' selected' : '' }}>3rd
                                        Year
                                    </option>
                                    <option value="4"{{ $c_subject->cs_yearLevel == '4' ? ' selected' : '' }}>4th
                                        Year
                                    </option>
                                    <option value="5"{{ $c_subject->cs_yearLevel == '5' ? ' selected' : '' }}>5th
                                        Year
                                    </option>
                                    <option value="6"{{ $c_subject->cs_yearLevel == '6' ? ' selected' : '' }}>6th
                                        Year
                                    </option>
                                </select>
                                @error('cs_yearLevel')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
            </div>


            <center>
                <div class="col-md-6 col-sm-12 col-12">
                    <input type="submit" class="btn w-100  mb-4 p-3 fw-bold mt-3 btn-primary btn-block"
                        value="UPDATE">
                </div>
            </center>
            </form>
            @endforeach
            </div></div>
            <footer
          class="text-center text-lg-start">
    <div class="text-center fw-bold p-3">Pangasinan State University • San Vicente • Urdaneta City • Pangasinan • (075) 542 5133<br>
      © 2023 Copyright:
    </div>
  </footer>
    </body>

</html>
<?php

}
?>
