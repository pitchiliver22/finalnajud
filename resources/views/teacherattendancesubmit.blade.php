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
    
    .header-container h1 {
        margin: 0; 
        font-size: 15px;
        text-transform:uppercase;
    }
    
        </style>
<div class="header-container">
<button id="openNav" class="w3-button w3-xlarge" onclick="w3_open()">&#9776;</button>
            <h1>Teacher Attendance - EDPCODE: {{ $edpcode }}</h1>
        </div>
        <div id="main" onclick="w3_close()">

    <div class="container" style="width: 80%; height: auto; border: 1px solid #ccc; padding: 20px;">
        <form action="/teacherattendance" method="POST">
            @csrf
            @foreach ($students as $index => $studentDetail)
                <input type="hidden" name="grade_level[]" value="{{ old('grade_level.' . $index, $studentDetail['grade_level']) }}">
                <input type="hidden" name="fullname[]" value="{{ old('fullname.' . $index, "{$studentDetail['student']->firstname} {$studentDetail['student']->middlename} {$studentDetail['student']->lastname}") }}">
                <input type="hidden" name="section[]" value="{{ old('section.' . $index, $studentDetail['section']) }}">
                <input type="hidden" name="subject[]" value="{{ old('subject.' . $index, $studentDetail['subject'] ?? '') }}">
                <input type="hidden" name="edp_code[]" value="{{ old('edp_code.' . $index, $studentDetail['edpcode'] ?? '') }}">
                <input type="hidden" name="attendance_id[]" value="{{ old('attendance_id.' . $index, $studentClassIds[$studentDetail['student']->id] ?? 'N/A') }}">
            @endforeach
            
            <div class="fee-list">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="card-title">Student Attendance</h4>
                    <div class="d-flex">
                        <div class="input-group mr-3">
                            <input type="text" class="form-control" placeholder="Search by EDP Code..." aria-label="Search" name="search" id="search-input">
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" type="button" onclick="searchByEdpCode()">Search</button>
                            </div>
                        </div>
                        <button type="button" class="btn btn-outline-secondary" onclick="refreshPage()">Refresh</button>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped table-hover" id="student-table">
                        <thead>
                            <tr>
                                <th>Full Name</th>
                                <th>Section</th>
                                <th>Grade Level</th>
                                <th>EDP Code</th>
                                <th>Subject</th>
                                <th>1st Quarter</th>
                                <th>2nd Quarter</th>
                                <th>3rd Quarter</th>
                                <th>4th Quarter</th>
                                <th>Overall Attendance</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($students as $studentDetail)
                                <tr>
                                    <td>{{ "{$studentDetail['student']->firstname} {$studentDetail['student']->middlename} {$studentDetail['student']->lastname}" }}</td>
                                    <td>{{ $studentDetail['section'] }}</td>
                                    <td>{{ $studentDetail['grade_level'] }}</td>
                                    <td>{{ $studentDetail['edpcode'] }}</td>
                                    <td>{{ $studentDetail['subject'] }}</td>
                                    <td>
                                        <input type="number" class="form-control" 
                                               value="{{ old('1st_quarter.' . $studentDetail['student']->id, $studentClassIds[$studentDetail['student']->id]['1st_quarter'] ?? 0) }}" 
                                               name="1st_quarter[{{ $studentDetail['student']->id }}]" 
                                               oninput="calculateOverallAttendance(this)" 
                                               required>
                                    </td>
                                    <td>
                                        <input type="number" class="form-control" 
                                               value="{{ old('2nd_quarter.' . $studentDetail['student']->id, $studentClassIds[$studentDetail['student']->id]['2nd_quarter'] ?? 0) }}" 
                                               name="2nd_quarter[{{ $studentDetail['student']->id }}]" 
                                               oninput="calculateOverallAttendance(this)" 
                                               required>
                                    </td>
                                    <td>
                                        <input type="number" class="form-control" 
                                               value="{{ old('3rd_quarter.' . $studentDetail['student']->id, $studentClassIds[$studentDetail['student']->id]['3rd_quarter'] ?? 0) }}" 
                                               name="3rd_quarter[{{ $studentDetail['student']->id }}]" 
                                               oninput="calculateOverallAttendance(this)" 
                                               required>
                                    </td>
                                    <td>
                                        <input type="number" class="form-control" 
                                               value="{{ old('4th_quarter.' . $studentDetail['student']->id, $studentClassIds[$studentDetail['student']->id]['4th_quarter'] ?? 0) }}" 
                                               name="4th_quarter[{{ $studentDetail['student']->id }}]" 
                                               oninput="calculateOverallAttendance(this)" 
                                               required>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" 
                                               value="{{ old('overall_attendance.' . $studentDetail['student']->id, $studentClassIds[$studentDetail['student']->id]['overall_attendance'] ?? 0) }}" 
                                               name="overall_attendance[{{ $studentDetail['student']->id }}]" readonly>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="text-center">
                <button type="submit" name="submit" class="btn btn-success btn-lg">Save Attendance</button>
            </div>
        </form>
    </div>
</div>

<script>
    function searchByEdpCode() {
        var searchInput = document.getElementById("search-input").value.toLowerCase();
        var studentTable = document.getElementById("student-table");
        var rows = studentTable.getElementsByTagName("tr");

        for (var i = 1; i < rows.length; i++) {
            var edpCodeCell = rows[i].getElementsByTagName("td")[3]; // Adjusted for EDP code column (index 3)
            if (edpCodeCell) {
                var edpCode = edpCodeCell.textContent.toLowerCase();
                rows[i].style.display = edpCode.includes(searchInput) ? "" : "none";
            }
        }
    }

    function refreshPage() {
        location.reload();
    }

    function calculateOverallAttendance(input) {
        var row = input.closest('tr');
        var firstQuarter = parseFloat(row.cells[5].getElementsByTagName('input')[0].value) || 0;
        var secondQuarter = parseFloat(row.cells[6].getElementsByTagName('input')[0].value) || 0;
        var thirdQuarter = parseFloat(row.cells[7].getElementsByTagName('input')[0].value) || 0;
        var fourthQuarter = parseFloat(row.cells[8].getElementsByTagName('input')[0].value) || 0;

        var overallAttendance = firstQuarter + secondQuarter + thirdQuarter + fourthQuarter;
        row.cells[9].getElementsByTagName('input')[0].value = overallAttendance; // Set the overall attendance input
    }
</script>

@include('templates.teacherfooter')