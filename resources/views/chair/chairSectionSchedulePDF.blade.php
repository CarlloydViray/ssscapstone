<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">



    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>




    <title>DOWNLOAD PDF</title>
</head>


<style>
   .border {
        border: 3px solid black;
        width: 60px; /* Adjust the width as needed */
        height: 35px;
        font-size: 10px;
        text-align: center;

    }

    .text {
        font-weight: bold;

    }
    .border2 {
        border: 3px solid black;
        padding: 2px;
    }
</style>

<body>
    <div class="container mb-5">
        <table style="width:100% ">
            <thead>
                <tr class="border2">
                    <th colspan=1 class="border2">
                        <center><img src="{{ public_path() . '/assets/logo/PSUlabel1.png' }}" alt="SSS Logo"
                                class="logo img-fluid" style="width:70px;"></center>
                    </th>

                    <th colspan=6 class="text-center">
                        <h4>SECTION SCHEDULE</h3>
                            <p>PANGASINAN STATE UNIVERSITY</p>
                    </th>
                </tr>
                <tr class="border2">
                    <th colspan=7 class="text-center p-3">
                        {{ $sections->section_semester }} , {{ $schoolyearSy }}, {{ $campus }}
                        Campus<br>Section Block:
                        <u> {{ $sections->section_desc }}</u>
                    </th>

                </tr>
                <tr class="border2">
                    <th class="border">TIME</th>
                    <th class="border">MONDAY</th>
                    <th class="border">TUESDAY</th>
                    <th class="border">WEDNESDAY</th>
                    <th class="border">THURSDAY</th>
                    <th class="border">FRIDAY</th>
                    <th class="border">SATURDAY</th>
                </tr>
            </thead>

            <tbody class="border2">

                <tr class="border">
                    <td class="border text">08:00<br>08:30</td>
                    <td class="border text">
                        @foreach ($section_schedules as $schedule)
                            @if ($schedule->day == 'Monday' && $schedule->start_time < '08:30' && $schedule->end_time > '08:00')
                                {{ $schedule->subject_desc }}<br>
                                {{ $schedule->room_desc }}<br>
                                {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
                            @endif
                        @endforeach

                    </td>



                    <td class="border text">
                        @foreach ($section_schedules as $schedule)
                            @if ($schedule->day == 'Tuesday' && $schedule->start_time < '08:30' && $schedule->end_time > '08:00')
                                {{ $schedule->subject_desc }}<br>
                                {{ $schedule->room_desc }}<br>
                                {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
                            @endif
                        @endforeach
                    </td>


                    <td class="border text">
                        @foreach ($section_schedules as $schedule)
                            @if ($schedule->day == 'Wednesday' && $schedule->start_time < '08:30' && $schedule->end_time > '08:00')
                                {{ $schedule->subject_desc }}<br>
                                {{ $schedule->room_desc }}<br>
                                {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
                            @endif
                        @endforeach
                    </td>


                    <td class="border text">
                        @foreach ($section_schedules as $schedule)
                            @if ($schedule->day == 'Thursday' && $schedule->start_time < '08:30' && $schedule->end_time > '08:00')
                                {{ $schedule->subject_desc }}<br>
                                {{ $schedule->room_desc }}<br>
                                {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
                            @endif
                        @endforeach
                    </td>

                    <td class="border text">
                        @foreach ($section_schedules as $schedule)
                            @if ($schedule->day == 'Friday' && $schedule->start_time < '08:30' && $schedule->end_time > '08:00')
                                {{ $schedule->subject_desc }}<br>
                                {{ $schedule->room_desc }}<br>
                                {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
                            @endif
                        @endforeach
                    </td>


                    <td class="border text">
                        @foreach ($section_schedules as $schedule)
                            @if ($schedule->day == 'Saturday' && $schedule->start_time < '08:30' && $schedule->end_time > '08:00')
                                {{ $schedule->subject_desc }}<br>
                                {{ $schedule->room_desc }}<br>
                                {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
                            @endif
                        @endforeach
                    </td>
                </tr>

                <tr class="border">

                    <td class="border text">08:30<br>09:00</td>

                    <td class="border text">
                        @foreach ($section_schedules as $schedule)
                            @if ($schedule->day == 'Monday' && $schedule->start_time < '09:00' && $schedule->end_time > '08:30')
                                {{ $schedule->subject_desc }}<br>
                                {{ $schedule->room_desc }}<br>
                                {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
                            @endif
                        @endforeach

                    </td>



                    <td class="border text">
                        @foreach ($section_schedules as $schedule)
                            @if ($schedule->day == 'Tuesday' && $schedule->start_time < '09:00' && $schedule->end_time > '08:30')
                                {{ $schedule->subject_desc }}<br>
                                {{ $schedule->room_desc }}<br>
                                {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
                            @endif
                        @endforeach
                    </td>


                    <td class="border text">
                        @foreach ($section_schedules as $schedule)
                            @if ($schedule->day == 'Wednesday' && $schedule->start_time < '09:00' && $schedule->end_time > '08:30')
                                {{ $schedule->subject_desc }}<br>
                                {{ $schedule->room_desc }}<br>
                                {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
                            @endif
                        @endforeach
                    </td>


                    <td class="border text">
                        @foreach ($section_schedules as $schedule)
                            @if ($schedule->day == 'Thursday' && $schedule->start_time < '09:00' && $schedule->end_time > '08:30')
                                {{ $schedule->subject_desc }}<br>
                                {{ $schedule->room_desc }}<br>
                                {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
                            @endif
                        @endforeach
                    </td>

                    <td class="border text">
                        @foreach ($section_schedules as $schedule)
                            @if ($schedule->day == 'Friday' && $schedule->start_time < '09:00' && $schedule->end_time > '08:30')
                                {{ $schedule->subject_desc }}<br>
                                {{ $schedule->room_desc }}<br>
                                {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
                            @endif
                        @endforeach
                    </td>


                    <td class="border text">
                        @foreach ($section_schedules as $schedule)
                            @if ($schedule->day == 'Saturday' && $schedule->start_time < '09:00' && $schedule->end_time > '08:30')
                                {{ $schedule->subject_desc }}<br>
                                {{ $schedule->room_desc }}<br>
                                {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
                            @endif
                        @endforeach
                    </td>
                </tr>



                <tr class=" border">
                    <td class="border text">09:00<br>09:30</td>
                    <td class="border text">
                        @foreach ($section_schedules as $schedule)
                            @if ($schedule->day == 'Monday' && $schedule->start_time < '09:30' && $schedule->end_time > '09:00')
                                {{ $schedule->subject_desc }}<br>
                                {{ $schedule->room_desc }}<br>
                                {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
                            @endif
                        @endforeach
                    </td>

                    <td class="border text">
                        @foreach ($section_schedules as $schedule)
                            @if ($schedule->day == 'Tuesday' && $schedule->start_time < '09:30' && $schedule->end_time > '09:00')
                                {{ $schedule->subject_desc }}<br>
                                {{ $schedule->room_desc }}<br>
                                {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
                            @endif
                        @endforeach
                    </td>

                    <td class="border text">
                        @foreach ($section_schedules as $schedule)
                            @if ($schedule->day == 'Wednesday' && $schedule->start_time < '09:30' && $schedule->end_time > '09:00')
                                {{ $schedule->subject_desc }}<br>
                                {{ $schedule->room_desc }}<br>
                                {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
                            @endif
                        @endforeach
                    </td>


                    <td class="border text">
                        @foreach ($section_schedules as $schedule)
                            @if ($schedule->day == 'Thursday' && $schedule->start_time < '09:30' && $schedule->end_time > '09:00')
                                {{ $schedule->subject_desc }}<br>
                                {{ $schedule->room_desc }}<br>
                                {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
                            @endif
                        @endforeach
                    </td>

                    <td class="border text">
                        @foreach ($section_schedules as $schedule)
                            @if ($schedule->day == 'Friday' && $schedule->start_time < '09:30' && $schedule->end_time > '09:00')
                                {{ $schedule->subject_desc }}<br>
                                {{ $schedule->room_desc }}<br>
                                {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
                            @endif
                        @endforeach
                    </td>


                    <td class="border text">
                        @foreach ($section_schedules as $schedule)
                            @if ($schedule->day == 'Saturday' && $schedule->start_time < '09:30' && $schedule->end_time > '09:00')
                                {{ $schedule->subject_desc }}<br>
                                {{ $schedule->room_desc }}<br>
                                {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
                            @endif
                        @endforeach
                    </td>
                </tr>

                <tr class=" border">
                    <td class="border text">09:30<br>10:00</td>
                    <td class="border text">
                        @foreach ($section_schedules as $schedule)
                            @if ($schedule->day == 'Monday' && $schedule->start_time < '10:00' && $schedule->end_time > '09:30')
                                {{ $schedule->subject_desc }}<br>
                                {{ $schedule->room_desc }}<br>
                                {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
                            @endif
                        @endforeach
                    </td>

                    <td class="border text">
                        @foreach ($section_schedules as $schedule)
                            @if ($schedule->day == 'Tuesday' && $schedule->start_time < '10:00' && $schedule->end_time > '09:30')
                                {{ $schedule->subject_desc }}<br>
                                {{ $schedule->room_desc }}<br>
                                {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
                            @endif
                        @endforeach
                    </td>

                    <td class="border text">
                        @foreach ($section_schedules as $schedule)
                            @if ($schedule->day == 'Wednesday' && $schedule->start_time < '10:00' && $schedule->end_time > '09:30')
                                {{ $schedule->subject_desc }}<br>
                                {{ $schedule->room_desc }}<br>
                                {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
                            @endif
                        @endforeach
                    </td>


                    <td class="border text">
                        @foreach ($section_schedules as $schedule)
                            @if ($schedule->day == 'Thursday' && $schedule->start_time < '10:00' && $schedule->end_time > '09:30')
                                {{ $schedule->subject_desc }}<br>
                                {{ $schedule->room_desc }}<br>
                                {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
                            @endif
                        @endforeach
                    </td>

                    <td class="border text">
                        @foreach ($section_schedules as $schedule)
                            @if ($schedule->day == 'Friday' && $schedule->start_time < '10:00' && $schedule->end_time > '09:30')
                                {{ $schedule->subject_desc }}<br>
                                {{ $schedule->room_desc }}<br>
                                {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
                            @endif
                        @endforeach
                    </td>


                    <td class="border text">
                        @foreach ($section_schedules as $schedule)
                            @if ($schedule->day == 'Saturday' && $schedule->start_time < '10:00' && $schedule->end_time > '09:30')
                                {{ $schedule->subject_desc }}<br>
                                {{ $schedule->room_desc }}<br>
                                {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
                            @endif
                        @endforeach
                    </td>
                </tr>

                <tr class="border">
                    <td class="border text">10:00<br>10:30</td>
                    <td class="border text">
                        @foreach ($section_schedules as $schedule)
                            @if ($schedule->day == 'Monday' && $schedule->start_time < '10:30' && $schedule->end_time > '10:00')
                                {{ $schedule->subject_desc }}<br>
                                {{ $schedule->room_desc }}<br>
                                {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
                            @endif
                        @endforeach
                    </td>

                    <td class="border text">
                        @foreach ($section_schedules as $schedule)
                            @if ($schedule->day == 'Tuesday' && $schedule->start_time < '10:30' && $schedule->end_time > '10:00')
                                {{ $schedule->subject_desc }}<br>
                                {{ $schedule->room_desc }}<br>
                                {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
                            @endif
                        @endforeach
                    </td>

                    <td class="border text">
                        @foreach ($section_schedules as $schedule)
                            @if ($schedule->day == 'Wednesday' && $schedule->start_time < '10:30' && $schedule->end_time > '10:00')
                                {{ $schedule->subject_desc }}<br>
                                {{ $schedule->room_desc }}<br>
                                {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
                            @endif
                        @endforeach
                    </td>


                    <td class="border text">
                        @foreach ($section_schedules as $schedule)
                            @if ($schedule->day == 'Thursday' && $schedule->start_time < '10:30' && $schedule->end_time > '10:00')
                                {{ $schedule->subject_desc }}<br>
                                {{ $schedule->room_desc }}<br>
                                {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
                            @endif
                        @endforeach
                    </td>

                    <td class="border text">
                        @foreach ($section_schedules as $schedule)
                            @if ($schedule->day == 'Friday' && $schedule->start_time < '10:30' && $schedule->end_time > '10:00')
                                {{ $schedule->subject_desc }}<br>
                                {{ $schedule->room_desc }}<br>
                                {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
                            @endif
                        @endforeach
                    </td>


                    <td class="border text">
                        @foreach ($section_schedules as $schedule)
                            @if ($schedule->day == 'Saturday' && $schedule->start_time < '10:30' && $schedule->end_time > '10:00')
                                {{ $schedule->subject_desc }}<br>
                                {{ $schedule->room_desc }}<br>
                                {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
                            @endif
                        @endforeach
                    </td>
                </tr>

                <tr class=" border">
                    <td class="border text">10:30<br>11:00</td>
                    <td class="border text">
                        @foreach ($section_schedules as $schedule)
                            @if ($schedule->day == 'Monday' && $schedule->start_time < '11:00' && $schedule->end_time > '10:30')
                                {{ $schedule->subject_desc }}<br>
                                {{ $schedule->room_desc }}<br>
                                {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
                            @endif
                        @endforeach
                    </td>

                    <td class="border text">
                        @foreach ($section_schedules as $schedule)
                            @if ($schedule->day == 'Tuesday' && $schedule->start_time < '11:00' && $schedule->end_time > '10:30')
                                {{ $schedule->subject_desc }}<br>
                                {{ $schedule->room_desc }}<br>
                                {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
                            @endif
                        @endforeach
                    </td>

                    <td class="border text">
                        @foreach ($section_schedules as $schedule)
                            @if ($schedule->day == 'Wednesday' && $schedule->start_time < '11:00' && $schedule->end_time > '10:30')
                                {{ $schedule->subject_desc }}<br>
                                {{ $schedule->room_desc }}<br>
                                {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
                            @endif
                        @endforeach
                    </td>


                    <td class="border text">
                        @foreach ($section_schedules as $schedule)
                            @if ($schedule->day == 'Thursday' && $schedule->start_time < '11:00' && $schedule->end_time > '10:30')
                                {{ $schedule->subject_desc }}<br>
                                {{ $schedule->room_desc }}<br>
                                {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
                            @endif
                        @endforeach
                    </td>

                    <td class="border text">
                        @foreach ($section_schedules as $schedule)
                            @if ($schedule->day == 'Friday' && $schedule->start_time < '11:00' && $schedule->end_time > '10:30')
                                {{ $schedule->subject_desc }}<br>
                                {{ $schedule->room_desc }}<br>
                                {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
                            @endif
                        @endforeach
                    </td>


                    <td class="border text">
                        @foreach ($section_schedules as $schedule)
                            @if ($schedule->day == 'Saturday' && $schedule->start_time < '11:00' && $schedule->end_time > '10:30')
                                {{ $schedule->subject_desc }}<br>
                                {{ $schedule->room_desc }}<br>
                                {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
                            @endif
                        @endforeach
                    </td>
                </tr>


                <tr class="border">
                    <td class="border text">11:00<br>11:30</td>
                    <td class="border text">
                        @foreach ($section_schedules as $schedule)
                            @if ($schedule->day == 'Monday' && $schedule->start_time < '11:30' && $schedule->end_time > '11:00')
                                {{ $schedule->subject_desc }}<br>
                                {{ $schedule->room_desc }}<br>
                                {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
                            @endif
                        @endforeach
                    </td>

                    <td class="border text">
                        @foreach ($section_schedules as $schedule)
                            @if ($schedule->day == 'Tuesday' && $schedule->start_time < '11:30' && $schedule->end_time > '11:00')
                                {{ $schedule->subject_desc }}<br>
                                {{ $schedule->room_desc }}<br>
                                {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
                            @endif
                        @endforeach
                    </td>

                    <td class="border text">
                        @foreach ($section_schedules as $schedule)
                            @if ($schedule->day == 'Wednesday' && $schedule->start_time < '11:30' && $schedule->end_time > '11:00')
                                {{ $schedule->subject_desc }}<br>
                                {{ $schedule->room_desc }}<br>
                                {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
                            @endif
                        @endforeach
                    </td>

                    <td class="border text">
                        @foreach ($section_schedules as $schedule)
                            @if ($schedule->day == 'Thursday' && $schedule->start_time < '11:30' && $schedule->end_time > '11:00')
                                {{ $schedule->subject_desc }}<br>
                                {{ $schedule->room_desc }}<br>
                                {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
                            @endif
                        @endforeach
                    </td>

                    <td class="border text">
                        @foreach ($section_schedules as $schedule)
                            @if ($schedule->day == 'Friday' && $schedule->start_time < '11:30' && $schedule->end_time > '11:00')
                                {{ $schedule->subject_desc }}<br>
                                {{ $schedule->room_desc }}<br>
                                {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
                            @endif
                        @endforeach
                    </td>

                    <td class="border text">
                        @foreach ($section_schedules as $schedule)
                            @if ($schedule->day == 'Saturday' && $schedule->start_time < '11:30' && $schedule->end_time > '11:00')
                                {{ $schedule->subject_desc }}<br>
                                {{ $schedule->room_desc }}<br>
                                {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
                            @endif
                        @endforeach
                    </td>



                </tr>
                <tr class="text-center border">
                    <td class="border text">11:30<br>12:00</td>
                    <td class="border text">
                        @foreach ($section_schedules as $schedule)
                            @if ($schedule->day == 'Monday' && $schedule->start_time < '12:00' && $schedule->end_time > '11:30')
                                {{ $schedule->subject_desc }}<br>
                                {{ $schedule->room_desc }}<br>
                                {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
                            @endif
                        @endforeach
                    </td>

                    <td class="border text">
                        @foreach ($section_schedules as $schedule)
                            @if ($schedule->day == 'Tuesday' && $schedule->start_time < '12:00' && $schedule->end_time > '11:30')
                                {{ $schedule->subject_desc }}<br>
                                {{ $schedule->room_desc }}<br>
                                {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
                            @endif
                        @endforeach
                    </td>

                    <td class="border text">
                        @foreach ($section_schedules as $schedule)
                            @if ($schedule->day == 'Wednesday' && $schedule->start_time < '12:00' && $schedule->end_time > '11:30')
                                {{ $schedule->subject_desc }}<br>
                                {{ $schedule->room_desc }}<br>
                                {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
                            @endif
                        @endforeach
                    </td>

                    <td class="border text">
                        @foreach ($section_schedules as $schedule)
                            @if ($schedule->day == 'Thursday' && $schedule->start_time < '12:00' && $schedule->end_time > '11:30')
                                {{ $schedule->subject_desc }}<br>
                                {{ $schedule->room_desc }}<br>
                                {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
                            @endif
                        @endforeach
                    </td>


                    <td class="border text">
                        @foreach ($section_schedules as $schedule)
                            @if ($schedule->day == 'Friday' && $schedule->start_time < '12:00' && $schedule->end_time > '11:30')
                                {{ $schedule->subject_desc }}<br>
                                {{ $schedule->room_desc }}<br>
                                {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
                            @endif
                        @endforeach
                    </td>

                    <td class="border text">
                        @foreach ($section_schedules as $schedule)
                            @if ($schedule->day == 'Saturday' && $schedule->start_time < '12:00' && $schedule->end_time > '11:30')
                                {{ $schedule->subject_desc }}<br>
                                {{ $schedule->room_desc }}<br>
                                {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
                            @endif
                        @endforeach
                    </td>
                </tr>


                <tr class="text-center border">
                    <td class="border text">12:00<br>12:30</td>
                    <td class="border text">
                        @foreach ($section_schedules as $schedule)
                            @if ($schedule->day == 'Monday' && $schedule->start_time < '12:30' && $schedule->end_time > '12:00')
                                {{ $schedule->subject_desc }}<br>
                                {{ $schedule->room_desc }}<br>
                                {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
                            @endif
                        @endforeach
                    </td>


                    <td class="border text">
                        @foreach ($section_schedules as $schedule)
                            @if ($schedule->day == 'Tuesday' && $schedule->start_time < '12:30' && $schedule->end_time > '12:00')
                                {{ $schedule->subject_desc }}<br>
                                {{ $schedule->room_desc }}<br>
                                {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
                            @endif
                        @endforeach
                    </td>

                    <td class="border text">
                        @foreach ($section_schedules as $schedule)
                            @if ($schedule->day == 'Wednesday' && $schedule->start_time < '12:30' && $schedule->end_time > '12:00')
                                {{ $schedule->subject_desc }}<br>
                                {{ $schedule->room_desc }}<br>
                                {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
                            @endif
                        @endforeach
                    </td>

                    <td class="border text">
                        @foreach ($section_schedules as $schedule)
                            @if ($schedule->day == 'Thursday' && $schedule->start_time < '12:30' && $schedule->end_time > '12:00')
                                {{ $schedule->subject_desc }}<br>
                                {{ $schedule->room_desc }}<br>
                                {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
                            @endif
                        @endforeach
                    </td>

                    <td class="border text">
                        @foreach ($section_schedules as $schedule)
                            @if ($schedule->day == 'Friday' && $schedule->start_time < '12:30' && $schedule->end_time > '12:00')
                                {{ $schedule->subject_desc }}<br>
                                {{ $schedule->room_desc }}<br>
                                {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
                            @endif
                        @endforeach
                    </td>

                    <td class="border text">
                        @foreach ($section_schedules as $schedule)
                            @if ($schedule->day == 'Saturday' && $schedule->start_time < '12:30' && $schedule->end_time > '12:00')
                                {{ $schedule->subject_desc }}<br>
                                {{ $schedule->room_desc }}<br>
                                {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
                            @endif
                        @endforeach
                    </td>
                </tr>


                <tr class="text-center border">
                    <td class="border text">12:30<br>1:00</td>
                    <td class="border text">
                        @foreach ($section_schedules as $schedule)
                            @if ($schedule->day == 'Monday' && $schedule->start_time < '13:00' && $schedule->end_time > '12:30')
                                {{ $schedule->subject_desc }}<br>
                                {{ $schedule->room_desc }}<br>
                                {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
                            @endif
                        @endforeach
                    </td>

                    <td class="border text">
                        @foreach ($section_schedules as $schedule)
                            @if ($schedule->day == 'Tuesday' && $schedule->start_time < '13:00' && $schedule->end_time > '12:30')
                                {{ $schedule->subject_desc }}<br>
                                {{ $schedule->room_desc }}<br>
                                {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
                            @endif
                        @endforeach
                    </td>

                    <td class="border text">
                        @foreach ($section_schedules as $schedule)
                            @if ($schedule->day == 'Wednesday' && $schedule->start_time < '13:00' && $schedule->end_time > '12:30')
                                {{ $schedule->subject_desc }}<br>
                                {{ $schedule->room_desc }}<br>
                                {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
                            @endif
                        @endforeach
                    </td>

                    <td class="border text">
                        @foreach ($section_schedules as $schedule)
                            @if ($schedule->day == 'Thursday' && $schedule->start_time < '13:00' && $schedule->end_time > '12:30')
                                {{ $schedule->subject_desc }}<br>
                                {{ $schedule->room_desc }}<br>
                                {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
                            @endif
                        @endforeach
                    </td>

                    <td class="border text">
                        @foreach ($section_schedules as $schedule)
                            @if ($schedule->day == 'Friday' && $schedule->start_time < '13:00' && $schedule->end_time > '12:30')
                                {{ $schedule->subject_desc }}<br>
                                {{ $schedule->room_desc }}<br>
                                {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
                            @endif
                        @endforeach
                    </td>

                    <td class="border text">
                        @foreach ($section_schedules as $schedule)
                            @if ($schedule->day == 'Saturday' && $schedule->start_time < '13:00' && $schedule->end_time > '12:30')
                                {{ $schedule->subject_desc }}<br>
                                {{ $schedule->room_desc }}<br>
                                {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
                            @endif
                        @endforeach
                    </td>
                </tr>
                <tr class="text-center border">
                    <td class="border text">01:00<br>01:30</td>
                    <td class="border text">
                        @foreach ($section_schedules as $schedule)
                            @if ($schedule->day == 'Monday' && $schedule->start_time < '13:30' && $schedule->end_time > '13:00')
                                {{ $schedule->subject_desc }}<br>
                                {{ $schedule->room_desc }}<br>
                                {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
                            @endif
                        @endforeach
                    </td>

                    <td class="border text">
                        @foreach ($section_schedules as $schedule)
                            @if ($schedule->day == 'Tuesday' && $schedule->start_time < '13:30' && $schedule->end_time > '13:00')
                                {{ $schedule->subject_desc }}<br>
                                {{ $schedule->room_desc }}<br>
                                {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
                            @endif
                        @endforeach
                    </td>

                    <td class="border text">
                        @foreach ($section_schedules as $schedule)
                            @if ($schedule->day == 'Wednesday' && $schedule->start_time < '13:30' && $schedule->end_time > '13:00')
                                {{ $schedule->subject_desc }}<br>
                                {{ $schedule->room_desc }}<br>
                                {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
                            @endif
                        @endforeach
                    </td>

                    <td class="border text">
                        @foreach ($section_schedules as $schedule)
                            @if ($schedule->day == 'Thursday' && $schedule->start_time < '13:30' && $schedule->end_time > '13:00')
                                {{ $schedule->subject_desc }}<br>
                                {{ $schedule->room_desc }}<br>
                                {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
                            @endif
                        @endforeach
                    </td>

                    <td class="border text">
                        @foreach ($section_schedules as $schedule)
                            @if ($schedule->day == 'Friday' && $schedule->start_time < '13:30' && $schedule->end_time > '13:00')
                                {{ $schedule->subject_desc }}<br>
                                {{ $schedule->room_desc }}<br>
                                {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
                            @endif
                        @endforeach
                    </td>

                    <td class="border text">
                        @foreach ($section_schedules as $schedule)
                            @if ($schedule->day == 'Saturday' && $schedule->start_time < '13:30' && $schedule->end_time > '13:00')
                                {{ $schedule->subject_desc }}<br>
                                {{ $schedule->room_desc }}<br>
                                {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
                            @endif
                        @endforeach
                    </td>
                </tr>
                <tr class="text-center border">
                    <td class="border text">01:30<br>02:00</td>
                    <td class="border text">
                        @foreach ($section_schedules as $schedule)
                            @if ($schedule->day == 'Monday' && $schedule->start_time < '14:00' && $schedule->end_time > '13:30')
                                {{ $schedule->subject_desc }}<br>
                                {{ $schedule->room_desc }}<br>
                                {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
                            @endif
                        @endforeach
                    </td>

                    <td class="border text">
                        @foreach ($section_schedules as $schedule)
                            @if ($schedule->day == 'Tuesday' && $schedule->start_time < '14:00' && $schedule->end_time > '13:30')
                                {{ $schedule->subject_desc }}<br>
                                {{ $schedule->room_desc }}<br>
                                {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
                            @endif
                        @endforeach
                    </td>

                    <td class="border text">
                        @foreach ($section_schedules as $schedule)
                            @if ($schedule->day == 'Wednesday' && $schedule->start_time < '14:00' && $schedule->end_time > '13:30')
                                {{ $schedule->subject_desc }}<br>
                                {{ $schedule->room_desc }}<br>
                                {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
                            @endif
                        @endforeach
                    </td>

                    <td class="border text">
                        @foreach ($section_schedules as $schedule)
                            @if ($schedule->day == 'Thursday' && $schedule->start_time < '14:00' && $schedule->end_time > '13:30')
                                {{ $schedule->subject_desc }}<br>
                                {{ $schedule->room_desc }}<br>
                                {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
                            @endif
                        @endforeach
                    </td>

                    <td class="border text">
                        @foreach ($section_schedules as $schedule)
                            @if ($schedule->day == 'Friday' && $schedule->start_time < '14:00' && $schedule->end_time > '13:30')
                                {{ $schedule->subject_desc }}<br>
                                {{ $schedule->room_desc }}<br>
                                {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
                            @endif
                        @endforeach
                    </td>

                    <td class="border text">
                        @foreach ($section_schedules as $schedule)
                            @if ($schedule->day == 'Saturday' && $schedule->start_time < '14:00' && $schedule->end_time > '13:30')
                                {{ $schedule->subject_desc }}<br>
                                {{ $schedule->room_desc }}<br>
                                {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
                            @endif
                        @endforeach
                    </td>
                </tr>
                <tr class="text-center border">
                    <td class="border text">02:00<br>02:30</td>
                    <td class="border text">
                        @foreach ($section_schedules as $schedule)
                            @if ($schedule->day == 'Monday' && $schedule->start_time < '14:30' && $schedule->end_time > '14:00')
                                {{ $schedule->subject_desc }}<br>
                                {{ $schedule->room_desc }}<br>
                                {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
                            @endif
                        @endforeach
                    </td>

                    <td class="border text">
                        @foreach ($section_schedules as $schedule)
                            @if ($schedule->day == 'Tuesday' && $schedule->start_time < '14:30' && $schedule->end_time > '14:00')
                                {{ $schedule->subject_desc }}<br>
                                {{ $schedule->room_desc }}
                                <br>
                                {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
                            @endif
                        @endforeach
                    </td>

                    <td class="border text">
                        @foreach ($section_schedules as $schedule)
                            @if ($schedule->day == 'Wednesday' && $schedule->start_time < '14:30' && $schedule->end_time > '14:00')
                                {{ $schedule->subject_desc }}<br>
                                {{ $schedule->room_desc }}
                                <br>
                                {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
                            @endif
                        @endforeach
                    </td>

                    <td class="border text">
                        @foreach ($section_schedules as $schedule)
                            @if ($schedule->day == 'Thursday' && $schedule->start_time < '14:30' && $schedule->end_time > '14:00')
                                {{ $schedule->subject_desc }}<br>
                                {{ $schedule->room_desc }}
                                <br>
                                {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
                            @endif
                        @endforeach
                    </td>

                    <td class="border text">
                        @foreach ($section_schedules as $schedule)
                            @if ($schedule->day == 'Friday' && $schedule->start_time < '14:30' && $schedule->end_time > '14:00')
                                {{ $schedule->subject_desc }}<br>
                                {{ $schedule->room_desc }}
                                <br>
                                {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
                            @endif
                        @endforeach
                    </td>

                    <td class="border text">
                        @foreach ($section_schedules as $schedule)
                            @if ($schedule->day == 'Saturday' && $schedule->start_time < '14:30' && $schedule->end_time > '14:00')
                                {{ $schedule->subject_desc }}<br>
                                {{ $schedule->room_desc }}
                                <br>
                                {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
                            @endif
                        @endforeach
                    </td>
                </tr>

                <tr class="text-center border">
                    <td class="border text">02:30<br>03:00</td>
                    <td class="border text">
                        @foreach ($section_schedules as $schedule)
                            @if ($schedule->day == 'Monday' && $schedule->start_time < '15:00' && $schedule->end_time > '14:30')
                                {{ $schedule->subject_desc }}<br>
                                {{ $schedule->room_desc }}<br>
                                {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
                            @endif
                        @endforeach
                    </td>

                    <td class="border text">
                        @foreach ($section_schedules as $schedule)
                            @if ($schedule->day == 'Tuesday' && $schedule->start_time < '15:00' && $schedule->end_time > '14:30')
                                {{ $schedule->subject_desc }}<br>
                                {{ $schedule->room_desc }}
                                <br>
                                {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
                            @endif
                        @endforeach
                    </td>

                    <td class="border text">
                        @foreach ($section_schedules as $schedule)
                            @if ($schedule->day == 'Wednesday' && $schedule->start_time < '15:00' && $schedule->end_time > '14:30')
                                {{ $schedule->subject_desc }}<br>
                                {{ $schedule->room_desc }}
                                <br>
                                {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
                            @endif
                        @endforeach
                    </td>

                    <td class="border text">
                        @foreach ($section_schedules as $schedule)
                            @if ($schedule->day == 'Thursday' && $schedule->start_time < '15:00' && $schedule->end_time > '14:30')
                                {{ $schedule->subject_desc }}<br>
                                {{ $schedule->room_desc }}
                                <br>
                                {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
                            @endif
                        @endforeach
                    </td>

                    <td class="border text">
                        @foreach ($section_schedules as $schedule)
                            @if ($schedule->day == 'Friday' && $schedule->start_time < '15:00' && $schedule->end_time > '14:30')
                                {{ $schedule->subject_desc }}<br>
                                {{ $schedule->room_desc }}
                                <br>
                                {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
                            @endif
                        @endforeach
                    </td>

                    <td class="border text">
                        @foreach ($section_schedules as $schedule)
                            @if ($schedule->day == 'Saturday' && $schedule->start_time < '15:00' && $schedule->end_time > '14:30')
                                {{ $schedule->subject_desc }}<br>
                                {{ $schedule->room_desc }}
                                <br>
                                {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
                            @endif
                        @endforeach
                    </td>
                </tr>


                <tr class="text-center border">
                    <td class="border text">03:00<br>03:30</td>
                    <td class="border text">
                        @foreach ($section_schedules as $schedule)
                            @if ($schedule->day == 'Monday' && $schedule->start_time < '15:30' && $schedule->end_time > '15:00')
                                {{ $schedule->subject_desc }}<br>
                                {{ $schedule->room_desc }}<br>
                                {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
                            @endif
                        @endforeach
                    </td>

                    <td class="border text">
                        @foreach ($section_schedules as $schedule)
                            @if ($schedule->day == 'Tuesday' && $schedule->start_time < '15:30' && $schedule->end_time > '15:00')
                                {{ $schedule->subject_desc }}<br>
                                {{ $schedule->room_desc }}
                                <br>
                                {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
                            @endif
                        @endforeach
                    </td>

                    <td class="border text">
                        @foreach ($section_schedules as $schedule)
                            @if ($schedule->day == 'Wednesday' && $schedule->start_time < '15:30' && $schedule->end_time > '15:00')
                                {{ $schedule->subject_desc }}<br>
                                {{ $schedule->room_desc }}
                                <br>
                                {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
                            @endif
                        @endforeach
                    </td>

                    <td class="border text">
                        @foreach ($section_schedules as $schedule)
                            @if ($schedule->day == 'Thursday' && $schedule->start_time < '15:30' && $schedule->end_time > '15:00')
                                {{ $schedule->subject_desc }}<br>
                                {{ $schedule->room_desc }}
                                <br>
                                {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
                            @endif
                        @endforeach
                    </td>

                    <td class="border text">
                        @foreach ($section_schedules as $schedule)
                            @if ($schedule->day == 'Friday' && $schedule->start_time < '15:30' && $schedule->end_time > '15:00')
                                {{ $schedule->subject_desc }}<br>
                                {{ $schedule->room_desc }}
                                <br>
                                {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
                            @endif
                        @endforeach
                    </td>

                    <td class="border text">
                        @foreach ($section_schedules as $schedule)
                            @if ($schedule->day == 'Saturday' && $schedule->start_time < '15:30' && $schedule->end_time > '15:00')
                                {{ $schedule->subject_desc }}<br>
                                {{ $schedule->room_desc }}
                                <br>
                                {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
                            @endif
                        @endforeach
                    </td>
                </tr>

                <tr class="text-center border">
                    <td class="border text">03:30<br>04:00</td>
                    <td class="border text">
                        @foreach ($section_schedules as $schedule)
                            @if ($schedule->day == 'Monday' && $schedule->start_time < '16:00' && $schedule->end_time > '15:30')
                                {{ $schedule->subject_desc }}<br>
                                {{ $schedule->room_desc }}<br>
                                {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
                            @endif
                        @endforeach
                    </td>

                    <td class="border text">
                        @foreach ($section_schedules as $schedule)
                            @if ($schedule->day == 'Tuesday' && $schedule->start_time < '16:00' && $schedule->end_time > '15:30')
                                {{ $schedule->subject_desc }}<br>
                                {{ $schedule->room_desc }}
                                <br>
                                {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
                            @endif
                        @endforeach
                    </td>

                    <td class="border text">
                        @foreach ($section_schedules as $schedule)
                            @if ($schedule->day == 'Wednesday' && $schedule->start_time < '16:00' && $schedule->end_time > '15:30')
                                {{ $schedule->subject_desc }}<br>
                                {{ $schedule->room_desc }}
                                <br>
                                {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
                            @endif
                        @endforeach
                    </td>

                    <td class="border text">
                        @foreach ($section_schedules as $schedule)
                            @if ($schedule->day == 'Thursday' && $schedule->start_time < '16:00' && $schedule->end_time > '15:30')
                                {{ $schedule->subject_desc }}<br>
                                {{ $schedule->room_desc }}
                                <br>
                                {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
                            @endif
                        @endforeach
                    </td>

                    <td class="border text">
                        @foreach ($section_schedules as $schedule)
                            @if ($schedule->day == 'Friday' && $schedule->start_time < '16:00' && $schedule->end_time > '15:30')
                                {{ $schedule->subject_desc }}<br>
                                {{ $schedule->room_desc }}
                                <br>
                                {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
                            @endif
                        @endforeach
                    </td>

                    <td class="border text">
                        @foreach ($section_schedules as $schedule)
                            @if ($schedule->day == 'Saturday' && $schedule->start_time < '16:00' && $schedule->end_time > '15:30')
                                {{ $schedule->subject_desc }}<br>
                                {{ $schedule->room_desc }}
                                <br>
                                {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
                            @endif
                        @endforeach
                    </td>
                </tr>

                <tr class="text-center border">
                    <td class="border text">04:00<br>04:30</td>
                    <td class="border text">
                        @foreach ($section_schedules as $schedule)
                            @if ($schedule->day == 'Monday' && $schedule->start_time < '16:30' && $schedule->end_time > '16:00')
                                {{ $schedule->subject_desc }}<br>
                                {{ $schedule->room_desc }}<br>
                                {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
                            @endif
                        @endforeach
                    </td>

                    <td class="border text">
                        @foreach ($section_schedules as $schedule)
                            @if ($schedule->day == 'Tuesday' && $schedule->start_time < '16:30' && $schedule->end_time > '16:00')
                                {{ $schedule->subject_desc }}<br>
                                {{ $schedule->room_desc }}
                                <br>
                                {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
                            @endif
                        @endforeach
                    </td>

                    <td class="border text">
                        @foreach ($section_schedules as $schedule)
                            @if ($schedule->day == 'Wednesday' && $schedule->start_time < '16:30' && $schedule->end_time > '16:00')
                                {{ $schedule->subject_desc }}<br>
                                {{ $schedule->room_desc }}
                                <br>
                                {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
                            @endif
                        @endforeach
                    </td>

                    <td class="border text">
                        @foreach ($section_schedules as $schedule)
                            @if ($schedule->day == 'Thursday' && $schedule->start_time < '16:30' && $schedule->end_time > '16:00')
                                {{ $schedule->subject_desc }}<br>
                                {{ $schedule->room_desc }}
                                <br>
                                {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
                            @endif
                        @endforeach
                    </td>

                    <td class="border text">
                        @foreach ($section_schedules as $schedule)
                            @if ($schedule->day == 'Friday' && $schedule->start_time < '16:30' && $schedule->end_time > '16:00')
                                {{ $schedule->subject_desc }}<br>
                                {{ $schedule->room_desc }}
                                <br>
                                {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
                            @endif
                        @endforeach
                    </td>

                    <td class="border text">
                        @foreach ($section_schedules as $schedule)
                            @if ($schedule->day == 'Saturday' && $schedule->start_time < '16:30' && $schedule->end_time > '16:00')
                                {{ $schedule->subject_desc }}<br>
                                {{ $schedule->room_desc }}
                                <br>
                                {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
                            @endif
                        @endforeach
                    </td>
                </tr>

                <tr class="text-center border">
                    <td class="border text">04:30<br>05:00</td>
                    <td class="border text">
                        @foreach ($section_schedules as $schedule)
                            @if ($schedule->day == 'Monday' && $schedule->start_time < '17:00' && $schedule->end_time > '16:30')
                                {{ $schedule->subject_desc }}<br>
                                {{ $schedule->room_desc }}<br>
                                {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
                            @endif
                        @endforeach
                    </td>

                    <td class="border text">
                        @foreach ($section_schedules as $schedule)
                            @if ($schedule->day == 'Tuesday' && $schedule->start_time < '17:00' && $schedule->end_time > '16:30')
                                {{ $schedule->subject_desc }}<br>
                                {{ $schedule->room_desc }}
                                <br>
                                {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
                            @endif
                        @endforeach
                    </td>

                    <td class="border text">
                        @foreach ($section_schedules as $schedule)
                            @if ($schedule->day == 'Wednesday' && $schedule->start_time < '17:00' && $schedule->end_time > '16:30')
                                {{ $schedule->subject_desc }}<br>
                                {{ $schedule->room_desc }}
                                <br>
                                {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
                            @endif
                        @endforeach
                    </td>

                    <td class="border text">
                        @foreach ($section_schedules as $schedule)
                            @if ($schedule->day == 'Thursday' && $schedule->start_time < '17:00' && $schedule->end_time > '16:30')
                                {{ $schedule->subject_desc }}<br>
                                {{ $schedule->room_desc }}
                                <br>
                                {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
                            @endif
                        @endforeach
                    </td>

                    <td class="border text">
                        @foreach ($section_schedules as $schedule)
                            @if ($schedule->day == 'Friday' && $schedule->start_time < '17:00' && $schedule->end_time > '16:30')
                                {{ $schedule->subject_desc }}<br>
                                {{ $schedule->room_desc }}
                                <br>
                                {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
                            @endif
                        @endforeach
                    </td>

                    <td class="border text">
                        @foreach ($section_schedules as $schedule)
                            @if ($schedule->day == 'Saturday' && $schedule->start_time < '17:00' && $schedule->end_time > '16:30')
                                {{ $schedule->subject_desc }}<br>
                                {{ $schedule->room_desc }}
                                <br>
                                {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
                            @endif
                        @endforeach
                    </td>
                </tr>

                <tr class="text-center border">
                    <td class="border text">05:00<br>05:30</td>
                    <td class="border text">
                        @foreach ($section_schedules as $schedule)
                            @if ($schedule->day == 'Monday' && $schedule->start_time < '15:00' && $schedule->end_time > '17:00')
                                {{ $schedule->subject_desc }}<br>
                                {{ $schedule->room_desc }}<br>
                                {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
                            @endif
                        @endforeach
                    </td>

                    <td class="border text">
                        @foreach ($section_schedules as $schedule)
                            @if ($schedule->day == 'Tuesday' && $schedule->start_time < '17:30' && $schedule->end_time > '17:00')
                                {{ $schedule->subject_desc }}<br>
                                {{ $schedule->room_desc }}
                                <br>
                                {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
                            @endif
                        @endforeach
                    </td>

                    <td class="border text">
                        @foreach ($section_schedules as $schedule)
                            @if ($schedule->day == 'Wednesday' && $schedule->start_time < '17:30' && $schedule->end_time > '17:00')
                                {{ $schedule->subject_desc }}<br>
                                {{ $schedule->room_desc }}
                                <br>
                                {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
                            @endif
                        @endforeach
                    </td>

                    <td class="border text">
                        @foreach ($section_schedules as $schedule)
                            @if ($schedule->day == 'Thursday' && $schedule->start_time < '17:30' && $schedule->end_time > '17:00')
                                {{ $schedule->subject_desc }}<br>
                                {{ $schedule->room_desc }}
                                <br>
                                {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
                            @endif
                        @endforeach
                    </td>

                    <td class="border text">
                        @foreach ($section_schedules as $schedule)
                            @if ($schedule->day == 'Friday' && $schedule->start_time < '17:30' && $schedule->end_time > '17:00')
                                {{ $schedule->subject_desc }}<br>
                                {{ $schedule->room_desc }}
                                <br>
                                {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
                            @endif
                        @endforeach
                    </td>

                    <td class="border text">
                        @foreach ($section_schedules as $schedule)
                            @if ($schedule->day == 'Saturday' && $schedule->start_time < '17:30' && $schedule->end_time > '17:00')
                                {{ $schedule->subject_desc }}<br>
                                {{ $schedule->room_desc }}
                                <br>
                                {{ $schedule->faculty_firstName }} {{ $schedule->faculty_lastName }}
                            @endif
                        @endforeach
                    </td>
                </tr>
            </tbody>

            <tr class=" border2">
                <td colspan="3" class="border2 p-3">
                    <div class="row">
                        <div class="col fw-bold" style="font-size: 10px;">Prepared by:</div><br>
                        <div class="col" style="font-size: 10px; margin-left:50px;">
                            <u><b>_________________________</b></u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <u><b>_________________________</b></u>
                            <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Registrar
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;Department Chair
                        </div>
                    </div>
                </td>

                <td colspan="2" class="border2 p-3">
                    <div class="row">
                        <div class="col fw-bold mb-1" style="font-size: 10px;">Recommending Approval:</div><br>
                    </div>
                    <div class="row">
                        <div class="col" style="font-size: 10px;">
                            <center><u><b>____________________</b></u><br>College Dean</center>
                        </div>
                    </div>
                </td>
                <td colspan="2" class="border2 p-3">
                    <div class="row">
                        <div class="col fw-bold mb-1" style="font-size: 10px;">Approved:</div><br>
                    </div>
                    <div class="row">
                        <div class="col" style="font-size: 10px;">
                            <center><u><b>__________________________</b></u><br>Campus Executive Director</center>
                        </div>
                    </div>
                </td>
            </tr>

        </table>
    </div>
</body>

</html>
