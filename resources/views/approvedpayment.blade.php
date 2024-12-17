    @include('templates.cashierheader')

    <style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f8f9fa;
        margin: 0;
        padding: 0;
    }

    .header-container {
        display: flex; 
        align-items: center; 
        background-color: rgba(8, 16, 66, 1); 
        color:white;
        padding: 10px; 
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.5); 
            }

    #mySidebar {
        display: none;
        position: fixed;
        z-index: 1;
        height: 100%;
        width: 250px;
        top: 0;
        left: 0;
        background-color: #0c3b6d;
        color: white;
        padding-top: 20px;
        padding-left: 15px;
        transition: 0.3s;
        overflow-y: auto;
    }

    #main {
        transition: margin-left .3s;
        padding:10px;
    }

    .table-striped tbody tr:nth-of-type(odd) {
        background-color: #f9f9f9;
    }

    .btn-info {
        background-color: #17a2b8;
        border-color: #17a2b8;
    }

    .btn-info:hover {
        background-color: #138496;
        border-color: #117a8b;
    }
    h1{
        margin-left:-1px;
        margin-top:12px;
        font-size: 14px;
        text-transform:uppercase;
    }
    .viewpayment{
        background-color:rgba(79, 194, 25);
        color:white;
        padding:7px;
        text-decoration:none;
        border-width:0;
        border-radius:7px;
    }
    .viewpayment:hover{
        background-color:rgba(63, 145, 25);
        color:white;
    }
    .refresh{
        background-color:rgba(35, 17, 112);
        color:white;
        padding:5px;
    }
    .refresh:hover{
        background-color:rgba(57, 33, 163);
    }
</style>


<div class="header-container">
        <button id="openNav" class="w3-button w3-xlarge nav-button" onclick="w3_open()">&#9776;</button>
        <div class="w3-container" >
            <h1>Approved Payments</h1>
        </div>
    </div>
    <div id="main" onclick="w3_close()">

    <div class="container" style="width: 80%; height: auto; border: 1px solid #ccc; padding: 20px;">
        <form action="/approvedpayment" method="GET">
            @csrf
            <div class="fee-list">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div class="d-flex">
                        <div class="input-group mr-3">
                            <input type="text" class="form-control" placeholder="Search..." aria-label="Search"
                                name="search" id="searchInput" onkeyup="filterTable()">
                            <div class="input-group-append">
                                <button class="refresh" type="submit">Refresh Search</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped" id="studentTable">
                        <thead>
                            <tr>
                                <th>Status</th>
                                <th>Last Name</th>
                                <th>First Name</th>
                                <th>Middle Name</th>
                                <th>Year Level</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($students as $student)
                            @php
                                // Fetch all payment records for the current student
                                $payments = App\Models\payment_form::where('payment_id', $student->id)->where('status', 'approved')->get(); // Get only approved payments
                            @endphp
                        
                            @if ($payments->isNotEmpty())
                                <tr>
                                    <td>{{ $payments->first()->status }}</td> <!-- Show the status of the first approved payment -->
                                    <td>{{ $student->lastname }}</td>
                                    <td>{{ $student->firstname }}</td>
                                    <td>{{ $student->middlename }}</td>
                                    <td>
                                        {{ $payments->first()->level ?? 'N/A' }} <!-- Show level of the first approved payment -->
                                    </td>
                                    <td>
                                        <a href="/proofofpayment/{{ $payments->first()->id }}"
                                           class="viewpayment" title="View Payment">
                                            View
                                        </a>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    function filterTable() {
        const input = document.getElementById('searchInput');
        const filter = input.value.toLowerCase();
        const table = document.getElementById('studentTable');
        const tr = table.getElementsByTagName('tr');

        for (let i = 1; i < tr.length; i++) { // Start from 1 to skip the header row
            const td = tr[i].getElementsByTagName('td');
            let rowVisible = false;

            // Check each cell in the row for a match
            for (let j = 0; j < td.length; j++) {
                if (td[j]) {
                    const cellValue = td[j].textContent || td[j].innerText;
                    if (cellValue.toLowerCase().indexOf(filter) > -1) {
                        rowVisible = true; // Row matches search criteria
                        break;
                    }
                }
            }

            // Show or hide the row based on whether it matches the search
            tr[i].style.display = rowVisible ? '' : 'none';
        }
    }
</script>

@include('templates.cashierfooter')
