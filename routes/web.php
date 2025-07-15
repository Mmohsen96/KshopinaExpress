<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NotificationController;
Route::get('send-sms-notification', [NotificationController::class, 'sendSmsNotificaition']);
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

Route::get('/', 'App\Http\Controllers\HomeController@main');
Route::get('/home', 'App\Http\Controllers\HomeController@main');
Route::get('/my_board', 'App\Http\Controllers\HomeController@dashboard_info')->name("my_board")->middleware('auth', 'staff');
Route::post('/search_home_page', 'App\Http\Controllers\HomeController@search_home_page');
Route::get('/staff', 'App\Http\Controllers\HomeController@index')->middleware('auth')->name("home");

Route::get('/dashboard', 'App\Http\Controllers\HomeController@dashboard')->name("dashboard")->middleware('auth', 'staff');
/* Route::get('/search', 'App\Http\Controllers\HomeController@search');
 */

Route::post('/get_data_of_week', 'App\Http\Controllers\HomeController@get_data_of_week');

Auth::routes();

Route::get('/staff_register', function () {
    return view('auth.register');
});

//performance

Route::get('/performance', 'App\Http\Controllers\PerformanceController@performancePage')->middleware('auth','userAdmin')->name("performance");

//


//dashboard

    Route::post('/submit_sticky_note', 'App\Http\Controllers\HomeController@submit_sticky_note');
    Route::post('/create_announcment', 'App\Http\Controllers\HomeController@create_announcment');
    Route::post('/get_note_attachments', 'App\Http\Controllers\HomeController@get_note_attachments');


    Route::post('/announcement_replies', 'App\Http\Controllers\HomeController@get_announcement_replies')->middleware('auth', 'staff');
    Route::post('/get_announcement_data', 'App\Http\Controllers\HomeController@get_announcment_data')->middleware('auth', 'staff');
    Route::post('/reply_to_announcement', 'App\Http\Controllers\HomeController@reply_to_announcement')->middleware('auth', 'staff');


    Route::post('/get_employee_attachments', 'App\Http\Controllers\HomeController@get_employee_attachments')->middleware('auth', 'staff');
//


//complains

    /* Route::get('/need_help', 'App\Http\Controllers\ComplainsController@index'); */
    Route::get('/complains_orders', 'App\Http\Controllers\ComplainsController@complains_page')->name("complaint_pending")->middleware('auth', 'staff');
    Route::get('/complains_orders_archived', 'App\Http\Controllers\ComplainsController@complains_page_archived')->name("complaint_archived")->middleware('auth', 'staff');
    Route::post('/solved', 'App\Http\Controllers\ComplainsController@solved')->middleware('auth', 'staff');
    Route::post('/send_message', 'App\Http\Controllers\ComplainsController@send_message');

    Route::post('/reply_complaint', 'App\Http\Controllers\ComplainsController@reply_complaint');

    Route::get('/complaint_ticket/{complain_number}', 'App\Http\Controllers\ComplainsController@get_complaint_replies');

    Route::post('/complaint_ticket/customer_complaint_reply', 'App\Http\Controllers\ComplainsController@customer_complaint_reply');

    Route::post('/complaint_ticket/rating', 'App\Http\Controllers\ComplainsController@send_rating');


    Route::post('/get_replies', 'App\Http\Controllers\ComplainsController@get_replies');

    Route::get('/need_help', 'App\Http\Controllers\ComplainsController@kmex_bot');

    Route::post('/send_first_mail_again', 'App\Http\Controllers\ComplainsController@send_first_mail_again');

    Route::post('/send_details_mail', 'App\Http\Controllers\ComplainsController@send_details_mail');

    Route::post('/send_tracking_mail', 'App\Http\Controllers\ComplainsController@send_tracking_mail');

    Route::post('/request_to_cancel_order', 'App\Http\Controllers\ComplainsController@request_to_cancel_order');

    Route::post('/reschedule_order', 'App\Http\Controllers\ComplainsController@reschedule_order');

    Route::post('/lmd_or_late', 'App\Http\Controllers\ComplainsController@lmd_or_late');

    Route::post('/customer_others', 'App\Http\Controllers\ComplainsController@customer_others');

    Route::post('/ask_about_product', 'App\Http\Controllers\ComplainsController@ask_about_product');

    Route::post('/guest_others', 'App\Http\Controllers\ComplainsController@guest_others');

    Route::get('/get_order_details', 'App\Http\Controllers\ComplainsController@get_order_details');
    
    /* changed */

    Route::get('/dicount_codes', 'App\Http\Controllers\ComplainsController@get_active_dicounts');

    Route::get('/services_payments', 'App\Http\Controllers\ComplainsController@get_services_payments');
    Route::get('/FAQS', 'App\Http\Controllers\ComplainsController@faqs');
    Route::get('/get_dicounts', 'App\Http\Controllers\ComplainsController@get_dicounts');
    Route::post('/update_discounts', 'App\Http\Controllers\ComplainsController@update_discounts');
    Route::get('/get_services_payments', 'App\Http\Controllers\ComplainsController@get_services_payments');
    Route::post('/update_services_payments', 'App\Http\Controllers\ComplainsController@update_services_payments');
    Route::post('/search_complaints', 'App\Http\Controllers\ComplainsController@search_complaints');

    Route::get('/get_faqs', 'App\Http\Controllers\ComplainsController@get_faqs_question')->middleware('auth', 'staff');

    Route::post('/update_faqs', 'App\Http\Controllers\ComplainsController@update_faqs_question')->middleware('auth', 'staff');

    Route::post('/send_something_wrong_mail', 'App\Http\Controllers\ComplainsController@send_something_wrong_mail');

    Route::get('/special_order/{complain_id}', 'App\Http\Controllers\ComplainsController@something_wrong_form');

    
    Route::post('/special_order/submit_somthing_wrong_form', 'App\Http\Controllers\ComplainsController@submit_somthing_wrong_form');

    Route::get('/complains_special_orders', 'App\Http\Controllers\ComplainsController@complains_special_page')->name("complaint_special")->middleware('auth', 'staff');

    Route::get('/new_chat', function () {
        return view('new_chatbot');
    });

    Route::get('/all_faqs', 'App\Http\Controllers\ComplainsController@all_faqs');

    Route::post('/open_ticket', 'App\Http\Controllers\ComplainsController@open_ticket_CS_side');

    Route::get('/complains_by_CS', 'App\Http\Controllers\ComplainsController@complains_by_CS')->name("complaint_CS")->middleware('auth', 'staff');

