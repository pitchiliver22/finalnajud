<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Reset Request</title>
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
            font-size: 28px;
            margin-bottom: 10px;
        }

        h2 {
            color: #555;
            margin-bottom: 20px;
            font-size: 22px;
        }

        h3 {
            color: #777;
            margin-top: 30px;
            font-size: 16px;
        }

        .logo {
            max-width: 120px;
            margin-bottom: 20px;
        }

        .button {
            display: inline-block;
            padding: 12px 24px;
            font-size: 18px;
            color: #fff;
            background-color: #e74c3c;
            border: none;
            border-radius: 5px;
            text-align: center;
            text-decoration: none;
            transition: background-color 0.3s, transform 0.3s;
        }

        .button:hover {
            background-color: #c0392b;
            transform: scale(1.05);
        }

        p {
            font-size: 16px;
            line-height: 1.5;
            margin-bottom: 20px;
            color: #555;
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

            .button {
                font-size: 16px;
                padding: 10px 20px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <img src="https://eu-images.contentstack.com/v3/assets/blt8eb3cdfc1fce5194/bltc656fdad185f44a5/6621164bf6abec06d3c22c92/redhat-logo-470.png?width=1280&auto=webp&quality=95&format=jpg&disable=upscale" alt="Logo" class="logo">
        <h1>Password Reset Requested</h1>
        <h2>Hello {{ $user->firstname }},</h2>
        <p>We received a request to reset your password. Click the button below to set a new password:</p>
        <a href="{{ url('/password/reset', $token) }}" class="button">Reset Password</a>
        <h3>If you did not request this, please ignore this email.<br>Best regards,<br>Your Team</h3>
    </div>
</body>
</html>