<?php

namespace App\Models;

use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use GuzzleHttp\Client as guzzle;

class TrackingUpdate extends Model
{
    use HasFactory;
    private $status = ['Verified' => 0, 'Fulfilled' => 1, 'Dispatched' => 2,'Kshopina_Warehouse' => 3, 'Delivery' => 4, 'Delivered' => 5, 'Refused' => 6];

    public function update_CUBESHIP_token()
    {
        $validate = $this->validate_CUBESHIP_token();

        if (!$validate) {

            $client = new guzzle([
                'headers' => [
                    'Content_Type' => 'application/x-www-form-urlencoded'
                ],
            ]);
            $URI = 'https://cube-shipperapi.dispatchex.com/GetAuthToken';
    
            $body = [
                "Username" => 'DPMLOGISTICS',
                'Password' =>'DPMLOGISTICS',
                'grant_type'=> 'password',
                'AccountNumber'=>'SH04'
            ];
    
            try {
                $URI_Response = $client->request('POST', $URI, ['form_params'=>$body]);
                $URI_Response = json_decode($URI_Response->getBody(), true);

                date_default_timezone_set('Africa/Cairo');

                DB::table('config')->where('keyy','cubeship_token')->update(['value'=>$URI_Response['access_token'],'update_date'=> date('Y-m-d H:i:s', time())]);
            } catch (\Throwable $th) {
    
                DB::insert('insert into errors (shipment_number, system_name, status, message) values (?,?,?,?)', ['update_CUBESHIP_token', 'API', 'ALERT', $th]);
    
            }
        }
        
        return DB::select('SELECT * from config where keyy = ?', ['cubeship_token'])[0]->value;
    }

    public function validate_CUBESHIP_token()
    {
        $cubeship_token= DB::select('SELECT * from config where keyy = ?', ['cubeship_token']);
        date_default_timezone_set('Africa/Cairo');

        if (count($cubeship_token) > 0) {

            $d1 = new DateTime(date('Y-m-d H:i:s', time())); 
            $d2= new DateTime(date($cubeship_token[0]->update_date));
            $interval= $d1->diff($d2); // get difference between two dates
            $hours =($interval->days * 24) + $interval->h;
            if ($hours > 22 ) {
                return false;
            }
            
        } else {
            DB::insert('INSERT into config (keyy) values (?)', ['cubeship_token']);
            return false;
        }

        return true;
        
    }