//

//domestic
    Route::get('/import_domestic_excel', 'App\Http\Controllers\DomesticController@import')->middleware('auth', 'staff'); //domestic page
    Route::post('/import_domestic_excel/upload', 'App\Http\Controllers\DomesticController@upload')->middleware('auth', 'staff');

    Route::post('/download_glt', 'App\Http\Controllers\DomesticController@download_glt')->middleware('auth', 'staff');
    Route::get('/get_items', 'App\Http\Controllers\DomesticController@get_items');

    //expired
        Route::post('/leftTheHub', 'App\Http\Controllers\DomesticController@left_the_hub')->middleware('auth', 'staff');
        Route::get('/delivery', 'App\Http\Controllers\DomesticController@delivery');

        Route::get('/domestic', 'App\Http\Controllers\DomesticController@index');
    //
//

//stock
    Route::get('/add_values', function () {
        return view('add_values');
    });
    Route::post('/submit_offline_order', 'App\Http\Controllers\StockController@submit_offline_order')->middleware('auth', 'staff');


    Route::get('/products_search', 'App\Http\Controllers\StockController@products_search_page');
    Route::get('/park_ksa', 'App\Http\Controllers\StockController@products_search_page_admin')->middleware('auth', 'staff');


    Route::post('/products_search_data', 'App\Http\Controllers\StockController@products_search_data');
    Route::post('get_similar_item_by_barcode', 'App\Http\Controllers\StockController@get_similar_item_by_barcode');
    Route::get('/products', 'App\Http\Controllers\StockController@index')->name('products')->middleware('auth', 'staff');
    /* Route::post('/export_products', 'App\Http\Controllers\StockController@export_products')->middleware('auth', 'staff'); */
    Route::post('/products_search_data_by_barcode', 'App\Http\Controllers\StockController@products_search_data_by_barcode');

    Route::post('/products_search_data_by_shopify_product_id', 'App\Http\Controllers\StockController@products_search_data_by_shopify_product_id');

    Route::post('/duplicate_product_by_product_id', 'App\Http\Controllers\StockController@duplicate_product_by_product_id');

    Route::post('TP_question', 'App\Http\Controllers\StockController@tp_submit_question');

    Route::get('/pre_alert', 'App\Http\Controllers\StockController@pre_alert_page')->name('pre_alert')->middleware('auth', 'staff');
    Route::get('/products_expired', 'App\Http\Controllers\StockController@out_of_stock_page')->name('products_expired')->middleware('auth', 'staff');
    Route::get('/search_products', 'App\Http\Controllers\StockController@search_products')->middleware('auth', 'staff');
    Route::get('/search_products_result', 'App\Http\Controllers\StockController@search_products_result')->middleware('auth', 'staff');
    Route::post('/get_variants', 'App\Http\Controllers\StockController@get_variants')->middleware('auth', 'staff');
    Route::post('/download_variant_barcode', 'App\Http\Controllers\StockController@download_variant_barcode')->middleware('auth', 'staff');
    Route::get('/products_in', 'App\Http\Controllers\StockController@products_in')->name('products_in')->middleware('auth', 'staff');
    Route::get('/products_out', 'App\Http\Controllers\StockController@products_out')->name('products_out')->middleware('auth', 'staff');
    Route::post('/scan_variant_barcode', 'App\Http\Controllers\StockController@scan_variant_barcode')->middleware('auth', 'staff');
    Route::post('/submit_variants_barcodes', 'App\Http\Controllers\StockController@submit_variants_barcodes')->middleware('auth', 'staff');
    /* Route::post('/export_stock', 'App\Http\Controllers\StockController@export_stock')->middleware('auth', 'staff'); */

    Route::post('/export_sales_report', 'App\Http\Controllers\StockController@export_sales_report')->middleware('auth', 'staff');
    Route::post('/export_products_filters', 'App\Http\Controllers\StockController@export_products_filters')->middleware('auth', 'staff');

    //expired
        /* Route::get('/add_item', 'App\Http\Controllers\StockController@add_item')->middleware('auth', 'staff'); */
        /* Route::get('/send_shipment', 'App\Http\Controllers\StockController@send_shipment'); */
        /* Route::post('/add_new_product', 'App\Http\Controllers\StockController@add_new_product'); */
        /* Route::get('/adjust', 'App\Http\Controllers\StockController@adjust_page')->middleware('auth', 'staff'); */
        /* Route::post('/adjust_quantity', 'App\Http\Controllers\StockController@adjust_quantity')->middleware('auth', 'staff'); */
        /* Route::get('/refresh_products', 'App\Http\Controllers\StockController@refresh_all_products')->name('products')->middleware('auth', 'staff'); */

    //
