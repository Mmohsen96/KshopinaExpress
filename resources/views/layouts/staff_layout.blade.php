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
    <link rel="stylesheet" href="{{ asset('js/sweetalert2.min.css') }}">

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

</head>

<style>
    body {
        margin: 0;
        font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
        font-size: 1rem;
        font-weight: 400;
        line-height: 1.5;
        text-align: left;
        background-color: #ffffff;
    }

    .w-100 {
        width: 60% !important;
    }

    .navbar {
        background: #1B3425;
        left: 244px;
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
        width: 100%;
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
        margin-right: 1rem;
        white-space: nowrap;
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
        top: 48px;
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

    @media (max-width: 480px) {
        .navbar .navbar-brand-wrapper {
            width: 130px;
        }

        .navbar .navbar-brand-wrapper .brand-logo-mini {
            padding-top: 0px;
        }
    }


    /* Sidebar */
    .sidebar {

        min-height: calc(100vh - 0px);
        background: #1B3425;
        font-weight: normal;
        padding: 0;
        width: 244px;
        z-index: 11;
        transition: width 0.25s ease, background 0.25s ease;
    }

    .sidebar .sidebar-brand-wrapper {
        transition: width 0.25s ease, background 0.25s ease;
        background: #1B3425;
        width: 244px;
        height: 70px;
    }

    @media (max-width: 991px) {
        .sidebar .sidebar-brand-wrapper {
            width: 55px;
        }
    }

    .sidebar .sidebar-brand-wrapper .sidebar-brand {
        font-size: 1.5rem;
        line-height: 48px;
        margin-right: 0;
        padding: 0rem 0rem 0rem 2.3rem;
        width: 100%;
    }

    .sidebar .sidebar-brand-wrapper .sidebar-brand:active,
    .sidebar .sidebar-brand-wrapper .sidebar-brand:focus,
    .sidebar .sidebar-brand-wrapper .sidebar-brand:hover {
        color: #1B3425;
    }

    .sidebar .sidebar-brand-wrapper .sidebar-brand img {
        width: calc(244px - 135px);
        max-width: 100%;
        height: auto;
        margin: auto;
        vertical-align: middle;
    }

    .sidebar .sidebar-brand-wrapper .sidebar-brand.brand-logo-mini {
        display: none;
    }

    .sidebar .sidebar-brand-wrapper .sidebar-brand.brand-logo-mini img {
        width: calc(70px - 50px);
        max-width: 100%;
        height: 28px;
        margin: auto;
    }

    .sidebar .nav {
        position: fixed;
        flex-wrap: nowrap;
        height: 100%;
        overflow-y: scroll;
        overflow-x: hidden;
        flex-direction: column;
        margin-bottom: 60px;
        padding-top: 70px;
        width: 245px;
    }

    .sidebar .nav .nav-item {
        transition-duration: 0.25s;
        transition-property: background;
        padding-right: 20px;
    }

    .sidebar .nav .nav-item .collapse {
        z-index: 999;
    }

    .sidebar .nav .nav-item .nav-link {
        display: flex;
        -webkit-align-items: center;
        align-items: center;
        white-space: nowrap;
        padding: 0.8rem 18px 0.8rem 1.188rem;
        color: #bdb59f;
        transition-duration: 0.45s;
        transition-property: color;
        height: 46px;
        width: auto;
        border-radius: 0px 100px 100px 0px;
    }

    .sidebar .nav .nav-item .nav-link i {
        color: inherit;
    }

    .sidebar .nav .nav-item .nav-link i.menu-icon {
        font-size: 1rem;
        line-height: 1;
        margin-left: auto;
    }

    .sidebar .nav .nav-item .nav-link i.menu-icon:before {
        vertical-align: middle;
    }

    .sidebar .nav .nav-item .nav-link .menu-title {

        display: inline-block;
        font-size: 0.9375rem;
        line-height: 1;
        vertical-align: middle;
    }

    .sidebar .nav .nav-item .nav-link .badge {
        margin-right: auto;
        margin-left: 1rem;
    }

    .sidebar .nav .nav-item.active>.nav-link {
        position: relative;
    }

    .sidebar .nav .nav-item.active>.nav-link:before {
        content: "";
        width: 3px;
        height: 100%;
        background: #f8bb86;
        display: inline-block;
        position: absolute;
        left: 0;
        top: 0;
    }

    .sidebar .nav .nav-item.nav-profile .nav-link {
        height: auto;
        line-height: 1;
        border-top: 0;
        padding: 1.25rem 0;
    }

    .sidebar .nav .nav-item.nav-profile .nav-link .nav-profile-image {
        width: 44px;
        height: 44px;
    }

    .sidebar .nav .nav-item.nav-profile .nav-link .nav-profile-image img {
        width: 44px;
        height: 44px;
        border-radius: 100%;
    }

    .sidebar .nav .nav-item.nav-profile .nav-link .nav-profile-text {
        margin-left: 1rem;
    }

    .rtl .sidebar .nav .nav-item.nav-profile .nav-link .nav-profile-text {
        margin-left: auto;
        margin-right: 1rem;
    }

    .sidebar .nav .nav-item.nav-profile .nav-link .nav-profile-badge {
        font-size: 1.125rem;
        margin-left: auto;
    }

    .rtl .sidebar .nav .nav-item.nav-profile .nav-link .nav-profile-badge {
        margin-left: 0;
        margin-right: auto;
    }

    .sidebar .nav .nav-item.sidebar-actions {
        margin-top: 1rem;
    }

    .sidebar .nav .nav-item.sidebar-actions .nav-link {
        border-top: 0;
        display: block;
        height: auto;
    }

    .rtl .sidebar .nav .nav-item.profile {
        padding-right: 10px;
    }

    .sidebar .nav .nav-item.profile .profile-desc {
        display: flex;
        flex-direction: row;
        align-items: center;
        justify-content: space-between;
        padding: 1.2rem 1.17rem;
        line-height: 1.25;
    }

    .sidebar .nav .nav-item.profile .profile-desc .profile-name {
        margin-left: 0rem;
        font-size: 14px;
    }

    .rtl .sidebar .nav .nav-item.profile .profile-desc .profile-name {
        margin-left: 0;
        margin-right: 1rem;
    }

    .sidebar .nav .nav-item.profile .profile-desc .profile-name span {
        font-size: 10px;
        color: #CB9D48;
        white-space: nowrap;
    }

    .sidebar .nav .nav-item.profile .profile-desc .profile-name h5 {
        font-size: 18px;
        white-space: nowrap;

    }

    .sidebar .nav .nav-item.profile .profile-desc .dropdown-menu {
        padding: 0;
        margin-top: 1.25rem;
    }

    .sidebar .nav .nav-item.profile .profile-desc .dropdown-menu .dropdown-item {
        padding: 11px 13px;
    }

    .sidebar .nav .nav-item.profile .profile-desc .dropdown-menu .dropdown-item.preview-item {
        align-items: center;
    }

    .sidebar .nav .nav-item.profile .profile-desc .dropdown-menu .dropdown-item.preview-item .preview-thumbnail .preview-icon {
        width: 30px;
        height: 30px;
    }

    .sidebar .nav .nav-item.profile .profile-desc .dropdown-menu .dropdown-item.preview-item .preview-thumbnail .preview-icon i {
        font-size: 0.875rem;
    }

    .sidebar .nav .nav-item.profile .profile-desc .dropdown-menu .dropdown-item:hover {
        color: inherit;
    }

    .sidebar .nav .nav-item.profile .profile-desc .dropdown-menu .dropdown-divider {
        margin: 0;
    }


    .sidebar .nav .nav-item .menu-icon {
        margin-right: 0.5rem;
        font-size: 0.8125rem;
        line-height: 1;
        background: rgba(41, 110, 69, 0.2);
        width: 31px;
        height: 31px;
        border-radius: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #ffffff;
    }

    .sidebar .nav .nav-item .menu-icon i {
        font-size: 0.875rem;
    }

    .sidebar .nav.sub-menu {
        position: absolute;
        height: 9.8rem;
        margin-bottom: 0;
        margin-top: 0;
        padding: 0 0 0 3.25rem;
        list-style: none;
    }

    .sidebar .nav.sub-menu .nav-item {
        padding: 0;
    }

    .sidebar .nav.sub-menu .nav-item .nav-link {
        color: #bdb59f;
        padding: 0.5rem 0.2rem;
        position: relative;
        font-size: 0.855rem;
        line-height: 1;
        height: auto;
        border-top: 0;
    }

    .sidebar .nav.sub-menu .nav-item .nav-link.active {
        color: #ffffff;
        background: transparent;
    }

    .sidebar .nav.sub-menu .nav-item .nav-link:hover {
        color: #ffffff;
    }

    .sidebar .nav.sub-menu .nav-item:hover {
        background: transparent;
    }

    .sidebar .nav:not(.sub-menu)>.nav-item:hover:not(.nav-category):not(.account-dropdown)>.nav-link {
        background: #296E45;
        color: #f7f6f3;
    }

    .sidebar .nav .menu-items:nth-child(5n+1) .nav-link .menu-icon i {
        color: #0090e7;
    }

    .sidebar .nav .menu-items:nth-child(5n+2) .nav-link .menu-icon i {
        color: #00d25b;
    }

    .sidebar .nav .menu-items:nth-child(5n+3) .nav-link .menu-icon i {
        color: #ffab00;
    }

    .sidebar .nav .menu-items:nth-child(5n+4) .nav-link .menu-icon i {
        color: #fc424a;
    }

    .sidebar .nav .menu-items:nth-child(5n+5) .nav-link .menu-icon i {
        color: #fc424a;
    }

    /* style for off-canvas menu*/
    @media screen and (max-width: 991px) {
        .sidebar-offcanvas {
            position: fixed;
            max-height: calc(100vh - 70px);
            top: 70px;
            bottom: 0;
            overflow: auto;
            width: 250px;
            transition: all 0.25s ease-out;
        }

        .sidebar-offcanvas.active {
            right: 0;
        }

        .sidebar .nav {
            padding-top: 0rem !important;
        }
    }

    .sidebar-tinted .sidebar {
        background: #fa424a;
    }

    .sidebar-tinted .sidebar .sidebar-brand-wrapper {
        background: #fa424a;
    }

    /* Layouts */
    .navbar.fixed-top+.page-body-wrapper {
        padding-top: 70px;
    }

    @media (min-width: 992px) {
        .sidebar-icon-only .navbar {
            left: 70px;
        }

        .sidebar-icon-only .navbar .navbar-menu-wrapper {
            width: 100%;
        }

        .sidebar-icon-only .sidebar {
            width: 70px;
        }

        .sidebar-icon-only .sidebar .sidebar-brand-wrapper {
            width: 70px;
        }

        .sidebar-icon-only .sidebar .sidebar-brand-wrapper .brand-logo {
            display: none;
        }

        .sidebar-icon-only .sidebar .sidebar-brand-wrapper .brand-logo-mini {
            display: inline-block;
        }

        .sidebar-icon-only .sidebar .nav {
            overflow: visible;
        }

        .sidebar-icon-only .sidebar .nav .nav-item {
            position: relative;
            padding: 0;
        }

        .sidebar-icon-only .sidebar .nav .nav-item .profile-name {
            display: none;
        }

        .sidebar-icon-only .sidebar .nav .nav-item.account-dropdown {
            display: none;
        }

        .sidebar-icon-only .sidebar .nav .nav-item .nav-link {
            text-align: center;
        }

        .sidebar-icon-only .sidebar .nav .nav-item .nav-link .menu-title,
        .sidebar-icon-only .sidebar .nav .nav-item .nav-link .badge,
        .sidebar-icon-only .sidebar .nav .nav-item .nav-link .menu-sub-title {
            display: none;
        }

        .sidebar-icon-only .sidebar .nav .nav-item .nav-link .menu-title {
            border-radius: 0 5px 5px 0px;
        }

        .rtl.sidebar-icon-only .sidebar .nav .nav-item .nav-link .menu-title {
            border-radius: 5px 0 0 5px;
        }

        .sidebar-icon-only .sidebar .nav .nav-item .nav-link i.menu-icon {
            margin-right: 0;
            margin-left: 0;
        }

        .sidebar-icon-only .sidebar .nav .nav-item .nav-link i.menu-arrow {
            display: none;
        }

        .sidebar-icon-only .sidebar .nav .nav-item .nav-link[aria-expanded] .menu-title {
            border-radius: 0 5px 0 0px;
        }

        .rtl.sidebar-icon-only .sidebar .nav .nav-item .nav-link[aria-expanded] .menu-title {
            border-radius: 5px 0 0 0;
        }

        .sidebar-icon-only .sidebar .nav .nav-item.nav-profile {
            display: none;
        }

        .sidebar-icon-only .sidebar .nav .nav-item .collapse {
            display: none;
        }

        .sidebar-icon-only .sidebar .nav .nav-item.hover-open .nav-link .menu-title {
            display: -webkit-flex;
            display: flex;
            -webkit-align-items: center;
            align-items: center;
            background: #0f1015;
            padding: 0.5rem 1.4rem;
            left: 70px;
            position: absolute;
            text-align: left;
            top: 0;
            bottom: 0;
            width: 190px;
            z-index: 1;
            line-height: 1.8;
        }

        .sidebar-dark.sidebar-icon-only .sidebar .nav .nav-item.hover-open .nav-link .menu-title {
            background: #0f1015;
        }

        .rtl.sidebar-icon-only .sidebar .nav .nav-item.hover-open .nav-link .menu-title {
            left: auto;
            right: 70px;
            text-align: left;
        }

        .sidebar-icon-only .sidebar .nav .nav-item.hover-open .nav-link .menu-title:after {
            display: none;
        }

        .sidebar-icon-only .page-body-wrapper {
            width: calc(100% - 70px);
            transition: all 0.25s ease;
        }
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

    @media (max-width: 991px) {
        .main-panel {
            margin-left: 0;
            width: 100%;
        }
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

    .fa-bars {
        color: #CB9D48;
        font-size: 1.1rem;
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

    .side_selected {
        background: #0d1d11;
        color: #ffffff !important;
    }

  /*   aside{

    } */

</style>

<style>
        /* width */
    ::-webkit-scrollbar {
    width: 5px;
    }

    /* Track */
    ::-webkit-scrollbar-track {
    box-shadow: inset 0 0 5px grey;
    border-radius: 10px;
    }

    /* Handle */
    ::-webkit-scrollbar-thumb {
        background: #cb9d48;
        border-radius: 5px;
    }

    /* Handle on hover */
    ::-webkit-scrollbar-thumb:hover {
    background: #cb9d48;
    }
</style>

<style>
    .input-icons i {
        position: absolute;
    }

    .input-icons {
        width: 100%;
    }

    .icon {
        padding: 10px;
        min-width: 40px;
    }

    .input-field {
        width: 100%;
        padding: 10px;
        text-align: center;
    }

    .search_item:hover {
        text-decoration: none;
    }

</style>

<style>
    .navbar_toggled {
        left: 0px;

    }

    .navbar_wrapper_toggled {
        padding-right: 50px;
    }

    .sidebar_toggled {
        display: none;
    }

    .logo_wrapper_toggeled {
        width: calc(100% - 0px);
    }

    .nav_item_toggled {
        width: 80%;
    }

    .navbar_dropdown_toggled {
        right: 80px !important;
    }

    .selected_toggled {
        background-color: #1b3425;
    }

    .selected_coloring {
        transition: background-color 1s;
    }

    .nav_hide {

        width: 0px !important;
    }

    .sidebar_clicked {
        display: none;
    }

    .sidebar_width {
        width: 0px;
    }

    .sub_order {
        position: relative;
        padding: 0px 0px 4rem 0px;
    }

    .sub_space {
        padding: 0px 20px 4rem 0px;
    }

    .resize {
        padding-left: 244px;
    }

</style>

<style>
    #icon0 {
        color: #ac2b1f;
    }
    #icon1 {
        color: #ffab00;
    }
    
    #icon2 {
        color: #00a516;
    }

    #icon3 {
        color: #059ba8;
    }

    #icon4 {
        color: #0072ff;
    }

    #icon5 {
        color: #fc424a;
    }

    #icon6 {
        color: white;
    }
    #icon7 {
        color: #823ecd;
    }
    #icon8 {
        color: #08a22e;
    }
    #icon9 {
        color: #cd1c1c;
    }
    .sub_order_staff {
        position: relative;
        padding: 0px 0px 7.8rem 0px;
    }

    .sub_space_staff {
        padding: 0px 20px 9.8rem 0px;
    }

    .profile-image{
        background-color: antiquewhite;
        border-radius: 35%;
        margin-right: 10px;
    }
