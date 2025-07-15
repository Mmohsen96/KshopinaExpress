<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx as XlsxReader;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx as XlsxWriter;

class ClientController extends Controller
{

    protected $historyModel;
    protected $clientModel;
    protected $domesticModel;

    public function __construct(Request $request)
    {
        $this->historyModel = new \App\Models\History();
        $this->clientModel = new \App\Models\Clients();
        $this->domesticModel = new \App\Models\Domestic();

    }
    /* function index()
    {
    return view('client_orders')->with('id',Auth::user()->id);
    } */
    public function under_review()
    {
        if (Auth::user()->active == 1) {
            return redirect('profile');
        } else {
            return view('under_review')->with('user', Auth::user());

        }
    }
    public function new_order()
    {
        return view('create_order')->with('user', Auth::user());
    }
    public function shippment_list()
    {
        try {
            $page = $_GET['page'];
        } catch (\Throwable $th) {
            $page = "1";
        }
        try {
            $ksp_number = $_GET['ksp_number'];
        } catch (\Throwable $th) {
            $ksp_number = "";
        }

        if (!empty($ksp_number)) {

            $shipments = $this->clientModel->get_shipment_for_client_search(Auth::user()->id, $ksp_number);
            return view('shippment_list')->with(['shipments' => $shipments]);

        } else {
            $shipments = $this->clientModel->get_client_shipment(Auth::user()->id, $page);

            $update = $this->clientModel->update_domestic_status($shipments[0]);

            if ($update) {
                $shipments = $this->clientModel->get_client_shipment(Auth::user()->id, $page);
            }
            return view('shippment_list')->with(['shipments' => $shipments[0], 'number_of_shipments' => $shipments[1]]);

        }

    }
    public function profile()
    {
        return view('profile')->with('user', Auth::user());
    }
    public function get_country_cities()
    {
        $country_id = $_POST['country'];

        return $this->clientModel->get_country_city($country_id);
    }
    public function send_shipper_info()
    {

        $shipper_data = $_POST['shipper_data'];

        $result = $this->clientModel->submit_shipper_info($shipper_data);
        return $result;

    }

    public function create_new_order(Request $request)
    {
        $data = request()->all();

        $checking_order = $this->clientModel->checking_order_already_exist($data);
        if ($checking_order != null && $checking_order != []) {

            return back()->with('error', 'Order already exists');

        } else {

            $shipment_id = $this->clientModel->create_new_order($data);

            $ksp_number = $this->clientModel->generate_ksp($data['customer_country'], $shipment_id);

            $barcode_image_name = $this->clientModel->generate_barcode($ksp_number);

            $this->clientModel->upload_barcode($shipment_id, $ksp_number, $barcode_image_name);

            $this->historyModel->create_kmex(Auth::user()->name, 'Create_order', "User create a new order with barcode image name *" . $barcode_image_name, $shipment_id);

            return back()->with('message', 'Order has been added successfully');
        }

    }
    public function barcodes()
    {
        return view('barcodes')->with(['orders' => []]);
    }

    public function scan_barcode()
    {
        $ksp_number = $_POST['barcode'];

        $shipment = $this->clientModel->get_shipment_by_ksp($ksp_number);

        /*  if ($shipment != null && $shipment != []) {
        $this->historyModel->create_kmex(Auth::user()->name, 'scan_barcode', "User scan the barcode with kspnumber #" . $shipment[0]->ksp_number, $shipment[0]->shipment_id);
        } else {
        $this->historyModel->create_kmex(Auth::user()->name, 'scan_barcode', "User scan wrong barcode", "error");
        } */

        return $shipment;
        /*  $shipments =$this->clientModel->get_shipment_by_ksp($ksp_number);
        dd($shipments); */
        /* return view('shippment_list')->with(['shipments' => $shipments]); */
    }

    public function scanBarcodes_details()
    {

        $ksp_number = $_GET['ksp_number'];

        return $this->clientModel->scanBarcodes_details($ksp_number);

    }

    public function delete_client_shipment()
    {
        $shipment_id = $_POST['id'];

        $response = $this->clientModel->delete_client_shipment($shipment_id);

        $this->historyModel->create_kmex(Auth::user()->name, 'delete_shipment', $response[1], $shipment_id);

        return (['status' => $response[0], 'message' => $response[1]]);

    }
    public function track_shipment()
    {
        try {
            $ksp_number = $_GET['kspNumber'];
        } catch (\Throwable $th) {
            http_response_code(404);
        }

        $shipment = $this->clientModel->get_shipment_by_ksp($ksp_number);

        $update = $this->clientModel->update_domestic_status($shipment);

        if ($update) {
            $shipment = $this->clientModel->get_shipment_by_ksp($ksp_number);
        }

        if ($shipment != null && $shipment != []) {
            return view('shipment_tracking')->with(['kshopina' => $shipment[0]->ksp_number, 'orignal_status' => $shipment[0]->status, 'shipment' => $shipment]);
        } else {
            return view('shipment_tracking')->with(['kshopina' => 'Invalid KSP number', 'orignal_status' => '-1']);
        }

    }

