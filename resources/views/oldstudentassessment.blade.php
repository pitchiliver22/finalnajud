<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap" rel="stylesheet">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

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
            margin-top: 1%; 
    
            font-size: 17px;
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
    .w3-sidebar {
            background-image: url('image/ucbuild.png');
            background-size: cover;
            background-position: center;
            position: relative;
            color: white;
            width: 220px;
            transition: width 0.3s;
            overflow-y: hidden;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.5);
        }

        .w3-sidebar::after {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(8, 16, 66, 0.9);
            z-index: 1;
        }

        .profile-section,
        .w3-bar-item {
            position: relative;
            z-index: 2;
        }

        .profile-section {
            display: flex;
            flex-direction: column; /* Change to column layout */
            align-items: center; /* Center align items */
            padding: 6px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
        }

        .profile-picture {
            width: 50px;
            height: 58px;
            border-radius: 80%;
            margin-bottom: 5px; /* Space below profile picture */
        }

        .w3-bar-item {
            display: flex;
            align-items: center;
            padding: 10px; /* Add padding for better spacing */
            text-decoration: none;
            transition: color 0.3s; /* Only transition color */
            border-radius: 5px;
            margin-right:15px;
            margin-top:15px;
            font-size: 14px; /* Adjusted font size */
        }

        .w3-bar-item svg {
            width: 15px;
            height: 15px;
            margin-right: 20px; /* Increased space between icon and text */
            transition: fill 0.5s;
        }

        .w3-bar-item:hover svg {
            fill: black;
        }

        .w3-bar-item.w3-button {
            color: rgb(255, 255, 255);
            border: none;
            border-radius: 5px;
            margin-bottom: 2px;
        }

        .w3-bar-item.w3-button:hover {
            background-color: #0004d6;
        }
        .w3-bar-item.active {
        background-color: rgba(240, 252, 126); /* Background color for active link */
        color: rgba(3, 5, 74); /* Text color for active link */
        }
        .profile-section a {
            text-decoration: none; /* No underline */
            color: rgba(203, 209, 208); /* Match text color */
            margin-top: 5px; /* Space above the link */
            font-size: 12px;
        }

        .profile-section a:hover {
            color: white; /* Change color on hover */
        }

        .profile-name {
            font-size: 13px;
            text-transform: uppercase;
        }
        .w3-bar-item.w3-button.w3-large{
            top:-550px;
            left:185px;
            border-radius: 20%; /* Make it round */
            width: 20px; /* Adjust width as needed */
            height: 20px; /* Adjust height as needed */
            display: flex; /* Center the content */
            align-items: center; /* Center vertically */
            justify-content: center; /* Center horizontally */
        }
        .signout{
            margin-top:150px;
        }
     
</style>

<body>
<div class="w3-sidebar w3-bar-block w3-card w3-animate-left" style="display:none" id="mySidebar">
        <div class="profile-section">
            <img src="image/cler.jpg" alt="Profile Picture" class="profile-picture">
            <span class="profile-name">{{ auth()->user()->firstname }} {{ auth()->user()->lastname }}</span>
            <a href="/#">View Profile</a>
        </div>

        <h5>
        <a href="/oldstudentdashboard" class="w3-bar-item w3-button" id="homeLink">
    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-house-check-fill" viewBox="0 0 16 16">
        <path d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L8 2.207l6.646 6.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293z" />
        <path d="m8 3.293 4.712 4.712A4.5 4.5 0 0 0 8.758 15H3.5A1.5 1.5 0 0 1 2 13.5V9.293z" />
        <path d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7m1.679-4.493-1.335 2.226a.75.75 0 0 1-1.174.144l-.774-.773a.5.5 0 0 1 .708-.707l.547.547 1.17-1.951a.5.5 0 1 1 .858.514" />
    </svg> Home
</a>

            <a href="/oldstudentclassload" class="w3-bar-item w3-button" id="classLoadLink">
                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-book" viewBox="0 0 16 16">
                    <path d="M1 2.828c.885-.37 2.154-.769 3.388-.893 1.33-.134 2.458.063 3.112.752v9.746c-.935-.53-2.12-.603-3.213-.493-1.18.12-2.37.461-3.287.811zm7.5-.141c.654-.689 1.782-.886 3.112-.752 1.234.124 2.503.523 3.388.893v9.923c-.918-.35-2.107-.692-3.287-.81-1.094-.111-2.278-.039-3.213.492zM8 1.783C7.015.936 5.587.81 4.287.94c-1.514.153-3.042.672-3.994 1.105A.5.5 0 0 0 0 2.5v11a.5.5 0 0 0 .707.455c.882-.4 2.303-.881 3.68-1.02 1.409-.142 2.59.087 3.223.877a.5.5 0 0 0 .78 0c.633-.79 1.814-1.019 3.222-.877 1.378.139 2.8.62 3.681 1.02A.5.5 0 0 0 16 13.5v-11a.5.5 0 0 0-.293-.455c-.952-.433-2.48-.952-3.994-1.105C10.413.809 8.985.936 8 1.783" />
                </svg> Class Load
            </a>
            <a href="/oldstudentenrollment" class="w3-bar-item w3-button">
                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
                </svg> Enrollment
            </a>
            <a href="/oldstudentgrades" class="w3-bar-item w3-button">
                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-bar-chart-line" viewBox="0 0 16 16">
                    <path d="M11 2a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v12h.5a.5.5 0 0 1 0 1H.5a.5.5 0 0 1 0-1H1v-3a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3h1V7a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v7h1zm1 12h2V2h-2zm-3 0V7H7v7zm-5 0v-3H2v3z"/>
                </svg> Grades
            </a>
            <a href="oldstudentassessment" class="w3-bar-item w3-button active">
                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-credit-card-2-back-fill" viewBox="0 0 16 16">
                    <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v5H0zm11.5 1a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h2a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5zM0 11v1a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-1z" />
                </svg> Assessment
            </a>
            <div class="signout">
            <a href="/logout" class="w3-bar-item w3-button">
                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-box-arrow-left" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M6 12.5a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v2a.5.5 0 0 1-1 0v-2A1.5 1.5 0 0 1 6.5 2h8A1.5 1.5 0 0 1 16 3.5v9a1.5 1.5 0 0 1-1.5 1.5h-8A1.5 1.5 0 0 1 5 12.5v-2a.5.5 0 0 1 1 0z" />
                    <path fill-rule="evenodd" d="M.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L1.707 7.5H10.5a.5.5 0 0 1 0 1H1.707l2.147 2.146a.5.5 0 0 1-.708.708z" />
                </svg> Sign Out
            </a>
    </div>
            <button class="w3-bar-item w3-button w3-large" onclick="w3_close()"> &times;</button>
        </h5>
    </div>
<div id="main" onclick="w3_close()">
    <div class="header-container">
        <button id="openNav" class="w3-button w3-xlarge nav-button" onclick="w3_open(event)">&#9776;</button>
            <h1>Assessment</h1>
       
    </div>

    <div class="test" style="min-height: 80vh;">
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
<script>
    function w3_open(event) {
    event.stopPropagation();
    document.getElementById("mySidebar").style.display = "block";
}

function w3_close() {
    document.getElementById("mySidebar").style.display = "none";
}
</script>

</body>
</html>