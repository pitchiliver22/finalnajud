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

    .uppercase {
        text-transform: uppercase;
    }

    .error-message {
        color: red;
        font-weight: bold;
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
            <div class="col">
                <label for="grade">Grade</label>
                <select class="form-control" id="grade" name="grade" required>
                    <option value="">Select Grade</option>
                    <option value="K">Kindergarten</option>
                    @for ($i = 1; $i <= 10; $i++)
                        <option value="Grade {{ $i }}">Grade {{ $i }}</option>
                    @endfor
                </select>
            </div>

            <div class="row">
                <div class="col">
                    <label for="adviser">Adviser</label>
                    <select class="form-control" id="adviser" name="adviser_id" required>
                        <option value="">Select Adviser</option>
                        @foreach ($teachers as $teacher)
                            <option value="{{ $teacher->id }}" data-name="{{ $teacher->name }}">
                                {{ $teacher->name }}
                            </option>
                        @endforeach
                    </select>
                    <input type="hidden" id="adviserName" name="adviser" value="">
                </div>
            </div>

            <div class="row">
                <div class="form-group">
                    <label for="section">Section</label>
                    <textarea class="form-control uppercase" id="section" name="section" pattern="^[A-Za-z\s,]+$"
                        title="Please enter letters and commas only"></textarea>
                </div>

                <div class="col">
                    <label for="room">Room</label>
                    <input type="text" class="form-control" id="room" name="room"
                        placeholder="208, ME 105, ETC." maxlength="5" required>
                </div>

                <div class="form-group">
                    <label for="subject">Subject</label>
                    <select class="form-control" id="subject" name="subject" required>
                        <option value="">Select Subject</option>
                        <!-- Subjects will be populated here -->
                    </select>
                </div>
            </div>

            <div class="col">
                <label for="description">Description</label>
                <textarea class="form-control" id="description" name="description" placeholder="e.g. FILIPINO IS ALL ABOUT-"
                    rows="2" required></textarea>
            </div>

            <div class="row">
                <div class="col">
                    <label for="edpcode">Edp Code</label>
                    <input type="text" class="form-control" id="edpcode" name="edpcode" placeholder="41121"
                        maxlength="5" pattern="\d*" title="Please enter numbers only" required>
                </div>
                <div class="col">
                    <label for="type">Type</label>
                    <input type="text" class="form-control" id="type" name="type" maxlength="1"
                        placeholder="Type L if it's LABORATORY and leave it blank if NOT" pattern="(L|)"
                        title="Please enter 'L' or leave it blank">
                </div>

                <div class="col">
                    <label for="unit">Unit</label>
                    <input type="text" class="form-control" id="unit" name="unit"
                        placeholder="(Available units: 1/2/3)" required maxlength="1" pattern="\d{1,3}"
                        title="Please enter 1 to 3 numbers">
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <label for="time">Time</label>
                    <input type="text" class="form-control" id="time" name="time"
                        placeholder="7:30 AM - 8:30 AM" required>
                </div>

                <div class="col">
                    <label for="days">Days</label>
                    <input type="text" class="form-control" id="days" name="days"
                        placeholder="e.g. MWF/ TTH/ SAT" pattern="[A-Za-z\s]+" title="Please enter letters only"
                        maxlength="4" required>
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

    <h2>Class List</h2>
    <div class="container">
        <input type="text" id="searchInput" class="form-control" placeholder="Search..."
            onkeyup="filterTable()">
        <br>

        <table class="table">
            <thead>
                <tr>
                    <th>Grade</th>
                    <th>Adviser</th>
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
                            <a href="/update_class/{{ $class->id }}" class="btn btn-primary btn-sm update-users">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    fill="currentColor" class="bi bi-pen" viewBox="0 0 16 16">
                                    <path
                                        d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001m-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708z" />
                                </svg>
                            </a>
                            <a href="/delete_class/{{ $class->id }}" class="btn btn-danger btn-sm delete-users">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    fill="currentColor" class="bi bi-recycle" viewBox="0 0 16 16">
                                    <path
                                        d="M9.302 1.256a1.5 1.5 0 0 0-2.604 0l-1.704 2.98a.5.5 0 0 0 .869.497l1.703-2.981a.5.5 0 0 1 .868 0l2.54 4.444-1.256-.337a.5.5 0 1 0-.26.966l2.415.647a.5.5 0 0 0 .613-.353l.647-2.415a.5.5 0 1 0-.966-.259l-.333 1.242zM2.973 7.773l-1.255.337a.5.5 0 1 1-.26-.966l2.416-.647a.5.5 0 0 1 .612.353l.647 2.415a.5.5 0 0 1-.966.259l-.333-1.242-2.545 4.454a.5.5 0 0 0 .434.748H5a.5.5 0 0 1 0 1H1.723A1.5 1.5 0 0 1 .421 12.24zm10.89 1.463a.5.5 0 1 0-.868.496l1.716 3.004a.5.5 0 0 1-.434.748h-5.57l.647-.646a.5.5 0 1 0-.708-.707l-1.5 1.5a.5.5 0 0 0 0 .707l1.5 1.5a.5.5 0 1 0 .708-.707l-.647-.647h5.57a1.5 1.5 0 0 0 1.302-2.244z" />
                                </svg>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script>
    document.getElementById('adviser').onchange = function() {
        var teacherId = this.value; // Get the selected teacher's ID
        var adviserName = this.options[this.selectedIndex].getAttribute('data-name'); // Get the teacher's name
        document.getElementById('adviserName').value = adviserName; // Set the hidden input value

        var subjectSelect = document.getElementById('subject');
        subjectSelect.innerHTML = '<option value="">Select Subject</option>'; // Reset options

        if (teacherId) {
            // Fetch the subjects associated with the selected teacher
            fetch(`/get-subject/${teacherId}`)
                .then(response => response.json())
                .then(data => {
                    data.subjects.forEach(subject => {
                        var option = document.createElement('option');
                        option.value = subject; // Assuming subject is a string
                        option.textContent = subject; // Display the subject name
                        subjectSelect.appendChild(option);
                    });
                })
                .catch(error => {
                    console.error('Error fetching subjects:', error);
                });
        }
    };
</script>
@include('templates.principalfooter')
