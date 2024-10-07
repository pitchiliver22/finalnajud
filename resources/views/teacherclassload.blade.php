@include('templates.teacherheader')

<div id="main">
    <div class="w3-teal">
        <button id="openNav" class="w3-button w3-teal w3-xlarge" onclick="w3_open()">&#9776;</button>
        <div class="w3-container">
            <h1>Teacher Submit Grades</h1>
        </div>
    </div>

    <div class="container" style="width: 80%; height: auto; border: 1px solid #ccc; padding: 20px;">
        <form action="/cashierstudentfee" method="GET">
            @csrf
            <div class="fee-list">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4>Select Edp Code</h4>
                    <div class="d-flex">
                        <div class="input-group mr-3">
                            <input type="text" class="form-control" placeholder="Search by EDP Code..."
                                aria-label="Search" name="search" id="search-input">
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" type="button" onclick="searchByEdpCode()">
                                    Search
                                </button>
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
                                <th>Section</th>
                                <th>Edp Code</th>
                                <th>Subject</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            <tr>
                                <td>Diamond</td>
                                <td>4343</td>
                                <td>English</td>
                                <td><a href="/gradesubmit" class="btn btn-info btn-sm view-studententry" title="View">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                            <path
                                                d="M7.998 2c-2.757 0-5.287 1.417-6.758 3.75a.748.748 0 0 0 0 .5c1.471 2.333 4.001 3.75 6.758 3.75s5.287-1.417 6.758-3.75a.748.748 0 0 0 0-.5c-1.471-2.333-4.001-3.75-6.758-3.75zm0 1.5a3.75 3.75 0 1 1 0 7.5 3.75 3.75 0 0 1 0-7.5zm0 2a1.75 1.75 0 1 0 0 3.5 1.75 1.75 0 0 0 0-3.5z" />
                                        </svg>
                                    </a></td>
                            </tr>
                            <tr>
                                <td>Gold</td>
                                <td>4545</td>
                                <td>Mathematics</td>
                                <td><a href="/gradesubmit" class="btn btn-info btn-sm view-studententry" title="View">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                            <path
                                                d="M7.998 2c-2.757 0-5.287 1.417-6.758 3.75a.748.748 0 0 0 0 .5c1.471 2.333 4.001 3.75 6.758 3.75s5.287-1.417 6.758-3.75a.748.748 0 0 0 0-.5c-1.471-2.333-4.001-3.75-6.758-3.75zm0 1.5a3.75 3.75 0 1 1 0 7.5 3.75 3.75 0 0 1 0-7.5zm0 2a1.75 1.75 0 1 0 0 3.5 1.75 1.75 0 0 0 0-3.5z" />
                                        </svg>
                                    </a></td>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </form>
        <script>
            function searchByEdpCode() {
                var searchInput = document.getElementById("search-input").value.toLowerCase();
                var studentTable = document.getElementById("student-table");
                var rows = studentTable.getElementsByTagName("tr");

                for (var i = 1; i < rows.length; i++) {
                    var edpCodeCell = rows[i].getElementsByTagName("td")[
                        1]; // Assuming EDP code is in the second column (index 1)
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
    </div>

</div>

@include('templates.teacherfooter')
