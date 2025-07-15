<?php

namespace App\Models;
use DateTime;
use DateTimeZone;
use App\Mail\CorrectInfo;
use App\Mail\VerificationMail;
use App\Mail\OrderDetailsMail;
use App\Mail\GroupOrderMail;
use App\Mail\TrackingMail;
use App\Mail\fvmReminderMail;
use App\Mail\rateComplaintReminder;
use App\Mail\svmReminderMail;

use GuzzleHttp\Client as guzzle;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Verification extends Model
{
    use HasFactory;

    protected $status;
  
    public function __construct()
    {
        $this->status = ['Verified' => 0, 'Fulfilled' => 1, 'Dispatched' => 2, 'Kshopina_Warehouse' => 3, 'Delivery' => 4, 'Delivered' => 5, 'Refused' => 6];
        
    }


    public function get_last_order($store)
    {
        /* if ($store == 'origin') {
        $keyy = 'last_order';
        } else {
        $keyy = 'egypt_last_order';
        } */
        $check = DB::select('select * from config where type = ?', [$store]);
        if (isset($check[0])) {
            return $check;
        } else {
            return false;
        }
    }
    public function update_last_order($store, $last_order)
    {
        /*  if ($store == 'origin') {
        $keyy = 'last_order';
        } else {
        $keyy = 'egypt_last_order';
        } */
        $check = DB::select('select * from config where type = ?', [$store]);
        if (isset($check[0])) {
            DB::update('update config set value = ? where type = ?', [$last_order, $store]);
        }
    }
    public function get_new_from_shopify($store, $last_order)
    {
        $shopify_token = DB::table('config')->where('keyy', $store)->get()[0]->value;
        $store_url = DB::table('config')->where('keyy', $store . '_url')->get()[0]->value;

        $header = array(
            'http' => array(
                'method' => "GET",
                'header' => "X-Shopify-Access-Token: " . $shopify_token,
            ),
            "ssl" => array(
                "verify_peer" => false,
                "verify_peer_name" => false,
            ),
        );

        $context = stream_context_create($header);
        $order = $store_url . "/admin/api/2023-04/orders.json?since_id=" . $last_order . "&status=any";
        // Open the file using the HTTP headers set above
        $data = file_get_contents($order, false, $context);
        $order = json_decode($data);
        $order = $order->orders;

        return $order;
    }
    public function save_orders($store, $orders)
    {

        foreach ($orders as $key => $order) {

            if ($order->gateway == "Cash on Delivery (COD)") {
                $gateway = "COD";
                $category = 0;
            } else if ($order->gateway == "E-Wallet (Vodafone Cash / We Cash / Orange Cash and more..)" && $order->financial_status == 'paid') {
                $gateway = "E-Wallet";
                $category = 2;
            } elseif ($order->financial_status == 'paid') {
                $gateway = $order->gateway;
                $category = 2;
            }else{
                $gateway = $order->gateway;
                $category = 0;
            }

            if ($store == 'origin') {
                $order_number = $order->order_number;
            } else {
                $order_number = substr($order->name, 1);
            }
            if (!$this->isExist($store, $order->order_number)[0]) {

                date_default_timezone_set('Africa/Cairo');
                $date = date('Y-m-d H:i:s', time());

                //currency

                if ($store == 'origin') {
                    $currency_rate = "";
                    if ($order->shipping_address->country == 'Egypt') {
                        $currency_rate = $this->get_currency('EGP');
                    } else if ($order->shipping_address->country == 'Saudi Arabia') {
                        $currency_rate = $this->get_currency('SAR');
                    } else if ($order->shipping_address->country == 'United Arab Emirates') {
                        $currency_rate = $this->get_currency('AED');
                    } else if ($order->shipping_address->country == 'Bahrain') {
                        $currency_rate = $this->get_currency('BHD');
                    } else if ($order->shipping_address->country == 'Kuwait') {
                        $currency_rate = $this->get_currency('KWD');
                    } else if ($order->shipping_address->country == 'Oman') {
                        $currency_rate = $this->get_currency('OMR');
                    } else if ($order->shipping_address->country == 'Jordan') {
                        $currency_rate = $this->get_currency('JOD');
                    } else if ($order->shipping_address->country == 'Qatar') {
                        $currency_rate = $this->get_currency('QAR');
                    }

                    if ($currency_rate == "") {
                        $converted_price = $order->total_price;
                    } else {
                        $converted_price = $order->total_price * $currency_rate[0]->value;
                    }
                } else {
                    $converted_price = $order->total_price;
                }

                $order_date = date("Y-m-d H:i:s", strtotime($order->created_at));
                $order_data = array(
                    'order_number' => $order_number,
                    'name' => $order->shipping_address->name,
                    'email' => $order->contact_email,
                    'customer_id' => $order->customer->id,
                    'order_id' => $order->id,
                    'total_price' => $order->total_price,
                    'currency' => round($converted_price),
                    'phone_number' => $order->shipping_address->phone,
                    'address' => $order->shipping_address->address1,
                    'apartment' => $order->shipping_address->address2,
                    'city' => $order->shipping_address->city,
                    'country' => $order->shipping_address->country,
                    'province' => $order->shipping_address->province,
                    'gateway' => $gateway,
                    'token' => "",
                    'created_at' => $order_date,
                    'saved_at' => $date,
                    'verified' => 0,
                    'category' => $category,
                    'active' => 0,
                    'store' => $store,
                    'financial_status'=>$order->financial_status
                );
    
                if (!empty($order_data)) {
                    
                    DB::insert('insert into orders (order_number, name,email,customer_id,order_id,
                    total_price,currency,phone_number,address,apartment,city,country,province,gateway,token,created_at,saved_at,verified,category,active,store,financial_status)
                    values (?, ?,?,?, ?,?,?,?, ?,?,?, ?,?,?, ?,?,?, ?,?,?, ?,?)',
                        [
                            $order_number, $order->shipping_address->name, $order->contact_email, $order->customer->id,
                            $order->id, $order->total_price, round($converted_price), $order->shipping_address->phone, $order->shipping_address->address1,
                            $order->shipping_address->address2, $order->shipping_address->city, $order->shipping_address->country,
                            $order->shipping_address->province, $gateway, "", $order_date, $date, 0, 0, 0, $store,$order->financial_status
                        ]);
    
                        if ($store == 'origin') {
                            $cancel_at = "";
                            $status = "";
                            $country = "";
                            $city = "";
    
                            if (($order->gateway == "Cash on Delivery (COD)" || $order->gateway == "manual" ) && $order->cancelled_at != null && $order->financial_status == "voided") {
                                $cancel_at = date("Y-m-d H:i:s", strtotime($order->cancelled_at));
                                $status = "canceled";
                            } else if ($order->gateway == "Cash on Delivery (COD)" && $order->financial_status == "paid") {
                                $status = "confirmed";
                            }else if($order->gateway == "manual" && $order->financial_status == "paid" && $order->fulfillment_status == "fulfilled"){
                                $status = "confirmed";
                            }else {
                                $status = "pending";
                            }
        
                            try {
                                if (isset($order->customer->default_address)) {
                                    $country = $order->customer->default_address->country;
                                    $city = $order->customer->default_address->city;
                                } else {
                                    $country = "";
                                    $city = "";
                                }
        
                                DB::insert('insert into shopify_orders (order_number, order_id,currency,total_price,financial_status,gateway,note,tags,customer_id,email,first_name,last_name,phone,country,city,
                                orders_count,created_at,updated_at,cancelled_at,status) values (?, ?,?, ?,?, ?,?, ?,?, ?,?, ?,?, ?,?, ?,?, ?,?, ?)',
                                    [$order->order_number, $order->id, $order->currency, $order->total_price, $order->financial_status, $order->gateway, $order->note, $order->tags, $order->customer->id,
                                        $order->customer->email, $order->customer->first_name, $order->customer->last_name, $order->customer->phone, $country,
                                        $city, $order->customer->orders_count, date("Y-m-d H:i:s", strtotime($order->created_at)), date("Y-m-d H:i:s", strtotime($order->updated_at)),
                                        $cancel_at, $status]);
                            } catch (\Throwable $th) {
                                DB::insert('insert into errors (shipment_number,system_name,message) values (?)', [$order->order_number,'shopify_orders',$th]);
                            }
                        }
                }
            }
        }
        return $order_number;
    }
    
    public function isExist($store, $order_number)
    {
        $check = DB::select('SELECT * from orders where order_number = ? AND store = ?', [$order_number, $store]);

        if ($check == null || $check == []) {
            return [false, []];
        } else {
            return [true, $check];
        }
    }
    public function get_orders_from_database($store, $rule, $page)
    {
        $orders_per_page = 15;
        $offset = ($page - 1) * $orders_per_page;

        if ($rule == "All" || $rule == "Normal") {
            $category = 0;
        } elseif ($rule == "Pre-order") {
            $category = 1;
        } elseif ($rule == "Paid") {
            $category = 2;
        } else {
            $category = 0;
        }

        $orders = DB::select('SELECT * FROM orders where verified = ? And category = ? And active = ? AND store = ? ORDER BY created_at DESC LIMIT ?, ?;', [0, $category, 0, $store, $offset, $orders_per_page]);
        $number_of_orders = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM kshopina.orders where verified = ? And category = ? And active = ? AND store = ?;', [0, $category, 0, $store]);

        $number_of_new_FVM = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM kshopina.orders where verified = ? AND store = ? and (fulfillment_status != ? or fulfillment_status is null) ;', [2, $store,'on_hold']);
        $number_of_new_SVM = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM kshopina.orders where verified = ? AND store = ? and (fulfillment_status != ? or fulfillment_status is null) ;', [5, $store,'on_hold']);

        $number_of_FVM_pending = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM kshopina.orders where verified = ? AND store = ? ;', [1, $store]);
        $number_of_SVM_pending = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM kshopina.orders where verified = ? AND store = ? ;', [4, $store]);

        $number_of_on_hold = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM kshopina.orders where verified < ? AND store = ? and fulfillment_status = ? ;', [6, $store,'on_hold']);

        /* $number_of_SVM = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM kshopina.orders where verified = ? AND store = ? OR send_svm_at IS NOT NULL AND store = ? ;', [4, $store, $store]);
        $number_of_replied_SVM = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM kshopina.orders where info_edited_at IS NOT NULL AND store = ? ;', [$store]); */

        $number_of_confirmed_archived = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM kshopina.orders where verified = ? AND store = ? ;', [6, $store]);
        $number_of_canceled_archived = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM kshopina.orders where verified = ? AND store = ? ;', [3, $store]);

        /*         $orders_items = DB::select('SELECT * FROM (SELECT * FROM orders where verified = ? And category = ? And active = ? LIMIT ?, ?) as gah INNER JOIN items ON gah.order_number = items.order_id ;', [0, $category, 0,$offset, $orders_per_page]);
         */
        return [
            $number_of_orders, $orders, $number_of_FVM_pending, $number_of_SVM_pending, $number_of_new_FVM,
            $number_of_new_SVM, $number_of_on_hold,0, $number_of_confirmed_archived, $number_of_canceled_archived,

        ];
    }
    public function get_confirmed_orders_from_database($store, $rule, $page)
    {
        $orders_per_page = 15;
        $offset = ($page - 1) * $orders_per_page;
        $customer_history=[];
        if ($rule == "All") {
            $category = 123;
        } else if ($rule == "Normal") {
            $category = 0;
        } elseif ($rule == "Pre-order") {
            $category = 1;
        } elseif ($rule == "Paid") {
            $category = 2;
        } else {
            $category = 0;
        }

        if ($category == 123) {
            $orders = DB::select('SELECT * FROM orders where verified = ? And active = ? AND store = ? AND (fulfillment_status != "on_hold" OR fulfillment_status is null) ORDER BY created_at DESC LIMIT ?, ?;', [2, 0, $store, $offset, $orders_per_page]);
            $number_of_orders = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM kshopina.orders where verified = ? And active = ? AND store = ? AND (fulfillment_status != "on_hold" OR fulfillment_status is null);', [2, 0, $store]);
        } else {
            $orders = DB::select('SELECT * FROM orders where verified = ? And category = ? And active = ? AND store = ? AND (fulfillment_status != "on_hold" OR fulfillment_status is null) ORDER BY created_at DESC LIMIT ?, ?;', [2, $category, 0, $store, $offset, $orders_per_page]);
            $number_of_orders = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM kshopina.orders where verified = ? And category = ? And active = ? AND store = ? AND (fulfillment_status != "on_hold" OR fulfillment_status is null);', [2, $category, 0, $store]);
        }

        $customer_history=[];
        foreach ($orders as $order) {
            $customer_history[$order->customer_id]=DB::select('select * from shopify_orders where customer_id = ?', [$order->customer_id]);
        }

        $number_of_new_FVM = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM kshopina.orders where verified = ? AND store = ? and (fulfillment_status != ? or fulfillment_status is null) ;', [2, $store,'on_hold']);
        $number_of_new_SVM = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM kshopina.orders where verified = ? AND store = ? and (fulfillment_status != ? or fulfillment_status is null) ;', [5, $store,'on_hold']);

        $number_of_FVM_pending = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM kshopina.orders where verified = ? AND store = ? ;', [1, $store]);
        $number_of_SVM_pending = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM kshopina.orders where verified = ? AND store = ? ;', [4, $store]);

        $number_of_on_hold = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM kshopina.orders where verified < ? AND store = ? and fulfillment_status = ? ;', [6, $store,'on_hold']);

        /* $number_of_SVM = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM kshopina.orders where verified = ? AND store = ? OR send_svm_at IS NOT NULL AND store = ? ;', [4, $store, $store]);
        $number_of_replied_SVM = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM kshopina.orders where info_edited_at IS NOT NULL AND store = ? ;', [$store]); */

        $number_of_confirmed_archived = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM kshopina.orders where verified = ? AND store = ? ;', [6, $store]);
        $number_of_canceled_archived = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM kshopina.orders where verified = ? AND store = ? ;', [3, $store]);

        /*         $orders_items = DB::select('SELECT * FROM (SELECT * FROM orders where verified = ? And category = ? And active = ? LIMIT ?, ?) as gah INNER JOIN items ON gah.order_number = items.order_id ;', [0, $category, 0,$offset, $orders_per_page]);
         */
        return [
            $number_of_orders, $orders, $number_of_FVM_pending, $number_of_SVM_pending, $number_of_new_FVM,
            $number_of_new_SVM, $number_of_on_hold,0, $number_of_confirmed_archived, $number_of_canceled_archived,$customer_history

        ];
    }

    public function get_edited_orders_from_database($store, $rule, $page)
    {

        $orders_per_page = 15;
        $offset = ($page - 1) * $orders_per_page;
        if ($rule == "All") {
            $category = 123;
        } else if ($rule == "Normal") {
            $category = 0;
        } elseif ($rule == "Pre-order") {
            $category = 1;
        } elseif ($rule == "Paid") {
            $category = 2;
        } else {
            $category = 0;
        }

        if ($category == 123) {
            $orders = DB::select('SELECT * FROM orders where verified = ? And active = ? AND store = ? AND (fulfillment_status != "on_hold" OR fulfillment_status is null) ORDER BY created_at DESC LIMIT ?, ?;', [5, 0, $store, $offset, $orders_per_page]);
            $number_of_orders = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM kshopina.orders where verified = ? And active = ? AND store = ? AND (fulfillment_status != "on_hold" OR fulfillment_status is null);', [5, 0, $store]);
        } else {
            $orders = DB::select('SELECT * FROM orders where verified = ? And category = ? And active = ? AND store = ? AND (fulfillment_status != "on_hold" OR fulfillment_status is null) ORDER BY created_at DESC LIMIT ?, ?;', [5, $category, 0, $store, $offset, $orders_per_page]);
            $number_of_orders = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM kshopina.orders where verified = ? And category = ? And active = ? AND store = ? AND (fulfillment_status != "on_hold" OR fulfillment_status is null);', [5, $category, 0, $store]);
        }

        $customer_history=[];
        foreach ($orders as $order) {
            $customer_history[$order->customer_id]=DB::select('select * from shopify_orders where customer_id = ?', [$order->customer_id]);
        }

        $number_of_new_FVM = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM kshopina.orders where verified = ? AND store = ? and (fulfillment_status != ? or fulfillment_status is null) ;', [2, $store,'on_hold']);
        $number_of_new_SVM = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM kshopina.orders where verified = ? AND store = ? and (fulfillment_status != ? or fulfillment_status is null) ;', [5, $store,'on_hold']);

        $number_of_FVM_pending = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM kshopina.orders where verified = ? AND store = ? ;', [1, $store]);
        $number_of_SVM_pending = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM kshopina.orders where verified = ? AND store = ? ;', [4, $store]);

        $number_of_on_hold = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM kshopina.orders where verified < ? AND store = ? and fulfillment_status = ? ;', [6, $store,'on_hold']);

        /* $number_of_SVM = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM kshopina.orders where verified = ? AND store = ? OR send_svm_at IS NOT NULL AND store = ? ;', [4, $store, $store]);
        $number_of_replied_SVM = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM kshopina.orders where info_edited_at IS NOT NULL AND store = ? ;', [$store]); */

        $number_of_confirmed_archived = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM kshopina.orders where verified = ? AND store = ? ;', [6, $store]);
        $number_of_canceled_archived = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM kshopina.orders where verified = ? AND store = ? ;', [3, $store]);

        return [
            $number_of_orders, $orders, $number_of_FVM_pending, $number_of_SVM_pending, $number_of_new_FVM,
            $number_of_new_SVM, $number_of_on_hold,0, $number_of_confirmed_archived, $number_of_canceled_archived,$customer_history

        ];
    }
    public function get_on_hold_orders_from_database($store, $rule, $page)
    {

        $orders_per_page = 15;
        $offset = ($page - 1) * $orders_per_page;
        if ($rule == "All") {
            $category = 123;
        } else if ($rule == "Normal") {
            $category = 0;
        } elseif ($rule == "Pre-order") {
            $category = 1;
        } elseif ($rule == "Paid") {
            $category = 2;
        } else {
            $category = 0;
        }

        if ($category == 123) {
            $orders = DB::select('SELECT * FROM orders where verified < ? And active = ? AND store = ? AND fulfillment_status = "on_hold" ORDER BY created_at DESC LIMIT ?, ?;', [6, 0, $store, $offset, $orders_per_page]);
            $number_of_orders = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM kshopina.orders where verified < ? And active = ? AND store = ? AND fulfillment_status = "on_hold" ;', [6, 0, $store]);
        } else {
            $orders = DB::select('SELECT * FROM orders where verified < ? And category = ? And active = ? AND store = ? AND fulfillment_status = "on_hold" ORDER BY created_at DESC LIMIT ?, ?;', [6, $category, 0, $store, $offset, $orders_per_page]);
            $number_of_orders = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM kshopina.orders where verified < ? And category = ? And active = ? AND store = ? AND fulfillment_status = "on_hold" ;', [6, $category, 0, $store]);
        }

        $customer_history=[];
        if ($store =='origin') {
            foreach ($orders as $order) {
                $customer_history[$order->customer_id]=DB::select('select * from shopify_orders where customer_id = ?', [$order->customer_id]);
            }
        }

        $number_of_new_FVM = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM kshopina.orders where verified = ? AND store = ? and (fulfillment_status != ? or fulfillment_status is null) ;', [2, $store,'on_hold']);
        $number_of_new_SVM = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM kshopina.orders where verified = ? AND store = ? and (fulfillment_status != ? or fulfillment_status is null) ;', [5, $store,'on_hold']);

        $number_of_FVM_pending = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM kshopina.orders where verified = ? AND store = ? ;', [1, $store]);
        $number_of_SVM_pending = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM kshopina.orders where verified = ? AND store = ? ;', [4, $store]);

        $number_of_on_hold = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM kshopina.orders where verified < ? AND store = ? and fulfillment_status = ? ;', [6, $store,'on_hold']);

        /* $number_of_SVM = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM kshopina.orders where verified = ? AND store = ? OR send_svm_at IS NOT NULL AND store = ? ;', [4, $store, $store]);
        $number_of_replied_SVM = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM kshopina.orders where info_edited_at IS NOT NULL AND store = ? ;', [$store]); */

        $number_of_confirmed_archived = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM kshopina.orders where verified = ? AND store = ? ;', [6, $store]);
        $number_of_canceled_archived = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM kshopina.orders where verified = ? AND store = ? ;', [3, $store]);
        
        return [
            $number_of_orders, $orders, $number_of_FVM_pending, $number_of_SVM_pending, $number_of_new_FVM,
            $number_of_new_SVM, $number_of_on_hold,0, $number_of_confirmed_archived, $number_of_canceled_archived,$customer_history

        ];
    }

    public function get_FVM_orders_from_database($store, $rule, $page)
    {

        $orders_per_page = 15;
        $offset = ($page - 1) * $orders_per_page;
        if ($rule == "All") {
            $category = 123;
        } else if ($rule == "Normal") {
            $category = 0;
        } elseif ($rule == "Pre-order") {
            $category = 1;
        } elseif ($rule == "Paid") {
            $category = 2;
        } else {
            $category = 0;
        } 
        
        if ($category == 123) {
            $orders = DB::select('SELECT MAX(id) as id ,MAX(order_number) as order_number,MAX(verified) as verified,MAX(name) as name,MAX(email) as email,MAX(token) as token,
            MAX(order_id) as order_id,MAX(total_price) as total_price,MAX(currency) as currency,MAX(phone_number) as phone_number,MAX(country) as country,MAX(gateway) as gateway,
            MAX(created_at) as created_at,MAX(saved_at) as saved_at,MAX(category) as category,MAX(send_fvm_at) as send_fvm_at,MAX(send_svm_at) as send_svm_at,
            MAX(active) as active,MAX(store) as store,MAX(address) as address,MAX(apartment) as apartment,MAX(city) as city,MAX(province) as province,
            MAX(message_id) as message_id,MAX(message_order_number) as message_order_number,MAX(message_phone_number) as message_phone_number,MAX(customer_id) as customer_id,
            MAX(whatsapp_message_id) as whatsapp_message_id,MAX(message_sent) as message_sent,MAX(message_sent_at) as message_sent_at,MAX(message_delivered) as message_delivered,
            MAX(message_delivered_at) as message_delivered_at,MAX(message_read) as message_read,MAX(message_read_at) as message_read_at,MAX(message_name) as message_name
             from (
                SELECT * FROM orders left join whatsapp_send_messages on orders.order_number = whatsapp_send_messages.message_order_number 
                where verified = ? And active = ? AND store = ? ORDER BY send_fvm_at DESC) as orders where orders.message_name =  ? 
                OR orders.message_name is null OR orders.message_name != "fvm" group by order_number LIMIT ?, ?;', [1, 0, $store, 'fvm',$offset, $orders_per_page]);

            $number_of_orders = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM kshopina.orders where verified = ? And active = ? AND store = ?;', [1, 0, $store]);
        } else {
                
            $orders = DB::select('SELECT MAX(id) as id ,MAX(order_number) as order_number,MAX(verified) as verified,MAX(name) as name,MAX(email) as email,MAX(token) as token,
            MAX(order_id) as order_id,MAX(total_price) as total_price,MAX(currency) as currency,MAX(phone_number) as phone_number,MAX(country) as country,MAX(gateway) as gateway,
            MAX(created_at) as created_at,MAX(saved_at) as saved_at,MAX(category) as category,MAX(send_fvm_at) as send_fvm_at,MAX(send_svm_at) as send_svm_at,
            MAX(active) as active,MAX(store) as store,MAX(address) as address,MAX(apartment) as apartment,MAX(city) as city,MAX(province) as province,
            MAX(message_id) as message_id,MAX(message_order_number) as message_order_number,MAX(message_phone_number) as message_phone_number,MAX(customer_id) as customer_id,
            MAX(whatsapp_message_id) as whatsapp_message_id,MAX(message_sent) as message_sent,MAX(message_sent_at) as message_sent_at,MAX(message_delivered) as message_delivered,
            MAX(message_delivered_at) as message_delivered_at,MAX(message_read) as message_read,MAX(message_read_at) as message_read_at,MAX(message_name) as message_name
             from (
                SELECT * FROM orders left join whatsapp_send_messages on orders.order_number = whatsapp_send_messages.message_order_number 
                where verified = ? And category = ? And active = ? AND store = ? ORDER BY send_fvm_at DESC) as orders where orders.message_name =  ? 
                OR orders.message_name is null OR orders.message_name != "fvm" group by order_number LIMIT ?, ?;', [1, $category, 0, $store, 'fvm', $offset, $orders_per_page]);

            $number_of_orders = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM kshopina.orders where verified = ? And category = ? And active = ? AND store = ?;', [1, $category, 0, $store]);
        }
        $customer_history=[];
        foreach ($orders as $order) {
            $customer_history[$order->customer_id]=DB::select('select * from shopify_orders where customer_id = ?', [$order->customer_id]);
        }
        $number_of_new_FVM = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM kshopina.orders where verified = ? AND store = ? and (fulfillment_status != ? or fulfillment_status is null) ;', [2, $store,'on_hold']);
        $number_of_new_SVM = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM kshopina.orders where verified = ? AND store = ? and (fulfillment_status != ? or fulfillment_status is null) ;', [5, $store,'on_hold']);

        $number_of_FVM_pending = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM kshopina.orders where verified = ? AND store = ? ;', [1, $store]);
        $number_of_SVM_pending = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM kshopina.orders where verified = ? AND store = ? ;', [4, $store]);

        $number_of_on_hold = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM kshopina.orders where verified < ? AND store = ? and fulfillment_status = ? ;', [6, $store,'on_hold']);

        /* $number_of_SVM = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM kshopina.orders where verified = ? AND store = ? OR send_svm_at IS NOT NULL AND store = ? ;', [4, $store, $store]);
        $number_of_replied_SVM = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM kshopina.orders where info_edited_at IS NOT NULL AND store = ? ;', [$store]); */

        $number_of_confirmed_archived = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM kshopina.orders where verified = ? AND store = ? ;', [6, $store]);
        $number_of_canceled_archived = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM kshopina.orders where verified = ? AND store = ? ;', [3, $store]);

        return [
            $number_of_orders, $orders, $number_of_FVM_pending, $number_of_SVM_pending, $number_of_new_FVM,
            $number_of_new_SVM, $number_of_on_hold,0, $number_of_confirmed_archived, $number_of_canceled_archived,$customer_history

        ];
    }
    public function get_SVM_orders_from_database($store, $rule, $page)
    {

        $orders_per_page = 15;
        $offset = ($page - 1) * $orders_per_page;
        if ($rule == "All") {
            $category = 123;
        } else if ($rule == "Normal") {
            $category = 0;
        } elseif ($rule == "Pre-order") {
            $category = 1;
        } elseif ($rule == "Paid") {
            $category = 2;
        } else {
            $category = 0;
        }
        
        if ($category == 123) {
            $orders = DB::select('SELECT MAX(id) as id ,MAX(order_number) as order_number,MAX(verified) as verified,MAX(name) as name,MAX(email) as email,MAX(token) as token,
            MAX(order_id) as order_id,MAX(total_price) as total_price,MAX(currency) as currency,MAX(phone_number) as phone_number,MAX(country) as country,MAX(gateway) as gateway,
            MAX(created_at) as created_at,MAX(saved_at) as saved_at,MAX(category) as category,MAX(send_fvm_at) as send_fvm_at,MAX(send_svm_at) as send_svm_at,
            MAX(active) as active,MAX(store) as store,MAX(address) as address,MAX(apartment) as apartment,MAX(city) as city,MAX(province) as province,
            MAX(message_id) as message_id,MAX(message_order_number) as message_order_number,MAX(message_phone_number) as message_phone_number,MAX(customer_id) as customer_id,
            MAX(whatsapp_message_id) as whatsapp_message_id,MAX(message_sent) as message_sent,MAX(message_sent_at) as message_sent_at,MAX(message_delivered) as message_delivered,
            MAX(message_delivered_at) as message_delivered_at,MAX(message_read) as message_read,MAX(message_read_at) as message_read_at,MAX(message_name) as message_name
             from (
                SELECT * FROM orders left join whatsapp_send_messages on orders.order_number = whatsapp_send_messages.message_order_number 
                where verified = ? And active = ? AND store = ? ORDER BY send_svm_at DESC) as orders where orders.message_name =  ? 
                OR orders.message_name is null OR orders.message_name != "svm" group by order_number LIMIT ?, ?;', [4, 0, $store,'svm', $offset, $orders_per_page]);
            
            $number_of_orders = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM kshopina.orders where verified = ? And active = ? AND store = ?;', [4, 0, $store]);
        } else {
            
            $orders = DB::select('SELECT MAX(id) as id ,MAX(order_number) as order_number,MAX(verified) as verified,MAX(name) as name,MAX(email) as email,MAX(token) as token,
            MAX(order_id) as order_id,MAX(total_price) as total_price,MAX(currency) as currency,MAX(phone_number) as phone_number,MAX(country) as country,MAX(gateway) as gateway,
            MAX(created_at) as created_at,MAX(saved_at) as saved_at,MAX(category) as category,MAX(send_fvm_at) as send_fvm_at,MAX(send_svm_at) as send_svm_at,
            MAX(active) as active,MAX(store) as store,MAX(address) as address,MAX(apartment) as apartment,MAX(city) as city,MAX(province) as province,
            MAX(message_id) as message_id,MAX(message_order_number) as message_order_number,MAX(message_phone_number) as message_phone_number,MAX(customer_id) as customer_id,
            MAX(whatsapp_message_id) as whatsapp_message_id,MAX(message_sent) as message_sent,MAX(message_sent_at) as message_sent_at,MAX(message_delivered) as message_delivered,
            MAX(message_delivered_at) as message_delivered_at,MAX(message_read) as message_read,MAX(message_read_at) as message_read_at,MAX(message_name) as message_name
             from (
                SELECT * FROM orders left join whatsapp_send_messages on orders.order_number = whatsapp_send_messages.message_order_number 
                where verified = ? And category = ? And active = ? AND store = ? ORDER BY send_svm_at DESC) as orders where orders.message_name =  ? 
                OR orders.message_name is null OR orders.message_name != "svm" group by order_number LIMIT ?, ?;', [4, $category, 0, $store,'svm', $offset, $orders_per_page]);

            $number_of_orders = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM kshopina.orders where verified = ? And category = ? And active = ? AND store = ?;', [4, $category, 0, $store]);
        }

        $customer_history=[];
        foreach ($orders as $order) {
            $customer_history[$order->customer_id]=DB::select('select * from shopify_orders where customer_id = ?', [$order->customer_id]);
        }

        $number_of_new_FVM = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM kshopina.orders where verified = ? AND store = ? and (fulfillment_status != ? or fulfillment_status is null) ;', [2, $store,'on_hold']);
        $number_of_new_SVM = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM kshopina.orders where verified = ? AND store = ? and (fulfillment_status != ? or fulfillment_status is null) ;', [5, $store,'on_hold']);

        $number_of_FVM_pending = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM kshopina.orders where verified = ? AND store = ? ;', [1, $store]);
        $number_of_SVM_pending = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM kshopina.orders where verified = ? AND store = ? ;', [4, $store]);

        $number_of_on_hold = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM kshopina.orders where verified < ? AND store = ? and fulfillment_status = ? ;', [6, $store,'on_hold']);

        /* $number_of_SVM = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM kshopina.orders where verified = ? AND store = ? OR send_svm_at IS NOT NULL AND store = ? ;', [4, $store, $store]);
        $number_of_replied_SVM = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM kshopina.orders where info_edited_at IS NOT NULL AND store = ? ;', [$store]); */

        $number_of_confirmed_archived = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM kshopina.orders where verified = ? AND store = ? ;', [6, $store]);
        $number_of_canceled_archived = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM kshopina.orders where verified = ? AND store = ? ;', [3, $store]);

        return [
            $number_of_orders, $orders, $number_of_FVM_pending, $number_of_SVM_pending, $number_of_new_FVM,
            $number_of_new_SVM, $number_of_on_hold,0, $number_of_confirmed_archived, $number_of_canceled_archived,$customer_history

        ];
    }
    public function get_archived_orders_from_database($store, $rule, $page)
    {

        $orders_per_page = 15;
        $offset = ($page - 1) * $orders_per_page;
        if ($rule == "All") {
            $category = 123;
        } else if ($rule == "Normal") {
            $category = 0;
        } elseif ($rule == "Pre-order") {
            $category = 1;
        } elseif ($rule == "Paid") {
            $category = 2;
        } else {
            $category = 0;
        }

        if ($category == 123) {
            $orders = DB::select('SELECT * FROM orders where (verified = ? OR verified = ?) AND store = ? ORDER BY created_at DESC LIMIT ?, ?;', [6, 3, $store, $offset, $orders_per_page]);
            $number_of_orders = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM kshopina.orders where (verified = ? OR verified = ?) AND store = ? ;', [6, 3, $store]);
        } else {
            $orders = DB::select('SELECT * FROM orders where (verified = ? OR verified = ?) And category = ? AND store = ? ORDER BY created_at DESC LIMIT ?, ?;', [6, 3, $category, $store, $offset, $orders_per_page]);
            $number_of_orders = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM kshopina.orders where (verified = ? OR verified = ?) And category = ? AND store = ? ', [6, 3, $category, $store]);
        }

        $customer_history=[];
        foreach ($orders as $order) {
            $customer_history[$order->customer_id]=DB::select('select * from shopify_orders where customer_id = ?', [$order->customer_id]);
        }

        $number_of_new_FVM = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM kshopina.orders where verified = ? AND store = ? and (fulfillment_status != ? or fulfillment_status is null) ;', [2, $store,'on_hold']);
        $number_of_new_SVM = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM kshopina.orders where verified = ? AND store = ? and (fulfillment_status != ? or fulfillment_status is null) ;', [5, $store,'on_hold']);

        $number_of_FVM_pending = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM kshopina.orders where verified = ? AND store = ? ;', [1, $store]);
        $number_of_SVM_pending = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM kshopina.orders where verified = ? AND store = ? ;', [4, $store]);

        $number_of_on_hold = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM kshopina.orders where verified < ? AND store = ? and fulfillment_status = ? ;', [6, $store,'on_hold']);

        /* $number_of_SVM = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM kshopina.orders where verified = ? AND store = ? OR send_svm_at IS NOT NULL AND store = ? ;', [4, $store, $store]);
        $number_of_replied_SVM = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM kshopina.orders where info_edited_at IS NOT NULL AND store = ? ;', [$store]); */

        $number_of_confirmed_archived = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM kshopina.orders where verified = ? AND store = ? ;', [6, $store]);
        $number_of_canceled_archived = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM kshopina.orders where verified = ? AND store = ? ;', [3, $store]);

        return [
            $number_of_orders, $orders, $number_of_FVM_pending, $number_of_SVM_pending, $number_of_new_FVM,
            $number_of_new_SVM, $number_of_on_hold,0, $number_of_confirmed_archived, $number_of_canceled_archived,$customer_history

        ];
    }
    public function get_group_orders_from_database($store, $rule, $page)
    {
        $orders_per_page = 15;
        $offset = ($page - 1) * $orders_per_page;

        $orders = DB::select('SELECT * FROM group_orders ORDER BY updated_at DESC LIMIT ?, ?;', [$offset, $orders_per_page]);
        $number_of_orders = DB::select('SELECT COUNT(group_orders_id) AS NumberOfOrders FROM kshopina.group_orders;');

        $number_of_new_FVM = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM kshopina.orders where verified = ? AND store = ? and (fulfillment_status != ? or fulfillment_status is null);', [2, $store,'on_hold']);
        $number_of_new_SVM = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM kshopina.orders where verified = ? AND store = ? and (fulfillment_status != ? or fulfillment_status is null) ;', [5, $store,'on_hold']);

        $number_of_FVM_pending = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM kshopina.orders where verified = ? AND store = ? ;', [1, $store]);
        $number_of_SVM_pending = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM kshopina.orders where verified = ? AND store = ? ;', [4, $store]);

        $number_of_on_hold = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM kshopina.orders where verified < ? AND store = ? and fulfillment_status = ? ;', [6, $store,'on_hold']);

        /* $number_of_SVM = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM kshopina.orders where verified = ? AND store = ? OR send_svm_at IS NOT NULL AND store = ? ;', [4, $store, $store]);
        $number_of_replied_SVM = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM kshopina.orders where info_edited_at IS NOT NULL AND store = ? ;', [$store]); */

        $number_of_confirmed_archived = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM kshopina.orders where verified = ? AND store = ? ;', [6, $store]);
        $number_of_canceled_archived = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM kshopina.orders where verified = ? AND store = ? ;', [3, $store]);

        return [
            $number_of_orders, $orders, $number_of_FVM_pending, $number_of_SVM_pending, $number_of_new_FVM,
            $number_of_new_SVM, $number_of_on_hold,0, $number_of_confirmed_archived, $number_of_canceled_archived,
        ];
    }

    public function edit_phone($order_number, $new_phone)
    {
        return DB::table('orders')->where('order_number', $order_number)->update(['phone_number' => $new_phone]);
    }

    public function get_order_data_by_order_number($order_number){
        return DB::select('SELECT * from orders where order_number =? ',[$order_number]);
    }
    
    public function change_to_preorder($order_number)
    {

        date_default_timezone_set('Africa/Cairo');
        $date = date('Y-m-d H:i:s', time());

        DB::table('orders')->where('order_number',$order_number)->update(['category'=>1 ,'categorised_by'=>Auth::user()->name,'categorised_at'=>$date]);
    }
    public function change_to_paid($order_number)
    {
        DB::update('update orders set category = 2 where order_number = ?', [$order_number]);
    }
    public function ignore_order_verification($order_id)
    {
        DB::update('update orders set active = 1 where id = ?', [$order_id]);
    }
    public function first_verification_mail($store, $order_number, $token)
    {
        $tags = "";
        $order = DB::table('orders')->where('order_number', $order_number)->get();
        $items = DB::select('select * from items where order_id = ?', [$order_number]);
        $shopify_id = $order[0]->order_id;

        date_default_timezone_set('Africa/Cairo');
        $date = date('Y-m-d H:i:s', time());

        DB::table('orders')->where('order_number', $order_number)->update(['verified' => 1, 'token' => $token, 'send_fvm_at' => $date]);

        if ($store == 'origin') {
            $converted_price = $order[0]->currency;
            $country_currency = "";
            $arabic_currency = "";
            if ($order[0]->country == 'Egypt') {
                $country_currency = 'EGP';
                $arabic_currency = 'جنيه مصري';
            } else if ($order[0]->country == 'Saudi Arabia') {
                $country_currency = 'SAR';
                $arabic_currency = 'ريال سعودي';
            } else if ($order[0]->country == 'United Arab Emirates') {
                $country_currency = 'AED';
                $arabic_currency = 'درهم اماراتي';
            } else if ($order[0]->country == 'Bahrain') {
                $country_currency = 'BHD';
                $arabic_currency = 'دينار بحريني';
            } else if ($order[0]->country == 'Kuwait') {
                $country_currency = 'KWD';
                $arabic_currency = 'دينار كويتي';
            } else if ($order[0]->country == 'Oman') {
                $country_currency = 'OMR';
                $arabic_currency = 'ريال عماني';
            } else if ($order[0]->country == 'Jordan') {
                $country_currency = 'JOD';
                $arabic_currency = 'دينار اردني';
            } else if ($order[0]->country == 'Qatar') {
                $country_currency = 'QAR';
                $arabic_currency = 'ريال قطري';
            } else {
                $country_currency = 'USD';
                $arabic_currency = 'دولار';
            }

        } else if ($store == 'plus_egypt') {
            $country_currency = 'EGP';
            $arabic_currency = 'جنيه مصري';
            $converted_price = $order[0]->total_price;
        } else if ($store == 'plus_ksa') {
            $country_currency = 'SAR';
            $arabic_currency = 'ريال سعودي';
            $converted_price = $order[0]->total_price;
        } else if ($store == 'plus_kuwait') {
            $country_currency = 'KWD';
            $arabic_currency = 'دينار كويتي';
            $converted_price = $order[0]->total_price;
        }else if ($store == 'plus_uae') {
            $country_currency = 'AED';
            $arabic_currency = 'درهم إماراتي';
            $converted_price = $order[0]->total_price;
        }

        /*  $confirm_url = "http://localhost:8888/public/" . "confirm?token=" . $token;
        $cancel_url = "http://localhost:8888/public/" . "cancel?token=" . $token; */

        $confirm_url ='https://kshopinaexpress.com/' . "confirm?token=" . $token;
        $cancel_url = 'https://kshopinaexpress.com/' . "cancel?token=" . $token;

        $data1 = [
            'order_number' => $order_number,
            'items' => $items,
            'price' => $converted_price,
            'currency' => $country_currency,
            'arabic_currency' => $arabic_currency,
            'confirm_url' => $confirm_url,
            'cancel_url' => $cancel_url,
            'country' => $order[0]->country,
            'city' => $order[0]->city,
            'address' => $order[0]->address,
            'phone_number' => $order[0]->phone_number,
        ];
        Mail::to($order[0]->email)->send(new VerificationMail($data1), function ($message) {
            $message->subject("Verification Order");
        });

        //add tag

        $shopify_token = DB::table('config')->where('keyy', $store)->get()[0]->value;
        $store_url = DB::table('config')->where('keyy', $store . '_url')->get()[0]->value;
        $store_myshopify_url = DB::table('config')->where('keyy', $store . '_myshopify')->get()[0]->value;

        $header = array(
            'http' => array(
                'method' => "GET",
                'header' => "X-Shopify-Access-Token: " . $shopify_token,
            ),
            "ssl" => array(
                "verify_peer" => false,
                "verify_peer_name" => false,
            ),
        );

        $context = stream_context_create($header);
        $order = $store_url . "/admin/api/2023-04/orders.json?name=" . $order_number . "&status=any";
        // Open the file using the HTTP headers set above
        $data = file_get_contents($order, false, $context);
        $order = json_decode($data);
        $order = $order->orders;

        foreach ($order as $key => $value) {
            $tags = $value->tags;
        }
        if (empty($tags) || $tags == "") {
            $tags = "Waiting_for_confirmation";
        } else {
            $tags = $tags . ",Waiting_for_confirmation";
        }

        $client = new guzzle([
            'headers' => [
                'Content-Type' => 'application/json',
                'X-Shopify-Access-Token' => $shopify_token,
                'debug' => true,
            ],
            "ssl" => [
                "verify_peer" => false,
                "verify_peer_name" => false,
            ],
        ]);

        $URI = $store_myshopify_url . '/admin/api/2023-04/orders/' . $shopify_id . '.json';

        $body = ["order" => ['id' => $shopify_id, 'tags' => $tags]];

        $body = json_encode($body);
        $URI_Response = $client->request('PUT', $URI, ['body' => $body]);
    }
    public function details_mail($store, $order_number, $token)
    {
        $order = DB::table('orders')->where('order_number', $order_number)->get();
        $items = DB::select('select * from items where order_id = ? and product_name != "Cash on Delivery fee" ', [$order_number]);

        if ($store == 'origin') {
            $converted_price = $order[0]->currency;
            $country_currency = "";
            $arabic_currency = "";
            if ($order[0]->country == 'Egypt') {
                $country_currency = 'EGP';
                $arabic_currency = 'جنيه مصري';
            } else if ($order[0]->country == 'Saudi Arabia') {
                $country_currency = 'SAR';
                $arabic_currency = 'ريال سعودي';
            } else if ($order[0]->country == 'United Arab Emirates') {
                $country_currency = 'AED';
                $arabic_currency = 'درهم اماراتي';
            } else if ($order[0]->country == 'Bahrain') {
                $country_currency = 'BHD';
                $arabic_currency = 'دينار بحريني';
            } else if ($order[0]->country == 'Kuwait') {
                $country_currency = 'KWD';
                $arabic_currency = 'دينار كويتي';
            } else if ($order[0]->country == 'Oman') {
                $country_currency = 'OMR';
                $arabic_currency = 'ريال عماني';
            } else if ($order[0]->country == 'Jordan') {
                $country_currency = 'JOD';
                $arabic_currency = 'دينار اردني';
            } else if ($order[0]->country == 'Qatar') {
                $country_currency = 'QAR';
                $arabic_currency = 'ريال قطري';
            } else {
                $country_currency = 'USD';
                $arabic_currency = 'دولار';
            }

        } else if ($store == 'plus_egypt') {
            $country_currency = 'EGP';
            $arabic_currency = 'جنيه مصري';
            $converted_price = $order[0]->total_price;
        } else if ($store == 'plus_ksa') {
            $country_currency = 'SAR';
            $arabic_currency = 'ريال سعودي';
            $converted_price = $order[0]->total_price;
        } else if ($store == 'plus_kuwait') {
            $country_currency = 'KWD';
            $arabic_currency = 'دينار كويتي';
            $converted_price = $order[0]->total_price;
        }else if ($store == 'plus_uae') {
            $country_currency = 'AED';
            $arabic_currency = 'درهم إماراتي';
            $converted_price = $order[0]->total_price;
        }

        /*  $confirm_url = "http://localhost:8888/public/" . "confirm?token=" . $token;
        $cancel_url = "http://localhost:8888/public/" . "cancel?token=" . $token; */

        $confirm_url = url('') . '/' . "confirm?token=" . $token;
        $cancel_url = url('') . '/' . "cancel?token=" . $token;

        $data1 = [
            'order_number' => $order_number,
            'customer_name' => $order[0]->name,
            'items' => $items,
            'price' => $converted_price,
            'currency' => $country_currency,
            'arabic_currency' => $arabic_currency,
            'country' => $order[0]->country,
            'city' => $order[0]->city,
            'address' => $order[0]->address,
            'phone_number' => $order[0]->phone_number,
        ];
        Mail::to($order[0]->email)->send(new OrderDetailsMail($data1), function ($message) {
            $message->subject("Order Details");
        });
    }
    public function generate_url($order_number)
    {
        $order = DB::table('orders')->where('order_number', $order_number)->get();
        $id = $order[0]->id;

        $bytes = random_bytes(20);
        $token = bin2hex($bytes) . $id;

        return $token;
    }
    public function confirmORcancel($token, $case)
    {
        $order = DB::table('orders')->where('token', $token)->get();
        date_default_timezone_set('Africa/Cairo');
        $date = date('Y-m-d H:i:s', time());

        if ($case == 'confirm') {
            DB::table('orders')->where('token', $token)->update(['verified' => 2,'fvm_replay_at'=>$date]);
        } else {
            DB::table('orders')->where('token', $token)->update(['verified' => 3, 'active' => 1,'fvm_replay_at'=>$date]);
        }
        return $order[0]->order_number;
    }
    public function action_by($order_number, $user_name)
    {
        date_default_timezone_set('Africa/Cairo');
        $date = date('Y-m-d H:i:s', time());

        DB::table('orders')->where('order_number', $order_number)->update(['action_taken_by' => $user_name, 'action_taken_at' => $date]);
    }
    public function cancel_shopify($store, $order_number,$system)
    {
        $order_data = DB::table('orders')->where('order_number', $order_number)->get();
        $tags = "";
        $shopify_id = $order_data[0]->order_id;

        $shopify_token = DB::table('config')->where('keyy', $order_data[0]->store)->get()[0]->value;
        $store_url = DB::table('config')->where('keyy', $order_data[0]->store . '_url')->get()[0]->value;
        $store_myshopify_url = DB::table('config')->where('keyy', $order_data[0]->store . '_myshopify')->get()[0]->value;


        date_default_timezone_set('Africa/Cairo');
        $date = date('Y-m-d H:i:s', time());

        if ($system=='verification') {
            DB::table('orders')->where('order_number', $order_data[0]->order_number)->update(['verified' => 3, 'active' => 1]);
        } else {
            DB::table('orders')->where('order_number', $order_number)->update([
                'status' => 0, 'actions' => 1,'financial_status'=>"voided", 'canceled_at' => $date, 'canceled_by' => Auth::user()->name]);
        }
        

        $header = array(
            'http' => array(
                'method' => "GET",
                'header' => "X-Shopify-Access-Token: " . $shopify_token,

            ),
            "ssl" => array(
                "verify_peer" => false,
                "verify_peer_name" => false,
            ),
        );

        $context = stream_context_create($header);
        $order = $store_url . "/admin/api/2023-04/orders.json?name=" . $order_number . "&status=any";
        // Open the file using the HTTP headers set above
        $data = file_get_contents($order, false, $context);
        $order = json_decode($data);
        $order = $order->orders;

        foreach ($order as $key => $value) {
            $tags = $value->tags;
        }
        if (empty($tags) || $tags == "") {
            $tags = "#Canceled";
        } else {
            $tags = str_replace("Waiting_for_confirmation", "#Canceled", $tags);
            /* $tags = $tags . ",#Canceled"; */
        }
        if (str_contains($tags, '#Canceled')) { 

            $tags = $tags . ",#Canceled";
        }

        $client = new guzzle([
            'headers' => [
                'Content-Type' => 'application/json',
                'X-Shopify-Access-Token' => $shopify_token,
                'debug' => true,
            ],
            "ssl" => [
                "verify_peer" => false,
                "verify_peer_name" => false,
            ],
        ]);

        $URI = $store_myshopify_url . '/admin/api/2023-04/orders/' . $shopify_id . '.json';

        $body = ["order" => ['id' => $shopify_id, 'tags' => $tags]];

        $body = json_encode($body);
        $URI_Response = $client->request('PUT', $URI, ['body' => $body]);


        if ($store=='origin') {
    
            DB::table('shopify_orders')->where('order_number', $order_number)->update(['status' => "canceled",
            'cancelled_at' => $date, 'financial_status' => "voided"]);
        }
        

        if ($order_data[0]->gateway == "COD") {
            $this->canceled_from_shopify($shopify_token,$store_myshopify_url,$shopify_id);

            $transaction_id=$this->get_transaction_info($shopify_token,$store_myshopify_url,$shopify_id);
    
            if ($transaction_id[0]) {
                $this->mark_payment_voided($shopify_token,$store_myshopify_url,$shopify_id,$order_data[0]->total_price,$transaction_id[1]);
    
            } else {
                DB::insert('insert into errors (shipment_number,message,system_name) values (?,?,?)', [$order_number, $transaction_id[1], "Get transaction info for cancelation"]);
            }
        }

    }
    public function canceled_from_shopify($shopify_token, $store_myshopify_url,$order_id)
    {
        $client = new guzzle([
            'headers' => [
                'Content-Type' => 'application/json',
                'X-Shopify-Access-Token' => $shopify_token,
                'debug' => true,
            ],
            "ssl" => [
                "verify_peer" => false,
                "verify_peer_name" => false,
            ],
        ]);

        $URI = $store_myshopify_url . '/admin/api/2023-04/orders/'.$order_id.'/cancel.json';

        $body = ['reason' => "customer","restock"=>true];

        $body = json_encode($body);

        try {
            $URI_Response = $client->request('POST', $URI, ['body' => $body]);
            return true;
            
        } catch (\Throwable $th) {
            DB::insert('insert into errors (shipment_number,message,system_name) values (?,?,?)', [$order_id, $th, "Canceled order in shopify"]);
        }
        return false;
    }
    public function get_transaction_info($shopify_token,$store_myshopify_url,$order_id)
    {
        $header = array(
            'http' => array(
                'method' => "GET",
                'header' => "X-Shopify-Access-Token: ".$shopify_token

            ),
            "ssl"=>array(
                "verify_peer"=>false,
                "verify_peer_name"=>false,
            )
        );

        $context = stream_context_create($header);

        $order = $store_myshopify_url . "/admin/api/2023-04/orders/".$order_id."/transactions.json";
        // Open the file using the HTTP headers set above
        $data = file_get_contents($order, false, $context);

        $transaction = json_decode($data);
        $transaction = $transaction->transactions;


        if (count($transaction) == 1 ) {
            foreach ($transaction as $value) {
                return [true,$value->admin_graphql_api_id];
           }
           return [false,"NOT FOUND"];
        }elseif(count($transaction) == 3 && $transaction[2]->kind =='sale'){
            return [true,$transaction[2]->admin_graphql_api_id];
        }
         else {
            return [false,"more than one and three transaction!"];
        }
        
    }
    public function mark_payment_voided($shopify_token,$store_myshopify_url,$order_id,$amount,$transaction_id)
    {
        $client = new guzzle([
            'headers' => [
                'Content-Type' => 'application/json',
                'X-Shopify-Access-Token' => $shopify_token,
                'debug' => true
            ],
            "ssl"=>[
                "verify_peer"=>false,
                "verify_peer_name"=>false,
            ]
        ]);

        $URI = $store_myshopify_url . '/admin/api/2023-04/graphql.json';

        $body['query'] = 'mutation refundCreate($input: RefundInput!) {
            refundCreate(input: $input) {
              userErrors {
                field
                message
              }
            }
          }';

   
        $body['variables'] = array(
            "input" => ["orderId" => "gid://shopify/Order/" . $order_id,
            "transactions"=>array(["amount"=> $amount, "gateway"=>"Cash on Delivery (COD)" ,
            "kind"=> "VOID",
            "orderId"=> "gid://shopify/Order/" . $order_id,
            "parentId"=> $transaction_id])
            ]

        );


        $body = json_encode($body);
        $URI_Response = $client->request('POST', $URI, ['body' => $body]);
        $URI_Response = json_decode($URI_Response->getBody(), true);

        if (isset($URI_Response['data']['refundCreate']['userErrors'])) {
            if (count($URI_Response['data']['refundCreate']['userErrors'])>0) {
                try {
                    DB::insert('insert into errors (shipment_number,message,system_name) values (?,?,?)', [$order_id, json_encode($URI_Response['data']['refundCreate']['userErrors']) , "Mark payment voided for cancelation"]);
                } catch (\Throwable $th) {
                    DB::insert('insert into errors (shipment_number,message,system_name) values (?,?,?)', [$order_id, "Contact Software team", "Mark payment voided for cancelation"]);
                }

                return [false,"Contact Software team!"];
            } else {
                return [true,"Success1"];
            }
        }elseif(isset($URI_Response["errors"])){
            DB::insert('insert into errors (shipment_number,message,system_name) values (?,?,?)', [$order_id, "Invalid data", "Mark payment voided for cancelation"]);
            
            return [false,"Invalid data!"];
        }
        else{
            return [true,"Success2"];
        }

        

    }

    public function check_token($token)
    {
        $check = DB::select('select * from orders where token = ?', [$token]);

        if ($check == null || $check == []) {
            return [false, []];
        } else {
            return [true, $check];
        }
    }
    public function validate_url($token, $status)
    {
        $order = DB::table('orders')->where('token', $token)->get();

        if ($order[0]->verified == $status) {
            return [true, $order];
        } else {
            return [false, $order];
        }
    }

    public function second_verification_mail($order_id, $problem)
    {
        $order = DB::table('orders')->where('id', $order_id)->get();

        date_default_timezone_set('Africa/Cairo');
        $date = date('Y-m-d H:i:s', time());

        DB::table('orders')->where('order_number', $order[0]->order_number)->update(['verified' => 4, 'problem' => $problem, 'send_svm_at' => $date,'send_svm_by'=>Auth::user()->name]);

        $problem_messages = [];
        $problem_english = [];
        if (str_contains($problem, 'P')) {
            $problem_messages['يجب أن يتكون رقم الهاتف من:'] = '( كود البلد - الرقم الخاص بك )';
            $problem_english['The phone number must consist of:'] = '( Country Code - Your Number )';
        }
        if (str_contains($problem, 'C') || str_contains($problem, 'T') || str_contains($problem, 'A') || str_contains($problem, 'R')) {
            $problem_messages['يجب ان يحتوي العنوان علي كلا من:'] = '( اسم مدينتك - اسم او رقم الحي - اسم او رقم الشارع - رقم العقار )';
            $problem_english['The address must contain:'] = '( Your city name - district name or number - street name or number - property number )';
        }
        $data1 = [
            'order_number' => $order[0]->order_number,
            'problems' => $problem_messages,
            'problems_eng' => $problem_english,
            'url' => url('') . '/' . "edit?token=" . $order[0]->token,
        ];
        /*         'url' => "http://localhost:8888/public/" . "edit?token=" . $order[0]->token
         */
        Mail::to($order[0]->email)->send(new CorrectInfo($data1), function ($message) {
            $message->subject("Correct information");
        });
    }
    public function getProblemInfo($order)
    {
        $problem_cases = ['P', 'C', 'T', 'A', 'R'];
        $problem_cases_names = ['phone', 'country', 'city', 'address', 'apartment'];
        $form_data_status = ['name' => 0];

        $problem = $order->problem;
        $form_data = [
            'name' => $order->name, 'phone' => $order->phone_number,
            'country' => $order->country, 'city' => $order->city, 'address' => $order->address,
            'apartment' => $order->apartment,
        ];
        if ($order->gateway == 'COD') {
            $form_data['payment'] = 'COD';
        } else {
            $form_data['payment'] = 'Visa';
        }
        // 0 => valid data
        // 1 => invalid data

        for ($i = 0; $i < sizeof($problem_cases); $i++) {

            if (str_contains($problem, $problem_cases[$i])) {
                $form_data_status[$problem_cases_names[$i]] = 1;
            } else {
                $form_data_status[$problem_cases_names[$i]] = 0;
            }
        }

        return [$form_data, $form_data_status];
    }
    public function update_order_data($data)
    {

        $query = [];
        foreach ($data as $key => $value) {
            if ($key != '_token' && $key != "access_token" && $key != 'route_name') {
                $query[$key] = $value;
            }
        }
        $query['verified'] = 5;

        date_default_timezone_set('Africa/Cairo');
        $date = date('Y-m-d H:i:s', time());
        $query['info_edited_at'] = $date;

        DB::table('orders')->where('token', $data['access_token'])->update($query);
    }
    public function update_shopify($order_id)
    {
        $order_data = DB::table('orders')->where('id', $order_id)->get();

        $order_number = $order_data[0]->order_number;
        $shopify_id = $order_data[0]->order_id;
        $tags = "";

        date_default_timezone_set('Africa/Cairo');
        $date = date('Y-m-d H:i:s', time());

        $tracking_number = $this->generate_kwb(0, $order_data[0]);
        $query['kshopina_awb'] = $tracking_number;

        $query['tracking_url'] = 'tracking/' . $tracking_number;
        $query['verified'] = 6;
        $query['action_taken_by'] = Auth::user()->name;
        $query['action_taken_at'] = $date;

        DB::table('orders')->where('order_number', $order_data[0]->order_number)->update($query);

        // Tracking Mail

            /* $data1 = [
                'order_number' => $order_data[0]->order_number,
                'tracking_url' => url('') . '/' . "tracking/" . $tracking_number,
                ];

            Mail::to($order_data[0]->email)->send(new TrackingMail($data1), function ($message) {
                $message->subject("Track Your Order");
                }); */
        //

        // Tracking Message

            $whatsModel = new \App\Models\WhatsApp();

            $whatsModel->whatsapp_send_tracking_message($order_data[0]->phone_number,$order_data[0]->order_number,$tracking_number,$order_data[0]->country);

        //

        $shopify_token = DB::table('config')->where('keyy', $order_data[0]->store)->get()[0]->value;
        $store_url = DB::table('config')->where('keyy', $order_data[0]->store . '_url')->get()[0]->value;
        $store_myshopify_url = DB::table('config')->where('keyy', $order_data[0]->store . '_myshopify')->get()[0]->value;

        
        $header = array(
            'http' => array(
                'method' => "GET",
                'header' => "X-Shopify-Access-Token: " . $shopify_token,

            ),
            "ssl" => array(
                "verify_peer" => false,
                "verify_peer_name" => false,
            ),
        );

        $context = stream_context_create($header);
        $order = $store_url . "/admin/api/2023-04/orders.json?name=" . $order_number . "&status=any";
        // Open the file using the HTTP headers set above
        $data = file_get_contents($order, false, $context);
        $order = json_decode($data);
        $order = $order->orders;

        if ($order == []) {
            return false;
        }
        foreach ($order as $key => $value) {
            $tags = $value->tags;
        }

        if (empty($tags) || $tags == "") {
            $tags = "#Confirmed";
        } else {
            $tags = str_replace("Waiting_for_confirmation", "#Confirmed", $tags);
            /* $tags = $tags . ",#Confirmed"; */
        }

        if (!str_contains($tags, '#Confirmed')) { 

            $tags = $tags . ",#Confirmed";
        }
        if (str_contains($tags, 'Waiting_for_confirmation')) { 

            $tags = str_replace("Waiting_for_confirmation", "", $tags);
        }

        $client = new guzzle([
            'headers' => [
                'Content-Type' => 'application/json',
                'X-Shopify-Access-Token' => $shopify_token,
                'debug' => true,
            ],
            "ssl" => [
                "verify_peer" => false,
                "verify_peer_name" => false,
            ],
        ]);

        $URI = $store_myshopify_url . '/admin/api/2023-04/orders/' . $shopify_id . '.json';
        $body = ["order" => ['id' => $shopify_id, 'tags' => $tags]];
        $body = json_encode($body);

        $URI_Response = $client->request('PUT', $URI, ['body' => $body]);


        $body = ["order" => ['id' => $shopify_id, 'tags' => $tags, 'shipping_address' => [
            'phone' => $order_data[0]->phone_number,
            'address1' => $order_data[0]->address,
            'address2' => $order_data[0]->apartment,
            'city' => $order_data[0]->city,
            'country' => $order_data[0]->country,
        ]]];

        $body = json_encode($body);
        try {
            $URI_Response = $client->request('PUT', $URI, ['body' => $body]);
        } catch (\Throwable $th) {
            if (str_contains($th->getMessage(), 'postal code')) {

                $postal_codes=['Egypt'=>'11765','Kuwait'=>'22053','Bahrain'=>'1016','Saudi Arabia'=>'12979','Qatar'=>'00000','Oman'=>'225','United Arab Emirates'=>'51133','Jordan'=>'11183'];
                if (isset($postal_codes[$order_data[0]->country])) {
                    $body1 = ["order" => ['id' => $shopify_id, 'tags' => $tags, 'shipping_address' => [
                        'phone' => $order_data[0]->phone_number,
                        'address1' => $order_data[0]->address,
                        'address2' => $order_data[0]->apartment,
                        'city' => $order_data[0]->city,
                        'country' => $order_data[0]->country,'zip'=>$postal_codes[$order_data[0]->country]
                    ]]];
                    $body1 = json_encode($body1);
                    $URI_Response = $client->request('PUT', $URI, ['body' => $body1]);
                } else {
                    return false;
                }
                
            } else {
                return false;
            }
            DB::insert('insert into errors (shipment_number,message,system_name) values (?,?,?)', [$order_data[0]->order_number, $th, 'Update_customer_info_after_add_hashtag_confirmed']);

        }
        return true;
    }

    public function generate_kwb($mode, $data)
    {
        if ($mode == 0) {
            $order = $data;
        } else {
            $order = DB::select('SELECT * from orders where order_number= ? AND verified = ?', [$data, 6])[0];
        }

        $countries = ['', 'Egypt' => 1, 'Saudi Arabia' => 2, 'Kuwait' => 3, 'United Arab Emirates' => 4, 'Qatar' => 5, 'Bahrain' => 6, 'Oman' => 7, 'Jordan' => 8];
        $country = 0;
        $gateway = 1;
        $price = 3;
        if (isset($countries[$order->country])) {
            $country = $countries[$order->country];
        }
        if ($order->gateway == 'COD') {
            $gateway = 0;
        }
        //price
        if ($order->total_price > 0 && $order->total_price < 25) {
            $price = 2;
        } else if ($order->total_price > 25 && $order->total_price < 65) {
            $price = 6;
        } else if ($order->total_price > 65 && $order->total_price < 100) {
            $price = 0;
        } else if ($order->total_price > 100 && $order->total_price < 500) {
            $price = 5;
        } else if ($order->total_price > 500 && $order->total_price < 1000) {
            $price = 1;
        } else {
            $price = 9;
        }

        $tracking_number = 'K' . $order->order_number . $country . $gateway . $price;

        return $tracking_number;
    }

    //On Hold

        public function get_fulfillment_list($order_id,$store){

            $shopify_token = DB::table('config')->where('keyy', $store)->get()[0]->value;
            $store_myshopify_url = DB::table('config')->where('keyy', $store . '_myshopify')->get()[0]->value;

            $client = new guzzle([
                'headers' => [
                    'Content-Type' => 'application/json',
                    'X-Shopify-Access-Token' => $shopify_token,
                    'debug' => true,
                ],
                "ssl" => [
                    "verify_peer" => false,
                    "verify_peer_name" => false,
                ],
            ]);

            $URI = $store_myshopify_url . "/admin/api/2023-04/orders/" . $order_id . "/fulfillment_orders.json";

            try {
                $URI_Response = $client->request('GET', $URI);
                $URI_Response = json_decode($URI_Response->getBody(), true);

            } catch (\Throwable $th) {
                DB::insert('insert into errors (message,shipment_number) values (?,?)', [$th, $order_id]);
                return $th;
            }

            return $URI_Response;
        }
        public function mark_fulfillment_as_onHold($order_fulfilment_id,$store,$order_id_shopify){

            $shopify_token = DB::table('config')->where('keyy', $store)->get()[0]->value;
            $store_myshopify_url = DB::table('config')->where('keyy', $store . '_myshopify')->get()[0]->value;

            $client = new guzzle([
                'headers' => [
                    'Content-Type' => 'application/json',
                    'X-Shopify-Access-Token' => $shopify_token,
                    'debug' => true,
                ],
                "ssl" => [
                    "verify_peer" => false,
                    "verify_peer_name" => false,
                ],
            ]);

            $URI = $store_myshopify_url . "/admin/api/2023-04/fulfillment_orders/" . $order_fulfilment_id . "/hold.json";

            $body = ["id" =>$order_fulfilment_id ,
                    'fulfillment_hold'=>['reason' => "high_risk_of_fraud", 'reason_notes' => "Customer has many orders pending"]];
            $body = json_encode($body);

            try {
                $URI_Response = $client->request('POST', $URI,['body' => $body]);
                $URI_Response = json_decode($URI_Response->getBody(), true);

            } catch (\Throwable $th) {
                DB::insert('insert into errors (message,shipment_number) values (?,?)', [$th, $order_id_shopify]);
                return false;
            }

            return true;

        }

        public function release_onHold_fulfillment($order_fulfilment_id,$store,$order_id_shopify){

            $shopify_token = DB::table('config')->where('keyy', $store)->get()[0]->value;
            $store_myshopify_url = DB::table('config')->where('keyy', $store . '_myshopify')->get()[0]->value;

            $client = new guzzle([
                'headers' => [
                    'Content-Type' => 'application/json',
                    'X-Shopify-Access-Token' => $shopify_token,
                    'debug' => true,
                ],
                "ssl" => [
                    "verify_peer" => false,
                    "verify_peer_name" => false,
                ],
            ]);

            $URI = $store_myshopify_url . "/admin/api/2023-04/fulfillment_orders/" . $order_fulfilment_id . "/release_hold.json";

            $body = ["id" =>$order_fulfilment_id ];

            $body = json_encode($body);

            try {
                $URI_Response = $client->request('POST', $URI,['body' => $body]);
                $URI_Response = json_decode($URI_Response->getBody(), true);

            } catch (\Throwable $th) {
                DB::insert('insert into errors (message,shipment_number) values (?,?)', [$th, $order_id_shopify]);
                return $th;
            }

            return $URI_Response;
        }
        public function update_fulfilment($fulfilment_status,$order_number,$store){

            $check=$this->isExist($store,$order_number);

            date_default_timezone_set('Africa/Cairo');
            $date = date('Y-m-d H:i:s', time());
    
            if ($check[0]) {
                DB::table('orders')->where("order_number", $order_number)->update(['fulfillment_status' => $fulfilment_status, 'fulfilled_at' => $date, 'fulfilled_by' =>$check[1][0]->fulfilled_by." ". Auth::user()->name]);
                return true;
            }else{
                return false;
            }
        }
        
        public function get_fulfilment($order_fulfilment_id,$store){

            $shopify_token = DB::table('config')->where('keyy', $store)->get()[0]->value;
            $store_myshopify_url = DB::table('config')->where('keyy', $store . '_myshopify')->get()[0]->value;

            $client = new guzzle([
                'headers' => [
                    'Content-Type' => 'application/json',
                    'X-Shopify-Access-Token' => $shopify_token,
                    'debug' => true,
                ],
                "ssl" => [
                    "verify_peer" => false,
                    "verify_peer_name" => false,
                ],
            ]);

            $URI = $store_myshopify_url . "/admin/api/2023-04/fulfillment_orders/" . $order_fulfilment_id . ".json";

            try {
                $URI_Response = $client->request('GET', $URI);
                $URI_Response = json_decode($URI_Response->getBody(), true);

            } catch (\Throwable $th) {
                DB::insert('insert into errors (message,shipment_number) values (?,?)', [$th, $order_fulfilment_id]);
                return $th;
            }

            return $URI_Response;
        }

        function get_order_by_order_id($order_id,$store)
        {
            return DB::select('SELECT * from orders where order_id = ? AND store = ?', [$order_id,$store]);
        }
    //
    public function updateCurrency($data)
    {

        date_default_timezone_set('Asia/Seoul');
        $date = date('Y-m-d H:i:s', time());

        DB::table('config')->where('keyy', 'SAR')->update(['value' => $data->USDSAR, 'update_date' => $date]);
        DB::table('config')->where('keyy', 'KWD')->update(['value' => $data->USDKWD, 'update_date' => $date]);
        DB::table('config')->where('keyy', 'JOD')->update(['value' => $data->USDJOD, 'update_date' => $date]);
        DB::table('config')->where('keyy', 'BHD')->update(['value' => $data->USDBHD, 'update_date' => $date]);
        DB::table('config')->where('keyy', 'OMR')->update(['value' => $data->USDOMR, 'update_date' => $date]);
        DB::table('config')->where('keyy', 'EGP')->update(['value' => $data->USDEGP, 'update_date' => $date]);
        DB::table('config')->where('keyy', 'QAR')->update(['value' => $data->USDQAR, 'update_date' => $date]);
        DB::table('config')->where('keyy', 'AED')->update(['value' => $data->USDAED, 'update_date' => $date]);
    }

    public function get_currency($currency)
    {
        return DB::table('config')->where('keyy', $currency)->get();
    }

    public function order_like($value)
    {
        $value = $value . '%';
        return DB::select('SELECT * FROM orders WHERE order_number LIKE "' . $value . '" ');
    }

    public function get_orders_from_database_search($store, $order_number,$func_name)
    {

        

        if ($func_name == 'fvm') {
            $orders = DB::select('SELECT * from (
                SELECT * FROM orders left join whatsapp_send_messages on orders.order_number = whatsapp_send_messages.message_order_number 
                where order_number = ?  AND store = ?) as orders where orders.message_name =  ? OR orders.message_name is null', [$order_number, $store,'fvm']);
        } elseif($func_name == 'svm') {
            $orders = DB::select('SELECT * from (
                SELECT * FROM orders left join whatsapp_send_messages on orders.order_number = whatsapp_send_messages.message_order_number 
                where order_number = ?  AND store = ?) as orders where orders.message_name =  ? OR orders.message_name is null', [$order_number, $store,'svm']);
        }else{
            $orders = DB::select('SELECT * FROM orders where order_number = ?  AND store = ? ;', [$order_number, $store]);
        }
        
        $number_of_orders = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM kshopina.orders where order_number = ?  AND store = ? ;', [$order_number, $store]);

        $customer_history=[];
        foreach ($orders as $order) {
            $customer_history[$order->customer_id]=DB::select('select * from shopify_orders where customer_id = ?', [$order->customer_id]);
        }

        $number_of_new_FVM = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM kshopina.orders where verified = ? AND store = ? and (fulfillment_status != ? or fulfillment_status is null) ;', [2, $store,'on_hold']);
        $number_of_new_SVM = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM kshopina.orders where verified = ? AND store = ? and (fulfillment_status != ? or fulfillment_status is null) ;', [5, $store,'on_hold']);

        $number_of_FVM_pending = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM kshopina.orders where verified = ? AND store = ? ;', [1, $store]);
        $number_of_SVM_pending = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM kshopina.orders where verified = ? AND store = ? ;', [4, $store]);

        $number_of_on_hold = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM kshopina.orders where verified < ? AND store = ? and fulfillment_status = ? ;', [6, $store,'on_hold']);

        /* $number_of_SVM = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM kshopina.orders where verified = ? AND store = ? OR send_svm_at IS NOT NULL AND store = ? ;', [4, $store, $store]);
        $number_of_replied_SVM = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM kshopina.orders where info_edited_at IS NOT NULL AND store = ? ;', [$store]); */

        $number_of_confirmed_archived = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM kshopina.orders where verified = ? AND store = ? ;', [6, $store]);
        $number_of_canceled_archived = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM kshopina.orders where verified = ? AND store = ? ;', [3, $store]);

        return [
            $number_of_orders, $orders, $number_of_FVM_pending, $number_of_SVM_pending, $number_of_new_FVM,
            $number_of_new_SVM, $number_of_on_hold,0, $number_of_confirmed_archived, $number_of_canceled_archived,$customer_history

        ];
    }

    public function get_orders_for_export($store ,$from ,$to)
    {
        return DB::select('SELECT order_number,name,
        email,
        created_at,
        country,
        gateway,
        verified,
        active,
        phone_number,
        currency,
        action_taken_by,
        category FROM orders where store = ? AND created_at BETWEEN ? AND ? ORDER BY created_at ASC;', [$store ,$from ,$to]);
    }
    public function export($store,$from ,$to)
    {
        $titles = ['A' => 'Order Number', 'B' => 'Name', 'C' => 'Email', 'D' => 'Date', 'E' => 'Country', 'F' => 'Gateway', 'G' => 'Status', 'H' => 'Phone Number', 'I' => 'Currency', 'J' => 'Action taken by', 'K' => 'Category'];
        $status = ['pending', 'FVM', 'Green-light', 'Canceled', 'SVM', 'Edited', 'Confirmed'];
        $category = ['Normal', 'Pre-order', 'Sky'];

        $orders = $this->get_orders_for_export($store,$from ,$to);

        $spreadsheet1 = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $spreadsheet1->getActiveSheet()->setTitle('All');

        $numoforders = count($orders);
        $row_1 = 2;

        foreach ($titles as $key => $value) {
            $spreadsheet1->getActiveSheet()->setCellValue($key . '1', $value);
        }

        for ($row = 0; $row < $numoforders; $row++) {
            $data[0] = $orders[$row]->order_number;
            $data[1] = $orders[$row]->name;
            $data[2] = $orders[$row]->email;
            $data[3] = $orders[$row]->created_at;
            $data[4] = $orders[$row]->country;
            $data[5] = $orders[$row]->gateway;
            if ($orders[$row]->verified == 0 && $orders[$row]->active == 1) {
                $data[6] = 'Ignored';
            } else {
                $data[6] = $status[$orders[$row]->verified];
            }

            $data[7] = $orders[$row]->phone_number;
            $data[8] = $orders[$row]->currency;
            $data[9] = $orders[$row]->action_taken_by;
            $data[10] = $category[$orders[$row]->category];

            $col = array_keys($titles);
           /*  $spreadsheet1->getActiveSheet()
                ->getStyle('G' . $row_1)
                ->getFill()
                ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID); */
            for ($i = 0; $i < count($data); $i++) {
                //All
                $spreadsheet1->getActiveSheet()->setCellValue($col[$i] . $row_1, $data[$i]);

                if ($orders[$row]->verified == 3) {

                    /* $spreadsheet1->getActiveSheet()
                        ->getStyle('G' . $row_1)
                        ->getFill()
                        ->getStartColor()
                        ->setRGB('ffc7ce'); */

                    $spreadsheet1->getActiveSheet()->getStyle('G' . $row_1)->getFont()
                        ->setBold(true)
                        ->getColor()->setRGB('9c0005');

                } elseif ($orders[$row]->verified == 6) {

                   /*  $spreadsheet1->getActiveSheet()
                        ->getStyle('G' . $row_1)
                        ->getFill()
                        ->getStartColor()
                        ->setRGB('c6efce'); */

                    $spreadsheet1->getActiveSheet()->getStyle('G' . $row_1)->getFont()
                        ->setBold(true)
                        ->getColor()->setRGB('006100');

                }

            }

            $row_1++;
        }

        $name = $store . date('Y-m-d--h-i-sa');
        $writer = new Xlsx($spreadsheet1);

        if (!file_exists(public_path('uploads/verification/' . $store))) {
            mkdir(public_path('uploads/verification/' . $store), 0777, true);
        }

        $writer->save(public_path('/uploads/verification' . '/' . $store . '/' . $name . '.xlsx'));

        unset($reader);

        return $name;
    }
    public function update_fvm()
    {
        try {
            $orders = DB::select('select * from orders where verified = ?', [0]);

            foreach ($orders as $key => $order) {

                if ($order->gateway != 'COD') {
                    DB::table('orders')->where('order_number', $order->order_number)->update(['category' => 2]);
                }

            }
        } catch (\Throwable $th) {
            return $th;
        }

    }

    public function create_group_order($data)
    {
        date_default_timezone_set('Africa/Cairo');
        $date = date('Y-m-d H:i:s', time());

        $id=DB::table('group_orders')->insertGetId(['email'=>$data['email'],'city'=>$data['city'],'shipping_rate'=>$data['shipping'],
        'final_price'=>$data['final_price'],
        'created_at'=>$date,'updated_at'=>$date,
        'created_by'=>Auth::user()->name,'status'=>0,'customer_name'=>$data['customer_name'],'contact_number'=>$data['phone'],'address'=>$data['address']]);

        //generate token for url
        $bytes = random_bytes(20);
        $token = bin2hex($bytes) . $id;

        for ($i = 0; $i < count($data['name']); $i++) {

            DB::insert('insert into group_orders_products (order_id, product_name,product_price,product_qty,created_at) values (?, ?,?, ?,?)',
             [$id, $data['name'][$i],(int)$data['price'][$i],(int)$data['qty'][$i],$date]);
        }

        $items=DB::select('select * from group_orders_products where order_id = ?', [$id]);
        

        $data1 = [
            'order_number' => $id,
            'items' => $items,
            'final_price' => $data['final_price'],
            'currency' => "EGP",
            'arabic_currency' => "جنيه مصري",
            'confirm_url' => url('') . '/' . "confirm_group?token=" . $token,
            'cancel_url' => url('') . '/' . "cancel_group?token=" . $token,
        ];

        Mail::to($data['email'])->send(new GroupOrderMail($data1), function ($message) {
            $message->subject("Kshopina - EG (Group Order) Invoice");
        });

        DB::table('group_orders')->where('group_orders_id',$id)->update(['token'=>$token,'status'=>1,'updated_at'=>$date]);


    }
    
    public function edit_email($order_number, $new_email)
    {
        return DB::table('orders')->where('order_number', $order_number)->update(['email' => $new_email]);
    }

    public function get_customers($method, $url)
    {
        set_time_limit(50000);
        try {

            $client = new guzzle([
                'headers' => [
                    'Content-Type' => 'application/json',
                    'X-Shopify-Access-Token' => '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',
                    'debug' => true,
                ],
                "ssl" => [
                    "verify_peer" => false,
                    "verify_peer_name" => false,
                ],
            ]);

            $tokenType = 'next';

            $response = $client->request($method, $url);
            $responseHeaders = $response->getHeaders();

            if (array_key_exists('Link', $responseHeaders)) {
                $link = $responseHeaders['Link'][0];
                $tokenType = strpos($link, 'rel="next') !== false ? "next" : "previous";
                $tobeReplace = ["<", ">", 'rel="next"', ";", 'rel="previous"'];
                $tobeReplaceWith = ["", "", "", ""];
                parse_str(parse_url(str_replace($tobeReplace, $tobeReplaceWith, $link), PHP_URL_QUERY), $op);
                $pageToken = trim($op['page_info']);
            }

            $rateLimit = explode('/', $responseHeaders["X-Shopify-Shop-Api-Call-Limit"][0]);
            $usedLimitPercentage = (100 * $rateLimit[0]) / $rateLimit[1];
            if ($usedLimitPercentage > 95) {
                sleep(5);
            }
            $responseBody = json_decode($response->getBody(), true);
            $r['resource'] = (is_array($responseBody) && count($responseBody) > 0) ? array_shift($responseBody) : $responseBody;
            $r[$tokenType]['page_token'] = isset($pageToken) ? $pageToken : null;

            return $r;
        } catch (\Throwable $th) {
            dd($th);
        }

    }

    public function insert_customers($id, $email, $first_name, $last_name, $phone, $country, $city, $orders_count, $state, $total_spent, $currency, $last_order_id, $note, $verified_email, $tags, $last_order_name, $created_at, $updated_at)
    {

        try {
            DB::insert(
                'INSERT into customers2 (customer_id,customer_email,customer_first_name,customer_last_name,customer_phone,customer_country,customer_city,orders_count,state,
                 total_spent,currency,last_order_id,note,verified_email,tags,last_order_name,created_at,updated_at) values
                 (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)',
                [
                    $id,
                    $email,
                    $first_name,
                    $last_name,
                    $phone,
                    $country,
                    $city,
                    $orders_count,
                    $state,
                    $total_spent,
                    $currency,
                    $last_order_id,
                    $note,
                    $verified_email,
                    $tags,
                    $last_order_name,
                    $created_at,
                    $updated_at,
                ]
            );
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    public function get_products_from_shopify($store)
    {

        $shopify_token = DB::table('config')->where('keyy', $store)->get()[0]->value;
        $store_url = DB::table('config')->where('keyy', $store.'_url')->get()[0]->value;

        $uri = $store_url . "/admin/api/2023-04/products.json?limit=250&page_info=eyJsYXN0X2lkIjo3MTM4MTcyNTY3NzM3LCJsYXN0X3ZhbHVlIjoiS1NIT1BJTkErRUdZUFQgKEJBRykiLCJkaXJlY3Rpb24iOiJuZXh0In0";


        $header = array(
            'http' => array(
                'method' => "GET",
                'header' => "X-Shopify-Access-Token: " . $shopify_token,
            ),
            "ssl" => array(
                "verify_peer" => false,
                "verify_peer_name" => false,
            ),
        );

        $context = stream_context_create($header);
        // Open the file using the HTTP headers set above
        $data = file_get_contents($uri, false, $context);
        $products = json_decode($data);
        $products = $products->products;


        $data = $http_response_header[45];    
       /*  $whatIWant = substr($data, strpos($data, "page_info=") + 10);    
        $whatIWant = substr($whatIWant,0, strpos($whatIWant, ">") );     */

        return [$products,$data];

    }
    public function compare_between($store,$shopify_products)
    {
        /*         $products = DB::select('SELECT * from stock where store = ?', [$store]);
        */        $our_products=["7166192320697"=>"","7164951298233"=>"","7136774979769"=>"","7166201266361"=>"","7166297538745"=>1,"7131373371577"=>"","7297530069177"=>"","7166172758201"=>"","7166107680953"=>"","7021453115577"=>"","7145824911545"=>"","6990718042297"=>"","7141325766841"=>"","7141366792377"=>"","7043501686969"=>"","6990745796793"=>"","7131374026937"=>"","7131374223545"=>"","7131374518457"=>"","7111521632441"=>"","7111532871865"=>"","7136842219705"=>"","7082043146425"=>"","6983772700857"=>"","7054535426233"=>"","7250599936185"=>"","7045663523001"=>"","7268302192825"=>"","7005513875641"=>"","7079663042745"=>"","7149955645625"=>"","7079675035833"=>"","7139368501433"=>"","7021480050873"=>"","7131370258617"=>"","7067192393913"=>"","7067202715833"=>"","7067201765561"=>"","7067202257081"=>"","7067202486457"=>"","7291395145913"=>"","7166404198585"=>"","7158784295097"=>"","7142855475385"=>"","7158713254073"=>"","7021252509881"=>"","7085314310329"=>"","7021256704185"=>"","7020924698809"=>"","7021397934265"=>"","7085291307193"=>"","7021409960121"=>"","7268303208633"=>"","7268303732921"=>"","6979058401465"=>"","6978808774841"=>"","7021195591865"=>"","7085343604921"=>"","6978923102393"=>"","7282134220985"=>"","6978526675129"=>"","7262643060921"=>"","7020967657657"=>"","7021053509817"=>"","7021093650617"=>"","7021248839865"=>"","7142926876857"=>"","6978993127609"=>"","7061351825593"=>"","7309649871033"=>"","7309651902649"=>"","7309653049529"=>"","7309654786233"=>"","7309655769273"=>"","7154609619129"=>"","7154613190841"=>"","7154638160057"=>"","7142880084153"=>"","7085276692665"=>"","7087763030201"=>"","7258437779641"=>"","7297503854777"=>"","7021127368889"=>"","7054596669625"=>"","7102061019321"=>"","7263921176761"=>"","7071801409721"=>"","7054553022649"=>"","7054580318393"=>"","7054564786361"=>"","7021072154809"=>"","7021045448889"=>"","7021180092601"=>"","7021015531705"=>"","7021238747321"=>"","7286450389177"=>"","7174574375097"=>"","7041016561849"=>"","7054782005433"=>"","7263968035001"=>"","7131375206585"=>"","7141444681913"=>"","7139399499961"=>"","7127438622905"=>"","7158699589817"=>"","7021306904761"=>"","7021310279865"=>"","6983684948153"=>"","7054607679673"=>"","7021312114873"=>"","7034024788153"=>"","7067172962489"=>"","7043571253433"=>"","7021443580089"=>"","7034046185657"=>"","7143757185209"=>"","7043490513081"=>"","7142108102841"=>"","7318870950073"=>"","7069525868729"=>"","7043564699833"=>"","7071799148729"=>"","7136833503417"=>"","7147557093561"=>"","7154628657337"=>"","7145814982841"=>"","7147560075449"=>"","7111545684153"=>"","7111578419385"=>"","7082012410041"=>"","7039475155129"=>"","7282102829241"=>"","7102028906681"=>"","7071815893177"=>"","7045672173753"=>"","7282133008569"=>"","7021242155193"=>"","7045658640569"=>"","7054546075833"=>"","7290135871673"=>"","7166339514553"=>"","7170607218873"=>"","7263924846777"=>"","7149957513401"=>"","7291152990393"=>"","7138172567737"=>"","7137269448889"=>5,"7071015502009"=>1,"7114850402489"=>1,"7087867461817"=>"","7297511620793"=>4,"7283315474617"=>1,"7043528556729"=>1,"7039506940089"=>1,"7039518769337"=>1,"7261944938681"=>1,"7261940220089"=>1,"6983769522361"=>1,"7079841726649"=>1,"7079826489529"=>2,"7243137712313"=>1,"7263953453241"=>1,"7158692577465"=>1,"7139705585849"=>2,"7139708895417"=>1,"6983258898617"=>1,"6984734048441"=>2,"7034049265849"=>2,"7034098057401"=>1,"7282072813753"=>1,"7282080448697"=>1,"7282088018105"=>1,"7266248360121"=>1,"7170545352889"=>1,"7138133934265"=>1,"7270632292537"=>2,"7156140703929"=>2,"7040963543225"=>2,"7156142932153"=>1,"6983758020793"=>1,"6983763656889"=>1,"6979449815225"=>1,"6983776567481"=>1,"6983772373177"=>1,"6983774863545"=>1,"7291361722553"=>"","7139431973049"=>1,"7250604884153"=>3,"7097700155577"=>3,"7291417362617"=>1,"7291194572985"=>1,"7138196717753"=>1,"7243321835705"=>5,"7138245738681"=>3,"7076609360057"=>1,"7071809667257"=>1,"7158812115129"=>1,"7127398023353"=>1,"7283298304185"=>1,"7283302891705"=>1,"7283294634169"=>1,"7039485477049"=>1,"7243100618937"=>1,"7146791796921"=>1,"7302896451769"=>5,"6983767425209"=>2,"7174582436025"=>1,"7065933807801"=>3,"7099256864953"=>3,"7079705772217"=>2,"7199462228153"=>1,"7268319854777"=>1,"7034013712569"=>2,"7079756890297"=>2,"7043474292921"=>1,"7021528481977"=>3,"7079730905273"=>1,"7136850706617"=>1,"7141440880825"=>2,"7079761182905"=>2,"7079785234617"=>1,"7057640489145"=>1,"7054840168633"=>1,"7061359689913"=>"","7043518529721"=>2,"7258805174457"=>1,"7262651351225"=>2,"7079792607417"=>2,"7034067976377"=>1,"7056749658297"=>1,"7136837664953"=>1,"7170533294265"=>1,"7282111447225"=>1,"7136773111993"=>2,"7170522087609"=>1,"7082090922169"=>3,"7082112155833"=>1,"7112773697721"=>1,"7246109802681"=>3,"7043560014009"=>2,"7039537316025"=>1,"7102085202105"=>1,"7131799060665"=>1,"7291157119161"=>1,"7087803957433"=>3,"7034074661049"=>3,"7079900250297"=>3,"7079914143929"=>1,"7034090094777"=>1,"7114844799161"=>4,"7131817902265"=>1,"7034091995321"=>1,"7079920861369"=>3,"7139757392057"=>3,"7139770564793"=>1,"7154621481145"=>1,"7079910670521"=>1,"7158789963961"=>1,"7149998670009"=>"","7131936882873"=>4,"7136838746297"=>1,"7297519026361"=>3,"7138122727609"=>3,"7136833831097"=>1,"7303081230521"=>1,"7291374502073"=>3,"7045615845561"=>3,"7045626331321"=>2,"7045643010233"=>2,"7045653102777"=>2,"7045618991289"=>1,"7054822867129"=>1,"7136776749241"=>1,"7105470955705"=>1,"7170538864825"=>1,"7149956464825"=>1,"7166383882425"=>2,"7174584402105"=>1,"7304957690041"=>4,"7283323994297"=>1,"7141418401977"=>8,"7304959721657"=>1,"7295538659513"=>1,"7304961097913"=>1,"6983741341881"=>1,"7069509419193"=>2,"7141432033465"=>7,"7111636025529"=>2,"7111658700985"=>1,"7329183203513"=>1,"7329201422521"=>6,"7329243496633"=>5,"7329245233337"=>2,"7330167718073"=>"","7330185543865"=>2,"7331654631609"=>4,"7331665248441"=>2,"7331711942841"=>2,"7331725902009"=>"","7371056447673"=>1,"7371059331257"=>1,"7371625431225"=>"","7371720523961"=>1,"7371722326201"=>2,"7371724521657"=>1,"7371731828921"=>1,"7374556233913"=>4,"7374559445177"=>1,"7376675995833"=>"","7378458017977"=>8,"7378469028025"=>2,"7379314770105"=>3,"7379318145209"=>1,"7379320766649"=>3,"7379404226745"=>"","7379410747577"=>2,"7379461963961"=>2,"7379481428153"=>1,"7380773437625"=>"","7380788445369"=>"","7381404713145"=>"","7381410447545"=>"","7381478998201"=>"","7381480964281"=>"","7381489975481"=>"","7381493285049"=>"","7381503377593"=>"","7381511471289"=>"","7381511962809"=>"","7381512519865"=>"","7381513273529"=>"","7383488069817"=>"","7383490724025"=>"","7383813324985"=>"","7383814144185"=>"","7383816077497"=>"","7383822237881"=>"","7383825154233"=>"","7383845503161"=>"","7383850877113"=>"","7383851860153"=>"","7383856742585"=>"","7383858905273"=>"","7383861264569"=>"","7383865852089"=>"","7383866867897"=>"","7383868801209"=>"","7383871586489"=>"","7383872471225"=>"","7383904813241"=>"","7386948108473"=>"","7386948862137"=>"","7386952040633"=>"","7387824881849"=>"","7388196339897"=>1,"7388203811001"=>3,"7388221800633"=>2,"7388236120249"=>2,"7388242804921"=>1,"7388247556281"=>"","7388252668089"=>"","7388256469177"=>1,"7394170306745"=>1,"7394172338361"=>"","7401065840825"=>"","7401075310777"=>"","7407565078713"=>"","7407566028985"=>"","7407566586041"=>"","7409889509561"=>"","7409939972281"=>"","7414923886777"=>7,"7414935519417"=>1,"7414954557625"=>"","7415057514681"=>"","7416402444473"=>1,"7416403755193"=>1,"7416420139193"=>"","7416422760633"=>6,"7416473944249"=>1,"7416846155961"=>"","7416847171769"=>"","7427467935929"=>"","7427472457913"=>"","7427473637561"=>"","7427477405881"=>"","7447567466681"=>4,"7447719018681"=>1,"7447733272761"=>"","7447756112057"=>"","7460099883193"=>1,"7460106567865"=>1,"7460114006201"=>2,"7460117545145"=>2,"7460131242169"=>2,"7460148707513"=>1,"7460206346425"=>1,"7469209813177"=>"","7469217415353"=>"","7469220167865"=>"","7469221609657"=>"","7469222691001"=>"","7472581017785"=>"","7486063050937"=>1,"7486064427193"=>2,"7487460737209"=>1,"7487467716793"=>1,"7487474172089"=>"","7487480398009"=>1,"7487490654393"=>"","7487497142457"=>"","7487508152505"=>1,"7487525683385"=>2,"7487532957881"=>"","7487575654585"=>"","7487588565177"=>"","7487595577529"=>"","7501774684345"=>"","7505102176441"=>"","7505109188793"=>1,"7508782284985"=>1,"7508783333561"=>1,"7508784545977"=>1,"7509299298489"=>"","7509301166265"=>"","7509301428409"=>"","7509319614649"=>"","7509355331769"=>"","7509387116729"=>"","7509390557369"=>"","7509398061241"=>"","7512066785465"=>"","7512070619321"=>"","7512071733433"=>"","7512072356025"=>"","7512077009081"=>"","7512083169465"=>"","7512092180665"=>"","7512210768057"=>"","7512273518777"=>"","7512290427065"=>"","7515931017401"=>"","7515950055609"=>"","7516003631289"=>"","7523022045369"=>"","7526460358841"=>"","7526470713529"=>""];

        /* foreach ($products as $product) {
            $our_products[$product->product_id]=$product->number_of_variants;
        } */

        foreach ($shopify_products as $product) {
            if (isset($our_products[$product->id]) ) {
                if (count($product->variants)==$our_products[$product->id]) {
                    $our_products[$product->id]="";
                }else{
                    $our_products[$product->id]=$our_products[$product->id] .'|'.count($product->variants);
                }
            }else{
                $our_products[$product->id]="Deleted";

            }
        } 

        return $our_products;
    }
    public function insert_products($store,$products)
    {
        $dublicated=[];

        foreach ($products as $product) {
            if (!$this->is_product_exist($product->id)) {

                $product_data = [
                    'product_title' => $product->title,
                    'product_id' => $product->id,
                    'product_type' => $product->product_type,
                    'product_tags' => $product->tags,
                    'created_at' => date("Y-m-d H:i:s", strtotime($product->created_at)),
                    'store' => $store,
                    'number_of_variants' => count($product->variants),
                    'product_cover_image' => $product->image->src,

                ];
                $id = DB::table('stock')->insertGetId($product_data);
                $this->insert_variants($id, $product->variants);
            }else{
                $dublicated[$product->id]=1;
            }
        }
        return $dublicated;
    }
    public function insert_variants($product_id, $variants)
    {

        foreach ($variants as $variant) {

            $product_data = [
                'product_id' => $product_id,
                'variant_id' => $variant->id,
                'variant_title' => $variant->title,
                'variant_price' => $variant->price,
                'variant_sku' => $variant->sku,
                'variant_image' => $variant->image_id,
                'variant_inventory_id' => $variant->inventory_item_id,
                'variant_quantity' => $variant->inventory_quantity,
                'variant_all_quantity' => $variant->inventory_quantity,

            ];
            $id = DB::table('variants')->insertGetId($product_data);
        }
    }
    public function is_product_exist($id)
    {
        $product = DB::select('select * from stock where product_id = ?', [$id]);
        if ($product == null || $product == []) {
            return false;
        } else {
            return true;
        }
    }
    public function rateReminder()
    {
        $complains = DB::select('SELECT * from kshopina.complains where solved =1 and rating =0 and saved_at > "2022-12-1" and saved_at < "2023-1-11" and id > 4261 and id < 4500');

        try {
            foreach ($complains as $key => $complaint) {
                $data1 = [
                    'complain_url'=>"https://kshopinaexpress.com" . '/' . "complaint_ticket/".$complaint->id."?token=" . $complaint->token,
                ];
    
                Mail::to($complaint->email)->send(new rateComplaintReminder($data1), function ($message) {
                    $message->subject("Complaint");
                });
        
            }
            return "done";
        } catch (\Throwable $th) {
            return $th;
        }
        
    }
    public function return_to_pending()
    {
        $store='plus_kuwait';

        $shopify_token = DB::table('config')->where('keyy', $store)->get()[0]->value;
            $store_myshopify_url = DB::table('config')->where('keyy', $store . '_myshopify')->get()[0]->value;

            $client = new guzzle([
                'headers' => [
                    'Content-Type' => 'application/json',
                    'X-Shopify-Access-Token' => $shopify_token,
                    'debug' => true,
                ],
                "ssl" => [
                    "verify_peer" => false,
                    "verify_peer_name" => false,
                ],
            ]);
            
            $URI = $store_myshopify_url . "/admin/api/2023-04/products.json?updated_at_min=2023-03-9&limit=250";

            
                $URI_Response = $client->request('GET', $URI);
                $URI_Response = json_decode($URI_Response->getBody(), true);

            $products = $URI_Response['products'];
            
            $dif=[];
            foreach ($products as $key => $response) {

                $mysql_data=DB::select('SELECT * FROM kshopina.variants inner join kshopina.stock on stock.id=variants.product_id where stock.product_id =? ', [$response['id']]);

                if (count($mysql_data)==0) {
                    $dif[$response['id']]='NOT FOUND';
                } else {
                    if (count($response['variants']) !=count($mysql_data) ) {
                        $dif[$response['id']]='VARIANTS DOES NOT MATCH';
                    }else{
                        foreach ($response['variants'] as $key => $shopify_prod) {
                            foreach ($mysql_data as $index => $mysql_prod) {
                                /* dd((string) $mysql_prod->product_id); */
                                if ($shopify_prod['id'] == $mysql_prod->variant_id) {
                                    if ($shopify_prod['price'] == $mysql_prod->variant_price) {
                                        
                                        $dif[$shopify_prod['id']]='QTY MATCH';
                                    } else {
                                        $dif[$shopify_prod['id']]='QTY DOES NOT MATCH';
                                    }
                                    break;
                                } else {
                                    $dif[$shopify_prod['id']]='VARIANT NOT FOUND';
                                }
                                
                            }
                        }
                    }
                }
                
            }
            dd($dif);
        $data1 = [
            'order_number' => '23258',
            'email'=>'nourabase1998@gmail.com'
        ];
        
        Mail::to($data1['email'])->send(new svmReminderMail($data1), function ($message) {
            $message->subject("correct info");
        });
        return 'sent';

       
$tstModel=new tst();

        $reasons=['no answer'=>'Send us an alternative number on ( +02 01102282260 ) via WhatsApp' ,
                'reschedule'=>'Please confirm your rescheduled date on ( +02 01102282260 ) via WhatsApp',
                'change address'=>'Please send us your new address on ( +02 01102282260 ) via WhatsApp',
                'cash issue'=> 'Please contact us on ( +02 01102282260 ) via WhatsApp',
                'wrong number'=> 'Please send us your correct number ( +02 01102282260 ) via WhatsApp'];
                

         date_default_timezone_set('Africa/Cairo');
        $date = date('Y-m-d H:i:s', time());

        $client = new guzzle([
            'headers' => [
                'Content-Type' => 'application/json',
            ],
        ]);
        $URI = 'https://api.shipadelivery.com/v2/orders/SD008770927/story?apikey=VR5SKO8wz7plviLIfJRpkNGFQQ3agIND';

        try {
            $URI_Response = $client->request('GET', $URI);
            $URI_Response = json_decode($URI_Response->getBody(), true);

        } catch (\Throwable $th) {

            /* DB::table('errors')->insert(['shipment_number' => $id, 'system_name' => 'SHIPA_TRACKING_2', 'status' => 'Fail', 'message' => $th->getMessage()]);
            return (['response' => 'fail', 'message' => $th->getMessage()]); */

        }
        $tstModel=new tst();
        $body = [
            "id" => 'GLT0001554047',
        ];
        $order_number='22925';
        $store='origin';
        $id=24825;
        $order_id=5214276813076;

        $arrive=0;
        $status = 0;
        $query = [];
        $dates = [];
        $reason="Cancelled by customer!";

        try {
            /* $URI_Response = $client->request('POST', $URI, ['body' => $body]);
            $URI_Response = json_decode($URI_Response->getBody(), true);

            $URI_Response = $URI_Response['data']['orders']; */

            foreach ($URI_Response as  $record) {

                if (($record['statusCode'] == 11 || $record['statusCode'] == 43)  && $arrive == 0 ) {
                    $hub = 1;
                    

                    $status = $this->status['Kshopina_Warehouse'];
                    $dates['in_warehouse_at'] = date('Y-m-d H:i:s', $record['date']/1000);

                    $query['status'] = $status;
                    $query['in_warehouse_at'] = $dates['in_warehouse_at'];

                }elseif ($record['statusCode'] == 16 || $record['statusCode'] == 17 /* && $ready == 0 */) {
                    $ready = 1;

                    $status = $this->status['Delivery'];
                    $dates['delivery_at'] = date('Y-m-d H:i:s', $record['date']/1000);

                    $query['status'] = $status;
                    $query['delivery_at'] = $dates['delivery_at'];

                } elseif ($record['statusCode'] == 19 ) {

                    $status = $this->status['Delivered'];
                    $dates['delivered_at'] = date('Y-m-d H:i:s', $record['date']/1000);

                    $query['status'] = $status;
                    $query['delivered_at'] = $dates['delivered_at'];

                }elseif ($record['statusCode'] == 26 || $record['statusCode'] == 23 ) {
                    $arrive = 1;

                    $status = $this->status['Refused'];
                    $dates['delivered_at'] = date('Y-m-d H:i:s', $record['date']/1000);
                    $query['status'] = $status;
                    $query['delivered_at'] = $dates['delivered_at'];

                }elseif( $record['statusCode'] == 20 ){
                    if (isset($record['details']['failReason'])) {

                        if(str_contains(strtolower($record['details']['failReason']),strtolower('No answer')) ){
                            $query['side_note']=$reasons['no answer'];
                            $query['issue']=1;
                        }
                        else{
                            $query['side_note']=$record['details']['failReason'];
                            $query['issue']=6;
                        }
                        /* elseif(str_contains(strtolower($record['reason']),strtolower('Reschedule')) ){
                            $query['side_note']=$reasons['reschedule'];
                            $query['issue']=2;
                        }
                        elseif(str_contains(strtolower($record['reason']),strtolower('Change address')) ){
                            $query['side_note']=$reasons['change address'];
                            $query['issue']=3;
                        }
                        elseif(str_contains(strtolower($record['reason']),strtolower('Cash issue')) ){
                            $query['side_note']=$reasons['cash issue'];
                            $query['issue']=4;
                        }
                        elseif(str_contains(strtolower($record['reason']),strtolower('Wrong number')) ){
                            $query['side_note']=$reasons['wrong number'];
                            $query['issue']=5;
                        }
                        elseif(str_contains(strtolower($record['reason']),strtolower('Cancelled')) ){
                            $status = $this->status['refused'];
                            $query['status'] = $status;
                        } */

                        $reason = $record['details']['failReason'];
                    }
                }
            }
                    if ($query != []) {

                        if ($query['status']==$this->status['Refused'] ) {

                            $tstModel->send_to_fct($order_number,$reason , $date, 3,$store);
                            if ($store !='origin') {
                                $tstModel->replace_tag("#on_process", "#FCT", $id, $store);

                            }else{
                                $tstModel->replace_tag("#dispatched", "#FCT", $id, $store);
        
                            }
                            $tstModel->replace_tag("#Delivered", "", $id, $store);
                            /* $query['old_status']=$old_status; */

                        }elseif($query['status'] == $this->status['Delivered']){

                            if ($store !='origin') {
                                $tstModel->replace_tag("#on_process", "#Delivered", $id, $store);

                            }else{
                                $tstModel->replace_tag("#dispatched", "#Delivered", $id, $store);
        
                            }
                            $tstModel->mark_order_as_paid($order_id,$store);
                        }
                        if ( isset($query['issue']) && $query['issue'] >0 ) {

                            if ($tstModel->fct_is_exist($order_number)) {
                                DB::table('fct')->where('order_number', $order_number)
                                ->update(['last_status'=>$reason , 'last_update' => $query['status'], 'updated_at' => $date]);

                                
                            }else{
                                DB::insert('insert into fct (order_number, last_status,last_update,created_at,source,store) values (?,?, ?,?,?,?)', 
                                [$order_number, $reason,$query['status'], $date, 3,$store]);

                            }
                            
                        }
                            
                        

                        DB::table('orders')->where('order_number', $order_number)->update($query);
                        return [$query,$reason];
                    }
        } catch (\Throwable $th) {

            return $th;

        }
      


        $store='origin';
        $orders=[
            '22213'
        ];

        foreach ($orders as $order_number) {

            $token = $this->generate_url($order_number);

            $this->first_verification_mail($store, (string) $order_number, $token); 
        
        }
       

return "done";


        

        $result = [0, 0];
        $cancel_at = "";
        $status = "";
        $country = "";
        $city = "";

        $c=DB::select("SELECT * FROM kshopina.orders where kshopina_awb is null AND created_at > '2022-02-12' AND verified =6 AND store ='origin'");
foreach ($c as $key => $order_data) {
    $tracking_number = $this->generate_kwb(0, $order_data);
    $query['kshopina_awb'] = $tracking_number;

    $query['tracking_url'] = 'tracking/' . $tracking_number;

    $result2[$order_data->order_number]=$tracking_number;
    DB::table('orders')->where('order_number', $order_data->order_number)->update($query);
}
        
return $result2;




        
        $shopify_token = DB::table('config')->where('keyy', 'origin')->get()[0]->value;
        $store_url = DB::table('config')->where('keyy', 'origin' . '_url')->get()[0]->value;
        
        $orders = [
            '17116'
,'17291'
,'19635'
,'19649'
,'19666'
,'17280'
,'17807'
,'18369'
,'18702'
,'18703'
,'18711'
,'17099'
,'17100'
,'17109'
,'17125'
,'17132'
,'17141'
,'17152'
,'17165'
,'17168'
,'17180'
,'17185'
,'17249'
,'17300'
,'17318'
,'17331'
,'17667'
,'17685'
,'17705'
,'18335'
,'18529'
,'18597'
,'18697'
,'18701'
,'18735'
,'18988'
,'19529'
,'17115'
,'17121'
,'17266'
,'17267'
,'18633'
,'18644'
,'18704'
,'18713'
,'19112'


        ];
        foreach ($orders as $order_number) {

            DB::table('orders')->where('order_number', $order_number)->update(['category'=>1]);


            
        }
return "done";
       
    }

    function add_manual_order($order_number){

        $store = 'plus_ksa';

        $shopify_token = DB::table('config')->where('keyy', $store)->get()[0]->value;
        $store_url = DB::table('config')->where('keyy', $store . '_url')->get()[0]->value;
        $store_myshopify_url = DB::table('config')->where('keyy', $store . '_myshopify')->get()[0]->value;
        
        try {
            $header = array(
                'http' => array(
                    'method' => "GET",
                    'header' => "X-Shopify-Access-Token: " . $shopify_token,

                ),
                "ssl" => array(
                    "verify_peer" => false,
                    "verify_peer_name" => false,
                ),
            );

            $context = stream_context_create($header);
            $order = $store_url . "/admin/api/2023-04/orders.json?name=".$order_number."&status=any";
            // Open the file using the HTTP headers set above
            $data = file_get_contents($order, false, $context);
            $order = json_decode($data);
            $order = $order->orders;

            $order_number= $this->save_orders($store,$order);

            foreach ($order[0]->line_items as $k => $variant) {

                date_default_timezone_set('Africa/Cairo');
                $date = date('Y-m-d H:i:s', time());
    
                $check = DB::select('SELECT * from items where order_id = ? AND variant_id = ? AND store = ?', [$order_number,$variant->variant_id,$store]);

                if ($check == null || $check == []) {
                    $check= [false, []];
                } else {
                    $check =[true, $check];
                }

                if (!$check[0]) {
                    DB::table('items')->insert([
                        'order_id' => $order_number,
                        'country_code' => 'KR',
                        'product_id' => $variant->product_id,
                        'quantity' => $variant->quantity,
                        'price' => $variant->price,
                        'product_name' => $variant->title,
                        'variant_id' => $variant->variant_id,
                        'sku' => $variant->sku,
                        'saved_at' => $date,
                        'store' => $store,
                    ]);
                   
        
                }

                
            }
            $token = $this->generate_url($order_number);

            $this->first_verification_mail($store,(string)$order_number, $token);

        }
        catch (\Throwable $th) {
            return $th;
        }
    }

    function add_group_tracking($id,$tracking_number,$tracking_url){
      
        date_default_timezone_set('Africa/Cairo');
        $date = date('Y-m-d H:i:s', time());

        DB::table('group_orders')->where('group_orders_id', $id)->update(['tracking_number' => $tracking_number, 'tracking_url' => $tracking_url,'tracking_added_at'=>$date]);
    }
}
