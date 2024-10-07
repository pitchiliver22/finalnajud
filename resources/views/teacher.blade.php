@include('templates.teacherheader')

<div id="main">
    <div class="w3-teal">
        <button id="openNav" class="w3-button w3-teal w3-xlarge" onclick="w3_open()">&#9776;</button>
        <div class="w3-container">
            <h1>Teacher Dashboard</h1>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Gradebook</h5>
                    <p class="card-text">Manage and view student grades.</p>
                    <a href="#" class="btn btn-primary">Open Gradebook</a>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Grade Submitted</h5>
                    <p class="card-text">View and confirm submitted grades.</p>
                    <a href="#" class="btn btn-primary">View Submissions</a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Report</h5>
                    <p class="card-text">Generate reports on student performance.</p>
                    <a href="#" class="btn btn-primary">Generate Report</a>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Total Students</h5>
                    <p class="card-text">View the total number of students.</p>
                    <a href="#" class="btn btn-primary">View Students</a>
                </div>
            </div>
        </div>
    </div>
</div>

@include('templates.teacherfooter')
