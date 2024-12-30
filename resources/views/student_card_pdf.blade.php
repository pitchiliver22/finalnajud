<style>
    .report-card {
        width: 100%;
        max-width: 800px;
        margin: 0 auto;
        font-family: Arial, sans-serif;
    }
    
    .header {
        text-align: center;
        margin-bottom: 20px;
    }
    
    .student-info {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 20px;
        margin-bottom: 20px;
    }
    
    
    table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
    }
    
    th, td {
        border: 1px solid #000;
        padding: 8px;
        text-align: left;
    }
    
    .grades-table th {
        background-color: #f5f5f5;
    }
    
    .behavior-table {
        margin-top: 20px;
    }
    
    .attendance-record {
        margin-top: 20px;
    }
    
    .grading-system {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 20px;
        margin: 20px 0;
    }
    
    .footer {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 20px;
        margin-top: 20px;
    }
    
    .school-vision {
        text-align: center;
        font-style: italic;
        margin-top: 20px;
    }
 h2{
color:#1f1085;
}
.passed{
background-color:#05fa19;
}
.failed{
background-color:#fa0505;
}
.attend{
text-align:center;
}
</style>
</head>
<body>
<div class="report-card">
    <div class="header">
        <h2><u>BASIC EDUCATION DEPARTMENT</u></h2>
    </div>
    
    <div class="student-info">
        <div>
            <strong>ID NO:</strong>
            <span><u>19089176</u></span>
        </div>
        <div>
            <strong>NAME:</strong>
            <span><u>{{$student->firstname}} {{$student->middlename}} {{$student->lastname}} {{$student->suffix}}</u></span>
        </div>
        <div>
            <strong>School Year:</strong>
            <span><u>2024-2025</u></span>
        </div>
        <div>   
            <strong>GRADE:</strong>
            <span><u>{{$level->level}}</u></span>
           
        </div>
    </div>

    <table class="grades-table">
        <thead>
            <tr>
                <th>Learning Areas</th>
                <th>Q1</th>
                <th>Q2</th>
                <th>Q3</th>
                <th>Q4</th>
                <th>Final Grade</th>
                <th>Remarks</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($grades as $grade)
                <tr>
                    <td>{{ $grade->subject }}</td>
                    <td>{{ $grade->{'1st_quarter'} ?? 'N/A' }}</td>
                    <td>{{ $grade->{'2nd_quarter'} ?? 'N/A' }}</td>
                    <td>{{ $grade->{'3rd_quarter'} ?? 'N/A' }}</td>
                    <td>{{ $grade->{'4th_quarter'} ?? 'N/A' }}</td>
                    <td>{{ $grade->overall_grade ?? 'N/A' }}</td>
                    <td>{{ ($grade->overall_grade ?? 0) < 75 ? 'FAILED' : 'PASSED' }}</td>
                </tr>
            @endforeach
    
            <tr>
                <td><strong>GENERAL AVERAGE</strong></td>
                <td><strong>{{ number_format($grades->avg('1st_quarter'), 2) }}</strong></td>
                <td><strong>{{ number_format($grades->avg('2nd_quarter'), 2) }}</strong></td>
                <td><strong>{{ number_format($grades->avg('3rd_quarter'), 2) }}</strong></td>
                <td><strong>{{ number_format($grades->avg('4th_quarter'), 2) }}</strong></td>
                <td><strong>{{ number_format($grades->avg('overall_grade'), 2) }}</strong></td>
                <td class="{{ ($grades->avg('overall_grade') ?? 0) < 75 ? 'failed' : 'passed' }}">
                    {{ ($grades->avg('overall_grade') ?? 0) < 75 ? 'FAILED' : 'PASSED' }}
                </td>
                
            </tr>
        </tbody>
    </table>

<table style="width: 100%; margin: 20px 0;">
<tr>
    <td colspan="5">Grading System Used: <u>AVERAGING</u></td>
