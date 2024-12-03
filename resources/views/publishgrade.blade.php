@include('templates.principalheader')

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<div id="main">
    <div class="w3-teal">
        <button id="openNav" class="w3-button w3-teal w3-xlarge" onclick="w3_open()">&#9776;</button>
        <div class="w3-container">
            <h1>Publish Grades</h1>
        </div>
    </div>

    <div class="w3-sidebar w3-bar-block w3-card w3-animate-left" style="display:none" id="mySidebar">
        <button class="w3-bar-item w3-button w3-large" onclick="w3_close()">Close &times;</button>
        <a href="/principal" class="w3-bar-item w3-button">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-house-check-fill" viewBox="0 0 16 16">
                <path d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L8 2.207l6.646 6.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293z" />
                <path d="m8 3.293 4.712 4.712A4.5 4.5 0 0 0 8.758 15H3.5A1.5 1.5 0 0 1 2 13.5V9.293z" />
                <path d="m12.5 16 a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7m1.679-4.493-1.335 2.226a.75.75 0 0 1-1.174.144l-.774-.773a.5.5 0 0 1 .708-.707l.547.547 1.17-1.951a.5.5 0 1 1 .858.514" />
            </svg>
        </a>
    </div>

    <div class="container mt-4">
        
            <div class="input-group mb-3">
                <input type="text" id="searchInput" class="form-control" name="query"
                    placeholder="Search grades..." aria-label="Search grades"
                    aria-describedby="button-addon2" value="{{ request()->input('query') }}">
                <button class="btn btn-outline-secondary" type="submit" id="button-addon2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-search" viewBox="0 0 16 16">
                        <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                    </svg>
                    Search
                </button>
            </div>

            <div class="input-group mb-3">
                <a href="javascript:void(0);" class="btn btn-outline-secondary" onclick="location.reload();">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-arrow-clockwise" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M8 3a5 5 0 1 0 4.546 2.914.5.5 0 0 1 .908-.417A6 6 0 1 1 8 2v1z" />
                        <path d="M8 4.466V.534a.25.25 0 0 1 .41-.192l2.36 1.966c.12.1.12.284 0 .384L8.41 4.658A.25.25 0 0 1 8 4.466z" />
                    </svg>
                    Refresh
                </a>
            </div>
     

        <form action="{{ route('publishgrade.post') }}" method="POST" id="publishGradesForm">
            @csrf
            @foreach ($grades as $grade)
            <input type="hidden" name="grade_id[]" value="{{ $grade->grade_id }}">
            @endforeach
            <button type="submit" class="btn btn-success mb-3">Publish Grades</button>
        </form>

        <div class="mb-3">
            <a href="javascript:history.back()" class="btn btn-secondary">Back</a>
        </div>
        
        <div class="table-responsive">
            <table class="table table-striped table-hover" id="gradesTable">
                <thead class="thead-light">
                    <tr>
                        <th>Student Name</th>
                        <th>Section</th>
                        <th>Subject</th>
                        <th>EDP Code</th>
                        <th>1st Quarter</th>
                        <th>2nd Quarter</th>
                        <th>3rd Quarter</th>
                        <th>4th Quarter</th>
                        <th>Overall Grade</th>
                        <th>Status</th>
                    </tr> 
                </thead>
                <tbody>
                    @foreach($grades as $grade)
                    <tr>
                        <td>{{ $grade->fullname }}</td>
                        <td>{{ $grade->section }}</td>
                        <td>{{ $grade->subject }}</td>
                        <td>{{ $grade->edp_code }}</td>
                        <td>{{ $grade->{'1st_quarter'} ?? 'N/A' }}</td>
                        <td>{{ $grade->{'2nd_quarter'} ?? 'N/A' }}</td>
                        <td>{{ $grade->{'3rd_quarter'} ?? 'N/A' }}</td>
                        <td>{{ $grade->{'4th_quarter'} ?? 'N/A' }}</td>
                        <td>{{ $grade->overall_grade ?? 'N/A' }}</td>
                        <td>{{ $grade->status }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    document.getElementById('searchInput').addEventListener('keyup', function() {
        const query = this.value.toLowerCase();
        const rows = document.querySelectorAll('#gradesTable tbody tr');

        rows.forEach(row => {
            const cells = row.getElementsByTagName('td');
            let match = false;

            for (let i = 0; i < cells.length; i++) {
                if (cells[i].textContent.toLowerCase().includes(query)) {
                    match = true;
                    break;
                }
            }

            row.style.display = match ? '' : 'none';
        });
    });
</script>

<style>
    body {
        font-family: 'Arial', sans-serif;
        background-color: #f8f9fa;
    }

    .w3-teal {
        background-color: #007bff;
        color: white;
        padding: 15px;
    }

    h1 {
        margin: 0;
        font-size: 24px;
    }

    .container {
        margin-top: 20px;
    }

    .input-group {
        margin-bottom: 20px;
    }

    .table {
        border-radius: 8px;
        overflow: hidden;
    }

    .table th,
    .table td {
        vertical-align: middle;
    }

    .table-striped tbody tr:nth-of-type(odd) {
        background-color: #f2f2f2;
    }

    .table-hover tbody tr:hover {
        background-color: #e9ecef;
    }

    .btn-outline-secondary {
        transition: background-color 0.3s, color 0.3s;
    }

    .btn-outline-secondary:hover {
        background-color: #e0e0e0;
    }

    .btn-success {
        transition: background-color 0.3s, color 0.3s;
    }

    .btn-success:hover {
        background-color: #218838;
    }
</style>

@include('templates.principalfooter')