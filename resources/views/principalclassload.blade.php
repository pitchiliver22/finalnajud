@include('templates.principalheader')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<style>
   


    .header-container {
    display: flex;
    align-items: center;
    background-color: rgba(8, 16, 66, 1);
    color: white;
    padding: 10px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.5);
}

    h1 {
        margin: 0; 
        font-size: 17px;
        text-transform:uppercase;
    }
    .header-container h1{
        margin: 0; 
        font-size: 15px;
        text-transform:uppercase;
    }

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
    .container{
        padding:20px;
    }
    .container h2{
        font-size:22px;
        margin-bottom:3%;
    }
    .container h1{
        margin-bottom:2%;
 
        color:black;
    
    }
    .savee{
        background-color:#148718;
        padding:10px;
        color:white;
        border-width:0;
        border-radius:10px;
        margin-left:86%;
        
    }
    .savee:hover{
        background-color:#24ab28;
    }
    .navvers{
    background-color:rgba(8, 16, 66, 1); 
    border-width:0;
    color:white;
    padding:15px;

}
.navvers:hover{
    color:yellow;
}
    @media (max-width: 320px) {
    .header-container{
            font-size: 12px; /* Adjust font size for mobile */
            padding:20px;
            width:41rem;
         
        }
      .header-container h1{
        margin-left:-40%;
        font-size:15px;
      }
        .navvers{
        position:absolute;
        left:10px;
        top:5px;
        padding:15px;
        }
        .savee{
            font-size:15px;
            width:50%;
            margin-left:50%;
        }

      
    }
  @media (min-width:320px) and (max-width:768px){
    .header-container{
            font-size: 12px; /* Adjust font size for mobile */
            padding:20px;
            width:41rem;
         
        }
      .header-container h1{
        margin-left:-40%;
        font-size:15px;
      }
        .navvers{
        position:absolute;
        left:10px;
        top:5px;
        padding:15px;
        }
        .savee{
            font-size:15px;
            width:50%;
            margin-left:50%;
        }


}
        
</style>

<div class="header-container">
        <button id="openNav" class="navvers" onclick="w3_open(event)">&#9776;</button>
            <h1>Classload for {{ $selectedSection }} Grade: {{ $selectedGrade }}</h1>
        </div>
        <div id="main" onclick="w3_close()">
 

    <div class="container">
        <h1>Classload</h1>

        @if (session('warning'))
            <div class="alert alert-warning">
                {{ session('warning') }}
            </div>
        @endif
        
        @if ($errors->any())
            <div class="alert alert-danger">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="/principalclassload" method="POST" id="myForm">
            @csrf
            <div class="row">
                <div class="col">
                    <label for="grade">Grade</label>
                    <input class="form-control" id="grade" name="grade" value="{{ old('grade', $selectedGrade) }}" readonly>
                </div>
                <div class="col">
                    <label for="section">Section</label>
                    <input class="form-control" id="section" name="section" value="{{ old('section', $selectedSection) }}" readonly>
                </div>
            </div>
        
            <div class="row">
                <div class="col">
                    <label for="room">Room</label>
                    <input type="text" class="form-control" id="room" name="room" placeholder="Room Number" required>
                </div>
                
                <div class="col">
                    <label for="subject">Subject</label>
                    <select class="form-control" id="subject" name="subject" required onchange="updateTeachers()">
                        <option value="">Select Subject</option>
                        @foreach ($subjects as $subject)
                            <option value="{{ trim($subject) }}" {{ old('subject', $selectedSubject) == trim($subject) ? 'selected' : '' }}>
                                {{ trim($subject) }}
                            </option>
                        @endforeach
                    </select>
                </div>
                
                <div class="col">
                    <label for="assignedTeacher">Assigned Teacher</label>
                    <select class="form-control" id="assignedTeacher" name="adviser" required>
                        <option value="">Select Teacher</option>
                        @foreach ($filteredTeachers as $teacher)
                            <option value="{{ $teacher->id }}" {{ old('adviser') == $teacher->id ? 'selected' : '' }}>
                                {{ $teacher->name }}
                            </option>
                        @endforeach
                    </select>
                </div>            
            </div>

            <div class="row">
                <div class="col">
                    <label for="description">Description</label>
                    <textarea class="form-control" id="description" name="description" placeholder="e.g. FILIPINO IS ALL ABOUT-" rows="2" required>{{ old('description') }}</textarea>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <label for="edpcode">Edp Code</label>
                    <input type="text" class="form-control" id="edpcode" name="edpcode" placeholder="41121" maxlength="5" pattern="\d*" title="Please enter numbers only" required value="{{ old('edpcode') }}">
                </div>
                <div class="col">
                    <label for="type">Type</label>
                    <select class="form-control" id="type" name="type" required>
                        <option value="">Select Type</option>
                        <option value="Lec" {{ old('type') == 'Lec' ? 'selected' : '' }}>Lec</option>
                        <option value="Lab" {{ old('type') == 'Lab' ? 'selected' : '' }}>Lab</option>
                    </select>
                </div>
                <div class="col">
                    <label for="unit">Unit</label>
                    <input type="text" class="form-control" id="unit" name="unit" placeholder="(Available units: 1/2/3)" required maxlength="1" pattern="\d{1,3}" title="Please enter 1 to 3 numbers" value="{{ old('unit') }}">
                </div>
            </div>

            <div class="row align-items-center">
                <div class="col">
                    <label for="startTime">Start Time:</label>
                    <input type="time" class="form-control" id="startTime" name="startTime" required value="{{ old('startTime') }}">
                </div>
                <div class="col">
                    <label for="endTime">End Time:</label>
                    <input type="time" class="form-control" id="endTime" name="endTime" required value="{{ old('endTime') }}">
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <label for="days">Days</label>
                    <input type="text" class="form-control" id="days" name="days" placeholder="e.g. MWF/ TTH/ SAT" pattern="[A-Za-z\s]+" title="Please enter letters only" maxlength="4" required value="{{ old('days') }}">
                </div>
            </div>
            <br>

            <div class="center">
                <button type="submit" class="savee">Save Classload</button>
            </div>
        </form>
    </div>

    <br>
    <hr>
    <br>

    <div class="container">
        <h1>Class List</h1>
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
                @foreach ($schedules as $schedule)
                    <tr>
                        <td>{{ $schedule->grade }}</td>
                        <td>{{ $schedule->adviser }}</td>
                        <td>{{ $schedule->section }}</td>
                        <td>{{ $schedule->room }}</td>
                        <td>{{ $schedule->edpcode }}</td>
                        <td>{{ $schedule->subject }}</td>
                        <td>{{ $schedule->description }}</td>
                        <td>{{ $schedule->type }}</td>
                        <td>{{ $schedule->unit }}</td>
                        <td>
                            {{ date('h:i A', strtotime($schedule->startTime)) }} - {{ date('h:i A', strtotime($schedule->endTime)) }}
                        </td> 
                        <td>{{ $schedule->days }}</td>
                        <td>
                            <a href="/update_class/{{ $schedule->id }}" class="btn btn-primary btn-sm">Edit</a>
                            <a href="/delete_class/{{ $schedule->id }}" class="btn btn-danger btn-sm" onclick="confirmDelete(event, '{{ $schedule->id }}')">Delete</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
