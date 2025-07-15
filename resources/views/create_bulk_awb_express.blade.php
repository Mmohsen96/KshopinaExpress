@extends('layouts.staff_layout')

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
            font-size: 15px;
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
            height: 55%;
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
        .b {
            font-size: smaller;
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
            background-color: #d1a85d !important;
            border-radius: 5px;
            position: relative;
            top: -0.5rem;
            font-family: 'Bebas Neue', cursive;
            font-size: 17px;
            letter-spacing: 2px;
            font-weight: 600;
            padding: 8px 25px 5px 25px;
        }

        .swal2-title {

            color: #296e45 !important;
            margin-bottom: 5% !important;
        }

        .swal2-container.swal2-center>.swal2-popup {
            background-color: #f7f6f3;
            width: 40em !important;
            padding: 7px 0px 0px;
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
                /*  transform: none; */
                width: 100%;
                height: auto;
            }
        }

        .vgr-cards .card-body {
            flex: 1;
        }

        @media (max-width: 576px) {
            .vgr-cards .card-body {
                padding: 0;
            }
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
    </style>
    {{-- @php
    
    $obj = json_encode(Session::get('val'));

echo "<script>console.log(JSON.parse('" . $obj . "'))</script>";
    @endphp
    @if ($message = Session::get('error'))
        <script>
            Swal.fire({
                position: 'center',
                icon: 'error',
                title: 'Invalid templete!',
                showConfirmButton: false,
                timer: 1500
            });
        </script>
    @elseif ($message = Session::get('error'))
        <script>
            Swal.fire({
                position: 'center',
                icon: 'error',
                title: 'You are not permitted to delete this shipment!',
                showConfirmButton: false,
                timer: 1500
            });
        </script>
    @endif --}}
    @if ($message = Session::get('error'))
    <script>
        Swal.fire({
            position: 'center',
            icon: 'error',
            title: 'Invalid templete!',
            showConfirmButton: false,
            timer: 1500
        });
    </script>

@endif
    <div class="container">

        <div class="row row--top-40">
            <div class="col-md-12" style="display: flex;justify-content: space-between;margin-top: 1rem;">
                <h2 class="row__title" style="padding-left: 1.2rem;">Create AWB</h2>
                <div id="upload_button">

                    <button onclick="upload_pop(this)" type="button" class="btn btn-primary"
                        style="border-radius: 15px;position: relative;right: 1.5rem;top: -0.5rem;font-family: 'Bebas Neue', cursive;font-size: 17px;letter-spacing: 2px;font-weight: 600;padding: 8px 25px 5px 25px;">
                        Upload by bulk
                    </button>
                </div>

            </div>
        </div>
        <div style="margin-top: 50px;" class="row row--top-20">
            <div class="col-md-12">
                <div class="table-container">

                    <table class="table">
                        <thead class="table__thead">
                            <tr>
                                <th class="table__th ">Uploaded at </th>
                                <th class="table__th">File name</th>
                                <th class="table__th">NO. of shipments</th>
                                <th class="table__th">Message</th>
                                <th class="table__th">Result</th>

                            </tr>
                        </thead>
                        <tbody id="table" class="table__tbody">

                            @foreach ($files as $file)
                                @php
                                    $status = ['Awaiting approval', 'Recieved', 'Ready to dispatch', 'Dispatched', 'At local HUB', 'OFD', 'Delivered', 'Refused'];
                                    $status_colors = ['blue', 'yellow', 'dark_blue', 'orange', 'grey', 'purple', 'green', 'red'];
                                    
                                @endphp <tr class="table-row table-row--chris">
                                    <td data-column="upload_date" class="table-row__td">
                                        <div class="table-row__info">
                                            <p class="table-row__name">
                                                {{ date('M j, Y', strtotime($file->file_uploaded_at)) }}</p>
                                        </div>
                                    </td>
                                    <td data-column="source_file_name" class="table-row__td">
                                        <div class="table-row__info">
                                            <p class="table-row__name">{{ $file->source_file_name }}{{-- <a
                                                    href="{{ asset('uploads/vendors/source_files/' . $file->source_file_new_name) }}"
                                                    download="{{ $file->source_file_name }}">{{ $file->source_file_name }}</a> --}}
                                            </p>
                                        </div>
                                    </td>
                                    <td data-column="number_of_shipments" class="table-row__td">
                                        <div class="table-row__info">
                                            <p class="table-row__name">{{ $file->number_of_shipments }}</p>
                                        </div>
                                    </td>


                                    <td data-column="message" class="table-row__td">
                                        <div class="table-row__info">
                                            <p class="table-row__name">{{ $file->message }}</p>
                                        </div>
                                    </td>
                                    <td data-column="result_file_name" class="table-row__td">
                                        <div class="table-row__info">
                                            <p class="table-row__name"><a
                                                    href="{{ asset('uploads/awb/result_files_express/' . $file->result_file_name) }}"
                                                    download>{{ $file->result_file_name }}</a></p>
                                        </div>
                                    </td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="pagination">
            <a href="#">&laquo;</a>
            <?php
            $files_per_page = 15;
            $pages = ceil($number_of_files[0]->NumberOfFiles / $files_per_page);
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
    </div>
    <div id="pop" class="overlay">
        <div class="popup" style="height: 65%;">
            <h2 style="font-size: 1.5rem;margin-bottom: 30px; margin-top: 10px;margin-left: 10px;">Download</h2>
            <a id='close' class="closee" href="#">&times;</a>
            <div class="col" style="flex-wrap: wrap;display: flex;">

                <div style="justify-content: space-around;align-items: flex-end;width:100%;" class="row">

                    <div class="user-details">
                        <div class="input-box">
                            <span style="font-weight: 500;" class="details">Templates</span>
                            <select name="templates" id="templates" class="details" placeholder="Colleague">
                                <option value="1">GLT KSA</option>
                                <option value="2">OCS</option>
                                <option value="3">GLT UAE</option>
                            </select required>
    
                        </div>
                    </div>
                    <div>
                        <button onclick="download_template(this)" type="submit" class="btn btn-primary" style="border-radius: 15px;font-family: 'Bebas Neue', cursive;font-size: 17px;letter-spacing: 2px;font-weight: 600;padding: 8px 25px 5px 25px;">
                        Download
                        </button>
                    </div>
                    
                </div>
                
                <hr style="width: 100%;">
                {{-- <select name="templates" id="templates">
                    <option value="1">GLT KSA</option>
                    <option value="2">OCS</option>
                    <option value="3">GLT UAE</option>

                </select> --}}
              {{--   <p style="color: black;">You can download <a href="{{ asset('GLT_template.xlsx') }}" download>GLT
                    templete</a> OR <a href="{{ asset('OCS_template.xlsx') }}" download>OCS
                        templete</a> and fill it with data then
                upload it here</p> --}}

                <h2 style="font-size: 1.5rem;margin-bottom: 30px;margin-left: 10px;">Upload Excel Sheet</h2>
                <form style="width: 100%;" method="post" enctype="multipart/form-data" action="awb_bulk_upload_express">
                    {{ csrf_field() }}
                    <div style="margin-top: 20px;display: flex;align-items: flex-end;justify-content: space-around;" class="row">
                        <div class="user-details">
                            <div class="input-box">
                                <span style="font-weight: 500;" class="details">Country</span>
                                <select name="countries" id="countries" class="details" placeholder="Colleague">
                                    <option value="KSA">KSA</option>
                                    <option value="OCS">KUWAIT</option>
                                    <option value="UAE">UAE</option>
                                </select required>
        
                            </div>
                        </div>

                        <input style="color: black;width: 40%;" type="file" name="awb_excel" id="awb_excel">
                    </div>
                    <div style="margin-top: 30px;display: flex;justify-content: center;">
                        <button onclick="upload_pop(this)" type="submit" class="btn btn-primary"
                            style="border-radius: 15px;font-family: 'Bebas Neue', cursive;font-size: 17px;letter-spacing: 2px;font-weight: 600;padding: 8px 25px 5px 25px;">
                            Ceate AWBs
                        </button>
                    </div>
                    
                </form>
            </div>

        </div>
    </div>
    <script>
        var template=0;

        
        function download_template(ele){
            template=$("#templates").val();
            if (template==1) {
                window.location.href="public/GLT_template.xlsx";
            } else if(template==2) {
                window.location.href="public/OCS_template.xlsx";
            }
            else if(template==3)
            {
                window.location.href="public/GLT_UAE_template.xlsx";
            }
            console.log($("#templates").val()); 
        }


        function upload_pop(elemant) {

            $('#pop').show();

        }
        $('.closee').click(function(e) {
            $(this.parentElement.parentElement).hide();
            e.preventDefault();
        });
    </script>
@endsection
