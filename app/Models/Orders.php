<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use DateTime;

class Orders extends Model
{
    use HasFactory;

    function saveOrder($value, $international)
    {

        $exist = false;
        $gateway = "";
        if ($value->gateway == "Cash on Delivery (COD)") {
            $gateway = "COD";
        }else if($value->gateway =="E-Wallet (Vodafone Cash / We Cash / Orange Cash and more..)") {
            $gateway = "E-Wallet";
        }
        else{
            $gateway = $value->gateway;
        }
        
        $new = $this->kshopinaAWB($value->order_number, $gateway, $value->total_price, $value->line_items);
        $newAWB = $new[0];
        $sku = $new[1];

        date_default_timezone_set('Asia/Seoul');
        $date = date('Y-m-d H:i:s', time());

        $order_date = date("Y-m-d H:i:s", strtotime($value->created_at));


        $order_data[] = array(
            'order_number'  => $value->order_number,
            'name'  => $value->shipping_address->name,
            'email'  => $value->contact_email,
            'order_id'  => $value->id,
            'country'  => $value->shipping_address->country,
            'address'  => $value->shipping_address->address1,
            'apartment'  => $value->shipping_address->address2,
            'city'  => $value->shipping_address->city,
            'province'  =>  $value->shipping_address->province,
            'total_price'  => $value->total_price,
            'phone_number'  => $value->shipping_address->phone,
            'financial_status'  => $value->financial_status,
            'fulfillment_status'  => $value->fulfillment_status,
            'international_awb'  => $international,
            'kshopina_awb'  => $newAWB,
            'tracking_url'  => url('') . '/' . "tracking/" . $newAWB,
            'gateway'  => $gateway,
            'total_weight'  => $value->total_weight,
            'customer_id'  => $value->customer->id,
            'status' => 0,
            'created_at' => $order_date,
            'update' => 0,
            'saved_at' => $date,
            'verified' => 0,
            'category' => 0,
            'active' => 1,
        );

        if ($this->isExist($value->order_number)[0]) {
            $exist = true;

            if (!empty($order_data)) {
                DB::table('orders')->where('order_number', $value->order_number)->update([
                    'financial_status'  => $value->financial_status,
                    'fulfillment_status'  => $value->fulfillment_status,
                    'international_awb'  => $international,
                    'kshopina_awb'  => $newAWB,
                    'tracking_url'  => url('') . '/' . "tracking/" . $newAWB,
                    'total_weight'  => $value->total_weight,
                    'status' => 0,
                    'update' => 0,
                    'active' => 1
                ]);
            }
        } else {
            $exist = false;
            if (!empty($order_data)) {
                DB::table('orders')->insert($order_data);
            }
        }
        return [$new, $order_data, $exist];
    }
    function isExist($order_number)
    {
        $check = DB::select('select * from orders where order_number = ?', [$order_number]);

        if ($check == null || $check == []) {
            return [false, []];
        } else {
            return [true, $check];
        }
    }
    function count_orders(){
        
    }
    function delete_order($order_number)
    {
        DB::table('orders')->delete($order_number);
    }

    function kshopinaAWB($order_number, $gateway, $total_price, $line_items)
    {
        $status = false;
        $oldsku = "first";


        foreach ($line_items as $k => $items) {


            $skutype = substr($this->getsku($items->product_id, $items->variant_id), -2);

            // stock status

            if ($oldsku == "first") {
                $oldsku = $skutype;
                $status = true;
            } else {
                if ($oldsku == $skutype && ($skutype == "EG" || $skutype == "KW" || $skutype == "SA")) {
                    $oldsku = $skutype;
                    $status = true;
                } else if ($oldsku != $skutype && (($skutype == "EG" || $skutype == "KW" || $skutype == "SA") || ($oldsku == "EG" || $oldsku == "KW" || $oldsku == "SA"))) {
                    $oldsku = "other";
                    $status = false;
                    break;
                } else {
                    $oldsku = $skutype;
                    $status = true;
                }
            }
        }

        if ($status == true) {
            if ($oldsku == "EG") {
                $stock = 0;
            } else if ($oldsku == "KW") {
                $stock = 1;
            } else if ($oldsku == "SA") {
                $stock = 2;
            } else {
                $stock = 3;
            }
        } else {
            $stock = 4;
        }

        // gateway
        if ($gateway == "COD") {
            $payment = 0;
        } else {
            $payment = 1;
        }
        // order price
        if ($total_price < 100) {
            $price = 0;
        } else if ($total_price > 100 && $total_price < 1000) {
            $price = 1;
        } else {
            $price = 2;
        }

        $newAWB = "K" . $order_number . $payment . $stock . $price;

        return [$newAWB, $skutype];
    }

