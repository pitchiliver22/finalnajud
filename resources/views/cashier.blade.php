@include('templates.cashierheader')

<style>
  

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
        padding: 0px;
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




    .btn {
      
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
        font-family: 'Arial', sans-serif;
        margin-left:-2%;
        margin-top:8%;
        text-transform:uppercase;
        
    }
    .card-header{
        background-color: rgba(8, 16, 66, 1); 
    
    }
    .studinfo{
        color:white;
    }
  
 
</style>

<div class="header-container">
        <button id="openNav" class="w3-button w3-xlarge nav-button" onclick="w3_open()">&#9776;</button>
      
        <div class="w3-container">
        <h1>Cashier Dashboard</h1>
          
            
        </div>
    </div>
    
    <div id="main" onclick="w3_close()">

    <div class="w3-sidebar w3-bar-block w3-card w3-animate-left" style="display:none" id="mySidebar">
        <button class="w3-bar-item w3-button w3-large" onclick="w3_close()">Close &times;</button>
        <a href="/principal" class="w3-bar-item w3-button">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                class="bi bi-house-check-fill" viewBox="0 0 16 16">
                <path
                    d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L8 2.207l6.646 6.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293z" />
                <path d="m8 3.293 4.712 4.712A4.5 4.5 0 0 0 8.758 15H3.5A1.5 1.5 0 0 1 2 13.5V9.293z" />
                <path
                    d="m12.5 16 a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7m1.679-4.493-1.335 2.226a.75.75 0 0 1-1.174.144l-.774-.773a.5.5 0 0 1 .708-.707l.547.547 1.17-1.951a.5.5 0 1 1 .858.514" />
            </svg>
            HOME
        </a>
    </div>

    <div class="container mt-4 mb-5">
        <div class="row">
            <!-- Account Summary Card -->
            <div class="col-md-12 mb-4">
                <div class="card border-primary shadow-sm">
                    <div class="card-header text-white" style="text-align:center;">
                        <h5 class="mb-0">Payment Summary</h5>
                    </div>
                    <div class="card-body text-center">
                        <p class="h4">Pending Payment: <span class="text-warning">{{ $pendingCount }}</span></p>
                        <p class="h4">Approved Payment: <span class="text-success">{{ $approvedCount }}</span></p>
                    </div>
                </div>
            </div>

            <!-- Student Information Card -->
            <div class="col-md-12 mb-4">
                <div class="card shadow-sm">
                    <div class="card-header">
                        <h5 class="studinfo">Student Information</h5>
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

@include('templates.cashierfooter')
