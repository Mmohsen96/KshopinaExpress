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
    .transition, ul li i:before, ul li i:after, p {
        transition: all 0.25s ease-in-out;
    }

    .flipIn, ul li, h1 {
        animation: flipdown 0.5s ease both;
    }

    .no-select, h2 {
        -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
        -webkit-touch-callout: none;
        -webkit-user-select: none;
        -khtml-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
    }

    html {
        width: 100%;
        height: 100%;
        perspective: 900;
        overflow-y: scroll;
        background-color: #1b3425;
        font-family: "Titillium Web", sans-serif;
        color: black;
    }

    body {
        border-radius: 0px 0px 8px 8px;
        min-height: 0;
        display: inline-block;
        position: relative;
        left: 50%;
        margin: 90px 0;
        transform: translate(-50%, 0);
        box-shadow: 0 10px 0 0 #cb9d48 inset;
        background-color: #fefffa;
        max-width: 700px;
        padding: 30px;
    }
    @media (max-width: 550px) {
        body {
            box-sizing: border-box;
            transform: translate(0, 0);
            max-width: 100%;
            min-height: 100%;
            margin: 0;
            left: 0;
        }
    }

    h1, h2 {
        color: #1b3425;
        font-weight: 600;
    }
    h4{
        font-weight: 400;
        color: #1b3425;
        font-size: 22px;
    }

    

    p {
        color: black;
        font-size: 14px;
        line-height: 26px;
        margin-left: 8px;
        letter-spacing: 1px;
        position: relative;
        overflow: hidden;
        max-height: 800px;
        opacity: 1;
        transform: translate(0, 0);
        margin-top: 14px;
        z-index: 2;
    }

    ul {
        list-style: none;
        perspective: 900;
        padding: 0;
        margin: 0;
    }
    ul li {
        position: relative;
        padding: 0;
        margin: 0;
        padding-bottom: 4px;
        padding-top: 18px;
        border-top: 1px dotted #1b3425;
    }
 
    ul li:last-of-type {
        padding-bottom: 0;
    }
    ul li i {
        position: absolute;
        transform: translate(-6px, 0);
        margin-top: 16px;
        right: 0;
    }
    ul li i:before, ul li i:after {
        content: "";
        position: absolute;
        background-color: #cd9d4d;
        width: 3px;
        height: 9px;
    }
    ul li i:before {
        transform: translate(-2px, 0) rotate(45deg);
    }
    ul li i:after {
        transform: translate(2px, 0) rotate(-45deg);
    }
    ul li input[type=checkbox] {
        position: absolute;
        cursor: pointer;
        width: 100%;
        height: 100%;
        z-index: 1;
        opacity: 0;
    }
    ul li input[type=checkbox]:checked ~ p {
        margin-top: 0;
        max-height: 0;
        opacity: 0;
        transform: translate(0, 50%);
    }
    ul li input[type=checkbox]:checked ~ i:before {
        transform: translate(2px, 0) rotate(45deg);
    }
    ul li input[type=checkbox]:checked ~ i:after {
        transform: translate(-2px, 0) rotate(-45deg);
    }

    @keyframes flipdown {
        0% {
            opacity: 0;
            transform-origin: top center;
            transform: rotateX(-90deg);
        }
        5% {
            opacity: 1;
        }
        80% {
            transform: rotateX(8deg);
        }
        83% {
            transform: rotateX(6deg);
        }
        92% {
            transform: rotateX(-3deg);
        }
        100% {
            transform-origin: top center;
            transform: rotateX(0deg);
        }
    }
    .faq_title{
        padding-right: 12px;
    }
</style>


<body>
    <div style="display: flex;justify-content: center;margin: 1rem;">
        <img class="logo"  style=" width: 10rem;" src="{{ asset('kshopina_original.png') }}" alt="ops" >
    </div>
    <h3 style="text-align: left;font-weight: 500;font-size: 24px;margin: 20px;"> FAQS </h3>
    <div class="container">
        
        <ul>
          <li>
            <input type="checkbox" checked>
            <i></i>
            <h4 class="faq_title">Where is the store located ?</h4>
            <p>Our store is located in Seoul, South Korea.<br>
                But we have an Arab team who is responsible for handling the customer service.
                </p>
          </li>
          <li>
            <input type="checkbox" checked>
            <i></i>
            <h4 class="faq_title">Are the products original ?</h4>
            <p>All provided products on the website are original 100%.<br>
                We provide our products directly from the entertainment company in South Korea and ship them to your doorstep.
                </p>
          </li>
          <li>
            <input type="checkbox" checked>
            <i></i>
            <h4 class="faq_title">Is the album random or set ?</h4>
            <p>If you want to know if the album comes as a single version or a set, please visit the website and read the description of the album for more information<br>
                If you find "Random version* in the album title, it means that it will be one copy
                </p>
          </li>
          <li>
            <input type="checkbox" checked>
            <i></i>
            <h4 class="faq_title">I want to know how much this album is</h4>
            <p>You can know the final prices of the items before completing the buying process on our website adding the shipping information</p>
          </li>
          <li>
            <input type="checkbox" checked>
            <i></i>
            <h4 class="faq_title">I want to refund my order</h4>
            <p>Please note that, you have to wait for months in order to refund your order back because the international bank transfers usually take time to process the transaction.</p>
          </li>
          <li>
            <input type="checkbox" checked>
            <i></i>
            <h4 class="faq_title">I want to ask about some products</h4>
            <p>You can check the website for any information regarding the products availability or prices.</p>
          </li>
          <li>
            <input type="checkbox" checked>
            <i></i>
            <h4 class="faq_title">What is the estimated shipping time ?</h4>
            <p>Please note that the expected shipping and delivery period starts after confirming the order first, and then the international shipping is as follows:<br>
                In Egypt, Jordan and Qatar: within 10 to 18 days<br>
                In Saudi Arabia, Kuwait, UAE, Sultanate of Oman: 7 to 15 days<br>
                Note: Shipping time may be changed according to the international procedures of each country<br>
                </p>
          </li>
          <li>
            <input type="checkbox" checked>
            <i></i>
            <h4 class="faq_title">Why is the order still at customs?</h4>
            <p>All orders are dispatched within the estimated shipping time but may be delayed due to customs procedures, so we are working to get shipments out as quickly as possible.<br>
                Please notes the customs clearance process may result in damages that are out of our control                
                </p>
          </li>
        </ul>
        
    </div>

</body>

</html>