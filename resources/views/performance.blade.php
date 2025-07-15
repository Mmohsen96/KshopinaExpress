@extends('layouts.staff_layout')

@section('content')
    <style>
        body {
            color: #1b3425;
        }

        .row {
            margin-bottom: 1.5rem !important;
            width: 100% !important;
        }

        .content-wrapper {
            padding: 1.5rem 0rem;
        }

        .stati {
            align-items: center;
            background: white;
            color: #1b3425;
            height: 9em;
            border: 1px solid #1b34253d;
            border-radius: 8px 8px 8px 8px;
            margin: 1em 0;
            transition: margin 0.5s ease, box-shadow 0.5s ease;
        }

        .stati:hover {
            margin-top: 0.5em;

        }


        .stati i {
            font-size: 3.5em;
        }

        .stati div b {
            font-size: 2.2em;
            width: 100%;
            padding-top: 0px;
            margin-top: -0.2em;
            margin-bottom: -0.2em;
            display: block;
        }

        .stati div span {
            font-size: 1em;
            width: 100%;
            color: rgb(0, 0, 0, 0.8);
             !important;
            display: block;
        }

        .stati.left div {
            float: left;
            text-align: left;
        }

        .stati.bg-turquoise {
            background-color: #1b3425;
            color: white;
        }


        .icon.icon-box-success {
            width: 40px;
            height: 37px;
            background: rgba(0, 210, 91, 0.11);
            border-radius: 7px;
            color: #00d25b;
        }

        .icon.icon-box-danger {
            width: 40px;
            height: 37px;
            background: rgba(252, 66, 74, 0.11);
            border-radius: 7px;
            color: #fc424a;
        }

        .card {
            border-radius: 0.5rem;
        }

        .bg-primary {
            background-color: white !important;
            height: 7rem;
        }

        .card_title {
            font-family: 'Bebas Neue', cursive;
            letter-spacing: .5px;
            text-align: center;
            padding: 8px;
            margin-bottom: 0rem;
        }

        .card_contents {
            display: flex;
            padding-top: 1rem;
        }

        #performance_day {
            border: 1px solid #9a9a9a;
            border-radius: 18px;
            padding: 5px 20px 5px 20px;
            font-family: 'Bebas Neue', cursive;
            letter-spacing: 1px;
            font-size: 14px;
            color: black;
        }

        @media (min-width: 768px) {
            .col-md-2 {
                -ms-flex: 0 0 16.666667%;
                flex: 1 0 16.666667%;
                max-width: 25.666667%;
            }
        }
    </style>

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
            background-color: white;
        }


        .row__title {
            font-family: 'Bebas Neue', cursive;
            color: #1b3425;
            font-size: 24px;
            letter-spacing: 1.4px;
            margin: 0;
            margin-bottom: 1rem;
            margin-top: 1rem;
            margin-left: 32px;
        }

        .row--top-40 {
            margin-top: 15px;
            justify-content: space-between;
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
            font-size: 20px;
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
            padding: 20px 8px !important;
            vertical-align: middle !important;
            color: #53646f;
            font-size: 17px;
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

        .btn-primary:focus {
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

        .btn-primary:disabled {
            border-radius: 18px;
            font-size: 14px;
            background-color: #303030e6 !important;
            border-color: #303030e6 !important;
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

        .create:hover {
            color: white;
            text-decoration: none;
        }

        .create {
            color: #426851;
        }
    </style>

    <style>
        .th_head {
            border-bottom: 1px solid #dee2e6 !important;
            border-top: none !important;
            padding: 1.75rem !important;

        }

        td {
            text-align: center;
        }
        .filter_select{
            border: none;
            padding-inline: 25px;
            background-color: white;
            font-family: 'Bebas Neue', cursive;
            letter-spacing: 1px;
            font-size: 16px;
        }
    </style>

    <style>
        canvas{
            background:#fff;
            height:400px;
        }

        h1{
            font-family: Roboto;
            color: #fff;
            margin-top:50px;
            font-weight:200;
            text-align: center;
            display: block;
            text-decoration: none;
        }
    </style>
    

    <div class="row row--top-40" style="display: flex;justify-content: center;">
        <div class="column">
            <h2 class="row__title" style="margin-left: 0px;">Performance</h2>
        </div>


    </div>
    <div class="container">
        <div class="row" style="display: flex;justify-content: center;">

            <div style="width: 100%;display: flex;justify-content: center;align-items: center;align-content: center;" >

                <div class="row" style="align-items: center;border: solid 1px #1b3425;border-radius: 15px;width: 65% !important;
                                display: flex;justify-content: space-around;padding: 13px 10px 13px 10px;">
                    <span
                        style="display: flex;font-size: 20px; margin-left: 10px;flex-wrap: nowrap;color: #1b3425;justify-content: space-between;">
                        <p
                            style="margin-bottom: 0rem; font-family: 'Bebas Neue', cursive; letter-spacing: 1px;">
                            Filters by
                            <i class="fas fa-sort-amount-down" style="color: #cb9d48; margin-left: 3px;"></i>
                        </p>
                    </span>


                    <div class="button-group">
                        
                        <select onchange="system_changed(this)" class="filter_select form-control">
                            <option value="verification" selected>Verification</option>
                            <option value="complaints"> Complaints</option>
                            {{-- <option value="tst"> TST</option> --}}

                            {{-- <option>complains</option>
                                <option>tst</option>
                                <option>stock</option> --}}

                        </select>

                    </div>
                    <div class="button-group" style=" margin-left: 20px;">
                        <select class="filter_select form-control">
                            <option>All</option>
                            {{-- <option>Esraa</option>
                                <option>Menna</option>
                                <option>Bassant</option>
                                <option>Samar</option> --}}
                        </select>

                    </div>
                    <div class="button-group" style=" margin-left: 20px;">
                        <input type="date" name="performance_day" id="performance_day" value="{{ date('Y-m-d', time()) }}">

                    </div>
                    

                </div>
            </div>


           

            <div class="col-md-12">
                <div class="table-container">
                    <table id="verification_table" class="table">
                        <thead class="table__thead">
                            <tr style="background-color: #ffffff;">
                
                                <th class="table__th "></th>
                                <th class="table__th ">Category sorting</th>
                                <th class="table__th ">SVM</th>
                                <th class="table__th ">Confirm order</th>
                                <th class="table__th ">Cancel order</th>

                                <th class="table__th ">Last action</th>
                                <th class="table__th ">Total</th>


                            </tr>
                        </thead>

                        <tbody>

                            @foreach ($verification_analytics as $name => $employee)
                                <tr id="employee_{{ $employee['id'] }}" class="table-row table-row--chris">
                                    <td class="table__th" style="font-size: 18px;">{{ $name }}</td>
                                    <td class="table-row__td">{{ $employee['category'] }}</td>
                                    <td class="table-row__td">{{ $employee['svm'] }}</td>
                                    <td class="table-row__td">{{ $employee['confirmed'] }}</td>
                                    <td class="table-row__td">{{ $employee['canceled'] }}</td>
                                    <td class="table-row__td">@if ($employee['last_action'] != "")  {{ date('h:i:s A', strtotime($employee['last_action'])) }} @else N/A @endif </td>
                                    <td class="table-row__td">{{ $employee['total'] }}</td>

                                </tr>
                            @endforeach

                        </tbody>
                    </table>

                    <table id="complaints_table" class="table" style="display: none;">
                        <thead class="table__thead">
                            <tr style="background-color: #ffffff;">
                                
                                <th class="table__th "></th>
                                <th class="table__th ">Replies</th>
                                <th class="table__th ">Solved</th>
                                <th class="table__th ">Total</th>
                                <th class="table__th ">Last action</th>

                                <th class="table__th ">Average Rate</th>

                            </tr>
                        </thead>

                        <tbody>

                            @foreach ($complaints_employees as $name => $employee)
                                <tr id="employee_{{ $employee['id'] }}" class="table-row table-row--chris">

                                    <td class="table__th" style="font-size: 18px;">{{ $name }}</td>
                                    <td class="table-row__td">{{ $employee['replies'] }}</td>
                                    <td class="table-row__td">{{ $employee['solved'] }}</td>
                                    <td class="table-row__td">{{ $employee['total'] }}</td>
                                    <td class="table-row__td">@if ($employee['last_action'] != "")  {{ date('h:i:s A', strtotime($employee['last_action'])) }} @else N/A @endif </td>

                                    {{-- <td class="table-row__td">{{ $employee['number_of_complaint_rated'] }}</td> --}}

                                    <td class="table-row__td">
                                        <span class="table__th" style="font-size: 18px;padding: 0px !important;">{{ $employee['rate'] }} </span> <i style="color: #cb9d48;position: relative;top: -1px;font-size: 15px;" class="far fa-star"></i>
                                         <span style="color: #9c9c9c;font-size: 13px;"> ( {{ $employee['number_of_complaint_rated'] }} ) </span>
                                    </td>
                
                                </tr>
                            @endforeach

                        </tbody>
                    </table>

                    {{-- <table id="tst_table" class="table" style="display: none;">
                        <thead class="table__thead">
                            <tr style="background-color: #ffffff;">
                                
                                <th class="table__th "></th>
                                <th class="table__th ">On process</th>
                                <th class="table__th ">Fulfill</th>
                                <th class="table__th ">Dispatch (Tst)</th>
                                <th class="table__th ">Status</th>
                                <th class="table__th ">Total</th>

                            </tr>
                        </thead>

                        <tbody>

                            @foreach ($complaints_employees as $name => $employee)
                                <tr id="employee_{{ $employee['id'] }}" class="table-row table-row--chris">

                                    <td class="table__th" style="font-size: 18px;">{{ $name }}</td>
                                    <td class="table-row__td">{{ $employee['replies'] }}</td>
                                    <td class="table-row__td">{{ $employee['solved'] }}</td>
                                    <td class="table-row__td">{{ $employee['total'] }}</td>
                                    <td class="table-row__td">@if ($employee['last_action'] != "")  {{ date('h:i:s A', strtotime($employee['last_action'])) }} @else N/A @endif </td>

                                    <td class="table-row__td">
                                        <span class="table__th" style="font-size: 18px;padding: 0px !important;">{{ $employee['rate'] }} </span> <i style="color: #cb9d48;position: relative;top: -1px;font-size: 15px;" class="far fa-star"></i>
                                         <span style="color: #9c9c9c;font-size: 13px;"> ( {{ $employee['number_of_complaint_rated'] }} ) </span>
                                    </td>
                
                                </tr>
                            @endforeach

                        </tbody>
                    </table> --}}

                </div>

            </div>
            <div>

                
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div style="font-size: 30px;margin-top: 10px;font-family: 'Bebas Neue', cursive;letter-spacing: 1px;display: flex;justify-content: center;">
                        Employees complaints' Rates </div>
                    <div class="card-body">
                        <canvas id="employees_complaints_rates" ></canvas>
                    </div>
                </div>
            </div>
        </div>


    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script>

    <script type="text/javascript">

        var employees_rates = JSON.parse('{!! json_encode($employees_rates) !!}');

        var rate_1 = JSON.parse('{!! json_encode($rate_1) !!}');
        var rate_2 = JSON.parse('{!! json_encode($rate_2) !!}');
        var rate_3 = JSON.parse('{!! json_encode($rate_3) !!}');
        var rate_4 = JSON.parse('{!! json_encode($rate_4) !!}');
        var rate_5 = JSON.parse('{!! json_encode($rate_5) !!}');

        var ctx = document.getElementById("employees_complaints_rates").getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ["1 star ("+rate_1+")","2 stars ("+rate_2+")","3 stars ("+rate_3+")","4 stars ("+rate_4+")","5 stars ("+rate_5+")"],
                datasets: [{
                    label: 'Bassant',
                    backgroundColor: "#caf270",
                    data: employees_rates['Bassant'],
                }, {
                    label: 'Samar',
                    backgroundColor: "#45c490",
                    data: employees_rates['Samar'],
                }, {
                    label: 'Sanaa',
                    backgroundColor: "#008d93",
                    data: employees_rates['Sanaa'],
                }, {
                    label: 'Nehal',
                    backgroundColor: "#2e5468",
                    data: employees_rates['Nehal'],
                }, {
                    label: 'Others',
                    backgroundColor: "#000",
                    data: employees_rates['Others'],
                }
            ],
            },
        options: {
            tooltips: {
            displayColors: true,
            callbacks:{
                mode: 'x',
            },
            },
            scales: {
            xAxes: [{
                stacked: true,
                gridLines: {
                display: false,
                }
            }],
            yAxes: [{
                stacked: true,
                ticks: {
                beginAtZero: true,
                },
                type: 'linear',
            }]
            },
                responsive: true,
                maintainAspectRatio: false,
                legend: { position: 'bottom' },
            }
        });
    </script>

    <script>
        var current_table='verification_table';

        function system_changed(element){
            $('#'+current_table).hide();

            $('#'+element.value+"_table").show();
            current_table=element.value+"_table";
            console.log(element.value);
        }
    </script>
@endsection