    public function get_kshopina_orders($shipping_company)
    {
        return DB::select('SELECT order_number as ref_number, domestic_awb as tracking_number, status as original_status,id,store,order_id as shopify_order_id FROM kshopina.orders where verified = ? AND  
                            international_awb is not null AND international_awb !="" AND domestic_awb is not null AND domestic_awb !="" and store = "origin" 
                            AND domestic_company = ? AND canceled_at is null AND status < ? 
                            UNION ALL

                            Select order_number as ref_number,international_awb as tracking_number, status as original_status,id,store,order_id as shopify_order_id FROM kshopina.orders where verified = ? AND
                            international_awb is not null AND international_awb !="" AND store != "origin"
                            AND domestic_company = ? AND canceled_at is null AND status < ?',[ 6, $shipping_company, 5, 6, $shipping_company, 5]);
    }
    public function get_kmex_orders($shipping_company)
    {
        return DB::select('SELECT shipment_id as ref_number,tracking_number,status as original_status FROM kmex.shipments where status < ? AND shipping_company = ?;', [ 6 , $shipping_company]);

    }
    public function get_pnp_orders($shipping_company)
    {
        return DB::select('SELECT pnp_number as ref_number,tracking_number,status as original_status FROM pnp.single_orders where status < ? AND tracking_company = ? ;', [ 6,$shipping_company]);
    }

    public function get_CUBESHIP_status($orders)
    {
        $cubeship_token =$this->update_CUBESHIP_token();

        $orders_status=[];

        $visible_reasons=[
            'Wrong Item'=>	'Delivery attempted - Consignee refused due to Wrong Item',
            'Bad Address'=>	'Delivery attempted - Incorrect Address',
            'Schedule for tomorrow'=>	'Delivery attempted - Consignee requested a schedule for tomorrow',
            'Location Changed'=>	'Delivery attempted - Consignee moved to new address',
            'Future Delivery'=>	'Delivery attempted - Consignee request future delivery',
            'Wrong Contact Number'=>	'Delivery attempted - Consignee incorrect phone number',
            'Mobile switched off'=>	'Delivery attempted - Consignee phone closed',
            'Mobile Not Answered'=>	'Delivery attempted - Consignee not answered',
            'No Response'=> 'Delivery attempted - Consignee not answered',
            'customer not Available'=>	'Delivery attempted - Consignee not available',
            'Cash not ready'=>	'Delivery attempted - Consignee refused due to Amount Not Ready',
            'Customer did not order'=>'Delivery attempted - Consignee did not order'
        ];

        $unvisible_reasons= [
            'Lost' =>'Delivery attempted - Piece Missing',
            'Shipment on hold'=> 'Shipment on hold',
            'Out of Service Area'=>'Delivery attempted - Out of Service Area',
            'Damaged'=>	'Delivery attempted - Consignee refused due to Damaged',
        ];

        foreach ($orders as $key => $order) {

            $client = new guzzle([
                'headers' => [
                    'Content_Type' => 'Application/json',
                    'Authorization' => 'bearer '.$cubeship_token
                ],
            ]);
            $URI = 'https://cube-shipperapi.dispatchex.com/api/order/ShipmentDetails';
    
            $body = [
                "TrackingNo" => $order->tracking_number
            ];
    
            try {
                $URI_Response = $client->request('POST', $URI, ['form_params'=>$body]);
                $URI_Response = json_decode($URI_Response->getBody(), true);
                $URI_Response = $URI_Response['data']['tracking_ShipmentStatusTracking'];
                
            } catch (\Throwable $th) {
    
                if ($th->getCode() == 401 || $th->getCode() == 403) {
                    $cubeship_token =$this->update_CUBESHIP_token();
                }
                DB::insert('insert into errors (shipment_number, system_name, status, message) values (?,?,?,?)', ['get_CUBESHIP_status', 'API', 'ALERT', $th]);
                continue;
            }

            // GET THE STATUS AND SORT IT

            $arrive=0;
            $query = [];
            $dates = [];
            $reason='';

            foreach ($URI_Response as $key => $record) {

                if (isset($record['trackingStatus_Name']) && ($record['trackingStatus_Name'] == 'Received at Hubs' || $record['trackingStatus_Name'] == 'Returned to Origin' || $record['trackingStatus_Name'] == 'Return to Origin' || $record['trackingStatus_Name'] == 'Shipment Return to Hub' )  && $arrive == 0 ) {
                    
                    $dates['in_warehouse_at'] = date("Y-m-d H:i:s", strtotime($record['createdOn']));

                    $query['status'] = $this->status['Kshopina_Warehouse'];
                    $query['in_warehouse_at'] = $dates['in_warehouse_at'];

                }elseif (isset($record['trackingStatus_Name']) && ($record['trackingStatus_Name'] == 'Out For Delivery' || $record['trackingStatus_Name'] == 'Out for delivery 1' || $record['trackingStatus_Name'] == 'Out for delivery 2' || $record['trackingStatus_Name'] == 'Out for delivery 3' || $record['trackingStatus_Name'] == 'In Transit' ) ) {

                    $dates['delivery_at'] = date("Y-m-d H:i:s", strtotime($record['createdOn']));

                    $query['status'] = $this->status['Delivery'];
                    $query['delivery_at'] = $dates['delivery_at'];

                } elseif (isset($record['trackingStatus_Name']) && $record['trackingStatus_Name'] == 'Delivered' ) {

                    $dates['delivered_at'] = date("Y-m-d H:i:s", strtotime($record['createdOn']));

                    $query['status'] = $this->status['Delivered'];
                    $query['delivered_at'] = $dates['delivered_at'];

                }elseif ( isset($record['trackingStatus_Name']) && ($record['trackingStatus_Name'] == 'Refunded' || $record['trackingStatus_Name'] == 'Cancelled' || $record['trackingStatus_Name'] == 'Shipper Cancelled' ) ) {
                    $arrive = 1;
                    
                    $dates['delivered_at'] = date("Y-m-d H:i:s", strtotime($record['createdOn']));
                    $query['status'] = $this->status['Refused'];
                    $query['delivered_at'] = $dates['delivered_at'];

                    $query['side_note'] = $record['trackingStatus_Name'];
                    $query['issue']=6;
                    $reason = $record['trackingStatus_Name'];

                }elseif( isset($record['trackingStatus_Name']) && isset($visible_reasons[$record['trackingStatus_Name']]) ){

                    $query['side_note'] = $visible_reasons[$record['trackingStatus_Name']];
                    $query['issue']=6;
                    $reason = $visible_reasons[$record['trackingStatus_Name']];
                }
                elseif( isset($record['trackingStatus_Name']) && isset($unvisible_reasons[$record['trackingStatus_Name']]) ){

                    $query['side_note'] =$unvisible_reasons[$record['trackingStatus_Name']];
                    $query['issue']=6;
                    $query['status'] = $order->original_status;
                    $reason = $unvisible_reasons[$record['trackingStatus_Name']];
                }
            }
            $orders_status[$order->ref_number]=['query'=>$query, 'dates'=>$dates, 'reason'=>$reason, 'order_data'=>$order];
        }
        
        
        return $orders_status;

    }


    public function update_kshopina_orders($orders_status,$shipping_company)
    {
        $tstModel = new \App\Models\tst();
        date_default_timezone_set('Africa/Cairo');
        $date = date('Y-m-d H:i:s', time());

        foreach ($orders_status as $order_number => $data) {
            
            if ($data['query'] != []) {

                if ($data['query']['status'] == $this->status['Refused']) {
    
                    if (!$tstModel->fct_is_exist($order_number)) {

                        $tstModel->insert_fct($order_number, $data['reason'], $date, 3,$data['order_data']->store);
                        if ($data['order_data']->store !='origin') {
                            $tstModel->replace_tag("#on_process", "#FCT", $data['order_data']->id, $data['order_data']->store);

                        }else{
                            $tstModel->replace_tag("#dispatched", "#FCT", $data['order_data']->id, $data['order_data']->store);
    
                        }
                        $tstModel->replace_tag("#Delivered", "", $data['order_data']->id, $data['order_data']->store);
                        $data['query']['old_status']=$data['order_data']->original_status;

                    }
                }elseif($data['query']['status'] == $this->status['Delivered']){
    
                    if ($data['order_data']->store !='origin') {
                        $tstModel->replace_tag("#on_process", "#Delivered", $data['order_data']->id, $data['order_data']->store);

                    }else{
                        $tstModel->replace_tag("#dispatched", "#Delivered", $data['order_data']->id, $data['order_data']->store);

                    }
                    $tstModel->mark_order_as_paid($data['order_data']->shopify_order_id,$data['order_data']->store);
                }
                
                if ( isset($data['query']['issue']) && $data['query']['issue'] >0 && $data['query']['status'] != $this->status['Refused']) {

                    if ($tstModel->fct_is_exist($order_number)) {
                        DB::table('fct')->where('order_number', $order_number)
                        ->update(['last_status'=>$data['reason'] , 'last_update' => $data['query']['status'], 'updated_at' => $date]);
                    }else{
                        if ($data['order_data']->store !='origin') {
                            $tstModel->replace_tag("#on_process", "#FCT", $data['order_data']->id, $data['order_data']->store);

                        }else{
                            $tstModel->replace_tag("#dispatched", "#FCT", $data['order_data']->id, $data['order_data']->store);
    
                        }
                        DB::insert('insert into fct (order_number, last_status,last_update,created_at,source,store) values (?,?, ?,?,?,?)', 
                        [$order_number, $data['reason'],$data['query']['status'], $date, 3,$data['order_data']->store]);
                    }
                }

                DB::table('orders')->where('id', $data['order_data']->id)->update($data['query']);

                
            }
            else {
                DB::table('errors')->insert(['shipment_number' => $data['order_data']->tracking_number, 'system_name' => $shipping_company.'_TRACKING_4', 'status' => 'Success', 'message' => "No data for ".$shipping_company." tracking number"]);
            }
        }
    }
    
}

