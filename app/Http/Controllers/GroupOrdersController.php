<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Jobs\AddToGroup;

class GroupOrdersController extends Controller
{
    protected $groupModel;
    

    public function __construct(Request $request)
    {
       
        $this->groupModel = new \App\Models\GroupOrders();

    }

    public function index()
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

        $all_orders = $this->groupModel->get_group_orders_from_database($rule, $page);

        return view('group_orders')->with([
            'orders' => $all_orders[1], 'number_of_orders' => $all_orders[0][0]->NumberOfOrders,
            'page' => 'group_orders',
        ]);        
        
       
    }
     
    public function group_order_form(){

        $products=$this->get_active_group_products();

        $zones =$this->get_active_zones();

        return view('group_order_form')->with(['products' => $products, 'zones' => $zones ]);   

    }
    protected function get_active_zones()
    {
        return DB::select('SELECT * from Zones where active=1');
    }
    protected function get_active_group_products()
    {
        return DB::select('SELECT * from group_orders_stock where active=1 AND deleted =0');

    }
    protected function get_group_order()
    {
        $id=$_GET['id'];

        
        $order_with_products= DB::select('SELECT group_orders.group_orders_id,group_orders.email,group_orders.city,group_orders.shipping_rate,group_orders.final_price,
                            group_orders.group_city_id,group_orders.customer_name,
                            group_orders.contact_number,group_orders.address,group_orders.created_at,group_orders_products.group_orders_products_id,
                            group_orders_products.order_id,group_orders_products.product_name,group_orders_products.product_price,group_orders_products.product_qty
                            FROM kshopina.group_orders_products
                            INNER JOIN kshopina.group_orders
                            ON group_orders_products.order_id = group_orders.group_orders_id 
                            WHERE group_orders_products.order_id = ? ;',[$id]);

        
        return $order_with_products;
    }
    
    public function create_group_order_customer(){

        $data = request()->all();
        $this->groupModel->create_group_order_by_customer($data);
        return redirect('/group_order_form')->withSuccess('Success message');

}
    protected function get_zones()
    {
        return DB::select('SELECT * from Zones ');
    }
    protected function get_group_products()
    {
        return DB::select('SELECT * from group_orders_stock where deleted =0 ');

    }
    protected function change_zones_status()
    {
        $new_status=$_POST['new_status'];

        $this->groupModel->submit_new_cities_status($new_status);
    }

    protected function update_group_product()
    { 
        $ids=request()->all()['id'];

        $name=request()->all()['name'];
        $price=request()->all()['price'];
        $sku=request()->all()['sku'];

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
        $this->groupModel->update_group_product($ids,$name,$price,$sku,$active,$deleted);       
        
        return back();
    }
    public function  get_confirmed_group_orders(){
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
            $confirmed_orders = $this->groupModel->get_confirmed_group_orders($rule, $page);
          
            return view('group_orders')->with([
                'confirmed_group_orders' => $confirmed_orders[0], 'number_of_orders' => count($confirmed_orders[1]) ,
                'members_data_each' => $confirmed_orders[2]
            ]);
        } catch (\Throwable $th) {
            return $th;
        }

    }

    
    public function send_group_order_mail()
    {

        $this->groupModel->send_group_order_mail(request()->all());
            return back();
    }

    public function confirm_group_order()
    {
        try {
            $token = $_GET['token'];
        } catch (\Throwable $th) {
            abort(404);
        }
        $check = DB::select('select * from group_orders where token = ?', [$token]);


        if ($check != null || $check != []) {
            if ($check[0]->status == 1) {

                $groupJob = new AddToGroup($check[0]);
                $data=dispatch($groupJob);

                return view('emails_response')->with(['status' => 'success', 'title' => "The Order has been confirmed!", 'sub_title' => "We will keep you posted via email 😊"]);
            } else {
                if ($check[0]->status == 3) {
                    return view('emails_response')->with(['status' => 'cancel', 'title' => "The Order has already been canceled before", 'sub_title' => "Please visit Kshopina to place a new order"]);
                } else {
                    return view('emails_response')->with(['status' => 'success', 'title' => "The Order has been confirmed!", 'sub_title' => "We will keep you posted via email 😊"]);
                }

            }
        } else {
            abort(404);
        }
    }
    public function cancel_group_order()
    {
        try {
            $token = $_GET['token'];
        } catch (\Throwable $th) {
            abort(404);
        }
        $check = DB::select('select * from group_orders where token = ?', [$token]);

        if ($check != null || $check != []) {
            if ($check[0]->status==1) {
                date_default_timezone_set('Africa/Cairo');
                $date = date('Y-m-d H:i:s', time());

                DB::table('group_orders')->where('token',$token)->update(['status'=>3,'replied_at'=>$date,'updated_at'=>$date]);
                
                return view('emails_response')->with(['status' => 'cancel', 'title' => "The Order has been canceled!", 'sub_title' => "We hope to see you again 😊"]);
            } else {
                if ($check[0]->status == 3) {
                    return view('emails_response')->with(['status' => 'cancel', 'title' => "The Order has already been canceled before", 'sub_title' => "Please visit Kshopina to place a new order 😊"]);
                } else {
                    return view('emails_response')->with(['status' => 'success', 'title' => "The Order has been confirmed!", 'sub_title' => "We will keep you posted via email 😊"]);
                }
                
            }
        } else {
            abort(404);
        }
    }
    public function group_order_customer_page()
    {
        try {
            $group_id = $_GET['group_id'];
        } catch (\Throwable $th) {
            abort(404);
        }
        /* try {
            $order_id = $_GET['order_id'];
        } catch (\Throwable $th) {
            abort(404);
        } */

        $city =substr($group_id,1,2);
        $group_id=substr($group_id,3);

        $group_orders=$this->groupModel->get_group_records($city,$group_id);

        return view('GO_charts')->with(['group_orders'=>$group_orders]);
    }
    
    public function left_group_order(){
        $id=$_POST['id'];

        $this->groupModel->left_group_order($id);
    }
    public function get_group_items()
    {
        $id = $_GET['order'];
        $items = DB::select('select * from group_orders_products where order_id = ?', [$id]);
        return (array) $items;
    }

    public function group_order_data()
    {
        $group_number_id = $_POST['id'];
       
        
        
        try {
            $file_name = $this->groupModel->export_group_data($group_number_id);
            return '/public/uploads/group_orders_reports/file'.$file_name.'.xlsx'; 

        } catch (\Throwable $th) {
            return $th;
        }
    }
}
