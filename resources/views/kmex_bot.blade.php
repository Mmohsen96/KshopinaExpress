<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Kshopina Bot</title>

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

    <link href="https://fonts.googleapis.com/css2?family=Caveat:wght@500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Changa:wght@500&display=swap" rel="stylesheet">

</head>

<style>
    body {
        background-color: #1b3425;
        color: white;
    }

    .bot {
        text-align: center;
        font-size: 30px;
        text-shadow: 0 0 3px #f7a209, 0 0 5px #ffcc70;
        color: white;
        font-family: 'Caveat', cursive;
        z-index: 10;
        display: flex;
        top: 25px;
        position: relative;
        left: -18px;
    }

    .kshopina {
        text-align: center;
        font-size: -webkit-xxx-large;
        color: white;
        z-index: 10;
        font-family: 'Changa', sans-serif;
    }

    .kshopina-logo {
        margin-left: 0px;
        z-index: 1;
        top: calc(40% - 150px);
        width: 100%;
        justify-content: center;
        align-items: end;
        margin-top: 5vh;
    }

    .content {
        margin-top: 75px;
        justify-content: center;
        text-align: center;
        padding: 55px;
        margin-bottom: 45px;
    }

    .choice {
        padding: 18px;
        margin: auto;
        color: #1b3425;
    }

    .choice_style {
        box-shadow: 0 0 3px #9b9b9b, 0 0 5px #1b3425;
        border-radius: 8px;
        background-color: #f5f5f5;
        color: black;
        width: 38rem;
    }

    .title {
        font-family: 'Changa', sans-serif;
        color: #1b3425;
        margin-bottom: 75px
    }

    .choice_style:hover {
        background-color: #cd9c44;
        color: white;
        cursor: pointer;
    }
    .choice_clicked{
        background-color: #cd9c44;
        color: white;
        cursor: pointer;
    }
    .move_forward{
        width: 4rem;
        height: 4rem;
        border-radius: 100%;
        background-color: #cb9c47;
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .move_forward:hover{
        box-shadow: 0 0 3px #9b9b9b, 0 0 5px #1b3425;
        cursor: pointer;
    }
    #inp-cover {
        position: absolute;
        top: 0;
        right: 41px;
        bottom: 0;
        left: 0;
        padding: 0 35px;
        background-color: #fff;
        border-radius: 10px;
        border: 0.5px #1b3425 solid;
    }

    button.shadow {
        box-shadow: 0 10px 30px #d0d0d0;
    }

    #app {

        border-radius: 120px;
        margin: 0 auto;
        width: 60vw;
        box-shadow: 0 10px 30px #c7c7c7;
    }

    .order_number_input {
        display: block;
        width: 50%;
        font-size: 19px;
        font-family: Arial, Helvetica, sans-serif;
        color: #382f1f;
        border: 0;
        padding: 30px 0;
        margin: 0;
        margin-top: 52px;
        line-height: 1;
        background-color: transparent;
        transition: 0.15s ease margin-top;
        cursor: auto;
        margin-top: 0;
    }

    .order_number_button {
        color: #ca9b49;
        background-color: #fff;
        box-shadow: none;
        cursor: pointer;
        position: absolute;
        top: 0;
        right: -30px;
        width: 82px;
        height: 82px;
        color: #fff;
        font-size: 30px;
        line-height: 1;
        padding: 26px;
        margin: 0;
        border: 0;
        background-color: #ca9b49;
        transition: 0.2s ease background-color;
        border-radius: 0px 10px 10px 0px;
    }

    input:focus-visible {
        outline: -webkit-focus-ring-color auto 0px;
    }

    select:focus-visible {
        outline: -webkit-focus-ring-color auto 0px;
    }

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

    input[type="date"]::-webkit-calendar-picker-indicator {
        background: transparent;
        bottom: 0;
        color: transparent;
        cursor: pointer;
        height: auto;
        left: 0;
        position: absolute;
        right: 0;
        top: 0;
        width: auto;
    }
</style>

<style>
    .btn-primary {
        border-radius: 18px;
        font-size: 14px;
        background-color: #e3ce88;
        border-color: #e3ce88;
        color: #426851;
    }

    .btn-primary:focus {
        border-radius: 18px;
        font-size: 14px;
        background-color: #e3ce88;
        border-color: #e3ce88;
        color: #426851;
    }

    .btn-primary:hover {
        border-radius: 18px;
        font-size: 14px;
        background-color: #cb9d48e6;
        border-color: #cb9d48e6;
    }

    .btn-primary:not(:disabled):not(.disabled):active {
        border-radius: 18px;
        font-size: 14px;
        background-color: #cb9d48e6 !important;
        border-color: #cb9d48e6 !important;
    }

    .btn-primary:disabled {
        border-radius: 18px;
        font-size: 14px;
        background-color: #303030e6 !important;
        border-color: #303030e6 !important;
    }

    .btn:not(:disabled):not(.disabled) {
        outline: none;
    }

    .btn-primary:focus {
        box-shadow: 0 0 0 0.2rem rgb(144 114 57 / 50%) !important;
    }

    #notes:focus-visible {
        outline: none;
    }
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
    .discount_button{
        box-shadow: 0 0 3px #9b9b9b, 0 0 1px #1b3425;
        border-radius: 4px;
        background-color: #dbda34;
        color: black;
    }
    .no_shadow{
        box-shadow: none !important;
    }
</style>