//

//verification
    Route::get('/first_verification', 'App\Http\Controllers\VerificationController@index')->name('pending')->middleware('auth', 'staff');
    Route::get('/first_verification_confirmed', 'App\Http\Controllers\VerificationController@confirmed')->name('confirmed')->middleware('auth', 'staff');
    Route::get('/first_verification_edited', 'App\Http\Controllers\VerificationController@edited')->name('edited')->middleware('auth', 'staff');
    Route::get('/first_verification_SVM', 'App\Http\Controllers\VerificationController@SVM')->name('SVM')->middleware('auth', 'staff');
    Route::get('/first_verification_FVM', 'App\Http\Controllers\VerificationController@FVM')->name('FVM')->middleware('auth', 'staff');
    Route::get('/first_verification_archived', 'App\Http\Controllers\VerificationController@archived')->name('verification_archived')->middleware('auth', 'staff');
    Route::post('/first_verification_export', 'App\Http\Controllers\VerificationController@export')->middleware('auth', 'staff');

    
    Route::post('/preorder', 'App\Http\Controllers\VerificationController@add_to_preorder')->middleware('auth', 'staff');
    Route::post('/paid', 'App\Http\Controllers\VerificationController@add_to_paid')->middleware('auth', 'staff');
    Route::post('/ignore', 'App\Http\Controllers\VerificationController@ignore_order')->middleware('auth', 'staff');
    Route::post('/verification_mail', 'App\Http\Controllers\VerificationController@verification_mail')->middleware('auth', 'staff');
    Route::post('/correct_mail', 'App\Http\Controllers\VerificationController@correct_mail')->middleware('auth', 'staff');
    Route::post('/send_correct_whatsApp_message', 'App\Http\Controllers\VerificationController@send_correct_whatsApp_message')->middleware('auth', 'staff');

    
    Route::get('/confirm', 'App\Http\Controllers\VerificationController@confirm_order');
    Route::get('/cancel', 'App\Http\Controllers\VerificationController@cancel_order');
    Route::post('/cancel_order', 'App\Http\Controllers\VerificationController@cancel_order_shopify');
    Route::post('/submit_order', 'App\Http\Controllers\VerificationController@update_shopify');

    Route::get('/edit', 'App\Http\Controllers\VerificationController@resubmit');
    Route::get('/edit_manually', 'App\Http\Controllers\VerificationController@edit_manually')->name('manuall')->middleware('auth', 'staff');
    Route::post('/update_editing', 'App\Http\Controllers\VerificationController@update_editing');
    Route::post('/first_verification_order', 'App\Http\Controllers\VerificationController@search_orders_result');
    Route::get('/edit_email', 'App\Http\Controllers\VerificationController@edit_email');


    /* Route::get('/update_fvm', 'App\Http\Controllers\WebhookController@add_new_manual_product')->middleware('auth', 'staff'); */

    
    Route::post('/add_group_tracking', 'App\Http\Controllers\VerificationController@add_group_tracking');

    Route::get('/first_verification_onHold', 'App\Http\Controllers\VerificationController@on_hold')->name('on_hold')->middleware('auth', 'staff');
    
    Route::post('/update_fulfilment_to_on_hold', 'App\Http\Controllers\VerificationController@update_fulfilment_to_on_hold');
    Route::post('/update_fulfilment_to_release', 'App\Http\Controllers\VerificationController@update_fulfilment_to_release');

    

    Route::get('/edit_phone', 'App\Http\Controllers\VerificationController@edit_phone');

    Route::post('/resend_fvm_message', 'App\Http\Controllers\VerificationController@resend_fvm_message');

