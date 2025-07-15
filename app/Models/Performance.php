<?php

namespace App\Models;
use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Performance extends Model
{
    use HasFactory;

    function getVerificationAnalytics($employee_filter,$day,$employees){

        $day_2=date('Y-m-d', strtotime($day .' +1 day'));


        /* setting up query of select DB */

            $employees_confirmed_query="";
            $employees_svm_query="";
            $employees_category_query="";


            foreach ($employees as $key => $employee) {
                $employees_confirmed_query = $employees_confirmed_query. ' action_taken_by LIKE '.'"%'. $employee->name .'%"' . ' OR';

                $employees_svm_query = $employees_svm_query. ' send_svm_by LIKE '.'"%'. $employee->name .'%"' . ' OR';

                $employees_category_query = $employees_category_query. ' categorised_by LIKE '.'"%'. $employee->name .'%"' . ' OR';
            }
            
            $employees_confirmed_query=substr($employees_confirmed_query, 0, -2);
            $employees_svm_query=substr($employees_svm_query, 0, -2);
            $employees_category_query=substr($employees_category_query, 0, -2);
        
        /*  DB select four categorise of verification points */

            $confirmed_orders= DB::select('SELECT action_taken_by,action_taken_at from orders where action_taken_at > ? AND action_taken_at < ? AND verified = ? AND ('. $employees_confirmed_query .')', [$day,$day_2,6]);
            $canceled_orders= DB::select('SELECT action_taken_by,action_taken_at from orders where action_taken_at > ? AND action_taken_at < ? AND verified = ? AND ('. $employees_confirmed_query .')', [$day,$day_2,3]);

            $svm_orders= DB::select('SELECT send_svm_by,send_svm_at from orders where send_svm_at > ? AND send_svm_at < ? AND ('. $employees_svm_query .')', [$day,$day_2]);
            $category_orders= DB::select('SELECT categorised_by,categorised_at from orders where categorised_at > ? AND categorised_at < ? AND ('. $employees_category_query .')', [$day,$day_2]);

        /* end */

        return ['confirmed_orders'=> $confirmed_orders,
                'canceled_orders'=> $canceled_orders,
                'svm_orders'=> $svm_orders,
                'category_orders'=> $category_orders];
    }

    function getComplaintsAnalytics($employee_filter,$day,$employees){

        $day_2=date('Y-m-d', strtotime($day .' +1 day'));


        /* setting up query of select DB */

            $employees_replies_query="";
            $employees_solved_query="";


            foreach ($employees as $key => $employee) {
                $employees_replies_query = $employees_replies_query. ' replied_by LIKE '.'"%'. $employee->name .'%"' . ' OR';

                $employees_solved_query = $employees_solved_query. ' solved_by LIKE '.'"%'. $employee->name .'%"' . ' OR';

            }
            
            $employees_replies_query=substr($employees_replies_query, 0, -2);
            $employees_solved_query=substr($employees_solved_query, 0, -2);
        
        /*  DB select four categorise of verification points */

            $complaints_replies= DB::select('SELECT replied_by,replied_at from complaints_replies where replied_at > ? AND replied_at < ? AND side = ? AND ('. $employees_replies_query .')', [$day,$day_2,0]);
            $complaints_solved= DB::select('SELECT solved_by,solved_at from complains where solved_at > ? AND solved_at < ? AND solved = ? AND ('. $employees_solved_query .')', [$day,$day_2,1]);

            $complaints_rated= DB::select('SELECT solved_by,rating from complains where rating > ? AND ('. $employees_solved_query .')', [0]);

        /* end */

        return ['complaints_replies'=> $complaints_replies,
                'complaints_solved'=> $complaints_solved,
                'complaints_rated'=> $complaints_rated ];
    }

    function complaints_Rates_employees (){

        $employees = ['Bassant'=>'Bassant','samar'=>'Samar','Nehal'=>'Nehal' ,'Sanaa Osama'=>'Sanaa',''=>'Others'];
        $complaint_rate_date = [];

        foreach ($employees as $key => $value) {
            $complaint_rate_date [$value] =[];
            if ( $key != '') {
                for ($i=1; $i <= 5 ; $i++) { 
                    $rate= DB::select('SELECT COUNT(id) as value FROM kshopina.complains where solved = 1 and rating = ? and solved_by =? ',[$i,$key]);
                    
                    array_push($complaint_rate_date [$value], $rate[0]->value);
                }
            } else {
                for ($i=1; $i <= 5 ; $i++) { 
                    $rate= DB::select('SELECT COUNT(id) as value FROM kshopina.complains where solved = 1 and rating = ? 
                    and solved_by not in ("Bassant","samar","Nehal","Sanaa Osama") ',[$i]);

                    array_push($complaint_rate_date [$value], $rate[0]->value);
                }
            }
        }

        $rate_1= DB::select('SELECT COUNT(id) as value FROM kshopina.complains where solved = 1 and rating = 1 ');
        $rate_2= DB::select('SELECT COUNT(id) as value FROM kshopina.complains where solved = 1 and rating = 2 ');
        $rate_3= DB::select('SELECT COUNT(id) as value FROM kshopina.complains where solved = 1 and rating = 3 ');
        $rate_4= DB::select('SELECT COUNT(id) as value FROM kshopina.complains where solved = 1 and rating = 4 ');
        $rate_5= DB::select('SELECT COUNT(id) as value FROM kshopina.complains where solved = 1 and rating = 5 ');

        return [ 
            $complaint_rate_date,
            $rate_1[0]->value,
            $rate_2[0]->value,
            $rate_3[0]->value,
            $rate_4[0]->value,
            $rate_5[0]->value
        ];

    }

    function getTstAnalytics($employee_filter,$day,$employees){
        
        $day_2=date('Y-m-d', strtotime($day .' +1 day'));

         /* setting up query of select DB */

         
        /*  DB select four categorise of verification points */


        /* end */
    }
    
}
