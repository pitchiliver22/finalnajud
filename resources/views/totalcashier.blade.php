<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Total Cashiers</title>
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
        <h1>Total Cashiers</h1>

        <p>Total Number of Cashiers: {{ $totalCashiers }}</p>

        <h2>List of Cashiers</h2>
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
                @foreach($cashiers as $cashier)
                    <tr>
                        <td>{{ $cashier->firstname }}</td>
                        <td>{{ $cashier->lastname }}</td>
                        <td>{{ $cashier->middlename }}</td>
                        <td>{{ $cashier->suffix }}</td>
                        <td>{{ $cashier->email }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>