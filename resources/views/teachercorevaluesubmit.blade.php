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
        <form action="/teachercorevalue" method="POST"> 
            @csrf
            @foreach ($students as $index => $studentDetail)
                <input type="hidden" name="grade_level[]" value="{{ old('grade_level.' . $index, $studentDetail['grade_level']) }}">
                <input type="hidden" name="fullname[]" value="{{ old('fullname.' . $index, "{$studentDetail['student']->firstname} {$studentDetail['student']->middlename} {$studentDetail['student']->lastname}") }}">
                <input type="hidden" name="section[]" value="{{ old('section.' . $index, $studentDetail['section']) }}">
                <input type="hidden" name="core_id[]" value="{{ old('core_id.' . $index, $studentClassIds[$studentDetail['student']->id] ?? 'N/A') }}">
            @endforeach

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
                            @foreach ($students as $studentDetail)
                                <tr>
                                    <td>{{ $studentDetail['student']->firstname }} {{ $studentDetail['student']->middlename }} {{ $studentDetail['student']->lastname }}</td>
                                    <td>{{ $studentDetail['section'] }}</td> 
                                    <td>{{ $studentDetail['grade_level'] ?? 'N/A' }}</td>
                                    @foreach (['respect', 'excellence', 'teamwork', 'innovation', 'sustainability'] as $coreValue)
                                        <td>
                                            <input type="text" class="form-control" name="core_values[{{ $studentDetail['student']->id }}][{{ $coreValue }}]" 
                                                   value="{{ old('core_values.' . $studentDetail['student']->id . '.' . $coreValue, '') }}" 
                                                   required {{ $errors->any() ? 'readonly' : '' }}>
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