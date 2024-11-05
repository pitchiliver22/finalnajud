@include('templates.recordheader')

<div id="main">
    <div class="w3-teal">
        <button id="openNav" class="w3-button w3-teal w3-xlarge" onclick="w3_open()">&#9776;</button>
        <div class="w3-container">
            <h1>Student Entries</h1>
        </div>
    </div>
    <br>
    <br>

    <div class="container">
        <input type="text" id="searchInput" onkeyup="searchFunction()" placeholder="Search for names.."
            class="form-control mb-3">

        <table class="table table-striped table-bordered" id="studentTable">
            <thead>
                <tr>
                    <th>First Name</th>
                    <th>Middle Name</th>
                    <th>Last Name</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($studentDetails as $student)
                    <tr>
                        <td>{{ $student->firstname }}</td>
                        <td>{{ $student->middlename }}</td>
                        <td>{{ $student->lastname }}</td>
                        <td>
                            <a href="/showdetails/{{ $student->id }}" class="btn btn-info">View</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script>
    function searchFunction() {
        const input = document.getElementById('searchInput');
        const filter = input.value.toLowerCase();
        const table = document.getElementById('studentTable');
        const tr = table.getElementsByTagName('tr');

        for (let i = 1; i < tr.length; i++) {
            const td1 = tr[i].getElementsByTagName('td')[0];
            const td2 = tr[i].getElementsByTagName('td')[1];
            const td3 = tr[i].getElementsByTagName('td')[2];

            if (td1 || td2 || td3) {
                const txtValue1 = td1.textContent || td1.innerText;
                const txtValue2 = td2.textContent || td2.innerText;
                const txtValue3 = td3.textContent || td3.innerText;

                if (txtValue1.toLowerCase().indexOf(filter) > -1 ||
                    txtValue2.toLowerCase().indexOf(filter) > -1 ||
                    txtValue3.toLowerCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
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

    .table {
        width: 100%;
        margin: 0 auto;
        border-collapse: collapse;
        border-radius: 8px;
        overflow: hidden;
    }

    .table th,
    .table td {
        padding: 15px;
        text-align: left;
    }

    .table-striped tbody tr:nth-of-type(odd) {
        background-color: #f2f2f2;
    }

    .table-bordered {
        border: 1px solid #dee2e6;
    }

    .table-bordered th,
    .table-bordered td {
        border: 1px solid #dee2e6;
    }

    .btn-info {
        background-color: #17a2b8;
        border: none;
        color: white;
        padding: 8px 12px;
        border-radius: 4px;
        text-decoration: none;
        transition: background-color 0.3s;
    }

    .btn-info:hover {
        background-color: #138496;
    }

    .form-control {
        width: 100%;
        padding: 10px;
        border: 1px solid #ced4da;
        border-radius: 4px;
    }
</style>

@include('templates.recordfooter')
