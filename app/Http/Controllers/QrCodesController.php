<?php

namespace App\Http\Controllers;

use App\Mail\RefusedOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use App\Mail\WrongPhoneMail;

class QrCodesController extends Controller
{
    protected $ordersModel;
    protected $qrModel;
    protected $itemsModel;
    protected $historyModel;

    public function __construct(Request $request)
    {
        /*         $this->middleware('auth');
 */
        $this->ordersModel = new \App\Models\Orders();
        $this->qrModel = new \App\Models\QRcode();
        $this->itemsModel = new \App\Models\Items();
        $this->historyModel=new \App\Models\History();

    }

    function index()
    {
        $user = Auth::user();
        $page = $_GET['page'];
        $orders = $this->ordersModel->QR_codes_order($user->country, $page);

        /* $obj = json_encode($orders[1]);

echo "<script>console.log(JSON.parse('" . $obj . "'))</script>"; */

        return view('QRcode')->with(['orders' => $orders[1], 'number_of_orders' => $orders[0]]);
    }


    function generate()
    {
        ignore_user_abort();
        $order_number = $_POST['order'];
        $qr = $this->qrModel->isExist($order_number);
        $kshopina_url = config('app.url');

        $order = $this->ordersModel->getorderbynumber($order_number);
        $order = $order[0]->kshopina_awb;

        if (!$qr[0]) {

            $imageName = $order_number . time() . '.png';
            $output_file = '/qr-code/img-' . $imageName;

            $url = 'uploads' . $output_file;

            $identifier = $this->qrModel->create_qr($order_number, $url);

            $image = QrCode::format('png')
                ->size(140)->errorCorrection('H')
                ->generate($kshopina_url . '/scan?token=' . $identifier);

            Storage::disk('public')->put($output_file, $image);

            $finalUrl = $url . "?token=" . $identifier;



            //merging
            $image1 = 'original2.jpg';
            $image2 = $url;

            list($width, $height) = getimagesize($image2);

            $image1 = imagecreatefromstring(file_get_contents($image1));
            $image2 = imagecreatefromstring(file_get_contents($image2));

            //string to image kshopina AWB
            $im = imagecreate(100, 20); // image size 150x20px
            imagecolorallocate($im, 255, 255, 255); // background white
            $text_color = imagecolorallocate($im, 0, 0, 0); // text color black
            imagestring($im, 9, 5, 5, $order, $text_color);


            //string to image order number
            $im2 = imagecreate(100, 20); // image size 150x20px
            imagecolorallocate($im2, 255, 255, 255); // background white
            $text_color = imagecolorallocate($im2, 0, 0, 0); // text color black
            /*         $font = imageloadfont('fonts/proxima_ssv/ProximaNova-Regular.otf');
 */

            imagestring($im2, 9, 5, 5, '#' . $order_number, $text_color);

            //merge
            imagecopymerge($image1, $image2, 400, 110, 0, 0, $width, $height, 100);
            imagecopymerge($image1, $im, 435, 255, 0, 0, 100, 20, 100);
            imagecopymerge($image1, $im2, 437, 83, 0, 0, 100, 20, 100);

            //save
            header('Content-Type:image/png');

            imagepng($image1, $url);
            imagedestroy($image1);
            $this->historyModel->create(Auth::user()->name,'QR code','Generate QR code for order number #'.$order_number);

/*             sleep(70);
 */            return [$finalUrl, $kshopina_url . '/scan?token=' . $identifier];
        } else {

            foreach ($qr[1] as $key => $value) {
                $url = $value->url;
                $identifier = $value->identifier;
            }

/*             sleep(70);
 */            return [$url, $kshopina_url . '/scan?token=' . $identifier];
        }

    }

