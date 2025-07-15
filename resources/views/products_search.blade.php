@extends('layouts.products_search_layout')

@section('header')

    <title>Products search</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="{{ asset('js/sweetalert2.min.js') }}"></script>

    <link rel="stylesheet" type="text/css" href="{{ asset('css/products_search.css') }}">
    
    <script src="{{ asset('js/products_search.js') }}"></script>

@endsection

@section('content')

<div class="container">
    <div> 
        <form id="products_search_form" class="products_search">
            {{-- @csrf --}}
            <input type="text" class="form-control order_number_input" name="order_number" id="order_number" placeholder="Order Number"  
                title="search products of your order number" >
        </form>
        <div class="results">

        </div>
    </div>
    <div>

    </div>
</div>

@endsection

