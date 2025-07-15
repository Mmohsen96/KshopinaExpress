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



        ul {
            margin-left: 20px;
        }

        .wtree li {
            list-style-type: none;
            margin: 10px 0 10px 10px;
            position: relative;
        }

        .wtree li:before {
            content: "";
            position: absolute;
            top: -10px;
            left: -20px;
            border-left: 1px solid #ddd;
            border-bottom: 1px solid #ddd;
            width: 20px;
            height: 15px;
        }

        .wtree li:after {
            position: absolute;
            content: "";
            top: 5px;
            left: -20px;
            border-left: 1px solid #ddd;
            border-top: 1px solid #ddd;
            width: 20px;
            height: 100%;
        }

        .wtree li:last-child:after {
            display: none;
        }

        .wtree li span {
            display: block;
            border: 1px solid #ddd;
            padding: 10px;
            color: #888;
            text-decoration: none;
        }

        .wtree li span:hover,
        .wtree li span:focus {
            background: #eee;
            color: #000;
            border: 1px solid #aaa;
        }

        .wtree li span:hover+ul li span,
        .wtree li span:focus+ul li span {
            background: #eee;
            color: #000;
            border: 1px solid #aaa;
        }

        .wtree li span:hover+ul li:after,
        .wtree li span:hover+ul li:before,
        .wtree li span:focus+ul li:after,
        .wtree li span:focus+ul li:before {
            border-color: #aaa;
        }

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
            width: 35%;
            position: relative;
            transition: all 5s ease-in-out;
        }

        .popup h2 {
            margin-top: 0;
            color: #ca9b49;
            font-family: Tahoma, Arial, sans-serif;
        }

        .popup .close {
            position: absolute;
            top: 20px;
            right: 30px;
            transition: all 200ms;
            font-size: 30px;
            font-weight: bold;
            text-decoration: none;
            color: #333;
        }

        .popup .close:hover {
            color: #ca9b49;
        }

        .popup .content {
            max-height: 45%;
            overflow: auto;
        }

        @media screen and (max-width: 700px) {
            .box {
                width: 70%;
            }

            .popup {
                width: 70%;
            }
        }

    </style>
    <div class="container">
        <h2 style="font-weight: bolder;text-align: center;margin-bottom: 50px;">Mark orders as they left the warehouse</h2>
        {{-- <button id='change'
            style="background-color:#ca9b49;color:white; display: flex;position: relative;left: 92%;margin-bottom: 10px;"
            type="button" class="btn">Update</button> --}}

        <table class="table table-striped">
            <tbody id="table">


                <tr style="background: #36304a;">
                    <th class="th">Order Number</th>
                    <th class="th">Details</th>
                    <th class="th">Kshopina AWB</th>
                    <th class="th">Track</th>
                    <th class="th">Status</th>
                    <th class="th">Actions</th>
                </tr>
                @foreach ($orders as $order)
                    <tr>

                        <td class="td">#{{ $order->order_number }}</td>
                        <td class="td"><button
                                style=" font-size: 11px;padding: 0px;font-size: 15px;display: inline-grid;"
                                class="btn btn-link" id="{{ $order->order_number }}" onclick="get_items(this)"
                                target="_blank">Details</button> </td>

                        <td class="td">{{ $order->kshopina_awb }}</td>
                        <td class="td"><a href="https://{{ $order->tracking_url }}" target="_blank">Track</a>
                        </td>

                        <?php if ($order->status == '1') {
                            $status = 'Fulfilled';
                        } elseif ($order->status == '2') {
                            $status = 'Dispatched';
                        } elseif ($order->status == '3') {
                            $status = 'Held At Customs';
                        } elseif ($order->status == '4') {
                            $status = 'In Warehouse';
                        } elseif ($order->status == '5') {
                            $status = 'With Courier';
                        } else {
                            $status = 'Delivered';
                        } ?>
                        <td class="td">{{ $status }}</td>
                        <td id="actions" class="td">
                            <div id="action{{ $order->order_number }}" style="width: max-content;display: inline-block;"
                                class="row">
                                @if ($order->status == 4)
                                    <button id="#{{ $order->order_number }}" onclick="left(this)"
                                        style="letter-spacing: .7px;font-size: 12px;background-color: #ca9b49;border-color: #ca9b49;padding-inline: 13px;display: inline-grid;"
                                        class="btn btn-success btn-s">
                                        With courier
                                    </button>
                                @Elseif($order->status > 4)
                                    Out
                                @else
                                    Waiting
                                @endif
                            </div>
                        </td>
                    </tr>
                @endforeach


            </tbody>
        </table>


        <div id="popup1" class="overlay">
            <div class="popup">
                <h2 style="margin-bottom: 8px" id="order">Here i am</h2>
                <a id='close' class="close" href="#">&times;</a>
                <div class="content">
                    <div style="margin-left: 32px;" id="items">10 item</div>
                    <ul id="tree" class="wtree">
                        <li>
                            <span>Nivel 1</span>
                            <ul>
                                <li>
                                    <span>Nivel 2</span>
                                </li>
                            </ul>
                        </li>

                    </ul>
                </div>
            </div>
        </div>

        <div class="pagination">
            <a href="#">&laquo;</a>
            <?php
            $orders_per_page = 15;
            $pages = ceil($number_of_orders[0]->NumberOfOrders / $orders_per_page);
            ?>
            @for ($i = 1; $i <= $pages; $i++)
                @if ($_GET['page'] == $i) <a class='active'
                        href="?page={{ $i }}">{{ $i }}</a>
                @else
                    <a href="?page={{ $i }}">{{ $i }}</a>
                @endif


            @endfor

            {{-- <a href="#" class="active">1</a>
            <a href="#">2</a>
            <a href="#">3</a>
            <a href="#">4</a>
            <a href="#">5</a>
            <a href="#">6</a> --}}
            <a href="#">&raquo;</a>
        </div>
        {{-- <button style="background-color: #ca9b49 !important;color: #000000 !important;" id="select-all" class="btn button-default">Select All / Cancel</button> --}}
    </div>


    <script>
        function left(elemant) {
            $(elemant.parentElement.parentElement).html(
                '<div id="' + elemant.id +
                '" style="align-items: center;justify-content: center;display: flex"><div class="loader"></div></div>'
            );
            var order_number = elemant.id.substring(1);
            $.ajax({
                url: "leftTheHub",
                type: "post",
                data: {
                    _token: "{{ csrf_token() }}",
                    order: order_number,
                },
                success: function(response) {
                    
                    $("#\\" + elemant.id).html("Action taken");
                    /* window.location.href = 'delivery?page=1'; */
                },
                error: function(xhr) {
                    //Do Something to handle error
                }

            });
        };




        $('#close').click(function() {
            $('#popup1').hide();
        });

        function get_items(elemant) {
            swal({
                title: "Please wait!",
                text: " ",
                closeOnClickOutside: false,
                button: null,
                icon: "loader.gif",
            });

            $.ajax({
                url: "get_items",
                type: "get",
                data: {
                    _token: "{{ csrf_token() }}",
                    order: elemant.id,
                },
                success: function(response) {
                    var elemant2 = "";
                    var order_id = '';
                    $('#tree').html('');
                    var html = '';
                    response.forEach(element => {
                        elemant2 = JSON.parse(JSON.stringify(element));
                        order_id = elemant2.order_id;
                        html += '<li><span>' + elemant2.product_name + '</span><ul><li><span>' +
                            elemant2['quantity'] + ' Qty</span></li></ul></li>'
                    });
                    swal.close();
                    $('#tree').html(html);
                    $('#order').html("#" + order_id);
                    $('#items').html(response.length + ' item');
                    $('#popup1').show();


                },
                error: function(xhr) {
                    //Do Something to handle error
                }

            });
        }
    </script>

@endsection
