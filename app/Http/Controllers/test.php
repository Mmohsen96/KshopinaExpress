<?php
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

DB::table('errors')->where('error_id','1723')
                            ->update(['system_name' => 'mahmoud mohsen', 'message' => 'mahmoud']);
?>