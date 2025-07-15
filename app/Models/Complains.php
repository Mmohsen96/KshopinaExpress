<?php

namespace App\Models;
use App\Mail\WrongItemMail;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class Complains extends Model
{
    use HasFactory;

    public function save_complain($all_data)
    {
       /*  date_default_timezone_set('Asia/Seoul'); */
       date_default_timezone_set('Africa/Cairo');

        $date = date('Y-m-d H:i:s', time());

        $id= DB::table('complains')->insertGetId([
            'name' => $all_data['name'],
            'order_number' => $all_data['order_number'],
            'email' => $all_data['email'],
            'whatsapp' => $all_data['whatsapp'],
            'complain' => $all_data['complains'],
            'message' => $all_data['other_message'],
            'country' => $all_data['country'],
            'saved_at' => $date,
            'assign' => $all_data['assign'], 'solved' => 0,
        ]);

        $bytes = random_bytes(20);
        $token = bin2hex($bytes) . $id;

        DB::table('complains')->where('id',$id)->update(['token'=>$token]);

        return [$id,$token];
        /* insert(
        'insert into complains
        (name,order_number,email,whatsapp,complain,message,country,saved_at,assign,solved)
        values (?,?,?,?,?,?,?,?,?,?)',
        [$all_data['name'], $all_data['order_number'], $all_data['email'], $all_data['whatsapp'], $all_data['complains'], $all_data['other_message'],$all_data['country'], $date,$all_data['assign'], 0]
        ); */
    }

    public function getComplains($page, $rule)
    {   

        $complains_per_page = 15;
        $offset = ($page - 1) * $complains_per_page;

        if ($rule == "All") {
            $complains = DB::select('SELECT * from complains where solved = 0 And active = 0 AND special_case = 0 AND complaint_side = 1 LIMIT ?, ? ;', [$offset, $complains_per_page]);
            $number_of_complains = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM kshopina.complains where solved = 0 And active = 0 AND special_case = 0 AND complaint_side = 1;');
        } 
        elseif ($rule == "cancel_order") {
            $complains = DB::select('SELECT * from complains where solved = 0 And active = 0 and complain = "Cancel order" LIMIT ?, ?;', [$offset, $complains_per_page]);
            $number_of_complains = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM kshopina.complains where solved = 0 And active = 0 and complain =  "Cancel order" ;');
        } 
        elseif ($rule == "reschedule") {
            $complains = DB::select('SELECT * from complains where solved = 0 And active = 0 and complain = "Rescheduling" LIMIT ?, ?;', [$offset, $complains_per_page]);
            $number_of_complains = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM kshopina.complains where solved = 0 And active = 0 and complain =  "Rescheduling";');
        } 
        elseif ($rule == "no_response") {
            $complains = DB::select('SELECT * from complains where solved = 0 And active = 0 and complain = "No response or late delivery" LIMIT ?, ?;', [$offset, $complains_per_page]);
            $number_of_complains = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM kshopina.complains where solved = 0 And active = 0 and complain =  "No response or late delivery" ;');
        } 
        elseif ($rule == "customer_others") {
            $complains = DB::select('SELECT * from complains where solved = 0 And active = 0 and complain = "customer_others" LIMIT ?, ?;', [$offset, $complains_per_page]);
            $number_of_complains = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM kshopina.complains where solved = 0 and complain = "customer_others" And active = 0;');
        }
        elseif ($rule == "ask_about_product") {
            $complains = DB::select('SELECT * from complains where solved = 0 And active = 0 and complain = "Inquire about product" LIMIT ?, ?;', [$offset, $complains_per_page]);
            $number_of_complains = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM kshopina.complains where solved = 0 And active = 0 and complain = "Inquire about product" ;');
        }
        elseif ($rule == "Others") {
            $complains = DB::select('SELECT * from complains where solved = 0 And active = 0 and complain = "guest_others" LIMIT ?, ?;', [$offset, $complains_per_page]);
            $number_of_complains = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM kshopina.complains where solved = 0 And active = 0 and complain = "guest_others" ;');
        } else {
            $complains = DB::select('SELECT * from complains where solved = 0 And active = 0 LIMIT ?, ?;', [$offset, $complains_per_page]);
            $number_of_complains = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM kshopina.complains where active = 0;');
        }
        
        $cancel_order = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM kshopina.complains where complain =  "Cancel order" And active = 0;');
        $reschedule = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM kshopina.complains where complain =  "Rescheduling" And active = 0; ');
        $no_response = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM kshopina.complains where complain =  "No response or late delivery" And active = 0; ');
        $customer_others = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM kshopina.complains where complain =  "customer_others" And active = 0;');
        $ask_about_product = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM kshopina.complains where complain =  "Inquire about product" And active = 0;');
        $Others = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM kshopina.complains where complain =  "guest_others" And active = 0;');


        $all_solved = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM kshopina.complains where solved = 1 And active = 0;');
        $all_not_solved = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM kshopina.complains where solved = 0 And active = 0;');

        return [$number_of_complains, $complains, $cancel_order, $reschedule, $no_response, $customer_others, $ask_about_product, $Others, $all_solved,$all_not_solved];
    }
    
    public function getComplains_archived($page, $rule)
    {

        $complains_per_page = 15;
        $offset = ($page - 1) * $complains_per_page;

        if ($rule == "All") {
            $complains = DB::select('SELECT * from complains where solved = 1 And active = 0  order by solved_at DESC LIMIT ?, ? ;', [$offset, $complains_per_page]);
            $number_of_complains = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM kshopina.complains where solved = 1 And active = 0;');
        } 
        elseif ($rule == "cancel_order") {
            $complains = DB::select('SELECT * from complains where solved = 1 And active = 0 and complain = "Cancel order" order by solved_at DESC LIMIT ?, ?;', [$offset, $complains_per_page]);
            $number_of_complains = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM kshopina.complains where solved = 1 And active = 0 and complain =  "Cancel order" ;');
        } 
        elseif ($rule == "reschedule") {
            $complains = DB::select('SELECT * from complains where solved = 1 And active = 0 and complain = "Rescheduling" order by solved_at DESC LIMIT ?, ?;', [$offset, $complains_per_page]);
            $number_of_complains = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM kshopina.complains where solved = 1 And active = 0 and complain =  "Rescheduling"');
        } 
        elseif ($rule == "no_response") {
            $complains = DB::select('SELECT * from complains where solved = 1 And active = 0 and complain = "No response or late delivery" order by solved_at DESC LIMIT ?, ?;', [$offset, $complains_per_page]);
            $number_of_complains = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM kshopina.complains where solved = 1 And active = 0 and complain =  "No response or late delivery"');
        } 
        elseif ($rule == "customer_others") {
            $complains = DB::select('SELECT * from complains where solved = 1 And active = 0 and complain = "customer_others" order by solved_at DESC LIMIT ?, ?;', [$offset, $complains_per_page]);
            $number_of_complains = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM kshopina.complains where solved = 1 and complain = "customer_others" And active = 0');
        }
        elseif ($rule == "ask_about_product") {
            $complains = DB::select('SELECT * from complains where solved = 1 And active = 0 and complain = "Inquire about product" order by solved_at DESC LIMIT ?, ?;', [$offset, $complains_per_page]);
            $number_of_complains = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM kshopina.complains where solved = 1 And active = 0 and complain = "Inquire about product" ');
        }
        elseif ($rule == "Others") {
            $complains = DB::select('SELECT * from complains where solved = 1 And active = 0 and complain = "guest_others" order by solved_at DESC LIMIT ?, ?;', [$offset, $complains_per_page]);
            $number_of_complains = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM kshopina.complains where solved = 1 And active = 0 and complain = "guest_others";');
        } else {
            $complains = DB::select('SELECT * from complains where solved = 1 And active = 0 order by solved_at DESC LIMIT ?, ?;', [$offset, $complains_per_page]);
            $number_of_complains = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM kshopina.complains where active = 0');
        }
        
        $cancel_order = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM kshopina.complains where complain =  "Cancel order" And active = 0;');
        $reschedule = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM kshopina.complains where complain =  "Rescheduling" And active = 0; ');
        $no_response = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM kshopina.complains where complain =  "No response or late delivery" And active = 0; ');
        $customer_others = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM kshopina.complains where complain =  "customer_others" And active = 0;');
        $ask_about_product = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM kshopina.complains where complain =  "Inquire about product" And active = 0;');
        $Others = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM kshopina.complains where complain =  "guest_others" And active = 0;');


        $all_solved = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM kshopina.complains where solved = 1 And active = 0;');
        $all_not_solved = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM kshopina.complains where solved = 1 And active = 0;');


        return [$number_of_complains, $complains, $cancel_order, $reschedule, $no_response, $customer_others, $ask_about_product, $Others, $all_solved,$all_not_solved];
    }

    public function getSpecialComplains($page, $rule)
    {

        $complains_per_page = 15;
        $offset = ($page - 1) * $complains_per_page;
        $complaints="(";

        if ($rule == "All") {
            $complains = DB::select('SELECT * from complains where solved = 0 And active = 0 AND special_case =1 LIMIT ?, ? ;', [$offset, $complains_per_page]);

            foreach ($complains as $key => $complain) {
                $complaints = $complaints. $complain->id . ',';
            }

            $complaints[strlen($complaints)-1] = ")";

            if ($complaints == ')') {
                $complaints_files =[];
            }else{
                $complaints_files=DB::select('SELECT  * FROM kshopina.complaint_files
                right JOIN kshopina.complains
                ON complains.id = complaint_files.complaint_id where complains.special_case = 1 and solved = 0 And active = 0 and complaint_id in '.$complaints );
            }

            $number_of_complains = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM kshopina.complains where solved = 0 And active = 0 AND special_case =1;');

            
        } 
        
        
        $cancel_order = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM kshopina.complains where complain =  "Cancel order" And active = 0;');
        $reschedule = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM kshopina.complains where complain =  "Rescheduling" And active = 0; ');
        $no_response = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM kshopina.complains where complain =  "No response or late delivery" And active = 0; ');
        $customer_others = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM kshopina.complains where complain =  "customer_others" And active = 0;');
        $ask_about_product = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM kshopina.complains where complain =  "Inquire about product" And active = 0;');
        $Others = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM kshopina.complains where complain =  "guest_others" And active = 0;');


        $all_solved = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM kshopina.complains where solved = 1 And active = 0;');
        $all_not_solved = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM kshopina.complains where solved = 0 And active = 0;');

        return [$number_of_complains, $complains, $cancel_order, $reschedule, $no_response, $customer_others, $ask_about_product, $Others, $all_solved,$all_not_solved,$complaints_files];
    }

    public function get_CS_Complains($page, $rule){

        $complains_per_page = 15;
        $offset = ($page - 1) * $complains_per_page;

        if ($rule == "All") {
            $complains = DB::select('SELECT * from complains where solved = 0 And active = 0 AND complaint_side = 0 LIMIT ?, ? ;', [$offset, $complains_per_page]);
            $number_of_complains = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM kshopina.complains where solved = 0 And active = 0 AND complaint_side = 0;');
        } 

        $cancel_order = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM kshopina.complains where complain =  "Cancel order" And active = 0;');
        $reschedule = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM kshopina.complains where complain =  "Rescheduling" And active = 0; ');
        $no_response = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM kshopina.complains where complain =  "No response or late delivery" And active = 0; ');
        $customer_others = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM kshopina.complains where complain =  "customer_others" And active = 0;');
        $ask_about_product = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM kshopina.complains where complain =  "Inquire about product" And active = 0;');
        $Others = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM kshopina.complains where complain =  "guest_others" And active = 0;');


        $all_solved = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM kshopina.complains where solved = 1 And active = 0;');
        $all_not_solved = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM kshopina.complains where solved = 0 And active = 0;');

        return [$number_of_complains, $complains, $cancel_order, $reschedule, $no_response, $customer_others, $ask_about_product, $Others, $all_solved,$all_not_solved];
    }

    public function solved($order_id)
    {
        DB::update('update complains set solved = 1 where id = ?', [$order_id]);
    }
    public function insert_complaint_reply($id, $reply, $solved, $replied_by)
    {
        date_default_timezone_set('Africa/Cairo');
        $now = date('Y-m-d H:i:s', time());

        DB::insert(
            'insert into complaints_replies (complaint_number, reply,replied_by,replied_at,side) values (?,?,?,?,?)',
            [
                $id,
                $reply,
                $replied_by,
                $now,
                0,
            ]
        );

        if ($solved == 1) {
            DB::table('complains')->where('id', $id)->update(['solved' => 1, 'solved_by' => $replied_by, 'solved_at' => $now]);
        }

        return DB::select('select * from complains where id = ?', [$id]);
    }
    public function get_complaint_replies($complaint_number,$complaint)
    {
        $complaint_with_replay=DB::select('SELECT complains.special_case, complains.saved_at, complains.rating, complains.message, complains.solved, complains.complaint_side ,
        complaints_replies.reply ,complaints_replies.replied_at ,complains.id ,complaints_replies.side ,complains.order_number,complains.complain
        FROM complains
        INNER JOIN complaints_replies
        ON complains.id = complaints_replies.complaint_number WHERE complains.id=?', [$complaint_number]);

        if ($complaint_with_replay== [] || $complaint_with_replay ==null) {
            return $complaint;
        } else {

            return $complaint_with_replay;
        }
        
    }
    public function insert_customer_complaint_reply($data)
    {
        $complain=DB::select('select * from complains where id = ?', [$data['id']]);

        if ($complain[0]->solved==1) {
            return false;
        } else {
            DB::insert(
                'insert into complaints_replies (complaint_number, reply,replied_by,replied_at,side) values (?,?,?,?,?)',
                [
                    $data['id'],
                    $data['customer_reply'],
                    'customer',
                    $data['replied_at'],
                    1,
                ]
            );
            //nour
            DB::table('complains')->where('id', $data['id'])->update(['seen' => 0]);
            return true;
        }
    }		
    public function validate_complaint_url($id,$token)
    {
        $complain=DB::select('SELECT * from complains where id = ? AND token=? AND active = 0', [$id,$token]);

        if ($complain==[] || $complain==null) {
            return [false,[]];
        } else {
            return[true,$complain];
        }
        
    }
    
    public function send_rating($data)
    {

        DB::table('complains')->where('id', $data['complaint_num'])->update(['rating' => $data['rate']]);

    }

    public function get_replies($id)
    {
      
        return DB::select('select * from complaints_replies where complaint_number = ?', [$id]);
    }
    //nour
    public function update_to_seen($id,$seen){

        DB::table('complains')->where('id', $id)->update(['seen' => $seen]);
       
    }	

    public function get_dicounts()
    {
       
        return DB::select('SELECT * from discounts where deleted =0 ');
    }

    public function get_active_dicounts()
    {
       
        return DB::select('SELECT * from discounts where deleted =0 AND active = 1; ');
    }

    public function update_discounts($ids,$discount_code,$percent,$active,$deleted)
    {
        date_default_timezone_set('Africa/Cairo');
        $date = date('Y-m-d H:i:s', time());

        if (count($deleted) !=0) {
            foreach ($deleted as $key => $id) {
                if ($id !='none') {
                    DB::table('discounts')->where('id',$id)->update(['deleted'=>1,'updated_at'=>$date, 'updated_by'=>Auth::user()->name]);
                }
            }
        }

        foreach ($ids as $index => $id) {
            if ($id != 'none') {
                if (in_array($id,$active)) {
                    DB::table('discounts')->where('id',$id)->update([
                    'discount_code'=>$discount_code[$index],'discount_percent'=>$percent[$index],'active'=>1,'updated_at'=>$date ,'updated_by'=>Auth::user()->name]);
                }
                else {
                    DB::table('discounts')->where('id',$id)->update([
                    'discount_code'=>$discount_code[$index],'discount_percent'=>$percent[$index],'active'=>0,'updated_at'=>$date ,'updated_by'=>Auth::user()->name]);
                }
                
            }else{
                if (in_array($id,$active)) {
                    DB::insert('INSERT into discounts (discount_code, discount_percent,active,created_at, created_by values (?, ?,?, ? ,?)',
                     [$discount_code[$index], $percent[$index] ,1 ,$date ,Auth::user()->name ]);
                }
                else {
                    DB::insert('INSERT into discounts (discount_code, discount_percent,active,created_at , created_by ) values (?, ?,?, ?,?)',
                     [$discount_code[$index],$percent[$index],0,$date,Auth::user()->name]);
                }
            }
        }
    }

    public function get_services_payments()
    {
        return DB::select('SELECT * from services_payments where deleted =0 ');
    }

    public function update_services_payments($ids,$country,$cod,$pre_paid,$active,$deleted)
    {
        
        date_default_timezone_set('Africa/Cairo');
        $date = date('Y-m-d H:i:s', time());

        if (count($deleted) !=0) {
            foreach ($deleted as $key => $id) {
                if ($id !='none') {
                    DB::table('services_payments')->where('id',$id)->update(['deleted'=>1,'updated_at'=>$date, 'updated_by'=>Auth::user()->name]);
                }
            }
        }

        foreach ($ids as $index => $id) {
            if ($id != 'none') {

                    if (in_array($id,$active)) {

                        if ( in_array($id,$cod) && !in_array($id,$pre_paid ) ){
                        
                            DB::table('services_payments')->where('id',$id)->update([
                                'country'=>$country[$index],'cod'=>1,'pre_paid'=>0,'active'=>1,'updated_at'=>$date ,'updated_by'=>Auth::user()->name]);

                        }else if( in_array($id,$pre_paid) && !in_array($id,$cod) ){

                            DB::table('services_payments')->where('id',$id)->update([
                                'country'=>$country[$index],'pre_paid'=>1,'cod'=>0,'active'=>1,'updated_at'=>$date ,'updated_by'=>Auth::user()->name]);

                        }else if(in_array($id,$pre_paid) && in_array($id,$cod) ){

                            DB::table('services_payments')->where('id',$id)->update([
                                'country'=>$country[$index],'cod'=>1,'pre_paid'=>1,'active'=>1,'updated_at'=>$date ,'updated_by'=>Auth::user()->name]);

                        }else{

                            DB::table('services_payments')->where('id',$id)->update([
                                'country'=>$country[$index],'active'=>1,'updated_at'=>$date ,'updated_by'=>Auth::user()->name]);

                        }
                        
                    }
                else{

                    if ( in_array($id,$cod) && !in_array($id,$pre_paid ) ){
                       
                        DB::table('services_payments')->where('id',$id)->update([
                            'country'=>$country[$index],'cod'=>1,'pre_paid'=>0,'updated_at'=>$date ,'updated_by'=>Auth::user()->name]);

                    }else if( in_array($id,$pre_paid) && !in_array($id,$cod) ){

                        DB::table('services_payments')->where('id',$id)->update([
                            'country'=>$country[$index],'pre_paid'=>1,'cod'=>0,'updated_at'=>$date ,'updated_by'=>Auth::user()->name]);

                    }else if(in_array($id,$pre_paid) && in_array($id,$cod) ){

                        DB::table('services_payments')->where('id',$id)->update([
                            'country'=>$country[$index],'cod'=>1,'pre_paid'=>1,'updated_at'=>$date ,'updated_by'=>Auth::user()->name]);

                    }else{

                        DB::table('services_payments')->where('id',$id)->update([
                            'country'=>$country[$index],'updated_at'=>$date ,'updated_by'=>Auth::user()->name]);

                    }

                }
                
            }else{

                if (in_array($id,$active)) {

                    if ( in_array($id,$cod) && !in_array($id,$pre_paid ) ){

                        DB::insert('INSERT into services_payments (country, cod,active,created_at, created_by) values (?, ?,?, ? ,?)',
                        [$country[$index], 1 ,1 ,$date ,Auth::user()->name ]);

                    }else if( in_array($id,$pre_paid) && !in_array($id,$cod) ){

                        DB::insert('INSERT into services_payments (country, pre_paid,active,created_at, created_by) values (?, ?,?, ? ,?)',
                        [$country[$index], 1 ,1 ,$date ,Auth::user()->name ]);

                    }else if(in_array($id,$pre_paid) && in_array($id,$cod) ){
                        DB::insert('INSERT into services_payments (country, cod, pre_paid,active,created_at, created_by) values (?, ?,?, ? ,?,?)',
                        [$country[$index], 1 , 1 , 1 ,$date ,Auth::user()->name ]);

                    }else{
                        DB::insert('INSERT into services_payments (country,active,created_at, created_by) values (?,?, ? ,?)',
                        [$country[$index] ,1 ,$date ,Auth::user()->name ]);
                    }

                }
                else {

                    if ( in_array($id,$cod) && !in_array($id,$pre_paid ) ){

                        DB::insert('INSERT into services_payments (country, cod,created_at, created_by) values (?, ?,?, ?)',
                        [$country[$index], 1 ,$date , Auth::user()->name ]);

                    }else if( in_array($id,$pre_paid) && !in_array($id,$cod) ){

                        DB::insert('INSERT into services_payments (country, pre_paid,created_at, created_by) values (?, ?,?, ?)',
                        [$country[$index], 1 ,$date , Auth::user()->name ]);

                    }else if(in_array($id,$pre_paid) && in_array($id,$cod) ){
                        DB::insert('INSERT into services_payments (country, cod, pre_paid,created_at, created_by) values (?, ?,?, ? ,?)',
                        [$country[$index], 1 , 1  ,$date , Auth::user()->name ]);

                    }else{
                        DB::insert('INSERT into services_payments (country , created_at, created_by)  values (?,?, ? )',
                        [ $country[$index]  , $date , Auth::user()->name ]);
                    }
                  
                }
            }
        }


    }
    
    public function create_new_complaint($complaint_type,$data)
    {
        $email='';

        if ($complaint_type =='request_to_cancel') {
            
            $order_data=DB::select('select * from orders where order_number = ?', [$data]);
            foreach ($order_data as $order) {
                date_default_timezone_set('Asia/Seoul');
                $date = date('Y-m-d H:i:s', time());

                $id= DB::table('complains')->insertGetId([
                    'name' => $order->name,
                    'order_number' => $order->order_number,
                    'email' => $order->email,
                    'whatsapp' =>$order->phone_number,
                    'complain' => 'Cancel order',
                    'country' => $order->country,
                    'saved_at' => $date,
                    'solved' => 0,
                ]);

                $bytes = random_bytes(20);
                $token = bin2hex($bytes) . $id;

                DB::table('complains')->where('id',$id)->update(['token'=>$token]);

                $email=$order->email;
                return [$id,$token,$email];
            }
        } 
        elseif($complaint_type =='reschedule') {
            
            $order_data=DB::select('select * from orders where order_number = ?', [$data[0]]);
            foreach ($order_data as $order) {
                date_default_timezone_set('Asia/Seoul');
                $date = date('Y-m-d H:i:s', time());

                $id= DB::table('complains')->insertGetId([
                    'name' => $order->name,
                    'order_number' => $order->order_number,
                    'email' => $order->email,
                    'whatsapp' =>$order->phone_number,
                    'complain' => 'Rescheduling',
                    'message' => $data[1],
                    'country' => $order->country,
                    'saved_at' => $date,
                    'solved' => 0,
                ]);

                $bytes = random_bytes(20);
                $token = bin2hex($bytes) . $id;

                DB::table('complains')->where('id',$id)->update(['token'=>$token]);

                $email=$order->email;

                return [$id,$token,$email];
             }
        
        }
        elseif($complaint_type =='lmd_or_late') {

            $order_data=DB::select('select * from orders where order_number = ?', [$data[0]]);
            foreach ($order_data as $order) {
                date_default_timezone_set('Asia/Seoul');
                $date = date('Y-m-d H:i:s', time());

                $id= DB::table('complains')->insertGetId([
                    'name' => $order->name,
                    'order_number' => $order->order_number,
                    'email' => $order->email,
                    'whatsapp' =>$order->phone_number,
                    'complain' => 'No response or late delivery',
                    'message' => $data[1],
                    'country' => $order->country,
                    'saved_at' => $date,
                    'solved' => 0,
                ]);

                $bytes = random_bytes(20);
                $token = bin2hex($bytes) . $id;

                DB::table('complains')->where('id',$id)->update(['token'=>$token]);

                $email=$order->email;

                return [$id,$token,$email];
             }
        }
        elseif($complaint_type =='customer_others') {

            $order_data=DB::select('select * from orders where order_number = ?', [$data[0]]);
            foreach ($order_data as $order) {
                date_default_timezone_set('Asia/Seoul');
                $date = date('Y-m-d H:i:s', time());

                $id= DB::table('complains')->insertGetId([
                    'name' => $order->name,
                    'order_number' => $order->order_number,
                    'email' => $order->email,
                    'whatsapp' =>$order->phone_number,
                    'complain' => 'customer_others',
                    'message' => $data[1],
                    'country' => $order->country,
                    'saved_at' => $date,
                    'solved' => 0,
                ]);

                $bytes = random_bytes(20);
                $token = bin2hex($bytes) . $id;

                DB::table('complains')->where('id',$id)->update(['token'=>$token]);

                $email=$order->email;

                return [$id,$token,$email];
             }
        }
        elseif($complaint_type =='ask_about_product') {

            date_default_timezone_set('Asia/Seoul');
            $date = date('Y-m-d H:i:s', time());

            $id= DB::table('complains')->insertGetId([
                'name' => $data['user_name'],
                'email' => $data['email'],
                'whatsapp' =>$data['phone_number'],
                'complain' => 'Inquire about product',
                'message' => $data['message'],
                'country' => $data['country'],
                'saved_at' => $date,
                'solved' => 0,
            ]);

            $bytes = random_bytes(20);
            $token = bin2hex($bytes) . $id;

            DB::table('complains')->where('id',$id)->update(['token'=>$token]);

            $email=$data['email'];

            return [$id,$token,$email];
        }
        elseif($complaint_type =='guest_others') {

            date_default_timezone_set('Asia/Seoul');
            $date = date('Y-m-d H:i:s', time());

            $id= DB::table('complains')->insertGetId([
                'name' => $data['user_name'],
                'email' => $data['email'],
                'whatsapp' =>$data['phone_number'],
                'complain' => 'guest_others',
                'message' => $data['message'],
                'country' => $data['country'],
                'saved_at' => $date,
                'solved' => 0,
            ]);

            $bytes = random_bytes(20);
            $token = bin2hex($bytes) . $id;

            DB::table('complains')->where('id',$id)->update(['token'=>$token]);

            $email=$data['email'];

            return [$id,$token,$email];
        }
    }

    public function get_order_details($id)
    {
        $order_details = DB::select('SELECT orders.id , orders.order_number , orders.name , orders.total_price , orders.phone_number , orders.email ,
        orders.city  , orders.country , orders.address , orders.apartment ,
        orders.province  , orders.gateway , orders.status ,
        items.id , items.order_id , items.product_name , items. quantity  
        FROM kshopina.orders
        INNER JOIN kshopina.items
        ON orders.order_number = items.order_id 
        WHERE orders.order_number = ?;',[$id]);
        
        return  $order_details;

    }
    
    public function get_complaint_database_search($page, $rule , $complaint_id)
    {
        $complains_per_page = 15;
        $offset = ($page - 1) * $complains_per_page;


        if ($rule  != 'All') {
            $complains = DB::select('SELECT * from complains where solved = 0 and id=? and complain =? LIMIT ?, ?;', [$complaint_id , $rule , $offset ,$complains_per_page]);
            $number_of_complains = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM kshopina.complains where solved = 0 and id=? ;' , [$complaint_id]);
        } else {
            $complains = DB::select('SELECT * from complains where solved = 0 and id=?  LIMIT ?, ?;', [$complaint_id ,  $offset ,$complains_per_page]);
            $number_of_complains = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM kshopina.complains where solved = 0 and id=? ; ' , [$complaint_id]);
        }
        
        $cancel_order = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM kshopina.complains where complain =  "Cancel order" ;');
        $reschedule = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM kshopina.complains where complain =  "Rescheduling";');
        $no_response = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM kshopina.complains where complain =  "No response or late delivery" ;');
        $customer_others = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM kshopina.complains where complain =  "customer_others" ;');
        $ask_about_product = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM kshopina.complains where complain =  "Inquire about product" ;');
        $Others = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM kshopina.complains where complain =  "guest_others" ;');


        $all_solved = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM kshopina.complains where solved = 1 ;');
        $all_not_solved = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM kshopina.complains where solved = 0 ;');

        return [$number_of_complains, $complains, $cancel_order, $reschedule, $no_response, $customer_others, $ask_about_product, $Others, $all_solved,$all_not_solved];
    }
    public function get_archived_complaint_database_search($page, $rule , $complaint_id)
    {

        $complains_per_page = 15;
        $offset = ($page - 1) * $complains_per_page;

        if ($rule  != 'All') {
            $complains = DB::select('SELECT * from complains where solved = 1  and id=? LIMIT ?, ?;', [$complaint_id , $offset ,$complains_per_page]);
            $number_of_complains = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM kshopina.complains where solved = 1  and id=? ;' , [$complaint_id]);
        } else {
            $complains = DB::select('SELECT * from complains where solved = 1 and id=?  LIMIT ?, ?;', [$complaint_id ,  $offset ,$complains_per_page]);
            $number_of_complains = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM kshopina.complains where solved = 1  and id=? ; ' , [$complaint_id]);
        }
        
        $cancel_order = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM kshopina.complains where complain =  "Cancel order" ;');
        $reschedule = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM kshopina.complains where complain =  "Rescheduling";');
        $no_response = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM kshopina.complains where complain =  "No response or late delivery" ;');
        $customer_others = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM kshopina.complains where complain =  "customer_others" ;');
        $ask_about_product = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM kshopina.complains where complain =  "Inquire about product" ;');
        $Others = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM kshopina.complains where complain =  "guest_others" ;');


        $all_solved = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM kshopina.complains where solved = 1 ;');
        $all_not_solved = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM kshopina.complains where solved = 0 ;');

        return [$number_of_complains, $complains, $cancel_order, $reschedule, $no_response, $customer_others, $ask_about_product, $Others, $all_solved,$all_not_solved];
    }

    public function get_special_complaint_database_search($page, $rule , $complaint_id)
    {

        $complains_per_page = 15;
        $offset = ($page - 1) * $complains_per_page;
        $complaints="(";

        if ($rule  == 'All') {
            $complains = DB::select('SELECT * from complains where id= ? AND solved = 0 And active = 0  LIMIT ?, ?;', [$complaint_id , $offset ,$complains_per_page]);

            foreach ($complains as $key => $complain) {
                $complaints = $complaints. $complain->id . ',';
            }

            $complaints[strlen($complaints)-1] = ")";

            if ($complaints == ')') {
                $complaints_files =[];
            }else{
                $complaints_files=DB::select('SELECT  * FROM kshopina.complaint_files
                right JOIN kshopina.complains
                ON complains.id = complaint_files.complaint_id where complains.special_case = 1 and solved = 0 And active = 0 and complaint_id in '.$complaints );
            }


            $number_of_complains = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM kshopina.complains where solved = 0 And active = 0 and id=? ;' , [$complaint_id]);
        } 
        
        $cancel_order = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM kshopina.complains where complain =  "Cancel order" ;');
        $reschedule = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM kshopina.complains where complain =  "Rescheduling";');
        $no_response = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM kshopina.complains where complain =  "No response or late delivery" ;');
        $customer_others = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM kshopina.complains where complain =  "customer_others" ;');
        $ask_about_product = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM kshopina.complains where complain =  "Inquire about product" ;');
        $Others = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM kshopina.complains where complain =  "guest_others" ;');


        $all_solved = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM kshopina.complains where solved = 1 ;');
        $all_not_solved = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM kshopina.complains where solved = 0 ;');

        return [$number_of_complains, $complains, $cancel_order, $reschedule, $no_response, $customer_others, $ask_about_product, $Others, $all_solved,$all_not_solved ,$complaints_files];
    }
    

    public function search_complaints($content,$filter)
    {
        $value = $content . '%';

        if ($filter == 1) {
            return DB::select('SELECT * FROM complains WHERE  order_number LIKE "' . $value . '"  ');
        } elseif($filter == 2) {
            return DB::select('SELECT * FROM complains WHERE   id LIKE "' . $value . '"  ');
        }
    }

    public function get_faqs_question()
    {

        return DB::select('SELECT * from faqs where deleted =0 ');

    }

    public function get_active_faqs_question()
    {

        return DB::select('SELECT * from faqs where deleted =0 AND active =1;');

    }

    public function update_faqs_question($ids,$questions,$answers,$active,$deleted){


        date_default_timezone_set('Africa/Cairo');
        $date = date('Y-m-d H:i:s', time());

        if (count($deleted) !=0) {
            foreach ($deleted as $key => $id) {
                if ($id !='none') {
                    DB::table('faqs')->where('id',$id)->update(['deleted'=>1,'updated_at'=>$date, 'updated_by'=>Auth::user()->name]);
                }
            }
        }

        foreach ($ids as $index => $id) {
            if ($id != 'none') {
                if (in_array($id,$active)) {
                    DB::table('faqs')->where('id',$id)->update([
                    'question'=>$questions[$index],'answer'=>$answers[$index],'active'=>1,'updated_at'=>$date ,'updated_by'=>Auth::user()->name]);
                }
                else {
                    DB::table('faqs')->where('id',$id)->update([
                    'question'=>$questions[$index],'answer'=>$answers[$index],'active'=>0,'updated_at'=>$date ,'updated_by'=>Auth::user()->name]);
                }
                
            }else{
                if (in_array($id,$active)) {
                    DB::insert('INSERT into faqs (question, answer,active,added_at, added_by values (?, ?,?, ? ,?)',
                     [$questions[$index], $answers[$index] ,1 ,$date ,Auth::user()->name ]);
                }
                else {
                    DB::insert('INSERT into faqs (question, answer,active,added_at , added_by ) values (?, ?,?, ?,?)',
                     [$questions[$index],$answers[$index],0,$date,Auth::user()->name]);
                }
            }
        }

    }

    public function validate_complaint_token($complaint_id,$token){

        $check= DB::select('SELECT * from complains where id = ? AND token=?', [$complaint_id,$token]);

        if (count($check) ==0) {
            return [false,[]];
        }else{
            return [true,$check];
        }
    }
    public function validate_complaint_exist($complaint_id,$token){

        $check= DB::select('SELECT * from complains where id = ? AND token=? AND (complain LIKE "%Wrong%" OR complain LIKE "%Missing%" OR complain LIKE "%Damaged%") AND active=0', [$complaint_id,$token]);

        if (count($check) ==0) {
            return [false,[]];
        }else{
            return [true,$check];
        }
    }
    public function something_wrong_mail($order_number,$type){

        $order_data=DB::select('SELECT * from orders where order_number = ?', [$order_number]);
        $full_type="";

        try {
        
            if (count($order_data)!=0) {

                foreach ($type as $key => $value) {
                    if ($value != '0') {
                        if ($full_type=="") {
                            $full_type =$key;
                        }else{
                            $full_type =$full_type.'|'.$key;
                        }
                    }
                    
                }

                $check= DB::select('SELECT * from complains where order_number = ?  AND (complain LIKE "%Wrong%" OR complain LIKE "%Missing%" OR complain LIKE "%Damaged%") ;', [ $order_number]);


                    if ( count($check) > 0) {

                        return [false,"Order number has been requested before!"];

                    } else {

                        foreach ($order_data as $order) {

                            date_default_timezone_set('Africa/Cairo');
                            $date = date('Y-m-d H:i:s', time());
        
                            $id= DB::table('complains')->insertGetId([
                                'name' => $order->name,
                                'order_number' => $order->order_number,
                                'email' => $order->email,
                                'whatsapp' =>$order->phone_number,
                                'complain' => $full_type,
                                'country' => $order->country,
                                'saved_at' => $date,
                                'solved' => 0,
                                'active'=>1,
                                'special_case'=>1
                            ]);
        
                            $bytes = random_bytes(20);
                            $token = bin2hex($bytes) . $id;
                            ignore_user_abort();

                            DB::table('complains')->where('id',$id)->update(['token'=>$token]);
        
                        }
        
                        $data1 = [
                            'order_number' => $order_number,
                            'form_url'=>url('') . '/' . "special_order/".$id."?token=" . $token
                        ];
        
                        Mail::to($order_data[0]->email)->send(new WrongItemMail($data1), function ($message) {
                            $message->subject("Form");
                        });
        
                        return [true,"Success"];
                    }
                
            }else{
                return [false,"Order number doesn't exist"];
            }

        } catch (\Throwable $th) {
            DB::insert('insert into errors (shipment_number,message,system_name) values (?,?,?)', [$order_number, $th, "REQUEST_TO_SEND_SOMETHING_WRONG_FORM 2"]);
        }
    }

    public function add_complaint_files($complaint_id,$files,$types)
    {
        if (!file_exists(public_path('uploads/complaints'))) {
            mkdir(public_path('uploads/complaints'), 0777, true);
        }

        date_default_timezone_set('Africa/Cairo');
        $date = date('Y-m-d H:i:s', time());
        
        foreach ($files as $index => $file) {
            try {
                
                $imageName = date('YmdHis', time()) .$index.$complaint_id. '.' . explode(".", $file->getClientOriginalName())[1];
                
                DB::insert('insert into complaint_files (complaint_id,file_old_name,file_new_name, file_type,file_size,uploaded_at) values (?, ?,?, ?, ?,?)', 
                [$complaint_id,$file->getClientOriginalName(),$imageName,$types[$index],$file->getSize(),$date]);

                $file->move(public_path('uploads/complaints'), $imageName);

                
            } catch (\Throwable $th) {
                DB::insert('insert into errors (shipment_number,message,system_name) values (?,?,?)', [$complaint_id, $th, "Upload in complaints - ".$file->getClientOriginalName()]);

            }
            
        }
        
    }


    public function check_customer_email_exists($customer_email){

        return  DB::select('SELECT * from orders where email = ?  ;', [ $customer_email]);

    }

    public function check_order_with_email_exists($customer_email , $customer_order_number){

        return  DB::select('SELECT * from orders where email = ? and order_number = ?   ;', [$customer_email , $customer_order_number]);

    }

    public function save_complain_cs_side($all_data , $cs_message,$order_number)
    {

       date_default_timezone_set('Africa/Cairo');

        $date = date('Y-m-d H:i:s', time());

        if (empty($order_number)) {
            $id= DB::table('complains')->insertGetId([
                'name' => $all_data->name ,
                'email' => $all_data->email ,
                'complain' => NULL, 
                'message' => $cs_message,
                'country' => $all_data->country ,
                'saved_at' => $date,
                'solved' => 0,
                'complaint_side' => 0
            ]);
        }else{
            $id= DB::table('complains')->insertGetId([
                'name' => $all_data->name ,
                'order_number' => $all_data->order_number ,
                'email' => $all_data->email ,
                'complain' => NULL, 
                'message' => $cs_message,
                'country' => $all_data->country ,
                'saved_at' => $date,
                'solved' => 0,
                'complaint_side' => 0
            ]);
        }
        

        $bytes = random_bytes(20);
        $token = bin2hex($bytes) . $id;

        DB::table('complains')->where('id',$id)->update(['token'=>$token]);

        return [$id,$token];

    }


}

