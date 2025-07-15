<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx as XlsxReader;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx as XlsxWriter;

class DomesticController extends Controller
{
    protected $ordersModel;
    protected $internationalModel;
    protected $domesticModel;
    protected $itemsModel;
    protected $historyModel;
    protected $clientModel;

    public function __construct(Request $request)
    {
        $this->middleware('auth');
        $this->ordersModel = new \App\Models\Orders();
        $this->internationalModel = new \App\Models\International();
        $this->domesticModel = new \App\Models\Domestic();
        $this->itemsModel = new \App\Models\Items();
        $this->historyModel = new \App\Models\History();
        $this->clientModel = new \App\Models\Clients();

    }
//expired
    public function index()
    {
        $user = Auth::user();
        $page = $_GET['page'];
        $orders = $this->ordersModel->getOrders($user->country, $page);
        foreach ($orders[1] as $key => $value) {
            if ($value->status < 4) {

                $response = $this->internationalModel->updatee($value, $value->kshopina_awb);
                if ($response['warehouse'] != null) {
                    $this->ordersModel->changeUpdate(1, $value->order_number);
                }
                $data = $this->ordersModel->changestatus($value->order_number, $response);
            }
        }
        $orders = $this->ordersModel->getOrders($user->country, $page);

        return view('domestic')->with(['orders' => $orders[1], 'number_of_orders' => $orders[0]]);
    }
    public function left_the_hub()
    {
        $order_number = $_POST['order'];

        date_default_timezone_set('Asia/Seoul');
        $date = date('Y-m-d H:i:s', time());

        $domestic = array(
            'fulfilled' => null,
            'dispatched' => null,
            'customs' => null,
            'warehouse' => null,
            'delivery' => $date,
            'delivered' => null,
        );

        $this->ordersModel->changestatus($order_number, $domestic);
        $this->ordersModel->changeUpdate(1, $order_number);
        $this->domesticModel->updateDomestic($order_number, ['domestic' => $date]);

        $this->historyModel->create(Auth::user()->name, 'Domestic', 'Mark order as left the warehouse for order number #' . $order_number);

        /*          return redirect()->action('DomesticController@delivery');
     */
    }

    public function delivery()
    {
        $user = Auth::user();
        $page = $_GET['page'];

        $orders = $this->ordersModel->get_archived_Orders($user->country, $page);

        foreach ($orders[1] as $key => $value) {
            if ($value->status < 4) {

                $response = $this->internationalModel->updatee($value, $value->kshopina_awb);
                if ($response['warehouse'] != null) {
                    $this->ordersModel->changeUpdate(1, $value->order_number);
                }
                $data = $this->ordersModel->changestatus($value->order_number, $response);
            }
        }
        $orders = $this->ordersModel->get_archived_Orders($user->country, $page);

        if ($user->country == 'All') {
            return view('delivery')->with([
                'orders' => $orders[1], 'number_of_orders' => $orders[0],
                'egypt' => $orders[2],
                'kuwait' => $orders[3],
                'ksa' => $orders[4],
            ]);
        } else {
            return view('delivery')->with(['orders' => $orders[1], 'number_of_orders' => $orders[0]]);
        }
    }
//
    public function get_items()
    {
        $order_number = $_GET['order'];
        $items = $this->itemsModel->getItems_with_total($order_number);
        return (array) $items;
    }

