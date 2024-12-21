<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Total Accounting Staff</title>
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
        </a>t
        <h1>Total Accounting Staff</h1>

        <p>Total Number of Accounting Staff: {{ $totalAccounting }}</p>

        <h2>List of Accounting Staff</h2>
        <table>
            <thead>
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Middle Name</th>
                    <th>Suffix</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody>
                @foreach($accountingStaff as $staff)
                    <tr>
                        <td>{{ $staff->firstname }}</td>
                        <td>{{ $staff->lastname }}</td>
                        <td>{{ $staff->middlename }}</td>
                        <td>{{ $staff->suffix }}</td>
                        <td>{{ $staff->email }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>