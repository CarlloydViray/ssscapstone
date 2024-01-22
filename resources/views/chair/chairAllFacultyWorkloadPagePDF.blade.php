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
        padding: 5px;
        font-size: 10px;
        text-align: center;
    }

    .border2 {
        border: 3px solid black;
        padding: 2px;
    }

    .border3 {
        border: 3px solid black;
        padding: 2px;
        font-size: 10px;
        font-weight: bold;
    }

    .border5 {
        border: 1px solid black;
        padding: 2px;
        font-size: 7px;
        font-weight: bold;
        text-align: center;
    }
</style>

<body>
    <div class="container mt-5">
        <table style="width:100%">
            <thead>
                <tr class="border2">
                    <td colspan="2" class="border2">
                        <center><img src="{{ public_path() . '/assets/logo/PSUlabel1.png' }}" alt="SSS Logo"
                                class="logo img-fluid" style="width:70px;"></center>
                    </td>

                    <td colspan="14" class="text-center">
                        <h3>SUMMARY OF FACULTY LOADING</h3>
                        <p>PANGASINAN STATE UNIVERSITY</p>
                    </td>
                </tr>
                <tr class="border2">
                    <td colspan="16" class="text-center p-1">
                        <p><b>1st Semester , SY {{ $currentSchoolYear }}</b></p>
                    </td>
                </tr>
                <tr class="border3" style="border: 3px solid black;">
                <td class="text-center p-1">CAMPUS :</td>
                    <td colspan="7" class="p-1">{{ $campus->first()->campus_location }}</td>
                    <td class="text-center p-1">DEPARTMENT:</td>
                    <td colspan="7" class="p-1">{{ $dept->first()->dept_desc }}</td>
                </tr>
                <tr class="border2">
                    <th rowspan=2 class="border5">INSTRUCTORS INFORMATION</th>
                    <th rowspan=2 class="border5">STUDENTS MAJOR/PROGRAM</th>
                    <th rowspan=2 class="border5">SECTION</th>
                    <th rowspan=2 class="border5">COURSE CODE</th>
                    <th rowspan=2 class="border5">COURSE TITLE</th>
                    <th colspan=2 class="border5">NO. OF TEACHING HOURS</th>
                    <th rowspan=2 class="border5">TOTAL TEACHING LOAD</th>
                    <th colspan=3 class="border5">WORK/DESIGNATION EQUIVALENT</th>
                    <th rowspan=2 class="border5">TOTAL OF UNITS DELOADING</th>
                    <th rowspan=2 class="border5">TOTAL WORKLOAD UNITS</th>
                    <th colspan=2 class="border5">NO. OF PREPARATIONS</th>
                    <th rowspan=2 class="border5">REMARKS OVERLOAD / RELOAD /UNDERLOAD</th>
                </tr>
                <tr class="border2">
                    <th class="border5">LEC</th>
                    <th class="border5">LAB</th>
                    <th class="border5">DESIGNATION</th>
                    <th class="border5">RESERCH</th>
                    <th class="border5">EXTENTION</th>
                    <th class="border5">TEACHING</th>
                    <th class="border5">DESIGNATION</th>


                </tr>
            </thead>
            @php
                $var = 1;
                $deptcode = "";
                $var2 = 0;
            @endphp



            <tbody class="border2">
    @foreach ($facultyMembers as $facultyMember)
        @php
             $var = 1;
            $var2 = 0;
        @endphp
        @foreach ($workloads[$facultyMember->faculty_id] as $workload)
            @php
                $var += 1;
                $var2 += 1;
            @endphp
        @endforeach 
        <tr>
            <td rowspan="{{ $var }}" class="border5">
                {{ $facultyMember->faculty_firstName . ' ' . $facultyMember->faculty_lastName }}
            </td>
            <td rowspan="{{ $var }}" class="border5">
                @foreach ($workloads[$facultyMember->faculty_id] as $workload)
                    @if ($loop->first)
                        @php $deptcode = $workload->dept_code; @endphp
                    @endif
                @endforeach
                {{ $deptcode }}
            </td>
            <td colspan=14 style="background-color: #A9A9A9;"></td>
        </tr>

        @foreach ($workloads[$facultyMember->faculty_id] as $workload)
            <tr>
                <td class="border5">{{ $workload->section_desc }}</td>
                <td class="border5">{{ $workload->subject_code }}</td>
                <td class="border5">{{ $workload->subject_desc }}</td>
                <td class="border5">{{ $workload->workload_lec }}</td>
                <td class="border5">{{ $workload->workload_lab }}</td>
                <td class="border5">{{ $workload->workload_teachingLoad }}</td>

                <!-- Loading information spanned across all rows of the workload -->
                @if ($loop->first)
                    @foreach ($loadings[$facultyMember->faculty_id] as $loading)
                        <td rowspan="{{ $var2 }}" class="border5">{{ $loading->designation_units ?? 0.0 }}</td>
                        <td rowspan="{{ $var2 }}" class="border5">{{ $loading->loading_research ?? 0.0 }}</td>
                        <td rowspan="{{ $var2 }}" class="border5">{{ $loading->loading_extension ?? 0.0 }}</td>
                        <td rowspan="{{ $var2 }}" class="border5">{{ $loading->loading_totalUnitsDeloading ?? 0.0 }}</td>
                        <td rowspan="{{ $var2 }}" class="border5">{{ $loading->loading_totalWorkLoadUnits ?? 0.0 }}</td>
                        <td rowspan="{{ $var2 }}" class="border5">{{ number_format($uniqueSubjectsCount[$facultyMember->faculty_id] ?? 0, 2, '.', '') }}</td>
                        <td rowspan="{{ $var2 }}" class="border5">{{ $loading->loading_prepDesignation ?? 0.0 }}</td>
                        <td rowspan="{{ $var2 }}" class="border5">{{ $loading->loading_remarks }}</td>
                    @endforeach
                @endif
            </tr>
        @endforeach
    @endforeach

</tbody>

<tbody> 
            <tr class=" border2">
                <td colspan="8" class="border2 p-3">
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

                <td colspan="4" class="border2 p-3">
                    <div class="row">
                        <div class="col fw-bold mb-1" style="font-size: 10px;">Recommending Approval:</div><br>
                    </div>
                    <div class="row">
                        <div class="col" style="font-size: 10px;">
                            <center><u><b>____________________</b></u><br>College Dean</center>
                        </div>
                    </div>
                </td>
                <td colspan="4" class="border2 p-3">
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
            </tbody>
        </table>
    </div>
</body>

</html>
