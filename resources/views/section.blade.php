@include('templates.principalheader')

<div class="header-container">
        <button id="openNav" class="navvers" onclick="w3_open()">&#9776;</button>
        <h1>Assessments Overview</h1>
    </div>
    <div id="main" onclick="w3_close()">

    <div class="container">
        <style>
            body {
                font-family: 'Arial', sans-serif;
                background-color: #f0f4f8;
                margin: 0;
  
            }

            .container {
                max-width: 1300px;
                margin: auto;
                background: white;
                padding: 30px;
                border-radius: 10px;
                box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
                margin-top:2%;
            }
            .header-container {
            display: flex;
            align-items: center;
            background-color: rgba(8, 16, 66, 1);
            color: white;
            padding: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.5);
            max-width:500%;
            }
            .header-container h1{
                margin: 0; 
                font-size: 15px;
                color:white;
                margin-left:2%;
                text-transform:uppercase;
            }
            h1 {
                text-align: center;
                color: #2c3e50;
                margin-bottom: 20px;
                font-size: 24px;
                font-weight: 600;
            }
            .navvers{
            background-color:rgba(8, 16, 66, 1); 
            border-width:0;
            color:white;
            padding:15px;

            }
            .navvers:hover{
                color:yellow;
                background-color:rgba(8, 16, 66, 1); 
            }
            .alert {
                padding: 15px;
                margin-bottom: 20px;
                border-radius: 5px;
                color: #fff;
            }

            .alert-success {
                background-color: #28a745; /* Green */
            }

            .alert-danger {
                background-color: #dc3545; /* Red */
            }

            .info-row {
                display: flex;
                justify-content: space-between;
                margin-bottom: 15px;
                padding: 10px 0;
                border-bottom: 1px solid #e0e0e0;
            }

            .label {
                font-weight: bold;
                color: #2980b9;
            }

            input[type="text"] {
                width: 100%;
                padding: 10px;
                margin-top: 10px;
                border: 1px solid #ccc;
                border-radius: 5px;
                font-size: 14px;
            }

            input[type="text"]:focus {
                border-color: #2980b9;
                outline: none;
                box-shadow: 0 0 5px rgba(41, 128, 185, 0.5);
            }

            table {
                width: 100%;
                border-collapse: collapse;
                margin-top: 20px;
                box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
                overflow-x: auto;
            }

            th, td {
                border: 1px solid #ddd;
                padding: 12px;
                text-align: left;
            }

            th {
                background-color: #2980b9;
                color: white;
                font-weight: bold;
            }

            tr:hover {
                background-color: #f2f2f2;
            }

            tr:nth-child(even) {
                background-color: #f9f9f9;
            }

            tr:nth-child(odd) {
                background-color: #ffffff;
            }

            button {
                background-color: #2980b9;
                color: white;
                border: none;
                padding: 10px 20px;
                border-radius: 5px;
                cursor: pointer;
                font-size: 16px;
                transition: background-color 0.3s;
            }

            button:hover {
                background-color: #1a6b8f;
            }

            @media (max-width: 600px) {
                .info-row {
                    flex-direction: column;
                    align-items: flex-start;
                }

                .info-row div {
                    margin-bottom: 10px;
                    width: 100%;
                }

                table {
                    display: block;
                    overflow-x: auto;
                    white-space: nowrap;
                }

                th, td {
                    min-width: 120px;
                    padding: 10px 5px;
                }

                h1 {
                    font-size: 20px;
                }

                input[type="text"] {
                    font-size: 16px;
                }

                button {
                    width: 100%;
                    padding: 12px;
                }
            }
        </style>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @elseif (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <form action="/section" method="POST">
            @csrf
            <input type="hidden" name="grade" value="{{ $proof->level }}">
            <input type="hidden" name="payment_id" value="{{ $proof->payment_id }}">
            
            <div class="info-row">
                <div>
                    <span class="label">Name:</span> {{ $students->firstname }} {{ $students->middlename }} {{ $students->lastname }} {{ $students->suffix }}
                </div>
                <div><span class="label">1st Semester S.Y. 2024 - 2025</span></div>
            </div>
            
            <div class="info-row">
                <div><span class="label">Year Level:</span> {{ $proof->level }}</div>
            </div>

            <h2>Assign Classes</h2>
            <input type="text" id="searchInput" onkeyup="searchClasses()" placeholder="Search for classes..." aria-label="Search for classes">
            <table>
                <thead>
                    <tr>
                        <th style="display: none;">Select</th>
                        <th>Teacher</th>
                        <th>EDP Code</th>
                        <th>Subject</th>
                        <th>Description</th>
                        <th>Type</th>
                        <th>Units</th>
                        <th>Days</th>
                        <th>Time</th>
                        <th>Room</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody id="classTableBody">
                    @foreach ($classes as $class)
                        @if ($class->grade === $proof->level)
                            <tr>
                                <td style="display: none;">
                                    <input type="checkbox" name="selected_classes[]" value="{{ $class->edpcode }}" checked>
                                </td>
                                <td>{{ $class->adviser }}</td>
                                <td>{{ $class->edpcode }}</td>
                                <td>{{ $class->subject }}</td>
                                <td>{{ $class->description }}</td>
                                <td>{{ $class->type }}</td>
                                <td>{{ $class->unit }}</td>
                                <td>{{ $class->days }}</td>
                                <td>{{ date('h:i A', strtotime($class->startTime)) }} - {{ date('h:i A', strtotime($class->endTime)) }}</td>
                                <td>{{ $class->room }}</td>
                                <td>Active</td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
            <br>
            <button type="submit">Assign Selected Classes</button>
        </form>
    </div>

    <script>
        function searchClasses() {
            const input = document.getElementById('searchInput');
            const filter = input.value.toLowerCase();
            const table = document.getElementById('classTableBody');
            const rows = table.getElementsByTagName('tr');

            for (let i = 0; i < rows.length; i++) {
                const cells = rows[i].getElementsByTagName('td');
                let rowContainsSearchTerm = false;

                for (let j = 1; j < cells.length; j++) { // Start from 1 to skip the checkbox column
                    if (cells[j]) {
                        const cellText = cells[j].textContent || cells[j].innerText;
                        if (cellText.toLowerCase().includes(filter)) {
                            rowContainsSearchTerm = true;
                            break;
                        }
                    }
                }

                rows[i].style.display = rowContainsSearchTerm ? "" : "none";
            }
        }
    </script>
</div>

@include('templates.principalfooter')