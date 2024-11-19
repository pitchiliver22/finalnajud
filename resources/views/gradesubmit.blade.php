@include('templates.teacherheader')

<div id="main">
    <div class="w3-teal">
        <button id="openNav" class="w3-button w3-teal w3-xlarge" onclick="w3_open()">&#9776;</button>
        <div class="w3-container">
            <h1>TEACHER GRADE SUBMISSION</h1>
        </div>
    </div>

    <div class="container" style="width: 80%; height: auto; border: 1px solid #ccc; padding: 20px;">
        <form action="/gradesubmit" method="POST">
            @csrf
            <input type="hidden" name="edp_code" value="{{ $edpcode }}">
            <input type="hidden" name="subject" value="{{ $subject }}">
            <input type="hidden" name="fullname" value="{{ $fullName }}">
            <input type="hidden" name="section" value="{{ $section }}">
            <input type="hidden" name="payment_id" value="{{ $paymentForm->payment_id ?? '' }}">

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
                                @if ($quartersEnabled['1st_quarter'])
                                    <th>1st Quarter</th>
                                @endif
                                @if ($quartersEnabled['2nd_quarter'])
                                    <th>2nd Quarter</th>
                                @endif
                                @if ($quartersEnabled['3rd_quarter'])
                                    <th>3rd Quarter</th>
                                @endif
                                @if ($quartersEnabled['4th_quarter'])
                                    <th>4th Quarter</th>
                                @endif
                                <th>Overall Grade</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $fullName }}</td>
                                <td>{{ $assign->section }}</td>
                                <td>{{ $edpcode }}</td>
                                <td>{{ $subject }}</td>
                                <td>{{ $paymentForm->level ?? 'N/A' }}</td>

                                @foreach (['1st_quarter', '2nd_quarter', '3rd_quarter', '4th_quarter'] as $quarter)
                                    @if ($quartersEnabled[$quarter])
                                        <td>
                                            <input type="number" class="form-control" name="{{ $quarter }}" min="0" max="100" step="0.01" 
                                                required oninput="calculateOverall()"
                                                {{ $quartersStatus[$quarter] === 'inactive' }}>
                                        </td>
                                    @endif
                                @endforeach

                                <td>
                                    <input type="number" class="form-control" name="overall_grade" min="0" max="100" step="0.01" required readonly>
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
    function calculateOverall() {
        const firstQuarter = parseFloat(document.querySelector('input[name="1st_quarter"]').value) || 0;
        const secondQuarter = parseFloat(document.querySelector('input[name="2nd_quarter"]').value) || 0;
        const thirdQuarter = parseFloat(document.querySelector('input[name="3rd_quarter"]').value) || 0;
        const fourthQuarter = parseFloat(document.querySelector('input[name="4th_quarter"]').value) || 0;

        const overallGrade = (firstQuarter + secondQuarter + thirdQuarter + fourthQuarter) / 
            ([firstQuarter, secondQuarter, thirdQuarter, fourthQuarter].filter(x => x > 0).length || 1);

        document.querySelector('input[name="overall_grade"]').value = overallGrade.toFixed(2);
    }
</script>

@include('templates.teacherfooter')