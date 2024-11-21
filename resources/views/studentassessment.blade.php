@include('templates.studentheader')

<div id="main">
    <div class="w3-teal">
        <button id="openNav" class="w3-button w3-teal w3-xlarge" onclick="w3_open()">&#9776;</button>
        <div class="w3-container">
            <h1>Assessments</h1>
        </div>
    </div>

    <div class="w3-container">
        <form method="GET" action="/studentassessment" class="assessment-form">
            <label for="school_year">Select School Year:</label>
            <select id="school_year" name="school_year" onchange="this.form.submit()">
                <option value="">All</option>
                @foreach($schoolYears as $year)
                    <option value="{{ $year }}" {{ request('school_year') == $year ? 'selected' : '' }}>
                        {{ $year }}
                    </option>
                @endforeach
            </select>
        </form>
    </div>

    <div class="w3-container">
        @if(request('school_year'))
            @if($assessments->isEmpty())
                <div class="alert alert-warning">No assessments available for the selected school year.</div>
            @else
                <div class="assessment-table-container">
                    <table class="assessment-table">
                        <thead>
                            <tr>
                                <th>Assessment Name</th>
                                <th>School Year</th>
                                <th>Grade Level</th>
                                <th>Description</th>
                                <th>Assessment Date</th>
                                <th>Assessment Time</th>
                                <th>Assessment Fee</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($assessments as $assessment)
                                <tr>
                                    <td>{{ $assessment->assessment_name }}</td>
                                    <td>{{ $assessment->school_year }}</td>
                                    <td>{{ $assessment->grade_level }}</td>
                                    <td>{{ $assessment->description }}</td>
                                    <td>{{ $assessment->assessment_date }}</td>
                                    <td>{{ $assessment->assessment_time }}</td>
                                    <td>{{ number_format($assessment->assessment_fee, 2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        @else
            <div class="alert alert-info">Please select a school year to view assessments.</div>
        @endif
    </div>
</div>

@include('templates.studentfooter')

<style>
    body {
        background-color: #f4f7f9; /* Light background for better contrast */
        font-family: 'Arial', sans-serif; /* Clean font */
    }

    .assessment-form {
        margin-bottom: 20px;
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
        background-color: #ffffff; /* White background for the form */
        border-radius: 8px;
        padding: 15px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .assessment-form label {
        margin-right: 10px;
        font-weight: bold;
    }

    .assessment-form select {
        padding: 10px;
        border: 1px solid #00796b; /* Teal border */
        border-radius: 5px;
        font-size: 16px;
        outline: none;
        transition: border-color 0.3s;
    }

    .assessment-form select:focus {
        border-color: #004d40; /* Darker teal on focus */
    }

    .assessment-table-container {
        overflow-x: auto; /* Enable horizontal scrolling on small screens */
        margin: 20px 0; /* Add some vertical spacing */
    }

    .assessment-table {
        width: 100%;
        border-collapse: collapse;
        margin: 0 auto; /* Center the table */
        background-color: #ffffff; /* White background for the table */
        border-radius: 8px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .assessment-table th, .assessment-table td {
        border: 1px solid #ddd;
        padding: 12px;
        text-align: left;
        vertical-align: middle; /* Center align vertically */
    }

    .assessment-table th {
        background-color: #00796b; /* Teal header */
        color: white; /* White text for header */
        font-weight: bold;
    }

    .assessment-table tr:nth-child(even) {
        background-color: #f9f9f9; /* Zebra stripe for even rows */
    }

    .assessment-table tr:hover {
        background-color: #e0f2f1; /* Light teal on row hover */
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
        .assessment-table th, .assessment-table td {
            font-size: 14px; /* Adjust font size for smaller screens */
            padding: 8px; /* Reduce padding */
        }
    }
</style>