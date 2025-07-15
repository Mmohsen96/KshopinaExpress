<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\ValidationException;

class HomeController extends Controller
{
    protected $ordersModel;
    protected $qrModel;
    protected $homeModel;
    protected $historyModel;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->ordersModel = new \App\Models\Orders();
        $this->qrModel = new \App\Models\QRcode();
        $this->homeModel = new \App\Models\Home();
        $this->historyModel = new \App\Models\History();

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        /* return app('App\Http\Controllers\StockController')->index(); */

        if (Auth::user()->id == 10) {
            return redirect()->route('products', array('page' => 1, 'filter' => 'All'));
        } else if (Auth::check() && Auth::user()->complete == 0 && Auth::user()->type == 1) {
            return view('shipper_info')->with('user', Auth::user());
        } elseif (Auth::check() && Auth::user()->complete == 1 && Auth::user()->type == 1) {
            return redirect('profile')->with('user', Auth::user());
        } else {
            try {
                /* $refused_counter = $this->ordersModel->refused_page(1);
                $requests_counter = $this->qrModel->count_requests(); */
                
                return redirect()->route('confirmed', array('store' => 'origin', 'filter' => 'All' , 'page' => 1));
                return view('home');

                /* return view('home')->with(['refused' => $refused_counter[0], 'requests' => $requests_counter[4]]); */
            } catch (\Throwable $th) {
                /* $count= $this->ordersModel->count_orders(); */
                return redirect()->route('home', array('store' => 'origin'));

                /* return view('choose_store'); */
            }
        }

    }

    public function search_home_page()
    {

        $value = $_POST['content'];
        $type = $_POST['user_input_type'];

        
        if ($type=='tracking_no') {

            return $this->homeModel->order_like($value,$type);

        } elseif($type=='order_no') {

            return $this->homeModel->order_like($value,$type);

        }elseif($type=='group_order') {

            return $this->homeModel->group_order_like($value,$type);

        }

    }

    public function main()
    {
        /*  return view('main'); */
        return view('home_page');
    }


    public function search()
    {
        $data = request()->all();
        $kshopina_tracking = $data['tracking_number'];
        $order = $this->ordersModel->getorderbytracking($kshopina_tracking);
        if (isset($order[0])) {
            return Redirect::to('/tracking/' . $kshopina_tracking);
        } else {
            throw ValidationException::withMessages(['invalid' => 'Invalid Tracking number']);
        }
    } 

    public function new_currency()
    {

        $data = $_POST['data'];
        $this->homeModel->update_currency_manually($data);
        $msg = 'Change the currency for (';

        foreach ($data as $key => $value) {

            $msg = $msg . $key . "=" . $value . ',';
        }
        $msg = $msg . ')';

        $this->historyModel->create(Auth::user()->name, 'Currency', $msg);

    }

    public function get_country_currency()
    {
        return $this->homeModel->get_country_currency();
    }

    public function dashboard_info()
    {
      
        $store_count = $this->homeModel->dashboard_info();

        date_default_timezone_set('Africa/Cairo');

        $current_year = date('Y', time());

        /* line graph for status of orders each month */

            $Delivered_data=[];
            $Refused_data=[];
            $Verified_data=[];
            $Cancelled_data=[];

            foreach ($store_count[29] as $status => $values) {
                
                    foreach ($values as $year => $data) {
                       
                        foreach ($data as $month => $value) {
                            if ($status == 'Verified') {

                                $Verified_data[ (string)$year .'_'  . (string)$month ] =  $value;
    
                            } else if($status == 'Cancelled'){
    
                                $Cancelled_data[ (string)$year .'_'  . (string)$month ] =  $value;
    
                            }else if($status == 'Delivered'){
    
                                $Delivered_data[ (string)$year .'_'  . (string)$month ] =  $value;
    
                            }else if($status == 'Refused'){
    
                                $Refused_data[ (string)$year .'_'  . (string)$month ] =  $value;
    
                            }
                        }

                    }

            }

        /*end*/

        // PROFIT PER MONTH CHART
            $total_amount_all=[];
            $total_amount_origin=[];
            $total_amount_egypt=[];
            $total_amount_kuwait=[];
            $total_amount_ksa=[];
            $total_amount_uae=[];

            /* origin */
            foreach ($store_count[30] as $year_ => $year) {
               
                foreach ($year as $month => $total_revenue) {

                    $total_amount_origin[(string)$year_.'_'.(string)$month ]= round($total_revenue,1);
                    $total_amount_all[(string)$year_.'_'.(string)$month ]= round($total_amount_origin[(string)$year_.'_'.(string)$month ] ,1);

                }
            }
            /* Egypt */   
            foreach ($store_count[31] as $year_ => $year) {

                foreach ($year as $month => $total_revenue) {

                    $total_amount_egypt[(string)$year_.'_'.(string)$month ]= round($total_revenue,1);
                    $total_amount_all[(string)$year_.'_'.(string)$month ] += round($total_amount_egypt[(string)$year_.'_'.(string)$month ] ,1);

                }

            }
            /* Kuwait */
            foreach ($store_count[32] as $year_ => $year) {

                foreach ($year as $month => $total_revenue) {
                    $total_amount_kuwait[(string)$year_.'_'.(string)$month ]= round($total_revenue,1);
                    $total_amount_all[(string)$year_.'_'.(string)$month ] += round($total_amount_kuwait[(string)$year_.'_'.(string)$month ] ,1);

                    
                }

            }
            /* KSA */
            foreach ($store_count[33] as $year_ => $year) {

                foreach ($year as $month => $total_revenue) {

                    $total_amount_ksa[(string)$year_.'_'.(string)$month ]= round($total_revenue,1);
                    $total_amount_all[(string)$year_.'_'.(string)$month ] += round($total_amount_ksa[(string)$year_.'_'.(string)$month ] ,1);

                }

            }
            /* UAE */
            foreach ($store_count[34] as $year_ => $year) {

                foreach ($year as $month => $total_revenue) {
                    $total_amount_uae[(string)$year_.'_'.(string)$month ]= round($total_revenue,1);
                    $total_amount_all[(string)$year_.'_'.(string)$month ] += round($total_amount_uae[(string)$year_.'_'.(string)$month ] ,1);
                }
            }
        //

        $orders_per_day = $store_count[11]['origin'] + $store_count[11]['plus_egypt'] + $store_count[11]['plus_ksa'] + $store_count[11]['plus_kuwait'] + 
        $store_count[11]['plus_uae'] ;

        // percentatge of visitors in countries   && line graph for top countries visits in each month  

            foreach ($store_count[46] as $country => $data ) {

                foreach ($data as $date => $num) {
                    if (strpos($date, $current_year) !== false) {
                        unset($data[$date]);
                    }
                    $data[$date]=$num;
                }
                $store_count[46][$country] = $data;
            }

        //END

        //line graph for number of visitors at stores  in tracking each month 

            for ($i=38; $i <= 42 ; $i++) { 
                foreach ($store_count[$i] as $date => $num) {
                    if (strpos($date, $current_year) !== false) {
                        unset($store_count[$i][$date]);
                    }
                    $store_count[$i][$date] = $num;
                }
            }

        //END

        // weekly sales chart

            // Convert the object to an associative array
            $array = (array) $store_count[48];

            // Sort the array by values in descending order
            arsort($array);

            // Convert the array back to an object
            $days_percent_arranged = (object) $array;
       
        //END

        return view('my_board')->with(
        [
            'origin_year_data' => $store_count[10]["origin"],
            'plus_egypt_year_data' => $store_count[10]["plus_egypt"],
            'plus_ksa_year_data' => $store_count[10]["plus_ksa"],
            'plus_kuwait_year_data' => $store_count[10]["plus_kuwait"],
            'plus_uae_year_data' => $store_count[10]["plus_uae"],
            'orders_per_day' => $orders_per_day,
            'orders_per_day_O' => $store_count[11]['origin'],
            'orders_per_day_EG' => $store_count[11]['plus_egypt'],
            'orders_per_day_KSA' => $store_count[11]['plus_ksa'],
            'orders_per_day_KW' => $store_count[11]['plus_kuwait'],
            'orders_per_day_UAE' => $store_count[11]['plus_uae'],
            'origin_countries_daily_orders' => $store_count[5],
            'percent_visa' => $store_count[37],
            'cancel_order' =>  $store_count[18][0]->value,
            'Rescheduling' => $store_count[19][0]->value,
            'lmd_or_late' =>  $store_count[20][0]->value,
            'customer_others' =>  $store_count[21][0]->value,
            'product_inquries' =>  $store_count[13][0]->value,
            'guest_others' =>  $store_count[14][0]->value,
            'special_cases' => $store_count[17][0]->value ,
            'all_number_of_resons' =>  $store_count[15][0]->value,
            'number_of_complains' => $store_count[16][0]->value,
            'solved_complains' => $store_count[36][0]->value,
            'ksp_num_origin' => $store_count[38],
            'ksp_num_egypt' => $store_count[39],
            'ksp_num_ksa' => $store_count[40],
            'ksp_num_kuwait' =>$store_count[41] ,
            'ksp_num_uae' =>$store_count[42] ,
            'countries_count' => $store_count[45] ,
            'visitors_count' => $store_count[44],
            'refused_orders' => $store_count[23][0]->value ,
            'delivered_orders' => $store_count[22][0]->value ,
            'daily_profit'=>$store_count[35],
            'complaint_rate_1'=> $store_count[24][0]->numberOfComplaint ,
            'complaint_rate_2'=>$store_count[25][0]->numberOfComplaint ,
            'complaint_rate_3'=>$store_count[26][0]->numberOfComplaint ,
            'complaint_rate_4'=> $store_count[27][0]->numberOfComplaint,
            'complaint_rate_5'=> $store_count[28][0]->numberOfComplaint,
            'Verified_orders_year_data' => $Verified_data,
            'Cancelled_orders_year_data' => $Cancelled_data,
            'Delivered_orders_year_data' => $Delivered_data,
            'Refused_orders_year_data' => $Refused_data,
            'total_profit_origin'=>$total_amount_origin,
            'total_profit_egypt'=>$total_amount_egypt,
            'total_profit_kuwait'=>$total_amount_kuwait,
            'total_profit_ksa'=>$total_amount_ksa,
            'total_amount_uae' =>$total_amount_uae,
            'total_profit_all'=>$total_amount_all,
            'countries_visits_monthly' =>  $store_count[46],
            'years_revenue' => $store_count[43],
            'week_data' => $store_count[47],
            'week_data_percentage' => $days_percent_arranged , 
            'all_order_num' => $store_count[49]
        ]);

    }
    public function get_data_of_week(){
      
        $week_data = request()->all();

        return   $this->homeModel->get_week_data($week_data['weekInput']);

    }

    


    public function dashboard()
    {
        /* $stickyNotes=$this->homeModel->getStickyNotes(); */
        date_default_timezone_set('Africa/Cairo');
        $now = date('Y-m', time());

        try {
            $date = $_GET["date"];
        } catch (\Throwable $th) {
            $date = $now; 
        }

        $firstPart = strtok( $date, '-' );
        $allTheRest = strtok( '' ); 

        $all_notes=$this->homeModel->getAllNotes($firstPart , $allTheRest);
           
        $announcements=[];

        foreach ($all_notes as $index => $note) {
            if (isset($announcements[$note->id])) {
                array_push($announcements[$note->id]->mentions,$note->user_name);
            } else {
                $note->mentions=[$note->user_name];
                $announcements[$note->id]=$note;
            }
        }

        return view('dashboard')->with([/* 'stickyNotes'=>$stickyNotes, */'announcements'=>$announcements ]) ;
    }


    public function submit_sticky_note()
    {
        
        $id = $_POST['id'];
        $note = $_POST['note'];

        try {
            return $this->homeModel->submit_sticky_note($id , $note);
        } catch (\Throwable $th) {
            return $th;
        }
    }

    public function create_announcment(Request $request)
    {
        try {
            $data=request()->all();

            $priority=$data['priority'];
            $type_of_submission=$data['type_of_submission'];
            $edit_announcement_id=$data['edit_announcement_id'];
            
            $size=0;

            try {
                $mentions=$data['mentions'];
                $mentions=explode(",", $mentions);
            } catch (\Throwable $th) {
                $mentions=[];
            }

            try {
                $files=$data['files'];
                $side_notes=$data['side_note'];
                $types=$data['type'];

            } catch (\Throwable $th) {
                $files=[];
                $side_notes=[];
                $types=[];
            }
            
            foreach ($files as $key => $file) {
                $size +=$file->getSize();
            }

            if ($size > 208500000) {
                return Redirect::back()->with('message','FILE_SIZE');
            }
            

            if ( $type_of_submission == 0 ) {

                $content=$data['content'];

                $note_id=$this->homeModel->add_note($content,$priority);

                $this->homeModel->add_mentions($note_id,$mentions);
    
                $this->homeModel->add_files($note_id,$files,$side_notes,$types);
    
                return Redirect::back()->with('message','COMPLETED');

            } else {

                $announcemnt_data = $this->homeModel->get_announcment_data( $edit_announcement_id );
                
                $content = $announcemnt_data[0]->note . "\r\n";
                $content .= $data['content'];

                $this->homeModel->update_note($edit_announcement_id,$content,$priority);

                $this->homeModel->add_mentions($edit_announcement_id,$mentions);

                $this->homeModel->add_files($edit_announcement_id,$files,$side_notes,$types);  

                return Redirect::back()->with('message','COMPLETED_EDIT');
            }
            
        } catch (\Throwable $th) {
            return $th;
        }
        
    }

    public function get_note_attachments(Request $request)
    {
        
        $id = $_POST['id'];
        $note_attachments= $this->homeModel->get_attachments($id);

        return $note_attachments;
    }

    public function get_announcement_replies(){
        $id = $_POST['id'];
       
        $replies=$this->homeModel->getAllReplies($id);

        return  $replies;
    }
   
    public function get_announcment_data(Request $request){

        $announcement_id = $_POST['id']; 
     
        return $this->homeModel->get_announcment_data( $announcement_id );
        
    }

    public function reply_to_announcement(Request $request){
       
            $data = request()->all();

            $reply_content = $data['reply'];
            $replier_name = $data['replier_name'];
            $announcement_id = $data['announcement_id_to_replies'];

            $this->homeModel->add_reply_to_announcement($reply_content,$replier_name,$announcement_id);

            return Redirect::back()->with('message','COMPLETED_REPLY');

    }
    
    public function pnp_customer(){

        return view('pnp_cust_shippment_list');
        
    }


    public function get_employee_attachments(Request $request){

        $id=$_POST['id'];
        $files = $this->homeModel->get_employee_attachments($id);
        return $files;
    }

    
    
}
