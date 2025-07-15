<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Choose</title>


    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"
        integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap-theme.min.css"
        integrity="sha384-6pzBo3FDv/PJ8r2KRkGHifhEocL+1X2rVCTTkUfGk7/0pbek5mMa1upzvWbrUbOZ" crossorigin="anonymous">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"
        integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous">
    </script>


    <style>
        body {
            font-family: fantasy;
            letter-spacing: 2px;
        }

        b {
            font-weight: 400 !important;
        }

        .one {
            background-color: rgba(26, 23, 23, 0.788);
            height: 100vh;
            width: 5vw;
        }

        .two {
            background-color: white;
            height: 100vh;
            width: 5vw;
            margin-top: 0vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .three {
            height: 70vh;
            margin-top: 15vh;
            width: 90vw;
            margin-right: -2vw;
            padding-left: 0 !important;
            padding-right: 5vw !important;
        }

        .logo {
            width: 70%;
            margin-top: 10%;
            margin-left: 10%;
        }

        .img1 {
            background-color: #959595;
            height: 100%;
            overflow: hidden;
        }
        .img1:hover .aa {
            color: rgb(147 107 40) !important;
        }
        .img1:hover {

            color: rgb(147 107 40);
            cursor: pointer;
            box-shadow: -6px 8px 3px -2px rgb(0 0 0 / 20%), 0 3px 4px 0 rgb(0 0 0 / 14%), 0 1px 8px 0 rgb(0 0 0 / 12%);
        }

        .img2 {
            background-color: #afafaf;
            height: 100%;
            overflow: hidden;
        }
        .img2:hover .aa {
            color: rgb(147 107 40) !important;
        }
        .img2:hover {

            color: rgb(147 107 40);
            cursor: pointer;
            box-shadow: -6px 8px 3px -2px rgb(0 0 0 / 20%), 0 3px 4px 0 rgb(0 0 0 / 14%), 0 1px 8px 0 rgb(0 0 0 / 12%);
        }

        .img3 {
            background-color: #cdcdcd;
            height: 100%;
            overflow: hidden;
        }
        .img3:hover .aa {
            color: rgb(147 107 40) !important;
        }
        .img3:hover {

            color: rgb(147 107 40);
            cursor: pointer;
            box-shadow: -6px 8px 3px -2px rgb(0 0 0 / 20%), 0 3px 4px 0 rgb(0 0 0 / 14%), 0 1px 8px 0 rgb(0 0 0 / 12%);
        }

        .img4 {
            background-color: #e9e9e9;
            height: 100%;
            overflow: hidden;
        }

        .img4:hover .aa {
            color: rgb(147 107 40) !important;
        }

        .img4:hover {

            color: rgb(147 107 40) !important;
            cursor: pointer;
            box-shadow: -6px 8px 3px -2px rgb(0 0 0 / 20%), 0 3px 4px 0 rgb(0 0 0 / 14%), 0 1px 8px 0 rgb(0 0 0 / 12%);
        }

        h3 {
            margin-top: 60vh;
            font-size: 2vw;
        }

        p {
            font-size: 1vw;
        }

        h1 {
            transform: rotatez(270deg);

            font-weight: bolder;
            font-size: 3.5rem;
            opacity: 0.3;
        }

        .global {
            width: 68%;
            transform: rotatez(40deg);
            position: absolute;
            left: 44%;
            top: -7%;
        }

        .egypt {
            margin-top: -6%;
            width: 100%;
            transform: rotatez(24deg);
            position: absolute;
            left: 20%;
        }

        .kuwait {
            margin-top: -6%;
            width: 100%;
            transform: rotatez(24deg);
            position: absolute;
            left: 20%;
        }

        .ksa {
            margin-top: 4%;
            width: 100%;
            transform: rotatez(24deg);
            position: absolute;
            left: 20%;
        }

        @media screen and (max-width:880px) {
            .global {
                top: -3%;
            }
        }

        @media screen and (max-width:500px) {
            .three {
                width: 88vw;
            }
        }

        @media screen and (max-width:430px) {
            .three {
                width: 80vw;
            }
        }

        .aa {
            color: #333333;
        }

    </style>

</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class=" one col-lg-2 col-md-2 col-sm-2 col-xs-2 ">
                <div><img class="logo" src="{{ asset('logo.png') }}"></div>

            </div>

            <div class=" two col-lg-2 col-md-2 col-sm-2 col-xs-2  ">
                <h1>CATEGORY</h1>
            </div>
            <div class=" three col-lg-8 col-md-8 col-sm-8 col-xs-8">
                <a href="/?store=origin">
                    <div class="img1 col-lg-3 col-md-3 col-sm-3 col-xs-3">
                        <img class="global" src="{{ asset('global.png') }}" alt="" srcset="">
                        <h3><b>Original</b> </h3>
                    </div>
                </a>
                <a href="/?store=plus_egypt">

                    <div class="img2 col-lg-3 col-md-3 col-sm-3 col-xs-3">
                        <img class="egypt" src="{{  asset('egypt.png') }}" alt="" srcset="">
                        <h3 class="text"><b class="aa">Egypt</b> </h3>
                    </div>
                </a>
                <a href="/?store=plus_kuwait">

                    <div class="img3 col-lg-3 col-md-3 col-sm-3 col-xs-3">
                        <img class="kuwait" src="{{  asset('kuwait.png') }}" alt="" srcset="">
                        <h3 class="text"><b class="aa">Kuwait</b> </h3>

                    </div>
                </a>
                <a href="/?store=plus_ksa">

                    <div class="img4 col-lg-3 col-md-3 col-sm-3 col-xs-3">
                        <img class="ksa" src="{{  asset('ksa.png') }}" alt="" srcset="">
                        <h3 class="text"><b class="aa">KSA</b> </h3>

                    </div>
                </a>
            </div>
        </div>
    </div>

</body>

</html>
