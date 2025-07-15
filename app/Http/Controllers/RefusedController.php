<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RefusedController extends Controller
{
    protected $ordersModel;
    protected $internationalModel;

    public function __construct(Request $request)
    {
        $this->middleware('auth');
        $this->ordersModel = new \App\Models\Orders();
        $this->internationalModel = new \App\Models\International();
    }

    function index()
    {
        $page = $_GET['page'];
        $orders = $this->ordersModel->refused_page($page);

        return view('refused_order')->with([
            'orders' => $orders[1], 'number_of_orders' => $orders[0],
            'all_orders'=>$orders[5],
            'pending' => $orders[2],
            'delivered' => $orders[3],
            'refused' => $orders[4]
        ]);
    }
}