    function scan()
    {
        $identifier = $_GET['token'];

        if ($this->qrModel->checkStatus($identifier)) {
            return view('scan_qr');
        } else {
            return view('wrong_access');
        }
    }
    function delivered(){
        ignore_user_abort();
        $identifier = $_POST['identifier'];

        if ($this->qrModel->checkStatus($identifier)) {

            $qr = $this->qrModel->getByIdentifier($identifier);
            foreach ($qr as $key => $value) {
                $order_number = $value->order_number;
            }

            $order = $this->ordersModel->getorderbynumber($order_number);
            foreach ($order as $key => $value) {
                $order_id = $value->order_id;
            }
            $gateway = $this->ordersModel->delivered($order_number);

            $this->qrModel->close_QR($identifier);
            
/*             $URI_Response = $this->qrModel->delivered($identifier, $order_id, $gateway);
 */
            $this->qrModel->updateInternational($order_number, ['delivered' => $date = date('Y-m-d H:i:s', time())]);

            /*  $obj = json_encode($URI_Response);

            echo "<script>console.log(JSON.parse('" . $obj . "'))</script>"; */
            $this->historyModel->create("unknown",'QR code','Mark order as delivered for order number #'.$order_number);

            return [true];
        } else {
            return [false, view('wrong_access')];
        }
    }
    function delivered_process()
    {
        ignore_user_abort();
        $order_number = $_POST['order'];

            $order = $this->ordersModel->getorderbynumber($order_number);
            foreach ($order as $key => $value) {
                $order_id = $value->order_id;
            }
            $gateway = $this->ordersModel->delivered($order_number);

            $this->qrModel->delivered($order_id, $gateway);

            /*  $obj = json_encode($URI_Response);

            echo "<script>console.log(JSON.parse('" . $obj . "'))</script>"; */
            $this->historyModel->create(Auth::user()->name,'Delivered orders','Delivered Action taken for order number #'.$order_number);
            $this->ordersModel->action_taken($order_number,1);

      
    }
    function wrongPhone()
    {
        ignore_user_abort();
        $identifier = $_POST['identifier'];

        if ($this->qrModel->checkStatus($identifier)) {
            $qr = $this->qrModel->getByIdentifier($identifier);
            foreach ($qr as $key => $value) {
                $order_number = $value->order_number;
            }

            $order = $this->ordersModel->getorderbynumber($order_number);

            foreach ($order as $key => $value) {
                $customer_email = $value->email;
                $customer_name = $value->name;
            }
            $data = [
                'name' => $customer_name
            ];

            Mail::to($customer_email)->send(new WrongPhoneMail($data), function ($message) {
                $message->subject("Update Your Phone number");
            });
            $this->historyModel->create("unknown",'QR code','Mark order as wrong phone for order number #'.$order_number);

            return [true];
        } else {
            return [false, view('wrong_access')];
        }
    }

