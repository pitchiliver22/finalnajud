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
            <!-- New hidden input -->

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="fee-list">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4>STUDENT GRADES</h4>
                    <div class="d-flex">
                        <div class="input-group mr-3">
                            <input type="text" class="form-control" placeholder="Search by EDP Code..."
                                aria-label="Search" name="search" id="search-input">
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" type="button"
                                    onclick="searchByEdpCode()">Search</button>
                            </div>
                            <button type="button" class="btn btn-outline-secondary"
                                onclick="refreshPage()">Refresh</button>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped" id="student-table">
                        <thead>
                            <tr>
                                <th>Fullname</th>
                                <th>Section</th>
                                <th>Edpcode</th>
                                <th>Subject</th>
                                <th>Grade Level</th>
                                <th>1st Quarter</th>
                                <th>2nd Quarter</th>
                                <th>3rd Quarter</th>
                                <th>4th Quarter</th>
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
                                <td>
                                    <input type="number" class="form-control" name="1st_quarter" min="0"
                                        max="100" step="0.01" required oninput="calculateOverall()">
                                </td>
                                <td>
                                    <input type="number" class="form-control" name="2nd_quarter" min="0"
                                        max="100" step="0.01" required oninput="calculateOverall()">
                                </td>
                                <td>
                                    <input type="number" class="form-control" name="3rd_quarter" min="0"
                                        max="100" step="0.01" required oninput="calculateOverall()">
                                </td>
                                <td>
                                    <input type="number" class="form-control" name="4th_quarter" min="0"
                                        max="100" step="0.01" required oninput="calculateOverall()">
                                </td>
                                <td>
                                    <input type="number" class="form-control" name="overall_grade" min="0"
                                        max="100" step="0.01" required readonly>
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
    function searchByEdpCode() {
        var searchInput = document.getElementById("search-input").value.toLowerCase();
        var studentTable = document.getElementById("student-table");
        var rows = studentTable.getElementsByTagName("tr");

        for (var i = 1; i < rows.length; i++) {
            var edpCodeCell = rows[i].getElementsByTagName("td")[2]; // EDP Code is in the third column
            if (edpCodeCell) {
                var edpCode = edpCodeCell.textContent.toLowerCase();
                rows[i].style.display = edpCode.includes(searchInput) ? "" : "none";
            }
        }
    }

    function refreshPage() {
        location.reload();
    }

    function calculateOverall() {
        // Get values from the quarter inputs
        const firstQuarter = parseFloat(document.querySelector('input[name="1st_quarter"]').value) || 0;
        const secondQuarter = parseFloat(document.querySelector('input[name="2nd_quarter"]').value) || 0;
        const thirdQuarter = parseFloat(document.querySelector('input[name="3rd_quarter"]').value) || 0;
        const fourthQuarter = parseFloat(document.querySelector('input[name="4th_quarter"]').value) || 0;

        // Calculate the overall grade (here we use average)
        const overallGrade = (firstQuarter + secondQuarter + thirdQuarter + fourthQuarter) / 4;

        // Set the overall grade input value
        document.querySelector('input[name="overall_grade"]').value = overallGrade.toFixed(
            2); // Limit to 2 decimal places
    }
</script>

@include('templates.teacherfooter')
