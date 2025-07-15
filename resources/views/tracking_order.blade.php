<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.css') }}">

    <script src="{{ asset('js/bootstrap.js') }}"></script>

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/v4-shims.css">
    <link rel="stylesheet" href="<?php echo asset('css/tracking.css'); ?>" type="text/css">
    <link rel="icon" type="image/png" href="{{ asset('mini_yellow.png') }}" style="font-size: 2rem;">

    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">


    <title>Tracking Order</title>
</head>

<style>
    .bg-dark {
        background-color: #264b34 !important;
    }

    .rounded-top {
        display: flex;
        flex-direction: column;
    }

</style>


<style>
    .floating-button-menu {
        z-index: 5;
        position: fixed;
        bottom: 20px;
        right: 50px;
        cursor: pointer;
        background: #1b3425;
        border-radius: 50%;
        min-width: 50px;
        max-width: 0px;
        min-height: 50px;
        max-height: 0px;
        box-shadow: 2px 1px 8px 1px rgb(0 0 0 / 25%);
        transition: all ease-in-out 0.8s;
    }

    .floating-button-menu:hover {
        background: #1b3425;
    }

    .floating-button-menu .floating-button-menu-links {
        width: 0;
        height: 0;
        overflow: hidden;
        opacity: 0;
        transition: all 0.4s;
    }

    .floating-button-menu .floating-button-menu-links a {
        position: relative;
        color: #454545;
        text-decoration: none;
        line-height: 50px;
        display: block;
        display: block;
        border-bottom: 1px solid #ccc;
        width: 100%;
        height: 45px;
        padding: 0 20px;
        border-bottom: 0.5px solid #ccc;
        transition: background ease-in-out 0.8s;
        background: rgba(0, 0, 0, 0);
    }

    .floating-button-menu .floating-button-menu-links a:hover {
        text-decoration: underline;
    }

    .floating-button-menu .floating-button-menu-links a:last-child {
        border-bottom: 0px solid #fff;
    }

    .floating-button-menu .floating-button-menu-links.menu-on {
        width: 450px;
        height: 400px;
        border-radius: 10px;
        opacity: 1;
        transition: all ease-in-out 0.8s;
    }

    .floating-button-menu .floating-button-menu-label {
        text-align: center;
        line-height: 0px;
        font-size: 25px;
        color: #fff;
        opacity: 1;
        transition: opacity 0.3s;
    }

    .floating-button-menu .floating-button-menu-label:hover {
        color: #ca9b49;
    }

    .floating-button-menu.menu-on {
        background: #fff;
        max-width: 340px;
        max-height: 3300px;
        border-radius: 10px;
    }

    .floating-button-menu.menu-on .floating-button-menu-links {
        width: 100%;
        height: 100%;
        opacity: 1;
        transition: all ease-in-out 1s;
    }

    .floating-button-menu.menu-on .floating-button-menu-label {
        height: 0px;
        overflow: hidden;
    }

    .floating-button-menu-close {
        position: fixed;
        z-index: 2;
        width: 0%;
        height: 0%;
    }

    .floating-button-menu-close.menu-on {
        width: 100%;
        height: 100%;
    }

    .vl {
        border-left: 1px solid #c8cecb;
        height: 80px;
    }

    option {
        margin-bottom: 50px !important;
    }
</style>