    function getsku($product_id, $variant_id)
    {
        $sku = "";
        $header = array(
            'http' => array(
                'method' => "GET",
                'header' => "X-Shopify-Access-Token: "

            ),
            "ssl"=>array(
                "verify_peer"=>false,
                "verify_peer_name"=>false,
            )
        );

        $context = stream_context_create($header);

        $order = "https://kshopina.com/admin/api/2023-04/products/" . $product_id . ".json";
        // Open the file using the HTTP headers set above
        $data = file_get_contents($order, false, $context);

        $product = json_decode($data);
        $product = $product->product;
        foreach ($product->variants as $key => $value) {
            if ($value->id == $variant_id) {
                $sku = $value->sku;
                break;
            }
        }
        /*  $obj = json_encode($sku);

        echo "<script>console.log(JSON.parse('" . $obj . "'))</script>"; */
        return $sku;
    }
    function getorderbytracking($tracking_number)
    {
        return DB::table('orders')->where('kshopina_awb', $tracking_number)->get();
    }
    function getorderbynumber($order_number)
    {
        return DB::table('orders')->where('order_number', $order_number)->get();
    }

    function getOrders($rule, $page)
    {
        $orders_per_page = 15;
        $offset = ($page - 1) * $orders_per_page;

        if ($rule == 'All') {
            $orders = DB::select('SELECT * from orders where kshopina_awb IS NOT NULL AND status <= ? LIMIT ?, ?;', [4, $offset, $orders_per_page]);
            $number_of_orders = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM kshopina.orders where kshopina_awb IS NOT NULL AND status <= ?;', [4]);
        } else {
            $orders = DB::select('SELECT * from orders where kshopina_awb IS NOT NULL AND country = ? AND status <= ? LIMIT ?, ?;', [$rule, 4, $offset, $orders_per_page]);
            $number_of_orders = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM kshopina.orders where kshopina_awb IS NOT NULL AND country = ? and status <= ?;', [$rule, 4]);
        }
        return [$number_of_orders, $orders];
    }
    function get_archived_Orders($rule, $page)
    {
        $orders_per_page = 15;
        $offset = ($page - 1) * $orders_per_page;

        if ($rule == 'All') {
            $orders = DB::select('SELECT * FROM orders where kshopina_awb IS NOT NULL ORDER BY saved_at DESC LIMIT ?, ?;', [$offset, $orders_per_page]);
            $number_of_orders = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM kshopina.orders where kshopina_awb IS NOT NULL;');
            $egypt = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM kshopina.orders where kshopina_awb IS NOT NULL AND country = ?;', ["Egypt"]);
            $kuwait = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM kshopina.orders where kshopina_awb IS NOT NULL AND country = ?;', ["Kuwait"]);
            $ksa = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM kshopina.orders where kshopina_awb IS NOT NULL AND country = ?;', ["Saudi Arabia"]);
            return [$number_of_orders, $orders, $egypt, $kuwait, $ksa];
        } else {
            $orders = DB::select('SELECT * FROM orders where kshopina_awb IS NOT NULL AND country = ? ORDER BY saved_at DESC LIMIT ?, ?;', [$rule, $offset, $orders_per_page]);
            $number_of_orders = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM kshopina.orders where kshopina_awb IS NOT NULL AND country = ? ;', [$rule]);
            return [$number_of_orders, $orders];
        }
    }
    function QR_codes_order($rule, $page)
    {
        $orders_per_page = 4;
        $offset = ($page - 1) * $orders_per_page;

        if ($rule == 'All') {
            $orders = DB::select('select * from orders where status > ? and status < ? LIMIT ?, ?;', [3, 6, $offset, $orders_per_page]);
            $number_of_orders = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM kshopina.orders where status > ? and status < ?;', [3, 6]);
        } else {
            $orders = DB::select('select * from orders where country = ? and status > ? and status < ? LIMIT ?, ?;', [$rule, 3, 6, $offset, $orders_per_page]);
            $number_of_orders = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM kshopina.orders where country = ? and status > ? and status < ?;', [$rule, 3, 6]);
        }
        return [$number_of_orders, $orders];
    }

