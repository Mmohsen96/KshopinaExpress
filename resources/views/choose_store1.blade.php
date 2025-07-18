<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css2?family=Caveat:wght@500&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
        integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous">
    </script>
    <title>Choose</title>
</head>
<style>
    .choose {
        font-family: 'Caveat', cursive;
        text-align: center;
        font-size: 45px;
        margin-bottom: 80px;
        justify-content: center;
        display: flex;

    }

    .pp {
        padding: 10px 50px 10px 50px;
        border: 1px solid black;
        border-radius: 60px;
    }

    .container {
        position: absolute;
        margin: auto;
        top: 0;
        right: 0;
        bottom: 30%;
        left: 0;
        width: 100%;
        height: 200px;
    }

    .row {
        align-items: center;
        justify-content: space-around;
    }

</style>

<body>
    <div class="container">
        <div class="choose">
            <p class="pp"> Choose the store</p>
        </div>
        <div class="row">
            <a style="width: 16%;" href="/?store=origin"><img style="width: 100%;"
                    src="{{ url('/kshopina_original.png') }}" alt=""></a>

            <a style="width: 16%;" href="/?store=plus_egypt"><img style="width: 100%;"
                    src="{{ url('/EGYPT_logo.png') }}" alt=""></a>
        </div>
    </div>
</body>

</html>
