@include('templates.principalheader')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

<style>
    body {
        background-color: #f8f9fa;
    }
    .form-container {
        background: white;
        padding: 2rem;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        max-width: 600px;
        margin: auto;
    }
    h1 {
        margin-bottom: 1.5rem;
    }
    .form-group {
        margin-bottom: 1.5rem;
    }
    label {
        font-weight: bold;
    }
    .subjects {
        margin-top: 10px;
        display: none;
        border: 1px solid #ddd;
        padding: 10px;
        border-radius: 5px;
    }
    .checkbox-group div {
        margin-left: 1.5rem;
    }
    .text-center {
        margin-top: 1.5rem;
    }
    .btn {
        width: 100%;
        padding: 10px;
    }
    .header-container {
        display: flex; 
        align-items: center; 
        background-color: #0c3b6d; 
        color: white;
        padding: 10px; 
    }
</style>

<div id="main">
    <div class="w3-teal">
        <div class="header-container">
            <button id="openNav" class="w3-button w3-xlarge nav-button" onclick="w3_open()">&#9776;</button>
            <h1 class="text-light">Teachers and Subjects</h1>
        </div>
    </div>
    <br>
    <div class="container d-flex justify-content-center align-items-start" style="min-height: 80vh;">
        <div class="form-container">
            <h1 class="text-center">Assign Teacher to Subject</h1>

            <form action="/principalteacher" method="POST" id="myForm">
                @csrf
                <div class="form-group">
                    <label for="teacher">Teacher</label>
                    <select class="form-control" id="teacher" name="name" required onchange="updateUserId(this)">
                        <option value="">Select a Teacher</option>
                        @foreach ($teachers as $teacher)
                            <option value="{{ $teacher['id'] }}" data-user-id="{{ $teacher['user_id'] }}">
                                {{ $teacher['name'] }}
                            </option>
                        @endforeach
                    </select>
                </div>
                
                <input type="hidden" name="user_id" id="user_id"> <!-- Hidden input for user ID -->

                <div class="form-group">
                    <label for="grade">Select Grade Level</label>
                    <select class="form-control" id="grade" name="grade" onchange="showSubjects(this.value)">
                        <option value="">Select Grade</option>
                        @foreach (range(1, 10) as $grade)
                            <option value="Grade {{ $grade }}">Grade {{ $grade }}</option>
                        @endforeach
                    </select>
                </div>
            
                <div id="subjects" class="checkbox-group">
                    @foreach ([
                        'Grade 1' => ["Mother tongue", "Filipino", "Reading", "Language", "Mathematics", "Science", "AP", "ESP", "Computer", "MAPEH"],
                        'Grade 2' => ["Mother tongue", "Filipino", "Reading", "Language", "Mathematics", "Science", "AP", "ESP", "Computer", "MAPEH"],
                        'Grade 3' => ["Mother tongue", "Filipino", "Reading & Phonics", "Language & Spelling", "Mathematics", "Science", "AP", "ESP", "Computer", "MAPEH"],
                        'Grade 4' => ["Mother tongue", "Filipino", "Reading", "Language", "Mathematics", "Science", "AP", "ESP", "Computer", "MAPEH"],
                        'Grade 5' => ["Mother tongue", "Filipino", "Reading", "Language", "Mathematics", "Science", "AP", "ESP", "Computer", "MAPEH"],
                        'Grade 6' => ["Filipino", "Reading", "Language", "Mathematics", "Science", "AP", "ESP", "Computer", "HELE (EPP)", "MAPEH"],
                        'Grade 7' => ["Filipino", "English", "Mathematics", "Science", "AP", "ESP", "TLE/Computer", "MAPEH"],
                        'Grade 8' => ["Filipino", "English", "Mathematics", "Science", "AP", "ESP", "TLE/Computer", "MAPEH"],
                        'Grade 9' => ["Filipino", "English", "Mathematics", "Science", "AP", "ESP", "TLE", "MAPEH"],
                        'Grade 10' => ["Filipino", "English", "Mathematics", "Science", "AP", "ESP", "TLE", "MAPEH"]
                    ] as $grade => $subjects)
                        <div class="subjects" id="{{ strtolower(str_replace(' ', '-', $grade)) }}">
                            <h4>{{ $grade }} Subjects:</h4>
                            @foreach ($subjects as $subject)
                                <div>
                                    <input type="checkbox" id="{{ strtolower(str_replace(' ', '-', $subject)) }}" name="subject[]" value="{{ $subject }}">
                                    <label for="{{ strtolower(str_replace(' ', '-', $subject)) }}">{{ $subject }}</label>
                                </div>
                            @endforeach
                        </div>
                    @endforeach
                </div>
            
                <input type="hidden" name="concatenated_subjects" id="concatenated_subjects">
            
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
            
            <script>
                function updateUserId(selectElement) {
                    const userId = selectElement.options[selectElement.selectedIndex].dataset.userId;
                    document.getElementById('user_id').value = userId;
                }

                document.getElementById('myForm').onsubmit = function() {
                    const checkboxes = document.querySelectorAll('input[name="subject[]"]:checked');
                    const selectedSubjects = Array.from(checkboxes).map(cb => cb.value);
                    const concatenatedSubjects = selectedSubjects.join(', ');
                    document.getElementById('concatenated_subjects').value = concatenatedSubjects;

                    console.log('Concatenated Subjects:', concatenatedSubjects);
                    
                    toastr.success('Teacher assigned successfully.');
                };
            
                function showSubjects(grade) {
                    document.querySelectorAll('.subjects').forEach(subjectList => {
                        subjectList.style.display = 'none';
                    });
                    if (grade) {
                        document.getElementById(grade.toLowerCase().replace(' ', '-')).style.display = 'block';
                    }
                }
            </script>

@include('templates.principalfooter')