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
            width: calc(100% / 3 - 20px);
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
            width: calc(100% / 1 - 20px);
        }

        @media(max-width: 584px) {

            .p_quantity,
            .p_title {
                width: 100% !important;
            }

            .input-box {
                width: 100% !important;
            }
        }

    </style>
    <?php
    
    ?>
    <div class="container">
        <div class="title"><img style="width: 23%;" src="{{ url(asset('kshopina-express_b.png')) }}" alt="">
        </div>
        <div class="content">
            <form method="POST" action="adjust_quantity" enctype="multipart/form-data">
                @csrf
                <input name='id' style="display: none;" value="{{ $_GET['id'] }}" readonly>
                <div class="user-details">
                    <div style="width: calc((100% / 3)*2);" class="p_title input-box">
                        <span class="details">Product title</span>
                        <input value="{{ $product->product_title }}" disabled name="product_title" type="text"
                            placeholder="Enter product name" required>
                    </div>
                    <div class="input-box">
                        <span class="details">Product type</span>
                        <input value="{{ $product->product_type }}" disabled id="formOrder1" name="product_type"
                            type="text" required>

                        {{-- <select disabled name="product_type" id="formOrder1" class="details" placeholder="Type"
                            style="color: black;">
                            <option value="" disabled hidden>Select the type</option>
                            <option value="{{ $product->product_type }}" selected>{{ $product->product_type }}
                            </option>

                        </select required> --}}


                    </div>

                    <div class="input-box">
                        <span class="details">Variants</span>
                        <select onchange="variant(this)" name="variants" id="formOrder" class="details" placeholder="Variants">
                            <option value="" selected disabled hidden>Select variant</option>

                            @foreach ($variants as $variant)
                            @if (count($variants)==1)
                            
                            <option selected value="{{$variant->variant_title}}_{{$variant->variant_price}}_{{$variant->variant_quantity}}_{{$variant->variant_id}}_{{$variant->variant_inventory_id}}">{{$variant->variant_title}}</option>

                            @else
                            <option value="{{$variant->variant_title}}_{{$variant->variant_price}}_{{$variant->variant_quantity}}_{{$variant->variant_id}}_{{$variant->variant_inventory_id}}">{{$variant->variant_title}}</option>

                            @endif

                            @endforeach
                            {{-- <option @if ($form_data['country'] == 'Egypt') selected @endif value="Egypt">Egypt</option> --}}
                        </select required>

                        {{-- <span class="details">Country</span>
                        <input type="text" placeholder="Enter your email" required> --}}
                    </div>
                    <div class="input-box">
                        <span class="details">Price</span>
                        <input @if (count($variants) == 1) value= "{{$variants[0]->variant_price}}" @endif  disabled id="price" name="variant_price" type="text" placeholder="none">
                    </div>
                    <div class="p_quantity input-box">
                        <span class="details">Quantity</span>
                        <input @if (count($variants) == 1) value= "{{$variants[0]->variant_quantity}}" @endif id="quantity" readonly name="variant_quantity" type="number"
                            placeholder="none" min="0">
                    </div>

                    <div class="gender-details">
                        <input value="0" type="radio" onchange="radio_changed(this)" name="adjust" id="dot-1">
                        <input value="1" type="radio" onchange="radio_changed(this)" name="adjust" id="dot-2">
                        <span style='white-space: nowrap;' class="gender-title">Adjust Quantity</span>
                        <div class="category">
                            <label for="dot-1">
                                <span class="dot one"></span>
                                <span class="gender">IN</span>
                            </label>
                            <label for="dot-2">
                                <span class="dot two"></span>
                                <span class="gender">OUT</span>
                            </label>

                        </div>
                    </div>
                    {{-- out --}}
                    <div id="out" style="display:none; width: 100%;" class="user-details">
                        <div style="width: calc(100% / 2 - 20px);" class="input-box">

                            @if (Auth::user()->name == 'OCS')
                                <span class="details">Market</span>
                                <select style="color: black;font-weight: 400;" name="market" id="formOrder1"
                                    class="details" placeholder="market" readonly>
                                    <option value="Kshopina" selected>Kshopina plus Kuwait</option>
                                </select required>
                            @else
                                <span class="details">Choose the market</span>
                                <select name="market" id="formOrder1" class="details" placeholder="market">
                                    <option value="" selected hidden>Select</option>
                                    <option value="Kshopina">Kshopina Original</option>
                                    <option value="Amazon">Amazon</option>
                                    <option value="Jumia">Jumia</option>
                                    <option value="Noon">Noon</option>
{{--                                     <option value="Kshopina-Egypt">Kshopina-Egypt</option>
 --}}
                                </select required>
                            @endif

                        </div>
                        <div style="width: calc(100% / 2 - 20px);" class="input-box">
                            <span class="details">Quantity</span>
                            <input onkeyup="check_quantity(this)" onchange="check_quantity(this)" name="out_quantity"
                                type="number" placeholder="Enter the Quantity" min="0">
                        </div>
                    </div>


                    {{-- in --}}
                    <div id="in" style="display:none; width: 100%;" class="user-details">
                        <div style="width: calc(100% / 2 - 20px);" class="input-box">
                            <span class="details">Source</span>
                            <select name="source" id="formOrder1" class="details" placeholder="Type">
                                <option value="" selected hidden>Select</option>
                                <option value="Return Item">Return from kshopina original</option>
                                <option value="New for stock">New for stock</option>

                            </select required>


                        </div>


                        <div style="width: calc(100% / 2 - 20px);" class="input-box">
                            <span class="details">Quantity</span>
                            <input name="in_quantity" type="number" placeholder="Enter the Quantity" min="0">
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

<script>
    function radio_changed(elemant) {
        if (elemant.id == "dot-2") {
            console.log(elemant.value);
            $("#in").hide();
            $("#out").show();

        } else {
            console.log(elemant.value);

            $("#out").hide();
            $("#in").show();

        }

    }

    function check_quantity(elemant) {

        if (elemant.value > $("#quantity").val()) {
            $(elemant).val($("#quantity").val());
        }
        console.log($("#quantity").val());
    }
    function variant(elem){
        console.log('dscd');
        var values=elem.value.split('_');
        $('#price').val(values[1]);
        $('#quantity').val(values[2]);

    }
</script>

</html>
