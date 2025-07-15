<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class History extends Model
{
    function create($user,$page,$process){
        
        DB::table('history')->insert([
            'user' => $user,
            'page' => $page,
            'process' => $process
        ]);
        
    }

    function create_kmex($user,$process,$message,$shipment_id){
        
        DB::table('kmex_history')->insert([
            'user_id' => $user,
            'process' => $process,
            'message' => $message,
            'shipment_id' => $shipment_id

        ]);
        
    }
    use HasFactory;
}
