@include('templates.studentheader')

<div id="main">
    <div class="w3-teal">
        <button id="openNav" class="w3-button w3-teal w3-xlarge" onclick="w3_open()">&#9776;</button>
        <div class="w3-container">
            <h1>STUDENT CLASS LOAD</h1>
        </div>
    </div>
    <div class="form-group">
        <label for="studyLoadName">Student Name:</label>
        <input type="text" class="form-control" id="studyLoadName" value="Oliver Pacatang" readonly>
    </div>
    <div class="form-group">
        <label for="yearLevel">Year Level:</label>
        <input type="number" class="form-control" id="yearLevel" value="4" readonly>
    </div>
    <div class="form-group">
        <label for="section">Section:</label>
        <input type="text" class="form-control" id="section" value="B" readonly>
    </div>

    <table class="table table-success table-striped">
        <thead>
            <tr>
                <th>Room</th>
                <th>Subject</th>
                <th>Description</th>
                <th>Type</th>
                <th>Unit</th>
                <th>Time</th>
                <th>Days</th>
            </tr>
        </thead>
        <tbody id="studyLoadTable">
            <tr>
                <td>123</td>
                <td>Mathematics</td>
                <td>Introduction to Calculus</td>
                <td>Lecture</td>
                <td>3</td>
                <td>9:00 AM - 10:30 AM</td>
                <td>Monday, Wednesday</td>
            </tr>
            <tr>
                <td>456</td>
                <td>Physics</td>
                <td>Mechanics and Waves</td>
                <td>Lecture</td>
                <td>4</td>
                <td>11:00 AM - 12:30 PM</td>
                <td>Tuesday, Thursday</td>
            </tr>
            <tr>
                <td>789</td>
                <td>English</td>
                <td>Academic Writing</td>
                <td>Lecture</td>
                <td>3</td>
                <td>2:00 PM - 3:30 PM</td>
                <td>Monday, Wednesday</td>
            </tr>
            <tr>
                <td>123</td>
                <td>Mathematics</td>
                <td>Introduction to Calculus</td>
                <td>Lecture</td>
                <td>3</td>
                <td>9:00 AM - 10:30 AM</td>
                <td>Monday, Wednesday</td>
            </tr>
            <tr>
                <td>456</td>
                <td>Physics</td>
                <td>Mechanics and Waves</td>
                <td>Lecture</td>
                <td>4</td>
                <td>11:00 AM - 12:30 PM</td>
                <td>Tuesday, Thursday</td>
            </tr>
            <tr>
                <td>789</td>
                <td>English</td>
                <td>Academic Writing</td>
                <td>Lecture</td>
                <td>3</td>
                <td>2:00 PM - 3:30 PM</td>
                <td>Monday, Wednesday</td>
            </tr>
            <tr>
                <td>234</td>
                <td>Chemistry</td>
                <td>Fundamentals of Chemistry</td>
                <td>Lecture</td>
                <td>4</td>
                <td>9:00 AM - 10:30 AM</td>
                <td>Monday, Wednesday</td>
            </tr>
            <tr>
                <td>567</td>
                <td>Biology</td>
                <td>Cell Biology</td>
                <td>Lecture</td>
                <td>3</td>
                <td>11:00 AM - 12:30 PM</td>
                <td>Tuesday, Thursday</td>
            </tr>
            <tr>
                <td>890</td>
                <td>History</td>
                <td>World History</td>
                <td>Lecture</td>
                <td>3</td>
                <td>2:00 PM - 3:30 PM</td>
                <td>Monday, Wednesday</td>
            </tr>
        </tbody>
    </table>
</div>
@include('templates.studentfooter')