</tr>
<tr>
    <th>Descriptors</th>
    <th>Grading Scale</th>
    <th>Remarks</th>
   
    <th>Marking</th>
    <th>Non-numerical Rating</th>
</tr>
<tr>
    <td>Outstanding</td>
    <td>90-100</td>
    <td>Passed</td>

    <td>AO</td>
    <td>Always Observed</td>
</tr>
<tr>
    <td>Very Satisfactory</td>
    <td>85-89</td>
    <td>Passed</td>

    <td>SO</td>
    <td>Sometimes Observed</td>
</tr>
<tr>
    <td>Satisfactory</td>
    <td>80-84</td>
    <td>Passed</td>

    <td>RO</td>
    <td>Rarely Observed</td>
</tr>
<tr>
    <td>Fairly Satisfactory</td>
    <td>75-79</td>
    <td>Passed</td>

    <td>NO</td>
    <td>Not Observed</td>
</tr>
<tr>
    <td>Did Not Meet Expectations</td>
    <td>Below 75</td>
    <td>Failed</td>
    <td></td>
    <td></td>

</tr>
</table>


<table class="behavior-table">
    <thead>
        <tr>
            <td colspan="6">REPORT ON LEARNER'S OBSERVED VALUES</td>
        </tr>
        <tr>
            <th>Core Values</th>    
            <th>Behavior Statements</th>
            <th>1</th>
            <th>2</th>
            <th>3</th>
            <th>4</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td rowspan="2">1.Maka-Diyos</td>
            <td>Expresses one's spiritual beliefs while respecting the spiritual beliefs of others, 

                Shows adherence to ethical principles by upholding the truth
            </td>
            <td>{{ $corevalues->first()->first }}</td>
            <td>{{ $corevalues->first()->second }}</td>
            <td>{{ $corevalues->first()->third }}</td>
            <td>{{ $corevalues->first()->fourth }}</td>
        </tr>
        <tr>
           
        
        </tr>
        <tr>
            <td rowspan="2">2.Makatao</td>
            <td>Is sensitive to indvidual, social, and cultural differences, Demonstrates contributions toward solidarity</td>
            <td>{{ $corevalues->first()->first }}</td>
            <td>{{ $corevalues->first()->second }}</td>
            <td>{{ $corevalues->first()->third }}</td>
            <td>{{ $corevalues->first()->fourth }}</td>
        </tr>
        <tr>

        </tr>
        <tr>
            <td rowspan="1">3.Makakalikasan</td>
            <td>Cares for the environment and utilizes resources wisely, judiciously, and econimically</td>
            <td>{{ $corevalues->first()->first }}</td>
            <td>{{ $corevalues->first()->second }}</td>
            <td>{{ $corevalues->first()->third }}</td>
            <td>{{ $corevalues->first()->fourth }}</td>
        </tr>
        
        <tr>
            <td rowspan="2">4.Makabansa</td>
            <td>Demonstrates pride in being Filipino; exercises the rights and responsibilities of a Filipino citizen,
                <br>
             Demonstrates appropriate behavior in carrying out activities in the school, community, and country</td>
            <td>{{ $corevalues->first()->first }}</td>
            <td>{{ $corevalues->first()->second }}</td>
            <td>{{ $corevalues->first()->third }}</td>
            <td>{{ $corevalues->first()->fourth }}</td>
        </tr>
        <tr>
        </tr>
    </tbody>
</table>

