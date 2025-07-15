@extends('layouts.app')
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
@section('content')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
    <style>
        /* ::placeholder {
               color: rgb(12, 12, 12);
                 opacity: 1;
                font-weight: bold;
           } */
        .hidee {
            position: absolute;
            z-index: -1;
        }

        .loader {
            border: 4px solid #f3f3f3;
            border-radius: 50%;
            border-top: 4px solid #cda051;
            width: 30px;
            height: 30px;
            -webkit-animation: spin 2s linear infinite;
            animation: spin 2s linear infinite;
        }

        input:focus {
            color: rgba(0, 0, 0, 0.5);
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
            border-radius: 0px 0px 15px 15px;
            overflow: hidden;
            border-top: hidden;
        }

        .td,
        .th {
            border: 1px solid #c6c6c6;
            text-align: left;
            padding: 8px;
            text-align: center;
            border: none;

        }

        #actions {
            background-color: #dfdfdf;
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

        .popup {
            margin: 70px auto;
            padding: 20px;
            background: #fff;
            border-radius: 5px;
            width: 35%;
            position: relative;
            transition: all 5s ease-in-out;
            height: 85%;
            overflow: auto;
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

        /* .popup .content {
                                                                                        max-height: 45%;
                                                                                        overflow: auto;
                                                                                    } */

        @media screen and (max-width: 700px) {
            .box {
                width: 70%;
            }

            .popup {
                width: 70%;
            }
        }


        #myInput {
            border-radius: 5px;
            font-size: 16px;
            padding: 9px 0px 9px 40px;
            border: 1px solid #ddd;
            margin-bottom: 12px;
        }

        #filters {
            flex: 80;
            margin-top: 15px;
        }

        #filters button {
            color: white;
            cursor: pointer;
            border: 1px solid #dfdfdf;
            padding: 0px 1% 0px 1%;
            height: 44px;
            align-items: center;
            display: flex;
            justify-content: center;
            background-color: transparent;

        }

        #filters button:hover {
            background: #90909040 !important;
        }

        .selected {
            color: #f5c573 !important;
            background: #90909040 !important;
        }

        .checked {
            text-decoration-line: line-through;
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
    {{-- @php
    $previous_order = '';
    @endphp --}}
    <div class="container">
        <h2 style="font-weight: bolder;text-align: center;margin-bottom: 50px;">ERP</h2>
        <div style="margin-top: 10px;">


            <form action="/erp" method="post" id='confirmed_form' enctype="multipart/form-data">
                @csrf

                <div style="display: flex;">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item"> <a class="nav-link active" href="erp" aria-controls="one"
                                aria-selected="true" id="one-tab" style=" font-weight: 600;margin-right: 15px;cursor: pointer;text-align: center;justify-content: center;align-items: center;padding-top: 5px;width: 95px;padding-bottom: 5px;display: flex;border-radius: 15px 15px 0px 0px;background: #36304a; color: white;
                                                                                                
                                @if (Route::current()->getName()=='erp') background:
                                #36304a;
                                color: #ffffff;
                            @else
                                background: #dfdfdf;
                                color: rgb(0, 0, 0); @endif ">
                                Confirmed
                            </a> </li>

                        <li class="nav-item"> <a class="nav-link " href="tst" aria-controls="two"
                                aria-selected="false" id="two-tab" style="font-weight: 600;margin-right: 15px;cursor: pointer;text-align: center;justify-content: center;align-items: center;padding-top: 5px;width: 95px;padding-bottom: 5px;display: flex;border-radius: 15px 15px 0px 0px;

                                     @if (Route::current()->getName()=='tst')
                                background:
                                #36304a;
                                color: #ffffff;
                            @else
                                background: #dfdfdf;
                                color: rgb(0, 0, 0); @endif " >
                                Tst
                            </a> </li>

                        {{-- <li class="nav-item"> <a class="nav-link " href="fct" aria-controls="three"
                                aria-selected="false" id="three-tab" style="font-weight: 600;margin-right: 15px;cursor: pointer;text-align: center;justify-content: center;align-items: center;padding-top: 5px;width: 95px;padding-bottom: 5px;display: flex;border-radius: 15px 15px 0px 0px;
                                                                                            @if (Route::current()->getName() == 'fct') background:#36304a;
                                color: #ffffff;
                            @else
                                background: #dfdfdf;
                                color: rgb(0, 0, 0); @endif " >
                                Fct
                            </a> </li> --}}
                    </ul>

                    <a href="{{ asset('files/template_confirmed.xlsx') }}">download template for confirmed table</a>
                    <b style="margin-left: 15px; margin-right:15px;">or</b> <a
                        href="{{ asset('files/template_tst.xlsx') }}">download template for TST table</a>
                </div>


                <div class="tab-content" id="myTabContent">
                    <div class="filters"
                        style="padding-bottom: 8px;display: flex;border-radius: 0px 0px 0px 0px;background: #36304a;">
                        <div style="flex:20; padding: 15px 0px 0px 15px;" class="position-relative">
                            <i style="font-size: 15px;display: flex;position: absolute;top: 29px;left: 25px;"
                                class="fas fa-search"></i>
                            <input type="text" id="myInput" {{-- onkeyup="myFunction()" --}} placeholder="Search for order.."
                                title="Type a order number">

                        </div>
                        <div id="filters" style="margin-right: 15px;margin-left: 35px; color:#fff; display: flex;">

                            <button name="filter" value='Egypt' type="submit" id="Egypt" style="flex:20;">Egypt</button>
                            <button name="filter" value='Kuwait' type="submit" id="Kuwait" style="flex:20;">kuwait</button>
                            <button name="filter" value='Saudi_Arabia' type="submit" id="Saudi_Arabia"
                                style="flex:20;">KSA</button>
                            <button name="filter" value='Bahrain' type="submit" id="Bahrain"
                                style="flex:20;">Bahrain</button>
                            <button name="filter" value='Oman' type="submit" id="Oman" style="flex:20;">Oman</button>
                            <button name="filter" value='Jordan' type="submit" id="Jordan" style="flex:20;">Jordan</button>
                            <button name="filter" value='Qatar' type="submit" id="Qatar" style="flex:20;">Qatar</button>
                            <button name="filter" value='United_Arab_Emirates' type="submit" id="United_Arab_Emirates"
                                style="flex:20;border-radius: 0px 10px 10px 0px;">UAE</button>


                        </div>

                        <div @if (Route::current()->getName() == 'erp')style="position: absolute; top: 38%; width: 72.3%;" @endif  id="erp" class="tab-pane fade  @if (Route::current()->getName() == 'erp') show active @endif   @if (Route::current()->getName() == 'tst') hidee @endif "
                            role=" tabpanel" aria-labelledby="one-tab">

                            <table class="table table-striped">
                                <tbody id="table">
                                    <tr style="background: #36304a;">
                                        <th class="th">Order Number</th>
                                        <th class="th">$</th>
                                        <th class="th">Currency</th>
                                        {{-- @if (Route::current()->getName() != 'archived') --}}
                                        <th class="th">AWB</th>
                                        {{-- @endif --}}
                                        <th class="th">Last Ation</th>
                                        <th class="th">Actions</th>
                                    </tr>
                                    <tr>
                                        @if (isset($orders))

                                            @for ($z = 0; $z < count($orders); $z++)
                                                {{-- @if ($previous_order == '' || $order->order_number != $previous_order)
                                                @php
                                                    $previous_order = $order->order_number;

                                                @endphp
                                            @endif 
                                            style="@if (isset($confirmed_orders[$z]))  @if (isset($confirmed_orders[$z]->international_awb)) background-color: transparent; font-weight:bold;  border:none; outline-color:#dfdfdf;  margin-left: 60px; @endif    
                                                      @else background-color: transparent;  border:none; outline-color:#dfdfdf; margin-left: 60px;
                                                      @endif " --}}
                                                {{-- {{ dd($orders,$confirmed_orders)}} --}}
                                                <td id="{{ $orders[$z]->order_number }}">{{ $orders[$z]->order_number }}
                                                </td>
                                                <td>{{ $orders[$z]->total_price }} $</td>
                                                <td>{{ $orders[$z]->total_price }} EGP</td>
                                                <td><input value="@if (isset($confirmed_orders[$z]))@if (isset($confirmed_orders[$z]->international_awb)){{ $confirmed_orders[$z]->international_awb }}@endif @endif"
                                                        style="@if (isset($confirmed_orders[$z]->international_awb)) background-color: transparent; font-weight:bold;  border:none; outline-color:#dfdfdf;  margin-left: 60px; @endif  background-color: transparent;  border:none; outline-color:#dfdfdf;  margin-left: 60px; "
                                                        type="text" name="awb" id="awb_{{ $orders[$z]->order_number }}"
                                                        onchange="awbFunc(this)">
                                                </td>
                                                <td><input value="@if (isset($confirmed_orders[$z]))@if (isset($confirmed_orders[$z]->last_action)){{ $confirmed_orders[$z]->last_action }}@endif @endif" style="background-color: transparent;  border:none; outline-color:#dfdfdf;  margin-left: 60px;
                                                    @if (isset($confirmed_orders[$z]->last_action)) font-weight:bold;  background-color: transparent;  border:none; outline-color:#dfdfdf;  margin-left: 60px; @endif" type="text" name="last_action"
                                                        id="lastaction_{{ $orders[$z]->order_number }}"
                                                        onchange="last_actionFunc(this)">
                                                </td>
                                                <td><button>submit</button></td>


                                    </tr>
                                    @endfor
                                    @endif

                                </tbody>
                                @if (session()->has('message'))

                                    <script>
                                        swal("File Imported Successfully")
                                    </script>



                                @endif
                            </table>

                            <div id="action{{-- {{ $order->id }} --}}"
                                style="width: max-content; display: inline-block; margin-left: 55%;" class="row">
                                <button type="submit" id="export" {{-- onclick="preorder(this)" --}} name="action" value="export"
                                    style="letter-spacing: .7px;font-size: 12px;background-color: #36304a;border-color: #36304a;padding-inline: 13px; display: inline-grid; "
                                    class="btn btn-success btn-s">
                                    Export
                                </button>
                                <input type="file" name="file"
                                    accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet " />
                                @error('file')
                                    <script>
                                        swal("Please Enter Your File ")
                                    </script>
                                @enderror
                                <button type="submit" id="import" {{-- onclick="preorder(this)" --}} name="action" value="import"
                                    style="letter-spacing: .7px;font-size: 12px;background-color: #36304a;border-color: #36304a;padding-inline: 13px; display: inline-grid; "
                                    class="btn btn-success btn-s">
                                    Import
                                </button>
                                <button id="submit" onclick='ajaxfunc()' type="button"
                                    style="letter-spacing: .7px;font-size: 12px;background-color: #36304a;border-color: #36304a;padding-inline: 25px; width: max-content; display: inline-block; margin-left: 85%; "
                                    class="btn btn-success btn-s">
                                    Submit
                                </button>


                            </div>
                        </div>
                        {{-- tst card --}}
                        <div @if (Route::current()->getName() == 'tst')
                            style="position: absolute; top: 39%; width: 74%;"
                            @endif id="two" class="tab-pane fade @if (Route::current()->getName() == 'tst')show active @endif   @if (Route::current()->getName() == 'erp') hidee @endif " role="tabpanel"
                            aria-labelledby="two-tab">

                            <table class="table table-striped ">
                                <tbody id="table">
                                    <tr style="background: #36304a;">
                                        <th class="th">Order Number</th>
                                        <th class="th">$</th>
                                        <th class="th">Currency</th>

                                        <th class="th">AWB</th>
                                        <th class="th">LWB</th>
                                        <th class="th">Kshopina Tracking</th>
                                        <th class="th">Domestic company</th>
                                        <th class="th">status</th>


                                        <th class="th">Last Action</th>

                                    </tr>

                                    @if (isset($orderinfo) && isset($tstorders))

                                        @for ($x = 0; $x < count($tstorders); $x++)

                                            <td>{{ $tstorders[$x]->order_number }}</td>
                                            <td>{{ $orderinfo[$x]->total_price }} $</td>
                                            <td>{{ $orderinfo[$x]->total_price }} EGP</td>

                                            <td><input type="text" value="@if (isset($tstorders[$x]->international_awb)){{ $tstorders[$x]->international_awb }} @endif" name="awb2"
                                                    id="awbtst_{{ $tstorders[$x]->order_number }}"
                                                    onchange="awb_tst_func(this)"
                                                    style="@if (isset($tstorders[$x]->international_awb))  background-color: transparent; font-weight:bold; border:none; outline-color:#dfdfdf;    text-align: center; @endif  background-color: transparent; border:none; outline-color:#dfdfdf;    text-align: center; ">
                                            </td>


                                            <td>
                                                <input type="text" value="@if (isset($tstorders[$x]->domestic_awb)){{ $tstorders[$x]->domestic_awb }} @endif" name="lwb"
                                                    id="lwb_{{ $tstorders[$x]->order_number }}"
                                                    onchange="lwb_tst_func(this)"
                                                    style="@if (isset($tstorders[$x]->domestic_awb))  background-color: transparent; font-weight:bold; border:none; outline-color:#dfdfdf;   text-align: center; @endif  background-color: transparent; border:none; outline-color:#dfdfdf;    text-align: center;">


                                            </td>

                                            <td>
                                                <a href="http://"></a>
                                            </td>
                                            <td>
                                                {{-- <input  type="text"   name="lwb"  placeholder=" @if ($orderinfo[$x]->domestic_company) {{ $orderinfo[$x]->domestic_company}} @endif"
                                                style="  background-color: transparent;  border:none; outline-color:#dfdfdf;     text-align: center; "> --}}
                                                <select name="" id="">
                                                    <option value="A"></option>
                                                    <option value="B"></option>
                                                    <option value="C"></option>
                                                    <option value="D"></option>
                                                    <option value="E"></option>
                                                </select>
                                            </td>
                                            <td>
                                                <select id='status_{{ $tstorders[$x]->order_number }}'
                                                    onchange="status_tst_func(this)"
                                                    style="background-color: transparent;  border:none; outline-color:#dfdfdf; margin-left: 60px; ">
                                                    <option @if (isset($tstorders[$x]->status) && $tstorders[$x]->status == 0)
                                                        selected
                                        @endif
                                        value="0"> </option>
                                        <option id='status3_{{ $tstorders[$x]->order_number }}' @if ((isset($tstorders[$x]->status) && $tstorders[$x]->status == 3) || isset($tstorders[$x]->international_awb))
                                            selected
                                            @endif value="3"> Fulfilled </option>
                                        <option id='status1_{{ $tstorders[$x]->order_number }}' @if (isset($tstorders[$x]->status) && $tstorders[$x]->status == 1)
                                            selected
                                            @endif value="1">Refused</option>
                                        <option id='status2_{{ $tstorders[$x]->order_number }}' @if (isset($tstorders[$x]->status) && $tstorders[$x]->status == 2)
                                            selected
                                            @endif value="2">Dispatched</option>
                                        <option id='status4_{{ $tstorders[$x]->order_number }}' @if (isset($tstorders[$x]->status) && $tstorders[$x]->status == 4)
                                            selected
                                            @endif value="4">In Airport</option>
                                        <option id='status5_{{ $tstorders[$x]->order_number }}' @if (isset($tstorders[$x]->status) && $tstorders[$x]->status == 5)
                                            selected
                                            @endif value="5">In Warehouse</option>
                                        <option id='status6_{{ $tstorders[$x]->order_number }}' @if (isset($tstorders[$x]->status) && $tstorders[$x]->status == 6)
                                            selected
                                            @endif value="6">Out For Delivery</option>
                                        </select>

                                        </td>
                                        <td> <input type="text" value="@if (isset($tstorders[$x]->last_action)){{ $tstorders[$x]->last_action }}@endif" name="last_action"
                                                id="last-action_{{ $tstorders[$x]->order_number }}"
                                                onchange="last_action_tst_func(this)"
                                                style=" @if (isset($tstorders[$x]->last_action)) background-color: transparent;  border:none; font-weight:bold; outline-color:#dfdfdf;     text-align: center; @endif  background-color: transparent; border:none; outline-color:#dfdfdf;    text-align: center; ">
                                        </td>
                                        </tr>

                                        {{-- @endforeach --}}
                                        {{-- @endforeach --}}
                                    @endfor
                                    @endif

                                </tbody>
                                @if (session()->has('message'))

                                    <script>
                                        swal("File Imported Successfully")
                                    </script>



                                @endif
                            </table>
                            <div id="action" style="width: max-content; display: inline-block; margin-left: 50%;"
                                class="row">
                                <button type="submit" id="export-two" {{-- onclick="preorder(this)" --}} name="action"
                                    value="export-two"
                                    style="letter-spacing: .7px;font-size: 12px;background-color: #36304a;border-color: #36304a;padding-inline: 13px; display: inline-grid; "
                                    class="btn btn-success btn-s">
                                    Export
                                </button>
                                <input type="file" name="file-two"
                                    accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet " />
                                @error('file-two')
                                    <script>
                                        swal("Please Enter Your File ")
                                    </script>
                                @enderror
                                <button type="submit" id="import-two" {{-- onclick="preorder(this)" --}} name="action"
                                    value="import-two"
                                    style="letter-spacing: .7px;font-size: 12px;background-color: #36304a;border-color: #36304a;padding-inline: 13px; display: inline-grid; "
                                    class="btn btn-success btn-s">
                                    Import
                                </button>
                                <button id="submit_two" onclick='ajaxfunc_2()' type="button"
                                    style="letter-spacing: .7px;font-size: 12px;background-color: #36304a;border-color: #36304a;padding-inline: 25px; width: max-content; display: inline-block; margin-left: 85%; "
                                    class="btn btn-success btn-s">
                                    Submit
                                </button>
                            </div>

                        </div>
                        {{-- fct card --}}
                        {{-- <div id="three" class="tab-pane fade  @if (Route::current()->getName() == 'fct') show active @endif" role="tabpanel"
                        aria-labelledby="three-tab">
                        <table class="table table-striped ">
                            <tbody id="table">
                                <tr style="background: #36304a;">
                                    <th class="th">Order Number</th>
                                    <th class="th">phone number</th>
                                    <th class="th">LWB</th>

                                    <th class="th">last status</th>


                                    <th class="th">Last update</th>

                                </tr>

                                @if (isset($refusedorderinfo) && isset($fctorders) && isset($fctinfo))

                                    @for ($y = 0; $y < count($fctinfo); $y++)
                                        <tr>

                                            <td>{{ $fctinfo[$y]->order_number }}</td>
                                            <td>{{ $refusedorderinfo[$y]->phone_number }}</td>

                                            <td ><input  type="text" placeholder=" @if ($fctorders[$y]->lwb) {{ $fctorders[$y]->lwb }} @endif"  name="lwb2" id="lwbfct_{{ $fctorders[$y]->order_number }}"   onchange="lwb_fct_func(this)"
                                                style="background-color: transparent;  border:none; outline-color:#dfdfdf; margin-left: 60px; "> </td>
                                            <td > <input  type="text" placeholder=" @if ($fctinfo[$y]->last_status) {{ $fctinfo[$y]->last_status }} @endif"  name="last_status_fct" id="laststatusfct_{{ $fctorders[$y]->order_number }}"   onchange="last_status_fct_func(this)"
                                                style="background-color: transparent;  border:none; outline-color:#dfdfdf; margin-left: 60px; "></td>
                                            <td>
                                                <input   placeholder=" @if ($fctinfo[$y]->last_update) {{$fctinfo[$y]->last_update }} @endif" type="text" name="last_update_fct" id="lastupdatefct_{{ $fctorders[$y]->order_number }}" onchange="lastupdate_fct_func(this)"
                                                style="background-color: transparent;  border:none; outline-color:#dfdfdf; margin-left: 60px; ">
                                            </td>

                                        </tr>

                                    @endfor
                                @endif



                            </tbody>
                            @if (session()->has('message'))

                                 <script>swal("File Imported Successfully")</script>


                        @endif
                        </table>
                        <div id="action"
                            style="width: max-content; display: inline-block; margin-left: 50%;" class="row">
                            <button type="submit" id="export-three"  name="action"
                                value="export-three"
                                style="letter-spacing: .7px;font-size: 12px;background-color: #36304a;border-color: #36304a;padding-inline: 13px; display: inline-grid; "
                                class="btn btn-success btn-s">
                                Export
                            </button>
                            <input type="file" name="file-three"
                                accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet " />
                                @error('file-three')
                        <script>swal("Please Enter Your File ")</script>
                    @enderror
                            <button type="submit" id="import-three"  name="action"
                                value="import-three"
                                style="letter-spacing: .7px;font-size: 12px;background-color: #36304a;border-color: #36304a;padding-inline: 13px; display: inline-grid; "
                                class="btn btn-success btn-s">
                                Import
                            </button>
                            <button id="submit_three" onclick='ajaxfunc_3()' type="button"
                                style="letter-spacing: .7px;font-size: 12px;background-color: #36304a;border-color: #36304a;padding-inline: 25px; width: max-content; display: inline-block; margin-left: 85%; "
                                class="btn btn-success btn-s">
                                Submit
                            </button>
                        </div>
                    </div> --}}





                    </div>
            </form>

            {{-- Elli bt active alcards --}}
            {{-- <div class="pagination">
         <a href="#">&laquo;</a>
         <?php
         $orders_per_page = 15;
         $pages = ceil($number_of_orders[0]->NumberOfOrders / $orders_per_page);
         ?> --}}
            {{-- @for ($i = 1; $i <= $pages; $i++)
            @if ($_GET['page'] == $i)
                @if (isset($_GET['filter']))

                    <a class='active'
                        href="?store={{$_GET['store']}}&page={{ $i }}&filter={{ $_GET['filter'] }}">{{ $i }}</a>

                @else
                    <a class='active' href="?store={{$_GET['store']}}&page={{ $i }}&filter=All">{{ $i }}</a>
                @endif
            @else
                @if (isset($_GET['filter']))
                    <a href="?store={{$_GET['store']}}&page={{ $i }}&filter={{ $_GET['filter'] }}">{{ $i }}</a>


                @else
                    <a href="?store={{$_GET['store']}}&page={{ $i }}&filter=All">{{ $i }}</a>
                @endif

            @endif


        @endfor --}}

            {{-- <a href="#" class="active">1</a>
        <a href="#">2</a>
        <a href="#">3</a>
        <a href="#">4</a>
        <a href="#">5</a>
        <a href="#">6</a> --}}
            {{-- <a href="#">&raquo;</a>
    </div> --}}



        </div>

    @endsection
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> --}}
    {{-- <script>
    $('#message').delay(5000).fadeOut('slow');
   </script> --}}
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    {{-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script> $('#message').delay(5000).fadeOut('slow');</script> --}}
    {{-- <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
@if (session()->has('message'))
 {{ swal({
     text: "Hello world!",
   }); }} --}}
    {{-- {{ session()->get('message') }} --}}

    {{-- @endif --}}

    <script type="text/javascript">
        // CONFIRMED TABLE
        /*  var awb = [];

         var last_action = []; */
        /* const confirmed_table = new Object(); */
        var confirmed_table = [];
        var confirmed_table_data = [];

        function awbFunc(element) {
            var awb_id = element.id;
            var awb_value = element.value;


            confirmed_table.push(awb_id);

        }

        function last_actionFunc(element) {
            var last_action_id = element.id;



            var las_action_value = element.value;
            confirmed_table.push(last_action_id);

        }


        console.log(confirmed_table);

        function ajaxfunc() {


            confirmed_table.forEach(element => {

                if (element.startsWith('awb')) {
                    var awb = document.getElementById(element).value;
                    var order_number = element.substring(element.indexOf("_") + 1);
                    var index;
                    if (confirmed_table_data.some(function(elem, i) {
                            return elem.order_number === order_number && ~(index = i);
                        })) {
                        confirmed_table_data[index].awb = awb;
                    } else {
                        confirmed_table_data.push({
                            order_number: order_number,
                            awb: awb,


                        });
                    }
                }
                if (element.startsWith('lastaction')) {
                    var last_action = document.getElementById(element).value;
                    var order_number = element.substring(element.indexOf("_") + 1);
                    var index;

                    /* console.log(result,index); */

                    if (confirmed_table_data.some(function(elem, i) {
                            return elem.order_number === order_number && ~(index = i);
                        })) {
                        confirmed_table_data[index].last_action = last_action;
                    } else {
                        confirmed_table_data.push({
                            order_number: order_number,

                            last_action: last_action
                        });
                    }


                }

            })
            console.log(confirmed_table_data);


0
            $.ajax({
                url: "submit_tst",
                type: 'POST',
                data: {
                    _token: "{{ csrf_token() }}",
                    confirmed_table_data: confirmed_table_data

                },
                success: function() {
                    location.reload(true);
                    swal("You Submited Successfully");
                }
            });
        };


        // TST TABLE
        var tst_table = [];
        var tst_table_data = [];


        function awb_tst_func(element) {
            var awb_id = element.id;
            var awb_value = element.value;

            tst_table.push(awb_id);
        }
        console.log(tst_table);

        function lwb_tst_func(element) {
            var lwb_id = element.id;
            var lwb_value = element.value;

            tst_table.push(lwb_id);
        }
        console.log(tst_table);

        function status_tst_func(element) {
            var status_id = element.id;
            var status_value = element.value;
            tst_table.push(status_id);
            if (status_value == 1) {
                var reason = prompt("Please enter your the reason", "");
                if (reason.length > 99) {
                    swal("max length is 100 characters only");
                }

                tst_table.push('reason=' + status_id + '-' + reason);
            } else {
                tst_table.push('reason=' + status_id + '- ');
            }


        }
        console.log(tst_table);

        function last_action_tst_func(element) {
            var last_action_id = element.id;
            var last_action_value = element.value;
            tst_table.push(last_action_id);
        }
        console.log(tst_table);

        function ajaxfunc_2() {



            tst_table.forEach(element => {

                if (element.startsWith('awbtst')) {
                    var awb = document.getElementById(element).value;
                    var order_number = element.substring(element.indexOf("_") + 1);
                    var index;


                    if (tst_table_data.some(function(elem, i) {

                            return elem.order_number === order_number && ~(index = i);
                        })) {
                        tst_table_data[index].awb = awb;
                    } else {
                        tst_table_data.push({
                            order_number: order_number,
                            awb: awb
                            /*  lwb:'',
                             status:'',
                             last_action:'',
                             reason:''   */
                        });
                    }
                }

                if (element.startsWith('lwb')) {
                    var lwb = document.getElementById(element).value;
                    var order_number = element.substring(element.indexOf("_") + 1);
                    var index;


                    if (tst_table_data.some(function(elem, i) {
                            return elem.order_number === order_number && ~(index = i);
                        })) {
                        tst_table_data[index].lwb = lwb;
                    } else {
                        tst_table_data.push({
                            order_number: order_number,
                            /*    awb: '', */
                            lwb: lwb
                            /*   status:'',
                              last_action:'',
                              reason:''  */
                        });
                    }
                }


                if (element.startsWith('status')) {
                    var status = document.getElementById(element).value;
                    var order_number = element.substring(element.indexOf("_") + 1);
                    var index;


                    if (tst_table_data.some(function(elem, i) {
                            return elem.order_number === order_number && ~(index = i);
                        })) {
                        tst_table_data[index].status = status;
                    } else {
                        tst_table_data.push({
                            order_number: order_number,
                            /*  awb: '',
                             lwb : '', */
                            status: status
                            /*   last_action:'',
                              reason:''   */
                        });
                    }
                }


                if (element.startsWith('last-action')) {
                    var last_action = document.getElementById(element).value;
                    var order_number = element.substring(element.indexOf("_") + 1);

                    var index;


                    if (tst_table_data.some(function(elem, i) {
                            return elem.order_number === order_number && ~(index = i);
                        })) {
                        tst_table_data[index].last_action = last_action;
                    } else {
                        tst_table_data.push({
                            order_number: order_number,
                            /*   awb: '',
                              lwb : '',
                              status:'', */
                            last_action: last_action
                            /*  reason:''   */
                        });
                    }
                }
                if (element.startsWith('reason')) {
                    var reason = element.substring(element.indexOf("-") + 1);
                    var order_number = element.substring(element.indexOf("_") + 1);
                    order_number = order_number.split("-")[0];

                    var index;


                    if (tst_table_data.some(function(elem, i) {
                            return elem.order_number === order_number && ~(index = i);
                        })) {
                        tst_table_data[index].reason = reason;
                    } else {
                        tst_table_data.push({
                            order_number: order_number,
                            /*        awb: '',
                                   lwb : '',
                                   status:'',
                                   last_action:'', */
                            reason: reason
                        });
                    }
                }







            })
            console.log(tst_table_data);








            $.ajax({
                url: "tstt",
                type: 'POST',
                data: {
                    _token: "{{ csrf_token() }}",
                    tst_table_data: tst_table_data
                },
                success: function() {
                    location.reload(true);
                    swal("You Submited Successfully");
                }
            });
        };


        /// FCT TABLE
        var fct_table = [];
        var fct_table_data = [];

        function lwb_fct_func(element) {
            var lwb_id = element.id;
            var lwb_value = element.value;

            fct_table.push(lwb_id);

        }

        function lastupdate_fct_func(element) {
            var last_update_id = element.id;
            var last_update_value = element.value;



            fct_table.push(last_update_id);
        }

        function last_status_fct_func(element) {
            var last_status_id = element.id;
            var last_status_value = element.value;

            fct_table.push(last_status_id);


        }
        console.log(fct_table);

        function ajaxfunc_3() {


            fct_table.forEach(element => {

                if (element.startsWith('lwbfct')) {
                    var lwb = document.getElementById(element).value;
                    var order_number = element.substring(element.indexOf("_") + 1);
                    var index;


                    if (fct_table_data.some(function(elem, i) {

                            return elem.order_number === order_number && ~(index = i);
                        })) {
                        fct_table_data[index].lwb = lwb;
                    } else {
                        fct_table_data.push({
                            order_number: order_number,
                            lwb: lwb,
                            /*  last_status:'',
                             last_update:''   */
                        });
                    }
                }

                if (element.startsWith('laststatusfct')) {
                    var last_status = document.getElementById(element).value;
                    var order_number = element.substring(element.indexOf("_") + 1);
                    var index;


                    if (fct_table_data.some(function(elem, i) {

                            return elem.order_number === order_number && ~(index = i);
                        })) {
                        fct_table_data[index].last_status = last_status;
                    } else {
                        fct_table_data.push({
                            order_number: order_number,
                            /*  lwb:'', */
                            last_status: last_status
                            /*  last_update:''  */
                        });
                    }
                }

                if (element.startsWith('lastupdate')) {

                    var last_update = document.getElementById(element).value;

                    var order_number = element.substring(element.indexOf("_") + 1);
                    var index;


                    if (fct_table_data.some(function(elem, i) {

                            return elem.order_number === order_number && ~(index = i);
                        })) {
                        fct_table_data[index].last_update = last_update;
                    } else {
                        fct_table_data.push({
                            order_number: order_number,
                            /*    lwb:'',
                               last_status:'' , */
                            last_update: last_update
                        });
                    }
                }
            });
            console.log(fct_table_data);
            $.ajax({
                url: "fctt",
                type: 'POST',
                data: {
                    _token: "{{ csrf_token() }}",
                    fct_table_data: fct_table_data

                },
                success: function() {
                    location.reload(true);
                    swal("You Submited Successfully");

                }
            });
        };
    </script>