//

// group orders 

    /*     Route::get('/group_orders', 'App\Http\Controllers\VerificationController@group_orders')->name('group')->middleware('auth', 'staff');*/

    Route::get('/group_order_form', 'App\Http\Controllers\GroupOrdersController@group_order_form');

    Route::post('/create_group_order', 'App\Http\Controllers\GroupOrdersController@create_group_order_customer');

    Route::get('/group_orders', 'App\Http\Controllers\GroupOrdersController@index')->name('group_orders')->middleware('auth', 'staff');

    Route::post('/change_zones_status', 'App\Http\Controllers\GroupOrdersController@change_zones_status')->middleware('auth', 'staff');

    Route::post('/update_group_product', 'App\Http\Controllers\GroupOrdersController@update_group_product')->middleware('auth', 'staff');

    Route::get('/get_zones', 'App\Http\Controllers\GroupOrdersController@get_zones')->middleware('auth', 'staff');

    Route::get('/get_group_products', 'App\Http\Controllers\GroupOrdersController@get_group_products')->middleware('auth', 'staff');

    Route::get('/get_group_order', 'App\Http\Controllers\GroupOrdersController@get_group_order')->middleware('auth', 'staff');

    Route::get('/get_active_group_products', 'App\Http\Controllers\GroupOrdersController@get_active_group_products');

    Route::get('/get_active_zones', 'App\Http\Controllers\GroupOrdersController@get_active_zones');

    Route::get('/confirmed_group_orders', 'App\Http\Controllers\GroupOrdersController@get_confirmed_group_orders')->name('confirmed_group_orders')->middleware('auth', 'staff');

    Route::post('/send_group_order_mail', 'App\Http\Controllers\GroupOrdersController@send_group_order_mail')->middleware('auth', 'staff');

    Route::get('/confirm_group', 'App\Http\Controllers\GroupOrdersController@confirm_group_order');

    Route::get('/cancel_group', 'App\Http\Controllers\GroupOrdersController@cancel_group_order');

    Route::get('/get_group_items', 'App\Http\Controllers\GroupOrdersController@get_group_items');

    Route::get('/group_order', 'App\Http\Controllers\GroupOrdersController@group_order_customer_page');

    Route::post('/left_group_order', 'App\Http\Controllers\GroupOrdersController@left_group_order');

    
    /* Route::post('/get_products_of_member', 'App\Http\Controllers\GroupOrdersController@get_products_of_member')->middleware('auth', 'staff'); */
    
    Route::post('/group_order_data', 'App\Http\Controllers\GroupOrdersController@group_order_data');

//

