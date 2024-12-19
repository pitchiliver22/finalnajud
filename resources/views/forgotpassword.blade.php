<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <link rel="icon" type="image/png" sizes="32x32" href="image/uclogo.png" class="titlelogo">
    <style>
        body {
            background: radial-gradient(circle, rgba(255, 255, 255, 0.3) 0%, rgba(0, 0, 0, 0.3) 70%, #001f3f 100%);
            margin: 0;
            padding: 0;
            height: 100vh;
            overflow: hidden;
            background-color: #0c76e0;
            position: relative;
        }
        .container {
            background: #fff;
            padding: 3rem;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 1;
            width: 100%;
            max-width: 450px; /* Maximum width for larger screens */
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.5);  
            border-radius:10px;
           
            
        }
        h2 {
            margin-bottom: 1rem;
            text-align: center;
            font-family: 'Arial', sans-serif;
            color:rgba(8, 16, 66, 1); 
            

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
        .email{
            font-family:'Arial',sans-serif;
            
            
        }
        .submit{
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.5);  
            width:104.5%;
            margin-bottom:2%;
            background-color:rgba(8, 16, 66, 1); 
            
        }
        .login{
            text-decoration:none;
            color:red;
        }
        .login:hover{
            color:blue;
        }
        #beat-container {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        overflow: hidden;
    }

    .beat {
        position: absolute;
        top: -50px;
        width: 30px;
        height: 30px;
        color: white;
        font-size: 1rem;
        opacity: 1;
        animation: fall linear infinite;
    }
    #email{
        border-color:black;
    }
    @keyframes fall {
        0% {
            transform: translateY(0) rotate(0deg);
            opacity: 1;
        }
        100% {
            transform: translateY(110vh) rotate(360deg);
            opacity: 0;
        }
    }

    .beat:nth-child(odd) {
        animation-duration: 5s;
    }

    .beat:nth-child(even) {
        animation-duration: 7s;
    }
    @media (max-width: 320px) {
            .container {
                padding: 1rem;
                width:60%;
                
            }

            h2 {
                font-size: 1rem;
            }

            .form-group {
                margin-bottom: 1rem;
            }
            #email{
               
                width:90%;
            }
            .submit{
                font-size:0.8rem;
                width:98%;
            }
            #emailadd{
                font-size:13px;
            }
            .message{
                font-size:13px;
            }
        
        }

        /* Tablet Styles */
        @media (min-width: 320px) and (max-width: 768px) {
            .container {
                padding: 1rem;
                width:60%;
             
            }

            h2 {
                font-size: 1rem;
            }

            .form-group {
                margin-bottom: 1rem;
            }
            #email{
               
                width:90%;
            }
            .submit{
                font-size:0.8rem;
                width:98%;
            }
            #emailadd{
                font-size:13px;
            }
            .message{
                font-size:13px;
            }
        }

        Prevent overflow issues on smaller screens
        @media (max-height: 600px) {
            body {
                height: auto;
                min-height: 100vh;
            }
        }
    
    </style>
</head>
<body>
<div id="beat-container"></div>
    <div class="container">
        
        <h2>Forgot Password</h2>
        <form action="{{ route('password.email') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="email" class="email" id="emailadd">E-Mail Address</label>
                <input type="email" id="email" class="emailinput" name="email" required>
            </div>
            <button type="submit" class="submit">Send Password Reset Link</button>
        </form>
        <div class="message">
            Remembered your password? <a href="/login" class="login">Login</a>
        </div>
    </div>
    <script>
        
        const beatContainer = document.getElementById('beat-container');

        function createBeat() {
            const beat = document.createElement('div');
            beat.classList.add('beat');
            beat.style.left = Math.random() * 100 + 'vw';
            beat.style.animationDuration = Math.random() * 2 + 3 + 's';
            beat.innerHTML = '&#9835;'; 

            beatContainer.appendChild(beat);

            setTimeout(() => {
                beat.remove();
            }, 10000);
        }

        setInterval(createBeat, 200); 
    </script>
</body>
</html>