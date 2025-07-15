@extends('layouts.app')

@section('content')
<script src="{{ asset('js/sweetalert2.min.js') }}"></script>
<link rel="stylesheet" href="{{ asset('js/sweetalert2.min.css') }}">

    <style>
        .loader {
            border: 4px solid #f3f3f3;
            border-radius: 50%;
            border-top: 4px solid #cda051;
            width: 30px;
            height: 30px;
            -webkit-animation: spin 2s linear infinite;
            animation: spin 2s linear infinite;
        }

        /* Safari */
        @-webkit-keyframes spin {
            0% {
                -webkit-transform: rotate(0deg);
            }

            100% {
                -webkit-transform: rotate(360deg);
            }
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }


        body {
            background-color: #f7f6f3;

        }

        .table {
            border-collapse: collapse;
            width: 100%;
            border-radius: 0px 0px 15px 15px;
            overflow: hidden;
            border-top: hidden;
        }

        .td,
        .th {
            border: 1px solid #c6c6c6;
            text-align: left;
            padding: 8px;
            text-align: center;
            border: none;

        }

        .th {
            color: white;

        }

        tr {
            background-color: #f9f9f9;
        }

        .td {
            padding: 0.87rem !important;
        }

        .pagination {
            display: inline-block;
        }

        .pagination a {
            color: black;
            float: left;
            padding: 8px 16px;
            text-decoration: none;
        }

        .pagination a.active {
            background-color: #ca9b49;
            color: white;
            border-radius: 5px;
        }

        .pagination a:hover:not(.active) {
            background-color: rgb(116, 112, 112);
            border-radius: 5px;
        }

        .dot {
            margin-right: 5px;
            height: 28px;
            width: 28px;
            border-radius: 50%;
            display: inline-block;
            display: inline-flex;
            justify-content: center;
            align-items: center;
            background-color: #000000;
            font-size: 14px;
            color: white;
        }

        .overlay {
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
            background: rgba(0, 0, 0, 0.7);
            transition: opacity 500ms;
            display: none;
        }

        .overlay:target {
            visibility: visible;
            opacity: 1;
        }

        .popup {
            margin: 70px auto;
            padding: 20px;
            background: #fff;
            border-radius: 5px;
            width: 35%;
            position: relative;
            transition: all 5s ease-in-out;
            height: 85%;
            overflow: auto;
        }

        .popup h2 {
            margin-top: 0;
            color: #ca9b49;
            font-family: Tahoma, Arial, sans-serif;
        }

        .popup .close {
            position: absolute;
            top: 20px;
            right: 30px;
            transition: all 200ms;
            font-size: 30px;

            text-decoration: none;
            color: #333;
        }

        .popup .close:hover {
            color: #ca9b49;
        }

        /* .popup .content {
                                                                                                        max-height: 45%;
                                                                                                        overflow: auto;
                                                                                                    } */

        @media screen and (max-width: 700px) {
            .box {
                width: 70%;
            }

            .popup {
                width: 70%;
            }
        }


        #myInput {
            border-radius: 5px;
            font-size: 16px;
            padding: 9px 0px 9px 40px;
            border: 1px solid #ddd;
            margin-bottom: 12px;
        }

        #filters {
            flex: 80;
            margin-top: 15px;
        }

        #filters button {
            color: white;
            cursor: pointer;
            border: 1px solid #dfdfdf;
            padding: 0px 1% 0px 1%;
            height: 44px;
            align-items: center;
            display: flex;
            justify-content: center;
            background-color: transparent;

        }

        #filters button:hover {
            background: #90909040 !important;
        }

        .selected {
            color: #f5c573 !important;
            background: #90909040 !important;
        }

        .checked {
            text-decoration-line: line-through;
        }



        .stati {
            align-items: center;
            background: #fff;
            height: 6em;
            /*             padding: 1em;
                                                                                    */
            margin: 1em 0;
            -webkit-transition: margin 0.5s ease, box-shadow 0.5s ease;
            /* Safari */
            transition: margin 0.5s ease, box-shadow 0.5s ease;
            -moz-box-shadow: 0px 0.2em 0.4em rgb(0, 0, 0, 0.8);
            -webkit-box-shadow: 0px 0.2em 0.4em rgb(0, 0, 0, 0.8);
            box-shadow: 0px 0.2em 0.4em rgb(0, 0, 0, 0.8);
        }

        .stati:hover {
            margin-top: 0.5em;
            -moz-box-shadow: 0px 0.4em 0.5em rgb(0, 0, 0, 0.8);
            -webkit-box-shadow: 0px 0.4em 0.5em rgb(0, 0, 0, 0.8);
            box-shadow: 0px 0.4em 0.5em rgb(0, 0, 0, 0.8);
        }


        .stati i {
            font-size: 3.5em;
        }

        .stati div {
            width: 50%;
            display: block;
            float: right;
            text-align: right;
        }

        .stati div b {
            font-size: 2.2em;
            width: 100%;
            padding-top: 0px;
            margin-top: -0.2em;
            margin-bottom: -0.2em;
            display: block;
        }

        .stati div span {
            font-size: 1em;
            width: 100%;
            color: rgb(0, 0, 0, 0.8);
             !important;
            display: block;
        }

        .stati.left div {
            float: left;
            text-align: left;
        }

        .stati.bg-turquoise {
            background: rgb(204 163 81);
            color: white;
        }

    </style>
    <style>
        /* @extend display-flex; */
        display-flex,
        .form-flex,
        .form-row,
        .add-info-link {
            display: flex;
            display: -webkit-flex;
        }

        /* @extend list-type-ulli; */
        list-type-ulli,
        ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
        }

        /* Montserrat-300 - latin */
        @font-face {
            font-family: 'Montserrat';
            font-style: normal;

            src: url("../fonts/montserrat/Montserrat-Light.ttf");
            /* IE9 Compat Modes */
        }

        @font-face {
            font-family: 'Montserrat';
            font-style: normal;

            src: url("../fonts/montserrat/Montserrat-Regular.ttf");
            /* IE9 Compat Modes */
        }

        @font-face {
            font-family: 'Montserrat';
            font-style: italic;

            src: url("../fonts/montserrat/Montserrat-Italic.ttf");
            /* IE9 Compat Modes */
        }

        @font-face {
            font-family: 'Montserrat';
            font-style: normal;

            src: url("../fonts/montserrat/Montserrat-Medium.ttf");
            /* IE9 Compat Modes */
        }

        @font-face {
            font-family: 'Montserrat';
            font-style: normal;

            src: url("../fonts/montserrat/Montserrat-SemiBold.ttf");
            /* IE9 Compat Modes */
        }

        @font-face {
            font-family: 'Montserrat';
            font-style: normal;

            src: url("../fonts/montserrat/Montserrat-Bold.ttf");
            /* IE9 Compat Modes */
        }

        @font-face {
            font-family: 'Montserrat';
            font-style: italic;

            src: url("../fonts/montserrat/Montserrat-BoldItalic.ttf");
            /* IE9 Compat Modes */
        }

        @font-face {
            font-family: 'Montserrat';
            font-style: italic;

            src: url("../fonts/montserrat/montserrat-v12-latin-900.ttf"), url("../fonts/montserrat/montserrat-v12-latin-900.eot") format("embedded-opentype"), url("../fonts/montserrat/montserrat-v12-latin-900.svg") format("woff2"), url("../fonts/montserrat/montserrat-v12-latin-900.woff") format("woff"), url("../fonts/montserrat/montserrat-v12-latin-900.woff2") format("truetype");
        }

        a:focus,
        a:active {
            text-decoration: none;
            outline: none;
            transition: all 300ms ease 0s;
            -moz-transition: all 300ms ease 0s;
            -webkit-transition: all 300ms ease 0s;
            -o-transition: all 300ms ease 0s;
            -ms-transition: all 300ms ease 0s;
        }

        input,
        select,
        textarea {
            outline: none;
            appearance: unset !important;
            -moz-appearance: unset !important;
            -webkit-appearance: unset !important;
            -o-appearance: unset !important;
            -ms-appearance: unset !important;
        }

        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            appearance: none !important;
            -moz-appearance: none !important;
            -webkit-appearance: none !important;
            -o-appearance: none !important;
            -ms-appearance: none !important;
            margin: 0;
        }

        input:focus,
        select:focus,
        textarea:focus {
            outline: none;
            box-shadow: none !important;
            -moz-box-shadow: none !important;
            -webkit-box-shadow: none !important;
            -o-box-shadow: none !important;
            -ms-box-shadow: none !important;
        }

        input[type=checkbox] {
            appearance: checkbox !important;
            -moz-appearance: checkbox !important;
            -webkit-appearance: checkbox !important;
            -o-appearance: checkbox !important;
            -ms-appearance: checkbox !important;
        }

        input[type=radio] {
            appearance: radio !important;
            -moz-appearance: radio !important;
            -webkit-appearance: radio !important;
            -o-appearance: radio !important;
            -ms-appearance: radio !important;
        }

        input[type=number] {
            -moz-appearance: textfield !important;
            appearance: none !important;
            -webkit-appearance: none !important;
        }

        input:-webkit-autofill {
            box-shadow: 0 0 0 30px transparent inset;
            -moz-box-shadow: 0 0 0 30px transparent inset;
            -webkit-box-shadow: 0 0 0 30px transparent inset;
            -o-box-shadow: 0 0 0 30px transparent inset;
            -ms-box-shadow: 0 0 0 30px transparent inset;
        }

        img {
            max-width: 100%;
            height: auto;
        }

        figure {
            margin: 0;
        }

        p {
            margin-bottom: 0px;
            font-size: 15px;
            color: #777;
        }

        h2 {
            line-height: 1.66;
            margin: 0;
            padding: 0;

            color: #222;
            font-family: 'Montserrat';
            font-size: 24px;
            text-transform: uppercase;
            text-align: center;
            margin-bottom: 40px;
        }

        .clear {
            clear: both;
        }


        .signup-content {
            padding: 10px 0;
        }

        .signup-form {
            padding: 8px 50px 0px 50px;
            height: auto;
            overflow-y: auto;
        }

        .signup-form::-webkit-scrollbar-track {
            border-radius: 5px;
            -moz-border-radius: 5px;
            -webkit-border-radius: 5px;
            -o-border-radius: 5px;
            -ms-border-radius: 5px;
            background-color: #f8f8f8;
            width: 10px;
        }

        .signup-form::-webkit-scrollbar {
            border-radius: 5px;
            -moz-border-radius: 5px;
            -webkit-border-radius: 5px;
            -o-border-radius: 5px;
            -ms-border-radius: 5px;
            width: 10px;
            background-color: #fff;
        }

        .signup-form::-webkit-scrollbar-thumb {
            border-radius: 5px;
            -moz-border-radius: 5px;
            -webkit-border-radius: 5px;
            -o-border-radius: 5px;
            -ms-border-radius: 5px;
            background-color: #ebebeb;
        }

        label,
        input {
            width: 90%;
        }


        input {
            border: 1px solid #ebebeb;
            border-radius: 5px;
            -moz-border-radius: 5px;
            -webkit-border-radius: 5px;
            -o-border-radius: 5px;
            -ms-border-radius: 5px;
            box-sizing: border-box;
            padding: 10px 10px;
            font-size: 14px;

            font-family: 'Montserrat';
        }

        input:focus {
            border: 1px solid #907239;
        }

        input::-webkit-input-placeholder {
            color: #999;
            text-transform: uppercase;

        }

        input::-moz-placeholder {
            color: #999;
            text-transform: uppercase;

        }

        input:-ms-input-placeholder {
            color: #999;
            text-transform: uppercase;

        }

        input:-moz-placeholder {
            color: #999;
            text-transform: uppercase;

        }

        .form-radio {
            margin-bottom: 40px;
        }

        .form-radio input {
            width: 0;
            height: 0;
            position: absolute;
            left: -9999px;
        }

        .form-radio input+label {
            margin: 0px;
            padding: 12px 10px;
            width: 94px;
            height: 50px;
            box-sizing: border-box;
            position: relative;
            display: inline-block;
            text-align: center;
            border: 1px solid #ebebeb;
            background-color: #FFF;
            font-size: 14px;

            color: #888;
            text-align: center;
            text-transform: none;
            transition: border-color .15s ease-out, color .25s ease-out, background-color .15s ease-out, box-shadow .15s ease-out;
            border-radius: 5px;
            -moz-border-radius: 5px;
            -webkit-border-radius: 5px;
            -o-border-radius: 5px;
            -ms-border-radius: 5px;
        }

        .form-radio input:checked+label {
            background-color: #907239;
            color: #FFF;
            border-color: #907239;
            z-index: 1;
        }

        .form-radio input:focus+label {
            outline: none;
        }

        .form-radio input:hover {
            background-color: #907239;
            color: #FFF;
            border-color: #907239;
        }

        .form-flex input+label:first-of-type {
            border-radius: 5px 0 0 5px;
            -moz-border-radius: 5px 0 0 5px;
            -webkit-border-radius: 5px 0 0 5px;
            -o-border-radius: 5px 0 0 5px;
            -ms-border-radius: 5px 0 0 5px;
            border-right: none;
        }

        .form-flex input+label:last-of-type {
            border-radius: 0 5px 5px 0;
            -moz-border-radius: 0 5px 5px 0;
            -webkit-border-radius: 0 5px 5px 0;
            -o-border-radius: 0 5px 5px 0;
            -ms-border-radius: 0 5px 5px 0;
            border-left: none;
        }

        .form-row {
            margin: 0 0px;
        }

        .form-row .form-group,
        .form-row .form-radio {
            width: 20rem;
            padding: 0 22px;
        }

        .form-group,
        .form-radio {
            margin-bottom: 18px;
            position: relative;
        }

        .form-icon {
            position: relative;
        }

        .ui-datepicker-trigger {
            position: absolute;
            right: 25px;
            top: 41px;
            color: #999;
            font-size: 18px;
            background: transparent;
            border: none;
            outline: none;
            cursor: pointer;
        }

        .add-info-link {
            text-decoration: none;
            text-transform: uppercase;

            margin-bottom: 16px;
            align-items: center;
            -moz-align-items: center;
            -webkit-align-items: center;
            -o-align-items: center;
            -ms-align-items: center;
        }

        .add-info-link .zmdi {
            font-size: 18px;
            padding-right: 14px;
        }

        .add_info {
            display: none;
        }

        ul {
            background: 0 0;
            position: relative;
            z-index: 9;
        }

        ul li {
            padding: 5px 0px;
            z-index: 2;
            color: #222;
            font-size: 14px;

        }

        /* ul li:not(.init) {
                display: none;
                background: #fff;
                color: #222;
                padding: 5px 10px;
            } */

        /* ul li:not(.init):hover,
            ul li.selected:not(.init) {
                background: #1da0f2;
                color: #fff;
            } */

        li.init {
            cursor: pointer;
            position: relative;
            border: 1px solid #ebebeb;
            padding: 12px 20px;
            border-radius: 5px;
            -moz-border-radius: 5px;
            -webkit-border-radius: 5px;
            -o-border-radius: 5px;
            -ms-border-radius: 5px;
        }

        li.init:after {
            position: absolute;
            right: 20px;
            top: 50%;
            transform: translateY(-50%);
            -moz-transform: translateY(-50%);
            -webkit-transform: translateY(-50%);
            -o-transform: translateY(-50%);
            -ms-transform: translateY(-50%);
            font-size: 18px;
            color: #999;
            font-family: 'Material-Design-Iconic-Font';
            content: '\f2f9';

        }

        .form-submit {
            width: auto;
            background: #1da0f2;
            color: #fff;
            text-transform: uppercase;

            padding: 16px 50px;
            float: right;
            border: none;
            margin-top: 37px;
            cursor: pointer;
        }

        .form-submit:hover {
            background: #0c85d0;
        }

        label.error {
            display: block;
            position: absolute;
            top: 0px;
            right: 0;
        }

        label.error:after {
            font-family: 'Material-Design-Iconic-Font';
            position: absolute;
            content: '\f135';
            right: 31px;
            top: 40px;
            font-size: 13px;
            color: #c70000;
        }

        input.error {
            border: 1px solid #c70000;
        }

        .select-list {
            position: relative;
            display: inline-block;
            width: 100%;
            margin-bottom: 47px;
        }

        .list-item {
            position: absolute;
            width: 100%;
        }

        #country {
            z-index: 99;
        }

        #city {
            z-index: 9;
        }


        label {
            color: #f7f6f3;
            font-family: Segoe, Tahoma, Geneva, Verdana, sans-serif;
            font-size: 14px;
            margin-bottom: 3px;
        }

        @media screen and (max-width: 768px) {
            .container {
                width: calc(100% - 30px);
                max-width: 100%;
            }
        }

    </style>
    <style>
        input:disabled {
            background: #d4d4d4;
        }

    </style>
    {{-- {{$_GET['id']}} --}}
    <div class="container">
        @if ($message = Session::get('message'))
            <script>
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Order has been added successfully',
                    showConfirmButton: false,
                    timer: 1500
                });
            </script>

        @elseif ($message = Session::get('error'))
            <script>
                Swal.fire({
                    position: 'center',
                    icon: 'error',
                    title: 'Something wrong happen try again later!',
                    showConfirmButton: false,
                    timer: 1500
                });
            </script>
        @endif

        <div style="margin-top: 10px;">
            <div style="display: flex; height: 3rem;">
                <a href=""
                    style="font-size: 14px;font-weight: 200;margin-right: 15px;cursor: pointer;text-align: center;
                                        justify-content: center;align-items: center;padding-top: 5px;width: 95px;padding-bottom: 5px;display: flex;border-radius: 15px 15px 0px 0px;background-color: #1B3425; text-decoration: none;color: #ffffff; font-family: Segoe, Tahoma, Geneva, Verdana, sans-serif;">
                    Create order</a>
                <a href="" id="confirmed"
                    style="font-size: 14px;font-weight: 200;margin-right: 15px;cursor: pointer;text-align: center;justify-content: center;align-items: center;padding-top: 5px;width: 95px;padding-bottom: 5px;display: flex;border-radius: 15px 15px 0px 0px; font-family: Segoe, Tahoma, Geneva, Verdana, sans-serif;
                                                @if (Route::current()->getName() == 'confirmed') background:
                    #36304a;
                    color: #ffffff;
                @else
                    background: #f7f6f3;
                    color: rgb(0, 0, 0); @endif ">
                    Shipment List</a>

            </div>


            <div style="background-color: #1B3425; border-radius: 0px 10px 10px 10px;">
                <form method="POST" action="create_new_order" id="create_order_form" class="signup-form">
                    @csrf
                    <div class="form-part">
                        <h3 style="margin-left: 0.6rem;color: #CB9D48;font-family: Segoe, Tahoma, Geneva, Verdana, sans-serif;font-size: 16px;
                                            text-transform: uppercase; margin-top: 2rem;">Order Info.</h3>
                        <div class="form-row">

                            <div class="form-group">
                                <label for="order_number">Order Number</label>
                                <input type="text" class="form-input" name="order_number" id="order_number"
                                    style="width: 14rem; padding: 5px 5px; font-family: Segoe, Tahoma, Geneva, Verdana, sans-serif;"
                                    required />
                            </div>
                            <div class="form-group">
                                <label for="order_value">Order Value</label>
                                <input type="number" class="form-input" name="order_value" id="order_value"
                                    style="width: 14rem; padding: 5px 5px;font-family: Segoe, Tahoma, Geneva, Verdana, sans-serif;"
                                    required />
                            </div>
                            <div class="form-group">
                                <label for="order_amount">Amount</label>
                                <input type="number" class="form-input" name="order_amount" id="order_amount"
                                    style="width: 14rem; padding: 5px 5px;font-family: Segoe, Tahoma, Geneva, Verdana, sans-serif;"
                                    required />
                            </div>
                            <div class="form-group">
                                <label for="payment_type">Payment Type</label>
                                <select name="payment_type" id='payment_type' onchange="payment_selected(this)"
                                    style="width: 220px; " required>
                                    <option value="" selected hidden>Select Payment</option>

                                    <option id='COD' value="0"> Cash on delivery (COD) </option>
                                    <option id='CC' value="1"> Credit card (CC) </option>
                                </select>

                            </div>
                            <div class="form-group">
                                <label for="products_description">Products description</label>
                                <input type="text" class="form-input" name="products_description"
                                    id="products_description"
                                    style="width: 14rem; padding: 5px 5px;font-family: Segoe, Tahoma, Geneva, Verdana, sans-serif;"
                                    required />

                            </div>
                        </div>
                        <hr style="margin-bottom: 2rem; border-top: 2px solid rgba(203, 157, 72,.1);  width: 80%;">
                    </div>
                    <div class="form-part">
                        <h3 style="margin-left: 0.6rem;color: #CB9D48;font-family: Segoe, Tahoma, Geneva, Verdana, sans-serif;font-size: 16px;
                                            text-transform: uppercase; margin-top: 2vh;">Customer Info.</h3>
                        <div class="form-row">

                            <div class="form-group">
                                <label for="customer-name">Name</label>
                                <input type="text" class="form-input" name="customer_name" id="customer_name"
                                    style="width: 14rem; padding: 5px 5px;font-family: Segoe, Tahoma, Geneva, Verdana, sans-serif;"
                                    required />
                            </div>
                            <div class="form-group">
                                <label for="customer-email">E-mail</label>
                                <input type="email" class="form-input" name="customer_email" id="customer_email"
                                    style="width: 14rem; padding: 5px 5px;font-family: Segoe, Tahoma, Geneva, Verdana, sans-serif;"
                                    required />
                            </div>
                            <div class="form-group">
                                <label for="customer_phone">phone</label>
                                <div style="margin:0px;width: 80%;" class="row">
                                    <input type="text" value="+0" class="form-input" name="customer_country_code"
                                        id="customer_country_code"
                                        style="flex: 2;border-radius: 0px;padding: 5px 5px;font-family: Segoe, Tahoma, Geneva, Verdana, sans-serif;"
                                        readonly />

                                    <input type="number" class="form-input" name="customer_phone" id="customer_phone"
                                        style="flex: 8;border-radius: 0px; padding: 5px 5px;font-family: Segoe, Tahoma, Geneva, Verdana, sans-serif;"
                                        required />
                                </div>

                            </div>
                            <div class="form-group">
                                <label for="customer_country">Address-Country</label>
                                <select name="customer_country" id='customer_country' onchange="get_cities(this)"
                                    style="width: 220px; " required>
                                    <option value="" selected hidden>Select Country</option>

                                    <option id='KSA' value="1"> Saudi Arabia </option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="customer_city">Address-City</label>
                                <select name="customer_city" id='customer_city' style="width: 220px; " required>
                                    <option value="" selected hidden>Select City</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="customer_request">Request</label>
                                <input type="text" class="form-input" name="customer_request" id="customer_request"
                                    style="     width: 14rem; padding: 5px 5px;font-family: Segoe, Tahoma, Geneva, Verdana, sans-serif;" />
                            </div>
                            <div class="form-group">
                                <label for="customer_area">Address-Area</label>
                                <input type="text" class="form-input" name="customer_area" id="customer_area"
                                    style=" width: 14rem; padding: 5px 5px;font-family: Segoe, Tahoma, Geneva, Verdana, sans-serif;"
                                    required />
                            </div>
                            <div class="form-group">
                                <label for="customer_address_number">Postal code</label>
                                <input type="number" class="form-input" name="customer_address_number"
                                    id="customer_address_number"
                                    style="     width: 14rem;padding: 5px 5px;font-family: Segoe, Tahoma, Geneva, Verdana, sans-serif;" />
                            </div>
                        </div>
                        <hr style="margin-bottom: 2rem; border-top: 2px solid rgba(203, 157, 72,.1);  width: 80%;">
                    </div>
                    <div class="form-part">
                        <h3 style="margin-left: 0.6rem;color: #CB9D48;font-family: Segoe, Tahoma, Geneva, Verdana, sans-serif;font-size: 16px;
                                            text-transform: uppercase; margin-top: 2vh;">Shipper Info.</h3>
                        <div class="form-row">

                            <div class="form-group">
                                <label for="shipper_name">Name</label>
                                <input type="text" class="form-input" name="shipper_name" id="shipper_name"
                                    value="{{ $user->name }}"
                                    style="     width: 14rem;padding: 5px 5px; font-family: Segoe, Tahoma, Geneva, Verdana, sans-serif;"
                                    disabled />
                            </div>
                            <div class="form-group">
                                <label for="shipper_email">E-mail</label>
                                <input type="text" class="form-input" name="shipper_email" id="shipper_email"
                                    value="{{ $user->email }}"
                                    style="     width: 14rem; padding: 5px 5px;font-family: Segoe, Tahoma, Geneva, Verdana, sans-serif;"
                                    disabled />
                            </div>
                            <div class="form-group">
                                <label for="shipper_phone">phone</label>
                                <input type="text" class="form-input" name="shipper_phone" id="shipper_phone"
                                    value="{{ $user->phone_number }}"
                                    style="     width: 14rem; padding: 5px 5px;font-family: Segoe, Tahoma, Geneva, Verdana, sans-serif;"
                                    disabled />
                            </div>
                            <div class="form-group">
                                <label for="shipper_country">Address-Country</label>
                                <input type="text" class="form-input" name="shipper_country" id="shipper_country"
                                    value="{{ $user->country }}"
                                    style="     width: 14rem; padding: 5px 5px;font-family: Segoe, Tahoma, Geneva, Verdana, sans-serif;"
                                    disabled />
                            </div>
                            <div class="form-group">
                                <label for="shipper_city">Address-City</label>
                                <input type="text" class="form-input" name="shipper_city" id="shipper_city"
                                    value="{{ $user->city }}"
                                    style="    width: 14rem; padding: 5px 5px;font-family: Segoe, Tahoma, Geneva, Verdana, sans-serif;"
                                    disabled />
                            </div>

                            <div class="form-group">
                                <label for="shipper_area">Address-Area</label>
                                <input type="text" class="form-input" name="shipper_area" id="shipper_area"
                                    value="{{ $user->area }}"
                                    style="     width: 14rem; padding: 5px 5px; font-family: Segoe, Tahoma, Geneva, Verdana, sans-serif;"
                                    disabled />
                            </div>
                            <div class="form-group">
                                <label for="shipper_address_number">Postal code</label>
                                <input type="text" class="form-input" name="shipper_address_number"
                                    value="{{ $user->address_number }}" id="shipper_address_number"
                                    style="    width: 14rem; padding: 5px 5px;font-family: Segoe, Tahoma, Geneva, Verdana, sans-serif;"
                                    disabled />
                            </div>
                        </div>
                    </div>

                    <button type="submit" id="submit_new_order"
                        style="letter-spacing: 2px;font-size: 18px; background-color: #CB9D48;border-color: #CB9D48;display: inline-grid; padding-inline: 35px; margin-bottom: 2rem;position: relative;left: 80%; top: 2rem;font-family: 'Bebas Neue', cursive;"
                        class="btn btn-success btn-s">
                        Submit
                    </button>
                </form>

            </div>

        </div>

    </div>

    <script>
        $(document).ready(function() {
            $("#create_order_form").on("submit", function() {
                $('#submit_new_order').html(
                    '<div id="submit_new_order" style="align-items: center;justify-content: center;display: flex"><div class="loader"></div></div>'
                );
            }); //submit
        });

        function get_cities(element) {
            var html = "";
            $.ajax({
                url: "get_country_cities",
                type: "post",
                data: {
                    _token: "{{ csrf_token() }}",
                    country: element.value,
                },
                success: function(response) {
                    html +=
                        '<option value="" selected disabled hidden>Select City</option>';
                    response.forEach(element => {

                        html += '<option value="' + element.city_id + '">' + element.name +
                            '</option>'
                    });


                    $('#customer_country_code').val(response[0].country_code);

                    $('#customer_city').html(html);
                },
                error: function(xhr) {
                    //Do Something to handle error
                }

            });
        }

        function payment_selected(element) {
            if (element.value == 1) {
                $('#order_amount').val(0);
                document.getElementById('order_amount').readOnly = true;
            } else {
                document.getElementById('order_amount').readOnly = false;
            }
        }
    </script>
@endsection
