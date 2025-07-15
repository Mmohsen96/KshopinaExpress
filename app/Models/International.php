<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use SoapClient;
use SoapFault;

class International extends Model
{
    use HasFactory;

    function read($data, $kshopina_tracking)
    {

        $options = [
            'trace'          => 1,
            'stream_context' => stream_context_create(
                [
                    'ssl' => [
                        'verify_peer'       => false,
                        'verify_peer_name'  => false,
                        'allow_self_signed' => true
                    ]
                ]
            )
        ];


        ini_set("soap.wsdl_cache_enabled", "0");

        /*     http://ws.aramex.net/ShippingAPI.V2/Tracking/Service_1_0.svc?singleWsdl
 */
        $soapClient = new SoapClient('shipments-tracking-api-wsdl.wsdl', $options);

        // shows the methods coming from the service 
        /*  $functions = $soapClient->__getFunctions ();
  var_dump ($functions); */

        /*
    Note: Shipments array can be more than one shipment.
*/
        try {
            $international_AWB = $data['international_awb'];
            $country = $data['country'];
        } catch (\Throwable $th) {
            $international_AWB = $data->international_awb;
            $country = $data->country;
        }

        $params = array(
            'ClientInfo'              => array(
                'AccountCountryCode'    => 'EG',
                'AccountEntity'             => 'CAI',
                'AccountNumber'             => '169936',
                'AccountPin'             => '321321',
                'UserName'                 => 'park@dpmglob.com',
                'Password'                 => 'Dpmglob2020@',
                'Version'                 => 'v1.0'
            ),

            'Transaction'             => array(
                'Reference1'            => '001'
            ),
            'Shipments'                => array(
                $international_AWB // Replace with your Shipment number by looking in the Aramex dashboard
            )



        );

        // calling the method and printing results
        try {
            $auth_call = $soapClient->TrackShipments($params);

            $arr = (array)$auth_call->TrackingResults;

            if (!$arr) {

                return array(
                    'tracking' => "NOT FOUND",
                    'fulfilled' => null,
                    'dispatched' => null,
                    'customs' => null,
                    'warehouse' => null,
                    'delivery' => null,
                    'delivered' => null
                );
            }

            $record = "";
            $not_received = false;
            $code = array();
            $date = array();
            $location = array();
            foreach ($auth_call->TrackingResults as $result) {

                if (is_array($result->Value->TrackingResult)) {
                    $not_received = false;
                    foreach ($result->Value->TrackingResult as $val) {

                        array_push($code, $val->UpdateCode);
                        array_push($date, $val->UpdateDateTime);
                        array_push($location, $val->UpdateLocation);
                    }
                } else {
                    array_push($code, $result->Value->TrackingResult->UpdateCode);
                    array_push($date, $result->Value->TrackingResult->UpdateDateTime);
                    array_push($location, $result->Value->TrackingResult->UpdateLocation);
                    $not_received = true;
                }
            }

            array_reverse($code);
            array_reverse($date);
            array_reverse($location);

            $response = array(
                'tracking' => $kshopina_tracking,
                'fulfilled' => null,
                'dispatched' => null,
                'customs' => null,
                'warehouse' => null,
                'delivery' => null,
                'delivered' => null
            );




            for ($i = 0; $i < count($code); $i++) {
                // Shipment still not received by Aramex
                if ($code[$i] == "SH014" && $not_received == true) {
                    $response['tracking'] = "Pending";
                    continue;
                }
                //Received at Origin Facility  || Record Created
                if (($code[$i] == "SH047" || $code[$i] == "SH406" || $code[$i] == "SH014") && $response['fulfilled'] == null) {
                    $response['fulfilled'] = $date[$i];
                }
                //Departed Operations facility – In Transit
                elseif ($code[$i] == "SH022" && str_contains($location[$i], 'Korea') && $response['dispatched'] == null) {
                    $response['dispatched'] = $date[$i];
                }
                //Customs Clearance || Under processing at operations facility
                elseif (($code[$i] == "SH156" || ($code[$i] == "SH001" && str_contains($location[$i], $country))) && $response['customs'] == null) {
                    $response['customs'] = $date[$i];
                }
                //Collected by Consignee || Delivered
                elseif (($code[$i] == "SH006" || $code[$i] == "SH005") && $response['warehouse'] == null) {
                    $response['warehouse'] = $date[$i];
                } else {
                    continue;
                }
            }
            /* if ($response['dispatched'] != null && $response['fulfilled'] == null) {
                $response['fulfilled'] = $date[$record];
            } */
        } catch (SoapFault $fault) {

            return array(
                'tracking' => "NOT FOUND",
                'fulfilled' => null,
                'dispatched' => null,
                'customs' => null,
                'warehouse' => null,
                'delivery' => null,
                'delivered' => null
            );
        }
        return $response;
    }


    function create($order_number, $kshopina_tracking, $order)
    {
        $response = $this->read($order, $kshopina_tracking);
        if ($response['tracking'] == "NOT FOUND") {
            return $response;
        } else {
            $create[] = array(
                'order_number' => $order_number,
                'fulfilled' => $response['fulfilled'],
                'dispatched' => $response['dispatched'],
                'customs' => $response['customs'],
                'warehouse' => $response['warehouse']
            );
            DB::table('international')->insert($create);
            return $response;
        }
    }
function check_if_exist($order,$kshopina_tracking){

    $response = $this->read($order, $kshopina_tracking);

    if ($response['tracking'] == "NOT FOUND") {
        return false;
    } else {
        return true ;
    }
}


    function updatee($order, $kshopina_tracking)
    {

        $response = $this->read($order, $kshopina_tracking);
        try {
            $order_number = $order->order_number;
        } catch (\Throwable $th) {
            $order_number = $order['order_number'];
        }
        /*         $order_number = substr($kshopina_tracking, 1, 4);
 */
        DB::table('international')->where('order_number', $order_number)
            ->update([
                'fulfilled' => $response['fulfilled'],
                'dispatched' => $response['dispatched'],
                'customs' => $response['customs'],
                'warehouse' => $response['warehouse']
            ]);
        return $response;
    }

    function getDate($order_number, $kshopina_tracking)
    {
        $data = DB::select('select * from international where order_number = ?', [$order_number]);
        foreach ($data as $key => $value) {
            $response = array(
                'tracking' => $kshopina_tracking,
                'fulfilled' => $value->fulfilled,
                'dispatched' => $value->dispatched,
                'customs' => $value->customs,
                'warehouse' => $value->warehouse,
                'delivery' => $value->domestic,
                'delivered' => $value->delivered
            );
        }
        return $response;
    }
    function isExist($order_number)
    {
        $check = DB::select('select * from international where order_number = ?', [$order_number]);

        if ($check == null || $check == []) {
            return [false, []];
        } else {
            return [true, $check];
        }
    }
}
