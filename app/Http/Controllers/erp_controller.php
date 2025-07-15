<?php

namespace App\Http\Controllers;

use Facade\FlareClient\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\support\Facades\Http;
use Illuminate\Support\Facades\DB;


class erp_controller extends Controller
{
    protected $tstmodel;
    protected $historyModel;
    protected $taskModel;

    public function __construct(Request $request)
    {
        $this->tstmodel = new \App\Models\tst();
        $this->historyModel = new \App\Models\History();
        $this->taskModel = new \App\Models\Tasks();
    }


    
    public function orders_by_awb()
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
            $category = $_GET['category'];
        } catch (\Throwable $th) {
            $category = "All";
        }
        try {
            $order_number = $_GET['order_num'];
        } catch (\Throwable $th) {

            $order_number = "";
        }
        try {
            $store = $_GET['store'];
        } catch (\Throwable $th) {
            $store = "origin";
        }

        if (!empty($order_number)) {

            $data = $this->tstmodel->get_orders_from_database_search_tst( $store, $rule, $page, $order_number); 
        } else {

                $data = $this->tstmodel->orders_by_awb( $store, $rule, $category, $page);
            
        }
       
        return view('tst')->with([
            'orders' => $data[0], 
            'number_of_verified' => $data[1],
            'number_of_fulfiled' => $data[2],
            'number_of_dispatched' => $data[3],
            'number_of_in_warehouse' => $data[4],
            'number_of_delivery' => $data[5],
            'number_of_canceled' => $data[6],
            'number_of_delivered' => $data[7],
            'number_of_refused' => $data[8],'map_of_awb'=>$data[9] ,'map_of_awb_data'=>$data[10], 'page' => 'tst',
        ]);
       
    }

    public function verified_orders()
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
            $category = $_GET['category'];
        } catch (\Throwable $th) {
            $category = "normal";
        }
        try {
            $order_number = $_GET['order_num'];
        } catch (\Throwable $th) {
            $order_number = "";
        }
        try {
            $store = $_GET['store'];
        } catch (\Throwable $th) {
            $store = "origin";
        }

        if (!empty($order_number)) {
            $data = $this->tstmodel->get_orders_from_database_search( $store, $rule, $page, $order_number, 'Verified');
        } else {
            try {
                $data = $this->tstmodel->get_confirmed_orders( $store, $rule, $category, $page, "Verified");
            } catch (\Throwable $th) {
                return  $th;
            }
        }

        return view('tst')->with([
            'orders' => $data[1], 'number_of_orders' => $data[0],
            'number_of_verified' => $data[2],
            'number_of_fulfiled' => $data[3],
            'number_of_dispatched' => $data[4],
            'number_of_in_warehouse' => $data[5],
            'number_of_delivery' => $data[6],
            'number_of_canceled' => $data[7],
            'number_of_delivered' => $data[8],
            'number_of_refused' => $data[9],'availability'=>$data[10],'number_of_items'=>$data[11], 'page' => 'tst',
        ]);
    }
    public function on_process_orders()
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
            $category = $_GET['category'];
        } catch (\Throwable $th) {
            $category = "normal";
        }
        try {
            $order_number = $_GET['order_num'];
        } catch (\Throwable $th) {
            $order_number = "";
        }
        try {
            $store = $_GET['store'];
        } catch (\Throwable $th) {
            $store = "origin";
        }

        if (!empty($order_number)) {
            $data = $this->tstmodel->get_orders_from_database_search( $store , $rule, $page, $order_number, 'on_process');
        } else {
            $data = $this->tstmodel->get_confirmed_orders( $store , $rule, $category, $page, "on_process");
        }


        return view('tst')->with([
            'orders' => $data[1], 'number_of_orders' => $data[0],
            'number_of_verified' => $data[2],
            'number_of_fulfiled' => $data[3],
            'number_of_dispatched' => $data[4],
            'number_of_in_warehouse' => $data[5],
            'number_of_delivery' => $data[6],
            'number_of_canceled' => $data[7],
            'number_of_delivered' => $data[8],
            'number_of_refused' => $data[9],'availability'=>$data[10],'number_of_items'=>$data[11], 'page' => 'tst',
        ]);
    }
    public function fulfilled_orders()
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
            $category = $_GET['category'];
        } catch (\Throwable $th) {
            $category = "normal";
        }
        try {
            $order_number = $_GET['order_num'];
        } catch (\Throwable $th) {
            $order_number = "";
        }
        try {
            $store = $_GET['store'];
        } catch (\Throwable $th) {
            $store = "origin";
        }

        if (!empty($order_number)) {
            $data = $this->tstmodel->get_orders_from_database_search( $store, $rule, $page, $order_number, "Fulfilled");
        } else {
            $data = $this->tstmodel->get_confirmed_orders( $store, $rule, $category, $page, "Fulfilled");
        }

        return view('tst')->with([
            'orders' => $data[1], 'number_of_orders' => $data[0],
            'number_of_verified' => $data[2],
            'number_of_fulfiled' => $data[3],
            'number_of_dispatched' => $data[4],
            'number_of_in_warehouse' => $data[5],
            'number_of_delivery' => $data[6],
            'number_of_canceled' => $data[7],
            'number_of_delivered' => $data[8],
            'number_of_refused' => $data[9],'availability'=>$data[10],'number_of_items'=>$data[11], 'page' => 'tst',
        ]);
    }
    public function tst()
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
            $category = $_GET['category'];
        } catch (\Throwable $th) {
            $category = "normal";
        }
        try {
            $order_number = $_GET['order_num'];
        } catch (\Throwable $th) {

            $order_number = "";
        }
        try {
            $store = $_GET['store'];
        } catch (\Throwable $th) {
            $store = "origin";
        }

        if (!empty($order_number)) {

            $data = $this->tstmodel->get_orders_from_database_search_tst( $store, $rule, $page, $order_number);
        } else {

            $data = $this->tstmodel->get_tst_orders( $store, $rule, $category, $page);
        }

        return view('tst')->with([
            'orders' => $data[1], 'number_of_orders' => $data[0],
            'number_of_verified' => $data[2],
            'number_of_fulfiled' => $data[3],
            'number_of_dispatched' => $data[4],
            'number_of_in_warehouse' => $data[5],
            'number_of_delivery' => $data[6],
            'number_of_canceled' => $data[7],
            'number_of_delivered' => $data[8],
            'number_of_refused' => $data[9],'page' => 'tst',
        ]);
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
            $category = $_GET['category'];
        } catch (\Throwable $th) {
            $category = "normal";
        }
        try {
            $order_number = $_GET['order_num'];
        } catch (\Throwable $th) {
            $order_number = "";
        }
        try {
            $store = $_GET['store'];
        } catch (\Throwable $th) {
            $store = "origin";
        }
        try {
            $archived =  $_GET['archived'];
        } catch (\Throwable $th) {
            $archived = 0;
        }
