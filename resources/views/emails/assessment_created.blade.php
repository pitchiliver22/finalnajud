<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accounting Submitted an Assessment</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            color: #333;
        }

        .container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        h1 {
            color: #e74c3c;
        }

        h2 {
            color: #555;
            margin-bottom: 20px;
        }

        h3 {
            color: #777;
            margin-top: 30px;
        }

        .logo {
            max-width: 120px;
            margin-bottom: 20px;
        }

        @media (max-width: 600px) {
            .container {
                margin: 20px;
                padding: 15px;
            }

            h1 {
                font-size: 24px;
            }

            h2 {
                font-size: 18px;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>New Assessment Created</h1>
        <h2>A new assessment has been created by the accounting:</h2>
        <ul style="list-style-type: none; padding: 0;">
            <li>School Year: {{ $assessment->school_year }}</li>
            <li>Grade Level: {{ $assessment->grade_level }}</li>
            <li>Assessment Name: {{ $assessment->assessment_name }}</li>
            <li>Description: {{ $assessment->description }}</li>
            <li>Assessment Date: {{ $assessment->assessment_date }}</li>
            <li>Assessment Month: 
                @php
                    $monthNames = [
                        1 => 'January',
                        2 => 'February',
                        3 => 'March',
                        4 => 'April',
                        5 => 'May',
                        6 => 'June',
                        7 => 'July',
                        8 => 'August',
                        9 => 'September',
                        10 => 'October',
                        11 => 'November',
                        12 => 'December',
                    ];
                @endphp
                {{ $monthNames[$assessment->month] ?? 'Unknown' }}
            </li>
            <li>Assessment Time: {{ $assessment->assessment_time }}</li>
            <li>Assessment Fee: {{ $assessment->assessment_fee }}</li>
        </ul>
        <h3>We kindly ask for your review and approval of this assessment. Your guidance in publishing it would greatly support our students and staff. Thank you for your continued leadership and support.</h3>
    </div>
</body>

</html>