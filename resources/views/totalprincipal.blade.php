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