    function refused()
    {
        ignore_user_abort();
        $identifier = $_POST['identifier'];
        if ($this->qrModel->checkStatus($identifier)) {

            $qr = $this->qrModel->getByIdentifier($identifier);
            foreach ($qr as $key => $value) {
                $order_number = $value->order_number;
            }

            $order = $this->ordersModel->getorderbynumber($order_number);
            foreach ($order as $key => $value) {
                $order_id = $value->order_id;
                $order_country = $value->country;
                $customer_email = $value->email;
                $customer_name = $value->name;
            }
            $data = [
                'name' => $customer_name
            ];

            Mail::to($customer_email)->send(new RefusedOrder($data), function ($message) {
                $message->subject("Rejected Order");
            });

            $test = $this->qrModel->close_QR($identifier);

            $URI_Response = $this->ordersModel->refused($order_number);

            $this->qrModel->updateInternational($order_number, ['delivered' => $date = date('Y-m-d H:i:s', time())]);
          
            $this->historyModel->create("unknown",'QR code','Mark order as refused for order number #'.$order_number);

            return [true, $test];
        } else {
            return [false, view('wrong_access')];
        }
    }
    function refused_process()
    {
        $order_number = $_POST['order'];
        $All_products = [];
        $All_dublicated_products = [];


        $order = $this->ordersModel->getorderbynumber($order_number);
        foreach ($order as $key => $value) {
            $order_country = $value->country;
        }
        ignore_user_abort();
        if ($order_country == 'Egypt' || $order_country == 'Saudi Arabia' || $order_country == 'Kuwait') {

            $order_items = $this->itemsModel->getItems($order_number);

            foreach ($order_items as $key => $value) {

                $product_id = $value->product_id;
                $variant_id = $value->variant_id;
                $old_title = $value->product_name;
                $old_sku = $value->sku;
                $quantity = $value->quantity;

                
                $check_product = $this->itemsModel->is_product_exist($product_id, $order_country);

                if ($value->country_code == "KR") {

                    if ($check_product == null) {

                        if (!in_array($product_id, $All_products)) {


                            $new_title = $old_title . " [Sky Premium - " . $order_country . " Only]";
                            $duplicate_order_id = $this->itemsModel->duplicateProduct($new_title, $product_id);

                            $duplicate_order_variant = $this->itemsModel->getProduct($duplicate_order_id, $old_sku);


                            $duplicate_order_sku = $this->itemsModel->changeSKU($old_sku, $duplicate_order_variant[0], $order_country);

                            $duplicate_order_locations = $this->itemsModel->get_inventory_locations($duplicate_order_variant[1]);

                            $duplicate_order = $this->itemsModel->set_available($duplicate_order_locations, $order_country, $quantity, $duplicate_order_variant[1]);

                            $this->itemsModel->add_tag($product_id, $duplicate_order_id, $order_country);


                            for ($i = 0; $i < count($duplicate_order_variant[2]); $i++) {
                                $this->itemsModel->changeSKU($duplicate_order_variant[3][$i], $duplicate_order_variant[2][$i], $order_country);
                                $remaining_order_locations = $this->itemsModel->get_inventory_locations($duplicate_order_variant[4][$i]);
                                $duplicate_order = $this->itemsModel->set_available($remaining_order_locations, $order_country, 0, $duplicate_order_variant[4][$i]);
                            }

                            array_push($All_products, $product_id);
                            array_push($All_dublicated_products, $duplicate_order_id);
                        } else {
                            $index = array_search($product_id, $All_products);
                            $product_id = $All_dublicated_products[$index];

                            $duplicate_order_variant = $this->itemsModel->getProduct($product_id, $old_sku);

                            $duplicate_order_sku = $this->itemsModel->changeSKU($old_sku, $duplicate_order_variant[0], $order_country);

                            $duplicate_order_locations = $this->itemsModel->get_inventory_locations($duplicate_order_variant[1]);

                            $duplicate_order = $this->itemsModel->set_available($duplicate_order_locations, $order_country, $quantity, $duplicate_order_variant[1]);
                        }
                    } else {
                        $duplicate_order_variant = $this->itemsModel->getProduct($check_product, $old_sku);

                        if ($duplicate_order_variant[0] == "NOT FOUND") {
                            $this->itemsModel->delete_tag($product_id, $order_country);

                            if (!in_array($product_id, $All_products)) {


                                $new_title = $old_title . " [Sky Premium - " . $order_country . " Only]";
                                $duplicate_order_id = $this->itemsModel->duplicateProduct($new_title, $product_id);

                                $duplicate_order_variant = $this->itemsModel->getProduct($duplicate_order_id, $old_sku);


                                $duplicate_order_sku = $this->itemsModel->changeSKU($old_sku, $duplicate_order_variant[0], $order_country);

                                $duplicate_order_locations = $this->itemsModel->get_inventory_locations($duplicate_order_variant[1]);

                                $duplicate_order = $this->itemsModel->set_available($duplicate_order_locations, $order_country, $quantity, $duplicate_order_variant[1]);

                                $this->itemsModel->add_tag($product_id, $duplicate_order_id, $order_country);


                                for ($i = 0; $i < count($duplicate_order_variant[2]); $i++) {
                                    $this->itemsModel->changeSKU($duplicate_order_variant[3][$i], $duplicate_order_variant[2][$i], $order_country);
                                    $remaining_order_locations = $this->itemsModel->get_inventory_locations($duplicate_order_variant[4][$i]);
                                    $duplicate_order = $this->itemsModel->set_available($remaining_order_locations, $order_country, 0, $duplicate_order_variant[4][$i]);
                                }

                                array_push($All_products, $product_id);
                                array_push($All_dublicated_products, $duplicate_order_id);
                            } else {
                                $index = array_search($product_id, $All_products);
                                $product_id = $All_dublicated_products[$index];

                                $duplicate_order_variant = $this->itemsModel->getProduct($product_id, $old_sku);

                                $duplicate_order_sku = $this->itemsModel->changeSKU($old_sku, $duplicate_order_variant[0], $order_country);

                                $duplicate_order_locations = $this->itemsModel->get_inventory_locations($duplicate_order_variant[1]);

                                $duplicate_order = $this->itemsModel->set_available($duplicate_order_locations, $order_country, $quantity, $duplicate_order_variant[1]);
                            }
                        } else {
                            $duplicate_order_locations = $this->itemsModel->get_inventory_locations($duplicate_order_variant[1]);

                            $duplicate_order = $this->itemsModel->adjust_available($duplicate_order_locations, $order_country, $quantity, $duplicate_order_variant[1]);
                        }
                    }
                } else {
                    $duplicate_order_variant = $this->itemsModel->getProduct($product_id, $old_sku);

                    $duplicate_order_locations = $this->itemsModel->get_inventory_locations($duplicate_order_variant[1]);

                    $duplicate_order = $this->itemsModel->adjust_available($duplicate_order_locations, $order_country, $quantity, $duplicate_order_variant[1]);
                }
            }
        }
        $this->historyModel->create(Auth::user()->name,'Refused orders','Refused Action taken for order number #'.$order_number);
        $this->ordersModel->refused($order_number);
        $this->ordersModel->action_taken($order_number,2);
        /*         return $duplicate_order_id;
 */
    }

