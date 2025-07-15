<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<?php
header('Connection: Keep-alive');
header('Cache-Control: max-age=31536000, must-revalidate');
header('Cache-Control: max-age=31536000, post-check=0, pre-check=0', false);
?>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>


    <!-- Fonts -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>


    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.css') }}">


    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/v4-shims.css">

    <script src="{{ asset('js/bootstrap.js') }}"></script>

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    {{-- <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet"> --}}


    <style>
        @font-face {
            font-family: proxima;
            font-weight: normal;
            src: url('public/fonts/proxima_ssv/ProximaNova-Regular.otf');
        }

        @font-face {
            font-family: proxima;
            font-weight: bold;
            src: url('public/fonts/proxima_ssv/Proxima\ Nova\ Bold.otf');
        }

        @font-face {
            font-family: proxima;
            font-weight: 200;
            src: url('public/fonts/proxima_ssv/Proxima\ Nova\ Thin.otf');
        }

        body {
            font-family: 'proxima';
        }

        .dropstart .dropdown-toggle::before {
            display: inline-flex;
            margin-right: 0.255em;
            vertical-align: 0.255em;
            content: "";
            border-top: 0.3em solid transparent;
            border-right: 0.3em solid;
            border-bottom: 0.3em solid transparent;
        }

        .dropstart .dropdown-toggle::after {
            display: none !important;
        }

    </style>
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a style="width: 12%;" href="/"><img style="width: 100%;"
                        src="{{ asset('kshopina-express_b.png') }}" alt=""></a>
                {{-- <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a> --}}
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul style="padding-left: 65px;" class="navbar-nav mr-auto">

                        {{-- @if (isset(Auth::user()->name) && Auth::user()->name != 'OCS')
                            <a href="/?store=origin"
                                style="margin-right: 3em;color: #7f7f7f; @if (isset($_GET['store']) && $_GET['store'] == 'origin') color: #cca351;font-weight: bold; @endif">Original</a>
                            <a href="/?store=plus_egypt"
                                style="margin-right: 3em;color: #7f7f7f; @if (isset($_GET['store']) && $_GET['store'] == 'plus_egypt') color: #cca351;font-weight: bold; @endif">Plus-Egypt</a>
                            <a href="/?store=plus_kuwait"
                                style="margin-right: 3em;color: #7f7f7f; @if (isset($_GET['store']) && $_GET['store'] == 'plus_kuwait') color: #cca351;font-weight: bold; @endif">Plus-Kuwait</a>
                            <a href="/?store=plus_ksa" style="color: #7f7f7f;@if (isset($_GET['store']) && $_GET['store'] == 'plus_ksa') color: #cca351;font-weight: bold; @endif">Plus-KSA</a>
                        @endif --}}
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        {{-- yasmin w nour --}}



                        {{-- yasmin w nour end --}}
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif

                        @else
                            
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <div class="btn-group dropstart">

                                        <a class="nav-link dropdown-toggle sub" href="#" id="navbarDropdown" role="button"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Currency
                                        </a>


                                        <div style="left: auto;top: 0%;right: 100%;margin:0; background-color: #f9f9f9; padding:0px; text-align: center;"
                                            class="dropdown-menu sub_m" aria-labelledby="navbarDropdown">
                                            
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th style="color: #cba369;  width: 35%;" scope="col">Currency </th>
                                                        <th style="color: #cba369; " scope="col">Current</th>
                                                        <th style="color: #cba369; " scope="col">Suggested</th>
                                                        <th style="color: #cba369; " scope="col">inputs </th>

                                                    </tr>
                                                </thead>
                                                <tbody id="country_table">

                                                    <tr id="country_row">
                                                        <td class="country"></td>
                                                        <td class="suggested_currency"></td>
                                                        <td class="currency_input"> <input type="text"
                                                                style="text-align: center;width: 80px; font-weight:bold;    background-color: transparent;  border:none; outline-color:#dfdfdf; ">
                                                        </td>
                                                    </tr>
                                                </tbody>

                                            </table>
                                            <div
                                                style="display: flex; justify-content: flex-end; width: 100%; height: 50px;">
                                                <button type="submit" id="currency_submit" onclick='currency_submit()'
                                                    style="letter-spacing: .7px; font-size: 12px; font-weight: 600;background-color: #36304a; border-color: #36304a; display: flex; padding-inline: 13px; height: 65%; margin-top: -14px; margin-right: 2rem;"
                                                    class="btn btn-success btn-s">
                                                    Submit
                                                </button>

                                            </div>


                                        </div>
                                        {{-- <div style="left: auto;top: 0%;right: 100%" class="dropdown-menu sub_m" aria-labelledby="navbarDropdown">
                                            <a class="dropdown-item sub_i" href="#">Action</a>
                                            <a class="dropdown-item sub_i" href="#">Another action</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="#">Something else here</a>
                                        </div> --}}
                                    </div>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                                                                                                                                                                             document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                   
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        class="d-none">
                                        {{ csrf_field() }}
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
    <script>
        var currency_data = new Object();
        var currency;
        var new_currency;


        function get_currency(elemant) {





        }

        function change_currency(elemant) {
            currency = elemant.id.substring(elemant.id.indexOf("_") + 1);

            new_currency = elemant.value;
            currency_data[currency] = new_currency;
            console.log(currency_data);



        }

        function currency_submit() {
            $.ajax({
                url: "new_currency",
                type: 'POST',
                data: {
                    _token: "{{ csrf_token() }}",
                    data: currency_data,


                },
                success: function(response) {
                    console.log(response);
                    /*                     location.reload(true);
                     */
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'The currency has been updated',
                        showConfirmButton: false,
                        timer: 1500
                    });

                }
            });
        }

        $(document).ready(function() {
            $('.sub').mouseover(function() {
                var html = "";
                var countries = {
                    SAR: 'Saudi Arabia',
                    KWD: 'Kuwait',
                    JOD: 'Jordan',
                    BHD: 'Bahrain',
                    OMR: 'Oman',
                    EGP: 'Egypt',
                    QAR: 'Qatar',
                    AED: 'United Arab Emirates'
                };



                try {
                    ajaxx.abort();
                } catch (error) {

                }
                setTimeout(function() {

                    ajaxx = $.ajax({
                        url: "get_currency",
                        type: 'get',
                        data: {
                            _token: "{{ csrf_token() }}",
                        },
                        success: function(response) {
                            /* countries[response[0][i].keyy] + '(' + */ 

                            for (let i = 0; i < response[0].length; i++) {

                                html += '<tr class="country_row">';
                                html +=
                                    ' <td class="country" style="font-size: 14px;padding: 0.5rem; width: 40%;"><span style="font-weight: 700;display: flex;align-items: center;justify-content: center;height: 35px;">' +
                                    response[0][
                                        i].keyy + 
                                    ' </span>   </td>';
                                html +=
                                    '<td class="current_currency" style="font-size: 14px;padding: 0.5rem;"><span style="display: flex;align-items: center;justify-content: center;height: 35px;"> ' +
                                    response[0][i].value + '</span> </td>';

                                html +=
                                    '<td class="suggested_currency" style="font-size: 14px;padding: 0.5rem;"><span style="display: flex;align-items: center;justify-content: center;height: 35px;"> ' +
                                    response[0][i].type + '</span> </td>';
                                html +=
                                    ' <td class="currency_input"> <input autocomplete="off" type="text" name ="new_currency_value" id="currency_' +
                                    response[0][i].keyy +
                                    '" onkeyup="change_currency(this)" style="border: solid;border-color: #b3b3b38a;border-radius: 4px;text-align: center;width: 80px; font-weight:bold;  background-color: transparent; outline-color:#dfdfdf; "> </td>';
                                html += '</tr>';

                            }

                            $('#country_table').html(html);



                        }
                    });
                }, 500);
                $('.sub_m').show();
            })

            $('.sub').mouseout(function() {
                t = setTimeout(function() {
                    $('.sub_m').hide();
                }, 100);

                $('.sub_m').on('mouseenter', function() {
                    $('.sub_m').show();
                    clearTimeout(t);
                });
               /*  
                
                $('.sub_m').on('mouseleave', function() {
                    setTimeout(function() {
                    $('.sub_m').hide();
                }, 500);
                }) */
            })
        });
        /* $(document).on('click', '.sub_m', function (e) {
          e.stopPropagation();
        }); */
    </script>

</body>

</html>
