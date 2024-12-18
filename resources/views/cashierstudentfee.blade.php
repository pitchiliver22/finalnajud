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

    

    #main {
        transition: margin-left .3s;
        padding: 10px;
      
    }

    .card {
        border-radius: 10px;
        transition: transform 0.2s, box-shadow 0.2s;
    }

    .card:hover {
        transform: translateY(-3px);
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
    }

    .list-group-item {
        transition: background-color 0.3s;
    }

    .list-group-item:hover {
        background-color: #e9ecef;
    }


    .text-center {
        text-align: center;
    }

    .btn {
        background-color: #0c3b6d;
        color: white;
        border: none;
        padding: 10px 15px;
        text-decoration: none;
        border-radius: 5px;
        transition: background-color 0.3s;
    }

    .btn:hover {
        background-color: #093d5e;
    }
    h1{
        font-size:14px;
        text-transform:uppercase;
        margin-left:-15%;
    }
    .approvebtn{
        background-color:rgba(56, 135, 30);
        color:white;
        border-radius:10px;
        box-shadow: 0px 2px 10px rgba(0,0,0,0.3);
        border-width:0;
        padding:8px;
        text-transform:uppercase;
        font-size:13px;
    }
    .approvebtn:hover{
        background-color:rgba(44, 110, 23);
    }
    .container{
        margin-top:2%;
        border-radius:10px;
    
    }
    .refresh{
        background-color:rgba(35, 17, 112);
        color:white;
        padding:5px;
    }
    .refresh:hover{
        background-color:rgba(57, 33, 163);
    }
    .view{
        background-color:rgba(79, 194, 25);
        color:white;
        padding:7px;
        text-decoration:none;
        border-width:0;
        border-radius:7px;
    }
    .view:hover{
        background-color:rgba(63, 145, 25);
        color:white;
    }
</style>

 <div class="header-container">
        <button id="openNav" class="w3-button w3-xlarge nav-button" onclick="w3_open()">&#9776;</button>
        <div class="w3-container" style="margin-left: 15px;">
            <h1>Pending Payments</h1>
        </div>
    </div>
    <div id="main" onclick="w3_close()">
    <div class="container" style="width: 80%; border: 1px solid #ccc; padding: 20px;">
        <form action="/cashierstudentfee" method="POST">
            @csrf
            <div class="fee-list">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4>Pending Student Fees</h4>
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
                                <th>
                                    <input type="checkbox" id="selectAll" onclick="toggleSelectAll(this)">
                                    <label for="selectAll" style="margin-left: 5px;">Select All</label>
                                </th>
                                <th>Status</th>
                                <th>Last Name</th>
                                <th>First Name</th>
                                <th>Middle Name</th>
                                <th>Year Level</th>
                                <th>Fee Type</th>
                                <th>Amount</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($students as $student)
                            @php
                                $payment = $payments->firstWhere('payment_id', $student->id); 
                                $status = $payment ? $payment->status : 'No payment';
                            @endphp
                            @if ($payment && $status === 'pending') 
                                <tr>
                                    <td>
                                        <input type="checkbox" name="payments[]" value="{{ $payment->id }}" class="paymentCheckbox">
                                    </td>
                                    <td>{{ $status }}</td>
                                    <td>{{ $student->lastname }}</td>
                                    <td>{{ $student->firstname }}</td>
                                    <td>{{ $student->middlename }}</td>
                                    <td>{{ $payment->level ?? 'N/A' }}</td>
                                    <td>{{ $payment->fee_type ?? 'N/A' }}</td>
                                    <td>{{ $payment->amount ?? 'N/A' }}</td>
                                    <td>
                                        <a href="{{ url('proofofpayment/' . $payment->id) }}"
                                        class="view" title="View">
                                            View
                                        </a>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="mt-3">
                    <button type="submit" class="approvebtn">Approve Selected Payments</button>
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

    function toggleSelectAll(selectAllCheckbox) {
        const checkboxes = document.querySelectorAll('.paymentCheckbox');
        checkboxes.forEach(checkbox => {
            checkbox.checked = selectAllCheckbox.checked;
        });
    }
</script>

@include('templates.cashierfooter')