</style>

<style>
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

    .navbar-nav .dropdown-menu {
        position: absolute;
        right: 10.01rem;
        top: 0rem;
    }


</style>

<body>
    <div class="container-scroller">
        <aside style="background-color: #1b3425; height: auto;">
            <nav class="sidebar sidebar-offcanvas" id="sidebar">
                <div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top">
                    <a class="sidebar-brand brand-logo" href="/staff">
                        <img src="{{ asset('background-zete.png') }}" alt="logo" />
                    </a>
                    <a class="sidebar-brand brand-logo-mini" href="/staff">
                        <img src="{{ asset('background-zete.png') }}" alt="logo" />
                    </a>
                </div>
                <ul class="nav">

                    <li class="nav-item profile">
                        <div class="profile-desc">
                            <div class="profile-pic row" style="margin-left: 0px;margin-bottom:0px !important;">
                                <div class="profile-image" 
                                style="height: 40px;width: 40px; background-position: center;
                                @if (isset(Auth::user()->form_url) && !empty(Auth::user()->form_url))
                                background-size: cover;background-image:url({{ asset(Auth::user()->form_url) }}) 
                                @else
                                background-size: cover;background-image:url({{ asset('uploads/profiles/anonymous.jpg') }}) 
                                @endif ">
                            </div>
                            
                                <div class="profile-name">
                                    <h5 style="color: white;" class="mb-0 font-weight-normal">{{ Auth::user()->name }}</h5>
                                    <span>@if (isset(Auth::user()->title))
                                        {{Auth::user()->title}}
                                    @else
                                    Staff
                                    @endif </span>
                                </div>
                            </div>
                        </div>
                    </li>

                    @php
                        date_default_timezone_set('Africa/Cairo');
                        $now = date('Y-m', time());
                    @endphp
            
                    <hr style="margin-top: 0rem;border-top: 1px solid rgb(195 152 71 / 30%);width: 100%;margin-bottom: 2rem;">
                    <li class="@if (Route::current()->getName() == 'dashboard') active @endif nav-item menu-items" id="parent">
                        <a class="@if (Route::current()->getName() == 'dashboard') active side_selected @endif nav-link"
                            href=" /dashboard?date={{$now}}">
                            <span class="menu-icon">
                                <i class="fas fa-home" style="color: #ac2b1f;"></i>
                            </span>
                            <span class="menu-title">Dashboard</span>
                        </a>
                    </li>

                    <li class="@if (Route::current()->getName() == 'my_board') active @endif nav-item menu-items" id="parent">
                        <a class="@if (Route::current()->getName() == 'my_board') active side_selected @endif nav-link"
                            href=" /my_board">
                            <span class="menu-icon">
                                <i class="fas fa-chart-pie" style="color: #ffd600;"></i>
                            </span>
                            <span class="menu-title">Analytics</span>
                        </a>
                    </li>

                    <li class="@if (isset($page) && $page == 'verification') active @endif nav-item menu-items" id="creating_order">
                        <a class="@if (isset($page) && $page == 'verification') active side_selected @endif nav-link" id="sub"
                            data-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
                            <span class="menu-icon">
                                <i class="fas fa-user-check" id="icon2"></i>
                            </span>
                            <span class="menu-title">Verification</span>
                        </a>
                        <div class="collapse @if (isset($page) && $page == 'verification') show sub_space_staff @else sub_space_staff @endif " id="auth">
                            <ul class="nav flex-column sub-menu">
                                <li class="@if (isset($_GET['store']) && $_GET['store'] == 'origin' && isset($page) && $page == 'verification') active @endif  nav-item " id="sub_staff1"
                                    onclick="sub_subOrder_staff(this)">
                                    <a style="padding-left: 15px;"
                                        class="@if (isset($_GET['store']) && $_GET['store'] == 'origin' && isset($page) && $page == 'verification') active side_selected @endif nav-link"
                                        href="first_verification_confirmed?store=origin&filter=All&page=1">
                                        Original </a>
                                </li>
                                <li class="@if (isset($_GET['store']) && $_GET['store'] == 'plus_egypt' && isset($page) && $page == 'verification') active @endif nav-item" id="sub_staff2"
                                    onclick="sub_subOrder_staff(this)">
                                    <a style="padding-left: 15px;" class="@if (isset($_GET['store']) && $_GET['store'] == 'plus_egypt' && isset($page) && $page == 'verification') active side_selected @endif nav-link"
                                        href="first_verification_confirmed?store=plus_egypt&filter=All&page=1">Plus-Egypt</a>
                                </li>
                                <li class="@if (isset($_GET['store']) && $_GET['store'] == 'plus_kuwait' && isset($page) && $page == 'verification') active @endif nav-item" id="sub_staff3"
                                    onclick="sub_subOrder_staff(this)">
                                    <a style="padding-left: 15px;" class="@if (isset($_GET['store']) && $_GET['store'] == 'plus_kuwait' && isset($page) && $page == 'verification') active side_selected @endif nav-link"
                                        href="first_verification_confirmed?store=plus_kuwait&filter=All&page=1">Plus-Kuwait</a>
                                </li>
                                <li class="@if (isset($_GET['store']) && $_GET['store'] == 'plus_ksa' && isset($page) && $page == 'verification') active @endif nav-item" id="sub_staff4"
                                    onclick="sub_subOrder_staff(this)"> <a style="padding-left: 15px;"
                                        class="@if (isset($_GET['store']) && $_GET['store'] == 'plus_ksa' && isset($page) && $page == 'verification') active side_selected @endif nav-link"
                                        href="first_verification_confirmed?store=plus_ksa&filter=All&page=1">Plus-KSA</a>
                                </li>

                                <li class="@if (isset($_GET['store']) && $_GET['store'] == 'plus_uae' && isset($page) && $page == 'verification') active @endif nav-item" id="sub_staff5"
                                    onclick="sub_subOrder_staff(this)"> <a style="padding-left: 15px;"
                                        class="@if (isset($_GET['store']) && $_GET['store'] == 'plus_uae' && isset($page) && $page == 'verification') active side_selected @endif nav-link"
                                        href="first_verification_confirmed?store=plus_uae&filter=All&page=1">Plus-UAE</a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <li class="@if (isset($page) && $page == 'tst') active @endif nav-item menu-items" id="tst_order">
                        <a class="@if (isset($page) && $page == 'tst') active side_selected @endif nav-link" id="sub"
                            data-toggle="collapse" href="#tst" aria-expanded="false" aria-controls="tst">
                            <span class="menu-icon">
                                <i class="fas fa-table" id="icon4"></i>
                            </span>
                            <span class="menu-title">Total Sales Table</span>
                        </a>
                        <div class="collapse @if (isset($page) && $page == 'tst') show sub_space_staff @else sub_space_staff @endif " id="tst">
                            <ul class="nav flex-column sub-menu">
                                <li class="@if (isset($_GET['store']) && $_GET['store'] == 'origin' && isset($page) && $page == 'tst') active @endif  nav-item " id="sub_tst1"
                                    onclick="sub_subOrder_tst(this)">
                                    <a style="padding-left: 15px;"
                                        class="@if (isset($_GET['store']) && $_GET['store'] == 'origin' && isset($page) && $page == 'tst') active side_selected @endif nav-link"
                                        href=" /verified?store=origin&page=1&filter=All&category=all">
                                        Original </a>
                                </li>
                                <li class="@if (isset($_GET['store']) && $_GET['store'] == 'plus_egypt' && isset($page) && $page == 'tst') active @endif nav-item" id="sub_tst2"
                                    onclick="sub_subOrder_tst(this)">
                                    <a style="padding-left: 15px;" class="@if (isset($_GET['store']) && $_GET['store'] == 'plus_egypt' && isset($page) && $page == 'tst') active side_selected @endif nav-link"
                                     href="verified?store=plus_egypt&page=1&filter=All&category=all">Plus-Egypt</a>
                                </li>
                                <li class="@if (isset($_GET['store']) && $_GET['store'] == 'plus_kuwait' && isset($page) && $page == 'tst') active @endif nav-item" id="sub_tst3"
                                    onclick="sub_subOrder_tst(this)">
                                    <a style="padding-left: 15px;" class="@if (isset($_GET['store']) && $_GET['store'] == 'plus_kuwait' && isset($page) && $page == 'tst') active side_selected @endif nav-link"
                                     href="verified?store=plus_kuwait&page=1&filter=All&category=all">Plus-Kuwait</a>
                                </li>
                                <li class="@if (isset($_GET['store']) && $_GET['store'] == 'plus_ksa' && isset($page) && $page == 'tst') active @endif nav-item" id="sub_tst4"
                                    onclick="sub_subOrder_tst(this)"> <a style="padding-left: 15px;"
                                        class="@if (isset($_GET['store']) && $_GET['store'] == 'plus_ksa' && isset($page) && $page == 'tst') active side_selected @endif nav-link"
                                        href="verified?store=plus_ksa&page=1&filter=All&category=all">Plus-KSA</a>
                                </li>

                                <li class="@if (isset($_GET['store']) && $_GET['store'] == 'plus_uae' && isset($page) && $page == 'tst') active @endif nav-item" id="sub_tst5"
                                    onclick="sub_subOrder_tst(this)"> <a style="padding-left: 15px;"
                                        class="@if (isset($_GET['store']) && $_GET['store'] == 'plus_uae' && isset($page) && $page == 'tst') active side_selected @endif nav-link"
                                        href="verified?store=plus_uae&page=1&filter=All&category=all">Plus-UAE</a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <li class="@if (Route::current()->getName() == 'fct') active @endif nav-item menu-items" id="fct_order">
                        <a class="@if (Route::current()->getName() == 'fct') active side_selected @endif nav-link" id="sub"
                            data-toggle="collapse"  href="#fctt" aria-expanded="false" aria-controls="fctt">
                            <span class="menu-icon">
                                <i class="fas fa-tasks" id="icon5"></i>
                            </span>
                            <span class="menu-title">FCT</span>
                        </a>
                        <div class="collapse @if (isset($page) && $page == 'fct') show sub_space_staff @else sub_space_staff @endif " id="fctt">
                            <ul class="nav flex-column sub-menu">
                                <li class="@if (isset($_GET['store']) && $_GET['store'] == 'origin' && isset($page) && $page == 'fct') active @endif  nav-item " id="sub_tst1"
                                    onclick="sub_subOrder_fct(this)">
                                    <a style="padding-left: 15px;"
                                        class="@if (isset($_GET['store']) && $_GET['store'] == 'origin' && isset($page) && $page == 'fct') active side_selected @endif nav-link"
                                        href=" /fct?store=origin&page=1&filter=All">
                                        Original </a>
                                </li>
                                <li class="@if (isset($_GET['store']) && $_GET['store'] == 'plus_egypt' && isset($page) && $page == 'fct') active @endif nav-item" id="sub_tst2"
                                    onclick="sub_subOrder_fct(this)">
                                    <a style="padding-left: 15px;" class="@if (isset($_GET['store']) && $_GET['store'] == 'plus_egypt' && isset($page) && $page == 'fct') active side_selected @endif nav-link"
                                     href="fct?store=plus_egypt&page=1&filter=Egypt">Plus-Egypt</a>
                                </li>
                                <li class="@if (isset($_GET['store']) && $_GET['store'] == 'plus_kuwait' && isset($page) && $page == 'fct') active @endif nav-item" id="sub_tst3"
                                    onclick="sub_subOrder_fct(this)">
                                    <a style="padding-left: 15px;" class="@if (isset($_GET['store']) && $_GET['store'] == 'plus_kuwait' && isset($page) && $page == 'fct') active side_selected @endif nav-link"
                                     href="fct?store=plus_kuwait&page=1&filter=Kuwait">Plus-Kuwait</a>
                                </li>
                                <li class="@if (isset($_GET['store']) && $_GET['store'] == 'plus_ksa' && isset($page) && $page == 'fct') active @endif nav-item" id="sub_tst4"
                                    onclick="sub_subOrder_fct(this)"> <a style="padding-left: 15px;"
                                        class="@if (isset($_GET['store']) && $_GET['store'] == 'plus_ksa' && isset($page) && $page == 'fct') active side_selected @endif nav-link"
                                        href="fct?store=plus_ksa&page=1&filter=Saudi%20Arabia">Plus-KSA</a>
                                </li>
                                <li class="@if (isset($_GET['store']) && $_GET['store'] == 'plus_uae' && isset($page) && $page == 'fct') active @endif nav-item" id="sub_tst5"
                                    onclick="sub_subOrder_fct(this)"> <a style="padding-left: 15px;"
                                        class="@if (isset($_GET['store']) && $_GET['store'] == 'plus_uae' && isset($page) && $page == 'fct') active side_selected @endif nav-link"
                                        href="fct?store=plus_uae&page=1&filter=United%20Arab%20Emirates">Plus-UAE</a>
                                </li>
                                
                            </ul>
                        </div>
                    </li>

                    <li class="@if (isset($page) && $page == 'stock') active @endif nav-item menu-items" id="stock_management">
                        <a class="@if (isset($page) && $page == 'stock') active side_selected @endif nav-link" id="sub"
                            data-toggle="collapse" href="#stock" aria-expanded="false" aria-controls="stock">
                            <span class="menu-icon">
                                <i class="fas fa-boxes" id="icon6"></i>
                            </span>
                            <span class="menu-title">Stock Management</span>
                        </a>
                        <div class="collapse @if (isset($page) && $page == 'stock') show sub_space_staff @else sub_space_staff @endif " id="stock" style="padding: 0px 20px 14.8rem 0px;">
                            <ul class="nav flex-column sub-menu" style="height: 14.8rem;">
                                
                                <li class="@if (isset($_GET['store']) && $_GET['store'] == 'plus_egypt' && isset($page) && $page == 'stock') active @endif nav-item" id="sub_stock2"
                                    onclick="sub_subOrder_staff(this)">
                                    <a style="padding-left: 15px;" class="@if (isset($_GET['store']) && $_GET['store'] == 'plus_egypt' && isset($page) && $page == 'stock') active side_selected @endif nav-link"
                                        href="/products?page=1&filter=All&store=plus_egypt">Plus-Egypt</a>
                                </li>
                                <li class="@if (isset($_GET['store']) && $_GET['store'] == 'plus_kuwait' && isset($page) && $page == 'stock') active @endif nav-item" id="sub_stock3"
                                    onclick="sub_subOrder_staff(this)">
                                    <a style="padding-left: 15px;" class="@if (isset($_GET['store']) && $_GET['store'] == 'plus_kuwait' && isset($page) && $page == 'stock') active side_selected @endif nav-link"
                                        href="/products?page=1&filter=All&store=plus_kuwait">Plus-Kuwait</a>
                                </li>
                                <li class="@if (isset($_GET['store']) && $_GET['store'] == 'plus_ksa' && isset($page) && $page == 'stock') active @endif nav-item" id="sub_stock4"
                                    onclick="sub_subOrder_staff(this)"> <a style="padding-left: 15px;"
                                        class="@if (isset($_GET['store']) && $_GET['store'] == 'plus_ksa' && isset($page) && $page == 'stock') active side_selected @endif nav-link"
                                        href="/products?page=1&filter=All&store=plus_ksa">Plus-KSA</a>
                                </li>
                                <li class="@if (isset($_GET['store']) && $_GET['store'] == 'plus_uae' && isset($page) && $page == 'stock') active @endif nav-item" id="sub_stock5"
                                onclick="sub_subOrder_staff(this)"> <a style="padding-left: 15px;"
                                    class="@if (isset($_GET['store']) && $_GET['store'] == 'plus_uae' && isset($page) && $page == 'stock') active side_selected @endif nav-link"
                                    href="/products?page=1&filter=All&store=plus_uae">Plus_UAE</a>
                            </li>
                            <li class="@if (isset($_GET['store']) && $_GET['store'] == 'oman' && isset($page) && $page == 'stock') active @endif nav-item" id="sub_stock6"
                                    onclick="sub_subOrder_staff(this)"> <a style="padding-left: 15px;"
                                        class="@if (isset($_GET['store']) && $_GET['store'] == 'oman' && isset($page) && $page == 'stock') active side_selected @endif nav-link"
                                        href="/products?page=1&filter=All&store=oman">Oman</a>
                                </li>
                                <li class="@if (isset($_GET['store']) && $_GET['store'] == 'jordan' && isset($page) && $page == 'stock') active @endif nav-item" id="sub_stock7"
                                    onclick="sub_subOrder_staff(this)"> <a style="padding-left: 15px;"
                                        class="@if (isset($_GET['store']) && $_GET['store'] == 'jordan' && isset($page) && $page == 'stock') active side_selected @endif nav-link"
                                        href="/products?page=1&filter=All&store=jordan">Jordan</a>
                                </li>
                                <li class="@if (isset($_GET['store']) && $_GET['store'] == 'bahrain' && isset($page) && $page == 'stock') active @endif nav-item" id="sub_stock8"
                                    onclick="sub_subOrder_staff(this)"> <a style="padding-left: 15px;"
                                        class="@if (isset($_GET['store']) && $_GET['store'] == 'bahrain' && isset($page) && $page == 'stock') active side_selected @endif nav-link"
                                        href="/products?page=1&filter=All&store=bahrain">Bahrain</a>
                                </li>
                                <li class="@if (isset($_GET['store']) && $_GET['store'] == 'qatar' && isset($page) && $page == 'stock') active @endif nav-item" id="sub_stock9"
                                    onclick="sub_subOrder_staff(this)"> <a style="padding-left: 15px;"
                                        class="@if (isset($_GET['store']) && $_GET['store'] == 'qatar' && isset($page) && $page == 'stock') active side_selected @endif nav-link"
                                        href="/products?page=1&filter=All&store=qatar">Qatar</a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <li class="@if (isset($page) && $page == 'complaints') active @endif nav-item menu-items" id="parent">
                        <a class="@if (isset($page) && $page == 'complaints') side_selected @endif nav-link"
                            href="/complains_orders?page=1&filter=All">
                            <span class="menu-icon">
                                <i class="fas fa-exclamation" id="icon1"></i>
                            </span>
                            <span class="menu-title">Complaints</span>
                        </a>
                    </li>


                    <li class="@if (isset($page) && $page == 'group_orders') active @endif nav-item menu-items" id="parent">
                        <a class="@if (isset($page) && $page == 'group_orders') side_selected @endif nav-link"
                            href=" /group_orders?page=1&filter=All">
                            <span class="menu-icon">
                                <i class="fas fa-users" id="icon8"></i>
                            </span>
                            <span class="menu-title">Group Orders</span>
                        </a>
                    </li>
                    @if (Auth::user()->id ==8 || Auth::user()->id == 1)
                        <li class="@if (isset($page) && $page == 'performance') active @endif nav-item menu-items" id="parent" style="margin-bottom: 2rem;">
                            <a class="@if (isset($page) && $page == 'performance') side_selected @endif nav-link"
                                href=" /performance">
                                <span class="menu-icon">
                                    <i class="fas fa-tachometer-alt" id="icon9"></i>
                                </span>
                                <span class="menu-title">Performance</span>
                            </a>
                        </li>
                    @endif
                    
                </ul>
            </nav>
        </aside>
        <div class="container-fluid page-body-wrapper ">
            <nav class="navbar p-0 fixed-top d-flex flex-row">
                <div class="navbar-brand-wrapper d-flex d-lg-none align-items-center justify-content-center">
                    <a class="navbar-brand brand-logo-mini" href="index.html">
                        <img src="{{ asset('background-zete.png') }}" alt="logo" />
                    </a>
                </div>
                <div class="navbar-menu-wrapper flex-grow d-flex align-items-stretch">
                    <button class="navbar-toggler navbar-toggler align-self-center" type="button"
                        onclick="myfunction(this)">
                        <span class="mdi mdi-menu"><i class="fas fa-bars"></i></span>
                    </button>
                 
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
                                        <table class="table currency_table" style="background-color: rgb(27, 52, 37);">
                                            <thead>
                                                <tr style="background-color: #1b3425;">
                                                    <th style="color: #cba369;  width: 35%;border-bottom: 1px solid #0e3c20;" scope="col">Currency </th>
                                                    <th style="color: #cba369;border-bottom: 1px solid #0e3c20; " scope="col">Current</th>
                                                    <th style="color: #cba369; border-bottom: 1px solid #0e3c20;" scope="col">Suggested</th>
                                                    <th style="color: #cba369;border-bottom: 1px solid #0e3c20; " scope="col">inputs </th>

                                                </tr>
                                            </thead>
                                            <tbody id="country_table" style="color: white; background-color: #1b3425;">
                                                <tr id="country_row"  >
                                                    <td class="country" style="border-top: 1px solid #0e3c20;background-color: #1b3425;"></td>
                                                    <td class="suggested_currency" style="border-top: 1px solid #0e3c20;background-color: #1b3425;"></td>
                                                    <td class="currency_input" style="border-top: 1px solid #0e3c20;background-color: #1b3425;">
                                                        <input type="text" style="display:none; " >
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

                    <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
                        data-toggle="offcanvas">
                        <span class="mdi mdi-format-line-spacing"></span>
                    </button>
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
    function search_shipment(elemant) {

        var value = (elemant.value);
        var html1 = "";
        var counter = 0;
        var url = "";
        var Controller_url = "";
        var name = "";
        var country = "";
        var user = $('#user').val();
        var user_type = $('#user_type').val();
        if ((value.replace(/\s/g, "")).length > 3) {

            try {
                ajaxx.abort();
            } catch (error) {

            }
            setTimeout(function() {

                ajaxx = $.ajax({
                    url: "search_shipment",
                    type: "post",
                    dataType: 'json',
                    data: {
                        _token: "{{ csrf_token() }}",
                        content: value,
                        user: user,
                        user_type: user_type
                        /*  filter: search_filter */
                    },
                    success: function(response) {
                        console.log(response);
                        response.forEach(shipment => {



                            if (user_type == 1) {
                                Controller_url = 'shippment_list';
                                name = shipment['customer_name'];
                                country = shipment['country_name'];

                            } else if (user_type == 0) {
                                Controller_url = 'shipments_managment';
                                name = shipment['name'];
                                country = shipment['country_name'];
                                //staff
                            }


                            counter++;

                            html1 += '<a href="' + Controller_url + '?ksp_number=' +
                                shipment[
                                    'ksp_number'] +
                                ' "  target="blank" class="search_item" > ';

                            html1 += '<div class="search-result row">';

                            html1 +=
                                '                        <div  style="width: 100%;margin-left: 10px;" class="column">';
                            html1 +=
                                '                            <div  style="letter-spacing: 0.5px;color: #b3883e;font-weight: 600;font-size: 16px;"> <i class="fas fa-hashtag"></i> ' +
                                shipment['ksp_number'] + '</div>';
                            html1 +=
                                '                            <div class="row" style="width: 100%;justify-content: space-between;padding-inline: 20px;margin: 6px 1px 0px 0px ;color: #918f8f;font-size: 13px;">';


                            html1 +=
                                '                                <div  style="font-size: 13px;color: white; "><i style="font-size: 13px;" class="fas fa-user-alt"></i>  ' +
                                name + '</div>';
                            html1 +=
                                '                                <div style="font-size: 13px;"><i style="font-size: 13px;" class="fas fa-flag"></i>  ' +
                                country + '</div>';
                            html1 += '                            </div>';
                            html1 += '                        </div>';
                            html1 += '                    </div> </a>';

                            if (counter != response.length) {
                                html1 +=
                                    '                    <hr style="background-color: #5e5e5e;" class="product">';
                            }


                        });
                        $("#results").html("");
                        $("#results").html(html1);

                        if (response.length > 0) {
                            $("#results").show();
                        } else {
                            $("#results").hide();
                        }


                    },
                    error: function(xhr) {
                        //Do Something to handle error
                    }

                });
            }, 500);
        } else {
            $("#results").hide();
        }

        $(document).click(function() {
            $("#results").hide();
        });


    }