    function changestatus($order_number, $aramex_array)
    {
        $new_status = 0;
        if ($aramex_array['delivered'] != null) {
            $new_status = 6;
        } else if ($aramex_array['delivery'] != null) {
            $new_status = 5;
        } else if ($aramex_array['warehouse'] != null) {
            $new_status = 4;
        } else {
            foreach ($aramex_array as $key => $value) {
                if ($key == 'tracking') {
                    continue;
                }
                if ($value != null) {
                    $new_status = $new_status + 1;
                } else {
                    break;
                }
            }
        }
        date_default_timezone_set('Asia/Seoul');
        $date = date('Y-m-d H:i:s', time());

        if ($new_status == 0) {
            DB::table('orders')
                ->where('order_number', $order_number)
                ->update(['status' => $new_status, 'fulfillment_status' => 'Pending', 'updated_at' => $date]);
        } else {
            DB::table('orders')
                ->where('order_number', $order_number)
                ->update(['status' => $new_status, 'fulfillment_status' => 'fullfiled', 'updated_at' => $date]);
        }

        return $new_status;
    }
    function change_spacific_status($order_number, $new_status)
    {

        date_default_timezone_set('Asia/Seoul');
        $date = date('Y-m-d H:i:s', time());

        DB::table('orders')
            ->where('order_number', $order_number)
            ->update(['status' => $new_status,  'updated_at' => $date]);
    }
    function delivered($order_number)
    {
        $order = DB::table('orders')->where('order_number', $order_number)->get();
        $change = true;

        foreach ($order as $key => $value) {
            if ($value->gateway != 'COD') {
                if ($value->financial_status == 'pending') {
                    $change = true;
                } else {
                    $change = false;
                }
            } else {
                $change = true;
            }
        }
        date_default_timezone_set('Asia/Seoul');
        $date = date('Y-m-d H:i:s', time());

        DB::table('orders')
            ->where('order_number', $order_number)
            ->update(['status' => 6, 'financial_status' => 'paid', 'fulfillment_status' => 'fullfiled', 'updated_at' => $date]);
        return $change;
    }
    function changeUpdate($status, $order_number)
    {
        DB::table('orders')->where('order_number', $order_number)->update(['update' => $status]);
    }

    function refused($order_number)
    {


        date_default_timezone_set('Asia/Seoul');
        $date = date('Y-m-d H:i:s', time());

        DB::table('orders')
            ->where('order_number', $order_number)
            ->update(['status' => 7, 'financial_status' => 'refund', 'updated_at' => $date]);
    }
    function refused_page($page)
    {
        $orders_per_page = 4;
        $offset = ($page - 1) * $orders_per_page;

        $orders = DB::select('SELECT * from orders where status >= ? and actions = ? LIMIT ?, ?;', [6, 0, $offset, $orders_per_page]);
        $number_of_orders = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM kshopina.orders where status >= ? and actions = ?;', [6, 0]);

        $pending = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM kshopina.orders where status >= ? and ( actions = ? OR actions = ? );', [6, 3, 0]);
        $delivered = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM kshopina.orders where status >= ? and actions = ? ;', [6, 1]);
        $refused = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM kshopina.orders where status >= ? and actions = ?;', [6, 2]);

        $all_orders = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM kshopina.orders where status >= ? and actions >= 1 and actions < 3 ;', [6]);

        return [$number_of_orders, $orders, $pending, $delivered, $refused, $all_orders];
    }

    function action_taken($order_number, $action)
    {
        DB::table('orders')->where('order_number', $order_number)->update(['actions' => $action]);
    }
    function requests_order($page)
    {
        $orders_per_page = 4;
        $offset = ($page - 1) * $orders_per_page;

        $orders = DB::select('SELECT * from requests where change_status = ? LIMIT ?, ?;', [0, $offset, $orders_per_page]);
        $number_of_orders = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM kshopina.requests where change_status = ? ;', [0]);

        return [$number_of_orders, $orders];
    }
}