<style>
    .bot_logo{
        width: 20rem;
    }
   
    .input_width{
        width: 35vw !important;
    }
    .input_height{
       position: relative; 
       height: 82px;
       cursor: auto;
       border-radius: 120px;
    }
    .input_height_calender{
       position: relative; 
       height: 82px;
       cursor: auto;
       border-radius: 120px;
    }
    .input_width_calender{
        width: 60vw !important;
    }
    .calender{
        padding-left: 15px;
        border: none;
        width: 90%;
        height: 90%;
    }
    .calender_icon{
        color: #1b3425;
    }
    .order_number_input_calender{
        display: block;
        width: 50%;
        font-size: 19px;
        font-family: Arial, Helvetica, sans-serif;
        color: #382f1f;
        border: 0;
        padding: 30px 0;
        margin: 0;
        margin-top: 52px;
        line-height: 1;
        background-color: transparent;
        transition: 0.15s ease margin-top;
        cursor: auto;
        margin-top: 0;
    }
    .calender_row{
        padding-left: 35px;
        align-items: center;
        height: 100%;
        width: 44%;
        border-left: 0.5px #1b3425 solid;
    }

    .first_form_input_first{
        display: flex;
        justify-content: flex-start;
        width: 34rem;
    }
    .first_form_input_text{
        width: 34rem;
        height: 7rem;
        display: flex;
        justify-content: flex-start;
    }
    .order_number_input_first_form{
        display: block;
        width: 50%;
        font-size: 19px;
        font-family: Arial, Helvetica, sans-serif;
        color: #382f1f;
        border: 0;
        padding: 30px 0;
        margin: 0;
        margin-top: 52px;
        line-height: 1;
        background-color: transparent;
        transition: 0.15s ease margin-top;
        cursor: auto;
        margin-top: 0;
    }
    .form_button{
        display: flex;
        flex-wrap: wrap;
        justify-content: flex-end;
        margin: 15px 0 12px 0;
    }

    a:hover {
        text-decoration: none !important;
    }

    .second_form_input{
        display: block;
        font-size: 19px;
        font-family: Arial, Helvetica, sans-serif;
        color: #382f1f;
        border: 0;
        margin: 0;
        margin-top: 52px;
        line-height: 1;
        background-color: transparent;
        transition: 0.15s ease margin-top;
        cursor: auto;
        margin-top: 0;
        width: 90%;
        padding: 15px 0;
    }

    .second_input_height{
        position: relative;
        height: 70px;
        cursor: auto;
        border-radius: 120px;
    }
    .second_form_icon{
        color: #1b3425;
        margin-right: 15px;
        font-size: 20px;
    }
    .second_form_title{
        color: #1b3425;
        display: flex;
        font-weight: 600;
        font-size: 17px;
        margin-left: 10px;
        margin-bottom: 10px;
    }

    .disc_but_style{
        margin-bottom: 30px;
        margin-right: 5rem;
        max-width: 14%;
        width: 6rem;
        height: 6vw;
    }
    .disc_but_num{
        color: white;
        letter-spacing: 2px;
        margin-bottom: 0px;
        font-size: 1.75vw;
    }
    .disc_but_code{
        padding: 0.5vw 0vw;
        padding-bottom: 0.7vw;
        color: white;
        font-size: 1.3vw;
        margin-bottom: 0px;
    }
    
    
    
    @media(max-width: 1200px) {
        .second_form_input{
            width: 70%;
            padding: 15px 0;
            font-size: 18px;
        }
        
    }
    @media(max-width: 992px) {
        .input_width{
            width: 55vw !important;
        }

        .input_width_calender{
            width: 55vw !important;
        }

        .input_height_calender{
            height: 65px ;
        }

        .order_number_input_calender{
            padding: 20px 0;
            padding-right: 30px;
            font-size: 16px;
        }

        .calender{
            font-size: small;
            width: 65%;
        }

        .order_number_calender{
            height: 65.5px;
            right: -15px;
        }

        .email_calender_icon{
            font-size: 20px;
            position: relative;
            bottom: 0.8rem;
        }

        .form_button{
            justify-content: space-around;
        }

        .disc_but_style{
            width: 15rem;
            max-width: 20%;
        }

        .disc_but_num{
            font-size: 1.5vw;
        }

        
    }
   

    @media(max-width: 768px) {
        .container{
            padding-right: 5px;
            padding-left: 5px;
        }
        .bot_logo{
            width: 17rem;
        }
        .sub_long_title{
            font-size: 1.2rem;
        }
        .content{
            padding: 25px;
        }

        .order_number_input{
            padding: 20px 0;
        }
        .input_height{
            height: 62px;
        }
        .order_number_button{
            height: 62.8px;
            right: 0px;
            width: 60px;
        }
        .email_icon{
            position: relative;
            bottom: 0.8rem;
            right: 0.2rem;
            right: 0.6rem;
            font-size: 24px;
        }
        .input_width_calender{
            width: 60vw !important;
        }
        .input_height_calender{
            height: 60px;
        }
    
        .order_number_calender{
            height: 60.8px;
            width: 70px;
        }

        #inp-cover{
            padding: 0px 15px;
        }
        .calender_row{
            padding-left: 15px;
        }
        .first_form_input_text{
            width: 30rem;
        }
        .order_number_input_first_form{
            padding: 20px 0;
        }
        
        .second_input_height{
            height: 55px;
        }

        .second_form_input{
            font-size: 14px;
        }
        .disc_but_style{
            height: 8vw;
        }
        .disc_but_code{
            padding: 1vw 0vw 1vw 0vw;
            margin-left: -1.5vw;
            font-size: 1.8vw;
            text-align: center;
        }
        .disc_but_num{
            font-size: 1.8vw;
        }



    }

    @media(max-width: 600px) {
        .input_width_calender {
            width: 80vw !important;
        }
    }
    
    @media(max-width: 574px) {

       .first_form_input_text{
         width: 80vw;
        } 
        
    }

    @media(max-width: 550px) {
        .input_width{
            width: 75vw !important;
        }
        .input_width_calender {
            width: 88vw !important;
        }
        .order_number_calender{
            width: 60px;
        }
        .email_calender_icon{
            bottom: 1rem;
            right: 0.5rem;
        }
        .calender{
            padding-left: 8px;
            font-size: 10px;
        }
        .order_number_input_calender{
            font-size: 14px;
        }
        .second_input_height{
            height: 45px;
        }
        .second_form_icon{
            font-size: 12px;
            margin-right: 8px;
        }
        .second_form_input{
            font-size: 10px;
        }

       
    }

    @media(max-width: 470px) {
        .disc_but_style{
            max-width: 30%;
            height: 12vw;
        }
        .disc_but_code{
            font-size: 2.5vw;
            padding: 2vw 0vw 1vw 0vw;
        }
        .disc_but_num{
            font-size: 3vw;
        }
    }
    @media(max-width: 400px) {
        .bot_logo{
            width: 12rem;
        }
        .first_form_input_text{
            width: 78vw;
        }
        .order_number_input_first_form{
            width: 80% !important;
            font-size: 16px;
        }
        .order_hashtag{
            margin-right: 8px;
        }
        .second_form_title{
            font-size: 12px;
            width: 50vw;
        }
        
       
    }
   
 
    @media(max-width: 310px) {
        .input_height_calender{
            height: 50px;
        }
        #inp-cover{
            padding: 0px 8px;
        }
        .order_number_input_calender{
            padding: 15px 0;
            width: 45%;
            padding-right: 25px;
            font-size: 10px;
        }
        .calender_row {
            padding-left: 10px;
        }
        .calender_icon{
            margin-left: -4px;
        }
        .calender {
            width: 85%;
        }
        .order_number_button{
            top: -1px;
            right: 4px;
        }
        .email_calender_icon{
            font-size: 18px;
            bottom: 1.3rem;
            right: 0.7rem;
        }
        .order_number_calender{
            height: 50.8px;
            width: 50px;
        }
        .second_input_height{
            height: 40px;
        }
        .second_form_input{
            width: 50%;
            font-size: 6px;
        }
        .form_minimize{
            width: 90vw !important;
        }
            
        
    }
    @media(max-width: 300px) {
        .input_width{
            width: 80vw !important;
            margin-left: -0.8rem !important;
        }
        .input_height{
            height: 51px;
        }
        .order_number_button{
            height: 52px;
            right: 4px;
            width: 50px;
        }
        .order_number_input{
            width: 140% !important;
            font-size: 12px;
            padding: 18px 0;
           
        }
        .email_icon{
            font-size: 12px;
            bottom: 1.5rem;
            right: 0.5rem;
        }
        .order_number_input_first_form{
            font-size: 12px;
            padding: 18px 0;
            width: 85% !important;
        }
       
      
       
    }
    
</style>


<body>

    @if ($message = Session::get('message'))
        @php
            echo "<script>
            Swal.fire({
                position: 'center',
                icon:'success',
                title:'We received your Inquiry',
                text:'".$message."',
                showConfirmButton: false,
                timer: 2500
            });</script>";
        @endphp
    @elseif ($message = Session::get('error'))
        @php
            echo "<script>
            Swal.fire({
                position: 'center',
                icon:'error',
                title:'OOPS!',
                text:'".$message."',
                showConfirmButton: false,
                timer: 2500
            });</script>";
        @endphp
        
    @endif

    
    <div class="container">
        <div >
            <div id="logo" class="row kshopina-logo">
                <div class="kshopina">
                    <img src="{{ asset('kshopina_mail_white.png') }}" class="bot_logo"
                        alt="ops"></div>
                <div class="bot">BOT</div>
            </div>

            <div id="content" class="content" style="background-color: white;border-radius: 7px;" class="col">

                <div style="display: flex;justify-content: center;">
                    <div style="margin-bottom: 30px;" class="choice_style" onclick="customer_or_not('customer')">
                        <h6 class="choice" >Order-related Questions</h6>
                    </div>

                </div>
                <div style="display: flex;justify-content: center;">
                    <div style="margin-bottom: 30px;" class="choice_style" onclick="customer_or_not('not')">
                        <h6 class="choice" >General Questions</h6>

                    </div>

                </div>
                <div style="display: flex;justify-content: center;">
                    <div class="choice_style"  >
                        
                        <a href="/FAQS" class="link_faqs"><h6 class=" choice" >FAQS</h6></a>  

                    </div>

                </div>
            </div>

        </div>

    </div>
</body>

