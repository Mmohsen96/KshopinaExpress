<?php

namespace App\Http\Controllers;
use DateTime;
use DateTimeZone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WebhookController extends Controller
{
    protected $verificationModel;

    public function __construct(Request $request)
    {
        $this->verificationModel = new \App\Models\Verification();

        
        
    }

    public function verify_webhook($data, $hmac_header, $store)
    {
        
    }

    public function all_create_new_order(Request $request)
    {

        try {
            $store = $request->store;

            $hmac_header = $_SERVER['HTTP_X_SHOPIFY_HMAC_SHA256'];
            $data = file_get_contents('php://input');
            $verified = $this->verify_webhook($data, $hmac_header, $store);
            error_log('Webhook verified: ' . var_export($verified, true)); // Check error.log to see the result
            if ($verified) {
                $response = $data;

                $response = json_decode($response);

                $order_number = substr($response->name, 1);

                try {
                    $check =$this->isExist($store, $order_number)[0];
                } catch (\Throwable $th) {
                    DB::insert('insert into errors (shipment_number,message,system_name) values (?,?,?)', [$order_number, 'isExist', $store]);
                }

                if (!$check) {
                    try {
                        $this->add_new_order($response, $store);
                    } catch (\Throwable $th) {
                        DB::insert('insert into errors (shipment_number,message,system_name) values (?,?,?)', [$order_number, 'add_new_order', $store]);
                        DB::insert('insert into errors (shipment_number,message,system_name) values (?,?,?)', [$order_number, $th, $store]);

                    }
                    try {
                        $this->saveitem($store, $response->line_items, $order_number,$response);
                    } catch (\Throwable $th) {
                        DB::insert('insert into errors (shipment_number,message,system_name) values (?,?,?)', [$order_number, 'saveitem', $store]);
                        DB::insert('insert into errors (shipment_number,message,system_name) values (?,?,?)', [$order_number, $th, $store]);

                    }
                    try {
                        $token = $this->verificationModel->generate_url($order_number);
                    } catch (\Throwable $th) {
                        DB::insert('insert into errors (shipment_number,message,system_name) values (?,?,?)', [$order_number, 'generate_url', $store]);
                        DB::insert('insert into errors (shipment_number,message,system_name) values (?,?,?)', [$order_number, $th, $store]);

                    }
                    
                    try {
                        $gateway_status = $this->check_gateway($order_number, $store);
                    } catch (\Throwable $th) {
                        DB::insert('insert into errors (shipment_number,message,system_name) values (?,?,?)', [$order_number, 'check_gateway', $store]);
                        DB::insert('insert into errors (shipment_number,message,system_name) values (?,?,?)', [$order_number, $th, $store]);

                    }
    
                   /*  try {
                        if ($response->contact_email =='bnbh@gmail.com' || $response->contact_email =='hk@gmail.com' || $response->contact_email =='ggg@gmail.com') {
                            
                            $this->verificationModel->cancel_shopify($store, (string) $order_number, 'verification');
                            DB::table('orders')->where('order_number', $order_number)->update(['action_by' => 'KMEX-BAN']);

                        }else{

                            $whatsModel = new \App\Models\WhatsApp();

                            $whatsModel->whatsapp_send_fvm_message($store, (string) $order_number, $token);
            

                        }
                    } catch (\Throwable $th) {
                        DB::insert('insert into errors (shipment_number,message,system_name) values (?,?,?)', [$order_number, 'first_verification_message', $store]);
                        DB::insert('insert into errors (shipment_number,message,system_name) values (?,?,?)', [$order_number, $th, $store]);

                    } */

                    /* DB::insert('insert into errors (shipment_number,message,system_name) values (?,?,?)', [$response->order_number, "send", $store]); */
                }
                

            } else {
                http_response_code(401);
            }

        } catch (\Throwable $th) {
            $response = json_decode($response);

            DB::insert('insert into errors (shipment_number,message,system_name) values (?,?,?)', [$order_number, 'ADD NEW ORDER', $store]);
        }

        http_response_code(200);
    }

    public function all_manual_create_new_order(Request $request)
    {
        $store = 'plus_ksa';

        
        $order=["S2588" ];

        foreach ($order as $key => $value) {
         

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
            $order = $store_url . "/admin/api/2023-04/orders.json?name=".$value."&status=any";
            // Open the file using the HTTP headers set above
            $data = file_get_contents($order, false, $context);
            $order = json_decode($data);
            $order = $order->orders;


            foreach ($order as $key => $response) {
                $order_number = substr($response->name, 1);

                try {
                    $check =$this->isExist($store, $order_number)[0];
                } catch (\Throwable $th) {
                    DB::insert('insert into errors (shipment_number,message,system_name) values (?,?,?)', [$order_number, 'isExist', $store]);
                }

                if (!$check) {
                    try {
                        $this->add_new_order($response, $store);
                    } catch (\Throwable $th) {
                        DB::insert('insert into errors (shipment_number,message,system_name) values (?,?,?)', [$order_number, 'add_new_order', $store]);
                        DB::insert('insert into errors (shipment_number,message,system_name) values (?,?,?)', [$order_number, $th, $store]);

                    }
                    try {
                        $this->saveitem($store, $response->line_items, $order_number,$response);
                    } catch (\Throwable $th) {
                        DB::insert('insert into errors (shipment_number,message,system_name) values (?,?,?)', [$order_number, 'saveitem', $store]);
                        DB::insert('insert into errors (shipment_number,message,system_name) values (?,?,?)', [$order_number, $th, $store]);

                    }
                    try {
                        $token = $this->verificationModel->generate_url($order_number);
                    } catch (\Throwable $th) {
                        DB::insert('insert into errors (shipment_number,message,system_name) values (?,?,?)', [$order_number, 'generate_url', $store]);
                        DB::insert('insert into errors (shipment_number,message,system_name) values (?,?,?)', [$order_number, $th, $store]);

                    }
                    /* try {
                        if ($response->contact_email =='bnbh@gmail.com' || $response->contact_email =='hk@gmail.com' || $response->contact_email =='ggg@gmail.com') {
                            
                            $this->verificationModel->cancel_shopify($store, (string) $order_number, 'verification');
                            DB::table('orders')->where('order_number', $order_number)->update(['action_by' => 'KMEX-BAN']);

                        }else{
                            $whatsModel = new \App\Models\WhatsApp();

                            $whatsModel->whatsapp_send_fvm_message($store, (string) $order_number, $token);


                        }
                    } catch (\Throwable $th) {
                        DB::insert('insert into errors (shipment_number,message,system_name) values (?,?,?)', [$order_number, 'first_verification_mail', $store]);
                        DB::insert('insert into errors (shipment_number,message,system_name) values (?,?,?)', [$order_number, $th, $store]);

                    } */
                    try {
                        $this->check_gateway($order_number, $store);
                    } catch (\Throwable $th) {
                        DB::insert('insert into errors (shipment_number,message,system_name) values (?,?,?)', [$order_number, 'check_gateway', $store]);
                        DB::insert('insert into errors (shipment_number,message,system_name) values (?,?,?)', [$order_number, $th, $store]);

                    }

                    /* DB::insert('insert into errors (shipment_number,message,system_name) values (?,?,?)', [$response->order_number, "send", $store]); */
                }
            }
            
        }
        
    }

    public function origin_manual_create_new_shopify_order(Request $request)
    {

        $store = 'origin';

        

            
        /* $order=["S2588" ]; */

        /* foreach ($order as $key => $value) {
            # code...
        } */
       
        for ($i=27425; $i <= 27458 ; $i++) { 
            try {
                //code...
            
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
            $order = $store_url . "/admin/api/2023-04/orders.json?name=".$i."&status=any";
            // Open the file using the HTTP headers set above
            $data = file_get_contents($order, false, $context);
            $order_data = json_decode($data);
            $order_data = $order_data->orders;
            
        
            foreach ($order_data as $key => $order) {
            
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
                $customer = $store_url . "/admin/api/2023-01/customers/".$order->customer->id.".json";
                // Open the file using the HTTP headers set above
                $data = file_get_contents($customer, false, $context);
                $customer = json_decode($data);
                $customer = $customer->customer;


                $orders_count= $customer->orders_count;
                $gateway_value = $order->payment_gateway_names[count($order->payment_gateway_names)-1];

                $cancel_at = "";
                $status = "";
                $country = "";
                $city = "";
                $total_price_with_discount=$order->total_price;

                if (($gateway_value == "Cash on Delivery (COD)" || $gateway_value == "manual") && $order->cancelled_at != null && $order->financial_status == "voided") {
                    $cancel_at = date("Y-m-d H:i:s", strtotime($order->cancelled_at));
                    $status = "canceled";
                } else if ($gateway_value == "Cash on Delivery (COD)" && $order->financial_status == "paid") {
                    $status = "confirmed";
                } else if ($gateway_value == "manual" && $order->financial_status == "paid" && $order->fulfillment_status == "fulfilled") {
                    $status = "confirmed";
                } else {
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
                        [$order->order_number, $order->id, $order->currency, $total_price_with_discount, $order->financial_status, $gateway_value, $order->note, $order->tags, $order->customer->id,
                            $order->customer->email, $order->customer->first_name, $order->customer->last_name, $order->customer->phone, $country,
                            $city, $orders_count, date("Y-m-d H:i:s", strtotime($order->created_at)), date("Y-m-d H:i:s", strtotime($order->updated_at)),
                            $cancel_at, $status]);

                } catch (\Throwable $th) {
                    DB::insert('insert into errors (shipment_number,system_name,message) values (?,?,?)', [$order->order_number, 'shopify_orders', $th]);
                }
            }

            
            
        } catch (\Throwable $th) {
            return $th;
        }
        }
        return "done";

    }
    
    public function add_new_product(Request $request)
    {
        try {
            
            $hmac_header = $_SERVER['HTTP_X_SHOPIFY_HMAC_SHA256'];
            $data = file_get_contents('php://input');
            $verified = $this->verify_webhook($data, $hmac_header, 'plus_egypt');
            error_log('Webhook verified: ' . var_export($verified, true)); // Check error.log to see the result

            if ($verified) {
                $product = json_decode($data);

                $product_values = DB::select('SELECT * from stock where product_id = ? and store = ?', [$product->id,"plus_egypt"]);

                if (count($product_values) == 0) {
                    sleep(3.5);
                }

                if (isset($product->image->src)) {
                    $image = $product->image->src;
                } else {
                    $image = "";
                }

                $product_data = [
                    'product_title' => $product->title,
                    'product_id' => $product->id,
                    'product_type' => $product->product_type,
                    'product_tags' => $product->tags,
                    'created_at' => date("Y-m-d H:i:s", strtotime($product->created_at)),
                    'store' => 'plus_egypt',
                    'number_of_variants' => count($product->variants),
                    'product_cover_image' => $image,
                ];
                $id = DB::table('stock')->insertGetId($product_data);

                foreach ($product->variants as $variant) {

                    $variant_data = [
                        'product_id' => $id,
                        'variant_id' => $variant->id,
                        'variant_title' => $variant->title,
                        'variant_price' => $variant->price,
                        'variant_sku' => $variant->sku,
                        'variant_image' => $variant->image_id,
                        'variant_inventory_id' => $variant->inventory_item_id,
                        'variant_quantity' => $variant->inventory_quantity,
                        'variant_all_quantity' => $variant->inventory_quantity,

                    ];
                    DB::table('variants')->insertGetId($variant_data);
                }

            } else {
                http_response_code(401);
            }
        } catch (\Throwable $th) {

            DB::insert('insert into errors (message ,shipment_number,system_name ,status) values (?,?,?,?)', [$th,$product->id,"plus_egypt","product creation failed"]);
        }

        http_response_code(200);
    }
    /* public function check_product_exist($shopify_product,$store){

        $product_values = DB::select('SELECT * from stock where (product_title = ? OR product_id = ?) and store = ?', [$shopify_product->title,$shopify_product->id,$store]);

        if (count($product_values) == 0) {
            foreach ($shopify_product->variants as $variant) {
                $variant = DB::select('SELECT * from stock where (product_title = ? OR product_id = ?) and store = ?', [$shopify_product->title,$shopify_product->id,$store]);
            }
        }else{

        }
    } */
    public function add_new_manual_product(Request $request)
    {
        $store='plus_ksa';

        try {
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
            $order = $store_url . "/admin/api/2023-04/products/7586923020444.json";
            // Open the file using the HTTP headers set above
            $data = file_get_contents($order, false, $context);
            $order = json_decode($data);
            $product = $order->product;


            if (isset($product->image->src)) {
                $image = $product->image->src;
            } else {
                $image = "";
            }

            $product_data = [
                'product_title' => $product->title,
                'product_id' => $product->id,
                'product_type' => $product->product_type,
                'product_tags' => $product->tags,
                'created_at' => date("Y-m-d H:i:s", strtotime($product->created_at)),
                'store' => 'plus_egypt',
                'number_of_variants' => count($product->variants),
                'product_cover_image' => $image,
            ];
            $id = DB::table('stock')->insertGetId($product_data);

            foreach ($product->variants as $variant) {

                $variant_data = [
                    'product_id' => $id,
                    'variant_id' => $variant->id,
                    'variant_title' => $variant->title,
                    'variant_price' => $variant->price,
                    'variant_sku' => $variant->sku,
                    'variant_image' => $variant->image_id,
                    'variant_inventory_id' => $variant->inventory_item_id,
                    'variant_quantity' => $variant->inventory_quantity,
                    'variant_all_quantity' => $variant->inventory_quantity,

                ];
                $variant_id = DB::table('variants')->insertGetId($variant_data);
                DB::insert('insert into errors (message , system_name ) values (? , ?)', [$product->id.'----'.$variant->id , 'add_new_manual_product' ]);

                if ($store =='origin') {
                    DB::table('variants')->where('id',$variant_id)->update(['unique_barcode'=>$id.$variant_id]);
                }
            }
        } catch (\Throwable $th) {

            return $th;
        }

    }

    public function product_updated(Request $request)
    {
        $variant_array = [];
        $sku_array=[];

        try {

            $hmac_header = $_SERVER['HTTP_X_SHOPIFY_HMAC_SHA256'];
            $data = file_get_contents('php://input');
            $verified = $this->verify_webhook($data, $hmac_header, 'origin');
            error_log('Webhook verified: ' . var_export($verified, true)); // Check error.log to see the result

            if ($verified) {

                $product = json_decode($data);
                $product_values = DB::select('select * from stock where product_id = ?', [$product->id]);
                $product_variants = DB::select('select * from variants where product_id = ?', [$product_values[0]->id]);

                if (isset($product->image->src)) {
                    $image = $product->image->src;
                } else {
                    $image = "";
                }

                $product_data = [
                    'product_title' => $product->title,
                    'product_type' => $product->product_type,
                    'product_tags' => $product->tags,
                    'number_of_variants' => count($product->variants),
                    'product_cover_image' => $image,
                ];

                DB::table('stock')->where('product_id', $product->id)->update($product_data);

                //add all variants to array with key(variant_id) to know the diffrence
                foreach ($product_variants as $saved_variant_data) {
                    $variant_array[$saved_variant_data->variant_id] = $saved_variant_data->id;
                    $sku_array[$saved_variant_data->variant_id] = $saved_variant_data->variant_sku;

                }

                foreach ($product->variants as $variant) {

                    if (isset($variant_array[$variant->id])) {
                        $variant_array[$variant->id] = "Updated";

                        $variant_data = [
                            'variant_id' => $variant->id,
                            'variant_title' => $variant->title,
                            'variant_price' => $variant->price,
                            'variant_sku' => $variant->sku,
                            'variant_image' => $variant->image_id,
                            'variant_inventory_id' => $variant->inventory_item_id,
                            'variant_quantity' => $variant->inventory_quantity,
                        ];

                        DB::table('variants')->where(['product_id' => $product_values[0]->id, 'variant_id' => $variant->id])->update($variant_data);
                    } else {

                        $variant_data = [
                            'product_id' => $product_values[0]->id,
                            'variant_id' => $variant->id,
                            'variant_title' => $variant->title,
                            'variant_price' => $variant->price,
                            'variant_sku' => $variant->sku,
                            'variant_image' => $variant->image_id,
                            'variant_inventory_id' => $variant->inventory_item_id,
                            'variant_quantity' => $variant->inventory_quantity,
                            'variant_all_quantity' => $variant->inventory_quantity,

                        ];
                        DB::table('variants')->insertGetId($variant_data);

                    }
                }

                foreach ($variant_array as $key => $value) {
                    if ($value != "Updated") {
                        DB::table('variants')->where(['product_id' => $product_values[0]->id, 'variant_id' => $key])->update(['product_id' => 0,
                         'variant_image' => $product_values[0]->id,'variant_sku'=>"",'variant_inventory_id'=>$sku_array[$key]]);

                        /* DB::delete('DELETE variants where id=?', [$value]); */
                    }
                }

            } else {
                http_response_code(401);
            }

        } catch (\Throwable $th) {

            DB::insert('insert into errors (message,shipment_number) values (?,?)', [$th, $product->id]);
        }

        http_response_code(200);

    }

    public function egypt_cancelled_order(Request $request)
    {
        try {

            $hmac_header = $_SERVER['HTTP_X_SHOPIFY_HMAC_SHA256'];
            $data = file_get_contents('php://input');
            $verified = $this->verify_webhook($data, $hmac_header, 'plus_egypt');
            error_log('Webhook verified: ' . var_export($verified, true)); // Check error.log to see the result

            if ($verified) {
                $response = $data;

                $response = json_decode($response);

                $order_number = substr($response->name, 1);

                date_default_timezone_set('Africa/Cairo');
                $date = date('Y-m-d H:i:s', time());
                
                $order=DB::select('SELECT * from orders where order_number = ? and order_id = ?', [$order_number,$response->id]);

                foreach ($order as $key => $value) {

                    if ($value->verified ==6 && $value->status !=6) {

                        DB::table('orders')->where(['order_id' => $response->id, 'order_number' => $order_number])->update([
                            'status' => 0, 'actions' => 1,'financial_status'=>"voided",'fulfillment_status' => $response->fulfillment_status,
                             'canceled_at' => $date, 'canceled_by' => "Shopify"]);
    
                    } elseif($value->verified !=6){
                        DB::table('orders')->where(['order_id' => $response->id, 'order_number' => $order_number])->update(['verified' => 3, 'active' => 1,
                        'financial_status' => 'voided', 'fulfillment_status' => $response->fulfillment_status, 'action_taken_by' => $value->action_taken_by.'| Shopify']);
    
                    }

                }

                /* DB::table('orders')->where(['order_id' => $response->id, 'order_number' => $order_number])->update(['verified' => 3, 'active' => 1,
                    'financial_status' => 'voided', 'fulfillment_status' => $response->fulfillment_status, 'action_taken_by' => 'Shopify']); */

                foreach ($response->line_items as $k => $variant) {

                    $product_values = DB::select('SELECT * from stock where product_id = ? AND store = ?', [$variant->product_id, 'plus_egypt']);

                    $stock_info = DB::select('SELECT * from variants where product_id = ? AND variant_id = ?', [$product_values[0]->id,$variant->variant_id]);


                    $history['operation'] = 'IN';
                    $history['operation_side'] = 'Shopify_return';
                    $history['product_id'] = $stock_info[0]->product_id;

                    $history['variant_quantity'] = $stock_info[0]->variant_quantity;

                    $history['adjust'] = $variant->quantity;

                    $this->stock_history($history, $stock_info[0]->id, 'plus_egypt', 'Shopify', false);

                    DB::update('UPDATE kshopina.variants SET variant_quantity = (variant_quantity + ?) WHERE variant_id = ? AND product_id = ? ;', [$variant->quantity, $variant->variant_id,$product_values[0]->id]);

                }
            } else {
                http_response_code(401);
            }

        } catch (\Throwable $th) {

            DB::insert('insert into errors (message) values (?)', [$th]);
        }

        http_response_code(200);

    }

    public function egypt_paid_order(Request $request)
    {

        try {

            $hmac_header = $_SERVER['HTTP_X_SHOPIFY_HMAC_SHA256'];
            $data = file_get_contents('php://input');
            $verified = $this->verify_webhook($data, $hmac_header, 'plus_egypt');
            error_log('Webhook verified: ' . var_export($verified, true)); // Check error.log to see the result

            if ($verified) {
                $response = $data;

                $response = json_decode($response);

                $order_number = substr($response->name, 1);

                /* DB::table('orders')->where(['order_id' => $response->id, 'order_number' => $order_number])->update(['verified' => 6, 'active' => 0, 'financial_status' => 'paid',
                    'fulfillment_status' => $response->fulfillment_status, 'action_taken_by' => 'Shopify']); */

                $order=DB::select('SELECT * from orders where order_number = ?', [$order_number]);

                foreach ($order as $key => $value) {
                    if ($value->status != 5) {
                        DB::insert('insert into errors (shipment_number,message,system_name,status) values (?,?,?,?)', [$order_number, 'MARK AS PAID ON SHOPIFY', 'plus_egypt',$response->payment_gateway_names[count($response->payment_gateway_names)-1]]);
                    }                
                }

                /*  DB::insert('insert into errors (shipment_number,message,system_name,status) values (?,?,?,?)', [$order_number, 'MARK AS PAID ON SHOPIFY', 'plus_egypt',$response->gateway]);
                */

            } else {
                http_response_code(401);
            }

        } catch (\Throwable $th) {

            DB::insert('insert into errors (shipment_number,message) values (?,?)', [$order_number,$th]);
        }

        http_response_code(200);

    }

    public function order_edited(Request $request)
    {
        try {

            $hmac_header = $_SERVER['HTTP_X_SHOPIFY_HMAC_SHA256'];
            $data = file_get_contents('php://input');
            $verified = $this->verify_webhook($data, $hmac_header, 'plus_egypt');
            error_log('Webhook verified: ' . var_export($verified, true)); // Check error.log to see the result

            if ($verified) {
               /*  $response = $data;

                $response = json_decode($response);

                $order_number = substr($response->name, 1);

                $tags = $response->tags;
                $confirm = 0;
                $canceled = 0;

                $tags = explode(",", preg_replace('/\s+/', '', $tags));

                foreach ($tags as $tag) {
                    if ($tag == '#confirmed' || $tag == "#Confirmed") {
                        $confirm = 1;

                    } elseif ($tag == '#canceled' || $tag == "#Canceled") {
                        $canceled = 1;
                    }
                }

                date_default_timezone_set('Africa/Cairo');
                $date = date('Y-m-d H:i:s', time());

                try {
                        if ($canceled == 1) {
                            DB::table('orders')->where(['order_id' => $response->id, 'order_number' => $order_number])->update(['verified' => 3, "email" => $response->email,
                                'active' => '1', 'action_taken_by' => 'Shopify','action_taken_at'=>$date]);
        
                        } elseif ($confirm == 1) {
                            
                            DB::table('orders')->where(['order_id' => $response->id, 'order_number' => $order_number])->update(['verified' => 6, "email" => $response->email,
                            'action_taken_by' => 'Shopify','action_taken_at'=>$date]);
        
                            $tracking_number = $this->verificationModel->generate_kwb(1, $order_number);
                            
                            DB::table('orders')->where(['order_id' => $response->id, 'order_number' => $order_number])->update(['kshopina_awb'=>$tracking_number,
                            'tracking_url'=>'tracking/' . $tracking_number]);
                        }
                    } catch (\Throwable $th) {
                    DB::insert('insert into errors (shipment_number,message) values (?,?)', [$order_number,$th]);
                } */
                
            } else {
                http_response_code(401);
            }

        } catch (\Throwable $th) {

            DB::insert('insert into errors (message) values (?)', [$th]);
        }

        http_response_code(200);

    }

    public function origin_order_edited(Request $request)
    {
        try {

            $hmac_header = $_SERVER['HTTP_X_SHOPIFY_HMAC_SHA256'];
            $data = file_get_contents('php://input');
            $verified = $this->verify_webhook($data, $hmac_header, 'origin');
            error_log('Webhook verified: ' . var_export($verified, true)); // Check error.log to see the result

            if ($verified) {

               /*  $response = $data;

                $response = json_decode($response);

                DB::insert('insert into errors (message, system_name ,shipment_number ) values (?,?,?)', [$response , 'origin_order_edited' , 'pass']); */
                DB::insert('insert into errors (system_name) values (?)', [ 'origin_order_edited' ]);
            } else {
                http_response_code(401);
            }

        } catch (\Throwable $th) {

            DB::insert('insert into errors (message, system_name) values (?,?)', [$th , 'origin_order_edited_error' ]);
        }

        http_response_code(200);

    }

    public function origin_cancelled_order(Request $request)
    {
        try {

            $hmac_header = $_SERVER['HTTP_X_SHOPIFY_HMAC_SHA256'];
            $data = file_get_contents('php://input');
            $verified = $this->verify_webhook($data, $hmac_header, 'origin');
            error_log('Webhook verified: ' . var_export($verified, true)); // Check error.log to see the result

            if ($verified) {
                $response = $data;

                $response = json_decode($response);

                $order_number = $response->order_number;

                date_default_timezone_set('Africa/Cairo');
                $date = date('Y-m-d H:i:s', time());

                $order=DB::select('SELECT * from orders where order_number = ? and order_id = ?', [$order_number,$response->id]);

                foreach ($order as $key => $value) {

                    if ($value->verified ==6 && $value->status !=6) {

                        DB::table('orders')->where(['order_id' => $response->id, 'order_number' => $order_number])->update([
                            'status' => 0, 'actions' => 1,'financial_status'=>"voided",'fulfillment_status' => $response->fulfillment_status,
                             'canceled_at' => $date, 'canceled_by' => "Shopify"]);
    
                    } elseif($value->verified !=6){
                        DB::table('orders')->where(['order_id' => $response->id, 'order_number' => $order_number])->update(['verified' => 3, 'active' => 1,
                        'financial_status' => 'voided', 'fulfillment_status' => $response->fulfillment_status, 'action_taken_by' => $value->action_taken_by.'| Shopify']);
    
                    }
                }
                
                DB::table('shopify_orders')->where('order_number', $order_number)->update(['status' => "canceled",
                    'cancelled_at' => $date, 'financial_status' => $response->financial_status]);

            } else {
                http_response_code(401);
            }

        } catch (\Throwable $th) {

            DB::insert('insert into errors (message) values (?)', [$th]);
        }

        http_response_code(200);
    }

    public function origin_paid_order(Request $request)
    {
        try {

            $hmac_header = $_SERVER['HTTP_X_SHOPIFY_HMAC_SHA256'];
            $data = file_get_contents('php://input');
            $verified = $this->verify_webhook($data, $hmac_header, 'origin');
            error_log('Webhook verified: ' . var_export($verified, true)); // Check error.log to see the result

            if ($verified) {
                $response = $data;

                $response = json_decode($response);

                $order_number = $response->order_number;

                /* date_default_timezone_set('Africa/Cairo');
                $date = date('Y-m-d H:i:s', time());

                DB::table('orders')->where('order_number',(string)$order_number)->update(['verified' => 6, 'active' => 0,
                'delivered_at'=>$date,'status'=>'5','financial_status'=>$response->financial_status]);

                DB::table('shopify_orders')->where('order_number', $order_number)->update(['status' => "confirmed", 'financial_status' => $response->financial_status]);*/
                
                $order=DB::select('SELECT * from orders where order_number = ? ', [$order_number]);

                foreach ($order as $key => $value) {
                    if ($value->status != 5) {
                        DB::insert('insert into errors (shipment_number,message,system_name,status) values (?,?,?,?)', [$order_number, 'MARK AS PAID ON SHOPIFY', 'origin',$response->payment_gateway_names[count($response->payment_gateway_names)-1]]);
                    }                
                }
                
                /*DB::insert('insert into errors (shipment_number,message,system_name,status) values (?,?,?,?)', [$order_number, 'MARK AS PAID ON SHOPIFY', 'origin',$response->gateway]);
                */

            } else {
                http_response_code(401);
            }

        } catch (\Throwable $th) {

            DB::insert('insert into errors (shipment_number,message) values (?,?)', [$order_number,$th]);
        }

        http_response_code(200);

    }
    
    public function plus_cancelled_order(Request $request)
    {
        try {
            $store = $request->store;

            $hmac_header = $_SERVER['HTTP_X_SHOPIFY_HMAC_SHA256'];
            $data = file_get_contents('php://input');
            $verified = $this->verify_webhook($data, $hmac_header, $store);
            error_log('Webhook verified: ' . var_export($verified, true)); // Check error.log to see the result
            if ($verified) {
                $response = $data;

                $response = json_decode($response);

                $order_number = substr($response->name, 1);

                date_default_timezone_set('Africa/Cairo');
                $date = date('Y-m-d H:i:s', time());

                $order=DB::select('SELECT * from orders where order_number = ? and order_id = ?', [$order_number,$response->id]);

                foreach ($order as $key => $value) {

                    if ($value->verified ==6 && $value->status !=6) {

                        DB::table('orders')->where(['order_id' => $response->id, 'order_number' => $order_number])->update([
                            'status' => 0, 'actions' => 1,'financial_status'=>"voided",'fulfillment_status' => $response->fulfillment_status,
                             'canceled_at' => $date, 'canceled_by' => "Shopify"]);
    
                    } elseif($value->verified !=6){
                        DB::table('orders')->where(['order_id' => $response->id, 'order_number' => $order_number])->update(['verified' => 3, 'active' => 1,
                        'financial_status' => 'voided', 'fulfillment_status' => $response->fulfillment_status, 'action_taken_by' => $value->action_taken_by.'| Shopify']);
    
                    }
                }

                try {
                    foreach ($response->line_items as $k => $variant) {

                        if (isset($variant->variant_id) && $variant->variant_id !=null) {

                            $product_values = DB::select('SELECT * from stock where product_id = ? AND store = ?', [$variant->product_id, $store]);

                            $stock_info = DB::select('SELECT * from variants where product_id = ? AND variant_id = ?', [$product_values[0]->id,$variant->variant_id]);


                            $history['operation'] = 'IN';
                            $history['operation_side'] = 'Shopify_return';
                            $history['product_id'] = $stock_info[0]->product_id;
        
                            $history['variant_quantity'] = $stock_info[0]->variant_quantity;
        
                            $history['adjust'] = $variant->quantity;
        
                            $this->stock_history($history, $stock_info[0]->id, $store, 'Shopify', false);
        
                            DB::update('UPDATE kshopina.variants SET variant_quantity = (variant_quantity + ?) WHERE variant_id = ? AND product_id = ? ;', [$variant->quantity, $variant->variant_id,$product_values[0]->id]);

                        }
                            
                    }
                } catch (\Throwable $th) {
                    DB::insert('insert into errors (shipment_number,message,system_name) values (?,?,?)', [$response->order_number, $th, $store]);
                }
                

            } else {
                http_response_code(401);
            }

        } catch (\Throwable $th) {
            $response = json_decode($response);

            DB::insert('insert into errors (shipment_number,message,system_name) values (?,?,?)', [$response->order_number, $th, $store]);
        }

        http_response_code(200);
    }
    
    public function plus_paid_order(Request $request)
    {
        try {
            $store = $request->store;

            $hmac_header = $_SERVER['HTTP_X_SHOPIFY_HMAC_SHA256'];
            $data = file_get_contents('php://input');
            $verified = $this->verify_webhook($data, $hmac_header, $store);
            error_log('Webhook verified: ' . var_export($verified, true)); // Check error.log to see the result
            if ($verified) {
                $response = $data;

                $response = json_decode($response);

                $order_number = substr($response->name, 1);

                /* date_default_timezone_set('Africa/Cairo');
                $date = date('Y-m-d H:i:s', time());

                DB::table('orders')->where('order_number',(string)$order_number)->update(['verified' => 6, 'active' => 0,
                'delivered_at'=>$date,'status'=>'5','financial_status'=>$response->financial_status]);

                DB::table('shopify_orders')->where('order_number', $order_number)->update(['status' => "confirmed", 'financial_status' => $response->financial_status]); */
                
                $order=DB::select('SELECT * from orders where order_number = ?', [$order_number]);

                foreach ($order as $key => $value) {
                    if ($value->status != 5) {
                        DB::insert('insert into errors (shipment_number,message,system_name,status) values (?,?,?,?)', [$order_number, 'MARK AS PAID ON SHOPIFY', $store , $response->payment_gateway_names[count($response->payment_gateway_names)-1]]);
                    }                
                }

                /*DB::insert('insert into errors (shipment_number,message,system_name,status) values (?,?,?,?)', [$order_number, 'MARK AS PAID ON SHOPIFY', $store,$response->gateway]);
                */

            } else {
                http_response_code(401);
            }

        } catch (\Throwable $th) {
            $response = json_decode($response);

            DB::insert('insert into errors (shipment_number,message,system_name) values (?,?,?)', [$response->order_number, $th, $store]);
        }

        http_response_code(200);
    }
    
    public function plus_add_new_product(Request $request)
    {
        try {
            $store = $request->store;

            $hmac_header = $_SERVER['HTTP_X_SHOPIFY_HMAC_SHA256'];
            $data = file_get_contents('php://input');
            $verified = $this->verify_webhook($data, $hmac_header, $store);
            error_log('Webhook verified: ' . var_export($verified, true)); // Check error.log to see the result

            if ($verified) {
                $product = json_decode($data);
                $product_values = DB::select('SELECT * from stock where product_id = ? and store = ?', [$product->id,$store]);

                if (count($product_values) == 0) {
                    sleep(3.5);
                }

                $product_values = DB::select('SELECT * from stock where product_id = ? and store = ?', [$product->id,$store]);
                if (count($product_values) == 0) {
                    if (isset($product->image->src)) {
                        $image = $product->image->src;
                    } else {
                        $image = "";
                    }
    
                    $product_data = [
                        'product_title' => $product->title,
                        'product_id' => $product->id,
                        'product_type' => $product->product_type,
                        'product_tags' => $product->tags,
                        'created_at' => date("Y-m-d H:i:s", strtotime($product->created_at)),
                        'store' => $store,
                        'status' => $product->status,
                        'number_of_variants' => count($product->variants),
                        'product_cover_image' => $image
                    ];
                    $id = DB::table('stock')->insertGetId($product_data);
    
                    foreach ($product->variants as $variant) {
    
                        $variant_data = [
                            'product_id' => $id,
                            'variant_id' => $variant->id,
                            'variant_title' => $variant->title,
                            'variant_price' => $variant->price,
                            'variant_sku' => $variant->sku,
                            'variant_image' => $variant->image_id,
                            'variant_inventory_id' => $variant->inventory_item_id,
                            'variant_quantity' => $variant->inventory_quantity,
                            'variant_all_quantity' => $variant->inventory_quantity,
                        ];
                        $variant_id = DB::table('variants')->insertGetId($variant_data);

                        DB::insert('insert into errors (message , system_name ) values (? , ?)', [$product->id.'----'.$variant->id , 'new_product_in '.$store ]);

                        if ($store =='origin') {
                            DB::table('variants')->where('id',$variant_id)->update(['unique_barcode'=>$id.$variant_id]);
                        }
    
                    }
                }
                

            } else {
                DB::insert('insert into errors (message , system_name ) values (? , ?)', ['smth wrong', 'new_product_in '.$store ]);
                http_response_code(401);
            }
        } catch (\Throwable $th) {

            try {

                DB::insert('insert into errors (message ,shipment_number,system_name ,status) values (?,?,?,?)', [$th,$product->id,$store,"plus creation failed"]);

            } catch (\Throwable $th) {
                DB::insert('insert into errors (message ,shipment_number,system_name ,status) values (?,?,?,?)', ['smth wrong',$product->id,$store,"plus creation failed"]);

            }
        }

        http_response_code(200);
    }

    public function plus_product_updated(Request $request)
    {
        $variant_array = [];
        $sku_array=[];

        try {
            $store = $request->store;

            $hmac_header = $_SERVER['HTTP_X_SHOPIFY_HMAC_SHA256'];
            $data = file_get_contents('php://input');
            $verified = $this->verify_webhook($data, $hmac_header, $store);
            error_log('Webhook verified: ' . var_export($verified, true)); // Check error.log to see the result

            if ($verified) {
                sleep(3.5);
                $product = json_decode($data);
                $product_values = DB::select('select * from stock where product_id = ?', [$product->id]);
                $product_variants = DB::select('select * from variants where product_id = ?', [$product_values[0]->id]);

                if (isset($product->image->src)) {
                    $image = $product->image->src;
                } else {
                    $image = "";
                }

                $product_data = [
                    'product_title' => $product->title,
                    'product_type' => $product->product_type,
                    'product_tags' => $product->tags,
                    'number_of_variants' => count($product->variants),
                    'product_cover_image' => $image,
                ];

                DB::table('stock')->where('product_id', $product->id)->update($product_data);

                //add all variants to array with key(variant_id) to know the diffrence
                foreach ($product_variants as $saved_variant_data) {
                    $variant_array[$saved_variant_data->variant_id] = $saved_variant_data->id;
                    $sku_array[$saved_variant_data->variant_id] = $saved_variant_data->variant_sku;

                }

                foreach ($product->variants as $variant) {

                    if (isset($variant_array[$variant->id])) {
                        $variant_array[$variant->id] = "Updated";

                        $variant_data = [
                            'variant_id' => $variant->id,
                            'variant_title' => $variant->title,
                            'variant_price' => $variant->price,
                            'variant_sku' => $variant->sku,
                            'variant_image' => $variant->image_id,
                            'variant_inventory_id' => $variant->inventory_item_id,
                            'variant_quantity' => $variant->inventory_quantity,
                        ];

                        DB::table('variants')->where(['product_id' => $product_values[0]->id, 'variant_id' => $variant->id])->update($variant_data);
                    } else {

                        $variant_data = [
                            'product_id' => $product_values[0]->id,
                            'variant_id' => $variant->id,
                            'variant_title' => $variant->title,
                            'variant_price' => $variant->price,
                            'variant_sku' => $variant->sku,
                            'variant_image' => $variant->image_id,
                            'variant_inventory_id' => $variant->inventory_item_id,
                            'variant_quantity' => $variant->inventory_quantity,
                            'variant_all_quantity' => $variant->inventory_quantity,
                        ];
                        $variant_id = DB::table('variants')->insertGetId($variant_data);

                        if ($store =='origin') {
                            DB::table('variants')->where('id',$variant_id)->update(['unique_barcode'=>$product_values[0]->id.$variant_id]);
                        }

                    }
                }

                foreach ($variant_array as $key => $value) {
                    if ($value != "Updated") {
                        DB::table('variants')->where(['product_id' => $product_values[0]->id, 'variant_id' => $key])->update(['product_id' => 0,
                         'variant_image' => $product_values[0]->id,'variant_sku'=>"",'variant_inventory_id'=>$sku_array[$key]]);

                        /* DB::delete('DELETE variants where id=?', [$value]); */
                    }
                }

            } else {
                http_response_code(401);
            }

        } catch (\Throwable $th) {

            DB::insert('insert into errors (message,shipment_number) values (?,?)', [$th, $product->id]);
        }

        http_response_code(200);

    }

    public function plus_delete_product(Request $request)
    {

        try {
            $store = $request->store;

            $hmac_header = $_SERVER['HTTP_X_SHOPIFY_HMAC_SHA256'];
            $data = file_get_contents('php://input');
            $verified = $this->verify_webhook($data, $hmac_header, $store);
            error_log('Webhook verified: ' . var_export($verified, true)); // Check error.log to see the result

            if ($verified) {

                $product = json_decode($data);
                $product_values = DB::select('SELECT * from stock where product_id = ?', [$product->id]);

                DB::table('stock')->where(['id' => $product_values[0]->id])->update(['product_type' => $product_values[0]->product_id,
                'product_id' => 0,'store'=>'removed_'. $product_values[0]->store]);

                
                DB::table('variants')->where(['product_id' => $product_values[0]->id])->update(['product_id' => 0,
                         'variant_image' => $product_values[0]->id,'variant_sku'=>""]);


            } else {
                http_response_code(401);
            }
        } catch (\Throwable $th) {

            DB::insert('insert into errors (message) values (?)', [$th]);
        }

        http_response_code(200);

    }
    
    public function ksa_order_edited(Request $request)
    {
        try {

            $hmac_header = $_SERVER['HTTP_X_SHOPIFY_HMAC_SHA256'];
            $data = file_get_contents('php://input');
            $verified = $this->verify_webhook($data, $hmac_header, $request->store);
            $store = $request->store;
            error_log('Webhook verified: ' . var_export($verified, true)); // Check error.log to see the result


            if ($verified) {

              /*   $response = $data;

                $response = json_decode($response); */

                DB::insert('insert into errors (system_name) values (?)', [ $store.'_order_edited' ]);

            } else {
                http_response_code(401);
            }

        } catch (\Throwable $th) {

            DB::insert('insert into errors (message, system_name) values (?,?)', [$th ,  $store.'_order_edited' ]);
        }

        http_response_code(200);

    }

    public function order_edited_webhook(Request $request)
    {
        try {
            $store = $request->store;
            $hmac_header = $_SERVER['HTTP_X_SHOPIFY_HMAC_SHA256'];
            $data = file_get_contents('php://input');
            $verified = $this->verify_webhook($data, $hmac_header, $store);
            error_log('Webhook verified: ' . var_export($verified, true)); // Check error.log to see the result

            if ($verified) {
                $response = $data;
                $response = json_decode($response);

                $order_number = substr($response->name, 1);

                try {
                    $check =$this->isExist($store, $order_number)[0];
                } catch (\Throwable $th) {
                    DB::insert('insert into errors (shipment_number,message,system_name) values (?,?,?)', [$order_number, 'isExist_edit_order', $store]);
                }

                if ($check) {
                    try {
                        $items=DB::select('SELECT * from items where order_id = ?', [$order_number]);

                        if (count($response->line_items) != count($items)) {

                            $exist_flag=0;
                            date_default_timezone_set('Asia/Seoul');
                            $date = date('Y-m-d H:i:s', time());

                            foreach ($response->line_items as $shopify_variant) {
                                
                                foreach ($items as $mysql_variant) {
                                    if ($shopify_variant->variant_id == $mysql_variant->variant_id && $shopify_variant->price == $mysql_variant->price && $shopify_variant->title == $mysql_variant->product_name ) {
                                        $exist_flag =1;
                                    }
                                }

                                if ($exist_flag == 0) {

                                    if (isset($shopify_variant->variant_title) && $shopify_variant->variant_title != null) {
                                        $variant_title = $shopify_variant->variant_title;
                                    }else{
                                        $variant_title = 'Default';
                                    }

                                    DB::table('items')->insert([
                                        'order_id' => $order_number,
                                        'country_code' => 'KR',
                                        'product_id' => $shopify_variant->product_id,
                                        'quantity' => $shopify_variant->quantity,
                                        'price' => $shopify_variant->price,
                                        'product_name' => $shopify_variant->title,
                                        'variant_name'=> $variant_title,
                                        'variant_id' => $shopify_variant->variant_id,
                                        'sku' => $shopify_variant->sku,
                                        'saved_at' => $date,
                                        'store' => $store,
                                    ]);
                                }
                                $exist_flag =0;
                            }
                        }
                    } catch (\Throwable $th) {
                        DB::insert('insert into errors (shipment_number,message,system_name) values (?,?,?)', [$order_number, 'add_new_order', $store]);
                        DB::insert('insert into errors (shipment_number,message,system_name) values (?,?,?)', [$order_number, $th, $store]);

                    }
                }

            } else {
                http_response_code(401);
            }

        } catch (\Throwable $th) {

            DB::insert('insert into errors (message) values (?)', [$th]);
        }

        http_response_code(200);

    }
    
    public function add_new_order($order, $store)
    {
        try {
            $gateway_value = $order->payment_gateway_names[count($order->payment_gateway_names)-1];

            if ($gateway_value == "Cash on Delivery (COD)") {
                $gateway = "COD";
                $category = 0;
            } else if ($gateway_value == "E-Wallet (Vodafone Cash / We Cash / Orange Cash and more..)" && $order->financial_status == 'paid') {
                $gateway = "E-Wallet";
                $category = 2;
            } elseif ($order->financial_status == 'paid') {
                $gateway = $gateway_value;
                $category = 2;
            } else {
                $gateway = $gateway_value;
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

                if (in_array("gift_card",$order->payment_gateway_names) ) {

                    $total_price_with_discount=$order->total_outstanding;
                }else{
                    $total_price_with_discount=$order->total_price;
                }

                
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
                        $converted_price = $total_price_with_discount;
                    } else {
                        $converted_price = $total_price_with_discount * $currency_rate[0]->value;
                    }
                } else {
                    $converted_price = $total_price_with_discount;
                }

                if ($store=='origin') {
                    $date = new DateTime($order->created_at, new DateTimeZone('Asia/Seoul'));
                    $date->setTimezone(new DateTimeZone('Africa/Cairo'));
                }
                else if($store=='plus_ksa'){
                    $date = new DateTime($order->created_at, new DateTimeZone('Asia/Riyadh'));
                    $date->setTimezone(new DateTimeZone('Africa/Cairo'));
                }else if($store=='plus_kuwait'){
                    $date = new DateTime($order->created_at, new DateTimeZone('Asia/Kuwait'));
                    $date->setTimezone(new DateTimeZone('Africa/Cairo'));
                }else{
                    $date = new DateTime($order->created_at, new DateTimeZone('Africa/Cairo'));
                }
                


                $order_date = $date->format('Y-m-d H:i:s');
                $order_data = array(
                    'order_number' => $order_number,
                    'name' => $order->shipping_address->name,
                    'email' => $order->contact_email,
                    'customer_id' => $order->customer->id,
                    'order_id' => $order->id,
                    'total_price' => $total_price_with_discount,
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
                    'financial_status' => $order->financial_status,
                );

                if (!empty($order_data)) {

                    DB::insert('insert into orders (order_number, name,email,customer_id,order_id,
                    total_price,currency,phone_number,address,apartment,city,country,province,gateway,token,created_at,saved_at,verified,category,active,store,financial_status)
                    values (?, ?,?,?, ?,?,?,?, ?,?,?, ?,?,?, ?,?,?, ?,?,?, ?,?)',
                        [
                            $order_number, $order->shipping_address->name, $order->contact_email, $order->customer->id,
                            $order->id, $total_price_with_discount, round($converted_price), $order->shipping_address->phone, $order->shipping_address->address1,
                            $order->shipping_address->address2, $order->shipping_address->city, $order->shipping_address->country,
                            $order->shipping_address->province, $gateway, "", $order_date, $date, 0, 0, 0, $store, $order->financial_status,
                        ]);

                    if ($store == 'origin') {
                        $cancel_at = "";
                        $status = "";
                        $country = "";
                        $city = "";

                        if (($gateway_value == "Cash on Delivery (COD)" || $gateway_value == "manual") && $order->cancelled_at != null && $order->financial_status == "voided") {
                            $cancel_at = date("Y-m-d H:i:s", strtotime($order->cancelled_at));
                            $status = "canceled";
                        } else if ($gateway_value == "Cash on Delivery (COD)" && $order->financial_status == "paid") {
                            $status = "confirmed";
                        } else if ($gateway_value == "manual" && $order->financial_status == "paid" && $order->fulfillment_status == "fulfilled") {
                            $status = "confirmed";
                        } else {
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
                            $customer = $store_url . "/admin/api/2023-01/customers/".$order->customer->id.".json";
                            // Open the file using the HTTP headers set above
                            $data = file_get_contents($customer, false, $context);
                            $customer = json_decode($data);
                            $customer = $customer->customer;
            
            
                            $orders_count= $customer->orders_count;

                            DB::insert('insert into shopify_orders (order_number, order_id,currency,total_price,financial_status,gateway,note,tags,customer_id,email,first_name,last_name,phone,country,city,
                            orders_count,created_at,updated_at,cancelled_at,status) values (?, ?,?, ?,?, ?,?, ?,?, ?,?, ?,?, ?,?, ?,?, ?,?, ?)',
                                [$order->order_number, $order->id, $order->currency, $total_price_with_discount, $order->financial_status, $gateway_value, $order->note, $order->tags, $order->customer->id,
                                    $order->customer->email, $order->customer->first_name, $order->customer->last_name, $order->customer->phone, $country,
                                    $city, $orders_count, date("Y-m-d H:i:s", strtotime($order->created_at)), date("Y-m-d H:i:s", strtotime($order->updated_at)),
                                    $cancel_at, $status]);
                        } catch (\Throwable $th) {
                            DB::insert('insert into errors (shipment_number,system_name,message) values (?,?,?)', [$order->order_number, 'shopify_orders', $th]);
                        }
                    }
                }
            }

            return $order_number;

        } catch (\Throwable $th) {

            DB::insert('insert into errors (shipment_number,message,system_name) values (?,?,?)', [$order->order_number, $th, $store]);
        }
    }

    public function saveitem($store, $variants, $order_number,$order_data)
    {

        foreach ($variants as $k => $variant) {

            date_default_timezone_set('Asia/Seoul');
            $date = date('Y-m-d H:i:s', time());

            if (isset($variant->variant_id) && $variant->variant_id != null && !$this->is_item_exist($store, $variant->variant_id, $order_number)[0]) {

                if (isset($variant->variant_title) && $variant->variant_title != null) {
                    $variant_title = $variant->variant_title;
                }else{
                    $variant_title = 'Default';
                }

                DB::table('items')->insert([
                    'order_id' => $order_number,
                    'country_code' => 'KR',
                    'product_id' => $variant->product_id,
                    'quantity' => $variant->quantity,
                    'price' => $variant->price,
                    'product_name' => $variant->title,
                    'variant_name'=> $variant_title,
                    'variant_id' => $variant->variant_id,
                    'sku' => $variant->sku,
                    'saved_at' => $date,
                    'store' => $store,
                ]);

                if ($store != 'origin') {
                    
                    $product_values = DB::select('SELECT * from stock where product_id = ? AND store = ?', [$variant->product_id, $store]);

                    $stock_info = DB::select('SELECT * from variants where product_id = ? AND variant_id = ?', [$product_values[0]->id,$variant->variant_id]);


                    $history['operation'] = 'OUT';
                    $history['operation_side'] = 'Shopify';
                    $history['product_id'] = $stock_info[0]->product_id;

                    $history['variant_quantity'] = $stock_info[0]->variant_quantity;

                    $history['adjust'] = $variant->quantity;

                    $this->stock_history($history, $stock_info[0]->id, $store, 'Shopify', false);

                    DB::update('UPDATE kshopina.variants SET variant_quantity = (variant_quantity - ?) WHERE variant_id = ? AND product_id = ? ;', [$variant->quantity, $variant->variant_id,$product_values[0]->id]);

                }

                
            }/* else{
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
            } */

        }
        $gateway_value = $order_data->payment_gateway_names[count($order_data->payment_gateway_names)-1];

        if (($store == 'origin' || $store == 'plus_ksa' || $store == 'plus_kuwait') && $gateway_value =='Cash on Delivery (COD)') {
                    
            $cash_fee_numbers=[
            'origin'=> 2.00,
            'plus_ksa'=> 5.00,
            'plus_kuwait'=> .500
            ];
            $cash_fee_string=[
                'origin'=> '2.00',
                'plus_ksa'=> '5.00',
                'plus_kuwait'=> '.500'
            ];

            DB::table('items')->insert([
                'order_id' => $order_number,
                'country_code' => 'KR',
                'product_id' => null,
                'quantity' => 1,
                'price' => $cash_fee_string[$store],
                'product_name' => 'Cash on Delivery fee',
                'variant_name'=> '-',
                'variant_id' => null,
                'sku' => null,
                'saved_at' => $date,
                'store' => $store,
            ]);

            $total_price_with_discount=$order_data->total_price + $cash_fee_numbers[$store];
            $currency_rate = "";

            if ($order_data->shipping_address->country == 'Egypt') {
                $currency_rate = $this->get_currency('EGP');
            } else if ($order_data->shipping_address->country == 'Saudi Arabia') {
                $currency_rate = $this->get_currency('SAR');
            } else if ($order_data->shipping_address->country == 'United Arab Emirates') {
                $currency_rate = $this->get_currency('AED');
            } else if ($order_data->shipping_address->country == 'Bahrain') {
                $currency_rate = $this->get_currency('BHD');
            } else if ($order_data->shipping_address->country == 'Kuwait') {
                $currency_rate = $this->get_currency('KWD');
            } else if ($order_data->shipping_address->country == 'Oman') {
                $currency_rate = $this->get_currency('OMR');
            } else if ($order_data->shipping_address->country == 'Jordan') {
                $currency_rate = $this->get_currency('JOD');
            } else if ($order_data->shipping_address->country == 'Qatar') {
                $currency_rate = $this->get_currency('QAR');
            }

            if ($currency_rate != "") {
                $converted_price = $total_price_with_discount * $currency_rate[0]->value;
                DB::table('orders')->where('order_number',$order_number)->update(['total_price'=>$total_price_with_discount ,'currency' => round($converted_price)]);
            }
        }
    }

    public function check_gateway($order_number, $store)
    {
        $order = DB::select('SELECT * from orders where order_number = ? AND store = ?', [$order_number, $store]);

        if ($order[0]->gateway != 'COD' && $order[0]->financial_status == 'paid' && $order[0]->category == 0) {
            DB::table('orders')->where(['order_number' => $order_number, "store" => $store])->update(['category' => 2]);
        }

        if ($order[0]->financial_status == 'paid') {
            return 'Paid';
        }else{
            return 'COD';
        }
    }

    public function stock_history($variant, $variant_id, $store, $adjust_by, $all_quantity)
    {
        $query['variant_id'] = $variant_id;
        $query['product_id'] = $variant['product_id'];

        $old_quantity = $variant['variant_quantity'];

        $query['operation'] = $variant['operation'];
        $query['adjustment'] = $variant['adjust'];

        $query['operation_side'] = $variant['operation_side'];

        if ($all_quantity == true) {
            $all_quantity = $variant->variant_all_quantity + $variant->adjust;
        }

        $query['store'] = $store;

        date_default_timezone_set('Africa/Cairo');
        $date = date('Y-m-d H:i:s', time());

        $query['adjustment_at'] = $date;

        $query['last_quantity'] = $old_quantity;

        $query['adjust_by'] = $adjust_by;

        DB::table('stock_history')->insert($query);
    }

    public function is_item_exist($store, $variant_id, $order_number)
    {

        $check = DB::select('SELECT * from items where order_id = ? AND variant_id = ? AND store = ?', [$order_number, $variant_id, $store]);

        if ($check == null || $check == []) {
            return [false, []];
        } else {
            return [true, $check];
        }
    }

    public function isExist($store, $order_number)
    {
        $check = DB::select('SELECT * from orders where order_number = ? AND store = ?', [$order_number, $store]);

        if (count($check) == 0 ) {
            return [false, []];
        } else {
            return [true, $check];
        }
    }

    public function get_currency($currency)
    {
        return DB::table('config')->where('keyy', $currency)->get();
    }

    public function fulfilment_placed_on_hold(Request $request)
    {
        try {
            $store = $request->store;

            $hmac_header = $_SERVER['HTTP_X_SHOPIFY_HMAC_SHA256'];
            $data = file_get_contents('php://input');
            $verified = $this->verify_webhook($data, $hmac_header, $store);
            error_log('Webhook verified: ' . var_export($verified, true)); // Check error.log to see the result
            if ($verified) {

                $response = json_decode($data);

                $id_array=explode("/", $response->fulfillment_order->id);

                $fulfilment_order=$this->verificationModel->get_fulfilment($id_array[count($id_array)-1],$store);

                date_default_timezone_set('Africa/Cairo');
                $date = date('Y-m-d H:i:s', time());

                if (isset($fulfilment_order['fulfillment_order']['order_id'])) {

                    $order=$this->verificationModel->get_order_by_order_id($fulfilment_order['fulfillment_order']['order_id'],$store);

                    if ($order[0]->fulfillment_status !='on_hold') {
                        DB::table('orders')->where(['order_id'=>$fulfilment_order['fulfillment_order']['order_id'],'store'=>$store])->update(['fulfillment_status' => "on_hold", 'fulfilled_at' => $date, 'fulfilled_by' =>$order[0]->fulfilled_by." SHOPIFY"]);
                    }
                }

            } else {

                http_response_code(401);
            }

        } catch (\Throwable $th) {
            /* $response = json_decode($response); */

            DB::insert('insert into errors (shipment_number,message,system_name) values (?,?,?)', [$fulfilment_order['fulfillment_order']['order_id'], $th, $store]);
        }

        http_response_code(200);
    }

    public function fulfilment_hold_release(Request $request)
    {
        try {
            $store = $request->store;

            $hmac_header = $_SERVER['HTTP_X_SHOPIFY_HMAC_SHA256'];
            $data = file_get_contents('php://input');
            $verified = $this->verify_webhook($data, $hmac_header, $store);
            error_log('Webhook verified: ' . var_export($verified, true)); // Check error.log to see the result
            if ($verified) {

                $response = json_decode($data);

                $id_array=explode("/", $response->fulfillment_order->id);

                $fulfilment_order=$this->verificationModel->get_fulfilment($id_array[count($id_array)-1],$store);

                date_default_timezone_set('Africa/Cairo');
                $date = date('Y-m-d H:i:s', time());

                if (isset($fulfilment_order['fulfillment_order']['order_id'])) {

                    $order=$this->verificationModel->get_order_by_order_id($fulfilment_order['fulfillment_order']['order_id'],$store);
                    
                    if ($order[0]->fulfillment_status !='released') {
                        DB::table('orders')->where(['order_id'=>$fulfilment_order['fulfillment_order']['order_id'],'store'=>$store])->update(['fulfillment_status' => "released", 'fulfilled_at' => $date, 'fulfilled_by' =>$order[0]->fulfilled_by." SHOPIFY"]);
                    }
                }


            } else {
                http_response_code(401);
            }

        } catch (\Throwable $th) {
            $response = json_decode($response);

            DB::insert('insert into errors (shipment_number,message,system_name) values (?,?,?)', [$fulfilment_order['fulfillment_order']['order_id'], $th, $store]);
        }

        http_response_code(200);
    }
}