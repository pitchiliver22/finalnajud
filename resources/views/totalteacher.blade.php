<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Total Teachers</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            padding: 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <div class="container">
        <a href="adminreport" class="btn btn-secondary">
            Back
        </a>
        <h1>Total Teachers</h1>
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
                @foreach($teachers as $teacher)
                    <tr>
                        <td>{{ $teacher->firstname }}</td>
                        <td>{{ $teacher->lastname }}</td>
                        <td>{{ $teacher->middlename }}</td>
                        <td>{{ $teacher->suffix }}</td>
                        <td>{{ $teacher->role }}</td>
                        <td>{{ $teacher->email }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <p>Total Number of Teachers: {{ count($teachers) }}</p>
    </div>
</body>
</html>