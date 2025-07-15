@extends('layouts.app')
@section('content')

    <style>
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

        body {
            background-color: #dfdfdf;
        }

        .table {
            border-collapse: collapse;
            width: 100%;
            border-radius: 15px;
            overflow: hidden;
        }

        .td,
        .th {
            border: 1px solid #c6c6c6;
            text-align: left;
            padding: 8px;
            text-align: center;
            border: none;

        }

        .th {
            color: white;

        }

        tr {
            background-color: #f9f9f9;
        }

        .td {
            padding: 0.87rem !important;
        }

        .pagination {
            display: inline-block;
        }

        .pagination a {
            color: black;
            float: left;
            padding: 8px 16px;
            text-decoration: none;
        }

        .pagination a.active {
            background-color: #ca9b49;
            color: white;
            border-radius: 5px;
        }

        .pagination a:hover:not(.active) {
            background-color: rgb(116, 112, 112);
            border-radius: 5px;
        }


        .stati {
            align-items: center;
            background: #fff;
            height: 6em;
            margin: 1em 0;
            -webkit-transition: margin 0.5s ease, box-shadow 0.5s ease;
            /* Safari */
            transition: margin 0.5s ease, box-shadow 0.5s ease;
            -moz-box-shadow: 0px 0.2em 0.4em rgb(0, 0, 0, 0.8);
            -webkit-box-shadow: 0px 0.2em 0.4em rgb(0, 0, 0, 0.8);
            box-shadow: 0px 0.2em 0.4em rgb(0, 0, 0, 0.8);
        }

        .stati:hover {
            margin-top: 0.5em;
            -moz-box-shadow: 0px 0.4em 0.5em rgb(0, 0, 0, 0.8);
            -webkit-box-shadow: 0px 0.4em 0.5em rgb(0, 0, 0, 0.8);
            box-shadow: 0px 0.4em 0.5em rgb(0, 0, 0, 0.8);
        }
        

        .stati i {
            font-size: 3.5em;
        }

        .stati div {
            width: 50%;
            display: block;
            float: right;
            text-align: right;
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
        .stati.bg-turquoise { background: rgb(204 163 81); color:white;} 

    </style>
    {{-- <img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(100)->generate('Make me into an QrCode!')) !!} "> --}}
    <div class="container">
        <h2 style="font-weight: bolder;text-align: center;margin-bottom: 50px;">Requests</h2>

        <div class="row">
            <div class="col-md-3">
                <div class="row stati turquoise ">
                    <i style="width: 50%; padding: 21px;color: rgb(204 163 81);" class="fas fa-globe"></i>
                    <div style="padding: 1em;" >
                        <b>{{$all_requests[0]->NumberOfOrders}}</b>
                        <span>All Requests</span>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="row stati turquoise left">
                    <div style="padding: 1em;">
                        <b>{{$ksa[0]->NumberOfOrders}}</b>
                        <span>Saudi Arabia</span>
                    </div>
                    <img class="flag" style="height: 66%;" src="{{ asset('/ksa.png')}}" alt="image">

                </div>
            </div>
            <div class="col-md-3">
                <div class="row stati bg-turquoise ">
                    <img class="flag" style="height: 70%;" src="{{ asset('/kuwait.png')}}" alt="image">

                    <div >
                        <b>{{$kuwait[0]->NumberOfOrders}}</b>
                        <span>Kuwait</span>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="row stati bg-turquoise left">
                    <div style="padding: 1em;">
                        <b>{{$egypt[0]->NumberOfOrders}}</b>
                        <span>Egypt</span>
                    </div>
                    <img class="flag" style="height: 66%;" src="{{ asset('/egypt.png')}}" alt="image">

                </div>
            </div>
        </div>

        <table class="table table-striped">
            <tbody id="table">


                <tr style="background: #36304a;">

                    <th class="th">Order Number</th>
                    <th class="th">Current Status</th>
                    <th class="th">New status</th>
                    <th class="th">Country</th>
                    <th class="th">Actions</th>
                </tr>
                @foreach ($orders as $order)
                    <tr>

                        <td class="td">#{{ $order->order_number }}</td>

                        <?php if ($order->change_from == '6') {
                        $old_status = 'Delivered';
                        } else {
                        $old_status = 'Refused';
                        } ?>

                        <td class="td">{{ $old_status }}</td>

                        <?php if ($order->change_to == '5') {
                        $new_status = 'Wrong Phone';
                        } elseif ($order->change_to == '6') {
                        $new_status = 'Delivered';
                        } else {
                        $new_status = 'Refused';
                        } ?>

                        <td class="td">{{ $new_status }}</td>
                        <td class="td">{{ $order->country }}</td>

                        <td id="actions" class="td">
                            <div style="display: inline-block;" class="row">
                                <button id="{{ $order->order_number . $order->change_to }}" onclick="support_change(this)"
                                    style="background-color: #ca9b49;border-color: #ca9b49; font-size: 14px; padding: .25rem 15px;display: inline-grid;"
                                    class="btn btn-success btn-s">
                                    Change
                                </button>
                                <button id="#{{ $order->order_number . $order->change_to }}"
                                    onclick="support_change(this)"
                                    style="background-color: #6c757d;border-color: #6c757d; font-size: 14px; padding: .25rem 15px;display: inline-grid;"
                                    class="btn btn-info btn-s">
                                    Dismiss
                                </button>
                            </div>

                        </td>
                        {{-- <td class="td">{{ $order->kshopina_awb }}</td> --}}

                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="pagination">
            <a href="#">&laquo;</a>
            <?php
            $orders_per_page = 4;
            $pages = ceil($number_of_orders[0]->NumberOfOrders / $orders_per_page);
            ?>
            @for ($i = 1; $i <= $pages; $i++)
                @if ($_GET['page'] == $i) <a class='active'
                href="?page={{ $i }}">{{ $i }}</a>
            @else
                <a href="?page={{ $i }}">{{ $i }}</a> @endif


            @endfor

            {{-- <a href="#" class="active">1</a>
            <a href="#">2</a>
            <a href="#">3</a>
            <a href="#">4</a>
            <a href="#">5</a>
            <a href="#">6</a> --}}
            <a href="#">&raquo;</a>
        </div>
    </div>

    <script>
        function support_change(order) {
            $(order.parentElement.parentElement).html(
                '<div id="' + order.id +
                '" style="align-items: center;justify-content: center;display: flex"><div class="loader"></div></div>'
            );
            var order_number = "";
            if (order.id.substring(0, 1) == '#') {
                order_number = order.id.substring(1, order.id.length - 1);
            } else {
                order_number = order.id.substring(0, order.id.length - 1);
            }
            var select_order = $(order.parentElement.parentElement);

            $.ajax({
                url: "support_change",
                type: "post",
                data: {
                    _token: "{{ csrf_token() }}",
                    first: order.id.substring(0, 1),
                    order: order_number,
                    status: order.id.substring(order.id.length - 1)
                },
                success: function(response) {
                    if (order.id.substring(0, 1) == '#') {
                        $("#\\" + order.id).html("Action taken");
                    } else {
                        $("#" + order.id).html("Action taken");
                    }


                    /*                     window.open(response);
                     */
                },
                error: function(xhr) {
                    //Do Something to handle error
                }

            });
        }

    </script>


@endsection
