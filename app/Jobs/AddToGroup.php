<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use App\Mail\GroupStatusMail;
use Illuminate\Support\Facades\Mail;

class AddToGroup implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    private $order;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($order)
    {
        $this->order = $order;

    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        
        date_default_timezone_set('Africa/Cairo');
        $date = date('Y-m-d H:i:s', time());


        $city_data = DB::select('select * from Zones where city = ?', [$this->order->city]);
        
        foreach ($city_data as $city) {

            $groups= DB::select('SELECT group_id,group_city_id,count(group_city_id) AS NumberOfOrders FROM group_orders where group_city_id= ?
                                 group by group_city_id,group_id having count(group_city_id) < ? order by group_id ASC;', [$city->id,15]);

            if (count($groups) !=0) {
                foreach ($groups as $group) {
                    $group_city_id=$city->id;
                    $group_id= $group->group_id;

                    $groups= DB::select('SELECT * FROM group_orders where group_id= ? AND group_city_id = ? order by customer_rank ASC;', [$group_id,$group_city_id]);

                    $customer_rank = $groups[count($groups)-1]->customer_rank +1;

                    break;
                }

                $mode=0;
            } else {
                $groups= DB::select('SELECT group_id,group_city_id,count(group_city_id) AS NumberOfOrders FROM group_orders where group_city_id= ?
                                 group by group_city_id,group_id order by group_id ASC;', [$city->id]);

                if (count($groups) !=0) {
                    $group_city_id=$city->id;
                    $group_id= count($groups)+1;
                    $customer_rank = 1;
                    $mode=1;
                } else {
                    $group_city_id=$city->id;
                    $group_id= 1;
                    $customer_rank = 1;
                    $mode=2;
                }
            }
            
        }

        DB::table('group_orders')->where('group_orders_id',$this->order->group_orders_id)->update(['status'=>2,'group_city_id'=>$group_city_id,'group_id'=>$group_id,'customer_rank'=>$customer_rank,
        'replied_at'=>$date,'updated_at'=>$date]);

        DB::insert('insert into group_orders_records (customer_name,case_name, order_id,group_id) values (?,?, ?,?)', 
        [$this->order->customer_name,"Join", $this->order->group_orders_id,sprintf("%02d", $group_city_id).sprintf("%02d",$group_id)]);


        $data1 = [
            'order_id' => $this->order->group_orders_id,
            'group_id' => 'G'.sprintf("%02d", $group_city_id).sprintf("%02d",$group_id),
            'customer_rank' => $customer_rank,
            'url' => url('') . '/' . "group_order?group_id=" . 'G'.sprintf("%02d", $group_city_id).sprintf("%02d",$group_id).'&order_id='.$this->order->group_orders_id,
            ];

        Mail::to($this->order->email)->send(new GroupStatusMail($data1), function ($message) {
            $message->subject("Kshopina - EG (Group Order Summary)");
        });

        /* $id = DB::table('group_orders')->insertGetId(['email'=>$this->data['email'],'city'=>$city_name,
        'created_at'=>$this->date,'updated_at'=>$this->date,
        'created_by'=>'customer','status'=>0,'customer_name'=>$this->data['customer_name'],'contact_number'=>$this->data['phone'],
        'address'=>$this->data['address'],'shipping_rate'=> $rate,'final_price'=>$this->data['final_price'],
         ]); */

         

    }
}
