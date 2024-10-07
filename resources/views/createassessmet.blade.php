@include('templates.accountingheader')

<div id="main">
    <div class="w3-teal">
        <button id="openNav" class="w3-button w3-teal w3-xlarge" onclick="w3_open()">&#9776;</button>
        <div class="w3-container">
            <h1>ASSESSMENT</h1>
        </div>
    </div>

    <form action="/createassessmet" method="GET">
        <div class="container my-5">
            <h1 class="mb-4">Assessment Creator</h1>

            <form id="assessment-form">
                <div class="mb-3">
                    <label for="school-year" class="form-label">School Year:</label>
                    <select id="school-year" name="school-year" class="form-select" required>
                        <option value="">Select School Year</option>
                        <option value="2021-2022">2021-2022</option>
                        <option value="2022-2023">2022-2023</option>
                        <option value="2024-2025">2024-2025</option>
                        <option value="2025-2026">2025-2026</option>
                        <option value="2026-2027">2026-2027</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="grade-level" class="form-label">Grade Level:</label>
                    <select id="grade-level" name="grade-level" class="form-select" required>
                        <option value="">Select Grade Level</option>
                        <option value="kindergarten">Kindergarten</option>
                        <option value="grade1">Grade 1</option>
                        <option value="grade2">Grade 2</option>
                        <option value="grade3">Grade 3</option>
                        <option value="grade4">Grade 4</option>
                        <option value="grade5">Grade 5</option>
                        <option value="grade6">Grade 6</option>
                        <option value="grade7">Grade 7</option>
                        <option value="grade8">Grade 8</option>
                        <option value="grade9">Grade 9</option>
                        <option value="grade10">Grade 10</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="assessment-name" class="form-label">Assessment Name:</label>
                    <input type="text" id="assessment-name" name="assessment-name" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="assessment-description" class="form-label">Assessment Description:</label>
                    <textarea id="assessment-description" name="assessment-description" class="form-control" required></textarea>
                </div>

                <div class="mb-3">
                    <label for="assessment-date" class="form-label">Assessment Date:</label>
                    <input type="date" id="assessment-date" name="assessment-date" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="assessment-time" class="form-label">Assessment Time:</label>
                    <input type="time" id="assessment-time" name="assessment-time" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="assessment-fee" class="form-label">Assessment Fee:</label>
                    <input type="number" id="assessment-fee" name="assessment-fee" class="form-control" min="0"
                        step="0.01" required>
                </div>

                <button type="submit" class="btn btn-primary">Create Assessment</button>
            </form>
        </div>
    </form>
    <script>
        const assessmentsByYear = {
            '2021-2022': [],
            '2022-2023': [],
            '2024-2025': [],
            '2025-2026': [],
            '2026-2027': []

        };

        const form = document.getElementById('assessment-form');

        form.addEventListener('submit', (event) => {
            event.preventDefault();

            const formData = new FormData(form);
            const assessment = {
                schoolYear: formData.get('school-year'),
                gradeLevel: formData.get('grade-level'),
                name: formData.get('assessment-name'),
                description: formData.get('assessment-description'),
                date: formData.get('assessment-date'),
                time: formData.get('assessment-time'),
                fee: parseFloat(formData.get('assessment-fee'))
            };

            assessmentsByYear[assessment.schoolYear].push(assessment);
            console.log(assessmentsByYear);
            // You can add logic to save the assessment data here
        });
    </script>


</div>
@include('templates.accountingfooter')
