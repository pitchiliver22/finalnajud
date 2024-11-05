@include('templates.principalheader')

<div id="main">
    <div class="w3-teal">
        <button id="openNav" class="w3-button w3-teal w3-xlarge" onclick="w3_open()">&#9776;</button>
        <div class="w3-container">
            <h1>Publish Grades</h1>
        </div>
    </div>

    <h2>Grade Details</h2>

    <table class="table-primary">
        <thead>
            <tr>
                <th>Detail</th>
                <th>Information</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><strong>Full Name</strong></td>
                <td>{{ $fullName ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td><strong>Section</strong></td>
                <td>{{ $assign->section ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td><strong>EDP Code</strong></td>
                <td>{{ $edpcode }}</td>
            </tr>
            <tr>
                <td><strong>Subject</strong></td>
                <td>{{ $subject }}</td>
            </tr>
            <tr>
                <td><strong>1st Quarter</strong></td>
                <td>{{ $first_quarter }}</td>
            </tr>
            <tr>
                <td><strong>2nd Quarter</strong></td>
                <td>{{ $second_quarter }}</td>
            </tr>
            <tr>
                <td><strong>3rd Quarter</strong></td>
                <td>{{ $third_quarter }}</td>
            </tr>
            <tr>
                <td><strong>4th Quarter</strong></td>
                <td>{{ $fourth_quarter }}</td>
            </tr>
            <tr>
                <td><strong>Overall Grade</strong></td>
                <td>{{ $overall_grade }}</td>
            </tr>
            <tr>
                <td><strong>Status</strong></td>
                <td>{{ $status }}</td>
            </tr>
        </tbody>
    </table>

    <div class="mt-3">
        <a href="/submittedgrades" class="btn btn-primary">Back to Grades</a>
        <a href="" class="btn btn-warning">Edit</a>

        <!-- Publish Button -->
        @if ($grades->status === 'pending')
            <form action="{{ route('grades.publish', $grades->id) }}" method="POST" style="display:inline;">
                @csrf
                <button type="submit" class="btn btn-success"
                    onclick="return confirm('Are you sure you want to publish this grade?');">Publish</button>
            </form>
        @endif

        <form action="" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger"
                onclick="return confirm('Are you sure you want to delete this grade?');">Delete</button>
        </form>
    </div>

    @if (session('success'))
        <div class="alert alert-success mt-3">
            {{ session('success') }}
        </div>
    @endif
</div>

<style>
    .table-primary {
        width: 100%;
        border-collapse: collapse;
        background-color: #f2f2f2;
        margin-top: 20px;
    }

    .table-primary th,
    .table-primary td {
        padding: 12px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    .table-primary th {
        background-color: #4CAF50;
        color: white;
    }

    /* Responsive design */
    @media (max-width: 600px) {

        .table-primary th,
        .table-primary td {
            display: block;
            text-align: right;
        }

        .table-primary th {
            text-align: left;
            position: relative;
        }

        .table-primary th::after {
            content: ":";
            position: absolute;
            right: 0;
        }
    }
</style>

@include('templates.principalfooter')