    public function import()
    {
        try {
            $page = $_GET['page'];
        } catch (\Throwable $th) {
            $page = "1";
        }
        /*  try {
        $rule = $_GET['filter'];
        } catch (\Throwable $th) {
        $rule = "All";
        } */

        $all_orders = $this->domesticModel->get_domestic_orders($page);
        return view('domesticUpload')->with([
            'orders' => $all_orders[1], 'number_of_orders' => $all_orders[0],
        ]);
    }
    public function download_glt()
    {
        $awb = $_POST['awb'];

        $header = array(
            'http' => array(
                'method' => "POST",
                'header' => "Authorization: Basic a3Nob3BpbmE6YXNkZjEyMzQ=",
            ),

        );

        $context = stream_context_create($header);
        $order = 'https://api.gltmena.com/api/get/awb?orderid=' . $awb;
        // Open the file using the HTTP headers set above

        header("Content-type: application/octet-stream");
        header('Content-Type: application/pdf');
        header("Content-Transfer-Encoding: Binary");
        header("Content-disposition: attachment; filename=" . $awb . ".pdf");
        return file_get_contents($order, false, $context);
    }
    public function upload(Request $request)
    {
        $this->validate($request, [
            'select_file' => 'required|mimes:xls,xlsx',
        ]);

        $path = $request->file('select_file');
        $file_name = $_FILES['select_file']['name'];
        $company = request()->all();
        $company = $company['company'];

        //Read Excel Sheet
        $reader = new Xlsx();
        $reader->setReadDataOnly(true);
        $reader->setReadEmptyCells(false);

        $spreadsheet = $reader->load($path);
        $sheet = $spreadsheet->getSheet(0);

        $highestRow = $sheet->getHighestRow();
        $highestColumn = $sheet->getHighestColumn();

        $sheetData = $sheet->rangeToArray(
            'A1:' . $highestColumn . $highestRow,
            null

        );
        unset($reader);

        ignore_user_abort();
        if ($company == 'OCS') {
            $table_key = [];
            $orders_faild = 0;
            $success = 0;

            for ($i = 0; $i < sizeof($sheetData[0]); $i++) {
                if ($sheetData[0][$i] == 'Order Number') {
                    $table_key['Order Number'] = $i;
                } else if ($sheetData[0][$i] == 'Consignee Name') {
                    $table_key['Consignee Name'] = $i;
                } else if ($sheetData[0][$i] == 'Block') {
                    $table_key['Block'] = $i;
                } else if ($sheetData[0][$i] == 'Street') {
                    $table_key['Street'] = $i;
                } else if ($sheetData[0][$i] == 'House') {
                    $table_key['House'] = $i;
                } else if ($sheetData[0][$i] == 'City') {
                    $table_key['City'] = $i;
                } else if ($sheetData[0][$i] == 'Consignee Tel No') {
                    $table_key['Consignee Tel No'] = $i;
                } else if ($sheetData[0][$i] == 'Actual Weight') {
                    $table_key['Actual Weight'] = $i;
                } else if ($sheetData[0][$i] == 'Date') {
                    $table_key['Date'] = $i;
                } else if ($sheetData[0][$i] == 'PCS') {
                    $table_key['PCS'] = $i;
                } else if ($sheetData[0][$i] == 'COD Amount') {
                    $table_key['COD Amount'] = $i;
                } else if ($sheetData[0][$i] == 'Customs Value') {
                    $table_key['Customs Value'] = $i;
                }
            }
            for ($i = 1; $i < sizeof($sheetData); $i++) {

                if ($sheetData[$i][$table_key['Order Number']] == null || $sheetData[$i][$table_key['Order Number']] == "") {
                    break;
                }

                $URI_Response = $this->domesticModel->create_Ocs($sheetData, $table_key, $i);

                if ($URI_Response['ResponseStatus']["Status"] == "Error") {
                    $orders_faild = $orders_faild + 1;
                } else {
                    $success = $success + 1;
                    if ($this->domesticModel->isExist($sheetData[$i][$table_key['Order Number']])[0]) {

                        $this->domesticModel->update_domestic_awb($sheetData[$i][$table_key['Order Number']], $URI_Response['ResponseShipmentDetails']["ReferenceNumber"], "OCS");
                    } else {
                        $this->domesticModel->add_domestic_awb($sheetData[$i][$table_key['Order Number']], $URI_Response['ResponseShipmentDetails']["ReferenceNumber"], "OCS");
                    }
                }
            }
            $this->historyModel->create(Auth::user()->name, 'OCS Excel', '(' . $success . ') Order Created Successfully , (' . $orders_faild . ') Order ERROR');

            return back()->with('success', '(' . $success . ') Order Created Successfully , (' . $orders_faild . ') Order ERROR');
        } else {
            $table_key = [];
            $orders_faild = 0;
            $success = 0;

            for ($i = 0; $i < sizeof($sheetData[0]); $i++) {
                if ($sheetData[0][$i] == 'Order Number') {
                    $table_key['Order Number'] = $i;
                } else if ($sheetData[0][$i] == 'Consignee Name') {
                    $table_key['Consignee Name'] = $i;
                } else if ($sheetData[0][$i] == 'Address') {
                    $table_key['Address'] = $i;
                } else if ($sheetData[0][$i] == 'Area Name') {
                    $table_key['Area Name'] = $i;
                } else if ($sheetData[0][$i] == 'City') {
                    $table_key['City'] = $i;
                } else if ($sheetData[0][$i] == 'Consignee Tel No') {
                    $table_key['Consignee Tel No'] = $i;
                } else if ($sheetData[0][$i] == 'Actual Weight') {
                    $table_key['Actual Weight'] = $i;
                } else if ($sheetData[0][$i] == 'Payment Type') {
                    $table_key['Payment Type'] = $i;
                } else if ($sheetData[0][$i] == 'PCS') {
                    $table_key['PCS'] = $i;
                } else if ($sheetData[0][$i] == 'COD Amount') {
                    $table_key['COD Amount'] = $i;
                } else if ($sheetData[0][$i] == 'Customs Value') {
                    $table_key['Customs Value'] = $i;
                }
            }
            for ($i = 1; $i < sizeof($sheetData); $i++) {
                if ($sheetData[$i][$table_key['Order Number']] == null || $sheetData[$i][$table_key['Order Number']] == "") {
                    break;
                }
                $URI_Response = $this->domesticModel->create_glt($sheetData, $table_key, $i,$request->country);

                if ($URI_Response['data']["orders"][0]['status'] == "fail") {
                    $orders_faild = $orders_faild + 1;
                } else {
                    $success = $success + 1;
                    if ($this->domesticModel->isExist($sheetData[$i][$table_key['Order Number']])[0]) {

                        $this->domesticModel->update_domestic_awb($sheetData[$i][$table_key['Order Number']], $URI_Response['data']["orders"][0]['orderTrackingNumber'], "GLT");
                    } else {
                        $this->domesticModel->add_domestic_awb($sheetData[$i][$table_key['Order Number']], $URI_Response['data']["orders"][0]['orderTrackingNumber'], "GLT");
                    }
                }
            }
            $this->historyModel->create(Auth::user()->name, 'GLT Excel', '(' . $success . ') Order Created Successfully , (' . $orders_faild . ') Order ERROR');

            return back()->with('success', '(' . $success . ') Order Created Successfully , (' . $orders_faild . ') Order ERROR');
        }
    }
    public function upload1(Request $request)
    {
        $this->validate($request, [
            'select_file' => 'required|mimes:xls,xlsx',
        ]);

        $path = $request->file('select_file');
        $file_name = $_FILES['select_file']['name'];
        $company = request()->all();
        $company = $company['company'];
        //Read Excel Sheet
        $reader = new Xlsx();
        $reader->setReadDataOnly(true);
        $reader->setReadEmptyCells(false);

        $spreadsheet = $reader->load($path);
        $sheet = $spreadsheet->getSheet(0);

        $highestRow = $sheet->getHighestRow();
        $highestColumn = $sheet->getHighestColumn();

        $sheetData = $sheet->rangeToArray(
            'A1:' . $highestColumn . $highestRow,
            null

        );
        unset($reader);

        ignore_user_abort();
        if ($company == 'OCS') {
            $table_key = [];
            $orders_faild = 0;
            $success = 0;

            for ($i = 0; $i < sizeof($sheetData); $i++) {

                $this->domesticModel->change($sheetData[$i][0], $sheetData[$i][1]);
            }
        }
    }
    public function staff_bulk_awb(Request $request)
    {
        try {
            $page = $_GET['page'];
        } catch (\Throwable $th) {
            $page = "1";
        }
        
        $result = $this->clientModel->get_history_of_awb_bulk_uploading(Auth::user()->id, $page,"EXPRESS");

        return view('create_bulk_awb_express')->with(['files' => $result[0], "number_of_files" => $result[1],'page' => 'awb_create']);
    }
    public function awb_bulk_upload_express(Request $request)
    {
        try {

            $this->validate($request, [
                'awb_excel' => 'required|mimes:xls,xlsx',
            ]);

            $path = $request->file('awb_excel');
            $file_name = $_FILES['awb_excel']['name'];

            //Read Excel Sheet
            $reader = new XlsxReader();
            $reader->setReadDataOnly(true);
            $reader->setReadEmptyCells(false);

            $spreadsheet = $reader->load($path);
            $sheet = $spreadsheet->getSheet(0);

            $highestRow = $sheet->getHighestRow();
            $highestColumn = $sheet->getHighestColumn();

            $sheetData = $sheet->rangeToArray(
                'A1:' . $highestColumn . $highestRow,
                null

            );
            unset($reader);

            ignore_user_abort();

            $table_key = [];
            $orders_faild = [];
            $success = [];
            $messages = [];
            $awbs = [];
            $company='';
            $table_key=['Order Number'=>'NULL','Consignee Name'=>'NULL',
                'Address'=>'NULL',
                'Area Name'=>'NULL',
                'City'=>'NULL',
                'Consignee Tel No'=>'NULL',
                'Actual Weight'=>'NULL',
                'Volume Weight'=>'NULL',
                'Chargeable Weight'=>'NULL',
                'Payment Type'=>'NULL',
                'PCS'=>'NULL',
                'COD Amount'=>'NULL',
                'Customs Value'=>'NULL',
                'KSP Number'=>'NULL'];

            $ocs_key=['KSP Number'=>'NULL','Order Number'=>'NULL','Consignee Name'=>'NULL','Consignee Tel No'=>'NULL',
                'Block'=>'NULL',
                'Street'=>'NULL',
                'House'=>'NULL',
                'City'=>'NULL',

                'Actual Weight'=>'NULL',
                'Volume Weight'=>'NULL',
                'Chargeable Weight'=>'NULL',
                'Payment Type'=>'NULL',
                'PCS'=>'NULL',
                'COD Amount'=>'NULL',
                'Customs Value'=>'NULL',
            ];

            for ($i = 0; $i < sizeof($sheetData[0]); $i++) {
                if ($sheetData[0][$i] == 'Order Number') {
                    $table_key['Order Number'] = $i;
                    $ocs_key['Order Number'] = $i;
                } else if ($sheetData[0][$i] == 'Consignee Name') {
                    $table_key['Consignee Name'] = $i;
                    $ocs_key['Consignee Name'] = $i;
                } else if ($sheetData[0][$i] == 'Address') {
                    $table_key['Address'] = $i;
                    $ocs_key['Address'] = $i;
                } else if ($sheetData[0][$i] == 'Area Name') {
                    $table_key['Area Name'] = $i;
                    $ocs_key['Area Name'] = $i;

                } else if ($sheetData[0][$i] == 'City') {
                    $table_key['City'] = $i;
                    $ocs_key['City'] = $i;

                } else if ($sheetData[0][$i] == 'Consignee Tel No') {
                    $table_key['Consignee Tel No'] = $i;
                    $ocs_key['Consignee Tel No'] = $i;

                } else if ($sheetData[0][$i] == 'Actual Weight') {
                    $table_key['Actual Weight'] = $i;
                    $ocs_key['Actual Weight'] = $i;

                } else if ($sheetData[0][$i] == 'Volume Weight') {
                    $table_key['Volume Weight'] = $i;
                    $ocs_key['Volume Weight'] = $i;

                } else if ($sheetData[0][$i] == 'Chargeable Weight') {
                    $table_key['Chargeable Weight'] = $i;
                    $ocs_key['Chargeable Weight'] = $i;

                } else if ($sheetData[0][$i] == 'Payment Type') {
                    $table_key['Payment Type'] = $i;
                    $ocs_key['Payment Type'] = $i;

                } else if ($sheetData[0][$i] == 'PCS') {
                    $table_key['PCS'] = $i;
                    $ocs_key['PCS'] = $i;

                } else if ($sheetData[0][$i] == 'COD Amount') {
                    $table_key['COD Amount'] = $i;
                    $ocs_key['COD Amount'] = $i;

                } else if ($sheetData[0][$i] == 'Customs Value') {
                    $table_key['Customs Value'] = $i;
                    $ocs_key['Customs Value'] = $i;

                } else if ($sheetData[0][$i] == 'KSP Number') {
                    $table_key['KSP Number'] = $i;
                    $ocs_key['KSP Number'] = $i;

                }
                else if ($sheetData[0][$i] == 'Block') {
                    $table_key['Block'] = $i;
                    $ocs_key['Block'] = $i;

                }
                else if ($sheetData[0][$i] == 'Street') {
                    $table_key['Street'] = $i;
                    $ocs_key['Street'] = $i;

                }
                else if ($sheetData[0][$i] == 'House') {
                    $table_key['House'] = $i;
                    $ocs_key['House'] = $i;

                }
            }

            if (count($table_key) == 14) {
                foreach ($table_key as $key => $value) {
                    if ($value=='NULL' && $key !='KSP Number') {
                        return back()->with(['error'=> 'Invalid templete!','val'=>$key]);
                    }
                }
                $company='glt';
            }
            elseif(count($ocs_key) == 15){
                foreach ($ocs_key as $key => $value) {
                    if ($value =="NULL" && $key !='KSP Number') {
                        return back()->with(['error'=> 'Invalid templete!','val'=>$key]);
                    }
                }
                $company='ocs';
            }
            else{
                return back()->with('error', 'Invalid templete!');
            }


            if ($company=='glt') {
                for ($i = 1; $i < sizeof($sheetData); $i++) {
                    if ($sheetData[$i][$table_key['Order Number']] == null || preg_replace('/\s+/', '', $sheetData[$i][$table_key['Order Number']]) == "" || preg_replace('/\s+/', '', $sheetData[$i][$table_key['KSP Number']]) == "") {
                        break;
                    }

                    if ($sheetData[$i][$table_key['Payment Type']] != 'COD' && $sheetData[$i][$table_key['Payment Type']] != 'CC' && $sheetData[$i][$table_key['Payment Type']] != 'cod' && $sheetData[$i][$table_key['Payment Type']] != 'cc') {
                        array_push($orders_faild, $sheetData[$i][$table_key['KSP Number']]);
                        $messages[$sheetData[$i][$table_key['KSP Number']]] = "Undefined payment type!";
                        continue;
                    } elseif (preg_replace('/\s+/', '', $sheetData[$i][$table_key['Chargeable Weight']]) == "" && preg_replace('/\s+/', '', $sheetData[$i][$table_key['Chargeable Weight']]) == "0" && preg_replace('/\s+/', '', $sheetData[$i][$table_key['Chargeable Weight']]) == 0) {
                        array_push($orders_faild, $sheetData[$i][$table_key['KSP Number']]);
                        $messages[$sheetData[$i][$table_key['KSP Number']]] = "Chargeable Weight can not be empty!";
                        continue;

                    } elseif (preg_replace('/\s+/', '', $sheetData[$i][$table_key['PCS']]) == "" && preg_replace('/\s+/', '', $sheetData[$i][$table_key['PCS']]) == "0" && preg_replace('/\s+/', '', $sheetData[$i][$table_key['PCS']]) == 0) {
                        array_push($orders_faild, $sheetData[$i][$table_key['KSP Number']]);
                        $messages[$sheetData[$i][$table_key['KSP Number']]] = "You should define number of pieces";
                        continue;
                    }

                    $order_info = $this->domesticModel->validate_ksp_with_order($sheetData[$i][$table_key['KSP Number']], $sheetData[$i][$table_key['Order Number']]);

                    if ($order_info[0]) {
                        $order_info = $order_info[1];

                        try {
                            $URI_Response = $this->domesticModel->create_glt($sheetData, $table_key, $i,$request->countries);
                        } catch (\Throwable $th) {

                            /* $this->historyModel->create_kmex(Auth::user()->name, 'Create_awb', 'Some data are invalid with GLT!', $shipment[0]->id); */
                            array_push($orders_faild, $sheetData[$i][$table_key['KSP Number']]);

                            return $th;
                            /* return ['status' => 'fail', 'message' => 'Some data are invalid with GLT!']; */
                        }

                        if ($URI_Response['data']["orders"][0]['status'] == "fail") {

                            /* $this->historyModel->create_kmex(Auth::user()->name, 'Create_awb', $URI_Response['data']["orders"][0]['msg'], $shipment[0]->id); */
                            array_push($orders_faild, $sheetData[$i][$table_key['KSP Number']]);
                            $messages[$sheetData[$i][$table_key['KSP Number']]] = $URI_Response['data']["orders"][0]['msg'];
                            /* return ['status' => 'fail', 'message' => $URI_Response['data']["orders"][0]['msg']]; */
                        } else {

                            $tracking_number = $URI_Response['data']["orders"][0]['orderTrackingNumber'];

                            $additional_data = ['weight' => $sheetData[$i][$table_key['Actual Weight']],
                                'pieces' => $sheetData[$i][$table_key['PCS']],
                                'volume_weight' => $sheetData[$i][$table_key['Volume Weight']],
                                'chargeable_weight' => $sheetData[$i][$table_key['Chargeable Weight']]];

                            $this->domesticModel->add_additional_data($additional_data, $tracking_number, $order_info[0]->id,'GLT');

                            array_push($success, $sheetData[$i][$table_key['KSP Number']]);

                            $messages[$sheetData[$i][$table_key['KSP Number']]] = 'Created successfully';
                            $awbs[$sheetData[$i][$table_key['KSP Number']]] = $tracking_number;

                            /* $this->historyModel->create_kmex(Auth::user()->name, 'Create_awb', $URI_Response['data']["orders"][0]['msg'] . ' with tracking number @' . $tracking_number, $shipment[0]->id);

                        return ['status' => 'success', 'message' => $URI_Response['data']["orders"][0]['msg'], 'tracking_number' => $tracking_number]; */
                        }

                    } else {
                        $messages[$sheetData[$i][$table_key['KSP Number']]] = 'NOT FOUND';
                        array_push($orders_faild, $sheetData[$i][$table_key['KSP Number']]);
                    }

                }

            } elseif($company=='ocs') {
                for ($i = 1; $i < sizeof($sheetData); $i++) {
                    if ($sheetData[$i][$table_key['Order Number']] == null || preg_replace('/\s+/', '', $sheetData[$i][$table_key['Order Number']]) == "" || preg_replace('/\s+/', '', $sheetData[$i][$table_key['KSP Number']]) == "") {
                        break;
                    }

                    if ($sheetData[$i][$table_key['Payment Type']] != 'COD' && $sheetData[$i][$table_key['Payment Type']] != 'CC' && $sheetData[$i][$table_key['Payment Type']] != 'cod' && $sheetData[$i][$table_key['Payment Type']] != 'cc') {
                        array_push($orders_faild, $sheetData[$i][$table_key['KSP Number']]);
                        $messages[$sheetData[$i][$table_key['KSP Number']]] = "Undefined payment type!";
                        continue;
                    } elseif (preg_replace('/\s+/', '', $sheetData[$i][$table_key['Chargeable Weight']]) == "" && preg_replace('/\s+/', '', $sheetData[$i][$table_key['Chargeable Weight']]) == "0" && preg_replace('/\s+/', '', $sheetData[$i][$table_key['Chargeable Weight']]) == 0) {
                        array_push($orders_faild, $sheetData[$i][$table_key['KSP Number']]);
                        $messages[$sheetData[$i][$table_key['KSP Number']]] = "Chargeable Weight can not be empty!";
                        continue;

                    } elseif (preg_replace('/\s+/', '', $sheetData[$i][$table_key['PCS']]) == "" && preg_replace('/\s+/', '', $sheetData[$i][$table_key['PCS']]) == "0" && preg_replace('/\s+/', '', $sheetData[$i][$table_key['PCS']]) == 0) {
                        array_push($orders_faild, $sheetData[$i][$table_key['KSP Number']]);
                        $messages[$sheetData[$i][$table_key['KSP Number']]] = "You should define number of pieces";
                        continue;
                    }

                    $order_info = $this->domesticModel->validate_ksp_with_order(preg_replace('/\s+/', '', $sheetData[$i][$table_key['KSP Number']]), preg_replace('/\s+/', '', $sheetData[$i][$table_key['Order Number']]));
                    
                    if ($order_info[0]) {
                        $order_info = $order_info[1];

                        try {
                            $URI_Response = $this->domesticModel->create_Ocs($sheetData, $table_key, $i);
                        } catch (\Throwable $th) {

                            /* $this->historyModel->create_kmex(Auth::user()->name, 'Create_awb', 'Some data are invalid with GLT!', $shipment[0]->shipment_id); */
                            array_push($orders_faild, $sheetData[$i][$table_key['KSP Number']]);

                            return $th;
                            /* return ['status' => 'fail', 'message' => 'Some data are invalid with GLT!']; */
                        }

                        if ($URI_Response['ResponseStatus']["Status"] == "Error") {

                            array_push($orders_faild, $sheetData[$i][$table_key['KSP Number']]);
                            $messages[$sheetData[$i][$table_key['KSP Number']]] = $URI_Response['ResponseStatus']["StatusDetails"];

                        } else {

                            $tracking_number = $URI_Response['ResponseShipmentDetails']["ReferenceNumber"];

                            $additional_data = ['weight' => $sheetData[$i][$table_key['Actual Weight']],
                                'pieces' => $sheetData[$i][$table_key['PCS']],
                                'volume_weight' => $sheetData[$i][$table_key['Volume Weight']],
                                'chargeable_weight' => $sheetData[$i][$table_key['Chargeable Weight']]];

                            $this->domesticModel->add_additional_data($additional_data, $tracking_number, $order_info[0]->id,'OCS');


                            array_push($success, $sheetData[$i][$table_key['KSP Number']]);

                            $messages[$sheetData[$i][$table_key['KSP Number']]] = 'Created successfully';
                            $awbs[$sheetData[$i][$table_key['KSP Number']]] = $tracking_number;

                        }

                    } else {
                        $messages[$sheetData[$i][$table_key['KSP Number']]] = 'NOT FOUND';
                        array_push($orders_faild, $sheetData[$i][$table_key['KSP Number']]);
                    }

                }
            }
            $result_file_counter = 2;
            $spreadsheet1 = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
            $spreadsheet1->getActiveSheet()->setTitle('Orders');

            $spreadsheet1->getSheet(0)->setCellValue('A1', 'KSP Number');

            $spreadsheet1->getSheet(0)->setCellValue('B1', 'Status');
            $spreadsheet1->getSheet(0)->setCellValue('C1', 'Message');

            $spreadsheet1->getSheet(0)->setCellValue('D1', 'Tracking Number');

            foreach ($messages as $ksp => $result) {
                $spreadsheet1->getSheet(0)->setCellValue('A' . $result_file_counter, $ksp);

                if (isset($awbs[$ksp])) {
                    $spreadsheet1->getSheet(0)->setCellValue('B' . $result_file_counter, 'Success');
                    $spreadsheet1->getSheet(0)->setCellValue('D' . $result_file_counter, $awbs[$ksp]);

                } else {
                    $spreadsheet1->getSheet(0)->setCellValue('B' . $result_file_counter, "Fail");
                    $spreadsheet1->getSheet(0)->setCellValue('D' . $result_file_counter, "N/A");
                }
                $spreadsheet1->getSheet(0)->setCellValue('C' . $result_file_counter, $result);
                $result_file_counter+=1;
            }
            $writer = new XlsxWriter($spreadsheet1);

            if (!file_exists(public_path('uploads/awb/result_files_express'))) {
                mkdir(public_path('uploads/awb/result_files_express'), 0777, true);
            }
            $result_file_Name = 'result_' . Auth::user()->id . '_' . time() . '.xlsx';

            $writer->save(public_path('uploads/awb/result_files_express/' . $result_file_Name));

            //
            unset($reader);

            $message = '(' . count($success) . ') Order Created Successfully , (' . count($orders_faild) . ') Order ERROR ';
            $this->clientModel->add_shipment_file_history(Auth::user()->id, Auth::user()->name, $file_name, 'N/A', count($orders_faild) + count($success), $message, $result_file_Name, "success","EXPRESS");

            /* return back()->with('success', '(' . $success . ') Order Created Successfully , (' . $orders_faild . ') Order ERROR'); */

            return back();
            //code...
        } catch (\Throwable $th) {
            return $th;
        }
    }
    
    /* function get_cities(){
$this->domesticModel->add_cities_to_database();
return $this->domesticModel->countries();
} */
}
