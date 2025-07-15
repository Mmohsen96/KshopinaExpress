@extends('layouts.dash_board_layout')

@section('content')
    <style>
        table {
            box-shadow: 0px 0px 7px 0px rgb(27 52 37 / 20%);
            padding: 5px 0px 0px 40px;
            margin-bottom: 1.5rem;
            background-color: #f7f6f3;
        }

        :disabled {
            color: #1b3425;
            background-color: white;
        }

        .card {
            position: relative;
            display: flex;
            margin-top: 0.5rem;
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
            width: 20px;
            height: 20px;
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
            right: 47%;
            font-family: 'Bebas Neue', cursive;
            color: #1b3425;
            font-weight: 700;
            font-size: 24px;
            letter-spacing: 1.4px;
            margin: 0;
            margin-top: 1rem;
            margin-bottom: 3rem;
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
            border-radius: 10px;
            font-size: 15px;
            letter-spacing: 1px;
            background-color: #e3ce88;
            border-color: #e3ce88;
            color: #426851;
        }

        .btn-primary:hover {
            border-radius: 10px;
            font-size: 15px;
            letter-spacing: 1px;
            background-color: #cb9d48e6;
            border-color: #cb9d48e6;
        }

        .btn-primary:not(:disabled):not(.disabled):active {
            border-radius: 10px;
            font-size: 15px;
            background-color: #cb9d48e6 !important;
            border-color: #cb9d48e6 !important;
        }

        .btn:not(:disabled):not(.disabled) {
            outline: none;
        }

        .btn-primary:focus {
            box-shadow: 0 0 0 0.2rem rgb(144 114 57 / 50%) !important;
        }

        .header {
            background-color: #1b3425;
            color: #d2ac6a;
            font-family: 'Bebas Neue', cursive;
            letter-spacing: 2px;
            font-size: 16px;
            font-weight: 500;
        }

        .table th {
            border-top: 0px solid #dee2e6 !important;
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
                title: 'Something wrong happen try again later!',
                showConfirmButton: false,
                timer: 1500
            });
        </script>
    @endif

    @if (isset($error))
        <script>
            Swal.fire({
                position: 'center',
                icon: 'error',
                title: 'No shipment founded!',
                showConfirmButton: false,
                timer: 1500
            });
        </script>
    @endif
