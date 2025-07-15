<?php

namespace App\Http\Controllers;

use DateTime;
use DateTimeZone;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Helpers\UserSystemInfoHelper;
use App\Jobs\AddToGroup;
use App\Mail\Discount;
use App\Mail\OrderDetailsMail;


use GuzzleHttp\Client as guzzle;
use SoapClient;
use SoapFault;
use App\Models\tst;
use App\Models\WhatsApp;
use Illuminate\Support\Facades\Mail;

class VerificationController extends Controller
{    private $Naqel_keys=[];

    protected $verificationModel;
    protected $ordersModel;
    protected $itemsModel;
    protected $historyModel;
    protected $tstModel;
    protected $domesticModel;
    private $status = ['Verified' => 0, 'Fulfilled' => 1, 'Dispatched' => 2,
    'Kshopina_Warehouse' => 3, 'Delivery' => 4, 'Delivered' => 5, 'Refused' => 6];
    public function __construct(Request $request)
    {
        /*         $this->middleware('auth');
         */
        $this->ordersModel = new \App\Models\Orders();
        $this->itemsModel = new \App\Models\Items();
        $this->historyModel = new \App\Models\History();
        $this->verificationModel = new \App\Models\Verification();
        $this->tstModel = new \App\Models\tst();
        $this->domesticModel = new \App\Models\Domestic();

    }
    public function index()
    {
        $oldsku = "first";

        try {
            $page = $_GET['page'];
        } catch (\Throwable $th) {
            $page = "1";
        }
        try {
            $rule = $_GET['filter'];
        } catch (\Throwable $th) {
            $rule = "All";
        }
        try {
            $store = $_GET['store'];
        } catch (\Throwable $th) {
            $store = "origin";
        }
        try {
            $order_number = $_GET['order_num'];
        } catch (\Throwable $th) {
            $order_number = "";
        }

        if (!empty($order_number)) {
            $all_orders = $this->verificationModel->get_orders_from_database_search($store, $order_number,'index');
        } else {

            /* if ($rule == 'All' && $store != "plus_egypt" && $store != "origin" && $store != "plus_ksa" && $store != "plus_kuwait") {
                $last_order = $this->verificationModel->get_last_order($store);

                foreach ($last_order as $value) {
                    $orders = $this->verificationModel->get_new_from_shopify($store, $value->value);
                }
                // save items
                if (sizeof($orders) != 0) {
                    ignore_user_abort();

                    $last_order_id = $orders[sizeof($orders) - 1]->id;

                    $this->verificationModel->update_last_order($store, $last_order_id);


                    $this->verificationModel->save_orders($store, $orders);

                    foreach ($orders as $key => $order) {

                        foreach ($order->line_items as $key => $item) {
                            $skutype = substr($item->sku, -2);

                            // stock status

                            if ($oldsku == "first") {
                                $oldsku = $skutype;
                            } else {
                                if ($oldsku == $skutype && ($skutype == "EG" || $skutype == "KW" || $skutype == "SA")) {
                                    $oldsku = $skutype;
                                } else if ($oldsku != $skutype && (($skutype == "EG" || $skutype == "KW" || $skutype == "SA") || ($oldsku == "EG" || $oldsku == "KW" || $oldsku == "SA"))) {
                                    $oldsku = "other";
                                    break;
                                } else {
                                    $oldsku = $skutype;
                                }
                            }
                        }

                        $this->itemsModel->saveitem($store, $order->line_items, substr($order->name, 1), $skutype);
                    }

                }
            } */
            if ( $store == "plus_egypt" || $store == "origin" || $store == "plus_ksa" || $store == "plus_kuwait"|| $store == "plus_uae") {
            $all_orders = $this->verificationModel->get_orders_from_database($store, $rule, $page);
            }
        }

        return view('first_verification')->with([
            'orders' => $all_orders[1], 'number_of_orders' => $all_orders[0],
            'number_of_FVM' => $all_orders[2],
            'number_of_replied_FVM' => $all_orders[3],
            'number_of_new_FVM' => $all_orders[4],
            'number_of_new_SVM' => $all_orders[5],
            'number_of_SVM' => $all_orders[6],
            'number_of_replied_SVM' => $all_orders[7],
            'number_of_confirmed_archived' => $all_orders[8],
            'number_of_canceled_archived' => $all_orders[9],
            'page' => 'verification',
        ]);

    }
    public function confirmed()
    {
        $oldsku = "first";

        try {
            $page = $_GET['page'];
        } catch (\Throwable $th) {
            $page = "1";
        }
        try {
            $rule = $_GET['filter'];
        } catch (\Throwable $th) {
            $rule = "All";
        }
        try {
            $store = $_GET['store'];
        } catch (\Throwable $th) {
            $store = "origin";
        }

        try {
            $order_number = $_GET['order_num'];
        } catch (\Throwable $th) {
            $order_number = "";
        }

      
        if (!empty($order_number)) {
            $all_orders = $this->verificationModel->get_orders_from_database_search($store, $order_number,'confirmed');
        } else {
            $all_orders = $this->verificationModel->get_confirmed_orders_from_database($store, $rule, $page);
        }
        
        return view('first_verification')->with([
            'orders' => $all_orders[1],
            'number_of_orders' => $all_orders[0],
            'number_of_FVM' => $all_orders[2],
            'number_of_replied_FVM' => $all_orders[3],
            'number_of_new_FVM' => $all_orders[4],
            'number_of_new_SVM' => $all_orders[5],
            'number_of_SVM' => $all_orders[6],
            'number_of_replied_SVM' => $all_orders[7],
            'number_of_confirmed_archived' => $all_orders[8],
            'number_of_canceled_archived' => $all_orders[9],
            'customer_history' => $all_orders[10],

            'page' => 'verification',
        ]);
    }
    public function edited()
    {

        try {
            $page = $_GET['page'];
        } catch (\Throwable $th) {
            $page = "1";
        }
        try {
            $rule = $_GET['filter'];
        } catch (\Throwable $th) {
            $rule = "All";
        }
        try {
            $store = $_GET['store'];
        } catch (\Throwable $th) {
            $store = "origin";
        }

        try {
            $order_number = $_GET['order_num'];
        } catch (\Throwable $th) {
            $order_number = "";
        }

        if (!empty($order_number)) {
            $all_orders = $this->verificationModel->get_orders_from_database_search($store, $order_number,'edited');
        } else {
            $all_orders = $this->verificationModel->get_edited_orders_from_database($store, $rule, $page);
        }

        return view('first_verification')->with([
            'orders' => $all_orders[1], 'number_of_orders' => $all_orders[0],
            'number_of_FVM' => $all_orders[2],
            'number_of_replied_FVM' => $all_orders[3],
            'number_of_new_FVM' => $all_orders[4],
            'number_of_new_SVM' => $all_orders[5],
            'number_of_SVM' => $all_orders[6],
            'number_of_replied_SVM' => $all_orders[7],
            'number_of_confirmed_archived' => $all_orders[8],
            'number_of_canceled_archived' => $all_orders[9],
            'customer_history' => $all_orders[10],
            'page' => 'verification',
        ]);
    }
    public function on_hold()
    {
        try {
            $page = $_GET['page'];
        } catch (\Throwable $th) {
            $page = "1";
        }
        try {
            $rule = $_GET['filter'];
        } catch (\Throwable $th) {
            $rule = "All";
        }
        try {
            $store = $_GET['store'];
        } catch (\Throwable $th) {
            $store = "origin";
        }

        try {
            $order_number = $_GET['order_num'];
        } catch (\Throwable $th) {
            $order_number = "";
        }

        if (!empty($order_number)) {
            $all_orders = $this->verificationModel->get_orders_from_database_search($store, $order_number,'onHold');
        } else {
            $all_orders = $this->verificationModel->get_on_hold_orders_from_database($store, $rule, $page);
        }

        return view('first_verification')->with([
            'orders' => $all_orders[1], 'number_of_orders' => $all_orders[0],
            'number_of_FVM' => $all_orders[2],
            'number_of_replied_FVM' => $all_orders[3],
            'number_of_new_FVM' => $all_orders[4],
            'number_of_new_SVM' => $all_orders[5],
            'number_of_SVM' => $all_orders[6],
            'number_of_replied_SVM' => $all_orders[7],
            'number_of_confirmed_archived' => $all_orders[8],
            'number_of_canceled_archived' => $all_orders[9],
            'customer_history' => $all_orders[10],
            'page' => 'verification',
        ]);
    }
    public function SVM()
    {

        try {
            $page = $_GET['page'];
        } catch (\Throwable $th) {
            $page = "1";
        }
        try {
            $rule = $_GET['filter'];
        } catch (\Throwable $th) {
            $rule = "All";
        }
        try {
            $store = $_GET['store'];
        } catch (\Throwable $th) {
            $store = "origin";
        }

        try {
            $order_number = $_GET['order_num'];
        } catch (\Throwable $th) {
            $order_number = "";
        }

        if (!empty($order_number)) {
            $all_orders = $this->verificationModel->get_orders_from_database_search($store, $order_number,'svm');
        } else {
            $all_orders = $this->verificationModel->get_SVM_orders_from_database($store, $rule, $page);
        }
        
        return view('first_verification')->with([
            'orders' => $all_orders[1], 'number_of_orders' => $all_orders[0],
            'number_of_FVM' => $all_orders[2],
            'number_of_replied_FVM' => $all_orders[3],
            'number_of_new_FVM' => $all_orders[4],
            'number_of_new_SVM' => $all_orders[5],
            'number_of_SVM' => $all_orders[6],
            'number_of_replied_SVM' => $all_orders[7],
            'number_of_confirmed_archived' => $all_orders[8],
            'number_of_canceled_archived' => $all_orders[9],
            'customer_history' => $all_orders[10],
            'page' => 'verification',
        ]);
    }
    public function FVM()
    {

        try {
            $page = $_GET['page'];
        } catch (\Throwable $th) {
            $page = "1";
        }
        try {
            $rule = $_GET['filter'];
        } catch (\Throwable $th) {
            $rule = "All";
        }
        try {
            $store = $_GET['store'];
        } catch (\Throwable $th) {
            $store = "origin";
        }

        try {
            $order_number = $_GET['order_num'];
        } catch (\Throwable $th) {
            $order_number = "";
        }

        try {
            
            if (!empty($order_number)) {

                $all_orders = $this->verificationModel->get_orders_from_database_search($store, $order_number,'fvm');


            } else {
    
                $all_orders = $this->verificationModel->get_FVM_orders_from_database($store, $rule, $page);
                
            }
    
               return view('first_verification')->with([
                'orders' => $all_orders[1], 'number_of_orders' => $all_orders[0],
                'number_of_FVM' => $all_orders[2],
                'number_of_replied_FVM' => $all_orders[3],
                'number_of_new_FVM' => $all_orders[4],
                'number_of_new_SVM' => $all_orders[5],
                'number_of_SVM' => $all_orders[6],
                'number_of_replied_SVM' => $all_orders[7],
                'number_of_confirmed_archived' => $all_orders[8],
                'number_of_canceled_archived' => $all_orders[9],
                'customer_history' => $all_orders[10],
                'page' => 'verification',
            ]);
        } catch (\Throwable $th) {
            return $th;
        }
       
    }
    public function archived()
    {

        try {
            $page = $_GET['page'];
        } catch (\Throwable $th) {
            $page = "1";
        }
        try {
            $rule = $_GET['filter'];
        } catch (\Throwable $th) {
            $rule = "All";
        }
        try {
            $store = $_GET['store'];
        } catch (\Throwable $th) {
            $store = "origin";
        }

        try {
            $order_number = $_GET['order_num'];
        } catch (\Throwable $th) {
            $order_number = "";
        }

        if (!empty($order_number)) {
            $all_orders = $this->verificationModel->get_orders_from_database_search($store, $order_number,'archived');
        } else {
            $all_orders = $this->verificationModel->get_archived_orders_from_database($store, $rule, $page);
        }

        return view('first_verification')->with([
            'orders' => $all_orders[1], 'number_of_orders' => $all_orders[0],
            'number_of_FVM' => $all_orders[2],
            'number_of_replied_FVM' => $all_orders[3],
            'number_of_new_FVM' => $all_orders[4],
            'number_of_new_SVM' => $all_orders[5],
            'number_of_SVM' => $all_orders[6],
            'number_of_replied_SVM' => $all_orders[7],
            'number_of_confirmed_archived' => $all_orders[8],
            'number_of_canceled_archived' => $all_orders[9],
            'customer_history' => $all_orders[10],

            'page' => 'verification',
        ]);
    }

