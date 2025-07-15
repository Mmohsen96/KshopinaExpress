<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use GuzzleHttp\Client as guzzle;
use Illuminate\Support\Facades\Auth;

class WhatsApp extends Model
{
    use HasFactory;

    public function save_message($profile_name,$phone_number,$msg_date,$msg_type,$msg_body)
    {
        DB::table('whatsApp_messages')->insert(['profile_name' => $profile_name, 'phone_number' => $phone_number, 'message_type' => $msg_type, 'message_body' => $msg_body,'message_date'=>$msg_date ]);

    }
    public function save_message_sent_record($order_number,$whatsapp_message_id,$phone_number,$message_name)
    {

        DB::table('whatsapp_send_messages')->insert(['message_order_number' =>$order_number,'whatsapp_message_id' => $whatsapp_message_id, 'message_phone_number' => $phone_number, 'message_name' => $message_name]);


    }
    public function update_message_status($message_id,$updates)
    {

        DB::table('whatsapp_send_messages')->where('whatsapp_message_id',$message_id)->update($updates);
    }
    public function reformat_phone_number($phone_number,$country)
    {

        $country_phone_codes = [
            "United Kingdom"=> "44",
            "United States"=> "1",
            "Algeria"=> "213",
            "Andorra"=> "376",
            "Angola"=> "244",
            "Anguilla"=> "1264",
            "Antigua & Barbuda"=> "1268",
            "Argentina"=> "54",
            "Armenia"=> "374",
            "Aruba"=> "297",
            "Australia"=> "61",
            "Austria"=> "43",
            "Azerbaijan"=> "994",
            "Bahamas"=> "1242",
            "Bahrain"=> "973",
            "Bangladesh"=> "880",
            "Barbados"=> "1246",
            "Belarus"=> "375",
            "Belgium"=> "32",
            "Belize"=> "501",
            "Benin"=> "229",
            "Bermuda"=> "1441",
            "Bhutan"=> "975",
            "Bolivia"=> "591",
            "Bosnia Herzegovina"=> "387",
            "Botswana"=> "267",
            "Brazil"=> "55",
            "Brunei"=> "673",
            "Bulgaria"=> "359",
            "Burkina Faso"=> "226",
            "Burundi"=> "257",
            "Cambodia"=> "855",
            "Cameroon"=> "237",
            "Canada"=> "1",
            "Cape Verde Islands"=> "238",
            "Cayman Islands"=> "1345",
            "Central African Republic"=> "236",
            "Chile"=> "56",
            "China"=> "86",
            "Colombia"=> "57",
            "Comoros"=> "269",
            "Congo"=> "242",
            "Cook Islands"=> "682",
            "Costa Rica"=> "506",
            "Croatia"=> "385",
            "Cuba"=> "53",
            "Cyprus North"=> "90392",
            "Cyprus South"=> "357",
            "Czech Republic"=> "42",
            "Denmark"=> "45",
            "Djibouti"=> "253",
            "Dominica"=> "1809",
            "Dominican Republic"=> "1809",
            "Ecuador"=> "593",
            "Egypt"=> "20",
            "El Salvador"=> "503",
            "Equatorial Guinea"=> "240",
            "Eritrea"=> "291",
            "Estonia"=> "372",
            "Ethiopia"=> "251",
            "Falkland Islands"=> "500",
            "Faroe Islands"=> "298",
            "Fiji"=> "679",
            "Finland"=> "358",
            "France"=> "33",
            "French Guiana"=> "594",
            "French Polynesia"=> "689",
            "Gabon"=> "241",
            "Gambia"=> "220",
            "Georgia"=> "7880",
            "Germany"=> "49",
            "Ghana"=> "233",
            "Gibraltar"=> "350",
            "Greece"=> "30",
            "Greenland"=> "299",
            "Grenada"=> "1473",
            "Guadeloupe"=> "590",
            "Guam"=> "671",
            "Guatemala"=> "502",
            "Guinea"=> "224",
            "Guinea - Bissau"=> "245",
            "Guyana"=> "592",
            "Haiti"=> "509",
            "Honduras"=> "504",
            "Hong Kong"=> "852",
            "Hungary"=> "36",
            "Iceland"=> "354",
            "India"=> "91",
            "Indonesia"=> "62",
            "Iran"=> "98",
            "Iraq"=> "964",
            "Ireland"=> "353",
            "Israel"=> "972",
            "Italy"=> "39",
            "Jamaica"=> "1876",
            "Japan"=> "81",
            "Jordan"=> "962",
            "Kazakhstan"=> "7",
            "Kenya"=> "254",
            "Kiribati"=> "686",
            "Korea North"=> "850",
            "Korea South"=> "82",
            "Kuwait"=> "965",
            "Kyrgyzstan"=> "996",
            "Laos"=> "856",
            "Latvia"=> "371",
            "Lebanon"=> "961",
            "Lesotho"=> "266",
            "Liberia"=> "231",
            "Libya"=> "218",
            "Liechtenstein"=> "417",
            "Lithuania"=> "370",
            "Luxembourg"=> "352",
            "Macao"=> "853",
            "Macedonia"=> "389",
            "Madagascar"=> "261",
            "Malawi"=> "265",
            "Malaysia"=> "60",
            "Maldives"=> "960",
            "Mali"=> "223",
            "Malta"=> "356",
            "Marshall Islands"=> "692",
            "Martinique"=> "596",
            "Mauritania"=> "222",
            "Mayotte"=> "269",
            "Mexico"=> "52",
            "Micronesia"=> "691",
            "Moldova"=> "373",
            "Monaco"=> "377",
            "Mongolia"=> "976",
            "Montserrat"=> "1664",
            "Morocco"=> "212",
            "Mozambique"=> "258",
            "Myanmar"=> "95",
            "Namibia"=> "264",
            "Nauru"=> "674",
            "Nepal"=> "977",
            "Netherlands"=> "31",
            "New Caledonia"=> "687",
            "New Zealand"=> "64",
            "Nicaragua"=> "505",
            "Niger"=> "227",
            "Nigeria"=> "234",
            "Niue"=> "683",
            "Norfolk Islands"=> "672",
            "Northern Marianas"=> "670",
            "Norway"=> "47",
            "Oman"=> "968",
            "Palau"=> "680",
            "Panama"=> "507",
            "Papua New Guinea"=> "675",
            "Paraguay"=> "595",
            "Peru"=> "51",
            "Philippines"=> "63",
            "Poland"=> "48",
            "Portugal"=> "351",
            "Puerto Rico"=> "1787",
            "Qatar"=> "974",
            "Reunion"=> "262",
            "Romania"=> "40",
            "Russia"=> "7",
            "Rwanda"=> "250",
            "San Marino"=> "378",
            "Sao Tome & Principe"=> "239",
            "Saudi Arabia"=> "966",
            "Senegal"=> "221",
            "Serbia"=> "381",
            "Seychelles"=> "248",
            "Sierra Leone"=> "232",
            "Singapore"=> "65",
            "Slovak Republic"=> "421",
            "Slovenia"=> "386",
            "Solomon Islands"=> "677",
            "Somalia"=> "252",
            "South Africa"=> "27",
            "Spain"=> "34",
            "Sri Lanka"=> "94",
            "St. Helena"=> "290",
            "St. Kitts"=> "1869",
            "St. Lucia"=> "1758",
            "Sudan"=> "249",
            "Suriname"=> "597",
            "Swaziland"=> "268",
            "Sweden"=> "46",
            "Switzerland"=> "41",
            "Syria"=> "963",
            "Taiwan"=> "886",
            "Tajikstan"=> "7",
            "Thailand"=> "66",
            "Togo"=> "228",
            "Tonga"=> "676",
            "Trinidad & Tobago"=> "1868",
            "Tunisia"=> "216",
            "Turkey"=> "90",
            "Turkmenistan"=> "7",
            "Turkmenistan"=> "993",
            "Turks & Caicos Islands"=> "1649",
            "Tuvalu"=> "688",
            "Uganda"=> "256",
            "Ukraine"=> "380",
            "United Arab Emirates"=> "971",
            "Uruguay"=> "598",
            "Uzbekistan"=> "998",
            "Vanuatu"=> "678",
            "Vatican City"=> "379",
            "Venezuela"=> "58",
            "Vietnam"=> "84",
            "Virgin Islands - British"=> "1284",
            "Virgin Islands - US"=> "1340",
            "Wallis & Futuna"=> "681",
            "Yemen"=>"967",
            "Zambia"=> "260",
            "Zimbabwe"=> "263",
        ];

        $new_phone_number = str_replace("+", "", $phone_number);
        $new_phone_number = str_replace(" ", "", $new_phone_number);
        $new_phone_number = str_replace("-", "", $new_phone_number);
        $new_phone_number = str_replace("(", "", $new_phone_number);
        $new_phone_number = str_replace(")", "", $new_phone_number);
        $new_phone_number = str_replace(" ", "", $new_phone_number);

        
        for ($i=0; $i < strlen($new_phone_number) ; $i++) { 
            if ($new_phone_number[$i] != '0') {
                $new_phone_number = substr($new_phone_number, $i);
                break;
            }
        }

        if (isset($country_phone_codes[$country])) {
            for ($i=0; $i < strlen($country_phone_codes[$country]) ; $i++) { 
                if ($new_phone_number[$i] != $country_phone_codes[$country][$i]) {
                    $new_phone_number = $country_phone_codes[$country] .$new_phone_number ;
                    break;
                }
            }
        }

        return $new_phone_number;
    }
    public function whatsapp_send_fvm_message($store, $order_number, $token){

        $order = DB::table('orders')->where('order_number', $order_number)->get();
        $shopify_id = $order[0]->order_id;
        $to = $order[0]->phone_number;
        $to = $this->reformat_phone_number($to,$order[0]->country);

        date_default_timezone_set('Africa/Cairo');
        $date = date('Y-m-d H:i:s', time());

        DB::table('orders')->where('order_number', $order_number)->update(['verified' => 1, 'token' => $token, 'send_fvm_at' => $date]);

        $confirm_url ="confirm?token=" . $token;
        $cancel_url = "cancel?token=" . $token;
        
        try {

            $curl = curl_init();

            curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://graph.facebook.com/v17.0/100169306499865/messages',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS =>'{
                "messaging_product": "whatsapp",
                "recipient_type": "individual",
                "to": "'.$to .'",
                "type": "template",
                "template": {
                    "name": "fvm",
                    "language": {
                        "code": "en"
                    },
                    "components": [
                        {
                            "type": "body",
                            "parameters": [
                                {
                                    "type":"TEXT",
                                    "text":"'.$order_number.'"
                                }
                            ]
                        },
                        {
                            "type": "button",
                            "sub_type": "url",
                            "index": 0,
                            "parameters": [
                              {
                                "type": "TEXT",
                                "text": "'.$confirm_url.'"
                              }
                            ]
                        },
                        {
                            "type": "button",
                            "sub_type": "url",
                            "index": 1,
                            "parameters": [
                              {
                                "type": "TEXT",
                                "text": "'.$cancel_url.'"
                              }
                            ]
                        }
                    ]
                }
            }',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Authorization: Bearer EAAJ9ObvQ2DABOZC0WwYHyTMuHtKVcHAOZAQPhZBl2OwzCrTB3KxBZBul1EIn3ZA3UIVHOJZBCo025ZBxinQ6XAI1mjLhnbvYTWQct0AVfmGg3zkqUkOIrE8o0BMolYsc1EDg0l36XEIh5dmUPXCMIZBTjlNEVpNnRjlG5ObEUZBzLs1V1ub73uLY56cttZAeejpuvWZC9f9kIvSmqzzsH5ZB'
            ),
            ));

            $response = curl_exec($curl);
            $response = json_decode($response);

            $whatsapp_model = new \App\Models\WhatsApp();

            if (isset($response->messages[0]) ) {

                $message=$response->messages[0];
                $id=$message->id;
                $contacts=$response->contacts[0];

                $whatsapp_model->save_message_sent_record($order_number,$id,$contacts->input,'fvm');
            }else {
                DB::table('errors')->insert(['shipment_number' => $to, 'system_name' => 'WhatsApp_fvm', 'status' => 'Fail', 'message' => $response ]);
            }

            curl_close($curl);

        } catch (\Throwable $th) {

            DB::table('errors')->insert(['shipment_number' => $to, 'system_name' => 'WhatsApp_fvm', 'status' => 'Fail', 'message' => $th ]);

        }


        //add tag

            $shopify_token = DB::table('config')->where('keyy', $store)->get()[0]->value;
            $store_url = DB::table('config')->where('keyy', $store . '_url')->get()[0]->value;
            $store_myshopify_url = DB::table('config')->where('keyy', $store . '_myshopify')->get()[0]->value;

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
                $tags = "Waiting_for_confirmation";
            } else {
                $tags = $tags . ",Waiting_for_confirmation";
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
        //
    }

    public function whatsapp_send_svm_message($order_id,$problem){

        $order = DB::table('orders')->where('id', $order_id)->get();
        $to = $order[0]->phone_number;
        $to = $this->reformat_phone_number($to,$order[0]->country);
        $edit_url ="edit?token=" . $order[0]->token;
        $order_number = $order[0]->order_number;

        date_default_timezone_set('Africa/Cairo');
        $date = date('Y-m-d H:i:s', time());

        DB::table('orders')->where('order_number', $order_number)->update(['verified' => 4, 'problem' => $problem, 'send_svm_at' => $date,'send_svm_by'=>Auth::user()->name]);
       
        try {

            $curl = curl_init();

            curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://graph.facebook.com/v17.0/100169306499865/messages',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS =>'{
                "messaging_product": "whatsapp",
                "recipient_type": "individual",
                "to": "'.$to .'",
                "type": "template",
                "template": {
                    "name": "svm",
                    "language": {
                        "code": "en"
                    },
                    "components": [
                        {
                            "type": "body",
                            "parameters": [
                                {
                                    "type":"TEXT",
                                    "text":"'.$order_number.'"
                                }
                            ]
                        },
                        {
                            "type": "button",
                            "sub_type": "url",
                            "index": 0,
                            "parameters": [
                              {
                                "type": "TEXT",
                                "text": "'.$edit_url.'"
                              }
                            ]
                        }
                    ]
                }
            }',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Authorization: Bearer EAAJ9ObvQ2DABOZC0WwYHyTMuHtKVcHAOZAQPhZBl2OwzCrTB3KxBZBul1EIn3ZA3UIVHOJZBCo025ZBxinQ6XAI1mjLhnbvYTWQct0AVfmGg3zkqUkOIrE8o0BMolYsc1EDg0l36XEIh5dmUPXCMIZBTjlNEVpNnRjlG5ObEUZBzLs1V1ub73uLY56cttZAeejpuvWZC9f9kIvSmqzzsH5ZB'
            ),
            ));

            $response = curl_exec($curl);
            $response = json_decode($response);

            $whatsapp_model = new \App\Models\WhatsApp();

            if (isset($response->messages[0]) ) {

                $message=$response->messages[0];
                $id=$message->id;
                $contacts=$response->contacts[0];

                $whatsapp_model->save_message_sent_record($order_number,$id,$contacts->input,'svm');
            }else {
                DB::table('errors')->insert(['shipment_number' => $to, 'system_name' => 'WhatsApp_svm', 'status' => 'Fail', 'message' => $response ]);
            }

            curl_close($curl);

        } catch (\Throwable $th) {

            DB::table('errors')->insert(['shipment_number' => $to, 'system_name' => 'WhatsApp_svm', 'status' => 'Fail', 'message' => $th ]);

        }

    }

    public function whatsapp_send_tracking_message($to,$order_number,$tracking_number,$country){

        $to = $this->reformat_phone_number($to,$country);
        $tracking_url ="tracking/" . $tracking_number;

        try {

            $curl = curl_init();

            curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://graph.facebook.com/v17.0/100169306499865/messages',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS =>'{
                "messaging_product": "whatsapp",
                "recipient_type": "individual",
                "to": "'.$to .'",
                "type": "template",
                "template": {
                    "name": "tracking",
                    "language": {
                        "code": "en"
                    },
                    "components": [
                        {
                            "type": "body",
                            "parameters": [
                                {
                                    "type":"TEXT",
                                    "text":"'.$order_number.'"
                                }
                            ]
                        },
                        {
                            "type": "button",
                            "sub_type": "url",
                            "index": 0,
                            "parameters": [
                              {
                                "type": "TEXT",
                                "text": "'.$tracking_url.'"
                              }
                            ]
                        }
                    ]
                }
            }',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Authorization: Bearer EAAJ9ObvQ2DABOZC0WwYHyTMuHtKVcHAOZAQPhZBl2OwzCrTB3KxBZBul1EIn3ZA3UIVHOJZBCo025ZBxinQ6XAI1mjLhnbvYTWQct0AVfmGg3zkqUkOIrE8o0BMolYsc1EDg0l36XEIh5dmUPXCMIZBTjlNEVpNnRjlG5ObEUZBzLs1V1ub73uLY56cttZAeejpuvWZC9f9kIvSmqzzsH5ZB'
            ),
            ));

            $response = curl_exec($curl);
            $response = json_decode($response);

            $whatsapp_model = new \App\Models\WhatsApp();

            if (isset($response->messages[0]) ) {

                $message=$response->messages[0];
                $id=$message->id;
                $contacts=$response->contacts[0];

                $whatsapp_model->save_message_sent_record($order_number,$id,$contacts->input,'tracking');
            }else {
                DB::table('errors')->insert(['shipment_number' => $to, 'system_name' => 'WhatsApp_tracking', 'status' => 'Fail', 'message' => $response ]);
            }

            curl_close($curl);

        } catch (\Throwable $th) {

            DB::table('errors')->insert(['shipment_number' => $to, 'system_name' => 'WhatsApp_tracking', 'status' => 'Fail', 'message' => $th ]);

        }
        
    }

    public function whatsapp_send_fvm_reminder_message($to,$country,$order_number){

        $to = $this->reformat_phone_number($to,$country);

        try {

            $curl = curl_init();

            curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://graph.facebook.com/v17.0/100169306499865/messages',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS =>'{
                "messaging_product": "whatsapp",
                "recipient_type": "individual",
                "to": "'.$to .'",
                "type": "template",
                "template": {
                    "name": "fvm_reminder",
                    "language": {
                        "code": "en"
                    },
                    "components": [
                        {
                            "type": "body",
                            "parameters": [
                                {
                                    "type":"TEXT",
                                    "text":"'.$order_number.'"
                                }
                            ]
                        }
                    ]
                }
            }',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Authorization: Bearer EAAJ9ObvQ2DABOZC0WwYHyTMuHtKVcHAOZAQPhZBl2OwzCrTB3KxBZBul1EIn3ZA3UIVHOJZBCo025ZBxinQ6XAI1mjLhnbvYTWQct0AVfmGg3zkqUkOIrE8o0BMolYsc1EDg0l36XEIh5dmUPXCMIZBTjlNEVpNnRjlG5ObEUZBzLs1V1ub73uLY56cttZAeejpuvWZC9f9kIvSmqzzsH5ZB'
            ),
            ));

            $response = curl_exec($curl);
            $response = json_decode($response);

            $whatsapp_model = new \App\Models\WhatsApp();

            if (isset($response->messages[0]) ) {

                $message=$response->messages[0];
                $id=$message->id;
                $contacts=$response->contacts[0];

                $whatsapp_model->save_message_sent_record($order_number,$id,$contacts->input,'fvm_reminder');
            }else {
                DB::table('errors')->insert(['shipment_number' => $to, 'system_name' => 'WhatsApp_fvm_reminder', 'status' => 'Fail', 'message' => $response ]);
            }

            curl_close($curl);

        } catch (\Throwable $th) {

            DB::table('errors')->insert(['shipment_number' => $to, 'system_name' => 'WhatsApp_fvm_reminder', 'status' => 'Fail', 'message' => $th ]);

        }
    }

    public function whatsapp_send_svm_reminder_message($to,$country,$order_number){

        $to = $this->reformat_phone_number($to,$country);

        try {

            $curl = curl_init();

            curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://graph.facebook.com/v17.0/100169306499865/messages',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS =>'{
                "messaging_product": "whatsapp",
                "recipient_type": "individual",
                "to": "'.$to .'",
                "type": "template",
                "template": {
                    "name": "svm_reminder",
                    "language": {
                        "code": "en"
                    },
                    "components": [
                        {
                            "type": "body",
                            "parameters": [
                                {
                                    "type":"TEXT",
                                    "text":"'.$order_number.'"
                                }
                            ]
                        }
                    ]
                }
            }',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Authorization: Bearer EAAJ9ObvQ2DABOZC0WwYHyTMuHtKVcHAOZAQPhZBl2OwzCrTB3KxBZBul1EIn3ZA3UIVHOJZBCo025ZBxinQ6XAI1mjLhnbvYTWQct0AVfmGg3zkqUkOIrE8o0BMolYsc1EDg0l36XEIh5dmUPXCMIZBTjlNEVpNnRjlG5ObEUZBzLs1V1ub73uLY56cttZAeejpuvWZC9f9kIvSmqzzsH5ZB'
            ),
            ));

            $response = curl_exec($curl);
            $response = json_decode($response);

            $whatsapp_model = new \App\Models\WhatsApp();

            if (isset($response->messages[0]) ) {

                $message=$response->messages[0];
                $id=$message->id;
                $contacts=$response->contacts[0];

                $whatsapp_model->save_message_sent_record($order_number,$id,$contacts->input,'svm_reminder');
            }else {
                DB::table('errors')->insert(['shipment_number' => $to, 'system_name' => 'WhatsApp_svm_reminder', 'status' => 'Fail', 'message' => $response ]);
            }

            curl_close($curl);

        } catch (\Throwable $th) {

            DB::table('errors')->insert(['shipment_number' => $to, 'system_name' => 'WhatsApp_svm_reminder', 'status' => 'Fail', 'message' => $th ]);

        }
    }

}
