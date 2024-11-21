@include('templates.studentheader')

<style>
    body {
        background-color: #f7f9fc; /* Light background for better contrast */
        font-family: Arial, sans-serif;
    }

    #main {
        padding: 20px;
    }

    .w3-teal {
        background-color: #007bff; /* Teal background */
        padding: 10px;
       
        border-radius: 0.5rem;
        box-shadow: 0 1rem 3rem rgba(0, 0, 0, 0.1);
    }

    h1 {
        color: white;
        margin: 0;
        font-size: 2.5rem;
    }

    h2 {
        margin-top: 20px;
        font-size: 1.75rem;
        color: #343a40;
        text-align: center; /* Centered heading */
    }

    .table-primary {
        width: 100%;
        margin-top: 20px;
        border-collapse: collapse;
        border-radius: 0.5rem;
        overflow: hidden; /* Rounded borders */
        box-shadow: 0 1rem 3rem rgba(0, 0, 0, 0.1);
    }

    .table-primary th,
    .table-primary td {
        padding: 12px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    .table-primary th {
        background-color: #4CAF50;
        color: white;
        text-transform: uppercase; /* Uppercase headers */
    }

    .table-primary tr:hover {
        background-color: #f1f1f1; /* Highlight on hover */
    }

    .alert {
        padding: 15px;
        background-color: #f9edbe;
        color: #856404;
        border: 1px solid #ffeeba;
        border-radius: 5px;
        margin-top: 20px; /* Spacing for alert */
        text-align: center; /* Centered alert message */
    }

    /* Responsive design */
    @media (max-width: 600px) {
        .table-primary th,
        .table-primary td {
            display: block;
            text-align: right;
        }

        .table-primary th {
            text-align: left;
            position: relative;
        }

        .table-primary th::after {
            content: ":";
            position: absolute;
            right: 0;
        }
    }
</style>

<div id="main">
    <div class="w3-teal">
        <button id="openNav" class="w3-button w3-teal w3-xlarge" onclick="w3_open()">&#9776;</button>
        <h2 style="text-align: center;">Grades S.Y 2024-2025</h2>
    </div>

    
    
    <form action="/studentgrades" method="GET">
        @csrf
        @if ($gradesApproved)
            <table class="table-primary">
                <thead>
                    <tr>
                        <th>Subject</th>
                        <th>EDP Code</th>
                        <th>Section</th>
                        <th>1st Quarter</th>
                        <th>2nd Quarter</th>
                        <th>3rd Quarter</th>
                        <th>4th Quarter</th>
                        <th>Final Grade</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($grades as $grade)
                        <tr>
                            <td>{{ $grade->subject }}</td>
                            <td>{{ $grade->edp_code }}</td>
                            <td>{{ $grade->section }}</td>
                            <td>{{ $grade->{'1st_quarter'} }}</td>
                            <td>{{ $grade->{'2nd_quarter'} }}</td>
                            <td>{{ $grade->{'3rd_quarter'} }}</td>
                            <td>{{ $grade->{'4th_quarter'} }}</td>
                            <td>{{ $grade->overall_grade }}</td>
                        </tr>
                    @endforeach
                    <tr>
                        <td><strong>General Average</strong></td>
                        <td colspan="6"></td>
                        <td><strong>{{ number_format($grades->avg('overall_grade'), 2) }}</strong></td>
                    </tr>
                </tbody>
            </table>
        @else
            <div class="alert">
                <strong>Notice:</strong> Your grades are currently under evaluation by the principal. Please check back later.
            </div>
        @endif
    </form>
</div>

@include('templates.studentfooter')