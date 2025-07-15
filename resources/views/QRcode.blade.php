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

       
    </style>
    {{-- <img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(100)->generate('Make me into an QrCode!')) !!} "> --}}
    
    <div class="container">
        <h2 style="font-weight: bolder;text-align: center;margin-bottom: 50px;">Orders that have QR code</h2>

        <table class="table table-striped">
            <tbody id="table">


                <tr style="background: #36304a;">

                    <th class="th">Order Number</th>
                    <th class="th">Status</th>
                    <th class="th">Case</th>
                    <th class="th">Generate & Download</th>
                </tr>
                @foreach ($orders as $order)
                    <tr>

                        <td class="td">#{{ $order->order_number }}</td>
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
                        <td class="td"><button style=" font-size: 11px;padding: 0px;font-size: 15px;display: inline-grid;"
                                class="btn btn-link" id="#{{ $order->order_number }}" onclick="generate_and_open(this)"
                                target="_blank">Scan</button> </td>

                        <td class="td"><button id="{{ $order->order_number }}" onclick="generate(this)"
                                style="background-color: #ca9b49;border-color:#ca9b49; padding-inline: 20px;display: inline-grid;"
                                class="btn btn-light btn-s">
                                <i class="fas fa-cog"></i>
                            </button>
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
        function generate(elemant) {
            
            swal({
                title: "Please wait!",
                text: " ",
                closeOnClickOutside: false,
                button: null,
                icon: "loader.gif",
            });
            $.ajax({
                url: "generate",
                type: "post",
                data: {
                    _token: "{{ csrf_token() }}",
                    order: elemant.id,
                },
                success: function(response) {
                    swal.close();
/*                     console.log(response);
 */                    window.open(response[0]);
                },
                error: function(xhr) {
                    //Do Something to handle error
                }

            });



        }

        function generate_and_open(elemant) {

             swal({
                title: "Please wait!",
                text: " ",
                closeOnClickOutside: false,
                button: null,
                icon: "loader.gif",
            });
            var id = (elemant.id).substr(1);
            $.ajax({
                url: "generate",
                type: "post",
                data: {
                    _token: "{{ csrf_token() }}",
                    order: id,
                },
                success: function(response) {
                    swal.close();
                    window.open(response[1]);
                },
                error: function(xhr) {
                    //Do Something to handle error
                }

            });



        }

        $(function() {
            var ff = document.getElementById('table').children;
            var data = [];
            for (var i = 1; i < ff.length; i++) {
                for (var k = 1; k < ff[i].children.length; k += 4) {
                    data.push(ff[i].children[k].firstChild.data.substring(1, ff[i].children[k].firstChild.data
                        .length));
                }
            }

            //column checkbox select all or cancel
            $("input.select-all").click(function() {
                var checked = this.checked;
                $("input.select-item").each(function(index, item) {
                    item.checked = checked;
                });
            });
            //check selected items
            $("input.select-item").click(function() {
                var checked = this.checked;
                var all = $("input.select-all")[0];
                var total = $("input.select-item").length;
                var len = $("input.select-item:checked:checked").length;
                all.checked = len === total;
            });

        });

    </script>

@endsection
