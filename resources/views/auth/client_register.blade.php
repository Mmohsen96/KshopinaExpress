<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/v4-shims.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script src="{{ asset('js/sweetalert2.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('js/sweetalert2.min.css') }}">
</head>
<style>
    @import url('https://fonts.googleapis.com/css?family=Montserrat:400,800');

    * {
        box-sizing: border-box;
    }


    body {
        /*  background: #f6f5f7; */
        background: #1b3425;
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
        font-family: 'Montserrat', sans-serif;
        height: 90vh;
    }

    h1 {
        font-weight: bold;
        margin: 0;
    }

    h2 {
        text-align: center;
    }

    p {
        font-size: 14px;
        font-weight: 100;
        line-height: 20px;
        letter-spacing: 0.5px;
        margin: 20px 0 30px;
    }

    span {
        font-size: 12px;
    }

    a {
        color: #333;
        font-size: 14px;
        text-decoration: none;
        margin: 15px 0;
    }

    button {
        transition: all .5s ease;
        border-radius: 20px;
        border-style: unset;
        font-size: 12px;
        font-weight: bold;
        padding: 12px 45px;
        letter-spacing: 1px;
        text-transform: uppercase;
        transition: transform 80ms ease-in;
    }

    .form-but:hover {
        background: rgba(203, 157, 72) !important;
        padding: 13px 52px;
    }

    .input-type {

        border-radius: 10px;
    }

    button:active {
        transform: scale(0.95);
    }

    button:focus {
        outline: none;
    }

    button.ghost {
        color: white;
        background-color: transparent;
        border-style: solid;
        border-color: white;
        cursor: pointer;
    }

    button.ghost:hover {
        border-color: #d7b16a;
    }

    .social:hover {
        background-color: #aa853f;
        color: white;
    }


    form {
        background-color: #FFFFFF;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        padding: 0 50px;
        height: 100%;
        text-align: center;
    }

    input {
        background-color: #eee;
        border: none;
        padding: 12px 15px;
        margin: 8px 0;
        width: 100%;
    }

    .container {
        margin-top: 2rem;
        background-color: #fff;
        border-radius: 10px;
        box-shadow: 0 14px 28px rgba(0, 0, 0, 0.25),
            0 10px 10px rgba(0, 0, 0, 0.22);
        position: relative;
        overflow: hidden;
        width: 768px;
        max-width: 100%;
        min-height: 480px;
    }

    .form-container {
        position: absolute;
        top: 0;
        height: 100%;
        transition: all 0.6s ease-in-out;
    }

    .sign-in-container {
        left: 0;
        width: 50%;
        z-index: 2;
    }

    .sign-in-container h1 {
        white-space: nowrap;
    }

    .container.right-panel-active .sign-in-container {
        transform: translateX(100%);
    }

    .sign-up-container {
        left: 0;
        width: 50%;
        opacity: 0;
        z-index: 1;
    }

    .container.right-panel-active .sign-up-container {
        transform: translateX(100%);
        opacity: 1;
        z-index: 5;
        animation: show 0.6s;
    }

    @keyframes show {

        0%,
        49.99% {
            opacity: 0;
            z-index: 1;
        }

        50%,
        100% {
            opacity: 1;
            z-index: 5;
        }
    }

    .overlay-container {
        position: absolute;
        top: 0;
        left: 50%;
        width: 50%;
        height: 100%;
        overflow: hidden;
        transition: transform 0.6s ease-in-out;
        z-index: 100;
    }

    .container.right-panel-active .overlay-container {
        transform: translateX(-100%);
    }

    .overlay {
        background: #1B3425;
        background: -webkit-linear-gradient(to right, #907239, #CB9D48);
        background: linear-gradient(to right, #907239, #CB9D48);
        background-repeat: no-repeat;
        background-size: cover;
        background-position: 0 0;
        color: #FFFFFF;
        position: relative;
        left: -100%;
        height: 100%;
        width: 200%;
        transform: translateX(0);
        transition: transform 0.6s ease-in-out;
    }

    .container.right-panel-active .overlay {
        transform: translateX(50%);
    }

    .overlay-panel {
        position: absolute;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        padding: 0 40px;
        text-align: center;
        top: 0;
        height: 100%;
        width: 50%;
        transform: translateX(0);
        transition: transform 0.6s ease-in-out;
    }

    .overlay-left {
        transform: translateX(-20%);
    }

    .container.right-panel-active .overlay-left {
        transform: translateX(0);
    }

    .overlay-right {
        right: 0;
        transform: translateX(0);
    }

    .container.right-panel-active .overlay-right {
        transform: translateX(20%);
    }

    .social-container {
        margin: 20px 0;
        display: flex;
        /*   width: 100%; */
        align-items: center;
        justify-content: center;
    }

    .social-container a {
        border: 1px solid #DDDDDD;
        border-radius: 50%;
        display: inline-flex;
        /*   justify-content: center; */
        align-items: center;
        margin: 0 5px;
        height: 40px;
        width: 40px;
        justify-content: space-around;
        align-content: center;
    }

    footer {
        background-color: #222;
        color: #fff;
        font-size: 14px;
        bottom: 0;
        position: fixed;
        left: 0;
        right: 0;
        text-align: center;
        z-index: 999;
    }

    .sign-in-container .inputs,
    .sign-up-container .inputs {
        width: 100%;
    }

    .sign-in-container span {
        white-space: nowrap;
    }

    @media(max-width: 530px) {
        .overlay-panel p {

            font-size: small;
        }

        .overlay-panel h1 {
            font-size: x-large;
        }

        .container button {

            padding: 10px 35px;

        }

        .sign-in-container .inputs,
        .sign-up-container .inputs {
            width: 125%;
        }

        .sign-up-container h1 {
            font-size: x-large;
        }

        .form-but:hover {
            background: rgba(203, 157, 72) !important;
            padding: 11px 35px;

        }

    }

    @media(max-width: 470px) {
        .logo {
            width: 10rem !important;
        }
    }

    @media(max-width: 452px) {


        .container button {

            padding: 8px 25px;

        }

        .form-but:hover {
            background: rgba(203, 157, 72) !important;
            padding: 9px 25px;

        }

        .sign-in-container .inputs,
        .sign-up-container .inputs {
            width: 150%;
        }

        .sign-up-container span {
            white-space: nowrap;
        }

        .overlay-left p {
            white-space: nowrap;
        }

        .text-break {

            display: inline-flex !important;


        }

    }


    @media(max-width: 416px) {


        .container button {

            padding: 5px 25px;
            white-space: nowrap;

        }

        .form-but:hover {
            background: rgba(203, 157, 72) !important;
            padding: 6px 25px;

        }

        .sign-in-container .inputs,
        .sign-up-container .inputs {
            width: 200%;
        }

        .logo {
            width: 8rem !important;
        }

        .aa {
            font-size: xx-small;

        }

        .sign-in-container h1 {
            font-size: x-large;
        }


    }

</style>

<body>

    <div class="container" id="container">
        <div class="form-container sign-up-container">
            <form id="register_form" method="POST" action="{{ route('register') }}">
                @csrf
                <h1 style="color: #1B3425;">Create Account</h1>
                <div class="social-container">
                    {{-- <a href="#" class="social"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="social"><i class="fab fa-google-plus-g"></i></a>
                    <a href="#" class="social"><i class="fab fa-linkedin-in"></i></a> --}}
                </div>
                {{-- <span>or use your <br class="text-break" style="display: none"> email for registration</span> --}}
                <div class="inputs">
                    <input value="1" type="text" name="register_type" hidden readonly />
                    <input id="name" type="text" class="input-type @error('name') is-invalid @enderror" name="name"
                        value="{{ old('name') }}" autocomplete="name" autofocus placeholder="Name" required />
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                    <input id="email" type="email" class="input-type @error('email') is-invalid @enderror" name="email"
                        value="{{ old('email') }}" autocomplete="email" placeholder="Email" required />
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                    <input id="register_password" type="password"
                        class="input-type @error('password') is-invalid @enderror" name="password"
                        autocomplete="new-password" placeholder="Password" required />
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                    <input id="password-confirm" name="password_confirmation" autocomplete="new-password"
                        class='input-type' type="password" placeholder="Confirm your Password" required />
                </div>
                <button class='form-but'
                    style="display: flex;position: relative;top: 20px;border-color: transparent !important;background: linear-gradient(35deg, rgba(27, 52, 37, 0.9612219887955182) 35%, rgba(41, 110, 69, 0.9808298319327731) 100%);color: #FFFFFF;">
                    SignUp</button>
            </form>
        </div>
        <div class="form-container sign-in-container">
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <h1 style="color: #1B3425;">Sign in</h1>
                <div class="social-container">
                    {{-- <a href="#" class="social"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="social"><i class="fab fa-google-plus-g"></i></a>
                    <a href="#" class="social"><i class="fab fa-linkedin-in"></i></a> --}}
                </div>
                {{-- <span>or use your account</span> --}}
                <div class="inputs">
                    <input class='input-type' type="email" placeholder="Email"
                        class=" @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required
                        autocomplete="email" />
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <input class='input-type' type="password" placeholder="Password"
                        class=" @error('password') is-invalid @enderror" name="password" required
                        autocomplete="current-password" id="login_password" />
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                </div>
                <div style="width: 100%;justify-content: start;display: flex;align-items: center;">
                    <input style="margin-inline: 7px;width: auto;" id="remember" name="remember" type="checkbox"
                        {{ old('remember') ? 'checked' : '' }} /> <span style="font-weight: 600;"
                        class="pl-2 font-weight-bold">Remember
                        Me</span>
                </div>
                <div style="display: flex;position: relative;top: 25px;">
                    <button class='form-but'
                        style=" border-color: transparent !important;background: linear-gradient(35deg, rgba(27, 52, 37, 0.9612219887955182) 35%, rgba(41, 110, 69, 0.9808298319327731) 100%);color: #FFFFFF;">Sign
                        In</button>
                </div>
                <a href="{{ route('password.request') }}" class='aa'
                    style="display: flex;position: relative;top: 25px;white-space: nowrap;">Forgot your password?</a>


            </form>
        </div>
        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-left">
                    {{-- <h1>Welcome Back!</h1> --}}

                    <img class="logo" src="{{ asset('background-yellow.png') }}" alt="ops"
                        style="width: 11rem;">
                    <p>To keep connected with <br class="text-break" style="display: none">us please login with
                        your<br class="text-break" style="display: none"> personal info</p>
                    <button class="ghost" id="signIn">Sign In</button>
                </div>
                <div class="overlay-panel overlay-right">
                    {{-- <h1>Hello, Friend!</h1> --}}

                    <img class="logo" src="{{ asset('background-yellow.png') }}" alt="ops"
                        style="width: 11rem;">
                    <p>Enter your personal details and start journey with us</p>
                    <button class="ghost" id="signUp">Sign Up</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        $("#register_form").on("submit", function(e) {
            e.preventDefault();
            Swal.fire({
                position: 'center',
                icon: 'error',
                title: 'The register is not available!',
                showConfirmButton: false,
                timer: 2500
            });
        });
        const signUpButton = document.getElementById('signUp');
        const signInButton = document.getElementById('signIn');
        const container = document.getElementById('container');

        signUpButton.addEventListener('click', () => {
            container.classList.add("right-panel-active");
        });

        signInButton.addEventListener('click', () => {
            container.classList.remove("right-panel-active");
        });
    </script>
</body>

</html>
