<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Mail\GroupOrderMail;
use Illuminate\Support\Facades\Mail;

use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use App\Jobs\AddToGroup;

class GroupOrders extends Model
{
    use HasFactory;

    public function get_group_orders_from_database($rule, $page)
    {
        $orders_per_page = 15;
        $offset = ($page - 1) * $orders_per_page;

        $orders = DB::select('SELECT * FROM group_orders where status < ? ORDER BY updated_at DESC LIMIT ?, ?;', [2,$offset, $orders_per_page]);
        $number_of_orders = DB::select('SELECT COUNT(group_orders_id) AS NumberOfOrders FROM kshopina.group_orders where status < 2;');

        return [
            $number_of_orders, $orders
        ];
    }
    public function get_confirmed_group_orders( $rule, $page ){

        $orders_per_page = 15;
        $offset = ($page - 1) * $orders_per_page;
       

        $groups = DB::select('SELECT group_id,group_city_id,city,count(group_city_id) AS NumberOfMembers 
        FROM group_orders where group_id is not Null AND group_city_id is not Null
        group by group_city_id,group_id,city having count(group_city_id) <= ?  
        order by group_id ASC LIMIT ?, ? ;', [15 ,$offset, $orders_per_page ]);

        $number_of_groups= DB::select('SELECT count(group_city_id) AS NumberOfOrders 
        FROM group_orders where group_id is not Null AND group_city_id is not Null
        group by group_city_id,group_id having count(group_city_id) <= ?  
        order by group_id ASC ;', [15]);

        $members_data_each=[];
        foreach ($groups as $group) {
        $member_data = DB::select('SELECT group_orders.email , group_orders.email , group_orders.city , group_orders.shipping_rate ,
        group_orders.final_price , group_orders.customer_name , group_orders.contact_number ,
        group_orders.address , group_orders.created_at , group_orders.status ,
        group_orders.customer_rank , group_orders.active , group_orders.group_orders_id
            FROM group_orders
        where group_id=? AND group_city_id=?', [$group->group_id , $group-> group_city_id]);


            $group_id = sprintf("%02d", $group->group_id);

            $group_city_id = sprintf("%02d", $group->group_city_id);

            $members_data_each[$group_city_id.$group_id]=$member_data;
        }

        return [$groups , $number_of_groups , $members_data_each];
    }
    function create_group_order_by_customer ($data){

        date_default_timezone_set('Africa/Cairo');
        $date = date('Y-m-d H:i:s', time());

        
        $city_data = DB::select('select * from Zones where id = ?', [$data['city']]);
        $city_name= $city_data[0]->city;
        $rate=$city_data[0]->shipping_rate;

        
        /* $groupJob = new AddToGroup($data,$date);
        dispatch($groupJob); */


        $id = DB::table('group_orders')->insertGetId(['email'=>$data['email'],'city'=>$city_name,
        'created_at'=>$date,'updated_at'=>$date,
        'created_by'=>'customer','status'=>0,'customer_name'=>$data['customer_name'],'contact_number'=>$data['phone'],
        'address'=>$data['address'],'shipping_rate'=> $rate,'final_price'=>$data['final_price']
         ]);

        
        for ($i = 0; $i < count($data['product']); $i++) {
            $product_from_stock=DB::select('select * from group_orders_stock where product_id = ?', [$data['product'][$i]]);

            foreach ($product_from_stock as $product) {
                DB::insert('INSERT into group_orders_products (order_id , product_name,product_id,product_price, product_qty , created_at) values (?, ?,?,?,?, ?)',
             [$id, (string)$product->product_title ,(int)$data['product'][$i],$product->price, (int)$data['qty'][$i] , $date]);
            }
            
        }

    }

    
    public function submit_new_cities_status($new_status){

        foreach ($new_status as $key => $value) {
            DB::table('Zones')->where('id',$key)->update(['active'=>$value]);
        }
    }
    public function update_group_product($ids,$name,$price,$sku,$active,$deleted){

        date_default_timezone_set('Africa/Cairo');
        $date = date('Y-m-d H:i:s', time());

        if (count($deleted) !=0) {
            foreach ($deleted as $key => $id) {
                if ($id !='none') {
                    DB::table('group_orders_stock')->where('product_id',$id)->update(['deleted'=>1,'updated_at'=>$date]);
                }
            }
        
        }

        foreach ($ids as $index => $id) {
            if ($id != 'none') {
                if (in_array($id,$active)) {
                    DB::table('group_orders_stock')->where('product_id',$id)->update(['product_title'=>$name[$index],
                    'price'=>$price[$index],'sku'=>$sku[$index],'active'=>1,'updated_at'=>$date]);
                }
                else {
                    DB::table('group_orders_stock')->where('product_id',$id)->update(['product_title'=>$name[$index],
                    'price'=>$price[$index],'sku'=>$sku[$index],'active'=>0,'updated_at'=>$date]);
                }
                
            }else{
                if (in_array($id,$active)) {
                    DB::insert('insert into group_orders_stock (product_title, price,sku,active,created_at) values (?, ?,?, ?,?)',
                     [$name[$index], $price[$index],$sku[$index],1,$date]);
                }
                else {
                    DB::insert('insert into group_orders_stock (product_title, price,sku,active,created_at) values (?, ?,?, ?,?)',
                     [$name[$index], $price[$index],$sku[$index],0,$date]);
                }
            }
        }
    }
    
    public function send_group_order_mail($data)
    {
        date_default_timezone_set('Africa/Cairo');
        $date = date('Y-m-d H:i:s', time());

        $id=$data['id'];

        //generate token for url
        $bytes = random_bytes(20);
        $token = bin2hex($bytes) . $id;
                

        $items=DB::select('select * from group_orders_products where order_id = ?', [$id]);
        

        $data1 = [
            'order_number' => $id,
            'items' => $items,
            'final_price' => substr($data['final_price'], 0, -4) ,
            'currency' => "EGP",
            'arabic_currency' => "جنيه مصري",
            'confirm_url' => url('') . '/' . "confirm_group?token=" . $token,
            'cancel_url' => url('') . '/' . "cancel_group?token=" . $token,
            ];

        Mail::to($data['email'])->send(new GroupOrderMail($data1), function ($message) {
            $message->subject("Kshopina - EG (Group Order) Invoice");
        });

        DB::table('group_orders')->where('group_orders_id',$id)->update(['token'=>$token,'status'=>1,'updated_at'=>$date]);

    }

    public function get_group_records($city,$group_id)
    {
        $all_orders_in_group= DB::select('SELECT * from group_orders where group_city_id = ? AND group_id=? AND status = ?', [$city,$group_id,2]);
        $records= DB::select('select * from group_orders_records where group_id = ?', [sprintf("%02d", $city).sprintf("%02d",$group_id)]);

        return [$all_orders_in_group,$records];
    }
    public function validate_order_in_group($order_id,$city,$group_id)
    {
        return DB::select('SELECT * from group_orders where group_orders_id = ? AND group_city_id=? AND group_id = ?', [$order_id,$city,$group_id]);

    }
    public function left_group_order($id){
        
        $order=DB::select('select * from group_orders where group_orders_id = ?', [$id]);

        foreach ($order as $value) {
            DB::insert('insert into group_orders_records (customer_name,case_name, order_id,group_id) values (?,?, ?,?)', 
                        [$value->customer_name,"Left", $value->group_orders_id,sprintf("%02d", $value->group_city_id).sprintf("%02d",$value->group_id)]);

        DB::table('group_orders')->where('group_orders_id',$value->group_orders_id)->update(['group_city_id'=>null,'group_id'=>null,'customer_rank'=>null,'active'=>1]);
        }
        
    }
    public function get_group_order_data($group_number_id){
        

        $data =DB::select('SELECT * FROM kshopina.group_orders inner join ( SELECT  group_orders_records.group_id , 
                group_orders_records.order_id , group_orders_records.customer_name , group_orders_products.product_name ,   
                group_orders_products.product_qty , group_orders_products.product_price  ,
                group_orders_products.group_orders_products_id 
                FROM kshopina.group_orders_records inner join kshopina.group_orders_products 
                on group_orders_records.order_id = group_orders_products.order_id where
                group_id= ? and group_orders_records.case_name="Join" ) as data 
                on data.order_id = group_orders.group_orders_id where active =0 ;', [$group_number_id]);

         return $data;
    }

    public function export_group_data($group_number_id){

        
        $titles = ['A' => 'Order Number', 'B' => "Customer's Name" , 'C' => 'Email'
        , 'D' => 'CUST. ADDRESS', 'E' => 'Number' 
        , 'F' => 'Product Name', 'G' => 'Qty' , 'H' => 'PRICE' 
        , 'I' => ' TOTAL PRICE '  ,'J' => 'Delivery Status'];

       /*  $status = ['Verified', 'Fulfilled', 'Dispatched', 'In Warehouse', 'Out for delivery', 'Delivered', 'Refused', 'Canceled']; */
        $status = ['Pending', 'Awaiting', 'Confirmed', 'Canceled'];

        $data_of_group= $this->get_group_order_data($group_number_id);

        $numoforders = count($data_of_group);
        $row_1 = 2;
       


        $spreadsheet1 = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $spreadsheet1->getActiveSheet()->setTitle('G'.$group_number_id);

        foreach ($titles as $key => $value) {
            $spreadsheet1->getActiveSheet()->setCellValue($key . '1', $value);
        }


        for ($row = 0; $row < $numoforders; $row++) {
           
            if ( $row > 0 && $data_of_group[$row]->order_id == $data_of_group[$row-1]->order_id   ) {
                $data[0] = '';
                $data[1] = '';
                $data[2] = '';

                $data[3] = '';
                $data[4] = '';

                $data[5] = $data_of_group[$row]->product_name;
                $data[6] = $data_of_group[$row]->product_qty;
                $data[7] = $data_of_group[$row]->product_price;

                $data[8] = $data_of_group[$row]->product_qty * $data_of_group[$row]->product_price;

                $data[9] = '';
               

            } else {
                $data[0] = $data_of_group[$row]->order_id;
                $data[1] = $data_of_group[$row]->customer_name;
                $data[2] = $data_of_group[$row]->email;

                $data[3] = $data_of_group[$row]->city .'//'. $data_of_group[$row]->address;
                $data[4] = $data_of_group[$row]->contact_number;

                $data[5] = $data_of_group[$row]->product_name;
                $data[6] = $data_of_group[$row]->product_qty;
                $data[7] = $data_of_group[$row]->product_price;

                $data[8] = ($data_of_group[$row]->product_qty * $data_of_group[$row]->product_price) .'+'. $data_of_group[$row]->shipping_rate . '=' .
                 (($data_of_group[$row]->product_qty * $data_of_group[$row]->product_price) + $data_of_group[$row]->shipping_rate ) ;

                $data[9] = $status[$data_of_group[$row]->status];

                
            }



            $col = array_keys($titles);
            
            for ($i = 0; $i < count($data); $i++) {
                
                $spreadsheet1->getActiveSheet()->setCellValue($col[$i] . $row_1, $data[$i]);

            }

            $row_1++;
        }

        $name = date('Y-m-d--h-i-sa');
        $writer = new Xlsx($spreadsheet1);

        if (!file_exists(public_path('uploads/group_orders_reports' ))) {
            mkdir(public_path('uploads/group_orders_reports'), 0777, true);
        }

        $writer->save(public_path('/uploads/group_orders_reports' . '/file' . $name . '.xlsx'));
        unset($reader);

        return $name;
    }

}


/* $member_data = DB::select('SELECT group_orders_products.product_name , group_orders_products.product_price , group_orders_products.product_qty ,
group_orders.email , group_orders.email , group_orders.city , group_orders.shipping_rate ,
group_orders.final_price , group_orders.customer_name , group_orders.contact_number ,
group_orders.address , group_orders.created_at , group_orders.status ,
group_orders.customer_rank , group_orders.active , group_orders.group_id , group_orders.group_city_id , group_orders.group_orders_id
FROM group_orders
INNER JOIN group_orders_products ON group_orders.group_orders_id = group_orders_products.order_id
where group_id = ? AND group_city_id = ? ', [$group->group_id , $group-> group_city_id]); */
