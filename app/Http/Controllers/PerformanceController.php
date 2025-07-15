<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Expr\Cast\Double;

class PerformanceController extends Controller
{
    protected $historyModel;
    protected $performanceModel;
    /* protected $domesticModel; */

    public function __construct(Request $request)
    {
        $this->historyModel = new \App\Models\History();
        $this->performanceModel = new \App\Models\Performance();
        /* $this->domesticModel = new \App\Models\Domestic(); */

    }

    public function performancePage()
    {
        try {
            date_default_timezone_set('Africa/Cairo');
            $date = date('Y-m-d', time());
            $verification_employees=[];
            $complaints_employees=[];
            $tst_employees=[];

            /* Get employees ( Team => 2 ) AND JOHN */
                $employees = DB::select('SELECT id,name from users where team = ? OR id = 3', [2]);
                foreach ($employees as $key => $employee) {
                    $verification_employees[$employee->name]=['id'=> $employee->id,'confirmed'=>0,'svm'=>0,'canceled'=>0,'category'=>0 ,'total'=>0,'last_action'=>''];
                    $complaints_employees[$employee->name]=['id'=> $employee->id,'replies'=>0,'solved'=>0,'rate'=>0,'total'=>0,'last_action'=>'',
                    'rate_1'=>0,
                    'rate_2'=>0,
                    'rate_3'=>0,
                    'rate_4'=>0,
                    'rate_5'=>0,
                    'number_of_complaint_rated'=>0 ];
                    $tst_employees[$employee->name]=['id'=> $employee->id,'on_process'=>0,'fulfill'=>0,'dispatch'=>0,'status'=>0 ,'total'=>0,'last_action'=>''];


                }
            //
            
            /* verification points counting  */

                $verification_analytics= $this->performanceModel->getVerificationAnalytics('All',$date,$employees);

                /* counting points of each employee  in for loop */

                    $max_size =max(count($verification_analytics['confirmed_orders']),count($verification_analytics['canceled_orders']),
                    count($verification_analytics['svm_orders']),count($verification_analytics['category_orders']));

                    for ($i=0; $i < $max_size; $i++) { 

                        if (isset($verification_analytics['confirmed_orders'][$i]) ) {

                            $action_taken_array=explode('|',$verification_analytics['confirmed_orders'][$i]->action_taken_by);

                            foreach ($action_taken_array as $key => $value) {
                                if (isset($verification_employees[$value]) ) {
                                    $verification_employees[$value]['confirmed'] += 1;
                                    $verification_employees[$value]['total'] += 1;

                                    if (empty($verification_employees[$value]['last_action']) || strtotime($verification_employees[$value]['last_action']) < strtotime($verification_analytics['confirmed_orders'][$i]->action_taken_at) ) {
                                        $verification_employees[$value]['last_action'] =(string) $verification_analytics['confirmed_orders'][$i]->action_taken_at;
                                    }
                                }
                            }
                        } 
                        if(isset($verification_analytics['canceled_orders'][$i])) {

                            $action_taken_array=explode('|',$verification_analytics['canceled_orders'][$i]->action_taken_by);

                            foreach ($action_taken_array as $key => $value) {
                                if (isset($verification_employees[$value]) ) {
                                    $verification_employees[$value]['canceled'] += 1;
                                    $verification_employees[$value]['total'] += 1;

                                    if (empty($verification_employees[$value]['last_action']) || strtotime($verification_employees[$value]['last_action']) < strtotime($verification_analytics['canceled_orders'][$i]->action_taken_at) ) {
                                        $verification_employees[$value]['last_action'] =(string) $verification_analytics['canceled_orders'][$i]->action_taken_at;
                                    }

                                }
                            }

                        }
                        if(isset($verification_analytics['svm_orders'][$i])) {
                            $verification_employees[$verification_analytics['svm_orders'][$i]->send_svm_by]['svm']+=1;
                            $verification_employees[$verification_analytics['svm_orders'][$i]->send_svm_by]['total'] += 1;
                            

                            if (empty($verification_employees[$verification_analytics['svm_orders'][$i]->send_svm_by]['last_action']) || strtotime($verification_employees[$verification_analytics['svm_orders'][$i]->send_svm_by]['last_action']) < strtotime($verification_analytics['svm_orders'][$i]->send_svm_at) ) {
                                $verification_employees[$verification_analytics['svm_orders'][$i]->send_svm_by]['last_action'] =(string) $verification_analytics['svm_orders'][$i]->send_svm_at;
                            }

                        }
                        if(isset($verification_analytics['category_orders'][$i])) {
                            $verification_employees[$verification_analytics['category_orders'][$i]->categorised_by]['category']+=1;
                            $verification_employees[$verification_analytics['category_orders'][$i]->categorised_by]['total'] += 1;

                            if (empty($verification_employees[$verification_analytics['category_orders'][$i]->categorised_by]['last_action']) || strtotime($verification_employees[$verification_analytics['category_orders'][$i]->categorised_by]['last_action']) < strtotime($verification_analytics['category_orders'][$i]->categorised_at) ) {
                                $verification_employees[$verification_analytics['category_orders'][$i]->categorised_by]['last_action'] =(string) $verification_analytics['category_orders'][$i]->categorised_at;
                            }
                        }
                        
                    }

                /* end */

            
            /* end  */


            /*  complaints points counting */
                $complaints_analytics= $this->performanceModel->getComplaintsAnalytics('All',$date,$employees);


                $max_size =max(count($complaints_analytics['complaints_replies']),count($complaints_analytics['complaints_solved']) );

                for ($i=0; $i < $max_size; $i++) { 

                    if(isset($complaints_analytics['complaints_replies'][$i])) {
                        $complaints_employees[$complaints_analytics['complaints_replies'][$i]->replied_by]['replies']+=1;
                        $complaints_employees[$complaints_analytics['complaints_replies'][$i]->replied_by]['total'] += 1;
                        

                        if (empty($complaints_employees[$complaints_analytics['complaints_replies'][$i]->replied_by]['last_action']) || strtotime($complaints_employees[$complaints_analytics['complaints_replies'][$i]->replied_by]['last_action']) < strtotime($complaints_analytics['complaints_replies'][$i]->replied_at) ) {
                            $complaints_employees[$complaints_analytics['complaints_replies'][$i]->replied_by]['last_action'] =(string) $complaints_analytics['complaints_replies'][$i]->replied_at;
                        }

                    }
                    if(isset($complaints_analytics['complaints_solved'][$i])) {
                        $complaints_employees[$complaints_analytics['complaints_solved'][$i]->solved_by]['solved']+=1;
                        $complaints_employees[$complaints_analytics['complaints_solved'][$i]->solved_by]['total'] += 1;

                        if (empty($complaints_employees[$complaints_analytics['complaints_solved'][$i]->solved_by]['last_action']) || strtotime($complaints_employees[$complaints_analytics['complaints_solved'][$i]->solved_by]['last_action']) < strtotime($complaints_analytics['complaints_solved'][$i]->solved_at) ) {
                            $complaints_employees[$complaints_analytics['complaints_solved'][$i]->solved_by]['last_action'] =(string) $complaints_analytics['complaints_solved'][$i]->solved_at;
                        }
                    }

                }

                foreach ($complaints_analytics['complaints_rated'] as $key => $complaint) {

                    $complaints_employees[$complaint->solved_by]['rate_'.$complaint->rating] += 1;

                    $complaints_employees[$complaint->solved_by]['number_of_complaint_rated'] += 1;
                    
                }

                foreach ($complaints_employees as $name => $value) {
                    if ( $value['number_of_complaint_rated'] != 0) {
                        
                        $complaints_employees[$name]['rate'] =  round( ( ($value['rate_1'] * 1)+($value['rate_2'] * 2)+($value['rate_3'] * 3)+($value['rate_4'] * 4)+($value['rate_5'] * 5) ) / $value['number_of_complaint_rated'] ,1);
                    }
                }

            /* end  */

            /*  tst points counting */

                $tst_analytics= $this->performanceModel->getTstAnalytics('All',$date,$employees);

            /* end  */

            /* complaints stars rates to each employee */
                $complains_rates= $this->performanceModel->complaints_Rates_employees();
            /* end */
                
        return view('performance')->with(['verification_analytics'=>$verification_employees,
                                                 'complaints_employees'=>$complaints_employees, 
                                                 'rate_1'=>$complains_rates[1],
                                                 'rate_2'=>$complains_rates[2],
                                                 'rate_3'=>$complains_rates[3],
                                                 'rate_4'=>$complains_rates[4],
                                                 'rate_5'=>$complains_rates[5],
                                                 'employees_rates'=>$complains_rates[0],
                                                 'page'=>'performance']);   
   
        
        } catch (\Throwable $th) {
            return $th;
        }
        
    }
}
