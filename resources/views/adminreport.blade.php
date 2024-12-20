@include('templates.Adminheader')

<div class="col py-3">
    <br>

    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Total Students</h5>
                    @if ($totalStudents > 0)
                        <p class="card-text">{{ $totalStudents }}</p>
                        <a href="/totalstudent" class="btn btn-primary">View Details</a>
                    @else
                        <p class="card-text text-danger">No students found!</p>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Total Accounting</h5>
                    @if ($totalAccounting > 0)
                        <p class="card-text">{{ $totalAccounting }}</p>
                        <a href="/totalaccounting" class="btn btn-primary">View Details</a>
                    @else
                        <p class="card-text text-danger">No accounting staff found!</p>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Total Principals</h5>
                    @if ($totalPrincipal > 0)
                        <p class="card-text">{{ $totalPrincipal }}</p>
                        <a href="/totalprincipal" class="btn btn-primary">View Details</a>
                    @else
                        <p class="card-text text-danger">No principals found!</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <br>
    <br>
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Total Teachers</h5>
                    @if ($totalTeachers > 0)
                        <p class="card-text">{{ $totalTeachers }}</p>
                        <a href="/totalteacher" class="btn btn-primary">View Details</a>
                    @else
                        <p class="card-text text-danger">No teachers found!</p>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Total Cashiers</h5>
                    @if ($totalCashiers > 0)
                        <p class="card-text">{{ $totalCashiers }}</p>
                        <a href="/totalcashier" class="btn btn-primary">View Details</a>
                    @else
                        <p class="card-text text-danger">No cashiers found!</p>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Total Records</h5>
                    @if ($record > 0)
                        <p class="card-text">{{ $record }}</p>
                        <a href="/totalrecord" class="btn btn-primary">View Details</a>
                    @else
                        <p class="card-text text-danger">No records found!</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <br>
    <h5>Students Information</h5>
    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Enrollment Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach($students as $student)
                <tr>
                    <td>{{ $student->firstname }} {{ $student->middlename }} {{ $student->lastname }} {{ $student->suffix }}</td>
                    <td>{{ $student->email }}</td>
                    <td>December 6, 2024</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@include('templates.Adminfooter')