//tst


    Route::get('orders_by_awb', 'App\Http\Controllers\erp_controller@orders_by_awb')->name('orders_by_awb')->middleware('auth', 'staff');


    Route::get('/verified', 'App\Http\Controllers\erp_controller@verified_orders')->name('verified')->middleware('auth', 'staff');
    Route::get('/on_process', 'App\Http\Controllers\erp_controller@on_process_orders')->name('on_process')->middleware('auth', 'staff');
    Route::get('/fulfilled', 'App\Http\Controllers\erp_controller@fulfilled_orders')->name('fulfilled')->middleware('auth', 'staff');
    Route::get('tst', 'App\Http\Controllers\erp_controller@tst')->name('tst')->middleware('auth', 'staff');
    Route::get('archived', 'App\Http\Controllers\erp_controller@archived')->name('archived')->middleware('auth', 'staff');
    Route::post('/move_to_on_process', 'App\Http\Controllers\erp_controller@move_to_on_process')->middleware('auth', 'staff');
    Route::post('/fulfill_order', 'App\Http\Controllers\erp_controller@mark_order_as_fulfilled')->middleware('auth', 'staff');
    Route::post('/return_to_stock', 'App\Http\Controllers\erp_controller@return_to_stock')->middleware('auth', 'staff');

    Route::post('/erp', 'App\Http\Controllers\erp_controller@excel_functions')->middleware('auth', 'staff');

    Route::post('/cancel_confirmed', 'App\Http\Controllers\VerificationController@cancel_order_confirmed')->middleware('auth', 'staff');
    Route::post('/cancel_tst', 'App\Http\Controllers\VerificationController@cancel_order_tst')->middleware('auth', 'staff');
    Route::post('/return_to_confirmed', 'App\Http\Controllers\VerificationController@return_to_confirmed')->middleware('auth', 'staff');
    Route::post('/send_to_fct', 'App\Http\Controllers\erp_controller@send_to_fct')->middleware('auth', 'staff');
    Route::post('/submit_tst', 'App\Http\Controllers\erp_controller@submit');
    Route::post('/search_tst_order', 'App\Http\Controllers\erp_controller@search_orders_result_tst');


    Route::get('bulk', 'App\Http\Controllers\erp_controller@tst')->name('bulk')->middleware('auth', 'staff');
    Route::post('export_tst', 'App\Http\Controllers\erp_controller@export_tst')->middleware('auth', 'staff');

    Route::post('export_tst', 'App\Http\Controllers\erp_controller@export_tst')->middleware('auth', 'staff');
    Route::post('export_archived', 'App\Http\Controllers\erp_controller@export_archived')->middleware('auth', 'staff');
    Route::post('submit_awb_data', 'App\Http\Controllers\erp_controller@submit_awb_data')->middleware('auth', 'staff');
    
    Route::post('remove_from_awbs', 'App\Http\Controllers\erp_controller@remove_from_awbs')->middleware('auth', 'staff');

    
    //return
    Route::post('get_similar_item', 'App\Http\Controllers\StockController@get_similar_item')->middleware('auth', 'staff');
    Route::post('return_qty_to_stock', 'App\Http\Controllers\StockController@return_qty_to_stock')->middleware('auth', 'staff');
    Route::post('create_new_variant', 'App\Http\Controllers\StockController@create_new_variant')->middleware('auth', 'staff');

    Route::post('/create_new_product_return', 'App\Http\Controllers\StockController@create_new_return_product')->middleware('auth', 'staff');
    //
//


//fct

    Route::get('/fct', 'App\Http\Controllers\erp_controller@fct')->name('fct')->middleware('auth', 'staff');

    Route::get('fct', 'App\Http\Controllers\erp_controller@fct')->name('fct')->middleware('auth', 'staff');

    Route::get('/archived_fct', 'App\Http\Controllers\erp_controller@fct_archived')->name('fct_archived')->middleware('auth', 'staff');

    Route::post('/submit_fct', 'App\Http\Controllers\erp_controller@submit_fct')->middleware('auth', 'staff');

    Route::post('/search_fct', 'App\Http\Controllers\erp_controller@search_fct')->middleware('auth', 'staff');

//

