@extends('layouts.dash_board_layout')

@section('content')
    <style>
        @import url('https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i');

        /*----------------------------------------------------------
                                                                                                                                                                                                                                GENERAL
                                                                                                                                                                                                                                ----------------------------------------------------------*/
        * {
            margin: 0;
            padding: 0;
            font-family: 'Roboto', sans-serif;
        }

        html,
        body {
            display: table;
            height: 100%;
            width: 100%;
            background-color: #f8f8f8;
        }

        .row__title {
            font-family: 'Bebas Neue', cursive;
            color: #1b3425;
            font-weight: 700;
            font-size: 24px;
            letter-spacing: 1.4px;
            margin: 0;
        }

        .row--top-40 {
            margin-top: 15px;
        }

        .row--top-20 {
            margin-top: 20px;
        }

        .table__th {
            font-family: 'Bebas Neue', cursive;
            letter-spacing: 2px;
            text-align: center;
            color: #636464;
            font-weight: 600;
            font-size: 18px;
            text-transform: uppercase;
            cursor: pointer;
            border: 0 !important;
            padding: 15px 8px !important;
        }

        .table-row {
            border-bottom: 1px solid #e4e9ea;
            background-color: #fff;
        }

        .table__th:hover {
            color: #1b3425;

        }

        .table--select-all {
            width: 18px;
            height: 18px;
            padding: 0 !important;
            border-radius: 50%;
            border: 2px solid #becad2;
        }

        .table-row__td {
            text-align: center;
            padding: 12px 8px !important;
            vertical-align: middle !important;
            color: #53646f;
            font-size: 13px;
            font-weight: 400;
            position: relative;
            line-height: 18px !important;
            border: 0 !important;
        }

        .table-row__img {
            width: 36px;
            height: 36px;
            display: inline-block;
            border-radius: 50%;
            background-position: center;
            background-size: cover;
            background-repeat: no-repeat;
            vertical-align: middle;
        }

        .table-row__info {
            display: inline-block;
            vertical-align: middle;
        }

        .table-row__name {
            color: #53646f;
            font-size: 16px;
            font-weight: 400;
            line-height: 18px;
            margin-bottom: 0px;
        }

        .table-row__small {
            color: #9eabb4;
            font-weight: 300;
            font-size: 12px;
        }

        .table-row__policy {
            color: #53646f;
            font-size: 13px;
            font-weight: 400;
            line-height: 18px;
            margin-bottom: 0px;
        }

        .table-row__p-status {
            margin-bottom: 0;
            font-size: 13px;
            vertical-align: middle;
            display: inline-block;
            color: #9eabb4;
        }


        .table-row__status {
            margin-bottom: 0;
            font-size: 13px;
            vertical-align: middle;
            display: inline-block;
            color: #9eabb4;
        }


        .table-row__progress {
            margin-bottom: 0;
            font-size: 13px;
            vertical-align: middle;
            display: inline-block;
            color: #9eabb4;
        }

        .status:before {
            content: '';
            margin-bottom: 0;
            width: 9px;
            height: 9px;
            display: inline-block;
            margin-right: 7px;
            border-radius: 50%;
        }

        .status--red:before {
            background-color: #e36767;
        }

        .status--red {
            color: #e36767;
        }

        .status--blue:before {
            background-color: #3fd2ea;
        }

        .status--blue {
            color: #3fd2ea;
        }

        .status--yellow:before {
            background-color: #ecce4e;
        }

        .status--yellow {
            color: #ecce4e;
        }

        .status--green {
            color: #4baa38;
        }

        .status--green:before {
            background-color: #4baa38;
        }

        .status--orange {
            color: #ea8e3f;
        }

        .status--orange:before {
            background-color: #ea8e3f;
        }

        .status--dark_blue {
            color: #1815dc;
        }

        .status--dark_blue:before {
            background-color: #1815dc;
        }

        .status--purple {
            color: #b384ff;
        }

        .status--purple:before {
            background-color: #b384ff;
        }

        .status--grey {
            color: #969696;
        }

        .status--grey:before {
            background-color: #969696;
        }

        .table__select-row {
            appearence: none;
            -moz-appearance: none;
            -o-appearance: none;
            -webkit-appearance: none;
            width: 17px;
            height: 17px;
            margin: 0 0 0 5px !important;
            vertical-align: middle;
            border: 2px solid #beccd7;
            border-radius: 50%;
            cursor: pointer;
        }

        .table__select-row:hover {
            border-color: #c29746;
        }

        .table__select-row:checked {
            background-image: url(data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8c3ZnIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHZlcnNpb249IjEuMSIgdmlld0JveD0iMCAwIDI2IDI2IiBlbmFibGUtYmFja2dyb3VuZD0ibmV3IDAgMCAyNiAyNiIgd2lkdGg9IjE2cHgiIGhlaWdodD0iMTZweCI+CiAgPHBhdGggZD0ibS4zLDE0Yy0wLjItMC4yLTAuMy0wLjUtMC4zLTAuN3MwLjEtMC41IDAuMy0wLjdsMS40LTEuNGMwLjQtMC40IDEtMC40IDEuNCwwbC4xLC4xIDUuNSw1LjljMC4yLDAuMiAwLjUsMC4yIDAuNywwbDEzLjQtMTMuOWgwLjF2LTguODgxNzhlLTE2YzAuNC0wLjQgMS0wLjQgMS40LDBsMS40LDEuNGMwLjQsMC40IDAuNCwxIDAsMS40bDAsMC0xNiwxNi42Yy0wLjIsMC4yLTAuNCwwLjMtMC43LDAuMy0wLjMsMC0wLjUtMC4xLTAuNy0wLjNsLTcuOC04LjQtLjItLjN6IiBmaWxsPSIjMDFiOWQxIi8+Cjwvc3ZnPgo=);
            background-position: center;
            background-size: 7px;
            background-repeat: no-repeat;
            border-color: #c29746;
        }

        .table-row--overdue {
            width: 3px;
            background-color: #e36767;
            display: inline-block;
            position: absolute;
            height: calc(100% - 24px);
            top: 50%;
            left: 0;
            transform: translateY(-50%);
        }

        .table-row__edit {
            width: 46px;
            padding: 8px 17px;
            display: inline-block;
            background-color: #daf3f8;
            border-radius: 18px;
            vertical-align: middle;
            margin-right: 10px;
            cursor: pointer;
        }

        .table-row__bin {
            margin-left: 16px;
            width: 16px;
            display: inline-block;
            vertical-align: middle;
            cursor: pointer;
        }

        .table-row--red {
            background-color: #fff2f2;
        }

        @media screen and (max-width: 991px) {
            .table__thead {
                display: none;
            }

            .table-row {
                display: inline-block;
                border: 0;
                background-color: #fff;
                width: calc(33.3% - 13px);
                margin-right: 10px;
                margin-bottom: 10px;
            }

            .table-row__img {
                width: 42px;
                height: 42px;
                margin-bottom: 10px;
            }

            .table-row__td:before {
                content: attr(data-column);
                color: #9eabb4;
                font-weight: 500;
                font-size: 12px;
                text-transform: uppercase;
                display: block;
            }

            .table-row__info {
                display: block;
                padding-left: 0;
            }

            .table-row__td {
                display: block;
                text-align: center;
                padding: 8px !important;
            }

            .table-row--red {
                background-color: #fff2f2;
            }

            .table__select-row {
                display: none;
            }

            .table-row--overdue {
                width: 100%;
                top: 0;
                left: 0;
                transform: translateY(0%);
                height: 4px;
            }
        }


        @media screen and (max-width: 680px) {
            .table-row {
                width: calc(50% - 13px);
            }
        }

        @media screen and (max-width: 480px) {
            .table-row {
                width: 100%;
            }
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

        .print:hover {
            color: white;
            text-decoration: none;
        }

        .print {
            color: #426851;
        }

        .delete:hover {
            background-color: #ce0808e6;
            border-color: #ce0808e6;
            color: white;
        }

        .loader {
            border: 3px solid #f3f3f3;
            border-radius: 50%;
            border-top: 4px solid #1b3425;
            width: 15px;
            height: 15px;
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
        ._checkbox {
            display: none;
        }

        label {
            position: absolute;
            top: 50%;
            right: 0;
            left: 0;
            width: 25px;
            height: 25px;
            margin: 0 auto;
            background-color: #7da58e;
            transform: translateY(-50%);
            border-radius: 50%;
            box-shadow: 0px 0px 8px 0px #7da58e;
            cursor: pointer;
            transition: 0.2s ease transform, 0.2s ease background-color, 0.2s ease box-shadow;
            overflow: hidden;
            z-index: 0;
        }

        label:before {
            content: "";
            position: absolute;
            top: 50%;
            right: 0;
            left: 0;
            width: 15px;
            height: 15px;
            margin: 0 auto;
            background-color: #fff;
            transform: translateY(-50%);
            border-radius: 50%;
            transition: 0.2s ease width, 0.2s ease height;
        }

        label:hover:before {
            width: 13px;
            height: 13px;
            box-shadow: inset 0 7px 10px #cfeddc;
        }

        label:active {
            transform: translateY(-50%) scale(0.9);
        }

        .tick_mark {
            position: absolute;
            top: -1px;
            right: 0;
            left: 0;
            width: 60px;
            height: 60px;
            margin: 0 auto;
            margin-left: 14px;
            transform: rotateZ(-40deg);
        }

        .tick_mark:before,
        .tick_mark:after {
            content: "";
            position: absolute;
            background-color: #fff;
            border-radius: 2px;
            opacity: 0;
            transition: 0.2s ease transform, 0.2s ease opacity;
        }

        .tick_mark:before {
            left: 10px;
            top: -8px;
            width: 3px;
            height: 8px;
            box-shadow: -2px 0 5px rgb(0 0 0 / 23%);
            transform: translateY(-68px);
        }

        .tick_mark:after {
            left: 11px;
            bottom: 60px;
            width: 23%;
            height: 3px;
            box-shadow: 0 3px 5px rgb(0 0 0 / 23%);
            transform: translateX(78px);
        }

        ._checkbox:checked+label {
            background-color: #db9513;
            box-shadow: 0px 4px 10px #ffd78d
        }

        ._checkbox:checked+label:before {
            width: 0;
            height: 0;
        }

        ._checkbox:checked+label .tick_mark:before,
        ._checkbox:checked+label .tick_mark:after {
            transform: translate(0);
            opacity: 1;
        }

        .barcode:focus {
            border: 1px solid rgba(71, 164, 71, 0.5) !important;
            box-shadow: 0 0 0 0.1rem rgb(41 110 69 / 70%) !important;
        }

        .barcode::placeholder {
            color: #1b3425;
        }

    </style>


    <style>
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
            width: 40%;
            position: relative;
            transition: all 5s ease-in-out;
            height: 75%;
            overflow: auto;
        }

        .popup h2 {
            margin-top: 0;
            color: #ca9b49;
            font-family: Tahoma, Arial, sans-serif;
        }

        .popup .closee {
            position: absolute;
            top: 20px;
            right: 30px;
            transition: all 200ms;
            font-size: 30px;
            font-weight: bold;
            text-decoration: none;
            color: #333;
        }

        .popup .closee:hover {
            color: #ca9b49;
        }

        .hr_popup {
            margin-left: 1.3rem;
            margin-top: 0.5rem;
            margin-bottom: 0.5rem;
            border: 0;
            border-top: 1px solid rgba(0, 0, 0, .1);
            width: 75%;
        }

        .left_div {
            padding: 7px 2px 7px 2px;
            margin-top: 8px;
            display: flex;
            align-items: center;
            justify-content: start;
            margin-left: 10px;
        }

        .right_div {
            padding: 7px 2px 7px 2px;
            margin-top: 8px;
            display: flex;
            align-items: center;
            justify-content: start;
            margin-left: 10px;
        }

        .detail {
            color: #426851;
            font-size: small;
            padding-left: 8px;
        }

        .detail_title {
            color: #426851;
            font-weight: 600;
            font-family: 'Bebas Neue', cursive;
            letter-spacing: 1.5px;
        }

        .row {
            padding-top: 5px;
        }

    </style>

    <div class="container">

        <div class="row row--top-40">
            <div class="col-md-12" style="display: flex;justify-content: space-between;margin-top: 1rem;">
                <h2 class="row__title" style="padding-left: 1.2rem;">Barcodes</h2>
                <div>
                    <button onclick="ajaxfunc(this)" type="button" class="btn btn-primary"
                        style="border-radius: 15px;position: relative;right: 1.5rem;top: -0.5rem;font-family: 'Bebas Neue', cursive;font-size: 17px;letter-spacing: 2px;font-weight: 600;padding: 8px 25px 5px 25px;">
                        Submit
                    </button>
                </div>

            </div>
        </div>
        <div class="row row--top-20">
            <div class="col-md-12">
                <div class="table-container">
                    <form id="barcode_form">
                        @csrf
                        <input type="text" class="form-control barcode" name="barcode" id="barcode"
                            placeholder="barcode number "
                            style="width: 40%; position: relative;left: 25%;border: 1px solid #1b3425;margin-bottom: 20px;">
                    </form>

                    <table class="table">
                        <thead class="table__thead">
                            <tr>
                                <th class="table__th ">Select all </th>
                                <th class="table__th">Order No.</th>
                                <th class="table__th">KSP No.</th>
                                <th class="table__th">Order Details</th>
                                <th class="table__th"> Delete </th>

                            </tr>
                        </thead>
                        <tbody id="table" class="table__tbody">


                        </tbody>
                    </table>
                </div>
            </div>
        </div>


    </div>

    <div id="pop" class="overlay">
        <div class="popup">
            <h2 style="margin-bottom: 30px; margin-top: 10px;margin-left: 10px;">Shipment ID <span id="shipment_id"> </span>
            </h2>
            <a id='close' class="closee" href="#">&times;</a>
            <div class="container content" style="display: flex;">

                <div style="width: 100% ; margin-right: 15px;">

                    <div class="left_div row">
                        <span class="detail_title"> Customer Name :</span>
                        <span class="detail" id="customer_name"></span>

                    </div>
                    <hr class="hr_popup">
                    <div class="left_div row">
                        <span class="detail_title"> Customer Phone :</span>
                        <span class="detail" id="customer_phone_number"></span>

                    </div>
                    <hr class="hr_popup">
                    <div class="left_div row">


                        <span class="detail_title"> Customer Email :</span>
                        <span class="detail" id="customer_email"></span>

                    </div>
                    <hr class="hr_popup">

                    <div class="left_div row">

                        <span class="detail_title"> Customer Country :</span>
                        <span class="detail" id="customer_country"></span>
                    </div>

                    <hr class="hr_popup">

                    <div class="left_div row">

                        <span class="detail_title"> Customer City :</span>
                        <span class="detail" id="customer_city"></span>
                    </div>
                    <hr class="hr_popup">
                    <div class="left_div row">

                        <span class="detail_title"> Customer Area :</span>
                        <span class="detail" id="customer_area"></span>
                    </div>
                    <hr class="hr_popup">
                    <div class="left_div row">

                        <span class="detail_title"> Customer Postal Code :</span>
                        <span class="detail" id="customer_postal_code"></span>
                    </div>
                    <hr class="hr_popup">
                    <div class="left_div row">

                        <span class="detail_title"> Customer Request :</span>
                        <span class="detail" id="customer_request"></span>
                    </div>
                </div>

                <div style="width: 100%">

                    <div class="right_div row">

                        <span class="detail_title">Order Value :</span>
                        <span class="detail" id="order_value">&nbsp;</span>
                    </div>
                    <hr class="hr_popup">
                    <div class="right_div row">

                        <span class="detail_title">Order Amount :</span>
                        <span class="detail" id="order_amount"></span>
                    </div>
                    <hr class="hr_popup">

                    <div class="right_div row">

                        <span class="detail_title">Payment Type :</span>
                        <span class="detail" id="payment_type"></span>
                    </div>
                    <hr class="hr_popup">
                    <div class="right_div row">


                        <span class="detail_title">Product Description :</span>
                        <span class="detail" id="product_description"></span>

                    </div>
                    <hr class="hr_popup">
                    <div class="right_div row">

                        <span class="detail_title"> Weight :</span>
                        <span class="detail" id="weight"></span>
                    </div>
                    <hr class="hr_popup">
                    <div class="right_div row">


                        <span class="detail_title"> Chargeable Weight :</span>
                        <span class="detail" id="chargeable_weight"></span>

                    </div>
                </div>




            </div>

        </div>
    </div>



    <script>
        document.getElementById("barcode").focus();
        var barcodes = new Object();
        var ajaxx;
        $("#barcode_form").submit(function(e) {
            e.preventDefault();
            var html = "";

            if (barcodes[$('#barcode').val()] == null ) {
                try {
                    ajaxx.abort();
                } catch (error) {}

                setTimeout(function() {

                    ajaxx = $.ajax({
                        url: "scan_barcode",
                        type: 'POST',
                        data: {
                            _token: "{{ csrf_token() }}",
                            barcode: $('#barcode').val()
                        },
                        complete: function() {

                        },
                        success: function(response) {


                            $('#barcode').val('');
                            if (response[0] != null && response[0] != []) {
                                if (response[0]['status'] == 0) {


                                    barcodes[response[0]['ksp_number']] = response[0][
                                        'shipment_id'
                                    ];
                                    //select
                                    html += '<tr class="table-row table-row--chris">';
                                    html +=
                                        '    <td data-column="upload_date" class="table-row__td">';
                                    html += '    <div class="table-row__info">';
                                    html +=
                                        '<input type="checkbox" onchange="press(this)" name="checkbox" id="checkbox_' +
                                        response[0]['shipment_id'] + '" class="_checkbox">';
                                    html += ' <label for="checkbox_' + response[0][
                                            'shipment_id'
                                        ] +
                                        '"><div class="tick_mark"></div></label></div></td>';

                                    //order_number

                                    html +=
                                        '<td data-column="order_number" class="table-row__td"><div class="table-row__info"><p class="table-row__name">' +
                                        response[0]['order_number'] + '</p></div></td>';

                                    //KSP number

                                    html +=
                                        '<td data-column="ksp_number" class="table-row__td"><div class="table-row__info"><p class="table-row__name">' +
                                        response[0]['ksp_number'] + '</p></div></td>';

                                    // Order_details
                                    html +=
                                        '<td data-column="order_details" class="table-row__td"><div class="table-row__info"><button type="button"  onclick="details(this)" id="details_' +
                                        response[0]['ksp_number'] + '" class="' + response[0][
                                            'ksp_number'
                                        ] +
                                        ' btn btn-primary"> Details</a> </button></div></td>';

                                    //delete

                                    html +=
                                        '<td data-column="delete" class="table-row__td"><div class="table-row__info"><button type="button" onclick="delete_shipment(this)" id="delete_' +
                                        response[0]['ksp_number'] +
                                        '"class="delete btn btn-primary"><i class="fas fa-trash-alt" style="font-weight: 500;"></i></button></div></td></tr>';


                                    document.getElementById('table').innerHTML += html;

                                } else {
                                    Swal.fire({
                                        position: 'center',
                                        icon: 'error',
                                        title: 'Shipment  already in Warehouse!',
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


                }, 500);

            } else if(barcodes[$('#barcode').val()] == 'deleted')
            {
                $('#barcode').val('');
                Swal.fire({
                    position: 'center',
                    icon: 'warning',
                    title: 'Shipment already deleted before!',
                    showConfirmButton: false,
                    timer: 1500
                });
            } else {
                $('#barcode').val('');
                Swal.fire({
                    position: 'center',
                    icon: 'warning',
                    title: 'Shipment already added!',
                    showConfirmButton: false,
                    timer: 1500
                });
            }
            document.getElementById("barcode").focus();

        });



        function details(elemant) {
            var html1 = "";
            var country = ['0', 'Saudi Arabia'];
            var payment_method = ['COD', 'CREDIT CARD'];

            var ksp_number = elemant.id.substring(elemant.id.indexOf("_") + 1);

            try {
                ajaxx.abort();
            } catch (error) {

            }

            setTimeout(function() {

                ajaxx = $.ajax({
                    url: "scanBarcodes_details",
                    type: 'GET',
                    data: {
                        _token: "{{ csrf_token() }}",
                        ksp_number: ksp_number,

                    },
                    success: function(response) {



                        console.log(response[1][0]['name']);
                        $("#shipment_id").html('#' + response[0][0]['shipment_id']);
                        $("#customer_name").html(response[0][0]['customer_name']);
                        $("#customer_phone_number").html(response[0][0]['customer_phone']);
                        $("#customer_email").html(response[0][0]['customer_email']);
                        $("#customer_country").html(country[response[0][0]['customer_country']]);
                        $("#customer_city").html(response[1][response[0][0]['customer_city'] - 1][
                            'name'
                        ]);
                        $("#customer_area").html(response[0][0]['customer_area']);
                        $("#customer_postal_code").html(response[0][0]['customer_postal_code']);
                        $("#customer_request").html(response[0][0]['customer_request']);



                        $("#order_value").html(response[0][0]['order_value']);
                        $("#order_amount").html(response[0][0]['order_amount']);
                        $("#payment_type").html(payment_method[response[0][0]['payment']]);
                        $("#product_description").html(response[0][0]['products_description']);
                        $("#weight").html(response[0][0]['weight']);
                        $("#chargeable_weight").html(response[0][0]['chargeable_weight']);

                        $('#pop').show();

                    }
                });


            }, 500);


            $('#pop' + elemant.id).show();
        }


        $('.closee').click(function(e) {
            $(this.parentElement.parentElement).hide();
            e.preventDefault();
        });


        var shipment_id;

        function delete_shipment(element) {

            shipment_id = element.id.substring(element.id.indexOf("_") + 1);

            $(element.parentElement).html(
                '<div id="loader' + shipment_id +
                '" style="align-items: center;justify-content: center;display: flex"><div class="loader"></div></div>'
            );

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#17a2b8',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {

                    var ele = document.getElementById("loader" + shipment_id).parentElement
                        .parentElement.parentElement;
                    $(ele).hide();

                    barcodes[shipment_id]='deleted';
                    document.getElementById("barcode").focus();


                } else {
                    var ele = document.getElementById("loader" + shipment_id).parentElement;
                    $(ele).html(
                        '<button type="button" onclick="delete_shipment(this)"id="delete_' + shipment_id +
                        '" class="delete btn btn-primary"><i class="fas fa-trash-alt" style="font-weight: 500;"></i></button>'
                    )
                    document.getElementById("barcode").focus();

                }
            });


        }



        var shipment_id;
        var shipments = new Object();

        function press(elemant) {

            shipment_id = elemant.id.substring(elemant.id.indexOf("_") + 1);

            if (elemant.checked) {
                shipments[shipment_id] = 3;
            } else {
                delete shipments[shipment_id];
            }
            console.log(shipments);
        }

        function ajaxfunc(element) {

            if (Object.keys(shipments).length == 0) {
                Swal.fire({
                    position: 'center',
                    icon: 'warning',
                    title: 'Nothing to submit!',
                    showConfirmButton: false,
                    timer: 1500
                });
            } else {

                $(element.parentElement).html(
                    '<div style="align-items: center;justify-content: center;display: flex"><div class="loader"></div></div>'
                );
                $.ajax({
                    url: "submit_barcodes",
                    type: 'POST',
                    data: {
                        _token: "{{ csrf_token() }}",
                        shipments: shipments,

                    },
                    success: function() {
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: 'Your work has been saved',
                            showConfirmButton: false,
                            timer: 1500
                        });
                        window.location.reload();
                    }

                });
            }
        }
    </script>
@endsection
