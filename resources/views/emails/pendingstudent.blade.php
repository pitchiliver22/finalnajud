<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pending Account</title>
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
            color: #555;
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
            max-width: 80px;
            /* Increased logo size */
            margin-bottom: 20px;
        }

        .image-placeholder {
            width: 100%;
            background-color: #eaeaea;
            margin-bottom: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            border-radius: 5px;
        }

        .image-placeholder img {
            width: 100%;
            background-color: #eaeaea;
            margin-bottom: 50px;
            display: flex;
            justify-content: center;
            align-items: center;
            color: #999;
            font-size: 18px;
            border-radius: 5px;
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
        <img src="https://static-00.iconduck.com/assets.00/redhat-icon-2048x2048-c81kj8ny.png" alt="Logo"
            class="logo">
        <h1>Your account, {{ $user->firstname }} {{ $user->middlename }} {{ $user->lastname }}!</h1>
        <div class="image-placeholder">
            <img src="https://cdn.dribbble.com/users/168771/screenshots/6457502/red_hat_4x.png" alt="Red Hat Logo">
        </div>
        <h2>Your account is currently on pending approval. We appreciate your patience as we work to get you set up!</h2>
        <h3>Best regards,<br>RedHat Team</h3>
    </div>
</body>

</html>