<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>


    <script src="{{ asset('js/bootstrap.js') }}"></script>


    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css">
    {{-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/v4-shims.css"> --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.css') }}">

</head>
<style>
    body {
        background: #c9ccd1;
    }

    .form-style input {
        border: 0;
        height: 40px;
        border-radius: 0;
        border-bottom: 1px solid #ebebeb;
    }

    .form-style input:focus {
        border-bottom: 1px solid #007bff;
        box-shadow: none;
        outline: 0;
        background-color: #ebebeb;
    }

    .sideline {
        display: flex;
        width: 100%;
        justify-content: center;
        align-items: center;
        text-align: center;
        color: #ccc;
    }

    button {
        height: 50px;
    }

    .sideline:before,
    .sideline:after {
        content: "";
        border-top: 1px solid #ebebeb;
        margin: 0 20px 0 0;
        flex: 1 0 20px;
    }

    .sideline:after {
        margin: 0 0 0 20px;
    }

    input:-webkit-autofill,
    input:-webkit-autofill:hover,
    input:-webkit-autofill:focus,
    input:-webkit-autofill:active {
        -webkit-box-shadow: 0 0 0 30px white inset !important;
    }

    input:-webkit-autofill::first-line {
        font-size: 17px;
    }

    .form-group {
        margin-bottom: 0rem;
    }

    @media (max-width: 650px) {
        .main {
            width: 100% !important;
            max-width: 650px;
        }
        .sub-main{
            margin-inline: 10px !important;
        }

    }

</style>

<body>
    <div style="width: 80%;" class="main container">
        <div class="sub-main row m-5 no-gutters shadow-lg">
            <div class="col-md-6 d-none d-md-block">
                <img style="object-fit: none;min-height: 100%;background-color: #343a40;" src="{{ secure_url(asset('login.png')) }}"
                    class="img-fluid" style="min-height:100%;" />
            </div>
            <div class="col-md-6 bg-white p-5">
                <h3 style="margin-bottom: 55px;font-size: 2.5rem;" class="pb-3">Login</h3>
                <div class="form-style">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div style="margin-left: 0px;justify-content: start;align-items: baseline;"
                            class="row form-group pb-3">

                            <i style="font-size: 17px;width: 10%; " class="far fa-envelope"></i>

                            <input id="email" style="font-size: 17px;width:85%;padding: 0px;" type="email"
                                placeholder="Email" class=" @error('email') is-invalid @enderror" name="email"
                                value="{{ old('email') }}" required autocomplete="email" autofocus>

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div style="margin-left: 0px;justify-content: start;align-items: baseline;"
                            class="row form-group pb-3">
                            <i style="font-size: 17px;;width: 10%; " class="fas fa-lock"></i>
                            <input style="font-size: 17px;width:85%; padding: 0px;" type="password"
                                placeholder="Password" class=" @error('password') is-invalid @enderror" name="password"
                                required autocomplete="current-password" id="password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center"><input id="remember" name="remember" type="checkbox"
                                    {{ old('remember') ? 'checked' : '' }} /> <span
                                    class="pl-2 font-weight-bold">Remember Me</span></div>
                            {{-- <div><a href="#">Forget Password?</a></div> --}}
                        </div>
                        <div style="margin-top: 40px;" class="pb-2">
                            <button style="background-color:#ca9b49;border-color:#ca9b49; height: 42px;" type="submit"
                                class="btn btn-dark w-100 font-weight-bold mt-2">{{ __('Login') }}</button>

                            <div class="pt-4 text-center">
                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>

                        </div>
                    </form>
                    {{-- <div class="sideline">OR</div>
                    <div>
                        <button type="submit" class="btn btn-primary w-100 font-weight-bold mt-2"><i
                                class="fa fa-facebook" aria-hidden="true"></i> Login With Facebook</button>
                    </div> --}}

                </div>

            </div>
        </div>
    </div>
</body>

</html>
