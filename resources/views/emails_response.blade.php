<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{$status}}</title>
    <link rel="icon" type="image/png" href="{{ asset('mini_yellow.png') }}" style="font-size: 2rem;">

    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">
    <style>
        body {
            background-color: #80808014;
            height: 90vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .container {
            display: flex;
            justify-content: center;
            height: auto;
        }

        .card {
            text-align: center;
            width: 60% !important;
            /*  height: 70vh; */
            /*  margin-top: 15vh; */
            margin-top: 7vw;
        }

        .card-text {
            font-family: 'Bebas Neue', cursive;
            font-size: 3.5vw;

            margin-bottom: 3px !important;
        }

        .success {
            color: #109145;
        }

        .cancel {
            color: #e62429;
        }

        .expired {
            color: #a6261f;
        }

        .card-text2 {

            font-size: 2.5rem;
            font-size: 2vw;
            color: #4a4748;
            font-weight: lighter;
            margin-top: 0px !important;
            font-family: Segoe, Tahoma, Geneva, Verdana, sans-serif;
        }

        .card-img-top {
            height: auto;
            width: 60%;

        }

        @media(max-width:992px) {
            .card-img-top {
                height: auto;
                width: 100%;

            }
        }

    </style>
</head>

<body>
    <div class="container">
        @if ($status=='success')
        <div class="card" style="width: 18rem;">
            <img class="card-img-top" src="{{ asset('envelope-success.png') }}" alt="Card image cap">
            <div class="card-body">
                <p class="card-text success"> {{$title}} </p>
                <p class="card-text2"> {{$sub_title}} </p>
            </div>
        </div>

        @elseif($status=='cancel')
        <div class="card" style="width: 18rem;">
            <img class="card-img-top" src="{{ asset('envelope-refused.png') }}" alt="Card image cap">
            <div class="card-body">
               
                <p class=" card-text cancel">{{$title}}</p>
                <p class="card-text2"> {{$sub_title}}</p>
                 
            </div>
        </div>
        @elseif($status=='fail')
        <div class="card" style="width: 18rem;">
            <img class="card-img-top" src="{{ asset('expired-1.png') }}" alt="Card image cap">
            <div class="card-body">
                <p style="letter-spacing: .5px;" class="card-text expired">{{$title}}</p>
                <p class="card-text2"> {{$sub_title}}</p>
            </div>
        </div>
        @endif
        
    </div>
</body>

</html>
