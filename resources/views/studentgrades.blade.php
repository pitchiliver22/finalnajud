@include('templates.studentheader')

<div id="main">
    <div class="w3-teal">
        <button id="openNav" class="w3-button w3-teal w3-xlarge" onclick="w3_open()">&#9776;</button>
        <div class="w3-container">
            <h1>Student Grades</h1>
        </div>
    </div>

    <h2>Grades S.Y 2024-2025</h2>
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
                        <td>General Average</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>{{ number_format($grades->avg('overall_grade'), 2) }}</td>
                    </tr>
                </tbody>
            </table>
        @else
            <div class="alert alert-warning mt-3">
                <strong>Notice:</strong> Your grades are currently under evaluation by the principal. Please check back
                later.
            </div>
        @endif
    </form>
</div>

<style>
    .table-primary {
        width: 100%;
        border-collapse: collapse;
        background-color: #f2f2f2;
        margin-top: 20px;
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

    .alert {
        padding: 15px;
        background-color: #f9edbe;
        color: #856404;
        border: 1px solid #ffeeba;
        border-radius: 5px;
    }
</style>

@include('templates.studentfooter')
