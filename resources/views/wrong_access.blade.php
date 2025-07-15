<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">


    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.css') }}">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="{{ asset('js/bootstrap.js') }}"></script>

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/v4-shims.css">

    <title>Document</title>
</head>

<body>
    <style>
        body {
            margin: 0;
            font-size: 16px;
        }

        * {
            box-sizing: border-box;
        }

        .container {
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            background: white;
            color: black;
            font-family: arial, sans-serif;
            overflow: hidden;
        }

        .content {
            position: relative;
            width: 600px;
            max-width: 100%;
            margin: 20px;
            background: white;
            padding: 50px 40px;
            text-align: center;
            box-shadow: -10px 10px 67px -12px rgba(0, 0, 0, 0.2);
            opacity: 0;
            animation: apparition 0.8s 1.2s cubic-bezier(0.39, 0.575, 0.28, 0.995) forwards;
        }

        .content p {
            font-size: 1.3rem;
            margin-top: 0;
            margin-bottom: 0.6rem;
            letter-spacing: 0.1rem;
            color: #595959;
        }

        .content p:last-child {
            margin-bottom: 0;
        }

        #contact_button {
            display: inline-block;
            margin-top: 2rem;
            padding: 0.5rem 1rem;
            border: 3px solid #595959;
            background: transparent;
            font-size: 1rem;
            color: #595959;
            text-decoration: none;
            cursor: pointer;
            font-weight: bold;
        }

        .particle {
            position: absolute;
            display: block;
            pointer-events: none;
        }

        .particle:nth-child(1) {
            top: 67.9802955665%;
            left: 78.0632411067%;
            font-size: 12px;
            filter: blur(0.02px);
            animation: 27s float2 infinite;
        }

        .particle:nth-child(2) {
            top: 50.4854368932%;
            left: 68.359375%;
            font-size: 24px;
            filter: blur(0.04px);
            animation: 25s floatReverse infinite;
        }

        .particle:nth-child(3) {
            top: 41.696969697%;
            left: 49.756097561%;
            font-size: 25px;
            filter: blur(0.06px);
            animation: 21s float2 infinite;
        }

        .particle:nth-child(4) {
            top: 1.9277108434%;
            left: 56.3106796117%;
            font-size: 30px;
            filter: blur(0.08px);
            animation: 31s floatReverse infinite;
        }

        .particle:nth-child(5) {
            top: 17.5824175824%;
            left: 79.4896957802%;
            font-size: 19px;
            filter: blur(0.1px);
            animation: 27s floatReverse2 infinite;
        }

        .particle:nth-child(6) {
            top: 2.9161603888%;
            left: 76.2463343109%;
            font-size: 23px;
            filter: blur(0.12px);
            animation: 33s floatReverse2 infinite;
        }

        .particle:nth-child(7) {
            top: 25.5842558426%;
            left: 0.9871668312%;
            font-size: 13px;
            filter: blur(0.14px);
            animation: 24s float infinite;
        }

        .particle:nth-child(8) {
            top: 54.8347613219%;
            left: 42.2812192724%;
            font-size: 17px;
            filter: blur(0.16px);
            animation: 25s floatReverse2 infinite;
        }

        .particle:nth-child(9) {
            top: 42.7184466019%;
            left: 19.53125%;
            font-size: 24px;
            filter: blur(0.18px);
            animation: 25s floatReverse2 infinite;
        }

        .particle:nth-child(10) {
            top: 86.0635696822%;
            left: 76.6208251473%;
            font-size: 18px;
            filter: blur(0.2px);
            animation: 24s float2 infinite;
        }

        .particle:nth-child(11) {
            top: 18.6274509804%;
            left: 51.1811023622%;
            font-size: 16px;
            filter: blur(0.22px);
            animation: 37s float infinite;
        }

        .particle:nth-child(12) {
            top: 72.7272727273%;
            left: 19.512195122%;
            font-size: 25px;
            filter: blur(0.24px);
            animation: 40s float2 infinite;
        }

        .particle:nth-child(13) {
            top: 47.7466504263%;
            left: 73.4573947111%;
            font-size: 21px;
            filter: blur(0.26px);
            animation: 30s floatReverse infinite;
        }

        .particle:nth-child(14) {
            top: 47.1165644172%;
            left: 95.5665024631%;
            font-size: 15px;
            filter: blur(0.28px);
            animation: 39s floatReverse2 infinite;
        }

        .particle:nth-child(15) {
            top: 39.7094430993%;
            left: 28.2651072125%;
            font-size: 26px;
            filter: blur(0.3px);
            animation: 25s floatReverse infinite;
        }

        .particle:nth-child(16) {
            top: 20.6896551724%;
            left: 29.6442687747%;
            font-size: 12px;
            filter: blur(0.32px);
            animation: 22s floatReverse infinite;
        }

        .particle:nth-child(17) {
            top: 75.271411339%;
            left: 40.8163265306%;
            font-size: 29px;
            filter: blur(0.34px);
            animation: 34s float infinite;
        }

        .particle:nth-child(18) {
            top: 17.7558569667%;
            left: 59.3471810089%;
            font-size: 11px;
            filter: blur(0.36px);
            animation: 31s float2 infinite;
        }

        .particle:nth-child(19) {
            top: 34.1047503045%;
            left: 18.6092066601%;
            font-size: 21px;
            filter: blur(0.38px);
            animation: 24s floatReverse infinite;
        }

        .particle:nth-child(20) {
            top: 8.7167070218%;
            left: 3.8986354776%;
            font-size: 26px;
            filter: blur(0.4px);
            animation: 23s floatReverse infinite;
        }

        .particle:nth-child(21) {
            top: 38.2352941176%;
            left: 78.7401574803%;
            font-size: 16px;
            filter: blur(0.42px);
            animation: 21s floatReverse2 infinite;
        }

        .particle:nth-child(22) {
            top: 74.7847478475%;
            left: 53.3070088845%;
            font-size: 13px;
            filter: blur(0.44px);
            animation: 29s float infinite;
        }

        .particle:nth-child(23) {
            top: 38.2352941176%;
            left: 61.0236220472%;
            font-size: 16px;
            filter: blur(0.46px);
            animation: 35s floatReverse infinite;
        }

        .particle:nth-child(24) {
            top: 24.3309002433%;
            left: 19.5694716243%;
            font-size: 22px;
            filter: blur(0.48px);
            animation: 28s floatReverse infinite;
        }

        .particle:nth-child(25) {
            top: 30.8805790109%;
            left: 29.1545189504%;
            font-size: 29px;
            filter: blur(0.5px);
            animation: 35s float infinite;
        }

        .particle:nth-child(26) {
            top: 89.7466827503%;
            left: 38.8726919339%;
            font-size: 29px;
            filter: blur(0.52px);
            animation: 34s floatReverse infinite;
        }

        .particle:nth-child(27) {
            top: 17.4334140436%;
            left: 68.2261208577%;
            font-size: 26px;
            filter: blur(0.54px);
            animation: 25s floatReverse2 infinite;
        }

        .particle:nth-child(28) {
            top: 36.0975609756%;
            left: 18.6274509804%;
            font-size: 20px;
            filter: blur(0.56px);
            animation: 21s float2 infinite;
        }

        .particle:nth-child(29) {
            top: 76.7527675277%;
            left: 63.1786771964%;
            font-size: 13px;
            filter: blur(0.58px);
            animation: 23s float2 infinite;
        }

        .particle:nth-child(30) {
            top: 49.8777506112%;
            left: 91.3555992141%;
            font-size: 18px;
            filter: blur(0.6px);
            animation: 29s float infinite;
        }

        .particle:nth-child(31) {
            top: 43.2432432432%;
            left: 48.3234714004%;
            font-size: 14px;
            filter: blur(0.62px);
            animation: 37s floatReverse infinite;
        }

        .particle:nth-child(32) {
            top: 29.5566502463%;
            left: 81.0276679842%;
            font-size: 12px;
            filter: blur(0.64px);
            animation: 33s float2 infinite;
        }

        .particle:nth-child(33) {
            top: 68.6819830713%;
            left: 91.5287244401%;
            font-size: 27px;
            filter: blur(0.66px);
            animation: 35s float infinite;
        }

        .particle:nth-child(34) {
            top: 13.5922330097%;
            left: 44.921875%;
            font-size: 24px;
            filter: blur(0.68px);
            animation: 23s floatReverse2 infinite;
        }

        .particle:nth-child(35) {
            top: 57.0737605804%;
            left: 10.7108081792%;
            font-size: 27px;
            filter: blur(0.7px);
            animation: 28s floatReverse infinite;
        }

        .particle:nth-child(36) {
            top: 78.527607362%;
            left: 10.8374384236%;
            font-size: 15px;
            filter: blur(0.72px);
            animation: 26s float infinite;
        }

        .particle:nth-child(37) {
            top: 37.8640776699%;
            left: 52.734375%;
            font-size: 24px;
            filter: blur(0.74px);
            animation: 22s floatReverse infinite;
        }

        .particle:nth-child(38) {
            top: 37.1638141809%;
            left: 90.373280943%;
            font-size: 18px;
            filter: blur(0.76px);
            animation: 36s floatReverse infinite;
        }

        .particle:nth-child(39) {
            top: 1.9300361882%;
            left: 45.6754130224%;
            font-size: 29px;
            filter: blur(0.78px);
            animation: 35s float2 infinite;
        }

        .particle:nth-child(40) {
            top: 18.5365853659%;
            left: 97.0588235294%;
            font-size: 20px;
            filter: blur(0.8px);
            animation: 32s floatReverse2 infinite;
        }

        .particle:nth-child(41) {
            top: 93.4939759036%;
            left: 93.2038834951%;
            font-size: 30px;
            filter: blur(0.82px);
            animation: 40s float infinite;
        }

        .particle:nth-child(42) {
            top: 74.3063932449%;
            left: 28.1827016521%;
            font-size: 29px;
            filter: blur(0.84px);
            animation: 37s float infinite;
        }

        .particle:nth-child(43) {
            top: 41.4303329223%;
            left: 52.4233432245%;
            font-size: 11px;
            filter: blur(0.86px);
            animation: 33s float infinite;
        }

        .particle:nth-child(44) {
            top: 77.8325123153%;
            left: 0.9881422925%;
            font-size: 12px;
            filter: blur(0.88px);
            animation: 23s float infinite;
        }

        .particle:nth-child(45) {
            top: 81.8742293465%;
            left: 4.9455984174%;
            font-size: 11px;
            filter: blur(0.9px);
            animation: 21s floatReverse2 infinite;
        }

        .particle:nth-child(46) {
            top: 78.0487804878%;
            left: 54.9019607843%;
            font-size: 20px;
            filter: blur(0.92px);
            animation: 33s floatReverse2 infinite;
        }

        .particle:nth-child(47) {
            top: 33.9393939394%;
            left: 37.0731707317%;
            font-size: 25px;
            filter: blur(0.94px);
            animation: 22s float2 infinite;
        }

        .particle:nth-child(48) {
            top: 96.1165048544%;
            left: 26.3671875%;
            font-size: 24px;
            filter: blur(0.96px);
            animation: 24s float2 infinite;
        }

        .particle:nth-child(49) {
            top: 75.4901960784%;
            left: 63.9763779528%;
            font-size: 16px;
            filter: blur(0.98px);
            animation: 36s float infinite;
        }

        .particle:nth-child(50) {
            top: 40.7272727273%;
            left: 40.9756097561%;
            font-size: 25px;
            filter: blur(1px);
            animation: 22s floatReverse infinite;
        }

        .particle:nth-child(51) {
            top: 56.8674698795%;
            left: 79.6116504854%;
            font-size: 30px;
            filter: blur(1.02px);
            animation: 38s floatReverse2 infinite;
        }

        .particle:nth-child(52) {
            top: 66.09963548%;
            left: 18.5728250244%;
            font-size: 23px;
            filter: blur(1.04px);
            animation: 28s floatReverse2 infinite;
        }

        .particle:nth-child(53) {
            top: 43.3497536946%;
            left: 84.9802371542%;
            font-size: 12px;
            filter: blur(1.06px);
            animation: 25s floatReverse infinite;
        }

        .particle:nth-child(54) {
            top: 26.0240963855%;
            left: 22.3300970874%;
            font-size: 30px;
            filter: blur(1.08px);
            animation: 39s floatReverse2 infinite;
        }

        .particle:nth-child(55) {
            top: 80.193236715%;
            left: 58.3657587549%;
            font-size: 28px;
            filter: blur(1.1px);
            animation: 25s float2 infinite;
        }

        .particle:nth-child(56) {
            top: 34.2298288509%;
            left: 3.9292730845%;
            font-size: 18px;
            filter: blur(1.12px);
            animation: 25s floatReverse2 infinite;
        }

        .particle:nth-child(57) {
            top: 25.304136253%;
            left: 74.3639921722%;
            font-size: 22px;
            filter: blur(1.14px);
            animation: 24s float2 infinite;
        }

        .particle:nth-child(58) {
            top: 94.5717732207%;
            left: 66.0835762877%;
            font-size: 29px;
            filter: blur(1.16px);
            animation: 22s float2 infinite;
        }

        .particle:nth-child(59) {
            top: 34.5252774353%;
            left: 87.0425321464%;
            font-size: 11px;
            filter: blur(1.18px);
            animation: 33s floatReverse2 infinite;
        }

        .particle:nth-child(60) {
            top: 47.0588235294%;
            left: 65.9448818898%;
            font-size: 16px;
            filter: blur(1.2px);
            animation: 25s float infinite;
        }

        .particle:nth-child(61) {
            top: 37.1638141809%;
            left: 36.3457760314%;
            font-size: 18px;
            filter: blur(1.22px);
            animation: 40s float2 infinite;
        }

        .particle:nth-child(62) {
            top: 45.7978075518%;
            left: 80.3134182174%;
            font-size: 21px;
            filter: blur(1.24px);
            animation: 23s floatReverse infinite;
        }

        .particle:nth-child(63) {
            top: 33.8983050847%;
            left: 12.6705653021%;
            font-size: 26px;
            filter: blur(1.26px);
            animation: 35s float infinite;
        }

        .particle:nth-child(64) {
            top: 0.9852216749%;
            left: 6.9169960474%;
            font-size: 12px;
            filter: blur(1.28px);
            animation: 35s float infinite;
        }

        .particle:nth-child(65) {
            top: 62.1359223301%;
            left: 9.765625%;
            font-size: 24px;
            filter: blur(1.3px);
            animation: 22s float infinite;
        }

        .particle:nth-child(66) {
            top: 22.3572296476%;
            left: 66.4711632454%;
            font-size: 23px;
            filter: blur(1.32px);
            animation: 31s floatReverse infinite;
        }

        .particle:nth-child(67) {
            top: 69.5226438188%;
            left: 44.2477876106%;
            font-size: 17px;
            filter: blur(1.34px);
            animation: 24s floatReverse2 infinite;
        }

        .particle:nth-child(68) {
            top: 21.4896214896%;
            left: 12.7576054956%;
            font-size: 19px;
            filter: blur(1.36px);
            animation: 28s float infinite;
        }

        .particle:nth-child(69) {
            top: 93.7114673243%;
            left: 44.5103857567%;
            font-size: 11px;
            filter: blur(1.38px);
            animation: 27s floatReverse infinite;
        }

        .particle:nth-child(70) {
            top: 17.6470588235%;
            left: 18.7007874016%;
            font-size: 16px;
            filter: blur(1.4px);
            animation: 28s float2 infinite;
        }

        .particle:nth-child(71) {
            top: 30.3921568627%;
            left: 77.7559055118%;
            font-size: 16px;
            filter: blur(1.42px);
            animation: 36s float2 infinite;
        }

        .particle:nth-child(72) {
            top: 50.1204819277%;
            left: 55.3398058252%;
            font-size: 30px;
            filter: blur(1.44px);
            animation: 27s float infinite;
        }

        .particle:nth-child(73) {
            top: 56.3791008505%;
            left: 0.9775171065%;
            font-size: 23px;
            filter: blur(1.46px);
            animation: 22s float2 infinite;
        }

        .particle:nth-child(74) {
            top: 19.3003618818%;
            left: 75.8017492711%;
            font-size: 29px;
            filter: blur(1.48px);
            animation: 25s float2 infinite;
        }

        .particle:nth-child(75) {
            top: 61.9105199516%;
            left: 7.7896786758%;
            font-size: 27px;
            filter: blur(1.5px);
            animation: 25s float infinite;
        }

        .particle:nth-child(76) {
            top: 86.7469879518%;
            left: 72.8155339806%;
            font-size: 30px;
            filter: blur(1.52px);
            animation: 27s floatReverse infinite;
        }

        .particle:nth-child(77) {
            top: 54.5676004872%;
            left: 76.3956904995%;
            font-size: 21px;
            filter: blur(1.54px);
            animation: 26s float infinite;
        }

        .particle:nth-child(78) {
            top: 34.3558282209%;
            left: 35.4679802956%;
            font-size: 15px;
            filter: blur(1.56px);
            animation: 38s float infinite;
        }

        .particle:nth-child(79) {
            top: 3.9024390244%;
            left: 53.9215686275%;
            font-size: 20px;
            filter: blur(1.58px);
            animation: 31s float2 infinite;
        }

        .particle:nth-child(80) {
            top: 86.1689106487%;
            left: 46.2143559489%;
            font-size: 17px;
            filter: blur(1.6px);
            animation: 22s float2 infinite;
        }

        @keyframes apparition {
            from {
                opacity: 0;
                transform: translateY(100px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(180px);
            }
        }

        @keyframes floatReverse {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-180px);
            }
        }

        @keyframes float2 {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(28px);
            }
        }

        @keyframes floatReverse2 {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-28px);
            }
        }

    </style>
    <style>
        .loader {
            border: 5px solid #f3f3f3;
            border-radius: 50%;
            border-top: 5px solid #cda051;
            width: 50px;
            height: 50px;
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

        #checklist {
            --text: #414856;
            --check: #ca9b49;
            --disabled: #C3C8DE;

            --border-radius: 10px;

            width: var(--width);
            height: var(--height);
            border-radius: var(--border-radius);
            position: relative;
            align-items: center;
        }

        #checklist label {
            color: var(--text);
            position: relative;
            cursor: pointer;
            display: grid;
            align-items: center;
            width: -webkit-fit-content;
            width: -moz-fit-content;
            width: fit-content;
            transition: color 0.3s ease;
        }

        #checklist label::before,
        #checklist label::after {
            content: "";
            position: absolute;
        }

        #checklist label::before {
            height: 2px;
            width: 8px;
            left: -27px;
            background: var(--check);
            border-radius: 2px;
            transition: background 0.3s ease;
        }

        #checklist label:after {
            height: 4px;
            width: 4px;
            top: 8px;
            left: -25px;
            border-radius: 50%;
        }

        #checklist input[type=checkbox] {
            -webkit-appearance: none;
            -moz-appearance: none;
            position: relative;
            height: 15px;
            width: 15px;
            outline: none;
            border: 0;
            margin: 0 15px 0 0;
            cursor: pointer;
            background: var(--background);
            display: grid;
            align-items: center;
        }

        #checklist input[type=checkbox]::before,
        #checklist input[type=checkbox]::after {
            content: "";
            position: absolute;
            height: 2px;
            top: auto;
            background: var(--check);
            border-radius: 2px;
        }

        #checklist input[type=checkbox]::before {
            width: 0px;
            right: 60%;
            transform-origin: right bottom;
        }

        #checklist input[type=checkbox]::after {
            width: 0px;
            left: 40%;
            transform-origin: left bottom;
        }

        #checklist input[type=checkbox]:checked::before {
            -webkit-animation: check-01 0.4s ease forwards;
            animation: check-01 0.4s ease forwards;
        }

        #checklist input[type=checkbox]:checked::after {
            -webkit-animation: check-02 0.4s ease forwards;
            animation: check-02 0.4s ease forwards;
        }

        #checklist input[type=checkbox]:checked+label {
            color: var(--disabled);
            -webkit-animation: move 0.3s ease 0.1s forwards;
            animation: move 0.3s ease 0.1s forwards;
        }

        #checklist input[type=checkbox]:checked+label::before {
            background: var(--disabled);
            -webkit-animation: slice 0.4s ease forwards;
            animation: slice 0.4s ease forwards;
        }

        #checklist input[type=checkbox]:checked+label::after {
            -webkit-animation: firework 0.5s ease forwards 0.1s;
            animation: firework 0.5s ease forwards 0.1s;
        }

        @-webkit-keyframes move {
            50% {
                padding-left: 8px;
                padding-right: 0px;
            }

            100% {
                padding-right: 4px;
            }
        }

        @keyframes move {
            50% {
                padding-left: 8px;
                padding-right: 0px;
            }

            100% {
                padding-right: 4px;
            }
        }

        @-webkit-keyframes slice {
            60% {
                width: 100%;
                left: 4px;
            }

            100% {
                width: 100%;
                left: -2px;
                padding-left: 0;
            }
        }

        @keyframes slice {
            60% {
                width: 100%;
                left: 4px;
            }

            100% {
                width: 100%;
                left: -2px;
                padding-left: 0;
            }
        }

        @-webkit-keyframes check-01 {
            0% {
                width: 4px;
                top: auto;
                transform: rotate(0);
            }

            50% {
                width: 0px;
                top: auto;
                transform: rotate(0);
            }

            51% {
                width: 0px;
                top: 8px;
                transform: rotate(45deg);
            }

            100% {
                width: 5px;
                top: 8px;
                transform: rotate(45deg);
            }
        }

        @keyframes check-01 {
            0% {
                width: 4px;
                top: auto;
                transform: rotate(0);
            }

            50% {
                width: 0px;
                top: auto;
                transform: rotate(0);
            }

            51% {
                width: 0px;
                top: 8px;
                transform: rotate(45deg);
            }

            100% {
                width: 5px;
                top: 8px;
                transform: rotate(45deg);
            }
        }

        @-webkit-keyframes check-02 {
            0% {
                width: 4px;
                top: auto;
                transform: rotate(0);
            }

            50% {
                width: 0px;
                top: auto;
                transform: rotate(0);
            }

            51% {
                width: 0px;
                top: 8px;
                transform: rotate(-45deg);
            }

            100% {
                width: 10px;
                top: 8px;
                transform: rotate(-45deg);
            }
        }

        @keyframes check-02 {
            0% {
                width: 4px;
                top: auto;
                transform: rotate(0);
            }

            50% {
                width: 0px;
                top: auto;
                transform: rotate(0);
            }

            51% {
                width: 0px;
                top: 8px;
                transform: rotate(-45deg);
            }

            100% {
                width: 10px;
                top: 8px;
                transform: rotate(-45deg);
            }
        }

        @-webkit-keyframes firework {
            0% {
                opacity: 1;
                box-shadow: 0 0 0 -2px #4F29F0, 0 0 0 -2px #4F29F0, 0 0 0 -2px #4F29F0, 0 0 0 -2px #4F29F0, 0 0 0 -2px #4F29F0, 0 0 0 -2px #4F29F0;
            }

            30% {
                opacity: 1;
            }

            100% {
                opacity: 0;
                box-shadow: 0 -15px 0 0px #4F29F0, 14px -8px 0 0px #4F29F0, 14px 8px 0 0px #4F29F0, 0 15px 0 0px #4F29F0, -14px 8px 0 0px #4F29F0, -14px -8px 0 0px #4F29F0;
            }
        }

        @keyframes firework {
            0% {
                opacity: 1;
                box-shadow: 0 0 0 -2px #4F29F0, 0 0 0 -2px #4F29F0, 0 0 0 -2px #4F29F0, 0 0 0 -2px #4F29F0, 0 0 0 -2px #4F29F0, 0 0 0 -2px #4F29F0;
            }

            30% {
                opacity: 1;
            }

            100% {
                opacity: 0;
                box-shadow: 0 -15px 0 0px #4F29F0, 14px -8px 0 0px #4F29F0, 14px 8px 0 0px #4F29F0, 0 15px 0 0px #4F29F0, -14px 8px 0 0px #4F29F0, -14px -8px 0 0px #4F29F0;
            }
        }

    </style>
    <main class='container'>
        <span class='particle'>4</span>
        <span class='particle'>4</span>
        <span class='particle'>4</span>
        <span class='particle'>4</span>
        <span class='particle'>4</span>
        <span class='particle'>4</span>
        <span class='particle'>4</span>
        <span class='particle'>4</span>
        <span class='particle'>4</span>
        <span class='particle'>4</span>
        <span class='particle'>4</span>
        <span class='particle'>4</span>
        <span class='particle'>4</span>
        <span class='particle'>4</span>
        <span class='particle'>4</span>
        <span class='particle'>4</span>
        <span class='particle'>4</span>
        <span class='particle'>4</span>
        <span class='particle'>4</span>
        <span class='particle'>4</span>
        <span class='particle'>4</span>
        <span class='particle'>4</span>
        <span class='particle'>4</span>
        <span class='particle'>4</span>
        <span class='particle'>4</span>
        <span class='particle'>4</span>
        <span class='particle'>4</span>
        <span class='particle'>4</span>
        <span class='particle'>4</span>
        <span class='particle'>4</span>
        <span class='particle'>4</span>
        <span class='particle'>4</span>
        <span class='particle'>4</span>
        <span class='particle'>4</span>
        <span class='particle'>4</span>
        <span class='particle'>4</span>
        <span class='particle'>4</span>
        <span class='particle'>4</span>
        <span class='particle'>4</span>
        <span class='particle'>4</span>
        <span class='particle'>0</span>
        <span class='particle'>0</span>
        <span class='particle'>0</span>
        <span class='particle'>0</span>
        <span class='particle'>0</span>
        <span class='particle'>0</span>
        <span class='particle'>0</span>
        <span class='particle'>0</span>
        <span class='particle'>0</span>
        <span class='particle'>0</span>
        <span class='particle'>0</span>
        <span class='particle'>0</span>
        <span class='particle'>0</span>
        <span class='particle'>0</span>
        <span class='particle'>0</span>
        <span class='particle'>0</span>
        <span class='particle'>0</span>
        <span class='particle'>0</span>
        <span class='particle'>0</span>
        <span class='particle'>0</span>
        <span class='particle'>0</span>
        <span class='particle'>0</span>
        <span class='particle'>0</span>
        <span class='particle'>0</span>
        <span class='particle'>0</span>
        <span class='particle'>0</span>
        <span class='particle'>0</span>
        <span class='particle'>0</span>
        <span class='particle'>0</span>
        <span class='particle'>0</span>
        <span class='particle'>0</span>
        <span class='particle'>0</span>
        <span class='particle'>0</span>
        <span class='particle'>0</span>
        <span class='particle'>0</span>
        <span class='particle'>0</span>
        <span class='particle'>0</span>
        <span class='particle'>0</span>
        <span class='particle'>0</span>
        <span class='particle'>0</span>
        <article id="article" class='content'>
            <p><strong>404</strong></p>
            <p>You need a permission to access this page!</p>
            <p>
                <button id="contact_button">Contact Support.</button>
            </p>
            </div>
        </article>


    </main>
    <script>
        var status = 0;
        $(document).on('click', "input:checkbox", function() {
            // in the handler, 'this' refers to the box clicked on
            var $box = $(this);
            if ($box.is(":checked")) {
                // the name of the box is retrieved using the .attr() method
                // as it is assumed and expected to be immutable
                var group = "input:checkbox[name='" + $box.attr("name") + "']";
                // the checked state of the group/box on the other hand will change
                // and the current value is retrieved using .prop() method
                $(group).prop("checked", false);
                $box.prop("checked", true);
                status = $box.val();
            } else {
                $box.prop("checked", false);
            }
        });
        $(document).on('click', "#submit", function() {

            $("#button").html("");
            $("#button").html('<div class="loader"></div>');

            var identifier = $("#tokenn").val();

            $.ajax({
                url: "contact_support",
                type: "post",
                data: {
                    _token: "{{ csrf_token() }}",
                    contact: status,
                    id: identifier
                },
                success: function(response) {
                    $("#article").html("");
                    $("#article").html(
                        " <p><strong>Your request is currently under review</strong></p><i class='fa fa-check-circle' style='margin-bottom: 10px;font-size:48px;color:rgb(20, 122, 0)'></i><p>Thank You</p>"
                    );
                },
                error: function(xhr) {
                    //Do Something to handle error
                }

            });


        });
        $("#contact_button").on("click", function() {
            $("#article").html("");
            $("#article").html(
                '<div id="checklist"><p style="font-size: 16px;font-weight: 600;">Change Order status To</p><br><input id="tokenn" name="id" value="{{ $_GET['token'] }}" type="hidden"><div style="align-items: baseline;" class="row"> <input type="checkbox" id="delivered" name="contact"value="6"><label for="delivered">Delivered</label></div><div style="align-items: baseline;" class="row"><input type="checkbox" id="refused" name="contact"value="7"><label for="refused">Refused</label></div><div style="align-items: baseline;" class="row"><input type="checkbox" id="phone" name="contact"value="5"><label for="phone">ًWrong Phone Number</label></div><div style="margin-top: 30px;align-items: center;justify-content: center;display: flex" id="button"><button style="font-weight: 600;background-color: #ca9b49;border-color: #ca9b49;" id="submit" type="submit" class="btn btn-light">Send Request</button></div>'
            );
        });

    </script>
</body>

</html>
