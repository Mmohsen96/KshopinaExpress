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
            font-size: 16px;
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

        .icon {
            color: #1b3425;
            font-size: 8px;

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
    {{-- @if ($message = Session::get('message'))
        <script>
            Swal.fire({
                position: 'center',
                icon: 'success',
                title: 'Shipment has been deleted successfully',
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
    <div class="container">
        <div class="row row--top-40">
            <div class="col-md-12">
                <h2 class="row__title">Accounts List</h2>
            </div>
        </div>
        <div class="row row--top-20">
            <div class="col-md-12">
                <div class="table-container">
                    <table class="table">
                        <thead class="table__thead">
                            <tr>
                                <th class="table__th ">Created At</th>
                                <th class="table__th">Name</th>
                                <th class="table__th">Email</th>
                                <th class="table__th">Phone Number</th>
                                <th class="table__th">City</th>
                                <th class="table__th">Profile completed</th>
                                <th class="table__th">Active</th>
                                <th class="table__th">Action</th>

                            </tr>
                        </thead>
                        <tbody class="table__tbody">
                            @php
                                $active = ['Not Active', 'Active'];
                                $active_colors = ['red', 'green'];
                                
                            @endphp
                            @foreach ($accounts as $account)
                                <tr class="table-row table-row--chris">
                                    <td data-column="created_at" class="table-row__td">
                                        <div class="table-row__info">
                                            <p class="table-row__name">
                                                {{ date('M j, Y', strtotime($account->created_at)) }}</p>
                                        </div>
                                    </td>
                                    <td data-column="user_name" class="table-row__td">
                                        <div class="table-row__info">
                                            <p class="table-row__name">{{ $account->name }}</p>
                                        </div>
                                    </td>
                                    <td data-column="user_email" class="table-row__td">
                                        <div class="table-row__info">
                                            <p class="table-row__name">{{ $account->email }}</p>
                                        </div>
                                    </td>
                                    <td data-column="phone_number" class="table-row__td">
                                        <div class="table-row__info">
                                            <p class="table-row__name">{{ $account->phone_number }}</p>
                                        </div>
                                    </td>
                                    <td data-column="user_city" class="table-row__td">
                                        <div class="table-row__info">
                                            <p class="table-row__name">{{ $account->city }}</p>
                                        </div>
                                    </td>
                                    <td data-column="completed" class="table-row__td">
                                        <div class="table-row__info">
                                            @if ($account->complete == 0)
                                                <p class="table-row__name">incomplete</p>
                                            @else
                                                <p class="table-row__name">Complete</p>
                                            @endif
                                        </div>
                                    </td>
                                    <td data-column="active" class="table-row__td">
                                        <div class="table-row__info">
                                            <p
                                                class="table-row__p-status status status--{{ $active_colors[$account->active] }}">
                                                {{ $active[$account->active] }}</p>
                                        </div>
                                    </td>
                                    <td data-column="order_details" class="table-row__td">
                                        <div class="table-row__info">
                                            @if ($account->active == 0)
                                                <button type="button"
                                                    onclick="toggle_active({{ $account->id }},{{ $account->active }})"
                                                    id="delete_1" class="btn btn-primary">
                                                    <i class="fas fa-check"></i>
                                                </button>
                                            @else
                                                <button type="button"
                                                    onclick="toggle_active({{ $account->id }},{{ $account->active }})"
                                                    id="delete_2" class="btn btn-primary">
                                                    <i class="fas fa-ban"></i>
                                                </button>
                                            @endif

                                        </div>
                                    </td>

                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

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
        <div class="pagination">
            <a href="#">&laquo;</a>
            <?php
            $accounts_per_page = 15;
            $pages = ceil($number_of_accounts[0]->NumberOfAccounts / $accounts_per_page);
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


    <script>
        var shipment_id;

        function toggle_active(id, active) {
            var msg;
            var sub;

            if (active == 0) {
                msg = "Do you make sure to activate this account ?";
                sub = 'Yes, activate it!';
            } else {
                msg = "Do you make sure to deactivate this account ?";
                sub = 'Yes, deactivate it!';
            }

            Swal.fire({
                title: msg,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#17a2b8',
                cancelButtonColor: '#d33',
                confirmButtonText: sub
            }).then((result) => {
                if (result.isConfirmed) {

                    $.ajax({
                        url: "toggle_active",
                        type: "post",
                        data: {
                            _token: "{{ csrf_token() }}",
                            id: id,
                            active: active
                        },
                        success: function(response) {



                            if (active == 0) {
                                $("#delete_1").html('<i class="fas fa-ban"></i>');

                            } else {
                                $("#delete_2").html('<i class="fas fa-check"></i>');

                            }
                            window.location.reload();

                            Swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: 'Done',
                                showConfirmButton: false,
                                timer: 1500
                            });

                        },
                        error: function(xhr) {
                            //Do Something to handle error
                        }

                    });
                }
            });



        }
    </script>
@endsection
