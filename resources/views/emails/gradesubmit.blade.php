<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grade Submission Notification</title>
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
            color: #2c3e50;
        }

        h2 {
            color: #555;
            margin-bottom: 20px;
        }

        p {
            color: #777;
            margin: 15px 0;
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
        <img src="https://static-00.iconduck.com/assets.00/redhat-icon-2048x2048-c81kj8ny.png" alt="Logo" class="logo">
        <h1>Dear Principal,</h1>
        <h2>Grade Submission Notification</h2>
        <p>I hope this message finds you well.</p>
        
        @foreach ($assignments as $assignment)
            <p>I wanted to inform you that I have submitted the grades for the section {{ $assignment->section }} for the academic {{ $assignment->grade }}.</p>
        @endforeach
        
        <p>Thank you for your continued support and guidance.</p>
        <h3>Best regards,<br>{{ $user->firstname }} {{ $user->middlename }} {{ $user->lastname }}</h3>
    </div>
</body>

</html>