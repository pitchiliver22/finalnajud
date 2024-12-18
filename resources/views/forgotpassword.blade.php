<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            background: #fff;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }
        h2 {
            margin-bottom: 1rem;
            text-align: center;
        }
        .form-group {
            margin-bottom: 1rem;
        }
        label {
            display: block;
            margin-bottom: 0.5rem;
        }
        input[type="email"] {
            width: 100%;
            padding: 0.5rem;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button {
            width: 100%;
            padding: 0.5rem;
            background-color: #007bff;
            border: none;
            border-radius: 4px;
            color: white;
            font-size: 1rem;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
        .message {
            margin-top: 1rem;
            text-align: center;
            color: #555;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Forgot Password</h2>
        <form action="{{ route('password.email') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="email">E-Mail Address</label>
                <input type="email" id="email" name="email" required>
            </div>
            <button type="submit">Send Password Reset Link</button>
        </form>
        <div class="message">
            Remembered your password? <a href="/login">Login</a>
        </div>
    </div>
</body>
</html>