<script>
    let scheduleCount = {};

    document.getElementById('myForm').onsubmit = function(event) {
        const section = document.getElementById('section').value;

        if (!scheduleCount[section]) {
            scheduleCount[section] = 0;
        }

        scheduleCount[section]++;

        if (scheduleCount[section] > 10) {
            alert('You have reached the maximum of 10 schedules for this section.');
            event.preventDefault();
            return;
        }

        toastr.success('Classload added successfully.');
    };

    function updateTeachers() {
        const subjectSelect = document.getElementById('subject');
        const selectedSubject = subjectSelect.value;
        const teacherSelect = document.getElementById('assignedTeacher');
        teacherSelect.innerHTML = '<option value="">Select Teacher</option>'; 

        const selectedGrade = document.getElementById('grade').value;

        if (selectedSubject) {
            fetch(`/get-teachers?subject=${selectedSubject}&grade=${selectedGrade}`)
                .then(response => response.json())
                .then(data => {
                    data.forEach(teacher => {
                        teacherSelect.innerHTML += `<option value="${teacher.id}">${teacher.name}</option>`;
                    });
                    
                    const selectedAdviser = '{{ old('adviser') }}'; 
                    if (selectedAdviser) {
                        teacherSelect.value = selectedAdviser;
                    }
                })
                .catch(error => console.error('Error fetching teachers:', error));
        }
    }

    function filterTable() {
        const input = document.getElementById('searchInput');
        const filter = input.value.toLowerCase();
        const table = document.getElementById('classTableBody');
        const rows = table.getElementsByTagName('tr');

        for (let i = 0; i < rows.length; i++) {
            const cells = rows[i].getElementsByTagName('td');
            let found = false;

            for (let j = 0; j < cells.length; j++) {
                const cell = cells[j];
                if (cell) {
                    const txtValue = cell.textContent || cell.innerText;
                    if (txtValue.toLowerCase().indexOf(filter) > -1) {
                        found = true;
                        break;
                    }
                }
            }

            if (found) {
                rows[i].style.display = "";
            } else {
                rows[i].style.display = "none";
            }
        }
    }
</script>


<script>
    function confirmDelete(event, scheduleId) {
        event.preventDefault(); 
        const deleteUrl = '/delete_class/' + scheduleId; 
        Swal.fire({
            title: 'Are you sure?',
            text: 'Once deleted, you will not be able to recover this schedule!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No, cancel!',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = deleteUrl; 
            }
        });
    }
</script>

@include('templates.principalfooter')