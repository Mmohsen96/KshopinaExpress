<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{-- <title>{{ config('app.name', 'Laravel') }}</title> --}}

    <link rel="icon" type="image/png" href="{{ asset('mini_yellow.png') }}" style="font-size: 2rem;">

    <link rel="shortcut icon"
        href="https://www.google.com/url?sa=i&url=https%3A%2F%2Far.wikipedia.org%2Fwiki%2F%25D9%2585%25D9%2584%25D9%2581%3ACircle-icons-computer.svg&psig=AOvVaw3O-ulCnXwWQPXHwnIAYu6z&ust=1647502755709000&source=images&cd=vfe&ved=0CAsQjRxqFwoTCOi1wpaQyvYCFQAAAAAdAAAAABAD">

    <link rel="icon"
        href="https://www.google.com/url?sa=i&url=https%3A%2F%2Far.wikipedia.org%2Fwiki%2F%25D9%2585%25D9%2584%25D9%2581%3ACircle-icons-computer.svg&psig=AOvVaw3O-ulCnXwWQPXHwnIAYu6z&ust=1647502755709000&source=images&cd=vfe&ved=0CAsQjRxqFwoTCOi1wpaQyvYCFQAAAAAdAAAAABAD">


    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/v4-shims.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.css') }}">


    <link href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>

    <script src="{{ asset('js/bootstrap.js') }}"></script>


    <script src="{{ asset('js/sweetalert2.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('js/sweetalert2.min.css') }}">    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

</head>

