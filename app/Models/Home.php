<?php

namespace App\Models;

use DateTime;
use App\Mail\mentionMail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\GroupOrders;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Mail;

class Home extends Model
{
    use HasFactory;

    public function get_country_currency()
    {

        $this->changeCurrency();
        $currency = DB::select('SELECT keyy,value,type ,id from config where id > ? AND id < ? ', [1, 10]);

        return [$currency];
    }
    public function order_like($value,$type)
    {
        if ($type == "tracking_no") {

            if (strtolower($value)[0]=='k' && strtolower($value)[1]=='s' && strtolower($value)[2]=='p' ) {

                $shipment = DB::select('SELECT * FROM kmex.shipments WHERE ksp_number = ? ;',[$value]);
                if (count($shipment) > 0) {
                    return [['tracking_url' => 'track/shipment?kspNumber='.$shipment[0]->ksp_number]];
                } else {
                    return [];
                }
                
            }else{
                return DB::select('SELECT tracking_url FROM orders WHERE kshopina_awb =? ;',[$value]);
            }

        } else {
            return DB::select('SELECT tracking_url FROM orders WHERE order_number =? ;',[$value]);
        }

    }
    public function group_order_like($value,$type)
    {
        $city =substr($value[0],1,2);
        $group_id=substr($value[0],3);

        $order_id=$value[1];

        $group= new GroupOrders();

        return [$group->get_group_records($city,$group_id),$group->validate_order_in_group($order_id,$city,$group_id)];

    }
    public function changeCurrency()
    {
        $sar = DB::table('config')->where('keyy', "SAR")->get();

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

            $this->updateCurrency($currency->quotes);
        }
    }
    public function updateCurrency($data)
    {

        date_default_timezone_set('Asia/Seoul');
        $date = date('Y-m-d H:i:s', time());

        DB::table('config')->where('keyy', 'SAR')->update(['type' => round($data->USDSAR, 2), 'update_date' => $date]);
        DB::table('config')->where('keyy', 'KWD')->update(['type' => round($data->USDKWD, 2), 'update_date' => $date]);
        DB::table('config')->where('keyy', 'JOD')->update(['type' => round($data->USDJOD, 2), 'update_date' => $date]);
        DB::table('config')->where('keyy', 'BHD')->update(['type' => round($data->USDBHD, 2), 'update_date' => $date]);
        DB::table('config')->where('keyy', 'OMR')->update(['type' => round($data->USDOMR, 2), 'update_date' => $date]);
        DB::table('config')->where('keyy', 'EGP')->update(['type' => round($data->USDEGP, 2), 'update_date' => $date]);
        DB::table('config')->where('keyy', 'QAR')->update(['type' => round($data->USDQAR, 2), 'update_date' => $date]);
        DB::table('config')->where('keyy', 'AED')->update(['type' => round($data->USDAED, 2), 'update_date' => $date]);
    }
    public function update_currency_manually($data)
    {

        foreach ($data as $key => $value) {

            if ($value !="") {
                DB::table('config')->where('keyy', $key)
                ->update(['value' => round($value, 2)]);
            }
        }

    }

    public function dashboard_info()
    {
        date_default_timezone_set('Africa/Cairo');

        $current_year = date('Y', time());
        $past_year= date("Y",strtotime("-1 year"));

        $current_month = date('m', time());
        $past_month= date('m', strtotime(date('Y-m')." -1 month"));

        $current_date = date('Y-m-d H:i:s', time());

        $current_day = date('Y-m-d', time());

        $func_year = 0;
        $new_year = 0;
        
        
        /*  $next_day = date('Y-m-d', strtotime('+1 days'));

        $current_korean_day_start =   date('Y-m-d H:i:s', strtotime($current_day. ' - 7 hours'));
        $current_korean_day_end = date('Y-m-d H:i:s', strtotime($next_day. ' - 7 hours')); */

        $stores = ['origin', 'plus_egypt', 'plus_ksa', 'plus_kuwait' , 'plus_uae'];
        $currency = ['plus_egypt' => "EGP", 'plus_ksa'=> "SAR", 'plus_kuwait' => "KWD", 'plus_uae' => "AED"];
        $order_status = ['Verified', 'Cancelled', 'Delivered', 'Refused'];

        $total_daily_revenue=0;
 

        /* line graph for number of orders in each store per  each month */  

            $all_stores_data = [];

            foreach ($stores as $store) {

                $store_data = [];

                for ($i = 1; $i <= 12; $i++) {

                    if ($i == $current_month) {

                        $data_of_month = DB::select('SELECT count(id) as value  FROM orders  where MONTH(created_at)=? AND YEAR(created_at)=? AND  store = ?  ', [$i, $current_year, $store]);
                        $store_data[$i] = $data_of_month[0]->value;

                    }elseif ($i < $current_month ) {

                        $check = DB::select('SELECT value FROM kshopina.analytics where store = ? AND year = ? AND month = ? AND function_name  = ? ;', [ $store , $current_year , $current_month-1 , "total_orders"]);

                        if (empty($check) || $check == []) {
                            $data_of_month = DB::select('SELECT count(id) as number_of_orders  FROM orders  where MONTH(created_at) = ? AND YEAR(created_at)=? AND  store = ?  ', [$current_month-1 , $current_year , $store]);
               
                            DB::table('kshopina.analytics')->insert([
                                'function_name' => "total_orders",
                                'value' => $data_of_month[0]->number_of_orders ,
                                'year' => $current_year,
                                'month' => $past_month,
                                'store' => $store,
                                'status' => '',
                                'created_at' => $current_date,
                            ]);
                        } 
                        
                        $data_of_month = DB::select('SELECT value FROM kshopina.analytics where store = ? AND year = ? AND month = ? AND function_name  = ? ;', [ $store , $current_year , $i , "total_orders"]);
                        $store_data[$i] = $data_of_month[0]->value;

                    }else {
                        $store_data[$i] = 0;
                    }

                }

                $all_stores_data[$store] = $store_data;
            }

        /*end  */

        /* daily orders */ 

            $each_day_orders_stores=[];
            $each_day_origin_country_orders=[]; 
            $sum_country = 0;
            $countries=['Egypt'=>'EGY' , 'Saudi Arabia'=>'KSA','Kuwait'=>'KWT' ,"Oman" => "OM" ,'Bahrain'=>'BH',"Qatar" => "QA" ,
            "Jordan"=> "JOR",'United Arab Emirates'=>'UAE' , 'Iraq'=>'IRQ'];
        
            foreach ($stores as $store) {
                /*  if ($store == "origin") {
                    $each_day_orders_data = DB::select('SELECT count(id) as value from kshopina.orders where created_at  between ? and ? and store = ? ;'
                    , [$current_korean_day_start, $current_korean_day_end , $store ]);
                } else { */
                    $each_day_orders_data = DB::select('SELECT count(id) as value from kshopina.orders where date(created_at) = ? and store = ? ;'
                    , [$current_day ,$store ]);
                /*  } */
                
                $each_day_orders_stores[$store] = $each_day_orders_data[0]->value;

                if ($store == 'origin' ) {
                    foreach ($countries as $country => $count_abrv) {
                        $each_day_origin_country_orders_data = DB::select('SELECT count(id) as value from kshopina.orders where date(created_at) = ? and store = ? and country = ? ;'
                        , [$current_day , $store , $country]);

                        $sum_country = $each_day_origin_country_orders_data[0]->value + $sum_country;
                        $each_day_origin_country_orders[$count_abrv] = $each_day_origin_country_orders_data[0]->value;
                        
                    }

                    $each_day_origin_country_orders['Others'] =  $each_day_orders_data[0]->value - $sum_country;

                }
               
            }
          
        /*end  */
 
        /* percentage of visa payments */ 
        
            $all_confirmed_all_stores = DB::select(' SELECT count(id) as value FROM orders where  verified =? OR verified =? ', [6, 2]);
            $all_confirmed_visa = DB::select(' SELECT count(id) as value FROM orders where  (verified =? OR verified =? ) AND 
            gateway not in ("COD","gift_card","manual"); ', [6, 2]);

            $visa_payment_percent = ($all_confirmed_visa[0]->value / $all_confirmed_all_stores[0]->value ) *100;

        /* end */

        /* percentage of each reason of complains  */

            $complains = DB::select('SELECT count(id) as value FROM complains where complain not like "%0%" and complain not like "%1%"');

            $special_cases = DB::select('SELECT count(id) as value FROM complains where (complain not like "%0%" and complain not like "%1%") and  special_case = 1');

            $cancel_order = DB::select('SELECT count(id) as value FROM complains where (complain not like "%0%" and complain not like "%1%") and ( complain  = "Cancel order"  )');
            $Rescheduling = DB::select('SELECT count(id) as value FROM complains where (complain not like "%0%" and complain not like "%1%") and ( complain  = "Rescheduling"  )');
            $lmd_or_late = DB::select('SELECT count(id) as value FROM complains where (complain not like "%0%" and complain not like "%1%") and ( complain  = "No response or late delivery")');
            $customer_others = DB::select('SELECT count(id) as value FROM complains where (complain not like "%0%" and complain not like "%1%") and ( complain  = "customer_others"  )');

            $product_inquries = DB::select('SELECT count(id) as value FROM complains where (complain not like "%0%" and complain not like "%1%") and ( complain  = "Inquire about product"  )');
            $guest_others = DB::select('SELECT count(id) as value FROM complains where (complain not like "%0%" and complain not like "%1%") and ( complain  = "guest_others"  )');
        
        /* end */

        /*  percentage solved and unsolved complains each day   */ 

           $each_day_complains =  DB::select('SELECT count(id) as value from kshopina.complains where date(saved_at) = ?;'
           , [$current_day]);

           $each_day_solved_complains = DB::select('SELECT count(id) as value from kshopina.complains where date(saved_at) = ? and solved = 1;'
           , [$current_day]);
            
        /* end */

        /* daily profit */

            foreach ($stores as $store) {
                if ($store == "origin") {
                    $daily_revenu =DB::select('SELECT sum(total_price) as value FROM orders where status = ? 
                        and (delivered_at > ? or re_delivered_at > ?) and store = ? ' , [5,$current_day,$current_day , $store]);
                        $total_daily_revenue += $daily_revenu[0]->value;
                } else {

                    $daily_revenu =DB::select('SELECT sum(currency) as value FROM orders where status = ? 
                        and (delivered_at > ? or re_delivered_at > ?) and store = ? ' , [5,$current_day,$current_day , $store]);

                    $currency_rate= DB::select('SELECT value from config where keyy = ?', [$currency[$store]]);

                    $total_daily_revenue += $daily_revenu[0]->value / $currency_rate[0]->value ;

                }
                
            }
            
        /* end */

        /* line graph for number of visitors at stores  in tracking each month  */ 

            $count_origin = [];
            $count_egypt = [];
            $count_ksa = [];
            $count_kuwait = [];
            $count_uae = [];
            
            foreach ($stores as $store) {

                for ($i = 1; $i <= $current_month; $i++) {

                    if ($current_month == 1) {

                        $check_year =DB::select('SELECT value FROM kshopina.analytics where function_name = ? 
                        AND year = ? AND month = 12 AND store = ?;'
                        , ["visits_store" , $past_year , $store ]);

                        if (count($check_year) > 0) {
                            $new_year = 0;
                        } else {
                            $new_year = 1; 
                        }
                        
                    } 


                    if ( $i == $current_month && $new_year == 0 ) {

                        if ($store == 'plus_egypt'){

                            $data_of_month_visitors = DB::select('SELECT count(visitor_id) as number_of_visitors  FROM kshopina.visitor 
                            where MONTH(visited_at)=? AND YEAR(visited_at)=? and ksp_number like "%E%" ', [$i, $current_year]);
    
                            $count_egypt[$current_year.'_'.$i] = $data_of_month_visitors[0]->number_of_visitors;
    
                        }else if ($store == 'plus_ksa'){
    
                            $data_of_month_visitors = DB::select('SELECT count(visitor_id) as number_of_visitors  FROM kshopina.visitor 
                            where MONTH(visited_at)=? AND YEAR(visited_at)=? and ksp_number like "%S%" ', [$i, $current_year]);
    
                            $count_ksa[$current_year.'_'.$i] = $data_of_month_visitors[0]->number_of_visitors;
    
                        }else if ($store == 'plus_kuwait'){
    
                            $data_of_month_visitors = DB::select('SELECT count(visitor_id) as number_of_visitors  FROM kshopina.visitor 
                            where MONTH(visited_at)=? AND YEAR(visited_at)=? and ksp_number like "%K%k%" ', [$i, $current_year]);
    
                            $count_kuwait[$current_year.'_'.$i] = $data_of_month_visitors[0]->number_of_visitors;
    
                        }else if ($store == 'plus_uae'){
    
                            $data_of_month_visitors = DB::select('SELECT count(visitor_id) as number_of_visitors  FROM kshopina.visitor 
                            where MONTH(visited_at)=? AND YEAR(visited_at)=? and ksp_number like "%U%" ', [$i, $current_year]);
    
                            $count_uae[$current_year.'_'.$i] = $data_of_month_visitors[0]->number_of_visitors;
    
                        }else{
    
                            $data_of_month_visitors = DB::select('SELECT count(visitor_id) as number_of_visitors  FROM kshopina.visitor 
                            where MONTH(visited_at)=? AND YEAR(visited_at)=? and 
                            (ksp_number Not Like "%u%" and ksp_number Not Like "%s%"  and ksp_number Not Like "%K%k%"  and ksp_number Not Like "%e%"); '
                            , [$i, $current_year]);
    
                            $count_origin[$current_year.'_'.$i] = $data_of_month_visitors[0]->number_of_visitors;
    
                        }

                    }elseif ( ($i < $current_month && $new_year ==0) || ($i == 1 && $new_year = 1) ) {

                        if ($new_year == 0) {
                            $func_year = $current_year;
                        } else {
                            $func_year = $past_year;
                            $old_i =$i;
                            $i =12;
                        }

                        $check = DB::select('SELECT value FROM kshopina.analytics where year = ? AND month = ? AND function_name  = ? AND store = ? ;'
                        , [  $func_year , $i, "visits_store" , $store]);

                        if (empty($check) || $check == []) {

                            if ($store == 'plus_egypt'){
                                $data_of_month_visitors = DB::select('SELECT count(visitor_id) as number_of_visitors  FROM kshopina.visitor 
                                where MONTH(visited_at)=? AND YEAR(visited_at)=? and ksp_number like "%E%" ', [$i, $func_year]);        
                            }else if ($store == 'plus_ksa'){
                                $data_of_month_visitors = DB::select('SELECT count(visitor_id) as number_of_visitors  FROM kshopina.visitor 
                                where MONTH(visited_at)=? AND YEAR(visited_at)=? and ksp_number like "%S%" ', [$i, $func_year]);        
                            }else if ($store == 'plus_kuwait'){
                                $data_of_month_visitors = DB::select('SELECT count(visitor_id) as number_of_visitors  FROM kshopina.visitor 
                                where MONTH(visited_at)=? AND YEAR(visited_at)=? and ksp_number like "%K%k%" ', [$i, $func_year]);        
                            }else if ($store == 'plus_uae'){
                                $data_of_month_visitors = DB::select('SELECT count(visitor_id) as number_of_visitors  FROM kshopina.visitor 
                                where MONTH(visited_at)=? AND YEAR(visited_at)=? and ksp_number like "%U%" ', [$i, $func_year]);        
                            }else{
                                $data_of_month_visitors = DB::select('SELECT count(visitor_id) as number_of_visitors  FROM kshopina.visitor 
                                where MONTH(visited_at)=? AND YEAR(visited_at)=? and 
                                (ksp_number Not Like "%u%" and ksp_number Not Like "%s%"  and ksp_number Not Like "%K%k%"  and ksp_number Not Like "%e%"); '
                                , [$i, $func_year]);        
                            }

                            DB::table('kshopina.analytics')->insert([
                                'function_name' => "visits_store",
                                'value' => $data_of_month_visitors[0]->number_of_visitors ,
                                'year' => $func_year,
                                'month' => $i,
                                'store' => $store,
                                'status' => '',
                                'country' => '',
                                'created_at' => $current_date,
                            ]);
                        } 

                        $data_of_month_visitors = DB::select('SELECT value FROM kshopina.analytics where year = ? AND month = ? AND function_name  = ? AND store = ? ;'
                        , [  $func_year , $i, "visits_store" , $store]);

                        if ($store == 'plus_egypt'){

                            $count_egypt[$func_year.'_'.$i] = $data_of_month_visitors[0]->value;
    
                        }else if ($store == 'plus_ksa'){

                            $count_ksa[$func_year.'_'.$i] = $data_of_month_visitors[0]->value;
    
                        }else if ($store == 'plus_kuwait'){

                            $count_kuwait[$func_year.'_'.$i] = $data_of_month_visitors[0]->value;
    
                        }else if ($store == 'plus_uae'){

                            $count_uae[$func_year.'_'.$i] = $data_of_month_visitors[0]->value;
    
                        }else{

                            $count_origin[$func_year.'_'.$i] = $data_of_month_visitors[0]->value;
    
                        }

                        if ($new_year == 1) {
                            $i = $old_i - 1;
                        }
                       
                    }

                    

                }

                for ($i = $current_month +1 ; $i <= 12; $i++) {
                    $data_of_month_visitors = DB::select('SELECT value FROM kshopina.analytics where year = ? AND month = ? AND function_name  = ? AND store = ? ;'
                    , [  $past_year , $i, "visits_store" , $store]);


                    if ($store == 'plus_egypt'){

                        $count_egypt[$past_year.'_'.$i] = $data_of_month_visitors[0]->value;

                    }else if ($store == 'plus_ksa'){

                        $count_ksa[$past_year.'_'.$i] = $data_of_month_visitors[0]->value;

                    }else if ($store == 'plus_kuwait'){

                        $count_kuwait[$past_year.'_'.$i] = $data_of_month_visitors[0]->value;

                    }else if ($store == 'plus_uae'){

                        $count_uae[$past_year.'_'.$i] = $data_of_month_visitors[0]->value;

                    }else{

                        $count_origin[$past_year.'_'.$i] = $data_of_month_visitors[0]->value;

                    }
                   

                }

            }
            
        /* end */

        /* percentatge of visitors in countries   && line graph for top countries visits in each month  */
        
            $countries_visits_number = DB::select('SELECT count(visitor_id) as visits FROM kshopina.visitor;');

            $countries_arranged_data = DB::select('SELECT count(visitor_id) as value, country FROM kshopina.visitor group by(country) order by count(visitor_id) DESC ;');
            $top_countries = ' (';
            foreach (  $countries_arranged_data as $key=> $data) {

                $country_visitors_data = [];

                if ($key <= 8 ) {

                    if($key == 8)  {
                        $top_countries = $top_countries.'"'.$data->country.'"';
                    }else{
                        $top_countries = $top_countries.'"'.$data->country.'",';
                    }

                    for ($i = 1; $i <= $current_month; $i++) {

                        if ($current_month == 1) {

                            $check_year =DB::select('SELECT value FROM kshopina.analytics where function_name = ? 
                            AND year= ? AND month = 12 AND country = ?;'
                            , ["visits_country" , $past_year , $data->country ]);
    
                            if (count($check_year) > 0) {
                                $new_year = 0;
                            } else {
                                $new_year = 1; 
                            }
                            
                        } 

                        if ( $i == $current_month && $new_year == 0 ) {
                        
                            $data_of_month = DB::select('SELECT count(visitor_id) as visits FROM kshopina.visitor where YEAR (visited_at) = ? AND MONTH (visited_at) = ? and country = ?',
                            [$current_year , $current_month ,$data->country]); 
    
                            $country_visitors_data[$current_year.'_'.$i] = $data_of_month[0]->visits;
  
                        }elseif ( ($i < $current_month && $new_year ==0) || ($i == 1 && $new_year = 1) ) {

                            if ($new_year == 0) {
                                $func_year = $current_year;
                            } else {
                                $func_year = $past_year;
                                $old_i =$i;
                                $i =12;
                            }

                            $check = DB::select('SELECT value FROM kshopina.analytics where year = ? AND month = ? AND function_name  = ? AND country = ? ;'
                            , [  $func_year , $i, "visits_country" , $data->country]);
  
                            if (empty($check) || $check == []) {
  
                                $data_of_month = DB::select('SELECT count(visitor_id) as visits FROM kshopina.visitor where YEAR (visited_at) = ? AND MONTH (visited_at) = ? and country = ?',
                                [$func_year , $i ,$data->country]); 
  
                                DB::table('kshopina.analytics')->insert([
                                    'function_name' => "visits_country",
                                    'value' => $data_of_month[0]->visits ,
                                    'year' => $func_year,
                                    'month' => $i,
                                    'store' => '',
                                    'status' => '',
                                    'country' => $data->country,
                                    'created_at' => $current_date,
                                ]);
                            } 
                          
                            $data_of_month = DB::select('SELECT value FROM kshopina.analytics where  year = ? AND month = ? AND function_name  = ? AND country = ? ;'
                            , [  $func_year , $i , "visits_country" , $data->country]);
                          
                            $country_visitors_data[$func_year.'_'.$i] = $data_of_month[0]->value;

                            if ($new_year == 1) {
                                $i = $old_i - 1;
                            }

                        }

                    }

                    for ($i = $current_month +1 ; $i <= 12; $i++) {
                        $data_of_month = DB::select('SELECT value FROM kshopina.analytics where  year = ? AND month = ? AND function_name  = ? AND country = ? ;'
                            , [  $past_year , $i , "visits_country" , $data->country]);

                        $country_visitors_data[$past_year.'_'.$i] = $data_of_month[0]->value;
                    }

                    $all_countries_visit_data[$data->country] = $country_visitors_data;

                } else {

                    if ($key == 9) {
                        
                        $top_countries = $top_countries.')';
                        
                        for ($i = 1; $i <= $current_month; $i++) {

                            if ($current_month == 1) {

                                $check_year =DB::select('SELECT value FROM kshopina.analytics where year = ? AND month = 12 AND function_name  = ? AND country NOT IN '.$top_countries
                                , [ $past_year ,"visits_country" ]);
        
                                if (count($check_year) > 0) {
                                    $new_year = 0;
                                } else {
                                    $new_year = 1; 
                                }
                                
                            } 

                            if ( $i == $current_month && $new_year == 0 ) {
                              
                                $data_of_month = DB::select('SELECT count(visitor_id) as visits FROM kshopina.visitor where YEAR (visited_at) = ? AND MONTH (visited_at) = ? and country NOT IN '.$top_countries,
                                [$current_year , $current_month ]); 
        
                                $country_visitors_data[$current_year.'_'.$i] = $data_of_month[0]->visits;
      
                            }elseif ( ($i < $current_month && $new_year ==0) || ($i == 1 && $new_year = 1) ) {

                                if ($new_year == 0) {
                                    $func_year = $current_year;
                                } else {
                                    $func_year = $past_year;
                                    $old_i =$i;
                                    $i =12;
                                }

                                $check = DB::select('SELECT value FROM kshopina.analytics where year = ? AND month = ? AND function_name  = ? AND country NOT IN '.$top_countries
                                , [  $func_year , $i, "visits_country" ]);
      
                                if (empty($check) || $check == []) {
      
                                    $data_of_month = DB::select('SELECT count(visitor_id) as visits FROM kshopina.visitor where YEAR (visited_at) = ? AND MONTH (visited_at) = ? and country NOT IN '.$top_countries,
                                    [$func_year , $i ]); 
        
                                    DB::table('kshopina.analytics')->insert([
                                        'function_name' => "visits_country",
                                        'value' => $data_of_month[0]->visits ,
                                        'year' => $func_year,
                                        'month' => $i,
                                        'store' => '',
                                        'status' => '',
                                        'country' => "Others",
                                        'created_at' => $current_date,
                                    ]);
                                } 
                              
                                $data_of_month = DB::select('SELECT value FROM kshopina.analytics where  year = ? AND month = ? AND function_name  = ? AND country NOT IN '.$top_countries
                                , [  $func_year , $i , "visits_country" ]);

                                $country_visitors_data[$func_year.'_'.$i] = $data_of_month[0]->value;

                                if ($new_year == 1) {
                                    $i = $old_i - 1;
                                }

                            }
                          
                        }

                        for ($i = $current_month +1 ; $i <= 12; $i++) {

                            $data_of_month =DB::select('SELECT value FROM kshopina.analytics where year = ? AND month = ? AND function_name  = ? AND country NOT IN '.$top_countries
                            , [ $past_year , $i , "visits_country" ]);

                            $country_visitors_data[$past_year.'_'.$i] = $data_of_month[0]->value;

                        }
      
                        $all_countries_visit_data['Others'] = $country_visitors_data;
                    }

                } 
                //
                $count_countries_visit[$data->country] = $data->value;

            }

        /* end */

        /*  percentage verified / cancelled / delivered and refused complains each day   */ 
        
            $each_day_delivery = DB::select('SELECT count(id) as value from kshopina.orders where ( date(delivered_at) = ? or date(re_delivered_at) = ? ) and status = 5 ;'
                    , [$current_day, $current_day]);
            $each_day_refused = DB::select('SELECT count(id) as value from kshopina.orders where ( date(delivered_at) = ? or date(re_delivered_at) = ? ) and status = 6 ;'
                    , [$current_day, $current_day]);

        /* end */

        /* Complaints rate precentage  */

            $rate_1 =DB::select('SELECT count(id) as numberOfComplaint FROM complains where solved =1 and rating = ?', [1]);
            $rate_2 =DB::select('SELECT count(id) as numberOfComplaint FROM complains where solved =1 and rating = ?', [2]);
            $rate_3 =DB::select('SELECT count(id) as numberOfComplaint FROM complains where solved =1 and rating = ?', [3]);
            $rate_4 =DB::select('SELECT count(id) as numberOfComplaint FROM complains where solved =1 and rating = ?', [4]);
            $rate_5 =DB::select('SELECT count(id) as numberOfComplaint FROM complains where solved =1 and rating = ?', [5]);
        /* end */
        
        /* line graph for status of orders each month */ 

            $all_order_status_data = [];

            $Verified_data[$past_year]=[];
            $Verified_data[$current_year]=[];

            $Cancelled_data[$past_year]=[];
            $Cancelled_data[$current_year]=[];

            $Delivered_data[$past_year]=[];
            $Delivered_data[$current_year]=[];
            
            $Refused_data[$past_year]=[];
            $Refused_data[$current_year]=[];

            foreach ($order_status as $status) {

                for ($i = 1; $i <= $current_month; $i++) {

                    if ($current_month == 1) {

                        $check_year =DB::select('SELECT value FROM kshopina.analytics where function_name = ? 
                        AND year= ? AND month = 12 AND status = ?;'
                        , ["orders_status" , $past_year , $status]);

                        if (count($check_year) > 0) {
                            $new_year = 0;
                        } else {
                            $new_year = 1; 
                        }
                        
                    } 
                    
                    if ($i == $current_month && $new_year == 0) {

                        if ($status == 'Verified') {

                            $order_status = DB::select('SELECT count(id) as value FROM kshopina.orders  where (( YEAR (action_taken_at) = ? AND MONTH (action_taken_at) = ?) or
                            (YEAR (fvm_replay_at) = ? AND MONTH (fvm_replay_at) = ?) or
                            (YEAR (send_fvm_at) = ? and MONTH (send_fvm_at) = ? ) ) AND ( verified = ? or  verified = ?) ; '
                            , [$current_year, $i ,$current_year,$i ,$current_year ,$i,6 ,2 ]);

                            $Verified_data[$current_year][$i]=$order_status[0]->value;
                            $all_order_status_data[$status] = $Verified_data;
                        } else if ($status == 'Cancelled'){

                            $order_status = DB::select('SELECT count(id) as value FROM kshopina.orders  where (( YEAR (action_taken_at) = ? AND MONTH (action_taken_at) = ?) or
                            (YEAR (fvm_replay_at) = ? AND MONTH (fvm_replay_at) = ?) or
                            (YEAR (send_fvm_at) = ? and MONTH (send_fvm_at) = ? ) )AND verified = ?; '
                            , [$current_year, $i ,$current_year,$i ,$current_year ,$i,3 ]);

                            $Cancelled_data[$current_year][$i]=$order_status[0]->value;
                            $all_order_status_data[$status] = $Cancelled_data;

                        }else if ($status == 'Delivered'){

                            $order_status = DB::select('SELECT count(id) as value FROM kshopina.orders  where ( ( YEAR (delivered_at) = ? AND MONTH (delivered_at) = ?) 
                            or (YEAR (re_delivered_at) = ? AND MONTH (re_delivered_at) = ?) ) AND ( verified = ? or  verified = ?)  AND status = ?;'
                            , [$current_year, $i ,$current_year,$i ,6 ,2 ,5 ]);

                            $Delivered_data[$current_year][$i]=$order_status[0]->value;
                            $all_order_status_data[$status] = $Delivered_data;


                        }else if ($status == 'Refused'){

                            $order_status = DB::select('SELECT count(id) as value FROM kshopina.orders  where ( ( YEAR (delivered_at) = ? AND MONTH (delivered_at) = ?) 
                            or (YEAR (re_delivered_at) = ? AND MONTH (re_delivered_at) = ?) ) AND ( verified = ? or  verified = ?)  AND status = ?;'
                            , [$current_year, $i ,$current_year,$i ,6 ,2,6 ]);

                            $Refused_data[$current_year][$i]=$order_status[0]->value;
                            $all_order_status_data[$status] = $Refused_data;

                        }

                    }elseif ( ($i < $current_month && $new_year ==0) || ($i == 1 && $new_year = 1) ) {

                        if ($new_year == 0) {
                            $func_year = $current_year;
                        } else {
                            $func_year = $past_year;
                            $old_i =$i;
                            $i =12;
                        }
                        
                            $check = DB::select('SELECT value FROM kshopina.analytics where function_name = ? 
                            AND year= ? AND month = ? AND status = ?;'
                            , ["orders_status" , $func_year ,$i , $status]);

                            if (empty($check) || $check == []) {
                                
                                if ($status == 'Verified') {

                                    $order_status = DB::select('SELECT count(id) as value FROM kshopina.orders  where (( YEAR (action_taken_at) = ? AND MONTH (action_taken_at) = ?) or
                                    (YEAR (fvm_replay_at) = ? AND MONTH (fvm_replay_at) = ?) or
                                    (YEAR (send_fvm_at) = ? and MONTH (send_fvm_at) = ? ) ) AND ( verified = ? or  verified = ?) ; '
                                    , [$func_year, $i ,$func_year,$i ,$func_year ,$i,6 ,2]);
        
                                } else if ($status == 'Cancelled'){
        
                                    $order_status = DB::select('SELECT count(id) as value FROM kshopina.orders  where (( YEAR (action_taken_at) = ? AND MONTH (action_taken_at) = ?) or
                                    (YEAR (fvm_replay_at) = ? AND MONTH (fvm_replay_at) = ?) or
                                    (YEAR (send_fvm_at) = ? and MONTH (send_fvm_at) = ? ) )AND  verified = ?  ; '
                                    , [$func_year, $i ,$func_year,$i ,$func_year ,$i,3 ]);
        
                                }else if ($status == 'Delivered'){
        
                                    $order_status = DB::select('SELECT count(id) as value FROM kshopina.orders  where ( ( YEAR (delivered_at) = ? AND MONTH (delivered_at) = ?) 
                                    or (YEAR (re_delivered_at) = ? AND MONTH (re_delivered_at) = ?) ) AND ( verified = ? or  verified = ?)  AND status = ?;'
                                    , [$func_year, $i ,$func_year,$i ,6 ,2,5 ]);
        
    
                                }else if ($status == 'Refused'){
        
                                    $order_status = DB::select('SELECT count(id) as value FROM kshopina.orders  where ( ( YEAR (delivered_at) = ? AND MONTH (delivered_at) = ?) 
                                    or (YEAR (re_delivered_at) = ? AND MONTH (re_delivered_at) = ?) ) AND ( verified = ? or  verified = ?)  AND status = ?;'
                                    , [$func_year, $i ,$func_year,$i ,6,2 ,6 ]);
        
                                }


                                DB::table('kshopina.analytics')->insert([
                                        'function_name' => "orders_status",
                                        'value' => $order_status[0]->value ,
                                        'year' => $func_year,
                                        'month' => $i,
                                        'store' => 'all',
                                        'status' => $status,
                                        'created_at' => $current_date,
                                    ]);
                            } 

                            $order_status = DB::select('SELECT value FROM kshopina.analytics where function_name = ? 
                            AND year= ? AND month = ? AND status = ?;'
                            , ["orders_status" , $func_year ,$i , $status]);


                            if ($status == 'Verified') {
                                $Verified_data[$func_year][$i]=$order_status[0]->value;
                                $all_order_status_data[$status] = $Verified_data;

                            } else if ($status == 'Cancelled'){
                                $Cancelled_data[$func_year][$i]=$order_status[0]->value;
                                $all_order_status_data[$status] = $Cancelled_data;

                            }else if ($status == 'Delivered'){
                                $Delivered_data[$func_year][$i]=$order_status[0]->value;
                                $all_order_status_data[$status] = $Delivered_data;

                            }else if ($status == 'Refused'){
                                $Refused_data[$func_year][$i]=$order_status[0]->value;
                                $all_order_status_data[$status] = $Refused_data;

                            }

                        if ($new_year == 1) {
                            $i = $old_i - 1;
                        }

                    }

                }

                for ($i = $current_month +1 ; $i <= 12; $i++) {

                    $order_status = DB::select('SELECT value FROM kshopina.analytics where function_name = ? 
                        AND year= ? AND month = ? AND status = ?;'
                        , ["orders_status" , $past_year ,$i , $status]);

                    if ($status == 'Verified') {
                        $Verified_data[$past_year][$i]=$order_status[0]->value;
                        $all_order_status_data[$status] = $Verified_data;
                    } else if ($status == 'Cancelled'){
                        $Cancelled_data[$past_year][$i]=$order_status[0]->value;
                        $all_order_status_data[$status] = $Cancelled_data;
                    }else if ($status == 'Delivered'){
                        $Delivered_data[$past_year][$i]=$order_status[0]->value;
                        $all_order_status_data[$status] = $Delivered_data;
                    }else if ($status == 'Refused'){
                        $Refused_data[$past_year][$i]=$order_status[0]->value;
                        $all_order_status_data[$status] = $Refused_data;
                    }
                }

            }

        /*end  */

        /* monthly profit  */  

            $profit_origin_data[$past_year]=[];
            $profit_origin_data[$current_year]=[];

            $profit_egypt_data[$past_year]=[];
            $profit_egypt_data[$current_year]=[];

            $profit_kuwait_data[$past_year]=[];
            $profit_kuwait_data[$current_year]=[];

            $profit_ksa_data[$past_year]=[];
            $profit_ksa_data[$current_year]=[];

            $profit_uae_data[$past_year]=[];
            $profit_uae_data[$current_year]=[];


            foreach ($stores as $store) {

                for ($i = 1; $i <= $current_month; $i++) {

                    if ($current_month == 1) {
                        
                        $check_year = DB::select('SELECT value FROM kshopina.analytics 
                        where function_name = ?  and year = ? and month = 12 and store = ?;'
                            , ["total_revenue" , $past_year , $store]);

                        if (count($check_year) > 0) {
                            $new_year = 0;
                        } else {
                            $new_year = 1; 
                        }
                        
                    } 

                    if ($i == $current_month && $new_year == 0) {

                        if ($store=="origin") {
                            $total_revenue = DB::select('SELECT sum(total_price) as value FROM kshopina.orders  where ( ( YEAR (delivered_at) = ? AND MONTH (delivered_at) = ? ) 
                            or (YEAR (re_delivered_at) = ? AND MONTH (re_delivered_at) = ?) ) AND ( verified = ? or  verified = ?)  AND status = ? and store = ? ;'
                            , [$current_year ,$i ,$current_year , $i , 6 ,2 , 5 , $store]);
                        } else {
                            $total_revenue = DB::select('SELECT sum(currency) as value FROM kshopina.orders  where ( ( YEAR (delivered_at) = ? AND MONTH (delivered_at) = ? ) 
                            or (YEAR (re_delivered_at) = ? AND MONTH (re_delivered_at) = ?) ) AND ( verified = ? or  verified = ?)  AND status = ? and store = ? ;'
                            , [$current_year ,$i ,$current_year , $i , 6 ,2, 5 , $store]);

                            $currency_rate= DB::select('SELECT value from config where keyy = ?', [$currency[$store]]);

                            $total_revenue[0]->value = $total_revenue[0]->value / $currency_rate[0]->value;
                        }

                        if ($total_revenue[0]->value == null ) {
                            $total_revenue[0]->value =0;
                        } 

                        if ($store == 'origin') {
                            $profit_origin_data[$current_year][$i] = $total_revenue[0]->value;
                        } else if ($store == 'plus_egypt'){
                            $profit_egypt_data[$current_year][$i] = $total_revenue[0]->value;
                        }else if ($store == 'plus_ksa'){
                            $profit_ksa_data[$current_year][$i] = $total_revenue[0]->value;
                        }else if ($store == 'plus_kuwait'){
                            $profit_kuwait_data[$current_year][$i] = $total_revenue[0]->value;
                        }else if ($store == 'plus_uae'){
                            $profit_uae_data[$current_year][$i] = $total_revenue[0]->value;
                        }

                    }elseif (( $i < $current_month && $new_year ==0 ) || ($i == 1 && $new_year = 1 )) {

                        if ($new_year == 0) {
                            $func_year = $current_year;
                        } else {
                            $func_year = $past_year;
                            $old_i =$i;
                            $i =12;
                        }

                        $check = DB::select('SELECT value FROM kshopina.analytics 
                                where function_name = ?  and year = ? and month = ? and store = ?;'
                                    , ["total_revenue" , $func_year ,$i , $store]);
                              
                        if (empty($check) || $check == []) {
                            if ($store=="origin") {
                                $total_revenue = DB::select('SELECT sum(total_price) as value FROM kshopina.orders  where ( ( YEAR (delivered_at) = ? AND MONTH (delivered_at) = ? ) 
                                or (YEAR (re_delivered_at) = ? AND MONTH (re_delivered_at) = ?) ) AND ( verified = ? or  verified = ?)  AND status = ? and store = ? ;'
                                , [$func_year ,$i ,$func_year , $i , 6 ,2, 5 , $store]);
                            } else {
                                $total_revenue = DB::select('SELECT sum(currency) as value FROM kshopina.orders  where ( ( YEAR (delivered_at) = ? AND MONTH (delivered_at) = ? ) 
                                or (YEAR (re_delivered_at) = ? AND MONTH (re_delivered_at) = ?) ) AND ( verified = ? or  verified = ?)  AND status = ? and store = ? ;'
                                , [$func_year ,$i ,$func_year , $i , 6 ,2, 5 , $store]);

                                $currency_rate= DB::select('SELECT value from config where keyy = ?', [$currency[$store]]);

                                if ($total_revenue[0]->value == null ) {
                                    $total_revenue[0]->value =0;
                                } 

                                $total_revenue[0]->value = $total_revenue[0]->value / $currency_rate[0]->value;
                            }
                            
                            DB::table('kshopina.analytics')->insert([
                                'function_name' => "total_revenue",
                                'value' => $total_revenue[0]->value ,
                                'year' => $func_year,
                                'month' => $i,
                                'store' => $store,
                                'status' => '',
                                'created_at' => $current_date,
                            ]);
                        } 

                        $total_revenue = DB::select('SELECT value FROM kshopina.analytics 
                        where function_name = ?  and year = ? and month = ? and store = ?;'
                            , ["total_revenue" , $func_year ,$i , $store]);

                        if ($store == 'origin') {
                            $profit_origin_data[$func_year][$i] = $total_revenue[0]->value;
                        } else if ($store == 'plus_egypt'){
                            $profit_egypt_data[$func_year][$i] = $total_revenue[0]->value;
                        }else if ($store == 'plus_ksa'){
                            $profit_ksa_data[$func_year][$i] = $total_revenue[0]->value;
                        }else if ($store == 'plus_kuwait'){
                            $profit_kuwait_data[$func_year][$i] = $total_revenue[0]->value;
                        }else if ($store == 'plus_uae'){
                            $profit_uae_data[$func_year][$i] = $total_revenue[0]->value;
                        }

                        if ($new_year == 1) {
                            $i = $old_i - 1;
                        }
                    }

                }

                for ($i = $current_month +1 ; $i <= 12; $i++) {
                    $total_revenue = DB::select('SELECT value FROM kshopina.analytics 
                    where function_name = ?  and year = ? and month = ? and store = ?;'
                        , ["total_revenue" , $past_year ,$i , $store]);


                    if ($store == 'origin') {
                        $profit_origin_data[$past_year][$i] = $total_revenue[0]->value;
                    } else if ($store == 'plus_egypt'){
                        $profit_egypt_data[$past_year][$i] = $total_revenue[0]->value;
                    }else if ($store == 'plus_ksa'){
                        $profit_ksa_data[$past_year][$i] = $total_revenue[0]->value;
                    }else if ($store == 'plus_kuwait'){
                        $profit_kuwait_data[$past_year][$i] = $total_revenue[0]->value;
                    }else if ($store == 'plus_uae'){
                        $profit_uae_data[$past_year][$i] = $total_revenue[0]->value;
                    }
                }
            }

        /*end  */

        /* yearly profit  */
            $yearly_profits = [];
            $total_profit_new = 0;

            for ($i=2021; $i <= $current_year ; $i++) { 
                
                if ($current_year == $i) {

                    foreach ($stores as $store) {

                        if ($store=="origin") {
                            $profit_dollar = DB::select('SELECT sum(total_price) as value FROM kshopina.orders  where ( YEAR (delivered_at) = ?  or YEAR (re_delivered_at) = ? ) 
                            AND ( verified = ? or  verified = ? )  AND status = ? and store = ?;',[$i , $i , 6, 2 , 5,$store ]);
                        } else {
                            $profit_dollar = DB::select('SELECT sum(currency) as value FROM kshopina.orders  where ( YEAR (delivered_at) = ?  or YEAR (re_delivered_at) = ? ) 
                            AND ( verified = ? or  verified = ? )  AND status = ? and store = ?;',[$i , $i , 6, 2 , 5,$store ]);

                            $currency_rate= DB::select('SELECT value from config where keyy = ?', [$currency[$store]]);

                            if ($profit_dollar[0]->value == null ) {
                                $profit_dollar[0]->value =0;
                            } 

                            $profit_dollar[0]->value = round($profit_dollar[0]->value, 2) / $currency_rate[0]->value;
                        }
                        if (!array_key_exists($i, $yearly_profits)) {
                            $yearly_profits[$i]= round($profit_dollar[0]->value, 2);
                        } else {
                            $yearly_profits[$i] =  round($yearly_profits[$i], 2) + round($profit_dollar[0]->value, 2);
                        }
                        
                    }
                    
                }else{
                    $check = DB::select('SELECT value FROM kshopina.analytics where function_name = "total_year_revenue" AND year = ?',[$i]);

                    if (empty($check) || $check == []) {

                        foreach ($stores as $store) {
                            if ($store=="origin") {
                                $profit_dollar = DB::select('SELECT sum(total_price) as value FROM kshopina.orders  where ( YEAR (delivered_at) = ?  or YEAR (re_delivered_at) = ? ) 
                                AND ( verified = ? or  verified = ? )  AND status = ? and store = ?;',[$i , $i , 6, 2 , 5,$store ]);
                            } else {
                                $profit_dollar = DB::select('SELECT sum(currency) as value FROM kshopina.orders  where ( YEAR (delivered_at) = ?  or YEAR (re_delivered_at) = ? ) 
                                AND ( verified = ? or  verified = ? )  AND status = ? and store = ?;',[$i , $i , 6, 2 , 5,$store ]);

                                $currency_rate= DB::select('SELECT value from config where keyy = ?', [$currency[$store]]);

                                if ($profit_dollar[0]->value == null ) {
                                    $profit_dollar[0]->value =0;
                                } 

                                $profit_dollar[0]->value = round($profit_dollar[0]->value, 2) / $currency_rate[0]->value;
                            }
                            $total_profit_new = $total_profit_new + round($profit_dollar[0]->value, 2);
                        }
                        
                        DB::table('kshopina.analytics')->insert([
                            'function_name' => "total_year_revenue",
                            'value' => $total_profit_new  ,
                            'year' => $i,
                            'store' => 'all',
                            'created_at' => $current_date,
                        ]);


                    }

                    $profit_dollar = DB::select('SELECT value FROM kshopina.analytics where function_name = "total_year_revenue" AND year = ?',[$i]);
                    $yearly_profits[$i]= round($profit_dollar[0]->value, 2);
                }
                
            }

        /*end  */

        /* weekly sales chart */

            /*  // Get the current date
                $currentDate = new DateTime();

                // Get the current day of the week (1 for Sunday, 2 for Monday, ..., 7 for Saturday)
                $currentDayOfWeek = $currentDate->format('N');

                // Calculate the start date of the week (Sunday) by subtracting the current day of the week
                $startDate = clone $currentDate;
                $startDate->modify('-' . (7- $currentDayOfWeek ) . ' days');

                // Create an array to store the dates of the week
                $weekDates = array();

                // Loop through the week, adding each day's date to the array
                for ($i = 0; $i < 7; $i++) {
                    $weekDates[] = $startDate->format('Y-m-d');
                    $startDate->modify('+1 day');
                } 
            */

            // Get the current date
            $currentDate = new DateTime();

            // Get the current day of the week (0 for Saturday, 1 for Sunday, ..., 6 for Friday)
            $currentDayOfWeek = $currentDate->format('w');

            // Calculate the start date of the week (Saturday) by subtracting the current day of the week
            $startDate = clone $currentDate;
            $startDate->modify('-' . $currentDayOfWeek  . ' days');

            // Create an array to store the dates of the week
            $weekDates = array();

            // Loop through the week, adding each day's date to the array
            for ($i = 0; $i < 7; $i++) {
                $weekDates[] = $startDate->format('Y-m-d');
                $startDate->modify('+1 day');
            }
            
            $weekNames = [  'SUN' , 'MON' , 'TUE' , 'WED' ,   'THU' ,   'FRI' ,'SAT' ];
            $week_data = [];

            for ($i=0; $i <7 ; $i++) { 
                $num_of_orders = DB::select('SELECT count(id) as num
                FROM orders
                WHERE date(created_at) = ? ;',[$weekDates[$i]]);
                
                $week_data[ substr(strstr($weekDates[$i], '-'),1) .'('.$weekNames[$i].')'] = $num_of_orders[0]->num;
            }

            $days_percent = [];
            $days_= [ 1  => 'SUN' ,2  =>  'MON'  , 3  =>  'TUE', 4  => 'WED' , 5  =>  'THU'  , 6  => 'FRI'  , 7  =>  'SAT' ];
            $all_orders = DB::select('SELECT count(id) as num FROM orders ;');
            
            for ($i=1; $i < 8 ; $i++) { 

                $week_orders = DB::select('SELECT count(id) as num FROM orders WHERE DAYOFWEEK(created_at) = ?;', [  $i ]);
                $days_percent[$days_[$i]] = $week_orders[0]->num;

            }

            
           

        /*end  */

            /* return [ $date ,$day_data_arr , $week_orders , $week_day , $days_[$week_day] ]; */
        return [[], [], [], [], [], //4
            $each_day_origin_country_orders,//5
            [],[],[],[], //9
            $all_stores_data, //10
            $each_day_orders_stores, //11
            [], //12
            $product_inquries, //13
            $guest_others, //14
            $complains, //15
            $each_day_complains, //16
            $special_cases, //17
            $cancel_order, //18
            $Rescheduling, //19
            $lmd_or_late, //20
            $customer_others,  //21
            $each_day_delivery, //22
            $each_day_refused, //23
            $rate_1,//24
            $rate_2,//25
            $rate_3,//26
            $rate_4,//27
            $rate_5,//28
            $all_order_status_data, //29
            $profit_origin_data,//30
            $profit_egypt_data,//31
            $profit_kuwait_data,//32
            $profit_ksa_data ,//33
            $profit_uae_data, //34
            round($total_daily_revenue), //35
            $each_day_solved_complains,//36
            round($visa_payment_percent,1), //37
            $count_origin, // 38
            $count_egypt, //39
            $count_ksa, //40
            $count_kuwait, //41
            $count_uae, //42
            $yearly_profits, //43 
            $countries_visits_number[0]->visits, //44
            $count_countries_visit, //45
            $all_countries_visit_data, //46
            $week_data, //47
            $days_percent, //48 
            $all_orders[0]->num, //49
        ];

        
    } 

    public function get_week_data($week_data){

        /* return $week_data; */
        $year = strtok($week_data, '-');
        $week = substr($week_data, strpos($week_data, "-") + 2);


        // Get the start date of the week
        $startDate = new DateTime();
        $startDate->setISODate($year, $week);

        // Create an array to store all the dates of the week
        $weekDates = array();

        // Loop through the days of the week and add each date to the array
        for ($i = 0; $i < 7; $i++) {
            $weekDates[] = $startDate->format('Y-m-d');
            $startDate->modify('+1 day');
        }

        array_pop($weekDates);

        $first_date_sunday = date('Y-m-d', strtotime('-1 day', strtotime($weekDates[0])));
        array_unshift($weekDates , $first_date_sunday );

        $weekNames = [  'SUN' , 'MON' , 'TUE' , 'WED' ,   'THU' ,   'FRI' ,'SAT' ];
        $week_data = [];

        for ($i=0; $i <7 ; $i++) { 
            $num_of_orders = DB::select('SELECT count(id) as num
            FROM orders
            WHERE date(created_at) = ? ;',[$weekDates[$i]]);
            
            $week_data[ substr(strstr($weekDates[$i], '-'),1) .'('.$weekNames[$i].')'] = $num_of_orders[0]->num;
        }

        return $week_data;

    }

    public function getStickyNotes()
    {
        return DB::select('SELECT * from dashboard where type LIKE "sticky%" order by sticky_order ASC');
    }

    public function getAllNotes($year, $month)
    {
        return DB::select('SELECT * FROM kshopina.mentions
                            INNER JOIN (SELECT dashboard.id,dashboard.note,dashboard.type,dashboard.active,dashboard.note_created_at,dashboard.attachment,dashboard.note_created_by,
                            dashboard.replies, dashboard.priorty,users.name,users.form_url
                            FROM kshopina.dashboard INNER JOIN users ON dashboard.note_created_by = users.id 
                            where dashboard.type = "announcement" and dashboard.active=0 order by dashboard.note_created_at DESC) as announcement
                            ON announcement.id = mentions.note_id  WHERE MONTH(note_created_at) = ? AND YEAR(note_created_at) = ? order by announcement.note_created_at DESC;',
                            [ $month , $year]);
    }
    
    public function getAllReplies($announcement_id){

        return DB::select('SELECT  replies.announcement_id , replies.note_created_by ,   replies.reply , replies.note_created_at ,
        replies.replied_at , replies.replied_by  , users.form_url , users.name
        FROM kshopina.users
        INNER JOIN (SELECT dashboard.id, dashboard.note_created_by , dashboard.note_created_at ,
        dashboard_replies.announcement_id, dashboard_replies.reply, dashboard_replies.replied_at, dashboard_replies.replied_by
        FROM kshopina.dashboard INNER JOIN kshopina.dashboard_replies ON dashboard.id = dashboard_replies.announcement_id 
        where dashboard_replies.announcement_id = ? AND dashboard.type = "announcement" 
        and dashboard.active = 0 order by dashboard.note_created_at DESC) as replies
        ON replies.replied_by = users.id order by replies.note_created_at DESC;', [$announcement_id]);
        
    }
    
    public function submit_sticky_note($id , $note)
    {

        $sticky_order= substr($id, -1);
        date_default_timezone_set('Africa/Cairo');
        $date = date('Y-m-d H:i:s', time()); 

        $check=DB::select('select * from dashboard where type = ?', [$id]);

        if (count($check) ==0) {
            DB::insert('insert into dashboard (type,note,sticky_order,note_created_at,note_created_by) values (?,?,?,?,?)', [$id , $note , $sticky_order , $date , Auth::user()->id ]);
        }
        else{
            DB::table('dashboard')->where('type', $id)->update(['note' => $note, 'note_updated_at' => $date]);

            DB::table('dashboard_history')->insert([
                'user_name' => Auth::user()->name,
                'note_id' => $check[0]->id,'note_type'=>$id,
                'process' => "sticky_note_update",
                'record_created_at'=>$date
            ]);
        }
        return 'done';
        
    }
    public function add_note($content,$priority)
    {
        date_default_timezone_set('Africa/Cairo');
        $date = date('Y-m-d H:i:s', time());

        $query['note']=$content;
        $query['type']='announcement';
        $query['active']=0;
        $query['note_created_at']=$date;
        $query['note_created_by']=Auth::user()->id;
        $query['priorty']=$priority;

        return DB::table('dashboard')->insertGetId($query);

       
    }

    /* changed */ 
    public function update_note($note_id ,$content,$priority)
    {
        date_default_timezone_set('Africa/Cairo');
        $date = date('Y-m-d H:i:s', time());

        $query['note']=$content;
        $query['note_updated_at']=$date;
        $query['note_updated_by']=Auth::user()->id;
        $query['priorty']=$priority;

       
        DB::table('dashboard')->where('id', $note_id)->update( $query );       
        return 'done';
    }


    public function get_announcment_data($announcement_id )
    {
        return DB::select('SELECT * FROM kshopina.mentions
                    INNER JOIN (SELECT dashboard.id,dashboard.note,dashboard.type,dashboard.active,dashboard.note_created_at,dashboard.attachment,
                    dashboard.priorty,users.name
                    FROM kshopina.dashboard INNER JOIN kshopina.users ON dashboard.note_created_by = users.id 
                    where dashboard.type = "announcement" and dashboard.active = 0  and dashboard.id = ? ) as announcement
                    ON announcement.id = mentions.note_id  order by announcement.note_created_at DESC;',[$announcement_id]);
    }
    /* changed */ 
    
    public function add_mentions($note_id,$mentions)
    {
        foreach ($mentions as $index => $user_id) {
            $query=[];
            $query['note_id']=$note_id;

            if(preg_replace('/\s+/', '', $user_id) =="" && count($mentions)==1){

                $query['user_id']=0;
                $query['user_name']="empty";

            }
            elseif(preg_replace('/\s+/', '', $user_id) =="" ){
                continue;
            }
            elseif (preg_replace('/\s+/', '', $user_id) =="0") {
                $query['user_id']=0;
                $query['user_name']="EVERYONE";
            }
            else {
                $user_data=DB::select('select * from users where id = ?', [preg_replace('/\s+/', '', $user_id)]);

                $query['user_id']=$user_data[0]->id;
                $query['user_name']=$user_data[0]->name;

                Mail::to($user_data[0]->email)->send(new mentionMail(['user_name'=>Auth::user()->name,'mention'=>$user_data[0]->name]), function ($message) {
                    $message->subject("Order Details");
                });
            }

            DB::table('mentions')->insertGetId($query);
        }
    }
    public function add_files($note_id,$files,$side_notes,$types)
    {
        if (!file_exists(public_path('uploads/dashboard'))) {
            mkdir(public_path('uploads/dashboard'), 0777, true);
        }
        if (count($files)==0    ) {

             $check = DB::select('select * from dashboard where id = ?',[$note_id]);
            
               if ($check[0]->attachment == 0 ){
                    DB::update('update dashboard set attachment = ? where id = ?', [0,$note_id]);

               }else{
                    DB::update('update dashboard set attachment = ? where id = ?', [1,$note_id]);
               }

        } else {
            foreach ($files as $index => $file) {
                try {
                    
                    $imageName = Auth::user()->id . date('YmdHis', time()) .$index. '.' . explode(".", $file->getClientOriginalName())[1];
                    
                    DB::insert('insert into attachments (note_id, file_type,file_note,file_old_name,file_new_name,file_size) values (?, ?,?, ?,?, ?)', 
                    [$note_id,$types[$index],$side_notes[$index],$file->getClientOriginalName(),$imageName,$file->getSize()]);
                    DB::update('update dashboard set attachment = ? where id = ?', [0,$note_id]);

                    $file->move(public_path('uploads/dashboard'), $imageName);
    
                } catch (\Throwable $th) {
                    DB::insert('insert into errors (shipment_number,message,system_name) values (?,?,?)', [$note_id, $th, "Upload in dashboard - ".$file->getClientOriginalName()]);
    
                }
                
            }
        }
        
    }


    public function get_attachments($note_id)
    {
        return  DB::select('SELECT * from attachments where note_id = ?', [$note_id]);
    }

    public function add_reply_to_announcement($reply_content,$replier_name,$announcement_id){


        date_default_timezone_set('Africa/Cairo');
        $date = date('Y-m-d H:i:s', time());

        $query['announcement_id']=$announcement_id;
        $query['reply']=$reply_content;
        $query['replied_by']=$replier_name;
        $query['replied_at']=$date;

        DB::update('update dashboard set replies = ? where id = ?', [1,$announcement_id]);

        DB::table('dashboard_replies')->insertGetId($query);


    }

    public function get_employee_attachments($user_id){
        return DB::select('SELECT * FROM kshopina.dashboard inner join kshopina.attachments on 
        dashboard.id = attachments.note_id where dashboard.note_created_by = ?', [$user_id]);
    }
    
    

}
