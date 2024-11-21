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
        <form action="{{ route('gradesubmit') }}" method="POST">
            @csrf
            <input type="hidden" name="edp_code" value="{{ old('edp_code', $edpcode) }}">
            <input type="hidden" name="subject" value="{{ old('subject', $subject) }}">
            <input type="hidden" name="grade_id" value="{{ old('payment_id', $paymentForm->payment_id ?? '') }}">
            <input type="hidden" name="fullname" value="{{ old('fullname', $fullName) }}">
            <input type="hidden" name="section" value="{{ old('section', $assign->section) }}">
        
            <!-- Student Grades Table -->
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
                                @foreach (['1st_quarter', '2nd_quarter', '3rd_quarter', '4th_quarter'] as $quarter)
                                    @if ($quartersEnabled[$quarter]) <th>{{ ucfirst(str_replace('_', ' ', $quarter)) }}</th> @endif
                                @endforeach
                                <th>Overall Grade</th>
                            </tr>
                        </thead>
                        <tbody id="student-rows">
                            <tr>
                                <td>{{ $fullName }}</td>
                                <td>{{ $assign->section }}</td>
                                <td>{{ $edpcode }}</td>
                                <td>{{ $subject }}</td>
                                <td>{{ $paymentForm->level ?? 'N/A' }}</td>
                                @foreach (['1st_quarter', '2nd_quarter', '3rd_quarter', '4th_quarter'] as $quarter)
                                    @if ($quartersEnabled[$quarter])
                                        <td>
                                            <input type="number" class="form-control" name="{{ $quarter }}" value="{{ old($quarter) }}" min="0" max="100" step="0.01" oninput="calculateOverall(this)" required>
                                        </td>
                                    @endif
                                @endforeach
                                <td>
                                    <input type="number" class="form-control" name="overall_grade" value="{{ old('overall_grade') }}" min="0" max="100" step="0.01" readonly>
                                </td>
                            </tr>
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

        quarterInputs.forEach(input => {
            if (input.value) {
                total += parseFloat(input.value);
                count++;
            }
        });

        const overallGrade = count ? (total / count) : 0;
        row.closest('tr').querySelector('input[name="overall_grade"]').value = overallGrade.toFixed(2);
    }
 
</script>

@include('templates.teacherfooter')