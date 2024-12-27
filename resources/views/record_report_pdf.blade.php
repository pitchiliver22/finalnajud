<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Record Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }
        h1 {
            color: #333;
            text-align: center;
        }
        p {
            text-align: center;
            font-size: 18px;
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
    <h1>Total Records Report</h1>
    <p>Total Number of Records: {{ $countRecord }}</p>

    <h2>List of Record Users</h2>
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
            @foreach($totalRecord as $record)
                <tr>
                    <td>{{ $record->firstname }}</td>
                    <td>{{ $record->lastname }}</td>
                    <td>{{ $record->middlename }}</td>
                    <td>{{ $record->suffix }}</td>
                    <td>{{ $record->email }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>