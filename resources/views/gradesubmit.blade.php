
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
        color:white;
        padding: 10px; 
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.5); 
            }

    .nav-button {
        margin-right: 15px; 
        margin-bottom: 4px;
    }

    h1 {
        margin: 0; 
        font-size: 15px;
        text-transform:uppercase;
    }

    .card {
        border: 1px solid #ddd;
        border-radius: 5px;
        margin: 10px;
        padding: 15px;
        background-color: #f9f9f9;
    }

    .card-title {
        color: #0c3b6d;
        font-size: 18px;
    }

    .card-text {
        color: #555;
        line-height: 1.6;
    }

    .btn {
        background-color: #0c3b6d;
        color: white;
        border: none;
        padding: 10px 15px;
        text-decoration: none;
        border-radius: 5px;
        transition: background-color 0.3s;
    }

    .btn:hover {
        background-color: #093d5e;
    }

    .row {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        margin: 20px 0;
    }

    .col-md-6 {
        flex: 0 0 45%; /* Adjusted for responsive design */
        margin: 10px;
    }

    /* Sidebar styles */
    #mySidebar {
        display: none;
        position: fixed;
        z-index: 1;
        height: 100%;
        width: 250px;
        top: 0;
        left: 0;
        background-color: #0c3b6d;
        color: white;
        padding-top: 20px;
        padding-left: 15px;
        transition: 0.3s;
        overflow-y: auto;
    }

    #main {
        transition: margin-left .3s;
        padding: 20px;
    }
    .submitg{
        background-color:#0c3b6d;
        color:white;
        padding:10px;
        border-width:0;
        border-radius:5px;
    }
    .download{
        background-color:#0c3b6d;
        color:white;
        padding:12px;
        text-decoration:none;
        border-width:0;
    }
    .download:hover{
        background-color:#150e5e;
        color:white;
    }
    .import{
        background-color:#0c3b6d;
        color:white;
        padding:12px;
        text-decoration:none;
        border-width:0;
    }
    .import:hover{
        background-color:#150e5e;
        color:white;
    }
    .submitg{
        background-color:#0c3b6d;
        color:white;
        padding:12px;
        text-decoration:none;
        border-width:0;
    }
    .submitg:hover{
        background-color:#150e5e;
        color:white;
    }
    .submitgg{
        background-color:#0c3b6d;
        color:white;
        padding:12px;
        text-decoration:none;
        border-width:0;
       
        
    }
    .submitgg:hover{
        background-color:#150e5e;
        color:white;
    }
</style>


