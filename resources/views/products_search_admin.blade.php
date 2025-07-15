@extends('layouts.products_search_layout')

@section('header')

    <title>Admin Products search</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="{{ asset('js/sweetalert2.min.js') }}"></script>

    <link rel="stylesheet" type="text/css" href="{{ asset('css/products_search.css') }}">
    
    <script src="{{ asset('js/products_search_admin.js') }}"></script>

@endsection

@section('content')

<div class="container">
    <div> 
        <form id="products_search_form" class="products_search">
            <select name="type_of_search" id="type_of_search" style="margin-right: 8px;font-size: 14px;padding: 10px;">
                <option value="order_number">Order number</option>
                <option value="product_barcode">Product barcode</option>
                <option value="product_id">Product id</option>

            </select>
            <input type="text" class="form-control order_number_input" name="order_number" id="order_number" placeholder="Order Number"  
                title="search products of your order number" >
        </form>
        <div class="results">

        </div>
    </div>

    <div style="z-index: 4;" id="return_pop" class="overlay">
        <div style="height: 85%;" class="row">
            <div class="popup">
                <a style="z-index: 30;" id='close' class="return_close" href="#">&times;</a>
                <div class="container content">
                  
                  <div id="product_name"></div>
                  
                  <div id="product_info" style="margin-top: 14px;align-items: center;justify-content: start;margin-left: 12px;" class="row" >
                      <span style="font-weight: 600;">NO. of variants :&nbsp;</span>
                      <span id="number_of_variants">100</span>
                  </div>

                  <hr>
                  
                  <div id="variants_body">
                      
                  </div>
                  <div style="margin:60px 0px 5px 0px;display: flex;justify-content: flex-end;" id="created_variant_button"> 

                    </div>
                </div>
                <div id="loader_" style="display: none;"><div style="align-items: center;justify-content: center;display:flex;position: absolute;width: 100%;height: 100%;z-index: 20;
                    top: 0;left: 0;background: #1b3425cf; "><div style="width: 20vh;height: 20vh;" class="loader"></div></div></div>

            </div>
        </div>
        
    </div>
    
</div>

@endsection