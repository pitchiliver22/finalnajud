@include('templates.principalheader')

<div id="main">
    <div class="w3-teal">
        <button id="openNav" class="w3-button w3-teal w3-xlarge" onclick="w3_open()">&#9776;</button>
        <div class="w3-container">
            <h1>Section Information</h1>
        </div>
    </div>
    <br><br>

    <div class="container">
        <style>
            body {
                font-family: 'Arial', sans-serif;
                background-color: #f0f4f8;
                margin: 0;
                padding: 20px;
            }

            .container {
                max-width: 1200px;
                margin: auto;
                padding: 20px;
                background: white;
                border-radius: 10px;
                box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
                display: flex;
                flex-wrap: wrap;
                gap: 20px;
            }

            h1, h2 {
                text-align: center;
                color: #2c3e50;
                margin-bottom: 20px;
                font-size: 24px;
                font-weight: 600;
            }

            .alert {
                background-color: #f8d7da; /* Light red background */
                color: #721c24; /* Dark red text */
                padding: 15px;
                border: 1px solid #f5c6cb; /* Light red border */
                border-radius: 5px;
                width: 100%; /* Full width of the container */
                margin-bottom: 20px; /* Space below the alert */
                display: flex;
                flex-direction: column; /* Stack items vertically */
            }

            .alert ul {
                list-style-type: none; /* Remove bullet points */
                margin: 0;
                padding: 0;
            }

            .alert li {
                margin: 5px 0; /* Space between error messages */
            }

            .form-section, .table-section {
                flex: 1;
                min-width: 300px;
                background: #f9f9f9;
                padding: 20px;
                border-radius: 8px;
                box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            }

            label {
                display: block;
                margin-bottom: 5px;
                font-weight: bold;
            }

            input, textarea, select {
                width: 100%;
                padding: 10px;
                margin-bottom: 15px;
                border: 1px solid #ccc;
                border-radius: 4px;
            }

            button {
                width: 100%;
                padding: 10px;
                background-color: #007bff;
                color: white;
                border: none;
                border-radius: 4px;
                font-size: 16px;
                cursor: pointer;
                margin-top: 10px;
                transition: background-color 0.3s;
            }

            button:hover {
                background-color: #0056b3;
            }

            table {
                width: 100%;
                border-collapse: collapse;
                margin-top: 20px;
            }

            th, td {
                padding: 10px;
                text-align: left;
                border-bottom: 1px solid #ccc;
            }

            th {
                background-color: #007bff;
                color: white;
            }

            tr:hover {
                background-color: #f1f1f1;
            }

            .icon-button {
                background: none;
                border: none;
                cursor: pointer;
                color: #007bff;
                font-size: 24px; /* Increased size for visibility */
                width: 36px; /* Set width */
                height: 36px; /* Set height */
                display: inline-flex;
                align-items: center;
                justify-content: center;
            }

            .icon-button:hover {
                color: #0056b3;
            }
        </style>

        @if ($errors->any())
        <div class="alert" id="error-alert">
            <span>Error(s) occurred:</span>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        <script>
            // Set a timeout to hide the error alert after 2 seconds
            setTimeout(() => {
                const alert = document.getElementById('error-alert');
                if (alert) {
                    alert.style.display = 'none';
                }
            }, 2000);
        </script>
        @endif

        <div class="form-section">
            <h2>Create Section & Schedule</h2>
            <form action="/createsection" method="POST">
                @csrf
                <label for="grade">Grade:</label>
                <select class="form-control" id="grade" name="grade" required onchange="updateSections()">
                    <option value="">Select Grade</option>
                    <option value="K">Kindergarten</option>
                    @for ($i = 1; $i <= 10; $i++)
                        <option value="Grade {{ $i }}">Grade {{ $i }}</option>
                    @endfor
                </select>

                <div class="col">
                    <label for="section">Section</label>
                    <select class="form-control" id="section" name="section" required onchange="handleSectionChange()">
                        <option value="">Select Section</option>
                    </select>
                </div>

                <button type="submit">Proceed to add schedules</button>
            </form>
        </div>

        <div class="table-section">
            <h2>Existing Sections</h2>
            <table>
                <thead>
                    <tr>
                        <th>Grade</th>
                        <th>Section</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($sections as $section)
                        <tr>
                            <td>{{ $section->grade }}</td>
                            <td>{{ $section->section }}</td>
                            <td>
                                <a href="{{ route('principalclassload', ['grade' => $section->grade, 'section' => $section->section]) }}" class="icon-button" title="Edit Schedule">&#9998;</a>
                                <form action="{{ route('section.delete', $section->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Are you sure you want to delete this section?');" class="icon-button" title="Delete Section">&#10060;</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@include('templates.principalfooter')

<script>
    const sectionsByGrade = {
        'K': ["Faith"],
        'Grade 1': ["Joy"],
        'Grade 2': ["Love"],
        'Grade 3': ["Peace"],
        'Grade 4': ["Charity"],
        'Grade 5': ["Hope"],
        'Grade 6': ["Respect"],
        'Grade 7': ["Emerald", "Diamond", "Gold", "Sapphire"],
        'Grade 8': ["Emerald", "Gold", "Sapphire"],
        'Grade 9': ["Emerald", "Diamond", "Gold", "Sapphire"],
        'Grade 10': ["Emerald", "Diamond", "Ruby", "Sapphire", "Gold"]
    };

    function updateSections() {
        const grade = document.getElementById('grade').value;
        const sectionSelect = document.getElementById('section');
        sectionSelect.innerHTML = '<option value="">Select Section</option>'; // Reset options

        if (sectionsByGrade[grade]) {
            sectionsByGrade[grade].forEach(section => {
                const option = document.createElement('option');
                option.value = section;
                option.textContent = section;
                sectionSelect.appendChild(option);
            });
            // Add option to add a new section
            const addOption = document.createElement('option');
            addOption.value = 'add';
            addOption.textContent = 'Add New Section';
            sectionSelect.appendChild(addOption);
        }
    }

    function handleSectionChange() {
        const sectionSelect = document.getElementById('section');
        if (sectionSelect.value === 'add') {
            const grade = document.getElementById('grade').value;
            const newSection = prompt("Enter new section name:");

            if (newSection && grade) {
                if (!sectionsByGrade[grade].includes(newSection)) {
                    sectionsByGrade[grade].push(newSection);
                    updateSections();
                    sectionSelect.value = newSection; // Select the newly added section
                    alert("Section added successfully!");
                } else {
                    alert("Section already exists for this grade.");
                }
            } else {
                alert("Please select a grade first.");
            }
        }
    }
</script>