<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
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

        #snow-container {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
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
            animation-duration: 40s;
            font-size: 1.2rem;
        }

        .snowflake:nth-child(even) {
            animation-duration: 30s;
            font-size: 0.8rem;
        }

        .container {
            position: absolute;
            top: 50%;
            left: 51.8%;
            transform: translate(-50%, -50%);
            z-index: 1;
            width: 400%; 
            max-width: 58%;
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
            bottom: -38%;
            left: -660px;
            width: 500px;
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
                transform: translateX(0vw) scaleX(-1);
            }
        }
    </style>
</head>

<body>
    <!-- Snowflake container -->
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
                        <img src="image/UCLOGO.png" alt="logo">
                    </div>

                    <form action="/login" method="POST">
                        @csrf
                        <div class="form-outline mb-3">
                            <input type="email" id="email" name="email" class="form-control" placeholder="Email">
                        </div>
                        <div class="form-outline mb-3">
                            <input type="password" id="password" name="password" class="form-control" placeholder="Password">
                        </div>
                        <div class="form-check mb-3">
                            <input type="checkbox" class="form-check-input" id="showPassword">
                            <label class="form-check-label" for="showPassword">Show Password</label>
                        </div>
                        <button class="btn btn-primary btn-block w-100 mb-3">Login</button>
                        <a href="#" class="text-muted">Forgot Password?</a>
                    </form>

                    <div class="mt-4">
                        <p>Don't have an account? <a href="/register_consent" class="text-primary">Register</a></p>
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
            snowflake.innerHTML = '&#10054;';
            snowflake.style.left = Math.random() * 100 + 'vw';
            snowflake.style.animationDuration = Math.random() * 3 + 7 + 's';
            snowflake.style.opacity = Math.random();
            snowflake.style.fontSize = Math.random() * 10 + 10 + 'px';

            snowContainer.appendChild(snowflake);

            setTimeout(() => {
                snowflake.remove();
            }, 10000);
        }

        setInterval(createSnowflake, 200);
        // Show/hide password functionality
        const passwordInput = document.getElementById('password');
        const showPasswordCheckbox = document.getElementById('showPassword');

        showPasswordCheckbox.addEventListener('change', () => {
            if (showPasswordCheckbox.checked) {
                passwordInput.type = 'text';
            } else {
                passwordInput.type = 'password';
            }
        });
    </script>
</body>

</html>