<table class="attendance-record">
    <thead>
        <tr>
            <th colspan="13" class="attend">ATTENDANCE RECORD</th>
        </tr>
        <tr>
            <th></th>
            <th>Aug</th>
            <th>Sep</th>
            <th>Oct</th>
            <th>Nov</th>
            <th>Dec</th>
            <th>Jan</th>
            <th>Feb</th>
            <th>Mar</th>
            <th>Apr</th>
            <th>May</th>
            <th>Jun</th>
            <th>Total</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($attendance as $record)
        <tr>
            <td>No. of School Days</td>
            <td>{{ $record->month === 'August' ? $record->{'1st_quarter'} : '' }}</td>
            <td>{{ $record->month === 'September' ? $record->{'1st_quarter'} : '' }}</td>
            <td>{{ $record->month === 'October' ? $record->{'1st_quarter'} : '' }}</td>
            <td>{{ $record->month === 'November' ? $record->{'1st_quarter'} : '' }}</td>
            <td>{{ $record->month === 'December' ? $record->{'1st_quarter'} : '' }}</td>
            <td>{{ $record->month === 'January' ? $record->{'1st_quarter'} : '' }}</td>
            <td>{{ $record->month === 'February' ? $record->{'1st_quarter'} : '' }}</td>
            <td>{{ $record->month === 'March' ? $record->{'1st_quarter'} : '' }}</td>
            <td>{{ $record->month === 'April' ? $record->{'1st_quarter'} : '' }}</td>
            <td>{{ $record->month === 'May' ? $record->{'1st_quarter'} : '' }}</td>
            <td>{{ $record->month === 'June' ? $record->{'1st_quarter'} : '' }}</td>
            <td>{{ $record->total }}</td>
        </tr>
        <tr>
            <td>No. of School Days Present</td>
            <td>{{ $record->month === 'August' ? $record->{'2nd_quarter'} : '' }}</td>
            <td>{{ $record->month === 'September' ? $record->{'2nd_quarter'} : '' }}</td>
            <td>{{ $record->month === 'October' ? $record->{'2nd_quarter'} : '' }}</td>
            <td>{{ $record->month === 'November' ? $record->{'2nd_quarter'} : '' }}</td>
            <td>{{ $record->month === 'December' ? $record->{'2nd_quarter'} : '' }}</td>
            <td>{{ $record->month === 'January' ? $record->{'2nd_quarter'} : '' }}</td>
            <td>{{ $record->month === 'February' ? $record->{'2nd_quarter'} : '' }}</td>
            <td>{{ $record->month === 'March' ? $record->{'2nd_quarter'} : '' }}</td>
            <td>{{ $record->month === 'April' ? $record->{'2nd_quarter'} : '' }}</td>
            <td>{{ $record->month === 'May' ? $record->{'2nd_quarter'} : '' }}</td>
            <td>{{ $record->month === 'June' ? $record->{'2nd_quarter'} : '' }}</td>
            <td>{{ $record->total }}</td>

        </tr>
        <tr>
            <td>No. of Times Tardy</td>
            <td>{{ $record->month === 'August' ? $record->{'3rd_quarter'} : '' }}</td>
            <td>{{ $record->month === 'September' ? $record->{'3rd_quarter'} : '' }}</td>
            <td>{{ $record->month === 'October' ? $record->{'3rd_quarter'} : '' }}</td>
            <td>{{ $record->month === 'November' ? $record->{'3rd_quarter'} : '' }}</td>
            <td>{{ $record->month === 'December' ? $record->{'3rd_quarter'} : '' }}</td>
            <td>{{ $record->month === 'January' ? $record->{'3rd_quarter'} : '' }}</td>
            <td>{{ $record->month === 'February' ? $record->{'3rd_quarter'} : '' }}</td>
            <td>{{ $record->month === 'March' ? $record->{'3rd_quarter'} : '' }}</td>
            <td>{{ $record->month === 'April' ? $record->{'3rd_quarter'} : '' }}</td>
            <td>{{ $record->month === 'May' ? $record->{'3rd_quarter'} : '' }}</td>
            <td>{{ $record->month === 'June' ? $record->{'3rd_quarter'} : '' }}</td>
            <td>{{ $record->total }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

    <div class="footer">
        <div>
            <strong>Adviser:</strong>
            <span>Therese Dungog</span>
        </div>
        <div>
            <strong>Principal:</strong>
            <span>Moimoi</span>
        </div>
    </div>

    <div class="school-vision">
        <p>Democratize quality education. Be the visionary and industry leader. Give hope and transform lives.</p>
    </div>

   
</div>
