@extends('layouts.app')
@section('content')

    <html>

    <head>
        <title>Import Excel File</title>

    </head>
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

        .input-box select {
            height: 38px;
            width: 100%;
            outline: none;
            font-size: 16px;
            border-radius: 0px;
            padding-left: 15px;
            border: 1px solid #ccc;
            border-bottom-width: 2px;
            transition: all 0.3s ease;
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

        .dot {
            margin-right: 5px;
            height: 28px;
            width: 28px;
            border-radius: 50%;
            display: inline-block;
            display: inline-flex;
            justify-content: center;
            align-items: center;
            background-color: #000000;
            font-size: 14px;
            color: white;
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

        .buttonn {
            background: none !important;
            border: none;
            padding: 0 !important;
            /*optional*/
            color: #007bff;
            cursor: pointer;
        }

        .buttonn:hover {
            color: #069;
            text-decoration: underline;
        }

    </style>

    <body>

        <br />

        <div class="container">
            <h3 align="center" style="font-weight: bold;">Import domestic Excel File</h3>
            <br />
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    Upload Validation Error<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if ($message = Session::get('success'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ $message }}</strong>
                </div>
            @endif
            <form method="post" enctype="multipart/form-data" action="{{ url('/import_domestic_excel/upload') }}">
                {{ csrf_field() }}
                <div style="text-align: center;align-items: center;text-align: center;justify-content: center;"
                    class="row form-group container">
                    <label style="margin-bottom: 0rem;margin-right: 10px;">Select File for Upload</label>
                    {{-- <div>
                        <input class="custom-file-input" id="customFile" type="file" name="select_file" />
                        <label class="custom-file-label" for="customFile">Choose file</label>

                    </div> --}}
                    <div style="width: 45%; margin-right: 70px; align-items: center;" class="input-group">

                        <div style="margin-right: 20px;flex: 70 !important;" class="custom-file">
                            <input name="select_file" type="file" class="custom-file-input" id="inputGroupFile01"
                                aria-describedby="inputGroupFileAddon01">
                            <label class="custom-file-label" for="inputGroupFile01">
                                <span style="display: flex;position: absolute;left: 80px;">Choose file</span>
                            </label>
                        </div>
                        <td width="30">
                            <div style="display: flex;flex: 30 !important;" class="input-box">
                                <select name="company" id="company" class="details" placeholder="Country" required>
                                    <option value="" selected disabled hidden>Company</option>
                                    <option value="OCS">OCS</option>
                                    <option value="GLT">GLT</option>
                                    {{-- <option value="Kuwait">Kuwait</option>
                                <option value="Saudi Arabia">Saudi Arabia</option>
                                <option value="United Arab Emirates">United Arab Emirates</option>
                                <option value="Oman">Oman</option>
                                <option value="Jordon">Jordon</option>
                                <option value="Bahrain">Bahrain</option>
                                <option value="Qatar">Qatar</option> --}}
                                </select>
                            </div>
                        </td>
                    </div>
                    <input id="submit" type="submit" name="upload" class="btn btn-primary" value="Upload">
                    <div style="margin-left: 10px;font-size: 13px;"> <a href="{{  asset('OCS_template.xlsx') }}" download>&nbsp;
                            Download OCS templete</a>&nbsp; OR <a href="{{ asset('GLT_template.xlsx') }}" download>&nbsp;
                                Download GLT templete</a></div>
                </div>
            </form>
            <div style="text-align: center;align-items: center;text-align: center;justify-content: center;"><span
                    class="text-muted"> .xls, .xlsx</span></div>
            <!--  <form method="post" enctype="multipart/form-data" action="{{ url('/import_excel/product') }}">
                                               {{ csrf_field() }}

                                               <input type="submit" name="upload" class="btn btn-primary" value="duplicate">
                                               </form> -->
            <br />

            <table class="table table-striped">
                <tbody id="table">


                    <tr style="background: #36304a;">

                        <th class="th">Order Number</th>
                        <th class="th">Company</th>
                        <th class="th">Domestic AWB</th>
                        <th class="th">AWB invoice</th>
                    </tr>
                    @foreach ($orders as $order)
                        <tr>

                            <td class="td">#{{ $order->order_number }}</td>
                            <td class="td">{{ $order->domestic_company }}</td>
                            <td class="td">{{ $order->domestic_awb }}</td>
                            @if ($order->domestic_company == 'OCS')

                                <td class="td"><a target="blank"
                                        href="http://ship.ocskuwait.com/Home/AWBCommercialInvoice?awbNo={{ $order->domestic_awb }}">Download</a>
                                </td>

                            @else
                                <td class="td">
                                    <form method="POST" action="download_glt" enctype="multipart/form-data">
                                        @csrf
                                        <input name="awb" value="{{ $order->domestic_awb }}" type="text" readonly hidden>
                                        <input id="submit" type="submit" name="download" class="buttonn" value="Download">

                                    </form>

                            @endif







                        </tr>
                    @endforeach
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

        </div>
    </body>
    <script>
        $('#submit').on('click', function() {
            if ($("#company :selected").val() != "") {
                swal({
                    title: "Please wait!",
                    text: " ",
                    closeOnClickOutside: false,
                    button: null,
                    icon: "loader.gif",
                });
            }

        });
        // Add the following code if you want the name of the file appear on select
        $(".custom-file-input").on("change", function() {
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });
    </script>

    </html>
@endsection
