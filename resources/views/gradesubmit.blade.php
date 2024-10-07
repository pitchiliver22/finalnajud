@include('templates.teacherheader')

<div id="main">
    <div class="w3-teal">
        <button id="openNav" class="w3-button w3-teal w3-xlarge" onclick="w3_open()">&#9776;</button>
        <div class="w3-container">
            <h1>TEACHER GRADE SUBMISSION</h1>
        </div>
    </div>


    <div class="container" style="width: 80%; height: auto; border: 1px solid #ccc; padding: 20px;">
        <form action="/gradesubmit" method="GET">
            @csrf
            <div class="fee-list">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4>STUDENT GRADES</h4>
                    <div class="d-flex">
                        <div class="input-group mr-3">
                            <input type="text" class="form-control" placeholder="Search by EDP Code..."
                                aria-label="Search" name="search" id="search-input">
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" type="button" onclick="searchByEdpCode()">
                                    Search</button>
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
                                <th>Full Name</th>
                                <th>Section</th>
                                <th>Student ID</th>
                                <th>Edp Code</th>
                                <th>Subject</th>
                                <th>1st Quarter Grade</th>
                                <th>2nd Quarter Grade</th>
                                <th>3rd Quarter Grade</th>
                                <th>4th Quarter Grade</th>
                                <th>Final Grade</th>

                            </tr>
                        </thead>
                        <tbody>

                            <tr>
                                <td> Oliver pacatang </td>
                                <td>Grade 10</td>
                                <td>2314324</td>
                                <td>4343</td>
                                <td>English</td>
                                <td><input type="number" class="form-control" value="78" name="firstquarter">
                                </td>
                                <td><input type="number" class="form-control" value="89" name="secondquarter">
                                </td>
                                <td><input type="number" class="form-control" value="90" name="thirdquarter">
                                </td>
                                <td><input type="number" class="form-control" value="78" name="fourthquarter">
                                </td>
                                <td><input type="number" class="form-control" value="83.75" name="grade"></td>

                            </tr>

                            <tr>
                                <td>claire dungog </td>
                                <td>Grade 10</td>
                                <td>435435</td>
                                <td>4343</td>
                                <td>English</td>
                                <td><input type="number" class="form-control" value="87" name="firstquarter">
                                </td>
                                <td><input type="number" class="form-control" value="90" name="secondquarter">
                                </td>
                                <td><input type="number" class="form-control" value="78" name="thirdquarter">
                                </td>
                                <td><input type="number" class="form-control" value="90" name="fourthquarter">
                                </td>
                                <td><input type="number" class="form-control" value="86.25" name="grade"></td>

                            </tr>

                            <tr>
                                <td> Johrnhay batan </td>
                                <td>Grade 10</td>
                                <td>2314324</td>
                                <td>4343</td>
                                <td>English</td>
                                <td><input type="number" class="form-control" value="88" name="firstquarter">
                                </td>
                                <td><input type="number" class="form-control" value="87" name="secondquarter">
                                </td>
                                <td><input type="number" class="form-control" value="89" name="thirdquarter">
                                </td>
                                <td><input type="number" class="form-control" value="90" name="fourthquarter">
                                </td>
                                <td><input type="number" class="form-control" value="88.5" name="grade"></td>

                            </tr>

                            <tr>
                                <td> Moises Belacura </td>
                                <td>Grade 10</td>
                                <td>2314324</td>
                                <td>4343</td>
                                <td>English</td>
                                <td><input type="number" class="form-control" value="89" name="firstquarter">
                                </td>
                                <td><input type="number" class="form-control" value="89" name="secondquarter">
                                </td>
                                <td><input type="number" class="form-control" value="90" name="thirdquarter">
                                </td>
                                <td><input type="number" class="form-control" value="78" name="fourthquarter">
                                </td>
                                <td><input type="number" class="form-control" value="86.5" name="grade"></td>

                            </tr>

                            <tr>
                                <td> Bernie Lambo </td>
                                <td>Grade 10</td>
                                <td>2314324</td>
                                <td>4343</td>
                                <td>English</td>
                                <td><input type="number" class="form-control" value="76" name="firstquarter">
                                </td>
                                <td><input type="number" class="form-control" value="89" name="secondquarter">
                                </td>
                                <td><input type="number" class="form-control" value="95" name="thirdquarter">
                                </td>
                                <td><input type="number" class="form-control" value="98" name="fourthquarter">
                                </td>
                                <td><input type="number" class="form-control" value="89.5" name="grade"></td>

                            </tr>


                        </tbody>
                    </table>
                </div>
            </div>
        </form>
    </div>

    <div class="text-center">
        <a href="#" class="btn btn-danger btn-lg">Submit</a>
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