</script>

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
    var side_action_staff = 1;
    var sub_action_staff = 1;

    var sub_action_tst=1;
    var sub_action_fct=1;


    function subOrder_staff(element) {
        if (!($('#sub_staff1').hasClass('active') || $('#sub_staff2').hasClass('active')  || $('#sub_staff3').hasClass('active') || $('#sub_staff4').hasClass('active'))) {
            if (side_action_staff == 1) {
                $('#creating_order').addClass("sub_order_staff");

                console.log('opened');
                side_action_staff = 2;
            } else if (side_action_staff == 2) {

                setTimeout(function() {
                    $("#creating_order").removeClass("sub_order_staff");
                }, 400);

                console.log('closed');
                side_action_staff = 1;
            }
        }
    }


    function sub_subOrder_staff(element1) {

        if (sub_action_staff == 1) {
            setTimeout(function() {
                $("#creating_order").removeClass("sub_space_staff");
            }, 400);
            sub_action_staff = 2;
            console.log( sub_action_staff);
                console.log('sub_sub_closed');


        } else if (sub_action_staff === 2) {
            sub_action_staff = 1;
            console.log( sub_action_staff);
                console.log('sub_sub_opened');


        }
    }

    function sub_subOrder_tst(element) {

        if (sub_action_tst == 1) {
            setTimeout(function() {
                $("#tst_order").removeClass("sub_space_staff");
            }, 400);
            sub_action_tst = 2;
            console.log( sub_action_tst);
                console.log('sub_sub_closed');


        } else if (sub_action_tst === 2) {
            sub_action_tst = 1;
            console.log( sub_action_tst);
                console.log('sub_sub_opened');
        }
    }

    function sub_subOrder_fct(element) {

        if (sub_action_fct == 1) {
            setTimeout(function() {
                $("#fct_order").removeClass("sub_space_staff");
            }, 400);
            sub_action_fct = 2;
            console.log( sub_action_fct);
                console.log('sub_sub_closed');


        } else if (sub_action_fct === 2) {
            sub_action_fct = 1;
            console.log( sub_action_fct);
                console.log('sub_sub_opened');
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

                            html += '<tr class="country_row"  style="background-color: #1b3425; ">';
                            html +=
                                ' <td class="country" style="border-top: 1px solid #0e3c20;font-size: 14px;padding: 0.5rem; width: 40%;"><span style="font-weight: 700;display: flex;align-items: center;justify-content: center;height: 35px;">' +
                                response[0][
                                    i
                                ].keyy +
                                ' </span>   </td>';
                            html +=
                                '<td class="current_currency" style="border-top: 1px solid #0e3c20;font-size: 14px;padding: 0.5rem;"><span style="display: flex;align-items: center;justify-content: center;height: 35px;"> ' +
                                response[0][i].value + '</span> </td>';

                            html +=
                                '<td class="suggested_currency" style="border-top: 1px solid #0e3c20;font-size: 14px;padding: 0.5rem;"><span style="display: flex;align-items: center;justify-content: center;height: 35px;"> ' +
                                response[0][i].type + '</span> </td>';
                            html +=
                                ' <td class="currency_input" style="border-top: 1px solid #0e3c20;"> <input autocomplete="off" type="text" name ="new_currency_value" id="currency_' +
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
