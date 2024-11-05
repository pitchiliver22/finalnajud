<!DOCTYPE html>
<html>

<head>
    <title>User Approved</title>
    <style>
        .button {
            display: inline-block;
            padding: 10px 20px;
            font-size: 16px;
            color: #007bff;
            /* Text color */
            background-color: transparent;
            /* Transparent background */
            border: 2px solid #007bff;
            /* Border color */
            text-align: center;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s, color 0.3s;
            /* Smooth transition */
        }

        .button:hover {
            background-color: #007bff;
            /* Background color on hover */
            color: white;
            /* Text color on hover */
        }
    </style>
</head>

<body>
    <h1>Congratulations, {{ $user->firstname }} {{ $user->middlename }} {{ $user->lastname }}!</h1>
    <h2>Your account has been approved. You can now log in to the application.</h2>
    <a href="{{ url('/login') }}" class="button">Go to Login</a>
    <h3>Best regards,<br>RedHat Team</h3>
</body>

</html>
