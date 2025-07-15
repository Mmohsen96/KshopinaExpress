<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\DB;

class StockController extends Controller
{
    protected $stockModel;
    protected $ordersModel;
    protected $itemsModel;
    protected $historyModel;

    public function __construct(Request $request)
    {
/*         $this->middleware('auth');
 */
        $this->ordersModel = new \App\Models\Orders();
        $this->itemsModel = new \App\Models\Items();
        $this->historyModel = new \App\Models\History();
        $this->stockModel = new \App\Models\Stock();
    }
    //

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
        try {
            $id = $_GET['id'];
        } catch (\Throwable $th) {
            $id = "";
        }
        try {
            $store = $_GET['store'];
        } catch (\Throwable $th) {
            $store = "";
        }
        try {

            $data = $this->stockModel->get_products($store, $rule, $page,$id);

            return view('products')->with(['number_of_products' => $data[0], 'products' => $data[1], 'number_of_pre_alert' => $data[2], 'page' => 'stock']);

        } catch (\Throwable $th) {
            return $th;
        }
    }
    public function pre_alert_page()
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
            $store = "";
        }
        $data = $this->stockModel->get_pre_alert_products($store, $rule, $page);


        return view('products')->with(['number_of_products' => $data[0], 'products' => $data[1], 'number_of_pre_alert' => $data[2], 'page' => 'stock']);
    }
    public function out_of_stock_page()
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
            $store = "";
        }
        $data = $this->stockModel->get_expired_products($store, $rule, $page);


        return view('products')->with(['number_of_products' => $data[0], 'products' => $data[1], 'number_of_pre_alert' => $data[2], 'page' => 'stock']);
    }
    /* public function refresh_all_products()
    {
       
        $data = $this->stockModel->get_products_from_shopify();
        $data = $this->stockModel->insert_products($data);

        $data = $this->stockModel->get_products("egypt", $rule, $page, 1);
        
        return view('products')->with(['number_of_products' => $data[0], 'products' => $data[1], 'total_quantity' => $data[2], 'page' => 'stock']);
    } */
    public function search_products()
    {
        return view('search_products');
    }

    public function export_products()
    {
        try {
            $month = $_POST['months'];
            if ($month == "") {
                $message = 'Select month you want to export first!';
                return back()->with('error', $message);
            }
            $all_products = $this->stockModel->get_all_products('plus_egypt');
            $total_quantity = $this->stockModel->refresh_all_variants_quantity($all_products);
            $url = $this->stockModel->generate_file($month, $all_products, $total_quantity);

            return Redirect::to($url);
        } catch (\Throwable $th) {
            return $th;
        }

    }

    /* public function adjust_page()
    {
        $id = $_GET['id'];
        $product = $this->stockModel->get_product($id);
        $this->stockModel->refresh_all_variants_quantity($product);

        $variants = $this->stockModel->get_variants($id);

        return view('adjust')->with(['product' => $product[0], 'variants' => $variants]);
    } */

    public function get_variants()
    {
        $data = request()->all();
        $id = $data['id'];

        $product = $this->stockModel->get_product($id);
        $variants = $this->stockModel->get_variants($id);

        return [$product, $variants];
    }
    public function download_variant_barcode()
    {
        $id = $_POST['id'];
        $check = $this->stockModel->barcode_is_exist($id);
        if ($check[0]) {
            return response()->download(public_path('uploads/products/' . $check[1]));
        } else {
            if ($check[1] == 'Variant not found!') {
                # code...
            } else {
                $barcode_url = $this->stockModel->generate_barcode($id);
                return response()->download(public_path('uploads/products/' . $barcode_url));
            }
        }
    }
    public function products_in()
    {
        try {
            $store = $_GET['store'];
        } catch (\Throwable $th) {
            $store = "";
        }

        $data = $this->stockModel->get_number_pre_alert_products($store);

        return view('products')->with(['number_of_pre_alert' => $data, 'page' => 'stock']);

    }
    public function products_out()
    {
        try {
            $store = $_GET['store'];
        } catch (\Throwable $th) {
            $store = "";
        }

        $data = $this->stockModel->get_number_pre_alert_products($store);

        return view('products')->with(['number_of_pre_alert' => $data, 'page' => 'stock']);
    }
    public function scan_variant_barcode()
    {
        $sku_or_bar = $_POST['sku_or_bar'];
        $store = $_POST['store'];

        return $this->stockModel->get_variant($sku_or_bar,$store);
    }
    
    public function submit_variants_barcodes()
    {
        $variants = $_POST['variants'];
        $variants_id = $_POST['variants_id'];

        $quantity = $_POST['quantity'];
        $discount = $_POST['discount'];
        $payment = $_POST['payment'];


        $route_name = $_POST['route_name'];
        $store = $_POST['store'];
 
        
        if ($route_name == 'products_in') {
            try {
                $this->stockModel->add_in_stock($variants,$variants_id, $quantity,$store);
            } catch (\Throwable $th) {
                return $th;
            }
        } else {


            try {
                $return= $this->stockModel->add_out_stock($variants,$variants_id, $quantity, $discount,$payment ,$store);
                return $return;
            } catch (\Throwable $th) {
                return $th;
            }
        }

    }

    /* public function adjust_quantity()
    {
        $data = request()->all();

        if (!isset($data['adjust'])) {
            throw ValidationException::withMessages(['variant_type' => 'You must choose between IN or OUT']);
        }
        if ($data['adjust'] == 0) {
            if (!isset($data['source'])) {
                throw ValidationException::withMessages(['variant_type' => 'You must choose the source']);
            }
            if (!isset($data['in_quantity'])) {
                throw ValidationException::withMessages(['variant_type' => 'You must add the quantity']);
            }
        } else {
            if (!isset($data['market'])) {
                throw ValidationException::withMessages(['variant_type' => 'You must choose the market']);
            }
            if (!isset($data['out_quantity'])) {
                throw ValidationException::withMessages(['variant_type' => 'You must add the quantity']);
            }
            if ($data['out_quantity'] > $data['variant_quantity']) {
                throw ValidationException::withMessages(['variant_type' => 'Out of stock']);
            }

        }

        $variant_data = $this->stockModel->update_quantity($data);
        $this->stockModel->adjust_available($variant_data[0], $variant_data[1], $variant_data[2]);
        return back()->with('success', 'The product has been successfully modified');

    } */

    public function search_products_result()
    {
        $value = $_GET['content'];
        $filter = $_GET['filter'];
        $store = $_GET['store'];
        
        $products = $this->stockModel->products_like($store, $value, $filter);
        return $products;
       

    }

    public function get_similar_item()
    {
        $sku = $_POST['sku'];
        $country = $_POST['country'];

        return $this->stockModel->get_similar_item($sku,$country);
    }
    public function return_qty_to_stock()
    {
        $id = $_POST['id'];
        $qty = $_POST['qty'];
        $country = $_POST['country'];

        return $this->stockModel->return_qty_to_stock($id,$qty,$country);

    }
    public function create_new_variant()
    {

        try {
            $country= $_POST['country'];

            $id = $_POST['shopify_product_id'];
            $sku = $_POST['sku'];
            $price = $_POST['price'];
            $qty = $_POST['qty'];
            $variant_name = $_POST['variant_name'];

            $default_variant= $_POST['default_variant'];
            $barcode= $_POST['barcode'];

            $variant_data= $this->stockModel->create_new_variant($id,$sku,$price,$variant_name,$qty,$country,$barcode);

            if ($variant_data[0]=='success') {

                if ($default_variant[0] !='Empty') {
                    $this->stockModel->change_variant_name_and_sku($default_variant[0],$default_variant[1],$default_variant[2],$country,$variant_data[1]);
                }

                return 'Success';
            }
            elseif($variant_data[0]=='done'){

                if ($default_variant[0] !='Empty') {
                    $this->stockModel->change_variant_name_and_sku_out_of_shopify($default_variant[0],$default_variant[1],$default_variant[2],$variant_data[1]);
                }
                return 'Success';
            }
             else {
                return 'Fail';
            }
        } catch (\Throwable $th) {
            DB::insert('insert into errors (message,shipment_number,system_name) values (?,?,?)', [$th, $id,$variant_name]);
            return 'Fail';
        }
        
        
    }

    public function create_new_return_product(Request $request){

        try {
            $product_id =$_POST['product_id'];
            $variant_id =$_POST['variant_id'];

            $product_name =$_POST['product_name'];
            $product_sku =$_POST['sku'];
            $product_price =$_POST['price'];
            $product_qty =$_POST['qty'];
            $country= $_POST['country'];

            return $this->stockModel->dublicate_product_in_another_store($product_id,$variant_id,$product_name,$product_sku,$product_price,$product_qty,$country);
                
        } catch (\Throwable $th) {
            DB::insert('insert into errors (message,shipment_number,status,system_name) values (?,?,?,?)', [$th, $product_id,$variant_id,$country]);

        return 'Fail';
        }
    
    }
    
    public function submit_offline_order(Request $request){

        $total_price = $_POST['total_price'];

        $offline_order_id= DB::table('offline_orders')->insertGetId(['total_price'=>$total_price, 'store'=>'plus_ksa','offline_created_at'=>'2023-01-20 14:00:00']);
        return back();
    }


    public function export_sales_report()
    {

        $from = $_POST['from'];
        $to = $_POST['to'];

        $response= $this->stockModel->export_sales_report($from ,$to);

       return '/public/'.$response;

    }

    public function export_products_filters()
    {
        
        $route_name = $_POST['route_name'];
        $store_name = $_POST['store_name'];
        $filter_name = $_POST['filter_name'];


        $response= $this->stockModel->export_products_filters($route_name ,$store_name ,$filter_name);
        
            return '/public/'.$response;
      

    }

    /* new */

    public function products_search_page(){
        
        return view('products_search');

    }

    public function products_search_data(Request $request){

        try {
        
            $order_number = $_POST['order_number'];

            $order_data = $this->stockModel->get_products_data_by_order_number( $order_number);

            return $order_data;

        } catch (\Throwable $th) {

            return  $th;

        }
        
    }

    public function products_search_data_by_barcode(Request $request){

        try {
        
            $barcode = $_POST['barcode'];

            $product_data = $this->stockModel->get_products_data_by_barcode($barcode);

            $unique_barcode_stores = $this->stockModel->search_by_unique_barcode($product_data[1][0]->unique_barcode);

            if (count($product_data[0]) > 0) {

                $shopify_product_data = $this->stockModel->get_shopify_product_data($product_data[0][0]->product_id,'origin');

                if (count($shopify_product_data['product']) > 0) {
                    return ['status'=>'success','data'=>$product_data[0],'variants'=>$product_data[1],'stores'=>$unique_barcode_stores];
                }else{
                    return ['status'=>'fail','data'=>"Product not found!"];
                }

            }else{
                return ['status'=>'fail','data'=>"Product not found!"];

            }

        } catch (\Throwable $th) {

            return  $th;

        }
        
    }

    public function products_search_data_by_shopify_product_id(Request $request){

        try {
        
            $shopify_product_id = $_POST['shopify_product_id'];

            $product_data = $this->stockModel->get_products_data_by_shopify_product_id($shopify_product_id);
            
            $unique_barcode_stores = $this->stockModel->search_by_unique_barcode($product_data[1][0]->unique_barcode);

            
            if (count($product_data[0]) > 0) {

                $shopify_product_data = $this->stockModel->get_shopify_product_data($product_data[0][0]->product_id,'origin');

                if (count($shopify_product_data['product']) > 0) {
                    return ['status'=>'success','data'=>$product_data[0],'variants'=>$product_data[1],'stores'=>$unique_barcode_stores];
                }else{
                    return ['status'=>'fail','data'=>"Product not found!"];
                }

            }else{
                return ['status'=>'fail','data'=>"Product not found!"];

            }

        } catch (\Throwable $th) {

            return  $th;

        }
    }

    public function duplicate_product_by_product_id(){
        $product_id = $_POST['product_id'];
        $store = $_POST['store'];

        try {
            return $this->stockModel->dublicate_product_from_original($product_id,$store);
        } catch (\Throwable $th) {
            DB::insert('insert into errors (message,shipment_number,status,system_name) values (?,?,?,?)', [$th, $product_id,"",""]);
        }

        
    }
    
    public function products_search_page_admin(){

        return view('products_search_admin');
        
    }

    public function get_similar_item_by_barcode()
    {
        try {
        
            $barcode = $_POST['barcode'];
            $country = $_POST['country'];

            return $this->stockModel->get_similar_item($barcode,$country);

        } catch (\Throwable $th) {

            return $th;
            
        }
    }

    public function tp_submit_question(Request $request){

        try {
            
            $name= $_POST['name'];
            $phone_number = $_POST['phone_number'];
            $order_number = $_POST['order_number'];
            $question = $_POST['question'];

            if ( $phone_number == ''  || $phone_number == NULL ) {
                return back()->with('error_phone_number', 'Submit your phone number please, so We be able to reach you.');
            }

            if ( $question == ''  || $question == NULL ) {
                return back()->with('error_question', 'Submit your question please, We want to help you.');
            }

            $this->stockModel->tp_submit_question($order_number,$question,$name,$phone_number);

            return back()->with('message', 'Thank you for your support, we will get back to you as soon as possible!');

        } catch (\Throwable $th) {
            return $th;
        }
        
    }
    
}