    public function edit_phone()
    {

        $order_number = $_GET['order_number'];
        $new_phone = $_GET['new_phone'];

        $this->verificationModel->edit_phone($order_number, $new_phone);

        return back();

    }

    public function resend_fvm_message(){
      
        $order_number = $_POST['order_number'];
        $order_data = $this->verificationModel->get_order_data_by_order_number($order_number);

       /*  $whatsModel = new \App\Models\WhatsApp();

        $whatsModel->whatsapp_send_fvm_message($order_data[0]->store, $order_data[0]->order_number, $order_data[0]->token); */
        return back();

    }

    //group orders
    public function group_orders()
    {
        try {
            $page = $_GET['page'];
        } catch (\Throwable $th) {
            $page = "1";
        }
        try {
            $rule = $_GET['filter'];
        } catch (\Throwable $th) {
            $rule = "All";
        }
        try {
            $store = $_GET['store'];
        } catch (\Throwable $th) {
            $store = "origin";
        }

        try {
            $all_orders = $this->verificationModel->get_group_orders_from_database($store, $rule, $page);
            return view('first_verification')->with([
                'orders' => $all_orders[1], 'number_of_orders' => $all_orders[0],
                'number_of_FVM' => $all_orders[2],
                'number_of_replied_FVM' => $all_orders[3],
                'number_of_new_FVM' => $all_orders[4],
                'number_of_new_SVM' => $all_orders[5],
                'number_of_SVM' => $all_orders[6],
                'number_of_replied_SVM' => $all_orders[7],
                'number_of_confirmed_archived' => $all_orders[8],
                'number_of_canceled_archived' => $all_orders[9], 'page' => 'verification',
            ]);        } catch (\Throwable $th) {
            return $th;
        }
        
    }
    
    //
    public function resubmit()
    {
        try {
            $token = $_GET['token'];
        } catch (\Throwable $th) {
            abort(404);
        }
        if ($this->verificationModel->check_token($token)[0]) {
            $data = $this->verificationModel->validate_url($token, 4);
            if ($data[0]) {
                $order = $data[1][0];
                $problem_data = $this->verificationModel->getProblemInfo($order);
                return view('edit')->with(['form_data' => $problem_data[0], 'form_data_status' => $problem_data[1]]);
            }
        } else {
            abort(404);
        }
    }
    public function edit_manually()
    {
        try {
            $token = $_GET['token'];
        } catch (\Throwable $th) {
            abort(404);
        }
        if ($this->verificationModel->check_token($token)[0]) {

            $data = $this->verificationModel->validate_url($token, 4);
            $order = $data[1][0];
            $form_data = [
                'name' => $order->name, 'phone' => $order->phone_number,
                'country' => $order->country, 'city' => $order->city, 'address' => $order->address,
                'apartment' => $order->apartment,
            ];
            if ($order->gateway == 'COD') {
                $form_data['payment'] = 'COD';
            } else {
                $form_data['payment'] = 'Visa';
            }
            $form_data_status = [
                'name' => 0, 'phone' => 1,
                'country' => 1, 'city' => 1, 'address' => 1,
                'apartment' => 1,
            ];

            return view('edit')->with(['form_data' => $form_data, 'form_data_status' => $form_data_status]);
        } else {
            abort(404);
        }
    }

    public function add_to_preorder()
    {
        $order_number = $_POST['order'];
        $this->verificationModel->change_to_preorder($order_number);
    }
    public function paid()
    {
        $order_number = $_POST['order'];
        $this->verificationModel->change_to_paid($order_number);
    }
    public function ignore_order()
    {
        $order_id = $_POST['order'];
        $this->verificationModel->ignore_order_verification($order_id);
        $this->historyModel->create(Auth::user()->name, 'Verification', 'Mark order as ignored for #ID' . $order_id);

    }
    public function verification_mail()
    {
        $order_number = $_POST['order'];
        $store = $_POST['store'];

        /* if ($store == 'origin') {
        $this->changeCurrency();
        } */

        $token = $this->verificationModel->generate_url($order_number);
        try {
           /*  $whatsModel = new \App\Models\WhatsApp();

            return $whatsModel->whatsapp_send_fvm_message($store, $order_number, $token); */

            /* return $this->verificationModel->first_verification_mail($store, $order_number, $token); */
        } catch (\Throwable $th) {
            return $th;
        }

        $this->historyModel->create(Auth::user()->name, 'Verification', 'Sent the first verification message for #' . $order_number);
    }
    public function confirm_order()
    {
        try {
            $token = $_GET['token'];
        } catch (\Throwable $th) {
            abort(404);
        }
        if ($this->verificationModel->check_token($token)[0]) {
            $order = $this->verificationModel->validate_url($token, 1);
            if ($order[0]) {
                $order_number = $this->verificationModel->confirmORcancel($token, 'confirm');
                return view('emails_response')->with(['status' => 'success', 'title' => "The Order has been confirmed!", 'sub_title' => "We will keep you posted via WhatsApp 😊"]);
            } else {
                if ($order[1][0]->verified == 3) {
                    return view('emails_response')->with(['status' => 'cancel', 'title' => "The Order has already been canceled before", 'sub_title' => "Please visit Kshopina to place a new order"]);
                } else {
                    return view('emails_response')->with(['status' => 'success', 'title' => "The Order has been confirmed!", 'sub_title' => "We will keep you posted via WhatsApp 😊"]);
                }
                /* return view('success')->with(['status' => 'OOPS!', 'message' => 'The link is expired', 'sub_message' => 'This order is already verified , you cannot verify it again!']); */
            }
        } else {
            abort(404);
        }
    }
    public function cancel_order()
    {
        try {
            $token = $_GET['token'];
        } catch (\Throwable $th) {
            abort(404);
        }

        if ($this->verificationModel->check_token($token)[0]) {
            $order = $this->verificationModel->validate_url($token, 1);

            if ($order[0]) {
                $order_number = $this->verificationModel->confirmORcancel($token, 'cancel');
                $this->verificationModel->cancel_shopify("unkown", $order_number,'verification');
                $this->verificationModel->action_by($order_number, "Customer");


                return view('emails_response')->with(['status' => 'cancel', 'title' => "The Order has been canceled!", 'sub_title' => "We hope to see you again 😊"]);
            } else {
                if ($order[1][0]->verified == 3) {
                    return view('emails_response')->with(['status' => 'cancel', 'title' => "The Order has already been canceled before", 'sub_title' => "Please visit Kshopina to place a new order"]);
                } else {
                    return view('emails_response')->with(['status' => 'success', 'title' => "The Order has been confirmed!", 'sub_title' => "We will keep you posted via WhatsApp 😊"]);
                }
               
            }
        } else {
            abort(404);
        }
    }
    public function cancel_order_confirmed()
    {
        $order_number = $_POST['order'];
        $store = $_POST['store'];
        $reason = $_POST['reason'];

        date_default_timezone_set('Africa/Cairo');
        $date = date('Y-m-d H:i:s', time());

        /* if (!$this->tstModel->fct_is_exist($order_number)) {
            $this->tstModel->insert_fct($order_number, $reason, $date, 0,$store);
        } */

        DB::table('orders')->where('order_number', $order_number)->update(['verified' => 3, 'active' => 1]);
        $this->verificationModel->action_by($order_number, Auth::user()->name);

        $this->tstModel->cancel_shopify($store, $order_number,'verification');

    }
    public function cancel_order_tst()
    {
        $order_number = $_POST['order'];
        $store = $_POST['store'];
        $reason = $_POST['reason'];

        date_default_timezone_set('Africa/Cairo');
        $date = date('Y-m-d H:i:s', time());

        if (!$this->tstModel->fct_is_exist($order_number)) {
            $this->tstModel->insert_fct($order_number, $reason, $date, 2,$store);
        }

        DB::table('orders')->where('order_number', $order_number)->update([ "on_process" => 0,
            'status' => 0, 'actions' => 1,'financial_status'=>"voided", 'canceled_at' => $date, 'canceled_by' => Auth::user()->name]);

        $this->tstModel->cancel_shopify($store, $order_number,'TST');

        /*$this->verificationModel->action_by($order_number, Auth::user()->name);
        */
    }

    public function return_to_confirmed()
    {
        $order_number = $_POST['order'];
        $store = $_POST['store'];

        DB::table('orders')->where('order_number', $order_number)->update([
            'international_awb' => '', 'domestic_awb' => '',
            'domestic_company' => '', 'actions' => 0,
            'last_action' => '', 'status' => 0,'on_process'=>0]);

        $this->historyModel->create(Auth::user()->name, 'TST', 'return the order to verified #' . $order_number);
        /*$this->verificationModel->action_by($order_number, Auth::user()->name);
        */
    }
    public function cancel_order_shopify()
    {
        $order_number = $_POST['order'];
        $store = $_POST['store'];

        $this->verificationModel->cancel_shopify($store, $order_number,'verification');
        $this->verificationModel->action_by($order_number, Auth::user()->name);
    }
    public function correct_mail()
    {
        $order_id = $_POST['order'];
        $problem = $_POST['problem'];

        $this->verificationModel->second_verification_mail($order_id, $problem);
        $this->historyModel->create(Auth::user()->name, 'Verification', 'Sent the second verification mail for ' . $order_id);
    }
    public function send_correct_whatsApp_message()
    {
        $order_id = $_POST['order'];
        $problem = $_POST['problem'];
/* 
        $whatsModel = new \App\Models\WhatsApp();

        $whatsModel->whatsapp_send_svm_message($order_id, $problem); */

        /* $this->verificationModel->second_verification_mail($order_id, $problem); */
        $this->historyModel->create(Auth::user()->name, 'Verification', 'Sent the second verification mail for ' . $order_id);
    }
    
