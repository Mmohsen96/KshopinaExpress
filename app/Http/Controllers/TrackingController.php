<?php

namespace App\Http\Controllers;
use App\Helpers\UserSystemInfoHelper;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Models\Orders;
use Illuminate\Http\Request;
use SoapClient;
use SoapFault;

class TrackingController extends Controller
{

    protected $ordersModel;
    protected $internationalModel;
    protected $tstModel;

    public function __construct(Request $request)
    {
        $this->ordersModel = new \App\Models\Orders();
        $this->internationalModel = new \App\Models\International();
        $this->tstModel = new \App\Models\tst();

    }

    public function index($kshopina_tracking)
    {
        
        try {
            $data = $this->ordersModel->getorderbytracking($kshopina_tracking);

            if ($data[0]->status==7) {
                $reason=$this->tstModel->get_fct($data[0]->order_number)[0]->last_status;
            } else {
                $reason="";
            }
            try {
                if (!isset(Auth::user()->id)) {
                    UserSystemInfoHelper::add_new_visitor($kshopina_tracking);
                }
            } catch (\Throwable $th) {
                
            }

            $fan_talk_episode= DB::table('config')->where('keyy', 'fan_talk')->get()[0]->value;

            return view('tracking_order')->with(['kshopina' => $kshopina_tracking, 'orignal_status' => $data[0]->status,'reason'=>$reason,'store'=>$data[0]->store ,
                                                'category'=>$data[0]->category ,'release_date'=> $data[0]->release_date , 'on_process'=> $data[0]->on_process,'fan_talk_episode'=>$fan_talk_episode ]);
        } catch (\Throwable $th) {
            http_response_code(404);
            exit;
        }
    }


    public function aramex($kshopina_tracking)
    {
        $options = [
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

        $soapClient = new SoapClient('http://ws.aramex.net/ShippingAPI.V2/Tracking/Service_1_0.svc?singleWsdl', $options);

        // shows the methods coming from the service
        /*  $functions = $soapClient->__getFunctions ();
        var_dump ($functions); */

        $data = $this->ordersModel->getorderbytracking($kshopina_tracking);

        /*
        Note: Shipments array can be more than one shipment.
         */

        $params = array(
            'ClientInfo' => array(
                'AccountCountryCode' => 'EG',
                'AccountEntity' => 'CAI',
                'AccountNumber' => '169936',
                'AccountPin' => '321321',
                'UserName' => 'park@dpmglob.com',
                'Password' => 'Dpmglob2020@',
                'Version' => 'v1.0',
            ),

            'Transaction' => array(
                'Reference1' => '001',
            ),
            'Shipments' => array(
                $data[0]->international_awb, // Replace with your Shipment number by looking in the Aramex dashboard
            ),

        );
        // calling the method and printing results
        try {

            $auth_call = $soapClient->TrackShipments($params);
            $code = array();
            $date = array();
            $location = array();
            foreach ($auth_call->TrackingResults as $result) {

                // var_dump($result->Value->TrackingResult);
                foreach ($result->Value->TrackingResult as $val) {

                    array_push($code, $val->UpdateCode);
                    array_push($date, $val->UpdateDateTime);
                    array_push($location, $val->UpdateLocation);
                }
            }
            
            array_reverse($code);
            array_reverse($date);
            array_reverse($location);

            $response = array(
                'tracking' => $kshopina_tracking,
                'fulfilled' => false,
                'dispatched' => false,
                'customs' => false,
                'warehouse' => false,
                'delivery' => false,
                'delivered' => false,
            );

            $country = $data[0]->country;

            for ($i = 0; $i < count($code); $i++) {
                //Received at Origin Facility
                if ($code[$i] == "SH047" || $code[$i] == "SH406") {
                    $response['fulfilled'] = true;
                }
                //Departed Operations facility – In Transit
                elseif ($code[$i] == "SH022" && str_contains($location[$i], 'Korea')) {
                    $response['dispatched'] = true;
                }
                //Customs Clearance || Under processing at operations facility
                elseif ($code[$i] == "SH156" || ($code[$i] == "SH001" && str_contains($location[$i], $country))) {
                    $response['customs'] = true;
                }
                //Collected by Consignee || Delivered
                elseif ($code[$i] == "SH006" || $code[$i] == "SH005") {
                    $response['warehouse'] = true;
                } else {
                    continue;
                }
            }
        } catch (SoapFault $fault) {

            // echo "TRY FAILED";

            die('Error : ' . $fault->faultstring);
        }
        return $response;
    }
}
