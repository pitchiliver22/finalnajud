@include('templates.teacherheader')

<style>
    body {
        font-family: Arial, sans-serif;
        background-color: white;
        margin: 0;
        padding: 0;
    }
    .header-container {
        display: flex; 
        align-items: center; 
        background-color: rgba(8, 16, 66, 1); 
        color: white;
        padding: 10px; 
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.5); 
    }
    h1 {
        margin: 0; 
        font-size: 15px;
        text-transform: uppercase;
    }
    .container {
        width: 80%; 
        height: auto; 
        border: 1px solid #ccc; 
        padding: 20px;
        margin: auto;
    }
    .table {
        width: 100%;
        border-collapse: collapse;
    }
    .table th, .table td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: left;
    }
    .table th {
        background-color: #f2f2f2;
    }
</style>

<div class="header-container"> 
    <button id="openNav" class="w3-button w3-xlarge nav-button" onclick="w3_open(event)">&#9776;</button>
    <h1>Grade Display</h1>
</div>

<div id="main" onclick="w3_close()">
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="container">
        <h4><strong>Displaying Grades for EDP Code: {{ $edpcode }}</strong></h4>
    
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Fullname</th>
                        <th>Section</th>
                        <th>EdpCode</th>
                        <th>Subject</th>
                        <th>1st Quarter</th>
                        <th>2nd Quarter</th>
                        <th>3rd Quarter</th>
                        <th>4th Quarter</th>
                        <th>Overall Grade</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($grades as $grade)
                        <tr>
                            <td>{{ $grade->fullname }}</td>
                            <td>{{ $grade->section }}</td>
                            <td>{{ $grade->edp_code }}</td>
                            <td>{{ $grade->subject }}</td>
                            <td>{{ $grade->{'1st_quarter'} ?? 'N/A' }}</td>
                            <td>{{ $grade->{'2nd_quarter'} ?? 'N/A' }}</td>
                            <td>{{ $grade->{'3rd_quarter'} ?? 'N/A' }}</td>
                            <td>{{ $grade->{'4th_quarter'} ?? 'N/A' }}</td>
                            <td>{{ $grade->overall_grade ?? 'N/A' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="hidden-center">
            <a href="/teacherclassload"><button type="button" name="button" class="submitg">Save</button></a>
            <a href="{{ url()->previous() }}">
                <button type="button" name="button" class="submitg">Back</button>
            </a>
        </div>
    </div>
</div>

@include('templates.teacherfooter')