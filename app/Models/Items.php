<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use GuzzleHttp\Client as guzzle;

class Items extends Model
{
    use HasFactory;

    function saveitem($store,$value, $order_number, $skutype)
    {

//problem
        foreach ($value as $k => $items) {

            /*            $skutype=substr($sku, -2);*/
            if ($skutype != "EG" && $skutype != "KW" && $skutype != "SA") {
                $countrycode = 'KR';
            } else {
                $countrycode = $skutype;
            }
            date_default_timezone_set('Asia/Seoul');
            $date = date('Y-m-d H:i:s', time());

            if (!$this->is_item_exist($store,$items->variant_id,$order_number)[0] ) {
                DB::table('items')->insert([
                    'order_id' => $order_number,
                    'country_code' => $countrycode,
                    'product_id' => $items->product_id,
                    'quantity' => $items->quantity,
                    'price' => $items->price,
                    'product_name' => $items->title,
                    'variant_id' => $items->variant_id,
                    'sku' => $items->sku,
                    'saved_at'=>$date,
                    'store'=>$store
                ]);
            }
            
        }
    }

    function is_item_exist($store,$variant_id,$order_number){

        $check = DB::select('SELECT * from items where order_id = ? AND variant_id = ? AND store = ?', [$order_number,$variant_id,$store]);

        if ($check == null || $check == []) {
            return [false, []];
        } else {
            return [true, $check];
        }
    }
    function getItems($order_number)
    {
        return DB::select('select * from items where order_id = ?', [$order_number]);
    }
    function getItems_with_total($order_number)
    {
        return DB::select('SELECT * from items inner join orders on orders.order_number = items.order_id where items.order_id = ?', [$order_number]);
    }
    
    function is_product_exist($product_id, $country)
    {

        if ($country == 'Egypt') {
            $country_code = 'EG';
        } else if ($country == 'Saudi Arabia') {
            $country_code = 'SA';
        } else {
            $country_code = 'KW';
        }

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
        $arr = explode(",", str_replace(' ', '', $product->tags));
        foreach ($arr as $key => $value) {
            if (substr($value, 0, 2) == $country_code) {
                return substr($value, 3);
            }
        }
        return null;
    }
    
    function duplicateProduct($title, $product_id)
    {

        $client = new guzzle([
            'headers' => [
                'Content-Type' => 'application/json',
                'X-Shopify-Access-Token' => '',
                'debug' => true
            ],
            "ssl"=>[
                "verify_peer"=>false,
                "verify_peer_name"=>false,
            ]
        ]);
        $URI = 'https://kshopina.myshopify.com/admin/api/2021-04/graphql.json';

        $body['query'] = 'mutation productDuplicate($includeImages: Boolean!,$productId: ID!, $newTitle: String!) {
            productDuplicate(includeImages: $includeImages,productId: $productId, newTitle: $newTitle) {
              imageJob {
                id
              }
              newProduct {
                id
              }
              shop {
                id
              }
              userErrors {
                field
                message
              }
            }
          }';

        $body['variables'] = array(
            "includeImages" => true,
            "productId" => "gid://shopify/Product/" . $product_id,
            "newTitle" => $title
        );


        $body = json_encode($body);
        $URI_Response = $client->request('POST', $URI, ['body' => $body]);
        $URI_Response = json_decode($URI_Response->getBody(), true);

        $full_id = $URI_Response['data']['productDuplicate']['newProduct']['id'];
        $arr = explode("/", $full_id);
        $id = end($arr);