<div class="header-container"> 
    <button id="openNav" class="w3-button w3-xlarge nav-button" onclick="w3_open(event)">&#9776;</button>
    <h1>Teacher Grade Submission</h1>
    <div class="w3-container" style="margin-left: auto;">
        <label>{{ auth()->user()->firstname }}</label>
    </div>
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

    <div class="container" style="width: 80%; height: auto; border: 1px solid #ccc; padding: 20px;">
        <form action="{{ route('grades.import') }}" method="POST" enctype="multipart/form-data">                        
            @csrf
            <div class="mb-3">
                <input type="hidden" name="edpcode" value="{{ $edpcode }}">
                <label for="excelFile" class="form-label">Import Grades (Excel file)</label>
                <input type="file" class="form-control" id="excelFile" name="excel_file" accept=".xls,.xlsx" required>
            </div>
            
            <button type="submit" class="import">Import</button>
        </form>
        <br>
    
        <a href="{{ route('grades.template', ['edp_code' => $edpcode]) }}" class="download">Download Grades Template</a>
        
        <br><br>
        <form action="{{ route('gradesubmitpost') }}" method="POST">            
            @csrf
    
            @foreach ($students as $index => $student)
                <input type="hidden" name="edp_code[]" value="{{ old('edp_code.' . $index, $edpcode) }}">
                <input type="hidden" name="subject[]" value="{{ old('subject.' . $index, $subject) }}">
                <input type="hidden" name="grade_id[]" value="{{ old('grade_id.' . $index, $studentClassIds[$student->id] ?? '') }}">
                <input type="hidden" name="fullname[]" value="{{ old('fullname.' . $index, $student->firstname . ' ' . $student->middlename . ' ' . $student->lastname) }}">
                <input type="hidden" name="section[]" value="{{ old('section.' . $index, $section) }}">
            @endforeach
    
            <div class="fee-list">
                <h4><strong>EDPCODE: {{ $edpcode }}, SUBJECT: {{ $subject }}, GRADE LEVEL: {{ $paymentForm->level ?? 'N/A' }}</strong></h4>
                <div class="table-responsive">
                    <table class="table table-striped" id="student-table">
                        <thead>
                            <tr>
                                <th>Fullname</th>
                                <th>Section</th>
                                @if ($quartersEnabled['1st_quarter']) <th>1st Quarter</th> @endif
                                @if ($quartersEnabled['2nd_quarter']) <th>2nd Quarter</th> @endif
                                @if ($quartersEnabled['3rd_quarter']) <th>3rd Quarter</th> @endif
                                @if ($quartersEnabled['4th_quarter']) <th>4th Quarter</th> @endif
                                <th>Overall Grade</th>
                            </tr>

                        </thead>
                        <tbody>
                            @foreach ($students as $index => $student)
                                <tr>
                                    <td>{{ $student->firstname }} {{ $student->middlename }} {{ $student->lastname }}</td>
                                    <td>{{ $section }}</td>
    
                                    @if ($quartersEnabled['1st_quarter'])
                                        <td>
                                            <input type="number" class="form-control" 
                                                   name="grades[{{ $index }}][1st_quarter]" 
                                                   min="0" max="100" 
                                                   step="0.01" 
                                                   oninput="calculateOverall(this)" 
                                                   value="{{ $importedGrades[$student->grade_id]['1st_quarter'] ?? '' }}" 
                                            >
                                        </td>
                                    @endif
    
                                    @if ($quartersEnabled['2nd_quarter'])
                                        <td>
                                            <input type="number" class="form-control" 
                                                   name="grades[{{ $index }}][2nd_quarter]" 
                                                   min="0" max="100" 
                                                   step="0.01" 
                                                   oninput="calculateOverall(this)" 
                                                   value="{{ $importedGrades[$student->grade_id]['2nd_quarter'] ?? '' }}" 
                                            >
                                        </td>
                                    @endif
    
                                    @if ($quartersEnabled['3rd_quarter'])
                                        <td>
                                            <input type="number" class="form-control" 
                                                   name="grades[{{ $index }}][3rd_quarter]" 
                                                   min="0" max="100" 
                                                   step="0.01" 
                                                   oninput="calculateOverall(this)" 
                                                   value="{{ $importedGrades[$student->grade_id]['3rd_quarter'] ?? '' }}" 
                                            >
                                        </td>
                                    @endif
    
                                    @if ($quartersEnabled['4th_quarter'])
                                        <td>
                                            <input type="number" class="form-control" 
                                                   name="grades[{{ $index }}][4th_quarter]" 
                                                   min="0" max="100" 
                                                   step="0.01" 
                                                   oninput="calculateOverall(this)" 
                                                   value="{{ $importedGrades[$student->grade_id]['4th_quarter'] ?? '' }}" 
                                            >
                                        </td>
                                    @endif
    
                                    <td>    
                                        <input type="number" class="form-control" name="grades[{{ $index }}][overall_grade]" 
                                               min="0" max="100" 
                                               step="0.01" 
                                               value="{{ $importedGrades[$student->grade_id]['overall_grade'] ?? '' }}" 
                                               readonly 
                                        >
                                    </td>
                                   
                                </tr>

                                
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        
            <div class="hidden-center">
                <button type="submit" name="submit" class="submitg">Submit Grades</button>
            </div>
            <br>
            <div class="hidden-center">
                <a href="{{ route('display.grade', ['edpcode' => $edpcode]) }}">
                    <button type="button" name="button" class="submitgg">Review Submitted Grades</button>
                </a>
            </div>
        </form>
    </div>
</div>

<script>
    function calculateOverall(input) {
        const row = input.closest('tr');
        const quarterInputs = row.querySelectorAll('input[type="number"][name*="quarter"]');
        let total = 0;
        let count = 0;

        quarterInputs.forEach(quarterInput => {
            const value = parseFloat(quarterInput.value);
            if (!isNaN(value)) {
                total += value;
                count++;
            }
        });

        const overallGrade = count ? (total / count) : 0;
        const overallGradeInput = row.querySelector('input[name*="[overall_grade]"]');
        overallGradeInput.value = overallGrade.toFixed(2);
    }

    document.querySelectorAll('input[type="number"]').forEach(input => {
        input.addEventListener('input', function() {
            calculateOverall(input);
        });
    });
</script>

@include('templates.teacherfooter')

<script>
    function calculateOverall(row) {
        const quarterInputs = row.closest('tr').querySelectorAll('input[type="number"]');
        let total = 0;
        let count = 0;

        quarterInputs.forEach(input => {
            if (input.name.includes('quarter') && input.value) {
                total += parseFloat(input.value);
                count++;
            }
        });

        const overallGrade = count ? (total / count) : 0;

        const overallGradeInput = row.closest('tr').querySelector('input[name$="[overall_grade]"]');
        overallGradeInput.value = overallGrade.toFixed(2);
    }

    document.querySelectorAll('input[type="number"]').forEach(input => {
        input.addEventListener('input', function() {
            calculateOverall(input);
        });
    });
</script>

@include('templates.teacherfooter')