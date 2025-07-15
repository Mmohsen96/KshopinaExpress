<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="icon" type="image/png" href="{{ asset('mini_yellow.png') }}" style="font-size: 2rem;">

    {{-- CSS --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" 
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <link rel="stylesheet" type="text/css" href="{{ asset('css/products_search_layout.css') }}">

    {{-- JS --}}
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" 
    integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" 
    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" 
    integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>


    {{-- JQUERY --}}
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>

    {{-- SWAL --}}
    <script src="{{ asset('js/sweetalert2.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('js/sweetalert2.min.css') }}">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    @yield('header')
</head>
<body>


@if ($message = Session::get('message'))
  <script>
      Swal.fire({
          position: 'center',
          icon: 'success',
          title: ' Thank you for your support, we will get back to you as soon as possible!',
          showConfirmButton: false,
          timer: 2000
      });
  </script>
@elseif ($message = Session::get('error_question'))
  <script>
      Swal.fire({
          position: 'center',
          icon: 'error',
          title: 'Submit your question please, We want to help you.',
          showConfirmButton: false,
          timer: 2000
      });
  </script>
@elseif ($message = Session::get('error_phone_number'))
<script>
    Swal.fire({
        position: 'center',
        icon: 'error',
        title: 'Submit your phone number please, so We be able to reach you.',
        showConfirmButton: false,
        timer: 2000
    });
</script>
@endif

    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper ">
            <nav class="navbar navbar-expand-lg navbar-light  justify-content-between">
                <a class="navbar-brand" href="#"> 
                  <img src="{{ asset('kshopina-express1.png') }}" alt="logo" class="logo_kshopina"/>
                </a>
                  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                  </button>
                
                  <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto">
                      <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></a>
                        <div class="dropdown-menu " aria-labelledby="navbarDropdown">
                          <span class="dropdown-item" id="contact_us">Contact us</span>
                        </div>
                      </li>
                    </ul>
                  </div>
                
              </nav>
              <div class="main-panel">
                <div class="content-wrapper">
                    @yield('content')
                </div>
            </div>
        </div>

        <div style="z-index: 4;" id="contact_us_popup" class="overlay">
          <div style="height: 85%;" class="row">
              <form class="popup" action="/TP_question" method="post" enctype="multipart/form-data">
                @csrf
                  <a style="z-index: 30;" id='close' class="return_close" href="#">&times;</a>

                  <div class="container content">

                    <h3 class="contact_title">Contact Us</h3>
                    <span class="contact_inf">Tell us about your Inquiry and one of our team will response to you as soon as possible.</span>

                    <div class="input_contain">
                      <label for="name" class="contact_label">Your name</label>
                      <input id="name" name="name" class="contact_input" type="text" >
                    </div>

                    <div class="input_contain">
                      <label for="phone_number" class="contact_label">Your phone Number</label>
                      <input id="phone_number" name="phone_number" class="contact_input" type="text" required>
                    </div>

                    <div class="input_contain">
                      <label for="order_number" class="contact_label">Order number</label>
                      <input id="order_number" name="order_number" class="contact_input" type="text" >
                    </div>

                    <div class="input_contain">
                      <label for="question" class="contact_label">Your Question</label>
                      <textarea id="question" name="question"  class="contact_input"  cols="30" rows="5" required ></textarea>
                    </div>

                    <div class="btn_contain">
                      <button  type="submit" class="btn btn-primary" style="font-weight: 700;padding: 5px 25px;">
                          Submit
                      </button>
                    </div>

                  </div>
  
              </form>
          </div>
        </div>
        
    </div>


</body>