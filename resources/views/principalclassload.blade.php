@include('templates.principalheader')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<style>
    .center {
        text-align: center;
        margin-top: 1rem;
    }

    #toast-container {
        z-index: 9999;
    }

    .error-message {
        color: red;
        font-weight: bold;
    }

    .row {
        display: flex;
        justify-content: space-between;
        margin-bottom: 1rem;
    }

    .row .col {
        flex: 1;
        margin-right: 1rem;
    }

    .row .col:last-child {
        margin-right: 0;
    }

    input[type="time"] {
        width: 100%;
        padding: 0.5rem;
        box-sizing: border-box;
    }
</style>

<div id="main">
    <div class="w3-teal">
        <button id="openNav" class="w3-button w3-teal w3-xlarge" onclick="w3_open()">&#9776;</button>
        <div class="w3-container">
            <h1>PRINCIPAL CLASSLOAD</h1>
        </div>
    </div>

    <div class="container">
        <h1>Classload</h1>

        @if ($errors->any())
            <div class="error-message">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="/principalclassload" method="POST" id="myForm">
            @csrf
            <div class="row">
                <div class="col">
                    <label for="grade">Grade</label>
                    <input class="form-control" id="grade" name="grade" value="{{ old('grade', isset($sections) && count($sections) > 0 ? $sections[0]->grade : '') }}" readonly>
                </div>
                <div class="col">
                    <label for="section">Section</label>
                    <input class="form-control" id="section" name="section" value="{{ old('section', isset($sections) && count($sections) > 0 ? $sections[0]->section : '') }}" readonly>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <label for="room">Room</label>
                    <input type="text" class="form-control" id="room" name="room" placeholder="208, ME 105, ETC." maxlength="5" required>
                </div>
                <div class="col">
                    <label for="subject">Subject</label>
                    <select class="form-control" id="subject" name="subject" required>
                        <option value="">Select Subject</option>
                        @foreach ($sections as $sec) <!-- Loop through sections -->
                            @foreach ($teachers as $teacher)
                                @if ($teacher->grade === $sec->grade) <!-- Match the grade -->
                                    @foreach (explode(',', $teacher->subject) as $subject)
                                        <option value="{{ trim($subject) }}" {{ old('subject') === trim($subject) ? 'selected' : '' }}>
                                            {{ trim($subject) }}
                                        </option>
                                    @endforeach
                                @endif
                            @endforeach
                        @endforeach
                    </select>
                </div>
                <div class="col">
                    <label for="assignedTeacher">Assigned Teacher</label>
                    <select class="form-control" id="assignedTeacher" name="adviser" required>
                        <option value="">Select Teacher</option>
                        @foreach ($sections as $sec) <!-- Loop through sections -->
                            @foreach ($teachers as $teacher)
                                @if ($teacher->grade === $sec->grade) <!-- Match the grade -->
                                    <option value="{{ $teacher->id }}" {{ old('adviser') == $teacher->id ? 'selected' : '' }}>
                                        {{ $teacher->name }}
                                    </option>
                                @endif
                            @endforeach
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col">
                <label for="description">Description</label>
                <textarea class="form-control" id="description" name="description" placeholder="e.g. FILIPINO IS ALL ABOUT-" rows="2" required></textarea>
            </div>

            <div class="row">
                <div class="col">
                    <label for="edpcode">Edp Code</label>
                    <input type="text" class="form-control" id="edpcode" name="edpcode" placeholder="41121" maxlength="5" pattern="\d*" title="Please enter numbers only" required>
                </div>
                <div class="col">
                    <label for="type">Type</label>
                    <select class="form-control" id="type" name="type" required>
                        <option value="">Select Type</option>
                        <option value="Lec">Lec</option>
                        <option value="Lab">Lab</option>
                    </select>
                </div>
                <div class="col">
                    <label for="unit">Unit</label>
                    <input type="text" class="form-control" id="unit" name="unit" placeholder="(Available units: 1/2/3)" required maxlength="1" pattern="\d{1,3}" title="Please enter 1 to 3 numbers">
                </div>
            </div>

            <div class="row align-items-center">
                <div class="col">
                    <label for="startTime">Start Time:</label>
                    <input type="time" class="form-control" id="startTime" name="startTime" required>
                </div>
                <div class="col">
                    <label for="endTime">End Time:</label>
                    <input type="time" class="form-control" id="endTime" name="endTime" required>
                </div>
            </div>
            
            <div class="row">
                <div class="col">
                    <label for="days">Days</label>
                    <input type="text" class="form-control" id="days" name="days" placeholder="e.g. MWF/ TTH/ SAT" pattern="[A-Za-z\s]+" title="Please enter letters only" maxlength="4" required>
                </div>
            </div>
            <br>

            <div class="center">
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </form>
    </div>

    <br>
    <hr>
    <br>

    <div class="container">
        <h2>Class List</h2>
        <input type="text" id="searchInput" class="form-control" placeholder="Search..." onkeyup="filterTable()">
        <br>

        <table class="table">
            <thead>
                <tr>
                    <th>Grade</th>
                    <th>Teacher</th>
                    <th>Section</th>
                    <th>Room</th>
                    <th>Edp Code</th>
                    <th>Subject</th>
                    <th>Description</th>
                    <th>Type</th>
                    <th>Unit</th>
                    <th>Time</th>
                    <th>Days</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="classTableBody">
                @foreach ($class as $class)
                    <tr>
                        <td>{{ $class->grade }}</td>
                        <td>{{ $class->adviser }}</td>
                        <td>{{ $class->section }}</td>
                        <td>{{ $class->room }}</td>
                        <td>{{ $class->edpcode }}</td>
                        <td>{{ $class->subject }}</td>
                        <td>{{ $class->description }}</td>
                        <td>{{ $class->type }}</td>
                        <td>{{ $class->unit }}</td>
                        <td>{{ $class->time }}</td>
                        <td>{{ $class->days }}</td>
                        <td>
                            <a href="/update_class/{{ $class->id }}" class="btn btn-primary btn-sm">Edit</a>
                            <a href="/delete_class/{{ $class->id }}" class="btn btn-danger btn-sm">Delete</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script>
    let scheduleCount = {}; // Object to track schedule counts by section

    document.getElementById('myForm').onsubmit = function(event) {
        const section = document.getElementById('section').value;
        const selectedSubject = document.getElementById('subject').value;

        // Initialize schedule count for this section if it doesn't exist
        if (!scheduleCount[section]) {
            scheduleCount[section] = 0; // Initialize if it doesn't exist
        }

        // Increment the count
        scheduleCount[section]++;

        // Check if the count has reached 8
        if (scheduleCount[section] > 8) {
            alert('You have reached the maximum of 8 schedules for this section.');
            event.preventDefault(); // Prevent form submission
            return; // Stop further processing
        }

        toastr.success('Classload added successfully.');
    };
</script>

@include('templates.principalfooter')