<style>
    .container-news {
        height: 21vw;
        text-align: center;
        z-index: 0;
    }

    .container-news a {
        color:white;
        text-decoration:none;
        width:100%;
        position: absolute;
        left: 0;
    }

    .on {
        opacity:1;
        -webkit-transition: all 0.5s ease-in;
        -moz-transition: all 0.5s ease-in;
        -ms-transition: all 0.5s ease-in;
        -o-transition: all 0.5s ease-in;
        transition: all 0.5s ease-in;
        -webkit-transition-delay: 2s;
        -moz-transition-delay: 2s;
        -ms-transition-delay: 2s;
        -o-transition-delay: 2s;
        transition-delay: 2s;
        z-index: 2;
    }

    .off {
        opacity:0;
        -webkit-transition: all 2s ease-out;
        -moz-transition: all 2s ease-out;
        -ms-transition: all 2s ease-out;
        -o-transition: all 2s ease-out;
        transition: all 2s ease-out;
        z-index: 1;
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

<body>

    

    <div class="floating-button-menu menu-off" style="display: flex;align-items: center;justify-content: center; z-index: 10;">
        <div class="floating-button-menu-links" >

            <div style="display: flex;padding: 1rem;flex-direction: row;margin-left: 2rem;margin-top: 1rem;">
                <span style="font-family: 'Bebas Neue', cursive !important;font-size: 14px;letter-spacing: 2px;"> 
                    if you have any question you can contact us 
                    <a href="https://kshopinaexpress.com/need_help" style="display: inline;color: #004eff;margin-left: -1rem;"> here </a> 
                </span> 
            </div>
            
             
           {{--  <a href="#" style=" display: flex;flex-direction: row; align-items: center;">
                <div style="margin: 0px 10px 5px 0px;background-color: #f241416e;border-color: #f241416e;height: 30px;width: 30px;"
                    class="tag">
                </div>
                <span>Canceled</span>
            </a>
            <a href="#" style=" display: flex;flex-direction: row; align-items: center;">
                <div style="margin: 0px 10px 5px 0px;background-color: #ca9b49a8;border-color: #ca9b49a8;height: 30px;width: 30px;"
                    class="tag">
                </div>
                <span>Re-delivery after cancelation</span>
            </a>
            <a href="#" style=" display: flex;flex-direction: row; align-items: center;">
                <div style="margin: 0px 10px 5px 0px;background-color: #126dd075;border-color: #126dd075;height: 30px;width: 30px;"
                    class="tag">
                </div>
                <span>Holding in FCT</span>
            </a> --}}
        </div>
        <div class="floating-button-menu-label"><i class="fas fa-robot"></i></div>
    </div>

    <div class="floating-button-menu-close"></div>



    <div class="container padding-bottom-3x mb-1">

        <div class="card mb-3">
            <div class="p-4 text-center text-white text-lg bg-dark rounded-top">
                <div>
                    <img src="{{ asset('background-zete.png') }}" alt="KMEX" style="width: 40%;max-width: 150px;">
                </div>
                
                <div style="padding-top: 0.5rem;">
                    <span class="text-uppercase">Tracking Order No - </span>
                    <span class="text-medium"><?= $kshopina ?></span>
                </div>
            </div>
            <div class="d-flex flex-wrap flex-sm-nowrap justify-content-between py-3 px-2 bg-secondary">
                <?php
                    $all_status = ['Order is Verified but it will be fulfilled soon', 'Order Fulfilled', 'Order Departed from korea', 'The Order has been arrived to Kshopina Hub', 'Now the Order with courier company', 'Delivered', 'Refused'];

                    $status = $all_status[$orignal_status];

                    if ($orignal_status == 7 && $reason != 'No service area') {
                        $status = $reason;
                    }

                   
                                                
                    date_default_timezone_set('Africa/Cairo');
                    $today = date('Y-m-d', time());

                    $release_date_ = date('Y-m-d', strtotime($release_date));
                                            
                                         
                ?>

                <div class="w-100 text-center py-1 px-2"><span class="text-medium">Shipped Via:</span> Etihad Airways
                </div>
                @if ( $category == 1 && $orignal_status == 0  )
                        <div style="display: flex;width: 30rem;align-items: center;">
                            <span class="text-medium">Release_date: </span> 
                            @if ($release_date == Null)
                                <p style="margin-bottom: 0px;margin-left: 1rem;color: #dc3545; ">  Not set yet! </p>
                            @else
                                @if ( $release_date_ <= $today )
                                    <p  style="margin-bottom: 0px;margin-left: 1rem; color: rgb(24, 184, 80); ">{{$release_date_}} </p>
                                @else
                                    <p style="margin-bottom: 0px;margin-left: 1rem; color:#dc3545; ">{{$release_date_}} </p>
                                @endif
                            @endif  
                        </div>
                @endif
                <div class="w-100 text-center py-1 px-2"><span class="text-medium">Status:</span> <?= $status ?></div>
              
            </div>
            <div class="card-body"> 
                <div class="steps d-flex flex-wrap flex-sm-nowrap justify-content-between padding-top-2x padding-bottom-1x">
                   
                    <div class="step @if ($orignal_status >= 0) completed @endif  ">
                        <div class="step-icon-wrap">
                            <div class="step-icon"><i class="fa fa-cart-arrow-down"></i></div>
                        </div>
                        <h4 class="step-title">Order Verified</h4>
                    </div>

                    {{--  momkn icon de tgrbha brdo e7trt ben aletnin ( ali homa msh moqtn3abehom   brdo awe )
                   <i class="fas fa-box-open"></i> --}}

                    <div class="step @if ( ($orignal_status >= 0 && $on_process == 1)  || $orignal_status >= 1) completed @endif  ">
                        <div class="step-icon-wrap">
                            <div class="step-icon"><i class="fas fa-users-cog"></i></i></div>
                        </div>
                        {{-- @if ($category == 1) --}}
                            <h4 class="step-title">Processing</h4>
                        {{-- @else
                            <h4 class="step-title">On process</h4>
                        @endif --}}
                    </div>
                   
                    <div class="step @if ($orignal_status >= 1) completed @endif  ">
                        <div class="step-icon-wrap">
                            <div class="step-icon"><i class="fas fa-people-carry"></i></div>
                        </div>
                        <h4 class="step-title">Fulfilled</h4>
                    </div>

                    @if ($store == 'origin')
                 
                        <div class="step @if ($orignal_status >= 2) completed @endif  ">
                            <div class="step-icon-wrap">
                                <div class="step-icon"><i class="fa fa-plane"></i></div>
                            </div>
                            <h4 class="step-title">Dispatched</h4>
                        </div>
                        <div class="step @if ($orignal_status >= 3) completed @endif  ">
                            <div class="step-icon-wrap">
                                <div class="step-icon"><i class="fa fa-dolly-flatbed"></i></div>
                            </div>
                            <h4 class="step-title">Kshopina Warehouse</h4>
                        </div>

                    @endif
                    
                    <div class="step @if ($orignal_status >= 4) completed @endif  ">
                        <div class="step-icon-wrap">
                            <div class="step-icon"><i class="fas fa-truck"></i></div>
                        </div>
                        <h4 class="step-title">Delivery</h4>
                    </div>

                    <div class="step @if ($orignal_status >= 5) completed @endif  ">
                        <div class="step-icon-wrap">
                            @if ($orignal_status == 6)
                                <div style="border-color: #dc3545;background-color: #dc3545;" class="step-icon"><i
                                        class="fas fa-times"></i>
                                </div>
                                <h4 class="step-title">Refused</h4>
                            @else
                                <div class="step-icon"><i class="fas fa-check"></i></div>
                                
                                <h4 class="step-title">Delivered</h4>
                            @endif
                        </div>
                    </div>

                   

                </div>
            </div>
        </div>
        
        <div class="p-4 text-center text-lg rounded-top">
            <div>
                <h2 style="font-family: 'Bebas Neue', cursive;letter-spacing: 4px;">Dont miss this</h2>
            </div>
            
        </div>

        
        <div class="card mb-3" style="padding: 10px 10px 10px 10px;border: none;">

            <div id="container-news" class="container-news no-js" >
                <iframe id="you_tube" width="300" height="500" src="{{$fan_talk_episode}}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>

                {{-- <a href="https://www.kshopina.com/collections/bts?sort_by=created-descending" id="news-1" target="_self" class="news off">
                    <img src="{{ asset('kmex banner.png') }}" alt="KMEX"  style="width: 90%;margin-bottom: 50px;">
                </a> --}}
            </div>
        </div>

    </div>
    <!-- <div class="d-flex flex-wrap flex-md-nowrap justify-content-center justify-content-sm-between align-items-center">
          <div class="custom-control custom-checkbox mr-3">
            <input class="custom-control-input" type="checkbox" id="notify_me" checked="">
            <label class="custom-control-label" for="notify_me">Notify me when order is delivered</label>
          </div>
          <div class="text-left text-sm-right"><a class="btn btn-outline-primary btn-rounded btn-sm" href="orderDetails" data-toggle="modal" data-target="#orderDetails">View Order Details</a></div>
        </div>
    </div> -->

    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous">
    </script>


    <script>

        $(".menu-off").click(function() {

            $(this).removeClass("menu-off");
            $(this).addClass("menu-on");
            $('.floating-button-menu-close').addClass('menu-on');
        });
        $('.floating-button-menu-close').click(function() {
            $(this).addClass("menu-off");
            $(this).removeClass("menu-on");
            $('.floating-button-menu').toggleClass('menu-on');
        });
    </script>

    <script>

        $(document).ready(function () {
        /* JS is enabled */
        $(".no-js").removeClass("no-js");

        /* Variables */
        var currentNews = 0;
        var nbNews = $(".news").length;
        var tempo;

        /* Initialization */
        $(".news").eq(currentNews).removeClass("off").addClass("on");

        function changeNews() {
            currentNews++;
                if (currentNews < nbNews) {
                $(".on").toggleClass("off").toggleClass("on");
                $(".off").eq(currentNews).toggleClass("off").toggleClass("on");
                } else {
                currentNews = 0;
                $(".on").toggleClass("off").toggleClass("on");
                $(".off").eq(currentNews).toggleClass("off").toggleClass("on");
                }
            }

            tempo = setInterval(changeNews, 7000);

            $('html, body').stop(true, false).animate({
                scrollTop: $('#you_tube').offset().top
            }, 'slow');

        });


       
    </script>
</body>

</html>
