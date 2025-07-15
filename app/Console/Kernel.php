<?php

namespace App\Console;
use DateTime;
use GuzzleHttp\Client as guzzle;
use App\Models\tst;
use App\Mail\fvmReminderMail;
use App\Mail\svmReminderMail;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use SoapClient;
use SoapFault;
class Kernel extends ConsoleKernel
{
    private $status = ['Verified' => 0, 'Fulfilled' => 1, 'Dispatched' => 2,
     'Kshopina_Warehouse' => 3, 'Delivery' => 4, 'Delivered' => 5, 'Refused' => 6];
    private $created_at= ['origin' => "2022-2-12", 'plus_egypt' => '2022-6-24', 'plus_kuwait' => '2022-6-24', 'plus_ksa' => '2022-6-24','plus_uae'=>'2023-4-15'];
    private $countries=['United Arab Emirates'=>'UAE','Saudi Arabia'=>'KSA','Egypt'=>'EGY','Bahrain'=>'BH','Kuwait'=>'KWT', "Jordan"=> "JOR"];
    private $Naqel_keys=[];
    /**
     * Get the timezone that should be used by default for scheduled events.
     *
     * @return \DateTimeZone|string|null
     */
    protected function scheduleTimezone()
    {
        return 'Africa/Cairo';
    }

    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {

       /*  $orders=DB::select('SELECT * FROM orders where verified = ? AND ( 
            (international_awb is not null AND international_awb !="" AND store = ? AND created_at > ? ) OR 
            (domestic_awb is not null AND domestic_awb !="" AND store = ? AND (country = ? OR country = ? OR country = ?) AND created_at > ? ) OR
            (international_awb is not null AND international_awb !="" AND store = ? AND created_at > ? )
            ) AND domestic_company = ? AND canceled_at is null
        AND status < ? ;', 

        [ 6,"plus_ksa",$this->created_at["plus_ksa"],"origin",'Saudi Arabia','United Arab Emirates','Egypt',$this->created_at["origin"],
        "plus_egypt",$this->created_at["plus_egypt"], 'GLT',5 ]); */



        //Qatar --- Kuwait --- Bahrain --- Oman --- UAE
        $schedule->call(function () {
            
            // check RSA expiration date 

                date_default_timezone_set('UTC');
                $date = date('Y-m-d H:i:s', time());

                $rsa_expire_date  = DB::table('kshopina.config')->where('keyy', 'rsa_token')->get()[0]->expire_date;

                $datetime1 = strtotime($rsa_expire_date);
                $datetime2 = strtotime($date);

            // RSA Data update and return 

                if( (($datetime1 - $datetime2) / 60) < 30 ){
                    $this->update_rsa_token();
                }

            //

            $orders = DB::select('SELECT * FROM orders where verified = ? AND ( 
                (international_awb is not null AND international_awb !="" AND store = ? AND created_at > ? ) OR 
                (international_awb is not null AND international_awb !="" AND store = ? AND created_at > ? ) OR 
                (domestic_awb is not null AND domestic_awb !="" AND store = ? AND ( country = ? OR country = ? OR country = ? OR country = ?  OR country = ? ) AND created_at > ? )
                ) AND domestic_company = ? AND canceled_at is null AND status < ? ;', 
                [ 6,"plus_kuwait",$this->created_at["plus_kuwait"],"plus_uae",$this->created_at["plus_uae"],
                "origin","Bahrain","Kuwait" ,"Oman" ,"Qatar" ,'United Arab Emirates',$this->created_at["origin"], 'RSA',5 ]);
        
                
            foreach ($orders as $key => $order) {
                try {
               
                    if ($order->store =='origin') {
                        $this->update_RSA_status($order->domestic_awb ,$order->id , $order->order_number , $order->store , $order->order_id );
                    } else {
                        $this->update_RSA_status($order->international_awb , $order->id , $order->order_number , $order->store , $order->order_id);
                    }

                } catch (\Throwable $th) {
                    DB::table('errors')->insert(["shipment_number"=>$order->international_awb,'system_name' => 'RSA_1', 'status' => 'Fail', 'message' => $th]);
                }
            }
        
        })->hourly();

        // KSA ---- UAE ---- EGY

