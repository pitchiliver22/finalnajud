<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Total Principals</title>
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
        h1 {
            color: #333;
            text-align: center;
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
        <div style="text-align: center;">
            <a href="{{ url('adminreport') }}" class="btn btn-secondary">Back</a>
            <a href="{{ route('principal.report') }}" class="btn">Generate Report</a>
        </div>

        <h1>Total Principals</h1>

        <p>Total Number of Principals: {{ $totalPrincipal }}</p>

        <h2>List of Principals</h2>
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
                @foreach($principals as $principal)
                    <tr>
                        <td>{{ $principal->firstname }}</td>
                        <td>{{ $principal->lastname }}</td>
                        <td>{{ $principal->middlename }}</td>
                        <td>{{ $principal->suffix }}</td>
                        <td>{{ $principal->email }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>