@extends('layouts.home')

<head>
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
        integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
</head>


<style>
    :root {
        --surface-color: #fff;
        --curve: 40;
    }

    * {
        box-sizing: border-box;
    }

    body {
        font-family: 'Noto Sans JP', sans-serif;
        background-color: #fef8f8;
    }

    .content-wrapper {
        padding: 5rem 0rem !important;
    }

    .cards {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 2rem;
        margin: 0rem 8vw;
        padding: 0;
        list-style-type: none;
    }

    .card {
        width: 22rem !important;
        position: relative;
        display: block;
        height: 23rem;
        border-radius: calc(var(--curve) * 1px);
        overflow: hidden;
        text-decoration: none;
    }

    .card__image {
        width: 40%;
        height: auto;
    }

    .card__overlay {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        z-index: 1;
        border-radius: calc(var(--curve) * 1px);
        background-color: var(--surface-color);
        transform: translateY(100%);
        transition: .2s ease-in-out;
    }

    .card:hover .card__overlay {
        transform: translateY(0);
    }

    .card__header {
        position: relative;
        display: flex;
        align-items: center;
        gap: 2em;
        padding: 2em;
        border-radius: calc(var(--curve) * 1px) 0 0 0;
        background-color: var(--surface-color);
        transform: translateY(-100%);
        transition: .2s ease-in-out;
    }

    .card__arc {
        width: 80px;
        height: 80px;
        position: absolute;
        bottom: 100%;
        right: 0;
        z-index: 1;
    }

    .card__arc path {
        fill: var(--surface-color);
        d: path("M 40 80 c 22 0 40 -22 40 -40 v 40 Z");
    }

    .card:hover .card__header {
        transform: translateY(0);
    }

    .card__thumb {
        flex-shrink: 0;
        width: 50px;
        height: 50px;
        border-radius: 50%;
    }

    .card__title {
        font-size: 1.5em;
        margin: 0 0 0.3em 1.5rem;
        color: #1b3425;
    }

    .card__tagline {
        display: block;
        margin: 1em 0;
        font-family: "MockFlowFont";
        font-size: .8em;
        color: #D7BDCA;
    }

    .card__status {
        font-size: .8em;
        color: #D7BDCA;
    }

    .card__description {
        font-family: 'Bebas Neue', cursive !important;
        letter-spacing: 0.1rem;
        padding: 0 2em 2em;
        margin: 0;
        color: #636464;
        display: -webkit-box;
        -webkit-box-orient: vertical;
        -webkit-line-clamp: 3;
        overflow: hidden;
    }

</style>

@section('content')
    <?php

    $obj = json_encode(session()->all());

    try {
        $store = $_GET['store'];
    } catch (\Throwable $th) {
        $store = 'origin';
    }

    ?>

    <div class="container">

        <ul class="cards">
            <li>
                <a href="/scanBarcodes" class="card" >
                    <div style="display: flex;flex-direction: column;align-items: center;height: 20rem;background: linear-gradient(to bottom,#CB9D48,#907239);">
                        <img src="{{ asset('mini_zete.png') }}" alt="KMEX" class="card__image"  style="margin-top: 2.5rem;"/>
                    </div>
                    <div class="card__overlay">
                        <div class="card__header">
                            <h4 class="card__title">KMEX</h4>
                        </div>
                        <p class="card__description">New version of Kshopina Express</p>
                    </div>
                </a>
            </li>
            <li>
                <a href="/first_verification_confirmed?store=origin&filter=All&page=1" class="card" >
                    <div style="display: flex;flex-direction: column;align-items: center;height: 20rem; background: linear-gradient(to bottom,#235c39,#1B3425)">
                        <img src="{{ asset('kshopina-small.png') }}" alt="KSHOPINA EXPRESS" class="card__image" style="width: 28%;margin-top: 3.5rem;" />
                    </div>
                    <div class="card__overlay">
                        <div class="card__header">
                            <h4 class="card__title">KSHOPINA EXPRESS</h4>
                        </div>
                        <p class="card__description">Staff Version</p>
                    </div>
                </a>
            </li>
        </ul>

    </div>
@endsection
