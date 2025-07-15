@extends('layouts.dash_board_layout')

@section('content')
    <style>
        .loader {
            border: 3px solid #f3f3f3;
            border-radius: 50%;
            border-top: 4px solid #1b3425;
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


        /*[ RESTYLE TAG ]*/

        * {
            margin: 0px;
            padding: 0px;
            box-sizing: border-box;
        }

        body,
        html {
            height: 100%;
        }

        /*---------------------------------------------*/
        a {
            font-size: 14px;
            line-height: 1.7;
            color: #666666;
            margin: 0px;
            transition: all 0.4s;
            -webkit-transition: all 0.4s;
            -o-transition: all 0.4s;
            -moz-transition: all 0.4s;
        }

        a:focus {
            outline: none !important;
        }

        a:hover {
            text-decoration: none;
        }

        /*---------------------------------------------*/
        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            margin: 0px;
        }

        p {
            font-size: 14px;
            line-height: 1.7;
            color: #666666;
            margin: 0px;
        }

        ul,
        li {
            margin: 0px;
            list-style-type: none;
        }


        /*---------------------------------------------*/
        input {
            outline: none;
            border: none;
        }

        textarea {
            outline: none;
            border: none;
        }

        textarea:focus,
        input:focus {
            border-color: transparent !important;
        }

        input:focus::-webkit-input-placeholder {
            color: transparent;
        }

        input:focus:-moz-placeholder {
            color: transparent;
        }

        input:focus::-moz-placeholder {
            color: transparent;
        }

        input:focus:-ms-input-placeholder {
            color: transparent;
        }

        textarea:focus::-webkit-input-placeholder {
            color: transparent;
        }

        textarea:focus:-moz-placeholder {
            color: transparent;
        }

        textarea:focus::-moz-placeholder {
            color: transparent;
        }

        textarea:focus:-ms-input-placeholder {
            color: transparent;
        }

        input::-webkit-input-placeholder {
            color: #adadad;
        }

        input:-moz-placeholder {
            color: #adadad;
        }

        input::-moz-placeholder {
            color: #adadad;
        }

        input:-ms-input-placeholder {
            color: #adadad;
        }

        textarea::-webkit-input-placeholder {
            color: #adadad;
        }

        textarea:-moz-placeholder {
            color: #adadad;
        }

        textarea::-moz-placeholder {
            color: #adadad;
        }

        textarea:-ms-input-placeholder {
            color: #adadad;
        }

        /*---------------------------------------------*/
        button {
            outline: none !important;
            border: none;
            background: transparent;
        }

        button:hover {
            cursor: pointer;
        }

        iframe {
            border: none !important;
        }


        /*---------------------------------------------*/
        .container {
            max-width: 1200px;
        }





        /*//////////////////////////////////////////////////////////////////
                                [ Contact ]*/

        .container-contact100 {
            height: 105vh !important;
            background: #f7f6f3;
            width: 100%;
            min-height: 100vh;
            display: -webkit-box;
            display: -webkit-flex;
            display: -moz-box;
            display: -ms-flexbox;
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            align-items: center;
            padding: 15px;

        }

        .wrap-contact100 {
            color: #1b3425;
            box-shadow: 0 3px 10px 0px rgb(152 120 59/ 30%);
            width: 500px;
            background: #fff;
            border-radius: 10px;
            overflow: hidden;
            padding: 42px 55px 45px 55px;
        }


        /*------------------------------------------------------------------
                                [ Form ]*/

        .contact100-form {
            width: 100%;
        }

        .contact100-form-title {
            display: block;
            font-weight: 600;
            font-family: 'Bebas Neue', cursive;
            letter-spacing: 2px;
            font-size: 39px;
            color: #1f442e;
            line-height: 1.2;
            text-align: center;
            padding-bottom: 44px;
        }



        /*------------------------------------------------------------------
                                [ Input ]*/

        .wrap-input100 {
            width: 100%;
            position: relative;
            border-bottom: 2px solid #d9d9d9;
            padding-bottom: 13px;
            margin-bottom: 15px;
        }

        .label-input100 {
            font-size: 13px;
            color: #666666;
            line-height: 1.5;
            padding-left: 5px;
        }

        .input100 {
            display: block;
            width: 100%;
            background: transparent;
            font-family: Poppins-Medium;
            color: #333333;
            line-height: 1.2;
            padding: 0 5px;
            font-size: 16px;
            font-family: Segoe, Tahoma, Geneva, Verdana, sans-serif;
            font-weight: 100;
        }

        .focus-input100 {
            position: absolute;
            display: block;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            pointer-events: none;
        }

        .focus-input100::before {
            content: "";
            display: block;
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 0;
            height: 2px;

            -webkit-transition: all 0.4s;
            -o-transition: all 0.4s;
            -moz-transition: all 0.4s;
            transition: all 0.4s;

            background: #7f7f7f;
        }


        /*---------------------------------------------*/
        input.input100 {
            height: 40px;
        }


        textarea.input100 {
            min-height: 110px;
            padding-top: 9px;
            padding-bottom: 13px;
        }


        .input100:focus+.focus-input100::before {
            width: 100%;
        }

        .has-val.input100+.focus-input100::before {
            width: 100%;
        }


        /*------------------------------------------------------------------
                                [ Button ]*/
        .container-contact100-form-btn {
            display: -webkit-box;
            display: -webkit-flex;
            display: -moz-box;
            display: -ms-flexbox;
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            padding-top: 13px;
        }

        .wrap-contact100-form-btn {
            width: 100%;
            display: block;
            position: relative;
            z-index: 1;
            border-radius: 25px;
            overflow: hidden;
            margin: 0 auto;
        }

        .contact100-form-bgbtn {
            position: absolute;
            z-index: -1;
            width: 300%;
            height: 100%;
            /*    background: #a64bf4; */
            background: -webkit-linear-gradient(left, #907239, #CB9D48, #907239, #CB9D48);
            background: -o-linear-gradient(left, #907239, #CB9D48, #907239, #CB9D48);
            background: -moz-linear-gradient(left, #907239, #CB9D48, #907239, #CB9D48);
            background: linear-gradient(left, #907239, #CB9D48, #907239, #CB9D48);
            top: 0;
            left: -100%;

            -webkit-transition: all 0.4s;
            -o-transition: all 0.4s;
            -moz-transition: all 0.4s;
            transition: all 0.4s;
        }

        .contact100-form-btn {
            display: -webkit-box;
            display: -webkit-flex;
            display: -moz-box;
            display: -ms-flexbox;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 0 20px;
            width: 100%;
            height: 50px;

            font-family: Poppins-Medium;
            font-size: 16px;
            color: #fff;
            line-height: 1.2;
        }

        .wrap-contact100-form-btn:hover .contact100-form-bgbtn {
            left: 0;
        }

        .contact100-form-btn i {
            -webkit-transition: all 0.4s;
            -o-transition: all 0.4s;
            -moz-transition: all 0.4s;
            transition: all 0.4s;
        }

        .contact100-form-btn:hover i {
            -webkit-transform: translateX(10px);
            -moz-transform: translateX(10px);
            -ms-transform: translateX(10px);
            -o-transform: translateX(10px);
            transform: translateX(10px);
        }


        /*------------------------------------------------------------------
                                [ Responsive ]*/

        @media (max-width: 576px) {
            .wrap-contact100 {
                padding: 72px 15px 65px 15px;
            }
        }



        /*------------------------------------------------------------------
                                [ Alert validate ]*/

        .validate-input {
            position: relative;
        }

        .alert-validate::before {
            content: attr(data-validate);
            position: absolute;
            max-width: 70%;
            background-color: #fff;
            border: 1px solid #c80000;
            border-radius: 2px;
            padding: 4px 25px 4px 10px;
            top: 58%;
            -webkit-transform: translateY(-50%);
            -moz-transform: translateY(-50%);
            -ms-transform: translateY(-50%);
            -o-transform: translateY(-50%);
            transform: translateY(-50%);
            right: 2px;
            pointer-events: none;
            color: #c80000;
            font-size: 13px;
            line-height: 1.4;
            text-align: left;
            visibility: hidden;
            opacity: 0;

            -webkit-transition: opacity 0.4s;
            -o-transition: opacity 0.4s;
            -moz-transition: opacity 0.4s;
            transition: opacity 0.4s;
        }

        .alert-validate::after {
            content: "\f06a";
            font-family: FontAwesome;
            display: block;
            position: absolute;
            color: #c80000;
            font-size: 16px;
            top: 58%;
            -webkit-transform: translateY(-50%);
            -moz-transform: translateY(-50%);
            -ms-transform: translateY(-50%);
            -o-transform: translateY(-50%);
            transform: translateY(-50%);
            right: 8px;
        }

        .alert-validate:hover:before {
            visibility: visible;
            opacity: 1;
        }

        @media (max-width: 992px) {
            .alert-validate::before {
                visibility: visible;
                opacity: 1;
            }
        }



        /*//////////////////////////////////////////////////////////////////
                                [ Restyle Select2 ]*/

        .select2-container {
            display: block;
            max-width: 100% !important;
            width: auto !important;
        }

        .select2-container .select2-selection--single {
            display: -webkit-box;
            display: -webkit-flex;
            display: -moz-box;
            display: -ms-flexbox;
            display: flex;
            align-items: center;
            background-color: transparent;
            border: none;
            height: 40px;
            outline: none;
            position: relative;
        }

        /*------------------------------------------------------------------
                                [ in select ]*/
        .select2-container .select2-selection--single .select2-selection__rendered {
            font-family: Poppins-Medium;
            font-size: 18px;
            color: #333333;
            line-height: 1.2;
            padding-left: 5px;
            background-color: transparent;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 100%;
            top: 50%;
            transform: translateY(-50%);
            right: 10px;
            display: -webkit-box;
            display: -webkit-flex;
            display: -moz-box;
            display: -ms-flexbox;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .select2-selection__arrow b {
            display: none;
        }

        .select2-selection__arrow::before {
            content: '';
            display: block;

            border-right: 5px solid transparent;
            border-left: 5px solid transparent;
            border-bottom: 5px solid #999999;
            margin-bottom: 2px;
        }

        .select2-selection__arrow::after {
            content: '';
            display: block;

            border-right: 5px solid transparent;
            border-left: 5px solid transparent;
            border-top: 5px solid #999999;
        }

        /*------------------------------------------------------------------
                                    [ Dropdown option ]*/
        .select2-container--open .select2-dropdown {
            z-index: 1251;
            border: 0px solid #e5e5e5;
            border-radius: 0px;
            background-color: white;

            box-shadow: 0 3px 10px 0px rgba(0, 0, 0, 0.2);
            -moz-box-shadow: 0 3px 10px 0px rgba(0, 0, 0, 0.2);
            -webkit-box-shadow: 0 3px 10px 0px rgba(0, 0, 0, 0.2);
            -o-box-shadow: 0 3px 10px 0px rgba(0, 0, 0, 0.2);
            -ms-box-shadow: 0 3px 10px 0px rgba(0, 0, 0, 0.2);
        }

        .select2-dropdown--above {
            top: -30px;
        }

        .select2-dropdown--below {
            top: 8px;
        }

        .select2-container .select2-results__option[aria-selected] {
            padding-top: 10px;
            padding-bottom: 10px;
        }

        .select2-container .select2-results__option[aria-selected="true"] {
            background: #a64bf4;
            background: -webkit-linear-gradient(right, #00dbde, #fc00ff);
            background: -o-linear-gradient(right, #00dbde, #fc00ff);
            background: -moz-linear-gradient(right, #00dbde, #fc00ff);
            background: linear-gradient(right, #00dbde, #fc00ff);
            color: white;
        }

        .select2-container .select2-results__option--highlighted[aria-selected] {
            background: #a64bf4;
            background: -webkit-linear-gradient(right, #00dbde, #fc00ff);
            background: -o-linear-gradient(right, #00dbde, #fc00ff);
            background: -moz-linear-gradient(right, #00dbde, #fc00ff);
            background: linear-gradient(right, #00dbde, #fc00ff);
            color: white;
        }

        .select2-results__options {
            font-size: 15px;
            color: #333333;
            line-height: 1.2;
        }

        .select2-search--dropdown .select2-search__field {
            border: 1px solid #aaa;
            outline: none;
            font-size: 15px;
            color: #333333;
            line-height: 1.2;
        }

        .requiredClass {
            background-color: red;
        }

        .content-wrapper {
            background: #f7f6f3;
        }

        .navbar .navbar-menu-wrapper .navbar-nav .nav-item .nav-link .navbar-profile .navbar-profile-name {
            font-family: Segoe, Tahoma, Geneva, Verdana, sans-serif;
            color: white;
            font-size: 16px;
            margin-top: 1px;
        }

        .navbar-profile {
            margin-top: 10px;
        }

        .mb-1 {
            font-family: Segoe, Tahoma, Geneva, Verdana, sans-serif;
            color: white;
            font-size: 14px;
        }

        .navbar .navbar-menu-wrapper .navbar-nav .nav-item.dropdown .dropdown-menu.navbar-dropdown {
            top: 65px;
        }

        .m-l-7 {
            color: transparent;
        }

    </style>

    <body>

        <div class="container-contact100">
            <div class="wrap-contact100">
                <input name="id" value="{{ $user->id }}" id="id_number" type hidden>
                <span class="contact100-form-title">
                    Shipper Information
                </span>
                <div style="display:flex; align-items: baseline;">
                    <i style="font-size: 17px;width: 8%; " class="far fa-user"></i>
                    <div class="wrap-input100 validate-input" data-validate="Name is required">
                        <input class="input100" type="text" name="name" id="name_30" value="{{ $user->name }}"
                            placeholder="Enter your name" required readonly>
                        <span class="focus-input100"></span>
                    </div>
                </div>

                <div style="display:flex; align-items: baseline;">
                    <i style="font-size: 17px;width: 8%; " class="far fa-envelope"></i>

                    <div class="wrap-input100 validate-input" data-validate="Valid email is required: ex@abc.xyz">
                        <input class="input100" type="text" name="email" id="email_30" value="{{ $user->email }}"
                            placeholder="Email" required readonly>
                        <span class="focus-input100"></span>
                    </div>
                </div>
                <div style="display:flex; align-items: baseline; ">
                    <i style="font-size: 17px;width: 8%;" class="fas fa-phone-alt"></i>
                    <span
                        style="width: 3rem;margin-right: 10px; margin-left: 15px;color: #333333; font-size: 16px;font-family: Segoe, Tahoma, Geneva, Verdana, sans-serif;font-weight: 100;">
                        + 82</span>
                    <div class="wrap-input100 validate-input" style=" margin-bottom: 24px;">
                        <input class="input100" type="text" name="phone" id="phone_30" onkeyup="press(this)" required
                            placeholder="Phone Number">
                        <span class="focus-input100"></span>
                    </div>

                </div>


                <div style=" padding-left: 10px;">
                    <label style="color: #1f442e;
                                    font-size: larger; font-weight: 700;" for="">Address</label>
                </div>

                <div class="wrap-input100 validate-input" style="display:flex; margin-top: 22px; padding-left: 25px;">
                    <div>
                        <input class="input100" type="text" name="country" id="country_30" placeholder="Country"
                            value="Korea" onkeyup="press(this)" required readonly
                            style="border-bottom: 1px solid #d9d9d9; width:85%; margin-bottom: 5px;">
                        <span class="focus-input100"></span>
                        <input class="input100" type="text" name="area" id="area_30" placeholder="Area"
                            onkeyup="press(this)" style=" width:85%;    margin-bottom: 5px;" required>
                        <span class="focus-input100"></span>
                    </div>
                    <div>
                        <select id='city_30' name="city" onchange="press(this)"
                            style="background-color: transparent;  border:none; outline-color:#dfdfdf; height: 40px;width: 100%; color: black; font-size: 16px;  border-bottom: 1px solid #d9d9d9;"
                            required>
                            <option style=" color: black; height: 50px;" value="" selected hidden>Select city</option>
                            <option value="Seoul" style=" color: black; height: 50px;">Seoul</option>
                            <option value="Busan" style=" color: black; height: 50px;">Busan</option>
                            <option value="Daegu" style=" color: black; height: 50px;">Daegu</option>
                            <option value="Incheon" style=" color: black; height: 50px;">Incheon</option>
                            <option value="Gyeongju-si" style=" color: black; height: 50px;">Gyeongju-si</option>
                            <option value="Daejeon" style=" color: black; height: 50px;">Daejeon</option>
                            <option value="Suwon-si" style=" color: black; height: 50px;">Suwon-si</option>
                            <option value="Andong" style=" color: black; height: 50px;">Andong</option>
                            <option value="ulsan" style=" color: black; height: 50px;">Ulsan</option>
                            <option value="changwon" style=" color: black; height: 50px;">Changwon</option>
                            <option value="jeju-si" style=" color: black; height: 50px;">Jeju-si</option>
                            <option value="seongnam-s" style=" color: black; height: 50px;">Seongnam-s</option>
                            <option value="bucheon-si" style=" color: black; height: 50px;">Bucheon-si</option>
                            <option value="ansan-si" style=" color: black; height: 50px;">Ansan-si</option>
                            <option value="pohang" style=" color: black; height: 50px;">Pohang</option>
                            <option value="masan" style=" color: black; height: 50px;">Masan</option>
                            <option value="cheonan" style=" color: black; height: 50px;">Cheonan</option>
                            <option value="kimhae" style=" color: black; height: 50px;">Kimhae</option>
                            <option value="chinju" style=" color: black; height: 50px;">Chinju</option>
                            <option value="yeosu" style=" color: black; height: 50px;">Yeosu</option>
                        </select>
                        <span class="focus-input100"></span>
                        <input class="input100" type="text" name="postal_Code" id="postalCode_30"
                            placeholder="Postal Code" style=" width:85%;  margin-bottom: 5px;" onkeyup="press(this)"
                            required>
                        <span class="focus-input100"></span>
                    </div>
                </div>


                <div class="container-contact100-form-btn">
                    <div class="wrap-contact100-form-btn">
                        <div class="contact100-form-bgbtn"></div>
                        <button class="contact100-form-btn" type="submit" id="submit" onclick='ajaxfunc(this)'>
                            <span style="    letter-spacing: 1px;
                                            font-family: Segoe, Tahoma, Geneva, Verdana, sans-serif;">
                                Submit
                                <i class="fa fa-long-arrow-right m-l-7" aria-hidden="true"></i>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
        </div>



        <div id="dropDownSelect1"></div>



        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13"></script>


        <script>
            window.dataLayer = window.dataLayer || [];

            function gtag() {
                dataLayer.push(arguments);
            }
            gtag('js', new Date());

            gtag('config', 'UA-23581568-13');
        </script>
        <script>
            var shipper_data = new Object();

            var values;

            var id_number = $('#id_number').attr("id");
            var id = $('#id_number').val();
            shipper_data[id_number] = id;
            shipper_data['phone'] = '';
            shipper_data['city'] = '';
            shipper_data['postalCode'] = '';


            function press(elemant) {
                values = elemant.id.substring(0, elemant.id.indexOf("_"));
                shipper_data[values] = elemant.value;
            }


            function ajaxfunc(element) {

                if (shipper_data['phone'] != '' && shipper_data['city'] != '' && shipper_data['postalCode'] != '') {

                    $(element.parentElement).html(
                        '<div id="submit_new_order" style="align-items: center;justify-content: center;display: flex"><div class="loader"></div></div>'
                    );

                    $.ajax({
                        url: "send_shipper_info",
                        type: 'POST',
                        data: {
                            _token: "{{ csrf_token() }}",
                            shipper_data: shipper_data
                        },
                        success: function(response) {

                            window.location.reload();

                        }
                    });

                } else {
                    Swal.fire({
                        position: 'center',
                        icon: 'error',
                        title: 'You must fill all fields!',
                        showConfirmButton: false,
                        timer: 2500
                    });
                }
            };
        </script>

    </body>
@endsection
