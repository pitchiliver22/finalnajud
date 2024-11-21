<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UC Web Portal</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background: linear-gradient(to bottom, #0072C6, #001F3F);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
            position: relative;
        }

        .snowflake {
            position: absolute;
            top: -10px;
            font-size: 1rem;
            color: white;
            opacity: 0.10;
            animation: fall linear infinite;
        }

        @keyframes fall {
            0% {
                transform: translateY(-100px) rotate(0deg);
                opacity: 1;
            }
            100% {
                transform: translateY(110vh) rotate(360deg);
                opacity: 0.5;
            }
        }

        .snowflake:nth-child(odd) {
            animation-duration: 20s;
            font-size: 1.2rem;
        }

        .snowflake:nth-child(even) {
            animation-duration: 15s;
            font-size: 0.8rem;
        }

        .card {
            background-color: white;
            border-radius: 10px;
            padding: 2rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            text-align: center;
            position: relative;
        }

        .logo {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1rem;
        }

        .logo img {
            width: 150px;
        }

        .form-check {
            display: flex;
            align-items: center;
            margin-bottom: 1rem;
        }

        .form-check-label {
            margin-left: 0.5rem;
        }

        .btn-primary {
            background-color: #1A5794;
            border: none;
            border-radius: 10px;
        }

        .btn-primary:hover {
            background-color: #004080;
        }

        a {
            color: #001F3F;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        .hat {
            position: absolute;
            top: -110px; 
            right: -21%;
            width: 300px;
            transform: rotate(12deg);
           
        }

        .santa-gif {
            position: absolute;
            bottom: -40%;
            left: -660px; 
            width: 400px; 
            overflow: hidden;
            animation: santa-ride 20s linear infinite;
        }

        .santa-gif img {
            width: 100%;
            height: auto;
        }

        @keyframes santa-ride {
            0% {
                transform: translateX(0) scaleX(1); 
            }
            50% {
                transform: translateX(100vw) scaleX(1); 
            }
            75% {
                transform: translateX(100vw) scaleX(-1); 
            }
            100% {
                transform: translateX(5vw) scaleX(-1); 
            }
        }
    </style>
</head>
<body>
    <div id="snow-container"></div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <img src="image/christmashat.png" alt="Santa Hat" class="hat">
                    <div class="santa-gif">
                        <img src="image/santaclaire.gif" alt="Santa Claus with Reindeer">
                    </div>
                    <div class="logo">
                        <img src="image/UCLOGO.png" alt="Logo">
                    </div>
                
                    <form>
                        <div class="form-group">
                            <input type="text" class="form-control" id="id-or-email" placeholder="ID Number or Email">
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" id="password" placeholder="Password">
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="remember-me">
                            <label class="form-check-label" for="remember-me">Remember Me</label>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Login</button>
                    </form>
                    <div class="mt-4">
                        <a href="#">Forgot Your Password?</a>
                        <p>Don't have an account? <a href="#">Register</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Generate snowflakes
        const snowContainer = document.getElementById('snow-container');

        function createSnowflake() {
            const snowflake = document.createElement('div');
            snowflake.classList.add('snowflake');
            snowflake.innerHTML = '&#10052;';
            snowflake.style.left = Math.random() * 100 + 'vw';
            snowflake.style.animationDuration = Math.random() * 3 + 7 + 's';
            snowflake.style.opacity = Math.random();
            snowflake.style.fontSize = Math.random() * 10 + 10 + 'px';

            snowContainer.appendChild(snowflake);

            setTimeout(() => {
                snowflake.remove();
            }, 15000);
        }

        setInterval(createSnowflake, 200);
    </script>
</body>
</html>