<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use GuzzleHttp\Client as guzzle;

class TrackingUpdateController extends Controller
{
    public function __construct(Request $request)
    {



    }

    public function verify_request($service_name,$secret_key)
    {
        $APP_SECRETS = [
        'Kshopina' => KSHOPINA_SECRET, 
        'KMEX' => KMEX_SECRET, 
        'PnP' => PNP_SECRET ];

        if ($APP_SECRETS[$service_name] == $secret_key) {
            return true;
        }else{
            return false;
        }
        
    }

    public function update_tracking_status(Request $request)
    {

        try {
            $service_name = $_SERVER['HTTP_SERVICE_NAME'];
            $secret_key = $_SERVER['HTTP_AUTHORIZATION'];
            $verified = $this->verify_request($service_name,$secret_key);

            if ($verified) {
                $shipping_company =$request->shipping_company;

                if ($shipping_company == 'CUBE SHIP') {
                    return json_encode($this->update_CUBESHIP_status($service_name,$shipping_company));
                }
                /* return json_encode([
                    'shipping_company'=> $shipping_company,
                    'service_name'=> $service_name,
                    'secret_key'=>$secret_key
                ]); */
            }else{
                DB::insert('insert into errors (shipment_number, system_name, status, message) values (?,?,?,?)', [$service_name."|".$secret_key,'API','ALERT', 'Unauthorized request attempt']);

                http_response_code(401);

            }
        } catch (\Throwable $th) {

            DB::insert('insert into errors (system_name, status, message) values (?,?,?)', ['API', 'WARNING', $th]);

            http_response_code(401);

        }

    }

    protected function update_CUBESHIP_status($service_name,$shipping_company)
    {

        $trackingModel = new \App\Models\TrackingUpdate();

        // GET ORDERS DATA BY SERVICE NAME
        if ($service_name == 'Kshopina') {
            $orders= $trackingModel->get_kshopina_orders($shipping_company);
        }elseif ($service_name == 'KMEX') {
            /* $orders= $trackingModel->get_kmex_orders($shipping_company); */
        }elseif ($service_name == 'PnP') {
            /* $orders= $trackingModel->get_pnp_orders($shipping_company); */
        }

        $orders_status= $trackingModel->get_CUBESHIP_status($orders);

        // UPDATE ORDERS DATA BY SERVICE NAME

        if ($service_name == 'Kshopina') {
            $trackingModel->update_kshopina_orders($orders_status,$shipping_company);
        }elseif ($service_name == 'KMEX') {
            /* $trackingModel->update_kmex_orders($orders, $orders_status); */
        }elseif ($service_name == 'PnP') {
            /* $trackingModel->update_pnp_orders($orders, $orders_status  ); */
        }

        return "DONE";
    }
    
    
}
