@include('templates.teacherheader')

<div id="main">
    <div class="w3-teal">
        <button id="openNav" class="w3-button w3-teal w3-xlarge" onclick="w3_open()">&#9776;</button>
        <div class="w3-container">
            <h1>TEACHER GRADE SUBMISSION</h1>
        </div>
    </div>

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
        <form action="" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="file">Import Grades (Excel File)</label>
                <input type="file" class="form-control" name="file" id="file" required>
            </div>
            <button type="submit" class="btn btn-primary">Import Grades</button>
        </form>

     
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
                                                       value="{{ $importedGrades[$index]['grades']['1st_quarter'] ?? '' }}" 
                                                       required>
                                            </td>
                                        @endif
                                        
                                        @if ($quartersEnabled['2nd_quarter'])
                                            <td>
                                                <input type="number" class="form-control" 
                                                       name="grades[{{ $index }}][2nd_quarter]" 
                                                       min="0" max="100" 
                                                       step="0.01" 
                                                       oninput="calculateOverall(this)" 
                                                       value="{{ $importedGrades[$index]['grades']['2nd_quarter'] ?? '' }}" 
                                                       required>
                                            </td>
                                        @endif

                                        @if ($quartersEnabled['3rd_quarter'])
                                            <td>
                                                <input type="number" class="form-control" 
                                                       name="grades[{{ $index }}][3rd_quarter]" 
                                                       min="0" max="100" 
                                                       step="0.01" 
                                                       oninput="calculateOverall(this)" 
                                                       value="{{ $importedGrades[$index]['grades']['3rd_quarter'] ?? '' }}" 
                                                       required>
                                            </td>
                                        @endif

                                        @if ($quartersEnabled['4th_quarter'])
                                            <td>
                                                <input type="number" class="form-control" 
                                                       name="grades[{{ $index }}][4th_quarter]" 
                                                       min="0" max="100" 
                                                       step="0.01" 
                                                       oninput="calculateOverall(this)" 
                                                       value="{{ $importedGrades[$index]['grades']['4th_quarter'] ?? '' }}" 
                                                       required>
                                            </td>
                                        @endif

                                        <td>    
                                            <input type="number" class="form-control" name="grades[{{ $index }}][overall_grade]" 
                                                   min="0" max="100" 
                                                   step="0.01" 
                                                   readonly required>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            
                <div class="hidden-center">
                    <button type="submit" name="submit" class="btn btn-danger btn-lg">Submit Grades</button>
                </div>
            </form>
      
    </div>
</div>

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