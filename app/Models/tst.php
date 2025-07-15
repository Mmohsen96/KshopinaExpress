<?php

namespace App\Models;

use GuzzleHttp\Client as guzzle;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\File ; 


class tst extends Model
{
    use HasFactory;

    protected $status;
    protected $created_at;
    protected $category;
    protected $country_to_store;

    public function __construct()
    {
        $this->status = ['Verified' => 0, 'Fulfilled' => 1, 'Dispatched' => 2, 'Kshopina_Warehouse' => 3, 'Delivery' => 4, 'Delivered' => 5, 'Refused' => 6];
        $this->created_at = ['origin' => "2022-2-12", 'plus_egypt' => '2022-6-24', 'plus_kuwait' => '2022-6-24', 'plus_ksa' => '2022-6-24','plus_uae'=>'2023-4-15'];
        $this->category = ['normal' => 0, 'pre order' => 1, 'paid' => 2];
        $this->country_to_store = ['Egypt' => 'plus_egypt', 'Saudi Arabia' => 'plus_ksa', 'Kuwait' => 'plus_kuwait','United Arab Emirates'=>'plus_uae',
        'Bahrain'=>'bahrain','Qatar'=>'qatar','Oman'=>'oman','Jordan'=>'jordan' ,'Iraq' => 'Iraq'];
    }

    public function get_orders_numbers($store)
    {
        $number_of_verified = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM kshopina.orders where verified = ? AND store = ? AND status = ? AND actions= ? AND created_at > ? ;', [6, $store, $this->status['Verified'], 0, $this->created_at[$store]]);
        $number_of_fulfiled = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM kshopina.orders where verified = ? AND store = ? AND status = ? AND actions= ? AND created_at > ? ;', [6, $store, $this->status['Fulfilled'], 0, $this->created_at[$store]]);

        $number_of_dispatched = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM kshopina.orders where verified = ? AND store = ? AND status = ? AND actions= ? AND created_at > ? ;', [6, $store, $this->status['Dispatched'], 0, $this->created_at[$store]]);
        $number_of_in_warehouse = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM kshopina.orders where verified = ? AND store = ? AND status = ? AND actions= ? AND created_at > ? ;', [6, $store, $this->status['Kshopina_Warehouse'], 0, $this->created_at[$store]]);

        $number_of_delivery = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM kshopina.orders where verified = ? AND store = ? AND status = ? AND actions= ? AND created_at > ? ;', [6, $store, $this->status['Delivery'], 0, $this->created_at[$store]]);
        $number_of_canceled = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM kshopina.orders where verified = ? AND store = ? AND status = ? AND actions = ? AND created_at > ? ;', [6, $store, $this->status['Verified'], 1, $this->created_at[$store]]);

        $number_of_delivered = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM kshopina.orders where verified = ? AND store = ? AND status = ? AND actions= ? AND created_at > ? ;', [6, $store, $this->status['Delivered'], 0, $this->created_at[$store]]);
        $number_of_refused = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM kshopina.orders where verified = ? AND store = ? AND status = ? AND actions= ? AND created_at > ? ;', [6, $store, $this->status['Refused'], 0, $this->created_at[$store]]);

        return [
            $number_of_verified, $number_of_fulfiled, $number_of_dispatched,
            $number_of_in_warehouse, $number_of_delivery, $number_of_canceled, $number_of_delivered, $number_of_refused,
        ];
    }
    
    public function orders_by_awb($store, $rule, $category, $page)
    {
        $products_per_page = 15;
        $offset = ($page - 1) * $products_per_page; 
        $map_of_awb=[];
        $map_of_awb_data=[];

        if ($rule == "Others") {

           
            $orders = DB::select('SELECT * FROM kshopina.international_awbs RIGHT JOIN ( SELECT * FROM orders INNER JOIN (SELECT international_awb as international_awbs from kshopina.orders where store = ? AND verified = ? AND on_process = ? 
                                AND country not in ("Egypt","Saudi Arabia","Kuwait","Oman","Bahrain","Qatar","Jordan","United Arab Emirates" ,"Iraq")
                                AND created_at > ? AND international_awb is not null AND international_awb != "" group by international_awb ) 
                                as orders_data ON orders.international_awb = orders_data.international_awbs) as orders ON international_awbs.mawb = orders.international_awbs where (awb_active = 0 OR awb_active is null) ORDER BY expected_date DESC  ;', 
                                [ $store, 6, 0, $this->created_at[$store] ]);

