<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>QR Code</title>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>

    <script src="{{ asset('js/bootstrap.js') }}"></script>


    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/v4-shims.css">

    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.css') }}">

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


    <style>
        @font-face {
            font-family: proxima;
            font-weight: normal;
            src: url('fonts/proxima_ssv/ProximaNova-Regular.otf');
        }

        @font-face {
            font-family: proxima;
            font-weight: bold;
            src: url('fonts/proxima_ssv/Proxima\ Nova\ Bold.otf');
        }

        @font-face {
            font-family: proxima;
            font-weight: 200;
            src: url('fonts/proxima_ssv/Proxima\ Nova\ Thin.otf');
        }

        body {
            font-family: 'proxima';
        }


        .btn-circle.btn-xl {
            width: 70px;
            height: 70px;
            padding: 10px 16px;
            font-size: 24px;
            line-height: 1.33;
            border-radius: 35px;
        }

        .main {
            margin-top: 50px;
            justify-content: center;
            display: flex;
            text-align: center;
        }

        .item {
            margin-top: 35px;
        }

        #list {
            position: absolute;
            margin: auto;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            width: 200px;
            height: 420px;
        }

        .overlay {
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
            background: rgba(0, 0, 0, 0.7);
            transition: opacity 500ms;
            visibility: hidden;
            opacity: 0;
        }

        .overlay:target {
            z-index: 10;
            visibility: visible;
            opacity: 1;
        }

        .show {
            z-index: 10;
            visibility: visible;
            opacity: 1;
        }

        .lds-dual-ring {
            justify-content: center;
            text-align: center;
            display: flex;
            position: relative;
        }

        .lds-dual-ring:after {
            content: " ";
            display: block;
            width: 55px;
            height: 55px;
            margin: 8px;
            border-radius: 50%;
            border: 6px solid #fff;
            border-color: rgb(0, 0, 0) transparent rgb(0, 0, 0) transparent;
            animation: lds-dual-ring 1.2s linear infinite;
        }

        @keyframes lds-dual-ring {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        #delivered2 {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .item2 {
            display: flex;
            justify-content: center;
        }


        

    </style>
</head>

<body>
    
    <div class="main container">
        <div id="list" class="column">
            <div class="column item">
                <button id="Delivered" type="button" class="btn btn-success btn-circle btn-xl">
                    <i class="fas fa-check"></i>
                </button>
                <div style="font-weight: 500;font-size: 17px;">Delivered</div>
            </div>
            <div class="column item">
                <button id="Refused" type="button" class="btn btn-danger btn-circle btn-xl">
                    <i class="fas fa-times"></i>
                </button>
                <div style="font-weight: 500;font-size: 17px;">Refused</div>
            </div>
            <div class="column item">
                <button id="Wrong" type="button" class="btn btn-warning btn-circle btn-xl">
                    <i class="fas fa-exclamation"></i>
                </button>
                <div style="font-weight: 500;font-size: 17px;">Wrong Phone number</div>
            </div>
        </div>
        <div id="token" style="display: none;">{{ $_GET['token'] }}</div>
    </div>
</body>
<script>
    /* var sweet_loader = 'loader.gif';

    swal({
            title: "Are you sure?",
            text: "Order Delivered, you will not be able to undo this !",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((delivered) => {
            if (delivered) {




            }
        }); */

    $("#Delivered").click(function() {

        swal({
                title: "Are you sure?",
                text: "Order Delivered, you will not be able to undo this !",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((delivered) => {
                if (delivered) {

                    swal({
                        title: "Please wait!",
                        text: " ",
                        closeOnClickOutside: false,
                        button: null,
                        icon: "loader.gif",
                    });

                    $identifier = $("#token").text();

                    $.ajax({
                        url: "delivered",
                        type: "post",
                        data: {
                            _token: "{{ csrf_token() }}",
                            identifier: $identifier,
                        },
                        success: function(response) {
                            if (response[0]) {
                                swal("Thank You", {
                                    icon: "success",
                                });
                            } else {
                                window.location.href = 'wrong?token='+$identifier;
                            }


                        },
                        error: function(xhr) {
                            //Do Something to handle error
                        }

                    });
                }
            });


    });



    $("#Wrong").click(function() {

        swal({
                title: "Are you sure?",
                text: "You tried to call this number, but the customer is unreachable !",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((delivered) => {
                if (delivered) {

                    swal({
                        title: "Please wait!",
                        text: " ",
                        closeOnClickOutside: false,
                        button: null,
                        icon: "loader.gif",
                    });

                    $identifier = $("#token").text();

                    $.ajax({
                        url: "wrongPhone",
                        type: "post",
                        data: {
                            _token: "{{ csrf_token() }}",
                            identifier: $identifier,
                        },
                        success: function(response) {
                            if (response[0]) {
                                swal("Thank You", {
                                    icon: "success",
                                });
                            } else {
                                window.location.href = 'wrong?token='+$identifier;
                            }


                        },
                        error: function(xhr) {
                            //Do Something to handle error
                        }

                    });

                }
            });

    });


    $("#Refused").click(function() {

        swal({
                title: "Are you sure?",
                text: "Order Refused, you will not be able to undo this !",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((delivered) => {
                if (delivered) {

                    swal({
                        title: "Please wait!",
                        text: " ",
                        closeOnClickOutside: false,
                        button: null,
                        icon: "loader.gif",
                    });

                    $identifier = $("#token").text();

                    $.ajax({
                        url: "refused",
                        type: "post",
                        data: {
                            _token: "{{ csrf_token() }}",
                            identifier: $identifier,
                        },
                        success: function(response) {

                            if (response[0]) {
                                swal("Thank You", {
                                    icon: "success",
                                });
                            } else {
                                window.location.href = 'wrong?token='+$identifier;
                            }


                        },
                        error: function(xhr) {
                            //Do Something to handle error
                        }

                    });


                }
            });

    });

</script>

</html>
