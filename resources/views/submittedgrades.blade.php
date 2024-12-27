@include('templates.principalheader')

<style>
  body {
        font-family: Arial, sans-serif;
        background-color: #f8f9fa; /* Light background */
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
        text-transform:uppercase;
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
        background-color: rgba(132, 128, 194);
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
        background-color:rgba(37, 176, 39);
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
        background-color: rgba(8, 16, 66, 1);
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
    #main{
        padding:10px;
    }
    h4{
        margin-top:10px;
        margin-bottom:3%;
        font-size:22px;
        font-family:'Arial',sans-serif;
    }
    .update{
        background-color:rgba(8, 16, 66, 1);
        color:white;
        padding:5px;
    }
    .update:hover{
        background-color:rgba(38, 29, 168);
    }
    .navvers{
    background-color:rgba(8, 16, 66, 1); 
    border-width:0;
    color:white;
    padding:15px;

}
.navvers:hover{
    color:yellow;
}
    @media (max-width: 320px) {
    .header-container{
            font-size: 12px; /* Adjust font size for mobile */
            padding:20px;
            width:41rem;
         
        }
      .header-container h1{
        margin-left:-70%;
        font-size:15px;
      }
        .navvers{
        position:absolute;
        left:10px;
        top:5px;
        padding:15px;
        }
   
      
    }
  @media (min-width:320px) and (max-width:768px){
    .header-container{
            font-size: 12px; /* Adjust font size for mobile */
            padding:20px;
            width:41rem;
         
        }
      .header-container h1{
        margin-left:-70%;
        font-size:15px;
      }
        .navvers{
        position:absolute;
        left:10px;
        top:5px;
        padding:15px;
        }
 

}
      
</style>
<div class="header-container">
        <button id="openNav" class="navvers" onclick="w3_open(event)">&#9776;</button>
        <h1 style="text-align: center;">Evaluate Grades</h1>
    </div>

    <div id="main" onclick="w3_close()">
    <!-- Container for Managing Quarters -->
    <div class="container">
        <form action="{{ route('update.quarters') }}" method="POST">
            @csrf
            <h4>Manage Quarter Settings</h4>
        
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
        
            {{-- @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif --}}

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
        
            <button type="submit" class="update">Update Quarters</button>
        </form>
    </div>

    <!-- Container for Evaluating Grade Submission -->
    <div class="container">
        <h4>Evaluate Grade Submissions</h4>
        <form action="{{ route('evaluate.grades') }}" method="GET">
            @csrf
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="input-group mr-3">
                    <input type="text" id="searchInput" class="form-control" name="query"
                    placeholder="Search account entries..." aria-label="Search account entries"
                    aria-describedby="button-addon2" value="{{ request()->input('query') }}">                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary ml-2" type="button" onclick="location.reload();">Refresh Search</button>                    
                    </div>
                </div>
            </div>
    
            <div class="table-responsive">
                <table class="table table-striped" id="searchTable">
                    <thead>
                        <tr>
                            <th>Status</th>
                            <th>Adviser</th>
                            <th>Section</th>
                            <th>Subject</th>
                            <th>Grade Level</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="results"> 
                        @foreach ($assigns as $assign)
                            @php
                                $grade = $grades->firstWhere('subject', $assign->subject);
                            @endphp
                            @if ($grade)
                                <tr>
                                    <td>{{ $grade->status }}</td>
                                    <td>{{ $assign->adviser }}</td>
                                    <td>{{ $assign->section }}</td>
                                    <td>{{ $assign->subject }}</td>
                                    <td>{{ $assign->grade }}</td>
                                    <td>
                                        @php
    $url = route('publishgrade', ['edp_code' => $grade->edp_code, 'subject' => $grade->subject]);
    Log::info('Generated URL for publishgrade: ' . $url);
@endphp

<a href="{{ $url }}" class="btn btn-info btn-sm" title="View">View</a> </td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </form>
    </div>


    <script>
        document.getElementById('searchInput').addEventListener('keyup', function() {
            const query = this.value.toLowerCase();
            const rows = document.querySelectorAll('#searchTable tbody tr');
    
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

@include('templates.principalfooter')