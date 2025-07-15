<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.css') }}">


    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/v4-shims.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

    <script src="{{ asset('js/bootstrap.js') }}"></script>



    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Caveat:wght@500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Changa:wght@500&display=swap" rel="stylesheet">
    <title>Search</title>
</head>

<style>
    * {
        outline: none;
    }

    html,
    body {
        height: 100%;
        min-height: 100%;
        font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", "Liberation Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
    }

    body {
        margin: 0;
    }

    #app-cover {
        position: absolute;
        top: 50%;
        right: 0;
        left: 0;
        width: 434px;
        margin: -41px auto 0 auto;
    }

    #app {
        top: 44%;
        position: fixed;
        right: -100px;
        left: -100px;
        width: 82px;
        height: 82px;
        border-radius: 120px;
        margin: 0 auto;
        transition: 0.15s ease width;
        z-index: 2;
    }

    form {
        position: relative;
        height: 82px;
        cursor: auto;
        border-radius: 120px;
    }

    #f-element {
        position: absolute;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        overflow: hidden;
        border-radius: 120px;
    }

    #inp-cover {
        position: absolute;
        top: 0;
        right: 41px;
        bottom: 0;
        left: 0;
        padding: 0 35px;
        background-color: #fff;
    }

    input {
        display: block;
        width: 100%;
        font-size: 19px;
        font-family: Arial, Helvetica, sans-serif;
        color: #382f1f;
        border: 0;
        padding: 30px 0;
        margin: 0;
        margin-top: 52px;
        line-height: 1;
        background-color: transparent;
        transition: 0.15s ease margin-top;
        cursor: auto;
    }

    button {
        position: absolute;
        top: 0;
        right: 0;
        width: 82px;
        height: 82px;
        color: #fff;
        font-size: 30px;
        line-height: 1;
        padding: 26px;
        margin: 0;
        border: 0;
        background-color: #ca9b49;
        transition: 0.2s ease background-color;
        border-radius: 50%;
    }

    button.shadow {
        box-shadow: 0 10px 30px #d0d0d0;
    }

    button i.fas {
        display: block;
        line-height: 1;
    }

    #layer {
        width: 78px;
        height: 78px;
        border-radius: 50%;
        background: linear-gradient(297deg, #0056d9, #cc9b48);
        transition: 0.9s ease all;
        z-index: 1;
    }

    #layer.sl {
        transition: 0.3s ease all;
    }

    #layer,
    #init {
        position: fixed;
        top: 50%;
        margin: -40px auto 0 auto;
    }

    #layer {
        right: -100px;
        left: -100px;
    }

    #init {
        right: 0;
        left: 0;
        width: 82px;
        height: 82px;
        cursor: pointer;
        z-index: 2;
    }

    #app.opened {
        width: 434px;
        box-shadow: 0 10px 30px #503e1e;
    }

    .opened input.move-up {
        margin-top: 0;
    }

    .opened button {
        color: #ca9b49;
        background-color: #fff;
        box-shadow: none;
        cursor: pointer;
    }

    #app.opened+#layer {
        width: 4000px;
        height: 4000px;
        margin-top: -2000px;
        opacity: 1;
        z-index: 0;
    }

    #app.opened~#init {
        z-index: -1;
    }

    @media(max-width: 490px) {
        #app.opened {
            width: 90%;
        }

        .result {
            width: 79% !important;

        }
    }

    #dot-1:checked~.category label .one,
    #dot-2:checked~.category label .two,
    #dot-3:checked~.category label .three {
        background: #36304a;
        border-color: #d9d9d9;
    }

    .dot {
        height: 18px;
        width: 18px;
        border-radius: 50%;
        margin-right: 10px;
        background: #d9d9d9;
        border: 5px solid transparent;
        transition: all 0.3s ease;
    }

    .gender-details {
        width: calc(100% / 1 - 20px);
    }

    .category {
        display: flex;
        margin: 14px 0;
        justify-content: space-between;
    }

    .category label .dot {
        height: 15px;
        width: 15px;
        border-radius: 50%;
        margin-right: 10px;
        background: #f3f3f3;
        border: 3px solid transparent;
        transition: all 0.3s ease;
    }

    .category label {
        display: flex;
        align-items: center;
        cursor: pointer;
    }

    .category {
        display: flex;
        margin: 14px 0;
        justify-content: center;
        position: absolute;
        top: calc(44% - 60px);
        right: 0;
        left: -15px;
        z-index: 10;
    }

    .gender {
        font-size: medium;
        font-weight: 500;
    }

    .search-result {

        width: 100%;
        justify-content: start;
    }

    .result {
        width: 83%;
        /*         display: flex;
 */
        position: relative;
        top: 83px;
        left: 32px;
        background-color: white;
        padding: 10px 10px 10px 25px;
        max-height: calc(368% - 60px);
        overflow-y: scroll;
        display: none;
    }

    hr.product {
        margin-bottom: 12px;
        border-top: 1px solid #c1c1c1;
        padding-top: 5px;
        margin-left: -15px;
    }

    a:hover {
        text-decoration: none;
        color: #ca9b49;
        /* Inherits color property from its parent */
    }

    .logo {
        text-align: center;
        font-size: 30px;
        text-shadow: 0 0 3px var(--cyan), 0 0 5px #046978;
        color: white;
        font-family: 'Caveat', cursive;
        z-index: 10;
    }

    .kshopina {
        text-align: center;
        font-size: -webkit-xxx-large;
        color: white;
        z-index: 10;
        font-family: 'Changa', sans-serif;
    }

    .kshopina-logo {
        margin-left: 0px;
        position: absolute;
        z-index: 1;
        top: calc(40% - 150px);
        width: 100%;
        justify-content: center;
        align-items: end;
    }