    public function scanBarcodes()
    {
        return view('barcodes_scan');
    }

    public function shipmments_client()
    {
        try {
            $page = $_GET['page'];
        } catch (\Throwable $th) {
            $page = "1";
        }
        try {
            $ksp_number = $_GET['ksp_number'];
        } catch (\Throwable $th) {
            $ksp_number = "";
        }
        try {
            $shipper_id = $_GET['shipper_id'];
        } catch (\Throwable $th) {
            $shipper_id = "";
        }
        try {
            $status = $_GET['status'];
        } catch (\Throwable $th) {
            $status = "All";
        }
        try {
            $country = $_GET['country'];
        } catch (\Throwable $th) {
            $country = "All";
        }
        try {
            $upload_date = $_GET['upload_date'];
        } catch (\Throwable $th) {
            $upload_date = "All";
        }

        if (!empty($shipper_id)) {

            $shipments = $this->clientModel->get_client_shipment($shipper_id, $page);

            return view('warehouse_shippment_list')->with(['shipments' => $shipments[0], 'number_of_shipments' => $shipments[1]]);

        } else if (!empty($ksp_number)) {

            $shipments = $this->clientModel->get_shipment_for_staff_search($ksp_number);

            return view('warehouse_shippment_list')->with(['shipments' => $shipments]);

        } else {
            $shipments = $this->clientModel->get_warehouse_shipmments($page, ['status' => $status, 'customer_country' => $country, 'shipment_upload_date' => $upload_date]);

            try {
                /* $update = $this->clientModel->update_domestic_status($shipments[0]);
                if ($update) { */
                    $shipments = $this->clientModel->get_warehouse_shipmments($page, ['status' => $status, 'customer_country' => $country, 'shipment_upload_date' => $upload_date]);
               /*  } */
            } catch (\Throwable $th) {
                return $th;
                $shipments = $this->clientModel->get_warehouse_shipmments($page, ['status' => $status, 'customer_country' => $country, 'shipment_upload_date' => $upload_date]);

            }
            return view('warehouse_shippment_list')->with(['shipments' => $shipments[0], 'number_of_shipments' => $shipments[1]]);

        }

    }

    public function get_shipments()
    {
        try {
            $page = $_GET['page'];
        } catch (\Throwable $th) {
            $page = "1";
        }

        $data = $this->clientModel->get_pending_shipments($page);

        return view('pending_shipments')->with(['shipments' => $data[0], 'number_of_shipments' => $data[1]]);

    }

    public function create_awb()
    {
        try {
            $shipment_id = $_GET['shipment_id'];
        } catch (\Throwable $th) {
            return view('create_awb')->with(['shipments' => [], 'payment' => []]);
        }

        $data = $this->clientModel->get_shipments($shipment_id);

        $shipments = $data[0];
        $payment = $data[1];

        if ($shipments == []) {
            return view('create_awb')->with(['shipments' => [], 'payment' => [], 'error' => true]);
        }

        return view('create_awb')->with(['shipments' => $shipments[0], 'payment' => $payment]);

    }
    public function create_awb_by_bulk()
    {
        try {
            $page = $_GET['page'];
        } catch (\Throwable $th) {
            $page = "1";
        }

        $result = $this->clientModel->get_history_of_awb_bulk_uploading(Auth::user()->id, $page,'KMEX');

        return view('create_bulk_awb')->with(['files' => $result[0], "number_of_files" => $result[1]]);
    }
    public function awb_bulk_upload(Request $request)
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

                    $shipment_info = $this->clientModel->validate_vendor_with_shipment($sheetData[$i][$table_key['KSP Number']], $sheetData[$i][$table_key['Order Number']]);

