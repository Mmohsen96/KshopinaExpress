<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [

        'egypt_order_create_webhook',
        'egypt_order_cancelled_webhook',
        'egypt_order_paid_webhook',
        'egypt_order_updated_webhook',
        'egypt_product_new_webhook',
        'egypt_product_updated_webhook',
        'egypt_product_delete_webhook',

        'origin_order_create_webhook',
        'origin_order_updated_webhook',
        'origin_order_cancelled_webhook',
        'origin_order_paid_webhook',
        'origin_product_new_webhook', 
        'origin_product_updated_webhook', 
        'origin_product_delete_webhook', 

        'ksa_order_create_webhook',
        'ksa_order_updated_webhook',
        'ksa_order_cancelled_webhook',
        'ksa_order_paid_webhook',
        'ksa_product_new_webhook',
        'ksa_product_updated_webhook',
        'ksa_product_delete_webhook',

        'kuwait_order_create_webhook',
        'kuwait_order_cancelled_webhook',
        'kuwait_order_paid_webhook',
        'kuwait_product_new_webhook',
        'kuwait_product_updated_webhook',
        'kuwait_product_delete_webhook',
        
        'uae_order_create_webhook',
        'uae_order_cancelled_webhook',
        'uae_order_paid_webhook',
        'uae_product_new_webhook',
        'uae_product_updated_webhook',
        'uae_product_delete_webhook',

        'fulfilment_placed_on_hold',
        'fulfilment_hold_release',
        'order_edited_webhook',
        
         'whatsapp',
         'UpdateTrackingStatus'
    ];
}
