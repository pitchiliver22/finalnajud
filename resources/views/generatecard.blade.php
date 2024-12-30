@include('templates.teacherheader')

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
        color:white;
        padding: 10px; 
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.5); 
            }

    h1 {
        margin: 0; 
        font-size: 15px;
        text-transform:uppercase;
       
    }

    .container {
        width: 80%;
        height: auto;
        border: 1px solid #ccc;
        padding: 20px;
        margin: 20px auto;
        background-color: #f9f9f9;
        border-radius: 5px;
    }

    .fee-list {
        margin-bottom: 20px;
    }

    .table-responsive {
        margin-top: 10px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    th, td {
        padding: 10px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    th {
        background-color: #0c3b6d;
        color: black;
    }

    .btn {
        background-color: #0c3b6d;
        color: white;
        border: none;
        padding: 5px 10px;
        text-decoration: none;
        border-radius: 5px;
        transition: background-color 0.3s;
    }

    .btn:hover {
        background-color: #093d5e;
    }

    .input-group {
        display: flex;
        align-items: center;
    }

    .input-group input {
        border: 1px solid #ccc;
        border-radius: 5px;
        padding: 5px;
    }

    .input-group .btn-outline-secondary {
        border: 1px solid #0c3b6d;
        background-color: white;
        color: #0c3b6d;
        border-radius: 5px;
    }

    .input-group .btn-outline-secondary:hover {
        background-color: #0c3b6d;
        color: white;
    }

    /* Sidebar styles */
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
        padding: 0px;
    }
</style>

<div class="header-container"> 
        <button id="openNav" class="w3-button w3-xlarge nav-button" onclick="w3_open()">&#9776;</button>
        <div class="w3-container">
            <h1>Teacher Generate Report Card</h1>
        </div>
    </div>
    <div id="main" onclick="w3_close()">

    <div class="container" style="width: 80%; height: auto; border: 1px solid #ccc; padding: 20px;">
        <form action="/teacherclassload" method="GET">
            @csrf
            <div class="fee-list">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div class="d-flex">
                        <div class="input-group mr-3">
                            <input type="text" class="form-control" placeholder="Search..." aria-label="Search" name="search">
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" type="submit">Refresh Search</button>
                            </div>
                        </div>
                    </div>
                </div>
          

                <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Full Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($students as $student)
                            <tr>
                            <td>{{ $student->firstname }} {{ $student->middlename }} {{ $student->lastname }} {{$student->suffix}}</td>
                            <td>
                                <a href="/studentcard/{{ $student->id }}" 
                                    class="btn btn-info btn-sm view-studententry">
                                    View Report Card
                                 </a>
                            </td>
                            </tr>
                                @endforeach
                            </tbody>
                        </table>
                </div>
            </div>
        </form>
    </div>
</div>

@include('templates.teacherfooter')