                    if ($shipment_info[0]) {
                        $shipment_info = $shipment_info[1];
                        $shipper_id = $shipment_info[0]->shipper_id;

                        try {
                            $URI_Response = $this->domesticModel->create_glt($sheetData, $table_key, $i,$request->countries);
                        } catch (\Throwable $th) {

                            /* $this->historyModel->create_kmex(Auth::user()->name, 'Create_awb', 'Some data are invalid with GLT!', $shipment[0]->shipment_id); */
                            array_push($orders_faild, $sheetData[$i][$table_key['KSP Number']]);

                            return $th;
                            /* return ['status' => 'fail', 'message' => 'Some data are invalid with GLT!']; */
                        }

                        if ($URI_Response['data']["orders"][0]['status'] == "fail") {

                            /* $this->historyModel->create_kmex(Auth::user()->name, 'Create_awb', $URI_Response['data']["orders"][0]['msg'], $shipment[0]->shipment_id); */
                            array_push($orders_faild, $sheetData[$i][$table_key['KSP Number']]);
                            $messages[$sheetData[$i][$table_key['KSP Number']]] = $URI_Response['data']["orders"][0]['msg'];
                            /* return ['status' => 'fail', 'message' => $URI_Response['data']["orders"][0]['msg']]; */
                        } else {

                            $tracking_number = $URI_Response['data']["orders"][0]['orderTrackingNumber'];

                            $additional_data = ['weight' => $sheetData[$i][$table_key['Actual Weight']],
                                'pieces' => $sheetData[$i][$table_key['PCS']],
                                'volume_weight' => $sheetData[$i][$table_key['Volume Weight']],
                                'chargeable_weight' => $sheetData[$i][$table_key['Chargeable Weight']]];

                            $this->clientModel->add_additional_data($additional_data, $tracking_number, $shipment_info[0]->shipment_id);

                            $this->clientModel->change_shipment_status([$shipment_info[0]->shipment_id => 3], 2);

                            array_push($success, $sheetData[$i][$table_key['KSP Number']]);

                            $messages[$sheetData[$i][$table_key['KSP Number']]] = 'Created successfully';
                            $awbs[$sheetData[$i][$table_key['KSP Number']]] = $tracking_number;

                            /* $this->historyModel->create_kmex(Auth::user()->name, 'Create_awb', $URI_Response['data']["orders"][0]['msg'] . ' with tracking number @' . $tracking_number, $shipment[0]->shipment_id);

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

                    $shipment_info = $this->clientModel->validate_vendor_with_shipment($sheetData[$i][$table_key['KSP Number']], $sheetData[$i][$table_key['Order Number']]);

                    if ($shipment_info[0]) {
                        $shipment_info = $shipment_info[1];
                        $shipper_id = $shipment_info[0]->shipper_id;

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

                            $this->clientModel->add_additional_data($additional_data, $tracking_number, $shipment_info[0]->shipment_id);

                            $this->clientModel->change_shipment_status([$shipment_info[0]->shipment_id => 3], 2);

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
            $spreadsheet1->getActiveSheet()->setTitle('Shipments');

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

            if (!file_exists(public_path('uploads/awb/result_files'))) {
                mkdir(public_path('uploads/awb/result_files'), 0777, true);
            }
            $result_file_Name = 'result_' . Auth::user()->id . '_' . time() . '.xlsx';

            $writer->save(public_path('uploads/awb/result_files/' . $result_file_Name));

            //
            unset($reader);

            $message = '(' . count($success) . ') Order Created Successfully , (' . count($orders_faild) . ') Order ERROR )';
            $this->clientModel->add_shipment_file_history(Auth::user()->id, Auth::user()->name, $file_name, 'N/A', count($orders_faild) + count($success), $message, $result_file_Name, "success","KMEX");

            /* return back()->with('success', '(' . $success . ') Order Created Successfully , (' . $orders_faild . ') Order ERROR'); */

            return back();
            //code...
        } catch (\Throwable $th) {
            return $th;
        }
    }
    public function generate_awb()
    {
        $shipment_id = $_POST['shipment_id'];

        $country = $_POST['country'];
        $additional_data = $_POST['additional_data'];

        $shipment = $this->clientModel->get_shipment_by_id($shipment_id);

        //KSA
        if ($country == 1) {
            try {
                $URI_Response = $this->clientModel->create_glt($shipment[0], $additional_data);
            } catch (\Throwable $th) {

                $this->historyModel->create_kmex(Auth::user()->name, 'Create_awb', 'Some data are invalid with GLT!', $shipment[0]->shipment_id);

                return ['status' => 'fail', 'message' => 'Some data are invalid with GLT!'];
            }

            if ($URI_Response['data']["orders"][0]['status'] == "fail") {

                $this->historyModel->create_kmex(Auth::user()->name, 'Create_awb', $URI_Response['data']["orders"][0]['msg'], $shipment[0]->shipment_id);

                return ['status' => 'fail', 'message' => $URI_Response['data']["orders"][0]['msg']];
            } else {

                $tracking_number = $URI_Response['data']["orders"][0]['orderTrackingNumber'];

                $this->clientModel->add_additional_data($additional_data, $tracking_number, $shipment[0]->shipment_id);
                $this->clientModel->change_shipment_status([$shipment[0]->shipment_id => 3], 2);

                $this->historyModel->create_kmex(Auth::user()->name, 'Create_awb', $URI_Response['data']["orders"][0]['msg'] . ' with tracking number @' . $tracking_number, $shipment[0]->shipment_id);

                return ['status' => 'success', 'message' => $URI_Response['data']["orders"][0]['msg'], 'tracking_number' => $tracking_number];
            }
        }

    }
    public function download_awb()
    {
        $awb = $_POST['awb'];
        $country = $_POST['country'];

        //KSA
        if ($country == 1) {
            $this->clientModel->awb_printed($awb);
            return $this->clientModel->download_glt($awb);
        }
    }

