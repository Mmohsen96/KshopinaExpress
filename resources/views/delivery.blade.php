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
 */            margin: 1em 0;
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
    <div class="container">
        <h2 style="font-weight: bolder;text-align: center;margin-bottom: 50px;">All Orders</h2>
        {{-- <button id='change'
            style="background-color:#ca9b49;color:white; display: flex;position: relative;left: 92%;margin-bottom: 10px;"
            type="button" class="btn">Update</button> --}}
            <div class="row">
                <div class="col-md-3">
                    <div class="row stati turquoise ">
                        <i style="width: 50%; padding: 21px;color: rgb(204 163 81);" class="fas fa-globe"></i>
                        <div style="padding: 1em;">
                            <b>{{ $number_of_orders[0]->NumberOfOrders }}</b>
                            <span>All Orders</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="row stati turquoise left">
                        <div style="padding: 1em;">
                            <b>{{ $ksa[0]->NumberOfOrders }}</b>
                            <span>Saudi Arabia</span>
                        </div>
                        <img class="flag" style="height: 66%;" src="{{ asset('/ksa.png') }}" alt="image">

                    </div>
                </div>
                <div class="col-md-3">
                    <div class="row stati bg-turquoise ">
                        <img class="flag" style="height: 70%;" src="{{ asset('/kuwait.png') }}" alt="image">

                        <div>
                            <b>{{ $kuwait[0]->NumberOfOrders }}</b>
                            <span>Kuwait</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="row stati bg-turquoise left">
                        <div style="padding: 1em;">
                            <b>{{ $egypt[0]->NumberOfOrders }}</b>
                            <span>Egypt</span>
                        </div>
                        <img class="flag" style="height: 66%;" src="{{ asset('/egypt.png') }}" alt="image">

                    </div>
                </div>
            </div>



        <table class="table table-striped">
            <tbody id="table">


                <tr style="background: #36304a;">
                    {{-- <th class="th">
                        <input type="checkbox" class="select-all checkbox" name="select-all" /> Select All
                    </th> --}}
                    <th class="th">Order Number</th>
                    <th class="th">Kshopina AWB</th>
                    <th class="th">Country</th>
                    <th class="th">Track</th>
                    <th class="th">Status</th>
                </tr>
                @foreach ($orders as $order)
                    <tr>
                        {{-- <td class="td">
                            @if ($order->status == 4)
                                <input type="checkbox" class="select-item checkbox" name="select-item" value="1000" />
                            @Elseif($order->status > 4)
                                Out
                            @else
                                Waiting
                            @endif
                        </td> --}}
                        <td class="td">#{{ $order->order_number }}</td>
                        <td class="td">{{ $order->kshopina_awb }}</td>
                        <td class="td">{{ $order->country }}</td>
                        <td class="td"><a href="https://{{ $order->tracking_url }}" target="_blank">Track</a> </td>

                        <?php if ($order->status == '0') {
                            $status = 'Pending';
                        }
                        elseif ($order->status == '1') {
                        $status = 'Fulfilled';
                        } elseif ($order->status == '2') {
                        $status = 'Dispatched';
                        } elseif ($order->status == '3') {
                        $status = 'Held At Customs';
                        } elseif ($order->status == '4') {
                        $status = 'In Warehouse';
                        } elseif ($order->status == '5') {
                        $status = 'With Courier';
                        } elseif ($order->status == '6') {
                        $status = 'Delivered';
                        } else {
                        $status = 'Refused';
                        } ?>
                        <td class="td">{{ $status }}</td>
                    </tr>
                @endforeach

                {{-- <tr>
                <td class="td">
                    <input type="checkbox" class="select-item checkbox" name="select-item" value="1001" />
                </td>
                <td class="td">kiran</td>
                <td class="td">boy</td>
                <td class="td">21</td>
            </tr>
            <tr>
                <td class="td">
                    <input type="checkbox" class="select-item checkbox" name="select-item" value="1002" />
                </td>
                <td class="td">Prasanna</td>
                <td class="td">boy</td>
                <td class="td">22</td>
            </tr>
            <tr>
                <td class="td">
                    <input type="checkbox" class="select-item checkbox" name="select-item" value="1003" />
                </td>
                <td class="td">shruthi </td>
                <td class="td">girl</td>
                <td class="td">23</td>
            </tr> --}}
            </tbody>
        </table>
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
        {{-- <button style="background-color: #ca9b49 !important;color: #000000 !important;" id="select-all" class="btn button-default">Select All / Cancel</button> --}}
    </div>


    <script>






    </script>

@endsection
