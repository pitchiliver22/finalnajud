@include('templates.teacherheader')

<div id="main">
    <div class="w3-teal">
        <button id="openNav" class="w3-button w3-teal w3-xlarge" onclick="w3_open()">&#9776;</button>
        <div class="w3-container">
            <h1>TEACHER CORE VALUE SUBMISSION</h1>
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
        <form action="/teachercorevalue" method="POST"> <!-- Ensure the action route is correct -->
            @csrf
            @foreach ($students as $index => $student)
    <input type="hidden" name="grade_level[]" value="{{ old('grade_level.' . $index, $paymentForm->level ?? '') }}">
    <input type="hidden" name="fullname[]" value="{{ old('fullname.' . $index, "{$student->firstname} {$student->middlename} {$student->lastname}") }}">
    <input type="hidden" name="section[]" value="{{ old('section.' . $index, $section) }}">
    <input type="hidden" name="core_id[]" value="{{ old('core_id.' . $index, $studentClassIds[$student->id] ?? 'N/A') }}">
@endforeach
            <!-- Core Values Table -->
            <div class="fee-list">
                <h4>STUDENT CORE VALUES</h4>
                <div class="table-responsive">
                    <table class="table table-striped" id="core-values-table">
                        <thead>
                            <tr>
                                <th>Fullname</th>
                                <th>Section</th>
                                <th>Grade Level</th>
                                <th>Respect</th>
                                <th>Excellence</th>
                                <th>Teamwork</th>
                                <th>Innovation</th>
                                <th>Sustainability</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($students as $student)
                                <tr>
                                    <td>{{ $student->firstname }} {{ $student->middlename }} {{ $student->lastname }}</td>
                                    <td>{{ $section }}</td> <!-- Use $section here -->
                                    <td>{{ $paymentForm->level ?? 'N/A' }}</td>
                                    @foreach (['respect', 'excellence', 'teamwork', 'innovation', 'sustainability'] as $coreValue)
                                        <td>
                                            <input type="hidden" class="form-control" name="core_values[{{ $student->id }}][{{ $coreValue }}]" value="{{ old('core_values.' . $student->id . '.' . $coreValue) }}" required>
                                        </td>
                                    @endforeach
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="hidden-center">
                <button type="submit" name="submit" class="btn btn-danger btn-lg">Submit Core Values</button>
            </div>
        </form>
    </div>
</div>

@include('templates.teacherfooter')