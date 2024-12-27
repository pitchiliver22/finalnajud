<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Total Students Report</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            padding: 0;
            background-color: #f9f9f9;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        h1, h2 {
            color: #333;
            text-align: center;
        }
        h1 {
            border-bottom: 2px solid #007bff;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        p {
            text-align: center;
            font-size: 18px;
            margin-bottom: 30px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: center;
        }
        th {
            background-color: #007bff;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #d1ecf1;
        }
        .btn {
            display: inline-block;
            padding: 10px 20px;
            margin: 10px;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            color: white;
            background-color: #007bff;
            transition: background-color 0.3s;
        }
        .btn-secondary {
            background-color: #6c757d; /* Gray for the Back button */
        }
        .btn:hover {
            background-color: #0056b3;
        }
        .btn-secondary:hover {
            background-color: #5a6268;
        }
    </style>
</head>
<body>
    <div class="container">
        <a href="{{ url('adminreport') }}" class="btn btn-secondary">Back</a>

        <h1>Total Students Report</h1>

        <p>Total Number of Students: {{ count($oldStudents) + count($newStudents) }}</p>

        <h2>Old Students</h2>
        <table>
            <thead>
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Middle Name</th>
                    <th>Suffix</th>
                    <th>Role</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody>
                @foreach($oldStudents as $student)
                    <tr>
                        <td>{{ $student->firstname }}</td>
                        <td>{{ $student->lastname }}</td>
                        <td>{{ $student->middlename }}</td>
                        <td>{{ $student->suffix }}</td>
                        <td>{{ $student->role }}</td>
                        <td>{{ $student->email }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <h2>New Students</h2>
        <table>
            <thead>
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Middle Name</th>
                    <th>Suffix</th>
                    <th>Role</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody>
                @foreach($newStudents as $student)
                    <tr>
                        <td>{{ $student->firstname }}</td>
                        <td>{{ $student->lastname }}</td>
                        <td>{{ $student->middlename }}</td>
                        <td>{{ $student->suffix }}</td>
                        <td>{{ $student->role }}</td>
                        <td>{{ $student->email }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <br>
        <div style="text-align: center;">
            <a href="{{ route('student.report') }}" class="btn">Generate PDF Report</a>
        </div>
    </div>
</body>
</html>