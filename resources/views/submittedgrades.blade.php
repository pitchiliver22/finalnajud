@include('templates.principalheader')

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
        margin-bottom: 20px;
    }

    h1 {
        color: white;
        margin: 0;
        font-size: 2.5rem;
    }

    .container {
        width: 80%;
        margin: auto; /* Centering the container */
        background-color: white;
        border: 1px solid #ccc;
        border-radius: 0.5rem;
        box-shadow: 0 1rem 3rem rgba(0, 0, 0, 0.1);
        padding: 20px;
        margin-bottom: 20px; /* Spacing between sections */
    }

    h4 {
        margin-top: 20px;
        color: #343a40;
        font-size: 1.5rem;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .alert {
        padding: 15px;
        background-color: #f9edbe;
        color: #856404;
        border: 1px solid #ffeeba;
        border-radius: 5px;
        margin-top: 10px;
        text-align: center;
    }

    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
    }

    .btn-info {
        background-color: #17a2b8;
        border-color: #17a2b8;
    }

    .toggle-switch {
        position: relative;
        display: inline-block;
        width: 60px;
        height: 34px;
    }

    .toggle-switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        transition: .4s;
        border-radius: 34px;
    }

    .slider:before {
        position: absolute;
        content: "";
        height: 26px;
        width: 26px;
        left: 4px;
        bottom: 4px;
        background-color: white;
        transition: .4s;
        border-radius: 50%;
    }

    input:checked + .slider {
        background-color: #007bff;
    }

    input:checked + .slider:before {
        transform: translateX(26px);
    }

    .table {
        margin-top: 20px;
        width: 100%;
        border-collapse: collapse;
    }

    .table th, .table td {
        padding: 12px;
        text-align: left;
    }

    .table th {
        background-color: #4CAF50;
        color: white;
        text-transform: uppercase;
    }

    .table-striped tbody tr:nth-of-type(odd) {
        background-color: #f2f2f2; /* Stripe effect */
    }

    .table-responsive {
        overflow-x: auto; /* Allow horizontal scroll */
    }

    /* Responsive adjustments */
    @media (max-width: 600px) {
        .container {
            width: 100%; /* Full width on small screens */
        }
    }
</style>

<div id="main">
    <div class="w3-teal">
        <button id="openNav" class="w3-button w3-teal w3-xlarge" onclick="w3_open()">&#9776;</button>
        <h1 style="text-align: center;">Evaluate Grades</h1>
    </div>

    <!-- Container for Managing Quarters -->
    <div class="container">
        <form action="{{ route('update.quarters') }}" method="POST">
            @csrf
            <h4>Manage Quarter Settings</h4>
        
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
        
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="form-group">
                <label class="toggle-switch">
                    <input type="checkbox" name="1st_quarter_enabled" value="1" {{ $quartersEnabled['1st_quarter'] ? 'checked' : '' }}>
                    <span class="slider"></span>
                </label>
                1st Quarter Enabled
            </div>
        
            <div class="form-group">
                <label class="toggle-switch">
                    <input type="checkbox" name="2nd_quarter_enabled" value="1" {{ $quartersEnabled['2nd_quarter'] ? 'checked' : '' }}>
                    <span class="slider"></span>
                </label>
                2nd Quarter Enabled
            </div>
        
            <div class="form-group">
                <label class="toggle-switch">
                    <input type="checkbox" name="3rd_quarter_enabled" value="1" {{ $quartersEnabled['3rd_quarter'] ? 'checked' : '' }}>
                    <span class="slider"></span>
                </label>
                3rd Quarter Enabled
            </div>
        
            <div class="form-group">
                <label class="toggle-switch">
                    <input type="checkbox" name="4th_quarter_enabled" value="1" {{ $quartersEnabled['4th_quarter'] ? 'checked' : '' }}>
                    <span class="slider"></span>
                </label>
                4th Quarter Enabled
            </div>
        
            <div class="form-group">
                <label for="quarter_status">Quarter Status</label>
                <select name="quarter_status" class="form-control" required>
                    <option value="" disabled selected>Select Status</option>
                    <option value="active" {{ $quarterSettings->quarter_status === 'active' ? 'selected' : '' }}>Active</option>
                    <option value="inactive" {{ $quarterSettings->quarter_status === 'inactive' ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>
        
            <button type="submit" class="btn btn-primary">Update Quarters</button>
        </form>
    </div>

    <!-- Container for Evaluating Grade Submission -->
    <div class="container">
        <h4>Evaluate Grade Submissions</h4>
        <form action="#" method="GET">
            @csrf
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="input-group mr-3">
                    <input type="text" class="form-control" placeholder="Search..." aria-label="Search" name="search">
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="submit">Refresh Search</button>
                    </div>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Status</th>
                            <th>Adviser</th>
                            <th>Subject</th>
                            <th>Section</th>
                            <th>Grade Level</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($assigns as $assign)
                            @php
                                $grade = $grades->firstWhere('id', $assign->id);
                            @endphp

                            <tr>
                                <td>{{ $grade ? $grade->status : 'pending' }}</td>
                                <td>{{ $assign->adviser }}</td>
                                <td>{{ $assign->subject }}</td>
                                <td>{{ $assign->section }}</td>
                                <td>{{ $assign->grade }}</td>
                                <td>
                                    <a href="/publishgrade/{{ $assign->id }}" class="btn btn-info btn-sm" title="View">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                            <path d="M7.998 2c-2.757 0-5.287 1.417-6.758 3.75a.748.748 0 0 0 0 .5c1.471 2.333 4.001 3.75 6.758 3.75s5.287-1.417 6.758-3.75a.748.748 0 0 0 0-.5c-1.471-2.333-4.001-3.75-6.758-3.75zm0 1.5a3.75 3.75 0 1 1 0 7.5 3.75 3.75 0 0 1 0-7.5zm0 2a1.75 1.75 0 1 0 0 3.5 1.75 1.75 0 0 0 0-3.5z"/>
                                        </svg>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </form>
    </div>
</div>

@include('templates.principalfooter')