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
            font-size: 14px;
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

        #delete:hover {
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
        .col-md-12 {
            padding-right: 0px !important;
            padding-left: 0px !important;
        }


        .table__th {
            font-family: 'Bebas Neue', cursive;
            letter-spacing: 1.3px;
            text-align: center;
            color: #636464;
            font-weight: 600;
            font-size: 15px;
            text-transform: uppercase;
            cursor: pointer;
            border: 0 !important;
            padding: 15px 5px !important;
        }

        /*
                                                                                                                                                                                        .add-items input[type="text"] {
                                                                                                                                                                                            border-top-right-radius: 0;
                                                                                                                                                                                            border-bottom-right-radius: 0;
                                                                                                                                                                                            width: 100%;
                                                                                                                                                                                            background: transparent;
                                                                                                                                                                                        }
                                                                                                                                                                                 */
        .barcode:focus {
            border: 1px solid rgba(71, 164, 71, 0.5) !important;
            box-shadow: 0 0 0 0.1rem rgb(41 110 69 / 70%) !important;
        }

        .barcode::placeholder {
            color: #1b3425;
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

        .icon {
            color: #1b3425;
            font-size: 8px;

        }

    </style>

    <style>
        .pagination {
            display: inline-block;
            margin-top: 50px;
        }

        .pagination a {
            color: black;
            float: left;
            padding: 8px 16px;
            text-decoration: none;
        }

        .pagination a.active {
            background-color: #e3ce88;
            color: #426851;
            border-radius: 30px;
        }

        .pagination a:hover:not(.active) {
            background-color: rgb(116, 112, 112);
            border-radius: 5px;
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
            height: 70%;
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

    <style>
        .filters_btn:focus {
            box-shadow: 0 0 0 0.1rem rgb(27 52 37) !important;
        }

        .filters_sub {
            padding: 0.5rem;
        }

        a {
            color: #1b3425;
            text-decoration: none;
            background-color: transparent;
        }

        a:hover {
            color: #1b3425;
            text-decoration: none;
            background-color: transparent;
        }

        input[type=checkbox] {
            margin-right: 10px !important;
        }

    </style>

    <style>
        tr.hidden {
            display: none;
        }

        .filter_button {
            border: none;
            background-color: white;
        }

        .filter_button:focus-visible,
        .filter_button:focus {
            border: none;
            outline: none;
        }

    </style>

    <?php
    $country = ['0', 'Saudi Arabia'];
    $payment_method = ['COD', 'CREDIT CARD'];
    ?>

    <div class="container">
        <div class="row row--top-40">
            <div class="col-md-12" style="display: flex;justify-content: space-between;margin-top: 1rem;">
                <h2 class="row__title">Shipment List</h2>
                <div>
                    <button type="button" class="btn btn-primary" onclick="ajaxfunc(this)"
                        style="border-radius: 15px;position: relative;right: 1.5rem;top: -0.5rem;font-family: 'Bebas Neue', cursive;font-size: 17px;letter-spacing: 2px;font-weight: 600;padding: 8px 25px 5px 25px;">
                        Submit
                    </button>
                </div>

            </div>
        </div>
            <form action="shipments_managment" method="get" style="width: 100%;display: flex;justify-content: center;align-items: center;align-content: center;" >

                <div class="row" style="align-items: center;border: solid 1px #1b3425;border-radius: 15px;width: 65%;
                                padding-bottom: 0.9rem;display: flex;justify-content: center;">
                    <span
                        style="display: flex;font-size: 20px; margin-left: 10px;flex-wrap: nowrap;color: #1b3425;justify-content: space-between;">
                        <p
                            style="margin-top: 1rem;margin-bottom: 0rem; font-family: 'Bebas Neue', cursive; letter-spacing: 1px;">
                            Filters by
                            <i class="fas fa-sort-amount-down" style="color: #cb9d48; margin-left: 3px;"></i>
                        </p>
                    </span>


                    <div class="button-group">
                        <select name="status" id='status_'
                            style="border: none;margin: 1rem 1rem 0rem 2rem;background-color: white;font-family: 'Bebas Neue', cursive;letter-spacing: 1px; font-size: 16px;">
                            <option value="" selected hidden>Select status</option>

                            <option id='status0_waiting' @if (isset($_GET['status']) && $_GET['status'] == "waiting") selected @endif value="waiting">
                                Awaiting
                                approval
                            </option>
                            <option id='status1_recieved' @if (isset($_GET['status']) && $_GET['status'] == 'recieved') selected @endif value="recieved">
                                Recieved
                            </option>
                            <option id='status2_ready' @if (isset($_GET['status']) && $_GET['status'] == "ready") selected @endif value="ready">Ready to
                                dispatch
                            </option>
                            <option id='status3_dispatched' @if (isset($_GET['status']) && $_GET['status'] == "dispatched") selected @endif value="dispatched">
                                Dispatched
                            </option>
                            <option id='status4_hub' @if (isset($_GET['status']) && $_GET['status'] == 'hub') selected @endif value="hub">At local
                                HUB
                            </option>
                            <option id='status5_ofd' @if (isset($_GET['status']) && $_GET['status'] == 'ofd') selected @endif value="ofd">OFD
                            </option>
                            <option id='status6_delivered' @if (isset($_GET['status']) && $_GET['status'] == 'delivered') selected @endif value="delivered">
                                Delivered
                            </option>
                            <option id='status7_refused' @if (isset($_GET['status']) && $_GET['status'] == "refused") selected @endif value="refused">Refused
                            </option>

                        </select>


                    </div>
                    <div class="button-group">
                        <select name="country" id='status_'
                            style="border: none;margin: 1rem 1rem 0rem 2rem;background-color: white;font-family: 'Bebas Neue', cursive;letter-spacing: 1px; font-size: 16px;">
                            <option value="" selected hidden>Country</option>

                            <option id='country0' @if (isset($_GET['country']) && $_GET['country'] == 'Saudi Arabia') selected @endif value="Saudi Arabia"> Saudi Arabia
                            </option>

                    </div>
                    <div class="button-group">
                        <input @if (isset($_GET['upload_date'])) value="{{$_GET['upload_date']}}" @endif
                            style="border: none;margin: 1rem 1rem 0rem 2rem;background-color: white; font-family: 'Bebas Neue', cursive;letter-spacing: 1px;font-size: 16px;"
                            type="date" name="upload_date" id="upload_date">

                    </div>
                    <div style="padding-top: 11px;" class="button-group">
                        <button style="background-color: #00ffff00;border-color: #cb9d4800;color: #d3ac64;"
                            class="btn btn-primary" type="submit"> <i class="fas fa-search"></i> </button>

                    </div>

                </div>
            </form>


        <div class="row" style="align-items: center;">
        </div>

        <div class="row row--top-20">
            <div class="col-md-12">
                <div class="table-container">
                    {{-- <span><i class="fas fa-barcode"></i></span>
                    <input type="text" class="form-control barcode"  placeholder="&#xf02a; BarCode" style="width: 40%;
                    position: relative;
                    left: 20rem;
                    border: 1px solid #1b3425;"> --}}
                    <table class="table">


                        <thead class="table__thead">
                            <tr>
                                <th class="table__th ">Select</th>
                                <th class="table__th ">Upload Date </th>
                                <th class="table__th">KSP No.</th>
                                <th class="table__th">Order No.</th>
                                <th class="table__th">Pieces</th>
                                <th class="table__th">Volume Weight</th>
                                <th class="table__th">Shipper Name</th>
                                <th class="table__th">Customer Country</th>
                                <th class="table__th">Status</th>
                                <th class="table__th">Tracking No.</th>
                                <th class="table__th">Details</th>
                                <th class="table__th">Print</th>
                                {{-- <th class="table__th"></th> --}}
                            </tr>
                        </thead>
                        <tbody class="table__tbody">
                            @foreach ($shipments as $shipment)
                                @php
                                    $status = ['Awaiting approval', 'Recieved', 'Ready to dispatch', 'Dispatched', 'At local HUB', 'OFD', 'Delivered', 'Refused'];
                                    $status_colors = ['blue', 'yellow', 'dark_blue', 'orange', 'grey', 'purple', 'green', 'red'];
                                    
                                @endphp <tr class="table-row table-row">
                                    <td class="table-row__td">
                                        <input @if ($shipment->status > 2 || $shipment->status == 1) disabled @endif type="checkbox"
                                            onchange="press(this)" class="_checkbox"
                                            id="shipment_{{ $shipment->shipment_id }}" name="shipment">
                                        <label
                                            @if ($shipment->status > 2 || $shipment->status == 1) style="background-color: #575958;     box-shadow: 0px 0px 8px 0px #575958;" @endif
                                            for="shipment_{{ $shipment->shipment_id }}">
                                            <div class="tick_mark"></div>
                                        </label>

                                    </td>
                                    <td data-column="upload_date" class="table-row__td">
                                        <div class="table-row__info">
                                            <p class="table-row__name">
                                                {{ date('M j, Y', strtotime($shipment->shipment_upload_date)) }}
                                            </p>
                                        </div>
                                    </td>
                                    <td data-column="ksp_number" class="table-row__td">
                                        <div class="table-row__info">
                                            <p class="table-row__name"><a target="blank" style="color: #0062cc;"
                                                    href="track/shipment?kspNumber={{ $shipment->ksp_number }}">{{ $shipment->ksp_number }}</a>
                                            </p>
                                        </div>
                                    </td>
                                    <td data-column="order_number" class="table-row__td">
                                        <div class="table-row__info">
                                            <p class="table-row__name">{{ $shipment->order_number }}</p>
                                        </div>
                                    </td>
                                    <td data-column="pieces" class="table-row__td">
                                        <div class="table-row__info">
                                            <p class="table-row__name">
                                                @if ($shipment->pieces == null)
                                                    N/A
                                                @else
                                                    {{ $shipment->pieces }}
                                                @endif
                                            </p>
                                        </div>
                                    </td>
                                    <td data-column="volume_weight" class="table-row__td">
                                        <div class="table-row__info">
                                            <p class="table-row__name">{{ $shipment->weight }}</p>
                                        </div>
                                    </td>
                                    <td data-column="shipper_name" class="table-row__td">
                                        <div class="table-row__info">
                                            <p class="table-row__name">{{ $shipment->name }}</p>
                                        </div>
                                    </td>
                                    <td data-column="customer_country" class="table-row__td">
                                        <div class="table-row__info">
                                            <p class="table-row__name">{{ $shipment->country_name }}</p>
                                        </div>
                                    </td>
                                    <td data-column="Status" class="table-row__td">
                                        <div class="table-row__info">
                                            <p
                                                class="table-row__p-status status status--{{ $status_colors[$shipment->status] }}">
                                                {{ $status[$shipment->status] }}
                                            </p>
                                        </div>
                                    </td>
                                    <td data-column="tracking_number" class="table-row__td">
                                        <div class="table-row__info">
                                            <p class="table-row__name">{{ $shipment->tracking_number }}</p>
                                        </div>
                                    </td>
                                    <td data-column="details" class="table-row__td">
                                        <div class="table-row__info">
                                            {{-- <input type="text" name="" id="shipment_id" readonly hidden value="{{ $shipment->shipment_id }}"> --}}
                                            <button type="button" class="{{ $shipment->shipment_id }}  btn btn-primary"
                                                id="{{ $shipment->shipment_id }}" onclick="details(this)">
                                                <i class="fas fa-info"></i>
                                            </button>
                                        </div>
                                    </td>
                                    <td data-column="print" class="table-row__td">
                                        <div class="table-row__info">
                                            <form method="POST" action="download_awb" enctype="multipart/form-data">
                                                @csrf
                                                <input name="awb" value="{{ $shipment->tracking_number }}" type="text"
                                                    readonly hidden>
                                                <input name="country" value="{{ $shipment->customer_country }}"
                                                    type="text" readonly hidden>

                                                <button type="submit" class="btn btn-primary"><i style="color: #426851;"
                                                        class="fas fa-print"></i></button>
                                            </form>
                                        </div>
                                    </td>
                                    {{-- <td class="table-row__td">
                                        <div class="table-row__info">
                                            <i style="color: #426851;" class="fas fa-sync-alt"></i>
                                        </div>

                                        

                                    </td> --}}
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>


        @if (isset($number_of_shipments))
            <div class="pagination">
                <a href="#">&laquo;</a>
                <?php
                $shipments_per_page = 15;
                $pages = ceil($number_of_shipments[0]->NumberOfShipments / $shipments_per_page);
                ?>
                @for ($i = 1; $i <= $pages; $i++)
                    @if (isset($_GET['page']))
                        @if ($_GET['page'] == $i)
                            <a class='active' href="?page={{ $i }}">{{ $i }}</a>
                        @else
                            <a href="?page={{ $i }}">{{ $i }}</a>
                        @endif
                    @else
                        @if ($i == 1)
                            <a class='active' href="?page={{ $i }}">{{ $i }}</a>
                        @else
                            <a href="?page={{ $i }}">{{ $i }}</a>
                        @endif
                    @endif
                @endfor


                <a href="#">&raquo;</a>
            </div>
        @endif

    </div>

    @foreach ($shipments as $shipment)
        <div id="pop{{ $shipment->shipment_id }}" class="overlay">
            <div class="popup">
                <h2 style="margin-bottom: 30px; margin-top: 10px;margin-left: 10px;">Shipment ID
                    #{{ $shipment->shipment_id }}</h2>
                <a id='close' class="closee" href="#">&times;</a>
                <div class="container content" style="display: flex;">



                    <div style="width: 100% ; margin-right: 15px;">

                        <div class="left_div row">


                            <span class="detail_title"> Customer Name :</span>
                            <span class="detail">{{ $shipment->customer_name }}</span>

                        </div>
                        <hr class="hr_popup">
                        <div class="left_div row">


                            <span class="detail_title"> Customer Phone :</span>
                            <span class="detail">{{ $shipment->customer_phone }}</span>

                        </div>
                        <hr class="hr_popup">
                        <div class="left_div row">


                            <span class="detail_title"> Customer Email :</span>
                            <span class="detail">{{ $shipment->customer_email }}</span>

                        </div>

                        <hr class="hr_popup">

                        <div class="left_div row">

                            <span class="detail_title"> Customer City :</span>
                            <span class="detail">{{ $shipment->city_name }}</span>
                        </div>
                        <hr class="hr_popup">
                        <div class="left_div row">

                            <span class="detail_title"> Customer Area :</span>
                            <span class="detail">{{ $shipment->customer_area }}</span>
                        </div>
                        <hr class="hr_popup">
                        <div class="left_div row">

                            <span class="detail_title"> Customer Postal Code :</span>
                            <span class="detail">{{ $shipment->customer_postal_code }}</span>
                        </div>
                        <hr class="hr_popup">
                        <div class="left_div row">

                            <span class="detail_title"> Customer Request :</span>
                            <span class="detail">{{ $shipment->customer_request }}</span>
                        </div>
                    </div>

                    <div style="width: 100%">

                        <div class="right_div row">

                            <span class="detail_title">Order Value :</span>
                            <span class="detail">&nbsp;{{ $shipment->order_value }}</span>
                        </div>
                        <hr class="hr_popup">
                        <div class="right_div row">

                            <span class="detail_title">Order Amount :</span>
                            <span class="detail">{{ $shipment->order_amount }}</span>
                        </div>
                        <hr class="hr_popup">

                        <div class="right_div row">

                            <span class="detail_title">Payment Type :</span>
                            <span class="detail">{{ $payment_method[$shipment->payment] }}</span>
                        </div>
                        <hr class="hr_popup">
                        <div class="right_div row">


                            <span class="detail_title">Product Description :</span>
                            <span class="detail">{{ $shipment->products_description }}</span>

                        </div>
                        <hr class="hr_popup">
                        <div class="right_div row">

                            <span class="detail_title"> Weight :</span>
                            <span class="detail">{{ $shipment->weight }}</span>
                        </div>
                        <hr class="hr_popup">
                        <div class="right_div row">


                            <span class="detail_title"> Chargeable Weight :</span>
                            <span class="detail">{{ $shipment->chargeable_weight }}</span>

                        </div>
                    </div>




                </div>

            </div>
        </div>
    @endforeach

    <script>
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
                    url: "submit_dispatch",
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

        function details(elemant) {
            var shipment_id = (elemant.className);
            shipment_id = shipment_id.split(" ");



            $('#pop' + elemant.id).show();
        }
        $('.closee').click(function(e) {
            $(this.parentElement.parentElement).hide();
            e.preventDefault();
        });
        /*  function details() {
             Swal.fire({
                 title: '<strong>HTML <u>Shipment Information </u></strong>',
                 icon: '',
                 html: '',
                 showCloseButton: true,
                 showCancelButton: false,
                 focusConfirm: false,
                 confirmButtonText: '<i class="fa fa-thumbs-up"></i> Great!',
                 confirmButtonAriaLabel: 'Thumbs up, great!',
                 cancelButtonText: '<i class="fa fa-thumbs-down"></i>',
                 cancelButtonAriaLabel: 'Thumbs down'
             })

         } */
    </script>



    <script>
        $(document).on('click', '.dropdown-menu label', function(e) {
            e.stopPropagation();
        });
    </script>


@endsection