<script>
    var html = '';
    var colors = 
    {'5': '#eeda66e3' , //yellow shade
        '10': '#f11b1b', // red shade // two 
        '15': '#46d986', //green shade
        '20': '#d9d946', //yellow shade // two
        '25': '#bc46d9',//purple shade
        '30': '#46a4d9', //blue shade
        '35': '#edba0a', //orange shade
        '40':'#B91228', //red shade
        '45': '#f58fba', //pink shade
        '50': '#7eabcd', //baby blue shade
        '55': '#eeda66e3' , //yellow shade
        '60': '#f11b1b', // red shade // two 
        '65': '#46d986', //green shade
        '70': '#bc46d9',//purple shade
        '75': '#46a4d9', //blue shade
        '80': '#edba0a', //orange shade
        '85': '#f58fba', //pink shade
        '90': '#eeda66e3' , //yellow shade
        '95': '#B91228', //red shade
        '100': '#57b64e' // green shade two 
    };

    
    function customer_or_not(type) {

        if (type == "customer") {

            html = '';

            html +=
                '<div id="title">' +
                '<h3 class="title" >How can I help you ?</h3>' +

                '</div>' +

                '<div style="display: flex;justify-content: center;">' +
                '<div style="margin-bottom: 30px;" class="choice_style" onclick="customer_choice(\'verification\')">' +
                '<h6 class="choice" >Want to cancel / confirm my order</h6>' +
                '</div>' +

                '</div>' +
                '<div style="display: flex;justify-content: center;">' +
                '<div style="margin-bottom: 30px;" class="choice_style" onclick="customer_choice(\'edit_customer_mail\')">' +
                '<h6 class="choice" >Want to change your email in the order information</h6>' +

                '</div>' +

                '</div>' +
                '<div style="display: flex;justify-content: center;">' +
                '<div style="margin-bottom: 30px;" class="choice_style" onclick="customer_choice(\'order_details\')">' +
                '<h6 class="choice" >Receive an email with order summary </h6>' +

                '</div>' +

                '</div>' +
                '<div style="display: flex;justify-content: center;">' +
                '<div style="margin-bottom: 30px;" class="choice_style" onclick="customer_choice(\'tracking\')">' +
                '<h6 class="choice" >Need to track your order</h6>' +

                '</div>' +

                '</div>' +
                '<div style="display: flex;justify-content: center;">' +
                '<div style="margin-bottom: 30px;" class="choice_style" onclick="customer_choice(\'item_status\')">' +
                '<h6 class="choice" >Found something wrong after receiving your order</h6>' +

                '</div>' +

                '</div>' +
                '<div style="display: flex;justify-content: center;">' +
                '<div style="margin-bottom: 30px;" class="choice_style" onclick="customer_choice(\'reschedule\')">' +
                '<h6 class="choice" >Request to reschedule the delivery date of your order</h6>' +

                '</div>' +

                '</div>' +
                '<div style="display: flex;justify-content: center;">' +
                '<div style="margin-bottom: 30px;" class="choice_style" onclick="customer_choice(\'lmd\')">' +
                '<h6 class="choice" >No response from delivery company OR Late delivery</h6>' +

                '</div>' +

                '</div>' +
                '<div style="display: flex;justify-content: center;">' +
                '<div style="margin-bottom: 30px;" class="choice_style" onclick="customer_choice(\'other\')">' +
                '<h6 class="choice" >Others</h6>' +

                '</div>' +

                '</div>'

            $("#content").html(html);
        } else {

            html = '';

            html +=
                '<div id="title">' +
                '<h3 class="title" >How can I help you ?</h3>' +

                '</div>' +

                '<div style="display: flex;justify-content: center;">' +
                '<div style="margin-bottom: 30px;" class="choice_style" onclick="guest_choice(\'ask_about_product\')">' +
                '<h6 class="choice" >Inquire about products on the website</h6>' +
                '</div>' +

                '</div>' +
                '<div style="display: flex;justify-content: center;">' +
                '<div style="margin-bottom: 30px;" class="choice_style" onclick="guest_choice(\'final_price\')">' +
                '<h6 class="choice" >Want to know the final price of the items</h6>' +

                '</div>' +

                '</div>' +
                '<div style="display: flex;justify-content: center;">' +
                '<div style="margin-bottom: 30px;" class="choice_style" onclick="guest_choice(\'availability\')">' +
                '<h6 class="choice" >Which countries Kshopina provides its service to</h6>' +

                '</div>' +

                '</div>' +
                '<div style="display: flex;justify-content: center;">' +
                '<div style="margin-bottom: 30px;" class="choice_style" onclick="guest_choice(\'discount_codes\')">' +
                '<h6 class="choice" >Ask about discount codes</h6>' +

                '</div>' +

                '</div>' +
                '<div style="display: flex;justify-content: center;">' +
                '<div style="margin-bottom: 30px;" class="choice_style" onclick="guest_choice(\'collabrations\')">' +
                '<h6 class="choice" >Ask about collabrations</h6>' +

                '</div>' +
                '</div>' +
                '<div style="display: flex;justify-content: center;">' +
                '<div style="margin-bottom: 30px;" class="choice_style" onclick="guest_choice(\'others\')">' +
                '<h6 class="choice" >Others</h6>' +

                '</div>';

            $("#content").html(html);


        }
    }

    var choices={'Wrong':0,'Missing':0,'Damaged':0};

    function customer_choice(type) {
        if (type == 'edit_customer_mail') {

            html = '';

            html +=
                '<div> <h3 style="margin-bottom: 0px;font-size: 1.4rem;" class="title" >' +
                'You have to send the new email over the WhatsApp number that was registered in the order to our WhatsApp: ' +
                '<span style="color: #cb9c47;">+20 110 228 2260</span> , For example :<br><br>' +
                'My old email : tesst123@gmail.com <br> My new email : test12@gmail.com <br>' +
                'Order reference : 12345 </h3>' +

                '</div>';



            $("#content").html(html);
        } else if (type == 'item_status') {

           /*  html = '';

            html +=
                '<div> <h3 style="text-align: left;margin-bottom: 0px;font-size: 1.4rem;" class="title" >' +
                '<div style="font-weight: 900;">Hello dear customer</div><br><br>' +
                'We apologize for what happened.<br>' +
                'Please follow these steps to help you better and faster:<br><br>' +
                '<div style="margin-left: 30px;"> 1- Take an unboxing video showing the condition of the whole order.<br>' +
                '2- A picture of the order.<br>' +
                '3- A picture of the invoice that comes attached to the package.</div><br><br>' +
                'Then send the requirements to the following WhatsApp number : ' +
                ' <span style="color: #cb9c47;">+201159528023</span> <br>' +
                'We will be following up with the case over WhatsApp.' +
                '</h3>' +

                '</div>';



            $("#content").html(html); */
            html ='';

            html += 
                    '<div id="title">'+
                        '<h3 class="title" >OOPS! Sorry for you, Can you tell me more ?</h3>'+

                    '</div>'+

                    '<div style="display: flex;justify-content: center;">'+
                        '<div style="margin-bottom: 30px;" class="choice_style" id="Wrong" onclick="customer_choice(\'Wrong\')">'+
                            '<h6 class="choice" >You recevied a Wrong item </h6>'+
                        '</div>'+
                    '</div>'+
                    '<div style="display: flex;justify-content: center;">'+
                        '<div style="margin-bottom: 30px;" class="choice_style" id="Missing" onclick="customer_choice(\'Missing\')">'+
                            '<h6 class="choice" >There is a Missing item </h6>'+
                        '</div>'+
                    '</div>'+
                    '<div style="display: flex;justify-content: center;">'+
                        '<div style="margin-bottom: 30px;" class="choice_style" id="Damaged" onclick="customer_choice(\'Damaged\')">'+
                            '<h6 class="choice" >There is a Damaged item</h6>'+
                        '</div>'+
                    '</div>'+
                    '<div style="display: flex;justify-content: flex-end;"> <div class="move_forward" onclick="customer_choice(\'something_wrong\')">'+
                        '<i style="color: black;" class="fas fa-arrow-right"></i> </div>'+
                    '</div>';

            $("#content").html(html);

        } else if (type == 'verification') {

            html = '';
            /* nouro */
            html +=
                '<div >' +
                '<h3 class="title sub_long_title" >Please type your order reference and we will send you a new verification email, and the previous email will be invalid.</h3>' +

                '</div>' +

                '<div  id="app" class="input_width" >' +
                '<div  class="input_height">' +
                '<div id="inp-cover"><input style="width: 100%;" id="order_number" class="order_number_input" type="text" name="query"' +
                'placeholder="Type your order reference..." autocomplete="off"></div>' +

                '<div><button onclick="send_verification_mail(this)" type="submit" class="order_number_button shadow"><i class="fas fa-paper-plane email_icon"></i></button></div>' +
                '</div>' +

                '</div>';

            $("#content").html(html);
        } else if (type == 'order_details') {
            
            html = '';
            /* nouro */
            html +=
                '<div >' +
                '<h3 class="title" >Please type your order reference, and we will send you an email with the order summary.</h3>' +

                '</div>' +

                '<div  id="app" class="input_width">' +
                '<div class="input_height">' +
                '<div id="inp-cover"><input style="width: 100%" id="order_reference" class="order_number_input" type="text" name="query"' +
                'placeholder="Type your order reference..." autocomplete="off"></div>' +

                '<div><button onclick="send_details_mail(this)" type="submit" class="order_number_button shadow"><i class="fas fa-paper-plane email_icon"></i></button></div>' +
                '</div>' +

                '</div>';

            $("#content").html(html);

        } else if (type == 'tracking') {
            /* nouro */
            html = '';

            html +=
                '<div >' +
                '<h3 style="font-size: 1.4rem;" class="title" >' +

                'If you have the tracking number of your order that starts with ( K ),<br> For example :  K*******<br><br>' +

                'Please visit <a href="https://kshopinaexpress.com/" target="blank">this link</a> and search by your number to know the latest update on your order.<br><br>' +

                'In case you do not have the tracking number, please insert your order reference that consists of 5 digits here.</h3>' +

                '</div>' +

                '<div  id="app" class="input_width">' +
                '<div class="input_height">' +
                '<div style="width: 100%;" id="inp-cover"><input id="order_reference_tracking"  style="width:100%" class="order_number_input" type="text" name="query"' +
                'placeholder="Type your order reference..." autocomplete="off"></div>' +

                '<div><button onclick="send_tracking_mail(this)" type="submit" class="order_number_button  shadow"><i class="fas fa-paper-plane email_icon"></i></button></div>' +
                '</div>' +

                '</div>';

            $("#content").html(html);

        } else if (type == 'reschedule') {
            /* nouro */
            html = '';

            html += '<div >' +
                '<h3 style="font-size: 1.4rem;" class="title" >' +

                'In the case of postponing the delivery date for a week, there will be no additional fees,<br>' +
                'but if the period is more than a week, an additional fee will be applied for keeping the order at the warehouse </h3>' +

                '</div>' +

                '<div id="app" class=" input_width_calender" >' +
                '<div class="input_height_calender">' +
                '<div style="align-items: center;" class="row" id="inp-cover">' +
                ' <i style="color: #1b3425;margin-right: 15px;" class="fas fa-hashtag order_hashtag"></i>' +
                '<input style="padding-right: 30px;" id="order_reference_reschedule" class="order_number_input_calender" type="text" name="query"' +
                ' placeholder="Type your order reference..." autocomplete="off" required>' +
                ' <div  class="row calender_row">' +
                '<i  class="far fa-calendar-alt calender_icon"></i>' +

                '<input id="reschedule_date" class="calender"  type="date" min="{{ date('Y-m-d', time()) }}" required>' +

                '</div>' +
                ' </div>' +

                '<div><button onclick="reschedule(this)" type="submit" class="order_number_button order_number_calender shadow"><i class="fas fa-paper-plane email_calender_icon"></i></button></div>' +
                '</div>' +

                '</div>';

            $("#content").html(html);

        } else if (type == 'lmd') {

            html = '';
            /* nouro */
            html +=
                '<div>' +
                '<h3 class="title" >Please be noted that we deliver during the weekdays only and Fridays and Saturdays are off.</h3>' +
                '</div>' +
                
                '<label style="color: #1b3425;display: flex;font-weight: 600;font-size: 17px;margin-left: 10px;margin-bottom: 10px;"  for="order_number"> Order number</label>' +

                '<div  class="col first_form_input_first">' +
                '<div style="margin: 0px;width: 100%;" id="app">' +
                '<div class="input_height">' +
                '<div style="align-items: center;right: 0;" class="row" id="inp-cover">' +
                '<i style="color: #1b3425;margin-right: 15px;" class="fas fa-hashtag order_hashtag"></i>' +
                '<input style="width: 90%;" id="order_reference_lmd" class="order_number_input_first_form" type="text" name="query"' +
                'placeholder="Type your order reference..." autocomplete="off" required>' +
                '</div>' +
                '</div>' +

                '</div>' +
                '</div>' +
                '<label style="margin-top: 3vw;color: #1b3425;display: flex;font-weight: 600;font-size: 17px;margin-left: 10px;margin-bottom: 10px;" for="message"> Message</label>' +

                '<div  class="first_form_input_text">' +
                '<textarea name="notes" id="notes_lmd" cols="74" rows="5" style="resize: none;padding: 20px;box-shadow: 0 10px 30px #c7c7c7;border: 0.5px solid #1b3425;border-radius: 8px;width: 100%;" required></textarea>' +
                '</div>' +

                ' <div class="form_button">' +
                '<button onclick="lmd_or_late(this)" type="submit" name="create_group_order" id="group_order_submit"' +
                'style="margin-top: 3rem;margin-right: 1rem;height: 80%;border-radius: 15px;font-family: \'Bebas Neue\', cursive;font-size: 17px;letter-spacing: 2px;font-weight: 600;padding: 10px 40px 8px 40px;"' +
                'class="btn btn-primary"> Submit' +
                '</button>' +
                '</div>';

            $("#content").html(html);
        } else if (type == 'other') {

            html = '';
            /* nouro */
            html +=
                '<div>' +
                '<h3 class="title" >Hello dear customer , ' +
                ' I hope you are doing great! <br>' +
                'Please tell me how I can help you today.</h3>' +
                '</div>' +

                '<label style="color: #1b3425;display: flex;font-weight: 600;font-size: 17px;margin-left: 10px;margin-bottom: 10px;" for="order_number"> Order number</label>' +

                '<div class="col first_form_input_first">' +
                '<div style="margin: 0px;width: 100%;" id="app">' +
                '<div  class="input_height">' +
                '<div style="align-items: center;right: 0;" class="row" id="inp-cover">' +
                '<i style="color: #1b3425;margin-right: 15px;" class="fas fa-hashtag order_hashtag"></i>' +
                '<input style="width: 90%;" id="order_reference_others" class="order_number_input_first_form" type="text" name="query"' +
                'placeholder="Type your order reference..." autocomplete="off" required>' +
                '</div>' +
                '</div>' +

                '</div>' +
                '</div>' +
                '<label style="margin-top: 3vw;color: #1b3425;display: flex;font-weight: 600;font-size: 17px;margin-left: 10px;margin-bottom: 10px;" for="message"> Message</label>' +

                '<div class="first_form_input_text">' +
                '<textarea name="notes" id="notes_others" cols="74" rows="5" style="resize: none;padding: 20px;box-shadow: 0 10px 30px #c7c7c7;border: 0.5px solid #1b3425;border-radius: 8px;width: 100%;" required></textarea>' +
                '</div>' +

                ' <div class="form_button">' +
                '<button onclick="customer_others(this)" type="submit"  name="create_group_order" id="group_order_submit"' +
                'style="margin-top: 3rem;margin-right: 1rem;height: 80%;border-radius: 15px;font-family: \'Bebas Neue\', cursive;font-size: 17px;letter-spacing: 2px;font-weight: 600;padding: 10px 40px 8px 40px;"' +
                'class="btn btn-primary"> Submit' +
                '</button>' +
                '</div>';

            $("#content").html(html);

        } else if (type == 'Wrong') {

            document.getElementById("Wrong").classList.toggle('choice_clicked');

            if (choices['Wrong']==0) {
                choices['Wrong']=1;
            }else{
                choices['Wrong']=0;
            }
            /* html = '';
            html +=
                '<div >' +
                '<h3 class="title sub_long_title" >Please type your order reference and we will send you an email to contact the CS team</h3>' +

                '</div>' +

                '<div  id="app" class="input_width" >' +
                '<div  class="input_height">' +
                '<div id="inp-cover"><input style="width: 100%;" id="order_number" class="order_number_input" type="text" name="query"' +
                'placeholder="Type your order reference..." autocomplete="off"></div>' +

                '<div><button onclick="send_something_wrong_mail(this,\'Wrong-item\')" type="submit" class="order_number_button shadow"><i class="fas fa-paper-plane email_icon"></i></button></div>' +
                '</div>' +

                '</div>';

            $("#content").html(html); */

            /* html = '';

            html +=
                '<div> <h3 style="text-align: left;margin-bottom: 0px;font-size: 1.4rem;" class="title" >' +
                '<div style="font-weight: 900;">Hello dear customer</div><br><br>' +
                'We apologize for what happened.<br>' +
                'Please follow these steps to help you better and faster:<br><br>' +
                '<div style="margin-left: 30px;"> 1- Take an unboxing video showing the condition of the whole order.<br>' +
                '2- A picture of the order.<br>' +
                '3- A picture of the invoice that comes attached to the package.</div><br><br>' +
                'Then send the requirements to the following WhatsApp number : ' +
                ' <span style="color: #cb9c47;">+201159528023</span> <br>' +
                'We will be following up with the case over WhatsApp.' +
                '</h3>' +

                '</div>';



            $("#content").html(html); */

        } else if (type == 'Missing') {

            document.getElementById("Missing").classList.toggle('choice_clicked');
            
            if (choices['Missing']==0) {
                choices['Missing']=1;
            }else{
                choices['Missing']=0;
            }
            /* html = '';
            html +=
                '<div >' +
                '<h3 class="title sub_long_title" >Please type your order reference and we will send you an email to contact the CS team</h3>' +

                '</div>' +

                '<div  id="app" class="input_width" >' +
                '<div  class="input_height">' +
                '<div id="inp-cover"><input style="width: 100%;" id="order_number" class="order_number_input" type="text" name="query"' +
                'placeholder="Type your order reference..." autocomplete="off"></div>' +

                '<div><button onclick="send_something_wrong_mail(this,\'Missing-item\')" type="submit" class="order_number_button shadow"><i class="fas fa-paper-plane email_icon"></i></button></div>' +
                '</div>' +

                '</div>';

            $("#content").html(html); */

        } else if (type == 'Damaged') {

            document.getElementById("Damaged").classList.toggle('choice_clicked');

            if (choices['Damaged']==0) {
                choices['Damaged']=1;
            }else{
                choices['Damaged']=0;
            }
            
        } else if (type == 'something_wrong'){
            html = '';
            
            html +=
                '<div >' +
                '<h3 class="title sub_long_title" >Please type your order reference and we will send you an email to contact the CS team</h3>' +

                '</div>' +

                '<div  id="app" class="input_width" >' +
                '<div  class="input_height">' +
                '<div id="inp-cover"><input style="width: 100%;" id="order_number" class="order_number_input" type="text" name="query"' +
                'placeholder="Type your order reference..." autocomplete="off"></div>' +

                '<div><button onclick="send_something_wrong_mail(this)" type="submit" class="order_number_button shadow"><i class="fas fa-paper-plane email_icon"></i></button></div>' +
                '</div>' +

                '</div>';

            $("#content").html(html);
        }
    }

    function guest_choice(type) {

        if (type == 'ask_about_product') {

            html = '';

            html +=

                    '<div>'+
                    '    <h3 class="title">Please leave your question and one of our CS agent will reply back to you via email.</h3>'+
                    '</div>'+

                    '<form action="ask_about_product" method="post" onsubmit="submit_form(\'submit_button\')" style="width: 100%;" class="form_minimize">'+
                    '    @csrf'+

                    '    <div style="margin-bottom: 30px;" class="row">'+

                    '        <div style="width: 45%;" class="col-lg-6 col-md-6 col-sm-6 col-xs-6" >'+
                    '            <label'+
                    '                 class="second_form_title"'+
                    '                for="name"> Name</label>'+

                    '            <div style="display: flex;justify-content: flex-start;width:100%;" class="col">'+
                    '                <div style="margin: 0px;width: 100%;box-shadow: 0 0px 5px #c7c7c7" id="app">'+
                    '                    <div  class="second_input_height">'+
                    '                        <div style="align-items: center;right: 0;" class="row" id="inp-cover">'+
                    '                            <i  '+
                    '                                class="fas fa-user second_form_icon"></i>'+
                    '                            <input  id="name_ask_product"'+
                    '                                class="second_form_input" type="text" name="user_name"'+
                    '                                placeholder="Type your name..." autocomplete="off" required>'+
                    '                        </div>'+
                    '                    </div>'+

                    '                </div>'+
                    '            </div>'+
                    '        </div>'+

                    '        <div style="width: 45%;" class="col-lg-6 col-md-6 col-sm-6 col-xs-6">'+
                    '            <label'+
                    '                class="second_form_title"'+
                    '                for="Email"> Email</label>'+

                    '            <div style="display: flex;justify-content: flex-start;width:100%;" class="col">'+
                    '                <div style="margin: 0px;width: 100%;box-shadow: 0 0px 5px #c7c7c7;" id="app">'+
                    '                    <div  class="second_input_height">'+
                    '                        <div style="align-items: center;right: 0;" class="row" id="inp-cover">'+
                    '                            <i  '+
                    '                                class="fas fa-envelope second_form_icon"></i>'+
                    '                            <input  id="email_ask_product"'+
                    '                                class=" second_form_input " type="email" name="email"'+
                    '                                placeholder="Type your email..." autocomplete="off" required>'+
                    '                        </div>'+
                    '                    </div>'+

                    '                </div>'+
                    '            </div>'+
                    '        </div>'+
                    '    </div>'+

                    '    <div class="row">'+

                    '        <div style="width: 45%;" class="col-lg-6 col-md-6 col-sm-6 col-xs-6">'+
                    '            <label'+
                    '                class="second_form_title"'+
                    '                for="phone_number"> Phone number</label>'+

                    '            <div style="display: flex;justify-content: flex-start;width:100%;" class="col">'+
                    '                <div style="margin: 0px;width: 100%;box-shadow: 0 0px 5px #c7c7c7;" id="app">'+
                    '                    <div  class="second_input_height">'+
                    '                        <div style="align-items: center;right: 0;" class="row" id="inp-cover">'+
                    '                            <i '+
                    '                                class="fab fa-whatsapp second_form_icon"></i>'+
                    '                            <input  id="phone_ask_product"'+
                    '                                class="second_form_input" type="number" name="phone_number"'+
                    '                                placeholder="Type your phone number..." autocomplete="off" required>'+
                    '                        </div>'+
                    '                    </div>'+

                    '                </div>'+
                    '            </div>'+
                    '        </div>'+

                    '        <div style="width: 45%;" class="col-lg-6 col-md-6 col-sm-6 col-xs-6">'+
                    '            <label'+
                    '                class="second_form_title"'+
                    '                for="country"> Country</label>'+

                    '            <div style="display: flex;justify-content: flex-start;width:100%;" class="col">'+
                    '                <div style="margin: 0px;width: 100%;box-shadow: 0 0px 5px #c7c7c7;" id="app">'+
                    '                    <div  class="second_input_height">'+
                    '                        <div style="align-items: center;right: 0;" class="row" id="inp-cover">'+
                    '                            <i '+
                    '                                class="fas fa-globe second_form_icon"></i>'+
                    '                            <select  name="country" id="ask_product"'+
                    '                                class="second_form_input thick" placeholder="Country">'+
                    '                                <option value="" selected disabled hidden>Country</option>'+
                    '                                <option value="Egypt">Egypt</option>'+
                    '                                <option value="Kuwait">Kuwait</option>'+
                    '                                <option value="Saudi Arabia">Saudi Arabia</option>'+
                    '                                <option value="United Arab Emirates">United Arab Emirates</option>'+
                    '                                <option value="Oman">Oman</option>'+
                    '                                <option value="Jordon">Jordon</option>'+
                    '                                <option value="Bahrain">Bahrain</option>'+
                    '                                <option value="Qatar">Qatar</option>'+
                    '                                <option value="Others">Others</option>'+

                    '                            </select required>'+
                    '                        </div>'+
                    '                    </div>'+

                    '                </div>'+
                    '            </div>'+
                    '        </div>'+
                    '    </div>'+

                    '    <label'+
                    '        style="margin-top: 3vw;"  class="second_form_title"'+
                    '        for="message"> Message</label>'+

                    '    <div class="first_form_input_text small_first_form_input_text">'+
                    '        <textarea name="notes_ask_product" id="notes" cols="74" rows="5"'+
                    '            style="resize: none;padding: 20px;box-shadow: 0 10px 30px #c7c7c7;border: 0.5px solid #1b3425;border-radius: 8px;width: 100%;"required ></textarea>'+
                    '    </div>'+

                    '    <div id="submit_button" class="form_button">'+
                    '        <button type="submit" name="ask_product" id="group_order_submit"'+
                    '            style="margin-top: 3rem;margin-right: 1rem;height: 80%;border-radius: 15px;font-family: \'Bebas Neue\', cursive;font-size: 17px;letter-spacing: 2px;font-weight: 600;padding: 10px 40px 8px 40px;"'+
                    '            class="btn btn-primary"> Submit'+
                    '        </button>'+
                    '    </div>'+
                    '</form>';
           /*  html +=
                '<div>' +
                '<h3 class="title" >Ask your question ?</h3>' +
                '</div>' +

                '<label style="margin-top: 3vw;color: #1b3425;display: flex;font-weight: 600;font-size: 17px;margin-left: 10px;margin-bottom: 10px;" for="message"> Message</label>' +

                '<div style="width: 35vw;height: 7rem;display: flex;justify-content: flex-start;">' +
                '<textarea name="notes" id="notes" cols="74" rows="5" style="resize: none;padding: 20px;box-shadow: 0 10px 30px #c7c7c7;border: 0.5px solid #1b3425;border-radius: 8px;width: 100%;"></textarea>' +
                '</div>' +

                ' <div style="display: flex;flex-wrap: wrap;justify-content: flex-end;margin: 15px 0 12px 0;">' +
                '<button type="submit"  name="create_group_order" id="group_order_submit"' +
                'style="margin-top: 3rem;margin-right: 1rem;height: 80%;border-radius: 15px;font-family: \'Bebas Neue\', cursive;font-size: 17px;letter-spacing: 2px;font-weight: 600;padding: 10px 40px 8px 40px;"' +
                'class="btn btn-primary"> Submit' +
                '</button>' +
                '</div>'; */

            $("#content").html(html);
        } else if (type == 'final_price') {

            html = '';

            html +=
                '<div>' +
                '<h3 style="text-align: left;margin-bottom: 0px;font-size: 1.4rem;" class="title" >' +
                '<div style="font-weight: 900;">Hello dear customer 💞</div><br><br>' +
                'You can know the final prices of our products including the international shipping and customs through our website,' +
                'before completing your purchase and after adding your address information.<br>' +

                '</h3>' +

                '</div>' +

                '<div style="width: 100%;display: flex;justify-content: end;margin-top: 60px;align-items: center; ">' +
                '<h6 class="title" style="text-align: left;margin-bottom: 0px;font-size: 1.2rem;width: 100%;">' +
                'After adding the item to the cart, you have to fill in your address information. </h6>' +
                '<img style="width: 15vw;" src="{{ asset('final_price1.jpeg') }}" alt=""> ' +
                '</div>' +
                '<div style="direction: rtl;width: 100%;display: flex;justify-content: end;margin-top: 60px;align-items: center;">' +
                '<h6 class="title" style="text-align: right;margin-bottom: 0px;font-size: 1.2rem;width: 100%;">' +
                ' Then you can check the final price including the shipping and customs </h6>' +
                '<img style="width: 15vw;" src="{{ asset('final_price2.jpeg') }}" alt=""> ' +
                '</div>';



            $("#content").html(html);

        } else if(type == 'discount_codes'){

            html ='';

            $.ajax({
            url: "/dicount_codes",
            type: "get",
            data: {
                _token: "{{ csrf_token() }}"
                
            },
            success: function(response) {
                console.log(response);

                html += '<h3 style="text-align: center;font-size: 1.4rem;margin-bottom: 3rem;" class="title" >'+
                                '<div style="font-weight: 900;">Discount Codes</div>'+
                            '</h3>'+
                            '<div style="display: flex;justify-content: space-around;padding-left: 55px;" class="row">';
                                
                response.forEach(element => {
                    html += 
                             
                                '<div style=" background-color:' + colors[element['discount_percent']] + '; " class="discount_button  disc_but_style col-lg-4 col-md-4 col-sm-4 col-xs-4 " >'+
                                    '<h6   class="disc_but_code">' + element['discount_code'] + ' </h6>'+
                                    '<h3 class="disc_but_num" ><span style="margin-right: -5px;font-size: larger;">-</span> ' + element['discount_percent'] + ' <span style="margin-left: -5px;">%</span> </h3>'+
                                '</div>';  
                            
                });
                html += '</div>';


                $("#content").html(html);

            },
            error: function(xhr) {
                //Do Something to handle error
            }

            });


        }else if(type == 'availability'){

            html ='';

            $.ajax({
            url: "/services_payments",
            type: "get",
            data: {
                _token: "{{ csrf_token() }}"
                
            },
            success: function(response) {
                console.log(response);

                
                html += '<div style="display: flex;justify-content: space-around;">'+
                            '<h3 style="text-align: center;margin-bottom: 0px;font-size: 1.4rem;" class="title" >Country</h3>'+
                            '<h3 style="text-align: center;margin-bottom: 0px;font-size: 1.4rem;width: 5rem;" class="title" >Visa</h3>'+
                            '<h3 style="text-align: center;margin-bottom: 0px;font-size: 1.4rem;width: 5rem;" class="title" >COD</h3>'+
                        '</div> <hr>' ;
                                
                response.forEach(element => {
                    html += 
                    '<div style="display: flex;justify-content: space-around;margin-top: 3rem;">'+
                        '<h3 style="text-align: center;margin-bottom: 0px;font-size: 1.4rem;width: 5rem;" class="title" >' + element['country'] + '</h3>';

                    if (element['pre_paid'] == 1 ) {
                        html += 
                        '<h3 style="text-align: center;margin-bottom: 0px;font-size: 1.4rem;width: 5rem;" class="title" >'+
                            '<i class="fas fa-check" style="color: #46d986;"></i>'+
                        '</h3>';
                    } else {
                        html += 
                        '<h3 style="text-align: center;margin-bottom: 0px;font-size: 1.4rem;width: 5rem;" class="title" >'+
                            '<i class="fas fa-times" style="color: #f11b1b;"></i>'+
                        '</h3>';
                        
                    }
                    
                    if (element['cod'] == 1 ) {
                        html += 
                        '<h3 style="text-align: center;margin-bottom: 0px;font-size: 1.4rem;width: 5rem;" class="title" >'+
                            '<i class="fas fa-check" style="color: #46d986;"></i>'+
                        '</h3>';
                    } else {
                        html += 
                        '<h3 style="text-align: center;margin-bottom: 0px;font-size: 1.4rem;width: 5rem;" class="title" >'+
                            '<i class="fas fa-times" style="color: #f11b1b;"></i>'+
                        '</h3>';
                    }

                    html += '</div>';
                            
                });
                html += '<div style="display: flex;justify-content: space-around;margin-top: 3rem;">'+
                            '<h3 style="text-align: center;margin-bottom: 0px;font-size: 1.4rem;width: 5rem;" class="title" >Others</h3>'+
                            '<h3 style="text-align: center;margin-bottom: 0px;font-size: 1.4rem;width: 5rem;" class="title" >'+
                                '<i class="fas fa-check" style="color: #46d986;"></i>'+
                            '</h3>' +
                            '<h3 style="text-align: center;margin-bottom: 0px;font-size: 1.4rem;width: 5rem;" class="title" >'+
                                '<i class="fas fa-times" style="color: #f11b1b;"></i>'+
                            '</h3>'+
                        '</div>';

                $("#content").html(html);


                
                
                   
            

            },
            error: function(xhr) {
                //Do Something to handle error
            }

            });
        } else if (type == 'collabrations') {

            html = '';

            html +=
                '<div>' +
                '<h3 style="text-align: left;margin-bottom: 0px;font-size: 1.4rem;" class="title" >' +
                '<div style="font-weight: 900;">Thank you for contacting KSHOPINA 💕</div><br><br>' +
                '<div style="margin-left: 25px;">Regarding your inquiry about the possibility of collaboration with KSHOPINA , please send an e-mail to the following:<br><br>' +
                '<span style="color: #cb9c47;">Info@kshopina.com</span><br><br>' +
                'With writing the subject of the mail (Collaboration), clarifying the points of collaboration and what you expect from ' +
                'KSHOPINA in thid regard.</div>' +

                '</h3>' +

                '</div>';



            $("#content").html(html);
        } else if (type == 'others') {

            html = '';

            html +=

                    '<div>'+
                        '<h3 class="title" >Hello dear customer , ' +
                        ' I hope you are doing great! <br>' +
                        'Please tell me how I can help you today.</h3>' +
                        '</div>' +

                    '<form action="guest_others" method="post" onsubmit="submit_form(\'submit_others_button\')" style="width: 100%;" class="form_minimize">'+
                    '    @csrf'+
                    '    <div style="margin-bottom: 30px;" class="row">'+

                    '        <div style="width: 45%;" class="col-lg-6 col-md-6 col-sm-6 col-xs-6">'+
                    '            <label'+
                    '                class="second_form_title"'+
                    '                for="name"> Name</label>'+

                    '            <div style="display: flex;justify-content: flex-start;width:100%;" class="col">'+
                    '                <div style="margin: 0px;width: 100%;box-shadow: 0 0px 5px #c7c7c7" id="app">'+
                    '                    <div  class="second_input_height">'+
                    '                        <div style="align-items: center;right: 0;" class="row" id="inp-cover">'+
                    '                            <i '+
                    '                                class="fas fa-user second_form_icon"></i>'+
                    '                            <input  id="name_other"'+
                    '                                class="second_form_input" type="text" name="user_name"'+
                    '                                placeholder="Type your name..." autocomplete="off" required>'+
                    '                        </div>'+
                    '                    </div>'+

                    '                </div>'+
                    '            </div>'+
                    '        </div>'+

                    '        <div style="width: 45%;" class="col-lg-6 col-md-6 col-sm-6 col-xs-6">'+
                    '            <label'+
                    '                class="second_form_title"'+
                    '                for="Email"> Email</label>'+

                    '            <div style="display: flex;justify-content: flex-start;width:100%;" class="col">'+
                    '                <div style="margin: 0px;width: 100%;box-shadow: 0 0px 5px #c7c7c7;" id="app">'+
                    '                    <div  class="second_input_height">'+
                    '                        <div style="align-items: center;right: 0;" class="row" id="inp-cover">'+
                    '                            <i '+
                    '                                class="fas fa-envelope second_form_icon"></i>'+
                    '                            <input  id="email_other"'+
                    '                                class="second_form_input" type="email" name="email"'+
                    '                                placeholder="Type your email..." autocomplete="off" required>'+
                    '                        </div>'+
                    '                    </div>'+

                    '                </div>'+
                    '            </div>'+
                    '        </div>'+
                    '    </div>'+

                    '    <div class="row">'+

                    '        <div style="width: 45%;" class="col-lg-6 col-md-6 col-sm-6 col-xs-6">'+
                    '            <label'+
                    '                class="second_form_title"'+
                    '                for="phone_number"> Phone number</label>'+

                    '            <div style="display: flex;justify-content: flex-start;width:100%;" class="col">'+
                    '                <div style="margin: 0px;width: 100%;box-shadow: 0 0px 5px #c7c7c7;" id="app">'+
                    '                    <div  class="second_input_height">'+
                    '                        <div style="align-items: center;right: 0;" class="row" id="inp-cover">'+
                    '                            <i '+
                    '                                class="fab fa-whatsapp second_form_icon"></i>'+
                    '                            <input  id="phone_other"'+
                    '                                class="second_form_input" type="number" name="phone_number"'+
                    '                                placeholder="Type your phone number..." autocomplete="off" required>'+
                    '                        </div>'+
                    '                    </div>'+

                    '                </div>'+
                    '            </div>'+
                    '        </div>'+

                    '        <div style="width: 45%;" class="col-lg-6 col-md-6 col-sm-6 col-xs-6">'+
                    '            <label'+
                    '                class="second_form_title"'+
                    '                for="country"> Country</label>'+

                    '            <div style="display: flex;justify-content: flex-start;width:100%;" class="col">'+
                    '                <div style="margin: 0px;width: 100%;box-shadow: 0 0px 5px #c7c7c7;" id="app">'+
                    '                    <div  class="second_input_height">'+
                    '                        <div style="align-items: center;right: 0;" class="row" id="inp-cover">'+
                    '                            <i '+
                    '                                class="fas fa-globe second_form_icon"></i>'+
                    '                            <select  name="country" id="formOrder"'+
                    '                                class="second_form_input thick" placeholder="Country">'+
                    '                                <option value="" selected disabled hidden>Country</option>'+
                    '                                <option value="Egypt">Egypt</option>'+
                    '                                <option value="Kuwait">Kuwait</option>'+
                    '                                <option value="Saudi Arabia">Saudi Arabia</option>'+
                    '                                <option value="United Arab Emirates">United Arab Emirates</option>'+
                    '                                <option value="Oman">Oman</option>'+
                    '                                <option value="Jordon">Jordon</option>'+
                    '                                <option value="Bahrain">Bahrain</option>'+
                    '                                <option value="Qatar">Qatar</option>'+
                    '                                <option value="Qatar">Other</option>'+

                    '                            </select required>'+
                    '                        </div>'+
                    '                    </div>'+

                    '                </div>'+
                    '            </div>'+
                    '        </div>'+
                    '    </div>'+

                    '    <label'+
                    '        style="margin-top: 3vw;" class="second_form_title"'+
                    '        for="message"> Message</label>'+

                    '    <div class="first_form_input_text small_first_form_input_text">'+
                    '        <textarea name="notes" id="notes" cols="74" rows="5"'+
                    '            style="resize: none;padding: 20px;box-shadow: 0 10px 30px #c7c7c7;border: 0.5px solid #1b3425;border-radius: 8px;width: 100%;"required ></textarea>'+
                    '    </div>'+

                    '    <div id="submit_others_button" class="form_button">'+
                    '        <button type="submit" name="other" id="group_order_submit"'+
                    '            style="margin-top: 3rem;margin-right: 1rem;height: 80%;border-radius: 15px;font-family: \'Bebas Neue\', cursive;font-size: 17px;letter-spacing: 2px;font-weight: 600;padding: 10px 40px 8px 40px;"'+
                    '            class="btn btn-primary"> Submit'+
                    '        </button>'+
                    '    </div>'+
                    '</form>';


                /* '<div>' +
                '<h3 class="title" >Hello dear customer , ' +
                ' Hope you are doing great! <br>' +
                'Please tell us how can we help you today ?</h3>' +
                '</div>' +

                '<label style="margin-top: 3vw;color: #1b3425;display: flex;font-weight: 600;font-size: 17px;margin-left: 10px;margin-bottom: 10px;" for="message"> Message</label>' +

                '<div style="width: 35vw;height: 7rem;display: flex;justify-content: flex-start;">' +
                '<textarea name="notes" id="notes" cols="74" rows="5" style="resize: none;padding: 20px;box-shadow: 0 10px 30px #c7c7c7;border: 0.5px solid #1b3425;border-radius: 8px;width: 100%;"></textarea>' +
                '</div>' +

                ' <div style="display: flex;flex-wrap: wrap;justify-content: flex-end;margin: 15px 0 12px 0;">' +
                '<button type="submit"  name="create_group_order" id="group_order_submit"' +
                'style="margin-top: 3rem;margin-right: 1rem;height: 80%;border-radius: 15px;font-family: \'Bebas Neue\', cursive;font-size: 17px;letter-spacing: 2px;font-weight: 600;padding: 10px 40px 8px 40px;"' +
                'class="btn btn-primary"> Submit' +
                '</button>' +
                '</div>'; */

            $("#content").html(html);

        }


    }

    function send_something_wrong_mail(element,type){

        var order_number = $('#order_number').val();

        var e = element.parentElement;
        $(element.parentElement).html('<div class="order_number_button"><div class="loader"></div></div>');


        $.ajax({
            url: "send_something_wrong_mail",
            type: "post",
            data: {
                _token: "{{ csrf_token() }}",
                order: order_number,
                type:choices
            },
            success: function(response) {
                console.log(response);

                if (!response[0]) {
                    Swal.fire({
                        position: 'center',
                        icon: 'error',
                        title: response[1],
                        showConfirmButton: false,
                        timer: 2500
                    });
                    /* $(e).html(
                        '<button onclick="send_details_mail(this)" type="submit" class="order_number_button shadow"><i class="fas fa-paper-plane"></i></button>'
                        ); */
                } else {
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: response[1],
                        showConfirmButton: false,
                        timer: 2500
                    });
                    /* $('#app').addClass('no_shadow');

                    $('#app').html('<span style="color: #cd9c44;font-size: 2.5vw;padding: 15px;font-family: \'Caveat\', cursive;font-weight: 900;">Mail has been sent , Thank you</span>'
                                            ); */

                }

            },
            error: function(xhr) {
                //Do Something to handle error
            }

        });

    }
    function send_verification_mail(element) {

        var order_number = $('#order_number').val();

        var e = element.parentElement;
        $(element.parentElement).html('<div class="order_number_button"><div class="loader"></div></div>');


        $.ajax({
            url: "send_first_mail_again",
            type: "post",
            data: {
                _token: "{{ csrf_token() }}",
                order: order_number,
            },
            success: function(response) {
                console.log(response);

                if (response == 'Too late!, Order already on process') {

                    Swal.fire({
                        position: 'center',
                        icon: 'error',
                        title:'Too late!, Order already on process',
                        text: 'But if you want to proceed with the cancellation request, we will check with the responsible team.',
                        showCancelButton: true,
                        confirmButtonText: 'Send request',
                        confirmButtonColor: '#cda051',
                    }).then((result) => {
                        if (result.isConfirmed) {

                            $.ajax({
                                url: "request_to_cancel_order",
                                type: "post",
                                data: {
                                    _token: "{{ csrf_token() }}",
                                    order: order_number,
                                },
                                success: function(response) {
                                    if (response=='success') {
                                        Swal.fire({
                                        position: 'center',
                                        icon:'success',
                                        title:'Submited!',
                                        text:'Your request has been submited.',
                                        showConfirmButton: false,
                                        timer: 2500
                                        });
                                        $('#app').addClass('no_shadow');

                                        $('#app').html(
                                                '<span style="color: #cd9c44;font-size: 2.5vw;padding: 15px;font-family: \'Caveat\', cursive;font-weight: 900;">Thank you, Please check your email to follow up</span>'
                                                );
                                    } else {
                                        Swal.fire({
                                        position: 'center',
                                        icon:'error',
                                        title:'OOPS!',
                                        text: response,
                                        showConfirmButton: false,
                                        timer: 2500
                                        });

                                        $(e).html(
                                            '<button onclick="send_verification_mail(this)" type="submit" class="order_number_button shadow"><i class="fas fa-paper-plane"></i></button>'
                                            );

                                    }
                                    
                                },
                                error: function(xhr) {
                                    //Do Something to handle error
                                }

                            });
                        }
                        else{
                            $(e).html(
                                            '<button onclick="send_verification_mail(this)" type="submit" class="order_number_button shadow"><i class="fas fa-paper-plane"></i></button>'
                                            );
                        }
                    });

                }
                else if (response != 'Success') {
                    Swal.fire({
                        position: 'center',
                        icon: 'error',
                        title: response,
                        showConfirmButton: false,
                        timer: 2500
                    });
                    $(e).html(
                        '<button onclick="send_verification_mail(this)" type="submit" class="order_number_button shadow"><i class="fas fa-paper-plane"></i></button>'
                        );
                } else {
                    $('#app').addClass('no_shadow');

                    $('#app').html('<span style="color: #cd9c44;font-size: 2.5vw;padding: 15px;font-family: \'Caveat\', cursive;font-weight: 900;">Mail has been sent , Thank you</span>'
                                            );

                }

            },
            error: function(xhr) {
                //Do Something to handle error
            }

        });
    }

    function send_details_mail(element) {
        var order_number = $('#order_reference').val();

        var e = element.parentElement;
        $(element.parentElement).html('<div class="order_number_button"><div class="loader"></div></div>');


        $.ajax({
            url: "send_details_mail",
            type: "post",
            data: {
                _token: "{{ csrf_token() }}",
                order: order_number,
            },
            success: function(response) {
                console.log(response);

                if (response != 'Success') {
                    Swal.fire({
                        position: 'center',
                        icon: 'error',
                        title: response,
                        showConfirmButton: false,
                        timer: 2500
                    });
                    $(e).html(
                        '<button onclick="send_details_mail(this)" type="submit" class="order_number_button shadow"><i class="fas fa-paper-plane"></i></button>'
                        );
                } else {
                    $('#app').addClass('no_shadow');

                    $('#app').html('<span style="color: #cd9c44;font-size: 2.5vw;padding: 15px;font-family: \'Caveat\', cursive;font-weight: 900;">Mail has been sent , Thank you</span>'
                                            );

                }

            },
            error: function(xhr) {
                //Do Something to handle error
            }

        });


    }

    function send_tracking_mail(element) {

        var order_number = $('#order_reference_tracking').val();

        var e = element.parentElement;
        $(element.parentElement).html('<div class="order_number_button"><div class="loader"></div></div>');


        $.ajax({
            url: "send_tracking_mail",
            type: "post",
            data: {
                _token: "{{ csrf_token() }}",
                order: order_number,
            },
            success: function(response) {
                console.log(response);

                if (response != 'Success') {
                    Swal.fire({
                        position: 'center',
                        icon: 'error',
                        title: response,
                        showConfirmButton: false,
                        timer: 2500
                    });
                    $(e).html(
                        '<button onclick="send_tracking_mail(this)" type="submit" class="order_number_button shadow"><i class="fas fa-paper-plane"></i></button>'
                        );
                } else {
                    $('#app').addClass('no_shadow');

                    $('#app').html('<span style="color: #cd9c44;font-size: 2.5vw;padding: 15px;font-family: \'Caveat\', cursive;font-weight: 900;">Mail has been sent , Thank you</span>'
                                            );

                }

            },
            error: function(xhr) {
                //Do Something to handle error
            }

        });
    }
    function reschedule(element) {

        var order_number = $('#order_reference_reschedule').val();
        var reschedule_date = $('#reschedule_date').val();

        if (reschedule_date == null || reschedule_date =="") {
            Swal.fire({
                    position: 'center',
                    icon:'error',
                    title:'OOPS!',
                    text: "You must add date",
                    showConfirmButton: false,
                    timer: 2500
                    });
        }else{
            var e = element.parentElement;
            $(element.parentElement).html('<div class="order_number_button"><div class="loader"></div></div>');

            $.ajax({
                url: "reschedule_order",
                type: "post",
                data: {
                    _token: "{{ csrf_token() }}",
                    order: order_number,
                    reschedule_date: reschedule_date
                },
                success: function(response) {

                    if (response=='success') {
                        Swal.fire({
                        position: 'center',
                        icon:'success',
                        title:'Submited!',
                        text:'Your request has been submited.',
                        showConfirmButton: false,
                        timer: 2500
                        });
                        $('#app').addClass('no_shadow');

                        $('#app').html('<span style="color: #cd9c44;font-size: 2.5vw;padding: 15px;font-family: \'Caveat\', cursive;font-weight: 900;">Thank you, Please check your email to follow up</span>'
                                                    );
                    } else {

                        Swal.fire({
                        position: 'center',
                        icon:'error',
                        title:'OOPS!',
                        text: response,
                        showConfirmButton: false,
                        timer: 2500
                        });
                        $(e).html(
                            '<button onclick="reschedule(this)" type="submit" class="order_number_button shadow"><i class="fas fa-paper-plane"></i></button>'
                            );

                    }
                    
                },
                error: function(xhr) {
                    //Do Something to handle error
                }

            });
        }
        
    }

    function lmd_or_late(element) {

        var order_number = $('#order_reference_lmd').val();
        var message = $('#notes_lmd').val();

        var e = element.parentElement;
        $(element.parentElement).html('<div class="loader"></div></div>');

        $.ajax({
            url: "lmd_or_late",
            type: "post",
            data: {
                _token: "{{ csrf_token() }}",
                order: order_number,
                message: message
            },
            success: function(response) {


                if (response=='success') {
                    Swal.fire({
                    position: 'center',
                    icon:'success',
                    title:'Submited!',
                    text:'Your request has been submited.',
                    showConfirmButton: false,
                    timer: 2500
                    });
                    

                    $(e).html("<span style='color: #1b3425;font-size: 1.5vw;font-weight: 500;padding: 15px;'> Thank you, Please check your email to follow up</span>");

                } else {

                    Swal.fire({
                    position: 'center',
                    icon:'error',
                    title:'OOPS!',
                    text: response,
                    showConfirmButton: false,
                    timer: 2500
                    });
                    $(e).html(
                        '<button onclick="lmd_or_late(this)" type="submit" name="create_group_order" id="group_order_submit"' +
                        'style="margin-top: 3rem;margin-right: 1rem;height: 80%;border-radius: 15px;font-family: \'Bebas Neue\', cursive;font-size: 17px;letter-spacing: 2px;font-weight: 600;padding: 10px 40px 8px 40px;"' +
                        'class="btn btn-primary"> Submit' +
                        '</button>'
                        );

                }

            },
            error: function(xhr) {
                //Do Something to handle error
            }

        });
    }

    function customer_others(element) {

        var order_number = $('#order_reference_others').val();
        var message = $('#notes_others').val();

        var e = element.parentElement;
        $(element.parentElement).html('<div class="loader"></div></div>');

        $.ajax({
            url: "customer_others",
            type: "post",
            data: {
                _token: "{{ csrf_token() }}",
                order: order_number,
                message: message
            },
            success: function(response) {


                if (response=='success') {
                    Swal.fire({
                    position: 'center',
                    icon:'success',
                    title:'Submited!',
                    text:'Your request has been submited.',
                    showConfirmButton: false,
                    timer: 2500
                    });
                    

                    $(e).html("<span style='color: #1b3425;font-size: 1.5vw;font-weight: 500;padding: 15px;'> Thank you, Please check your email to follow up</span>");

                } else {

                    Swal.fire({
                    position: 'center',
                    icon:'error',
                    title:'OOPS!',
                    text: response,
                    showConfirmButton: false,
                    timer: 2500
                    });
                    $(e).html(
                        '<button onclick="customer_others(this)" type="submit" name="create_group_order" id="group_order_submit"' +
                        'style="margin-top: 3rem;margin-right: 1rem;height: 80%;border-radius: 15px;font-family: \'Bebas Neue\', cursive;font-size: 17px;letter-spacing: 2px;font-weight: 600;padding: 10px 40px 8px 40px;"' +
                        'class="btn btn-primary"> Submit' +
                        '</button>'
                        );

                }

            },
            error: function(xhr) {
                //Do Something to handle error
            }

        });
    }
    
    function submit_form(button_id){
            
        $('#'+button_id).html('<div class="loader"></div></div>');
    }
</script>

</html>
