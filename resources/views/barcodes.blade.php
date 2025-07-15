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

        .th {
            color: white;

        }

        tr {
            background-color: #f9f9f9;
        }

        .td {
            padding: 0.87rem !important;
            white-space: nowrap;
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

        .search-item:hover {
            color: transparent !important;
            text-decoration: none !important;
        }

        .sub_btn {
            background: transparent;
            border: none;
            width: 100%;
            text-align: left;
        }

        .search-result:hover {
            opacity: .5;
        }

    </style>
    <style>
        .tasks_popup {
            margin: 70px auto;
            padding: 20px;
            background: #fff;
            border-radius: 5px;
            width: 50%;
            position: relative;
            transition: all 5s ease-in-out;
            height: 88%;
            overflow: auto;
        }

        .tasks_popup .closee {
            position: absolute;
            top: 20px;
            right: 30px;
            transition: all 200ms;
            font-size: 30px;
            font-weight: bold;
            text-decoration: none;
            color: #333;
        }

        .content form .user-details {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            margin: 20px 0 12px 0;
        }

        form .user-details .input-box {
            margin-bottom: 15px;
            width: calc(100% / 2 - 20px);
        }

        form .input-box span.details {
            display: block;
            font-weight: 600;
            margin-bottom: 5px;
        }

        .user-details .input-box input,
        .user-details .input-box textarea {
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

        form .gender-details .gender-title {
            font-size: 20px;
            font-weight: 600;
        }

        form .category {
            display: flex;
            width: 80%;
            margin: 14px 0;
            justify-content: space-between;
        }

        form .category label {
            display: flex;
            align-items: center;
            cursor: pointer;
        }

        form .category label .dot {
            height: 18px;
            width: 18px;
            border-radius: 50%;
            margin-right: 10px;
            background: #d9d9d9;
            border: 5px solid transparent;
            transition: all 0.3s ease;
        }

        #dot-1:checked~.category label .one,
        #dot-2:checked~.category label .two,
        #dot-3:checked~.category label .three {
            background: #CA9B49;
            border-color: #d9d9d9;
        }

        form input[type="radio"] {
            display: none;
        }

        form .button {
            height: 45px;
            margin: 35px 0
        }

        form .button input {
            height: 100%;
            width: 100%;
            border-radius: 5px;
            border: none;
            color: #fff;
            font-size: 18px;
            font-weight: 500;
            letter-spacing: 1px;
            cursor: pointer;
            transition: all 0.3s ease;
            background: linear-gradient(135deg, #5f5386, #CA9B49);
        }

        form .button textarea {
            height: 100%;
            width: 100%;
            border-radius: 5px;
            border: none;
            color: #fff;
            font-size: 18px;
            font-weight: 500;
            letter-spacing: 1px;
            cursor: pointer;
            transition: all 0.3s ease;
            background: linear-gradient(135deg, #5f5386, #CA9B49);
        }

        form .button input:hover {
            /* transform: scale(0.99); */
            background: linear-gradient(135deg, #36304a, #CA9B49);
        }

        form .button textarea:hover {
            /* transform: scale(0.99); */
            background: linear-gradient(135deg, #36304a, #CA9B49);
        }

        @media(max-width: 584px) {
            .container {
                max-width: 100%;
            }

            form .user-details .input-box {
                margin-bottom: 15px;
                width: 100%;
            }

            form .category {
                width: 100%;
            }

            .content form .user-details {
                max-height: 300px;
                overflow-y: scroll;
            }

            .user-details::-webkit-scrollbar {
                width: 5px;
            }
        }

        @media(max-width: 459px) {
            .container .content .category {
                flex-direction: column;
            }
        }

    </style>

    <div class="container">

        <div style="margin-top: 10px;">

            @if ($message = Session::get('message'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ $message }}</strong>
                </div>
            @elseif ($message = Session::get('error'))
                <div class="alert alert-danger alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ $message }}</strong>
                </div>
            @endif
            <form id="barcode_form">
                @csrf
                <input type="text" name="barcode" id="barcode">


            </form>

            <table class="table table-striped">
                <tbody id="table">


                    <tr style="background: #36304a;">
                        <th class="th">shipment_id</th>

                        <th class="th">Order Number</th>



                    </tr>
                    
                </tbody>
            </table>

        </div>

    </div>


    <script>
        document.getElementById("barcode").focus();

        $("#barcode_form").submit(function(e) {
            e.preventDefault();
            var html="";

            ajaxx = $.ajax({
                    url: "scan_barcode",
                    type: 'POST',
                    data: {
                        _token: "{{ csrf_token() }}",
                        barcode: $('#barcode').val()
                    },
                    complete: function() {
                        /*  $("#arrow_id" + order_number).html(
                             '<i onclick="create_task(this)" id="assign_' + order_number +
                             '"class="fas fa-chevron-right"></i>'
                         ); */
                    },
                    success: function(response) {

                        $('#barcode').val('');

                        html +=
                            '<tr><td class="td">'+response[0]['shipment_id']+'</td><td class="td">'+response[0]['order_number'] +'</td></tr>';

                        /* response.forEach(element => {
                            users[element.id] = element.name;

                            html += '<option value="' + element.id + '">' + element
                                .name +
                                '</option>'
                        }); */
                        document.getElementById('table').innerHTML += html;
/*                         $('#table').innerHTML += html;
 */

                    }
                });


        });

        function create_task(elemant) {
            order_number = elemant.id.substring(elemant.id.indexOf("_") + 1);
            data = elemant.id.substring(0, elemant.id.indexOf("_"));
            var html = "";


            $(elemant.parentElement).html(
                '<div style="height:20px; width:20px;" class="loader"></div>'
            );

            try {
                ajaxx.abort();
            } catch (error) {

            }
            if (Object.keys(users).length == 0) {
                setTimeout(function() {

                    ajaxx = $.ajax({
                        url: "get_users",
                        type: 'POST',
                        data: {
                            _token: "{{ csrf_token() }}",
                        },
                        complete: function() {
                            $("#arrow_id" + order_number).html(
                                '<i onclick="create_task(this)" id="assign_' + order_number +
                                '"class="fas fa-chevron-right"></i>'
                            );
                        },
                        success: function(response) {
                            html +=
                                '<option value="" selected disabled hidden>Select the colleague</option>';
                            response.forEach(element => {
                                users[element.id] = element.name;

                                html += '<option value="' + element.id + '">' + element.name +
                                    '</option>'
                            });


                            $('#assign_to').html(html);

                            $('#order_number').val(order_number);

                            $('#tasks_popup').show();
                        }
                    });
                }, 10);
            } else {

                var users_key = Object.keys(users);
                html += '<option value="" selected disabled hidden>Select the colleague</option>';

                for (let i = 0; i < Object.keys(users).length; i++) {
                    html += '<option value="' + users_key[i] + '">' + users[users_key[i]] +
                        '</option>'

                }
                $('#assign_to').html(html);

                $('#order_number').val(order_number);

                $('#tasks_popup').show();

                $("#arrow_id" + order_number).html('<i onclick="create_task(this)" id="assign_' + order_number +
                    '"class="fas fa-chevron-right"></i>');
            }


        }

        $(document).ready(function() {
            $("#assign_form").on("submit", function() {
                $('#assign_submit').html(
                    '<div id="assign_submit" style="align-items: center;justify-content: center;display: flex"><div class="loader"></div></div>'
                );
            }); //submit
        });
    </script>
@endsection
