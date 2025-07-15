<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/v4-shims.css">
    <link rel="stylesheet" href="<?php echo asset('css/tracking.css'); ?>" type="text/css">


    <title>Tracking Order</title>
</head>

<body>


    <div class="container padding-bottom-3x mb-1">
        <div class="card mb-3">
            <div style="background-color: #264b34!important;" class="p-4 text-center text-white text-lg rounded-top">
                <img style="width: 40%;max-width: 150px;" src="{{ asset('background-zete.png') }}" alt="logo" />
            </div>
            <div class="d-flex flex-wrap flex-sm-nowrap justify-content-between py-3 px-2 bg-secondary">
                <div class="w-100 text-center py-1 px-2"><span style="font-weight: 600;" class="text-medium">Tracking
                        Order No: </span> <?= $kshopina ?>
                </div>
                <?php
                $all_status = ['Order Submitted', 'Order received at KMEX warehouse ', 'Order ready to dispatch', 'Order dispatched from Korea', 'Order at local warehouse', 'Out for delivery', 'Delivered', 'Refused'];
                if ($orignal_status >= 0 && $orignal_status <= 7) {
                    $status = $all_status[$orignal_status];
                } else {
                    $status = 'No status';
                }
                
                ?>
                <div class="w-100 text-center py-1 px-2"><span style="font-weight: 600;"
                        class="text-medium">Status:</span> <?= $status ?></div>
                <!--                 <div class="w-100 text-center py-1 px-2"><span class="text-medium">Expected Date:</span> SEP 09, 2017</div>
 -->
            </div>
            <div class="card-body">
                <div
                    class="steps d-flex flex-wrap flex-sm-nowrap justify-content-between padding-top-2x padding-bottom-1x">
                    <div class="step @if ($orignal_status >= 0) completed @endif  ">
                        <div class="step-icon-wrap">
                            <div class="step-icon"><i class="fa fa-cart-arrow-down"></i></div>
                        </div>
                        <div class="column">
                            <h4 class="step-title">Order Submitted</h4>
                            @if (isset($shipment) && !empty($shipment[0]->shipment_upload_date) && $orignal_status >= 0)
                                <div style="align-items: baseline;justify-content: center;display: flex;">
                                    <i style="margin-right: 7px;font-size: 13px;color: #808080a3;"
                                        class="far fa-clock"></i>
                                    <div
                                        style="margin-top: 5px;margin-bottom: 0px;font-size: 13px;font-weight: 500;color: #808080a3">
                                        {{ date('j-m-Y', strtotime($shipment[0]->shipment_upload_date)) }}
                                    </div>

                                </div>
                            @endif

                        </div>
                    </div>
                    <div class="step @if ($orignal_status >= 1) completed @endif  ">
                        <div class="step-icon-wrap">
                            <div class="step-icon"><i class="fas fa-people-carry"></i></div>
                        </div>
                        <div class="column">
                            <h4 class="step-title">Received by KMEX</h4>
                            @if (isset($shipment) && !empty($shipment[0]->barcode_scaned_at) && $orignal_status >= 1)
                                <div style="align-items: baseline;justify-content: center;display: flex;">
                                    <i style="margin-right: 7px;font-size: 13px;color: #808080a3;"
                                        class="far fa-clock"></i>
                                    <div
                                        style="margin-top: 5px;margin-bottom: 0px;font-size: 13px;font-weight: 500;color: #808080a3">
                                        {{ date('j-m-Y', strtotime($shipment[0]->barcode_scaned_at)) }}
                                    </div>
                                </div>
                            @endif

                        </div>
                    </div>
                    <div class="step @if ($orignal_status >= 2) completed @endif  ">
                        <div class="step-icon-wrap">
                            <div class="step-icon"><i class="fa fa-dolly-flatbed"></i></div>
                        </div>
                        <div class="column">

                            <h4 class="step-title">Ready to dispatch</h4>
                            @if (isset($shipment) && !empty($shipment[0]->awb_created_at) && $orignal_status >= 2)
                                <div style="align-items: baseline;justify-content: center;display: flex;">
                                    <i style="margin-right: 7px;font-size: 13px;color: #808080a3;"
                                        class="far fa-clock"></i>
                                    <div
                                        style="margin-top: 5px;margin-bottom: 0px;font-size: 13px;font-weight: 500;color: #808080a3">
                                        {{ date('j-m-Y', strtotime($shipment[0]->awb_created_at)) }}
                                    </div>
                                </div>
                            @endif

                        </div>
                    </div>
                    <div class="step @if ($orignal_status >= 3) completed @endif  ">
                        <div class="step-icon-wrap">
                            <div class="step-icon"><i class="fa fa-plane"></i></div>
                        </div>
                        <div class="column">

                            <h4 class="step-title">Dispatched</h4>
                            @if (isset($shipment) && !empty($shipment[0]->shipment_dispatched_at) && $orignal_status >= 3)
                                <div style="align-items: baseline;justify-content: center;display: flex;">
                                    <i style="margin-right: 7px;font-size: 13px;color: #808080a3;"
                                        class="far fa-clock"></i>
                                    <div
                                        style="margin-top: 5px;margin-bottom: 0px;font-size: 13px;font-weight: 500;color: #808080a3">
                                        {{ date('j-m-Y', strtotime($shipment[0]->shipment_dispatched_at)) }}
                                    </div>
                                </div>
                            @endif

                        </div>
                    </div>
                    <div class="step @if ($orignal_status >= 4) completed @endif  ">
                        <div class="step-icon-wrap">
                            <div class="step-icon"><i class="icon fa fa-warehouse"></i></div>
                        </div>
                        <div class="column">

                            <h4 class="step-title">At local HUB</h4>
                            @if (isset($shipment) && !empty($shipment[0]->shipment_in_hub_at) && $orignal_status >= 4)
                                <div style="align-items: baseline;justify-content: center;display: flex;">
                                    <i style="margin-right: 7px;font-size: 13px;color: #808080a3;"
                                        class="far fa-clock"></i>
                                    <div
                                        style="margin-top: 5px;margin-bottom: 0px;font-size: 13px;font-weight: 500;color: #808080a3">
                                        {{ date('j-m-Y', strtotime($shipment[0]->shipment_in_hub_at)) }}
                                    </div>
                                </div>
                            @endif

                        </div>
                    </div>
                    <div class="step @if ($orignal_status >= 5) completed @endif  ">
                        <div class="step-icon-wrap">
                            <div class="step-icon"><i class="fas fa-truck"></i></div>
                        </div>
                        <div class="column">

                            <h4 class="step-title">OFD</h4>
                            @if (isset($shipment) && !empty($shipment[0]->shipment_delivery_at) && $orignal_status >= 5)
                                <div style="align-items: baseline;justify-content: center;display: flex;">
                                    <i style="margin-right: 7px;font-size: 13px;color: #808080a3;"
                                        class="far fa-clock"></i>
                                    <div
                                        style="margin-top: 5px;margin-bottom: 0px;font-size: 13px;font-weight: 500;color: #808080a3">
                                        {{ date('j-m-Y', strtotime($shipment[0]->shipment_delivery_at)) }}
                                    </div>
                                </div>
                            @endif

                        </div>
                    </div>
                    <div class="step @if ($orignal_status >= 6) completed @endif  ">
                        <div class="step-icon-wrap">
                            @if ($orignal_status == 7)
                                <div style="border-color: #dc3545;background-color: #dc3545;" class="step-icon"><i
                                        class="fas fa-times"></i></div>
                        </div>
                        <div class="column">

                            <h4 class="step-title">Refused</h4>
                            @if (isset($shipment) && !empty($shipment[0]->shipment_delivered_at) && $orignal_status == 7)
                                <div style="align-items: baseline;justify-content: center;display: flex;">
                                    <i style="margin-right: 7px;font-size: 13px;color: #808080a3;"
                                        class="far fa-clock"></i>
                                    <div
                                        style="margin-top: 5px;margin-bottom: 0px;font-size: 13px;font-weight: 500;color: #808080a3">
                                        {{ date('j-m-Y', strtotime($shipment[0]->shipment_delivered_at)) }}
                                    </div>
                                </div>
                            @endif

                        </div>
                    @else
                        <div class="step-icon"><i class="fas fa-check"></i></div>
                    </div>
                    <div class="column">

                        <h4 class="step-title">Delivered</h4>
                        @if (isset($shipment) && !empty($shipment[0]->shipment_delivered_at) && $orignal_status == 6)
                            <div style="align-items: baseline;justify-content: center;display: flex;">
                                <i style="margin-right: 7px;font-size: 13px;color: #808080a3;"
                                    class="far fa-clock"></i>
                                <div
                                    style="margin-top: 5px;margin-bottom: 0px;font-size: 13px;font-weight: 500;color: #808080a3">
                                    {{ date('j-m-Y', strtotime($shipment[0]->shipment_delivered_at)) }}
                                </div>
                            </div>
                        @endif

                    </div>
                    @endif

                </div>
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

</body>

</html>
