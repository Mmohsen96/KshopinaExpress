{{-- @extends('layouts.app')
@section('content')
<div>
    
    {!! QrCode::size(200)->generate('https://kshopina.com/'); !!}
</div>
@endsection --}}

@extends('layouts.app')

@section('content')

    <style>
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
            /*             padding: 1em;
                        */
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

        .stati.bg-turquoise {
            background: rgb(204 163 81);
            color: white;
        }

    </style>
    {{-- <img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(100)->generate('Make me into an QrCode!')) !!} "> --}}
    <div class="container">
        <h2 style="font-weight: bolder;text-align: center;margin-bottom: 50px;">Resubmitted Orders</h2>

            <div class="row">
                <div class="col-md-3">
                    <div class="row stati turquoise ">
                        <i style="width: 50%; padding: 21px;color: rgb(204 163 81);" class="fas fa-globe"></i>
                        <div style="padding: 1em;">
                            <b>{{ $all_orders[0]->NumberOfOrders }}</b>
                            <span>All Submitted</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="row stati turquoise left">
                        <div style="padding: 1em;">
                            <b>{{ $pending[0]->NumberOfOrders }}</b>
                            <span>Pending</span>
                        </div>
                        <i style="text-align: right;width: 50%; padding: 21px;color: rgb(204 163 81);" class="fas fa-clock"></i>

                    </div>
                </div>
                <div class="col-md-3">
                    <div class="row stati bg-turquoise ">
                        <i style="width: 50%; padding: 21px;color:rgb(8 138 0);" class="fas fa-check"></i>

                        <div style="padding: 1em;">
                            <b>{{ $delivered[0]->NumberOfOrders }}</b>
                            <span>Delivered</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="row stati bg-turquoise left">
                        <div style="padding: 1em;">
                            <b>{{ $refused[0]->NumberOfOrders }}</b>
                            <span>Refused</span>
                        </div>
                        <i style="text-align: right;width: 50%; padding: 21px;color:rgb(185 0 0);" class="fas fa-times"></i>

                    </div>
                </div>
            </div>



        <table class="table table-striped">
            <tbody id="table">


                <tr style="background: #36304a;">

                    <th class="th">Order Number</th>
                    <th class="th">Country</th>
                    <th class="th">Order Link</th>
                    <th class="th">Status</th>
                    <th class="th">Actions</th>
                </tr>
                @foreach ($orders as $order)
                    <tr>

                        <td class="td">#{{ $order->order_number }}</td>

                        <td class="td">{{ $order->country }}</td>
                        <td class="td"><a target="blank"
                                href="https://kshopina.myshopify.com/admin/orders/{{ $order->order_id }}">Shopify</a></td>

                                @if ($order->status == '6')
                                <td style="color: #0b7105;font-weight: 600;" class="td">Delivered</td>
                                @else
                                <td style="color: #b90000;font-weight: 600;" class="td">Refused</td>
                                @endif
                       
                        

                        <td id="actions" class="td">
                            @if ($order->actions == 0)
                                <div style="display: inline-block;" class="row">
                                    <button id="##{{ $order->order_number }}" onclick="delivered(this)"
                                        style="letter-spacing: .7px;font-size: 12px;background-color: #ca9b49;border-color: #ca9b49;padding-inline: 13px;display: inline-grid;"
                                        class="btn btn-success btn-s">
                                        Delivered
                                    </button>
                                    <button id="{{ $order->order_number }}" onclick="dublicate(this)"
                                        style="letter-spacing: .7px;font-size: 12px;background-color: #6c757d;border-color: #6c757d;padding-inline: 13px;display: inline-grid;"
                                        class="btn btn-info btn-s">
                                        Refused
                                    </button>
                                   {{--  <button id="#{{ $order->order_number }}" onclick="pending(this)"
                                        style="padding: 9px;letter-spacing: .7px;font-size: 12px;border-color: #6c757d;padding-inline: 13px;display: inline-grid;"
                                        class="btn btn-s">
                                        <i class="far fa-clock"></i>
                                    </button> --}}
                                </div>
                            @else
                                Action Taken
                            @endif

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
        function dublicate(order) {

            swal({
                title: "Please wait!",
                text: " ",
                closeOnClickOutside: false,
                button: null,
                icon: "loader.gif",
            });

            $.ajax({
                url: "refused_process",
                type: "post",
                data: {
                    _token: "{{ csrf_token() }}",
                    order: order.id,
                },
                success: function(response) {
                    swal.close();

                    $(order.parentElement.parentElement).html("Action taken");
                    /*                     window.open(response);
                     */
                },
                error: function(xhr) {
                    //Do Something to handle error
                }

            });
        }

        function delivered(order) {

            swal({
                title: "Please wait!",
                text: " ",
                closeOnClickOutside: false,
                button: null,
                icon: "loader.gif",
            });

            $.ajax({
                url: "delivered_process",
                type: "post",
                data: {
                    _token: "{{ csrf_token() }}",
                    order: order.id.substring(2),
                },
                success: function(response) {
                    swal.close();

                    $(order.parentElement.parentElement).html("Action taken");
                    /*                     window.open(response);
                     */
                },
                error: function(xhr) {
                    //Do Something to handle error
                }

            });
        }

        function cancel(order) {
            swal({
                title: "Please wait!",
                text: " ",
                closeOnClickOutside: false,
                button: null,
                icon: "sloader.gif",
            });
            $.ajax({
                url: "refused_cancel",
                type: "post",
                data: {
                    _token: "{{ csrf_token() }}",
                    order: order.id.substring(1),
                },
                success: function(response) {
                    swal.close();

                    $(order.parentElement.parentElement).html("Action taken");
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
