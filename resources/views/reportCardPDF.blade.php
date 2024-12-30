<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f4f4f4;
            color: #333;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;

            color: rgb(0, 0, 0);
            padding: 20px;
            border-radius: 8px;
        }
        h1 {
            font-size: 28px;
            margin: 0;
        }
        h2 {
            font-size: 24px;
            margin: 5px 0;
            font-weight: normal;
        }
        .passed{
background-color:#05fa19;
}
.failed{
background-color:#fa0505;
}
        .info {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
            background-color: #ffffff;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        .info div {
            width: 48%;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        .table th, .table td {
            padding: 12px;
            text-align: center;
            border: 1px solid #ddd;
        }
        .section {
            margin-top: 30px;
        }
        .footer {
            margin-top: 40px;
            text-align: right;
            font-weight: bold;
        }
       
      
    </style>
    <title>Student Report Card</title>
</head>
<body>

    <div class="header">
        <h1>Student Report Card</h1>
    </div>

    <div class="info">
        <div>
            <strong>Student Name:</strong> {{ $reportCardData['fullname'] }}<br>
            <strong>Section:</strong> {{ $reportCardData['section'] }}<br>
            <strong>GRADE:</strong>
            <span><u>{{ $reportCardData['level'] }}</u></span>
        </div>
    </div>

    <div class="section">
        <h2>Grades</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Subject</th>
                    <th>Q1</th>
                    <th>Q2</th>
                    <th>Q3</th>
                    <th>Q4</th>
                    <th>Final Grade</th>
                    <th>Remark</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($reportCardData['grades'] as $grade)
                    <tr>
                        <td>{{ $grade->subject }}</td>
                        <td>{{ number_format($grade->{'1st_quarter'} ?? 0, 2) }}</td>
                        <td>{{ number_format($grade->{'2nd_quarter'} ?? 0, 2) }}</td>
                        <td>{{ number_format($grade->{'3rd_quarter'} ?? 0, 2) }}</td>
                        <td>{{ number_format($grade->{'4th_quarter'} ?? 0, 2) }}</td>
                        <td>{{ number_format($grade->overall_grade ?? 0, 2) }}</td>
                        <td class="{{ ($grade->overall_grade ?? 0) < 75 ? 'faileds' : 'passeds' }}">
                            {{ ($grade->overall_grade ?? 0) < 75 ? 'FAILED' : 'PASSED' }}
                        </td>
                    </tr>
                @endforeach
                <tr>
                    <td><strong>GENERAL AVERAGE</strong></td>
                    <td><strong>{{ number_format($reportCardData['grades']->avg('1st_quarter'), 2) }}</strong></td>
                    <td><strong>{{ number_format($reportCardData['grades']->avg('2nd_quarter'), 2) }}</strong></td>
                    <td><strong>{{ number_format($reportCardData['grades']->avg('3rd_quarter'), 2) }}</strong></td>
                    <td><strong>{{ number_format($reportCardData['grades']->avg('4th_quarter'), 2) }}</strong></td>
                    <td><strong>{{ number_format($reportCardData['grades']->avg('overall_grade'), 2) }}</strong></td>
                    <td class="{{ $reportCardData['grades']->avg('overall_grade') < 75 ? 'failed' : 'passed' }}">
                        {{ $reportCardData['grades']->avg('overall_grade') < 75 ? 'FAILED' : 'PASSED' }}
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="footer">
        <p>Generated on: {{ date('Y-m-d') }}</p>
    </div>

    <script>
        function calculateFinalGrade(index) {
            const firstQuarter = parseFloat(document.querySelector(`input[name="grade[${index}][1st_quarter]"]`).value) || 0;
            const secondQuarter = parseFloat(document.querySelector(`input[name="grade[${index}][2nd_quarter]"]`).value) || 0;
            const thirdQuarter = parseFloat(document.querySelector(`input[name="grade[${index}][3rd_quarter]"]`).value) || 0;
            const fourthQuarter = parseFloat(document.querySelector(`input[name="grade[${index}][4th_quarter]"]`).value) || 0;

            const total = firstQuarter + secondQuarter + thirdQuarter + fourthQuarter;
            const count = [firstQuarter, secondQuarter, thirdQuarter, fourthQuarter].filter(grade => grade > 0).length;

            const overallGrade = count > 0 ? (total / count).toFixed(2) : 0;
            document.querySelector(`input[name="grade[${index}][overall_grade]"]`).value = overallGrade;
        }
    </script>
</body>
</html>