<style>
    body {
        margin: 0;
        font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
        font-size: 1rem;
        font-weight: 400;
        line-height: 1.5;
        color: #ffffff;
        text-align: left;
        background-color: #ffffff;
    }

    .w-100 {
        width: 60% !important;
    }

    .navbar {
        background: #1B3425;
        transition: left 0.25s ease;
    }

    @media (max-width: 992px) {
        .sidebar .nav {
            padding-top: 3rem !important;
        }


    }

    .navbar .navbar-brand-wrapper {
        transition: width 0.25s ease, background 0.25s ease;
        background: #1B3425;
        width: 244px;
        height: 70px;
    }




    .navbar .navbar-brand-wrapper .navbar-brand:active,
    .navbar .navbar-brand-wrapper .navbar-brand:focus,
    .navbar .navbar-brand-wrapper .navbar-brand:hover {
        color: #1B3425;
    }

    .navbar .navbar-brand-wrapper .navbar-brand img {
        width: calc(244px - 120px);
        max-width: 100%;
        height: 28px;
        margin: auto;
        vertical-align: middle;
    }

    .navbar .navbar-brand-wrapper .navbar-brand.brand-logo-mini {
        display: none;
    }

    .navbar .navbar-brand-wrapper .navbar-brand.brand-logo-mini img {
        width: calc(70px - 10px);
        max-width: 100%;
        height: 28px;
        margin: auto;
    }

    .navbar .navbar-menu-wrapper {
        transition: width 0.25s ease;
        color: #ffffff;
        padding-left: 15px;
        padding-right: 15px;
        width: 60%;
        height: 70px;
    }

    @media (max-width: 991px) {
        .navbar .navbar-menu-wrapper {
            width: auto;
            padding-left: 15px;
            padding-right: 15px;
        }
    }

    .navbar .navbar-menu-wrapper .navbar-toggler {
        border: 0;
        color: #6c7293;
        height: 70px;
        border-radius: 0px;
    }

    .navbar .navbar-menu-wrapper .navbar-toggler:not(.navbar-toggler-right) {
        font-size: 0.875rem;
        outline: none;
    }

    @media (max-width: 991px) {
        .navbar .navbar-menu-wrapper .navbar-toggler:not(.navbar-toggler-right) {
            position: relative;
            right: 50vw;
        }
    }

    @media (max-width: 991px) {
        .navbar .navbar-menu-wrapper .navbar-toggler.navbar-toggler-right {
            padding-left: 15px;
            padding-right: 11px;
            border-right: none;
        }
    }

    .navbar .navbar-menu-wrapper .search-field .input-group input {
        font-size: 0.875rem;
        padding: .5rem;
    }

    .navbar .navbar-menu-wrapper .search-field .input-group i {
        font-size: 17px;
        margin-right: 0;
        color: #ffffff;
    }

    .navbar .navbar-menu-wrapper .search-field .input-group .input-group-text {
        background: transparent;
    }


    .navbar .navbar-menu-wrapper .navbar-nav {
        flex-direction: row;
        align-items: center;
    }

    .navbar .navbar-menu-wrapper .navbar-nav .nav-item .nav-link {
        color: inherit;
        font-size: 0.9375rem;
        margin-left: 0rem;
        margin-right: 1rem;
        white-space: nowrap;
    }

    .navbar-nav .dropdown-menu {
        position: absolute;
        right: 10.01rem;
        top: 0rem;
    }

    @media (max-width: 767px) {
        .navbar .navbar-menu-wrapper .navbar-nav .nav-item .nav-link {
            margin-left: .8rem;
            margin-right: .8rem;
        }
    }

    .navbar .navbar-menu-wrapper .navbar-nav .nav-item .nav-link i {
        font-size: 1.125rem;
    }

    .navbar .navbar-menu-wrapper .navbar-nav .nav-item .nav-link .navbar-profile {
        display: flex;
        font-weight: normal;
        align-items: center;
    }

    .navbar .navbar-menu-wrapper .navbar-nav .nav-item .nav-link .navbar-profile .navbar-profile-name {
        white-space: nowrap;
        margin-left: 1rem;
    }

    .navbar .navbar-menu-wrapper .navbar-nav .nav-item .nav-link .navbar-profile i {
        color: #f7f6f3;
        margin-left: 10px;
        margin-bottom: 3px;
    }

    .navbar .navbar-menu-wrapper .navbar-nav .nav-item .nav-link.create-new-button {
        padding: 0.375rem 0.75rem;
    }

    .navbar .navbar-menu-wrapper .navbar-nav .nav-item.dropdown {
        line-height: 1rem;
    }

    .navbar .navbar-menu-wrapper .navbar-nav .nav-item.dropdown .dropdown-toggle:after {
        color: #1b3425;
        font-size: 1rem;
    }

    .navbar .navbar-menu-wrapper .navbar-nav .nav-item.dropdown .dropdown-menu {
        border: none;
        border-radius: 4px;
    }

    .navbar .navbar-menu-wrapper .navbar-nav .nav-item.dropdown .dropdown-menu.navbar-dropdown {
        position: absolute;
        font-size: 0.9rem;
        margin-top: 0;
        top: 45px;
        right: -18px;
        left: auto;
        box-shadow: -2px 0px 43px -8px #1e402c;
        padding: 0;
        border-radius: 8px;
    }

    .rtl .navbar .navbar-menu-wrapper .navbar-nav .nav-item.dropdown .dropdown-menu.navbar-dropdown {
        right: auto;
        left: 0;
    }

    .navbar .navbar-menu-wrapper .navbar-nav .nav-item.dropdown .dropdown-menu.navbar-dropdown .dropdown-item {
        margin-bottom: 0;
        padding: 11px 13px;
        cursor: pointer;
    }

    .navbar .navbar-menu-wrapper .navbar-nav .nav-item.dropdown .dropdown-menu.navbar-dropdown .dropdown-item:hover {
        color: #fff;
    }

    .navbar .navbar-menu-wrapper .navbar-nav .nav-item.dropdown .dropdown-menu.navbar-dropdown .dropdown-item i {
        font-size: 20px;
    }

    .navbar .navbar-menu-wrapper .navbar-nav .nav-item.dropdown .dropdown-menu.navbar-dropdown .dropdown-item .ellipsis {
        max-width: 200px;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .rtl .navbar .navbar-menu-wrapper .navbar-nav .nav-item.dropdown .dropdown-menu.navbar-dropdown .dropdown-item i {
        margin-left: 10px;
    }

    .navbar .navbar-menu-wrapper .navbar-nav .nav-item.dropdown .dropdown-menu.navbar-dropdown .dropdown-divider {
        margin: 0;
    }

    @media (max-width: 991px) {
        .navbar .navbar-menu-wrapper .navbar-nav .nav-item.dropdown {
            position: static;
        }

        .navbar .navbar-menu-wrapper .navbar-nav .nav-item.dropdown .navbar-dropdown {
            left: 20px;
            right: 20px;
            top: 70px;
            width: calc(100% - 40px);
        }
    }

    .navbar .navbar-menu-wrapper .navbar-nav .nav-item.nav-profile .nav-link .nav-profile-img {
        position: relative;
        width: 32px;
        height: 32px;
    }

    .navbar .navbar-menu-wrapper .navbar-nav .nav-item.nav-profile .nav-link .nav-profile-img .availability-status.online {
        background: #00d25b;
    }

    .navbar .navbar-menu-wrapper .navbar-nav .nav-item.nav-profile .nav-link .nav-profile-img .availability-status.offline {
        background: #fc424a;
    }

    .navbar .navbar-menu-wrapper .navbar-nav .nav-item.nav-profile .nav-link .nav-profile-img .availability-status.busy {
        background: #ffab00;
    }

    .navbar .navbar-menu-wrapper .navbar-nav .nav-item.nav-profile .nav-link .nav-profile-text {
        margin-left: 1.25rem;
    }

    .rtl .navbar .navbar-menu-wrapper .navbar-nav .nav-item.nav-profile .nav-link .nav-profile-text {
        margin-left: 0;
        margin-right: 1.25rem;
    }

    .navbar .navbar-menu-wrapper .navbar-nav .nav-item.nav-profile .nav-link .nav-profile-text p {
        line-height: 1;
    }

    @media (max-width: 767px) {
        .navbar .navbar-menu-wrapper .navbar-nav .nav-item.nav-profile .nav-link .nav-profile-text {
            display: none;
        }
    }

    .navbar .navbar-menu-wrapper .navbar-nav .nav-item.nav-profile .nav-link.dropdown-toggle:after {
        line-height: 2;
    }

    @media (min-width: 992px) {
        .navbar .navbar-menu-wrapper .navbar-nav.navbar-nav-right {
            margin-left: auto;
        }

        .rtl .navbar .navbar-menu-wrapper .navbar-nav.navbar-nav-right {
            margin-left: 0;
            margin-right: auto;
        }
    }

    .navbar .navbar-menu-wrapper .search input {
        background-color: #f7f6f3;
        padding: 9px 20px 9px 40px;
        border: 2px solid #1b3425;
        width: 100%;
        border-radius: 6px;
    }

    .navbar .navbar-menu-wrapper .search input:focus-visible {
        outline: none !important;
        text-decoration: none !important;
        border: 2px solid #937b2a;
    }

    .navbar .navbar-menu-wrapper .search input::placeholder {
        color: #296E45;
        font-size: 0.9rem;
        margin-bottom: 10px;
    }

    @media (max-width: 991px) {
        .navbar {
            flex-direction: row;
            left: 0px;
        }



        .navbar .navbar-brand-wrapper .navbar-brand.brand-logo {
            display: none;
        }

        .navbar .navbar-brand-wrapper .navbar-brand.brand-logo-mini {
            display: inline-block;
        }

        .navbar-collapse {
            display: flex;
            margin-top: 0.5rem;
        }
    }


    /* Layouts */
    .navbar.fixed-top+.page-body-wrapper {
        padding-top: 70px;
    }


    .page-body-wrapper {
        min-height: 100vh;
        display: flex;
        padding-left: 0px;
        padding-right: 0;
        transition: all 0.25s ease;
        width: calc(100% - 244px);
    }


    .page-body-wrapper.full-page-wrapper {
        width: 100%;
        min-height: 100vh;
    }



    .container-scroller {
        display: flex;
        position: relative;
        background-color: white;
    }

    .main-panel {
        transition: width 0.25s ease, margin 0.25s ease;
        width: 100%;
        min-height: calc(100vh - 70px);
        padding-top: 70px;
        display: flex;
        flex-direction: column;
        background-color: white;
    }

    .content-wrapper {
        background: white;
        padding: 4rem 0rem;
        width: 100%;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .navbar .navbar-menu-wrapper .navbar-nav .nav-item.dropdown .dropdown-menu.navbar-dropdown .dropdown-item {
        margin-bottom: 0;
        padding: 20px 13px;
        background-color: #1B3425;
        border-radius: 0px;
        color: #f7f6f3;
        cursor: pointer;
        display: flex;
        align-items: center;
    }

    .dropdown-toggle:after {
        color: transparent !important;
        font-size: 0rem !important;
    }

    .preview-list .preview-item .preview-thumbnail {
        color: #ffffff;
        position: relative;
    }

    .preview-item-content {
        margin-left: 1rem;
    }

    .bg-dark {
        height: 2rem;
        width: 2rem;
        background-color: #1e402c !important;
        display: flex;
        flex-direction: row;
        justify-content: center;
        align-items: center;
    }

    .dropdown-divider {
        border-top: 1px solid #1e402c !important;
    }

    .form-control:focus {
        box-shadow: 0 0 0 0.1rem rgb(203 157 72 / 84%) !important;
    }

    .selected {
        background: #0d1d11;
        color: #ffffff !important;
    }

</style>

<style>
    .table thead th {
        border-bottom: 1px solid #0e3c20;
    }

    .table td {
        border-top: 1px solid #0e3c20;
    }

    .table th {
        border-top: none;
    }

</style>

<body>
    <div class="container-scroller">

        <div class="container-fluid page-body-wrapper ">
            <nav class="navbar p-0 fixed-top d-flex flex-row">
                <div>
                    <a href="#" style="display: flex;align-content: center;justify-content: center;">
                        <img src="{{ asset('kshopina-express1.png') }}" alt="logo"
                            style="width:25%;margin-right: 8rem;" />
                    </a>
                </div>
                <div class="navbar-menu-wrapper flex-grow d-flex align-items-stretch">

                    <ul class="navbar-nav ml-auto navbar-nav-right w-100"
                        style="display: flex;justify-content: flex-end;padding: 0rem 2.3rem 0rem 0rem;">
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
                            <li class="nav-item dropdown show">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre
                                    style="display: flex;align-items: center;">
                                    <p class="mb-0 d-none d-sm-block navbar-profile-name">{{ Auth::user()->name }}
                                    </p>
                                    <i class="fas fa-caret-down" style="margin-left: 0.7rem;"></i>
                                </a>


                                <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list"
                                    aria-labelledby="dropdownMenuLink">
                                    {{-- <div class="btn-group dropstart"> --}}

                                    <a class="nav-link dropdown-toggle  dropdown-item preview-item  sub" href="#"
                                        id="navbarDropdown2" role="button" data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">
                                        <div class="preview-thumbnail">
                                            <div class="preview-icon bg-dark rounded-circle ">
                                                <i class="fas fa-coins " style="color: #ffd600;"></i>
                                            </div>
                                        </div>
                                        <div class="preview-item-content ">
                                            <p class="preview-subject mb-1">Currency</p>
                                        </div>
                                    </a>


                                    <div id="sub_m"
                                        style="left: auto;margin: 0px;background-color: rgb(27, 52, 37);padding: 0px;text-align: center;"
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
                                                    <td class="currency_input">
                                                        <input type="text" style="display:none; ">
                                                    </td>
                                                </tr>
                                            </tbody>

                                        </table>
                                        <div style="display: flex; justify-content: flex-end; width: 100%; height: 50px;">
                                            <button type="submit" id="currency_submit" onclick='currency_submit()'
                                                style="letter-spacing: .7px;font-size: 12px;font-weight: 600;background-color: #bf8d45;border-color: #bf8d45;
                                                            display: flex;padding-inline: 13px;height: 65%;margin-top: 0px;margin-right: 2rem;" class="btn btn-success btn-s">
                                                Submit
                                            </button>
                                        </div>
                                    </div>
                                    {{-- </div> --}}

                                    <a class="dropdown-item preview-item"
                                        style="border-radius: 0px 0px 6px 6px;border-top: 2px solid #0e3c20;"
                                        href="{{ route('logout') }}"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                            class="d-none">
                                            {{ csrf_field() }}
                                        </form>
                                        <div class="preview-thumbnail">
                                            <div class="preview-icon bg-dark rounded-circle">
                                                <i class="fas fa-sign-out-alt" style="color: #fc424a;"></i>
                                            </div>
                                        </div>
                                        <div class="preview-item-content">
                                            <p class="preview-subject mb-1">Log out</p>
                                        </div>
                                    </a>
                                </div>
                            </li>
                        @endguest
                    </ul>

                </div>
            </nav>
            <div class="main-panel">
                <div class="content-wrapper">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>

</body>



<script>
    var action = 1;

    function myfunction() {

        if (action == 1) {
            $(".sidebar").addClass("sidebar_width");
            $(".nav").addClass("nav_hide");

            /*  resize */

            console.log('closed');

            action = 2;
        } else if (action === 2) {


            setTimeout(function() {

                $(".nav").removeClass("nav_hide");

            }, 200);

            $(".sidebar").removeClass("sidebar_width");

            console.log('opened');
            action = 1;
        }
    }
</script>



<script>
    var currency_data = new Object();
    var currency;
    var new_currency;
    var currency_tab;

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
        document.getElementById("navbarDropdown2").addEventListener("mouseenter", mouseEnter);
        document.getElementById("navbarDropdown2").addEventListener("mouseleave", mouseLeave);
        document.getElementById("sub_m").addEventListener("mouseenter", sub_mouseEnter);
        document.getElementById("sub_m").addEventListener("mouseleave", mouseLeave);

        function sub_mouseEnter() {
            $('.sub_m').show();
            clearTimeout(currency_tab);
        }
        function mouseEnter() {
            clearTimeout(currency_tab);

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

                        for (let i = 0; i < response[0].length; i++) {

                            html += '<tr class="country_row">';
                            html +=
                                ' <td class="country" style="font-size: 14px;padding: 0.5rem; width: 40%;"><span style="font-weight: 700;display: flex;align-items: center;justify-content: center;height: 35px;">' +
                                response[0][
                                    i
                                ].keyy +
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
                                '" onkeyup="change_currency(this)" style="color: white;border: solid;border-color: #cba369;border-radius: 4px;text-align: center;width: 80px; font-weight:bold;  background-color: transparent; outline-color:#dfdfdf; "> </td>';
                            html += '</tr>';

                        }

                        $('#country_table').html(html);

                    }
                });
            }, 500);
            $('.sub_m').show();
        }

        function mouseLeave() {
            currency_tab = setTimeout(function() {
                $('.sub_m').hide();
            }, 200);

        }
    });
</script>

</html>
