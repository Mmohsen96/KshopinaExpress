<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Group Order Form</title>

    <link rel="icon" type="image/png" href="{{ asset('mini_yellow.png') }}" style="font-size: 2rem;">

    <link rel="shortcut icon"
        href="https://www.google.com/url?sa=i&url=https%3A%2F%2Far.wikipedia.org%2Fwiki%2F%25D9%2585%25D9%2584%25D9%2581%3ACircle-icons-computer.svg&psig=AOvVaw3O-ulCnXwWQPXHwnIAYu6z&ust=1647502755709000&source=images&cd=vfe&ved=0CAsQjRxqFwoTCOi1wpaQyvYCFQAAAAAdAAAAABAD">

    <link rel="icon"
        href="https://www.google.com/url?sa=i&url=https%3A%2F%2Far.wikipedia.org%2Fwiki%2F%25D9%2585%25D9%2584%25D9%2581%3ACircle-icons-computer.svg&psig=AOvVaw3O-ulCnXwWQPXHwnIAYu6z&ust=1647502755709000&source=images&cd=vfe&ved=0CAsQjRxqFwoTCOi1wpaQyvYCFQAAAAAdAAAAABAD">


    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/v4-shims.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.css') }}">


    <link href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>

    <script src="{{ asset('js/bootstrap.js') }}"></script>


    <script src="{{ asset('js/sweetalert2.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('js/sweetalert2.min.css') }}">    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

</head>

