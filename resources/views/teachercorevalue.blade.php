@include('templates.teacherheader')

<div id="main">
    <div class="w3-teal">
        <button id="openNav" class="w3-button w3-teal w3-xlarge" onclick="w3_open()">&#9776;</button>
        <div class="w3-container">
            <h1>TEACHER CORE VALUES</h1>
        </div>
    </div>


    <div class="container my-5">
        <form action="/teacherattendance" method="GET">
            @csrf
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="card-title">STUDENT CORE VALUES</h4>
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
                                    <th>Student ID</th>
                                    <th>Grade Level</th>
                                    <th>Respect</th>
                                    <th>Excellence</th>
                                    <th>Teamwork</th>
                                    <th>Innovation</th>
                                    <th>Sustainability</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Oliver pacatang</td>
                                    <td>Diamond</td>
                                    <td>2314324</td>

                                    <td>Grade 2</td>

                                    <td><input type="text" class="form-control" value="AO" name="firstquarter">
                                    </td>
                                    <td><input type="text" class="form-control" value="AO" name="secondquarter">
                                    </td>
                                    <td><input type="text" class="form-control" value="SO" name="thirdquarter">
                                    </td>
                                    <td><input type="text" class="form-control" value="SO" name="fourthquarter">
                                    </td>
                                    <td><input type="text" class="form-control" value="AO" name="attendance">
                                    </td>
                                </tr>
                                <tr>
                                    <td>claire dungog</td>
                                    <td>Diamond</td>
                                    <td>435435</td>

                                    <td>Grade 2</td>
                                    <td><input type="text" class="form-control" value="AO" name="firstquarter">
                                    </td>
                                    <td><input type="text" class="form-control" value="SO" name="secondquarter">
                                    </td>
                                    <td><input type="text" class="form-control" value="SO" name="thirdquarter">
                                    </td>
                                    <td><input type="text" class="form-control" value="SO" name="fourthquarter">
                                    </td>
                                    <td><input type="text" class="form-control" value="AO" name="attendance">
                                    </td>
                                </tr>
                                <tr>
                                    <td>Johrnhay batan</td>
                                    <td>Diamond</td>
                                    <td>2314324</td>

                                    <td>Grade 2</td>
                                    <td><input type="text" class="form-control" value="AO" name="firstquarter">
                                    </td>
                                    <td><input type="text" class="form-control" value="AO" name="secondquarter">
                                    </td>
                                    <td><input type="text" class="form-control" value="AO" name="thirdquarter">
                                    </td>
                                    <td><input type="text" class="form-control" value="AO" name="fourthquarter">
                                    </td>
                                    <td><input type="text" class="form-control" value="SO" name="attendance">
                                    </td>
                                </tr>
                                <tr>
                                    <td>Moises Belacura</td>
                                    <td>Diamond</td>
                                    <td>2314324</td>

                                    <td>Grade 2</td>
                                    <td><input type="text" class="form-control" value="AO" name="firstquarter">
                                    </td>
                                    <td><input type="text" class="form-control" value="AO" name="secondquarter">
                                    </td>
                                    <td><input type="text" class="form-control" value="AO" name="thirdquarter">
                                    </td>
                                    <td><input type="text" class="form-control" value="SO"
                                            name="fourthquarter">
                                    </td>
                                    <td><input type="text" class="form-control" value="SO" name="attendance">
                                    </td>
                                </tr>
                                <tr>
                                    <td>Bernie Lambo</td>
                                    <td>Diamond</td>
                                    <td>2314324</td>

                                    <td>Grade 2</td>
                                    <td><input type="text" class="form-control" value="AO"
                                            name="firstquarter">
                                    </td>
                                    <td><input type="text" class="form-control" value="AO"
                                            name="secondquarter">
                                    </td>
                                    <td><input type="text" class="form-control" value="AO"
                                            name="thirdquarter">
                                    </td>
                                    <td><input type="text" class="form-control" value="AO"
                                            name="fourthquarter">
                                    </td>
                                    <td><input type="text" class="form-control" value="SO" name="attendance">
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
            var edpCodeCell = rows[i].getElementsByTagName("td")[3];
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
