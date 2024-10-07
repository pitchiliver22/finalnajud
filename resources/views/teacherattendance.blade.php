@include('templates.teacherheader')

<div id="main">
    <div class="w3-teal">
        <button id="openNav" class="w3-button w3-teal w3-xlarge" onclick="w3_open()">&#9776;</button>
        <div class="w3-container">
            <h1>TEACHER ATTENDANCE</h1>
        </div>
    </div>


    <div class="container my-5">
        <form action="/teacherattendance" method="GET">
            @csrf
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="card-title">STUDENT ATTENDANCE</h4>
                        <div class="d-flex">
                            <div class="input-group me-3">
                                <input type="text" class="form-control" placeholder="Search by EDP Code..."
                                    aria-label="Search" name="search" id="search-input">
                                <button class="btn btn-outline-secondary" type="button"
                                    onclick="searchByEdpCode()">Search</button>
                            </div>
                            <button type="button" class="btn btn-outline-secondary"
                                onclick="refreshPage()">Refresh</button>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped table-hover" id="student-table">
                            <thead>
                                <tr>
                                    <th>Full Name</th>
                                    <th>Section</th>
                                    <th>Grade Level</th>
                                    <th>Student ID</th>
                                    <th>Edp Code</th>
                                    <th>Subject</th>
                                    <th>1st Quarter Attendance</th>
                                    <th>2nd Quarter Attendance</th>
                                    <th>3rd Quarter Attendance</th>
                                    <th>4th Quarter Attendance</th>
                                    <th>Overall Attendance</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Oliver pacatang</td>
                                    <td>Diamond</td>
                                    <td>Grade 2</td>
                                    <td>2314324</td>
                                    <td>2321</td>
                                    <td>English</td>
                                    <td><input type="text" class="form-control" value="P-23" name="firstquarter">
                                    </td>
                                    <td><input type="text" class="form-control" value="P-42" name="secondquarter">
                                    </td>
                                    <td><input type="text" class="form-control" value="P-44" name="thirdquarter">
                                    </td>
                                    <td><input type="text" class="form-control" value="P-45" name="fourthquarter">
                                    </td>
                                    <td><input type="text" class="form-control" value="P-154" name="attendance">
                                    </td>
                                </tr>
                                <tr>
                                    <td>claire dungog</td>
                                    <td>Diamond</td>
                                    <td>Grade 2</td>
                                    <td>435435</td>
                                    <td>4342</td>
                                    <td>English</td>
                                    <td><input type="text" class="form-control" value="P-45" name="firstquarter">
                                    </td>
                                    <td><input type="text" class="form-control" value="P-43" name="secondquarter">
                                    </td>
                                    <td><input type="text" class="form-control" value="P-34" name="thirdquarter">
                                    </td>
                                    <td><input type="text" class="form-control" value="P-25" name="fourthquarter">
                                    </td>
                                    <td><input type="text" class="form-control" value="P-192" name="attendance">
                                    </td>
                                </tr>
                                <tr>
                                    <td>Johrnhay batan</td>
                                    <td>Diamond</td>
                                    <td>Grade 2</td>
                                    <td>2314324</td>
                                    <td>4356</td>
                                    <td>English</td>
                                    <td><input type="text" class="form-control" value="P-32" name="firstquarter">
                                    </td>
                                    <td><input type="text" class="form-control" value="P-38" name="secondquarter">
                                    </td>
                                    <td><input type="text" class="form-control" value="P-43" name="thirdquarter">
                                    </td>
                                    <td><input type="text" class="form-control" value="P-26" name="fourthquarter">
                                    </td>
                                    <td><input type="text" class="form-control" value="P-139" name="attendance">
                                    </td>
                                </tr>
                                <tr>
                                    <td>Moises Belacura</td>
                                    <td>Diamond</td>
                                    <td>Grade 2</td>
                                    <td>2314324</td>
                                    <td>5657</td>
                                    <td>English</td>
                                    <td><input type="text" class="form-control" value="P-45" name="firstquarter">
                                    </td>
                                    <td><input type="text" class="form-control" value="P-56" name="secondquarter">
                                    </td>
                                    <td><input type="text" class="form-control" value="P-34" name="thirdquarter">
                                    </td>
                                    <td><input type="text" class="form-control" value="P-23"
                                            name="fourthquarter">
                                    </td>
                                    <td><input type="text" class="form-control" value="P-158" name="attendance">
                                    </td>
                                </tr>
                                <tr>
                                    <td>Bernie Lambo</td>
                                    <td>Diamond</td>
                                    <td>Grade 2</td>
                                    <td>2314324</td>
                                    <td>5658</td>
                                    <td>English</td>
                                    <td><input type="text" class="form-control" value="P-32"
                                            name="firstquarter">
                                    </td>
                                    <td><input type="text" class="form-control" value="P-34"
                                            name="secondquarter">
                                    </td>
                                    <td><input type="text" class="form-control" value="P-45"
                                            name="thirdquarter">
                                    </td>
                                    <td><input type="text" class="form-control" value="P-32"
                                            name="fourthquarter">
                                    </td>
                                    <td><input type="text" class="form-control" value="P-143" name="attendance">
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <div class="text-center">
        <a href="#" class="btn btn-danger btn-lg">Save</a>
    </div>

</div>
<script>
    function searchByEdpCode() {
        var searchInput = document.getElementById("search-input").value.toLowerCase();
        var studentTable = document.getElementById("student-table");
        var rows = studentTable.getElementsByTagName("tr");

        for (var i = 1; i < rows.length; i++) {
            var edpCodeCell = rows[i].getElementsByTagName("td")[4];
            var edpCode = edpCodeCell.textContent.toLowerCase();

            if (edpCode.includes(searchInput)) {
                rows[i].style.display = "";
            } else {
                rows[i].style.display = "none";
            }
        }
    }

    function refreshPage() {
        location.reload();
    }
</script>
@include('templates.teacherfooter')