    public function submit_barcodes()
    {
        $shipments = $_POST['shipments'];

        $this->clientModel->update_status_date($shipments, 'barcode_scaned_at');
        $this->clientModel->change_shipment_status($shipments, 1);

        foreach ($shipments as $shipment_id => $value) {
            $this->historyModel->create_kmex(Auth::user()->name, 'scan_barcode', "User scan the barcode ", $shipment_id);
        }
    }
    public function submit_dispatch()
    {
        $shipments = $_POST['shipments'];
        $this->clientModel->update_status_date($shipments, 'shipment_dispatched_at');
        $this->clientModel->change_shipment_status($shipments, 3);

        foreach ($shipments as $shipment_id => $value) {
            $this->historyModel->create_kmex(Auth::user()->name, 'dispatched', "User mark the shipment as dispatched ", $shipment_id);
        }
    }
    public function accounts_managment()
    {
        try {
            $page = $_GET['page'];
        } catch (\Throwable $th) {
            $page = "1";
        }

        $accounts = $this->clientModel->get_accounts($page);

        return view('accounts_managment')->with(['accounts' => $accounts[0], 'number_of_accounts' => $accounts[1]]);

    }

    public function vendors_shipments()
    {
        try {
            $page = $_GET['page'];
        } catch (\Throwable $th) {
            $page = "1";
        }

        try {
            $shipments = $this->clientModel->get_vendors_shipments($page);
        } catch (\Throwable $th) {
            return $th;
        }

        return view('vendors_shipments')->with(['shipments' => $shipments[0], 'received_shipments' => $shipments[1], 'all_shipments' => $shipments[2]]);

    }
    public function toggle_users_active()
    {
        $id = $_POST['id'];
        $active = $_POST['active'];

        $accounts = $this->clientModel->toggle_users_active($id, $active);

        $this->historyModel->create_kmex(Auth::user()->name, 'Users_managment', "User change the account ~" . $id . " status to " . $active, "");

    }

    /* public function generate ()
    {
    $barcode = $this->clientModel->generate_barcode('122212');

    }
     */

    public function search_shipment_result()
    {
        $value = $_POST['content'];
        $user = $_POST['user'];
        $user_type = $_POST['user_type'];

        if ($user_type == 1) {
            return $this->clientModel->shipment_like_client($value, $user);
        } else {
            return $this->clientModel->shipment_like_staff($value);
        }
    }

    public function get_upload_orders_page(Request $request)
    {
        try {
            $page = $_GET['page'];
        } catch (\Throwable $th) {
            $page = "1";
        }

        $result = $this->clientModel->get_history_of_vendor_bulk_uploading(Auth::user()->id, $page);

        return view('create_orders')->with(['files' => $result[0], "number_of_files" => $result[1]]);
    }
    public function import(Request $request)
    {
        $request->validate([

            'file' => 'required|mimes:xls,xlsx',

        ]);
        try {
            $file_name = $_FILES['file']['name'];

            $result = $this->clientModel->import($request->file('file'), Auth::user()->id);

            if ($result['status'] == 'fail') {
                $this->clientModel->add_upload_file_history(Auth::user()->id, $file_name, 'N/A', 'N/A', $result['message'], 'N/A', "Fail");
            } else {
                $this->clientModel->add_upload_file_history(Auth::user()->id, $file_name, $result['source_file_new_name'], $result['number_of_shipments'], $result['message'], $result['result_file_name'], "Success");
            }
        } catch (\Throwable $th) {
            return $th;
        }

        return back();

    }

    public function insert_user_url()
    {
        $user_url = $_POST['user_url'];
        return $this->clientModel->insert_user_url($user_url);

    }

    public function get_user_url()
    {
        //$client= Auth::user()->id;
        $form_url = $this->clientModel->get_user_url(Auth::user()->id);

        return view('import')->with(['form_url' => $form_url[0]->form_url]);
    }

    public function add_claim()
    {
        $ksp_number = $_POST['ksp_number'];
        $claim = $_POST['claim'];
        $shipper_id = $_POST['shipper_id'];
        $customer_email = $_POST['customer_email'];

        $this->clientModel->add_claim($ksp_number, $claim, $shipper_id, $customer_email);

        return back()->with('message', 'claim has been sent successfully');

    }
}
