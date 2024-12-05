<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #fff;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        h1 {
            font-size: 24px;
            margin: 0;
        }
        h2 {
            font-size: 20px;
            margin: 5px 0;
            font-weight: normal;
        }
        .info {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }
        .info div {
            width: 48%;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        .table, .table th, .table td {
            border: 1px solid #000;
        }
        .table th, .table td {
            padding: 8px;
            text-align: center;
        }
        .table th {
            background-color: #f2f2f2;
        }
        .section {
            margin-top: 20px;
        }
        .footer {
            margin-top: 30px;
            text-align: right;
        }
    </style>
    <title>Student Report Card</title>
</head>
<body>

    <div class="header">
    
        <h2>Student Report Card</h2>
    </div>

    <div class="info">
        <div>
            <strong>Student Name:</strong> {{ $reportCardData['fullname'] }}<br>
            <strong>Section:</strong> {{ $reportCardData['section'] }}<br>
            <strong>Grade Level:</strong> {{ $reportCardData['grade_level'] }}
        </div>
      
    </div>

    <div class="section">
        <h3>Grades</h3>
        <table class="table">
            <thead>
                <tr>
                    <th>Subject</th>
                    <th>Q1</th>
                    <th>Q2</th>
                    <th>Q3</th>
                    <th>Q4</th>
                    <th>Overall Grade</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($reportCardData['grades'] as $grade)
                    <tr>
                        <td>{{ $grade->subject }}</td>
                        <td>{{ $grade->{'1st_quarter'} }}</td>
                        <td>{{ $grade->{'2nd_quarter'} }}</td>
                        <td>{{ $grade->{'3rd_quarter'} }}</td>
                        <td>{{ $grade->{'4th_quarter'} }}</td>
                        <td>{{ $grade->overall_grade }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="section">
        <h3>Attendance</h3>
        <table class="table">
            <thead>
                <tr>
                    <th>Subject</th>
                    <th>1st Quarter</th>
                    <th>2nd Quarter</th>
                    <th>3rd Quarter</th>
                    <th>4th Quarter</th>
                    <th>Overall Attendance</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($reportCardData['attendance'] as $attendance)
                    <tr>
                        <td>{{ $attendance->subject }}</td>
                        <td>{{ $attendance->{'1st_quarter'} }}</td>
                        <td>{{ $attendance->{'2nd_quarter'} }}</td>
                        <td>{{ $attendance->{'3rd_quarter'} }}</td>
                        <td>{{ $attendance->{'4th_quarter'} }}</td>
                        <td>{{ $attendance->overall_attendance }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="section">
        <h3>Core Values</h3>
        <table class="table">
            <thead>
                <tr>
                    <th>Core Value</th>
                    <th>Score</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Respect</td>
                    <td>{{ $reportCardData['core_values']->respect }}</td>
                </tr>
                <tr>
                    <td>Excellence</td>
                    <td>{{ $reportCardData['core_values']->excellence }}</td>
                </tr>
                <tr>
                    <td>Teamwork</td>
                    <td>{{ $reportCardData['core_values']->teamwork }}</td>
                </tr>
                <tr>
                    <td>Innovation</td>
                    <td>{{ $reportCardData['core_values']->innovation }}</td>
                </tr>
                <tr>
                    <td>Sustainability</td>
                    <td>{{ $reportCardData['core_values']->sustainability }}</td>
                </tr>
            </tbody>
        </table>
    </div>

  

</body>
</html>