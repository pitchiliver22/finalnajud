@include('templates.accountingheader')

<div id="main">
    <div class="w3-teal">
        <button id="openNav" class="w3-button w3-teal w3-xlarge" onclick="w3_open()">&#9776;</button>
        <div class="w3-container">
            <h1>ASSESSMENT</h1>
        </div>
    </div>


    <form action="/accountingassessment" method="GET">
        <div class="row">
            <div class="col">
                <a href="/createassessment"><button class="btn btn-primary" type="button">Create Assessment</button></a>
                <button class="btn btn-secondary">Edit Assessment</button>
                <button class="btn btn-danger">Delete Assessment</button>
            </div>
        </div>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>School Year</th>
                    <th>Grade Level</th>
                    <th>Assessment Name</th>
                    <th>Description</th>
                    <th>Assessment Date</th>
                    <th>Assessment Time</th>
                    <th>Assessment Fee</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>2021-2022</td>
                    <td>Grade 10</td>
                    <td>Enrollment</td>
                    <td>Enrollment Payment</td>
                    <td>02/02/2024</td>
                    <td>7:40 Am</td>
                    <td>500</td>
                    <td><button class="btn btn-success">Submit Assessment</button></td>
                </tr>
            </tbody>
        </table>


    </form>

</div>
@include('templates.accountingfooter')
