<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use GuzzleHttp\Client as guzzle;

class QRcode extends Model
{
    use HasFactory;

    function create_qr($order_number, $url)
    {
        $identifier = rand(64528, 9163037194);
        $identifier = "$order_number" . "$identifier";
        $new_url = $url . "?token=" . $identifier;

        date_default_timezone_set('Asia/Seoul');
        $date = date('Y-m-d H:i:s', time());

        DB::insert(
            'insert into qrcodes (identifier, order_number,status,url,created_at) values (?, ?, ?,?,?)',
            [$identifier, $order_number, 0, $new_url, $date]
        );
        return $identifier;
    }


    function isExist($order_number)
    {
        $check = DB::select('select * from qrcodes where order_number = ?', [$order_number]);
        if ($check == null || $check == []) {
            return [false, []];
        } else {
            return [true, $check];
        }
    }
    function getByIdentifier($identifier)
    {
        $check = DB::select('select * from qrcodes where identifier = ?', [$identifier]);
        return $check;
    }
    function checkStatus($identifier)
    {
        $check = DB::select('select * from qrcodes where identifier = ?', [$identifier]);

        foreach ($check as $key => $value) {
            if ($value->status == 0) {
                return true;
            } else {
                return false;
            }
        }
    }

    function delivered($order_id, $gateway)
    {

        if ($gateway) {
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
        }

    }
    function updateInternational($order_number, $changes)
    {
        DB::table('international')->where('order_number', $order_number)
            ->update($changes);
    }
    function close_QR($identifier)
    {

        /* $client = new guzzle([
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
        $URI = 'https://kshopina.com/admin/api/2021-01/orders/3813594169432/cancel.json';

        $body = [ "reason"=> "inventory"
            
        ];


        $body = json_encode($body);
        $URI_Response = $client->request('POST', $URI, ['body' => $body]);
        $URI_Response = json_decode($URI_Response->getBody(), true);
        return $URI_Response; */

        /* $header = array(
            'http' => array(
                'method' => "POST",
                'header' => "X-Shopify-Access-Token: "

            ),
            "ssl"=>array(
                "verify_peer"=>false,
                "verify_peer_name"=>false,
            )
        );

        $context = stream_context_create($header);

        $order = "https://kshopina.com/admin/api/2021-01/orders/".$order_id."/cancel.json";
        // Open the file using the HTTP headers set above
        $data = file_get_contents($order, false, $context); */

        date_default_timezone_set('Asia/Seoul');
        $date = date('Y-m-d H:i:s', time());

        DB::update('update qrcodes set status = 1 , updated_at = ? where identifier = ?', [$date, $identifier]);
    }
    function contact_support($old_status, $new_status, $country, $order_number)
    {
        $check = DB::select('select * from requests where order_number = ?', [$order_number]);

        date_default_timezone_set('Asia/Seoul');
        $date = date('Y-m-d H:i:s', time());

        if ($check == null || $check == []) {
            DB::insert(
                'insert into requests (order_number, change_to, change_from, country) values (?, ?, ?, ?)',
                [$order_number, $new_status, $old_status, $country]
            );
        } else {
            DB::update(
                'update requests set change_to = ? , change_from = ? , updated_at=? where order_number = ?',
                [$new_status, $old_status, $date, $order_number]
            );
        }
    }
    function support_change_status($order_number)
    {
        date_default_timezone_set('Asia/Seoul');
        $date = date('Y-m-d H:i:s', time());

        DB::table('requests')->where('order_number', $order_number)
            ->update(['change_status' => 1, 'updated_at' => $date]);
    }
    function count_requests()
    {
        $all_requests = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM kshopina.requests');
        $egypt = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM kshopina.requests where country = ?;', ["Egypt"]);
        $kuwait = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM kshopina.requests where country = ?;', ["Kuwait"]);
        $ksa = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM kshopina.requests where country = ?;', ["Saudi Arabia"]);

        $requests = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM kshopina.requests where change_status = ?;', [0]);

        return [$all_requests, $egypt, $kuwait, $ksa, $requests];
    }
}
