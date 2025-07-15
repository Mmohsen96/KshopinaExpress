<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="{{ asset('js/sweetalert2.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('js/sweetalert2.min.css') }}">    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">

    <script src="{{ asset('js/bootstrap.js') }}"></script>


    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.css') }}">


    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">
    <style>
        .b {
            font-size: smaller;
            margin-left: -35px;
        }




        .btn_submit {
            border-radius: 3px;
            background-color: #296e45;
            color: white;
            font-size: 15px;
            padding: 1.5%;

        }

        .btn_link {
            white-space: nowrap !important;
            text-align: center !important;
            background-color: #5b8f6f !important;
            margin-top: 12px;
            margin-left: 10px;
            font-size: 12px !important;
            width: 60% !important;

        }

        body {
            margin-top: 20px;

        }

        .swal2-input {
            border: 2px solid #296E45 !important;
            background-color: white;
        }

        .swal2-styled.swal2-confirm {
            background-color: #296e45 !important;
        }

        .swal2-title {

            color: #296e45 !important;
            margin-bottom: 5% !important;
        }

        .swal2-container.swal2-center>.swal2-popup {
            background-color: #f7f6f3;
        }

        .card-text {
            font-size: 1rem !important;

        }

        .card-title {
            font-family: 'Bebas Neue', cursive;
            font-size: 1.5rem !important;
            color: #cb9d48;

        }

        .card-body {
            text-align: initial;
            background-color: #f7f6f3;
        }

        .card {
            border: none;
        }

        .card-img {
            border-radius: 0;
        }

        .vgr-cards .card {
            display: flex;
            flex-flow: wrap;
            flex: 100%;
            margin-bottom: 45px;
        }

        .vgr-cards .card:nth-child(even) .card-img-body {
            order: 2;
        }

        .vgr-cards .card:nth-child(even) .card-body {
            padding-left: 0;
            padding-right: 1.25rem;
        }

        @media (max-width: 576px) {
            .vgr-cards .card {
                display: block;
            }
        }

        .vgr-cards .card-img-body {
            flex: 2;
            overflow: hidden;
            position: relative;
            box-shadow: -1px 5px 9px 0px rgb(0 0 0 / 25%);
            border-radius: 6px;
        }

        @media (max-width: 576px) {
            .vgr-cards .card-img-body {
                width: 100%;
                height: 200px;
                margin-bottom: 20px;
            }
        }

        .vgr-cards .card-img {
            width: 100%;
            height: auto;
            position: absolute;
            /*     margin-left: 50%; */
            transform: translateX(-50%);
        }

        @media (max-width: 1140px) {
            .vgr-cards .card-img {
                margin: 0;
                transform: none;
                width: 100%;
                height: auto;
            }
        }

        .vgr-cards .card-body {
            flex: 1;
            padding: 0 0 0 1.25rem;
        }

        @media (max-width: 576px) {
            .vgr-cards .card-body {
                padding: 0;
            }
        }

    </style>
</head>

