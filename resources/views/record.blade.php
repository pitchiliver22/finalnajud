@include('templates.recordheader')

<style>
    body {
        font-family: Arial, sans-serif;
        background-color: white;
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
        background-color: #0c3b6d; 
    }

    h1 {
        margin: 0; 
        font-size: 15px;
        text-transform:uppercase;
    
        
    }

   

    .container {
        margin: 100px; /* Add margin to container */
        display: flex;
        flex-direction: column;
        align-items: center; /* Center contents */
    }

    .card {
        border-radius: 8px;
        transition: transform 0.2s, box-shadow 0.2s;
        width: 100%; /* Full width for smaller screens */
        max-width: 600px; /* Limit max width */
        margin: 10px 0; /* Add margin for spacing */
    }

    .card:hover {
        transform: translateY(-3px);
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
    }

    .card-header {
        background-color: #0c3b6d; /* Match card header color */
        color: white;
    }

    .list-group-item {
        transition: background-color 0.3s;
    }

    .list-group-item:hover {
        background-color: #e9ecef; /* Light hover effect */
    }


    .text-center {
        text-align: center;
    }
    .accountsummary{
        background-color: rgba(8, 16, 66, 1); 
        color:white;
        padding:10px;
        text-align:center;
    }
    .studinfo{
        background-color: rgba(8, 16, 66, 1); 
        color:white;
        padding:10px;
        margin-top:-5%;
    }
</style>

    <div class="header-container">
        <button id="openNav" class="w3-button w3-xlarge" onclick="w3_open()">&#9776;</button>
        <h1>Records Dashboard</h1>
    </div>

    <div id="main" onclick="w3_close()">


    <div class="container mt-4 mb-5">
        <div class="row">
            <!-- Account Summary Card -->
            <div class="col-md-12 mb-4">
                <div class="card border-primary shadow-sm">
                    <div class="accountsummary">
                        <h5>Account Summary</h5>
                    </div>
                    <div class="card-body text-center">
                        <p class="h4">Pending Accounts: <span class="text-warning">{{ $pendingCount }}</span></p>
                        <p class="h4">Approved Accounts: <span class="text-success">{{ $approvedCount }}</span></p>
                    </div>
                </div>
            </div>

            <!-- Student Information Card -->
            <div class="col-md-12 mb-4">
                <div class="card shadow-sm">
                    <div class="studinfo">
                        <h5>Student Information</h5>
                    </div>
                    <div class="card-body">
                        <ul class="list-group">
                            @foreach ($students as $student)
                                <li class="list-group-item">{{ $student->firstname }} {{ $student->lastname }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<style>
    body {
        font-family: 'Arial', sans-serif;
        background-color: #f8f9fa;
        margin: 0;
        padding: 0;
    }

    .w3-teal {
        background-color: #007bff;
    }

    .card {
        border-radius: 8px;
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

    h1,
    h5 {
        margin: 0;
    }

    .text-center {
        text-align: center;
    }
</style>

@include('templates.recordfooter')
