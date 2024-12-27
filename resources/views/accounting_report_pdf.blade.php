<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Total Accounting Staff Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            padding: 0;
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
    </style>
</head>
<body>
    <h1>Total Accounting Staff Report</h1>

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
</body>
</html>