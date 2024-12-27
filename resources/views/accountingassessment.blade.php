@include('templates.accountingheader')
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f8f9fa;
        margin: 0;
        padding: 0;
    }

    .header-container {
        display: flex; 
        align-items: center; 
        background-color: rgba(8, 16, 66, 1); 
        color:white;
        padding: 10px; 
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.5); 
    }

    #mySidebar {
        display: none;
        position: fixed;
        z-index: 1;
        height: 100%;
        width: 250px;
        top: 0;
        left: 0;
        background-color: #0c3b6d;
        color: white;
        padding-top: 20px;
        padding-left: 15px;
        transition: 0.3s;
        overflow-y: auto;
    }

    #main {
        transition: margin-left .3s;
        padding: 0px;
    }
    h1{
        margin: 0; 
        font-size: 15px;
        text-transform:uppercase;
    }

    .table-striped tbody tr:nth-of-type(odd) {
        background-color: #f9f9f9;
    }

    .btn-primary {
        background-color: #008080;
        border-color: #008080;
    }

    .btn-primary:hover {
        background-color: #006060;
        border-color: #006060;
    }
    .buttoncreate{
        background-color:rgba(48, 150, 14);
        padding:10px;
        font-size:15px;
        color:white;
        text-decoration:none;
        margin-lefT:0.5%;
        border-radius:8px;
        
    }
    .buttoncreate:hover{
        background-color:rgba(37, 89, 20);
        color:white;
    }
    .navvers{
    background-color:rgba(8, 16, 66, 1); 
    border-width:0;
    color:white;
    padding:15px;

}
.navvers:hover{
    color:yellow;
}
    </style>

@php
$monthNames = [
    1 => 'January',
    2 => 'February',
    3 => 'March',
    4 => 'April',
    5 => 'May',
    6 => 'June',
    7 => 'July',
    8 => 'August',
    9 => 'September',
    10 => 'October',
    11 => 'November',
    12 => 'December',
];
@endphp

<div class="header-container">
        <button id="openNav" class="navvers" onclick="w3_open()">&#9776;</button>
        <div class="w3-container" style="margin-left: 15px;">
            <h1>Assessment</h1>
        </div>
    </div>
    <div id="main" onclick="w3_close()">
     

    <br>
    <div class="row mb-3">
        <div class="col">
            <a href="/createassessment" class="buttoncreate">Create Assessment</a>
        </div>
    </div>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>School Year</th>
                <th>Grade Level</th>
                <th>Assessment Name</th>
                <th>Description</th>
                <th>Assessment Date</th>
                <th>Assessment Month</th>
                <th>Assessment Time</th>
                <th>Assessment Fee</th>
                <th>Assessment Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($assessments as $assessment)
                <tr>
                    <td>{{ $assessment->school_year }}</td>
                    <td>{{ $assessment->grade_level }}</td>
                    <td>{{ $assessment->assessment_name }}</td>
                    <td>{{ $assessment->description }}</td>
                    <td>{{ $assessment->assessment_date }}</td>
                    <td>{{ $assessment->month_name }}</td> 
                    <td>{{ $assessment->assessment_time }}</td>
                    <td>{{ $assessment->assessment_fee }}</td>
                    <td>{{ $assessment->status }}</td>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center">No assessments found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@include('templates.accountingfooter')