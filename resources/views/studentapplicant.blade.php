@include('templates.recordheader')

<div id="main">
    <div class="w3-teal">
        <button id="openNav" class="w3-button w3-teal w3-xlarge" onclick="w3_open()">&#9776;</button>
        <div class="w3-container">
            <h1>Student Pending Account</h1>
        </div>
    </div>

    <div class="container mt-4">
        <form action="/studentapplicant" method="POST">
            @csrf <!-- CSRF token for security -->
            <div class="input-group mb-3">
                <input type="text" id="searchInput" class="form-control" placeholder="Search account entries..."
                    aria-label="Search account entries">
                <button class="btn btn-outline-secondary" type="button" id="button-addon2" onclick="searchFunction()">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-search" viewBox="0 0 16 16">
                        <path
                            d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                    </svg>
                    Search
                </button>
            </div>

            <div class="table-responsive">
                <table class="table table-striped table-hover" id="accountTable">
                    <thead class="thead-light">
                        <tr>
                            <th>
                                <input type="checkbox" id="selectAll" onclick="toggleSelectAll(this)">
                                <label for="selectAll" style="display: inline;"> Select All</label>
                            </th>
                            <th>Status</th>
                            <th>Users ID</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Middle Name</th>
                            <th>Suffix</th>
                            <th>Email Address</th>
                            <th>Password</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($account as $acc)
                            <tr>
                                <td>
                                    <input type="checkbox" name="students[]" value="{{ $acc->id }}" class="studentCheckbox">
                                </td>
                                <td>{{ $acc->status }}</td>
                                <td>{{ $acc->id }}</td>
                                <td>{{ $acc->firstname }}</td>
                                <td>{{ $acc->lastname }}</td>
                                <td>{{ $acc->middlename }}</td>
                                <td>{{ $acc->suffix }}</td>
                                <td>{{ $acc->email }}</td>
                                <td>{{ $acc->password }}</td>
                                <td>
                                    <a href="/recordapproval/{{ $acc->id }}" class="btn btn-info btn-sm" title="View">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                            <path
                                                d="M7.998 2c-2.757 0-5.287 1.417-6.758 3.75a.748.748 0 0 0 0 .5c1.471 2.333 4.001 3.75 6.758 3.75s5.287-1.417 6.758-3.75a.748.748 0 0 0 0-.5c-1.471-2.333-4.001-3.75-6.758-3.75zm0 1.5a3.75 3.75 0 1 1 0 7.5 3.75 3.75 0 0 1 0-7.5zm0 2a1.75 1.75 0 1 0 0 3.5 1.75 1.75 0 0 0 0-3.5z" />
                                        </svg>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <button type="submit" class="btn btn-success mt-3">Approve Selected</button>
        </form>
    </div>
</div>

<script>
    function searchFunction() {
        const input = document.getElementById('searchInput');
        const filter = input.value.toLowerCase();
        const rows = document.querySelectorAll('#accountTable tbody tr');

        rows.forEach(row => {
            const cells = row.getElementsByTagName('td');
            let match = false;

            // Check through each cell in the row
            for (let i = 1; i < cells.length; i++) { // Start from 1 to skip the checkbox column
                if (cells[i].textContent.toLowerCase().includes(filter)) {
                    match = true;
                    break;
                }
            }

            // Show or hide row based on match
            row.style.display = match ? '' : 'none';
        });
    }

    function toggleSelectAll(selectAllCheckbox) {
        const checkboxes = document.querySelectorAll('.studentCheckbox');
        checkboxes.forEach(checkbox => {
            checkbox.checked = selectAllCheckbox.checked;
        });
    }
</script>

<style>
    body {
        font-family: 'Arial', sans-serif;
        background-color: #f8f9fa;
    }

    .w3-teal {
        background-color: #007bff;
        color: white;
        padding: 15px;
    }

    h1 {
        margin: 0;
        font-size: 24px;
    }

    .container {
        margin-top: 20px;
    }

    .input-group {
        margin-bottom: 20px;
    }

    .table {
        border-radius: 8px;
        overflow: hidden;
    }

    .table th,
    .table td {
        vertical-align: middle;
    }

    .table-striped tbody tr:nth-of-type(odd) {
        background-color: #f2f2f2;
    }

    .table-hover tbody tr:hover {
        background-color: #e9ecef;
    }

    .btn-info {
        background-color: #17a2b8;
        border: none;
        transition: background-color 0.3s;
    }

    .btn-info:hover {
        background-color: #138496;
    }

    .btn-success {
        background-color: #28a745;
        border: none;
        transition: background-color 0.3s;
    }

    .btn-success:hover {
        background-color: #218838;
    }
</style>

@include('templates.recordfooter')