//tasks
    Route::post('/assign_task', 'App\Http\Controllers\erp_controller@assign_task')->middleware('auth', 'staff');
    Route::get('/tasks', 'App\Http\Controllers\erp_controller@get_tasks')->name('tasks')->middleware('auth', 'staff');
    Route::post('/get_users', 'App\Http\Controllers\erp_controller@get_users');

    Route::get('/archived_tasks', 'App\Http\Controllers\erp_controller@get_archived_tasks')->name('tasks_archived')->middleware('auth', 'staff');

    Route::get('/assigned_tasks', 'App\Http\Controllers\erp_controller@get_assigned_tasks')->name('assigned')->middleware('auth', 'staff');

    Route::post('/new_currency', 'App\Http\Controllers\HomeController@new_currency')->middleware('auth', 'staff');
    Route::post('/add_task', 'App\Http\Controllers\erp_controller@add_task')->middleware('auth', 'staff');
    Route::get('/get_currency', 'App\Http\Controllers\HomeController@get_country_currency')->middleware('auth', 'staff');

    Route::post('/task_status', 'App\Http\Controllers\erp_controller@update_task_status')->middleware('auth', 'staff');

    Route::post('/assign_reply', 'App\Http\Controllers\erp_controller@assign_reply')->middleware('auth', 'staff');
    Route::post('/task_details', 'App\Http\Controllers\erp_controller@task_details')->middleware('auth', 'staff');
//


Route::get('/emails', function () {
    return view('emails_response');
});


// AWB
    Route::get('/staff_bulk_awb', 'App\Http\Controllers\DomesticController@staff_bulk_awb')->middleware('auth', 'staff'); 
    Route::post('/awb_bulk_upload_express', 'App\Http\Controllers\DomesticController@awb_bulk_upload_express')->middleware('auth', 'staff'); 

    
//


// KMEX

    // Client

            /* Route::get('/shipper_info', 'App\Http\Controllers\Auth\RegisterController@add_shipper_info')->name('shipper_info'); */

            /* Route::get('/new_order', 'App\Http\Controllers\ClientController@index')->name('new_order')->middleware('auth', 'client');
            */
            Route::post('/get_country_cities', 'App\Http\Controllers\ClientController@get_country_cities')->middleware('auth', 'client');
            Route::post('/send_shipper_info', 'App\Http\Controllers\ClientController@send_shipper_info')->middleware('auth');
            Route::post('/create_new_order', 'App\Http\Controllers\ClientController@create_new_order')->middleware('auth', 'client');


            Route::post('/scan_barcode', 'App\Http\Controllers\ClientController@scan_barcode');

            Route::get('/under_review', 'App\Http\Controllers\ClientController@under_review')->middleware('auth');

            Route::get('/new_order', 'App\Http\Controllers\ClientController@new_order')->name('create')->middleware('auth', 'client');

            Route::get('/shippment_list', 'App\Http\Controllers\ClientController@shippment_list')->name('shipments')->middleware('auth', 'client');

            Route::get('/profile', 'App\Http\Controllers\ClientController@profile')->middleware('auth', 'client');

            Route::post('/delete_shipment', 'App\Http\Controllers\ClientController@delete_client_shipment')->middleware('auth', 'client');

            Route::get('/track/shipment', 'App\Http\Controllers\ClientController@track_shipment');

            Route::post('/add_claim', 'App\Http\Controllers\ClientController@add_claim'); //yasmin


    //


    Route::get('/scanBarcodes', 'App\Http\Controllers\ClientController@scanBarcodes')->name('scan_barcodes')->middleware('auth', 'staff');

    Route::get('/shipments_managment', 'App\Http\Controllers\ClientController@shipmments_client')->name('warehouse')->middleware('auth', 'staff');

    Route::get('/pending_shipments', 'App\Http\Controllers\ClientController@get_shipments')->name('pending_shipments')->middleware('auth', 'staff');

    Route::get('/client_shipment_awb', 'App\Http\Controllers\ClientController@create_awb')->name('create_awb')->middleware('auth', 'staff');

    Route::get('/client_bulk_shipment_awb', 'App\Http\Controllers\ClientController@create_awb_by_bulk')->name('create_bulk_awb')->middleware('auth', 'staff');

    Route::post('/awb_bulk_upload', 'App\Http\Controllers\ClientController@awb_bulk_upload')->middleware('auth', 'staff');

    Route::post('/submit_barcodes', 'App\Http\Controllers\ClientController@submit_barcodes')->middleware('auth', 'staff');

    Route::post('/submit_dispatch', 'App\Http\Controllers\ClientController@submit_dispatch')->middleware('auth', 'staff');

    Route::post('/generate_awb', 'App\Http\Controllers\ClientController@generate_awb')->middleware('auth', 'staff');
    Route::post('/download_awb', 'App\Http\Controllers\ClientController@download_awb')->middleware('auth', 'staff');

    Route::get('/accounts_managment', 'App\Http\Controllers\ClientController@accounts_managment')->name('accounts')->middleware('auth', 'staff');
    Route::post('/toggle_active', 'App\Http\Controllers\ClientController@toggle_users_active')->middleware('auth', 'staff');

    Route::get('/scanBarcodes_details', 'App\Http\Controllers\ClientController@scanBarcodes_details')->middleware('auth', 'staff');

    Route::post('/search_shipment', 'App\Http\Controllers\ClientController@search_shipment_result'); //search

    Route::get('/vendors_shipments', 'App\Http\Controllers\ClientController@vendors_shipments')->name('vendors')->middleware('auth', 'staff');