            /* $number_of_orders = DB::select('SELECT COUNT(count) as NumberOfOrders FROM ( SELECT COUNT(id) AS count FROM orders  INNER JOIN (SELECT international_awb  from  kshopina.orders where store = ? AND verified = ? AND on_process = ? 
                                            AND country not in ("Egypt","Saudi Arabia","Kuwait","Oman","Bahrain","Qatar","Jordan","United Arab Emirates")
                                            AND created_at > ? AND international_awb is not null AND international_awb != "" group by international_awb ) 
                                            as orders_data ON orders.international_awb = orders_data.international_awb) as A;'
                                            , [ $store, 6, 0, $this->created_at[$store]]); */

        } elseif($rule == "All"){
           
            $orders = DB::select('SELECT * FROM kshopina.international_awbs RIGHT JOIN (SELECT * FROM orders INNER JOIN (SELECT international_awb as international_awbs from kshopina.orders where store = ? AND verified = ? AND on_process = ? 
                                    AND created_at > ? AND international_awb is not null AND international_awb != "" group by international_awb ) 
                                    as orders_data ON orders.international_awb = orders_data.international_awbs) as orders ON international_awbs.mawb = orders.international_awbs where (awb_active = 0 OR awb_active is null) ORDER BY expected_date DESC  ;', 
                                    [ $store, 6, 0, $this->created_at[$store] ] );

            /* $number_of_orders = DB::select('SELECT COUNT(count) as NumberOfOrders FROM ( SELECT COUNT(id) AS count from  kshopina.orders where store = ? AND verified = ? AND on_process = ? 
                                            AND created_at > ? AND international_awb is not null AND international_awb != "" group by international_awb) as A;',
                                            [ $store, 6, 0, $this->created_at[$store]]); */
        }else {
            
           $orders =  DB::select('SELECT * FROM kshopina.international_awbs RIGHT JOIN (SELECT * FROM orders INNER JOIN (SELECT international_awb as international_awbs from kshopina.orders where store = ? AND verified = ? AND on_process = ? 
                                    AND country = ? AND created_at > ? AND international_awb is not null AND international_awb != "" group by international_awb  ) 
                                    as orders_data ON orders.international_awb = orders_data.international_awbs ) as orders ON international_awbs.mawb = orders.international_awbs where (awb_active = 0 OR awb_active is null) ORDER BY expected_date DESC  
                                    ', [ $store, 6, 0, $rule , $this->created_at[$store] ]);

            /* $number_of_orders = DB::select('SELECT COUNT(count) as NumberOfOrders FROM ( SELECT COUNT(id) AS count from  kshopina.orders where store = ? AND verified = ? AND on_process = ? 
                                            AND country = ? AND created_at > ? AND international_awb is not null AND international_awb != "" group by international_awb) as A ;
                                            ', [ $store, 6, 0, $rule , $this->created_at[$store]]); */
        }

        foreach ($orders as $order) {

            if (isset($map_of_awb[$order->international_awb])  ) {
                array_push($map_of_awb[$order->international_awb],$order);
            }else{
                $map_of_awb[$order->international_awb]=[$order];
            }

            if ($order->mawb != null ) {
                $map_of_awb_data[$order->mawb]=$order;
            } 

        }


        $all_orders_numbers = $this->get_orders_numbers($store);

        return [
            $orders, $all_orders_numbers[0], $all_orders_numbers[1],
            $all_orders_numbers[2], $all_orders_numbers[3], $all_orders_numbers[4], $all_orders_numbers[5], $all_orders_numbers[6], $all_orders_numbers[7],$map_of_awb,$map_of_awb_data
            
        ];

        /* DB::select('SELECT * FROM kshopina.international_awbs RIGHT JOIN (SELECT * FROM orders INNER JOIN (SELECT international_awb as international_awbs from kshopina.orders where store = ? AND verified = ? AND on_process = ? 
        AND country = ? AND created_at > ? AND international_awb is not null AND international_awb != "" group by international_awb  ) 
        as orders_data ON orders.international_awb = orders_data.international_awbs ) as orders ON international_awbs.mawb = orders.international_awbs where (awb_active = 0 OR awb_active is null) 
        UNION
        SELECT * FROM kshopina.international_awbs LEFT JOIN (SELECT * FROM orders INNER JOIN (SELECT international_awb as international_awbs from kshopina.orders where store = ? AND verified = ? AND on_process = ? 
        AND country = ? AND created_at > ? AND international_awb is not null AND international_awb != "" group by international_awb )
        as orders_data ON orders.international_awb = orders_data.international_awbs ) as orders ON international_awbs.mawb = orders.international_awbs where (awb_active = 0 OR awb_active is null) ORDER BY expected_date DESC;
        ', [ $store, 6, 0, $rule , $this->created_at[$store] , $store, 6, 0, $rule , $this->created_at[$store] ]); */

    }
    
    public function get_confirmed_orders($store, $rule, $category, $page, $status)
    {
        $products_per_page = 15;
        $offset = ($page - 1) * $products_per_page;
        $map_of_availability=[];
        $map_of_number_of_items=[];
        $pre_order_arrange = '';

        if($category != "all"){ 
             if ($category != 'pre%20order') {
                $pre_order_arrange = '';
             } else {
                $pre_order_arrange = 'ORDER BY release_date ASC';
             }
             
            if ($rule == "Others") {

                if ($status != "on_process") {
                    $orders = DB::select('SELECT * FROM orders where country not in ("Egypt","Saudi Arabia","Kuwait","Oman","Bahrain","Qatar","Jordan","United Arab Emirates","Iraq") AND (international_awb is null OR international_awb = "") AND store = ? AND verified = ? AND on_process = ? AND status = ? AND actions = ? AND category =? AND created_at > ? '.$pre_order_arrange.' LIMIT ?, ?;', [$store, 6, 0, $this->status[$status], 0, $this->category[$category], $this->created_at[$store], $offset, $products_per_page]);
                    $number_of_orders = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM orders where country not in ("Egypt","Saudi Arabia","Kuwait","Oman","Bahrain","Qatar","Jordan","United Arab Emirates","Iraq") AND (international_awb is null OR international_awb = "") AND store = ? AND verified = ? AND on_process = ? AND status = ? AND actions = ? AND category =? AND created_at > ?', [$store, 6, 0, $this->status[$status], 0, $this->category[$category], $this->created_at[$store]]);
                } else {
                    $orders = DB::select('SELECT * FROM orders where country not in ("Egypt","Saudi Arabia","Kuwait","Oman","Bahrain","Qatar","Jordan","United Arab Emirates","Iraq") AND store = ? AND verified = ? AND on_process = ? AND actions = ? AND category =? AND created_at > ? '.$pre_order_arrange.' LIMIT ?, ?;', [$store, 6, 1, 0, $this->category[$category], $this->created_at[$store], $offset, $products_per_page]);
                    $number_of_orders = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM orders where country not in ("Egypt","Saudi Arabia","Kuwait","Oman","Bahrain","Qatar","Jordan","United Arab Emirates","Iraq") AND store = ? AND verified = ? AND on_process = ? AND actions = ? AND category =? AND created_at > ?', [$store, 6, 1, 0, $this->category[$category], $this->created_at[$store]]);
                }
                
            } elseif($rule == "All"){
                if ($store == 'origin') {
                    if ($status != "on_process") {
                        $orders = DB::select('SELECT * FROM orders where (international_awb is null OR international_awb = "") AND store = ? AND verified = ? AND on_process = ? AND status = ? AND actions = ? AND category =? AND created_at > ? '.$pre_order_arrange.' LIMIT ?, ?;', [$store, 6, 0, $this->status[$status], 0, $this->category[$category], $this->created_at[$store], $offset, $products_per_page]);
                        $number_of_orders = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM orders where (international_awb is null OR international_awb = "") AND store = ? AND verified = ? AND on_process = ? AND status = ? AND actions = ? AND category =? AND created_at > ?', [$store, 6, 0, $this->status[$status], 0, $this->category[$category], $this->created_at[$store]]);
                    } else {
                        $orders = DB::select('SELECT * FROM orders where (international_awb is null OR international_awb = "") AND  store = ? AND verified = ? AND on_process = ? AND actions = ? AND category =? AND created_at > ? '.$pre_order_arrange.' LIMIT ?, ?;', [ $store, 6, 1, 0, $this->category[$category], $this->created_at[$store], $offset, $products_per_page]);
                        $number_of_orders = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM orders where (international_awb is null OR international_awb = "") AND store = ? AND verified = ? AND on_process = ? AND actions = ? AND category =? AND created_at > ?', [$store, 6, 1, 0, $this->category[$category], $this->created_at[$store]]);
                    }
                } else {
                    if ($status != "on_process") {
                        $orders = DB::select('SELECT * FROM orders where  (international_awb is null OR international_awb = "") AND store = ? AND verified = ? AND on_process = ? AND status = ? AND actions = ? AND category =? AND created_at > ? '.$pre_order_arrange.' LIMIT ?, ?;', [$store, 6, 0, $this->status[$status], 0, $this->category[$category], $this->created_at[$store], $offset, $products_per_page]);
                        $number_of_orders = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM orders where (international_awb is null OR international_awb = "") AND store = ? AND verified = ? AND on_process = ? AND status = ? AND actions = ? AND category =? AND created_at > ?', [$store, 6, 0, $this->status[$status], 0, $this->category[$category], $this->created_at[$store]]);
                    } else {
                        $orders = DB::select('SELECT * FROM orders where  (international_awb is null OR international_awb = "") AND  store = ? AND verified = ? AND on_process = ? AND actions = ? AND category =? AND created_at > ? '.$pre_order_arrange.' LIMIT ?, ?;', [$store, 6, 1, 0, $this->category[$category], $this->created_at[$store], $offset, $products_per_page]);
                        $number_of_orders = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM orders where  (international_awb is null OR international_awb = "") AND store = ? AND verified = ? AND on_process = ? AND actions = ? AND category =? AND created_at > ?', [$store, 6, 1, 0, $this->category[$category], $this->created_at[$store]]);
                    }
                }
            }else {
                if ($store == 'origin') {
                    if ($status != "on_process") {
                        $orders = DB::select('SELECT * FROM orders where country = ? AND (international_awb is null OR international_awb = "") AND store = ? AND verified = ? AND on_process = ? AND status = ? AND actions = ? AND category =? AND created_at > ? '.$pre_order_arrange.' LIMIT ?, ?;', [$rule, $store, 6, 0, $this->status[$status], 0, $this->category[$category], $this->created_at[$store], $offset, $products_per_page]);
                        $number_of_orders = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM orders where country = ? AND (international_awb is null OR international_awb = "") AND store = ? AND verified = ? AND on_process = ? AND status = ? AND actions = ? AND category =? AND created_at > ?', [$rule, $store, 6, 0, $this->status[$status], 0, $this->category[$category], $this->created_at[$store]]);

                    } else {
                        $orders = DB::select('SELECT * FROM orders where country = ? AND (international_awb is null OR international_awb = "") AND  store = ? AND verified = ? AND on_process = ? AND actions = ? AND category =? AND created_at > ? '.$pre_order_arrange.' LIMIT ?, ?;', [$rule, $store, 6, 1, 0, $this->category[$category], $this->created_at[$store], $offset, $products_per_page]);
                        $number_of_orders = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM orders where country = ? AND (international_awb is null OR international_awb = "") AND store = ? AND verified = ? AND on_process = ? AND actions = ? AND category =? AND created_at > ?', [$rule, $store, 6, 1, 0, $this->category[$category], $this->created_at[$store]]);
                    }

                } else {
                    if ($status != "on_process") {
                        $orders = DB::select('SELECT * FROM orders where  (international_awb is null OR international_awb = "") AND store = ? AND verified = ? AND on_process = ? AND status = ? AND actions = ? AND category =? AND created_at > ? '.$pre_order_arrange.' LIMIT ?, ?;', [$store, 6, 0, $this->status[$status], 0, $this->category[$category], $this->created_at[$store], $offset, $products_per_page]);
                        $number_of_orders = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM orders where (international_awb is null OR international_awb = "") AND store = ? AND verified = ? AND on_process = ? AND status = ? AND actions = ? AND category =? AND created_at > ?', [$store, 6, 0, $this->status[$status], 0, $this->category[$category], $this->created_at[$store]]);
                    } else {
                        $orders = DB::select('SELECT * FROM orders where  (international_awb is null OR international_awb = "") AND  store = ? AND verified = ? AND on_process = ? AND actions = ? AND category =? AND created_at > ? '.$pre_order_arrange.' LIMIT ?, ?;', [$store, 6, 1, 0, $this->category[$category], $this->created_at[$store], $offset, $products_per_page]);
                        $number_of_orders = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM orders where  (international_awb is null OR international_awb = "") AND store = ? AND verified = ? AND on_process = ? AND actions = ? AND category =? AND created_at > ?', [$store, 6, 1, 0, $this->category[$category], $this->created_at[$store]]);
                    }
                }
            }

        }else{
            if ($rule == "Others") {

                if ($status != "on_process") {
                    $orders = DB::select('SELECT * FROM orders where country not in ("Egypt","Saudi Arabia","Kuwait","Oman","Bahrain","Qatar","Jordan","United Arab Emirates","Iraq" ) AND (international_awb is null OR international_awb = "") AND store = ? AND verified = ? AND on_process = ? AND status = ? AND actions = ?  AND created_at > ?    LIMIT ?, ?;', [$store, 6, 0, $this->status[$status], 0, $this->created_at[$store], $offset, $products_per_page]);
                    $number_of_orders = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM orders where country not in ("Egypt","Saudi Arabia","Kuwait","Oman","Bahrain","Qatar","Jordan","United Arab Emirates" ,"Iraq") AND (international_awb is null OR international_awb = "") AND store = ? AND verified = ? AND on_process = ? AND status = ? AND actions = ?  AND created_at > ?', [$store, 6, 0, $this->status[$status], 0,  $this->created_at[$store]]);
                } else {
                    $orders = DB::select('SELECT * FROM orders where country not in ("Egypt","Saudi Arabia","Kuwait","Oman","Bahrain","Qatar","Jordan","United Arab Emirates", "Iraq") AND store = ? AND verified = ? AND on_process = ? AND actions = ? AND created_at > ?    LIMIT ?, ?;', [$store, 6, 1, 0, $this->created_at[$store], $offset, $products_per_page]);
                    $number_of_orders = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM orders where country not in ("Egypt","Saudi Arabia","Kuwait","Oman","Bahrain","Qatar","Jordan","United Arab Emirates", "Iraq") AND store = ? AND verified = ? AND on_process = ? AND actions = ?  AND created_at > ?', [$store, 6, 1, 0, $this->created_at[$store]]);
                }

            } elseif($rule == "All"){
                if ($store == 'origin') {
                    if ($status != "on_process") {
                        $orders = DB::select('SELECT * FROM orders where (international_awb is null OR international_awb = "") AND store = ? AND verified = ? AND on_process = ? AND status = ? AND actions = ?  AND created_at > ?    LIMIT ?, ?;', [$store, 6, 0, $this->status[$status], 0,  $this->created_at[$store], $offset, $products_per_page]);
                        $number_of_orders = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM orders where (international_awb is null OR international_awb = "") AND store = ? AND verified = ? AND on_process = ? AND status = ? AND actions = ? AND created_at > ?', [$store, 6, 0, $this->status[$status], 0, $this->created_at[$store]]);
                    } else {
                        $orders = DB::select('SELECT * FROM orders where (international_awb is null OR international_awb = "") AND  store = ? AND verified = ? AND on_process = ? AND actions = ?  AND created_at > ?    LIMIT ?, ?;', [ $store, 6, 1, 0, $this->created_at[$store], $offset, $products_per_page]);
                        $number_of_orders = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM orders where (international_awb is null OR international_awb = "") AND store = ? AND verified = ? AND on_process = ? AND actions = ?  AND created_at > ?', [$store, 6, 1, 0,  $this->created_at[$store]]);
                    }
                } else {
                    if ($status != "on_process") {
                        $orders = DB::select('SELECT * FROM orders where  (international_awb is null OR international_awb = "") AND store = ? AND verified = ? AND on_process = ? AND status = ? AND actions = ? AND created_at > ?   LIMIT ?, ?;', [$store, 6, 0, $this->status[$status], 0,  $this->created_at[$store], $offset, $products_per_page]);
                        $number_of_orders = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM orders where (international_awb is null OR international_awb = "") AND store = ? AND verified = ? AND on_process = ? AND status = ? AND actions = ?  AND created_at > ?', [$store, 6, 0, $this->status[$status], 0,  $this->created_at[$store]]);
                    } else {
                        $orders = DB::select('SELECT * FROM orders where  (international_awb is null OR international_awb = "") AND  store = ? AND verified = ? AND on_process = ? AND actions = ? AND created_at > ?  LIMIT ?, ?;', [$store, 6, 1, 0,  $this->created_at[$store], $offset, $products_per_page]);
                        $number_of_orders = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM orders where  (international_awb is null OR international_awb = "") AND store = ? AND verified = ? AND on_process = ? AND actions = ? AND created_at > ?', [$store, 6, 1, 0,  $this->created_at[$store]]);
                    }
                }
            }else {
                if ($store == 'origin') {
                    if ($status != "on_process") {
                        $orders = DB::select('SELECT * FROM orders where country = ? AND (international_awb is null OR international_awb = "") AND store = ? AND verified = ? AND on_process = ? AND status = ? AND actions = ?  AND created_at > ?  LIMIT ?, ?;', [$rule, $store, 6, 0, $this->status[$status], 0,  $this->created_at[$store], $offset, $products_per_page]);
                        $number_of_orders = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM orders where country = ? AND (international_awb is null OR international_awb = "") AND store = ? AND verified = ? AND on_process = ? AND status = ? AND actions = ?  AND created_at > ?', [$rule, $store, 6, 0, $this->status[$status], 0, $this->created_at[$store]]);
                    } else {
                        $orders = DB::select('SELECT * FROM orders where country = ? AND (international_awb is null OR international_awb = "") AND  store = ? AND verified = ? AND on_process = ? AND actions = ? AND created_at > ?  LIMIT ?, ?;', [$rule, $store, 6, 1, 0,  $this->created_at[$store], $offset, $products_per_page]);
                        $number_of_orders = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM orders where country = ? AND (international_awb is null OR international_awb = "") AND store = ? AND verified = ? AND on_process = ? AND actions = ?  AND created_at > ?', [$rule, $store, 6, 1, 0,  $this->created_at[$store]]);
                    }
                } else {
                    if ($status != "on_process") {
                        $orders = DB::select('SELECT * FROM orders where  (international_awb is null OR international_awb = "") AND store = ? AND verified = ? AND on_process = ? AND status = ? AND actions = ?  AND created_at > ?  LIMIT ?, ?;', [$store, 6, 0, $this->status[$status], 0,  $this->created_at[$store], $offset, $products_per_page]);
                        $number_of_orders = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM orders where (international_awb is null OR international_awb = "") AND store = ? AND verified = ? AND on_process = ? AND status = ? AND actions = ?  AND created_at > ?', [$store, 6, 0, $this->status[$status], 0,  $this->created_at[$store]]);
                    } else {
                        $orders = DB::select('SELECT * FROM orders where  (international_awb is null OR international_awb = "") AND  store = ? AND verified = ? AND on_process = ? AND actions = ?  AND created_at > ?  LIMIT ?, ?;', [$store, 6, 1, 0,  $this->created_at[$store], $offset, $products_per_page]);
                        $number_of_orders = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM orders where  (international_awb is null OR international_awb = "") AND store = ? AND verified = ? AND on_process = ? AND actions = ? AND created_at > ?', [$store, 6, 1, 0,  $this->created_at[$store]]);
                    }
                }
            }
        }

        if($rule != "Others" && $store == 'origin' && $rule != "All"){

            if (count($orders)>0) {
                $orders_string="(";
                foreach ($orders as $index=> $order) {
                    if ($index == count($orders)-1 ) {
                        $orders_string = $orders_string.'"'.$order->order_number.'"';
                    }else{
                        $orders_string = $orders_string.'"'.$order->order_number.'",';
                    }
                }
                $orders_string =$orders_string.")";
    
                $availability=DB::select('SELECT order_details.order_number, order_details.total_price, order_details.created_at,
                                    order_details.country,order_details.origin_variant_id,order_details.quantity,order_details.sku,order_details.variant_quantity,
                                    order_details.plus_variant_id ,order_details.variant_title, stock.product_title,stock.store
                                    FROM kshopina.stock INNER JOIN
                                (SELECT orders.order_number, orders.total_price, orders.created_at,
                                    orders.country,orders.variant_id as origin_variant_id ,orders.quantity,orders.sku,variants.variant_quantity,
                                    variants.variant_id as plus_variant_id,variants.product_id,variants.variant_title 
                                    FROM kshopina.variants INNER JOIN
                                    ( SELECT
                                    orders.order_number , orders.total_price , orders.created_at , items.variant_id, 
                                    items.quantity,items.sku,orders.country
                                    FROM items INNER JOIN orders ON items.order_id = orders.order_number where order_number IN ' .$orders_string. ' ) as orders 
                                    ON orders.sku = variants.variant_sku where orders.quantity <= variants.variant_quantity ) as order_details 
                                    ON order_details.product_id = stock.id 
                                    where stock.store=? ', [$this->country_to_store[$rule]]);
    
                $number_of_items=DB::select('SELECT order_id,count(id) as number_of_items from items where order_id IN ' .$orders_string. ' group by order_id');
    
                foreach ($availability as $order) {
                    if ($order->sku != "" || !empty($order->sku)) {
                        if (isset($map_of_availability[$order->order_number])) {
                            
                                array_push($map_of_availability[$order->order_number],$order);
                        }else{
                                $map_of_availability[$order->order_number]=[$order];
                        }
                    }
                }
                foreach ($number_of_items as $order) {
                    $map_of_number_of_items[$order->order_id]=$order->number_of_items;
                }
            }
        }
        
        $all_orders_numbers = $this->get_orders_numbers($store);
        
        return [
            $number_of_orders, $orders, $all_orders_numbers[0], $all_orders_numbers[1],
            $all_orders_numbers[2], $all_orders_numbers[3], $all_orders_numbers[4], $all_orders_numbers[5], $all_orders_numbers[6], $all_orders_numbers[7],
            $map_of_availability,$map_of_number_of_items
        ];
    }

    public function get_tst_orders($store, $rule, $category, $page)
    {

        $products_per_page = 15;
        $offset = ($page - 1) * $products_per_page;
        if($category != "all"){   

            if ($rule == "Others") {
                $orders = DB::select('SELECT * FROM orders where country not in ("Egypt","Saudi Arabia","Kuwait","Oman","Bahrain","Qatar","Jordan","United Arab Emirates", "Iraq") AND store = ? AND verified = ? AND  (international_awb is not null AND international_awb !="") AND actions != ? AND status < ? AND category =? AND created_at > ? ORDER BY domestic_awb  ASC LIMIT ?, ?;', [$store, 6, 1, $this->status['Delivered'], $this->category[$category], $this->created_at[$store], $offset, $products_per_page]);
                $number_of_orders = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM orders where country not in ("Egypt","Saudi Arabia","Kuwait","Oman","Bahrain","Qatar","Jordan","United Arab Emirates", "Iraq") AND store = ? AND verified = ? AND (international_awb is not null AND international_awb !="") AND actions != ?   AND status < ? AND category =? AND created_at > ? ORDER BY domestic_awb  ASC', [$store, 6, 1, $this->status['Delivered'], $this->category[$category], $this->created_at[$store]]);
            }elseif($rule=='All'){
                if ($store == 'origin') {
                    $orders = DB::select('SELECT * FROM orders where store = ? AND verified = ? AND (international_awb is not null AND international_awb !="") AND actions != ?  AND status < ? AND category =? AND created_at > ? ORDER BY domestic_awb  ASC LIMIT ?, ?;', [ $store, 6, 1, 5, $this->category[$category], $this->created_at[$store], $offset, $products_per_page]);
                    $number_of_orders = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM orders where store = ? AND verified = ? AND (international_awb is not null AND international_awb !="") AND actions != ?  AND status < ? AND category =? AND created_at > ? ORDER BY domestic_awb  ASC', [ $store, 6, 1, 5, $this->category[$category], $this->created_at[$store]]);
                } else {
                    $orders = DB::select('SELECT * FROM orders where store = ? AND verified = ? AND (international_awb is not null AND international_awb !="")  AND actions != ?  AND status < ? AND category =? AND created_at > ? ORDER BY domestic_awb  ASC LIMIT ?, ?;', [$store, 6, 1, 5, $this->category[$category], $this->created_at[$store], $offset, $products_per_page]);
                    $number_of_orders = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM orders where  store = ? AND verified = ? AND (international_awb is not null AND international_awb !="") AND actions != ?  AND status < ? AND category =? AND created_at > ? ORDER BY domestic_awb  ASC ', [$store, 6, 1, 5, $this->category[$category], $this->created_at[$store]]);
                }
            }
            else {
                if ($store == 'origin') {
                    $orders = DB::select('SELECT * FROM orders where country = ? AND store = ? AND verified = ? AND (international_awb is not null AND international_awb !="") AND actions != ?  AND status < ? AND category =? AND created_at > ? ORDER BY domestic_awb  ASC LIMIT ?, ?;', [$rule, $store, 6, 1, 5, $this->category[$category], $this->created_at[$store], $offset, $products_per_page]);
                    $number_of_orders = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM orders where country = ? AND store = ? AND verified = ? AND (international_awb is not null AND international_awb !="") AND actions != ?  AND status < ? AND category =? AND created_at > ? ORDER BY domestic_awb  ASC ', [$rule, $store, 6, 1, 5, $this->category[$category], $this->created_at[$store]]);
                } else {
                    $orders = DB::select('SELECT * FROM orders where store = ? AND verified = ? AND (international_awb is not null AND international_awb !="")  AND actions != ?  AND status < ? AND category =? AND created_at > ? ORDER BY domestic_awb  ASC LIMIT ?, ?;', [$store, 6, 1, 5, $this->category[$category], $this->created_at[$store], $offset, $products_per_page]);
                    $number_of_orders = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM orders where  store = ? AND verified = ? AND (international_awb is not null AND international_awb !="") AND actions != ?  AND status < ? AND category =? AND created_at > ? ORDER BY domestic_awb  ASC', [$store, 6, 1, 5, $this->category[$category], $this->created_at[$store]]);
                }
            }
        }else{
            if ($rule == "Others") {
                $orders = DB::select('SELECT * FROM orders where country not in ("Egypt","Saudi Arabia","Kuwait","Oman","Bahrain","Qatar","Jordan","United Arab Emirates", "Iraq") AND store = ? AND verified = ? AND  (international_awb is not null AND international_awb !="") AND actions != ? AND status < ?  AND created_at > ? ORDER BY domestic_awb  ASC LIMIT ?, ?;', [$store, 6, 1, $this->status['Delivered'], $this->created_at[$store], $offset, $products_per_page]);
                $number_of_orders = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM orders where country not in ("Egypt","Saudi Arabia","Kuwait","Oman","Bahrain","Qatar","Jordan","United Arab Emirates", "Iraq") AND store = ? AND verified = ? AND (international_awb is not null AND international_awb !="") AND actions != ?   AND status < ? AND created_at > ? ORDER BY domestic_awb  ASC', [$store, 6, 1, $this->status['Delivered'],  $this->created_at[$store]]);
            }elseif($rule=='All'){
                if ($store == 'origin') {
                    $orders = DB::select('SELECT * FROM orders where store = ? AND verified = ? AND (international_awb is not null AND international_awb !="") AND actions != ?  AND status < ?  AND created_at > ? ORDER BY domestic_awb  ASC LIMIT ?, ?;', [ $store, 6, 1, 5,  $this->created_at[$store], $offset, $products_per_page]);
                    $number_of_orders = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM orders where store = ? AND verified = ? AND (international_awb is not null AND international_awb !="") AND actions != ?  AND status < ?  AND created_at > ? ORDER BY domestic_awb  ASC', [ $store, 6, 1, 5,  $this->created_at[$store]]);
                } else {
                    $orders = DB::select('SELECT * FROM orders where store = ? AND verified = ? AND (international_awb is not null AND international_awb !="")  AND actions != ?  AND status < ? AND created_at > ? ORDER BY domestic_awb  ASC LIMIT ?, ?;', [$store, 6, 1, 5, $this->created_at[$store], $offset, $products_per_page]);
                    $number_of_orders = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM orders where  store = ? AND verified = ? AND (international_awb is not null AND international_awb !="") AND actions != ?  AND status < ? AND created_at > ? ORDER BY domestic_awb  ASC', [$store, 6, 1, 5,  $this->created_at[$store]]);
                }
            }
            else {
                if ($store == 'origin') {
                    $orders = DB::select('SELECT * FROM orders where country = ? AND store = ? AND verified = ? AND (international_awb is not null AND international_awb !="") AND actions != ?  AND status < ?  AND created_at > ? ORDER BY domestic_awb  ASC LIMIT ?, ?;', [$rule, $store, 6, 1, 5, $this->created_at[$store], $offset, $products_per_page]);
                    $number_of_orders = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM orders where country = ? AND store = ? AND verified = ? AND (international_awb is not null AND international_awb !="") AND actions != ?  AND status < ?  AND created_at > ? ORDER BY domestic_awb  ASC', [$rule, $store, 6, 1, 5,  $this->created_at[$store]]);
                } else {
                    $orders = DB::select('SELECT * FROM orders where store = ? AND verified = ? AND (international_awb is not null AND international_awb !="")  AND actions != ?  AND status < ?  AND created_at > ? ORDER BY domestic_awb  ASC LIMIT ?, ?;', [$store, 6, 1, 5, $this->created_at[$store], $offset, $products_per_page]);
                    $number_of_orders = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM orders where  store = ? AND verified = ? AND (international_awb is not null AND international_awb !="") AND actions != ?  AND status < ?  AND created_at > ? ORDER BY domestic_awb  ASC', [$store, 6, 1, 5,  $this->created_at[$store]]);
                }
            }
        }
        $all_orders_numbers = $this->get_orders_numbers($store);

        return [
            $number_of_orders, $orders, $all_orders_numbers[0], $all_orders_numbers[1],
            $all_orders_numbers[2], $all_orders_numbers[3], $all_orders_numbers[4], $all_orders_numbers[5], $all_orders_numbers[6], $all_orders_numbers[7]
        ];
    }
    
    public function get_archived_orders($store, $rule, $category, $page , $archived)
    {
        $products_per_page = 15;
        $offset = ($page - 1) * $products_per_page;

        if ($archived == 0) {
            if ($store == 'origin') {
                if($rule=="All"){
                    $orders = DB::select('SELECT * FROM kshopina.orders where store = ? AND verified = ? AND (status = ? AND actions = 0 ) AND category =? AND created_at > ? LIMIT ?, ? ;', 
                    [ $store, 6, $this->status['Delivered'], $this->category[$category], $this->created_at[$store] ,$offset, $products_per_page]); 

                    $number_of_orders = DB::select('SELECT COUNT(orders.id) AS NumberOfOrders FROM orders where store = ? AND verified = ? AND (status = ? AND actions = 0 ) AND category =? AND created_at > ?', 
                    [ $store, 6, $this->status['Delivered'], $this->category[$category], $this->created_at[$store] ]); 
                }  
                elseif ($rule != 'Others') {  
                    $orders = DB::select('SELECT * FROM kshopina.orders where  orders.country = ? AND store = ? AND verified = ? AND (status = ? AND actions = 0 ) AND category =? AND created_at > ? LIMIT ?, ? ;', 
                    [$rule, $store, 6, $this->status['Delivered'], $this->category[$category], $this->created_at[$store] ,$offset, $products_per_page]);

                    $number_of_orders = DB::select('SELECT COUNT(orders.id) AS NumberOfOrders FROM orders where  orders.country = ? AND store = ? AND verified = ? AND (status = ? AND actions = 0 ) AND category =? AND created_at > ?', 
                    [$rule, $store, 6, $this->status['Delivered'], $this->category[$category], $this->created_at[$store] ]);
                } else {

                    $orders = DB::select('SELECT * FROM kshopina.orders where country not in ("Egypt","Saudi Arabia","Kuwait","Oman","Bahrain","Qatar","Jordan","United Arab Emirates", "Iraq") AND store = ? AND verified = ? AND (status = ? AND actions = 0 ) AND category =? AND created_at > ? LIMIT ?, ? ;', 
                    [ $store, 6, $this->status['Delivered'], $this->category[$category], $this->created_at[$store] ,$offset, $products_per_page]); 

                    $number_of_orders = DB::select('SELECT COUNT(orders.id) AS NumberOfOrders FROM orders where country not in ("Egypt","Saudi Arabia","Kuwait","Oman","Bahrain","Qatar","Jordan","United Arab Emirates", "Iraq") AND store = ? AND verified = ? AND (status = ? AND actions = 0 ) AND category =? AND created_at > ?', 
                    [ $store, 6, $this->status['Delivered'], $this->category[$category], $this->created_at[$store] ]); 
                }
            } else {
                $orders = DB::select('SELECT * FROM kshopina.orders where store = ? AND verified = ? AND (status = ? AND actions = 0 ) AND category =? AND created_at > ? LIMIT ?, ? ;', 
                [ $store, 6, $this->status['Delivered'], $this->category[$category], $this->created_at[$store] ,$offset, $products_per_page]); 

                $number_of_orders = DB::select('SELECT COUNT(orders.id) AS NumberOfOrders FROM orders where store = ? AND verified = ? AND (status = ? AND actions = 0 ) AND category =? AND created_at > ?', 
                [ $store, 6, $this->status['Delivered'], $this->category[$category], $this->created_at[$store] ]); 
            }
        } elseif ($archived == 1) {
            if ($store == 'origin') {
                if($rule=="All"){
                    $orders = DB::select('SELECT * FROM kshopina.orders where store = ? AND verified =  ? AND status = ? AND actions = 0 AND category = ? AND created_at > ? LIMIT ?, ? ;', 
                    [ $store, 6, $this->status['Refused'], $this->category[$category], $this->created_at[$store], $offset, $products_per_page]); 

                    $number_of_orders = DB::select('SELECT COUNT(orders.id) AS NumberOfOrders FROM orders where store = ? AND verified =  ? AND status = ? AND actions = 0 AND category = ? AND created_at > ?', 
                     [ $store, 6, $this->status['Refused'], $this->category[$category], $this->created_at[$store] ]);
                }
                elseif ($rule != 'Others') {
                    $orders = DB::select('SELECT * FROM kshopina.orders where  orders.country = ? AND store = ? AND verified =  ? AND status = ? AND actions = 0 AND category = ? AND created_at > ? LIMIT ?, ? ;', 
                    [$rule ,$store, 6, $this->status['Refused'], $this->category[$category], $this->created_at[$store], $offset, $products_per_page]);
                    
                    $number_of_orders = DB::select('SELECT COUNT(orders.id) AS NumberOfOrders FROM orders where orders.country = ? AND store = ? AND verified =  ? AND status = ? AND actions = 0 AND category = ? AND created_at > ?', 
                    [$rule ,$store, 6, $this->status['Refused'], $this->category[$category], $this->created_at[$store]]);
                } else {
                    $orders = DB::select('SELECT * FROM kshopina.orders where country not in ("Egypt","Saudi Arabia","Kuwait","Oman","Bahrain","Qatar","Jordan","United Arab Emirates", "Iraq") 
                    AND store = ? AND verified =  ? AND status = ? AND actions = 0 AND category = ? AND created_at > ? LIMIT ?, ? ;', 
                    [ $store, 6, $this->status['Refused'], $this->category[$category], $this->created_at[$store], $offset, $products_per_page]); 

                    $number_of_orders = DB::select('SELECT COUNT(orders.id) AS NumberOfOrders FROM orders where country not in ("Egypt","Saudi Arabia","Kuwait","Oman","Bahrain","Qatar","Jordan","United Arab Emirates" , "Iraq") 
                    AND store = ? AND verified =  ? AND status = ? AND actions = 0 AND category = ? AND created_at > ?', 
                    [ $store, 6, $this->status['Refused'], $this->category[$category], $this->created_at[$store] ]);
                }
            } else {
                $orders = DB::select('SELECT * FROM kshopina.orders where store = ? AND verified =  ? AND status = ? AND actions = 0 AND category = ? AND created_at > ? LIMIT ?, ? ;', 
                    [ $store, 6, $this->status['Refused'], $this->category[$category], $this->created_at[$store], $offset, $products_per_page]); 

                    $number_of_orders = DB::select('SELECT COUNT(orders.id) AS NumberOfOrders FROM orders where store = ? AND verified =  ? AND status = ? AND actions = 0 AND category = ? AND created_at > ?', 
                     [ $store, 6, $this->status['Refused'], $this->category[$category], $this->created_at[$store] ]);
            }
        }else {
            if ($store == 'origin') {
                if($rule=="All"){

                    $orders = DB::select('SELECT *,orders.id as order_id,orders.order_id as shopify_id , fct.updated_at as fct_updated_at FROM orders INNER JOIN fct ON orders.order_number = fct.order_number where 
                    orders.store = ? AND orders.verified = ? AND (orders.status = ? OR orders.actions = 1 ) AND orders.category =?  AND orders.created_at > ? 
                    AND orders.return_to_stock = ? AND fct.last_update = ? LIMIT ?, ? ;', 
                    [ $store, 6, $this->status['Refused'], $this->category[$category], $this->created_at[$store],0, $this->status['Refused'] , $offset, $products_per_page]); 

                    $number_of_orders = DB::select('SELECT COUNT(orders.id) AS NumberOfOrders FROM orders INNER JOIN fct ON orders.order_number = fct.order_number where orders.store = ? AND orders.verified = ? AND (orders.status = ? OR orders.actions = 1) AND orders.category =? AND orders.created_at > ? AND orders.return_to_stock=? AND fct.last_update = ?', 
                    [ $store, 6, $this->status['Refused'], $this->category[$category], $this->created_at[$store],0 , $this->status['Refused'] ]);

                }elseif ($rule != 'Others') {
                    $orders = DB::select('SELECT *,orders.id as order_id,orders.order_id as shopify_id , fct.updated_at as fct_updated_at FROM orders INNER JOIN fct ON orders.order_number = fct.order_number where orders.country = ? AND orders.store = ? AND orders.verified = ? AND (orders.status = ? OR orders.actions = 1) AND orders.category =? AND orders.created_at > ?  AND orders.return_to_stock = ? AND fct.last_update = ? LIMIT ?, ?;', 
                    [$rule, $store, 6, $this->status['Refused'], $this->category[$category], $this->created_at[$store],0,$this->status['Refused'], $offset, $products_per_page ]);
                    //lsa 
                    $number_of_orders = DB::select('SELECT COUNT(orders.id) AS NumberOfOrders FROM orders INNER JOIN fct ON orders.order_number = fct.order_number where orders.country = ? AND orders.store = ? AND orders.verified = ? AND (orders.status = ? OR orders.actions = 1) AND orders.category =? AND orders.created_at > ? AND orders.return_to_stock=? AND fct.last_update = ?', 
                    [$rule, $store, 6, $this->status['Refused'], $this->category[$category], $this->created_at[$store],0 ,$this->status['Refused']]);
                } else {
                    $orders = DB::select('SELECT *,orders.id as order_id,orders.order_id as shopify_id , fct.updated_at as fct_updated_at FROM orders INNER JOIN fct ON orders.order_number = fct.order_number where country not in ("Egypt","Saudi Arabia","Kuwait","Oman","Bahrain","Qatar","Jordan","United Arab Emirates", "Iraq") AND orders.store = ? AND orders.verified = ? AND (orders.status = ? OR orders.actions = 1) AND orders.category =? AND orders.created_at > ? AND orders.return_to_stock=? AND fct.last_update = ? LIMIT ?, ?;', 
                    [ $store, 6, $this->status['Refused'], $this->category[$category], $this->created_at[$store] ,0, $this->status['Refused'] ,$offset, $products_per_page]);

                    $number_of_orders = DB::select('SELECT COUNT(orders.id) AS NumberOfOrders FROM orders INNER JOIN fct ON orders.order_number = fct.order_number where country not in ("Egypt","Saudi Arabia","Kuwait","Oman","Bahrain","Qatar","Jordan","United Arab Emirates", "Iraq") AND orders.store = ? AND orders.verified = ? AND (orders.status > ? OR orders.actions = 1) AND orders.category =? AND orders.created_at > ? AND orders.return_to_stock=? AND fct.last_update = ?', 
                    [ $store, 6, $this->status['Refused'], $this->category[$category], $this->created_at[$store] ,0 ,$this->status['Refused']]);
                }
            } /* else {
                $orders = DB::select('SELECT *,orders.id as order_id,orders.order_id as shopify_id FROM orders INNER JOIN fct ON orders.order_number = fct.order_number where  orders.store = ? AND orders.verified = ? AND (orders.status = ? OR orders.actions = 1) AND orders.category =? AND orders.created_at > ? AND orders.return_to_stock=? AND fct.last_update = ? LIMIT ?, ?;', 
                [$store, 6, $this->status['Refused'], $this->category[$category], $this->created_at[$store] ,0,$this->status['Refused'], $offset, $products_per_page]);
                
                $number_of_orders = DB::select('SELECT COUNT(orders.id) AS NumberOfOrders FROM orders INNER JOIN fct ON orders.order_number = fct.order_number where  orders.store = ? AND orders.verified = ? AND (orders.status = ? OR orders.actions = 1) AND orders.category =? AND orders.created_at > ? AND orders.return_to_stock = ? AND fct.last_update = ?', 
                [$store, 6, $this->status['Refused'], $this->category[$category], $this->created_at[$store] ,0,$this->status['Refused']]);
            } */
        }

        $all_orders_numbers = $this->get_orders_numbers($store);

        return [
            $number_of_orders, $orders, $all_orders_numbers[0], $all_orders_numbers[1],
            $all_orders_numbers[2], $all_orders_numbers[3], $all_orders_numbers[4], $all_orders_numbers[5], $all_orders_numbers[6], $all_orders_numbers[7]
        ];
    }

    public function get_fct_orders($store, $rule, $page)
    {

        $products_per_page = 15;
        $offset = ($page - 1) * $products_per_page;
        if ($rule == 'Others') {
            $orders = DB::select('SELECT orders.international_awb,fct.reschedule_date,orders.order_id,fct.id,orders.country,fct.order_number,orders.phone_number,
            orders.country,orders.domestic_awb,fct.last_status,fct.notes,fct.last_update,fct.created_at FROM fct INNER JOIN orders
            ON fct.order_number = orders.order_number WHERE orders.country not in ("Egypt","Saudi Arabia","Kuwait","Oman","Bahrain","Qatar","Jordan","United Arab Emirates", "Iraq")
            AND fct.source > ? AND orders.store = ? AND (fct.last_update = ? OR fct.last_update = ? OR fct.last_update = ?)  order by fct.notes LIMIT ?, ?;',
            [ 0, $store, 0, $this->status['Delivery'],$this->status['Kshopina_Warehouse'], $offset, $products_per_page]);

            $number_of_orders = DB::select('SELECT COUNT(orders.id) AS NumberOfOrders FROM orders INNER JOIN fct ON fct.order_number = orders.order_number WHERE orders.country not in ("Egypt","Saudi Arabia","Kuwait","Oman","Bahrain","Qatar","Jordan","United Arab Emirates", "Iraq")  AND orders.store = ? AND fct.source > ? AND (fct.last_update = ? OR fct.last_update = ? OR fct.last_update = ?)', [ $store, 0, 0, $this->status['Delivery'],$this->status['Kshopina_Warehouse']]);
        } else {
            if($rule=='All'){
                $orders = DB::select('SELECT orders.international_awb,fct.reschedule_date,orders.order_id, fct.id,orders.country,fct.order_number,orders.phone_number,orders.country,orders.domestic_awb,fct.last_status,fct.notes,fct.last_update,fct.created_at FROM fct INNER JOIN orders ON fct.order_number = orders.order_number WHERE  fct.source > ? AND orders.store = ? AND (fct.last_update = ? OR fct.last_update = ? OR fct.last_update = ?) order by fct.notes LIMIT ?, ?;', [ 0, $store, 0, $this->status['Delivery'],$this->status['Kshopina_Warehouse'], $offset, $products_per_page]);

                $number_of_orders = DB::select('SELECT COUNT(orders.id) AS NumberOfOrders FROM orders INNER JOIN fct ON fct.order_number = orders.order_number WHERE  orders.store = ? AND fct.source > ? AND (fct.last_update = ? OR fct.last_update = ? OR fct.last_update = ?)', [ $store, 0, 0, $this->status['Delivery'],$this->status['Kshopina_Warehouse']]);
    
            }else{
            $orders = DB::select('SELECT orders.international_awb,fct.reschedule_date,orders.order_id, fct.id,orders.country,fct.order_number,orders.phone_number,orders.country,orders.domestic_awb,fct.last_status,fct.notes,fct.last_update,fct.created_at FROM fct INNER JOIN orders ON fct.order_number = orders.order_number WHERE orders.country = ? AND fct.source > ? AND orders.store = ? AND (fct.last_update = ? OR fct.last_update = ? OR fct.last_update = ?) order by  fct.notes LIMIT ?, ?;', [$rule, 0, $store, 0, $this->status['Delivery'],$this->status['Kshopina_Warehouse'], $offset, $products_per_page]);

            $number_of_orders = DB::select('SELECT COUNT(orders.id) AS NumberOfOrders FROM orders INNER JOIN fct ON fct.order_number = orders.order_number WHERE orders.country = ? AND orders.store = ? AND fct.source > ? AND (fct.last_update = ? OR fct.last_update = ? OR fct.last_update = ?)', [$rule, $store, 0, 0, $this->status['Delivery'],$this->status['Kshopina_Warehouse']]);

           }
        }


        $number_of_pending = DB::select('SELECT COUNT(fct.id) AS NumberOfOrders FROM fct INNER JOIN orders ON fct.order_number = orders.order_number where fct.last_update = ? AND fct.source > ?  AND orders.store= ?;', [0, 0, $store]);
        $number_of_delivery = DB::select('SELECT COUNT(fct.id) AS NumberOfOrders FROM fct INNER JOIN orders ON fct.order_number = orders.order_number where fct.last_update = ? AND fct.source > ?  AND orders.store= ?;', [$this->status['Delivery'], 0, $store]);

        $number_of_delivered = DB::select('SELECT COUNT(fct.id) AS NumberOfOrders FROM fct INNER JOIN orders ON fct.order_number = orders.order_number where fct.last_update = ? AND fct.source > ?  AND orders.store= ?;', [$this->status['Delivered'], 0, $store]);
        $number_of_refused = DB::select('SELECT COUNT(fct.id) AS NumberOfOrders FROM fct INNER JOIN orders ON fct.order_number = orders.order_number where fct.last_update = ? AND fct.source > ?  AND orders.store= ?;', [$this->status['Refused'], 0, $store]);

        return [
            $number_of_orders, $orders, $number_of_pending, $number_of_delivery, $number_of_delivered,
            $number_of_refused,
        ];
    }

    public function get_fct_archived_orders($store, $rule, $page)
    {

        $products_per_page = 15;
        $offset = ($page - 1) * $products_per_page;

        $orders = DB::select('SELECT orders.international_awb,orders.order_id,fct.id,orders.country,fct.order_number,orders.phone_number,orders.country,orders.domestic_awb,fct.last_status,fct.notes,fct.last_update,fct.created_at FROM fct INNER JOIN orders ON fct.order_number = orders.order_number WHERE orders.country = ? AND fct.source > ? AND orders.store = ? AND (fct.last_update = ? OR fct.last_update = ?) LIMIT ?, ?;', [$rule, 0, $store, $this->status['Delivered'], $this->status['Refused'], $offset, $products_per_page]);
        $number_of_orders = DB::select('SELECT COUNT(orders.id) AS NumberOfOrders FROM orders INNER JOIN fct ON fct.order_number = orders.order_number WHERE orders.country = ? AND orders.store = ? AND fct.source > ? AND (fct.last_update = ? OR fct.last_update = ? )', [$rule, $store, 0, $this->status['Delivered'], $this->status['Refused']]);

        $number_of_pending = DB::select('SELECT COUNT(fct.id) AS NumberOfOrders FROM fct INNER JOIN orders ON fct.order_number = orders.order_number where fct.last_update = ? AND fct.source > ?  AND orders.store= ?;', [0, 0, $store]);
        $number_of_delivery = DB::select('SELECT COUNT(fct.id) AS NumberOfOrders FROM fct INNER JOIN orders ON fct.order_number = orders.order_number where fct.last_update = ? AND fct.source > ?  AND orders.store= ?;', [$this->status['Delivery'], 0, $store]);

        $number_of_delivered = DB::select('SELECT COUNT(fct.id) AS NumberOfOrders FROM fct INNER JOIN orders ON fct.order_number = orders.order_number where fct.last_update = ? AND fct.source > ?  AND orders.store= ?;', [$this->status['Delivered'], 0, $store]);
        $number_of_refused = DB::select('SELECT COUNT(fct.id) AS NumberOfOrders FROM fct INNER JOIN orders ON fct.order_number = orders.order_number where fct.last_update = ? AND fct.source > ?  AND orders.store= ?;', [$this->status['Refused'], 0, $store]);

        return [
            $number_of_orders, $orders, $number_of_pending, $number_of_delivery, $number_of_delivered,
            $number_of_refused,
        ];
    }

    public function get_all_confirmed_orders($store)
    {

        return DB::select(' SELECT * FROM orders where (international_awb is null OR international_awb = "") AND store = ? AND verified = ? AND created_at > ?', [$store, 6, $this->created_at[$store]]);
    }

    public function get_all_tst_orders($store)
    {

        return DB::select('SELECT * FROM orders where store = ? AND verified = ?  AND ( (international_awb is not null AND international_awb !="") OR (status = ? AND actions = ?)) AND status < ? AND created_at > ?', [$store, 6, 0, 1, 5, $this->created_at[$store]]);
    }

    public function get_all_fct_orders($store)
    {

        return DB::select('SELECT orders.country,fct.order_number,orders.phone_number,orders.domestic_awb,fct.last_status,fct.notes,fct.last_update,fct.created_at FROM fct
        INNER JOIN orders ON fct.order_number = orders.order_number WHERE orders.store = ? AND fct.source > ? AND (fct.last_update = ? OR fct.last_update = ?) ;', [$store, 0, 0, $this->status['Delivery']]);
    }

    public function move_to_on_process($id, $store)
    {
        date_default_timezone_set('Africa/Cairo');
        $date = date('Y-m-d H:i:s', time());

        $this->replace_tag("#Confirmed", "#on_process", $id, $store);

        DB::table('orders')->where("id", $id)->update(['on_process' => 1, 'on_process_at' => $date, 'on_process_by' => Auth::user()->name]);
    }

    public function order_details_shopify($order_id , $store){

        $shopify_token = DB::table('config')->where('keyy', $store)->get()[0]->value;
        $store_myshopify_url = DB::table('config')->where('keyy', $store . '_myshopify')->get()[0]->value;
        $store_url = DB::table('config')->where('keyy', $store . '_url')->get()[0]->value;

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
      
        $URI = $store_url . "/admin/api/2023-04/orders/" . $order_id . ".json?status=any";

        try {
           
            $URI_Response = $client->request('GET', $URI);

            $now = \DateTime::createFromFormat('U.u', microtime(true));
            $date_of_search= $now->format("i:s.u");

            $URI_Response = json_decode($URI_Response->getBody(), true);
            return $URI_Response;

        } catch (\Throwable $th) {
            DB::insert('insert into errors (shipment_number,message) values (?,?)', [ $order_id, $th]);
        }

    }

    public function mark_order_as_fulfilled($id, $store)
    {
        try {
            //code...
        
        $location_array =['origin'=> '16697917528','plus_egypt'=> '65388675257','plus_ksa'=> '64379879580','plus_kuwait'=> '66254045432','plus_uae'=>'81097130268'];
        $shopify_token = DB::table('config')->where('keyy', $store)->get()[0]->value;
        $store_myshopify_url = DB::table('config')->where('keyy', $store . '_myshopify')->get()[0]->value;
      
        $order_data = DB::table('orders')->where('id', $id)->get();

        $verification_model = new \App\Models\Verification();

        $fulfilmentList=$verification_model->get_fulfillment_list($order_data[0]->order_id,$store);

        if (isset($fulfilmentList['fulfillment_orders']) ) {

            foreach ($fulfilmentList['fulfillment_orders'] as $key => $fulfilmentRecord) {

                if ($fulfilmentRecord['status'] == 'open' || $fulfilmentRecord['status']=='on_hold') {

                    if ($fulfilmentRecord['status']=='open') {
                        $fulfilment_id= $fulfilmentRecord['id'];
        
                    }elseif($fulfilmentRecord['status']=='on_hold'){
        
                        $fulfilment_id= $fulfilmentRecord['id'];
                        $verification_model->release_onHold_fulfillment($fulfilment_id,$store,$order_data[0]->order_id);
                    }

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
            
                    $body['query'] = 'mutation fulfillmentCreateV2($fulfillment: FulfillmentV2Input!) {
                        fulfillmentCreateV2(fulfillment: $fulfillment) {
                          fulfillment {
                            id
                            status
                            trackingInfo(first: 10) {
                              company
                              number
                              url
                            }
                          }
                          userErrors {
                            field
                            message
                          }
                        }
                      }';
            
                    $body['variables'] = [
                        "fulfillment" => [
                          "lineItemsByFulfillmentOrder" => [
                            "fulfillmentOrderId"=> "gid://shopify/FulfillmentOrder/".$fulfilment_id
                        ],
                          "trackingInfo" => [
                            "company"=> "KMEX",
                            "number"=> $order_data[0]->kshopina_awb,
                            "url"=> "https://kshopinaexpress.com/tracking/".$order_data[0]->kshopina_awb
                          ],
                        ],
                        'message'=>"Order fulfilled and ready to dispatch"
                      ];
                   
            
                    $body = json_encode($body);
                    try {
                        $URI_Response = $client->request('POST', $URI, ['body' => $body]);
                        $URI_Response = json_decode($URI_Response->getBody(), true);
            
                    } catch (\Throwable $th) {
                        
                        DB::insert('insert into errors (message,shipment_number) values (?,?)', [$th, $id]);
                    }

                    $body = json_decode($body, true );
                }
                
            }
            date_default_timezone_set('Africa/Cairo');
            $date = date('Y-m-d H:i:s', time());
    
            DB::table('orders')->where("id", $id)->update(['fulfillment_status' => "fulfilled", 'fulfilled_at' => $date, 'fulfilled_by' => Auth::user()->name, 'on_process' => 0, 'status' => 1]);

            /* $fulfilmentList_data = $fulfilmentList['fulfillment_orders'][count($fulfilmentList['fulfillment_orders']) - 1]; */

        }

        } catch (\Throwable $th) {
            DB::insert('insert into errors (message,shipment_number) values (?,?)', [$th, $id]);
        }
    }
    
    public function get_fulfillment_id($order_number,$store){

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
        $order = $store_url . "/admin/api/2023-04/orders.json?name=" . $order_number . "&status=any";
        // Open the file using the HTTP headers set above
        $data = file_get_contents($order, false, $context);
        $order = json_decode($data);
        $order = $order->orders;

        foreach ($order as $key => $value) {
            $fulfillemnt = $value->fulfillments;
        }

        return $fulfillemnt;
    }

    public function update_fulfillment_tracking($fulfill_id,$store,$kmex_number,$id){

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

        $URI = $store_myshopify_url . "/admin/api/2023-04/fulfillments/" . $fulfill_id . "/update_tracking.json";


        $body = ["fulfillment" => ["tracking_info" => ["number" => $kmex_number, "url" => 'https://kshopinaexpress.com/' . "tracking/" . $kmex_number
        , "company" => "KMEX"] , "notify_customer" => false]];


        $body = json_encode($body);
        try {
            $URI_Response = $client->request('POST', $URI, ['body' => $body]);
        } catch (\Throwable $th) {
            DB::insert('insert into errors (message,shipment_number) values (?,?)', [$th, $id]);
        }

        date_default_timezone_set('Africa/Cairo');
        $date = date('Y-m-d H:i:s', time());

        DB::table('orders')->where("id", $id)->update(['fulfillment_status' => "fulfilled", 'fulfilled_at' => $date, 'fulfilled_by' => Auth::user()->name]);
    }

    public function return_to_stock($id){

        date_default_timezone_set('Africa/Cairo');
        $date = date('Y-m-d H:i:s', time());
        DB::table('orders')->where("id", $id)->update(['return_to_stock' => 1, 'return_to_stock_at' => $date, 'return_to_stock_by' => Auth::user()->name]);

    }

    public function mark_order_as_paid($order_id,$store)
    {
        try {
            $shopify_token = DB::table('config')->where('keyy', $store)->get()[0]->value;
            $store_myshopify_url = DB::table('config')->where('keyy', $store . '_myshopify')->get()[0]->value;
            

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

            $body['query'] = 'mutation orderMarkAsPaid($input: OrderMarkAsPaidInput!) {
                orderMarkAsPaid(input: $input) {
                    order {
                    id
                    }
                    userErrors {
                    field
                    message
                    }
                }
                }';

            $body['variables'] = array(
                "input" => ["id" => "gid://shopify/Order/" . $order_id]

            );


            $body = json_encode($body);
            $URI_Response = $client->request('POST', $URI, ['body' => $body]);
            $URI_Response = json_decode($URI_Response->getBody(), true);

            if ($store=='origin') {
                DB::table('shopify_orders')->where(['order_id'=> $order_id])->update(
                    ['status' => "confirmed", 'financial_status' => "paid"]);
            }
            
        } catch (\Throwable $th) {
            try {
                DB::insert('insert into errors (shipment_number,message) values (?,?)', [$order_id, $th]);
            } catch (\Throwable $th) {
                DB::insert('insert into errors (shipment_number,message) values (?,?)', [$order_id, 'TST mark as paid']);
            }
        }
        

    }

    public function replace_tag($old_tag, $new_tag, $order_id, $store)
    {
        
        $store_url = DB::table('config')->where('keyy', $store . '_url')->get()[0]->value;
        $shopify_token = DB::table('config')->where('keyy', $store)->get()[0]->value;
        $store_myshopify_url = DB::table('config')->where('keyy', $store . '_myshopify')->get()[0]->value;

        $order_all_data = DB::select('select * from orders where id = ?', [$order_id]);

        foreach ($order_all_data as $order_data) {
           
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
            $order = $store_url . "/admin/api/2023-04/orders.json?name=" . $order_data->order_number . "&status=any";
            // Open the file using the HTTP headers set above
            $data = file_get_contents($order, false, $context);
            $order = json_decode($data);
            $order = $order->orders;

            foreach ($order as $key => $value) {
                $tags = $value->tags;
            }
            $tags = str_replace($old_tag, "", $tags);

            $tags = $tags . "," . $new_tag;

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

            $URI = $store_myshopify_url . '/admin/api/2023-04/orders/' . $order_data->order_id . '.json';

            $body = ["order" => ['id' => $order_data->order_id, 'tags' => $tags]];

            $body = json_encode($body);
            $URI_Response = $client->request('PUT', $URI, ['body' => $body]);
        }

    }

    public function export($mode, $store)
    {
        $confirmed_titles = ['A' => 'Order Number', 'B' => 'Dollar', 'C' => 'Currency', 'D' => 'AWB', 'E' => 'Last Action', 'F' => 'status', 'G' => 'KMEX.no', 'H' => 'KMEX tracking URL'];
        $tst_titles = ['A' => 'Order Number', 'B' => 'Dollar', 'C' => 'Currency', 'D' => 'AWB', 'E' => 'LWB', 'F' => 'Company', 'G' => 'KWB', 'H' => 'URL', 'I' => 'Status', 'J' => 'Last Action'];
        $tst_titles_plusmodels = ['A' => 'Order Number', 'B' => 'Price', 'C' => 'HAWB', 'D' => 'Company', 'E' => 'KWB', 'F' => 'URL', 'G' => 'Status', 'H' => 'Last Action'];
        $status = ['Verified', 'Fulfilled', 'Dispatched', 'In Warehouse', 'Out for delivery', 'Delivered', 'Refused', 'Canceled'];

        $titles = [];
        if ($mode == 'confirmed') {
            $orders =  $this->get_all_confirmed_orders($store);
            $titles = $confirmed_titles;
        } elseif ($mode == 'tst'  && $store == 'origin') {
            $orders = $this->get_all_tst_orders($store);
            $titles = $tst_titles;
        } elseif ($mode == 'tst'  && $store != 'origin') {
            $orders = $this->get_all_tst_orders($store);
            $titles = $tst_titles_plusmodels;
        }


        $arr2 = ['', 'Egypt', 'Kuwait', 'Saudi Arabia', 'Bahrain', 'Oman', 'Jordan', 'Qatar', 'United Arab Emirates', "Iraq", 'Others'];
        $countries = ['Egypt', 'Kuwait', 'Saudi Arabia', 'Bahrain', 'Oman', 'Jordan', 'Qatar', 'United Arab Emirates', "Iraq"];
        $check = 0;

        $spreadsheet1 = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $numoforders = count($orders);
        $row_1 = 2;


        if ($store == 'origin') {
            // bta3 alsheets
            $arr = [];
            $arr[''] = 0;
            $arr['Egypt'] = 1;
            $arr['Kuwait'] = 2;
            $arr['Saudi Arabia'] = 3;
            $arr['Bahrain'] = 4;
            $arr['Oman'] = 5;
            $arr['Jordan'] = 6;
            $arr['Qatar'] = 7;
            $arr['United Arab Emirates'] = 8;
            $arr['Iraq'] = 9;
            $arr['Others'] = 10;
            
            $arr0 = [];
            $arr0['Egypt'] = 2;
            $arr0['Kuwait'] = 2;
            $arr0['Saudi Arabia'] = 2;
            $arr0['Bahrain'] = 2;
            $arr0['Oman'] = 2;
            $arr0['Jordan'] = 2;
            $arr0['Qatar'] = 2;
            $arr0['United Arab Emirates'] = 2;
            $arr0['Iraq'] = 2;
            $arr0['Others'] = 2;

            $spreadsheet1->getActiveSheet()->setTitle('All');
            $spreadsheet1->createSheet()->setTitle('Egypt');
            $spreadsheet1->createSheet()->setTitle('Kuwait');
            $spreadsheet1->createSheet()->setTitle('KSA');
            $spreadsheet1->createSheet()->setTitle('Bahrin');
            $spreadsheet1->createSheet()->setTitle('Oman');
            $spreadsheet1->createSheet()->setTitle('Jordan');
            $spreadsheet1->createSheet()->setTitle('Qatar');
            $spreadsheet1->createSheet()->setTitle('UAE');
            $spreadsheet1->createSheet()->setTitle('Iraq');
            $spreadsheet1->createSheet()->setTitle('Others');
            //titles
            for ($b = 0; $b < count($arr2); $b++) {
                foreach ($titles as $key => $value) {
                    $spreadsheet1->getSheet($b)->setCellValue($key . '1', $value);
                }
            }
        } else {
            $spreadsheet1->getActiveSheet()->setTitle($store);
            foreach ($titles as $key => $value) {
                $spreadsheet1->getActiveSheet()->setCellValue($key . '1', $value);
            }
        }


        //values

        for ($row = 0; $row < $numoforders; $row++) {

            if ($mode == 'confirmed') {
                $data[0] = $orders[$row]->order_number;
                $data[1] = $orders[$row]->total_price;
                $data[2] = $orders[$row]->currency;
                $data[3] = $orders[$row]->international_awb;
                $data[4] = $orders[$row]->last_action;


                if ($orders[$row]->on_process == 0) {
                    if ($orders[$row]->status == 1) {
                        $data[5] = 'Fulfilled';
                    } else {
                        $data[5] = 'Verified';
                    }
                } else {
                    $data[5] = 'on_process';
                }


                if ($orders[$row]->kshopina_awb != NULL) {
                    $data[6] = $orders[$row]->kshopina_awb;
                    $data[7] = 'https://kshopinaexpress.com/' . $orders[$row]->tracking_url;
                } else {
                    $data[6] = 'none';
                    $data[7] = 'none';
                }
            } else {
                if ($store == 'origin') {
                    $data[0] = $orders[$row]->order_number;
                    $data[1] = $orders[$row]->total_price;
                    $data[2] = $orders[$row]->currency;
                    $data[3] = $orders[$row]->international_awb;
                    $data[4] = $orders[$row]->domestic_awb;
                    $data[5] = $orders[$row]->domestic_company;
                    $data[6] = $orders[$row]->kshopina_awb;
                    $data[7] = url('') . '/' . $orders[$row]->tracking_url;

                    if ($orders[$row]->actions == 1) {

                        $data[8] = $status[7];
                    } else {
                        $data[8] = $status[$orders[$row]->status];
                    }

                    $data[9] = $orders[$row]->last_action;
                } else {

                    $data[0] = $orders[$row]->order_number;
                    $data[1] = $orders[$row]->total_price;
                    $data[2] = $orders[$row]->international_awb;
                    $data[3] = $orders[$row]->domestic_company;
                    $data[4] = $orders[$row]->kshopina_awb;
                    $data[5] = url('') . '/' . $orders[$row]->tracking_url;

                    if ($orders[$row]->actions == 1) {

                        $data[6] = $status[7];
                    } else {
                        $data[6] = $status[$orders[$row]->status];
                    }

                    $data[7] = $orders[$row]->last_action;
                }
            }

            $col = array_keys($titles);


            if ($store == 'origin') {
                if (!in_array($orders[$row]->country, $countries, true)) {
                    $orders[$row]->country = 'Others';
                }

                for ($i = 0; $i < count($data); $i++) {

                    try {

                        //country
                        $spreadsheet1->getSheet($arr[$orders[$row]->country])->setCellValue($col[$i] . $arr0[$orders[$row]->country], $data[$i]);
                        //All
                        $spreadsheet1->getActiveSheet()->setCellValue($col[$i] . $row_1, $data[$i]);
                        $check = 0;
                    } catch (\Throwable $th) {
                        //All
                        $spreadsheet1->getActiveSheet()->setCellValue($col[$i] . $row_1, $data[$i]);
                        $check = 1;
                    }
                }


                if ($check == 0) {
                    $arr0[$orders[$row]->country] = $arr0[$orders[$row]->country] + 1;
                }
            } else {
                for ($i = 0; $i < count($data); $i++) {
                    $spreadsheet1->getActiveSheet()->setCellValue($col[$i] . $row_1, $data[$i]);
                }
            }

            $row_1++;
        }

        $name = date('Y-m-d--h-i-sa');
        $writer = new Xlsx($spreadsheet1);

        if (!file_exists(public_path('uploads/' . $mode))) {
            mkdir(public_path('uploads/' . $mode), 0777, true);
        }

        $writer->save(public_path('/uploads' . '/' . $mode . '/file' . $name . '.xlsx'));
        unset($reader);

        return $name;
    }

    public function get_orders_from_database_search_archived($store, $rule, $page, $order_number, $category)
    {
        
        $products_per_page = 15;
        $offset = ($page - 1) * $products_per_page;
        if ($rule != 'Others') {
            $orders = DB::select('SELECT *,orders.id as order_id,orders.order_id as shopify_id , fct.updated_at as fct_updated_at  , orders.order_number as order_number FROM orders left JOIN fct ON orders.order_number = fct.order_number 
            where   orders.order_number = ? and orders.country = ? AND orders.store = ? AND orders.verified = ? 
             AND ( (orders.status = ? OR  orders.status = ? ) AND orders.actions = 0) AND orders.category = ? AND orders.created_at > ?  LIMIT ?, ?',
             [$order_number , $rule , $store  , 6 , $this->status['Refused'], $this->status['Delivered'] , $this->category[$category] , $this->created_at[$store] , $offset, $products_per_page ]);
              
            $number_of_orders = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM orders where country = ? AND store = ? AND verified = ? AND order_number =? AND ( (international_awb is not null AND international_awb !="") OR (status = ? AND actions = ?)) AND status <= ?  AND created_at >?', [$rule, $store, 6, $order_number, 0, 1, 6, $this->created_at[$store]]);
        } else {
            $orders = DB::select('SELECT *,orders.id as order_id,orders.order_id as shopify_id , fct.updated_at as fct_updated_at  , orders.order_number as order_number FROM orders left JOIN fct ON orders.order_number = fct.order_number 
            where   orders.order_number = ? and orders.country not in ("Egypt","Saudi Arabia","Kuwait","Oman","Bahrain","Qatar","Jordan","United Arab Emirates", "Iraq")  AND orders.store = ? AND orders.verified = ? 
             AND ( (orders.status = ? OR  orders.status = ? ) AND orders.actions = 0) AND orders.category = ? AND orders.created_at > ? LIMIT ?, ?',
            [$order_number , $store  , 6 , $this->status['Refused'], $this->status['Delivered'] , $this->category[$category] , $this->created_at[$store] , $offset, $products_per_page ]);

            $number_of_orders = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM orders where  store = ? AND verified = ? AND order_number =? AND ( (international_awb is not null AND international_awb !="") OR (status = ? AND actions = ?)) AND status <= ?  AND created_at > ?', [$store, 6, $order_number, 0, 1, 6, $this->created_at[$store]]);
        }
        $all_orders_numbers = $this->get_orders_numbers($store);
        return [
            $number_of_orders, $orders, $all_orders_numbers[0], $all_orders_numbers[1],
            $all_orders_numbers[2], $all_orders_numbers[3], $all_orders_numbers[4], $all_orders_numbers[5], $all_orders_numbers[6], $all_orders_numbers[7]
        ];

    }

    public function export_archived($from ,$to, $store ,$archived)
    {

        $category = [0=> 'normal' , 1 => 'pre order', 2 => 'paid'];
        $orgin_titles = ['A' => 'Order Number', 'B' => 'Dollar', 'C' => 'Currency', 'D' => 'KMEX.NO', 'E'=>'KMEX Url','F' => 'MAWB', 'G' => 'HAWB','H'=>'Company','I'=>'Status','J'=>'Category'];
        $plus_models_titles = ['A' => 'Order Number', 'B' => 'Total price', 'C' => 'KMEX.NO', 'D'=>'KMEX Url', 'E' => 'HAWB','F'=>'Company','G'=>'Status','H'=>'Category'];
        $status = ['Verified', 'Fulfilled', 'Dispatched', 'In Warehouse', 'Out for delivery', 'Delivered', 'Refused', 'Canceled'];

        if($store == 'origin'){
            $titles=  $orgin_titles;
        }else{
            $titles=  $plus_models_titles;
        }
        date_default_timezone_set('Africa/Cairo');
        $date = date('Y-m-d--h-i-sa');


        $orders= $this->export_archived_orders_filter($from ,$to,$store,$archived);

        $arr2 = ['', 'Egypt', 'Kuwait', 'Saudi Arabia', 'Bahrain', 'Oman', 'Jordan', 'Qatar', 'United Arab Emirates', "Iraq", 'Others'];
        $countries= ['Egypt', 'Kuwait', 'Saudi Arabia', 'Bahrain', 'Oman', 'Jordan', 'Qatar', 'United Arab Emirates', "Iraq"];
        $check = 0;

        $spreadsheet1 = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $numoforders = count($orders);
        $row_1 = 2;


        if ($store == 'origin') {
            // bta3 alsheets
                $arr = [];
                $arr[''] = 0;
                $arr['Egypt'] = 1;
                $arr['Kuwait'] = 2;
                $arr['Saudi Arabia'] = 3;
                $arr['Bahrain'] = 4;
                $arr['Oman'] = 5;
                $arr['Jordan'] = 6;
                $arr['Qatar'] = 7;
                $arr['United Arab Emirates'] = 8;
                $arr['Iraq'] = 9;
                $arr['Others'] = 10;
                
                $arr0 = [];
                $arr0['Egypt'] = 2;
                $arr0['Kuwait'] = 2;
                $arr0['Saudi Arabia'] = 2;
                $arr0['Bahrain'] = 2;
                $arr0['Oman'] = 2;
                $arr0['Jordan'] = 2;
                $arr0['Qatar'] = 2;
                $arr0['United Arab Emirates'] = 2;
                $arr0['Iraq'] = 2;
                $arr0['Others'] = 2;
                
                $spreadsheet1->getActiveSheet()->setTitle('All');
                $spreadsheet1->createSheet()->setTitle('Egypt');
                $spreadsheet1->createSheet()->setTitle('Kuwait');
                $spreadsheet1->createSheet()->setTitle('KSA');
                $spreadsheet1->createSheet()->setTitle('Bahrin');
                $spreadsheet1->createSheet()->setTitle('Oman');
                $spreadsheet1->createSheet()->setTitle('Jordan');
                $spreadsheet1->createSheet()->setTitle('Qatar');
                $spreadsheet1->createSheet()->setTitle('UAE');
                $spreadsheet1->createSheet()->setTitle('Iraq');
                $spreadsheet1->createSheet()->setTitle('Others');
            //titles
                for ($b = 0; $b < count($arr2); $b++) {
                    foreach ($titles as $key => $value) {
                        $spreadsheet1->getSheet($b)->setCellValue($key . '1', $value);
                    }
                }

        }else{
            $spreadsheet1->getActiveSheet()->setTitle($store);
            foreach ($titles as $key => $value) {
                $spreadsheet1->getActiveSheet()->setCellValue($key . '1', $value);
            }
        }


        //values

        for ($row = 0; $row < $numoforders; $row++) {

            if ($store == 'origin') {
                $data[0] = $orders[$row]->order_number;
                $data[1] = $orders[$row]->total_price;
                $data[2] = $orders[$row]->currency;
                $data[3] = $orders[$row]->kshopina_awb;
                $data[4] = url('') . '/' . $orders[$row]->tracking_url;
                $data[5] = $orders[$row]->international_awb;
                $data[6] = $orders[$row]->domestic_awb;
                $data[7] = $orders[$row]->domestic_company;
                $data[8] = $status[$orders[$row]->status];
                $data[9] = $category[$orders[$row]->category];


            } else {
                $data[0] = $orders[$row]->order_number;
                $data[1] = $orders[$row]->total_price;
                $data[2] = $orders[$row]->kshopina_awb;
                $data[3] = url('') . '/' . $orders[$row]->tracking_url;
                $data[4] = $orders[$row]->international_awb;
                $data[5] = $orders[$row]->domestic_company;
                $data[6] = $orders[$row]->status;
                $data[7] = $orders[$row]->category;
            }

            $col = array_keys($titles);


            if ($store == 'origin') {
                if (!in_array($orders[$row]->country ,$countries , true) ) {
                    $orders[$row]->country ='Others';
                }

                for ($i = 0; $i < count($data); $i++) {

                    try {

                        //country
                        $spreadsheet1->getSheet($arr[$orders[$row]->country])->setCellValue($col[$i] . $arr0[$orders[$row]->country], $data[$i]);
                        //All
                        $spreadsheet1->getActiveSheet()->setCellValue($col[$i] . $row_1, $data[$i]);
                        $check = 0;
                    } catch (\Throwable $th) {
                        //All
                        $spreadsheet1->getActiveSheet()->setCellValue($col[$i] . $row_1, $data[$i]);
                        $check = 1;
                    }
                }


                if ($check == 0) {
                    $arr0[$orders[$row]->country] = $arr0[$orders[$row]->country] + 1;
                }

            } else {
                for ($i = 0; $i < count($data); $i++) {
                    $spreadsheet1->getActiveSheet()->setCellValue($col[$i] . $row_1, $data[$i]);
                }
            }

            $row_1++;
        }

        $name = date('Y-m-d--h-i-sa');
        $writer = new Xlsx($spreadsheet1);

        if (!file_exists(public_path('uploads/archived'))) {
            mkdir(public_path('uploads/archived'), 0777, true);
        }

        $writer->save(public_path('/uploads' . '/archived/file' . $name . '.xlsx'));
        unset($reader);

        $path='uploads' . '/archived/file' . $name . '.xlsx';

        return $path;
    }

    public function export_archived_orders_filter($from ,$to,$store, $archived)
    {

        if ($archived == 0) {

            $orders = DB::select('SELECT * FROM orders where  store = ? AND verified = ? AND (status = ? OR actions = 1)  AND delivered_at BETWEEN ? AND ? ;', [ $store, 6, $this->status['Delivered'] ,$from ,$to]);

        } elseif ($archived == 1) {

            $orders = DB::select('SELECT * FROM orders where  store = ? AND verified = ? AND (status = ? OR actions = 1) AND delivered_at BETWEEN ? AND ? ;', [ $store, 6, $this->status['Refused'] ,$from ,$to ]);

        }else{

            $orders = DB::select('SELECT *,orders.id as order_id FROM orders INNER JOIN fct ON orders.order_number = fct.order_number where 
            orders.store = ? AND orders.verified = ? AND (orders.status = ? OR orders.actions = 1 )  AND orders.created_at > ? 
            AND fct.last_update = ? AND orders.delivered_at BETWEEN ? AND ?  AND return_to_stock=? ;',
             [ $store, 6, $this->status['Refused'],$this->created_at[$store] , $this->status['Refused'] ,$from ,$to ,0]);

             

        }

        return  $orders;
    }

    public function export_with_filters($filters)
    {

        $templates = ['Saudi Arabia' => 'KMEX_GLT.xlsx', 'Kuwait' => 'KMEX_OCS.xlsx'];
        $category = ["normal" => 0, "pre order" => 1, "paid" => 2];
        $category_array = [0 => "normal" ,  1 => "pre order" , 2 => "paid"];

        $coutries_shortcuts = [
            'All' => 'All' ,
            'Egypt' => 'EGY',
            'Kuwait' => 'KW',
            'Saudi Arabia' => 'KSA',
            'Bahrain' => 'BH',
            'Oman' => 'OM',
            'Jordan' => 'JO',
            'Qatar' => 'QA',
            'United Arab Emirates' => 'UAE',
            "Iraq"=> 'IRQ',
            'Others' => 'Others'
        ];
        $sku_titles = ['A' => 'Order Ref.', 'B' => 'Total price', 'C' => 'Created at', 'D' => 'Product Name', 'E' => 'Quantity', 'F' => 'SKU' , 'G' => 'Category' ];


        date_default_timezone_set('Africa/Cairo');
        $date = date('Y-m-d--h-i-sa');

        if ($filters[3] == "verified") {

            $data_names = ['store' => $filters[0], 'filter' => $filters[1],  'category' => $filters[2], 'route_name' => $filters[3], 'template' => $filters[4], 'add_on_process' => $filters[5]];
        } else {

            $data_names = ['store' => $filters[0], 'filter' => $filters[1],  'category' => $filters[2], 'route_name' => $filters[3], 'template' => $filters[4]];
        }



        if ($data_names['template'] == "kmex_temp") {

            if ($data_names['filter'] == "Saudi Arabia") {

                $original_template = $templates[$data_names['filter']];
            } else if ($data_names['filter'] == "Kuwait") {

                $original_template = $templates[$data_names['filter']];
            } else {

                $original_template = 'KMEX_standard.xlsx';
            }
            

            if ($data_names['route_name'] == 'verified') {

                if (!file_exists(public_path("uploads/export/export_verified/" . $coutries_shortcuts[$data_names['filter']]))) {
                    mkdir(public_path("uploads/export/export_verified/" . $coutries_shortcuts[$data_names['filter']]), 0777, true);
                }

                $coppy_template = "uploads/export/export_verified/" . $coutries_shortcuts[$data_names['filter']] . "/V_" .  $coutries_shortcuts[$data_names['filter']] . $date . ".xlsx";

                $name = "V_" .  $coutries_shortcuts[$data_names['filter']] . $date . ".xlsx";

                $data = $this->get_all_verified_orders_with_filters($data_names['store'], $data_names['filter'], $data_names['category']);

            } else if($data_names['route_name'] == 'tst') {

                if (!file_exists(public_path( "uploads/export/export_tst/" . $coutries_shortcuts[$data_names['filter']]))) {
                    mkdir(public_path( "uploads/export/export_tst/" . $coutries_shortcuts[$data_names['filter']]), 0777, true);
                }

                $coppy_template = "uploads/export/export_tst/" . $coutries_shortcuts[$data_names['filter']] . "/T_" .  $coutries_shortcuts[$data_names['filter']] . $date . ".xlsx";
                $name = "T_" .  $coutries_shortcuts[$data_names['filter']] . $date . ".xlsx";
                $data =  $this->get_all_tst_orders_with_filters($data_names['store'], $data_names['filter'], $data_names['category']);

            }else if($data_names['route_name'] == 'on_process') {

                if (!file_exists(public_path( "uploads/export/export_on_process/" . $coutries_shortcuts[$data_names['filter']]))) {
                    mkdir(public_path( "uploads/export/export_on_process/" . $coutries_shortcuts[$data_names['filter']]), 0777, true);
                }

                $coppy_template = "uploads/export/export_on_process/" . $coutries_shortcuts[$data_names['filter']] . "/on_process_" .  $coutries_shortcuts[$data_names['filter']] . $date . ".xlsx";
                $name = "T_" .  $coutries_shortcuts[$data_names['filter']] . $date . ".xlsx";
                $data =  $this->get_all_on_process_orders_with_filters($data_names['store'], $data_names['filter'], $data_names['category']);

            }

            File::copy(public_path($original_template), public_path($coppy_template));

            $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
            $spreadsheet =  $reader->load(public_path($coppy_template));
            $worksheet = $spreadsheet->getActiveSheet();

            $numoforders = count($data);

            for ($row = 0; $row < $numoforders; $row++) {
                $row_number = $row + 2;
                $worksheet->setCellValue('A' . $row_number,  $data[$row]->kshopina_awb);

                $worksheet->setCellValue('B' . $row_number,  $data[$row]->international_awb);
                $worksheet->setCellValue('C' . $row_number,  $data[$row]->domestic_company);
                $worksheet->setCellValue('D' . $row_number,  $data[$row]->domestic_awb);                
                
                
                
                $worksheet->setCellValue('E' . $row_number,  $data[$row]->order_number);
                $worksheet->setCellValue('F' . $row_number,  $data[$row]->name);
                $worksheet->setCellValue('G' . $row_number,  $data[$row]->phone_number);
                if ($data[$row]->gateway == 'COD') {
                    $payment_type = 'COD';
                    $cod_amount = '';
                } else {
                    $payment_type = 'CC';
                    $cod_amount = 0;
                }
                $worksheet->setCellValue('O' . $row_number,  $payment_type);
                $worksheet->setCellValue('P' . $row_number,   $cod_amount);

                if ($data_names['route_name'] == 'verified' && $data_names['add_on_process'] == 1) {
                    $this->move_to_on_process($data[$row]->id, $data[$row]->store);
                }
            }


            $writer = new Xlsx($spreadsheet);
           

            $writer->save(public_path($coppy_template));

            unset($reader);

            return  $coppy_template;
        } else if ($data_names['template'] == "sku_temp") {

            if ($data_names['route_name'] == 'verified') {
                if (!file_exists(public_path( "uploads/export_SKU/export_verified/" . $coutries_shortcuts[$data_names['filter']] ))) {
                    mkdir(public_path( "uploads/export_SKU/export_verified/" . $coutries_shortcuts[$data_names['filter']]  ), 0777, true);
                }

                $coppy_template = "uploads/export_SKU/export_verified/" . $coutries_shortcuts[$data_names['filter']] . "/V_SKU_" .  $coutries_shortcuts[$data_names['filter']] . $date . ".xlsx";

                $name = "V_SKU_" .  $coutries_shortcuts[$data_names['filter']] . $date . ".xlsx";

                $data =  $this->export_with_verified_SKUs($data_names['store'], $data_names['filter'],$data_names['category']);
            } else if($data_names['route_name'] == 'tst') {

                if (!file_exists(public_path( "uploads/export_SKU/export_tst/" . $coutries_shortcuts[$data_names['filter']] ))) {
                    mkdir(public_path( "uploads/export_SKU/export_tst/" . $coutries_shortcuts[$data_names['filter']]  ), 0777, true);
                }
                $coppy_template = "uploads/export_SKU/export_tst/" . $coutries_shortcuts[$data_names['filter']] . "/T_SKU_" .  $coutries_shortcuts[$data_names['filter']] . $date . ".xlsx";
                
                $name = "T_SKU_" .  $coutries_shortcuts[$data_names['filter']] . $date . ".xlsx";

                $data =  $this->export_with_tst_SKUs($data_names['store'], $data_names['filter'], $data_names['category']);

            }else if($data_names['route_name'] == 'on_process') {

                if (!file_exists(public_path( "uploads/export_SKU/export_on_process/" . $coutries_shortcuts[$data_names['filter']] ))) {
                    mkdir(public_path( "uploads/export_SKU/export_on_process/" . $coutries_shortcuts[$data_names['filter']]  ), 0777, true);
                }
                $coppy_template = "uploads/export_SKU/export_on_process/" . $coutries_shortcuts[$data_names['filter']] . "/on_process_SKU_" .  $coutries_shortcuts[$data_names['filter']] . $date . ".xlsx";
                
                $name = "T_SKU_" .  $coutries_shortcuts[$data_names['filter']] . $date . ".xlsx";

                $data =  $this->export_with_on_process_SKUs($data_names['store'], $data_names['filter'], $data_names['category']);

            }

            $spreadsheet1 = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
            $worksheet1 = $spreadsheet1->getActiveSheet();
            $spreadsheet1->getActiveSheet()->setTitle($data_names['filter']);
            $numoforders = count($data);


            foreach ($sku_titles as $key => $value) {
                $spreadsheet1->getActiveSheet()->setCellValue($key . '1', $value);
            }

            $order_number_check = NULL;

            for ($row = 0; $row < $numoforders; $row++) {
                $row_number = $row + 2;


                if ($data[$row]->order_number !=   $order_number_check) {
                    $worksheet1->setCellValue('A' . $row_number,  $data[$row]->order_number);
                    $worksheet1->setCellValue('B' . $row_number,  $data[$row]->total_price);
                    $worksheet1->setCellValue('C' . $row_number,  $data[$row]->created_at);
                    $worksheet1->setCellValue('D' . $row_number,  $data[$row]->product_name);
                    $worksheet1->setCellValue('E' . $row_number,  $data[$row]->quantity);
                    $worksheet1->setCellValue('F' . $row_number,  $data[$row]->sku);
                    $worksheet1->setCellValue('G' . $row_number,  $category_array[$data[$row]->category]);
                } else {
                    $worksheet1->setCellValue('A' . $row_number,  $data[$row]->order_number);
                    $worksheet1->setCellValue('D' . $row_number,  $data[$row]->product_name);
                    $worksheet1->setCellValue('E' . $row_number,  $data[$row]->quantity);
                    $worksheet1->setCellValue('F' . $row_number,  $data[$row]->sku);
                    $worksheet1->setCellValue('G' . $row_number,  $category_array[$data[$row]->category]);
                }



                $order_number_check =  $data[$row]->order_number;
            }


            $writer = new Xlsx($spreadsheet1);

           

            $writer->save(public_path($coppy_template));

            unset($reader);
            return  $coppy_template;
        }
    }

    public function export_with_on_process_SKUs($store, $filter, $category){

        $category_array = ["normal" => 0, "pre order" => 1, "paid" => 2];

        if ($filter == 'All') {

            if ($category == 'all' ) {
                return   DB::select('SELECT orders.order_number , orders.category , orders.country , orders.total_price , orders.created_at , items.product_name , items.quantity , items.sku  FROM items INNER JOIN orders ON items.order_id = orders.order_number 
                  where (orders.international_awb is null OR orders.international_awb = "") AND  orders.store = ? AND orders.verified = ? AND orders.on_process = ? AND 
                  orders.actions = ?  AND orders.created_at > ? ORDER BY orders.release_date'
                 , [ $store, 6, 1, 0, $this->created_at[$store]]);
    
            } else {
                return   DB::select('SELECT orders.order_number , orders.category , orders.country , orders.total_price , orders.created_at , items.product_name , items.quantity , items.sku  FROM items INNER JOIN orders ON items.order_id = orders.order_number 
                 where (orders.international_awb is null OR orders.international_awb = "") AND  orders.store = ? AND orders.verified = ? AND orders.on_process = ? AND 
                  orders.actions = ? AND orders.category =? AND orders.created_at > ? ORDER BY orders.release_date '
                 , [  $store, 6, 1, 0,$category_array[$category], $this->created_at[$store]]);
    
            }

        } else if($filter == 'Others') {

            if ($category == 'all' ) {
                return   DB::select('SELECT orders.order_number , orders.category , orders.country , orders.total_price , orders.created_at , items.product_name , items.quantity , items.sku  FROM items INNER JOIN orders ON items.order_id = orders.order_number 
                 where (orders.international_awb is null OR orders.international_awb = "") AND  orders.store = ? AND orders.verified = ? AND orders.on_process = ? AND 
                  orders.actions = ?  AND orders.created_at > ? AND orders.country not in ("Egypt","Saudi Arabia","Kuwait","Oman","Bahrain","Qatar","Jordan","United Arab Emirates", "Iraq") ORDER BY orders.release_date'
                 , [ $store, 6, 1, 0, $this->created_at[$store]]);
    
            } else {
                return   DB::select('SELECT orders.order_number , orders.category , orders.country , orders.total_price , orders.created_at , items.product_name , items.quantity , items.sku  FROM items INNER JOIN orders ON items.order_id = orders.order_number 
                 where (orders.international_awb is null OR orders.international_awb = "") AND  orders.store = ? AND orders.verified = ? AND orders.on_process = ? AND 
                  orders.actions = ?  AND orders.category =?  AND orders.created_at > ? 
                  AND orders.country not in ("Egypt","Saudi Arabia","Kuwait","Oman","Bahrain","Qatar","Jordan","United Arab Emirates", "Iraq") ORDER BY orders.release_date'
                 , [  $store, 6, 1, 0, $category_array[$category], $this->created_at[$store]]);
    
            }

        }else{

            if ($category == 'all' ) {
                return   DB::select('SELECT orders.order_number , orders.category , orders.country , orders.total_price , orders.created_at , items.product_name , items.quantity , items.sku  FROM items INNER JOIN orders ON items.order_id = orders.order_number 
                 where (orders.international_awb is null OR orders.international_awb = "") AND  orders.store = ? AND orders.verified = ? AND orders.on_process = ? AND 
                  orders.actions = ?  AND orders.country =?   AND orders.created_at > ? ORDER BY orders.release_date '
                 , [  $store, 6, 1, 0 ,$filter , $this->created_at[$store]]);
    
            } else {
                return   DB::select('SELECT orders.order_number , orders.category , orders.country ,  orders.total_price , orders.created_at , items.product_name , items.quantity , items.sku  FROM items INNER JOIN orders ON items.order_id = orders.order_number 
                 where (orders.international_awb is null OR orders.international_awb = "") AND  orders.store = ? AND orders.verified = ? AND orders.on_process = ? AND 
                  orders.actions = ? AND orders.category =? AND orders.country =?   AND orders.created_at > ? ORDER BY orders.release_date '
                 , [  $store, 6, 1, 0,$category_array[$category],$filter , $this->created_at[$store]]);
    
            }

        }
    }

    public function get_all_on_process_orders_with_filters($store, $filter, $category){

        $category_array = ["normal" => 0, "pre order" => 1, "paid" => 2];

        if ($filter == 'All') {

            if ($category == 'all' ) {
                return DB::select('SELECT * FROM orders where (international_awb is null OR international_awb = "") AND  store = ? AND verified = ? 
                AND orders.on_process = ? AND actions = ? AND created_at > ? ORDER BY release_date'
               , [ $store, 6, 1, 0, $this->created_at[$store]] );
            } else {
                return DB::select('SELECT * FROM orders where (international_awb is null OR international_awb = "") AND  store = ? AND verified = ? 
                AND orders.on_process = ? AND actions = ? AND category=?  AND created_at > ? ORDER BY release_date
                ', [ $store, 6, 1, 0, $category_array[$category] , $this->created_at[$store] ]);
            } 
            
        } else if($filter == 'Others') {
           
            if ($category == 'all' ) {
                return DB::select('SELECT * FROM orders where (international_awb is null OR international_awb = "") AND  store = ? AND verified = ? 
                AND orders.on_process = ? AND actions = ? AND created_at > ? 
                AND country not in ("Egypt","Saudi Arabia","Kuwait","Oman","Bahrain","Qatar","Jordan","United Arab Emirates", "Iraq") ORDER BY release_date'
                ,  [ $store, 6, 1, 0, $this->created_at[$store]] );
            } else {
                return DB::select('SELECT * FROM orders where (international_awb is null OR international_awb = "") AND  store = ? AND verified = ? 
                AND orders.on_process = ? AND actions = ? AND category=? AND created_at > ? 
                AND country not in ("Egypt","Saudi Arabia","Kuwait","Oman","Bahrain","Qatar","Jordan","United Arab Emirates", "Iraq") ORDER BY release_date'
                , [ $store, 6, 1, 0,  $category_array[$category], $this->created_at[$store]] );
            }
        }else{
            if ($category == 'all' ) {
                return DB::select('SELECT * FROM orders where (international_awb is null OR international_awb = "") AND  store = ? AND verified = ? 
                AND orders.on_process = ? AND actions = ? AND country = ? AND created_at > ? ORDER BY release_date'
                , [ $store, 6, 1, 0, $filter, $this->created_at[$store]] );
            } else {
                return DB::select('SELECT * FROM orders where (international_awb is null OR international_awb = "") AND  store = ? AND verified = ? 
                AND orders.on_process = ? AND actions = ? AND country = ? AND category=? AND created_at > ? ORDER BY release_date'
                , [ $store, 6, 1, 0, $filter, $category_array[$category], $this->created_at[$store]] );
            }
        }

    }

    public function export_with_verified_SKUs($store, $filter, $category)
    {
        $category_array = ["normal" => 0, "pre order" => 1, "paid" => 2];
        
        if ($filter == 'All') {
            
            if ($category == 'all' ) {
                return   DB::select('SELECT orders.order_number , orders.category , orders.country , orders.total_price , orders.created_at , items.product_name , items.quantity , items.sku  FROM items INNER JOIN orders ON items.order_id = orders.order_number where 
                (orders.international_awb is null OR orders.international_awb = "") AND orders.store = ? AND orders.verified = ?   AND orders.created_at > ?
                AND orders.status = ? AND orders.actions = ? AND orders.on_process =? ', [$store, 6, $this->created_at[$store], 0 , 0 , 0]);
            } else {
                return   DB::select('SELECT orders.order_number , orders.category , orders.country , orders.total_price , orders.created_at , items.product_name , items.quantity , items.sku  FROM items INNER JOIN orders ON items.order_id = orders.order_number where 
                (orders.international_awb is null OR orders.international_awb = "") AND orders.store = ? AND orders.verified = ?  AND orders.category=?  AND orders.created_at > ?
                AND orders.status = ? AND orders.actions = ? AND orders.on_process =? ', [$store, 6, $category_array[$category] , $this->created_at[$store], 0 , 0 , 0]);
            }

        } else if($filter == 'Others') {

            if ($category == 'all' ) {
                return   DB::select('SELECT orders.order_number , orders.category , orders.country , orders.total_price , orders.created_at , items.product_name , items.quantity , items.sku  
                FROM items INNER JOIN orders ON items.order_id = orders.order_number where (orders.international_awb is null OR orders.international_awb = "") AND orders.store = ? 
                AND orders.verified = ? AND orders.country not in ("Egypt","Saudi Arabia","Kuwait","Oman","Bahrain","Qatar","Jordan","United Arab Emirates", "Iraq") AND orders.created_at > ?
                AND orders.status = ? AND orders.actions = ? AND orders.on_process =? ',
                 [$store, 6 , $this->created_at[$store] , 0 , 0 , 0]);
            } else {
                return   DB::select('SELECT orders.order_number , orders.category , orders.country , orders.total_price , orders.created_at , items.product_name , items.quantity , items.sku  
                FROM items INNER JOIN orders ON items.order_id = orders.order_number where (orders.international_awb is null OR orders.international_awb = "") AND orders.store = ? 
                AND orders.verified = ? AND orders.country not in ("Egypt","Saudi Arabia","Kuwait","Oman","Bahrain","Qatar","Jordan","United Arab Emirates", "Iraq") AND orders.category=?  AND orders.created_at > ?
                AND orders.status = ? AND orders.actions = ? AND orders.on_process =?',
                 [$store, 6, $category_array[$category] , $this->created_at[$store], 0 , 0 , 0]);
            }

        }else{

            if ($category == 'all' ) {
                return   DB::select('SELECT orders.order_number , orders.category , orders.country, orders.total_price , orders.created_at , items.product_name , items.quantity , items.sku  FROM items INNER JOIN orders 
                ON items.order_id = orders.order_number where (orders.international_awb is null OR orders.international_awb = "") AND orders.store = ? AND orders.verified = ? AND orders.country= ?  AND orders.created_at > ?
                AND orders.status = ? AND orders.actions = ? AND orders.on_process =?'
                , [$store, 6, $filter , $this->created_at[$store], 0 , 0 , 0]);
            } else {
                return   DB::select('SELECT orders.order_number , orders.category , orders.country , orders.total_price , orders.created_at , items.product_name , items.quantity , items.sku  FROM items INNER JOIN orders 
                ON items.order_id = orders.order_number where (orders.international_awb is null OR orders.international_awb = "") AND orders.store = ? AND orders.verified = ? AND orders.country= ? AND orders.category=?  AND orders.created_at > ?
                AND orders.status = ? AND orders.actions = ? AND orders.on_process =?'
                , [$store, 6, $filter, $category_array[$category] , $this->created_at[$store], 0 , 0 , 0]);
            }

        }
        
        
    }

    public function export_with_tst_SKUs($store, $filter, $category)
    {

        $category_array = ["normal" => 0, "pre order" => 1, "paid" => 2];

        if ($filter == 'All') {

            if ($category == 'all' ) {
                
                return   DB::select('SELECT orders.order_number , orders.category , orders.country , orders.total_price , orders.created_at , items.product_name , items.quantity , items.sku  FROM items INNER JOIN orders ON items.order_id = orders.order_number 
                 where  orders.store = ? AND  orders.verified = ?  AND (orders.international_awb is not null AND orders.international_awb !="") 
                 AND orders.actions != ?  AND orders.status < ? AND   orders.created_at > ?'
                 , [$store, 6, 1, 5, $this->created_at[$store]]);
    
            } else {
                return   DB::select('SELECT orders.order_number , orders.category , orders.country , orders.total_price , orders.created_at , items.product_name , items.quantity , items.sku  FROM items INNER JOIN orders ON items.order_id = orders.order_number 
                 where  orders.store = ? AND  orders.verified = ?  AND (orders.international_awb is not null AND orders.international_awb !="") 
                 AND orders.actions != ?  AND orders.status < ?  AND  orders.category=? AND  orders.created_at > ?'
                 , [$store, 6, 1, 5, $category_array[$category], $this->created_at[$store]]);
    
            }

        } else if($filter == 'Others') {

            if ($category == 'all' ) {
                return   DB::select('SELECT orders.order_number , orders.category , orders.country , orders.total_price , orders.created_at , items.product_name , items.quantity , items.sku  FROM items INNER JOIN orders ON items.order_id = orders.order_number 
                 where  orders.store = ? AND  orders.verified = ?  AND (orders.international_awb is not null AND orders.international_awb !="") 
                 AND orders.actions != ?  AND orders.status < ? AND  orders.country not in ("Egypt","Saudi Arabia","Kuwait","Oman","Bahrain","Qatar","Jordan","United Arab Emirates", "Iraq") AND 
                   orders.created_at > ?'
                 , [$store, 6, 1, 5, $this->created_at[$store]]);
    
            } else {
                return   DB::select('SELECT orders.order_number , orders.category , orders.country , orders.total_price , orders.created_at , items.product_name , items.quantity , items.sku  FROM items INNER JOIN orders ON items.order_id = orders.order_number 
                 where  orders.store = ? AND  orders.verified = ?  AND (orders.international_awb is not null AND orders.international_awb !="") 
                 AND orders.actions != ?  AND orders.status < ? AND orders.country not in ("Egypt","Saudi Arabia","Kuwait","Oman","Bahrain","Qatar","Jordan","United Arab Emirates", "Iraq") 
                 AND  orders.category=? AND  orders.created_at > ?'
                 , [$store, 6, 1, 5, $category_array[$category] , $this->created_at[$store]]);
    
            }

        }else{

            if ($category == 'all' ) {
                return   DB::select('SELECT orders.order_number , orders.category , orders.country , orders.total_price , orders.created_at , items.product_name , items.quantity , items.sku  FROM items INNER JOIN orders ON items.order_id = orders.order_number 
                 where  orders.store = ? AND  orders.verified = ?  AND (orders.international_awb is not null AND orders.international_awb !="") 
                 AND orders.actions != ?  AND orders.status < ? AND  orders.country= ? AND   orders.created_at > ?'
                 , [$store, 6, 1, 5, $filter, $this->created_at[$store]]);
    
            } else {
                return   DB::select('SELECT orders.order_number , orders.category , orders.country ,  orders.total_price , orders.created_at , items.product_name , items.quantity , items.sku  FROM items INNER JOIN orders ON items.order_id = orders.order_number 
                 where  orders.store = ? AND  orders.verified = ?  AND (orders.international_awb is not null AND orders.international_awb !="") 
                 AND orders.actions != ?  AND orders.status < ? AND  orders.country= ? AND  orders.category=? AND  orders.created_at > ?'
                 , [$store, 6, 1, 5, $filter, $category_array[$category] , $this->created_at[$store]]);
    
            }

        }

    }

    public function get_all_verified_orders_with_filters($store, $filter, $category)
    {
        $category_array = ["normal" => 0, "pre order" => 1, "paid" => 2];

        if ($filter == 'All') {
            if ($category == 'all' ) {

                return DB::select(' SELECT * FROM orders where (international_awb is null OR international_awb = "") AND store = ? AND verified = ? 
                 AND created_at > ? AND status = ? AND actions = ? AND on_process =?'
                , [$store, 6, $this->created_at[$store], 0 , 0 , 0]);
    
            } else {
    
                return DB::select(' SELECT * FROM orders where (international_awb is null OR international_awb = "") AND store = ? AND verified = ? 
                AND category=?  AND created_at > ? AND status = ? AND actions = ? AND on_process =?'
                , [$store, 6, $category_array[$category] , $this->created_at[$store] , 0 ,0 ,0 ]);
    
            }
        } else if($filter == 'Others') {

            if ($category == 'all' ) {

                return DB::select(' SELECT * FROM orders where (international_awb is null OR international_awb = "") AND store = ? AND verified = ? 
                AND  country not in ("Egypt","Saudi Arabia","Kuwait","Oman","Bahrain","Qatar","Jordan","United Arab Emirates", "Iraq")  AND created_at > ? AND status = ? AND actions = ? AND on_process =?'
                , [$store, 6, $this->created_at[$store] , 0 , 0 ,0]);
    
            } else {
    
                return DB::select(' SELECT * FROM orders where (international_awb is null OR international_awb = "") AND store = ? AND verified = ? 
                AND country not in ("Egypt","Saudi Arabia","Kuwait","Oman","Bahrain","Qatar","Jordan","United Arab Emirates", "Iraq") AND category=?  AND created_at > ? AND status = ? AND actions = ? AND on_process =?'
                , [$store, 6,$category_array[$category] , $this->created_at[$store] , 0 , 0 ,0]);
    
            }

        }else{
            if ($category == 'all' ) {

                return DB::select(' SELECT * FROM orders where (international_awb is null OR international_awb = "") AND store = ? AND verified = ? 
                AND country= ?  AND created_at > ? AND status = ? AND actions = ? AND on_process =?'
                , [$store, 6, $filter, $this->created_at[$store] , 0  ,0 ,0]);
    
            } else {
    
                return DB::select(' SELECT * FROM orders where (international_awb is null OR international_awb = "") AND store = ? AND verified = ? 
                AND country= ? AND category=?  AND created_at > ? AND status = ?  AND actions = ? AND on_process =?'
                , [$store, 6, $filter,  $category_array[$category] , $this->created_at[$store], 0 ,0 ,0]);
    
            }
        }

    }

    public function get_all_tst_orders_with_filters($store, $filter, $category)
    {
        $category_array = ["normal" => 0, "pre order" => 1, "paid" => 2];

        if ($filter == 'All') {

            if ($category == 'all' ) {
                return DB::select('SELECT * FROM orders where store = ? AND verified = ?  AND 
                (international_awb is not null AND international_awb !="") AND actions != ?  AND status < ?  AND created_at > ?'
               , [$store, 6, 1, 5, $this->created_at[$store]]);
            } else {
                return DB::select('SELECT * FROM orders where store = ? AND verified = ?  AND 
               (international_awb is not null AND international_awb !="") AND actions != ?  AND status < ?   AND
               category=? AND created_at > ?', [$store, 6, 1, 5, $category_array[$category], $this->created_at[$store]]);
            }

        } else if($filter == 'Others') {
           
            if ($category == 'all' ) {
                return DB::select('SELECT * FROM orders where store = ? AND verified = ?  AND 
                (international_awb is not null AND international_awb !="") AND actions != ?  AND status < ?  AND
                country= ?  country not in ("Egypt","Saudi Arabia","Kuwait","Oman","Bahrain","Qatar","Jordan","United Arab Emirates", "Iraq")
                 AND created_at > ?', [$store, 6, 1, 5, $this->created_at[$store]]);
            } else {
                return DB::select('SELECT * FROM orders where store = ? AND verified = ?  AND 
                (international_awb is not null AND international_awb !="") AND actions != ?  AND status < ?  AND
                country not in ("Egypt","Saudi Arabia","Kuwait","Oman","Bahrain","Qatar","Jordan","United Arab Emirates", "Iraq") AND category=? AND created_at > ?'
                , [$store, 6, 1, 5,  $category_array[$category], $this->created_at[$store]]);
            }
        }else{
            if ($category == 'all' ) {
                return DB::select('SELECT * FROM orders where store = ? AND verified = ?  AND 
                 (international_awb is not null AND international_awb !="") AND actions != ?  AND status < ?  AND
                country= ?  AND created_at > ?', [$store, 6, 1, 5, $filter, $this->created_at[$store]]);
            } else {
                return DB::select('SELECT * FROM orders where store = ? AND verified = ?  AND 
               (international_awb is not null AND international_awb !="") AND actions != ?  AND status < ?  AND
                country= ? AND category=? AND created_at > ?', [$store, 6, 1, 5, $filter, $category_array[$category], $this->created_at[$store]]);
            }
        }
        
    }
    
    public function import($file, $store)
    {

        ignore_user_abort();
        
        $orders = ['success' => 0, 'failed' => 0];
 
        $companies = ['GLT' => 'GLT', 'OCS' => 'OCS', 'SMSA' => 'SMSA', 'ARAMEX' => 'ARAMEX', 'DHL' => 'DHL', 'SHIPA' => 'SHIPA' , 'NAQEL' => 'NAQEL' , 
        'CUBE SHIP' => 'CUBE SHIP'];

        $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader('Xlsx');
        $reader->setReadDataOnly(true);
        $spreadsheet = $reader->load($file);

        $worksheet = $spreadsheet->getActiveSheet();

        $highestRow = $worksheet->getHighestRow();

        if ($highestRow > 200 ) {
            $orders['error'] = 'Invalid Import, The number of orders exceeds 200!';
            return $orders;
        }
        
        $highestColumn = $worksheet->getHighestColumn();

        $dataArray = $spreadsheet->getActiveSheet()
            ->rangeToArray(
                'A1:' . $highestColumn . $highestRow, // The worksheet range that we want to retrieve
                null, // Value that should be returned for empty cells
                true, // Should formulas be calculated (the equivalent of getCalculatedValue() for each cell)
                true, // Should values be formatted (the equivalent of getFormattedValue() for each cell)
                true // Should the array be indexed by cell row and cell column
            );

        $data = count($dataArray);

        date_default_timezone_set('Africa/Cairo');
        $date = date('Y-m-d H:i:s', time());
       

        /// creating sheet of errors 

            $errors_titles= ['A'=> 'order number ' , 'B' => 'Reason of failure '];

            $spreadsheet_error = new \PhpOffice\PhpSpreadsheet\Spreadsheet();    
            $spreadsheet_error->getActiveSheet()->setTitle('Failure reasons');

            foreach ($errors_titles as $key => $value) {
                $spreadsheet_error->getActiveSheet()->setCellValue($key . '1', $value);
            }

            $row_errors = 2;
            $errors_data=[];

        /// creating sheet of errors 

        $Egypt_letter = 'E';
        $Kuwait_letter = 'K';
        $ksa_letter = 'S';
        $uae_letter = 'U';

        $first_letter = NULL;


        $first_date_check_min = 0;
        $first_date_check_sec = 0;

        $second_date_check_min = 0;
        $second_date_check_sec = 0;

        $delay = 0;
        $sleep_delay_sec = 600;
        $time_now=0;
        $last_method_time=0;

        if ($store == 'plus_egypt') {
            $first_letter = $Egypt_letter;
            $origin = 0;
        } elseif ($store == 'plus_kuwait') {
            $first_letter = $Kuwait_letter;
            $origin = 0;
        } elseif ($store == 'plus_ksa') {
            $first_letter = $ksa_letter;
            $origin = 0;
        }elseif ($store == 'plus_uae') {
            $first_letter = $uae_letter;
            $origin = 0;
        }else{
            $origin = NULL;
        }
        
        if ($store == 'origin') {
            if ($dataArray[1]['A'] != 'Order number' || $dataArray[1]['B'] != 'AWB' || $dataArray[1]['C'] != 'LWB' || $dataArray[1]['D'] != 'Company' || $dataArray[1]['E'] != 'Last Action') {
                $orders['error'] = 'Invalid template, There is an error with entering the data';
            }
        } else {
            if ($dataArray[1]['A'] != 'Order number' || $dataArray[1]['B'] != 'HAWB' || $dataArray[1]['C'] != 'Company' || $dataArray[1]['D'] != 'Last Action') {
                $orders['error'] = 'Invalid template, There is an error with entering the data';
            }
        }

        try {
            for ($row = 2; $row <= $data; $row++) {

                $order_number= (string)$dataArray[$row]['A'];
    
                $order = DB::select('SELECT * from orders where order_number= ? AND verified = ?', [ $order_number, 6]);
    
                if (ctype_digit(substr((string) $order_number ,0,1))) {
                    $origin = 1;
                }
    
                $time_now=floor(microtime(true) * 1000);
    
    
                    if ($order_number == '' || $order_number == NULL ) {
    
                        //$errors_data['empty row'] = 'The next '. $orders['failed'] .'rows are not added too!';
                                    
                       break;
    
                    } else {
                        
                        if ($order == null || $order == []) {
                        
                            // order is not even verified yet *************
                            $orders['failed'] = $orders['failed'] + 1;
                            $errors_data[$order_number] = 'order is not even verified yet';
                                    
                            continue;
                            
                        } else {
    
                
                            //check if this order in the store 
    
                            if (  $order_number[0] != $first_letter && $origin != 1) {
    
                                ///wrong store *************
                                $orders['failed'] = $orders['failed'] + 1;
                            
                                $errors_data[$order_number] = 'order is in wrong store';
                            
                                continue;
    
                            } else {
    
                                if ($last_method_time ==0 || ($time_now - $last_method_time ) >= $sleep_delay_sec ) {
    
                                    $last_method_time=floor(microtime(true) * 1000);
                                    $orderinshopify = $this->order_details_shopify($order[0]->order_id , $store);
                                    
                                }else {
                    
                                    usleep( ($sleep_delay_sec -($last_method_time - $time_now)) * 1000 );
                    
                                    $orderinshopify = $this->order_details_shopify($order[0]->order_id , $store);
                                }
                    
                    
                                if (count($orderinshopify['order']['fulfillments']) == 0 ) {
                                    //DELAY
                                        $time_now=floor(microtime(true) * 1000);
                    
                                        if (($time_now - $last_method_time ) >= $sleep_delay_sec) {
                    
                                            $last_method_time=floor(microtime(true) * 1000);
                    
                                        }else{
                    
                                            usleep( ($sleep_delay_sec -($last_method_time - $time_now)) * 1000 );
                                            $last_method_time =floor(microtime(true) * 1000);
                                            
                                        }
                                    //
                                    try {

                                        $this->mark_order_as_fulfilled( $order[0]->id , $store );
                                    } catch (\Throwable $th) {
                                        DB::insert('insert into errors (message,shipment_number) values (?,?)', [$th, $order[0]->id]);
                                    }
                                    
                    
                                }
                                elseif(count($orderinshopify['order']['fulfillments']) > 0)
                                {
                                    $check=0;
                                    foreach ($orderinshopify['order']['fulfillments'] as $fullfilment_data) {
                                        if ($fullfilment_data['status'] == 'success') {
                                            //DELAY
                                                $time_now=floor(microtime(true) * 1000);
                                            
                                                if (($time_now - $last_method_time ) >= $sleep_delay_sec) {
                    
                                                    $last_method_time=floor(microtime(true) * 1000);
                                                }else{
                    
                                                    usleep( ($sleep_delay_sec -($last_method_time - $time_now)) * 1000 );
                                                    $last_method_time =floor(microtime(true) * 1000);

                                                }
                                            //
                                            $this->update_fulfillment_tracking($fullfilment_data['id'], $store,$order[0]->kshopina_awb,$order[0]->id);
                                            $check=1;
                                            break;
                                            
                                        }
                                    }
                                    if ($check==0) {
                                        //DELAY
                                            $time_now=floor(microtime(true) * 1000);
                    
                                            if (($time_now - $last_method_time ) >= $sleep_delay_sec) {
                    
                                                $last_method_time=floor(microtime(true) * 1000);
                                            }else{
                    
                                                usleep( ($sleep_delay_sec -($last_method_time - $time_now)) * 1000 );
                                                $last_method_time =floor(microtime(true) * 1000);
        
                                            }
                                        //
                                        DB::insert('insert into errors (message,shipment_number) values (?,?)', ["2", $order[0]->id]);

                                        $this->mark_order_as_fulfilled( $order[0]->id , $store );
                                    }
                    
                                }
    
    
                                if ($store == 'origin') {
    
                                    $awb = $dataArray[$row]['B'];
                                    $lwb = $dataArray[$row]['C'];
    
                                    if (empty($order[0]->international_awb)) {
                                        if (!empty($dataArray[$row]['B'])) {
    
                                            //DELAY
                                                $time_now=floor(microtime(true) * 1000);
    
                                                if (($time_now - $last_method_time ) >= $sleep_delay_sec) {
                            
                                                    $last_method_time=floor(microtime(true) * 1000);
                                                }else{
                            
                                                    usleep( ($sleep_delay_sec -($last_method_time - $time_now)) * 1000 );
                                                    $last_method_time =floor(microtime(true) * 1000);

                                                }
                                            //
                                            $status = $this->status['Dispatched'];
                                            
                                            $this->replace_tag("#Confirmed", "#on_process",  $order[0]->id, $order[0]->store);
                                            $this->replace_tag("#on_process", "#dispatched",  $order[0]->id, $order[0]->store);

                                        } elseif (empty($dataArray[$row]['B'])) {
    
                                            /// has no awb means not dispached yettttt  (origin) **********
                                            
                                            $orders['failed'] = $orders['failed'] + 1;
                                        
                                            $errors_data[ $order_number] = 'has no awb means not dispached yettttt';
                                            continue;
                                        }
                                    } else {
                                     
                                        if (!empty($dataArray[$row]['B'])) {
    
                                            if (!empty($dataArray[$row]['C'])) {
                                                $status = $order[0]->status;
                                            } else {
                                                //DELAY
                                                    $time_now=floor(microtime(true) * 1000);
    
                                                    if (($time_now - $last_method_time ) >= $sleep_delay_sec) {
    
                                                        $last_method_time=floor(microtime(true) * 1000);
    
                                                    }else{
                                                        usleep( ($sleep_delay_sec -($last_method_time - $time_now)) * 1000 );
                                                        $last_method_time =floor(microtime(true) * 1000);
                                                        
                                                    }
                                                //
                                                $status = $this->status['Dispatched'];
                                                $this->replace_tag("#Confirmed", "#dispatched",  $order[0]->id, $order[0]->store);
                                                
                                            }
                                        } else {
                                        
                                            if (!empty($dataArray[$row]['C'])) {
    
                                                $status = $order[0]->status;
    
                                                $awb = $order[0]->international_awb;
                                            } elseif (!empty($dataArray[$row]['E'])) {
    
                                                $status = $order[0]->status;
    
                                            } else {
    
                                                //// not enough info   mzwdsh 7aga gdeda ll order hwa dispached w lsa  (origin)******
                                                $orders['failed'] = $orders['failed'] + 1;
                                                
                                                $errors_data[ $order_number] = 'no added information to the order';
                                            
                                                continue;
                                            }
                                        }
                                    }
    
                                    //company
    
                                    if (isset($dataArray[$row]['D'])) {
    
                                        if (isset($companies[strtoupper($dataArray[$row]['D'])]) && !empty($lwb)) {
    
                                            $company = $companies[strtoupper($dataArray[$row]['D'])];
    
                                        } else {
                                           ///// no lwb added to add domestic company  (origin) ***********
    
                                            $orders['failed'] = $orders['failed'] + 1;
                                        
                                            $errors_data[$order_number] = 'no lwb added to add domestic company ';
    
                                            continue;
                                        }
                                    } else {
    
                                        $company = NULL;
    
                                    }
    
                                    //actions
                                    if (!empty($dataArray[$row]['C']) && $order[0]->actions == 1) {
    
                                        $action = 2;
                                        $status = $this->status['Kshopina_Warehouse'];
    
                                    } else {
    
                                        $action = $order[0]->actions;
    
                                    }
    
    
                                    $values = [
                                        'international_awb' => $awb,
                                        'domestic_awb' => $lwb,
                                        'domestic_company' => $company,
                                        'status' => $status,
                                        'actions' => $action,
                                        'last_action' => $dataArray[$row]['D'],
                                        'updated_at' => $date,
                                    ];
                                    $orders['success'] = $orders['success'] + 1;
    
    
                                    if ($values['status'] == $this->status['Dispatched']) {
                                        $values['dispatched_at'] = $date;
                                    } else if ($values['status'] == $this->status['Kshopina_Warehouse']) {
                                        $values['in_warehouse_at'] = $date;
                                    } else if ($values['status'] == $this->status['Delivery']) {
                                        $values['delivery_at'] = $date;
                                    } else if ($values['status'] == $this->status['Delivered']) {
                                        $values['delivered_at'] = $date;
                                    } else if ($values['status'] == $this->status['Delivery'] && $order[0]->actions == 2) {
                                        $values['re_delivery_at'] = $date;
                                    } else if ($values['status'] == $this->status['Delivered'] && $order[0]->actions == 2) {
                                        $values['re_delivered_at'] = $date;
                                    }
    
                                    DB::table('orders')
                                        ->where('order_number',   $order_number)
                                        ->update($values);
                                } else {
    
                                    $hawb = $dataArray[$row]['B'];
    
                                    if (empty($order[0]->international_awb) && empty($dataArray[$row]['B'])) {
    
                                        /// order doesnt have hawb ********** (plus models)
                                        $orders['failed'] = $orders['failed'] + 1;
                                    
                                        $errors_data[ $order_number] = 'order doesnt have hawb';
    
                                        continue;
                                    }
    
                                    //status
                                    if (!empty($order[0]->international_awb) || !empty($dataArray[$row]['B'])) {
                                        $status = 2;
                                    } else {
                                        $status = 0;
                                    }
    
    
                                        //company
                                    if (isset($dataArray[$row]['C'])) {
    
                                        if (isset($companies[strtoupper($dataArray[$row]['C'])]) && !empty($hawb)) {
    
                                            $company = $companies[strtoupper($dataArray[$row]['C'])];
                                            $hawb = $dataArray[$row]['B'];
                                            
                                        } else {
    
                                            if (!empty($order[0]->international_awb)) {
    
                                                $company = $companies[strtoupper($dataArray[$row]['C'])];
                                                $hawb = $order[0]->international_awb;
    
                                            } else {
    
                                                ///// invalid company name (plus models) ***********
    
                                                $orders['failed'] = $orders['failed'] + 1;
                                                
                                                $errors_data[$order_number] = 'invalid company name';
    
                                                continue;
                                            }
                                        }
                                    } else {
                                        $company = NULL;
                                    }
                                
                                    //last action only
                                    if (!empty($order[0]->international_awb) && empty($dataArray[$row]['B'])) {
                                        if (!empty($order[0]->domestic_company) && empty($dataArray[$row]['C'])) {
                                            $company = $order[0]->domestic_company;
                                            $hawb = $order[0]->international_awb;
                                        }
                                    }
    
                                    $values = [
                                        'international_awb' => $hawb,
                                        'domestic_company' => $company,
                                        'last_action' => $dataArray[$row]['D'],
                                        'status' => $status,
                                        'updated_at' => $date,
                                    ];
                                    $orders['success'] = $orders['success'] + 1;
    
                                    $values['international_awb']=preg_replace('/\s+/', '', $values['international_awb']);
    
                                    DB::table('orders')
                                        ->where('order_number',   $order_number)
                                        ->update($values);
                                }
                            }
                        }
    
                    }
            }
    
            if ( !empty($errors_data) ) {
                foreach ($errors_data as $key => $value) {
                    $spreadsheet_error->getActiveSheet()->setCellValue('A' . $row_errors, $key);
                    $spreadsheet_error->getActiveSheet()->setCellValue('B' . $row_errors, $value);
                    $row_errors ++;
                }
            }
            
            $writer = new Xlsx($spreadsheet_error);
            $name = date('Y-m-d--h-i-sa');
    
            if (!file_exists(public_path('uploads/import_errors/'))) {
                mkdir(public_path('uploads/import_errors/' ), 0777, true);
            }
    
            $writer->save(public_path('/uploads/import_errors' . '/file' . $name . '.xlsx'));
            unset($reader);
    
            return [$orders , $name];
        } catch (\Throwable $th) {
            DB::insert('insert into errors (message,system_name) values (?,?)', [ $th, "IMPORT ERROR"]);
        }

        
    }


    // here we start
    public function submit($reasons, $data, $old_status , $store)
    {

        $table = ['awb' => 'international_awb', 'lwb' => 'domestic_awb', 'company' => 'domestic_company', 'status' => 'status', 'lastaction' => 'last_action','releasedate'=>'release_date'];
        $query = [];
        date_default_timezone_set('Africa/Cairo');
        $date = date('Y-m-d H:i:s', time());

        foreach ($data as $order_number => $values) {

            $order_data = DB::select('SELECT * from orders where order_number= ? AND verified = ?', [$order_number, 6]);

            foreach ($values as $key => $value) {

                $query[$table[$key]] = $value;
            }


            foreach ($order_data as $order) {
                
            
                if ($old_status[$order_number] < 2 && isset($query['international_awb']) && !isset($query['status'])) {

                    $this->replace_tag("#on_process", "#dispatched", $order->id, $store);
                    $query['status'] = $this->status['Dispatched'];

                    if ($order->fulfillment_status != "fulfilled") {
                        $this->mark_order_as_fulfilled($order->id, $store);
                    }
                } /* else if ($old_status[$order_number] == 2 && isset($query['domestic_awb']) && !isset($query['status'])) {

                    $query['status'] = $this->status['Kshopina_Warehouse'];
                    $query['in_warehouse_at'] = $date;
                } */


                //refused to fct
                if (isset($query['status']) && $query['status'] == $this->status['Refused'] && isset($reasons[$order_number])) {
                    if ($this->fct_is_exist($order_number)) {
                        $this->update_fct((string)$order_number, $reasons[$order_number], $date);
                    } else {
                        $this->insert_fct((string)$order_number, $reasons[$order_number], $date, 3,$store);
                        if ($store !='origin') {
                            $this->replace_tag("#on_process", "#FCT", $order->id, $store);
                        }else{
                            $this->replace_tag("#dispatched", "#FCT", $order->id, $store);

                        }
                        $this->replace_tag("#Delivered", "", $order->id, $store);
                    }
                    $query['delivered_at'] = $date;
                    $query['old_status']=$order->status;
                }
                //tag delivered
                if (isset($query['status']) && $query['status'] == $this->status['Delivered']) {

                    if ($store !='origin') {
                        $this->replace_tag("#on_process", "#Delivered", $order->id, $store);
                    }else{
                        $this->replace_tag("#dispatched", "#Delivered", $order->id, $store);

                    }

                    $this->mark_order_as_paid($order->order_id,$order->store);
                }
                //actions
                if (isset($query['domestic_awb']) && $order->actions == 1) {
                    $query['actions'] = 2;
                    $query['status'] = $this->status['Kshopina_Warehouse'];
                    $query['re_delivery'] = 1;
                } else {
                    $query['actions'] = $order->actions;
                }

                $query['updated_at'] = $date;
                if (isset($query['status'])) {
                    if ($query['status'] == $this->status['Dispatched'] && $order->actions == 0) {
                        $query['dispatched_at'] = $date;
                    } else if ($query['status'] == $this->status['Kshopina_Warehouse'] && $order->actions == 0) {
                        $query['in_warehouse_at'] = $date;
                    } else if ($query['status'] == $this->status['Delivery'] && $order->actions == 0) {
                        $query['delivery_at'] = $date;
                    } else if (($query['status'] == $this->status['Delivered'] || $query['status'] == $this->status['Refused']) && $order->actions == 0) {
                        $query['delivered_at'] = $date;
                    } else if ($query['status'] == $this->status['Delivery'] && $order->actions == 2) {
                        $query['re_delivery_at'] = $date;
                    } else if ($query['status'] == $this->status['Delivered'] && $order->actions == 2) {
                        $query['re_delivered_at'] = $date;
                    }
                }

                if (isset($query['international_awb'])) {
                    $query['international_awb']=preg_replace('/\s+/', '', $query['international_awb']);
                }
                if (isset($query['domestic_awb'])) {
                    $query['domestic_awb']=preg_replace('/\s+/', '', $query['domestic_awb']);
                }
                DB::table('orders')->where('order_number', (string) $order_number)
                    ->update($query);

                $query = [];
            }
        }
        return count($data);
    }
    public function submit_fct($data,$store)
    {

        $table = ['notes' => 'notes', 'status' => 'last_update','rescheduledate'=>'reschedule_date'];
        $query = [];
        date_default_timezone_set('Africa/Cairo');
        $date = date('Y-m-d H:i:s', time());
        
        foreach ($data as $order_number => $values) {

            foreach ($values as $key => $value) {

                if ($key == 'rescheduledate' && ( $value == '' )) {
                    $value = NULL;
                }
                $query[$table[$key]] = $value;
            }

            $query['updated_at'] = $date;

            $query['update_by']= Auth::user()->name;
            
            DB::table('fct')->where('order_number',(string) $order_number)
                ->update($query);


            if ( isset($values['status']) && ($values['status'] == $this->status['Delivered'] || $values['status'] == $this->status['Refused']) ) {

                DB::table('orders')->where('order_number', (string) $order_number)
                    ->update(['status' => $values['status'], 'actions' => 0, 're_delivered_at' => $date, 'updated_at' => $date]);

                $order = DB::select('SELECT * from orders where order_number= ? AND verified = ?', [$order_number, 6]);

                if ($values['status'] == $this->status['Delivered']) {
                   
                    $this->replace_tag("#FCT", "#Delivered", $order[0]->id, $store);
                   
                    $this->mark_order_as_paid($order[0]->order_id,$order[0]->store);
                
                } else {
                    
                    $this->replace_tag("#FCT", "#Refused", $order[0]->id, $store);
                    try {
                        $this->cancel_shopify($store, $order_number,'TST');
                    } catch (\Throwable $th) {
                        DB::insert('insert into errors (shipment_number,message,system_name) values (?,?,?)', [$order_number, $th, $store]);
                    }
  
                } 

            } else if (isset($values['status']) && $values['status'] == $this->status['Delivery']) {
                
                DB::table('orders')->where('order_number', (string) $order_number)
                    ->update(['status' => $values['status'], 're_delivery' => 1, 're_delivery_at' => $date, 'updated_at' => $date]);
            } 
            else if (isset($values['status']) && $values['status'] == $this->status['Kshopina_Warehouse']) {
                
                DB::table('orders')->where('order_number', (string) $order_number)
                    ->update(['status' => $values['status'], 'updated_at' => $date]);
            }
           
        }

        return count($data);
    }

    public function submit_awbs($awbs)
    {
        $query=[];
        date_default_timezone_set('Africa/Cairo');
        $date = date('Y-m-d H:i:s', time());
        $clear_date = Null ;

        foreach ($awbs as $awb => $data) {
            $check=DB::select('SELECT * from international_awbs where mawb=? AND awb_active = ?', [$awb,0]);

            foreach ($data as $key => $value) {
                if( ( $key == "dispatched_date"  || $key == "expected_date" ) &&  $value == null){
                    $query[$key] = $clear_date;
                }else{
                    $query[$key]=$value;
                }
            }

            if (count($check) > 0) {

                $query['awb_updated_at']=$date;
               
                DB::table('international_awbs')->where(['mawb'=>(string)$awb])->update($query);

            } else {
                
                $query['mawb']=$awb;
                $query['awb_created_at']=$date;
                
                DB::table('international_awbs')->insert($query);
              
            }
            
        }
    }
    
    public function remove_from_awbs($awb)
    {
        date_default_timezone_set('Africa/Cairo');
        $date = date('Y-m-d H:i:s', time()); 

        $check=DB::select('SELECT * from international_awbs where mawb =? ', [$awb]);

        if ( count($check) > 0 ) {

            DB::table('international_awbs')->where(['mawb'=>$awb])->update(['awb_active' => 1  , 'awb_updated_at'  =>  $date,'removed_by'=>Auth::user()->name]);

        } else {
        
            DB::insert('insert into international_awbs (mawb,awb_active,awb_created_at,removed_by) values (?, ?,?,?)',
            [$awb, 1 , $date,Auth::user()->name]);

         }
    }
    
    
    public function insert_fct($order_number, $reason, $date, $source,$store)
    {
        DB::insert('insert into fct (order_number, last_status,created_at,source,store) values (?, ?,?,?,?)', [$order_number, $reason, $date, $source,$store]);
    }

    public function fct_is_exist($order_number)
    {
        $fct = DB::select('select * from fct where order_number = ?', [$order_number]);
        if ($fct == null || $fct == [] | count($fct) == 0) {
            return false;
        } else {
            return true;
        }
    }
    public function update_fct($order_number, $reason, $date)
    {
        if( isset(Auth::user()->name) ){ 
            DB::table('fct')->where('order_number', $order_number)
            ->update(['last_status' => $reason, 'last_update' => 0, 'updated_at' => $date,'update_by'=>Auth::user()->name]);
        }else{
            DB::table('fct')->where('order_number', $order_number)
            ->update(['last_status' => $reason, 'last_update' => 0, 'updated_at' => $date,'update_by'=>'Tracking']);
        }
    }
    public function send_to_fct($order_number, $reason, $date, $source,$store)
    {

        if ($this->fct_is_exist($order_number)) {
            $this->update_fct($order_number, $reason, $date);
        } else {
            $this->insert_fct($order_number, $reason, $date, $source,$store);
        }
    }
    public function change_action($order_number, $action, $date)
    {

        DB::table('orders')->where('order_number', $order_number)
            ->update(['actions' => $action, 'status' => $this->status['Kshopina_Warehouse'], 'updated_at' => $date]);
    }
    public function get_fct($order_number)
    {

        return DB::select('select * from fct where order_number = ?', [$order_number]);
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

    public function export_fct()
    {

        $orders = $this->get_all_fct_orders('origin');
        $check = 0;
        $fct_titles = ['A' => 'Order Number', 'B' => 'Phone number', 'C' => 'LWB', 'D' => 'Reason', 'E' => 'Notes', 'F' => 'Final status', 'G' => 'From'];
        $status = ['Verified', 'Fulfilled', 'Dispatched', 'In Warehouse', 'Out for delivery', 'Delivered', 'Refused', 'Canceled'];

        $arr2 = ['', 'Egypt', 'Kuwait', 'Saudi Arabia', 'Bahrain', 'Oman', 'Jordan', 'Qatar', 'United Arab Emirates', "Iraq"];

        $arr = [];
        $arr[''] = 0;
        $arr['Egypt'] = 1;
        $arr['Kuwait'] = 2;
        $arr['Saudi Arabia'] = 3;
        $arr['Bahrain'] = 4;
        $arr['Oman'] = 5;
        $arr['Jordan'] = 6;
        $arr['Qatar'] = 7;
        $arr['United Arab Emirates'] = 8;
        $arr['Iraq'] = 9;
        
        $arr0 = [];
        $arr0['Egypt'] = 2;
        $arr0['Kuwait'] = 2;
        $arr0['Saudi Arabia'] = 2;
        $arr0['Bahrain'] = 2;
        $arr0['Oman'] = 2;
        $arr0['Jordan'] = 2;
        $arr0['Qatar'] = 2;
        $arr0['United Arab Emirates'] = 2;
        $arr0['Iraq'] = 2;

        $spreadsheet1 = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $spreadsheet1->getActiveSheet()->setTitle('All');
        $spreadsheet1->createSheet()->setTitle('Egypt'); //
        $spreadsheet1->createSheet()->setTitle('Kuwait');
        $spreadsheet1->createSheet()->setTitle('KSA');
        $spreadsheet1->createSheet()->setTitle('Bahrin');
        $spreadsheet1->createSheet()->setTitle('Oman');
        $spreadsheet1->createSheet()->setTitle('Jordan');
        $spreadsheet1->createSheet()->setTitle('Qatar');
        $spreadsheet1->createSheet()->setTitle('UAE');
        $spreadsheet1->createSheet()->setTitle('Iraq');

        $numoforders = count($orders);
        $row_1 = 2;

        for ($b = 0; $b < count($arr2); $b++) {
            foreach ($fct_titles as $key => $value) {
                $spreadsheet1->getSheet($b)->setCellValue($key . '1', $value);
            }
        }

        for ($row = 0; $row < $numoforders; $row++) {

            $data[0] = $orders[$row]->order_number;
            $data[1] = $orders[$row]->phone_number;
            $data[2] = $orders[$row]->domestic_awb;
            $data[3] = $orders[$row]->last_status;
            $data[4] = $orders[$row]->notes;
            $data[5] = $status[$orders[$row]->last_update];
            $data[6] = date('M j, Y', strtotime($orders[$row]->created_at));

            $col = array_keys($fct_titles);

            for ($i = 0; $i < count($data); $i++) {
                try {
                    //country
                    $spreadsheet1->getSheet($arr[$orders[$row]->country])->setCellValue($col[$i] . $arr0[$orders[$row]->country], $data[$i]);
                    //All
                    $spreadsheet1->getActiveSheet()->setCellValue($col[$i] . $row_1, $data[$i]);
                    $check = 0;
                } catch (\Throwable $th) {
                    //All
                    $spreadsheet1->getActiveSheet()->setCellValue($col[$i] . $row_1, $data[$i]);
                    $check = 1;
                }
            }
            if ($check == 0) {
                $arr0[$orders[$row]->country] = $arr0[$orders[$row]->country] + 1;
            }

            $row_1++;
        }
        $name = date('Y-m-d--h-i-sa');
        $writer = new Xlsx($spreadsheet1);

        if (!file_exists(public_path('uploads/fct'))) {
            mkdir(public_path('uploads/fct'), 0777, true);
        }

        $writer->save(public_path('uploads/fct/file' . $name . '.xlsx'));
        unset($reader);

        return $name;
    }

    public function order_like($value,$store,$filter)
    {
        $value = $value . '%';

        if ($filter == 1) {
            return DB::select('SELECT orders.order_number, orders.status , orders.actions , orders.on_process, orders.international_awb , 
            orders.country, orders.category, orders.domestic_awb,orders.name,orders.store , fct.last_update
              FROM orders left join fct on fct.order_number = orders.order_number WHERE orders.verified = ? AND orders.created_at > ? AND orders.store = ? AND orders.order_number LIKE "' . $value . '"  ', [6,$this->created_at[$store],$store ]);
        } elseif($filter == 2) {
            return DB::select('SELECT orders.order_number, orders.status , orders.actions , orders.on_process, orders.international_awb , 
            orders.country, orders.category, orders.domestic_awb,orders.name ,orders.store, fct.last_update 
             FROM orders left join fct on fct.order_number = orders.order_number WHERE  orders.verified = ? AND orders.created_at > ? AND orders.store = ? AND international_awb LIKE "' . $value . '"  ', [6,$this->created_at[$store],$store ]);
        }else{
            return DB::select('SELECT orders.order_number, orders.status , orders.actions , orders.on_process, orders.international_awb , 
            orders.country, orders.category, orders.domestic_awb,orders.name ,orders.store, fct.last_update
             FROM orders left join fct on fct.order_number = orders.order_number WHERE  orders.verified = ? AND orders.created_at > ? AND orders.store = ? AND domestic_awb LIKE "' . $value . '"  ', [6,$this->created_at[$store],$store ]);

        }
        
    }
    public function order_like_fct($value,$store,$filter)
    {
        $value = $value . '%';

        if ($filter == 1) {
            return DB::select('SELECT  orders.international_awb,orders.country,fct.order_number,fct.store,orders.phone_number,orders.domestic_awb,fct.last_status,fct.notes,fct.last_update,fct.created_at FROM fct
            INNER JOIN orders ON fct.order_number = orders.order_number WHERE orders.store = ? AND fct.order_number LIKE "' . $value . '"  ', [$store]);
            
        } else {
            return DB::select('SELECT  orders.international_awb,orders.country,fct.order_number,fct.store,orders.phone_number,orders.domestic_awb,fct.last_status,fct.notes,fct.last_update,fct.created_at FROM fct
            INNER JOIN orders ON fct.order_number = orders.order_number WHERE orders.store = ? AND orders.domestic_awb LIKE "' . $value . '"  ', [$store]);
            }
        
    }
    

    public function get_orders_from_database_search($store, $rule, $page, $order_number, $page_name)
    {


        $products_per_page = 15;
        $offset = ($page - 1) * $products_per_page;
        $map_of_availability=[];
        $map_of_number_of_items=[];


        if ($rule != 'Others') {
            if ($page_name != "on_process") {
                $orders = DB::select('SELECT * FROM orders where country = ? AND status=? AND on_process = ? AND (international_awb is null OR international_awb = "") AND store = ? AND verified = ? AND order_number =? AND created_at > ? LIMIT ?, ?;', [$rule, $this->status[$page_name], 0, $store, 6, $order_number, $this->created_at[$store], $offset, $products_per_page]);
                $number_of_orders = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM orders where country = ? AND status=? AND on_process = ? AND (international_awb is null OR international_awb = "") AND store = ? AND verified = ? AND order_number =? AND created_at > ?', [$rule, $this->status[$page_name], 0, $store, 6, $order_number, $this->created_at[$store]]);
            } else {
                $orders = DB::select('SELECT * FROM orders where country = ? AND  (international_awb is null OR international_awb = "") AND store = ? AND verified = ? AND on_process = ? AND actions = ? AND order_number =? AND created_at > ? LIMIT ?, ?;', [$rule, $store, 6, 1, 0, $order_number, $this->created_at[$store], $offset, $products_per_page]);
                $number_of_orders = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM orders where country = ? AND  (international_awb is null OR international_awb = "") AND  store = ? AND verified = ? AND on_process = ? AND actions = ? AND order_number =? AND created_at > ?', [$rule, $store, 6, 1, 0, $order_number, $this->created_at[$store]]);
            }
        } else {
            if ($page_name != "on_process") {
                $orders = DB::select('SELECT * FROM orders where  status=? AND on_process = ? AND (international_awb is null OR international_awb = "") AND store = ? AND verified = ? AND order_number =? AND created_at > ? LIMIT ?, ?;', [$this->status[$page_name], 0, $store, 6, $order_number, $this->created_at[$store], $offset, $products_per_page]);
                $number_of_orders = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM orders where  status=? AND on_process = ? AND (international_awb is null OR international_awb = "") AND store = ? AND verified = ? AND order_number =? AND created_at > ?', [$this->status[$page_name], 0, $store, 6, $order_number, $this->created_at[$store]]);
            } else {
                $orders = DB::select('SELECT * FROM orders where  (international_awb is null OR international_awb = "") AND store = ? AND verified = ? AND on_process = ? AND actions = ? AND order_number =? AND created_at > ? LIMIT ?, ?;', [$store, 6, 1, 0, $order_number, $this->created_at[$store], $offset, $products_per_page]);
                $number_of_orders = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM orders where   (international_awb is null OR international_awb = "") AND  store = ? AND verified = ? AND on_process = ? AND actions = ? AND order_number =? AND created_at > ?', [$store, 6, 1, 0, $order_number, $this->created_at[$store]]);
            }
        }

        if($rule != "Others" && $store == 'origin' && $rule != "All"){

            if (count($orders)>0) {
                $orders_string="(";
                foreach ($orders as $index=> $order) {
                    if ($index == count($orders)-1 ) {
                        $orders_string = $orders_string.'"'.$order->order_number.'"';
                    }else{
                        $orders_string = $orders_string.'"'.$order->order_number.'",';
                    }
                }
                $orders_string =$orders_string.")";
    
                $availability=DB::select('SELECT order_details.order_number, order_details.total_price, order_details.created_at,
                                    order_details.country,order_details.origin_variant_id,order_details.quantity,order_details.sku,order_details.variant_quantity,
                                    order_details.plus_variant_id ,order_details.variant_title, stock.product_title,stock.store
                                    FROM kshopina.stock INNER JOIN
                                (SELECT orders.order_number, orders.total_price, orders.created_at,
                                    orders.country,orders.variant_id as origin_variant_id ,orders.quantity,orders.sku,variants.variant_quantity,
                                    variants.variant_id as plus_variant_id,variants.product_id,variants.variant_title 
                                    FROM kshopina.variants INNER JOIN
                                    ( SELECT
                                    orders.order_number , orders.total_price , orders.created_at , items.variant_id, 
                                    items.quantity,items.sku,orders.country
                                    FROM items INNER JOIN orders ON items.order_id = orders.order_number where order_number IN ' .$orders_string. ' ) as orders 
                                    ON orders.sku = variants.variant_sku where orders.quantity <= variants.variant_quantity ) as order_details 
                                    ON order_details.product_id = stock.id 
                                    where stock.store=? ', [$this->country_to_store[$rule]]);
    
                $number_of_items=DB::select('SELECT order_id,count(id) as number_of_items from items where order_id IN ' .$orders_string. ' group by order_id');
    
                foreach ($availability as $order) {
                    if ($order->sku != "" || !empty($order->sku)) {
                        if (isset($map_of_availability[$order->order_number])) {
                            
                                array_push($map_of_availability[$order->order_number],$order);
                        }else{
                                $map_of_availability[$order->order_number]=[$order];
                        }
                    }
                }
                foreach ($number_of_items as $order) {
                    $map_of_number_of_items[$order->order_id]=$order->number_of_items;
                }
            }
        }

        $all_orders_numbers = $this->get_orders_numbers($store);

        return [
            $number_of_orders, $orders, $all_orders_numbers[0], $all_orders_numbers[1],
            $all_orders_numbers[2], $all_orders_numbers[3], $all_orders_numbers[4], $all_orders_numbers[5], $all_orders_numbers[6], $all_orders_numbers[7],
            $map_of_availability,$map_of_number_of_items
        ];
    }

    public function get_orders_from_database_search_tst($store, $rule, $page, $order_number)
    {

        $products_per_page = 15;
        $offset = ($page - 1) * $products_per_page;
        if ($rule != 'Others') {
            $orders = DB::select('SELECT * FROM orders where country = ? AND store = ? AND verified = ? AND order_number = ? AND ( (international_awb is not null AND international_awb !="") OR (status = ? AND actions = ?)) AND status <= ? AND created_at > ? LIMIT ?, ?;', [$rule, $store, 6, $order_number, 0, 1, 6, $this->created_at[$store], $offset, $products_per_page]);
            $number_of_orders = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM orders where country = ? AND store = ? AND verified = ? AND order_number =? AND ( (international_awb is not null AND international_awb !="") OR (status = ? AND actions = ?)) AND status <= ?  AND created_at >?', [$rule, $store, 6, $order_number, 0, 1, 6, $this->created_at[$store]]);
        } else {
            $orders = DB::select('SELECT * FROM orders where  store = ? AND verified = ? AND order_number = ? AND ( (international_awb is not null AND international_awb !="") OR (status = ? AND actions = ?)) AND status <= ? AND created_at > ? LIMIT ?, ?;', [$store, 6, $order_number, 0, 1, 6, $this->created_at[$store], $offset, $products_per_page]);
            $number_of_orders = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM orders where  store = ? AND verified = ? AND order_number =? AND ( (international_awb is not null AND international_awb !="") OR (status = ? AND actions = ?)) AND status <= ?  AND created_at > ?', [$store, 6, $order_number, 0, 1, 6, $this->created_at[$store]]);
        }
        $all_orders_numbers = $this->get_orders_numbers($store);
        return [
            $number_of_orders, $orders, $all_orders_numbers[0], $all_orders_numbers[1],
            $all_orders_numbers[2], $all_orders_numbers[3], $all_orders_numbers[4], $all_orders_numbers[5], $all_orders_numbers[6], $all_orders_numbers[7]
        ];
    }

    public function get_fct_orders_for_search($store,$order_number)
    {


        $orders= DB::select('SELECT  orders.international_awb,fct.reschedule_date,orders.order_id,orders.country,fct.order_number,fct.store,orders.phone_number,orders.domestic_awb,fct.last_status,fct.notes,fct.last_update,fct.created_at FROM fct
            INNER JOIN orders ON fct.order_number = orders.order_number WHERE orders.store = ? AND fct.order_number = ?', [$store,$order_number]);

        $number_of_orders = DB::select('SELECT COUNT(orders.id) AS NumberOfOrders FROM orders INNER JOIN fct ON fct.order_number = orders.order_number WHERE orders.store = ? AND fct.order_number=? ', [ $store,$order_number]);

       

        $all_orders_numbers = $this->get_orders_numbers($store);
        return [
            $number_of_orders, $orders, $all_orders_numbers[0], $all_orders_numbers[1],
            $all_orders_numbers[2], $all_orders_numbers[3], $all_orders_numbers[4], $all_orders_numbers[5], $all_orders_numbers[6], $all_orders_numbers[7]
        ];
    }
    public function get_fct_archived_orders_for_search($store,$order_number)
    {


        $orders= DB::select('SELECT  orders.international_awb,fct.reschedule_date,orders.order_id,orders.country,fct.order_number,fct.store,orders.phone_number,orders.domestic_awb,fct.last_status,fct.notes,fct.last_update,fct.created_at FROM fct
            INNER JOIN orders ON fct.order_number = orders.order_number WHERE orders.store = ? AND fct.order_number = ? AND ( last_update = 5 OR last_update = 6)', [ $store,$order_number ]);

        $number_of_orders = DB::select('SELECT COUNT(orders.id) AS NumberOfOrders FROM orders INNER JOIN fct ON fct.order_number = orders.order_number WHERE orders.store = ? AND fct.order_number=? AND ( last_update = 5 OR last_update = 6) ', [ $store,$order_number ]);

    

        $all_orders_numbers = $this->get_orders_numbers($store);
        return [
            $number_of_orders, $orders, $all_orders_numbers[0], $all_orders_numbers[1],
            $all_orders_numbers[2], $all_orders_numbers[3], $all_orders_numbers[4], $all_orders_numbers[5], $all_orders_numbers[6], $all_orders_numbers[7]
        ];
    } 
    
    public function fix_import()
    {
        set_time_limit(50000);
        $orders = DB::select('SELECT * FROM kshopina.orders where (status >= 0 AND status <2) and verified = 6 AND international_awb is not null and created_at > "2022-2-12";');

        foreach ($orders as $order) {

            DB::table('orders')->where("id", $order->id)->update(['status' => 2]);
        }
    }

    public function cancel_shopify($store, $order_number,$system)
    {
        $order_data = DB::table('orders')->where('order_number', $order_number)->get();
        $tags = "";
        $shopify_id = $order_data[0]->order_id;

        $shopify_token = DB::table('config')->where('keyy', $order_data[0]->store)->get()[0]->value;
        $store_url = DB::table('config')->where('keyy', $order_data[0]->store . '_url')->get()[0]->value;
        $store_myshopify_url = DB::table('config')->where('keyy', $order_data[0]->store . '_myshopify')->get()[0]->value;


        date_default_timezone_set('Asia/Seoul');
        $date = date('Y-m-d H:i:s', time());

        if ($system=='verification') {
            DB::table('orders')->where('order_number', $order_data[0]->order_number)->update(['verified' => 3, 'active' => 1]);
        } else {
            DB::table('orders')->where('order_number', $order_data[0]->order_number)->update([
                'status' => 6,'financial_status'=>"voided"]);
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
            $this->canceled_from_shopify($shopify_token,$store_myshopify_url,$shopify_id,$order_data[0]->old_status,$store);

            $transaction_id=$this->get_transaction_info($shopify_token,$store_myshopify_url,$shopify_id);
    
            if ($transaction_id[0]) {
                $this->mark_payment_voided($shopify_token,$store_myshopify_url,$shopify_id,$order_data[0]->total_price,$transaction_id[1]);
    
            } else {
                DB::insert('insert into errors (shipment_number,message,system_name) values (?,?,?)', [$order_number, $transaction_id[1], "Get transaction info for cancelation"]);
            }
        }

    }
    public function canceled_from_shopify($shopify_token, $store_myshopify_url,$order_id,$old_status,$store)
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

        if ($store=='origin') {
            if ($old_status < 2) {
                $body = ['reason' => "customer","restock"=>true];
            }else{
                $body = ['reason' => "customer","restock"=>false];
    
            }
        } else {
            $body = ['reason' => "customer","restock"=>true];
        }
        
        

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


        if ($transaction !=[] && isset($transaction[count($transaction)-1])&& $transaction[count($transaction)-1]->kind =='sale' ) {
           
            return [true,$transaction[count($transaction)-1]->admin_graphql_api_id];

        }else {
            return [false,"NOT SET!"];
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
                    DB::insert('insert into errors (shipment_number,message,system_name) values (?,?,?)', [$order_id, $URI_Response['data']['refundCreate']['userErrors'], "Mark payment voided for cancelation"]);
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
   
}

