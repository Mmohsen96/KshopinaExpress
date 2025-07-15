@extends('layouts.dash_board_layout')

@section('content')
    <style>
        .content-wrapper {
            padding: 1rem 1.2rem;
        }

        .card {
            position: relative;
            display: flex;
            margin-top: 2rem;
            width: 96%;
            -ms-flex-direction: column;
            min-width: 0;
            word-wrap: break-word;
            background-color: #fff;
            background-clip: border-box;
            border: 0px;
            border-radius: 0rem;
            flex-direction: row;
        }

        .row {
            width: 100%;
            margin-right: 5px;
        }

        h3,
        h4 {
            color: #1b3425;
            font-family: 'Bebas Neue', cursive;
            font-weight: 700;
            letter-spacing: 1px;
        }

        .card-body {
            box-shadow: 0px 0px 7px 0px rgb(27 52 37 / 31%);
            border-radius: 10px;
            margin-left: 2rem;
            display: flex;
            flex-direction: row;
            height: auto;
            justify-content: space-around;
            background-color: #f7f6f3;

        }

        .info-container {
            display: flex;
            align-items: center;
            justify-content: flex-start;
            padding: 0.5rem;
        }

        .title {
            color: #1b3425;
            font-size: 20px;
            margin-bottom: 0px;
            margin-right: 10px;
            font-weight: 600;
        }

        .info {
            color: #1b3425;
            padding-left: 10px;
            font-weight: 400;
        }

        hr {
            margin-top: 0.3rem;
            margin-bottom: 0.3rem;
            width: 65%;
            border: 0;
            border-top: 2px solid #d9d9d9;
        }

    </style>
    <div class="row">

        <div class="col-lg-12 col-md-12 col-sm-12 card card-body">
            <div class="right"
                style="display: flex;align-items: center;flex-direction: column; justify-content: center;">
                <img style="width: 70%;padding: 1rem 0rem 1rem 0rem;" src="{{ asset('reviewdata-1.png') }}"
                    alt="data_reviewing">
                <h3> Your Information under review now </h3>
                <h4> Your Account will be Active soon</h4>
            </div>
            <div class="left" style="margin: -10px 0px -10px 0px;">
                <h3
                    style="    margin-left: 2rem;width: 110%;margin-top: 1rem;color: #d5b06c;text-align: center;font-weight: bold;font-size: 26px;letter-spacing: 2px;">
                    Your Information
                </h3>
                <div class="info-container">
                    <span class="title">
                        <i style="" class="far fa-user"></i>
                    </span>
                    <span class="info"> {{ $user->name }} </span>
                </div>
                <hr>
                <div class="info-container">
                    <span class="title">
                        <i style="" class="far fa-envelope"></i>
                    </span>
                    <span class="info">{{ $user->email }} </span>
                </div>
                <hr>
                <div class="info-container">
                    <span class="title">
                        <i style="font-size: 17px;width: 8%;" class="fas fa-phone-alt"></i>
                    </span>
                    <span class="info"> {{ $user->phone_number }} </span>
                </div>
                <hr>
                <div class="info-container">
                    <span class="title">
                        <i class="fas fa-flag"></i>
                    </span>
                    <span class="info"> {{ $user->country }} </span>
                </div>
                <hr>
                <div class="info-container">
                    <span class="title">
                        <i class="fas fa-city"></i>
                    </span>
                    <span class="info"> {{ $user->city }} </span>
                </div>
                <hr>
                <div class="info-container">
                    <span class="title">
                        <i class="fas fa-road"></i>
                    </span>
                    <span class="info"> {{ $user->area }} </span>
                </div>
                <hr>
                <div class="info-container">
                    <span class="title">
                        <i class="fas fa-mail-bulk"></i>
                    </span>
                    <span class="info"> {{ $user->address_number }} </span>
                </div>
            </div>
        </div>




    </div>
@endsection
