@include('templates.Adminheader')

<div class="col py-3">
    <br>

    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Total Student</h5>
                    <p class="card-text">{{ $totalStudents }}</p>
                    <a href="#" class="btn btn-primary">View Details</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Total Accounting</h5>
                    <p class="card-text">{{ $totalAccounting }}</p>
                    <a href="#" class="btn btn-primary">View Details</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Total Principal</h5>
                    <p class="card-text">{{ $totalPrincipal }}</p>
                    <a href="#" class="btn btn-primary">View Details</a>
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
                    <h5 class="card-title">Total Teacher</h5>
                    <p class="card-text">{{ $totalTeachers }}</p>
                    <a href="/totalteacher" class="btn btn-primary">View Details</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Total Cashier</h5>
                    <p class="card-text">{{ $totalCashiers }}</p>
                    <a href="#" class="btn btn-primary">View Details</a>
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
                    <td>{{ $student->firstname }} {{$student->middlenme}} {{$student->lastname}} {{$student->suffix}}</td>
                    <td>{{ $student->email }}</td>
                    <td>December 6, 2024</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@include('templates.Adminfooter')