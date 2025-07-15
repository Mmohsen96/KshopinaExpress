<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WhatsAppController extends Controller
{
    //
    public static $app_secret ='';

    public function whatsapp(){

        if($_SERVER['REQUEST_METHOD']=="GET"){

            http_response_code(200);
        }else{
         
        }
    }

    public function whatsapp_webhooks(Request $request){
        
        try {
            

    } catch (\Throwable $th) {
        return $th;
    }
    }

    
}
