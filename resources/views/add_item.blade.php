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
        .user-details .input-box input:valid {
            border-color: #CA9B49;
        }

        form .gender-details .gender-title {
            font-size: 20px;
            font-weight: 500;
        }

        form .category {
            display: flex;
            width: 80%;
            margin: 14px 0;
            justify-content: space-between;
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
            width: calc(100% / 2 - 20px);
        }

    </style>
    <?php
    
    ?>
    <div class="container">
        <div class="title"><img style="width: 23%;" src="{{ url('kshopina-express_b.png') }}" alt=""></div>
        <div class="content">
            <form method="POST" action="add_new_product" enctype="multipart/form-data">
                @csrf
                <div class="user-details">
                    <div class="input-box">
                        <span class="details">Product title</span>
                        <input name="product_title" type="text" placeholder="Enter product name" required>
                    </div>
                    <div class="input-box">
                        <span class="details">Product type</span>
                        <select name="product_type" id="formOrder1" class="details" placeholder="Type">
                            <option value="" selected disabled hidden>Select the type</option>
                            @foreach ($types as $type)
                                <option value="{{ $type->value }}">{{ $type->value }}</option>
                            @endforeach

                        </select required>

                        {{-- <span class="details">Country</span>
                        <input type="text" placeholder="Enter your email" required> --}}
                    </div>
                    <div class="input-box">
                        <span class="details">Band Name</span>
                        <select name="product_band" id="formOrder" class="details" placeholder="Band">
                            <option value="" selected disabled hidden>Select the band</option>
                            @foreach ($bands as $band)
                                <option value="{{ $band->value }}">{{ $band->value }}</option>
                            @endforeach

                        </select required>

                        {{-- <span class="details">Country</span>
                        <input type="text" placeholder="Enter your email" required> --}}
                    </div>
                    <div class="input-box">
                        <span class="details">SKU </span>
                        <input name="product_sku" type="text" placeholder="Enter the SKU" required>
                    </div>

                    <div class="input-box">
                        <span class="details">Quantity</span>
                        <input name="product_quantity" type="number" placeholder="Enter the Quantity"  min="0" required>
                    </div>
                    {{-- <div class="input-box">
                        <span class="details">Address - العنوان</span>
                        <input @if ($form_data_status['address'] == 0) disabled
                    @else
                        style="border-color: #f31c1c;" @endif
                        value="{{ $form_data['address'] }}" name="address" type="text" placeholder="Enter your
                        Address" required>
                    </div>
                    <div class="input-box">
                        <span class="details">Apartment - العقار</span>
                        <input @if ($form_data_status['apartment'] == 0) disabled
                    @else
                        style="border-color: #f31c1c;" @endif
                        value="{{ $form_data['apartment'] }}" name="apartment" type="text" placeholder="Enter
                        Apartment Number"
                        required>
                    </div>
                </div> --}}
                    <div class="gender-details">

                        <span class="gender-title">Product image</span>
                        <div class="category">
                            <input type="file" name="image">



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

</body>


</html>
