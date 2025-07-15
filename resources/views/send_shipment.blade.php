<!DOCTYPE html>
<!-- Created By CodingLab - www.codinglabweb.com -->
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>


    <script src="{{ asset('js/bootstrap.js') }}"></script>


    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/v4-shims.css">

    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.css') }}">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
</head>

<body>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 10px;
            background: linear-gradient(135deg, #134380, #cc9b48);
        }

        .container {
            max-width: 700px;
            width: 100%;
            background-color: #fff;
            padding: 25px 30px;
            border-radius: 5px;
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.15);
        }

        .container .title {
            font-size: 25px;
            font-weight: 500;
            position: relative;
        }

        /* .container .title::before {
            content: "";
            position: absolute;
            left: 5px;
            bottom: 8px;
            height: 3px;
            width: 30px;
            border-radius: 5px;
            background: linear-gradient(135deg, #14477D, #CA9B49);
        } */

        .content form .user-details {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            margin: 20px 0 12px 0;
        }

        form .user-details .input-box {
            margin-bottom: 15px;
            width: calc(100% / 2 - 20px);
        }

        form .input-box span.details {
            display: block;
            font-weight: 500;
            margin-bottom: 5px;
        }

        .user-details .input-box input {
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

        .user-details .input-box textarea {
            width: 100%;
            outline: none;
            font-size: 16px;
            border-radius: 5px;
            padding-left: 15px;
            border: 1px solid #ccc;
            border-bottom-width: 2px;
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
            font-weight: 500;
        }

        form .category {
            display: flex;
            /* width: 90%; */
            margin: 14px 0;
            /* justify-content: space-between; */
            align-items: center;
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
            background: linear-gradient(135deg, #134380, #cc9b48);
        }

        form .button input:hover {
            /* transform: scale(0.99); */
            background: linear-gradient(135deg, #36304a, #CA9B49);
        }

        @media(max-width: 584px) {
            .container {
                max-width: 100%;
            }

            form .user-details .input-box {
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

        .gender-details {
            width: calc(100% / 1 - 20px);
        }


        /* popup */

        .wtree li {
            list-style-type: none;
            margin: 10px 0 10px 10px;
            position: relative;
        }

        .wtree li:before {
            content: "";
            position: absolute;
            top: -10px;
            left: -20px;
            border-left: 1px solid #ddd;
            border-bottom: 1px solid #ddd;
            width: 20px;
            height: 15px;
        }

        .wtree li:after {
            position: absolute;
            content: "";
            top: 5px;
            left: -20px;
            border-left: 1px solid #ddd;
            border-top: 1px solid #ddd;
            width: 20px;
            height: 100%;
        }

        .wtree li:last-child:after {
            display: none;
        }

        .wtree li span {
            display: block;
            border: 1px solid #ddd;
            padding: 10px;
            color: #888;
            text-decoration: none;
        }

        .wtree li span:hover,
        .wtree li span:focus {
            background: #eee;
            color: #000;
            border: 1px solid #aaa;
        }
        .wtree li input:focus {
            background: #eee;
            color: #000;
            border: none !important;
        }
        
        .wtree li span:hover+ul li span,
        .wtree li span:focus+ul li span {
            background: #eee;
            color: #000;
            border: 1px solid #aaa;
        }

        .wtree li span:hover+ul li:after,
        .wtree li span:hover+ul li:before,
        .wtree li span:focus+ul li:after,
        .wtree li span:focus+ul li:before {
            border-color: #aaa;
        }

        .overlay {
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
            background: rgba(0, 0, 0, 0.7);
            transition: opacity 500ms;
            display: none;
        }

        .overlay:target {
            visibility: visible;
            opacity: 1;
        }

        .popup {
            margin: 70px auto;
            padding: 20px;
            background: #fff;
            border-radius: 5px;
            width: 35%;
            position: relative;
            transition: all 5s ease-in-out;
        }

        .popup h2 {
            margin-top: 0;
            color: #ca9b49;
            font-family: Tahoma, Arial, sans-serif;
        }

        .popup .close {
            position: absolute;
            top: 20px;
            right: 30px;
            transition: all 200ms;
            font-size: 30px;
            font-weight: bold;
            text-decoration: none;
            color: #333;
        }

        .popup .close:hover {
            color: #ca9b49;
        }

        .popup .content {
            max-height: 45%;
            overflow: auto;
        }

        @media screen and (max-width: 700px) {
            .box {
                width: 70%;
            }

            .popup {
                width: 70%;
            }
        }

        ul {
            margin-left: 20px;
        }

    </style>
    <?php
    
    ?>
    <div class="container">
        <div class="title"><img style="width: 23%;" src="{{ url('kshopina-express_b.png') }}" alt=""></div>
        <div class="content">
            <form method="POST" action="send_new_shipment" enctype="multipart/form-data">
                @csrf
                <div class="user-details">
                    <div class="input-box">
                        <span class="details">Shipment number</span>
                        <input name="product_title" type="text" placeholder="Enter Shipment number" required>
                    </div>
                    <div class="input-box">
                        <span class="details">To</span>
                        <select name="product_type" id="formOrder1" class="details" placeholder="Type">
                            <option value="" selected disabled hidden>Select the company</option>
                            @foreach ($companies as $company)
                                <option value="{{ $company->value }}">{{ $company->value }}</option>
                            @endforeach

                        </select required>

                    </div>
                    <div class="input-box">
                        <span class="details">Description </span>
                        <textarea rows="3" cols="40" name="description"
                            placeholder="write the shipment description here...." required> </textarea>
                    </div>


                    <div class="gender-details">

                        <span class="gender-title">Products</span>
                        <div class="category">
                            <span style="margin-right: 12px;">no product choosen</span>
                            <button id="show_products" onclick="show_popup(this)" style="margin-right: 20px;"
                                type="button" class="btn btn-dark">
                                <i class="fas fa-list"></i> Select</button>
                            <button type="button" class="btn btn-info"><i class="fas fa-plus"></i> Add new</button>

                        </div>
                    </div>
                </div>
                <div class="button">
                    <input type="submit" value="Submit">
                </div>
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if ($message = Session::get('success'))
                    <div class="alert alert-success alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong>{{ $message }}</strong>
                    </div>
                @endif
            </form>
        </div>
    </div>
    <div id="popup1" class="overlay">
        <div class="popup">
            <h2 style="margin-bottom: 8px" id="order">Products</h2>
            <a id='close' class="close" href="#">&times;</a>
            <div class="content">
                {{-- <div style="margin-left: 32px;" id="items">10 item</div> --}}
                <ul id="tree" class="wtree">
                    <li>
                        <span>Nivel 1</span>
                        <ul>
                            <li>
                                <span style="display:flex; justify-content: space-between;align-items: center;">Nivel 2 
                                    <input style="background: transparent;width: 60px;border: none;" placeholder="QTY" type="number" name="quantity" id="product1_quantity">
                                    <input type="checkbox" name="product" id="product1_active"></span>

                            </li>
                        </ul>
                    </li>

                </ul>
            </div>
        </div>
    </div>
</body>
<script>
    function show_popup(elemant) {
        $("#popup1").show();
    }
    $('#close').click(function() {
        $('#popup1').hide();
    });
</script>

</html>
