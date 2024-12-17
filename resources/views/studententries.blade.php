@include('templates.recordheader')

<style>
    body {
        font-family: Arial, sans-serif;
        background-color: white; /* Changed for consistency */
        margin: 0;
        padding: 0;
    }

    .header-container {
        display: flex; 
        align-items: center; 
        background-color: rgba(8, 16, 66, 1); 
        color: white;
        padding: 10px; 
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.5);  
    }

    .w3-teal {
        background-color: #0c3b6d; /* Match the header color */
    }

    h1 {
        margin: 0; 
        font-size: 15px;
        text-transform:uppercase;
    
   
    }

    .w3-sidebar {
        background-color: #0c3b6d; 
        color: white;
        width: 250px; /* Set a fixed width for the sidebar */
        position: fixed; /* Make it fixed */
        height: 100%; /* Full height */
        padding-top: 20px; /* Space at the top */
        display: none; /* Initially hidden */
    }



    .container {
        margin: 20px auto; /* Center the container */
        max-width: 100%; /* Limit max width */
        padding: 0 15px; /* Add padding */
        margin-left: 5px; /* Leave space for the sidebar */
    }

    .form-control {
        width: 30%;
        padding: 10px;
        border: 1px solid #ced4da;
        border-radius: 4px;
        margin-bottom: 15px; /* Space below the input */
    }

    .table {
        width: 100%
        border-collapse: collapse;
        border-radius: 8px;
        overflow: hidden;
    }

    .table th,
    .table td {
        padding: 15px;
        text-align: left;
        width:10%;
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
    .viewbtn{
        background-color:rgba(79, 194, 25);
        color:white;
        padding:7px;
        text-decoration:none;
        border-width:0;
        border-radius:7px;
 
    }
    .viewbtn:hover{
        background-color:rgba(63, 145, 25);
        color:white;
    }
</style>

    <div class="header-container">
        <button id="openNav" class="w3-button w3-xlarge" onclick="w3_open()">&#9776;</button>
        <h1>Student Entries</h1>
    </div>
    
    <div id="main" onclick="w3_close()">

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
                            <a href="/showdetails/{{ $student->id }}" class="viewbtn">View Student Information</a>
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


@include('templates.recordfooter')