        return $id;
    }
    function getProduct($product_id, $old_sku)
    {
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
        try {
            $data = file_get_contents($order, false, $context);

            $product = json_decode($data);

        } catch (\Throwable $th) {

            return ["NOT FOUND"];

        }
        
        $product = $product->product;
        $all_variants_id = [];
        $all_variants_sku = [];
        $all_variants_inventory = [];

        foreach ($product->variants as $key => $value) {

            if ($value->sku == $old_sku || substr($value->sku, 0, -2) == $old_sku) {
                $variant = $value->id;
                $inventory_item_id = $value->inventory_item_id;
            } else {
                array_push($all_variants_id, $value->id);
                array_push($all_variants_sku, $value->sku);
                array_push($all_variants_inventory, $value->inventory_item_id);
            }
        }

        return [$variant, $inventory_item_id, $all_variants_id, $all_variants_sku, $all_variants_inventory];
    }


    function changeSKU($old_sku, $variant_id, $country)
    {
        if ($country == 'Egypt') {
            $new_sku = $old_sku . 'EG';
        } else if ($country == 'Saudi Arabia') {
            $new_sku = $old_sku . 'SA';
        } else {
            $new_sku = $old_sku . 'KW';
        }



        $client = new guzzle([
            'headers' => [
                'Content-Type' => 'application/json',
                'X-Shopify-Access-Token' => '',
                'debug' => true
            ],
            "ssl"=>[
                "verify_peer"=>false,
                "verify_peer_name"=>false,
            ]
        ]);
        $URI = 'https://kshopina.myshopify.com/admin/api/2023-04/variants/' . $variant_id . '.json';

        $body = ["variant" => ['id' => $variant_id, 'sku' => $new_sku]];




        $body = json_encode($body);
        $URI_Response = $client->request('PUT', $URI, ['body' => $body]);
        $URI_Response = json_decode($URI_Response->getBody(), true);

        return $new_sku;
    }

    function get_inventory_locations($inventory_item_id)
    {
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

        $order = "https://kshopina.com/admin/api/2023-04/inventory_levels.json?inventory_item_ids=" . $inventory_item_id;
        // Open the file using the HTTP headers set above
        $data = file_get_contents($order, false, $context);

        $locations = json_decode($data);

        return $locations->inventory_levels;
    }
    function set_available($locations, $country, $quantity, $inventory_item_id)
    {
        $found = false;
        $country_code = 00000;
        if ($country == 'Egypt') {
            $country_code = 37280579672;
        } else if ($country == 'Saudi Arabia') {
            $country_code = 17064591448;
        } else {
            //kuwait
            $country_code = 37224579160;
        }

        $client = new guzzle([
            'headers' => [
                'Content-Type' => 'application/json',
                'X-Shopify-Access-Token' => '',
                'debug' => true
            ],
            "ssl"=>[
                "verify_peer"=>false,
                "verify_peer_name"=>false,
            ]
        ]);
        $URI = 'https://kshopina.myshopify.com/admin/api/2023-04/inventory_levels/set.json';

        foreach ($locations as $key => $value) {

            if ($value->location_id == $country_code) {
                $new_quantity = $quantity;
                $found = true;
            } else {
                $new_quantity = 0;
            }

            $body = [
                'location_id' => $value->location_id,
                'inventory_item_id' => $inventory_item_id,
                'available' => $new_quantity
            ];


            $body = json_encode($body);
            $URI_Response = $client->request('POST', $URI, ['body' => $body]);
        }

        if (!$found) {
            $body = [
                'location_id' => $country_code,
                'inventory_item_id' => $inventory_item_id,
                'available' => $quantity
            ];


            $body = json_encode($body);
            $URI_Response = $client->request('POST', $URI, ['body' => $body]);
        }

        return $URI_Response;
    }

    
    function adjust_available1($locations, $country, $quantity, $inventory_item_id)
    {
        $found = false;
        $country_code = 00000;
        if ($country == 'Egypt') {
            $country_code = 37280579672;
        } else if ($country == 'Saudi Arabia') {
            $country_code = 17064591448;
        } else {
            //kuwait
            $country_code = 37224579160;
        }

        $client = new guzzle([
            'headers' => [
                'Content-Type' => 'application/json',
                'X-Shopify-Access-Token' => '',
                'debug' => true
            ],
            "ssl"=>[
                "verify_peer"=>false,
                "verify_peer_name"=>false,
            ]
        ]);
        $URI = 'https://kshopina.myshopify.com/admin/api/2023-04/inventory_levels/adjust.json';

        foreach ($locations as $key => $value) {

            if ($value->location_id == $country_code) {
                $new_quantity = $quantity;
                $found = true;
                $body = [
                    'location_id' => $value->location_id,
                    'inventory_item_id' => $inventory_item_id,
                    'available_adjustment' => $new_quantity
                ];
                $body = json_encode($body);
                $URI_Response = $client->request('POST', $URI, ['body' => $body]);
            }
        }

        if (!$found) {
            $body = [
                'location_id' => $country_code,
                'inventory_item_id' => $inventory_item_id,
                'available_adjustment' => $quantity
            ];


            $body = json_encode($body);
            $URI_Response = $client->request('POST', $URI, ['body' => $body]);
        }

        return $URI_Response;
    }
    function add_tag($product_id,$dublicate_product_id,$country){

        if ($country == 'Egypt') {
            $tag = 'EG-';
        } else if ($country == 'Saudi Arabia') {
            $tag = 'SA-';
        } else {
            $tag = 'KW-';
        }

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

        $old_tags=$product->tags;

        $client = new guzzle([
            'headers' => [
                'Content-Type' => 'application/json',
                'X-Shopify-Access-Token' => '',
                'debug' => true
            ],
            "ssl"=>[
                "verify_peer"=>false,
                "verify_peer_name"=>false,
            ]
        ]);
        $URI = 'https://kshopina.myshopify.com/admin/api/2023-04/products/' . $product_id . '.json';

        $body = ["product" => ['id' => $product_id, 'tags' =>$old_tags .", ".$tag.$dublicate_product_id]];




        $body = json_encode($body);
        $URI_Response = $client->request('PUT', $URI, ['body' => $body]);
    }

    function delete_tag($product_id,$country){

        if ($country == 'Egypt') {
            $tag = 'EG';
        } else if ($country == 'Saudi Arabia') {
            $tag = 'SA';
        } else {
            $tag = 'KW';
        }

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

        $old_tags=$product->tags;


        $arr = explode(",", str_replace(' ', '', $old_tags));
        $new_tags="";
        foreach ($arr as $key => $value) {
            if (substr($value, 0, 2) != $tag) {
                $new_tags =$new_tags. $value.',';
            }
        }


        $client = new guzzle([
            'headers' => [
                'Content-Type' => 'application/json',
                'X-Shopify-Access-Token' => '',
                'debug' => true
            ],
            "ssl"=>[
                "verify_peer"=>false,
                "verify_peer_name"=>false,
            ]
        ]);
        $URI = 'https://kshopina.myshopify.com/admin/api/2023-04/products/' . $product_id . '.json';

        $body = ["product" => ['id' => $product_id, 'tags' =>$new_tags]];




        $body = json_encode($body);
        $URI_Response = $client->request('PUT', $URI, ['body' => $body]);
    }
}