<div class="container">
    <div class="card">
        <h4 class="card-title row__title">
            Creating AWB</h4>
        <div class="form_part">
            <h3 style="margin-bottom: 1rem;margin-left: 0.2rem;color: #b89244;font-size: 22px;letter-spacing: 1.5px;font-weight: 500;
                     text-transform: uppercase;margin-top: 1rem;font-family: 'Bebas Neue', cursive;">
                Order Information</h3>
            <div class="form-row">
                <div class="form-group">
                    <label for="ksp_number">KSP NO.</label>
                    @if (isset($shipments->ksp_number))
                        <input type="text" class="form-input" name="ksp_number" id="ksp_number"
                            value=" {{ $shipments->ksp_number }} " disabled required />
                    @else
                        <form id="awb_form">
                            @csrf
                            <input type="text" class="form-input" name="ksp_number" id="ksp_number" value="" required />
                        </form>
                    @endif
                </div>
                <div class="form-group">
                    <label for="order_number">Order Number</label>
                    <input type="text" class="form-input" name="order_number" id="order_number"
                        value="@if (isset($shipments->order_number)) {{ $shipments->order_number }} @endif " disabled
                        required />
                </div>
                <div class="form-group">
                    <label for="order_value">Order Value</label>
                    <input type="text" class="form-input" name="order_value" id="order_value"
                        value="@if (isset($shipments->order_value)) {{ $shipments->order_value }} @endif" disabled
                        required />
                </div>
                <div class="form-group">
                    <label for="order_amount">Amount</label>
                    <input type="text" class="form-input" name="order_amount" id="order_amount"
                        value="@if (isset($shipments->order_amount)) {{ $shipments->order_amount }} @endif" disabled
                        required />
                </div>
                <div class="form-group">
                    <label for="payment_type">Payment Type</label>
                    <select class="form-input" name="payment_type" id='payment_type' onchange="payment_selected(this)"
                        style="border: 1px solid #bdbdbd9c;width: 10rem;padding: 5px 5px;font-family: Segoe, Tahoma, Geneva, Verdana, sans-serif;outline: none;border-radius: 5px;border: 1px solid #ebebeb;"
                        required disabled>
                        <option value="" selected disabled>
                            @if (isset($shipments->payment))
                                {{ $payment[$shipments->payment] }}
                            @endif
                        </option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="prod_description">Production Description</label>
                    <input type="text" class="form-input" name="products_description" id="products_description"
                        value=" @if (isset($shipments->products_description)) {{ $shipments->products_description }} @endif "
                        disabled />
                </div>
            </div>

        </div>

        <div class="form_part">
            <h3 style="margin-bottom: 1rem;margin-left: 0.2rem;color: #b89244;font-size: 22px;letter-spacing: 1.5px;font-weight: 500;
                   text-transform: uppercase;margin-top: 1rem;font-family: 'Bebas Neue', cursive;">
                Customer Information</h3>
            <div class="form-row">
                <div class="form-group">
                    <label for="customer-name">Name</label>
                    <input type="text" class="form-input" name="customer_name" id="customer_name"
                        value="@if (isset($shipments->customer_name)) {{ $shipments->customer_name }} @endif " disabled />
                </div>
                <div class="form-group">
                    <label for="customer-email">E-mail</label>
                    <input type="text" class="form-input" name="customer_email" id="customer_email"
                        value="@if (isset($shipments->customer_email)) {{ $shipments->customer_email }} @endif " disabled />
                </div>
                <div class="form-group">
                    <label for="customer-phone">phone</label>
                    <div style="margin:0px;" class="row">
                        <input type="text" class="form-input" name="customer_phone" id="customer_phone"
                            value="@if (isset($shipments->customer_phone)) {{ $shipments->customer_phone }} @endif " disabled
                            required />
                    </div>

                </div>
                <div class="form-group">
                    <label for="cust-address-country">Address-Country</label>
                    <select name="customer_country" id='customer_country' onchange="get_cities(this)"
                        style="border: 1px solid #bdbdbd9c;width: 10rem;padding: 5px 5px;font-family: Segoe, Tahoma, Geneva, Verdana, sans-serif;outline: none;border-radius: 5px;border: 1px solid #ebebeb;"
                        required disabled>
                        <option value="" selected disabled>
                            @if (isset($shipments->country_name))
                                {{ $shipments->country_name }}
                            @endif
                        </option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="cust-address-city">Address-City</label>
                    <select name="customer_city" id='customer_city'
                        style="border: 1px solid #bdbdbd9c;width: 10rem;padding: 5px 5px;font-family: Segoe, Tahoma, Geneva, Verdana, sans-serif;outline: none;border-radius: 5px;border: 1px solid #ebebeb;"
                        required disabled>
                        <option value="" selected disabled>
                            @if (isset($shipments->city_name))
                                {{ $shipments->city_name }}
                            @endif
                        </option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="customer-request">Request</label>
                    <input type="text" class="form-input" name="customer_request" id="customer_request"
                        value=" @if (isset($shipments->customer_request)) {{ $shipments->customer_request }} @endif "
                        disabled />
                </div>
                <div class="form-group">
                    <label for="cust-address-area">Address-Area</label>
                    <input type="text" class="form-input" name="customer_area" id="customer_area"
                        value=" @if (isset($shipments->customer_area)) {{ $shipments->customer_area }} @endif " disabled />
                </div>
                <div class="form-group">
                    <label for="cust-address-number">Address-Number</label>
                    <input type="text" class="form-input" name="customer_address_number" id="customer_address_number"
                        value=" @if (isset($shipments->customer_postal_code)) {{ $shipments->customer_postal_code }} @endif "
                        disabled />
                </div>
                <div class="form-group">
                    <label for="cust-address-details ">Address-Details</label>
                    <input type="text" class="form-input input_45" name="customer_address_details" style="width: 15rem;"
                        id="customer_address_details" maxlength="500"  value=" @if (isset($shipments->customer_address_details)) {{ $shipments->customer_address_details }} @endif " />
                </div>
            </div>

        </div>

        <div class="form_part">
            <h3 style="margin-bottom: 1rem;margin-left: 0.2rem;color: #b89244;font-size: 22px;letter-spacing: 1.5px;font-weight: 500;
                                                text-transform: uppercase;margin-top: 1rem;font-family: 'Bebas Neue', cursive;">
                Shipper Information</h3>
            <div class="form-row">

                <div class="form-group">
                    <label for="shipper-name">Name</label>
                    <input type="text" class="form-input" name="shipper-name" id="shipper-name"
                        value="@if (isset($shipments->name)) {{ $shipments->name }} @endif " disabled />
                </div>
                <div class="form-group">
                    <label for="shipper-email">E-mail</label>
                    <input type="text" class="form-input" name="shipper-email" id="shipper-email"
                        value=" @if (isset($shipments->email)) {{ $shipments->email }} @endif " disabled />
                </div>
                <div class="form-group">
                    <label for="shipper-phone">phone</label>
                    <input type="text" class="form-input" name="shipper-phone" id="shipper-phone"
                        value=" @if (isset($shipments->phone_number)) {{ $shipments->phone_number }} @endif " disabled />
                </div>
                <div class="form-group">
                    <label for="shipper-address-country">Address-Country</label>
                    <input type="text" class="form-input" name="shipper-address-country" id="shipper-address-country"
                        value="@if (isset($shipments->country)) {{ $shipments->country }} @endif " disabled />
                </div>
                <div class="form-group">
                    <label for="shipper-address-city">Address-City</label>
                    <input type="text" class="form-input" name="shipper-address-city" id="shipper-address-city"
                        value="@if (isset($shipments->city)) {{ $shipments->city }} @endif " disabled />
                </div>
                <div class="form-group">
                    <label for="cust-address-area">Address-Area</label>
                    <input type="text" class="form-input" name="shipper-address-area" id="shipper-address-area"
                        value="@if (isset($shipments->area)) {{ $shipments->area }} @endif " disabled />
                </div>
                <div class="form-group">
                    <label for="shipper-address-number">Address-Number</label>
                    <input type="text" class="form-input" name="shipper-address-number" id="shipper-address-number"
                        value="@if (isset($shipments->address_number)) {{ $shipments->address_number }} @endif " disabled />
                </div>
            </div>
        </div>
        <div id='table_container' style="width: 95%;">
            <table class="table table-striped" >
                <tbody id="table">
                    <tr style="background: rgb(27 52 37);">
                        <th class="th header">Seller Upload Time</th>
                        <th class="th header">Weight</th>
                        <th class="th header">Pieces</th>
                        <th class="th header">Volume Weight</th>
                        <th class="th header">Chargeable Weight</th>
                        <th class="th header">Create AWB</th>
                        <th class="th header"> Track no.</th>
                    </tr>
                    <tr style="background: #ebedec;">
                        <td
                            style="display: flex;align-items: center;justify-content: center;border-top: 0px solid #dee2e6;">
                            <span style="color: #1b3425;">
                                @if (isset($shipments->shipment_upload_date))
                                    {{ date('M j, Y', strtotime($shipments->shipment_upload_date)) }}
                                @endif
                            </span>
                        </td>
                        <td>
                            <input type="text" class="form-input" name="weight" id="weight"
                                style="width: 100px; padding: 5px 5px; font-family: Segoe, Tahoma, Geneva, Verdana, sans-serif;"
                                required>
                        </td>
                        <td>
                            <input type="number" class="form-input" name="pieces" id="pieces"
                                style="    width: 100px; padding: 5px 5px; font-family: Segoe, Tahoma, Geneva, Verdana, sans-serif;"
                                required>
                        </td>
                        <td>
                            <input type="number" class="form-input" name="volume_weight" id="volume_weight"
                                style="    width: 100px; padding: 5px 5px; font-family: Segoe, Tahoma, Geneva, Verdana, sans-serif;"
                                required>
                        </td>
                        <td>
                            <input type="number" class="form-input" name="chargeable_weight" id="chargeable_weight"
                                style="    width: 100px; padding: 5px 5px; font-family: Segoe, Tahoma, Geneva, Verdana, sans-serif;"
                                required>
                        </td>
                        <td style="display: flex;justify-content: center;">
                            <input type="text" name="shipment_id" id="shipment_id" readonly hidden>
                            <div style="margin-left: -12px;">
                                <button type="submit" id="submit_new_order"
                                    @if ($shipments != []) onclick="create_awb({{ $shipments->shipment_id }},{{ $shipments->customer_country }})" @endif
                                    style="font-size: 15px;font-family: 'Bebas Neue', cursive;padding-right: 12px;"
                                    class="btn btn-primary">
                                    Create AWB
                                </button>
                            </div>
                        </td>
                        <td>
                            <div style="display: flex;justify-content: center;" id="tracking_no">
                                <span style="color: #1b3425;padding-top: 5px;">N/A
                                </span>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

    </div>
