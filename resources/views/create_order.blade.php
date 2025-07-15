@extends('layouts.dash_board_layout')

@section('content')
    <style>
        .card {
            position: relative;
            display: flex;
            margin-top: 0.5rem;
            width: 96%;
            min-width: 0;
            word-wrap: break-word;
            background-color: #fff;
            background-clip: border-box;
            border: 0px;
            border-radius: 0rem;
            align-items: center;
        }

        .form-row {
            margin: 0 0px;
        }

        .form-row .form-group,
        .form-row .form-radio {
            width: 10.5rem;

        }

        label {
            display: inline-block;
            margin-bottom: 0.3rem !important;
            margin-left: 5px;
            color: #1b3425 !important;
            font-size: 15px !important;
            font-weight: 500 !important;
        }

        input {
            outline: none;
            width: 10rem;
            padding: 3px 5px;
            font-family: Segoe, Tahoma, Geneva, Verdana, sans-serif;
            border-radius: 5px;
            border: 1px solid #bdbdbd9c;
        }

        input:focus {
            border: 2px solid #cb9d483b;
            outline: none;
        }

        select:focus {
            border: 1px solid #cb9d483b !important;
            outline: none !important;
        }

        .loader {
            border: 4px solid #f3f3f3;
            border-radius: 50%;
            border-top: 4px solid #cda051;
            width: 30px;
            height: 30px;
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

    </style>

    <style>
        .row__title {
            position: relative;
            right: 46%;
            font-family: 'Bebas Neue', cursive;
            color: #1b3425;
            font-weight: 700;
            font-size: 24px;
            letter-spacing: 1.4px;
            margin: 0;
            margin-top: 1rem;
            margin-left: 32px;
        }

        .form_part {
            width: 95%;
            box-shadow: 0px 0px 7px 0px rgb(27 52 37 / 20%);
            border-radius: 8px;
            padding: 5px 0px 0px 40px;
            margin-bottom: 1.5rem;
            background: #ffffff;
            background-color: #ebedec;
        }

        .btn-primary {
            border-radius: 18px;
            font-size: 14px;
            background-color: #e3ce88;
            border-color: #e3ce88;
            color: #426851;
        }

        .btn-primary:hover {
            border-radius: 18px;
            font-size: 14px;
            background-color: #cb9d48e6;
            border-color: #cb9d48e6;
        }

        .btn-primary:not(:disabled):not(.disabled):active {
            border-radius: 18px;
            font-size: 14px;
            background-color: #cb9d48e6 !important;
            border-color: #cb9d48e6 !important;
        }

        .btn:not(:disabled):not(.disabled) {
            outline: none;
        }

        .btn-primary:focus {
            box-shadow: 0 0 0 0.2rem rgb(144 114 57 / 50%) !important;
        }

        .phone:focus {
            border: 1px solid #cb9d483b;
            border-radius: 6px;
        }

    </style>

    @if ($message = Session::get('message'))
        <script>
            Swal.fire({
                position: 'center',
                icon: 'success',
                title: 'Order has been added successfully',
                showConfirmButton: false,
                timer: 1500
            });
        </script>
    @elseif ($message = Session::get('error'))
        <script>
            Swal.fire({
                position: 'center',
                icon: 'error',
                title: 'Order already exists!',  /* Something wrong happen try again later */
                showConfirmButton: false,
                timer: 1500
            });
        </script>
    @endif

    @php

    /*         echo DNS1D::getBarcodeHTML('4445645656', 'PHARMA2T');
                                                                                                */

    /*         echo DNS1D::getBarcodeSVG('KSP105057', 'C39',1, 50, 'black', true);
                                                                                                */
    /* try {
                                                                                                    $usmap = 'https://www.kshopinaexpress.com/public/uploads/barcodes/bar-5-1647364648.svg';
                                                                                                $im = new \Imagick();
                                                                                                $svg = file_get_contents($usmap);
                                                                                                $im->readImageBlob($svg);
                                                                                                $im->setImageFormat("png24");

                                                                                                $im->writeImage(public_path('uploads/barcodes/12.png'));
                                                                                                $im->clear();
                                                                                                $im->destroy();} catch (\Throwable $th) {
                                                                                                    echo $th;
                                                                                                }  */

    /* try {
                                                                                                    echo '<img src="data:image/png;base64,' . DNS1D::getBarcodePNG('KSP105057', 'C39',1, 50, array(1, 1, 1)) . '" alt="barcode"   />';
                                                                                                } catch (\Throwable $th) {
                                                                                                    echo $th;
                                                                                                }  */
    @endphp

    <div class="card">
        <h4 class="card-title row__title">
            Creating order</h4>
        <form method="POST" action="create_new_order" id="create_order_form" class="signup-form">
            @csrf

            <button type="submit" id="submit_new_order" style="font-size: 17px;letter-spacing: 2px;font-weight: 600;padding: 8px 25px 5px 25px;   display: inline-grid;padding-inline: 30px;margin-bottom: 1rem;position: relative;left: 88%;
                            bottom: 5%;font-family: 'Bebas Neue', cursive;" class="btn btn-primary">
                Submit
            </button>

            <div class="form_part">
                <h3
                    style="margin-bottom: 1rem;margin-left: 0.2rem;color: #cb9d48;font-size: 22px;letter-spacing: 1.5px;font-weight: 500;
                                                                     text-transform: uppercase;margin-top: 1rem;font-family: 'Bebas Neue', cursive;">
                    Order Information
                </h3>
                <div class="form-row">
                    <div class="form-group">
                        <label for="order_number">Order Number</label>
                        <input type="text" class="form-input input_45" name="order_number" id="order_number" maxlength="45"
                            required />
                    </div>
                    <div class="form-group">
                        <label for="order_value">Order Value</label>
                        <input type="number" class="form-input input_45" name="order_value" id="order_value" maxlength="45"
                            required />
                    </div>
                    <div class="form-group">
                        <label for="order_amount">Amount</label>
                        <input type="number" class="form-input input_45" name="order_amount" id="order_amount"
                            maxlength="45" required />
                    </div>
                    <div class="form-group">
                        <label for="payment_type">Payment Type</label>
                        <select class="form-input input_45" name="payment_type" id='payment_type' maxlength="45"
                            onchange="payment_selected(this)"
                            style="width: 10rem;padding: 5px 5px;font-family: Segoe, Tahoma, Geneva, Verdana, sans-serif;outline: none;border-radius: 5px;border: 1px solid #ebebeb;"
                            required>
                            <option value="" selected hidden>Select Payment</option>
                            <option id='COD' value="0"> Cash on delivery (COD) </option>
                            <option id='CC' value="1"> Credit card (CC) </option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="prod_description ">Production Description</label>
                        <input type="text" class="form-input input_100" name="products_description"
                            id="products_description" maxlength="100" />
                    </div>
                </div>
            </div>
            <div class="form_part">
                <h3 style="margin-bottom: 1rem;margin-left: 0.2rem;color: #cb9d48;font-size: 22px;letter-spacing: 1.5px;font-weight: 500;
                         text-transform: uppercase;margin-top: 1rem;font-family: 'Bebas Neue', cursive;">
                    Customer Information</h3>
                <div class="form-row">
                    <div class="form-group">
                        <label for="customer-name ">Name</label>
                        <input type="text" class="form-input input_50" name="customer_name" id="customer_name"
                            maxlength="50" />
                    </div>
                    <div class="form-group">
                        <label for="customer-email ">E-mail</label>
                        <input type="text" class="form-input input_100" name="customer_email" id="customer_email"
                            maxlength="100" />
                    </div>
                    <div class="form-group">
                        <label for="cust-address-country ">Address-Country</label>
                        <select name="customer_country" id='customer_country' onchange="get_cities(this)"
                            class="input_45"
                            style="width: 10rem; padding: 5px 5px;font-family: Segoe, Tahoma, Geneva, Verdana, sans-serif;outline: none;border-radius: 5px;border: 1px solid #ebebeb;"
                            required>
                            <option value="" selected hidden>Select Country</option>
                            <option id='KSA' value="1"> Saudi Arabia </option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="cust-address-city input_45">Address-City</label>
                        <select name="customer_city" id='customer_city' maxlength="45"
                            style="width: 10rem;padding: 5px 5px;font-family: Segoe, Tahoma, Geneva, Verdana, sans-serif;outline: none;border-radius: 5px;border: 1px solid #ebebeb;"
                            required>
                            <option value="" selected hidden>Select City</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="customer-phone">phone</label>
                        <div style="margin:0px;" class="row phone_input phone ">
                            <input type="text" value="+0" class=" phone input_45" name="customer_country_code"
                                maxlength="45" onclick="phone(this)" id="customer_country_code"
                                style="width: 30%; border-radius: 5px 0px 0px 5px;padding: 3px 5px;border-right: 0px;font-family: Segoe, Tahoma, Geneva, Verdana, sans-serif;"
                                readonly />
                            <input type="number" class=" phone input_45" name="customer_phone" id="customer_phone"
                                maxlength="45"
                                style="width: 70%;border-radius: 0px 5px 5px 0px;padding: 3px 5px;border-left: 0px;font-family: Segoe, Tahoma, Geneva, Verdana, sans-serif;"
                                required />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="customer-request">Request</label>
                        <input type="text" class="form-input input_45" name="customer_request" id="customer_request"
                            maxlength="45" />
                    </div>
                    <div class="form-group">
                        <label for="cust-address-area">Address-Area</label>
                        <input type="text" class="form-input input_100" name="customer_area" id="customer_area"
                            maxlength="100" />
                    </div>
                    <div class="form-group">
                        <label for="cust-address-number ">Address-Number</label>
                        <input type="text" class="form-input input_45" name="customer_address_number"
                            id="customer_address_number" maxlength="45" />
                    </div>
                    <div class="form-group">
                        <label for="cust-address-details ">Address-Details</label>
                        <input type="text" class="form-input input_45" name="customer_address_details" style="width: 15rem;"
                            id="customer_address_details" maxlength="500" />
                    </div>
                </div>
            </div>
            <div class="form_part">
                <h3
                    style="margin-bottom: 1rem;margin-left: 0.2rem;color: #cb9d48;font-size: 22px;letter-spacing: 1.5px;font-weight: 500;
                                                            text-transform: uppercase;margin-top: 1rem;font-family: 'Bebas Neue', cursive;">
                    Shipper Information</h3>
                <div class="form-row">
                    <div class="form-group">
                        <label for="shipper-name">Name</label>
                        <input type="text" class="form-input" name="shipper-name" id="shipper-name"
                            value="{{ $user->name }}" disabled />
                    </div>
                    <div class="form-group">
                        <label for="shipper-email">E-mail</label>
                        <input type="text" class="form-input" name="shipper-email" id="shipper-email"
                            value="{{ $user->email }}" disabled />
                    </div>
                    <div class="form-group">
                        <label for="shipper-phone">phone</label>
                        <input type="text" class="form-input" name="shipper-phone" id="shipper-phone"
                            value="{{ $user->phone_number }}" disabled />
                    </div>
                    <div class="form-group">
                        <label for="shipper-address-country">Address-Country</label>
                        <input type="text" class="form-input" name="shipper-address-country"
                            id="shipper-address-country" value="{{ $user->country }}" disabled />
                    </div>
                    <div class="form-group">
                        <label for="shipper-address-city">Address-City</label>
                        <input type="text" class="form-input" name="shipper-address-city" id="shipper-address-city"
                            value="{{ $user->city }}" disabled />
                    </div>
                    <div class="form-group">
                        <label for="cust-address-area">Address-Area</label>
                        <input type="text" class="form-input" name="shipper-address-area" id="shipper-address-area"
                            value="{{ $user->area }}" disabled />
                    </div>
                    <div class="form-group">
                        <label for="shipper-address-number">Address-Number</label>
                        <input type="text" class="form-input" name="shipper-address-number" id="shipper-address-number"
                            value="{{ $user->address_number }}" disabled />
                    </div>
                </div>
            </div>

        </form>


    </div>


    <script>
        $(document).ready(function() {
            $("#create_order_form").on("submit", function() {
                $('#submit_new_order').html(
                    '<div id="submit_new_order" style="align-items: center;justify-content: center;display: flex"><div class="loader"></div></div>'
                );
            }); //submit
        });

        function get_cities(element) {
            var html = "";
            $.ajax({
                url: "get_country_cities",
                type: "post",
                data: {
                    _token: "{{ csrf_token() }}",
                    country: element.value,
                },
                success: function(response) {
                    html +=
                        '<option value="" selected disabled hidden>Select City</option>';
                    response.forEach(element => {

                        html += '<option value="' + element.city_id + '">' + element.name +
                            '</option>'
                    });


                    $('#customer_country_code').val(response[0].country_code);

                    $('#customer_city').html(html);
                },
                error: function(xhr) {
                    //Do Something to handle error
                }

            });
        }

        function payment_selected(element) {
            if (element.value == 1) {
                $('#order_amount').val(0);
                document.getElementById('order_amount').readOnly = true;
            } else {
                document.getElementById('order_amount').readOnly = false;
            }
        }
    </script>

    <script>
        $(".input_45").on("keyup", function() {
            var maxLength = $(this).attr("maxlength");
            if (maxLength == $(this).val().length) {
                alert("You can't write more than " + maxLength + " chacters")
            }
        })

        $(".input_50").on("keyup", function() {
            var maxLength = $(this).attr("maxlength");
            if (maxLength == $(this).val().length) {
                alert("You can't write more than " + maxLength + " chacters")
            }
        })

        $(".input_100").on("keyup", function() {
            var maxLength = $(this).attr("maxlength");
            if (maxLength == $(this).val().length) {
                alert("You can't write more than " + maxLength + " chacters")
            }
        })

    </script>

    <script>
        function phone() {
            $(".phone_input").addClass("phone");
        }
    </script>
@endsection
