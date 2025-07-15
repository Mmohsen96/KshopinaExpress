<?php

namespace App\Http\Controllers;

use App\Mail\ComplainMail;
use App\Mail\ComplainReply;
use App\Mail\TrackingMail;
use App\Mail\CsComplainMail;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class ComplainsController extends Controller
{

    protected $complainsModel;
    protected $ordersModel;
    protected $historyModel;
    protected $verificationModel;

    public function __construct(Request $request)
    {
        $this->complainsModel = new \App\Models\Complains();
        $this->ordersModel = new \App\Models\Orders();
        $this->historyModel = new \App\Models\History();
        $this->verificationModel = new \App\Models\Verification();

    }

    public function index()
    {
        return view('complain');
    }

    public function send_message(Request $request)
    {
        $data = request()->all();
        $complains = "00000";
        $assign = null;
        $others_message = "";
        if (!isset($data['Missing_items']) && !isset($data['Wrong_items']) && !isset($data['No_response']) && !isset($data['Late_Delivery']) && !isset($data['Others'])&& !isset($data['cancel_order']) ) {
            throw ValidationException::withMessages(['sheet_counter' => 'You must choose one of the complains']);
        }
        if (!isset($data['country'])) {
            throw ValidationException::withMessages(['sheet_counter' => 'You must enter your country']);
        }
        if (isset($data['Missing_items'])) {
            $complains[0] = "1";
            $assign = "0";
        }
        if (isset($data['Wrong_items'])) {
            $complains[1] = "1";
            $assign = "0";
        }
        if (isset($data['No_response'])) {
            $complains[2] = "1";
            if ($assign != "" || $assign != null) {
                $assign = $assign . "|1";
            } else {
                $assign = $assign . "1";
            }
        }
        if (isset($data['Late_Delivery'])) {
            $complains[3] = "1";
            if ($assign != "" || $assign != null) {
                $assign = $assign . "|2";
            } else {
                $assign = $assign . "2";
            }
        }
        if (isset($data['Others'])) {
            $complains[4] = "1";
            if ($assign != "" || $assign != null) {
                $assign = $assign . "|3";
            } else {
                $assign = $assign . "3";
            }

            if (!isset($data["Others_message"])) {
                throw ValidationException::withMessages(['sheet_counter' => 'Please write down the other complaints']);
            }
        }
        if (isset($data['cancel_order'])) {
            $complains[5] = "1";
            if ($assign != "" || $assign != null) {
                $assign = $assign . "|1";
            } else {
                $assign = $assign . "1";
            }
        }

        if (isset($data["Others_message"])) {
            $others_message = $data["Others_message"];
        }
        $all_data = [
            'name' => $data['name'],
            'order_number' => $data['order_number'],
            'email' => $data['email'],
            'whatsapp' => $data['whatsapp'],
            'complains' => $complains,
            'other_message' => $others_message,
            'country' => $data['country'],
            'assign' => $assign,
        ];
       

        $complain_info = $this->complainsModel->save_complain($all_data);

        $data1 = [
            'complain_url'=>url('') . '/' . "complaint_ticket/".$complain_info[0]."?token=" . $complain_info[1],
            'complain_number' => $complain_info[0],
        ];

        Mail::to($data['email'])->send(new ComplainMail($data1), function ($message) {
            $message->subject("Complaint Ticket");
        });

        return view('emails_response')->with(['status' =>'success' ,'title'=>"We received your Inquiry",'sub_title'=>"Please check your email to follow up 😊"]);
        /* $order_number = $data['order_number'];
        $obj = json_encode($order_number);

        echo "<script>console.log(JSON.parse('" . $obj . "'))</script>";

        dd(request()->all()); */
    }

    public function complains_page()
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

        /* search nour  */
        
        try {
            $complaint_id = $_GET['complaint_id'];
        } catch (\Throwable $th) {

            $complaint_id = "";
        }

        if (!empty($complaint_id)) {

            $complains = $this->complainsModel->get_complaint_database_search($page, $rule , $complaint_id);

        } else {
           
            $complains = $this->complainsModel->getComplains($page, $rule);
        }
        

        return view('complains_page')->with([
            'complains' => $complains[1],
            'number_of_complains' => $complains[0],
            'cancel_order' => $complains[2],
            'reschedule' => $complains[3],
            'no_response' => $complains[4],
            'customer_others' => $complains[5],
            'ask_about_product' => $complains[6],
            'Others' => $complains[7],
            'all_solved' => $complains[8],
            'all_not_solved' => $complains[9], 'page' => 'complaints',

        ]);
    }

    public function complains_page_archived()
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

     /* search nour  */
        try {
            $complaint_id = $_GET['complaint_id'];
        } catch (\Throwable $th) {

            $complaint_id = "";
        }

        if (!empty($complaint_id)) {

            $complains = $this->complainsModel->get_archived_complaint_database_search($page, $rule , $complaint_id);

        } else {
           
            $complains = $this->complainsModel->getComplains_archived($page, $rule);
            
        }

        return view('complains_page')->with([
            'complains' => $complains[1],
            'number_of_complains' => $complains[0],
            'korean' => $complains[2],
            'customer' => $complains[3],
            'logistic' => $complains[4],
            'others' => $complains[5],
            'korean_solved' => $complains[6],
            'customer_solved' => $complains[7],
            'logistic_solved' => $complains[8],
            'others_solved' => $complains[9], 'page' => 'complaints',

        ]);
    }

    public function complains_special_page()
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
            $complaint_id = $_GET['complaint_id'];
        } catch (\Throwable $th) {

            $complaint_id = "";
        }

        if (!empty($complaint_id)) {

            $complains = $this->complainsModel->get_special_complaint_database_search($page, $rule , $complaint_id);

        } else {
           
            $complains = $this->complainsModel->getSpecialComplains($page, $rule);
        }
        
        
        return view('complains_page')->with([
            'complains' => $complains[1],
            'number_of_complains' => $complains[0],
            'cancel_order' => $complains[2],
            'reschedule' => $complains[3],
            'no_response' => $complains[4],
            'customer_others' => $complains[5],
            'ask_about_product' => $complains[6],
            'Others' => $complains[7],
            'all_solved' => $complains[8],
            'all_not_solved' => $complains[9],'complaints_files'=>$complains[10], 'page' => 'complaints',

        ]);
    }

    public function complains_by_CS(){


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

        if (!empty($complaint_id)) {

            $complains = $this->complainsModel->get_CS_complaint_database_search($page, $rule , $complaint_id);

        } else {
            $complains = $this->complainsModel->get_CS_Complains($page, $rule);
        }

        return view('complains_page')->with([
            'complains' => $complains[1],
            'number_of_complains' => $complains[0],
            'cancel_order' => $complains[2],
            'reschedule' => $complains[3],
            'no_response' => $complains[4],
            'customer_others' => $complains[5],
            'ask_about_product' => $complains[6],
            'Others' => $complains[7],
            'all_solved' => $complains[8],
            'all_not_solved' => $complains[9], 'page' => 'complaints',

        ]);
    }

    public function open_ticket_CS_side(Request $request){

        try {       
        $cust_email = $_POST['cust_email'];
        $cust_order_number = $_POST['cust_order_number'];
        $cs_message = $_POST['cs_message'];

        if (empty($cust_email) ) {
            return Redirect::back()->with('ERROR','customer_email');
        } else {
            $check_email = $this->complainsModel->check_customer_email_exists($cust_email);
        }

        if ($cs_message == '' ||  $cs_message == NULL  ) {
            return Redirect::back()->with('ERROR','complaint_msg');
        }

        if (count($check_email) > 0 ) {

            if($cust_order_number != '' || $cust_order_number != NULL ){

                $check_order = $this->complainsModel->check_order_with_email_exists($cust_email , $cust_order_number);

                if (count($check_order) > 0) {

                    
                    $complain_info = $this->complainsModel->save_complain_cs_side($check_order[0] , $cs_message,$cust_order_number);

                    
                        $data1 = [
                            'complain_url'=>url('') . '/' . "complaint_ticket/".$complain_info[0]."?token=" . $complain_info[1],
                            'complain_number' => $complain_info[0], 'customer_name'=>$check_email[0]->name
                        ];

                        Mail::to($check_email[0]->email)->send(new CsComplainMail($data1), function ($message) {
                            $message->subject("Complaint Ticket");
                        }); 
                   
                    return Redirect::back()->with('MESSAGE','success');
                   
                } else {
                    return Redirect::back()->with('ERROR','not_match');
                }

            }else{
                
                $complain_info = $this->complainsModel->save_complain_cs_side($check_email[0] , $cs_message,"");

                    $data1 = [
                        'complain_url'=>url('') . '/' . "complaint_ticket/".$complain_info[0]."?token=" . $complain_info[1],
                        'complain_number' => $complain_info[0], 'customer_name'=>$check_email[0]->name
                    ];

                    Mail::to($check_email[0]->email)->send(new CsComplainMail($data1), function ($message) {
                        $message->subject("Complaint Ticket");
                    }); 

                return Redirect::back()->with('MESSAGE','success');
            }

        } else {
            return Redirect::back()->with('ERROR','email_not_found');
        }

    } catch (\Throwable $th) {
        return $th;
    }

    }

    public function search_complaints()
    {
        
        $content=$_POST['content'];
        $filter=$_POST['filter'];

         return $this->complainsModel->search_complaints($content,$filter);
    }
    
    public function solved()
    {
        $order_id = $_POST['order'];

        $this->complainsModel->solved($order_id);

        $this->historyModel->create(Auth::user()->name, 'Complaints', 'Complaint solved for complaint id #' . $order_id);

    }

    public function reply_complaint()
    {

        $reply = $_POST['reply'];
        $id = $_POST['id'];
        $solved = $_POST['solved'];
        $replied_by = Auth::user()->name;

        $complain_info=$this->complainsModel->insert_complaint_reply($id, $reply, $solved, $replied_by);

        $data1 = [
            'complain_url'=>url('') . '/' . "complaint_ticket/".$complain_info[0]->id."?token=" . $complain_info[0]->token,
            'complain_number' => $complain_info[0]->id,
        ];
        
        Mail::to($complain_info[0]->email)->send(new ComplainReply($data1), function ($message) {
            $message->subject("Inquiry Answered");
        });
    }

    public function get_complaint_replies($complaint_number)
    {
        $complaints_files=[];

        if (isset($_GET['token'])) {
            $complaint = $this->complainsModel->validate_complaint_url($complaint_number, $_GET['token']);
            if ($complaint[0]) {
                $complaints = $this->complainsModel->get_complaint_replies($complaint_number,$complaint[1]);

                if ($complaints[0]->special_case == 1) {
                    $complaints_files=
                    DB::select('SELECT * FROM kshopina.complaint_files
                    right JOIN kshopina.complains
                    ON complains.id = complaint_files.complaint_id where complains.special_case = 1 and solved = 0 And active = 0 and complains.id=?',[$complaint_number] );

                }
                

            } else {
                http_response_code(404);
            }
        } else {
            http_response_code(404);
        }
        
        return view('complaint_replies')->with(['complaints' => $complaints,'complaints_files'=> $complaints_files]);

    }

    public function customer_complaint_reply(Request $request)
    {
        $data = request()->all();
        date_default_timezone_set('Africa/Cairo');
        $now = date('Y-m-d H:i:s', time());
        $data['replied_at'] = $now;
        $result = $this->complainsModel->insert_customer_complaint_reply($data);

        if (!$result) {
            throw ValidationException::withMessages(['Reply' => 'Complaint had been solved, You can not reply!']);
        } else {
            return view('emails_response')->with(['status' =>'success' ,'title'=>"We received your Reply",'sub_title'=>"Keep in touch with us 😊"]);
        }

    }

    public function send_rating(Request $request)
    {
        $data = request()->all();
        $already_rated = $this->complainsModel->send_rating($data);

        return view('rating')->with(['rate' => $data['rate'], 'already_rated' => $already_rated]);
    }

    public function get_replies()
    {
        $id = $_POST['id'];

        $seen = $_POST['seen'];
        
        if ( $seen != '') {
            $this->complainsModel->update_to_seen($id,$seen);
        }
       
        return  $this->complainsModel->get_replies($id);

    }	

    public function kmex_bot()
    {
        /* return view('kmex_bot'); */
        return view('new_chatbot');
    }
    public function validate_order_to_resend_fvm($order_data,$mode)
    {
        if ($mode=='verification') {

            foreach ($order_data as $order) {
                if ($order->verified ==3) {
                    return ['status'=>'fail','message' => 'Order had been canceled, do an order again'];
                } elseif($order->verified ==6) {
                    if ($order->status==0 && $order->on_process==0) {
                        return ['status'=>'success','message' =>'send'];
                    } else {
                        return ['status'=>'fail','message' => 'Too late!, Order already on process'];
                    }
                    
                }else {
                    return ['status'=>'success','message' => 'send'];
                }
                
            }
        } else {
            foreach ($order_data as $order) {
                if ($order->verified ==3) {
                    return ['status'=>'fail','message' => 'Order had been canceled, No tracking!'];
                } elseif($order->verified ==6) {
                    if ($order->kshopina_awb != null && $order->kshopina_awb != '') {
                        return ['status'=>'success','data' =>['ksp_number'=>$order->kshopina_awb,'email'=>$order->email]];
                    } else {

                        $tracking_number = $this->verificationModel->generate_kwb(0, $order);
                        $query['kshopina_awb'] = $tracking_number;
                    
                        $query['tracking_url'] = 'tracking/' . $tracking_number;
                    
                        $result2[$order->order_number]=$tracking_number;
                        DB::table('orders')->where('order_number', $order->order_number)->update($query);

                        return ['status'=>'success','data' =>['ksp_number'=>$tracking_number,'email'=>$order->email]];
                    }
                    
                }else {
                    return ['status'=>'fail','message' => 'Order not submited yet, keep in touch with your email'];
                }
                
            }
        }
        
       

    }
    public function send_first_mail_again()
    {
        $order_number = preg_replace('/\s+/', '', $_POST['order']) ;
        
        if (substr((string)$order_number,0,1) =='#') {
            $order_number =substr((string)$order_number,1);
        }
        if (ctype_digit(substr((string)$order_number,0,1)) ) {
            $store = 'origin';
        }elseif(substr((string)$order_number,0,1) =='e' || substr((string)$order_number,0,1) =='E'){
            $store = 'plus_egypt';
        }elseif(substr((string)$order_number,0,1) =='s' || substr((string)$order_number,0,1) =='S'){
            $store = 'plus_ksa';
        }elseif(substr((string)$order_number,0,1) =='k' || substr((string)$order_number,0,1) =='K'){
            $store = 'plus_kuwait';
        }elseif(substr((string)$order_number,0,1) =='u' || substr((string)$order_number,0,1) =='U'){
            $store = 'plus_uae';
        }else{
            return 'Invalid order reference format!';
        }

        try {
            $check=$this->verificationModel->isExist($store,$order_number);

            
        if ($check[0]) {
            $valid =$this->validate_order_to_resend_fvm($check[1],'verification');

            if ($valid['status']=='success') {
             /*    $whatsModel = new \App\Models\WhatsApp();

                $whatsModel->whatsapp_send_fvm_message($store,$order_number,$check[1][0]->token); */

                /* $this->verificationModel->first_verification_mail($store,$order_number,$check[1][0]->token); */
                return 'Success';
            }else{
                return $valid['message'];
            }
            
        }else{
            return 'Not found!';

        }
        } catch (\Throwable $th) {
            return $th;
        }
        
    }
    public function request_to_cancel_order()
    {
        $order_number = preg_replace('/\s+/', '', $_POST['order']) ;

        if (substr((string)$order_number,0,1) =='#') {
            $order_number =substr((string)$order_number,1);
        }
        if (ctype_digit(substr((string)$order_number,0,1)) ) {
            $store = 'origin';
        }elseif(substr((string)$order_number,0,1) =='e' || substr((string)$order_number,0,1) =='E'){
            $store = 'plus_egypt';
        }elseif(substr((string)$order_number,0,1) =='s' || substr((string)$order_number,0,1) =='S'){
            $store = 'plus_ksa';
        }elseif(substr((string)$order_number,0,1) =='k' || substr((string)$order_number,0,1) =='K'){
            $store = 'plus_kuwait';
        }elseif(substr((string)$order_number,0,1) =='u' || substr((string)$order_number,0,1) =='U'){
            $store = 'plus_uae';
        }
        else{
            return 'Invalid order reference format!';
        }
        $check=$this->verificationModel->isExist($store,$order_number);

        if ($check[0]) {
            $complain_info = $this->complainsModel->create_new_complaint('request_to_cancel',$order_number);
        }
        else{
            return 'Order number not found!';

        }
        $data1 = [
            'complain_url'=>url('') . '/' . "complaint_ticket/".$complain_info[0]."?token=" . $complain_info[1],
            'complain_number' => $complain_info[0],
        ];

        Mail::to($complain_info[2])->send(new ComplainMail($data1), function ($message) {
            $message->subject("Complaint Ticket");
        });

        return 'success';
    }
    public function reschedule_order()
    {
        $order_number = preg_replace('/\s+/', '', $_POST['order']) ;

        $reschedule_date = $_POST['reschedule_date'];

        if (substr((string)$order_number,0,1) =='#') {
            $order_number =substr((string)$order_number,1);
        }
        if (ctype_digit(substr((string)$order_number,0,1)) ) {
            $store = 'origin';
        }elseif(substr((string)$order_number,0,1) =='e' || substr((string)$order_number,0,1) =='E'){
            $store = 'plus_egypt';
        }elseif(substr((string)$order_number,0,1) =='s' || substr((string)$order_number,0,1) =='S'){
            $store = 'plus_ksa';
        }elseif(substr((string)$order_number,0,1) =='k' || substr((string)$order_number,0,1) =='K'){
            $store = 'plus_kuwait';
        }elseif(substr((string)$order_number,0,1) =='u' || substr((string)$order_number,0,1) =='U'){
            $store = 'plus_uae';
        }
        else{
            return 'Invalid order reference format!';
        }
        $check=$this->verificationModel->isExist($store,$order_number);

        if ($check[0]) {
            $complain_info = $this->complainsModel->create_new_complaint('reschedule',[$order_number,$reschedule_date]);
        }
        else{
            return 'Order number not found!';
        }
        $data1 = [
            'complain_url'=>url('') . '/' . "complaint_ticket/".$complain_info[0]."?token=" . $complain_info[1],
            'complain_number' => $complain_info[0],
        ];

        Mail::to($complain_info[2])->send(new ComplainMail($data1), function ($message) {
            $message->subject("Complaint Ticket");
        });
        return 'success';

    }
    public function lmd_or_late()
    {
        $order_number = preg_replace('/\s+/', '', $_POST['order']) ;

        $message = $_POST['message'];

        if (substr((string)$order_number,0,1) =='#') {
            $order_number =substr((string)$order_number,1);
        }
        if (ctype_digit(substr((string)$order_number,0,1)) ) {
            $store = 'origin';
        }elseif(substr((string)$order_number,0,1) =='e' || substr((string)$order_number,0,1) =='E'){
            $store = 'plus_egypt';
        }elseif(substr((string)$order_number,0,1) =='s' || substr((string)$order_number,0,1) =='S'){
            $store = 'plus_ksa';
        }elseif(substr((string)$order_number,0,1) =='k' || substr((string)$order_number,0,1) =='K'){
            $store = 'plus_kuwait';
        }elseif(substr((string)$order_number,0,1) =='u' || substr((string)$order_number,0,1) =='U'){
            $store = 'plus_uae';
        }
        else{
            return 'Invalid order reference format!';
        }
        $check=$this->verificationModel->isExist($store,$order_number);

        if ($check[0]) {
            $complain_info = $this->complainsModel->create_new_complaint('lmd_or_late',[$order_number,$message]);
        }
        else{
            return 'Order number not found!';
        }

        $data1 = [
            'complain_url'=>url('') . '/' . "complaint_ticket/".$complain_info[0]."?token=" . $complain_info[1],
            'complain_number' => $complain_info[0],
        ];

        Mail::to($complain_info[2])->send(new ComplainMail($data1), function ($message) {
            $message->subject("Complaint Ticket");
        });
        return 'success';

    }
    public function customer_others()
    {
        $order_number = preg_replace('/\s+/', '', $_POST['order']) ;

        $message = $_POST['message'];

        if (substr((string)$order_number,0,1) =='#') {
            $order_number =substr((string)$order_number,1);
        }
        if (ctype_digit(substr((string)$order_number,0,1)) ) {
            $store = 'origin';
        }elseif(substr((string)$order_number,0,1) =='e' || substr((string)$order_number,0,1) =='E'){
            $store = 'plus_egypt';
        }elseif(substr((string)$order_number,0,1) =='s' || substr((string)$order_number,0,1) =='S'){
            $store = 'plus_ksa';
        }elseif(substr((string)$order_number,0,1) =='k' || substr((string)$order_number,0,1) =='K'){
            $store = 'plus_kuwait';
        }elseif(substr((string)$order_number,0,1) =='u' || substr((string)$order_number,0,1) =='U'){
            $store = 'plus_uae';
        }
        else{
            return 'Invalid order reference format!';
        }
        $check=$this->verificationModel->isExist($store,$order_number);

        if ($check[0]) {
        $complain_info = $this->complainsModel->create_new_complaint('customer_others',[$order_number,$message]);
        }else{
            return 'Order number not found!';

        }
        $data1 = [
            'complain_url'=>url('') . '/' . "complaint_ticket/".$complain_info[0]."?token=" . $complain_info[1],
            'complain_number' => $complain_info[0],
        ];

        Mail::to($complain_info[2])->send(new ComplainMail($data1), function ($message) {
            $message->subject("Complaint Ticket");
        });
        return 'success';

    }
    
   /*  public function ask_about_product()
    {
        $data=request()->all();

        $complain_info = $this->complainsModel->create_new_complaint('ask_about_product',['user_name'=> $data['user_name'],'email'=>$data['email'],
        'phone_number'=>$data['phone_number'],'country'=>$data['country'],'message'=>$data['notes_ask_product']]);

        $data1 = [
            'complain_url'=>url('') . '/' . "complaint_ticket/".$complain_info[0]."?token=" . $complain_info[1],
            'complain_number' => $complain_info[0],
        ];

        Mail::to($complain_info[2])->send(new ComplainMail($data1), function ($message) {
            $message->subject("Complaint Ticket");
        });

        return back()->with('message', 'Please check your email to follow up');

    } */

    public function ask_about_product(){
        
        $user_name = $_POST['user_name'];
        $email = $_POST['email'];
        $phone_number = $_POST['phone_number'];
        $country = $_POST['country'];
        $message = $_POST['message'];


        $complain_info = $this->complainsModel->create_new_complaint('ask_about_product',['user_name'=> $user_name ,'email'=> $email,
        'phone_number'=>$phone_number ,'country'=> $country,'message'=>$message]); 

        $data1 = [
            'complain_url'=>url('') . '/' . "complaint_ticket/".$complain_info[0]."?token=" . $complain_info[1],
            'complain_number' => $complain_info[0],
        ];

        Mail::to($complain_info[2])->send(new ComplainMail($data1), function ($message) {
            $message->subject("Complaint Ticket");
        });

        return 'Success';
        
    }
   /*  public function guest_others()
    {
        $data=request()->all();

        $complain_info = $this->complainsModel->create_new_complaint('guest_others',['user_name'=> $data['user_name'],'email'=>$data['email'],
        'phone_number'=>$data['phone_number'],'country'=>$data['country'],'message'=>$data['notes']]);

        $data1 = [
            'complain_url'=>url('') . '/' . "complaint_ticket/".$complain_info[0]."?token=" . $complain_info[1],
            'complain_number' => $complain_info[0],
        ];

        Mail::to($complain_info[2])->send(new ComplainMail($data1), function ($message) {
            $message->subject("Complaint Ticket");
        });
        return back()->with('message', 'Please check your email to follow up');

    } */
    public function guest_others(){
        
        $user_name = $_POST['user_name'];
        $email = $_POST['email'];
        $phone_number = $_POST['phone_number'];
        $country = $_POST['country'];
        $message = $_POST['message'];

        $complain_info = $this->complainsModel->create_new_complaint('guest_others',['user_name'=> $user_name ,'email'=>$email,
        'phone_number'=>$phone_number,'country'=> $country,'message'=>$message]);

        $data1 = [
            'complain_url'=>url('') . '/' . "complaint_ticket/".$complain_info[0]."?token=" . $complain_info[1],
            'complain_number' => $complain_info[0],
        ];

        Mail::to($complain_info[2])->send(new ComplainMail($data1), function ($message) {
            $message->subject("Complaint Ticket");
        });

        return 'Success';
        
    }

    public function get_order_details()
    {
        $id=$_GET['order_number'];
        return $this->complainsModel->get_order_details($id);
        
    }
    
    public function send_details_mail()
    {
        $order_number = preg_replace('/\s+/', '', $_POST['order']) ;

        if (substr((string)$order_number,0,1) =='#') {
            $order_number =substr((string)$order_number,1);
        }
        if (ctype_digit(substr((string)$order_number,0,1)) ) {
            $store = 'origin';
        }elseif(substr((string)$order_number,0,1) =='e' || substr((string)$order_number,0,1) =='E'){
            $store = 'plus_egypt';
        }elseif(substr((string)$order_number,0,1) =='s' || substr((string)$order_number,0,1) =='S'){
            $store = 'plus_ksa';
        }elseif(substr((string)$order_number,0,1) =='k' || substr((string)$order_number,0,1) =='K'){
            $store = 'plus_kuwait';
        }elseif(substr((string)$order_number,0,1) =='u' || substr((string)$order_number,0,1) =='U'){
            $store = 'plus_uae';
        }
        else{
            return 'Invalid order reference format!';
        }

        $check=$this->verificationModel->isExist($store,$order_number);
        if ($check[0]) {
            $this->verificationModel->details_mail($store,$order_number,$check[1][0]->token);
            return 'Success';

        }else{
            return 'Not found!';

        }
    }

    public function send_tracking_mail()
    {
        $order_number = preg_replace('/\s+/', '', $_POST['order']) ;

        if (substr((string)$order_number,0,1) =='#') {
            $order_number =substr((string)$order_number,1);
        }
        if (ctype_digit(substr((string)$order_number,0,1)) ) {
            $store = 'origin';
        }elseif(substr((string)$order_number,0,1) =='e' || substr((string)$order_number,0,1) =='E'){
            $store = 'plus_egypt';
        }elseif(substr((string)$order_number,0,1) =='s' || substr((string)$order_number,0,1) =='S'){
            $store = 'plus_ksa';
        }elseif(substr((string)$order_number,0,1) =='k' || substr((string)$order_number,0,1) =='K'){
            $store = 'plus_kuwait';
        }elseif(substr((string)$order_number,0,1) =='u' || substr((string)$order_number,0,1) =='U'){
            $store = 'plus_uae';
        }else{
            return 'Invalid order reference format!';
        }

        $check=$this->verificationModel->isExist($store,$order_number);
        if ($check[0]) {
            $valid =$this->validate_order_to_resend_fvm($check[1],'tracking');
            if ($valid['status']=='success') {

                /* $data1 = [
                    'order_number' => $order_number,
                    'tracking_url' => url('') . '/' . "tracking/" . $valid['data']['ksp_number'],
                    ];
    
                Mail::to($valid['data']['email'])->send(new TrackingMail($data1), function ($message) {
                    $message->subject("Track Your Order");
                    }); */

                    // Tracking Message

                       /*  $whatsModel = new \App\Models\WhatsApp();

                        $whatsModel->whatsapp_send_tracking_message($check[1][0]->phone_number,$check[1][0]->order_number,$check[1][0]->kshopina_awb,$check[1][0]->country);
 */
                    //

                return 'Success';
            }else{
                return $valid['message'];
            }

        }else{
            return 'Not found!';

        }
    }
    
    public function get_dicounts()
    {
       
        return $this->complainsModel->get_dicounts();
       
    }

    public function get_active_dicounts()
    {
       
        return $this->complainsModel->get_active_dicounts();
       
    }
    
    public function update_discounts()
    {
     
        $ids=request()->all()['id'];
      
        $discount_code=request()->all()['discount_code'];
        $percent=request()->all()['percent'];

      
        if (isset(request()->all()['active'])) {
            $active=request()->all()['active'];
        } else {
            $active=[];
        }
        if (isset(request()->all()['deleted'])) {
            $deleted=request()->all()['deleted'];
        } else {
            $deleted=[];
        }
        

         $this->complainsModel->update_discounts($ids,$discount_code,$percent,$active,$deleted); 

        return back();
      
    }

    public function get_services_payments()
    {
        return $this->complainsModel->get_services_payments();
    }
    
    public function update_services_payments()
    {
        $ids=request()->all()['id'];
      
        $country=request()->all()['country'];

        if (isset(request()->all()['cod'])) {
            $cod=request()->all()['cod'];
        } else {
            $cod=[];
        }

        if (isset(request()->all()['pre_paid'])) {
            $pre_paid=request()->all()['pre_paid'];
        } else {
            $pre_paid=[];
        }

        if (isset(request()->all()['active'])) {
            $active=request()->all()['active'];
        } else {
            $active=[];
        }

        if (isset(request()->all()['deleted'])) {
            $deleted=request()->all()['deleted'];
        } else {
            $deleted=[];
        }
        
       
           $this->complainsModel->update_services_payments($ids,$country,$cod,$pre_paid,$active,$deleted);
        
           return back();
    }

    public function faqs()
    {
        return view('faqs');
    }
    public function get_faqs_question()
    {
        return $this->complainsModel->get_faqs_question();
    }

    public function update_faqs_question()
    {

        $ids=request()->all()['id'];
      
        $questions=request()->all()['questions'];
        $answers=request()->all()['answers'];

      
        if (isset(request()->all()['active'])) {
            $active=request()->all()['active'];
        } else {
            $active=[];
        }

        if (isset(request()->all()['deleted'])) {
            $deleted=request()->all()['deleted'];
        } else {
            $deleted=[];
        }


        $this->complainsModel->update_faqs_question($ids,$questions,$answers,$active,$deleted); 
    
        return back();
    }

    public function send_something_wrong_mail()
    {
        $order_number=$_POST["order"];

        $type=$_POST["type"];

         try {
            return $this->complainsModel->something_wrong_mail($order_number,$type);
        } catch (\Throwable $th) {
            DB::insert('insert into errors (shipment_number,message,system_name) values (?,?,?)', [$order_number, $th, "REQUEST_TO_SEND_SOMETHING_WRONG_FORM 2"]);

            return [false,"Sorry service is unavalibale now! try again later"];

         }
    }

    public function something_wrong_form($complain_id){

        if (isset($_GET['token'])) {

            $validate =$this->complainsModel->validate_complaint_token($complain_id,$_GET['token']);

            if ($validate[0]) {
                return view('specialOrdersForm');
            }
            else{
                http_response_code(404);
            }
        } else {
            http_response_code(404);
        }
    }
    public function submit_somthing_wrong_form()
    {
        $data = request()->all();
        $size=0;

        $content=$data['content'];
        $complaint_id=$data['complaint_id'];

        try {
            $files=$data['files'];
            $types=$data['type'];

        } catch (\Throwable $th) {
            $files=[];
            $types=[];
            return Redirect::back()->with('message','FILES_NOT_FOUND');

        }

        try {
        
            if (isset($_GET['token'])) {
                $validate1 =$this->complainsModel->validate_complaint_token($complaint_id,$_GET['token']);
                $validate2= $this->complainsModel->validate_complaint_exist($complaint_id,$_GET['token']);

                if ($validate1[0]==true ) {

                    if ($validate2[0] ==false) {

                        foreach ($files as $key => $file) {
                            $size +=$file->getSize();
                        }
                        if ($size > 208500000) {
                            return Redirect::back()->with('message','FILE_SIZE');
                        }
                        ignore_user_abort();

                        DB::table('complains')->where('id',$complaint_id)->update(['message'=>$content,'active'=>0]);
    
                        $this->complainsModel->add_complaint_files($complaint_id,$files,$types);

                        $data1 = [
                            'complain_url'=>url('') . '/' . "complaint_ticket/".$complaint_id."?token=" . $_GET['token'],
                            'complain_number' => $complaint_id,
                        ];
                
                        Mail::to($validate1[1][0]->email)->send(new ComplainMail($data1), function ($message) {
                            $message->subject("Complaint Ticket");
                        });

                        return Redirect::back()->with('message','SUCCESS');
                    } else {
                        return Redirect::back()->with('message','SUBMITED_BEFORE');
                    }
                    
                }
                else{
                    return Redirect::back()->with('message','DOES_NOT_MATCH');
                }
            }
            else{
                return Redirect::back()->with('message','TOKEN');
            }
        
        } catch (\Throwable $th) {
            DB::insert('insert into errors (shipment_number,message,system_name) values (?,?,?)', [$complaint_id, $th, "COMPLAINTS"]);
        }
        

    }


    public function all_faqs(){
        return $this->complainsModel->get_active_faqs_question();
    }
    
    
}
