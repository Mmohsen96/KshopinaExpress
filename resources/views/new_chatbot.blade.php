<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Kshopina Help</title>
    <link rel="icon" type="image/png" href="{{ asset('K-blue-png.png') }}" style="font-size: 2rem;height:60%; width:auto;">


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.3/jquery.mCustomScrollbar.concat.min.js">
    </script>
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.3/jquery.mCustomScrollbar.min.css">

    
        <style>
            *,
            *::before,
            *::after {
                box-sizing: border-box;
            }

            html,
            body {
                height: 100%;
            }

            body {
            /*  background: linear-gradient(135deg, #044f48, #2a7561); */
                background: linear-gradient(135deg, #485a7d , #60ADFF);
                background-size: cover;
                font-family: "Open Sans", sans-serif;
                font-size: 12px;
                line-height: 1.3;
                overflow: hidden;
            }

            .bg {
                width: 100%;
                height: 100%;
                top: 0;
                left: 0;
                z-index: 1;
                filter: blur(80px);
                /*transform: scale(1.2);*/
            }

            /*--------------------
            Chat
            --------------------*/
            .chat {
                position: absolute;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                width: 35%;
                height: 80vh;
                max-height: 600px;
                z-index: 2;
                overflow: hidden;
                box-shadow: 0 5px 30px rgb(0 0 0 / 20%);
                background: rgba(0, 0, 0, 0.5);
                border-radius: 20px;
                display: flex;
                justify-content: space-between;
                flex-direction: column;
                max-width: 600px;
                min-width: 315px;
            }

            /*--------------------
            Chat Title
            --------------------*/
            .chat-title {
                flex: 0 1 45px;
                position: relative;
                z-index: 2;
                background: rgba(0, 0, 0, 0.2);
                color: #fff;
                text-transform: uppercase;
                text-align: left;
                padding: 10px 10px 10px 50px;
            }

            .chat-title h1,
            .chat-title h2 {
                font-weight: normal;
                font-size: 14px;
                margin: 0;
                padding: 0;
            }

            .chat-title h2 {
                color: rgba(255, 255, 255, 0.5);
                font-size: 9px;
                letter-spacing: 1px;
            }

            .chat-title .avatar {
                position: absolute;
                z-index: 1;
                top: 8px;
                left: 9px;
                border-radius: 30px;
                width: 30px;
                height: 30px;
                overflow: hidden;
                margin: 0;
                padding: 0;
                border: 2px solid rgba(255, 255, 255, 0.24);
                background-size: contain;
                background-repeat: no-repeat;
                background-position: center;
                border: hidden;
            }

            .chat-title .avatar img {
                width: 100%;
                height: auto;
            }

            /*--------------------
            Messages
            --------------------*/
            .messages {
                flex: 1 1 auto;
                color: rgba(255, 255, 255, 0.7);
                overflow: hidden;
                position: relative;
                width: 100%;
            }

            .messages .messages-content {
                position: absolute;
                top: 0;
                left: 0;
                height: 101%;
                width: 100%;
            }

            .messages .message {
                clear: both;
                float: left;
                padding: 7px 10px 7px;
                border-radius: 10px 10px 10px 0;
                background: rgba(0, 0, 0, 0.6);
                margin: 8px 0;
                word-wrap: break-word;
                height: max-content;
                white-space: pre-line;
                font-size: 14px;
                line-height: 1.4;
                margin-left: 35px;
                position: relative;
            }

            .messages .message .timestamp {
                position: absolute;
                bottom: -15px;
                font-size: 9px;
                color: rgba(255, 255, 255, 0.3);
            }

            .messages .message::before {
                content: "";
                position: absolute;
                bottom: -6px;
                border-top: 6px solid rgb(0 0 0 / 70%);
                left: 0;
                border-right: 7px solid transparent;
            }

            .messages .message .avatar {
                position: absolute;
                z-index: 1;
                bottom: -15px;
                left: -35px;
                border-radius: 30px;
                width: 30px;
                height: 30px;
                overflow: hidden;
                margin: 0;
                padding: 0;
                border: 1px solid rgba(255, 255, 255, 0.24);
            }

            .messages .message .avatar img {
                width: auto;
                height: 95%;
                padding: 6px 0px 6px 4px;
                display: flex;
            }   

            .messages .message.message-personal {
                float: right;
                color: #fff;
                text-align: right;
                background: linear-gradient(120deg, #485a7d , #60adff96);
                border-radius: 10px 10px 0 10px;
            }

            .messages .message.message-personal::before {
                left: auto;
                right: 0;
                border-right: none;
                border-left: 5px solid transparent;
                border-top: 4px solid #257287;
                bottom: -4px;
            }

            .messages .message:last-child {
                margin-bottom: 30px;
            }

            .messages .message.new {
                transform: scale(0);
                transform-origin: 0 0;
                -webkit-animation: bounce 500ms linear both;
                animation: bounce 500ms linear both;
            }

            .messages .message.loading::before {
                position: absolute;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                content: "";
                display: block;
                width: 3px;
                height: 3px;
                border-radius: 50%;
                background: rgba(255, 255, 255, 0.5);
                z-index: 2;
                margin-top: 4px;
                -webkit-animation: ball 0.45s cubic-bezier(0, 0, 0.15, 1) alternate infinite;
                animation: ball 0.45s cubic-bezier(0, 0, 0.15, 1) alternate infinite;
                border: none;
                -webkit-animation-delay: 0.15s;
                animation-delay: 0.15s;
            }

            .messages .message.loading span {
                display: block;
                font-size: 0;
                width: 20px;
                height: 10px;
                position: relative;
            }

            .messages .message.loading span::before {
                position: absolute;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                content: "";
                display: block;
                width: 3px;
                height: 3px;
                border-radius: 50%;
                background: rgba(255, 255, 255, 0.5);
                z-index: 2;
                margin-top: 4px;
                -webkit-animation: ball 0.45s cubic-bezier(0, 0, 0.15, 1) alternate infinite;
                animation: ball 0.45s cubic-bezier(0, 0, 0.15, 1) alternate infinite;
                margin-left: -7px;
            }

            .messages .message.loading span::after {
                position: absolute;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                content: "";
                display: block;
                width: 3px;
                height: 3px;
                border-radius: 50%;
                background: rgba(255, 255, 255, 0.5);
                z-index: 2;
                margin-top: 4px;
                -webkit-animation: ball 0.45s cubic-bezier(0, 0, 0.15, 1) alternate infinite;
                animation: ball 0.45s cubic-bezier(0, 0, 0.15, 1) alternate infinite;
                margin-left: 7px;
                -webkit-animation-delay: 0.3s;
                animation-delay: 0.3s;
            }

            /*--------------------
            Message Box
            --------------------*/
            .message-box {
                flex: 0 1 40px;
                width: 100%;
                background: rgba(0, 0, 0, 0.3);
                padding: 10px;
                position: relative;
            }

            .message-box .message-input {
                background: none;
                border: none;
                outline: none !important;
                resize: none;
                color: rgba(255, 255, 255, 0.7);
                font-size: 11px;
                height: 17px;
                margin: 0;
                padding-right: 20px;
                width: 98%;
            }

            .message-box textarea:focus:-webkit-placeholder {
                color: transparent;
            }

            .message-box .message-submit {
                position: absolute;
                z-index: 1;
                top: 9px;
                right: 10px;
                color: #fff;
                border: none;
                background: #60adffdb;
                font-size: 10px;
                text-transform: uppercase;
                line-height: 1;
                padding: 6px 10px;
                border-radius: 10px;
                outline: none !important;
                transition: background 0.2s ease;
            }

            .message-box .message-submit:hover {
                background: #60ADFF;
            }

            /*--------------------
            Custom Srollbar
            --------------------*/
            .mCSB_scrollTools {
                margin: 1px -3px 1px 0;
                opacity: 0;
            }

            .mCSB_inside>.mCSB_container {
                margin-right: 0px;
                padding: 0 10px;
            }

            .mCSB_scrollTools .mCSB_dragger .mCSB_dragger_bar {
                background-color: rgba(0, 0, 0, 0.5) !important;
            }

            /*--------------------
            Bounce
            --------------------*/
            @-webkit-keyframes bounce {
                0% {
                    transform: matrix3d(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1);
                }

                4.7% {
                    transform: matrix3d(0.45, 0, 0, 0, 0, 0.45, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1);
                }

                9.41% {
                    transform: matrix3d(0.883, 0, 0, 0, 0, 0.883, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1);
                }

                14.11% {
                    transform: matrix3d(1.141, 0, 0, 0, 0, 1.141, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1);
                }

                18.72% {
                    transform: matrix3d(1.212, 0, 0, 0, 0, 1.212, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1);
                }

                24.32% {
                    transform: matrix3d(1.151, 0, 0, 0, 0, 1.151, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1);
                }

                29.93% {
                    transform: matrix3d(1.048, 0, 0, 0, 0, 1.048, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1);
                }

                35.54% {
                    transform: matrix3d(0.979, 0, 0, 0, 0, 0.979, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1);
                }

                41.04% {
                    transform: matrix3d(0.961, 0, 0, 0, 0, 0.961, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1);
                }

                52.15% {
                    transform: matrix3d(0.991, 0, 0, 0, 0, 0.991, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1);
                }

                63.26% {
                    transform: matrix3d(1.007, 0, 0, 0, 0, 1.007, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1);
                }

                85.49% {
                    transform: matrix3d(0.999, 0, 0, 0, 0, 0.999, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1);
                }

                100% {
                    transform: matrix3d(1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1);
                }
            }

            @keyframes bounce {
                0% {
                    transform: matrix3d(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1);
                }

                4.7% {
                    transform: matrix3d(0.45, 0, 0, 0, 0, 0.45, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1);
                }

                9.41% {
                    transform: matrix3d(0.883, 0, 0, 0, 0, 0.883, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1);
                }

                14.11% {
                    transform: matrix3d(1.141, 0, 0, 0, 0, 1.141, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1);
                }

                18.72% {
                    transform: matrix3d(1.212, 0, 0, 0, 0, 1.212, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1);
                }

                24.32% {
                    transform: matrix3d(1.151, 0, 0, 0, 0, 1.151, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1);
                }

                29.93% {
                    transform: matrix3d(1.048, 0, 0, 0, 0, 1.048, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1);
                }

                35.54% {
                    transform: matrix3d(0.979, 0, 0, 0, 0, 0.979, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1);
                }

                41.04% {
                    transform: matrix3d(0.961, 0, 0, 0, 0, 0.961, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1);
                }

                52.15% {
                    transform: matrix3d(0.991, 0, 0, 0, 0, 0.991, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1);
                }

                63.26% {
                    transform: matrix3d(1.007, 0, 0, 0, 0, 1.007, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1);
                }

                85.49% {
                    transform: matrix3d(0.999, 0, 0, 0, 0, 0.999, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1);
                }

                100% {
                    transform: matrix3d(1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1);
                }
            }

            @-webkit-keyframes ball {
                from {
                    transform: translateY(0) scaleY(0.8);
                }

                to {
                    transform: translateY(-10px);
                }
            }

            @keyframes ball {
                from {
                    transform: translateY(0) scaleY(0.8);
                }

                to {
                    transform: translateY(-10px);
                }
            }

            .logo {
                position: absolute;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                width: 234px;
                max-height: 500px;
                z-index: 2;
                overflow: hidden;
                display: flex;
                justify-content: space-between;
                flex-direction: column;
                filter: blur(1px);
            }

            .choice_body {
                margin: 7px;
                padding: 7px 15px;
                border: 1px solid white;
                border-radius: 5px;
                margin-bottom: 15px;
                cursor: pointer;
            }

            .choice_body:hover,
            .choice_body:active{
                background-color: #60adffdb;
                border: 1px solid #60adffdb;
                color: white;

            }
        </style>

        <style>
            .inputGroup {
                background-color: transparent;
                display: block;
                margin: 10px 0;
                position: relative;
            }

            .inputGroup label {
                padding: 10px 10px 10px 2.5rem;
                width: 100%;
                display: block;
                text-align: left;
                color: rgba(255, 255, 255, 0.7);
                cursor: pointer;
                position: relative;
                z-index: 2;
                transition: color 200ms ease-in;
                overflow: hidden;
                border: 1px solid white;
                border-radius: 5px;

            }
            .inputGroup label:active{
                border: 1px solid #60ADFF;

            }
            .inputGroup label:before {
                width: 10px;
                height: 10px;
                border-radius: 50%;
                content: "";
                background-color: #60ADFF;
                position: absolute;
                left: 50%;
                top: 50%;
                transform: translate(-50%, -50%) scale3d(1, 1, 1);
                transition: all 300ms cubic-bezier(0.4, 0, 0.2, 1);
                opacity: 0;
                z-index: -1;
                border: 1px solid #60ADFF;
            }

            .inputGroup label:after {
                width: 1.3rem;
                height: 1.3rem;
                content: "";
                border: 2px solid #d1d7dc;
                background-color: #fff;
                background-image: url("data:image/svg+xml,%3Csvg width='32' height='32' viewBox='0 0 32 32' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M5.414 11L4 12.414l5.414 5.414L20.828 6.414 19.414 5l-10 10z' fill='%23fff' fill-rule='nonzero'/%3E%3C/svg%3E ");            background-repeat: no-repeat;
                background-position: 2px 3px;
                border-radius: 50%;
                z-index: 2;
                position: absolute;
                left: 5%;
                top: 50%;
                transform: translateY(-50%);
                cursor: pointer;
                transition: all 200ms ease-in;
                background-size: contain;
                background-origin: border-box;
            }

            .inputGroup input:checked~label {
                color: white;
                border: 1px solid #60ADFF;
            }

            .inputGroup input:checked~label:before {
                transform: translate(-50%, -50%) scale3d(56, 56, 1);
                opacity: 1;
            }

            .inputGroup input:checked~label:after {
                background-color: #495e83;
                border-color: #495e83;
            }

            .inputGroup input {
                width: 1.2rem;
                height: 1.2rem;
                order: 1;
                z-index: 2;
                position: absolute;
                top: 45%;
                left: 3%;
                transform: translateY(-50%);
                cursor: pointer;
                visibility: hidden;
            }
            

            ::-webkit-calendar-picker-indicator {
                filter: invert(1);
            }


            .custom-select {
                background: transparent url(/public/arrow_heads_down_white.png) no-repeat 93% 30%;
                border: 1px solid #0d332b;
                float: left;
                background-size: 8%;
                border-radius: 8px;
                padding: 3px 0;
                overflow: hidden;
                width: 255px;
            }

            .custom-select select {
                -webkit-appearance: none;
                border: none;
                box-shadow: none;
                background: transparent;
                background-image: none;
                font-family: Georgia;
                font-size: 14px;
                font-style: italic;
                font-weight: normal;
                padding: 0 0 0 20px;
                padding-bottom: 12px\9 ;
                vertical-align: middle;
                width: 130%;
            }

            .custom-select option {
                background-color: #485a7d;
            }

            .custom-select select:focus {
                outline: none;
            }
        
        
        </style> 
  

    <style>
        .home{
            min-height: 100vh;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            color: white;
            padding: 30px;
        }

    </style>

</head>

<body>
    <div class="home">
        <h1>If you have any questions or concerns, feel free to contact us through the live chat on our 
            <a style="color:rgba(0, 0, 0, 0.866)" href="https://kshopina.com/" target="blank"> website</a>.</h1>
    </div>
    {{-- <img class="logo" src="{{ asset('bot_alpha_white.png') }}" alt="Kshopina bot" srcset="Kshopina bot">
    <div class="chat">
        <div class="chat-title">
            <h1>KSHOPINA BOT</h1>
            <h2>Online</h2>
            <figure class="avatar" style="background-image: url({{ asset('K-white-png.png') }});height: 40%;padding: 15px 10px;border-radius: 0px;">
            </figure>
        </div>
        <div class="messages">
            <div class="messages-content mCustomScrollbar _mCS_1 mCS_no_scrollbar">
              
            </div>
        </div>
        <div class="message-box">
            <textarea type="text" id="text_msg_input" class="message-input" placeholder="Type message..."></textarea>
            <input id="calender_msg_input" class="message-input"  type="date" min="{{ date('Y-m-d', time()) }}" required hidden>

            <div class="custom-select" hidden>
                <select name="custom-select" id="country_msg_input" class="message-input" required hidden>
                  <option value="" selected disabled hidden style="background-color: #0a241f;">Country</option>
                  <option value="Egypt">Egypt</option>
                  <option value="Kuwait">Kuwait</option>
                  <option value="Saudi Arabia">Saudi Arabia</option>
                  <option value="United Arab Emirates">United Arab Emirates</option>
                  <option value="Oman">Oman</option>
                  <option value="Jordon">Jordon</option>
                  <option value="Bahrain">Bahrain</option>
                  <option value="Qatar">Qatar</option>
                  <option value="Others">Others</option>
                </select>
            </div>
            <button type="submit" class="message-submit">Send</button>
        </div>

    </div>
    <div class="bg"></div> --}}

</body>
{{-- <script>
    var $messages = $(".messages-content"),
        d,
        h,
        m,
        i = 0;
        var choices={'Wrong':0,'Missing':0,'Damaged':0};
        var counter =1;
        var global_category ='menu';

        /* var menu_array =['customer','guest','faqs']; */

        var customer_array = {
             'Cancel / Confirm your order' : "verification",
             'Change your email in the order' : "edit_customer_mail",
             'Get your order summary email' : "order_details",
             'Track your order' : "tracking",
             'Report an issue in your order' : "item_status",
             'Reschedule your order' : "reschedule",
             'Complain about late delivery' : "lmd",
             'Others' : "other"
            };
      
        var guest_array = {
             'Inquire about products on the website' : "ask_about_product",
             'Want to know the final price of the items' : "final_price",
             'Which countries Kshopina provides its service to' : "availability",
             'Ask about discount codes' : "discount_codes",
             'Ask about collabrations' : "collabrations",
             'Others' : "others",
            };
        

        var order_refrence;
        var reschedule_date;

        var complaint_msg;

        var user_name;
        var user_email;
        var user_phone;
        var user_country;

    $(window).load(function() {
         $messages.mCustomScrollbar();
         setTimeout(function() {
             fakeMessage('menu');

         }, 100);
    });

    function updateScrollbar() {
        $messages.mCustomScrollbar("update").mCustomScrollbar("scrollTo", "bottom", {
            scrollInertia: 10,
            timeout: 0
        });
    }

    function setDate() {
        d = new Date();
        if (m != d.getMinutes()) {
            m = d.getMinutes();
            $('<div class="timestamp">' + d.getHours() + ":" + m + "</div>").appendTo(
                $(".message:last")
            );
        }
    }
       

    
    function customer_or_not(category, message ) {

       

        get_answer(message);

        fakeMessage(category);

       

    }

    function get_answer(message) {
        $(".message-input").val(message);
        insertMessage();

    }

    function get_faq_answer( question , answer ){

        get_answer(question);

        $('<div class="message loading new"><figure class="avatar"><img src="{{ asset('K-white-png.png') }}" /></figure><span></span></div>'
            ).appendTo($(".mCSB_container"));
            updateScrollbar();

        setTimeout(function() {
            $(".message.loading").remove();

            $('<div class="message new"><figure class="avatar"><img src="{{ asset('K-white-png.png') }}" /></figure>' +
                    answer +
                    "</div>"
                )
                .appendTo($(".mCSB_container"))
                .addClass("new");

            setDate();
            updateScrollbar();

        },  Math.random() * 1000 );
           
        global_category = 'faqs';
    }

    function insertMessage() {

    
        if (global_category == 'reschedule' && order_refrence != null ) {

             msg = $("#calender_msg_input").val();

        } else if ( ( global_category == 'ask_about_product' || global_category == 'others' ) && user_phone != null  && user_country == null ) {

            msg = $("#country_msg_input").val();

        }else  {

            msg = $(".message-input").val();

        }

        if ($.trim(msg) == "") {
            return false;
        }
       
        $('<div class="message message-personal">' + msg + "</div>")
            .appendTo($(".mCSB_container"))
            .addClass("new");
        setDate();
        $(".message-input").val(null);
        updateScrollbar();

    //cusstomers  part 
        if (msg.toUpperCase() == 'DONE' && global_category== 'item_status') {

            var check =0;
            msg="You selected ";

            if (choices['Wrong'] !=0) {
                msg = msg + 'Wrong-item';
                check=1;
            }
            if(choices['Missing'] !=0) {
                if (check==0) {
                    msg = msg + 'Missing-item';
                    check=1;
                } else {
                    msg = msg + ' & Missing-item';
                }
            }
            if(choices['Damaged'] !=0) {
                if (check==0) {
                    msg = msg + 'Damaged-item';
                    check=1;
                } else {
                    msg = msg + ' & Damaged-item';
                }
            }

            if (check != 0) {
                global_category = 'item_status2';
                msg = msg +".<br><br> Type ( <span style='color: #60ADFF;'> Yes </span> ) to confirm or ( <span style='color: #60ADFF;'> No </span> ) to reselect";

            }else{
                msg = "Maybe you forgot to select one of options 🤔!<br><br>Select one or more of the options to help you as fast as we can.";

            }
            
            $(
            '<div class="message loading new"><figure class="avatar"><img src="{{ asset('K-white-png.png') }}" /></figure><span></span></div>'
            ).appendTo($(".mCSB_container"));
            updateScrollbar();

            setTimeout(function() {
                $(".message.loading").remove();

                $('<div class="message new"><figure class="avatar"><img src="{{ asset('K-white-png.png') }}" /></figure>' +
                        msg+
                        "</div>"
                    )
                    .appendTo($(".mCSB_container"))
                    .addClass("new");

                setDate();
                updateScrollbar();

            }, 1000 + Math.random() * 20 * 100);
        } 
        else if(msg.toUpperCase() == 'YES' && global_category== 'item_status2'){

            global_category='item_status3';

            msg = "Please type your order reference.<br> We will send you a form to fill in some information about your issue.";

            $(
            '<div class="message loading new"><figure class="avatar"><img src="{{ asset('K-white-png.png') }}" /></figure><span></span></div>'
            ).appendTo($(".mCSB_container"));
            updateScrollbar();

            setTimeout(function() {
                $(".message.loading").remove();

                $('<div class="message new"><figure class="avatar"><img src="{{ asset('K-white-png.png') }}" /></figure>' +
                        msg+
                        "</div>"
                    )
                    .appendTo($(".mCSB_container"))
                    .addClass("new");

                setDate();
                updateScrollbar();

            }, 1000 + Math.random() * 20 * 100);

        }
        else if(msg.toUpperCase() == 'NO' && global_category== 'item_status2'){
            fakeMessage('item_status');
        }
        else if( global_category== 'item_status3'){

            $(
                '<div class="message loading new"><figure class="avatar"><img src="{{ asset('K-white-png.png') }}" /></figure><span></span></div>'
                ).appendTo($(".mCSB_container"));
                updateScrollbar();

            $.ajax({
                url: "send_something_wrong_mail",
                type: "post",
                data: {
                    _token: "{{ csrf_token() }}",
                    order: msg,
                    type:choices
                },
                success: function(response) {
                    console.log(response);
                    if (response[0]) {
                        msg = "We have sent an email to you 📩 <br> please check your inbox";

                        
                    } else {
                        msg = response[1];
                    }

                        setTimeout(function() {
                            $(".message.loading").remove();

                            $('<div class="message new"><figure class="avatar"><img src="{{ asset('K-white-png.png') }}" /></figure>' +
                                    msg+
                                    "</div>"
                                )
                                .appendTo($(".mCSB_container"))
                                .addClass("new");

                            setDate();
                            updateScrollbar();

                        }, 1000 + Math.random() * 20 * 100);
                        global_category ="customer";

                },
                error: function(xhr) {
                    //Do Something to handle error
                }

            });
        }
        else if(global_category== 'verification'  ){

       
                if ( isNaN(msg.charAt(0)) && ( msg.charAt(0).toUpperCase() != 'K' &&  msg.charAt(0).toUpperCase() != 'S' &&  msg.charAt(0).toUpperCase() != 'E')  ) {
                
                    if ( !Fake.hasOwnProperty(customer_array[msg])  ) {

                        if ( msg.toUpperCase() == 'YES' || msg.toUpperCase() == 'NO') {
                            if ( msg.toUpperCase() == 'YES') {

                                request_to_cancel_order(order_refrence);

                            } else {

                                setTimeout(function() {
                                    $(".message.loading").remove();

                                    $('<div class="message new"><figure class="avatar"><img src="{{ asset('K-white-png.png') }}" /></figure>' +
                                           'Thank you for contacting Kshopina.'+
                                            "</div>"
                                        )
                                        .appendTo($(".mCSB_container"))
                                        .addClass("new");

                                    setDate();
                                    updateScrollbar();

                                }, 1000 + Math.random() * 20 * 100);
                                global_category = 'customer';

                            }
                            
                        } else {
                            msg ="Sorry I can not understand!<br> Please write down your correct order refrence.";
                            setTimeout(function() {
                                    $(".message.loading").remove();

                                    $('<div class="message new"><figure class="avatar"><img src="{{ asset('K-white-png.png') }}" /></figure>' +
                                            msg +
                                            "</div>"
                                        )
                                        .appendTo($(".mCSB_container"))
                                        .addClass("new");

                                    setDate();
                                    updateScrollbar();

                            },  Math.random() * 1000 );
                        }
                       
                    }else{
                        global_category = 'customer';
                    }

                } else {
                    order_refrence = msg;
                    send_verification_mail(order_refrence);
                    
                } 
            
        }else if( global_category== 'order_details' ){
           
            if ( isNaN(msg.charAt(0)) && ( msg.charAt(0).toUpperCase() != 'K' &&  msg.charAt(0).toUpperCase() != 'S' &&  msg.charAt(0).toUpperCase() != 'E') ) {
                
                if ( !Fake.hasOwnProperty(customer_array[msg]) ) {
                    msg ="Sorry I can not understand!<br> Please write down your correct order refrence.";
                    setTimeout(function() {
                            $(".message.loading").remove();

                            $('<div class="message new"><figure class="avatar"><img src="{{ asset('K-white-png.png') }}" /></figure>' +
                                    msg +
                                    "</div>"
                                )
                                .appendTo($(".mCSB_container"))
                                .addClass("new");

                            setDate();
                            updateScrollbar();

                    },  Math.random() * 1000 );
                }else{
                    global_category = 'customer';
                }

            } else {
                
                send_details_mail(msg);
                
            } 
               
        
        }else if( global_category== 'tracking' ){

            if ( isNaN(msg.charAt(0)) && ( msg.charAt(0).toUpperCase() != 'K' &&  msg.charAt(0).toUpperCase() != 'S' &&  msg.charAt(0).toUpperCase() != 'E') ) {
                
                if ( !Fake.hasOwnProperty(customer_array[msg]) ) {
                    msg ="Sorry I can not understand!<br> Please write down your correct order refrence.";
                    setTimeout(function() {
                            $(".message.loading").remove();

                            $('<div class="message new"><figure class="avatar"><img src="{{ asset('K-white-png.png') }}" /></figure>' +
                                    msg +
                                    "</div>"
                                )
                                .appendTo($(".mCSB_container"))
                                .addClass("new");

                            setDate();
                            updateScrollbar();

                    },  Math.random() * 1000 );
                }else{
                    global_category = 'customer';
                }

            } else {
                
                send_tracking_mail(msg);
                
            } 
                

        }
        else if( global_category== 'reschedule'  ){

            if ( order_refrence == null ) {
            
                if ( isNaN(msg.charAt(0)) && ( msg.charAt(0).toUpperCase() != 'K' &&  msg.charAt(0).toUpperCase() != 'S' &&  msg.charAt(0).toUpperCase() != 'E') ) {
                    
                    if ( !Fake.hasOwnProperty(customer_array[msg]) ) {
                        msg ="Sorry I can not understand!<br> Please write down your correct order refrence.";
                        setTimeout(function() {
                                $(".message.loading").remove();

                                $('<div class="message new"><figure class="avatar"><img src="{{ asset('K-white-png.png') }}" /></figure>' +
                                        msg +
                                        "</div>"
                                    )
                                    .appendTo($(".mCSB_container"))
                                    .addClass("new");

                                setDate();
                                updateScrollbar();

                        },  Math.random() * 1000 );
                    }else{
                        global_category = 'customer';
                    }

                } else {
                    
                    order_refrence = msg;
                    
                    setTimeout(function() {
                        $(".message.loading").remove();

                        $('<div class="message new"><figure class="avatar"><img src="{{ asset('K-white-png.png') }}" /></figure>' +
                                'Second: Select your reschedule date.'+
                                "</div>"
                            )
                            .appendTo($(".mCSB_container"))
                            .addClass("new");

                        setDate();
                        updateScrollbar();

                    },  Math.random() * 100 );

                    $("#text_msg_input").hide();
                    $("#calender_msg_input").css("width"," 25%");
                    $("#calender_msg_input").css("font-size","12px");
                    $("#calender_msg_input").show();
                } 

            } else {
                reschedule_date = msg;

                $("#calender_msg_input").hide();
                $("#text_msg_input").show();

                $(
                '<div class="message loading new"><figure class="avatar"><img src="{{ asset('K-white-png.png') }}" /></figure><span></span></div>'
                ).appendTo($(".mCSB_container"));
                updateScrollbar();

                reschedule(order_refrence,reschedule_date);

                order_refrence = null ;
                reschedule_date = null;


            }
           
        } else if( global_category== 'lmd' ){

            if ( order_refrence == null ) {

                if ( isNaN(msg.charAt(0)) && ( msg.charAt(0).toUpperCase() != 'K' &&  msg.charAt(0).toUpperCase() != 'S' &&  msg.charAt(0).toUpperCase() != 'E') ) {

                    if ( !Fake.hasOwnProperty(customer_array[msg]) ) {

                        msg ="Sorry I can not understand!<br> Please write down your correct order refrence.";
                        setTimeout(function() {
                                $(".message.loading").remove();

                                $('<div class="message new"><figure class="avatar"><img src="{{ asset('K-white-png.png') }}" /></figure>' +
                                        msg +
                                        "</div>"
                                    )
                                    .appendTo($(".mCSB_container"))
                                    .addClass("new");

                                setDate();
                                updateScrollbar();

                        },  Math.random() * 1000 );

                    }else{

                        global_category = 'customer';

                    }

                } else {

                    order_refrence = msg;

                    setTimeout(function() {
                        $(".message.loading").remove();

                        $('<div class="message new"><figure class="avatar"><img src="{{ asset('K-white-png.png') }}" /></figure>' +
                                'Second: Please type your inquiry. <br> Then, we will send you an email to follow up.'+
                                "</div>"
                            )
                            .appendTo($(".mCSB_container"))
                            .addClass("new");

                        setDate();
                        updateScrollbar();

                    },  Math.random() * 1000 );

                } 

            } else {

                if ( !Fake.hasOwnProperty(customer_array[msg]) ) {
                    complaint_msg = msg;

                    $(
                    '<div class="message loading new"><figure class="avatar"><img src="{{ asset('K-white-png.png') }}" /></figure><span></span></div>'
                    ).appendTo($(".mCSB_container"));
                    updateScrollbar();

                    lmd_or_late(order_refrence,complaint_msg);

                    order_refrence = null ;
                    complaint_msg = null;
                }else{
                    global_category = 'customer';
                }

            }
            
        }else if( global_category== 'other' ){

            if ( order_refrence == null ) {

                if ( isNaN(msg.charAt(0)) && ( msg.charAt(0).toUpperCase() != 'K' &&  msg.charAt(0).toUpperCase() != 'S' &&  msg.charAt(0).toUpperCase() != 'E') ) {

                    if ( !Fake.hasOwnProperty(customer_array[msg]) ) {

                        msg ="Sorry I can not understand!<br> Please write down your correct order refrence.";
                        setTimeout(function() {
                                $(".message.loading").remove();

                                $('<div class="message new"><figure class="avatar"><img src="{{ asset('K-white-png.png') }}" /></figure>' +
                                        msg +
                                        "</div>"
                                    )
                                    .appendTo($(".mCSB_container"))
                                    .addClass("new");

                                setDate();
                                updateScrollbar();

                        },  Math.random() * 1000 );

                    }else{

                        global_category = 'customer';

                    }

                } else {

                    order_refrence = msg;

                    setTimeout(function() {
                        $(".message.loading").remove();

                        $('<div class="message new"><figure class="avatar"><img src="{{ asset('K-white-png.png') }}" /></figure>' +
                                'Second: Please type your inquiry, then we will send you an email to follow up.'+
                                "</div>"
                            )
                            .appendTo($(".mCSB_container"))
                            .addClass("new");

                        setDate();
                        updateScrollbar();

                    },  Math.random() * 1000 );

                } 

            } else {

                if ( !Fake.hasOwnProperty(customer_array[msg]) ) {
                    complaint_msg = msg;

                    $(
                    '<div class="message loading new"><figure class="avatar"><img src="{{ asset('K-white-png.png') }}" /></figure><span></span></div>'
                    ).appendTo($(".mCSB_container"));
                    updateScrollbar();

                    customer_others(order_refrence,complaint_msg);

                    order_refrence = null ;
                    complaint_msg = null;
                }else{
                    global_category = 'customer';
                }

            }

    //userss  part availability
        }else if( global_category == 'ask_about_product' ){

            if ( user_name == null ) {
                
                if ( !Fake.hasOwnProperty(guest_array[msg]) ) {

                    user_name = msg;

                    setTimeout(function() {
                        $(".message.loading").remove();

                        $('<div class="message new"><figure class="avatar"><img src="{{ asset('K-white-png.png') }}" /></figure>' +
                            'Second: Type your email so we can send you an email to follow up.'+
                                "</div>"
                            )
                            .appendTo($(".mCSB_container"))
                            .addClass("new");

                        setDate();
                        updateScrollbar();

                    },  Math.random() * 1000 );

                }else{

                    global_category = 'guest';
                    user_name = null;
                    user_email = null;
                    user_phone = null;
                    user_country = null;
                    complaint_msg = null;
                    
                } 

            } else if( user_name &&  user_email == null ) {

                if ( !Fake.hasOwnProperty(guest_array[msg]) ) {

                    user_email = msg;

                    if ( !user_email.includes("@") || !user_email.includes(".com")  ){
                        user_email= null;
                        setTimeout(function() {
                            $(".message.loading").remove();

                            $('<div class="message new"><figure class="avatar"><img src="{{ asset('K-white-png.png') }}" /></figure>' +
                                'Invalid email format!<br> Dear customer 💞 <br> Please type the correct email so we can follow up with you.<br><br> Example: test@gmail.com '+
                                    "</div>"
                                )
                                .appendTo($(".mCSB_container"))
                                .addClass("new");

                            setDate();
                            updateScrollbar();

                        },  Math.random() * 1000 );
                    }else{

                        setTimeout(function() {
                            $(".message.loading").remove();

                            $('<div class="message new"><figure class="avatar"><img src="{{ asset('K-white-png.png') }}" /></figure>' +
                                'Third: Type your phone number'+
                                    "</div>"
                                )
                                .appendTo($(".mCSB_container"))
                                .addClass("new");

                            setDate();
                            updateScrollbar();

                        },  Math.random() * 1000 );

                    }

                }else{

                    global_category = 'guest';
                    user_name = null;
                    user_email = null;
                    user_phone = null;
                    user_country = null;
                    complaint_msg = null;
                    
                } 
                

            }else if( user_name &&  ( user_email.includes("@") && user_email.includes(".com") ) &&  user_phone == null ) {

                if ( !Fake.hasOwnProperty(guest_array[msg]) ) {
                    user_phone = msg;
                        
                    if (  /^\d+$/.test(user_phone) ){

                        setTimeout(function() {
                            $(".message.loading").remove();

                            $('<div class="message new"><figure class="avatar"><img src="{{ asset('K-white-png.png') }}" /></figure>' +
                                'Fourth: Choose your country from below'+
                                    "</div>"
                                )
                                .appendTo($(".mCSB_container"))
                                .addClass("new");

                            setDate();
                            updateScrollbar();

                        },  Math.random() * 100 );

                        $("#text_msg_input").hide();

                        $(".custom-select").show();

                        $("#country_msg_input").show();

                    }else{

                        user_phone= null;
                        setTimeout(function() {
                            $(".message.loading").remove();

                            $('<div class="message new"><figure class="avatar"><img src="{{ asset('K-white-png.png') }}" /></figure>' +
                                'Invalid phone number format!<br> Please type the correct phone number and try again. <br><br> Exampe: 0123456789'+
                                    "</div>"
                                )
                                .appendTo($(".mCSB_container"))
                                .addClass("new");

                            setDate();
                            updateScrollbar();

                        },  Math.random() * 1000 );

                    }

                }else{

                    global_category = 'guest';
                    user_name = null;
                    user_email = null;
                    user_phone = null;
                    user_country = null;
                    complaint_msg = null;
                    
                } 
                
               
            }else if( user_name &&  user_email &&  user_phone  && user_country == null ) {

                user_country = msg;
                
                setTimeout(function() {
                    $(".message.loading").remove();

                    $('<div class="message new"><figure class="avatar"><img src="{{ asset('K-white-png.png') }}" /></figure>' +
                        "You're almost done 🤏 <br> <br>"+
                            'Type your question here, and we will send you an email with a complaint ticket to follow up with us. <br>'+
                            "</div>"
                        )
                        .appendTo($(".mCSB_container"))
                        .addClass("new");

                    setDate();
                    updateScrollbar();

                },  Math.random() * 100 );

                $(".custom-select").hide();
                $("#country_msg_input").hide();
                $("#text_msg_input").show();

            }else if ( user_name &&  user_email &&  user_phone  && user_country  && complaint_msg == null  ){

                if ( !Fake.hasOwnProperty(guest_array[msg]) ) {

                    complaint_msg = msg;

                    $(
                    '<div class="message loading new"><figure class="avatar"><img src="{{ asset('K-white-png.png') }}" /></figure><span></span></div>'
                    ).appendTo($(".mCSB_container"));
                    updateScrollbar();

                    ask_about_product(user_name , user_email , user_phone , user_country , complaint_msg);

                    user_name = null;
                    user_email = null;
                    user_phone = null;
                    user_country = null;
                    complaint_msg = null;

                }else{

                    global_category = 'guest';
                    user_name = null;
                    user_email = null;
                    user_phone = null;
                    user_country = null;
                    complaint_msg = null;
                    
                } 
                
            }
        }else if( global_category== 'others' ){

            if ( user_name == null ) {

                if ( !Fake.hasOwnProperty(guest_array[msg]) ) {

                    user_name = msg;

                    setTimeout(function() {
                        $(".message.loading").remove();

                        $('<div class="message new"><figure class="avatar"><img src="{{ asset('K-white-png.png') }}" /></figure>' +
                            'Second: Type your email so we can send you an email to follow up.'+
                                "</div>"
                            )
                            .appendTo($(".mCSB_container"))
                            .addClass("new");

                        setDate();
                        updateScrollbar();

                    },  Math.random() * 1000 );

                }else{

                    global_category = 'guest';
                    user_name = null;
                    user_email = null;
                    user_phone = null;
                    user_country = null;
                    complaint_msg = null;
                    
                } 
                

            } else if( user_name &&  user_email == null ) {

                if ( !Fake.hasOwnProperty(guest_array[msg]) ) {
                    user_email = msg;

                    if ( !user_email.includes("@") || !user_email.includes(".com")  ){
                        user_email= null;
                        setTimeout(function() {
                            $(".message.loading").remove();

                            $('<div class="message new"><figure class="avatar"><img src="{{ asset('K-white-png.png') }}" /></figure>' +
                                'Invalid email format!<br> Dear customer 💞 <br> Please type the correct email so we can follow up with you.<br><br> Example: test@gmail.com '+
                                    "</div>"
                                )
                                .appendTo($(".mCSB_container"))
                                .addClass("new");

                            setDate();
                            updateScrollbar();

                        },  Math.random() * 1000 );
                    }else{

                        setTimeout(function() {
                            $(".message.loading").remove();

                            $('<div class="message new"><figure class="avatar"><img src="{{ asset('K-white-png.png') }}" /></figure>' +
                                'Third: Type your phone number'+
                                    "</div>"
                                )
                                .appendTo($(".mCSB_container"))
                                .addClass("new");

                            setDate();
                            updateScrollbar();

                        },  Math.random() * 1000 );

                    }

                }else{

                    global_category = 'guest';
                    user_name = null;
                    user_email = null;
                    user_phone = null;
                    user_country = null;
                    complaint_msg = null;
                    
                } 

               
            }else if( user_name &&  ( user_email.includes("@") && user_email.includes(".com") ) &&  user_phone == null ) {

                if ( !Fake.hasOwnProperty(guest_array[msg]) ) {

                    user_phone = msg;

                    if (  /^\d+$/.test(user_phone) ){

                        setTimeout(function() {
                        $(".message.loading").remove();

                            $('<div class="message new"><figure class="avatar"><img src="{{ asset('K-white-png.png') }}" /></figure>' +
                                'Fourth: Choose your country from below'+
                                    "</div>"
                                )
                                .appendTo($(".mCSB_container"))
                                .addClass("new");

                            setDate();
                            updateScrollbar();

                        },  Math.random() * 100 );

                        $("#text_msg_input").hide();

                        $(".custom-select").show();

                        $("#country_msg_input").show();

                    }else{
                        user_phone= null;
                        
                        setTimeout(function() {
                            $(".message.loading").remove();

                            $('<div class="message new"><figure class="avatar"><img src="{{ asset('K-white-png.png') }}" /></figure>' +
                                'Invalid phone number format!<br> Dear customer 💞 <br> Please type the correct phone number so we can follow up with you. <br><br> Exampe: 0123456789 '+
                                    "</div>"
                                )
                                .appendTo($(".mCSB_container"))
                                .addClass("new");

                            setDate();
                            updateScrollbar();

                        },  Math.random() * 1000 );
                    }
                
                    

                }else{

                   global_category = 'guest';
                   user_name = null;
                    user_email = null;
                    user_phone = null;
                    user_country = null;
                    complaint_msg = null;
                   
                } 

            }else if( user_name &&  user_email &&  user_phone  && user_country == null ) {

                user_country = msg;
                
                setTimeout(function() {
                    $(".message.loading").remove();

                    $('<div class="message new"><figure class="avatar"><img src="{{ asset('K-white-png.png') }}" /></figure>' +
                           "You're almost done 🤏 <br> <br>"+
                            'Type your question here, and we will send you an email to follow up. <br>'+
                            "</div>"
                        )
                        .appendTo($(".mCSB_container"))
                        .addClass("new");

                    setDate();
                    updateScrollbar();

                },  Math.random() * 100 );

                $(".custom-select").hide();
                $("#country_msg_input").hide();
                $("#text_msg_input").show();

            }else if ( user_name &&  user_email &&  user_phone  && user_country  && complaint_msg == null  ){

                if ( !Fake.hasOwnProperty(guest_array[msg]) ) {

                    complaint_msg = msg;

                    $(
                    '<div class="message loading new"><figure class="avatar"><img src="{{ asset('K-white-png.png') }}" /></figure><span></span></div>'
                    ).appendTo($(".mCSB_container"));
                    updateScrollbar();

                    guest_others(user_name , user_email , user_phone , user_country , complaint_msg);

                    user_name = null;
                    user_email = null;
                    user_phone = null;
                    user_country = null;
                    complaint_msg = null;

                }else{

                   global_category = 'guest';

                   user_name = null;
                    user_email = null;
                    user_phone = null;
                    user_country = null;
                    complaint_msg = null;
                   
                } 
                
            }
        }

    }

    $(".message-submit").click(function() {
        insertMessage();
    });

    $(window).on("keydown", function(e) {
        if (e.which == 13) {
            insertMessage();
            return false;
        }
    });

    var Fake = {
        "menu": "Hello there, this is Kshopina Bot 👋🏻 <br> Please select one of the following options to direct you to a responsible CS Agent (Real Person) for better and faster support 😍 ",
        'customer': "What is your inquiry? 🧐",
        'guest': "What is your inquiry? 🧐",
        'edit_customer_mail': 'You have to send the new email over the WhatsApp number that was registered in the order to our WhatsApp: ' +
            '<span style="color: #60ADFF;">+20 110 228 2260</span>. <br> For example :<br><br>' +
            'My previous email : tesst123@gmail.com <br> My new email : test12@gmail.com <br>' +
            'Order reference : 12345 </h3>',

        'item_status' :"Oops, we truly apologize to you, please select one or more of the below options.<br><br>Type (<span style='color: #60ADFF;'> Done </span>) after you select",
        'verification' :"Please type your order reference. <br> We will send you a new verification WhatsApp message, and the previous message will be invalid." ,
        'order_details' : " Please type your order reference. <br> We will send you an email with the order summary. ",
        'tracking' : "If you have the tracking number of your order that starts with ( K ),<br> For example :  K*******<br><br>Please visit <a href='https://kshopinaexpress.com/' target='blank' style='color: #1a9edd;' >this link</a> and search by your number to know the latest update on your order.<br><br>In case you do not have the tracking number, please type your order reference." ,
        'reschedule' : " <span style='color: #60ADFF; font-weight:600;'> 📌 *You can reschedule your order 7 days maximum, if you want to exceed this period we will charge you extra shipping fees.*  📌</span><br><br> " +
            "First: please type your order reference ",
        'lmd' :  "Dear customer, <br><br>" +
            "First: please type your order reference ",
        'other': "  Hello dear customer 💞<br> "+
            " I hope you are doing great, please follow the steps below:<br> <br>" + 
            "First: please type your order reference " ,
        'ask_about_product' : " Hello dear customer 💞 <br>  Please leave your contact information and your question, so one of our CS agents can assist you. <br> We will send you an email to follow up.<br><br>" +
            "First: Please type your name" ,
        'final_price' :
                'Hello dear customer 💞<br><br>' +
                'You can know the final prices of our products including the international shipping and customs through our website,' +
                'before completing your purchase and after adding your address information.<br><br>' +

                '<img style="width: 15vw;" src="{{ asset('final_price1.jpeg') }}" alt=""> <br>' +
                'After adding the item to the cart, you have to fill in your address information.<br> <br>' +

                '<img style="width: 15vw;" src="{{ asset('final_price2.jpeg') }}" alt=""><br> ' +

                ' Then you can check the final price including the shipping and customs.<br>' 
        ,
        'others' :  " Hello dear customer 💞 <br>  Please leave your contact information and your question, so one of our CS agents can assist you. <br> We will send you an email to follow up.<br><br>" +
            "First: Please type your name" ,
        'availability' : "Hello dear customer 💞<br> This is a list with the countries we provide our service to and available payment methods for each, <br>" ,
        'discount_codes' : "Hello dear customer 💞<br> You can find the available discount codes below: <br>",
        'collabrations' : "Thank you for contacting KSHOPINA 💞 <br>"+ 
            "We appreciate your interest in collaborating with us! <br> Please contact our project manager through this Email: ‘’menna@dpmglob.com’’, also please follow these steps when sending the Email: <br>"+
            "1. Subject of the e-mail should contain (Collaboration) <br>" +
            "2. Email body should contain ( What you can offer? and What do you expect from us? )",
        'faqs' : "Hello dear customer 💞<br><br> Please find the following questions and their answers🤗. <br>"+
            "If you don't find your question among this list, please send us what you are looking for. ",
        'uncompleted_data' : 'Sorry I can not understand!<br> pLease follow the last steps correctly.<br>Complete filling your information.',
        'wrong_order_refrence ' : 'Sorry I can not understand!<br> Please type your correct order refrence.',
        'back_to_menu' : 'Dear customer 💞 <br> Something went wrong,<br> Please go back to the previous menu.',
    
            
    };

    function fakeMessage(category) {
        
        if ($(".message-input").val() != "") {
            return false;
        }


        $(
            '<div class="message loading new"><figure class="avatar"><img src="{{ asset('K-white-png.png') }}" /></figure><span></span></div>'
        ).appendTo($(".mCSB_container"));
        updateScrollbar();

        setTimeout(function() {
            $(".message.loading").remove();

            $('<div class="message new"><figure class="avatar"><img src="{{ asset('K-white-png.png') }}" /></figure>' +
                    Fake[category] +
                    "</div>"
            )
            .appendTo($(".mCSB_container"))
            .addClass("new");

            global_category = category;

            if (category == 'menu') {
                $(
                        '<div class="message new">' +
                        '<figure class="avatar"><img src="{{ asset('K-white-png.png') }}" /></figure>' +
                        '<div class="col" >' +
                        '<div class="choice_body" onclick="customer_or_not(\'customer\',\'Order-related Questions\')">Order-related Questions</div>' +
                        '<div class="choice_body" onclick="customer_or_not(\'guest\',\'General Questions\')">General Questions</div>' +
                        '<div style="margin-bottom: 7px;" class="choice_body" onclick="customer_or_not(\'faqs\',\'FAQS\')">FAQS</div>' +

                        '</div>' +
                        "</div>"
                    )
                    .appendTo($(".mCSB_container"))
                    .addClass("new");

            } 
            
           
                
            if (category == 'customer') {

                $(
                    '<div class="message new">' +
                    '<figure class="avatar"><img src="{{ asset('K-white-png.png') }}" /></figure>' +
                    '<div class="col" >' +
                    '<div class="choice_body" onclick="customer_or_not(\'verification\',\'Cancel / Confirm your order\')">Cancel / Confirm your order</div>' +
                    '<div class="choice_body" onclick="customer_or_not(\'edit_customer_mail\',\'Change your email in the order\')">Change your email in the order</div>' +
                    '<div class="choice_body" onclick="customer_or_not(\'order_details\',\'Get your order summary email\')">Get your order summary email</div>' +
                    '<div class="choice_body" onclick="customer_or_not(\'tracking\',\'Track your order\')">Track your order</div>' +
                    '<div class="choice_body" onclick="customer_or_not(\'item_status\',\'Report an issue in your order\')">Report an issue in your order</div>' +
                    '<div class="choice_body" onclick="customer_or_not(\'reschedule\',\'Reschedule your order\')">Reschedule your order</div>' +
                    '<div class="choice_body" onclick="customer_or_not(\'lmd\',\'Complain about late delivery\')">Complain about late delivery</div>' +
                    '<div style="margin-bottom: 7px;" class="choice_body" onclick="customer_or_not(\'other\',\'Others\')">Others</div>' +

                    '</div>' +
                    "</div>"
                )
                .appendTo($(".mCSB_container"))
                .addClass("new");

            } 

            if (category == 'guest') {

                $(
                    '<div class="message new">' +
                        '<figure class="avatar"><img src="{{ asset('K-white-png.png') }}" /></figure>' +
                        '<div class="col" >' +
                            '<div class="choice_body" onclick="customer_or_not(\'ask_about_product\',\'Inquire about products on the website\')">Inquire about products on the website</div>' +
                            '<div class="choice_body" onclick="customer_or_not(\'final_price\',\'Want to know the final price of the items\')">Want to know the final price of the items</div>' +
                            '<div class="choice_body" onclick="customer_or_not(\'availability\',\'Which countries Kshopina provides its service to\')">Which countries Kshopina provides its service to</div>' +
                            '<div class="choice_body" onclick="customer_or_not(\'discount_codes\',\'Ask about discount codes\')">Ask about discount codes</div>' +
                            '<div class="choice_body" onclick="customer_or_not(\'collabrations\',\'Ask about collabrations\')">Ask about collabrations</div>' +
                            '<div style="margin-bottom: 7px;" class="choice_body" onclick="customer_or_not(\'others\',\'Others\')">Others</div>' +

                        '</div>' +
                    "</div>"
                )
                .appendTo($(".mCSB_container"))
                .addClass("new");

            } 

            if (category == 'item_status') {

                choices={'Wrong':0,'Missing':0,'Damaged':0};
                $(
                        '<div class="message new">' +
                            '<figure class="avatar"><img src="{{ asset('K-white-png.png') }}" /></figure>' +
                            '<div class="col" >' +
                                '<div style="position: relative;" class="row">'+

                                    '<div class="inputGroup" style="padding: 0px;">'+
                                        '<input id="Wrong_'+counter+'" name="Wrong_'+counter+'" type="checkbox" onclick="item_status_clicked(this,this.checked ? \'Wrong\' : 0)" />'+
                                        '<label for="Wrong_'+counter+'">Wrong item</label>'+
                                    '</div>'+

                                '</div>' +
                                '<div style="position: relative;" class="row">'+

                                    '<div class="inputGroup" style="padding: 0px;">'+
                                        '<input id="Missing_'+counter+'" name="Missing_'+counter+'" type="checkbox" onclick="item_status_clicked(this,this.checked ? \'Missing\' : 0)"/>'+
                                        '<label for="Missing_'+counter+'">Missing item</label>'+
                                    '</div>'+

                                '</div>' +
                                '<div style="position: relative;margin-bottom: 7px;" class="row">'+

                                    '<div class="inputGroup" style="padding: 0px;">'+
                                        '<input id="Damaged_'+counter+'" name="Damaged_'+counter+'" type="checkbox" onclick="item_status_clicked(this,this.checked ? \'Damaged\' : 0)" />'+
                                        '<label for="Damaged_'+counter+'">Damaged item</label>'+
                                    '</div>'+

                                '</div>' +
                            '</div>' +
                        "</div>"
                    )
                    .appendTo($(".mCSB_container"))
                    .addClass("new");

                    counter++;

            } 
            if (category == 'Wrong') {

                document.getElementById("Wrong").classList.toggle('choice_clicked');

                if (choices['Wrong'] == 0) {
                    choices['Wrong'] = 1;
                } else {
                    choices['Wrong'] = 0;
                }

            }
            if (category == 'Missing') {

                document.getElementById("Missing").classList.toggle('choice_clicked');

                if (choices['Missing'] == 0) {
                    choices['Missing'] = 1;
                } else {
                    choices['Missing'] = 0;
                }


            }
            if (category == 'Damaged') {

                document.getElementById("Damaged").classList.toggle('choice_clicked');

                if (choices['Damaged'] == 0) {
                    choices['Damaged'] = 1;
                } else {
                    choices['Damaged'] = 0;
                }

            }
            if (category == 'availability') {

                get_countries();
                
                global_category ='guest';

            } 
            if (category == 'discount_codes') {

                get_discounts();
                
                global_category ='guest';

            } 
            if( category == "smth_wrong"){
                setTimeout(function() {
                        $(".message.loading").remove();

                        $('<div class="message new"><figure class="avatar"><img src="{{ asset('K-white-png.png') }}" /></figure>' +
                                'somthing wrong!'+
                                "</div>"
                            )
                            .appendTo($(".mCSB_container"))
                            .addClass("new");

                        setDate();
                        updateScrollbar();

                }, 1000 + Math.random() * 20 * 100);

                return false;
                
            }

            if( category == "faqs"){
                
                get_faqs();

                global_category ='menu';

            }

            setDate();
            updateScrollbar();
            i++;
        }, 1000 + Math.random() * 20 * 100);
    }


    function item_status_clicked(element,value) {
        
        if ((element.id.split("_")[0] == "Wrong" || element.id.split("_")[0] == 'Missing' || element.id.split("_")[0] =='Damaged') && ( value == "Wrong" || value == 'Missing' || value =='Damaged' || value == 0)) {
            choices[element.id.split("_")[0]]=value;
        }

    }
    
   
    function send_verification_mail(order_number) {

        $('<div class="message loading new"><figure class="avatar"><img src="{{ asset('K-white-png.png') }}" /></figure><span></span></div>'
                ).appendTo($(".mCSB_container"));
                updateScrollbar();

        $.ajax({
            url: "send_first_mail_again",
            type: "post",
            data: {
                _token: "{{ csrf_token() }}",
                order: order_number,
            },
            success: function(response) {

                if (response == 'Too late!, Order already on process') {

                    setTimeout(function() {
                        $(".message.loading").remove();

                        $('<div class="message new"><figure class="avatar"><img src="{{ asset('K-white-png.png') }}" /></figure>' +
                            'Oops 🤭 your order is on process for shipping soon.<br><br> But if you want to proceed with the cancellation request, we will check with the responsible team.'+
                            "<br><br> Type ( <span style='color: #60ADFF;'> Yes </span> ) to confirm or ( <span style='color: #60ADFF;'> No </span> ) to keep your order"+
                                "</div>"
                            )
                            .appendTo($(".mCSB_container"))
                            .addClass("new");

                        setDate();
                        updateScrollbar();

                    }, 1000 + Math.random() * 20 * 100);

                    global_category = "verification";
                    order_refrence = order_number;

                }
                else if (response != 'Success') {
                    setTimeout(function() {
                        $(".message.loading").remove();

                        $('<div class="message new"><figure class="avatar"><img src="{{ asset('K-white-png.png') }}" /></figure>' +
                            'Order reference is not found!'+
                                "</div>"
                            )
                            .appendTo($(".mCSB_container"))
                            .addClass("new");

                        setDate();
                        updateScrollbar();

                    }, 1000 + Math.random() * 20 * 100);
                    order_refrence = null;


                } else {
                    
                    setTimeout(function() {
                        $(".message.loading").remove();

                        $('<div class="message new"><figure class="avatar"><img src="{{ asset('K-white-png.png') }}" /></figure>' +
                                'Email has been sent 📩 <br> Thank you 😊'+
                                "</div>"
                            )
                            .appendTo($(".mCSB_container"))
                            .addClass("new");

                        setDate();
                        updateScrollbar();

                    }, 1000 + Math.random() * 20 * 100);

                    global_category ="customer";
                    order_refrence = null;
                }

            },
            error: function(xhr) {
                //Do Something to handle error
            }

        });
    }

    function request_to_cancel_order(order_number){

        $('<div class="message loading new"><figure class="avatar"><img src="{{ asset('K-white-png.png') }}" /></figure><span></span></div>'
                ).appendTo($(".mCSB_container"));
                updateScrollbar();

        $.ajax({
            url: "request_to_cancel_order",
            type: "post",
            data: {
                _token: "{{ csrf_token() }}",
                order: order_number,
            },
            success: function(response) {
                if (response == 'success') {
                    
                    setTimeout(function() {
                        $(".message.loading").remove();

                        $('<div class="message new"><figure class="avatar"><img src="{{ asset('K-white-png.png') }}" /></figure>' +
                                'Your request has been submitted, Thank you'+
                                "</div>"
                            )
                            .appendTo($(".mCSB_container"))
                            .addClass("new");

                        setDate();
                        updateScrollbar();

                    }, 1000 + Math.random() * 20 * 100);

                    global_category ="customer";
                    order_refrence = null;
                }else{
                    setTimeout(function() {
                        $(".message.loading").remove();

                        $('<div class="message new"><figure class="avatar"><img src="{{ asset('K-white-png.png') }}" /></figure>' +
                                'Something must have been wrong!<br>Please return back to the previous menu.'+
                                "</div>"
                            )
                            .appendTo($(".mCSB_container"))
                            .addClass("new");

                        setDate();
                        updateScrollbar();

                    }, 1000 + Math.random() * 20 * 100);
                }
                
            },
            error: function(xhr) {
                //Do Something to handle error
            }

        });

    }

    function send_details_mail(order_number) {
      
        $('<div class="message loading new"><figure class="avatar"><img src="{{ asset('K-white-png.png') }}" /></figure><span></span></div>'
                ).appendTo($(".mCSB_container"));
                updateScrollbar();

        $.ajax({
            url: "send_details_mail",
            type: "post",
            data: {
                _token: "{{ csrf_token() }}",
                order: order_number,
            },
            success: function(response) {

                if (response == 'Invalid order reference format!') {
                    setTimeout(function() {
                        $(".message.loading").remove();

                        $('<div class="message new"><figure class="avatar"><img src="{{ asset('K-white-png.png') }}" /></figure>' +
                            'Invalid order reference format!'+
                                "</div>"
                            )
                            .appendTo($(".mCSB_container"))
                            .addClass("new");

                        setDate();
                        updateScrollbar();

                    }, 1000 + Math.random() * 20 * 100);
                  
                }else if(response == "Not found!"){
                    setTimeout(function() {
                        $(".message.loading").remove();

                        $('<div class="message new"><figure class="avatar"><img src="{{ asset('K-white-png.png') }}" /></figure>' +
                            'Order reference is not found!'+
                                "</div>"
                            )
                            .appendTo($(".mCSB_container"))
                            .addClass("new");

                        setDate();
                        updateScrollbar();

                    }, 1000 + Math.random() * 20 * 100);
                   
                }else {

                   setTimeout(function() {
                        $(".message.loading").remove();

                        $('<div class="message new"><figure class="avatar"><img src="{{ asset('K-white-png.png') }}" /></figure>' +
                                'Email has been sent 📩 <br> Thank you 😊'+
                                "</div>"
                            )
                            .appendTo($(".mCSB_container"))
                            .addClass("new");

                        setDate();
                        updateScrollbar();

                    }, 1000 + Math.random() * 20 * 100);

                    global_category ="customer";
                  
                }

            },
            error: function(xhr) {
                //Do Something to handle error
            }

        });


    }

    function send_tracking_mail(order_number) {

        $('<div class="message loading new"><figure class="avatar"><img src="{{ asset('K-white-png.png') }}" /></figure><span></span></div>'
                ).appendTo($(".mCSB_container"));
                updateScrollbar();

        $.ajax({
            url: "send_tracking_mail",
            type: "post",
            data: {
                _token: "{{ csrf_token() }}",
                order: order_number,
            },
            success: function(response) {

                if (response == 'Invalid order reference format!') {
                    setTimeout(function() {
                        $(".message.loading").remove();

                        $('<div class="message new"><figure class="avatar"><img src="{{ asset('K-white-png.png') }}" /></figure>' +
                            'Invalid order reference format!'+
                                "</div>"
                            )
                            .appendTo($(".mCSB_container"))
                            .addClass("new");

                        setDate();
                        updateScrollbar();

                    }, 1000 + Math.random() * 20 * 100);
                  
                }else if(response == "Not found!"){
                    setTimeout(function() {
                        $(".message.loading").remove();

                        $('<div class="message new"><figure class="avatar"><img src="{{ asset('K-white-png.png') }}" /></figure>' +
                            'Order reference is not found!'+
                                "</div>"
                            )
                            .appendTo($(".mCSB_container"))
                            .addClass("new");

                        setDate();
                        updateScrollbar();

                    }, 1000 + Math.random() * 20 * 100);
                   
                }else {

                   setTimeout(function() {
                        $(".message.loading").remove();

                        $('<div class="message new"><figure class="avatar"><img src="{{ asset('K-white-png.png') }}" /></figure>' +
                                'A WhatsApp message has been sent with the tracking link.<br> Thank you 😊'+
                                "</div>"
                            )
                            .appendTo($(".mCSB_container"))
                            .addClass("new");

                        setDate();
                        updateScrollbar();

                    }, 1000 + Math.random() * 20 * 100);

                    global_category ="customer";
                   
                }


            },
            error: function(xhr) {
                //Do Something to handle error
            }

        });
    }

    function reschedule(order_number , reschedule_date) {

       
            $.ajax({
                url: "reschedule_order",
                type: "post",
                data: {
                    _token: "{{ csrf_token() }}",
                    order: order_number,
                    reschedule_date: reschedule_date
                },
                success: function(response) {


                    if (response == 'Invalid order reference format!') {
                        setTimeout(function() {
                            $(".message.loading").remove();

                            $('<div class="message new"><figure class="avatar"><img src="{{ asset('K-white-png.png') }}" /></figure>' +
                                'Invalid order reference format!'+
                                    "</div>"
                                )
                                .appendTo($(".mCSB_container"))
                                .addClass("new");

                            setDate();
                            updateScrollbar();

                        }, 1000 + Math.random() * 20 * 100);
                    }else if(response == "Order number not found!"){
                        setTimeout(function() {
                            $(".message.loading").remove();

                            $('<div class="message new"><figure class="avatar"><img src="{{ asset('K-white-png.png') }}" /></figure>' +
                                'Order reference is not found!'+
                                    "</div>"
                                )
                                .appendTo($(".mCSB_container"))
                                .addClass("new");

                            setDate();
                            updateScrollbar();

                        }, 1000 + Math.random() * 20 * 100);
                    }else {

                        setTimeout(function() {
                            $(".message.loading").remove();

                            $('<div class="message new"><figure class="avatar"><img src="{{ asset('K-white-png.png') }}" /></figure>' +
                                    'Email has been sent 📩<br> Please check your inbox now.'+
                                    "</div>"
                                )
                                .appendTo($(".mCSB_container"))
                                .addClass("new");

                            setDate();
                            updateScrollbar();

                        }, 1000 + Math.random() * 20 * 100);

                        global_category ="customer";
                    }

                },
                error: function(xhr) {
                    //Do Something to handle error
                }

            });
      
        
    }

    function lmd_or_late(order_number ,message ) {

        $.ajax({
            url: "lmd_or_late",
            type: "post",
            data: {
                _token: "{{ csrf_token() }}",
                order: order_number,
                message: message
            },
            success: function(response) {

                    if (response == 'Invalid order reference format!') {
                        setTimeout(function() {
                            $(".message.loading").remove();

                            $('<div class="message new"><figure class="avatar"><img src="{{ asset('K-white-png.png') }}" /></figure>' +
                                'Invalid order reference format!'+
                                    "</div>"
                                )
                                .appendTo($(".mCSB_container"))
                                .addClass("new");

                            setDate();
                            updateScrollbar();

                        }, 1000 + Math.random() * 20 * 100);
                    }else if(response == "Order number not found!"){
                        setTimeout(function() {
                            $(".message.loading").remove();

                            $('<div class="message new"><figure class="avatar"><img src="{{ asset('K-white-png.png') }}" /></figure>' +
                                'Order reference is not found!'+
                                    "</div>"
                                )
                                .appendTo($(".mCSB_container"))
                                .addClass("new");

                            setDate();
                            updateScrollbar();

                        }, 1000 + Math.random() * 20 * 100);
                    }else {

                        setTimeout(function() {
                            $(".message.loading").remove();

                            $('<div class="message new"><figure class="avatar"><img src="{{ asset('K-white-png.png') }}" /></figure>' +
                                    'Email has been sent 📩<br> Please check your inbox now.'+
                                    "</div>"
                                )
                                .appendTo($(".mCSB_container"))
                                .addClass("new");

                            setDate();
                            updateScrollbar();

                        }, 1000 + Math.random() * 20 * 100);

                        global_category ="customer";
                    }

            },
            error: function(xhr) {
                //Do Something to handle error
            }

        });
    }

    function customer_others(order_number ,message ) {

        $.ajax({
            url: "customer_others",
            type: "post",
            data: {
                _token: "{{ csrf_token() }}",
                order: order_number,
                message: message
            },
            success: function(response) {

                    if (response == 'Invalid order reference format!') {
                        setTimeout(function() {
                            $(".message.loading").remove();

                            $('<div class="message new"><figure class="avatar"><img src="{{ asset('K-white-png.png') }}" /></figure>' +
                                'Invalid order reference format!'+
                                    "</div>"
                                )
                                .appendTo($(".mCSB_container"))
                                .addClass("new");

                            setDate();
                            updateScrollbar();

                        }, 1000 + Math.random() * 20 * 100);
                    }else if(response == "Order number not found!"){
                        setTimeout(function() {
                            $(".message.loading").remove();

                            $('<div class="message new"><figure class="avatar"><img src="{{ asset('K-white-png.png') }}" /></figure>' +
                                'Order reference is not found!'+
                                    "</div>"
                                )
                                .appendTo($(".mCSB_container"))
                                .addClass("new");

                            setDate();
                            updateScrollbar();

                        }, 1000 + Math.random() * 20 * 100);
                    }else {

                        setTimeout(function() {
                            $(".message.loading").remove();

                            $('<div class="message new"><figure class="avatar"><img src="{{ asset('K-white-png.png') }}" /></figure>' +
                                    'Email has been sent 📩<br>Please check your inbox now.'+
                                    "</div>"
                                )
                                .appendTo($(".mCSB_container"))
                                .addClass("new");

                            setDate();
                            updateScrollbar();

                        }, 1000 + Math.random() * 20 * 100);

                        global_category ="customer";
                    }

            },
            error: function(xhr) {
                //Do Something to handle error
            }

        });
    }
  

    function ask_about_product( user_name , user_email , user_phone , user_country , complaint_msg ) {

        $.ajax({
            url: "ask_about_product",
            type: "post",
            data: {
                _token: "{{ csrf_token() }}",
                user_name : user_name,
                email : user_email ,
                phone_number : user_phone ,
                country : user_country ,
                message :complaint_msg 
            },
            success: function(response) {

                    if (response == 'Success') {
                        setTimeout(function() {
                            $(".message.loading").remove();

                            $('<div class="message new"><figure class="avatar"><img src="{{ asset('K-white-png.png') }}" /></figure>' +
                                    'Email has been sent 📩<br>Please check your inbox now.'+
                                    "</div>"
                                )
                                .appendTo($(".mCSB_container"))
                                .addClass("new");

                            setDate();
                            updateScrollbar();

                        }, 1000 + Math.random() * 20 * 100);

                        global_category ="guest";
                    } else {
                        setTimeout(function() {
                            $(".message.loading").remove();

                            $('<div class="message new"><figure class="avatar"><img src="{{ asset('K-white-png.png') }}" /></figure>' +
                                    'Something Went wrong!<br>Please try again later.'+
                                    "</div>"
                                )
                                .appendTo($(".mCSB_container"))
                                .addClass("new");

                            setDate();
                            updateScrollbar();

                        }, 1000 + Math.random() * 20 * 100);
                    }

            },
            error: function(xhr) {
                //Do Something to handle error
            }

        });
    }

    function guest_others( user_name , user_email , user_phone , user_country , complaint_msg ) {

        $.ajax({
            url: "guest_others",
            type: "post",
            data: {
                _token: "{{ csrf_token() }}",
                user_name : user_name,
                email : user_email ,
                phone_number : user_phone ,
                country : user_country ,
                message :complaint_msg 
            },
            success: function(response) {

                    if (response == 'Success') {
                        setTimeout(function() {
                            $(".message.loading").remove();

                            $('<div class="message new"><figure class="avatar"><img src="{{ asset('K-white-png.png') }}" /></figure>' +
                                    'Email has been sent 📩<br>Please check your inbox now.'+
                                    "</div>"
                                )
                                .appendTo($(".mCSB_container"))
                                .addClass("new");

                            setDate();
                            updateScrollbar();

                        }, 1000 + Math.random() * 20 * 100);

                        global_category ="guest";
                    } else {
                        setTimeout(function() {
                            $(".message.loading").remove();

                            $('<div class="message new"><figure class="avatar"><img src="{{ asset('K-white-png.png') }}" /></figure>' +
                                    'Something Went wrong!<br>Please try again later.'+
                                    "</div>"
                                )
                                .appendTo($(".mCSB_container"))
                                .addClass("new");

                            setDate();
                            updateScrollbar();

                        }, 1000 + Math.random() * 20 * 100);
                    }

            },
            error: function(xhr) {
                //Do Something to handle error
            }

        });
    }

    function get_countries(){

        $(
            '<div class="message loading new"><figure class="avatar"><img src="{{ asset('K-white-png.png') }}" /></figure><span></span></div>'
        ).appendTo($(".mCSB_container"));
        updateScrollbar();

        var countries ={};
        html ='';

         $.ajax({
                url: "/services_payments",
                type: "get",
                data: {
                _token: "{{ csrf_token() }}"
                },
                success: function(response) {

                    response.forEach(element => {

                        if ( element['cod'] == 1 ) {
                            countries[element['country']]= "1";
                        }

                    });

                    html += '<ul style="list-style-type: disclosure-closed;margin-left: -10px;">';
                        Object.keys(countries).forEach(element => {
                            html += '<li>' + element + '</li>';
                    });
                    html += '</ul>';

                    setTimeout(function() {
                        $(".message.loading").remove();

                                $('<div class="message new"><figure class="avatar"><img src="{{ asset('K-white-png.png') }}" /></figure>' +
                                     'We provide the <span style="font-weight:bold;"> COD </span> service to the following countries:'+
                                     html  +
                                     'Please note that we deliver to all countries using the <span style="font-weight:bold;"> pre-paid </span> option.'  +
                                      "</div>"
                                    )
                                    
                                .appendTo($(".mCSB_container"))
                                .addClass("new");

                                setDate();
                                updateScrollbar();

                    },  100);

                },
                error: function(xhr) {
                    //Do Something to handle error
                }

            });
    }

    function get_discounts(){

        $(
            '<div class="message loading new"><figure class="avatar"><img src="{{ asset('K-white-png.png') }}" /></figure><span></span></div>'
        ).appendTo($(".mCSB_container"));
        updateScrollbar();

        html ='';

            $.ajax({
                url: "/dicount_codes",
                type: "get",
                data: {
                    _token: "{{ csrf_token() }}"
                    
                },
                success: function(response) {

                    if (response.length > 0) {
                        response.forEach(element => {
                        html += 
                                '<div  style="    display: flex;align-items: center;">' +
                                    '<h6 style="margin: 0px;" >' + element['discount_code'] + ' </h6>'+
                                    '<h6  style="margin-left: 20px !important;margin: 0px;">-</span> (' + element['discount_percent'] + ' <span >%</span> )</h6>'+
                                '<br></div>';        
                        });
                    } else {
                        html += '<h3 style="margin: 0px;" >Stay tuned!</h3>'
                    }
                    

                    setTimeout(function() {
                        $(".message.loading").remove();

                                $('<div class="message new"><figure class="avatar"><img src="{{ asset('K-white-png.png') }}" /></figure>' +
                                     html  +
                                      "</div>"
                                    )
                                    
                                .appendTo($(".mCSB_container"))
                                .addClass("new");

                                setDate();
                                updateScrollbar();

                    },  100);


                },
                error: function(xhr) {
                    //Do Something to handle error
                }

            });

    }

    function get_faqs(){

        var html='';


           $.ajax({
                url: "/all_faqs",
                type: "get",
                data: {
                    _token: "{{ csrf_token() }}"
                    
                },
                success: function(response) {

                    response.forEach(element => {
                    html += 
                        ' <div class="choice_body" onclick="get_faq_answer( \''+ element['question'].replace(/(\r\n|\n|\r)/gm, "")  +'\' ,\''+ element['answer'].replace(/(\r\n|\n|\r)/gm, "")  +'\' )"> ' +
                            element['question'] +
                            '</div>' ;   
                    });

                    $(
                        '<div class="message new">' +
                            '<figure class="avatar"><img src="{{ asset('K-white-png.png') }}" /></figure>' +
                            '<div class="col" >' +
                                html +
                            '</div>' +
                        "</div>"
                    )
                    .appendTo($(".mCSB_container"))
                    .addClass("new");

                
                },
                error: function(xhr) {
                    //Do Something to handle error
                }

            });

    }
    

    

</script> --}}

</html>
