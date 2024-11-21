@include('templates.principalheader')

<div id="main">
    <div class="w3-teal">
        <button id="openNav" class="w3-button w3-teal w3-xlarge" onclick="w3_open()">&#9776;</button>
        <div class="w3-container">
            <h1>Assessments Overview</h1>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col">
            <h2>List of Created Assessments</h2>
        </div>
    </div>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>School Year</th>
                <th>Grade Level</th>
                <th>Assessment Name</th>
                <th>Description</th>
                <th>Assessment Date</th>
                <th>Assessment Time</th>
                <th>Assessment Fee</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($assessments as $assessment)
                <tr>
                    <td>{{ $assessment->school_year }}</td>
                    <td>{{ $assessment->grade_level }}</td>
                    <td>{{ $assessment->assessment_name }}</td>
                    <td>{{ $assessment->description }}</td>
                    <td>{{ $assessment->assessment_date }}</td>
                    <td>{{ $assessment->assessment_time }}</td>
                    <td>{{ $assessment->assessment_fee }}</td>
                    <td>{{ $assessment->status }}</td> <!-- Add status column if applicable -->
                    <td>
                        <form action="{{ route('assessment.publish', $assessment->id) }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-primary">Publish</button>
                        </form>
                        <form action="{{ route('assessment.edit', $assessment->id) }}" method="GET" class="d-inline">
                            <button type="submit" class="btn btn-secondary">Edit</button>
                        </form>
                        <form action="{{ route('assessment.delete', $assessment->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="9" class="text-center">No assessments found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@include('templates.principalfooter')