        $schedule->call(function () {
            
                /* $orders=DB::select('SELECT * FROM orders where verified = ? AND ( 
                    (international_awb is not null AND international_awb !="" AND store = ? AND created_at > ? ) OR 
                    (domestic_awb is not null AND domestic_awb !="" AND store = ? AND (country = ? OR country = ?) AND created_at > ? )
                    ) AND domestic_company = ? AND canceled_at is null
                AND status < ? ;', 
                [ 6,"plus_ksa",$this->created_at["plus_ksa"],"origin",'Saudi Arabia','United Arab Emirates',$this->created_at["origin"], 'GLT',5 ]); */
            
                $orders=DB::select('SELECT * FROM orders where verified = ? AND ( 
                    (international_awb is not null AND international_awb !="" AND store = ? AND created_at > ? ) OR 
                    (international_awb is not null AND international_awb !="" AND store = ? AND created_at > ? ) OR 
                    (international_awb is not null AND international_awb !="" AND store = ? AND created_at > ? ) OR
                    (domestic_awb is not null AND domestic_awb !="" AND store = ? AND (country = ? OR country = ? OR country = ?) AND created_at > ? )
                    ) AND domestic_company = ? AND canceled_at is null
                AND status < ? ;', 
        
                [ 6,"plus_ksa",$this->created_at["plus_ksa"],
                "plus_egypt",$this->created_at["plus_egypt"],
                "plus_uae",$this->created_at["plus_uae"],
                "origin",'Saudi Arabia','United Arab Emirates','Egypt',$this->created_at["origin"],'GLT',5 ]);

            foreach ($orders as $key => $order) {
                try {
                    if ($order->store =='origin') {
                        $this->update_GLT_status($order->domestic_awb,$order->id,$order->order_id,$this->countries[$order->country],$order->order_number,$order->store,$order->status);
                    } else {
                        $this->update_GLT_status($order->international_awb,$order->id,$order->order_id,$this->countries[$order->country],$order->order_number,$order->store,$order->status);
                    }
                } catch (\Throwable $th) {
                    DB::table('errors')->insert(["shipment_number"=>$order->international_awb,'system_name' => 'GLT_TRACKING_1', 'status' => 'Fail', 'message' => $th]);
                }
            }
            
        })->hourly();

        // EGYPT --- BAHRAIN --- KSA -- JORDAN

        $schedule->call(function () {

            $orders=DB::select('SELECT * FROM orders where verified = ? AND ( 
                (international_awb is not null AND international_awb !="" AND store = ? AND created_at > ? ) OR 
                (international_awb is not null AND international_awb !="" AND store = ? AND created_at > ? ) OR
                (domestic_awb is not null AND domestic_awb !="" AND store = ? AND (country = ? OR country = ? OR country = ? OR country = ? ) AND created_at > ? )
                ) AND domestic_company = ? AND canceled_at is null
            AND status < ? ;', 
            [ 6,"plus_egypt",$this->created_at["plus_egypt"],"plus_ksa",$this->created_at["plus_ksa"],
            "origin",'Egypt','Saudi Arabia','Bahrain','Jordan',$this->created_at["origin"], 'SMSA',5 ]);
        
            foreach ($orders as $key => $order) {
                try {

                    if ($order->store =='origin') {
                        $this->update_SMSA_status($order->domestic_awb,$order->id,$order->order_id,$this->countries[$order->country],$order->order_number,$order->store,$order->status);
                    } else {
                        $this->update_SMSA_status($order->international_awb,$order->id,$order->order_id,$this->countries[$order->country],$order->order_number,$order->store,$order->status);
                    }
                    
                } catch (\Throwable $th) {
                    DB::table('errors')->insert(["shipment_number"=>$order->international_awb,'system_name' => 'SMSA_TRACKING_1', 'status' => 'Fail', 'message' => $th]);
                }
        }
        
        })->hourly();

        //KUWAIT ---  KSA (SHIPA)
        $schedule->call(function () {
            
            $orders=DB::select('SELECT * FROM orders where verified = ? AND ( 
                (international_awb is not null AND international_awb !="" AND store = ? AND created_at > ? ) OR 
                (international_awb is not null AND international_awb !="" AND store = ? AND created_at > ? ) OR 
                (domestic_awb is not null AND domestic_awb !="" AND store = ? AND  ( country = ? || country =? ) 
                AND created_at > ? ) ) AND domestic_company = ? AND canceled_at is null
            AND status < ? ', 
            [ 6,"plus_kuwait",$this->created_at["plus_kuwait"],"plus_ksa",$this->created_at["plus_ksa"],
            "origin",'Kuwait','Saudi Arabia',$this->created_at["origin"], 'SHIPA',5 ]);
        

            foreach ($orders as $key => $order) {
                try {

                    if ($order->store =='origin') {
                        $this->update_SHIPA_status($order->domestic_awb,$order->id,$order->order_id,$this->countries[$order->country],$order->order_number,$order->store,$order->status);
                    } else {
                        $this->update_SHIPA_status($order->international_awb,$order->id,$order->order_id,$this->countries[$order->country],$order->order_number,$order->store,$order->status);
                    }
                    
                } catch (\Throwable $th) {
                    DB::table('errors')->insert(["shipment_number"=>$order->international_awb,'system_name' => 'SHIPA_TRACKING_1', 'status' => 'Fail', 'message' => $th]);
                }
        }
        })->hourly();


        //NAQEL
        $schedule->call(function () {
            
            $orders=DB::select('SELECT * FROM orders where verified = ? AND 
                ( (international_awb is not null AND international_awb !="" AND domestic_awb is not null AND domestic_awb !="" and store = "origin" ) OR 
				(international_awb is not null AND international_awb !="" AND store != "origin" ) ) AND domestic_company = ? 
                AND canceled_at is null AND status < ? ;', 
    
            [ 6,'NAQEL',5 ]);
        

            foreach ($orders as $key => $order) {
                try {

                    if ($order->store =='origin') {
                        $this->update_NAQEL_status($order->domestic_awb,$order->id,$order->order_id,$order->country,$order->order_number,$order->store,$order->status);
                    } else {
                        $this->update_NAQEL_status($order->international_awb,$order->id,$order->order_id,$order->country,$order->order_number,$order->store,$order->status);
                    }
                    
                } catch (\Throwable $th) {
                    DB::table('errors')->insert(["shipment_number"=>$order->international_awb,'system_name' => 'NAQEL_TRACKING_0', 'status' => 'Fail', 'message' => $th]);
                }
        }
        
        })->hourlyAt(30);


        //FVM REMINDER
        $schedule->call(function () {
            
            $start_date = new DateTime(date('Y-m-d H:i:s', time())); // For today/now, don't pass an arg.
            $end_date = new DateTime(date('Y-m-d H:i:s', time()));

            $end_date->modify("-4 day");
            $start_date->modify("-3 day");
            $new_date= $start_date->format("Y-m-d H:i:s");

            
            $orders=DB::select('SELECT * FROM kshopina.orders WHERE send_fvm_at < ? and send_fvm_at > ? and fvm_replay_at is null and verified < 6 and verified != 3;',[$new_date,$end_date]);
    
            foreach ($orders as $key => $order) {
                try {

                    /* $data1 = [
                        'order_number' => $order->order_number,
                        ];
            
                    Mail::to($order->email)->send(new fvmReminderMail($data1), function ($message) {
                        $message->subject("fvm reminder");
                        }); */
            
                   /*  $whatsModel = new \App\Models\WhatsApp();

                    $whatsModel->whatsapp_send_fvm_reminder_message($order->phone_number,$order->country,$order->order_number); */

                    DB::table('errors')->insert(["shipment_number"=>$order->order_number,'system_name' => 'Fvm_Reminder', 'status' => 'success']);

                } catch (\Throwable $th) {
                    DB::table('errors')->insert(["shipment_number"=>$order->order_number,'system_name' => 'Fvm_Reminder', 'status' => 'Fail', 'message' => $th]);
                }
        }
        
        })->dailyAt('14:00');

        //SVM REMINDER
        $schedule->call(function () {
            $start_date = new DateTime(date('Y-m-d H:i:s', time())); // For today/now, don't pass an arg.
            $end_date = new DateTime(date('Y-m-d H:i:s', time()));

            $end_date->modify("-4 day");
            $start_date->modify("-3 day");
            $new_date= $start_date->format("Y-m-d H:i:s");

            $orders=DB::select('SELECT * FROM kshopina.orders  WHERE send_svm_at < ? and send_svm_at > ? and (info_edited_at is null ) and verified < 6 and verified != 3;', [ $new_date,$end_date]);
        

            foreach ($orders as $key => $order) {
                try {

                    /* $data1 = [
                        'order_number' => $order->order_number,
                        ];
            
                    Mail::to($order->email)->send(new svmReminderMail($data1), function ($message) {
                        $message->subject("svm reminder");
                        }); */

                   /*  $whatsModel = new \App\Models\WhatsApp();

                    $whatsModel->whatsapp_send_svm_reminder_message($order->phone_number,$order->country,$order->order_number); */

                    DB::table('errors')->insert(["shipment_number"=>$order->order_number,'system_name' => 'Svm_Reminder', 'status' => 'success']);

                } catch (\Throwable $th) {
                    DB::table('errors')->insert(["shipment_number"=>$order->order_number,'system_name' => 'Svm_Reminder', 'status' => 'Fail', 'message' => $th]);
                }
        }
        
        })->dailyAt('14:00');
       
        // $schedule->command('inspire')->hourly();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }

    protected function update_GLT_status($tracking_number,$id, $order_id,$country,$order_number,$store,$old_status)
    {
        $keys=['KSA'=>"a3Nob3BpbmE6YXNkZjEyMzQ=",'UAE'=>"S1NIT1BJTkFVQUU6S1NIT1BJTkExMjM=",'EGY'=>'a3Nob3A6YXNkMTIz', "KSA_TEST"=>"a3Nob3BpbmF0ZXN0OnF3ZTMyMWFzZA=="];

        $reasons=['no answer'=>'Send us an alternative number on ( +02 01102282260 ) via WhatsApp' ,
                'reschedule'=>'Please confirm your rescheduled date on ( +02 01102282260 ) via WhatsApp',
                'change address'=>'Please send us your new address on ( +02 01102282260 ) via WhatsApp',
                'cash issue'=> 'Please contact us on ( +02 01102282260 ) via WhatsApp',
                'wrong number'=> 'Please send us your correct number ( +02 01102282260 ) via WhatsApp'];

        date_default_timezone_set('Asia/Riyadh');
        $date = date('Y-m-d', time());

        $client = new guzzle([
            'headers' => [
                'Authorization' => 'Basic '.$keys[$country],
                'Content-Type' => 'application/json',
            ],
        ]);
        $URI = 'https://api.gltmena.com/api/order/check/statuses?timezone=Asia/Riyadh&from=2022-03-1&to='.$date;

        $body = [
            "id" => $tracking_number,
        ];

        $body = json_encode($body);
        try {
            $URI_Response = $client->request('POST', $URI, ['body' => $body]);
            $URI_Response = json_decode($URI_Response->getBody(), true);
        } catch (\Throwable $th) {

            DB::table('errors')->insert(['shipment_number' => $id, 'system_name' => 'GLT_TRACKING_2', 'status' => 'Fail', 'message' => $th->getMessage()]);
            return (['response' => 'fail', 'message' => $th->getMessage()]);

        }


        $tstModel=new tst();
        $hub = 0;
        $ready = 0;
        $arrive = 0;
        $status = 0;
        $query = [];
        $dates = [];
        $reason = "Cancelled by customer!";

            if ($URI_Response['status'] == 'success') {
                if (isset($URI_Response['data']['orders']) && count($URI_Response['data']['orders']) != 0) {

                    $URI_Response = $URI_Response['data']['orders'];

                    foreach ($URI_Response as $key => $value) {
                        if ($value['id'] == $tracking_number) {

                            foreach ($value['events'] as $key => $record) {
    
                                if (($record['status'] == 'RECEIVED_IN_HUB' || $record['status'] == 'PICKED')  /* && $hub == 0 */ ) {

                                        if ($arrive == 0) {
                                            /* $hub = 1; */
            
                                            $status = $this->status['Kshopina_Warehouse'];
                                            $dates['in_warehouse_at'] = date("Y-m-d H:i:s", strtotime($record['createdAt']));
                    
                                            $query['status'] = $status;
                                            $query['in_warehouse_at'] = $dates['in_warehouse_at'];

                                        } else {
                                            /* $hub = 1; */

                                            $dates['in_warehouse_at'] = date("Y-m-d H:i:s", strtotime($record['createdAt']));        
                                            $query['in_warehouse_at'] = $dates['in_warehouse_at'];
                                            
                                        }

                                } elseif ($record['status'] == 'RETURN_TO_HUB' ) {

                                    $status = $this->status['Kshopina_Warehouse'];
                                    $dates['in_warehouse_at'] = date("Y-m-d H:i:s", strtotime($record['createdAt']));
            
                                    $query['status'] = $status;
                                    $query['in_warehouse_at'] = $dates['in_warehouse_at'];
            
                                }elseif ($record['status'] == 'OUT_FOR_DELIVERY' /* && $ready == 0 */) {
                                    /* $ready = 1; */
                                    
                                    $status = $this->status['Delivery'];
                                    $dates['delivery_at'] = date("Y-m-d H:i:s", strtotime($record['createdAt']));
            
                                    $query['status'] = $status;
                                    $query['delivery_at'] = $dates['delivery_at'];
            
                                } elseif ($record['status'] == 'DELIVERED' ) {

                                    $arrive = 1;
            
                                    $status = $this->status['Delivered'];
                                    $dates['delivered_at'] = date("Y-m-d H:i:s", strtotime($record['createdAt']));
            
                                    $query['status'] = $status;
                                    $query['delivered_at'] = $dates['delivered_at'];
            
                                } elseif ($record['status'] == 'NOT_DELIVERED' /* || $record['status'] == 'RETURN_TO_CLIENT' */ ) {
                                    $arrive = 1;
            
                                    /* $status = $this->status['Refused']; */
                                    $dates['delivered_at'] = date("Y-m-d H:i:s", strtotime($record['createdAt']));
            
                                    /* $query['status'] = $status; */
                                    $query['delivered_at'] = $dates['delivered_at'];
                                    if (isset($record['reason'])) {

                                        if(str_contains(strtolower($record['reason']),strtolower('No answer')) ){
                                            $query['side_note']=$reasons['no answer'];
                                            $query['issue']=1;
                                        }
                                        elseif(str_contains(strtolower($record['reason']),strtolower('Reschedule')) ){
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
                                            $status = $this->status['Refused'];
                                            $query['side_note']=$record['reason'];
                                            $query['issue']=6;
                                            $query['status'] = $status;
                                        }else{
                                            $query['side_note']=$record['reason'];
                                            $query['issue']=6;
                                        }
                                        
                                        $reason = $record['reason'];
                                    }
                                    
                                } 
                              
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
                            $query['old_status']=$old_status;

                        }elseif($query['status'] == $this->status['Delivered']){

                            if ($store !='origin') {
                                $tstModel->replace_tag("#on_process", "#Delivered", $id, $store);

                            }else{
                                $tstModel->replace_tag("#dispatched", "#Delivered", $id, $store);
        
                            }
                            $tstModel->mark_order_as_paid($order_id,$store);
                        }
                        
                        if ( isset($query['issue']) && $query['issue'] >0 && $query['status'] != $this->status['Refused'] ) {

                            if ($tstModel->fct_is_exist($order_number)) {
                                DB::table('fct')->where('order_number', $order_number)
                                ->update(['last_status'=>$reason , 'last_update' => $query['status'], 'updated_at' => $date]);
                            }else{
                                DB::insert('insert into fct (order_number, last_status,last_update,created_at,source,store) values (?,?, ?,?,?,?)', 
                                [$order_number, $reason,$query['status'], $date, 3,$store]);

                            }
                            
                        }

                        DB::table('orders')->where('id', $id)->update($query);
                        
                        return (['response' => 'success', 'status' => $status, 'dates' => $dates]);
                    }

                } else {
                    DB::table('errors')->insert(['shipment_number' => $tracking_number, 'system_name' => 'GLT_TRACKING_3', 'status' => $URI_Response['status'], 'message' => "Can not find the GLT tracking number"]);
                }
                
            } else {
                DB::table('errors')->insert(['shipment_number' => $tracking_number, 'system_name' => 'GLT_TRACKING_4', 'status' => $URI_Response['status'], 'message' => $URI_Response['message']]);
                return (['response' => 'fail', 'message' => $URI_Response['message']]);
            }
        
    }
    
    protected function update_SMSA_status($tracking_number,$id, $order_id,$country,$order_number,$store,$old_status)
    {
        /* "Dpm@6689    " */
        $keys=['EGY'=>"Dpm@6689",'BH'=>"Ppc$7888" , 'KSA' => "Ppc$7888" , "JOR" => "Ppc$7888"];

        date_default_timezone_set('Africa/Cairo');
        $date = date('Y-m-d H:i:s', time());

        $client = new guzzle([
            'headers' => [
                'Content-Type' => 'application/json',
            ],
        ]);

        $URI = 'https://track.smsaexpress.com/SecomRestWebApi/api/getTracking?awbNo='.$tracking_number.'&passkey='.$keys[$country];

        try {
            $URI_Response = $client->request('GET', $URI);
            $URI_Response = json_decode($URI_Response->getBody(), true);

        } catch (\Throwable $th) {

            DB::table('errors')->insert(['shipment_number' => $id, 'system_name' => 'SMSA_TRACKING_2', 'status' => 'Fail', 'message' => $th->getMessage()]);
            return (['response' => 'fail', 'message' => $th->getMessage()]);

        }
        $tstModel=new tst();
        $hub = 0;
        $ready = 0;
        $status = 0;
        $query = [];
        $dates = [];

        if (isset($URI_Response['Tracking'])) {
            $new_array=array_reverse($URI_Response['Tracking']);

            foreach ($new_array as  $record) {

                if (($record['Activity'] == 'DATA RECEIVED' || $record['Activity'] == 'PICKED UP')  && $hub == 0 && $country=='EGY') {
                    $hub = 1;

                    $status = $this->status['Kshopina_Warehouse'];
                    $dates['in_warehouse_at'] = date("Y-m-d H:i:s", strtotime($record['Date']));

                    $query['status'] = $status;
                    $query['in_warehouse_at'] = $dates['in_warehouse_at'];

                } elseif (($record['Activity'] == 'AT SMSA FACILITY' || $record['Activity'] == 'ARRIVED HUB FACILITY')  && $hub == 0 &&  ( $country == 'BH' ||  $country == 'KSA' ||  $country == 'JOR' ) ) {
                    $hub = 1;

                    $status = $this->status['Kshopina_Warehouse'];
                    $dates['in_warehouse_at'] = date("Y-m-d H:i:s", strtotime($record['Date']));

                    $query['status'] = $status;
                    $query['in_warehouse_at'] = $dates['in_warehouse_at'];

                } elseif (($record['Activity'] == 'DEPARTED HUB FACILITY' || $record['Activity'] == 'OUT FOR DELIVERY') && $ready == 0) {
                    $ready = 1;

                    $status = $this->status['Delivery'];
                    $dates['delivery_at'] = date("Y-m-d H:i:s", strtotime($record['Date']));

                    $query['status'] = $status;
                    $query['delivery_at'] = $dates['delivery_at'];

                } elseif ($record['Activity'] == 'PROOF OF DELIVERY CAPTURED' ) {

                    $status = $this->status['Delivered'];
                    $dates['delivered_at'] = date("Y-m-d H:i:s", strtotime($record['Date']));

                    $query['status'] = $status;
                    $query['delivered_at'] = $dates['delivered_at'];

                }elseif (($record['Activity'] == 'SHIPMENT REFUSE BY RECIPIENT' || $record['Activity'] == 'RETURNED TO CLIENT' || $record['Activity'] == 'RETURNED TO SHIPPER') && $status != $this->status['Refused']) {
                    $arrive = 1;

                    $status = $this->status['Refused'];
                    $dates['delivered_at'] = date("Y-m-d H:i:s", strtotime($record['Date']));

                    $query['status'] = $status;
                    $query['delivered_at'] = $dates['delivered_at'];

                } 
            }

            if ($query != []) {

                if ($query['status']==$this->status['Refused']) {
    
                    if (!$tstModel->fct_is_exist($order_number)) {
                        $tstModel->insert_fct($order_number, "Cancelled by customer!", $date, 3,$store);
                        if ($store !='origin') {
                            $tstModel->replace_tag("#on_process", "#FCT", $id, $store);

                        }else{
                            $tstModel->replace_tag("#dispatched", "#FCT", $id, $store);
    
                        }
                        $tstModel->replace_tag("#Delivered", "", $id, $store);
                        $query['old_status']=$old_status;

                    }
                }elseif($query['status'] == $this->status['Delivered']){
                    if ($store !='origin') {
                        $tstModel->replace_tag("#on_process", "#Delivered", $id, $store);

                    }else{
                        $tstModel->replace_tag("#dispatched", "#Delivered", $id, $store);

                    }
                    $tstModel->mark_order_as_paid($order_id,$store);
                }
    
                DB::table('orders')->where('id', $id)->update($query);
    
                return (['response' => 'success', 'status' => $status, 'dates' => $dates]);
                
            }
            else {
                DB::table('errors')->insert(['shipment_number' => $tracking_number, 'system_name' => 'SMSA_TRACKING_4', 'status' => 'Success', 'message' => "No data for SMSA tracking number"]);
            }
        }
        else {
            DB::table('errors')->insert(['shipment_number' => $tracking_number, 'system_name' => 'SMSA_TRACKING_3', 'status' => 'Fail', 'message' => "Wrong SMSA tracking number"]);
        }
            
        
        
    }

    protected function update_SHIPA_status($tracking_number,$id, $order_id,$country,$order_number,$store,$old_status)
    {
        $keys=['KWT'=>"VR5SKO8wz7plviLIfJRpkNGFQQ3agIND" , 'KSA' => "hwv42StVKYizJGEXkAPUWYyd3KE0dIiu"];
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
        $URI = 'https://api.shipadelivery.com/v2/orders/'.$tracking_number.'/story?apikey='.$keys[$country];

        try {
            $URI_Response = $client->request('GET', $URI);
            $URI_Response = json_decode($URI_Response->getBody(), true);

        } catch (\Throwable $th) {

            DB::table('errors')->insert(['shipment_number' => $id, 'system_name' => 'SHIPA_TRACKING_2', 'status' => 'Fail', 'message' => $th->getMessage()]);
            return (['response' => 'fail', 'message' => $th->getMessage()]);

        }
        $tstModel=new tst();
        $hub = 0;
        $ready = 0;
        $arrive=0;
        $status = 0;
        $query = [];
        $dates = [];
        $reason="Cancelled by customer!";

        if (!isset($URI_Response['message'])) {

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

                }elseif ($record['statusCode'] == 26 || $record['statusCode'] == 10 /* || $record['statusCode'] == 23 */ ) {
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
                        
                        $reason = $record['details']['failReason'];
                    }
                }
            }

            if ($query != []) {

                if ($query['status'] == $this->status['Refused']) {
    
                    if (!$tstModel->fct_is_exist($order_number)) {
                        $tstModel->insert_fct($order_number, $reason, $date, 3,$store);
                        if ($store !='origin') {
                            $tstModel->replace_tag("#on_process", "#FCT", $id, $store);

                        }else{
                            $tstModel->replace_tag("#dispatched", "#FCT", $id, $store);
    
                        }
                        $tstModel->replace_tag("#Delivered", "", $id, $store);
                        $query['old_status']=$old_status;

                    }
                }elseif($query['status'] == $this->status['Delivered']){
    
                    if ($store !='origin') {
                        $tstModel->replace_tag("#on_process", "#Delivered", $id, $store);

                    }else{
                        $tstModel->replace_tag("#dispatched", "#Delivered", $id, $store);

                    }
                    $tstModel->mark_order_as_paid($order_id,$store);
                }
                
                if ( isset($query['issue']) && $query['issue'] >0 && $query['status'] != $this->status['Refused']) {

                    if ($tstModel->fct_is_exist($order_number)) {
                        DB::table('fct')->where('order_number', $order_number)
                        ->update(['last_status'=>$reason , 'last_update' => $query['status'], 'updated_at' => $date]);
                    }else{
                        DB::insert('insert into fct (order_number, last_status,last_update,created_at,source,store) values (?,?, ?,?,?,?)', 
                        [$order_number, $reason,$query['status'], $date, 3,$store]);

                    }
                    
                }
    
                DB::table('orders')->where('id', $id)->update($query);
    
                return (['response' => 'success', 'status' => $status, 'dates' => $dates]);
                
            }
            else {
                DB::table('errors')->insert(['shipment_number' => $tracking_number, 'system_name' => 'SHIPA_TRACKING_4', 'status' => 'Success', 'message' => "No data for SHIPA tracking number"]);
            }
        }
        else {
            DB::table('errors')->insert(['shipment_number' => $tracking_number, 'system_name' => 'SHIPA_TRACKING_3', 'status' => 'Fail', 'message' => $URI_Response['message'] ]);
        }
            
    }  

    protected function update_RSA_status($rsa_tracking_number , $id , $order_number , $store , $order_id){
        

        $reasons=['no answer'=>'Send us an alternative number on ( +02 01102282260 ) via WhatsApp' ,
                'reschedule'=>'Please confirm your rescheduled date on ( +02 01102282260 ) via WhatsApp',
                'change address'=>'Please send us your new address on ( +02 01102282260 ) via WhatsApp',
                'cash issue'=> 'Please contact us on ( +02 01102282260 ) via WhatsApp',
                'wrong number'=> 'Please send us your correct number ( +02 01102282260 ) via WhatsApp'];

        
        date_default_timezone_set('Africa/Cairo');
        $date = date('Y-m-d', time());

        $rsa_url  = DB::table('config')->where('keyy', 'rsa_url')->get()[0]->value;
        $subscription_key = DB::table('config')->where('keyy', 'Ocp-apim-subscription-key')->get()[0]->value;
        $rsa_token  = DB::table('config')->where('keyy', 'rsa_token')->get()[0]->value;
      

        $client = new guzzle([
            'headers' => [
                'Content-type' => 'application/json',
                'Ocp-apim-subscription-key' => $subscription_key,
                'Authorization' => 'Bearer '.$rsa_token,    
                'Accept'        => 'application/json',
            ]
        ]);

        $URI = $rsa_url . '/api/client/tracking-details/'. $rsa_tracking_number;

        try {
            $URI_Response = $client->request('GET', $URI);
            $URI_Response = json_decode($URI_Response->getBody(), true);
        } catch (\GuzzleHttp\Exception\BadResponseException $th) {

            $response = $th->getResponse();
            $responseBodyAsString = $response->getBody()->getContents();
            $URI_Response = json_decode($responseBodyAsString, true);
          
            if ( ($URI_Response["errors"][0] == "Token has expired.") ||  ($URI_Response["errors"][0] == "Token is invalidated.") ) {
                $this->update_rsa_token();

                DB::table('errors')->insert(['shipment_number' => $rsa_tracking_number , 'system_name' => 'RSA_2', 'status' => 'Fail', 'message' => $URI_Response["errors"][0]]);
                return (['response' => 'fail', 'message' => $URI_Response]);
            }
        }

        /* try {
            $URI_Response = $client->request('GET', $URI);
            $URI_Response = json_decode($URI_Response->getBody(), true);

        } catch (\Throwable $th) {
            DB::table('errors')->insert(['shipment_number' => $rsa_tracking_number , 'system_name' => 'RSA_2', 'status' => 'Fail', 'message' => $th->getMessage()]);
            return (['response' => 'fail', 'message' => $th->getMessage()]);
        } */
        

        $tstModel=new tst();
        $query = [];
        $dates = [];
        $reason = "Cancelled by customer!";

        if ($URI_Response['result'] == "success") {
            
            if (isset($URI_Response['data']) && count($URI_Response['data']) != 0){

                if ( $URI_Response['data']['tracking_no'] == $rsa_tracking_number ) {

                    if ( isset( $URI_Response['data']['events']) && count($URI_Response['data']['events'] ) != 0) {

                        $records=array_reverse($URI_Response['data']['events']);

                        foreach ($records as $key => $record) {

                            if ( ( $record['event_status'] == 'SHIPMENT_AT_SORT_FACILITY' || $record['event_status'] == 'RETURN_TO_FACILITY' ) ) {
    
                                $status = $this->status['Kshopina_Warehouse'];
                                $dates['in_warehouse_at'] = date("Y-m-d H:i:s", strtotime($record['on']));
        
                                $query['status'] = $status;
                                $query['in_warehouse_at'] = $dates['in_warehouse_at'];
        
                            } else if ( ( $record['event_status'] == 'OUT_FOR_DELIVERY' ) ){ 

                                $status = $this->status['Delivery'];
                                $dates['delivery_at'] = date("Y-m-d H:i:s", strtotime($record['on']));
        
                                $query['status'] = $status;
                                $query['delivery_at'] = $dates['delivery_at'];

                            }else if ( $record['event_status'] == 'DELIVERED' ){

                                $status = $this->status['Delivered'];
                                $dates['delivered_at'] = date("Y-m-d H:i:s", strtotime($record['on']));
        
                                $query['status'] = $status;
                                $query['delivered_at'] = $dates['delivered_at'];

                            }else if ( ( $record['event_status'] == 'DELIVERY_FAILED' ||  $record['event_status'] == 'REFUSED_SHIPMENT' || 

                                        $record['event_status'] == 'DELIVERY_RESCHEDULED' || 
                                        $record['event_status'] == 'NO_RESPONSE'  || 
                                        $record['event_status'] == 'CHANGE_OF_LOCATION'  ||  $record['event_status'] == 'ADDRESS_NEEDED'  ||
                                        $record['event_status'] == 'COD_UNAVAILABLE'  || 
                                        $record['event_status'] == 'WRONG_INFO'  ||

                                        $record['event_status'] == 'CONSIGNEE_NOT_AVAILABLE'  || 
                                        ( $record['event_status'] == 'DELIVERY_ATTEMPT' && $record['comments'] == 'Undelivered' ) 

                                    )){
                                            
                                $dates['delivered_at'] = date("Y-m-d H:i:s", strtotime($record['on']));
                                $query['delivered_at'] = $dates['delivered_at'];
    
                                if ($record['event_status'] == 'NO_RESPONSE' ) {

                                    $query['side_note']=$reasons['no answer'];
                                    $query['issue']=1;
                                    $reason = 'no answer';
                                    
                                }else if ($record['event_status'] == 'DELIVERY_RESCHEDULED' ) {

                                    $query['side_note']=$reasons['reschedule'];
                                    $query['issue']=2;
                                    $reason = $record['comments'];

                                } else if (  $record['event_status'] == 'CHANGE_OF_LOCATION'  ||  $record['event_status'] == 'ADDRESS_NEEDED' ){

                                    $query['side_note']=$reasons['change address'];
                                    $query['issue']=3;
                                    $reason = 'address information issue';

                                }else if (  $record['event_status'] == 'COD_UNAVAILABLE' ){

                                    $query['side_note']=$reasons['cash issue'];
                                    $query['issue']=4;
                                    $reason = 'cash issue';
                                    
                                }else if (  $record['event_status'] == 'WRONG_INFO' ){

                                    $query['side_note']=$reasons['wrong number'];
                                    $query['issue']=5;
                                    $reason = 'wrong information issue';
                                    
                                }else if (  $record['event_status'] == 'DELIVERY_FAILED' ||  $record['event_status'] == 'REFUSED_SHIPMENT' ){

                                    $query['side_note']= $reason;
                                    $query['issue']=6;
                                    $status = $this->status['Refused'];
                                    $query['status'] = $status;
                                    
                                }else{

                                    $query['side_note']=$reason;
                                    $query['issue']=6;

                                }
                                
                            }
                            
                        }

                        if (count($query) != 0) {
                            
                            if ( $query['status'] == $this->status['Refused']) { 
                               
                                $tstModel->send_to_fct($order_number,$reason , $date, 3,$store);
                                if ($store !='origin') {
                                    $tstModel->replace_tag("#on_process", "#FCT", $id, $store);
                                }else{
                                    $tstModel->replace_tag("#dispatched", "#FCT", $id, $store);
                                }

                                $tstModel->replace_tag("#Delivered", "", $id, $store);
                                
                            } else if ($query['status'] == $this->status['Delivered']){
                               
                                if ($store !='origin') {
                                    $tstModel->replace_tag("#on_process", "#Delivered", $id, $store);
    
                                }else{
                                    $tstModel->replace_tag("#dispatched", "#Delivered", $id, $store);
            
                                }
                                $tstModel->mark_order_as_paid($order_id,$store);
                            }

                            if ( isset($query['issue']) && $query['issue'] > 0 && $query['status'] != $this->status['Refused'] ) {

                                if ($tstModel->fct_is_exist($order_number)) {

                                    DB::table('fct')->where('order_number', $order_number)
                                    ->update(['last_status'=>$reason , 'last_update' => $query['status'], 'updated_at' => $date]);

                                }else{

                                    DB::insert('insert into fct (order_number,last_status,last_update,created_at,source,store) values (?,?, ?,?,?,?)', 
                                    [$order_number , $reason , $query['status'] , $date, 3 , $store]);
    
                                }
                                
                            }
                            
                            DB::table('orders')->where('id', $id)->update($query);
                            /* return (['response' => 'success', 'status' => $status, 'dates' => $dates]); */

                        }

                    }else{

                        DB::table('errors')->insert(['shipment_number' => $rsa_tracking_number, 'system_name' => 'RSA_6', 'status' => $URI_Response['result'], 'message' => "no events yet "]);

                    }

                }else{

                    DB::table('errors')->insert(['shipment_number' => $rsa_tracking_number, 'system_name' => 'RSA_5', 'status' => $URI_Response['result'], 'message' => "somthing wrong with tracking number!"]);
                
                }
               

            }else{
                DB::table('errors')->insert(['shipment_number' => $rsa_tracking_number, 'system_name' => 'RSA_4', 'status' => $URI_Response['result'], 'message' => "no enough data"]);
            }

           
        }else {
            DB::table('errors')->insert(['shipment_number' => $rsa_tracking_number, 'system_name' => 'RSA_3', 'status' => $URI_Response['result'], 'message' => $URI_Response['errors'][0]['message'] ]);
            /* return (['response' => 'fail', 'message' => $URI_Response['errors'][0]['message'] ]); */
        }

    }

    protected function update_NAQEL_status($tracking_number,$id, $order_id,$country,$order_number,$store,$old_status)
    {
        $reasons=[
            '100'=>	'Delivery attempted - Incorrect City/Area/District',
            '101'=>	'Delivery attempted - Incorrect Street Name',
            '102'=>	'Delivery attempted - Incorret Building/House',
            '103'=>	'Delivery attempted - Consignee moved to new and known address',
            '104'=>	'Delivery attempted - Consignee moved to a unknown address',
            '111'=>	'Delivery attempted - Damaged',
            '112'=>	'Delivery attempted - Piece Missing',
            '162'=>	'Delivery attempted - Consignee premises closed',
            '163'=>	'Delivery attempted - Consignee request to collection ',
            '164'=>	'Delivery attempted - Consignee request future delivery',
            '165'=>	'Delivery attempted - Consignee incorrect phone number',
            '166'=>	'Delivery attempted - Consignee phone closed',
            '167'=>	'Delivery attempted - Consignee not answered',
            '168'=>	'Delivery attempted - Consignee not home',
            '169'=>	'Delivery attempted - required access permission to Consignee address',
            '170'=>	'Delivery not attempted due to weather conditions',
            '171'=>	'Delivery attempted - Consignee refused due to incomplete documents',
        ];

        $refused_reasons= [
            '105'=>	'Delivery attempted - Consignee refused Delivery',
            '106'=>	'Delivery attempted - Consignee refused due to Missing Contents',
            '107'=>	'Delivery attempted - Consignee refused due to Amount Not Ready',
            '108'=>	'Delivery attempted - Consignee refused due to Wrong Content',
            '109'=>	'Delivery attempted - Consignee refused due to Damaged',
            '110'=>	'Delivery attempted - Consignee refused due to Content Check',
            '114'=>'Shipping cancelled by Shipper'
        ];

        $customs_cases = [
            '208'=>"Message",
            '209'=>"Message",
            '210'=>"Message",
            '211'=>"Message",
            '214'=>"Message",
            '215'=>"Message",
            '216'=>"Message",
            '217'=>"Message",
            '218'=>"Message",
            '219'=>"Message",
            '220'=>"Message",
            '202'=>"Message",
            '203'=>"Message",
            '191'=>"Message",
            '192'=>"Message",
            '193'=>"Message",
            '194'=>"Message",
            '195'=>"Message",
            '196'=>"Message",
            '197'=>"Message",
            '181'=>"Message",
            '182'=>"Message",
            '183'=>"Message",
            '184'=>"Message",
            '185'=>"Message",
            '186'=>"Message",
            '187'=>"Message",
            '188'=>"Message",
            '189'=>"Message",
            '144'=>"Message",
            '145'=>"Message",
            '146'=>"Message",
            '147'=>"Message",
            '148'=>"Message",
            '149'=>"Message",
            '150'=>"Message",
            '151'=>"Message",
            '113'=>"Message",
            '115'=>"Message"
        ];

        $warehouse_cases = [
            '138'=>'Message',
            '139'=>'Message',
            '140'=>'Message',
            '141'=>'Message',
            '134'=>'Message',
            '135'=>'Message',
            '136'=>'Message',
            '131'=>'Message',
            '127'=>'Message',
            '128'=>'Message'

        ];
        $naqel_again = 0;
        date_default_timezone_set('Africa/Cairo');
        $date = date('Y-m-d', time());

        if (isset($this->Naqel_keys[$country]) ) {
            $credentials = $this->Naqel_keys[$country];
        }else{
            $credentials = DB::select('SELECT * from naqel where country = ?', [$country]);
            $this->Naqel_keys[$country] = $credentials;
        }
        $client_id =$credentials[0]->client_id;
        $password = $credentials[0]->password;
        $version = $credentials[0]->version;

        naqel_again:
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://infotrack.naqelexpress.com/NaqelAPIServices/NaqelAPI/9.0/XMLShippingService.asmx',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS =>'<?xml version="1.0" encoding="utf-8"?>
                <soap12:Envelope xmlns:soap12="http://www.w3.org/2003/05/soap-envelope">
                    <soap12:Body>
                    <TraceByWaybillNo xmlns="http://tempuri.org/">
                        <ClientInfo>
                        <ClientID>'.$client_id.'</ClientID>
                        <Password>'.$password.'</Password>
                        <Version>'.$version.'</Version>
                        </ClientInfo>
                        <WaybillNo>'.$tracking_number.'</WaybillNo>
                    </TraceByWaybillNo>
                    </soap12:Body>
                </soap12:Envelope>',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: text/xml; charset=utf-8',
                'SOAPAction: http://tempuri.org/TraceByWaybillNo',
                'Cookie: RKKUJEZR=02394fd7f1-1e40-4bQN5wePom9MHoO0wl3K3SHv4XM0HnP1DgJVv9N_Q_7htHShZur70CCJqbTq3W_ORtSaU'
            ),
        ));

        /* $options = [
            'cache_wsdl' => WSDL_CACHE_NONE,
            'trace' => 1,
            'stream_context' => stream_context_create(
                [
                    'ssl' => [
                        'verify_peer' => false,
                        'verify_peer_name' => false,
                        'allow_self_signed' => true,
                    ],
                ]
            ),
        ];

        ini_set("soap.wsdl_cache_enabled", "0");

        $soapClient = new SoapClient('https://infotrack.naqelexpress.com/NaqelAPIServices/NaqelAPI/9.0/XMLShippingService.asmx?WSDL', $options); */

        // shows the methods coming from the service
        /*  $functions = $soapClient->__getFunctions ();
        var_dump ($functions); */


        /*
        Note: Shipments array can be more than one shipment.
         */
       
        /* $params = array(
            'ClientInfo' => array(
                'ClientID' => $credentials[0]->client_id,
                'Password' => $credentials[0]->password,
                'Version' => $credentials[0]->version
            ),

            'WaybillNo' => $tracking_number,
            
        ); */

        try {
            $response = curl_exec($curl);

            curl_close($curl);
            
            $xml = preg_replace("/(<\/?)(\w+):([^>]*>)/", "$1$2$3", $response);
            $xml = simplexml_load_string($xml);
            $json = json_encode($xml);
            $responseArray = json_decode($json,true);

            $auth_call = $responseArray['soapBody'];

            if ( isset($auth_call['TraceByWaybillNoResponse']) ) {
                $auth_call = $auth_call['TraceByWaybillNoResponse'];
            } else {
                return DB::table('errors')->insert(['shipment_number' => $tracking_number, 'system_name' => 'NAQEL_TRACKING_1__1', 'status' => 'Fail', 'message' => $auth_call['soapFault']['soapReason']['soapText'] ,"created_at" => $date]);
            }

        } catch (\Throwable $th) {
            return DB::table('errors')->insert(['shipment_number' => $tracking_number, 'system_name' => 'NAQEL_TRACKING_1', 'status' => 'Fail', 'message' => $th ]);
        }

        if (isset($auth_call['TraceByWaybillNoResult']['Tracking']['ErrorMessage']) && !empty($auth_call['TraceByWaybillNoResult']['Tracking']['ErrorMessage'])) {

            return DB::table('errors')->insert(['shipment_number' => $order_number, 'system_name' => 'NAQEL_TRACKING_2', 'status' => 'Fail', 'message' => $auth_call['TraceByWaybillNoResult']['Tracking']['ErrorMessage'] ]);

        } else {

            $tstModel=new tst();
            $arrive=0;
            $status = 0;
            $query = [];
            $dates = [];
            $reason="Cancelled by customer!";
            $special_case= 0;
            
            if (isset($auth_call['TraceByWaybillNoResult']['Tracking'])) {
            
                foreach ($auth_call['TraceByWaybillNoResult']['Tracking'] as  $record) {
                
                    if (isset($record['EventCode']) && ($record['EventCode'] == 1 || $record['EventCode'] == 120 || $record['EventCode'] == 122 || $record['EventCode'] == 124 || $record['EventCode'] == 125 || $record['EventCode'] == 126 || $record['EventCode'] == 9 || $record['EventCode'] == 44 || $record['EventCode'] == 221 || $record['EventCode'] == 1 || $record['EventCode'] == 226 || $record['EventCode'] == 3)  && $arrive == 0 ) {
                        $hub = 1;
                        
                        $status = $this->status['Kshopina_Warehouse'];
                        $dates['in_warehouse_at'] = date("Y-m-d H:i:s", strtotime($record['Date']));

                        $query['status'] = $status;
                        $query['in_warehouse_at'] = $dates['in_warehouse_at'];

                    }elseif (isset($record['EventCode']) && $record['EventCode'] == 5 ) {

                        $status = $this->status['Delivery'];
                        $dates['delivery_at'] = date("Y-m-d H:i:s", strtotime($record['Date']));

                        $query['status'] = $status;
                        $query['delivery_at'] = $dates['delivery_at'];

                    } elseif (isset($record['EventCode']) && $record['EventCode'] == 7 ) {

                        $status = $this->status['Delivered'];
                        $dates['delivered_at'] = date("Y-m-d H:i:s", strtotime($record['Date']));

                        $query['status'] = $status;
                        $query['delivered_at'] = $dates['delivered_at'];

                    }elseif ( isset($record['EventCode']) && isset($refused_reasons[$record['EventCode']]) ) {
                        $arrive = 1;
                        
                        $status = $this->status['Refused'];
                        $dates['delivered_at'] = date("Y-m-d H:i:s", strtotime($record['Date']));
                        $query['status'] = $status;
                        $query['delivered_at'] = $dates['delivered_at'];

                        $query['side_note'] = $record['Activity'];
                        $query['issue']=6;
                        $reason = $record['Activity'];

                    }elseif( isset($record['EventCode']) && isset($reasons[$record['EventCode']]) ){

                        $query['side_note'] = $reasons[$record['EventCode']];
                        $query['issue']=6;
                        $reason = $reasons[$record['EventCode']];
                    }
                    elseif( isset($record['EventCode']) && isset($customs_cases[$record['EventCode']]) ){

                        $query['side_note'] =$record['Activity'];
                        $query['issue']=6;
                        $query['status'] = $old_status;
                        $reason = $record['Activity'];
                        $special_case = 1;
                    }
                    elseif( isset($record['EventCode']) && isset($warehouse_cases[$record['EventCode']]) ){

                        $query['side_note'] =$record['Activity'];
                        $query['issue']=6;
                        $reason = $record['Activity'];
                        $special_case = 1;

                        $status = $this->status['Kshopina_Warehouse'];
                        $query['status'] = $status;
                    }
                    
                }
            }else{
                if ($country =='Saudi Arabia' && $naqel_again == 0) {
                    $naqel_again = 1;
                    $clearance_credentials = explode('|',$credentials[0]->client2);

                    $client_id =$clearance_credentials[0];
                    $password = $clearance_credentials[1];
                    $version = $credentials[0]->version;

                    goto naqel_again;
                }
                return DB::table('errors')->insert(['shipment_number' => $order_number, 'system_name' => 'NAQEL_TRACKING_4', 'status' => 'Fail', 'message' => 'NO TRACKING INFO FOUND' ]);
            }

            if ($query != []) {

                if ($query['status'] == $this->status['Refused']) {
    
                    if (!$tstModel->fct_is_exist($order_number)) {

                        $tstModel->insert_fct($order_number, $reason, $date, 3,$store);
                        if ($store !='origin') {
                            $tstModel->replace_tag("#on_process", "#FCT", $id, $store);

                        }else{
                            $tstModel->replace_tag("#dispatched", "#FCT", $id, $store);
    
                        }
                        $tstModel->replace_tag("#Delivered", "", $id, $store);
                        $query['old_status']=$old_status;

                    }
                }elseif($query['status'] == $this->status['Delivered']){
    
                    if ($store !='origin') {
                        $tstModel->replace_tag("#on_process", "#Delivered", $id, $store);

                    }else{
                        $tstModel->replace_tag("#dispatched", "#Delivered", $id, $store);

                    }
                    $tstModel->mark_order_as_paid($order_id,$store);
                }
                
                if ( isset($query['issue']) && $query['issue'] >0 && $query['status'] != $this->status['Refused']) {

                    if ($tstModel->fct_is_exist($order_number)) {
                        DB::table('fct')->where('order_number', $order_number)
                        ->update(['last_status'=>$reason , 'last_update' => $query['status'], 'updated_at' => $date]);
                    }else{
                        if ($store !='origin') {
                            $tstModel->replace_tag("#on_process", "#FCT", $id, $store);

                        }else{
                            $tstModel->replace_tag("#dispatched", "#FCT", $id, $store);
    
                        }
                        DB::insert('insert into fct (order_number, last_status,last_update,created_at,source,store) values (?,?, ?,?,?,?)', 
                        [$order_number, $reason,$query['status'], $date, 3,$store]);
                    }
                }

                DB::table('orders')->where('id', $id)->update($query);

                return (['response' => 'success', 'status' => $status, 'dates' => $dates]);
                
            }
            else {
                DB::table('errors')->insert(['shipment_number' => $tracking_number, 'system_name' => 'NAQEl_TRACKING_4', 'status' => 'Success', 'message' => "No data for NAQEL tracking number"]);
            }


        }
            
    }
    
    public function update_rsa_token(){

        $rsa_url  = DB::table('kshopina.config')->where('keyy', 'rsa_url')->get()[0]->value;
        $client_key  = DB::table('kshopina.config')->where('keyy', 'client_key')->get()[0]->value;
        $subscription_key = DB::table('kshopina.config')->where('keyy', 'Ocp-apim-subscription-key')->get()[0]->value;

        $client = new guzzle([
            'headers' => [
                'Content-type' => 'application/json',
                'Ocp-apim-subscription-key' => $subscription_key,
            ]
        ]);

        $URI = $rsa_url . '/api/client-authenticate?client-key=' . $client_key ;
        $URI_Response = $client->request('GET', $URI);
        $URI_Response = json_decode($URI_Response->getBody(), true);


        $expire_date = $URI_Response['data']['expire_at'];
        /* $expire_date = date('Y-m-d H:i:s', strtotime($expire_date. ' + 2 hours')); */

        $token = $URI_Response['data']['token'];

        DB::table('kshopina.config')->where('keyy','rsa_token')->update([ 'value' => $token ,'expire_date' => $expire_date ]);

    }
    
    
}