<style>
    .entry:not(:first-of-type) {
        margin-top: 10px;
    }

    .glyphicon {
        font-size: 12px;
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
        background-color: #ffffff;
    }
                                                                                                                                                                                                                                                               } */


    #myInput {
        border-radius: 6px;
        font-size: 16px;
        padding: 9px 0px 9px 40px;
        border: 1px solid #1b3425;
        background-color: #ffffff;
    }

    #myInput:focus-visible {
        border: 1px solid #c2a264;
        outline: none;
    }

    #filters {
        flex: 80;
        margin-top: 15px;
    }

    #filters button {
        color: #1b3425 cursor: pointer;
        border: 1px solid #1b3425;
        border-right: 0px;
        padding: 0px 1% 0px 1%;
        height: 44px;
        align-items: center;
        display: flex;
        justify-content: center;
        background-color: transparent;
        background-color: white;

    }

    #filters button:hover {
        background: #1b3425 !important;
        color: white;
    }

    .selected {
        color: white !important;
        background-color: #1b3425 !important;

    }

    .checked {
        text-decoration-line: line-through;
    }



    .stati {
        align-items: center;
        background: white;
        color: #1b3425;
        height: 6em;
        border: 1px solid #1b34253d;
        border-radius: 0px 0px 8px 8px;
        margin: 1em 0;
        -webkit-transition: margin 0.5s ease, box-shadow 0.5s ease;
        transition: margin 0.5s ease, box-shadow 0.5s ease;

    }

    .stati:hover {
        margin-top: 0.5em;

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
        background-color: #1b3425;
        color: white;
    }

    .font-style {
        font-family: 'Bebas Neue', cursive !important;
        font-size: 18px;
        letter-spacing: 3px;
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

    .group_popup {
        margin: 30px auto;
        padding: 10px;
        background: #fff;
        border-radius: 5px;
        width: 50%;
        border: solid 0.1px #1b3425;
        position: relative;
        transition: all 5s ease-in-out;
    }


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

    .tasks_popup .closee,
    .group_popup .closee {
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

    form .user-details .input-box,
    .group_input {
        margin-bottom: 15px;
        width: calc(100% / 2 - 20px);
    }

    form .input-box span.details {
        display: block;
        font-weight: 600;
        margin-bottom: 5px;
    }

    .user-details .input-box input,
    .user-details .input-box textarea,
    .group_input_style {
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
        background: linear-gradient(135deg, #1B3425, #CA9B49);
    }

    form .button textarea:hover {
        /* transform: scale(0.99); */
        background: linear-gradient(135deg, #1B3425, #CA9B49);
    }

    @media(max-width: 584px) {
        .container {
            max-width: 100%;
        }

        form .user-details .input-box,
        .group_input {
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

<style>

    html,
    body {
        display: table;
        height: 100%;
        width: 100%;
        background-color: #1b3425;
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
    .email-form {
        display: inline-block;

    }

    .pseudo-search {
        display: flex;
        border: 2px solid #ccc;
        border-radius: 100px;

        transition: background-color 0.5 ease-in-out;
    }

    .pseudo-search input {
        border: 0;
        background-color: transparent;
        width: 180px;
        padding-left: 10px;
    }

    .pseudo-search input:focus {
        outline: none;
    }

    .pseudo-search button,
    .pseudo-search i {
        border: none;
        background: none;
        cursor: pointer;
    }

    .pseudo-search select {
        border: none;
    }

    .email_btn {
        border-left: 2px solid #cccccc !important;
        color: green;
    }

    .pseudo-search input::placeholder {
        font-size: 14px;
    }

    .btn:focus {
        box-shadow: none !important;
    }
</style>

<style>
    /* width */
    ::-webkit-scrollbar {
    width: 5px;
    }

    /* Track */
    ::-webkit-scrollbar-track {
    box-shadow: inset 0 0 5px grey;
    border-radius: 10px;
    }

    /* Handle */
    ::-webkit-scrollbar-thumb {
        background: #cb9d48;
        border-radius: 5px;
    }

    /* Handle on hover */
    ::-webkit-scrollbar-thumb:hover {
    background: #cb9d48;
    }
</style>

<style>
    .logo{
        width: 23%;
    }

    .form-control:focus{
        border-color: #cc9b48;
        box-shadow:none;
    }
</style>

<style>
    .product_titles{
        font-weight: 600;
        padding: 0px 0px 10px 3px;
        flex-wrap: nowrap;
        align-items: center;
        margin:0px;
        font-size: 18px;
    }
    .product_input{
        height: 38px;
        font-size: 16px;
    }
    .input_field{
        margin-bottom: 0px;
        font-size:18px;
    }
    .product_title_name{
        flex: .58;
    }
    .product_title_price{
        flex: .23;
    }
    .product_title_qty{
        flex: .26;
    }
    .product_price{
        flex: .3;
        background-color: #eef0f2;
    }
    .product_qty{
        flex: .3;
    }
    .first_div{
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        margin: 45px 0 12px 0;
    }
    @media screen and (max-width: 991px){
        .logo {
            width: 25%;
        }
        .product_titles{
            font-size: 16px;
        }
        .product_input{
            font-size: 14px;
        }
        .input_field {
            font-size: 16px;
        }
        .group_input_style{
            padding-left: 10px;
            font-size: 14px;
        }
    }
    @media screen and (max-width: 768px){
        .group_popup {
            width: 80%;
        }
        .logo {
            width: 29%;
        }
        .product_titles{
            font-size: 13px;
        }
        .product_input{
            font-size: 13px;
        }
        .input_field {
            font-size: 12px;
        }
        .product_title_name{
            flex: .5;
        }
        .group_input_style{
            font-size: 12px;
        }

    }
    @media screen and (max-width: 576px){
        .product_select {
            flex: none !important;
        }
        .product_price ,
        .product_qty{
            flex: .5 !important;
        }
    
        .logo {
            width: 40%;
        }
        .product_titles{
            display: none;
        }
        .product_select{
        width: 100% !important;
        }
        
        .first_div{
            margin: 25px 0 25px 0;
        }
        form .input-box span.details{
            margin-bottom: 10px;
            margin-top: 10px;
        }
    }
    @media screen and (max-width: 400px){
        
        .logo {
            width: 50%;
        }
        .product_input {
            font-size: 11px;
        }
        .input_field {
            font-size: 10px;
        }
        .group_input_style {
            font-size: 10px;
        }
    }
    @media screen and (max-width: 300px){
        .group_popup {
            width: 80%;
        }
    }
</style>

<body style="display: flex;justify-content: center;align-items: center;">
    <div class="group_popup">
        <div class="container">
            <div style="margin-top: 15px;" class="title">
                <img  src="{{ asset('background-white.png') }}" class="logo"
                    alt="">
            </div>
        </div>
    
        <div style="margin-top: 40px;" class="container content">
            <form action="create_group_order" method="post" enctype="multipart/form-data">
                @csrf
    
                <div class="dynamic-wrap">
                    <div class="row entry input-group product_titles">
                        <span  class="product_title_name">Product Name</span>
                        <span  class="product_title_price">EGP</span>
                        <span  class="product_title_qty">QTY</span>
                    </div>
                    <div class="products_form">
                        <div class="entry input-group">
    
                            <select style="flex: .6;" onchange="product_selected(this)"  class="form-control product_input product_select" name="product[]" id="product"
                            class="details" placeholder="product" required>
                                <option  value="" selected disabled hidden>Select the product</option>
                                @foreach ($products as $item)
    
                                <option  value="{{$item->product_id}}" >{{$item->product_title}}</option>
    
                                @endforeach
                                
                            </select required>
    
                            <input style="flex: .2;"  class="price form-control product_input product_price" type="text" name="price[]" placeholder="Price" required readonly>


                                     
                            <input style="flex: .2;"  class="qty form-control product_input product_qty" type="number" name="qty[]"
                            placeholder="QTY" onchange="price_changed(0)" required>
    
                            <span class="input-group-btn product_input">
                                <button class="btn btn-success btn-add" style="height: 100%;" type="button">
                                    <i style="font-size: 14px;" class="fas fa-plus"></i>
                                </button>
                            </span>
                        </div>
                    </div>
    
                </div>
                <hr>
                <div  class="row first_div">
                    <div  class="group_input input-box input_field ">
                        <span class="details">Name</span>
    
                        <input style="height: 40px" class="group_input_style" type="text" name="customer_name" placeholder="Customer name" required>
    
                    </div>
                    <div  class="group_input input-box input_field ">
                        <span class="details">Email</span>
    
                        <input style="height: 40px" class="group_input_style" type="email" name="email" value="@gmail.com" placeholder="Email" required>
    
                    </div>
    
                </div>
                <div style="display: flex;flex-wrap: wrap;justify-content: space-between;margin: 0px 0 12px 0;" class="row ">
                    <div  class="group_input input-box input_field" >
                        <span class="details">Contact number</span>
    
                        <input style="height: 40px" class="group_input_style" type="text" name="phone" placeholder="Customer phone number" minlength="11" maxlength="11" required>
    
                    </div>
                    <div  class="group_input input-box input_field ">
                        <span class="details">Address</span>
    
                        <input style="height: 40px" class="group_input_style" type="text" name="address" placeholder="Address" required>
    
                    </div>
    
                </div>
                <div style="display: flex;flex-wrap: wrap;justify-content: space-between;margin: 0px 0 12px 0;" class="row ">
                    <div  class="group_input input-box input_field ">
                        <span class="details">Cities</span>
    
                        <select style="height: 40px" onchange="city_selected(this)" class="group_input_style" name="city" id="city"
                        class="details" placeholder="city" required>
                        <option  value="" selected disabled hidden>Select the City</option>
                        @foreach ($zones as $city)
                                
                                <option value="{{$city->id}}" >{{$city->city}}</option>
    
                                @endforeach
                        </select>
    
                    </div>
    
                    <div  class="group_input input-box input_field ">
                        <span class="details">Shipping rate</span>

                        <input style="height: 40px;background-color: #eef0f2;" class="group_input_style" type="text" name="rate" id="rate" readonly>

                    </div>
                </div>
    
                <hr style="border-top: 2px solid rgb(27 52 37 / 58%);">
                <div  class="row first_div ">
                    
                    <div  class="group_input input-box input_field ">
                        <span class="details">Final price</span>

                        <input style="height: 40px;background-color: #eef0f2;" class="group_input_style" type="text" name="final_price" id="final_price"
                            value="0" readonly>

                    </div>
                </div>

                <div style="display: flex;flex-wrap: wrap;justify-content:flex-end;margin: 15px 0 12px 0;">
                    <button type="submit"   id="group_order_submit"
                        style="margin-right: 1rem;height: 80%;border-radius: 15px;font-family: 'Bebas Neue', cursive;font-size: 17px;letter-spacing: 2px;font-weight: 600;padding: 7px 30px 5px 30px;"
                        class="btn btn-primary">
                        Submit
                    </button>
                </div>
            </form>
    
        </div>
    
        @if(Session::has('success'))
            <script type="text/javascript">
                Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Your Order has been submited',
                        showConfirmButton: false,
                        timer: 1500
                });
            </script>
        @endif
    </div>
</body>


<script>
    var products=[];
    var cities=[];

    /* document.querySelector("#product").addEventListener("change", product_selected ); */

    function product_selected(element) {

        if (products.length == 0) {
            $.ajax({
                    url: "get_active_group_products",
                    type: "get",
                    data: {
                        _token: "{{ csrf_token() }}",
                    },
                    success: function(response) {
                        products = response;

                        response.forEach(product => {
                            if (product['product_id'] == element.value) {

                                $(element).next().val(product['price']);
                                return true;
                            }
                            
                        });
                        price_changed(0);

                    },
                    error: function(xhr) {
                        //Do Something to handle error
                    }

                });
        } else {
            products.forEach(product => {
                            if (product['product_id'] == element.value) {

                                $(element).next().val(product['price']);
                                return true;
                            }
                            
                        });
                        price_changed(0);
        }
    }

    function city_selected(element) {

        if (cities.length == 0) {
            $.ajax({
                    url: "get_active_zones",
                    type: "get",
                    data: {
                        _token: "{{ csrf_token() }}",
                    },
                    success: function(response) {
                        cities = response;

                        response.forEach(city => {
                            if (city['id'] == element.value) {
                                $("#rate").val(city['shipping_rate'] + " EGP");
                                return true;
                            }
                            
                        });
                        price_changed(element.value); 

                    },
                    error: function(xhr) {
                        //Do Something to handle error
                    }

                });
        } else {
            cities.forEach(city => {
                            if (city['id'] == element.value) {

                                $("#rate").val(city['shipping_rate'] + " EGP");
                                return true;
                            }
                            
                        });
            price_changed(element.value); 


        }

    }

        function price_changed(element) {
            var prices = $(".price");
            var qtys = $(".qty");

            final_price = 0;

            for (let i = 0; i < prices.length; i++) {
                if (prices[i].value != null && parseInt(prices[i].value).length != 0 && prices[i].value.length != 0) {
                    if (parseInt(qtys[i].value).length != 0 && qtys[i].value.length != 0) {
                        final_price = parseInt(prices[i].value) * parseInt(qtys[i].value) + final_price;
                    } else {
                        final_price = parseInt(prices[i].value) * 0 + final_price;
                    }
                }
            }

           if (document.getElementById("rate").value.length != 0 && document.getElementById("rate").value != null) {

                final_price += parseInt(document.getElementById("rate").value);
            }
            $("#final_price").val(final_price);
        }


    $(function() {
        $(document).on('click', '.btn-add', function(e) {
            e.preventDefault();

            var dynaForm = $('.dynamic-wrap .products_form:first'),
                currentEntry = $(this).parents('.entry:first'),
                newEntry = $(currentEntry.clone()).appendTo(dynaForm);

            newEntry.find('input').val('');
            dynaForm.find('.entry:not(:last) .btn-add')
                .removeClass('btn-add').addClass('btn-remove')
                .removeClass('btn-success').addClass('btn-danger')
                .html('<i class="fas fa-minus"></i>');
        }).on('click', '.btn-remove', function(e) {
            $(this).parents('.entry:first').remove();

            e.preventDefault();
            return false;
        });
    });

</script>
</html>
