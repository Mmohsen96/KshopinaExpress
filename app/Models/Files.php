<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Files extends Model
{
    use HasFactory;

    function save_file($data)
    {
        date_default_timezone_set('Asia/Seoul');
        $date = date('Y-m-d H:i:s', time());

        DB::table('files')->insert([
            'file_name' => $data['file_name'],
            'status' => $data['status'],
            'url' => $data['url'],
            'user_name'=>$data['user_name'],
            'completed_at'=>$date
        ]);
    }
    function get_files_data(){
        return DB::select('select * from files');
/*         return DB::table('files')->get();
 */    }
}