    function refused_cancel()
    {
        $order_number = $_POST['order'];
        $this->ordersModel->action_taken($order_number,3);
        $this->historyModel->create(Auth::user()->name,'Refused orders','No Action taken for order number #'.$order_number);

    }

    function contact_support()
    {
        $status = $_POST["contact"];
        $identifier = $_POST["id"];

        $qr = $this->qrModel->getByIdentifier($identifier);
        foreach ($qr as $key => $value) {
            $order_number = $value->order_number;
        }

        $order = $this->ordersModel->getorderbynumber($order_number);
        foreach ($order as $key => $value) {
            $order_status = $value->status;
            $order_country = $value->country;
        }

        $this->qrModel->contact_support($order_status, $status, $order_country, $order_number);
    }
    function support_change()
    {
        ignore_user_abort();

        $order_number = $_POST['order'];
        $order_status = $_POST['status'];

        $this->qrModel->support_change_status($order_number);
        if ($_POST['first'] != "#") {
            $this->ordersModel->change_spacific_status($order_number, $order_status);
        }

        $this->historyModel->create(Auth::user()->name,'Requests','order status changed for order number #'.$order_number);

    }
    function requests()
    {
        $page = $_GET['page'];
        $orders = $this->ordersModel->requests_order($page);
        $counter = $this->qrModel->count_requests();
        /* $obj = json_encode($orders[1]);

        echo "<script>console.log(JSON.parse('" . $obj . "'))</script>"; */

        return view('requests')->with(
            [
                'orders' => $orders[1],
                'number_of_orders' => $orders[0],
                'all_requests' => $counter[0],
                'egypt' => $counter[1],
                'kuwait' => $counter[2],
                'ksa' => $counter[3]
            ]
        );
    }
    function wrong_access()
    {
        $identifier = $_GET['token'];

        if ($this->qrModel->checkStatus($identifier)) {
            return view('scan_qr');
        } else {
            return view('wrong_access');
        }
    }
}