try {
    //code...

        if (!empty($order_number)) {

             $data = $this->tstmodel->get_orders_from_database_search_archived( $store, $rule, $page, $order_number, $category);

        } else {

            $data = $this->tstmodel->get_archived_orders( $store, $rule, $category, $page,$archived);
        }


    } catch (\Throwable $th) {
        return  $th;
    }
        return view('tst')->with([
            'orders' => $data[1], 'number_of_orders' => $data[0],
            'number_of_verified' => $data[2],
            'number_of_fulfiled' => $data[3],
            'number_of_dispatched' => $data[4],
            'number_of_in_warehouse' => $data[5],
            'number_of_delivery' => $data[6],
            'number_of_canceled' => $data[7],
            'number_of_delivered' => $data[8],
            'number_of_refused' => $data[9], 'page' => 'tst',
        ]);
    }
    public function move_to_on_process()
    {
        $id = $_POST['order_id'];
        $store = $_POST['store'];

        $this->tstmodel->move_to_on_process($id, $store);
    }
    public function mark_order_as_fulfilled()
    {
        $id = $_POST['order_id'];
        $store = $_POST['store'];

        try {
            $this->tstmodel->mark_order_as_fulfilled($id, $store);
        } catch (\Throwable $th) {
            return $th;
        }
    }

    public function return_to_stock()
    {
        $id = $_POST['order_id'];

        try {
            $this->tstmodel->return_to_stock($id);
        } catch (\Throwable $th) {
            return $th;
        }
    }


    public function export_tst()
    {
       

        $filters = $_POST['data'];
      
        try {
            
         /*    return $this->tstmodel->export_with_filters($filters); */
            $response= $this->tstmodel->export_with_filters($filters);

          //  $file =public_path($response);

             return '/public/'.$response; 
         

          

        } catch (\Throwable $th) {
            return $th;
        }


    
    }
    public function export_archived()
    {


        $from = $_POST['from'];
        $to = $_POST['to'];
        $store = $_POST['store'];
        $archived = $_POST['archived'];

        try {

              $response = $this->tstmodel->export_archived($from ,$to, $store ,$archived );

          //  $file =public_path($response);

             return '/public/'.$response;


        } catch (\Throwable $th) {
            return $th;
        }

    }
    public function excel_functions(Request $request)
    {

        $store= $request->input('store');
        $data = request()->all();
        // nour w yasmouna
        if ($request->input('action') == 'export-fct') {
            $name = $this->tstmodel->export_fct();

            $myFile = public_path('/uploads/fct/file' . $name . '.xlsx');

            $this->historyModel->create(Auth::user()->name, 'FCT_export', 'file name (' . $name . ') exported');

            return response()->download($myFile);
        }


        switch ($request->input('action')) {

            case 'export':
                if ($data['system'] == "") {

                    return back()->with('error', 'You must choose your system first!');
                } else {
                    if ($request->input('system') == 'confirmed_system') {
                        $name = $this->tstmodel->export('confirmed',$store);

                        $myFile = public_path('/uploads/confirmed/file' . $name . '.xlsx');

                        $this->historyModel->create(Auth::user()->name, 'confirmed_export', 'file name (' . $name . ') exported');

                        return response()->download($myFile);

                        break;
                    } elseif ($request->input('system') == 'tst_system') {

                        $name = $this->tstmodel->export('tst',$store);

                        $myFile = public_path('/uploads/tst/file' . $name . '.xlsx');

                        $this->historyModel->create(Auth::user()->name, 'TST_export', 'file name (' . $name . ') exported');

                        return response()->download($myFile);
                        break;
                    }
                }
            case 'import':


                $this->validate($request, [
                    'file' => 'required|mimes:xls,xlsx',
                ]);

                try {

                     $response = $this->tstmodel->import($request->file('file'),$store);
                     
                } catch (\Throwable $th) {

                    DB::insert('insert into errors (message,system_name) values (?,?)', [ $th, "IMPORT ERROR"]);

                }
                

                if (isset($response['error'])) {

                   
                    $message = $response['error'];

                    $this->historyModel->create(Auth::user()->name, 'TST_import', $message);

                    return back()->with('error', $message);

                } else {

                    $myFile = public_path('/uploads/import_errors/file' . $response[1] . '.xlsx');

                    $message = '( ' . $response[0]['success'] . ' ) order updated successfully  ( ' . $response[0]['failed'] . ' ) order failed to update';

                    $this->historyModel->create(Auth::user()->name, 'TST_import', $message);

                    return back()->with(['message'=> $message,'file_name'=> 'file' . $response[1] . '.xlsx' , 'status'=>$response[0]]);

                }

                break;
        }
    }

    public function submit(Request $request)
    {
        $data = $_POST['data'];
        $status = $_POST['status'];
        $reasons = $_POST['reasons'];
        $store = $_POST['store'];

        try {
            $result = $this->tstmodel->submit($reasons, $data, $status,$store );
            return $result;
        } catch (\Throwable $th) {
            return $th;
        }

        $this->historyModel->create(Auth::user()->name, 'TST_OR_confirmed', 'the number of submited orders : ' . $result);

        return $result;
    }
    public function submit_fct(Request $request)
    {
        $data = $_POST['data'];
        $store = $_POST['store'];
       
        $result = $this->tstmodel->submit_fct($data ,$store);
       
        $this->historyModel->create(Auth::user()->name, 'FCT', 'the number of submited orders : ' . $result);

        return $result;
    }
    public function submit_awb_data(Request $request)
    {
        try {
            $awbs = $_POST['awbs'];
            $result = $this->tstmodel->submit_awbs($awbs);
        } catch (\Throwable $th) {
            return  $th;
        }
        

    }
    public function remove_from_awbs(Request $request)
    {
        try {
            $awb = $_POST['awb'];

            $result = $this->tstmodel->remove_from_awbs($awb);

        } catch (\Throwable $th) {

            return $th;
            
        }
       
    }

    
    
    public function fct()
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

            $data = $this->tstmodel->get_fct_orders_for_search( $store,$order_number);
        } else {

            $data = $this->tstmodel->get_fct_orders( $store, $rule, $page);
        }
      

        return view('fct')->with([
            'orders' => $data[1], 'number_of_orders' => $data[0], 'number_of_pending' => $data[2],
            'number_of_delivery' => $data[3],
            'number_of_delivered' => $data[4],
            'number_of_refused' => $data[5], 'page' => 'fct'
        ]);
  
    }
    public function fct_archived()
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
        }try {
            $order_number = $_GET['order_num'];
        } catch (\Throwable $th) {
            $order_number = "";
        }
        
        if (!empty($order_number)) {

            $data = $this->tstmodel->get_fct_archived_orders_for_search( $store,$order_number);
        } else {

            $data = $this->tstmodel->get_fct_archived_orders($store, $rule, $page);
        }

        return view('fct')->with([
            'orders' => $data[1], 'number_of_orders' => $data[0], 'number_of_pending' => $data[2],
            'number_of_delivery' => $data[3],
            'number_of_delivered' => $data[4],
            'number_of_refused' => $data[5], 'page' => 'fct'
        ]);
    }

    public function send_to_fct()
    {
        $reason = $_POST['reason'];
        $order_number = $_POST['order_number'];
        $store=$_POST['store'];

        date_default_timezone_set('Africa/Cairo');
        $date = date('Y-m-d H:i:s', time());

        $this->tstmodel->send_to_fct($order_number, $reason, $date, 1,$store);
        $this->tstmodel->change_action($order_number, 3, $date);
    }

    public function get_tasks()
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
        if ($rule == 'Normal') {
            $rule = '0';
        } elseif ($rule == 'Important') {
            $rule = '1';
        } elseif ($rule == 'Urgent') {
            $rule = '2';
        } else {
            $rule = "All";
        }

        $data = $this->taskModel->get_tasks($rule, $page, Auth::user()->id);

        return view('tasks')->with([
            'orders' => $data[1], 'number_of_orders' => $data[0], 'page' => 'tasks', /* 'number_of_pending' => $data[2],
        'number_of_delivery' => $data[3],
        'number_of_delivered' => $data[4],
        'number_of_refused' => $data[5] */
        ]);
    }
    public function get_assigned_tasks()
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

        if ($rule == 'Normal') {
            $rule = '0';
        } elseif ($rule == 'Important') {
            $rule = '1';
        } elseif ($rule == 'Urgent') {
            $rule = '2';
        } else {
            $rule = "All";
        }

        $data = $this->taskModel->get_assigned_tasks($rule, $page, Auth::user()->id);

        return view('tasks')->with([
            'orders' => $data[1], 'number_of_orders' => $data[0], 'page' => 'tasks', /* 'number_of_pending' => $data[2],
        'number_of_delivery' => $data[3],
        'number_of_delivered' => $data[4],
        'number_of_refused' => $data[5] */
        ]);
    }
    public function get_archived_tasks()
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
        if ($rule == 'Normal') {
            $rule = '0';
        } elseif ($rule == 'Important') {
            $rule = '1';
        } elseif ($rule == 'Urgent') {
            $rule = '2';
        } else {
            $rule = "All";
        }
        $data = $this->taskModel->get_archived_tasks($rule, $page, Auth::user()->id);

        return view('tasks')->with([
            'orders' => $data[1], 'number_of_orders' => $data[0], 'page' => 'tasks', /* 'number_of_pending' => $data[2],
        'number_of_delivery' => $data[3],
        'number_of_delivered' => $data[4],
        'number_of_refused' => $data[5] */
        ]);
    }
    public function assign_task(Request $request)
    {

        $data = request()->all();

        if (preg_replace('/\s+/', '', $data['task']) == "") {
            return back()->with('error', 'Comment can\'t be empty');
        }

        if ($request->file('image') != null) {
            $imageName = Auth::user()->id . date('YmdHis', time()) . '.' . $request->image->extension();
            $files = $request->file('image');

            if (!file_exists(public_path('uploads/tasks'))) {
                mkdir(public_path('uploads/tasks'), 0777, true);
            }

            $files->move(public_path('uploads/tasks'), $imageName);
        } else {
            $imageName = '';
        }

        $task = [
            'order_number' => $data['order_number'], 'system_name' => $data['system_name'],
            'assign_from' => Auth::user()->id, 'assign_to' => $data['assign_to'], 'comment' => $data['task'],
            'deadline' => $data['deadline'], 'priority' => $data['priority'], 'status' => 0, 'image_url' => $imageName
        ];

        $this->taskModel->add_to_tasks($task);

        return back()->with('message', 'Task has been assigned');
    }

    public function add_task(Request $request)
    {
        $data = request()->all();

        /* $this->validate($request, [
        'image' => 'required',
        ]); */
        if (preg_replace('/\s+/', '', $data['task']) == "") {
            return back()->with('error', 'Comment can\'t be empty');
        }
        if ($request->file('image') != null) {
            $imageName = Auth::user()->id . date('YmdHis', time()) . '.' . $request->image->extension();
            $files = $request->file('image');

            if (!file_exists(public_path('uploads/tasks'))) {
                mkdir(public_path('uploads/tasks'), 0777, true);
            }

            $files->move(public_path('uploads/tasks'), $imageName);
        } else {
            $imageName = '';
        }

        $task = [
            'order_number' => $data['order_number'], 'assign_to' => $data['assign_to'], 'system_name' => $data['system_name'], 'deadline' => $data['deadline'],
            'assign_from' => Auth::user()->id, 'comment' => $data['task'],
            'priority' => $data['priority'], 'status' => 0, 'image_url' => $imageName
        ];

        $this->taskModel->add_to_tasks($task);

        return back()->with('message', 'Task has been assigned');
    }


    public function get_users()
    {
        return $this->taskModel->get_users();
    }
    public function update_task_status(Request $request)
    {

        $data = $_POST['data'];

        $result = $this->taskModel->update_task_status($data, Auth::user()->id);

        /*         $this->historyModel->create(Auth::user()->name, 'Tasks', 'the number of submited orders : ' . $result);
 */
        return $result;
    }

    public function assign_reply(Request $request)
    {

        $data = request()->all();

        if (preg_replace('/\s+/', '', $data['task']) == "") {
            return back()->with('error', 'Comment can\'t be empty');
        }

        if ($request->file('image') != null) {
            $imageName = Auth::user()->id . date('YmdHis', time()) . '.' . $request->image->extension();
            $files = $request->file('image');

            if (!file_exists(public_path('uploads/tasks'))) {
                mkdir(public_path('uploads/tasks'), 0777, true);
            }

            $files->move(public_path('uploads/tasks'), $imageName);
        } else {
            $imageName = '';
        }

        if (isset($data['mark_as'])) {
            $mark = $data['mark_as'];
            $this->taskModel->mark_as_solved($data['case_number'], Auth::user()->id);
        } else {
            $mark = 0;
            $task_data = $this->taskModel->get_task($data['case_number']);

            if (Auth::user()->id != $task_data[0]->assign_from) {
                $this->taskModel->change_task_status($data['case_number'], 1);
            }
        }

        $task = [
            'case_number' => $data['case_number'], 'comment' => $data['task'], 'user' => Auth::user()->id,
            'mark_as_solved' => $mark, 'image_url' => $imageName
        ];

        $this->taskModel->add_to_replies($task);

        return back()->with('message', 'Reply has been sent');
    }

    public function task_details()
    {

        $id = $_POST['task'];
        $route_name = $_POST['route_name'];

        return $this->taskModel->get_task_with_replies($id, $route_name);
    }
    
    public function search_orders_result_tst()
    {
        $value = $_POST['content'];
        $store = $_POST['store'];
        $filter=$_POST['filter'];

        return $this->tstmodel->order_like($value,$store,$filter);
    }

    public function search_fct()
    {
        $value = $_POST['content'];
        $store = $_POST['store'];
        $filter=$_POST['filter'];

        try {
            return $this->tstmodel->order_like_fct($value,$store,$filter);
        } catch (\Throwable $th) {
            return $th;
        }
      
    }

    public function fix_import()
    {

        $this->tstmodel->fix_import();
    }


}
