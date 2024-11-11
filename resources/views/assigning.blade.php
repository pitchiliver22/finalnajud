@include('templates.principalheader')

<div id="main">
    <div class="w3-teal">
        <button id="openNav" class="w3-button w3-teal w3-xlarge" onclick="w3_open()">&#9776;</button>
        <div class="w3-container">
            <h1>Available Sections</h1>
        </div>
    </div>

    <div class="container">
        <style>
            body {
                font-family: 'Arial', sans-serif;
                background-color: #f0f4f8;
                margin: 0;
                padding: 20px;
            }

            .container {
                max-width: 1300px;
                margin: auto;
                background: white;
                padding: 30px;
                border-radius: 10px;
                box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            }

            h1 {
                text-align: center;
                color: #2c3e50;
                margin-bottom: 20px;
                font-size: 28px;
                font-weight: 600;
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

            input[type="text"] {
                width: 100%;
                padding: 10px;
                margin-bottom: 20px;
                border: 1px solid #ccc;
                border-radius: 4px;
                font-size: 16px;
            }

            table {
                width: 100%;
                border-collapse: collapse;
                margin-top: 20px;
                box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            }

            th, td {
                border: 1px solid #ddd;
                padding: 12px;
                text-align: left;
                cursor: pointer; /* Add cursor pointer for rows */
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

            @media (max-width: 600px) {
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
                    font-size: 22px;
                }

                input[type="text"] {
                    font-size: 14px;
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

        <h2>Assign Classes</h2>
        <input type="text" id="searchInput" onkeyup="searchClasses()" placeholder="Search for classes..." aria-label="Search for classes">

        <table>
            <thead>
                <tr>
                    <th>Year Level</th>
                    <th>Teacher</th>
                    <th>Section</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody id="classTableBody">
                @php
                    $uniqueSections = [];

                    foreach ($classes as $class) {
                        if ($class->grade === $proof->level && !in_array($class->section, $uniqueSections)) {
                            $uniqueSections[] = $class->section; 
                @endphp
                            <tr onclick="redirectToSection('{{ $class->id }}', '{{ $class->section }}', '{{ $proof->id }}')">
                                <td>{{ $class->grade }}</td>
                                <td>{{ $class->adviser }}</td>
                                <td>{{ $class->section }}</td>
                                <td>Active</td>
                            </tr>
                @php
                        }
                    }
                @endphp
            </tbody>
        </table>

    </div>
</div>

@include('templates.principalfooter')

<script>
    function searchClasses() {
        const input = document.getElementById('searchInput');
        const filter = input.value.toLowerCase();
        const table = document.getElementById('classTableBody');
        const rows = table.getElementsByTagName('tr');

        for (let i = 0; i < rows.length; i++) {
            const cells = rows[i].getElementsByTagName('td');
            let rowContainsSearchTerm = false;

            for (let j = 0; j < cells.length; j++) {
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

    function redirectToSection(id, sectionName, paymentId) {
        window.location.href = `/section/${paymentId}/${sectionName}`;
    }
</script>