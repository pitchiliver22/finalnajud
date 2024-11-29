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
                <h4>STUDENT GRADES</h4>     
                <div class="table-responsive">
                    <table class="table table-striped" id="student-table">
                        <thead>
                            <tr>
                                <th>Fullname</th>
                                <th>Section</th>
                                <th>Edpcode</th>
                                <th>Subject</th>
                                <th>Grade Level</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($students as $index => $student)
                        <tr>
                            <td>{{ $student->firstname }} {{ $student->middlename }} {{ $student->lastname }}</td>
                            <td>{{ $section }}</td>
                            <td>{{ $edpcode }}</td>
                            <td>{{ $subject }}</td>
                            <td>{{ $paymentForm->level ?? 'N/A' }}</td>

                            @foreach (['1st_quarter', '2nd_quarter', '3rd_quarter', '4th_quarter'] as $quarter)
                                @if ($quartersEnabled[$quarter])
                                    <td>
                                        <input type="number" class="form-control" 
                                               name="grades[{{ $index }}][{{ $quarter }}]" 
                                               min="0" max="100" step="0.01" 
                                               oninput="calculateOverall(this)" 
                                               required>
                                    </td>
                                @endif
                            @endforeach

                            <td>
                                <input type="number" class="form-control" name="grades[{{ $index }}][overall_grade]" 
                                       min="0" max="100" step="0.01" readonly required>
                            </td>

                         
                        </tr>
                    @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        
            <div class="text-center">
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

        // Sum up all the input values for the quarters
        quarterInputs.forEach(input => {
            if (input.value) {
                total += parseFloat(input.value);
                count++;
            }
        });

        // Calculate the overall grade (average)
        const overallGrade = count ? (total / count) : 0;

        // Update the overall grade input for this row
        const overallGradeInput = row.closest('tr').querySelector('input[name$="[overall_grade]"]');
        overallGradeInput.value = overallGrade.toFixed(2);
    }

    // Add event listeners to the number inputs to trigger the calculation
    document.querySelectorAll('input[type="number"]').forEach(input => {
        input.addEventListener('input', function() {
            calculateOverall(input);
        });
    });
</script>

@include('templates.teacherfooter')