    public function update_editing()
    {
        $data = request()->all();
        if ($this->verificationModel->validate_url($data['access_token'], 4)[0] || $data['route_name'] == 'manuall') {

            $this->verificationModel->update_order_data($data);

            if (isset(Auth::user()->name)) {
                $this->historyModel->create(Auth::user()->name, 'Verification', 'The shipping information has been edited');
            } else {
                $this->historyModel->create("Customer", 'Verification', 'The shipping information has been edited by Customer');
            }
            return view('emails_response')->with(['status' => 'success', 'title' => "We have received your new infomation", 'sub_title' => "we will be in touch shortly!"]);
        }
    }

    public function update_shopify()
    {
        ignore_user_abort();

        $order_id = $_POST['order'];
        return $this->verificationModel->update_shopify($order_id);
    }
    public function changeCurrency()
    {
        $sar = $this->verificationModel->get_currency("SAR");

        date_default_timezone_set('Asia/Seoul');
        $now = date('Y-m-d H:i:s', time());

        $date1 = new DateTime($sar[0]->update_date);
        $date2 = new DateTime($now);
        $interval = $date1->diff($date2);

        if ($interval->y == 0 && $interval->m == 0 && $interval->d == 0) {
        } else {
            $header = array(
                'http' => array(
                    'method' => "GET",
                ),
            );

            $context = stream_context_create($header);
            $url = "http://api.currencylayer.com/live?access_key=e23172a8bbaebfd50e04e888d719ff12&currencies=SAR,KWD,JOD,BHD,OMR,EGP,QAR,AED";
            // Open the file using the HTTP headers set above
            $data = file_get_contents($url, false, $context);
            $currency = json_decode($data);

            $this->verificationModel->updateCurrency($currency->quotes);
        }

        /*  $obj = json_encode($interval);

    echo "<script>console.log(JSON.parse('" . $obj . "'))</script>"; */
    }

    public function search_orders_result()
    {
        $value = $_POST['content'];

        return $this->verificationModel->order_like($value);
    }

    public function export(Request $request)
    {
        $store = $request->store;
        $from = $request->from;
        $to = $request->to;


        $name = $this->verificationModel->export($store ,$from ,$to);
        $myFile = public_path('uploads/verification' . '/' . $store . '/' . $name . '.xlsx');

        return response()->download($myFile);
        /* return $name; */
    }

    public function edit_email()
    {
        $order_number = $_GET['order_number'];
        $new_email = $_GET['new_email'];

        $this->verificationModel->edit_email($order_number, $new_email);

        return back();

    }

