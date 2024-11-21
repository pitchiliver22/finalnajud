<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Approved Account</title>
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

        .button {
            display: inline-block;
            padding: 10px 20px;
            font-size: 16px;
            color: #e74c3c;
            background-color: transparent;
            border: 2px solid #e74c3c;
            text-align: center;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s, color 0.3s;
        }

        .button:hover {
            background-color: #e74c3c;
            color: white;
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
        <img src="https://eu-images.contentstack.com/v3/assets/blt8eb3cdfc1fce5194/bltc656fdad185f44a5/6621164bf6abec06d3c22c92/redhat-logo-470.png?width=1280&auto=webp&quality=95&format=jpg&disable=upscale" alt="Logo"
            class="logo">
        <h1>Congratulations, {{ $user->firstname }} {{ $user->middlename }} {{ $user->lastname }}!</h1>
        <h2>Congratulations! Your account has been approved. You can now log in to the application and explore all the features available to you!</h2>
        <a href="{{ url('/login') }}" class="button">Go to Login</a>
        <h3>Best regards,<br>RedHat Team</h3>
    </div>
</body>

</html>