<body>
    {{-- <form action="/import_file" method="post" enctype="multipart/form-data">
        @csrf
        <input type="file" name="file" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet ">

        <button type="submit">submit</button>
    </form> --}}


    <button onclick="upload()">Upload</button>

    <input id="url_form_url" type="text"
        value=" @if (isset($form_url)) {{ $form_url }}
    <br /> @endif" hidden readonly>



    <p>

    </p>




    <script>
        function upload() {

            $url = $('#url_form_url').val();
            window.open($url, "_blank");


            Swal.fire({
                title: 'Upload',

                html: ' <div id="user_guide"><div class="container"> <div class="card-group vgr-cards"> <div class="card"> <div class="card-img-body"> <img class="card-img" src="{{ asset('55.PNG') }}" alt="Card image cap"> </div> <div class="card-body"> <h4 class="card-title">First Step</h4> <p class="card-text"><ul  class="b"><li>Clear all previous data</li><li>Fill your new data </li></ul> </p>   </div> </div>' +

                    '   <div class="card"><div class="card-img-body"> <img class="card-img" src="{{ asset('66.png') }}" alt="Card image cap"></div> <div class="card-body"><h4 class="card-title">Second Step</h4> <p class="card-text">Download your Excel sheet (.xlsx) </p>   </div> </div> ' +
                    ' <div class="card" style="background-color: inherit;">  <div class="card-body" style="text-align: center;">  <h4 class="card-title">Last Step</h4> <p class="card-text">Upload your Excel Sheet here </p>      </div>' +
                    '  <form action="/import_file" method="post" enctype="multipart/form-data" style="width: 100%;margin-top: 50px;background-color: inherit;">@csrf<input type="file" name="file" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet "><button class="btn_submit" type="submit">submit</button></form>  </div> </div>  </div> </div> '

                    ,
                inputAttributes: {
                    autocapitalize: 'off'
                },
                inputPlaceholder: 'Paste Your URL here !!',
                showCancelButton: true,
                confirmButtonText: false,
                showLoaderOnConfirm: true,
                customClass: {
                    confirmButton: 'c' //insert class here
                },
                backdrop: true,
                preConfirm: (value) => {
                    if (value == "") {
                        Swal.showValidationMessage(
                            `Please fill in the field`
                        );
                        return false;
                    } else {
                        return value;
                    }
                },
                allowOutsideClick: () => !Swal.isLoading()
            }).then((result) => {
                if (result.value) {
                    console.log(result);

                }
            })

            $(".swal2-confirm.swal2-styled").css("display", "none ");
        }

        function upload_first_time() {

            Swal.fire({
                title: 'Upload',

                html: ' <div id="user_guide"><div class="container"> <div class="card-group vgr-cards"> <div class="card"> <div class="card-img-body"> <img class="card-img" src="{{ asset('55.PNG') }}" alt="Card image cap"> </div> <div class="card-body"> <h4 class="card-title">First Step</h4> <p class="card-text"><ul  class="b"><li>Clear all previous data</li><li>Fill your new data </li></ul> </p>   </div> </div>' +

                    '   <div class="card"><div class="card-img-body"> <img class="card-img" src="{{ asset('66.png') }}" alt="Card image cap"></div> <div class="card-body"><h4 class="card-title">Second Step</h4> <p class="card-text">Download your Excel sheet (.xlsx) </p>   </div> </div> ' +
                    ' <div class="card" style="background-color: inherit;">  <div class="card-body" style="text-align: center;">  <h4 class="card-title">Last Step</h4> <p class="card-text">Upload your Excel Sheet here </p>      </div>' +
                    '  <form action="/import_file" method="post" enctype="multipart/form-data" style="width: 100%;margin-top: 50px;background-color: inherit;">@csrf<input type="file" name="file" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet "><button class="btn_submit" type="submit">submit</button></form>  </div> </div>  </div> </div> '

                    ,
                inputAttributes: {
                    autocapitalize: 'off'
                },
                inputPlaceholder: 'Paste Your URL here !!',
                showCancelButton: true,
                confirmButtonText: false,
                showLoaderOnConfirm: true,
                customClass: {
                    confirmButton: 'c' //insert class here
                },
                backdrop: true,
                preConfirm: (value) => {
                    if (value == "") {
                        Swal.showValidationMessage(
                            `Please fill in the field`
                        );
                        return false;
                    } else {
                        return value;
                    }
                },
                allowOutsideClick: () => !Swal.isLoading()
            }).then((result) => {
                if (result.value) {
                    console.log(result);

                }
            })

            $(".swal2-confirm.swal2-styled").css("display", "none ");

        }

        Swal.fire({
            title: 'Setup your Google Form',
            input: 'text',
            html: ' <div id="user_guide"><div class="container"> <div class="card-group vgr-cards"> <div class="card"> <div class="card-img-body"> <img class="card-img" src="{{ asset('44.PNG') }}" alt="Card image cap"> </div> <div class="card-body"> <h4 class="card-title">First Step</h4> <p class="card-text"> Make a copy of Kshopina Template <a target="blank" href="https://docs.google.com/spreadsheets/d/1gcr0gHolJtEwaNQrzATTT5WZmeJIRXDKZDPrnlv0h3g/copy?usp=sharing" class="btn btn-primary btn_link"> Click here! </a> </p>   </div> </div>' +

                '   <div class="card"><div class="card-img-body"> <img class="card-img" src="{{ asset('3.jpg') }}" alt="Card image cap"></div> <div class="card-body"><h4 class="card-title">Second Step</h4> <p class="card-text"> Copy the Url of your version of Kshopina Template </p>   </div> </div> ' +
                ' <div class="card">  <div class="card-body" style="text-align: center;">  <h4 class="card-title">Last Step</h4> <p class="card-text">Paste your url here </p>      </div>  </div> </div>  </div> </div> '

                ,
            inputAttributes: {
                autocapitalize: 'off'
            },
            inputPlaceholder: 'Paste Your URL here !!',
            showCancelButton: true,
            confirmButtonText: 'Send',
            showLoaderOnConfirm: true,
            backdrop: true,
            preConfirm: (value) => {
                if (value == "") {
                    Swal.showValidationMessage(
                        `Please fill in the field`
                    );
                    return false;
                } else {
                    return value;
                }
            },
            allowOutsideClick: () => !Swal.isLoading()
        }).then((result) => {
            if (result.value) {
                console.log(result);
                $.ajax({
                    url: "user_url",
                    type: 'POST',
                    data: {
                        _token: "{{ csrf_token() }}",
                        user_url: result.value,

                    },
                    success: function(resposne) {

                        console.log(resposne);
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: 'Your url has been sent ',
                            showConfirmButton: false,
                            timer: 1500
                        });


                        upload_first_time();

                    }
                });
            }
        });
        }
    </script>
</body>

</html>