    public function update_fulfilment_to_on_hold()
    {
        $order_number = $_POST['order_number'];
        $store = $_POST['store'];
        $fulfilment_id=0;
        $open_or_hold='';

        $check= $this->verificationModel->isExist($store,$order_number);
        if ($check[0]) {
            $fulfilmentList=$this->verificationModel->get_fulfillment_list($check[1][0]->order_id,$store);

            try {
                if (isset($fulfilmentList['fulfillment_orders']) ) {
                    foreach ($fulfilmentList['fulfillment_orders'] as $key => $fulfilment) {
                        if ($fulfilment['status']=='open') {
                            $open_or_hold='open';
                            $fulfilment_id= $fulfilment['id'];

                            $this->verificationModel->mark_fulfillment_as_onHold($fulfilment_id,$store,$check[1][0]->order_id);
                        }elseif($fulfilment['status']=='on_hold'){
                            $open_or_hold='hold';
                            $fulfilment_id= $fulfilment['id'];
                        }
                    }
                    if ($fulfilment_id != 0) {
                        if ($open_or_hold !='open' && $open_or_hold !='hold') {
                            return [false,'CONTACT SOFTWARE TEAM'];
                        }
                        
                    }else{
                        return [false,'ORDER ALREADY FULFILLED IN SHOPIFY'];
                    }
                }else{
                    return [false,'NO FULFILMENT HISTORY IN SHOPIFY'];
                }
            } catch (\Throwable $th) {
                DB::insert('insert into errors (message,shipment_number) values (?,?)', [$th, $order_number]);

                return [false,'CONTACT SOFTWARE TEAM.'];
            }
        } else {
            return [false,'INVALID ORDER NUMBER'];
        }
        
        $this->verificationModel->update_fulfilment('on_hold', $order_number, $store);

        return [true,'success'];

    }
    public function update_fulfilment_to_release()
    {

        
        $order_number = $_POST['order_number'];
        $store = $_POST['store'];
        $fulfilment_id=0;
        $open_or_hold='';

        $check= $this->verificationModel->isExist($store,$order_number);
        if ($check[0]) {
            $fulfilmentList=$this->verificationModel->get_fulfillment_list($check[1][0]->order_id,$store);

            try {
                if (isset($fulfilmentList['fulfillment_orders']) ) {

                    foreach ($fulfilmentList['fulfillment_orders'] as $key => $fulfilment) {
                        if ($fulfilment['status']=='open') {
                            $open_or_hold='open';
                            $fulfilment_id= $fulfilment['id'];
                        }elseif($fulfilment['status']=='on_hold'){
                            $open_or_hold='hold';
                            $fulfilment_id= $fulfilment['id'];

                            $this->verificationModel->release_onHold_fulfillment($fulfilment_id,$store,$check[1][0]->order_id);

                        }
                    }

                    if ($fulfilment_id != 0) {
                        if ($open_or_hold !='open' && $open_or_hold !='hold') {
                            return [false,'CONTACT SOFTWARE TEAM'];
                        }
                        
                    }else{
                        return [false,'ORDER ALREADY FULFILLED IN SHOPIFY'];
                    }
                }else{
                    return [false,'NO FULFILMENT HISTORY IN SHOPIFY'];
                }
            } catch (\Throwable $th) {
                DB::insert('insert into errors (message,shipment_number) values (?,?)', [$th, $order_number]);

                return [false,'CONTACT SOFTWARE TEAM.'];
            }
        } else {
            return [false,'INVALID ORDER NUMBER'];
        }
        
        $this->verificationModel->update_fulfilment('released', $order_number, $store);

        return [true,'success'];

    }
    public function something(){

        $order = DB::table('orders')->where('order_number', '32079')->get();

        $items = DB::select('SELECT * from items where order_id = ? and product_name != "Cash on Delivery fee"', ['32079']);
        
        $converted_price = $order[0]->currency;
        $store = 'origin';
        
        if ($store == 'origin') {
            $converted_price = $order[0]->currency;
            $country_currency = "";
            $arabic_currency = "";
            if ($order[0]->country == 'Egypt') {
                $country_currency = 'EGP';
                $arabic_currency = 'جنيه مصري';
            } else if ($order[0]->country == 'Saudi Arabia') {
                $country_currency = 'SAR';
                $arabic_currency = 'ريال سعودي';
            } else if ($order[0]->country == 'United Arab Emirates') {
                $country_currency = 'AED';
                $arabic_currency = 'درهم اماراتي';
            } else if ($order[0]->country == 'Bahrain') {
                $country_currency = 'BHD';
                $arabic_currency = 'دينار بحريني';
            } else if ($order[0]->country == 'Kuwait') {
                $country_currency = 'KWD';
                $arabic_currency = 'دينار كويتي';
            } else if ($order[0]->country == 'Oman') {
                $country_currency = 'OMR';
                $arabic_currency = 'ريال عماني';
            } else if ($order[0]->country == 'Jordan') {
                $country_currency = 'JOD';
                $arabic_currency = 'دينار اردني';
            } else if ($order[0]->country == 'Qatar') {
                $country_currency = 'QAR';
                $arabic_currency = 'ريال قطري';
            } else {
                $country_currency = 'USD';
                $arabic_currency = 'دولار';
            }

        } else if ($store == 'plus_egypt') {
            $country_currency = 'EGP';
            $arabic_currency = 'جنيه مصري';
            $converted_price = $order[0]->total_price;
        } else if ($store == 'plus_ksa') {
            $country_currency = 'SAR';
            $arabic_currency = 'ريال سعودي';
            $converted_price = $order[0]->total_price;
        } else if ($store == 'plus_kuwait') {
            $country_currency = 'KWD';
            $arabic_currency = 'دينار كويتي';
            $converted_price = $order[0]->total_price;
        }else if ($store == 'plus_uae') {
            $country_currency = 'AED';
            $arabic_currency = 'درهم إماراتي';
            $converted_price = $order[0]->total_price;
        }

        $data1 = [
            'order_number' => '32079',
            'customer_name' => $order[0]->name,
            'items' => $items,
            'price' => $converted_price,
            'currency' => $country_currency,
            'arabic_currency' => $arabic_currency,
            'country' => $order[0]->country,
            'city' => $order[0]->city,
            'address' => $order[0]->address,
            'phone_number' => $order[0]->phone_number,
        ];
        
        Mail::to('mennagalal30@gmail.com')->send(new OrderDetailsMail($data1), function ($message) {
            $message->subject("");
        });

        return 'here we go';





        return DB::select('SELECT order_number as ref_number, domestic_awb as tracking_number FROM kshopina.orders where verified = 6 AND  
        international_awb is not null AND international_awb !="" AND domestic_awb is not null AND domestic_awb !="" and store = "origin" 
        AND domestic_company = "SMSA" AND canceled_at is null AND status < 5 
        UNION ALL

        Select order_number as ref_number,international_awb as tracking_number FROM kshopina.orders where verified = 6 AND
        international_awb is not null AND international_awb !="" AND store != "origin"
        AND domestic_company = "SMSA" AND canceled_at is null AND status < 5');

        $client = new guzzle([
            'headers' => [
                'Content_Type' => 'Application/json',
                'Authorization' => 'bearer QMwCi6DUbzD9gtOfruEq3gH8IUNF3tH7ynDZMu6e7zll_-T3OBCXfTBZILDFiK_lhHO-SKeEJcoxYucq-gsBk0TffG9kO-wVAOlbkWQMtgQdyp6rnfDrxevabhWt9ED90d0GFQab3TP1fh-0i8dXx_FNlNAwtooL2mLcDSuYuwGiod2QtT99teEJWEyAuMzZjrqo8Qn0q9C9LoDHaUW4xC89IXqg0bTY8wDkSI_ixNuw5-uBN3ig0R0EnvA-S8mqHkbFuYoqPQCJDUfyRPrwPry-yXMkPM8p0lUI3g8Nb0kJ-azmKq2LOJPZ6Vuzv8R0sQ0MkXHWYzmn5DOU2z2mhETpnZd7QIqUK94qkKjWG9s'
            ],
        ]);
        $URI = 'https://cube-shipperapi.dispatchex.com/api/order/ShipmentDetails';

        $body = [
            "TrackingNo" => 'UAE4570076057',
            'Barcode' =>'UAE4570076057'
        ];

        try {
            $URI_Response = $client->request('POST', $URI, ['form_params'=>$body]);
            $URI_Response = json_decode($URI_Response->getBody(), true);
        } catch (\Throwable $th) {

            if ($th->getCode() == 401 || $th->getCode() == 403) {
                return "fgnhfghf";
            }
            return (['response' => 'fail', 'message' => $th->getCode()]);

        }
        
        return $URI_Response;


        /* return $whatsModel->reformat_phone_number('+96567611106','Kuwait'); */
        
        
        
        /* dd(DB::select('SELECT * FROM whatsapp_send_messages right join orders on orders.order_number = whatsapp_send_messages.order_number 
        where message_name="fvm" and verified = 1 And active = 0 AND store = "origin" ORDER BY send_fvm_at DESC')) ; */
        

        return 'done';

        $a= [
            "gift_card",
            "Cash on Delivery (COD)"
        ];

        if (in_array("gift_card",$a) ) {
            return "found";
        }else{
            return "not_found";
        }
        
        return 'done';
       
    }
    
    
    public function get_shopify_products_counts(){

        $store = 'origin';

        $shopify_token = DB::table('config')->where('keyy', $store)->get()[0]->value;
        $store_url = DB::table('config')->where('keyy', $store . '_url')->get()[0]->value;
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
        $products = $store_url . "/admin/api/2023-07/products/count.json";
        // Open the file using the HTTP headers set above
        $data = file_get_contents($products, false, $context);
        $products = json_decode($data);
        return $products;

    }

    public function get_string_between($string, $start, $end){
        $string = ' ' . $string;
        $ini = strpos($string, $start);
        if ($ini == 0) return '';
        $ini += strlen($start);
        $len = strpos($string, $end, $ini) - $ini;
        return substr($string, $ini, $len);
    }


    public function get_all_shopify_products($page_info){
        $store = 'origin';

        $shopify_token = DB::table('config')->where('keyy', $store)->get()[0]->value;
        $store_url = DB::table('config')->where('keyy', $store . '_url')->get()[0]->value;

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
        $order = $store_url . "/admin/api/2023-07/products.json?limit=100&page_info=".$page_info;
        // Open the file using the HTTP headers set above
        $data = file_get_contents($order, false, $context);
        
        $orders = json_decode($data);

        return [$orders, $http_response_header];

    }

    public function get_all_variants_of_shopify_product($product_id){


        $store = 'origin';

        $shopify_token = DB::table('config')->where('keyy', $store)->get()[0]->value;
        $store_url = DB::table('config')->where('keyy', $store . '_url')->get()[0]->value;

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
        $order = $store_url . "/admin/api/2023-07/products/". $product_id ."/variants.json";
        // Open the file using the HTTP headers set above
        $data = file_get_contents($order, false, $context);
        
        $orders = json_decode($data);

        return  $orders;
 
    }

    public function get_shopify_products(){

        try {
            
            $store = 'origin';           
            for ($i=24; $i <= 27 ; $i++) { 
            
                 $products_shopify_count = $this->get_shopify_products_counts();
 
                 $products_db_count =  DB::select('SELECT count(id) as count from stock where store = "origin" ');
 
                 if ($products_shopify_count->count > $products_db_count[0]->count ) {
 
                     $request_info = DB::select(' SELECT * FROM shopify_pages  ORDER BY id ');
                    
                     try {
 
                         if ( count($request_info) == 0 ) {   
 
                             $products = $this->get_all_shopify_products(null);
         
                         }else{
         
                             if( $request_info[$i]->rel == "next" ){
         
                                 $products = $this->get_all_shopify_products($request_info[$i]->page_info );
         
                             }
                                 
                         }
                         
                         foreach ($products[0]->products as $product) {
                             if (isset($product->image->src)) {
                                 $image = $product->image->src;
                             } else {
                                 $image = "";
                             }
 
                             //INSERT PRODUCTS DATA IN DB 
                             $product_id=DB::table('stock')->insertGetId([
                             'product_title' => $product->title,
                             'product_id' => $product->id ,
                             'product_type' => $product->product_type, 
                             'status' => $product->status,
                             'number_of_variants' => count($product->variants),
                             'store' => $store,
                             'product_tags' => $product->tags,
                             'product_cover_image' => $image,
                             'created_at' => date("Y-m-d H:i:s", strtotime($product->created_at)),
                             ]);   
                             
                             //GET VARIANTS OF PRODUCT
                             $variants_of_product = $this->get_all_variants_of_shopify_product($product->id);
                 
                             //INSERT VARIANTS DATA IN DB 
                             foreach ($variants_of_product->variants as $variant) {
                                 DB::table('variants')->insert([
                                 'product_id' => $product_id ,
                                 'variant_id' => $variant->id,
                                 'variant_title' => $variant->title, 
                                 'variant_price' => $variant->price,
                                 'variant_sku' => $variant->sku,
                                 'variant_image' => $variant->image_id,
                                 'variant_inventory_id' => $variant->inventory_item_id,
                                 'variant_quantity' => $variant->inventory_quantity,
                                 'variant_all_quantity' => $variant->inventory_quantity
                                 ]);  
                                 
                             }
                         }
                 
                         //NEXT REQUEST  CREDENTIALS
                         $products_headers = $products[1];
                 
                         foreach ( $products_headers as $key => $value) {
                 
                             $matches = explode(':', $value, 2) ;
                 
                             if(count($matches) != 1) {
                                 $response_headers[$matches[0]] = $matches[1];
                             }else{
                                 $response_headers[$key] = $matches[0];
                             }
                 
                         } 
                 
                         if ( substr_count($response_headers['Link'] ,'page_info') > 1 ) {
                 
                             $response_headers['Link'] = strstr($response_headers['Link'] , ',');
                 
                         }
                         
                         $parsed_pageInfo = $this->get_string_between($response_headers['Link'], 'page_info=', '>');
                         $parsed_rel = $this->get_string_between($response_headers['Link'], 'rel="', '"');
                 
                         //INSERT LAST REQUEST DETAILS 
                         if ( count($request_info) == 0 ) {   
                             $products_num = 100;
                         }else{
                             $products_num = $request_info[$i]->products_mum + count($products[0]->products); 
                         }
                 
                         DB::table('shopify_pages')->insert([
                             'page_info' => $parsed_pageInfo ,
                             'rel' => $parsed_rel ,
                             'products_mum' => $products_num, 
                             ]); 
                         
                     } catch (\Throwable $th) {
                         
                         return $th;
                     }
                     
 
                 }else{
                     return 'done';
                 }
             }
         } catch (\Throwable $th) {
             return  $th;
         }       
 
        return 'fvdfbdf';
    }

    public function send_mail(){
        /* 'mmohsen@dpmglob.com' */
        /* mennagalal30@gmail.com */
        $email="";
        $id =0;
        $send_email=[];
        
        $plus_mails =[
            '21mustersowoozoo@gmail.com',
            '3ahad.2009@gmail.com',
            '3rachattath@gmail.com',
            '3slalkhaldy@gmail.com',
            '6amialqrifa@gmail.com',
            'a.2lroqi@icloud.com',
            'a.rahmankw8@gmail.com',
            'a.y.m.o.q88@gmail.com',
            'a8574033@gmail.com',
            'abdallah_r_alajmi3115@fbs.edu.kw',
            'abdul07mohsin@gmail.com',
            'abedi1977@gmail.com',
            'aboalowh1900@gmail.com',
            'adangladys0526@gmail.com',
            'af1story@icloud.com',
            'afnanito@yahoo.com',
            'afnantttturki@gmail.com',
            'ahaikahaladwaniii@gmail.com',
            'aishaalhajri1974@gmail.com',
            'aishaalmotereee@gmail.com',
            'aishafahad669@gmail.com',
            'aishafahad669@gnail.com',
            'aishasaddouq@gmail.com',
            'ajlesaca@hotmail.com',
            'alajmishefaa@gmail.com',
            'alazminoor196@gmail.com',
            'aldwsryr25@gmail.com',
            'alenezyomer@gmail.com',
            'al-gala.love.2010@hotmail.com',
            'algalaali@gmail.com',
            'aliah.alrashidia@gmail.com',
            'alisoncarly360@gmail.com',
            'aljoudalrasheedi@gmail.com',
            'almayyas.awatef@gmail.com',
            'almoumenzainab@gmail.com',
            'almutairialjazi9@gmail.com',
            'aloloa81@hotmail.com',
            'alotaiby32@gmail.com',
            'alqallafa_nm@hotmail.com',
            'alsaghyer29@gmail.com',
            'altafalsh23@gmail.com',
            'altafffff46@gmail.com',
            'amjadalajm_5432@icloud.com',
            'anfal20007m@gmil.com',
            'anfal223@icloud.com',
            'angle0eyes@gmail.com',
            'ansnansne2827@gmail.com',
            'appss2424@gmail.com',
            'aralrshidi@gmail.com',
            'aryaf4588@gmail.com',
            'aryam211@gmail.com',
            'aseelalburaisi11@gmail.com',
            'asmaawe41@gmail.com',
            'atefmanar069@gmail.com',
            'awradalmeshwet@gmail.com',
            'ayshay007@live.com',
            'azoghbour@gmail.com',
            'balqees2511@gmail.com',
            'bander332008@gmail.com',
            'bassantbahaa46@yahoo.com',
            'beriyesama@gmail.com',
            'berserker.w.bsk@gmail.com',
            'bnawaf5644@gmil.com',
            'bns987125@gmail.com',
            'boomar1974@hotmail.com',
            'bora7@gmail.com',
            'boshaldosari@gmail.com',
            'cocoonthestreet@gmail.com',
            'coldabcding@gmail.com',
            'd.k.alwasmi@hotmail.com',
            'danahalsanad6@gmail.com',
            'danaosama2008@yahoo.com',
            'dee@yahoo.com',
            'deee3716@gmail.com',
            'deema9795@gmail.com',
            'deemaalshmari5@gmail.com',
            'deemahaltrarwah01@outlook.com',
            'dk0825199@gmail.com',
            'dx95_@hotmail.com',
            'ealduraie@gmail.com',
            'ebtesamalm.06@gmail.com',
            'elafmh@icloud.com',
            'emaan.kw8@icloud.com',
            'emjhay678@gmail.com',
            'eng.soula@gmail.com',
            'esraa@dpmglob.com',
            'essa1313@outloo.com',
            'estbralenzi@gmail.com',
            'estbrqhamad@icloud.com',
            'f66099711@gmail.com',
            'faialb@outlook.com',
            'fajrf977@gmail.com',
            'faldhfeeri2@gmail.com',
            'falhallaq3@gmail.com',
            'fatamyah@outlook.com',
            'fatamyah6.82007@gmail.com',
            'fatima051127@gmail.com',
            'ffajora798@gmail.com',
            'fgfgvytt@gmail.com',
            'fmahadi656@gmail.com',
            'fouzmohamed25@gmail.com',
            'fouzsaedi9@gmail.com',
            'foza1968@icloud.com',
            'foza1969@icloud.com',
            'froohaldousarii4@icloud.com',
            'gana19811@gmail.com',
            'gh_al7addad@hotmail.com',
            'ghadder_191919@icloud.com',
            'ghezlanalsaleh679@gmail.com',
            'ghzoola2009@gmail.com',
            'goociangxl@gmail.com',
            'guihgg@gmil.com',
            'gxi1536@gmail.com',
            'gzyld8@gmail.com',
            'h.aldharman@icloud.com',
            'habela4567@gmail.com',
            'hadeel_2011@icloud.com',
            'hadeelmsabti@gmail.com',
            'halaalzayed00@gmail.com',
            'halmutairi662@gmail.com',
            'hamodazmi35@gmail.com',
            'hamsaahmed_ali@hotmail.com',
            'hana.albannay12@gmail.com',
            'hanaaahmed8801119@hotmail.com',
            'hanan1alshmmri@gmail.com',
            'hawraa.mk@icloud.com',
            'haya-aladwani@hotmail.com',
            'house809@icloud.com',
            'hussainipad01@gmail.com',
            'ialfajer7@gmail.com',
            'imaram86i@gmail.com',
            'j.jfg@icloud.com',
            'j.jtdh@xcf.com',
            'jaidahesham95@gmail.com',
            'jazi.31.kw@gmail.com',
            'jenanalmousawi210@gmail.com',
            'jhoe011898@gmail.com',
            'jiinnxy@gmail.com',
            'jj160vo@gmail.com',
            'jod_fahad@icloud.com',
            'joelle.09090@gmail.com',
            'jonridad@yahoo.com',
            'joodku2020@hotmail.com',
            'joriiookuwait123@gmail.com',
            'joryaaljassar@hotmail.com',
            'joryaljassar@hotmail.com',
            'jourealadwani@gmail.com',
            'jourinjen@icloud.com',
            'jwryalqryft@gmail.com',
            'kgqueen1999@gmail.com',
            'khaledibra119@gmail.com',
            'kooktae123o11@gmail.com',
            'kstocke@hotmail.com',
            'kwtia_86@hotmail.com',
            'kwtk334400@gmail.com',
            'kwyk123490@gmail.com',
            'lakahabwj@gmail.com',
            'lalaiealigay@gmail.com',
            'lallnzi190@gmail.com',
            'latifaalajmi2000@hotmail.com',
            'likehala@gmail.com',
            'lilialkandari3@gmail.com',
            'lojainquenn46@gmail.com',
            'loulwahalbloushi@gmail.com',
            'lulu.k.malallah@gmail.com',
            'luluwaaloniazi@gmail.com',
            'm.al3sly66@gmail.com',
            'ma.esmaili59@yahoo.com',
            'maari4e@yahoo.com',
            'magedezzat@hotmail.com',
            'mahaadel346@gmail.com',
            'mahaakmutairi13@icloud.com',
            'mahaalajmy3@gmail.com',
            'mahawy5@hotmail.com',
            'majedah_2009@icloud.com',
            'malak.ss123123@gmail.com',
            'malh42623@gmail.com',
            'manoya@gmail.com',
            'manoya172@gmail.com',
            'mans23alsubaie@icloud.com',
            'maramkh114@icloud.com',
            'marem308@gmail.com',
            'mariam_m09@icloud.com',
            'mariam450d@icloud.com',
            'mariamalajmi548@gmail.com',
            'mariamyaseer59@gmail.com',
            'marie789.com@icloud.com',
            'mariem.ouraied@gmail.com',
            'maryam.falhasiri00@gmail.com',
            'maryam_2009bts@hotmail.com',
            'maryoomb2016@gmail.com',
            'maryoomsherif@gmail.com',
            'mashael3dwani@gmail.com',
            'masouma97@hotmail.com',
            'mdaawi503@gmail.com',
            'mennagalal30@gmail.com',
            'mexishoo@gmail.com',
            'mhakuwait102@gmail.com',
            'mmm-q3@outlook.com',
            'mmohsen@dpmglob.com',
            'mohandesa79@yahoo.com',
            'mona05q8@gmail.com',
            'mrs.maritime2009@gmail.com',
            'msalkhaldy@yahoo.com',
            'muneera_altwaya@icloud.com',
            'muneera_altwayah@icloud.com',
            'mustersun009@gmail.com',
            'mutariathari@gmail.com',
            'n.furaih2008@gmail.com',
            'nadytm911@gmail.com',
            'najalaajami@gmail.com',
            'najla.almutairi6002@gmail.com',
            'najlaastay@gmail.com',
            'nawarah1412@icloud.com',
            'nehakw7@gmail.com',
            'netsudiacal@hotmail.com',
            'nfalbannai@gmail.com',
            'nikka_umali@yahoo.com',
            'noon.alk.02@gmail.com',
            'noona.q888@gmail.com',
            'noooor_822@hotmail.com',
            'noormohamed1312007@gmail.com',
            'norarafats2@gmail.com',
            'nore2070@hotmail.com',
            'noufah89@hotmail.com',
            'noura-albaloul@hotmail.com',
            'nourah.alfuraih14@gmail.com',
            'nourahalmotery@gmail.com',
            'nourahalmotery@icloud.com',
            'nskharaz@hotmail.com',
            'nuor.2025@icloud.com',
            'o-7007@hotmail.com',
            'odoekd@icloud.com',
            'omjasimaltmimi@gmail.com',
            'osama.sultan66@gmail.com',
            'patrick_boghdady@hotmail.com',
            'q8hope82@gmail.com',
            'q8moon1234@gmail.com',
            'r12january@hotmail.com',
            'ra467702@gmail.com',
            'ragahd.200790@icloud.com',
            'raghad.200790@icloud.com',
            'rahaf97x@gmail.com',
            'ralshmry116@gmail.com',
            'raventhamer2@gmail.com',
            'rawanalharbi2001@icloud.com',
            'rayanahmad2009719@gmail.com',
            'rcam80942@gmail.com',
            'reem2004q8@gmail.com',
            'reemah2666@icloud.com',
            'reemaldhafeeri0@gmail.com',
            'reemalkan2@gmail.com',
            'reemfarah54678@gmail.com',
            'remasalhamdan@gmail.com',
            'remasaljassar@gmail.com',
            'ritajmirza656@gmail.com',
            'rnivua@gmail.com',
            'rrawaany@gmail.com',
            'rubaalkhass@gmail.com',
            's_alhasawi@yahoo.com',
            'sa722.x@gmail.com',
            'sa722.x8@icloud.com',
            'saa060750@gmail.com',
            'sadan_2007@icloud.com',
            'salemaladel@hotmail.com',
            'salmaalajmi99@gmail.com',
            'salmaelsafany9@gmail.com',
            'salwaljurais7@gmail.com',
            'sameehakw@gmail.com',
            'sanadharbi@icloud.com',
            'saoudalali720@gmail.com',
            'saraalghanim12@gmail.com',
            'saraalqasemii@gmail.com',
            'sarafahad2000@icloud.com',
            'sarahagerman@hotmail.com',
            'sarahalazmii4@gmail.com',
            'sarahtalhouk@gmail.com',
            'sawaa17@gmail.com',
            'sba83622@gmail.com',
            'sead431@gmail.com',
            'seoannamj@gmail.com',
            'sh.alshamri@yahoo.com',
            'sh2h2d2090@gmail.com',
            'shadiaalotaibi2006@gmail.com',
            'shahad.2007.al_jre15@hotmail.com',
            'shahd.mohad.ali220055@gmail.com',
            'shaikaalfares@gmail.com',
            'shaikahaladwaniii@hotmail.com',
            'shaikhaalbloushi75@gmail.com',
            'shaikhabbh@gmail.com',
            'sharifa.alqallaf@gmail.com',
            'shaymaalb13@gmail.com',
            'shibajamil420@gmail.com',
            'shshhshjshs6@gmail.com',
            'sm3830755@gmail.com',
            'sndnqejdnn@gmail.com',
            'soudq81@gmail.com',
            'ss7023690@gmail.com',
            'ssalqallaf@hotmail.com',
            'ssarraa1981@gmail.com',
            'sulttani1974@gmail.com',
            'suvnll@icloud.com',
            'tagoresasmita@gmail.com',
            'taifalls35@gmail.com',
            'taiiif.614@gmail.com',
            'talal8585@hotmail.com',
            'taniatam77@hotmail.com',
            'tatoona06@gmail.com',
            'tdd03026@gmail.com',
            'tetenaana@gmail.com',
            'thanann_q8_@hotmail.com',
            'tobyy369@gmail.com',
            'totoo00.6655@gmail.com',
            'touchytahani@gmail.com',
            'tuliao.melanie72@gmail.com',
            'u@yahoo.com',
            'umbadori11@gmail.com',
            'uvzerp@gmail.com',
            'vb15vb@icloud.com',
            'vjkclxlilkhal@gmail.com',
            'vydamean@gmail.com',
            'wafaa.1987.3@gmail.com',
            'wan.payments@gmail.com',
            'wasan_alfheed@yahoo.com',
            'wejdan922@outlook.com',
            'wesalalotbi@icloud.com',
            'whait2003@hotmail.com',
            'wintertata10@gmail.com',
            'x4llr2@gmail.com',
            'xnazziiz@hotmail.com',
            'xxareejo0oxx@gmail.com',
            'xxtaifxx.21@gmail.com',
            'xxzfajer@gmail.com',
            'y.65545510@gmail.com',
            'yonayonana3@gmail.com',
            'yraaajjobara@gmail.com',
            'zaanzoon1234@gmail.com',
            'zakariadaki@gmail.com',
            'zamk0549@gmail.com',
            'zdana4709@gmail.com',
            'zmzmayed4@gmail.com',
            'zozoahh@hotmail.com',
            'zozoalk183@gmail.com',
            'zps34353@gmail.com',
            'zxzxtrkee@gmail.com',

        ];

        try {

        $customers = DB::select("SELECT email FROM kshopina.shopify_orders where country ='Kuwait' group by email");
        /* Mail::to('mmohsen@dpmglob.com')->send(new Discount(), function ($message) {
                    $message->subject("");
                }); */

        for ($i=0; $i < count($customers) ; $i++) { 

            try {
            
                if ($customers[$i]->email == 'bent.tamim9@gmail.com' || !empty($email)) {
                    $email = $customers[$i]->email;

                    Mail::to($customers[$i]->email)->send(new Discount(), function ($message) {
                        $message->subject("");
                    });

                    $send_email[$customers[$i]->email] = $customers[$i]->email;
                }else{
                    $send_email[$customers[$i]->email] = $customers[$i]->email;
                }
                
                /* $send_email[$customers[$i]->email] = $customers[$i]->email; */

            } catch (\Throwable $th) {
                sleep(60);
                $i =$i - 1;
            }
        }

        for ($i=0; $i < count($plus_mails) ; $i++) { 
            try {
            
                if (!isset($send_email[$plus_mails[$i]])) {
                    $email = $plus_mails[$i];

                    Mail::to($plus_mails[$i])->send(new Discount(), function ($message) {
                        $message->subject("");
                    });

                    $send_email[$plus_mails[$i]] = $plus_mails[$i];
                }
                
            } catch (\Throwable $th) {
                sleep(60);
                $i =$i - 1;
            }
        }
       
        /* Mail::to('mmohsen@dpmglob.com')->send(new Discount(), function ($message) {
            $message->subject("");
        }); */
        return [$email];
        } catch (\Throwable $th) {
            return [$th,$email,$send_email] ;
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
        
        date_default_timezone_set('Africa/Cairo');
        $date = date('Y-m-d', time());

        if (isset($this->Naqel_keys[$country]) ) {
            $credentials = $this->Naqel_keys[$country];
        }else{
            $credentials = DB::select('SELECT * from naqel where country = ?', [$country]);
        }

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
                        <ClientID>'.$credentials[0]->client_id.'</ClientID>
                        <Password>'.$credentials[0]->password.'</Password>
                        <Version>'.$credentials[0]->version.'</Version>
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
            return $json = json_encode($xml);
            $responseArray = json_decode($json,true);

            $auth_call = $responseArray['soapBody']['TraceByWaybillNoResponse'];

            /* dd($auth_call); */
            /* $auth_call = $soapClient->TraceByWaybillNo($params); */

        } catch (\Throwable $th) {
            return $th;
            return DB::table('errors')->insert(['shipment_number' => $tracking_number, 'system_name' => 'NAQEL_TRACKING_1', 'status' => 'Fail', 'message' => $th ]);
        }

        if (isset($auth_call['TraceByWaybillNoResult']['Tracking']['ErrorMessage']) && !empty($auth_call['TraceByWaybillNoResult']['Tracking']['ErrorMessage'])) {

            return $auth_call['TraceByWaybillNoResult']['Tracking']['ErrorMessage'];
            DB::table('errors')->insert(['shipment_number' => $order_number, 'system_name' => 'NAQEL_TRACKING_2', 'status' => 'Fail', 'message' => $auth_call['TraceByWaybillNoResult']['Tracking']['ErrorMessage'] ]);

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
                
                    if (isset($record->EventCode) && ($record->EventCode == 1 || $record->EventCode == 120 || $record->EventCode == 122 || $record->EventCode == 124 || $record->EventCode == 125 || $record->EventCode == 126 || $record->EventCode == 9 || $record->EventCode == 44 || $record->EventCode == 221 || $record->EventCode == 1 || $record->EventCode == 226 || $record->EventCode == 3)  && $arrive == 0 ) {
                        $hub = 1;
                        
                        $status = $this->status['Kshopina_Warehouse'];
                        $dates['in_warehouse_at'] = date("Y-m-d H:i:s", strtotime($record->Date));

                        $query['status'] = $status;
                        $query['in_warehouse_at'] = $dates['in_warehouse_at'];

                    }elseif (isset($record->EventCode) && $record->EventCode == 5 ) {

                        $status = $this->status['Delivery'];
                        $dates['delivery_at'] = date("Y-m-d H:i:s", strtotime($record->Date));

                        $query['status'] = $status;
                        $query['delivery_at'] = $dates['delivery_at'];

                    } elseif (isset($record->EventCode) && $record->EventCode == 7 ) {

                        $status = $this->status['Delivered'];
                        $dates['delivered_at'] = date("Y-m-d H:i:s", strtotime($record->Date));

                        $query['status'] = $status;
                        $query['delivered_at'] = $dates['delivered_at'];

                    }elseif (isset($record->EventCode) && isset($refused_reasons[$record->EventCode]) ) {
                        $arrive = 1;
                        
                        $status = $this->status['Refused'];
                        $dates['delivered_at'] = date("Y-m-d H:i:s", strtotime($record->Date));
                        $query['status'] = $status;
                        $query['delivered_at'] = $dates['delivered_at'];

                        $query['side_note'] = $record->Activity;
                        $query['issue']=6;
                        $reason = $record->Activity;

                    }elseif(isset($record->EventCode) && isset($reasons[$record->EventCode]) ){

                        $query['side_note'] = $reasons[$record->EventCode];
                        $query['issue']=6;
                        $reason = $reasons[$record->EventCode];
                    }
                    elseif(isset($record->EventCode) && isset($customs_cases[$record->EventCode]) ){

                        $query['side_note'] =$record->Activity;
                        $query['issue']=6;
                        $query['status'] = $old_status;
                        $reason = $record->Activity;
                        $special_case = 1;
                    }
                    elseif(isset($record->EventCode) && isset($warehouse_cases[$record->EventCode]) ){

                        $query['side_note'] =$record->Activity;
                        $query['issue']=6;
                        $reason = $record->Activity;
                        $special_case = 1;

                        $status = $this->status['Kshopina_Warehouse'];
                        $query['status'] = $status;
                    }
                    
                }
            }else{
                return 'NO TRACKING INFO FOUND';
                DB::table('errors')->insert(['shipment_number' => $order_number, 'system_name' => 'NAQEL_TRACKING_4', 'status' => 'Fail', 'message' => 'NO TRACKING INFO FOUND' ]);
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
                dd($auth_call);
                DB::table('errors')->insert(['shipment_number' => $tracking_number, 'system_name' => 'NAQEl_TRACKING_4', 'status' => 'Success', 'message' => "No data for NAQEL tracking number"]);
            }


        }
            
    }

    public function add_group_tracking(){
        $id=$_POST['id'];
        $tracking_number=$_POST['tracking_number'];
        $tracking_url=$_POST['tracking_url'];
      
       $this->verificationModel->add_group_tracking($id,$tracking_number,$tracking_url);
    }


    public function add_new_manual_product(Request $request)
    {
        $store='origin';

        $products_ids= [ 8853121892628 , 8853150433556 ];

        foreach ($products_ids as $product_id) {
            try {
                $shopify_token = DB::table('config')->where('keyy', $store)->get()[0]->value;
                $store_url = DB::table('config')->where('keyy', $store . '_url')->get()[0]->value;
            
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
                $order = $store_url . "/admin/api/2023-04/products/".$product_id.".json";
                // Open the file using the HTTP headers set above
                $data = file_get_contents($order, false, $context);
                $order = json_decode($data);
                $product = $order->product;

                if (isset($product->image->src)) {
                    $image = $product->image->src;
                } else {
                    $image = "";
                }

                $product_data = [
                    'product_title' => $product->title,
                    'product_id' => $product->id,
                    'product_type' => $product->product_type,
                    'product_tags' => $product->tags,
                    'created_at' => date("Y-m-d H:i:s", strtotime($product->created_at)),
                    'store' => $store,
                    'number_of_variants' => count($product->variants),
                    'product_cover_image' => $image,
                ];
                $id = DB::table('stock')->insertGetId($product_data);

                foreach ($product->variants as $variant) {

                    $variant_data = [
                        'product_id' => $id,
                        'variant_id' => $variant->id,
                        'variant_title' => $variant->title,
                        'variant_price' => $variant->price,
                        'variant_sku' => $variant->sku,
                        'variant_image' => $variant->image_id,
                        'variant_inventory_id' => $variant->inventory_item_id,
                        'variant_quantity' => $variant->inventory_quantity,
                        'variant_all_quantity' => $variant->inventory_quantity,

                    ];
                    $variant_id = DB::table('variants')->insertGetId($variant_data);
                   
                    DB::insert('insert into errors (message , system_name ) values (? , ?)', [$product->id.'----'.$variant->id , 'new_product_in '.$store ]);

                    if ($store =='origin') {
                        DB::table('variants')->where('id',$variant_id)->update(['unique_barcode'=>$id.$variant_id]);
                    }
                }
            } catch (\Throwable $th) {

                return [$th,$product_id];
            }
        }
            return 'done';

    }


    public function aramex_new_tracking (){

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
      
        /* $soapClient = new SoapClient('shipments-tracking-api-wsdl.wsdl' , $options ); */
       /*  http://ws.aramex.net/ShippingAPI.V2/Tracking/Service_1_0.svc?singleWsdl */
                                        
        $soapClient = new SoapClient('https://ws.dev.aramex.net/ShippingAPI.V2/Tracking/Service_1_0.svc?singleWsdl', $options);

        $params = array(
            'ClientInfo' => [
                "UserName" =>  "testingapi@aramex.com",
                "Password" =>  'R123456789$r',
                "Version" =>  "v1",
                "AccountNumber" => "987654",
                "AccountPin" =>  "226321",
                "AccountEntity" => "CAI",
                "AccountCountryCode" => "EG",
                "Source" => 24
            ],
            "GetLastTrackingUpdateOnly" => false, 
            'Transaction' => [
                "Reference1"=> "001"
            ],
            'Shipments' => [
               '123456782' // Replace with your Shipment number by looking in the Aramex dashboard
            ]

        );

       
        // calling the method and printing results
        try {
            $auth_call = $soapClient->TrackShipments($params);

            $arr = (array)$auth_call->TrackingResults;
            return $auth_call;
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
                'tracking' => '123456782',
                'fulfilled' => null,
                'dispatched' => null,
                'customs' => null,
                'warehouse' => null,
                'delivery' => null,
                'delivered' => null
            );

          /*   for ($i = 0; $i < count($code); $i++) {
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
            } */

           
        }catch (SoapFault $fault) {
 
            return $fault;
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
        
    }


    public function all_manual_create_new_order(Request $request)
    {
        $store = 'plus_uae';

        $order=["U1001"];

        foreach ($order as $key => $value) {
         

            $shopify_token = DB::table('config')->where('keyy', $store)->get()[0]->value;
            $store_url = DB::table('config')->where('keyy', $store . '_url')->get()[0]->value;
        
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
            $order = $store_url . "/admin/api/2023-04/orders.json?name=".$value."&status=any";
            // Open the file using the HTTP headers set above
            $data = file_get_contents($order, false, $context);
            $order = json_decode($data);
            $order = $order->orders;


            foreach ($order as $key => $response) {
                $order_number = substr($response->name, 1);

                try {
                    $check =$this->isExist($store, $order_number)[0];
                } catch (\Throwable $th) {
                    DB::insert('insert into errors (shipment_number,message,system_name) values (?,?,?)', [$order_number, 'isExist', $store]);
                }

                if (!$check) {
                    try {
                        $this->add_new_order($response, $store);
                    } catch (\Throwable $th) {
                        DB::insert('insert into errors (shipment_number,message,system_name) values (?,?,?)', [$order_number, 'add_new_order', $store]);
                        DB::insert('insert into errors (shipment_number,message,system_name) values (?,?,?)', [$order_number, $th, $store]);

                    }
                    try {
                        $this->saveitem($store, $response->line_items, $order_number,$response);
                    } catch (\Throwable $th) {
                        DB::insert('insert into errors (shipment_number,message,system_name) values (?,?,?)', [$order_number, 'saveitem', $store]);
                        DB::insert('insert into errors (shipment_number,message,system_name) values (?,?,?)', [$order_number, $th, $store]);

                    }
                    try {
                        $token = $this->verificationModel->generate_url($order_number);
                    } catch (\Throwable $th) {
                        DB::insert('insert into errors (shipment_number,message,system_name) values (?,?,?)', [$order_number, 'generate_url', $store]);
                        DB::insert('insert into errors (shipment_number,message,system_name) values (?,?,?)', [$order_number, $th, $store]);

                    }
                    try {
                        if ($response->contact_email =='bnbh@gmail.com' || $response->contact_email =='hk@gmail.com' || $response->contact_email =='ggg@gmail.com') {
                            
                            $this->verificationModel->cancel_shopify($store, (string) $order_number, 'verification');
                            DB::table('orders')->where('order_number', $order_number)->update(['action_by' => 'KMEX-BAN']);

                        }else{
                            $this->verificationModel->first_verification_mail($store, (string) $order_number, $token);

                        }
                    } catch (\Throwable $th) {
                        DB::insert('insert into errors (shipment_number,message,system_name) values (?,?,?)', [$order_number, 'first_verification_mail', $store]);
                        DB::insert('insert into errors (shipment_number,message,system_name) values (?,?,?)', [$order_number, $th, $store]);

                    }
                    try {
                        $this->check_gateway($order_number, $store);
                    } catch (\Throwable $th) {
                        DB::insert('insert into errors (shipment_number,message,system_name) values (?,?,?)', [$order_number, 'check_gateway', $store]);
                        DB::insert('insert into errors (shipment_number,message,system_name) values (?,?,?)', [$order_number, $th, $store]);

                    }

                    /* DB::insert('insert into errors (shipment_number,message,system_name) values (?,?,?)', [$response->order_number, "send", $store]); */
                }else{
                    return 'found';
                }
            }
            
        }
        return 'done';
    }

    public function check_gateway($order_number, $store)
    {
        $order = DB::select('SELECT * from orders where order_number = ? AND store = ?', [$order_number, $store]);

        if ($order[0]->gateway != 'COD' && $order[0]->financial_status == 'paid' && $order[0]->category == 0) {
            DB::table('orders')->where(['order_number' => $order_number, "store" => $store])->update(['category' => 2]);
        }

    }

    public function isExist($store, $order_number)
    {
        $check = DB::select('SELECT * from orders where order_number = ? AND store = ?', [$order_number, $store]);

        if (count($check) == 0 ) {
            return [false, []];
        } else {
            return [true, $check];
        }
    }

    public function add_new_order($order, $store)
    {
        try {
            $gateway_value = $order->payment_gateway_names[count($order->payment_gateway_names)-1];

            if ($gateway_value == "Cash on Delivery (COD)") {
                $gateway = "COD";
                $category = 0;
            } else if ($gateway_value == "E-Wallet (Vodafone Cash / We Cash / Orange Cash and more..)" && $order->financial_status == 'paid') {
                $gateway = "E-Wallet";
                $category = 2;
            } elseif ($order->financial_status == 'paid') {
                $gateway = $gateway_value;
                $category = 2;
            } else {
                $gateway = $gateway_value;
                $category = 0;
            }

            if ($store == 'origin') {
                $order_number = $order->order_number;
            } else {
                $order_number = substr($order->name, 1);
            }

            if (!$this->isExist($store, $order->order_number)[0]) {

                date_default_timezone_set('Africa/Cairo');
                $date = date('Y-m-d H:i:s', time());

                //currency

                $total_price_with_discount=$order->total_price;


                if ($store == 'origin') {
                    $currency_rate = "";
                    if ($order->shipping_address->country == 'Egypt') {
                        $currency_rate = $this->get_currency('EGP');
                    } else if ($order->shipping_address->country == 'Saudi Arabia') {
                        $currency_rate = $this->get_currency('SAR');
                    } else if ($order->shipping_address->country == 'United Arab Emirates') {
                        $currency_rate = $this->get_currency('AED');
                    } else if ($order->shipping_address->country == 'Bahrain') {
                        $currency_rate = $this->get_currency('BHD');
                    } else if ($order->shipping_address->country == 'Kuwait') {
                        $currency_rate = $this->get_currency('KWD');
                    } else if ($order->shipping_address->country == 'Oman') {
                        $currency_rate = $this->get_currency('OMR');
                    } else if ($order->shipping_address->country == 'Jordan') {
                        $currency_rate = $this->get_currency('JOD');
                    } else if ($order->shipping_address->country == 'Qatar') {
                        $currency_rate = $this->get_currency('QAR');
                    }

                    if ($currency_rate == "") {
                        $converted_price = $total_price_with_discount;
                    } else {
                        $converted_price = $total_price_with_discount * $currency_rate[0]->value;
                    }
                } else {
                    $converted_price = $total_price_with_discount;
                }

                if ($store=='origin') {
                    $date = new DateTime($order->created_at, new DateTimeZone('Asia/Seoul'));
                    $date->setTimezone(new DateTimeZone('Africa/Cairo'));
                }
                else if($store=='plus_ksa'){
                    $date = new DateTime($order->created_at, new DateTimeZone('Asia/Riyadh'));
                    $date->setTimezone(new DateTimeZone('Africa/Cairo'));
                }else if($store=='plus_kuwait'){
                    $date = new DateTime($order->created_at, new DateTimeZone('Asia/Kuwait'));
                    $date->setTimezone(new DateTimeZone('Africa/Cairo'));
                }else{
                    $date = new DateTime($order->created_at, new DateTimeZone('Africa/Cairo'));
                }
                


                $order_date = $date->format('Y-m-d H:i:s');
                $order_data = array(
                    'order_number' => $order_number,
                    'name' => $order->shipping_address->name,
                    'email' => $order->contact_email,
                    'customer_id' => $order->customer->id,
                    'order_id' => $order->id,
                    'total_price' => $total_price_with_discount,
                    'currency' => round($converted_price),
                    'phone_number' => $order->shipping_address->phone,
                    'address' => $order->shipping_address->address1,
                    'apartment' => $order->shipping_address->address2,
                    'city' => $order->shipping_address->city,
                    'country' => $order->shipping_address->country,
                    'province' => $order->shipping_address->province,
                    'gateway' => $gateway,
                    'token' => "",
                    'created_at' => $order_date,
                    'saved_at' => $date,
                    'verified' => 0,
                    'category' => $category,
                    'active' => 0,
                    'store' => $store,
                    'financial_status' => $order->financial_status,
                );

                if (!empty($order_data)) {

                    DB::insert('insert into orders (order_number, name,email,customer_id,order_id,
                    total_price,currency,phone_number,address,apartment,city,country,province,gateway,token,created_at,saved_at,verified,category,active,store,financial_status)
                    values (?, ?,?,?, ?,?,?,?, ?,?,?, ?,?,?, ?,?,?, ?,?,?, ?,?)',
                        [
                            $order_number, $order->shipping_address->name, $order->contact_email, $order->customer->id,
                            $order->id, $total_price_with_discount, round($converted_price), $order->shipping_address->phone, $order->shipping_address->address1,
                            $order->shipping_address->address2, $order->shipping_address->city, $order->shipping_address->country,
                            $order->shipping_address->province, $gateway, "", $order_date, $date, 0, 0, 0, $store, $order->financial_status,
                        ]);

                    if ($store == 'origin') {
                        $cancel_at = "";
                        $status = "";
                        $country = "";
                        $city = "";

                        if (($gateway_value == "Cash on Delivery (COD)" || $gateway_value == "manual") && $order->cancelled_at != null && $order->financial_status == "voided") {
                            $cancel_at = date("Y-m-d H:i:s", strtotime($order->cancelled_at));
                            $status = "canceled";
                        } else if ($gateway_value == "Cash on Delivery (COD)" && $order->financial_status == "paid") {
                            $status = "confirmed";
                        } else if ($gateway_value == "manual" && $order->financial_status == "paid" && $order->fulfillment_status == "fulfilled") {
                            $status = "confirmed";
                        } else {
                            $status = "pending";
                        }

                        try {
                            if (isset($order->customer->default_address)) {
                                $country = $order->customer->default_address->country;
                                $city = $order->customer->default_address->city;
                            } else {
                                $country = "";
                                $city = "";
                            }


                            $shopify_token = DB::table('config')->where('keyy', $store)->get()[0]->value;
                            $store_url = DB::table('config')->where('keyy', $store . '_url')->get()[0]->value;

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
                            $customer = $store_url . "/admin/api/2023-01/customers/".$order->customer->id.".json";
                            // Open the file using the HTTP headers set above
                            $data = file_get_contents($customer, false, $context);
                            $customer = json_decode($data);
                            $customer = $customer->customer;
            
            
                            $orders_count= $customer->orders_count;

                            DB::insert('insert into shopify_orders (order_number, order_id,currency,total_price,financial_status,gateway,note,tags,customer_id,email,first_name,last_name,phone,country,city,
                            orders_count,created_at,updated_at,cancelled_at,status) values (?, ?,?, ?,?, ?,?, ?,?, ?,?, ?,?, ?,?, ?,?, ?,?, ?)',
                                [$order->order_number, $order->id, $order->currency, $total_price_with_discount, $order->financial_status, $gateway_value, $order->note, $order->tags, $order->customer->id,
                                    $order->customer->email, $order->customer->first_name, $order->customer->last_name, $order->customer->phone, $country,
                                    $city, $orders_count, date("Y-m-d H:i:s", strtotime($order->created_at)), date("Y-m-d H:i:s", strtotime($order->updated_at)),
                                    $cancel_at, $status]);
                        } catch (\Throwable $th) {
                            DB::insert('insert into errors (shipment_number,system_name,message) values (?,?,?)', [$order->order_number, 'shopify_orders', $th]);
                        }
                    }
                }
            }

            return $order_number;

        } catch (\Throwable $th) {

            DB::insert('insert into errors (shipment_number,message,system_name) values (?,?,?)', [$order->order_number, $th, $store]);
        }
    }

    public function saveitem($store, $variants, $order_number,$order_data)
    {

        foreach ($variants as $k => $variant) {

            date_default_timezone_set('Asia/Seoul');
            $date = date('Y-m-d H:i:s', time());

            if (isset($variant->variant_id) && $variant->variant_id != null && !$this->is_item_exist($store, $variant->variant_id, $order_number)[0]) {

                if (isset($variant->variant_title) && $variant->variant_title != null) {
                    $variant_title = $variant->variant_title;
                }else{
                    $variant_title = 'Default';
                }

                DB::table('items')->insert([
                    'order_id' => $order_number,
                    'country_code' => 'KR',
                    'product_id' => $variant->product_id,
                    'quantity' => $variant->quantity,
                    'price' => $variant->price,
                    'product_name' => $variant->title,
                    'variant_name'=> $variant_title,
                    'variant_id' => $variant->variant_id,
                    'sku' => $variant->sku,
                    'saved_at' => $date,
                    'store' => $store,
                ]);

                if ($store != 'origin') {
                    
                    $product_values = DB::select('SELECT * from stock where product_id = ? AND store = ?', [$variant->product_id, $store]);

                    $stock_info = DB::select('SELECT * from variants where product_id = ? AND variant_id = ?', [$product_values[0]->id,$variant->variant_id]);


                    $history['operation'] = 'OUT';
                    $history['operation_side'] = 'Shopify';
                    $history['product_id'] = $stock_info[0]->product_id;

                    $history['variant_quantity'] = $stock_info[0]->variant_quantity;

                    $history['adjust'] = $variant->quantity;

                    $this->stock_history($history, $stock_info[0]->id, $store, 'Shopify', false);

                    DB::update('UPDATE kshopina.variants SET variant_quantity = (variant_quantity - ?) WHERE variant_id = ? AND product_id = ? ;', [$variant->quantity, $variant->variant_id,$product_values[0]->id]);

                }

                
            }/* else{
                DB::table('items')->insert([
                    'order_id' => $order_number,
                    'country_code' => 'KR',
                    'product_id' => $variant->product_id,
                    'quantity' => $variant->quantity,
                    'price' => $variant->price,
                    'product_name' => $variant->title,
                    'variant_id' => $variant->variant_id,
                    'sku' => $variant->sku,
                    'saved_at' => $date,
                    'store' => $store,
                ]);
            } */

        }
        $gateway_value = $order_data->payment_gateway_names[count($order_data->payment_gateway_names)-1];

        if (($store == 'origin' || $store == 'plus_ksa' || $store == 'plus_kuwait') && $gateway_value =='Cash on Delivery (COD)') {
                    
            $cash_fee_numbers=[
            'origin'=> 2.00,
            'plus_ksa'=> 5.00,
            'plus_kuwait'=> .500
            ];
            $cash_fee_string=[
                'origin'=> '2.00',
                'plus_ksa'=> '5.00',
                'plus_kuwait'=> '.500'
            ];

            DB::table('items')->insert([
                'order_id' => $order_number,
                'country_code' => 'KR',
                'product_id' => null,
                'quantity' => 1,
                'price' => $cash_fee_string[$store],
                'product_name' => 'Cash on Delivery fee',
                'variant_name'=> '-',
                'variant_id' => null,
                'sku' => null,
                'saved_at' => $date,
                'store' => $store,
            ]);

            $total_price_with_discount=$order_data->total_price + $cash_fee_numbers[$store];
            $currency_rate = "";

            if ($order_data->shipping_address->country == 'Egypt') {
                $currency_rate = $this->get_currency('EGP');
            } else if ($order_data->shipping_address->country == 'Saudi Arabia') {
                $currency_rate = $this->get_currency('SAR');
            } else if ($order_data->shipping_address->country == 'United Arab Emirates') {
                $currency_rate = $this->get_currency('AED');
            } else if ($order_data->shipping_address->country == 'Bahrain') {
                $currency_rate = $this->get_currency('BHD');
            } else if ($order_data->shipping_address->country == 'Kuwait') {
                $currency_rate = $this->get_currency('KWD');
            } else if ($order_data->shipping_address->country == 'Oman') {
                $currency_rate = $this->get_currency('OMR');
            } else if ($order_data->shipping_address->country == 'Jordan') {
                $currency_rate = $this->get_currency('JOD');
            } else if ($order_data->shipping_address->country == 'Qatar') {
                $currency_rate = $this->get_currency('QAR');
            }

            if ($currency_rate != "") {
                $converted_price = $total_price_with_discount * $currency_rate[0]->value;
                DB::table('orders')->where('order_number',$order_number)->update(['total_price'=>$total_price_with_discount ,'currency' => round($converted_price)]);
            }
        }
    }



    
    //ON HOLD
    /* mark_order_as_onHold */
   /*  public function update_fvm (){

        $fulfilment_id=0;
        $open_or_hold='';

        $fulfilmentList=$this->verificationModel->get_fulfillment_list(5235850641684,'origin');

        try {
            if (isset($fulfilmentList['fulfillment_orders']) ) {
                foreach ($fulfilmentList['fulfillment_orders'] as $key => $fulfilment) {
                    if ($fulfilment['status']=='open') {
                        $open_or_hold='open';
                        $fulfilment_id= $fulfilment['id'];
                    }elseif($fulfilment['status']=='on_hold'){
                        $open_or_hold='hold';
                        $fulfilment_id= $fulfilment['id'];
                    }
                }
                if ($fulfilment_id != 0) {
                    if ($open_or_hold =='open') {
                        return $this->verificationModel->mark_fulfillment_as_onHold($fulfilment_id,'origin',5235850641684);
                    }else{
                        return $this->verificationModel->release_onHold_fulfillment($fulfilment_id,'origin',5235850641684);
                    }
                    
                }else{
                    return [false,'ORDER ALREADY FULFILLED IN SHOPIFY'];
                }
            }else{
                return [false,'NO FULFILMENT HISTORY IN SHOPIFY'];
            }
        } catch (\Throwable $th) {
            return $th;
        }
        
        
    } */

    /* public function update_fvm()
    {
    $this->verificationModel->update_fvm();

    } */
    /*  public function update_fvm()
    {
    ignore_user_abort();
    set_time_limit(50000);
    try {
    // $x = 'eyJkaXJlY3Rpb24iOiJuZXh0IiwibGFzdF9pZCI6NTIzODc3OTk2OTYyNCwibGFzdF92YWx1ZSI6MTYyNzMzNDkwODAwMH0';
    $nextPageToken = 'eyJkaXJlY3Rpb24iOiJuZXh0IiwibGFzdF9pZCI6MjQ0OTI4MzcxMTA2NCwibGFzdF92YWx1ZSI6MTU3MDE3MzQyMTAwMH0';
    $customers = [];
    $page_infos = [];

    $i = 0;

    do {
    sleep(3);
    $response = $this->verificationModel->get_customers('GET', 'https://kshopina.myshopify.com/admin/api/2021-10/customers.json?limit=250&page_info=' . $nextPageToken);

    foreach ($response['resource'] as $customer) {

    try {
    $country = $customer['addresses'][0]['country'];
    $city = $customer['addresses'][0]['city'];
    $phone = $customer['addresses'][0]['phone'];
    } catch (\Throwable $th) {
    $country = null;
    $city = null;
    $phone = null;
    }

    array_push($customers, (object) [
    'id' => $customer['id'],
    'email' => $customer['email'],
    'first_name' => $customer['first_name'],
    'last_name' => $customer['last_name'],
    'phone' => $phone,
    'country' => $country,
    'city' => $city,
    'orders_count' => $customer['orders_count'],
    'state' => $customer['state'],
    'total_spent' => $customer['total_spent'],
    'currency' => $customer['currency'],
    'last_order_id' => $customer['last_order_id'],
    'note' => $customer['note'],
    'verified_email' => $customer['verified_email'],
    'tags' => $customer['tags'],
    'last_order_name' => $customer['last_order_name'],
    'created_at' => $customer['created_at'],
    'updated_at' => $customer['updated_at'],
    ]);
    }
    $nextPageToken = $response['next']['page_token'] ?? null;
    array_push($page_infos, $nextPageToken);
    $i++;
    } while ($nextPageToken != null && $i < 24);
    try {

    foreach ($customers as $customer) {

    $this->verificationModel->insert_customers(
    $customer->id,
    $customer->email,
    $customer->first_name,
    $customer->last_name,
    $customer->phone,
    $customer->country,
    $customer->city,
    $customer->orders_count,
    $customer->state,
    $customer->total_spent,
    $customer->currency,
    $customer->last_order_id,
    $customer->note,
    $customer->verified_email,
    $customer->tags,
    $customer->last_order_name,
    $customer->created_at,
    $customer->updated_at
    );
    }
    } catch (\Throwable $th) {
    dd($th);
    }
    } catch (\Throwable $th) {
    dd($th);
    }
    return $page_infos;
    } */

    public function update_fvm(Request $request)
    {/* $origin=0;
        if (ctype_digit(substr((string) 's1901' ,0,1))) {
            $origin = 1;
        }

        return $origin; */

        $orders =[ "26653" , "26654" , "26655" , "26656" , 
                    "26657" , "26658" , "26659" , "26660" , 
                    "26661" , "26662" , "26663"
        ];
        
        try {
            foreach ($orders as $order_number) {
                return $this->verificationModel->add_manual_order($order_number);
            }
        } catch (\Throwable $th) {
            return $th;
        }
       /*  try {
            dd ($this->verificationModel->return_to_pending());  
        } catch (\Throwable $th) {
            return $th;
        } */

       /*  $str = 'one';

        return explode('|', $str);
 */
        /* date_default_timezone_set('Africa/Cairo'); */
        
/*         return date('Y-m-d H:i:s', 1671510882753/1000);
 */        /* 
        $tags="Waiting_for_confirmation";

        if (str_contains($tags, 'Waiting_for_confirmation')) { 

            return str_replace("Waiting_for_confirmation", "#Confirmed", $tags);
        }
        else{
            return 'false';
        } */

        /* $header = array(
            'http' => array(
                'method' => "GET",
                'header' => "X-Shopify-Access-Token: " ,

            ),
            "ssl" => array(
                "verify_peer" => false,
                "verify_peer_name" => false,
            ),
        );

        $context = stream_context_create($header);
        $order = "https://kshopina.com/admin/api/2021-01/orders.json?name=20000&status=any";
        // Open the file using the HTTP headers set above
        $data = file_get_contents($order, false, $context);
        $order = json_decode($data);
        $order = $order->orders;


        return substr($order[0]->name, 1); */


/*         $getip = UserSystemInfoHelper::get_ip();
    $getbrowser = UserSystemInfoHelper::get_browsers();
    $getdevice = UserSystemInfoHelper::get_device();
    $getos = UserSystemInfoHelper::get_os();

    $ipp= json_decode(file_get_contents("http://ipinfo.io/{$getip}/json?token=add6d175ef3bd5"));

    
    return "<center>$getip <br> $getdevice <br> $getbrowser <br> $getos</center>";



        $userAgent = $request->header('user-agent');
        $userAgentString = strtolower($userAgent);
        
        $androidKeywords = ['android'];
        $iosKeywords = ['iphone', 'ipad'];
    
        $isAndroidDevice = \Illuminate\Support\Str::contains($userAgentString, $androidKeywords);
        $isIosDevice = \Illuminate\Support\Str::contains($userAgentString, $iosKeywords);
    
        if ($isAndroidDevice) {
            return 'android';
        } elseif ($isIosDevice) {
            return 'ios';
        } else {
            return 'pc';
        }
    
        
        return $request->ip(); */

        /* $groupJob = (new AddToGroup())->delay(now()->addSeconds(10));
        dispatch($groupJob);
         
        return "dssd"; */
        try {
            /* $orders=DB::select("SELECT * from orders where international_awb is not null AND fulfilled_by ='Esraa' AND verified = 6 AND created_at > '2022-08-01' ");
            $arr=[];

            foreach ($orders as $order_data) {
                $fulfillment=$this->tstModel->get_fulfillment_id($order_data->order_number, $order_data->store);

                if (count($fulfillment) == 1) {
                    $fulfill_id=$fulfillment[0]->id;
                    $this->tstModel->update_fulfillment_tracking($fulfill_id, $order_data->store,$order_data->kshopina_awb,$order_data->id);
                }
                else{
                    $arr[$order_data->order_number]=count($fulfillment);
                }
            }

            return $arr; */
            
            /* $last_method_time=floor(microtime(true) * 1000);
            $sleep_delay_sec = 6000;

            $time_now=floor(microtime(true) * 1000);
                
            if (($time_now - $last_method_time ) >= $sleep_delay_sec) {

                $last_method_time=floor(microtime(true) * 1000);
                return $last_method_time;
            }else{

                usleep( ($sleep_delay_sec -($last_method_time - $time_now)) * 1000 );
                $last_method_time =floor(microtime(true) * 1000);

            }

            $now = floor(microtime(true) * 1000);

            usleep( 500000 );

            $now2 = floor(microtime(true) * 1000);


            dd ( $last_method_time - $time_now ); */


           /*  $data= $this->verificationModel->get_products_from_shopify("plus_egypt");
            $data2= $this->verificationModel->compare_between("plus_egypt",$data[0]);
            dd($data[1],$data2); */

            
            

            /* $start_date = new DateTime(date('Y-m-d H:i:s', time())); // For today/now, don't pass an arg.
            $end_date = new DateTime(date('Y-m-d H:i:s', time()));

            $end_date->modify("-4 day");
            $start_date->modify("-3 day");
            
            return [$start_date->format("Y-m-d H:i:s"),$end_date->format("Y-m-d H:i:s")]; */

        /* return $this->verificationModel->rateReminder(); */

            
        } catch (\Throwable $th) {
            return $th;
        }
    }
}
