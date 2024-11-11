@include('templates.principalheader')

<div id="main">
    <div class="w3-teal">
        <button id="openNav" class="w3-button w3-teal w3-xlarge" onclick="w3_open()">&#9776;</button>
        <div class="w3-container">
            <h1>Section Information</h1>
        </div>
    </div>

    <div class="container" style="max-width: 600px; margin: auto; padding: 20px;">
        <style>
            body {
                font-family: 'Arial', sans-serif;
                background-color: #f0f4f8;
                margin: 0;
                padding: 20px;
            }

            .container {
                background: white;
                padding: 20px;
                border-radius: 10px;
                box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
                border: 1px solid #ccc;
            }

            h1, h2 {
                text-align: center;
                color: #2c3e50;
                margin-bottom: 20px;
                font-size: 24px;
                font-weight: 600;
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
            }

            button:hover {
                background-color: #0056b3;
            }

            @media (max-width: 600px) {
                h1, h2 {
                    font-size: 20px;
                }
            }
        </style>

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