//

Route::get('/mohsen', function () {
    return 'mohsen';
}); 

Route::post('/import_file', 'App\Http\Controllers\ClientController@import');

Route::post('/user_url', 'App\Http\Controllers\ClientController@insert_user_url');

Route::get('/upload_orders', 'App\Http\Controllers\ClientController@get_upload_orders_page')->name('upload')->middleware('auth', 'client');

/* Route::get('/import', 'App\Http\Controllers\ClientController@get_user_url'); */




/* Route::get('/staff_login', function () {
return view('auth.login');
}); */


/* Route::get('/login', function () {
return view('auth.client_register');
}); */


//expired
    Route::get('/import_excel', 'App\Http\Controllers\ImportExcelController@index')->middleware('auth', 'staff');
    Route::post('/import_excel/import', 'App\Http\Controllers\ImportExcelController@import')->middleware('auth', 'staff');
    Route::get('/import_excel/aramex', 'App\Http\Controllers\ImportExcelController@aramex');
    Route::post('/import_excel/product', 'App\Http\Controllers\ImportExcelController@product')->middleware('auth', 'staff');
    Route::get('/tracking/{kshopina_tracking}', 'App\Http\Controllers\TrackingController@index');
    Route::get('/QRcodes', 'App\Http\Controllers\QrCodesController@index')->middleware('auth', 'staff');
    Route::post('/generate', 'App\Http\Controllers\QrCodesController@generate')->middleware('auth', 'staff');
    Route::get('/scan', 'App\Http\Controllers\QrCodesController@scan');

    Route::get('/wrong', "App\Http\Controllers\QrCodesController@wrong_access");
    Route::get('/refused_orders', 'App\Http\Controllers\RefusedController@index')->middleware('auth', 'staff');

    Route::post('/delivered', 'App\Http\Controllers\QrCodesController@delivered');
    Route::post('/delivered_process', 'App\Http\Controllers\QrCodesController@delivered_process');

    Route::post('/wrongPhone', 'App\Http\Controllers\QrCodesController@wrongPhone');

    Route::post('/refused', 'App\Http\Controllers\QrCodesController@refused');
    Route::post('/refused_process', 'App\Http\Controllers\QrCodesController@refused_process');
    Route::post('/refused_cancel', 'App\Http\Controllers\QrCodesController@refused_cancel');

    Route::post('/contact_support', 'App\Http\Controllers\QrCodesController@contact_support');
    Route::get('/requests', 'App\Http\Controllers\QrCodesController@requests')->middleware('auth', 'staff');
    Route::post('/support_change', 'App\Http\Controllers\QrCodesController@support_change')->middleware('auth', 'staff');

//

