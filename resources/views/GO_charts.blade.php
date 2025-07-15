<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Group Order</title>

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
    body{
        background-color: white;
    }

    .logo{
        width: 12.5% ;
        height: auto;
    }
    .number{
        display: flex !important;
        align-items: center !important;
        padding: 10px !important;
    }
    .group_inf{
        display: flex;
        flex-direction: row;
        align-items: center;
        justify-content: center;
    }

    .inf_1{
        margin-top: 1rem;
        /* margin-right: 5rem; */
        font-size: 18px;

    }

    .inf_2{
        margin-top: 1rem;
        font-size: 18px;

    }

    .inf_group_id,
    .inf_group_rank {
        font-family: 'Bebas Neue', cursive;
        font-size: 20px;
        letter-spacing: 1.2px;
        color: #1B3425;
    }

    .et_pb_text{
        padding-right: 18px;
    }

    @media screen and (max-width: 991px) {
        .logo{
            width: 20%;
        }
        .inf_group_id,.inf_1,.inf_2
        .inf_group_rank {
            font-size: 1rem;
        }
    }

    @media screen and (max-width: 700px) {
        .logo{
            width: 25%;
        }
        .number{
            padding: 5px !important;
            font-size: 12px;
        }
    }
    @media screen and (max-width: 450px) {
        .number{
            padding: 2px !important;
            font-size: 9px;
        }
        .logo {
            width: 30%;
        }
    }
    @media screen and (max-width: 400px) and (min-width:300px) {
        .group_inf{
            flex-direction: column;
        }
        .inf_1 {
            margin-right: 0rem;
        }
    }
    @media screen and (max-width: 300px) {
        .logo {
            width: 50%;
        }

        .group_inf{
            flex-direction: column;
        }

        .inf_1{
            margin-right: 0rem;
        }
        
        .et_pb_text{
            padding-right: 18px;
        }

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
</style>

<style>
    .stacked-bar-graph {
        width: 100%;
        height: 55px;
        color: #373638;
        display: flex;
        flex-direction: row;
        justify-content: center;
        margin-top: 4rem;
    }
    /* .stacked-bar-graph span {

    } */

</style>

<style>

    .group_popup {
        margin: 30px auto;
        padding: 10px;
        background: #fff;
        border-radius: 5px;
        width: 50%;
        border: solid 0.1px #1b3425;
        position: relative;
        transition: all 5s ease-in-out;
    }


    .tasks_popup {
        margin: 70px auto;
        padding: 20px;
        background: #fff;
        border-radius: 5px;
        width: 50%;
        position: relative;
        transition: all 5s ease-in-out;
        height: 88%;
        overflow: auto;
    }

    .tasks_popup .closee,
    .group_popup .closee {
        position: absolute;
        top: 20px;
        right: 30px;
        transition: all 200ms;
        font-size: 30px;
        font-weight: bold;
        text-decoration: none;
        color: #333;
    }

    .content form .user-details {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        margin: 20px 0 12px 0;
    }

    form .user-details .input-box,
    .group_input {
        margin-bottom: 15px;
        width: calc(100% / 2 - 20px);
    }

    form .input-box span.details {
        display: block;
        font-weight: 600;
        margin-bottom: 5px;
    }

    .user-details .input-box input,
    .user-details .input-box textarea,
    .group_input_style {
        height: 45px;
        width: 100%;
        outline: none;
        font-size: 16px;
        border-radius: 5px;
        padding-left: 15px;
        border: 1px solid #ccc;
        border-bottom-width: 2px;
        transition: all 0.3s ease;
    }

    .user-details .input-box select {
        height: 45px;
        width: 100%;
        outline: none;
        font-size: 16px;
        border-radius: 5px;
        padding-left: 15px;
        border: 1px solid #ccc;
        border-bottom-width: 2px;
        transition: all 0.3s ease;
    }

    .user-details .input-box input:focus,
    .user-details .input-box input:valid,
    .user-details .input-box textarea:focus {
        border-color: #CA9B49;
    }

    form .gender-details .gender-title {
        font-size: 20px;
        font-weight: 600;
    }

    form .category {
        display: flex;
        width: 80%;
        margin: 14px 0;
        justify-content: space-between;
    }

    form .category label {
        display: flex;
        align-items: center;
        cursor: pointer;
    }

    form .category label .dot {
        height: 18px;
        width: 18px;
        border-radius: 50%;
        margin-right: 10px;
        background: #d9d9d9;
        border: 5px solid transparent;
        transition: all 0.3s ease;
    }

    #dot-1:checked~.category label .one,
    #dot-2:checked~.category label .two,
    #dot-3:checked~.category label .three {
        background: #CA9B49;
        border-color: #d9d9d9;
    }

    form input[type="radio"] {
        display: none;
    }

    form .button {
        height: 45px;
        margin: 35px 0
    }

    form .button input {
        height: 100%;
        width: 100%;
        border-radius: 5px;
        border: none;
        color: #fff;
        font-size: 18px;
        font-weight: 500;
        letter-spacing: 1px;
        cursor: pointer;
        transition: all 0.3s ease;
        background: linear-gradient(135deg, #5f5386, #CA9B49);
    }

    form .button textarea {
        height: 100%;
        width: 100%;
        border-radius: 5px;
        border: none;
        color: #fff;
        font-size: 18px;
        font-weight: 500;
        letter-spacing: 1px;
        cursor: pointer;
        transition: all 0.3s ease;
        background: linear-gradient(135deg, #5f5386, #CA9B49);
    }

    form .button input:hover {
        /* transform: scale(0.99); */
        background: linear-gradient(135deg, #1B3425, #CA9B49);
    }

    form .button textarea:hover {
        /* transform: scale(0.99); */
        background: linear-gradient(135deg, #1B3425, #CA9B49);
    }

    @media(max-width: 584px) {
        .container {
            max-width: 100%;
        }

        form .user-details .input-box,
        .group_input {
            margin-bottom: 15px;
            width: 100%;
        }

        form .category {
            width: 100%;
        }

        .content form .user-details {
            max-height: 300px;
            overflow-y: scroll;
        }

        .user-details::-webkit-scrollbar {
            width: 5px;
        }
    }

    @media(max-width: 459px) {
        .container .content .category {
            flex-direction: column;
        }
    }
</style>

<style>

    .et_pb_text ol{

        justify-content: center;
    }

    .et_pb_text ol{
        max-width:500px;/*remove if full width*/
        text-align:justify;
    }

    .et_pb_text ol {
        position: relative;
        padding-left: 60px;
        margin-bottom: 20px;
        list-style: none !important;
    }

    .et_pb_text ol li {
        position: relative;
        margin-top: 0em;
        margin-bottom: 20px;
    }

    /*number styling - note that you will need to physically add in a span class*/
    .et_pb_text ol li .number_divider {
        position: absolute;
        font-weight: 800;
        font-size: 2em;
        left: -60px;
        top: -5px;
    }

    /*line styling*/
    .et_pb_text ol li:before {
        content: "";
        background: #ca9b49;
        position: absolute;
        width: 2px;
        top: 1px;
        bottom: -21px;
        left: -24px;
    }
    .et_pb_text ol .left:before {
        content: "";
        background: #e9543c;
        position: absolute;
        width: 2px;
        top: 1px;
        bottom: -21px;
        left: -24px;
    }
    /*dot styling*/
    .et_pb_text ol li:after {
        content: "";
        background: #ca9b49;
        position: absolute;
        width: 15px;
        height: 15px;
        border-radius: 100%;
        top: 1px;
        left: -31px;
    }
    .et_pb_text ol .left:after {
        content: "";
        background: #e9543c;
        position: absolute;
        width: 15px;
        height: 15px;
        border-radius: 100%;
        top: 1px;
        left: -31px;
    }
    .et_pb_text ol .complete:after {
        content: "";
        background: #49953d;
        position: absolute;
        width: 15px;
        height: 15px;
        border-radius: 100%;
        top: 1px;
        left: -31px;
    }
    /*removes line from last number*/
    .et_pb_text ol li:last-child:before {
        content: "";
        background: #ffffff;
    }
</style>
@php
    $chart=['#dff5ea','#c4f5dd','#a2ffd2','#76ffbd','#49ffa7','#22ff94','#00f980','#03e778','#01cb69','#05b962','#02a556','#029950','#048f4b','#067c42','#01723a'];

@endphp
    <body>
        <div>
            <div style="display: flex;justify-content: center;margin: 2rem;margin-bottom: 3rem;">
                <img class="logo" src="{{ asset('kshopina-express_b.png') }}" alt="ops" >
            </div>
            <div class="group_inf" >
                <div  class="inf_1"><span  > Group ID :</span>
                    <span class="inf_group_id" > G{{ sprintf("%02d", $group_orders[0][0]->group_city_id)}}{{ sprintf("%02d",$group_orders[0][0]->group_id)}} </span>
                </div>
                @foreach ($group_orders[0] as $order)
                        @if (isset($_GET['order_id']) && $order->group_orders_id==$_GET['order_id'])
                            <div style="margin-left: 5rem;" class="inf_2"><span >Your Rank :</span>
                        
                                <span class="inf_group_rank">{{$order->customer_rank}} </span>
                            </div>
                        @endif
                    @endforeach
                
                {{-- <div  class="inf_2"><span style="font-size: 20px" >Group members :</span> 
                    <span class="inf_group_rank">{{count($group_orders[0])}} </span>
                </div> --}}
            </div>
        </div>
        <div class="stacked-bar-graph">
            @for ($i = 0; $i < count($group_orders[0]); $i++)
            <span style="width:5%;background-color: {{$chart[$i]}}" class="bar-{{$i+1}}"><span class="number">{{$i+1}}</span></span>
            @endfor
            @for ($i = count($group_orders[0])+1; $i <= 15; $i++)
            <span style="width:5%;border: 1px #9a9a9a dashed;" class="bar-{{$i}}"><span class="number">{{$i}}</span></span>

            @endfor
            {{-- <span style="width:5%;border: 1px #9a9a9a dashed;" class="bar-2"><span class="number">2</span></span>
            <span style="width:5%;border: 1px #9a9a9a dashed;" class="bar-3"><span class="number">3</span></span>
            <span style="width:5%;border: 1px #9a9a9a dashed;" class="bar-4"><span class="number">4</span></span>
            <span style="width:5%;border: 1px #9a9a9a dashed;" class="bar-5"><span class="number">5</span></span>
            <span style="width:5%;border: 1px #9a9a9a dashed;" class="bar-6"><span class="number">6</span></span>
            <span style="width:5%;border: 1px #9a9a9a dashed;" class="bar-7"><span class="number">7</span></span>
            <span style="width:5%;border: 1px #9a9a9a dashed;" class="bar-8"><span class="number">8</span></span>
            <span style="width:5%;border: 1px #9a9a9a dashed;" class="bar-9"><span class="number">9</span></span>
            <span style="width:5%;border: 1px #9a9a9a dashed;" class="bar-10"><span class="number">10</span></span>
            <span style="width:5%;border: 1px #9a9a9a dashed;" class="bar-11"><span class="number">11</span></span>
            <span style="width:5%;border: 1px #9a9a9a dashed;" class="bar-12"><span class="number">12</span></span>
            <span style="width:5%;border: 1px #9a9a9a dashed;" class="bar-13"><span class="number">13</span></span>
            <span style="width:5%;border: 1px #9a9a9a dashed;" class="bar-14"><span class="number">14</span></span>
            <span style="width:5%;border: 1px #9a9a9a dashed;" class="bar-15"><span class="number">15</span></span> --}}

        </div>

        <div class="et_pb_text"  style="display: flex;justify-content: center;margin-top: 5rem;">
            <ol>
                @foreach ($group_orders[1] as $record)
                    
                    @if ($record->case_name =='Join')
                        <li>
                            <p>{{$record->customer_name}} just joins the group.</p>
                        </li>
                    @else
                        <li class="left">
                            <p>{{$record->customer_name}} left group.</p>
                        </li>
                    @endif
                @endforeach
               @if (count($group_orders[0])==15)
                <li class="complete">
                    <p>Group completed successfully</p>
                </li>
               
               @endif

                {{-- <li>
                    <p>Mahmoud left group.</p>
                </li>

                <li>
                    <p>Mahmoud just joins the group.</p>
                </li>
                <li>
                    <p>Mahmoud just joins the group.</p>
                </li>

                <li>
                    <p>Nour just joins the group.</p>
                </li>
                <li>
                    <p>Group is now completed.</p>
                </li> --}}
            </ol>
        </div>
    </body>



</html>
