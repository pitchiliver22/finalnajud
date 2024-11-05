@include('templates.principalheader')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

<style>
    /* Your existing styles */
    body {
        background-color: #f8f9fa;
    }

    .form-container {
        background: white;
        padding: 2rem;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    .teacher-list {
        margin-top: 2rem;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    th,
    td {
        border: 1px solid #dee2e6;
        padding: 0.75rem;
        text-align: left;
    }

    th {
        background-color: #e9ecef;
    }

    .btn-danger {
        border: none;
        background-color: #dc3545;
        color: white;
    }

    .btn-primary {
        background-color: #007bff;
        border: none;
        color: white;
    }

    .assigned {
        color: green;

    }

    .not-assigned {
        color: orange;

    }
</style>

<div id="main">
    <div class="w3-teal">
        <button id="openNav" class="w3-button w3-teal w3-xlarge" onclick="w3_open()">&#9776;</button>
        <div class="w3-container">
            <h1>TEACHERS AND SUBJECTS</h1>
        </div>
    </div>
    <br>
    <div class="container d-flex justify-content-center align-items-center" style="min-height: 80vh;">
        <div class="form-container">
            <h1 class="text-center">Assign Teacher to Subject</h1>

            <form action="/principalteacher" method="POST" id="myForm">
                @csrf
                <div class="form-group">
                    <label for="teacher">Adviser</label>
                    <select class="form-control" id="teacher" name="name" required>
                        <option value="">Select a Teacher</option>
                        @foreach ($teachers as $teacher)
                            <option value="{{ $teacher['id'] }}" {{ $teacher['assigned'] ? 'disabled' : '' }}>
                                {{ $teacher['name'] }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="subject">Subject</label>
                    <textarea class="form-control uppercase" id="subject" name="subject" placeholder="e.g. FILIPINO, ENGLISH, ETC."
                        pattern="^[A-Za-z\s,]+$" title="Please enter letters and commas only" required></textarea>
                </div>
                <br>

                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>

            <div class="teacher-list">
                <h2>List of Teachers</h2>
                <table id="teacherTable">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($teachers as $teacher)
                            <tr id="teacher-{{ $teacher['id'] }}">
                                <td>{{ $teacher['name'] }}</td>
                                <td class="{{ $teacher['assigned'] ? 'assigned' : 'not-assigned' }}">
                                    {{ $teacher['assigned'] ? 'Assigned' : 'Not Assigned' }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script>
    // Handle form submission to show notification
    document.getElementById('myForm').onsubmit = function() {
        toastr.success('Teacher assigned successfully.');
    };
</script>

@include('templates.principalfooter')
