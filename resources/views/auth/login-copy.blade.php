<!DOCTYPE html>
<!-- Coding by CodingNepal | www.codingnepalweb.com-->
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <title> Login - EArsip </title>
    <link rel="icon" type="image/png" href="{{ asset('dist/img/logo.png') }}">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Poppins", sans-serif;
        }

        body {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #ffffff;
            padding: 30px;
        }

        .container {
            position: relative;
            max-width: 850px;
            width: 100%;
            background: #fff;
            padding: 40px 30px;
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
            perspective: 2700px;
        }

        .container .cover {
            position: absolute;
            top: 0;
            left: 50%;
            height: 100%;
            width: 50%;
            z-index: 98;
            transition: all 1s ease;
            transform-origin: left;
            transform-style: preserve-3d;
            backface-visibility: hidden;
        }

        .container #flip:checked~.cover {
            transform: rotateY(-180deg);
        }

        .container #flip:checked~.forms .login-form {
            pointer-events: none;
        }

        .container .cover .front,
        .container .cover .back {
            position: absolute;
            top: 0;
            left: 0;
            height: 100%;
            width: 100%;
        }

        .cover .back {
            transform: rotateY(180deg);
        }

        .container .cover img {
            position: absolute;
            height: 100%;
            width: 100%;
            object-fit: cover;
            z-index: 10;
        }

        .container .cover .text {
            position: absolute;
            z-index: 10;
            height: 100%;
            width: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .container .cover .text::before {
            content: '';
            position: absolute;
            height: 100%;
            width: 100%;
            opacity: 0.5;
            background: #e8a62a;
        }

        .cover .text .text-1,
        .cover .text .text-2 {
            z-index: 20;
            font-size: 26px;
            font-weight: 600;
            color: #fff;
            text-align: center;
        }

        .cover .text .text-2 {
            font-size: 15px;
            font-weight: 500;
        }

        .container .forms {
            height: 100%;
            width: 100%;
            background: #fff;
        }

        .container .form-content {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .form-content .login-form,
        .form-content .signup-form {
            width: calc(100% / 2 - 25px);
        }

        .forms .form-content .title {
            position: relative;
            font-size: 24px;
            font-weight: 500;
            color: #333;
        }

        .forms .form-content .logo {
            display: block;
            margin: 0 auto 10px;
            /* auto untuk horizontal center */
        }

        .forms .form-content .title:before {
            content: '';
            position: absolute;
            left: 0;
            bottom: 0;
            height: 3px;
            width: 25px;
            background: #e8a62a;
        }

        .forms .signup-form .title:before {
            width: 20px;
        }

        .forms .form-content .input-boxes {
            margin-top: 30px;
        }

        .forms .form-content .input-box {
            display: flex;
            align-items: center;
            height: 50px;
            width: 100%;
            margin: 10px 0;
            position: relative;
        }

        .form-content .input-box input {
            height: 100%;
            width: 100%;
            outline: none;
            border: none;
            padding: 0 30px;
            font-size: 16px;
            font-weight: 500;
            border-bottom: 2px solid rgba(0, 0, 0, 0.2);
            transition: all 0.3s ease;
        }

        .form-content .input-box input:focus,
        .form-content .input-box input:valid {
            border-color: #e8a62a;
        }

        .form-content .input-box i {
            position: absolute;
            color: #e8a62a;
            font-size: 17px;
        }

        .forms .form-content .text {
            font-size: 14px;
            font-weight: 500;
            color: #333;
        }

        .forms .form-content .text a {
            text-decoration: none;
        }

        .forms .form-content .text a:hover {
            text-decoration: underline;
        }

        .forms .form-content .button {
            color: #fff;
            margin-top: 40px;
        }

        .forms .form-content .button input {
            color: #fff;
            background: #e8a62a;
            border-radius: 6px;
            padding: 0;
            cursor: pointer;
            transition: all 0.4s ease;
        }

        .forms .form-content .button input:hover {
            background: #e8962a;
        }

        .forms .form-content label {
            color: #e8962a;
            cursor: pointer;
        }

        .forms .form-content label:hover {
            text-decoration: underline;
        }

        .forms .form-content .login-text,
        .forms .form-content .sign-up-text {
            text-align: center;
            margin-top: 25px;
        }

        .container #flip {
            display: none;
        }

        @media (max-width: 730px) {
            .container .cover {
                display: none;
            }

            .form-content .login-form,
            .form-content .signup-form {
                width: 100%;
            }

            .form-content .signup-form {
                display: none;
            }

            .container #flip:checked~.forms .signup-form {
                display: block;
            }

            .container #flip:checked~.forms .login-form {
                display: none;
            }
        }
    </style>
    <!-- Fontawesome CDN Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <div class="container">
        <div class="cover">
            <div class="front">
                <img src="dist/img/photo1.png" alt="">
                <div class="text">
                    <span class="text-1">Welcome to <br> E-Arsip App</span>
                    <span class="text-2">Let's get connected</span>
                </div>
            </div>
        </div>
        <div class="forms">
            <div class="form-content">
                <div class="login-form">
                    <img src="/dist/img/logo.png" height="80" class="logo" alt="">
                    <div class="title">Login</div>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="input-boxes">
                            <div class="input-box">
                                <i class="fas fa-envelope"></i>
                                <input type="email" placeholder="Enter your email" name="email"
                                    :value="old('email')" required autofocus autocomplete="username" />
                            </div>
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            <div class="input-box">
                                <i class="fas fa-lock"></i>
                                <input type="password" placeholder="Enter your password" type="password" name="password"
                                    required autocomplete="current-password">
                            </div>
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                            <div class="button input-box">
                                <input type="submit" value="Login">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
