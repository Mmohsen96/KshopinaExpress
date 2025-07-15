<?php

namespace App\Models;

use GuzzleHttp\Client as guzzle;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Domestic extends Model
{
    use HasFactory;

    public function updateDomestic($order_number, $changes)
    {

        DB::table('international')->where('order_number', $order_number)
            ->update($changes);
    }
    public function create_Ocs($sheetData, $table_key, $i)
    {

        $client = new guzzle([
            'headers' => [
                'Content-Type' => 'application/json',
            ],
        ]);
        $URI = 'http://ws.api.ocskuwait.com/api/ShipmentCreation';

        $body = [
            "UserCredential" => [
                "UserKey" => "PPP110596",
                "UserPassword" => "PPP0596",
                "UserPIN" => "1105",
            ], "ClientDetails" => [
                "AccountNumber" => "110596",
            ],
            "VersionDetails" => [
                "RequestType" => "Shipment",
                "VersionMajor" => "4",
                "VersionMinor" => "0",
            ],
            "TransactionDetails" => [
                "TransactionReferenceNumber" => $sheetData[$i][$table_key['Order Number']],
            ],
            "ShipmentDetails" => [
                "ShipmentDate" => date('Y-m-d', time()),
                "ShipmentTime" => date('Y-m-d', time()),
                "ServiceType" => "EXPRESS",
                "ProductType" => "NDOX",
                "ContentType" => "NON DOCUMENTS",
                "ContentDescription" => ": CD (Book)",
                "ConsignmentValue" => $sheetData[$i][$table_key['Customs Value']],
                "ConsignmentValueCurrency" => "KWD",
                "InsuranceValue" => 0,
                "InsuranceValueCurrency" => "",
                "CODAmount" => $sheetData[$i][$table_key['COD Amount']],
                "TotalPieces" => $sheetData[$i][$table_key['PCS']],
                "TotalWeight" => $sheetData[$i][$table_key['Actual Weight']],
                "TotalLength" => 10.000,
                "TotalWidth" => 10.000,
                "TotalHeight" => 10.000,
            ],
            "ShipperDetails" => [
                "CompanyName" => "Kshopina",
                "ContactName" => "JOHN SEO",
                "AddressLine1" => "Mapo-daero",
                "AddressLine2" => "34",
                "TelephoneNumber" => "821063094613",
                "Email" => "park@dpmglob.com",
                "City" => "Seoul",
                "State" => "",
                "Country" => "KOREA,SOUTH",
            ],
            "ConsigneeDetails" => [
                "CompanyName" => $sheetData[$i][$table_key['Consignee Name']],
                "ContactName" => $sheetData[$i][$table_key['Consignee Name']],
                "AddressLine1" => "Block " . $sheetData[$i][$table_key['Block']],
                "AddressLine2" => "Street " . $sheetData[$i][$table_key['Street']],
                "AddressLine3" => "House " . $sheetData[$i][$table_key['House']],
                "TelephoneNumber" => $sheetData[$i][$table_key['Consignee Tel No']],
                "City" => $sheetData[$i][$table_key['City']],
                "Country" => "Kuwait",
            ],

            "PaymentDetails" => [
                "PaymentMethod" => "Credit",
                "PaymentCurrency" => "KWD",
                "PaymentBy" => "Sender",
            ],
            "LabelDetails" => [
                "BarcodeLabelPrintYN" => "Y",
                "AirwayBillLabelPrintYN" => "Y",
                "CommercialInvoicePrintYN" => "Y",
            ],
        ];

        $body = json_encode($body);
        $URI_Response = $client->request('POST', $URI, ['body' => $body]);
        $URI_Response = json_decode($URI_Response->getBody(), true);

        return $URI_Response;
    }
    public function create_glt($sheetData, $table_key, $i,$country)
    {
        $keys=['KSA'=>"a3Nob3BpbmE6YXNkZjEyMzQ=",'UAE'=>"S1NIT1BJTkFVQUU6S1NIT1BJTkExMjM=","KSA_TEST"=>"a3Nob3BpbmF0ZXN0OnF3ZTMyMWFzZA=="];
        
        $client = new guzzle([
            'headers' => [
                'Authorization' => 'Basic '.$keys[$country],
                'Content-Type' => 'application/json',
            ],
        ]);
        $URI = 'https://api.gltmena.com/api/create/order';

        $body = [
            "orders" => [[

                "referenceNumber" => $sheetData[$i][$table_key['Order Number']],
                "pieces" => $sheetData[$i][$table_key['PCS']],
                "description" => "CD (Book)",
                "codAmount" => $sheetData[$i][$table_key['COD Amount']],
                "paymentType" => $sheetData[$i][$table_key['Payment Type']],
                "clientComments" => "none",
                "sender" => "KSHOPINA",
                "senderInformation" => [
                    "city" => [
                        "name" => "South Korea",
                    ],
                    "address" => "9F, 34, Mapo Daero Mapo Gu Seoul South Korea",
                    "contactNumber" => "821076219222",
                ],
                "value" => $sheetData[$i][$table_key['Customs Value']],
                "customer" => [
                    "name" => $sheetData[$i][$table_key['Consignee Name']],
                    "customerAddresses" => [
                        "city" => [
                            "name" => $sheetData[$i][$table_key['City']],
                        ],
                        "address" => $sheetData[$i][$table_key['Address']],
                        "areaName" => $sheetData[$i][$table_key['Area Name']],
                    ],
                    "mobile1" => $sheetData[$i][$table_key['Consignee Tel No']],
                ],
                "weight" => $sheetData[$i][$table_key['Chargeable Weight']],
            ]],
        ];

        $body = json_encode($body);
        $URI_Response = $client->request('POST', $URI, ['body' => $body]);
        $URI_Response = json_decode($URI_Response->getBody(), true);

        return $URI_Response;
    }
    public function countries()
    {

        $client = new guzzle([
            'headers' => [
                'Authorization' => 'Basic a3Nob3BpbmE6YXNkZjEyMzQ=',
                'Content-Type' => 'application/json',
            ],
        ]);
        $URI = 'https://api.gltmena.com/api/get/all/cities';

        $body = [
            "id" => 45,
        ];

        $body = json_encode($body);
        $URI_Response = $client->request('POST', $URI, ['body' => $body]);
        $URI_Response = json_decode($URI_Response->getBody(), true);

        $spreadsheet1 = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $spreadsheet1->getActiveSheet()->setTitle('All');


        $city_codes = ['code'=>'empty'];
        $row = 1;

        foreach ($URI_Response['data'] as $key => $city) {

            if (!isset($city_codes[$city['code']])) {
                $spreadsheet1->getActiveSheet()->setCellValue('A'.$row, $city['name']);
                $city_codes[$city['code']]=$city['name'];
            } 

            $row+=1;
        }

        
        $name = date('Y-m-d--h-i-sa');
        $writer = new Xlsx($spreadsheet1);

        if (!file_exists('public/uploads')) {
            mkdir('public/uploads', 0777, true);
        }
        $writer->save(public_path('/uploads/cities' . $name . '.xlsx'));
        unset($reader);

        return $city_codes;

    }
    public function add_cities_to_database(){
        
        $cities=["Abha","Abqaiq","Abu Arish","Ad Darb","Ad Dilam","Ad Diriyah","Ahad Al Masarihah","Ahad Rafidah","AinDar","Al `Uyun","Al Amaaria","Al Aqiqah","Al Artawiyah","Al Badayea","Al Bahah","Al Bashayer","Al Bukayriyah","Al Ghat","Al Hasa","Al Hawiyah","Al Henakiyah","Al Hofuf","Al Huda","Al Husima","Al Jaradiyah","Al Jithamiyah","Al Juaima'h","Al Jubail","Al Jubaylah","Al Jumum","Al Ju'ranah","Al Karbus","Al Kharj","Al Khobar","Al Khurma","Al Lith","Al Madaya","Al Majmaah","Al Mithnab","Al Namas","Al Nuzha","Al Qaraa","Al Qasab","Al Qassim","Al Qatif","Al Qunfudhah","Al Qurainah","Al Salamah","Al Shuqaiq","Al Taraf","Al Ula","Al Uyaynah","Al Wadeen","Aldhabyah","Al-Fuwayliq","Aljouf","Al-Jsh","Al-Matan","Al-Muzahmiya","Al-Nasfah","Alsilaa","Al-Umran","Al-Wozeyh","An Nawwariyyah","Anak","Ar Rass","Arar","Asfan","Ash Shihyah","Ash Shinan","Audat Sudair","Awamiah","Ayn Ibn Fuhayd","Az Zulfi","Badr","Bahrah","Baish","Banban","Billasmar","Bisha","Buqayq","Buraydah","Damad","Dammam","Dhahban","Dhahran","Dhurma","Duba","EXPN","Ghizlan","Hail","Hautat Sudair","Hawiyah, Hofuf","Howtat Bani Tamim","Huraymila","Jazan","Jazan Economic City","Jeddah","Juatha","Julayjilah","Khamis Mushait","Khodariya","Khulais","Lahore","Mahalah","Mahd Al Thahab","Makkah","Malham","Marat","Mastorah","Medina","Mubaraz","Muhayil","Nabiya","Najran","Qarah","Qilwah","Qurayyat","Rabigh","Ras Tanura","Raudat Sudair","Riyadh","Riyadh Al Khabra","Rughabah","Sabt Aljarah","Sabya","Sadus","Safwa","Saihat","Sakaka","Salasil","Salbukh","Samtah","Sarat Abidah","Shaqra","Tabalah","Tabuk","Taif","Tanomah","Tarut","Tendaha","testin","Thadiq","Tharmda","Thuwal","Tubarjal","Turbah","Udhailiyah","Unayzah","Urayrah","Ushaiqer","Uthal","Uthmaniyah","Uyun Al Jawa","Wadi Bin Hashbal","Yanbu","Yanbu Al Bahr"];

        foreach ($cities as $key => $value) {
            DB::insert('insert into cities (country_id,name,status) values (?, ?, ?)', [1,$value, 1]);
        }
    }

    public function isExist($order_number)
    {
        $check = DB::select('select * from domestic where order_number = ?', [$order_number]);

        if ($check == null || $check == []) {
            return [false, []];
        } else {
            return [true, $check];
        }
    }
    public function add_domestic_awb($order_number, $domestic_awb, $company)
    {
        date_default_timezone_set('Asia/Seoul');
        $date = date('Y-m-d H:i:s', time());

        DB::table('domestic')->insert(['order_number' => $order_number, 'domestic_awb' => $domestic_awb, 'domestic_company' => $company, 'updated_at' => $date]);
    }
    public function update_domestic_awb($order_number, $domestic_awb, $company)
    {
        date_default_timezone_set('Asia/Seoul');
        $date = date('Y-m-d H:i:s', time());

        DB::table('domestic')
            ->where('order_number', $order_number)
            ->update(['domestic_awb' => $domestic_awb, 'domestic_company' => $company, 'updated_at' => $date]);
    }
    public function get_domestic_orders($page)
    {
        $orders_per_page = 15;
        $offset = ($page - 1) * $orders_per_page;

        $orders = DB::select('SELECT * FROM domestic where domestic_awb IS NOT NULL ORDER BY updated_at DESC LIMIT ?, ?;', [$offset, $orders_per_page]);
        $number_of_orders = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM kshopina.domestic where domestic_awb IS NOT NULL ;');

        return [$number_of_orders, $orders];
    }

    public function validate_ksp_with_order($ksp,$order_number)
    {
        $order=DB::select('SELECT * from orders where kshopina_awb = ? AND order_number = ?', [$ksp , $order_number]);

        if ($order==[] || $order==null) {
            return [false];
        } else {
            return [true,$order];
        }

    }

    public function add_additional_data($additional_data, $tracking_number, $id,$company)
    {
        date_default_timezone_set('Africa/Cairo');
        $date = date('Y-m-d H:i:s', time());

        DB::table('orders')->where('id', $id)->update(['weight' => $additional_data['weight'],
            'pieces' => $additional_data['pieces'],
            'volume_weight' => $additional_data['volume_weight'],
            'chargeable_weight' => $additional_data['chargeable_weight'],
            'domestic_awb' => $tracking_number,
            'lwb_created_at' => $date,'domestic_company'=>$company
        ]);
    }
}