// Webhook

    //GLOBAL

        Route::post('/fulfilment_placed_on_hold', 'App\Http\Controllers\WebhookController@fulfilment_placed_on_hold');

        Route::post('/fulfilment_hold_release', 'App\Http\Controllers\WebhookController@fulfilment_hold_release');
        
        //wait to see
        Route::post('/order_edited_webhook', 'App\Http\Controllers\WebhookController@order_edited_webhook');

        Route::get('/all_manual_create_new_order', 'App\Http\Controllers\WebhookController@origin_manual_create_new_shopify_order');

    //
    
    //egypt

        Route::post('/egypt_order_create_webhook', 'App\Http\Controllers\WebhookController@all_create_new_order');

        Route::post('/egypt_order_cancelled_webhook', 'App\Http\Controllers\WebhookController@egypt_cancelled_order');

        Route::post('/egypt_order_paid_webhook', 'App\Http\Controllers\WebhookController@egypt_paid_order');

        Route::post('/egypt_order_updated_webhook', 'App\Http\Controllers\WebhookController@order_edited');

        Route::post('/egypt_product_new_webhook', 'App\Http\Controllers\WebhookController@plus_add_new_product');

        Route::post('/egypt_product_updated_webhook', 'App\Http\Controllers\WebhookController@plus_product_updated');

        Route::post('/egypt_product_delete_webhook', 'App\Http\Controllers\WebhookController@plus_delete_product');

    //

    //origin
    
        Route::post('/origin_order_create_webhook', 'App\Http\Controllers\WebhookController@all_create_new_order');

        Route::post('/origin_order_updated_webhook', 'App\Http\Controllers\WebhookController@origin_order_edited');

        Route::post('/origin_order_cancelled_webhook', 'App\Http\Controllers\WebhookController@origin_cancelled_order');

        Route::post('/origin_order_paid_webhook', 'App\Http\Controllers\WebhookController@origin_paid_order');

        Route::post('/origin_product_new_webhook', 'App\Http\Controllers\WebhookController@plus_add_new_product');

        Route::post('/origin_product_updated_webhook', 'App\Http\Controllers\WebhookController@plus_product_updated');

        Route::post('/origin_product_delete_webhook', 'App\Http\Controllers\WebhookController@plus_delete_product');

    //

    //KSA
        Route::post('/ksa_order_create_webhook', 'App\Http\Controllers\WebhookController@all_create_new_order');

        Route::post('/ksa_order_updated_webhook', 'App\Http\Controllers\WebhookController@ksa_order_edited');

        Route::post('/ksa_order_cancelled_webhook', 'App\Http\Controllers\WebhookController@plus_cancelled_order');

        Route::post('/ksa_order_paid_webhook', 'App\Http\Controllers\WebhookController@plus_paid_order');

        Route::post('/ksa_product_new_webhook', 'App\Http\Controllers\WebhookController@plus_add_new_product');

        Route::post('/ksa_product_updated_webhook', 'App\Http\Controllers\WebhookController@plus_product_updated');

        Route::post('/ksa_product_delete_webhook', 'App\Http\Controllers\WebhookController@plus_delete_product');

        
    //

    //KUWAIT

        Route::post('/kuwait_order_create_webhook', 'App\Http\Controllers\WebhookController@all_create_new_order');

        Route::post('/kuwait_order_cancelled_webhook', 'App\Http\Controllers\WebhookController@plus_cancelled_order');

        Route::post('/kuwait_order_paid_webhook', 'App\Http\Controllers\WebhookController@plus_paid_order');

        Route::post('/kuwait_product_new_webhook', 'App\Http\Controllers\WebhookController@plus_add_new_product');

        Route::post('/kuwait_product_updated_webhook', 'App\Http\Controllers\WebhookController@plus_product_updated');

        Route::post('/kuwait_product_delete_webhook', 'App\Http\Controllers\WebhookController@plus_delete_product');

    //

    //UAE

        Route::post('/uae_order_create_webhook', 'App\Http\Controllers\WebhookController@all_create_new_order');

        Route::post('/uae_order_cancelled_webhook', 'App\Http\Controllers\WebhookController@plus_cancelled_order');

        Route::post('/uae_order_paid_webhook', 'App\Http\Controllers\WebhookController@plus_paid_order');

        Route::post('/uae_product_new_webhook', 'App\Http\Controllers\WebhookController@plus_add_new_product');

        Route::post('/uae_product_updated_webhook', 'App\Http\Controllers\WebhookController@plus_product_updated');

        Route::post('/uae_product_delete_webhook', 'App\Http\Controllers\WebhookController@plus_delete_product');
    //
//



 /* Route::get('/test', function () {
return view('warehouse_test');
});  */

Route::get('/whatsapp', 'App\Http\Controllers\WhatsAppController@whatsapp');
Route::post('/whatsapp', 'App\Http\Controllers\WhatsAppController@whatsapp_webhooks');

Route::get('/whatsapp_send_msg', 'App\Http\Controllers\WhatsAppController@whatsapp_send_message');
/* aramex_new_trackin  something */
Route::get('/something', 'App\Http\Controllers\VerificationController@something')->middleware('auth', 'staff');

Route::post('/UpdateTrackingStatus', 'App\Http\Controllers\TrackingUpdateController@update_tracking_status');



