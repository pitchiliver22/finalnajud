@include('templates.oldstudentheader')

<style>
    body {
        background-color: #f8f9fa;
        font-family: Arial, sans-serif;
    }

    .form-container {
        background: white;
        padding: 2rem;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        max-width: 600px; /* Set a max width for the form */
        margin: auto; /* Center the form */
    }

    .w3-container h1 {
    color: black; /* Change to black */
    text-align: center; /* Center align */
}
    .header-container {
        display: flex; 
        align-items: center; 
        background-color: rgba(8, 16, 66, 1); 
        color:white;
        padding: 10px; 
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.5); 
}
.form-container {
        background: white;
        padding: 1rem;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        max-width: 100%; /* Set a max width for the form */
        margin: 10px auto; /* Center the form with margin */
    }
    .text-center{
        background-color:rgba(8, 16, 66, 1);
        padding:10px;
        color:white;
        font-size: 24px;
      
      
    }

    .header-container h1{
        margin: 0; 
        font-size: 15px;
        text-transform:uppercase;
    }

    .form-group {
        margin-bottom: 1.5rem; /* Increase space between form groups */
    }

    label {
        font-weight: bold; /* Make labels bold */
    }

    .assessment-list-container {
        margin-top: 20px; /* Add spacing above the assessment list */
        display: flex;
        flex-direction: column;
        gap: 15px; /* Space between assessment cards */
    }

    .assessment-card {
        background-color: #ffffff; /* White background for cards */
        border: 1px solid #ddd; /* Light border */
        border-radius: 8px;
        padding: 15px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .assessment-card h3 {
        margin-top: 0; /* Remove default margin for h3 */
        color: #00796b; /* Teal color for assessment name */
    }

    .btn {
        width: 100%; /* Make the button full width */
        padding: 10px; /* Increase button padding */
        background-color: #00796b; /* Teal background */
        color: white; /* White text */
        border: none; /* Remove border */
        border-radius: 5px; /* Rounded corners */
        cursor: pointer; /* Pointer on hover */
        transition: background-color 0.3s;
    }

    .btn:hover {
        background-color: #004d40; /* Darker teal on hover */
    }

    .alert {
        padding: 10px;
        margin: 20px 0;
        border-radius: 5px;
        color: #333;
        background-color: #f9f9f9;
        border: 1px solid #ddd;
    }

    .alert-warning {
        border-color: #ffc107;
        background-color: #fff3cd;
    }

    .alert-info {
        border-color: #17a2b8;
        background-color: #d1ecf1;
    }

    @media (max-width: 768px) {
        .assessment-card {
            padding: 10px; /* Reduce padding for smaller screens */
        }
        
        .assessment-card h3 {
            font-size: 18px; /* Adjust heading size */
        }
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
@media (max-width: 320px) {
        .header-container{
            font-size: 12px; /* Adjust font size for mobile */
            padding:20px;
            width:41rem;
         
        }
      .header-container h1{
        margin-left:-70%;
      }
        .navvers{
        position:absolute;
        left:10px;
        top:5px;
        }
     
     

    }
    @media (min-width: 320px) and (max-width:768px) {
        .header-container{
            font-size: 12px; /* Adjust font size for mobile */
            padding:20px;
            width:41rem;
    
         
        }
        .header-container h1{
            margin-left:-70%;
        }
        .navvers{
        position:absolute;
        left:10px;
        top:5px;
        }
   
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

<body>
    
<div class="header-container">
        <button id="openNav" class="navvers" onclick="w3_open(event)">&#9776;</button>
            <h1>Assessment</h1>
       
    </div>
    <div id="main" onclick="w3_close()">

    <div class="container d-flex justify-content-center align-items-start" style="min-height: 80vh;">
        <div class="form-container">
            <h1 class="text-center">View Assessments</h1>

            <form method="GET" action="/oldstudentassessment" class="assessment-form">
                <div class="form-group">
                    <label for="school_year">Select School Year:</label>
                    <select id="school_year" name="school_year" onchange="this.form.submit()" required>
                        <option value="">All</option>
                        @foreach($schoolYears as $year)
                            <option value="{{ $year }}" {{ request('school_year') == $year ? 'selected' : '' }}>
                                {{ $year }}
                            </option>
                        @endforeach
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="month">Select Month:</label>
                    <select id="month" name="month" onchange="this.form.submit()">
                        <option value="">All</option>
                        @foreach(range(1, 12) as $month)
                            <option value="{{ $month }}" {{ request('month') == $month ? 'selected' : '' }}>
                                {{ date('F', mktime(0, 0, 0, $month, 1)) }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </form>

            <div class="assessment-list-container">
                @if(request('school_year'))
                    @if($assessments->isEmpty())
                        <div class="alert alert-warning">No assessments available for the selected school year.</div>
                    @else
                        @foreach($assessments as $assessment)
                            <div class="assessment-card">
                                <h3><strong>Assessment Name: </strong>{{ $assessment->assessment_name }}</h3>
                                <p><strong>School Year:</strong> {{ $assessment->school_year }}</p>
                                <p><strong>Grade Level:</strong> {{ $assessment->grade_level }}</p>
                                <p><strong>Description:</strong> {{ $assessment->description }}</p>
                                <p><strong>Assessment Date:</strong> {{ $assessment->assessment_date }}</p>
                                <p><strong>Assessment Month:</strong> {{ $assessment->month_name }}</p>
                                <p><strong>Assessment Time:</strong> {{ $assessment->assessment_time }}</p>
                                <p><strong>Assessment Fee:</strong> Php {{ number_format($assessment->assessment_fee, 2) }}</p>
                            </div>
                        @endforeach
                    @endif
                @else
                    <div class="alert alert-info">Please select a school year to view assessments.</div>
                @endif
            </div>
        </div>
    </div>
</div>

@include('templates.oldstudentfooter')