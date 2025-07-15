@extends('layouts.staff_layout')

@section('content')
    <style>
        body {
            color: #1b3425;
        }

        .row {
            margin-bottom: 1.5rem !important;
            width: 100% !important;
        }

        .content-wrapper {
            padding: 1.5rem 0rem;
        }

        .stati {
            align-items: center;
            background: white;
            color: #1b3425;
            height: 9em;
            border: 1px solid #1b34253d;
            border-radius: 8px 8px 8px 8px;
            margin: 1em 0;
            transition: margin 0.5s ease, box-shadow 0.5s ease;
        }

        .stati:hover {
            margin-top: 0.5em;

        }


        .stati i {
            font-size: 3.5em;
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
            background-color: #1b3425;
            color: white;
        }


        .icon.icon-box-success {
            width: 40px;
            height: 37px;
            background: rgba(0, 210, 91, 0.11);
            border-radius: 7px;
            color: #00d25b;
        }

        .icon.icon-box-danger {
            width: 40px;
            height: 37px;
            background: rgba(252, 66, 74, 0.11);
            border-radius: 7px;
            color: #fc424a;
        }

        .card {
            border-radius: 0.5rem;
            height: 100%;
        }

        .bg-primary {
            background-color: white !important;
            height: 7rem;
        }

        .card_title {
            font-family: 'Bebas Neue', cursive;
            letter-spacing: .5px;
            text-align: center;
            padding: 8px;
            margin-bottom: 0rem;
        }

        .card_contents {
            display: flex;
            padding-top: 1rem;
        }

    </style>

    <style>
        html {
            --black: #21252a;
            --grey-1: #343A40;
            --grey-2: #495057;
            --grey-3: #868E96;
            --grey-4: #ADB5BD;
            --grey-5: #CED4DA;
            --grey-6: #DEE2E6;
            --grey-7: #E9ECEF;
            --grey-8: #F1F3F5;
            --grey-9: #F8F9FA;
            --trans-black: rgba(33, 37, 42, .9);
            --red: #e10600;
            --gold: #ffda65;
            --gold-dark: #a3862c;
            --bronze: #c99355;
            --bronze-dark: #80582c;
        }

        .list {
            width: 100%;
            margin-bottom: 0rem !important;
            max-width: 600px;
            margin: 1rem auto 2rem;
            border-radius: 0.4rem;
            box-shadow: 0px 12px 25px rgb(0 0 0 / 10%), 0px 5px 12px rgb(0 0 0 / 7%);
        }

        @media screen and (max-width: 800px) {
            .list {
                margin: 0 auto;
            }
        }

        .list__table {
            width: 100%;
            border-spacing: 0;
            color: var(--grey-3);
        }

        .list__header {
            padding: 0.5rem 2rem;
            background: white;
            border-top-left-radius: 0.4rem;
            border-top-right-radius: 0.4rem;
        }

        .list__header h1,
        .list__header h5 {
            margin: 0;
            padding: 0;
        }

        .list__header h5 {
            margin-bottom: 0.5rem;
            text-transform: uppercase;
            color: #1b3425;
            text-align: center;
            font-family: 'Bebas Neue', cursive;
            letter-spacing: 1px;
        }

        .list__value {
            display: block;
            font-size: 13px;
        }

        .list__label {
            font-size: 11px;
            opacity: 0.6;
        }

        .list__row {
            background: #f4f6f9;
            cursor: pointer;
            transition: all 300ms ease;
        }

        .list__row:hover,
        .list__row:focus {
            transform: scale(1.05);
            box-shadow: 0px 15px 28px rgba(0, 0, 0, 0.1), 0px 5px 12px rgba(0, 0, 0, 0.08);
            transition: all 300ms ease;
        }

        .list__row:not(:last-of-type) .list__cell {
            box-shadow: 0px 2px 0px rgba(0, 0, 0, 0.08);
        }

        .list__row:first-of-type {
            color: #442ca3;
            background: var(--grey-9);
        }

        .list__row:first-of-type .list__cell:first-of-type {
            background: #0900BB;
            color: var(--gold-dark);
        }

        .list__row:nth-of-type(2) {
            color: #6c086c;
            background: var(--grey-9);
        }

        .list__row:nth-of-type(2) .list__cell:first-of-type {
            background: #9c59e7;
            color: var(--grey-2);
        }

        .list__row:nth-of-type(3) {
            color: #c300b4;
            background: var(--grey-9);
        }

        .list__row:nth-of-type(3) .list__cell:first-of-type {
            background: #F5B0CB;
            color: var(--bronze-dark);
        }

        .list__cell {
            padding: 1rem;
        }

        .list__cell:first-of-type {
            text-align: center;
            padding: 1rem 0.2rem;
            background: #ebd2fb;
        }


        .button {
            font-family: inherit;
            border: 0;
            background: transparent;
            cursor: pointer;
        }

        .button:focus,
        .button:active {
            outline: 0;
        }

        .button--close {
            padding: 0;
            margin: 0;
            height: auto;
            line-height: 1;
            color: var(--grey-5);
        }

        .button--close:hover {
            color: var(--grey--4);
        }

        .driver {
            display: flex;
            align-items: flex-start;
            opacity: 0;
            position: relative;
            left: 100px;
            -webkit-animation: fade 500ms ease 150ms forwards;
            animation: fade 500ms ease 150ms forwards;
        }

        .driver__image {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            background-size: 220px;
            background-repeat: no-repeat;
            background-position: top center;
            border: 3px solid white;
            box-shadow: 0px 5px 12px rgba(0, 0, 0, 0.12);
            margin-right: 1.5rem;
        }

        .driver__content {
            width: auto;
        }

        .driver__title {
            font-weight: 700;
            font-size: 1.6rem;
            margin: 0.5rem 0;
        }

        .driver__table {
            width: 100%;
            color: var(--grey-2);
        }

        .driver__table small {
            color: var(--grey-4);
        }

        .driver__table td {
            padding: 0.3rem 0.6rem 0.3rem 0;
            height: 2rem;
        }

        .driver__table td img {
            position: relative;
            top: 5px;
            margin-right: 6px;
        }

        @-webkit-keyframes fade {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
                left: 0;
            }
        }

        @keyframes fade {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
                left: 0;
            }
        }

        .list__bar {
            width: 6rem;
        }

    </style>

    <style>
        .tag {
            font-weight: 600;
            letter-spacing: .7px;
            font-size: 14px;
            background-color: #36304a;
            border-radius: 55px;
            padding: 6px 15px 6px 15px;
            border-color: #36304a;
            color: white;
            display: inline-grid;
            margin-right: 15px;
            margin-bottom: 15px;
        }

        .tag:hover {
            color: #ca9b49;
            text-decoration: none;
            cursor: pointer;
        }

        .floating-button-menu {
            z-index: 5;
            position: fixed;
            bottom: 10px;
            right: 50px;
            cursor: pointer;
            background: #1b3425;
            border-radius: 50%;
            min-width: 50px;
            max-width: 0px;
            min-height: 50px;
            max-height: 0px;
            box-shadow: 2px 1px 8px 1px rgb(0 0 0 / 25%);
            transition: all ease-in-out 0.8s;
        }

        .floating-button-menu:hover {
            background: #1b3425;
        }

        .floating-button-menu .floating-button-menu-links {
            width: 0;
            height: 0;
            overflow: hidden;
            opacity: 0;
            transition: all 0.4s;
        }

        .floating-button-menu .floating-button-menu-links a {
            position: relative;
            color: #454545;
            text-decoration: none;
            line-height: 50px;
            display: block;
            display: block;
            border-bottom: 1px solid #ccc;
            width: 100%;
            height: 45px;
            padding: 0 20px;
            border-bottom: 0.5px solid #ccc;
            transition: background ease-in-out 0.8s;
            background: rgba(0, 0, 0, 0);
        }

        .floating-button-menu .floating-button-menu-links a:hover {
            background: rgba(0, 0, 0, 0.1);
        }

        .floating-button-menu .floating-button-menu-links a:last-child {
            border-bottom: 0px solid #fff;
        }

        .floating-button-menu .floating-button-menu-links.menu-on {
            width: 450px;
            height: 400px;
            border-radius: 10px;
            opacity: 1;
            transition: all ease-in-out 0.8s;
        }

        .floating-button-menu .floating-button-menu-label {
            text-align: center;
            line-height: 74px;
            font-size: 25px;
            color: #fff;
            opacity: 1;
            transition: opacity 0.3s;
        }

        .floating-button-menu .floating-button-menu-label:hover {
            color: #ca9b49;
        }

        .floating-button-menu.menu-on {
            background: #fff;
            max-width: 400px;
            max-height: 3300px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
        }

        .floating-button-menu.menu-on .floating-button-menu-links {
            width: 100%;
            height: 100%;
            opacity: 1;
            transition: all ease-in-out 1s;
        }

        .floating-button-menu.menu-on .floating-button-menu-label {
            height: 0px;
            overflow: hidden;
        }

        .floating-button-menu-close {
            position: fixed;
            z-index: 2;
            width: 0%;
            height: 0%;
        }

        .floating-button-menu-close.menu-on {
            width: 100%;
            height: 100%;
        }

        .vl {
            border-left: 1px solid #c8cecb;
            height: 80px;
        }

    </style>

    <style>
        @media (min-width: 768px){
            .col-md-2{
                flex: 1 0 16.666667% !important;
                max-width: 20.666667% !important;
            }
        }

    </style>

    <style>
        .bargraph {
            list-style: none;
            width: auto;
            position: relative;
        }
        .bargraph li {
            position: relative;
            height: 60px;
            margin-bottom: 5px;
            transition: width 2s;
            -webkit-transition: width 2s;
            margin-top: 12px;
            border-radius: 2px;
        }
        .bargraph li span {
            position: absolute;
            left: 100%;
            margin-left: 1rem;
            width: 120px;
            margin-top: 1rem;
        }
    </style>

    <style>
        .loader {
            border: 4px solid #f3f3f3;
            border-radius: 50%;
            border-top: 4px solid #1b3425;
            width: 15px;
            height: 15px;
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

        .weekInput:focus-visible{
            outline: none;
            border: none;
        }
    </style>

    <div class="floating-button-menu-close"></div>

    <div class="content-wrapper">

        <div class="row">

            <div class="col-md-2">
                <div class="row stati turquoise"
                    style="box-shadow: 0px 0.2em 0.4em rgb(0 0 0 / 15%); display: flex;flex-direction: column;justify-content: center;">
                    <div style="width: 100%;margin-bottom: 16px;">
                        <p class="card_title" style="display: flex;flex-direction: row;align-items: center;justify-content: center;">
                            Today orders <span style="color: #c99b47;font-size: 20px;margin: 0px 8px;width: fit-content;">({{$orders_per_day}})</span>
                        </p>
                        <hr style="margin-top: 0px;margin-bottom: 0px;width: 65%;">
                    </div>
                    <div class="card_contents"  style="flex-direction: column;padding-top: 0rem;">
                        <div style="display: flex;align-items: center;width: 10vw;justify-content: space-around;font-size: x-small;margin: 2px;">
                            <div style="display: flex;flex-direction: row;">
                                <p style="margin-bottom: 0px;">
                                    Origin
                                </p>
                                <p style="margin-bottom: 0px;margin-left: 2px;">|</p>
                                <p style="margin-bottom: 0px;margin-left: 4px;">
                                    {{$orders_per_day_O}}
                                </p>
                            </div>
                            <div style="display: flex;flex-direction: row;">
                                <p style="margin-bottom: 0px;">
                                    KSA
                                </p>
                                <p style="margin-bottom: 0px;margin-left: 2px;">|</p>
                                <p style="margin-bottom: 0px;margin-left: 4px;">
                                    {{$orders_per_day_KSA}}
                                </p>
                            </div>
                            <div style="display: flex;flex-direction: row;">
                                <p style="margin-bottom: 0px;">
                                    EG
                                </p>
                                <p style="margin-bottom: 0px;margin-left: 2px;">|</p>
                                <p style="margin-bottom: 0px;margin-left: 4px;">
                                    {{$orders_per_day_EG}}
                                </p>
                            </div>
                        </div>
                        <div style="display: flex;align-items: center;width: 10vw;justify-content: space-around;font-size: x-small;margin: 2px;">
                            <div style="display: flex;flex-direction: row;">
                                <p style="margin-bottom: 0px;">
                                    KW
                                </p>
                                <p style="margin-bottom: 0px;margin-left: 2px;">|</p>
                                <p style="margin-bottom: 0px;margin-left: 4px;">
                                    {{$orders_per_day_KW}}
                                </p>
                            </div>
                            <div style="display: flex;flex-direction: row;">
                                <p style="margin-bottom: 0px;">
                                    UAE
                                </p>
                                <p style="margin-bottom: 0px;margin-left: 2px;">|</p>
                                <p style="margin-bottom: 0px;margin-left: 4px;">
                                    {{$orders_per_day_UAE}}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="row stati turquoise "
                    style="box-shadow: 0px 0.2em 0.4em rgb(0 0 0 / 15%); display: flex;flex-direction: column;justify-content: center;">
                    <div>
                        <p class="card_title">Daily profit</p>
                        <hr style="margin-top: 0px;margin-bottom: 0px;">
                    </div>
                    <div class="card_contents"  >
                        <div style="display: flex; align-items: center; justify-content: space-between;width: 5vw;">
                            
                            <h3 style="padding: 4px;color: #cb9d48;">{{$daily_profit}}</h3> 
                            <h6 style="font-family: 'Bebas Neue', cursive !important;font-size: 40px;letter-spacing: 1px;margin-bottom: 0px;">
                                $
                            </h6>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="row stati turquoise  "
                    style="box-shadow: 0px 0.2em 0.4em rgb(0 0 0 / 15%); display: flex;flex-direction: column;justify-content: center;">
                    <div>
                        <p class="card_title">
                            Visa payments in all store </p>
                        <hr style="margin-top: 0px;margin-bottom: 0px;">
                    </div>
                    <div class="card_contents">
                        <div style="display: flex; align-items: center;">
                            <h3 style="padding: 8px; color: #cb9d48;"> {{ $percent_visa }}</h3>
                            <span
                                style="font-family: 'Bebas Neue', cursive !important;font-size: 40px;letter-spacing: 1px;">%</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-2">
                <div class="row stati turquoise"
                    style="box-shadow: 0px 0.2em 0.4em rgb(0 0 0 / 15%);display: grid;justify-content: center;">
                    <div>
                        <p class="card_title">Today Delivery</p>
                        <hr style="margin-top: 0px;margin-bottom: 0px;">
                    </div>
                    <div style="display: flex;flex-direction: column;align-items: center;margin-bottom: 12px;">
                        <div class="card_contents" style="padding: 0px;">
                            <div style="display: flex; align-items: center; justify-content: space-around;width: 5vw;">
                                
                                <h3 style="padding: 4px;color: #cb9d48;">{{$delivered_orders + $refused_orders}}</h3> 
                                <h6 style="font-family: 'Bebas Neue', cursive !important;font-size: 14px;letter-spacing: 1px;margin-bottom: 0px;">
                                    @if ( ($delivered_orders + $refused_orders )> 10 || ($delivered_orders + $refused_orders ) == 0)
                                        order
                                    @else
                                        orders
                                    @endif
                                </h6>
                                
                            </div>
                        </div>
                        <div style="display: flex;align-items: center;width: 10vw;justify-content: space-around;font-size: x-small;">
                            <div style="display: flex;flex-direction: row;">
                                <p style="margin-bottom: 0px;">
                                    Delivered
                                </p>
                                <p style="margin-bottom: 0px;margin-left: 2px;">|</p>
                                <p style="margin-bottom: 0px;margin-left: 4px;">
                                {{$delivered_orders}}
                                </p>
                            </div>
                            
                            <div style="display: flex;flex-direction: row;">
                                <p style="margin-bottom: 0px;">
                                    Refused
                                </p>
                                <p style="margin-bottom: 0px;margin-left: 2px;">|</p>
                                <p style="margin-bottom: 0px;margin-left: 4px;">
                                    {{$refused_orders}}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-2">
                <div class="row stati turquoise  "
                    style="box-shadow: 0px 0.2em 0.4em rgb(0 0 0 / 15%); display: grid;justify-content: center;">
                    <div>
                        <p class="card_title">Today Complains</p>
                        <hr style="margin-top: 0px;margin-bottom: 0px;">
                    </div>
                    <div style="display: flex;flex-direction: column;align-items: center;margin-bottom: 12px;">
                        <div class="card_contents" style="padding: 0px;">
                            <div style="display: flex; align-items: center; justify-content: space-around;width: 5vw;">
                                
                                <h3 style="padding: 4px;color: #cb9d48;">{{$number_of_complains}}</h3> 
                                <h6 style="font-family: 'Bebas Neue', cursive !important;font-size: 14px;letter-spacing: 1px;margin-bottom: 0px;">
                                    @if ( $number_of_complains >= 11 )
                                        Complaint
                                    @else
                                        Complaints
                                    @endif
                                </h6>
                                
                            </div>
                        </div>
                        <div style="display: flex;align-items: center;width: 10vw;justify-content: space-around;font-size: x-small;">
                            <div style="display: flex;flex-direction: row;">
                                <p style="margin-bottom: 0px;">
                                    Solved
                                </p>
                                <p style="margin-bottom: 0px;margin-left: 2px;">|</p>
                                <p style="margin-bottom: 0px;margin-left: 4px;">
                                {{$solved_complains}}
                                </p>
                            </div>
                            
                            <div style="display: flex;flex-direction: row;">
                                <p style="margin-bottom: 0px;">
                                    Not-Solved
                                </p>
                                <p style="margin-bottom: 0px;margin-left: 2px;">|</p>
                                <p style="margin-bottom: 0px;margin-left: 4px;">
                                    {{$number_of_complains - $solved_complains}}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="row stati turquoise"
                    style="box-shadow: 0px 0.2em 0.4em rgb(0 0 0 / 15%);display: flex; justify-content: space-evenly; height: 4em; margin: 0px;">
                    <span style="font-size: 18px;font-weight: 500;font-family: 'Bebas Neue', cursive;letter-spacing: 1px;">origin orders : </span>
                    @foreach ($origin_countries_daily_orders as $country => $daily_orders) 
                        <div style="display: flex;flex-direction: row;font-size: smaller;">
                            <p style="margin-bottom: 0px;">
                                {{$country}}
                            </p>
                            <p style="margin-bottom: 0px;margin-left: 2px;">|</p>
                            <p style="margin-bottom: 0px;margin-left: 4px;">
                                {{$daily_orders}}
                            </p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12 ">
                <div class="card">
                    <div
                        style="font-size: 30px;margin-top: 10px;font-family: 'Bebas Neue', cursive;letter-spacing: 1px;display: flex;justify-content: center;">
                        Total Orders</div>
                    <div class="card-body">
                        <canvas id="verified_time_chart" style="max-height:300px; width:36rem;"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">

            <div class="col-lg-6 ">
                <div class="card">
                    <div style="font-size: 30px;margin-top: 10px;font-family: 'Bebas Neue', cursive;letter-spacing: 1px;display: flex;justify-content: center;">
                        Total Revenue in stores </div>
                    <div class="card-body">
                        <canvas id="profits_per_months" style="max-height:300px; width:36rem;"></canvas>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-6 ">
                <div class="card">
                    <div style="font-size: 30px;margin-top: 10px;font-family: 'Bebas Neue', cursive;letter-spacing: 1px;display: flex;justify-content: center;">
                        Years revenue</div>
                    <div class="card-body">
                        <canvas id="years_revenue" style="max-height:300px; width:36rem;"></canvas>
                    </div>
                </div>
            </div>
            
        </div>

        <div class="row"> 

            <div class="col-lg-6 ">
                <div class="card">
                    <div style="font-size: 30px;margin-top: 70px;font-family: 'Bebas Neue', cursive;letter-spacing: 1px;display: flex;justify-content: center;">
                         Orders status</div>
                    <div class="card-body">
                        <canvas id="orders_status_per_months" style="max-height:300px; width:36rem;"></canvas>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 ">
                <div class="card">
                    <div style="font-size: 30px;margin: 10px 0px 5px;font-family: 'Bebas Neue', cursive;letter-spacing: 1px;display: flex;justify-content: center;">
                        Weekly orders
                    </div>
                
                    <div style="display: flex;justify-content: center;align-items: center;">
                        <label for="weekInput" style="font-weight: 600;margin: 0px 0px 0px -50px;">Select a Week:</label>
                        <input type="week" id="weekInput" name="weekInput"  style="margin: 0px 10px;" class="weekInput" >
                        <div id="week_submit">
                            <button  class="btn" type="submit" style="font-size: 10px;" onclick="week_choose()" >Get data</button>
                        </div>
                    </div>
                    
                    <div class="card-body">
                        <canvas id="weekly_orders" style="max-height:300px; width:36rem;"></canvas>
                    </div>

                    <div style="display: flex;margin: 10px 0px 20px;flex-wrap: wrap;padding: 0px 20px;justify-content: space-evenly;">
                        @foreach ($week_data_percentage as $day => $count)
                        
                            <div style="display: flex;align-items: center;margin: 5px 10px;width: 120px;"> 
                                <span style="font-weight: 700;">{{ $loop->index + 1 }} - {{$day}}:</span>
                                <span style="font-size: 12px;margin-left: 5px;">{{ round(($count/$all_order_num) * 100 , 2) }}%</span> 
                            </div>
                    
                        @endforeach
                    </div>
                </div>
            </div>


        </div>

        <div class="row"> 

            <div class="col-lg-6 ">
                @php
                    $other_percentage=0;
                @endphp
                <div class="card">
                    <div style="font-size: 30px;margin-top: 10px;font-family: 'Bebas Neue', cursive;letter-spacing: 1px;display: flex;justify-content: center;">
                        Total Visitors in stores </div>
                    <div style="font-size: 24px;margin-top: 10px;font-family: 'Bebas Neue', cursive;letter-spacing: 1px;display: flex;justify-content: center;">
                            All visits : <span> {{$visitors_count}}  </span>
                    </div>
                    {{-- <div style="display: flex;margin-top: 10px;flex-wrap: wrap;padding: 0px 20px;">
                        @foreach ($countries_count as $country_name => $country_number)
                            @if( $loop->index <= 9)

                                <div style="display: flex;align-items: center;justify-content: space-between;margin: 0px 10px;"> 
                                    <span style="font-weight: 700;">{{$country_name}}:</span>
                                    <span style="font-size: 12px;margin-left: 5px;">{{ round(($country_number/$visitors_count) * 100 , 2) }}%</span> 
                                </div>

                            @else
                    
                                @php
                                    $other_percentage=$other_percentage+$country_number
                                @endphp

                            @endif

                        @endforeach
                            <div style="display: flex;align-items: center;justify-content: space-between;margin: 0px 10px;"> 
                                <span style="font-weight: 700;">Others:</span>
                                <span style="font-size: 12px;margin-left: 5px;">{{ round(( $other_percentage/$visitors_count) * 100 , 2) }} %</span> 
                            </div>
                    --}}
                    <div class="card-body">
                        <canvas id="visitors_stores_per_months" style="max-height:300px; width:36rem;"></canvas>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 ">

                <div class="card">
                    <div style="font-size: 30px;margin-top: 40px;font-family: 'Bebas Neue', cursive;letter-spacing: 1px;display: flex;justify-content: center;">
                        Visitors in countries 
                    </div>
                    <div class="card-body">
                        <canvas id="visitors_per_months" style="max-height:300px; width:36rem;"></canvas>
                    </div>
                </div>
            </div>

        </div>

        <div class="row" style="display: flex;justify-content: center;">
            <div class="col-lg-6 ">
                <div class="card">
                    <div
                        style="font-size: 30px;margin-top: 10px;font-family: 'Bebas Neue', cursive;letter-spacing: 1px;display: flex;justify-content: center;">
                        Complaints rate</div>
                    <div class="card-body">
                        <canvas id="complaints_rate" style="height:230px"></canvas>

                        <h1 id="average_rate" style="margin-top: 15px;font-size: 1.3rem;font-family: 'Bebas Neue', cursive;letter-spacing: .5px;display: flex;justify-content: center;align-items: baseline;"></h1>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 ">
                <div class="card">
                    <div
                        style="font-size: 30px;margin-top: 40px;font-family: 'Bebas Neue', cursive;letter-spacing: 1px;display: flex;justify-content: center;">
                        Precentage of Inquries</div>
                    <div class="card-body">
                        <canvas id="complains" style="height:230px"></canvas>
                    </div>
                </div>
            </div>

        </div>

        
        
    </div>
     
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script>

    <script type="text/javascript">
        let weekly_orders_chart;
        $(function() {

            'use strict';

            // variables

                var origin_year = JSON.parse('{!! json_encode($origin_year_data) !!}');
                var plus_egypt_year = JSON.parse('{!! json_encode($plus_egypt_year_data) !!}');
                var plus_ksa_year = JSON.parse('{!! json_encode($plus_ksa_year_data) !!}');
                var plus_kuwait_year = JSON.parse('{!! json_encode($plus_kuwait_year_data) !!}');
                var plus_uae_year = JSON.parse('{!! json_encode($plus_uae_year_data) !!}');

                var origin_year_data = [];
                var plus_egypt_year_data = [];
                var plus_ksa_year_data = [];
                var plus_kuwait_year_data = [];
                var plus_uae_year_data = [];

                var all_year_data = [];

                
                for (let index = 1; index <= 12; index++) {

                    var origin_element = origin_year[index];

                    origin_year_data.push(origin_element);

                    var egypt_element = plus_egypt_year[index];

                    plus_egypt_year_data.push(egypt_element);

                    var ksa_element = plus_ksa_year[index];

                    plus_ksa_year_data.push(ksa_element);

                    var kuwait_element = plus_kuwait_year[index];

                    plus_kuwait_year_data.push(kuwait_element);

                    var uae_element = plus_uae_year[index];

                    plus_uae_year_data.push(uae_element);

                    all_year_data.push(origin_element + egypt_element + ksa_element + kuwait_element + uae_element);
                }

                var cancel_order = JSON.parse('{!! json_encode($cancel_order) !!}');
                var Rescheduling = JSON.parse('{!! json_encode($Rescheduling) !!}');
                var lmd_or_late = JSON.parse('{!! json_encode($lmd_or_late) !!}');
                var customer_others = JSON.parse('{!! json_encode($customer_others) !!}');
                var product_inquries = JSON.parse('{!! json_encode($product_inquries) !!}');
                var guest_others = JSON.parse('{!! json_encode($guest_others) !!}');

                var special_cases = JSON.parse('{!! json_encode($special_cases) !!}');
                
                var all_number_of_resons = JSON.parse('{!! json_encode($all_number_of_resons) !!}');

                var rate_1 = JSON.parse('{!! json_encode($complaint_rate_1) !!}');
                var rate_2 = JSON.parse('{!! json_encode($complaint_rate_2) !!}');
                var rate_3 = JSON.parse('{!! json_encode($complaint_rate_3) !!}');
                var rate_4 = JSON.parse('{!! json_encode($complaint_rate_4) !!}');
                var rate_5 = JSON.parse('{!! json_encode($complaint_rate_5) !!}');

                var ksp_num_origin = JSON.parse('{!! json_encode($ksp_num_origin) !!}');
                var ksp_num_egypt = JSON.parse('{!! json_encode($ksp_num_egypt) !!}');
                var ksp_num_ksa = JSON.parse('{!! json_encode($ksp_num_ksa) !!}');
                var ksp_num_kuwait = JSON.parse('{!! json_encode($ksp_num_kuwait) !!}');
                var ksp_num_uae = JSON.parse('{!! json_encode($ksp_num_uae) !!}');

                const titles = Object.keys(ksp_num_origin);
                const ksp_num_origin_data = Object.values(ksp_num_origin);
                const ksp_num_egypt_data = Object.values(ksp_num_egypt);
                const ksp_num_ksa_data = Object.values(ksp_num_ksa);
                const ksp_num_kuwait_data = Object.values(ksp_num_kuwait);
                const ksp_num_uae_data = Object.values(ksp_num_uae);
                const ksp_num_all_data = [];

                for(var i = 0; i < ksp_num_origin_data.length; i++){
                    ksp_num_all_data.push(ksp_num_origin_data[i] + ksp_num_egypt_data[i] + ksp_num_ksa_data[i] + ksp_num_kuwait_data[i] + ksp_num_uae_data[i]);
                }
                
                var Verified_orders_year = JSON.parse('{!! json_encode($Verified_orders_year_data) !!}');
                var Cancelled_orders_year = JSON.parse('{!! json_encode($Cancelled_orders_year_data) !!}');
                var Delivered_orders_year = JSON.parse('{!! json_encode($Delivered_orders_year_data) !!}');
                var Refused_orders_year = JSON.parse('{!! json_encode($Refused_orders_year_data) !!}');

                var total_profit_origin = JSON.parse('{!! json_encode($total_profit_origin) !!}');
                var total_profit_egypt = JSON.parse('{!! json_encode($total_profit_egypt) !!}');
                var total_profit_kuwait = JSON.parse('{!! json_encode($total_profit_kuwait) !!}');
                var total_profit_ksa = JSON.parse('{!! json_encode($total_profit_ksa) !!}');
                var total_amount_uae = JSON.parse('{!! json_encode($total_amount_uae) !!}');
                var total_profit_all = JSON.parse('{!! json_encode($total_profit_all) !!}');
                
                var countries_visits_monthly = JSON.parse('{!! json_encode($countries_visits_monthly) !!}');

                var countries_names_arr = Object.keys(countries_visits_monthly)

                var countries_values_arr = Object.values(countries_visits_monthly)
                
                var years_revenue = JSON.parse('{!! json_encode($years_revenue) !!}');

                var week_data = JSON.parse('{!! json_encode($week_data) !!}');

                
            //end

            // multi line graph for VERIFIED ORDERS ALONG TIME

                var ctx_verified_time = document.getElementById("verified_time_chart").getContext('2d');

                var myChart = new Chart(ctx_verified_time, {
                    type: 'line',
                    data: {
                        labels: ["JANUARY", "FEBRUARY", "MARCH", "APRIL", "MAY", "JUNE",
                            "JULY", "AUGUST", "SEPTEMBER", "OCTOBER", "NOVEMBER", "DECEMBER"
                        ],
                        datasets: [{
                                label: 'All', // Name the series
                                data: all_year_data, // Specify the data values array
                                fill: false,
                                borderColor: '#4B4A59', // Add custom color border (Line)
                                backgroundColor: '#4B4A59', // Add custom color background (Points and Fill)
                                borderWidth: 1 // Specify bar border width
                            },
                            {
                                label: 'Original', // Name the series
                                data: origin_year_data, // Specify the data values array
                                fill: false,
                                borderColor: '#E84855', // Add custom color border (Line)
                                backgroundColor: '#E84855', // Add custom color background (Points and Fill)
                                borderWidth: 1 // Specify bar border width
                            },
                            {
                                label: 'Egypt', // Name the series
                                data: plus_egypt_year_data, // Specify the data values array
                                fill: false,
                                borderColor: '#FACF0E', // Add custom color border (Line)
                                backgroundColor: '#FACF0E', // Add custom color background (Points and Fill)
                                borderWidth: 1 // Specify bar border width
                            },
                            {
                                label: 'KSA', // Name the series
                                data: plus_ksa_year_data, // Specify the data values array
                                fill: false,
                                borderColor: '#3185FC', // Add custom color border (Line)
                                backgroundColor: '#3185FC', // Add custom color background (Points and Fill)
                                borderWidth: 1 // Specify bar border width
                                },
                            {
                                label: 'Kuwait', // Name the series
                                data: plus_kuwait_year_data, // Specify the data values array
                                fill: false,
                                borderColor: '#BF5C8C', // Add custom color border (Line)
                                backgroundColor: '#BF5C8C', // Add custom color background (Points and Fill)
                                borderWidth: 1 // Specify bar border width
                            },
                            {
                                label: 'UAE', // Name the series
                                data: plus_uae_year_data, // Specify the data values array
                                fill: false,
                                borderColor: '#51bb6b', // Add custom color border (Line)
                                backgroundColor: '#51bb6b', // Add custom color background (Points and Fill)
                                borderWidth: 1 // Specify bar border width
                            }
                        ]
                    },
                    options: {
                        responsive: true, // Instruct chart js to respond nicely.
                        maintainAspectRatio: false, // Add to prevent default behaviour of full-width/height
                    }
                });

            //END

            //bar chart for percentage of reasons of complains

                var complains_data = {
                    labels: ["Cancel order", "Reschedule", "No response", "Cust. others", "Product inquries" , "Guest others" , "Special cases"],
                    datasets: [{
                        label: "Rate of reason",
                        data: [
                            parseFloat(((cancel_order / all_number_of_resons) * 100).toFixed(1)),
                            parseFloat(((Rescheduling / all_number_of_resons) * 100).toFixed(1)),
                            parseFloat(((lmd_or_late / all_number_of_resons) * 100).toFixed(1)),
                            parseFloat(((customer_others / all_number_of_resons) * 100).toFixed(1)),
                            parseFloat(((product_inquries / all_number_of_resons) * 100).toFixed(1)),
                            parseFloat(((guest_others / all_number_of_resons) * 100).toFixed(1)) ,
                            parseFloat(((special_cases / all_number_of_resons) * 100).toFixed(1))
                        ],
                        
                        backgroundColor: [
                            '#CC3803',
                            '#F58320',
                            '#F5E31F',
                            '#006C14',
                            '#3185FC',
                            '#218380' ,
                            '#51bb6b'

                        ],
                        borderColor: [
                            '#CC3803',
                            '#F58320',
                            '#F5E31F',
                            '#006C14',
                            '#3185FC',
                            '#218380',
                            '#51bb6b'
                        ],
                        borderWidth: 1
                    }]
                };

                if ($("#complains").length) {
                    var complain_reasons = document.getElementById("complains").getContext("2d");
                    // This will get the first returned node in the jQuery collection.
                    var complain_chart = new Chart(complain_reasons, {
                        type: 'bar',
                        data: complains_data,
                        options: complains_options
                    });
                }

            //END

            //pie chart for solved and not solved complains each day

                var total_rate= rate_1+ rate_2 +rate_3+rate_4+rate_5;
                var label_complains_today = ["1 Star", "2 Stars","3 Stars","4 Stars","5 Stars"];
                var backgroundColor_complains_today = ["#CC0202", "#f58320","#f5e31f","#218380","#00A40E"];
                var data_complains_today = [parseFloat(((rate_1/total_rate)*100).toFixed(1)), parseFloat(((rate_2/total_rate)*100 ).toFixed(1)),
                parseFloat(((rate_3/total_rate)*100).toFixed(1)),parseFloat(((rate_4/total_rate)*100).toFixed(1)),parseFloat(((rate_5/total_rate)*100).toFixed(1))];

                var average_rate = parseFloat(((rate_1*1 + rate_2*2 + rate_3*3 + rate_4*4 + rate_5*5) / (rate_1+ rate_2 +rate_3+rate_4+rate_5) ).toFixed(1));
                $("#average_rate").html("Average rate : "+average_rate +"&nbsp;<i style='position: relative;top: -1px;font-size: 15px;' class='far fa-star'></i>");
                
                var complains_piechart = document.getElementById("complaints_rate").getContext('2d');
                var complain_solved_chart = new Chart(complains_piechart, {
                    type: 'pie',
                    data: {
                        labels: label_complains_today,
                        datasets: [{
                            backgroundColor: backgroundColor_complains_today,
                            data: data_complains_today
                        }]
                    }
                });
            //End

            //multi line graph of visitors of each store tracking per month along time

                var ctx_visitors_per_months = document.getElementById("visitors_stores_per_months").getContext('2d');
                
                var myChart_visitors = new Chart(ctx_visitors_per_months, {
                    type: 'line',
                    data: {
                        labels: titles,
                        
                        datasets: [{
                                label: 'All', // Name the series
                                data: ksp_num_all_data, // Specify the data values array
                                fill: false,
                                borderColor: '#4B4A59', // Add custom color border (Line)
                                backgroundColor: '#4B4A59', // Add custom color background (Points and Fill)
                                borderWidth: 1 // Specify bar border width
                            },
                            {
                                label: 'Original', // Name the series
                                data: ksp_num_origin_data, // Specify the data values array
                                fill: false,
                                borderColor: '#E84855', // Add custom color border (Line)
                                backgroundColor: '#E84855', // Add custom color background (Points and Fill)
                                borderWidth: 1 // Specify bar border width
                            },
                            {
                                label: 'Egypt', // Name the series
                                data: ksp_num_egypt_data, // Specify the data values array
                                fill: false,
                                borderColor: '#FACF0E', // Add custom color border (Line)
                                backgroundColor: '#FACF0E', // Add custom color background (Points and Fill)
                                borderWidth: 1 // Specify bar border width
                            },
                            {
                                label: 'KSA', // Name the series
                                data: ksp_num_ksa_data, // Specify the data values array
                                fill: false,
                                borderColor: '#3185FC', // Add custom color border (Line)
                                backgroundColor: '#3185FC', // Add custom color background (Points and Fill)
                                borderWidth: 1 // Specify bar border width
                            },
                            {
                                label: 'Kuwait', // Name the series
                                data: ksp_num_kuwait_data, // Specify the data values array
                                fill: false,
                                borderColor: '#BF5C8C', // Add custom color border (Line)
                                backgroundColor: '#BF5C8C', // Add custom color background (Points and Fill)
                                borderWidth: 1 // Specify bar border width
                            },
                            {
                                label: 'UAE', // Name the series
                                data: ksp_num_uae_data, // Specify the data values array
                                fill: false,
                                borderColor: '#51bb6b', // Add custom color border (Line)
                                backgroundColor: '#51bb6b', // Add custom color background (Points and Fill)
                                borderWidth: 1 // Specify bar border width
                            }

                        ]
                    },
                    options: {
                        responsive: true, // Instruct chart js to respond nicely.
                        maintainAspectRatio: false, // Add to prevent default behaviour of full-width/height
                    }
                });

            //End

            //multi line graph of visitors of each store tracking per month along time

                var ctx_visitors_per_months = document.getElementById("visitors_per_months").getContext('2d');
                
                var myChart_visitors = new Chart(ctx_visitors_per_months, {
                    type: 'line',
                    data: {
                        labels: Object.keys(countries_values_arr[0]) ,
                        
                        datasets: [
                            {
                                label: countries_names_arr[0], // Name the series
                                data: Object.values(countries_values_arr[0]), // Specify the data values array
                                fill: false,
                                borderColor: '#3185FC', // Add custom color border (Line)
                                backgroundColor: '#3185FC', // Add custom color background (Points and Fill)
                                borderWidth: 1 // Specify bar border width
                            },
                            {
                                label: countries_names_arr[1], // Name the series
                                data: Object.values(countries_values_arr[1]), // Specify the data values array
                                fill: false,
                                borderColor: '#FACF0E', // Add custom color border (Line)
                                backgroundColor: '#FACF0E', // Add custom color background (Points and Fill)
                                borderWidth: 1 // Specify bar border width
                            },
                            {
                                label:countries_names_arr[2], // Name the series
                                data: Object.values(countries_values_arr[2]), // Specify the data values array
                                fill: false,
                                borderColor: '#BF5C8C', // Add custom color border (Line)
                                backgroundColor: '#BF5C8C', // Add custom color background (Points and Fill)
                                borderWidth: 1 // Specify bar border width
                            },
                            {
                                label: countries_names_arr[3], // Name the series
                                data: Object.values(countries_values_arr[3]), // Specify the data values array
                                fill: false,
                                borderColor: '#51bb6b', // Add custom color border (Line)
                                backgroundColor: '#51bb6b', // Add custom color background (Points and Fill)
                                borderWidth: 1 // Specify bar border width
                            },
                            {
                                label: countries_names_arr[4], // Name the series
                                data: Object.values(countries_values_arr[4]), // Specify the data values array
                                fill: false,
                                borderColor: '#4B4A59', // Add custom color border (Line)
                                backgroundColor: '#4B4A59', // Add custom color background (Points and Fill)
                                borderWidth: 1 // Specify bar border width
                            },
                            {
                                label: countries_names_arr[5], // Name the series
                                data: Object.values(countries_values_arr[5]), // Specify the data values array
                                fill: false,
                                borderColor: '#E84855', // Add custom color border (Line)
                                backgroundColor: '#E84855', // Add custom color background (Points and Fill)
                                borderWidth: 1 // Specify bar border width
                            },
                            {
                                label: countries_names_arr[6], // Name the series
                                data: Object.values(countries_values_arr[6]), // Specify the data values array
                                fill: false,
                                borderColor: '#3d5bd3', // Add custom color border (Line)
                                backgroundColor: '#3d5bd3', // Add custom color background (Points and Fill)
                                borderWidth: 1 // Specify bar border width
                            },
                            {
                                label: countries_names_arr[7], // Name the series
                                data: Object.values(countries_values_arr[7]), // Specify the data values array
                                fill: false,
                                borderColor: '#f58320', // Add custom color border (Line)
                                backgroundColor: '#f58320', // Add custom color background (Points and Fill)
                                borderWidth: 1 // Specify bar border width
                            },
                            {
                                label: countries_names_arr[8], // Name the series
                                data: Object.values(countries_values_arr[8]), // Specify the data values array
                                fill: false,
                                borderColor: '#c586db', // Add custom color border (Line)
                                backgroundColor: '#c586db', // Add custom color background (Points and Fill)
                                borderWidth: 1 // Specify bar border width
                            },
                            {
                                label: countries_names_arr[9], // Name the series
                                data: Object.values(countries_values_arr[9]), // Specify the data values array
                                fill: false,
                                borderColor: '#92c3a4', // Add custom color border (Line)
                                backgroundColor: '#92c3a4', // Add custom color background (Points and Fill)
                                borderWidth: 1 // Specify bar border width
                            }

                        ]
                    },
                    options: {
                        responsive: true, // Instruct chart js to respond nicely.
                        maintainAspectRatio: false, // Add to prevent default behaviour of full-width/height
                    }
                });

            //End


            //multi line graph of profits

                var ctx_profits_per_months = document.getElementById("profits_per_months").getContext('2d');
                
                var myChart_profits = new Chart(ctx_profits_per_months, {
                    type: 'line',
                    data: {
                        labels: Object.keys(total_profit_origin) ,
                        datasets: [{
                                label: 'All', // Name the series
                                data:Object.values(total_profit_all), // Specify the data values array
                                fill: false,
                                borderColor: '#4B4A59', // Add custom color border (Line)
                                backgroundColor: '#4B4A59', // Add custom color background (Points and Fill)
                                borderWidth: 1 // Specify bar border width
                            },
                            {
                                label: 'Original', // Name the series
                                data: Object.values(total_profit_origin), // Specify the data values array
                                fill: false,
                                borderColor: '#E84855', // Add custom color border (Line)
                                backgroundColor: '#E84855', // Add custom color background (Points and Fill)
                                borderWidth: 1 // Specify bar border width
                            },
                            {
                                label: 'Egypt', // Name the series
                                data: Object.values(total_profit_egypt), // Specify the data values array
                                fill: false,
                                borderColor: '#FACF0E', // Add custom color border (Line)
                                backgroundColor: '#FACF0E', // Add custom color background (Points and Fill)
                                borderWidth: 1 // Specify bar border width
                            },
                            {
                                label: 'KSA', // Name the series
                                data: Object.values(total_profit_ksa), // Specify the data values array
                                fill: false,
                                borderColor: '#3185FC', // Add custom color border (Line)
                                backgroundColor: '#3185FC', // Add custom color background (Points and Fill)
                                borderWidth: 1 // Specify bar border width
                            },
                            {
                                label: 'Kuwait', // Name the series
                                data:Object.values(total_profit_kuwait), // Specify the data values array
                                fill: false,
                                borderColor: '#BF5C8C', // Add custom color border (Line)
                                backgroundColor: '#BF5C8C', // Add custom color background (Points and Fill)
                                borderWidth: 1 // Specify bar border width
                            },
                            {
                                label: 'UAE', // Name the series
                                data:Object.values(total_amount_uae), // Specify the data values array
                                fill: false,
                                borderColor: '#51bb6b', // Add custom color border (Line)
                                backgroundColor: '#51bb6b', // Add custom color background (Points and Fill)
                                borderWidth: 1 // Specify bar border width
                            }

                        ]
                    },
                    options: {
                        responsive: true, // Instruct chart js to respond nicely.
                        maintainAspectRatio: false, // Add to prevent default behaviour of full-width/height
                    }
                });

            //End

            // multi line graph for ORDERS STATUS ALONG TIME

                var ctx_status_time = document.getElementById("orders_status_per_months").getContext('2d');
                
                var myChart = new Chart(ctx_status_time, {
                    type: 'line',
                    data: {
                        labels: Object.keys(Verified_orders_year).slice(0, 12) ,
                        datasets: [
                            {
                                label: 'Verified', // Name the series
                                data: Object.values(Verified_orders_year).slice(0, 12) , // Specify the data values array
                                fill: false,
                                borderColor: '#3185FC', // Add custom color border (Line)
                                backgroundColor: '#3185FC', // Add custom color background (Points and Fill)
                                borderWidth: 1 // Specify bar border width
                            },
                            {
                                label: 'Cancelled', // Name the series
                                data: Object.values(Cancelled_orders_year).slice(0, 12) , // Specify the data values array
                                fill: false,
                                borderColor: '#FACF0E', // Add custom color border (Line)
                                backgroundColor: '#FACF0E', // Add custom color background (Points and Fill)
                                borderWidth: 1 // Specify bar border width
                            },
                            {
                                label: 'Delivered', // Name the series
                                data: Object.values(Delivered_orders_year).slice(0, 12) , // Specify the data values array
                                fill: false,
                                borderColor: '#00a40e', // Add custom color border (Line)
                                backgroundColor: '#00a40e', // Add custom color background (Points and Fill)
                                borderWidth: 1 // Specify bar border width
                            },
                            {
                                label: 'Refused', // Name the series
                                data: Object.values(Refused_orders_year).slice(0, 12) , // Specify the data values array
                                fill: false,
                                borderColor: '#cc0202', // Add custom color border (Line)
                                backgroundColor: '#cc0202', // Add custom color background (Points and Fill)
                                borderWidth: 1 // Specify bar border width
                            }
                        ]
                    },
                    options: {
                        responsive: true, // Instruct chart js to respond nicely.
                        maintainAspectRatio: false, // Add to prevent default behaviour of full-width/height
                    }
                });

            //END

            // line graph for years revenue

                var ctx_years_revenue = document.getElementById("years_revenue").getContext('2d');
                
                 var myChart = new Chart(ctx_years_revenue, {
                    type: 'line',
                    data: {
                        labels: Object.keys(years_revenue) ,
                        datasets: [
                            {
                                label: 'Revenue', // Name the series
                                data: Object.values(years_revenue) , // Specify the data values array
                                fill: false,
                                borderColor: '#4B4A59', // Add custom color border (Line)
                                backgroundColor: '#4B4A59', // Add custom color background (Points and Fill)
                                borderWidth: 1 // Specify bar border width
                            }
                        ]
                    },
                    options: {
                        responsive: true, // Instruct chart js to respond nicely.
                        maintainAspectRatio: false, // Add to prevent default behaviour of full-width/height
                    }
                });

            //END

            // line graph for years revenue

                var ctx_weekly_orders = document.getElementById("weekly_orders").getContext('2d');
                
                weekly_orders_chart = new Chart(ctx_weekly_orders, {
                   type: 'line',
                   data: {
                       labels: Object.keys(week_data) ,
                       datasets: [
                           {
                               label: 'Orders No.', // Name the series
                               data: Object.values(week_data) , // Specify the data values array
                               fill: false,
                               borderColor: '#4B4A59', // Add custom color border (Line)
                               backgroundColor: '#4B4A59', // Add custom color background (Points and Fill)
                               borderWidth: 1 // Specify bar border width
                           }
                       ]
                   },
                   options: {
                       responsive: true, // Instruct chart js to respond nicely.
                       maintainAspectRatio: false, // Add to prevent default behaviour of full-width/height
                   }
               });

           //END
            
            
            var options = {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        },
                        gridLines: {
                            color: "rgba(204, 204, 204,0.1)"
                        }
                    }],
                    xAxes: [{
                        gridLines: {
                            color: "rgba(204, 204, 204,0.1)"
                        }
                    }]
                },
                legend: {
                    display: false
                },
                elements: {
                    point: {
                        radius: 0
                    }
                }
            };


            var complains_options = {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        },
                        gridLines: {
                            color: "rgba(204, 204, 204,0.1)"
                        }
                    }],
                    xAxes: [{
                        gridLines: {
                            color: "rgba(204, 204, 204,0.1)"
                        }
                    }]
                },
                legend: {
                    display: false
                },
                elements: {
                    point: {
                        radius: 0
                    }
                }

            };

        });

            function week_choose(){

                document.getElementById("week_submit").innerHTML = '<div style="width: 65px;align-items: center;justify-content: center;display: flex"><div class="loader"></div></div>';

                var week = $('#weekInput').val();

                var ctx_weekly_orders = document.getElementById("weekly_orders").getContext('2d');

                if (weekly_orders_chart) {
                    weekly_orders_chart.destroy();
                }

                /*   var myChart = new Chart(ctx_weekly_orders, {
                    type: 'line',
                    data: {
                        labels: [] ,
                        datasets: [
                            {
                                label: 'Orders No.', // Name the series
                                data: [] , // Specify the data values array
                                fill: false,
                                borderColor: '#4B4A59', // Add custom color border (Line)
                                backgroundColor: '#4B4A59', // Add custom color background (Points and Fill)
                                borderWidth: 1 // Specify bar border width
                            }
                        ]
                    },
                    options: {
                        responsive: true, // Instruct chart js to respond nicely.
                        maintainAspectRatio: false, // Add to prevent default behaviour of full-width/height
                    }
                }); */

                $.ajax({
                    url: "get_data_of_week",
                    type: "post",
                    data: {
                        _token: "{{ csrf_token() }}",
                        weekInput: week
                    },
                    success: function(response) {
                    /*  var result= JSON.parse(response); */

                        console.log([Object.keys(response) , Object.values(response)]);
                    
                            weekly_orders_chart = new Chart(ctx_weekly_orders, {
                                type: 'line',
                                data: {
                                    labels: Object.keys(response) ,
                                    datasets: [
                                        {
                                            label: 'Orders No.', // Name the series
                                            data: Object.values(response) , // Specify the data values array
                                            fill: false,
                                            borderColor: '#4B4A59', // Add custom color border (Line)
                                            backgroundColor: '#4B4A59', // Add custom color background (Points and Fill)
                                            borderWidth: 1 // Specify bar border width
                                        }
                                    ]
                                },
                                options: {
                                    responsive: true, // Instruct chart js to respond nicely.
                                    maintainAspectRatio: false, // Add to prevent default behaviour of full-width/height
                                }
                            });
                        
                        document.getElementById("week_submit").innerHTML = '<button  class="btn" type="submit" style="font-size: 10px;" onclick="week_choose()" >Get data</button>';

                    },
                    error: function(xhr) {
                        //Do Something to handle error
                    }

                });

            }

       
    </script>

    <script>
        $(".menu-off").click(function() {
            $(this).removeClass("menu-off");
            $(this).addClass("menu-on");
            $('.floating-button-menu-close').addClass('menu-on');
        });


        $('.floating-button-menu-close').click(function() {
            $(this).addClass("menu-off");
            $(this).removeClass("menu-on");
            $('.floating-button-menu').toggleClass('menu-on');
        });
    </script>

@endsection