</div>
    <script>
        $(document).ready(function() {
            $("#create_order_form").on("submit", function() {
                $('#submit_new_order').html(
                    '<div id="submit_new_order" style="align-items: center;justify-content: center;display: flex"><div class="loader"></div></div>'
                );
            }); //submit

            if ($('#ksp_number').val() != "") {
                document.getElementById('table_container').scrollIntoView();
                document.getElementById("weight").focus();
            } else {
                document.getElementById("ksp_number").focus();
            }

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

        function create_awb(shipment_id, country) {

            var additional_data = new Object();

            additional_data['weight'] = $('#weight').val();
            additional_data['pieces'] = $('#pieces').val();
            additional_data['volume_weight'] = $('#volume_weight').val();
            additional_data['chargeable_weight'] = $('#chargeable_weight').val();

            if (additional_data['weight'].replace(/\s/g, "") != "" && additional_data['pieces'].replace(/\s/g, "") != "" &&
                additional_data['volume_weight'].replace(/\s/g, "") != "" && additional_data['chargeable_weight'].replace(
                    /\s/g, "") != "") {


                $("#submit_new_order").html(
                    '<div id="loader" style="align-items: center;justify-content: center;display: flex"><div class="loader"></div></div>'
                );
                try {
                    ajaxx.abort();
                } catch (error) {

                }
                setTimeout(function() {

                    ajaxx = $.ajax({
                        url: "generate_awb",
                        type: "post",
                        data: {
                            _token: "{{ csrf_token() }}",
                            shipment_id: shipment_id,
                            country: country,
                            additional_data: additional_data
                        },
                        complete: function() {
                            $("#submit_new_order").html(
                                'Create AWB'
                            );
                        },
                        success: function(response) {

                            if (response['status'] == 'fail') {
                                Swal.fire({
                                    position: 'center',
                                    icon: 'error',
                                    title: response['message'],
                                    showConfirmButton: false,
                                    timer: 2500
                                });
                            } else {
                                Swal.fire({
                                    position: 'center',
                                    icon: 'success',
                                    title: response['message'],
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                                $('#tracking_no').html('<span style="color: #1b3425;padding-top: 5px;">'+response['tracking_number']+'</span>' );

                            }


                        },
                        error: function(xhr) {
                            //Do Something to handle error
                        }

                    });
                }, 500);

            } else {
                Swal.fire({
                    position: 'center',
                    icon: 'error',
                    title: 'You must fill all fields!',
                    showConfirmButton: false,
                    timer: 2500
                });
            }

        }

        $("#awb_form").submit(function(e) {
            e.preventDefault();

            ajaxx = $.ajax({
                url: "scan_barcode",
                type: 'POST',
                data: {
                    _token: "{{ csrf_token() }}",
                    barcode: $('#ksp_number').val()
                },
                complete: function() {

                },
                success: function(response) {

                    if (response[0] != null && response[0] != []) {
                        if (response[0]['status'] == 1) {

                            window.location.href = "client_shipment_awb?shipment_id=" + response[0][
                                'shipment_id'
                            ];

                        } else {
                            Swal.fire({
                                position: 'center',
                                icon: 'error',
                                title: 'Shipment already has AWB!',
                                showConfirmButton: false,
                                timer: 1500
                            });
                        }



                    } else {
                        $('#barcode').val('');
                        Swal.fire({
                            position: 'center',
                            icon: 'error',
                            title: 'Barcode not found!',
                            showConfirmButton: false,
                            timer: 1500
                        });
                    }

                }
            });


        });
    </script>
@endsection