</style>

<body>
    <div style="display: none;" id="logo" class="row kshopina-logo">
        <div class="kshopina">Kshopina</div>
        <div class="logo">Stock</div>
    </div>

    <div class="gender-details">
        <input checked style="display: none;" value="Album" type="radio" onchange="radio_changed(this)" name="adjust"
            id="dot-1">
        <input style="display: none;" value="Band" type="radio" onchange="radio_changed(this)" name="adjust" id="dot-2">
        <div id="options" style="display: none;" class="category">
            <label for="dot-1">
                <span class="dot one"></span>
                <span class="gender">Name</span>
            </label>
            <label style="padding-left: 30px;" for="dot-2">
                <span class="dot two"></span>
                <span class="gender">Type</span>
            </label>
        </div>
    </div>
    <div id="app-cover">
        <div id="app">
            <form method="get" action="">
                @csrf
                <div id="f-element">
                    <div id="inp-cover"><input onkeyup="search(this)" type="text" name="query"
                            placeholder="Type something to search ..." autocomplete="off"></div>
                </div>
                <div id="results" class="result col">
                    {{-- <div class="search-result row">
                        <img style="width: 15%;" src="{{ url('uploads/products/20211010113608.jpg') }}" alt="">
                        <div style="margin-left: 10px;" class="col">
                            <div style="font-size: 17px;">sav</div>
                            <div class="row" style="margin: 0;color: #918f8f;font-size: 15px;">
                                <div style="margin-right: 15px;"><i class="fas fa-hashtag"></i> : BTS</div>
                                <div><i class="fas fa-cart-plus"></i> : 1</div>
                            </div>
                        </div>
                    </div> --}}
                </div>
                <button type="submit" class="shadow"><i class="fas fa-search"></i></button>
            </form>
        </div>
        <div id="layer" title="Click the gold area to hide the form"></div>
        <div id="init"></div>
    </div>
</body>
<script>
    var search_filter = "Album";
    var ajaxx;
    var base_url = window.location.origin;

    $(function() {
        var app = $('#app'),
            init = $('#init'),
            layer = $('#layer'),
            input = $('#inp-cover input'),
            button = $('button');

        function toggleApp() {
            app.toggleClass('opened');

            if (button.hasClass('shadow'))
                button.toggleClass('shadow');
            else
                setTimeout(function() {
                    button.toggleClass('shadow');
                }, 300);

            if (app.hasClass('opened')) {
                setTimeout(function() {
                    input.toggleClass('move-up');
                }, 200);
                setTimeout(function() {
                    input.focus();
                }, 500);
                setTimeout(function() {
                    $('#options').show();
                    $("#logo").show();
                }, 200);
            } else {
                setTimeout(function() {
                    input.toggleClass('move-up').val('');
                }, 200);
                $('#options').hide();
                $("#results").hide();
                $("#logo").hide();
            }


            if (!layer.hasClass('sl')) {
                setTimeout(function() {
                    layer.addClass('sl');
                }, 500);
            } else
                setTimeout(function() {
                    layer.removeClass('sl');
                }, 300);
        }

        layer.on('click', toggleApp);
        init.on('click', toggleApp);
    });

    function radio_changed(elemant) {
        search_filter = elemant.value;
    }

    function search(elemant) {

        var value = (elemant.value);
        var html1 = "";
        var counter = 0;
        
        var url;
        url = window.location.href;
        url = new URL(url);
        var store_name = url.searchParams.get("store");

     

        if ((value.replace(/\s/g, "")).length > 1) {

            try {
                ajaxx.abort();
            } catch (error) {

            }
            setTimeout(function() {

                ajaxx = $.ajax({
                    url: "search_products_result",
                    type: "get",
                    data: {
                        _token: "{{ csrf_token() }}",
                        content: value,
                        filter: search_filter ,
                        store: store_name
                    },
                    success: function(response) {

                        response.forEach(product => {

                            counter++;
                            html1 += '<a href="products?filter=All&page=1&store='+store_name+'&id=' +
                                product['id'] + '" target="blank">'
                            html1 += '<div style="align-items: center;" class="search-result row">';
                            html1 +=
                                '<img style="height: max-content;width: 20%;" src="' +
                                product['product_cover_image'] + '" alt="">';
                            html1 +=
                                '<div style="width: 75%;margin-left: 10px;" class="column">';
                            html1 +=
                                '<div style="color: #b3883e;font-weight: 600;font-size: 14px;">' +
                                product['product_title'] + '</div>';
                            html1 +=
                                '<div class="row" style="margin: 3px 1px 0px 0px ;color: #918f8f;font-size: 13px;">';

                            html1 +=
                                '<div style="margin-right: 25px;"><i class="fas fa-hashtag"></i>  ' +
                                product['product_type'] + '</div>';
                            /* html1 +=
                                '<div><i class="fas fa-cart-plus"></i>  ' +
                                product['product_quantity'] + '</div>'; */
                            html1 += '                            </div>';
                            html1 += '                        </div>';
                            html1 += '                    </div> </a>';

                            if (counter != response.length) {
                                html1 += '                    <hr class="product">';
                            }


                        });
                        $("#results").html("");
                        $("#results").html(html1);

                        if (response.length > 0) {
                            $("#results").show();
                        } else {
                            $("#results").hide();
                        }
                    },
                    error: function(xhr) {
                        //Do Something to handle error
                    }

                });
            }, 300);
        } else {
            $("#results").hide();
        }

    }
</script>

</html>
