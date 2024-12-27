@include('templates.oldstudentheader')

<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4; 
        margin: 0;
        padding: 0;
    }

    #main{
        padding:10px;
    }
    .header-container {
        display: flex; 
        align-items: center; 
        background-color: rgba(8, 16, 66, 1); 
        color: white;
        padding: 10px; 
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.5); 
    }

    .nav-button {
        margin-right: 15px; 
        margin-bottom: 4px;
    }

    h1 {
        margin: 0; 
        font-size: 15px;
        text-transform: uppercase;
    }

    .table-primary {
        width: 100%;
        margin-top: 20px;
        border-collapse: collapse;
        border-radius: 0.5rem;
        overflow: hidden; 
        box-shadow: 0 1rem 3rem rgba(0, 0, 0, 0.1);
    }

    .table-primary th,
    .table-primary td {
        padding: 12px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    .table-primary th {
        background-color: #278024; 
        color: white;
        text-transform: uppercase; 
    }

    .table-primary tr:hover {
        background-color: #f1f1f1; 
    }

    .alert {
        padding: 15px;
        background-color: #f9edbe;
        color: #856404;
        border: 1px solid #ffeeba;
        border-radius: 5px;
        margin-top: 20px; 
        text-align: center; 
    }

    .btn-report {
        background-color: #28a745; /* Bright green */
        color: white;
        padding: 12px 24px;
        border: none;
        border-radius: 30px; /* Rounded corners */
        cursor: pointer;
        text-align: center;
        font-size: 16px;
        text-decoration: none; /* Remove underline from link */
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2); /* Subtle shadow */
        transition: background-color 0.3s, transform 0.3s; /* Smooth transition */
    }

    .btn-report:hover {
        background-color: #218838; /* Darker green on hover */
        transform: translateY(-2px); /* Lift effect on hover */
    }

    /* Responsive design */
    @media (max-width: 600px) {
        .table-primary th,
        .table-primary td {
            display: block;
            text-align: right;
        }

        .table-primary th {
            text-align: left;
            position: relative;
        }

        .table-primary th::after {
            content: ":";
            position: absolute;
            right: 0;
        }
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
        margin-left:-50%;
      }
   

    }
    @media (min-width: 320px) and (max-width:768px) {
        .header-container{
            font-size: 12px; /* Adjust font size for mobile */
            padding:20px;
            width:41rem;
    
         
        }
        .header-container h1{
            margin-left:-50%;
        }
        .navvers{
        position:absolute;
        left:10px;
        top:5px;
        }
 
    }
    .btn-report{
        font-size:15px;
        background-color:rgba(8, 16, 66, 1); 
    }
    .btn-report:hover{
        background-color:#243675;
        color:white;
    }
</style>

<div class="header-container">
    <button id="openNav" class="navvers" onclick="w3_open(event)">&#9776;</button>
    <h1>Grades S.Y 2024-2025</h1>
</div>
<div id="main" onclick="w3_close()">

    @if ($gradesApproved)
        <table class="table-primary">
            <thead>
                <tr>
                    <th>Subject</th>
                    <th>EDP Code</th>
                    <th>Section</th>
                    <th>1st Quarter</th>
                    <th>2nd Quarter</th>
                    <th>3rd Quarter</th>
                    <th>4th Quarter</th>
                    <th>Final Grade</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($grades as $grade)
                    <tr>
                        <td>{{ $grade->subject }}</td>
                        <td>{{ $grade->edp_code }}</td>
                        <td>{{ $grade->section }}</td>
                        <td>{{ $grade->{'1st_quarter'} ?? 'N/A' }}</td>
                        <td>{{ $grade->{'2nd_quarter'} ?? 'N/A' }}</td>
                        <td>{{ $grade->{'3rd_quarter'} ?? 'N/A' }}</td>
                        <td>{{ $grade->{'4th_quarter'} ?? 'N/A' }}</td>
                        <td>{{ $grade->overall_grade ?? 'N/A' }}</td>
                    </tr>
                @endforeach
                <tr>
                    <td><strong>General Average</strong></td>
                    <td></td>
                    <td></td>
                    <td><strong>{{ number_format($grades->avg('1st_quarter') + 0.00, 2) }}</strong></td>
                    <td><strong>{{ number_format($grades->avg('2nd_quarter') + 0.00, 2) }}</strong></td>
                    <td><strong>{{ number_format($grades->avg('3rd_quarter') + 0.00, 2) }}</strong></td>
                    <td><strong>{{ number_format($grades->avg('4th_quarter') + 0.00, 2) }}</strong></td>

                    <!-- <td colspan="6"></td> -->
                    <td><strong>{{ number_format($grades->avg('overall_grade'), 2) }}</strong></td>
                </tr>
            </tbody>

        </table>
    <br>
        @if (!is_null($coreId) && !is_null($gradeId) && !is_null($attendanceId))
            <a href="{{ route('report.card.download', ['grade_id' => $gradeId, 'core_id' => $coreId, 'attendance_id' => $attendanceId]) }}" class="btn-report">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-download" viewBox="0 0 16 16">
                    <path d="M.5 15a.5.5 0 0 0 .5.5h14a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5H1a.5.5 0 0 0-.5.5v1zM7.5 0a.5.5 0 0 1 .5.5v8.793l2.354-2.354a.5.5 0 0 1 .708.708l-3 3a.5.5 0 0 1-.708 0l-3-3a.5.5 0 0 1 .708-.708L7 9.293V.5a.5.5 0 0 1 .5-.5z"/>
                </svg>
                Download Report Card
            </a>
        @else
            <div class="alert">
                <strong>Notice:</strong> Attendance, core value, or grade is currently under processing by the teacher. Please check back later.
            </div>
        @endif

    @else
        <div class="alert">
            <strong>Notice:</strong> Your grades are currently under evaluation by the principal. Please check back later.
        </div>
    @endif
</div>

<script>
function calculateFinalGrade(index) {
    const firstQuarter = parseFloat(document.querySelector(`input[name="grades[${index}][1st_quarter]"]`).value) || 0;
    const secondQuarter = parseFloat(document.querySelector(`input[name="grades[${index}][2nd_quarter]"]`).value) || 0;
    const thirdQuarter = parseFloat(document.querySelector(`input[name="grades[${index}][3rd_quarter]"]`).value) || 0;
    const fourthQuarter = parseFloat(document.querySelector(`input[name="grades[${index}][4th_quarter]"]`).value) || 0;

    const total = firstQuarter + secondQuarter + thirdQuarter + fourthQuarter;
    const count = [firstQuarter, secondQuarter, thirdQuarter, fourthQuarter].filter(grade => grade > 0).length;

    const overallGrade = count > 0 ? (total / count).toFixed(2) : 0;
    document.querySelector(`input[name="grades[${index}][overall_grade]"]`).value = overallGrade;
}
</script>

@include('templates.oldstudentfooter')