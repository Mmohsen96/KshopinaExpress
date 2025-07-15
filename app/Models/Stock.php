<?php

namespace App\Models;

use GuzzleHttp\Client as guzzle;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Milon\Barcode\Facades\DNS1DFacade;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Stock extends Model
{
    use HasFactory;

    protected $locations;
    protected $country_to_store;

    public function __construct()
    {
        $this->locations = ['plus_egypt' => '65388675257', 'plus_ksa' => '64379879580', 'plus_kuwait' => '66254045432','plus_uae'=>'81097130268'];
        $this->country_to_store = ['Egypt' => 'plus_egypt', 'Saudi Arabia' => 'plus_ksa', 'Kuwait' => 'plus_kuwait','United Arab Emirates'=>'plus_uae',
        'Bahrain'=>'bahrain','Qatar'=>'qatar','Oman'=>'oman','Jordan'=>'jordan'];

    }


    public function get_all_products($store)
    {
        return DB::select('SELECT * FROM stock where store = ? ORDER BY product_title ASC ;', [$store]);
    }
    public function get_product($id)
    {
        return DB::select('select * from stock where id = ? ', [$id]);
    }
    public function get_variants($id)
    {
        return DB::select('select * from variants where product_id = ? ', [$id]);
    }
    public function get_variant($sku_or_bar,$store)
    {
        if ($store=='plus_egypt' || $store=='plus_ksa') {
            return DB::select('SELECT variants.id,variants.variant_price,variants.variant_quantity,variants.variant_title,stock.product_title
                                    FROM variants
                                    INNER JOIN stock
                                    ON variants.product_id = stock.id
                                    WHERE variants.id = ? AND stock.store= ?;', [$sku_or_bar,$store]);
        } else {
            return DB::select('SELECT variants.id,variants.variant_price,variants.variant_quantity,variants.variant_title,stock.product_title
                                    FROM variants
                                    INNER JOIN stock
                                    ON variants.product_id = stock.id
                                    WHERE variants.variant_sku = ? AND stock.store= ?;', [$sku_or_bar,$store]);
        }
        
        
    }

    public function generate_barcode($variant_id)
    {
        if (!file_exists(public_path('uploads/products'))) {
            mkdir(public_path('uploads/products'), 0777, true);
        }

        $imageName = 'bar-' . $variant_id . '-' . time() . '.png';
        $output_file = '/products/' . $imageName;

        /* $url = public_path('uploads') . $output_file; */

        $image = DNS1DFacade::getBarcodePNG($variant_id, 'C39', 1, 50, array(1, 1, 1), true);

        Storage::disk('public')->put($output_file, base64_decode($image));

        DB::update('update variants set barcode_image_name = ? where id = ?', [$imageName, $variant_id]);

        return $imageName;
    }
    public function barcode_is_exist($variant_id)
    {
        $variant = DB::select('select * from variants where id = ?', [$variant_id]);

        if ($variant != [] && $variant != null) {
            if ($variant[0]->barcode_image_name != null || $variant[0]->barcode_image_name != "") {
                if (!file_exists(public_path('uploads/products/' . $variant[0]->barcode_image_name))) {
                    return [false, 'No barcode yet!'];
                } else {
                    return [true, $variant[0]->barcode_image_name];
                }
            } else {
                return [false, 'No barcode yet!'];
            }
        } else {
            return [false, 'Variant not found!'];
        }
    }
    public function add_in_stock($variants,$variants_id, $quantity,$store)
    {
        if (isset($this->locations[$store]) ) {
            $location =$this->locations[$store];
        }

        foreach ($variants as $variant_id => $source_name) {

            if ($store=='plus_egypt' || $store=='plus_ksa') {
                if ($source_name != 'deleted') {
                    $variant = DB::select('SELECT * from variants where id = ? ', [$variant_id]);
                } else {
                    continue;
                }
            } else {
                if ($source_name != 'deleted') {
                    $variant = DB::select('SELECT * from variants where id = ? ', [$variants_id[$variant_id]]);
                } else {
                    continue;
                }
            }
            

            $query['variant_id'] = $variant[0]->id;
            $query['product_id'] = $variant[0]->product_id;

            $old_quantity = $variant[0]->variant_quantity;

            $query['operation'] = "IN";
            $query['adjustment'] = $quantity[$variant_id];

            $query['operation_side'] = $source_name;
            $new_quantity = $quantity[$variant_id] + $old_quantity;
            $all_quantity = $variant[0]->variant_all_quantity + $quantity[$variant_id];

            $query['store'] = $store;

            date_default_timezone_set('Africa/Cairo');
            $date = date('Y-m-d H:i:s', time());

            $query['adjustment_at'] = $date;

            $query['last_quantity'] = $old_quantity;

            $query['adjust_by'] = Auth::user()->name;

            DB::table('stock_history')->insert($query);

            DB::table('variants')
                ->where(['id' => $variant[0]->id])
                ->update(['variant_quantity' => $new_quantity, 'variant_all_quantity' => $all_quantity, 'updated_at' => $date]);

            if (isset($this->locations[$store]) ) {
                $this->adjust_available($location, $quantity[$variant_id], $variant[0]->variant_inventory_id);
            }

        }

    }

   

    public function add_out_stock($variants,$variants_id, $quantity, $discount, $payment ,$store)
    {
        if (isset($this->locations[$store]) ) {
            $location =$this->locations[$store];
        }
        date_default_timezone_set('Africa/Cairo');
        $date = date('Y-m-d H:i:s', time());

        $total_price=0;
        $offline_order_id=0;
        $first=0;

        foreach ($variants as $variant_id => $source_name) {

            if ($store=='plus_egypt' || $store=='plus_ksa') {
                if ($source_name != 'deleted') {
                    $variant = DB::select('SELECT * from variants where id = ? ', [$variant_id]);
                } else {
                    continue;
                }
            } else {
                if ($source_name != 'deleted') {
                    $variant = DB::select('SELECT * from variants where id = ? ', [$variants_id[$variant_id]]);
                } else {
                    continue;
                }
            }

            $query['variant_id'] = $variant[0]->id;
            $query['product_id'] = $variant[0]->product_id;

            $old_quantity = $variant[0]->variant_quantity;

            $query['operation'] = "OUT";
            $query['adjustment'] = $quantity[$variant_id];

            if ($source_name == 'Offline') {
                $query['discount'] = $discount[$variant_id];

                $total_price += $variant[0]->variant_price;
                if ($first==0) {
                    $offline_order_id= DB::table('offline_orders')->insertGetId(['store'=>$store,'offline_created_at'=>$date]);
                    $first=1;
                }

                $query['order_number']=$offline_order_id;

            } else {
                $query['discount'] = 0;
            }

            $query['operation_side'] = $source_name;
            $new_quantity = $old_quantity - $quantity[$variant_id];

            $query['store'] = $store;

            $query['gateway'] = $payment[$variant_id];

            $query['adjustment_at'] = $date;

            $query['last_quantity'] = $old_quantity;

            $query['adjust_by'] = Auth::user()->name;
           
           DB::table('stock_history')->insert($query);
 
            DB::table('variants')
                ->where(['id' => $variant[0]->id])
                ->update(['variant_quantity' => $new_quantity, 'updated_at' => $date]); 


            $adjustment = -1 * abs($quantity[$variant_id]);
            $quantity[$variant_id] - ($quantity[$variant_id] * 2);

            if (isset($this->locations[$store]) ) {
                $this->adjust_available($location, $adjustment, $variant[0]->variant_inventory_id);
            }

        }

        if ($total_price >0) {
            DB::table('offline_orders')->where('offline_order_id',$offline_order_id)->update(['total_price'=>$total_price]);
        }
        

    }

    public function get_products($store, $rule, $page, $id)
    {

        $products_per_page = 15;
        $offset = ($page - 1) * $products_per_page;

        if ($rule == "All") {

            if ($id == "") {
                $products = DB::select('SELECT product_title,product_type,product_cover_image, t1.id,sum(variant_quantity) as quantity,count(*) as number_of_variants
                                        from stock as t1 inner join variants as t2 on t1.id=t2.product_id where store = ? group by t1.product_id ,t1.id ORDER BY product_title ASC LIMIT ?, ?;',
                    [$store, $offset, $products_per_page]);

                $number_of_products = DB::select('SELECT COUNT(id) AS NumberOfProducts FROM kshopina.stock where store = ?;', [$store]);

            } else {
                $products = DB::select('SELECT product_title,product_type,product_cover_image, t1.id,sum(variant_quantity) as quantity,count(*) as number_of_variants
                                        from stock as t1 inner join variants as t2 on t1.id=t2.product_id where t1.id=? AND store = ? group by t1.product_id ,t1.id ORDER BY product_title ASC LIMIT ?, ?;',
                    [$id, $store, $offset, $products_per_page]);

                $number_of_products = DB::select('SELECT COUNT(id) AS NumberOfProducts FROM kshopina.stock where store = ? AND id = ?;', [$store, $id]);

            }

        } else {

            $products = DB::select('SELECT product_title,product_type,product_cover_image, t1.id,sum(variant_quantity) as quantity,count(*) as number_of_variants
                                    from stock as t1 inner join variants as t2 on t1.id=t2.product_id where product_type = ? AND store = ?
                                    group by t1.product_id ,t1.id ORDER BY product_title ASC LIMIT ?, ?;', [$rule, $store, $offset, $products_per_page]);

            $number_of_products = DB::select('SELECT COUNT(id) AS NumberOfProducts FROM kshopina.stock where product_type = ? AND store = ?;', [$rule, $store]);
        }

        $number_of_pre_alert = DB::select('SELECT COUNT(id) AS NumberOfProducts FROM stock where store = ? AND id IN (SELECT product_id FROM kshopina.variants GROUP BY product_id HAVING sum(variant_quantity) <= 2)', [$store]);

        return [
            $number_of_products, $products, $number_of_pre_alert,
        ];
    }
    public function get_expired_products($store, $rule, $page)
    {

        $products_per_page = 15;
        $offset = ($page - 1) * $products_per_page;

        /* $products = DB::select('SELECT * FROM stock where store = ? ORDER BY product_title DESC ;', [$store]);
        $total_quantity = $this->refresh_all_variants_quantity($products); */

        if ($rule == "All") {

            $products = DB::select('SELECT product_title,product_type,product_cover_image, t1.id,sum(variant_quantity) as quantity,count(*) as number_of_variants
            from stock as t1 inner join variants as t2 on t1.id=t2.product_id where store = ? group by t1.product_id ,t1.id HAVING sum(variant_quantity) = 0
            ORDER BY product_title ASC LIMIT ?, ?;', [$store, $offset, $products_per_page]);

            $number_of_products = DB::select('SELECT COUNT(id) AS NumberOfProducts FROM stock where store = ? AND id IN (SELECT product_id FROM kshopina.variants GROUP BY product_id HAVING sum(variant_quantity) = 0)', [$store]);
        } else {

            $products = DB::select('SELECT product_title,product_type,product_cover_image, t1.id,sum(variant_quantity) as quantity,count(*) as number_of_variants
            from stock as t1 inner join variants as t2 on t1.id=t2.product_id where product_type = ? AND store = ? group by t1.product_id ,t1.id HAVING sum(variant_quantity) = 0
            ORDER BY product_title ASC LIMIT ?, ?;', [$rule, $store, $offset, $products_per_page]);

            $number_of_products = DB::select('SELECT COUNT(id) AS NumberOfProducts FROM kshopina.stock where product_type = ? AND store = ? AND id IN (SELECT product_id FROM kshopina.variants GROUP BY product_id HAVING sum(variant_quantity) = 0)', [$rule, $store]);
        }

        $number_of_pre_alert = DB::select('SELECT COUNT(id) AS NumberOfProducts FROM stock where store = ? AND id IN (SELECT product_id FROM kshopina.variants GROUP BY product_id HAVING sum(variant_quantity) <= 2)', [$store]);

        return [
            $number_of_products, $products, $number_of_pre_alert,
        ];
    }

    public function get_pre_alert_products($store, $rule, $page)
    {

        $products_per_page = 15;
        $offset = ($page - 1) * $products_per_page;

        /* $products = DB::select('SELECT * FROM stock where store = ? ORDER BY updated_at DESC ;', [$store]);
        $total_quantity = $this->refresh_all_variants_quantity($products); */

        if ($rule == "All") {

            $products = DB::select('SELECT product_title,product_type,product_cover_image, t1.id,sum(variant_quantity) as quantity,count(*) as number_of_variants
            from stock as t1 inner join variants as t2 on t1.id=t2.product_id where store = ? group by t1.product_id ,t1.id HAVING sum(variant_quantity) <= 2
            ORDER BY product_title ASC LIMIT ?, ?;', [$store, $offset, $products_per_page]);

            $number_of_products = DB::select('SELECT COUNT(id) AS NumberOfProducts FROM stock where store = ? AND id IN (SELECT product_id FROM kshopina.variants GROUP BY product_id HAVING sum(variant_quantity) <= 2)', [$store]);
        } else {

            $products = DB::select('SELECT product_title,product_type,product_cover_image, t1.id,sum(variant_quantity) as quantity,count(*) as number_of_variants
            from stock as t1 inner join variants as t2 on t1.id=t2.product_id where product_type = ? AND store = ? group by t1.product_id ,t1.id HAVING sum(variant_quantity) <= 2
            ORDER BY product_title ASC LIMIT ?, ?;', [$rule, $store, $offset, $products_per_page]);

            $number_of_products = DB::select('SELECT COUNT(id) AS NumberOfProducts FROM kshopina.stock where product_type = ? AND store = ? AND id IN (SELECT product_id FROM kshopina.variants GROUP BY product_id HAVING sum(variant_quantity) <= 2)', [$rule, $store]);
        }

        $number_of_pre_alert = $number_of_products;

        return [
            $number_of_products, $products, $number_of_pre_alert,
        ];
    }
    public function get_number_pre_alert_products($store)
    {
        return DB::select('SELECT COUNT(id) AS NumberOfProducts FROM stock where store = ? AND id IN (SELECT product_id FROM kshopina.variants GROUP BY product_id HAVING sum(variant_quantity) <= 2)', [$store]);

    }
    public function products_like($store, $value, $filter)
    {
        $value = $value . '%';
        if ($filter == "Album") {
            return DB::select('SELECT * FROM stock WHERE store = ? AND product_title LIKE "' . $value . '" ', [$store]);
        } else {
            return DB::select('SELECT * FROM stock WHERE store = ? AND product_type LIKE "' . $value . '" ', [$store]);
        }
    }
    public function adjust_available($location, $quantity, $inventory_item_id)
    {
        $store = array_search ($location, $this->locations);


        $shopify_token = DB::table('config')->where('keyy', $store)->get()[0]->value;
        $store_myshopify_url = DB::table('config')->where('keyy', $store . '_myshopify')->get()[0]->value;

        $client = new guzzle([
            'headers' => [
                'Content-Type' => 'application/json',
                'X-Shopify-Access-Token' => $shopify_token,
                'debug' => true,
            ],
            "ssl" => [
                "verify_peer" => false,
                "verify_peer_name" => false,
            ],
        ]);

        $URI = $store_myshopify_url.'/admin/api/2023-04/inventory_levels/adjust.json';

        $body = [
            'location_id' => $location,
            'inventory_item_id' => $inventory_item_id,
            'available_adjustment' => $quantity,
        ];
        $body = json_encode($body);
        $URI_Response = $client->request('POST', $URI, ['body' => $body]);

        return $URI_Response;
    }
   

    public function insert_products($products)
    {
        /* SELECT product_id ,COUNT(*) c from kshopina.stock group by product_id having c > 1; */

        foreach ($products[0] as $product) {
            if ($products[1] == 0) {
                $product_data = [
                    'product_title' => $product->title,
                    'product_id' => $product->id,
                    'product_type' => $product->product_type,
                    'product_tags' => $product->tags,
                    'created_at' => date("Y-m-d H:i:s", strtotime($product->created_at)),
                    'store' => 'egypt',
                    'number_of_variants' => count($product->variants),
                    'product_cover_image' => $product->image->src,

                ];
                $id = DB::table('stock')->insertGetId($product_data);
                $this->insert_variants($id, $product->variants);
            } else {
                if (!$this->is_product_exist($product->id)) {

                    $product_data = [
                        'product_title' => $product->title,
                        'product_id' => $product->id,
                        'product_type' => $product->product_type,
                        'product_tags' => $product->tags,
                        'created_at' => date("Y-m-d H:i:s", strtotime($product->created_at)),
                        'store' => 'egypt',
                        'number_of_variants' => count($product->variants),
                        'product_cover_image' => $product->image->src,

                    ];
                    $id = DB::table('stock')->insertGetId($product_data);
                    $this->insert_variants($id, $product->variants);
                }
            }
        }
    }
    public function insert_variants($product_id, $variants)
    {

        foreach ($variants as $variant) {

            $product_data = [
                'product_id' => $product_id,
                'variant_id' => $variant->id,
                'variant_title' => $variant->title,
                'variant_price' => $variant->price,
                'variant_sku' => $variant->sku,
                'variant_image' => $variant->image_id,
                'variant_inventory_id' => $variant->inventory_item_id,
                'variant_quantity' => $variant->inventory_quantity,
                'variant_all_quantity' => $variant->inventory_quantity,

            ];
            $id = DB::table('variants')->insertGetId($product_data);
        }
    }
    public function generate_file($month, $all_products, $total_quantity)
    {

        $months = ['', 'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
        $in_quantity = $this->get_in_quantity($month);
        $all_variant_quantity = $this->get_all_quantity();

        $spreadsheet = new Spreadsheet();
        $newsheet = $spreadsheet->getActiveSheet();
        $newsheet->setCellValue('A1', 'Product Name');
        $newsheet->setCellValue('B1', 'Product Type');
        $newsheet->setCellValue('C1', 'Current QTY');
        $newsheet->setCellValue('D1', 'Registration Time');
        $newsheet->setCellValue('E1', 'NO. of Variants');
        $newsheet->setCellValue('F1', 'In QTY');
        $newsheet->setCellValue('G1', 'Total registered QTY');

        for ($i = 0; $i < count($all_products); $i++) {
            $k = $i + 2;
            $newsheet->setCellValue('A' . $k, $all_products[$i]->product_title);
            $newsheet->setCellValue('B' . $k, $all_products[$i]->product_type);
            $newsheet->setCellValue('C' . $k, $total_quantity[$all_products[$i]->id]);
            $newsheet->setCellValue('D' . $k, $all_products[$i]->created_at);
            $newsheet->setCellValue('E' . $k, $all_products[$i]->number_of_variants);

            if (isset($in_quantity[$all_products[$i]->id])) {
                $newsheet->setCellValue('F' . $k, $in_quantity[$all_products[$i]->id]);
            } else {
                $newsheet->setCellValue('F' . $k, 0);
            }
            if (isset($all_variant_quantity[$all_products[$i]->id])) {
                $newsheet->setCellValue('G' . $k, $all_variant_quantity[$all_products[$i]->id]);
            } else {
                $newsheet->setCellValue('G' . $k, 0);
            }

        }

        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Csv($spreadsheet);

        if (!file_exists(public_path('uploads/stock'))) {
            mkdir(public_path('uploads/stock'), 0777, true);
        }

        $date = date('Y-m-d His', time());
        $file_url = 'uploads/stock/' . $months[$month] . date("Y") . '.csv';
        $writer->save($file_url);
        return $file_url;

    }
    public function get_in_quantity($month)
    {

        $quantity_sum = [];
        $in = DB::select('SELECT product_id,sum(adjustment) AS in_quantity FROM stock_history where operation = ? AND MONTH(adjustment_at) = ? GROUP BY product_id;', ['IN', $month]);

        foreach ($in as $value) {
            $quantity_sum[$value->product_id] = $value->in_quantity;
        }
        return $quantity_sum;
    }
    public function get_all_quantity()
    {

        $quantity_sum = [];
        $in = DB::select('SELECT product_id,sum(variant_all_quantity) AS all_quantity FROM variants GROUP BY product_id;');

        foreach ($in as $value) {
            $quantity_sum[$value->product_id] = $value->all_quantity;
        }
        return $quantity_sum;
    }
    public function is_product_exist($id)
    {
        $product = DB::select('select * from stock where product_id = ?', [$id]);
        if ($product == null || $product == []) {
            return false;
        } else {
            return true;
        }
    }

    public function export_stock_orders($from, $to)
    {

        return DB::select('SELECT  stock_history.operation , stock_history.operation_side, stock_history.store , stock_history.last_quantity ,
                            stock_history.adjustment ,
                            stock_variants.product_id  , stock_variants.created_at , stock_variants.product_title,
                            stock_variants.number_of_variants, stock_variants.variant_id , stock_variants.variant_title ,
                            stock_variants.variant_price , stock_variants.variant_sku , stock_variants.variant_all_quantity
                            FROM kshopina.stock_history
                            INNER JOIN (SELECT  stock.id as product_id ,stock.created_at  , stock.product_title, stock.number_of_variants ,
                            variants.id as variant_id , variants.variant_title, variants.variant_price, variants.variant_sku,  variants.variant_all_quantity
                            FROM kshopina.stock INNER JOIN kshopina.variants
                            ON stock.id = variants.product_id )  as stock_variants
                            ON stock_history.variant_id = stock_variants.variant_id where stock_history.adjustment_at BETWEEN ? AND ?
                            order by stock_history.variant_id ,stock_history.operation ;', [$from, $to]);
    }

    public function get_similar_item($barcode,$country)
    {
        $item = [];

        $item = DB::select('SELECT *,variants.id as sql_variant_id,stock.product_id as shopify_product_id
                            FROM variants
                            INNER JOIN stock
                            ON variants.product_id = stock.id
                            WHERE variants.unique_barcode = ? AND stock.store= ?;', [$barcode,$this->country_to_store[$country]]);

        if (count($item) == 0) {
            $item = DB::select('SELECT *,variants.id as sql_variant_id,stock.product_id as shopify_product_id
                                FROM variants
                                INNER JOIN stock
                                ON variants.product_id = stock.id
                                WHERE variants.unique_barcode Like ? AND stock.store= ?;', [$barcode . '%',$this->country_to_store[$country]]);
        }

        return $item;

    }
    public function return_qty_to_stock($id, $qty,$country)
    {
        $variant = DB::select('SELECT * from variants where id = ? ', [$id]);

        if (isset($this->locations[$this->country_to_store[$country]]) ) {
            $location =$this->locations[$this->country_to_store[$country]];
        }

        $query['variant_id'] = $variant[0]->id;
        $query['product_id'] = $variant[0]->product_id;

        $old_quantity = $variant[0]->variant_quantity;

        $query['operation'] = "IN";
        $query['adjustment'] = $qty;

        $query['operation_side'] = 'Kshopina Original Return';

        $new_quantity = $old_quantity + $qty;

        $query['store'] = $this->country_to_store[$country];

        date_default_timezone_set('Africa/Cairo');
        $date = date('Y-m-d H:i:s', time());

        $query['adjustment_at'] = $date;

        $query['last_quantity'] = $old_quantity;

        $query['adjust_by'] = Auth::user()->name;

        DB::table('stock_history')->insert($query);


        if (isset($this->locations[$this->country_to_store[$country]]) ) {
            $this->adjust_available($location, $qty, $variant[0]->variant_inventory_id);
        }else{
            DB::table('variants')
                ->where(['id' => $variant[0]->id])
                ->update(['variant_quantity' => $new_quantity, 'variant_all_quantity' => $variant[0]->variant_all_quantity + $qty, 'updated_at' => $date]);
        }
        
    }
    public function create_new_variant($id,$sku,$price,$variant_name,$qty,$country,$barcode)
    {
        if (isset($this->locations[$this->country_to_store[$country]]) ) {
            $location =$this->locations[$this->country_to_store[$country]];

            $shopify_token = DB::table('config')->where('keyy', $this->country_to_store[$country])->get()[0]->value;
            $store_myshopify_url = DB::table('config')->where('keyy', $this->country_to_store[$country] . '_myshopify')->get()[0]->value;

            $client = new guzzle([
                'headers' => [
                    'Content-Type' => 'application/json',
                    'X-Shopify-Access-Token' => $shopify_token,
                    'debug' => true,
                ],
                "ssl" => [
                    "verify_peer" => false,
                    "verify_peer_name" => false,
                ],
            ]);
            $URI = $store_myshopify_url.'/admin/api/2023-04/products/'.$id.'/variants.json';

            $body = ['variant'=>[
                                'product_id' => $id,
                                'sku'=>$sku,
                                'option1' => $variant_name,
                                'price' => $price,
                                'barcode'=> $barcode]
                
            ];
            $body = json_encode($body);

            try {
                $URI_Response = $client->request('POST', $URI, ['body' => $body]);
            } catch (\Throwable $th) {
                DB::insert('insert into errors (message,shipment_number,system_name) values (?,?,?)', [$th, $id,$variant_name]);
            }

            $URI_Response = json_decode($URI_Response->getBody(), true);

            if (isset($URI_Response['variant']['inventory_item_id']) ) {

                $product = DB::select('SELECT * from stock where product_id = ? ', [$id]);
    
                $variant_data = [
                    'product_id' => $product[0]->id,
                    'variant_id' => $URI_Response['variant']['id'],
                    'variant_title' => $variant_name,
                    'variant_price' => $price,
                    'variant_sku' => $sku,
                    'variant_image' => $URI_Response['variant']['image_id'],
                    'variant_inventory_id' => $URI_Response['variant']['inventory_item_id'],
                    'variant_quantity' => $qty,
                    'variant_all_quantity' => $qty,
                    'unique_barcode'=>$barcode
    
                ];
                DB::table('variants')->insertGetId($variant_data);
    
                if (isset($this->locations[$this->country_to_store[$country]]) ) {
                    $this->adjust_available($location,$qty,$URI_Response['variant']['inventory_item_id']);
                }
    
                $this->add_record_to_stock_history($URI_Response['variant']['id'],$qty,'IN','Kshopina Original Return',Auth::user()->name,$this->country_to_store[$country],$product[0]->id);
    
    
                return ['success',$product[0]->id,$URI_Response['variant']['id']];
            }
            else{
                DB::insert('insert into errors (message,shipment_number,system_name) values (?,?,?)', ['NOT CREATED', $id,$variant_name]);
    
                return ['fail','NOT CREATED'];
            }
        }else{
            $product = DB::select('SELECT * from stock where product_id = ? ', [$id]);
            
            
                $variant_data = [
                    'product_id' => $product[0]->id,
                    'variant_id' => "",
                    'variant_title' => $variant_name,
                    'variant_price' => $price,
                    'variant_sku' => $sku,
                    'variant_image' => "",
                    'variant_inventory_id' => "",
                    'variant_quantity' => $qty,
                    'variant_all_quantity' => $qty,
    
                ];
                $sql_variant_id=DB::table('variants')->insertGetId($variant_data);

                $variant_id = rand(1000000,9999999) . $sql_variant_id;

                DB::table('variants')
                ->where(['id' => $sql_variant_id])
                ->update(['variant_id' => $variant_id]);

                $this->add_record_to_stock_history($variant_id,$qty,'IN','Kshopina Original Return',Auth::user()->name,$this->country_to_store[$country],$product[0]->id);

                return ['done',$product[0]->id,$variant_id];
        }
        
    }
    public function change_variant_name_and_sku($variant_name,$variant_id,$sku,$country,$sql_product_id)
    {
        date_default_timezone_set('Africa/Cairo');
        $date = date('Y-m-d H:i:s', time());


        $shopify_token = DB::table('config')->where('keyy', $this->country_to_store[$country])->get()[0]->value;
        $store_myshopify_url = DB::table('config')->where('keyy', $this->country_to_store[$country] . '_myshopify')->get()[0]->value;

        $client = new guzzle([
            'headers' => [
                'Content-Type' => 'application/json',
                'X-Shopify-Access-Token' => $shopify_token,
                'debug' => true,
            ],
            "ssl" => [
                "verify_peer" => false,
                "verify_peer_name" => false,
            ],
        ]);
        $URI = $store_myshopify_url.'/admin/api/2023-04/variants/'.$variant_id.'.json';

        $body = ['variant'=>
        ['id' => $variant_id,
        'sku'=>$sku,
        'option1' => $variant_name]
            
        ];
        $body = json_encode($body);
        $URI_Response = $client->request('PUT', $URI, ['body' => $body]);
        $URI_Response = json_decode($URI_Response->getBody(), true);

        DB::table('variants')
        ->where(['variant_id' => $variant_id,'product_id'=>$sql_product_id])
        ->update(['variant_title' => $variant_name, 'variant_sku' => $sku, 'updated_at' => $date]);

    }
    public function change_variant_name_and_sku_out_of_shopify($variant_name,$variant_id,$sku,$sql_product_id)
    {
        date_default_timezone_set('Africa/Cairo');
        $date = date('Y-m-d H:i:s', time());

        DB::table('variants')
        ->where(['variant_id' => $variant_id,'product_id'=>$sql_product_id])
        ->update(['variant_title' => $variant_name, 'variant_sku' => $sku, 'updated_at' => $date]);
    }
    public function add_record_to_stock_history($shopify_variant_id,$adjustment,$operation,$operation_side,$user,$store,$sql_product_id)
    {
        $variant = DB::select('SELECT * from variants where variant_id = ? AND product_id= ?', [$shopify_variant_id,$sql_product_id]);

        $query['variant_id'] = $variant[0]->id;
        $query['product_id'] = $variant[0]->product_id;

        $query['operation'] = $operation;
        $query['adjustment'] = $adjustment;

        $query['operation_side'] = $operation_side;

        $query['store'] = $store;

        date_default_timezone_set('Africa/Cairo');
        $date = date('Y-m-d H:i:s', time());

        $query['adjustment_at'] = $date;

        $query['last_quantity'] = 0;

        $query['adjust_by'] = $user;

        DB::table('stock_history')->insert($query);
    }
    function get_shopify_product_data($product_id,$store){
       
        $product_id =$product_id;
        
        
        $shopify_token = DB::table('config')->where('keyy', $store)->get()[0]->value;
        $store_url = DB::table('config')->where('keyy', $store . '_url')->get()[0]->value;
      
          $client = new guzzle([
              'headers' => [
                  'Content-Type' => 'application/json',
                  'X-Shopify-Access-Token' => $shopify_token,
                  'debug' => true,
              ],
              "ssl" => [
                  "verify_peer" => false,
                  "verify_peer_name" => false,
              ],
          ]);
         
          $URI = $store_url . '/admin/api/2023-04/products/' . $product_id . '.json';
        
                
         try {
            $URI_Response = $client->request('GET', $URI);  
         } catch (\Throwable $th) {
           return  $th;
         }
           

        $response = json_decode($URI_Response->getBody(), true);

        return $response ;

    }
    
    function get_origin_product_data($product_id,$variant_id){
       
        $product_id =$product_id;   //mlosh variants
        
        $variant_id = $variant_id;  //mlosh variants

        /* $product_id ="7097058492504";  */ //leh variants

        /* $variant_id = "39928850481240";  */ //leh variants
        
        $shopify_token = DB::table('config')->where('keyy', 'origin')->get()[0]->value;
        $store_url = DB::table('config')->where('keyy', 'origin' . '_url')->get()[0]->value;
      
          $client = new guzzle([
              'headers' => [
                  'Content-Type' => 'application/json',
                  'X-Shopify-Access-Token' => $shopify_token,
                  'debug' => true,
              ],
              "ssl" => [
                  "verify_peer" => false,
                  "verify_peer_name" => false,
              ],
          ]);
         
          $URI = $store_url . '/admin/api/2023-04/products/' . $product_id . '.json';
        
                
         try {
            $URI_Response = $client->request('GET', $URI);  
         } catch (\Throwable $th) {
           return  $th;
         }
           

        $response = json_decode($URI_Response->getBody(), true);

        $origin_product_info =DB::select('SELECT * FROM variants inner join stock on variants.product_id = stock.id where stock.product_id = ? and variants.variant_id = ? and stock.store = ?', [$product_id,$variant_id,'origin']);
        return [$response , $variant_id,$origin_product_info[0]];

    }

    function dublicate_product_in_another_store($product_id,$variant_id,$product_name,$product_sku,$product_price,$product_qty,$country){
       
        date_default_timezone_set('Africa/Cairo');
        $date = date('Y-m-d H:i:s', time());

        $variant_data = [];
        $images_data = [];

        $data =$this->get_origin_product_data($product_id,$variant_id);
        $barcode = $data[2]->unique_barcode;

        if (isset($this->locations[$this->country_to_store[$country]]) ) {
            $location =$this->locations[$this->country_to_store[$country]];

            $shopify_token = DB::table('config')->where('keyy', $this->country_to_store[$country])->get()[0]->value;
            $store_myshopify_url = DB::table('config')->where('keyy', $this->country_to_store[$country] . '_myshopify')->get()[0]->value;

            
            $client = new guzzle([
                    'headers' => [
                        'Content-Type' => 'application/json',
                        'X-Shopify-Access-Token' => $shopify_token,
                        'debug' => true,
                    ],
                    "ssl" => [
                        "verify_peer" => false,
                        "verify_peer_name" => false,
                    ],
            ]);
            

            try {
                $URI_2 = $store_myshopify_url . '/admin/api/2023-04/products.json';

                foreach ($data[0]['product']['variants'] as $variant) {
                
                    if($variant['id'] == (int)$variant_id){

                        $variant_data ['price']= $product_price ;
                        $variant_data ['sku']= $product_sku ;
                        $variant_data ['option1']= "Default Title";
                        $variant_data ['grams']= $variant['grams'] ;

                        $variant_data['inventory_policy']= $variant['inventory_policy'] ;
                        $variant_data ['weight']= $variant['weight'] ;
                        $variant_data['weight_unit']= $variant['weight_unit'] ;
                        $variant_data ['inventory_management']= $variant['inventory_management'] ;
                        $variant_data['barcode'] = $barcode;
                    }
                
                }

                $images_data =[];
                $counter=0;

                if (count( $data[0]['product']['images'] ) >1) {
                    
                    for ($j=0 ; $j < count( $data[0]['product']['images'] ) ; $j++) { 
                    
                        if ($data[0]['product']['images'][$j]['id'] != $data[0]['product']['image']['id'] ) {

                            $images_data [$counter]['src']= $data[0]['product']['images'][$j]['src'] ;
                            $counter++;
                            
                            /* $images_data [$j]['height']= $image['height'] ;
                            $images_data [$j]['width']= $image['width'] ;
                            $images_data [$j] ['position']= $image['position'] ;
                            $images_data [$j] ['alt']= $image['alt'] ; */
                        }
                        
                    }
                } 
                    
                
                $body_2= [
                'product' => [   'title' => $product_name,
                                    'body_html'=> $data[0]['product']['body_html'] ,
                                    'product_type'=> $data[0]['product']['product_type'],
                                    'handle'=> $data[0]['product']['handle'],
                                    'published_scope'=> $data[0]['product']['published_scope'],
                                    'status'=> $data[0]['product']['status'],
                                    'taASs'=> $data[0]['product']['tags'],
                                    'vendor'=> $data[0]['product']['vendor'] ,
                                    'images' => $images_data ,
                                    'variants' => [$variant_data]
                                ]
                ];
                 

                $body_2 = json_encode($body_2);
                
                $URI_Response_2 = $client->request('POST', $URI_2 , ['body' => $body_2]);
                    
                $URI_Responssssss = json_decode($URI_Response_2->getBody(), true);

                $this->adjust_available($location,$product_qty,$URI_Responssssss['product']['variants'][0]['inventory_item_id']);

                $image = $this->image_new_product( $URI_Responssssss['product']['id'] , $data[0]['product'],$country); 

                $shopify_product_data = $this->get_shopify_product_data($URI_Responssssss['product']['id'],$this->country_to_store[$country]);

                $product=$shopify_product_data['product'];

                if (isset($product['image']['src'])) {
                    $image = $product['image']['src'];
                } else {
                    $image = "";
                }

                $product_data = [
                    'product_title' => $product['title'],
                    'product_id' => $product['id'],
                    'product_type' => $product['product_type'],
                    'product_tags' => $product['tags'],
                    'created_at' => date("Y-m-d H:i:s", strtotime($product['created_at'])),
                    'store' => $this->country_to_store[$country],
                    'status' => $product['status'],
                    'number_of_variants' => count($product['variants']),
                    'product_cover_image' => $image
                ];
                $id = DB::table('stock')->insertGetId($product_data);

                foreach ($product['variants'] as $variant) {

                    $variant_data = [
                        'product_id' => $id,
                        'variant_id' => $variant['id'],
                        'variant_title' => $variant['title'],
                        'variant_price' => $variant['price'],
                        'variant_sku' => $variant['sku'],
                        'variant_image' => $variant['image_id'],
                        'variant_inventory_id' => $variant['inventory_item_id'],
                        'variant_quantity' => $variant['inventory_quantity'],
                        'variant_all_quantity' => $variant['inventory_quantity'],
                        'unique_barcode'=>$barcode   

                    ];
                    $variant_id = DB::table('variants')->insertGetId($variant_data);

                }

            } catch (\Throwable $th) {
                
                DB::insert('insert into errors (message,shipment_number,status,system_name) values (?,?,?,?)', [$th, $product_id,$variant_id,$country]);

                return 'Fail';
            }
        }else{

            $product=$data[0]['product'];

            if (isset($product['image']['src'])) {
                $image = $product['image']['src'];
            } else {
                $image = "";
            }
            
           $product_data = [
                'product_title' => $product_name,
                'product_id' => $product['id'],
                'product_type' => $product['product_type'],
                'product_tags' => $product['tags'],
                'created_at' => date("Y-m-d H:i:s", strtotime($product['created_at'])),
                'store' => $this->country_to_store[$country],
                'number_of_variants' => 1,
                'product_cover_image' => $image,
            ];
            $id = DB::table('stock')->insertGetId($product_data);

            foreach ($product->variants as $variant) {

                $variant_data = [
                    'product_id' => $id,
                    'variant_id' => $variant['id'],
                    'variant_title' => $variant['title'],
                    'variant_price' => $product_price,
                    'variant_sku' => $product_sku,
                    'variant_image' => $variant['image_id'],
                    'variant_inventory_id' => $variant['inventory_item_id'],
                    'variant_quantity' => $product_qty,
                    'variant_all_quantity' => $product_qty,
                    'unique_barcode'=>$barcode
    
                ];
                $variant_id = DB::table('variants')->insertGetId($variant_data);
    
            }
    
            return 'Success';
        }
        
    }

    function dublicate_product_from_original($product_id,$store){
       
        date_default_timezone_set('Africa/Cairo');
        $date = date('Y-m-d H:i:s', time());

        $variant_data = [];
        $images_data = [];

        $data =$this->get_shopify_product_data($product_id,'origin');
        $barcode = DB::select('SELECT unique_barcode from stock inner join variants on stock.id = variants.product_id where stock.product_id = ? and store = ?', [$product_id,'origin']);

        $shopify_token = DB::table('config')->where('keyy', $store)->get()[0]->value;
        $store_myshopify_url = DB::table('config')->where('keyy', $store . '_myshopify')->get()[0]->value;

            
        $client = new guzzle([
                'headers' => [
                    'Content-Type' => 'application/json',
                    'X-Shopify-Access-Token' => $shopify_token,
                    'debug' => true,
                ],
                "ssl" => [
                    "verify_peer" => false,
                    "verify_peer_name" => false,
                ],
        ]);
            

            try {
                $URI_2 = $store_myshopify_url . '/admin/api/2023-04/products.json';

                for ($i=0; $i < count($data['product']['variants']); $i++) { 

                    if (count($data['product']['variants']) == 1) {
                        $variant_data[$i] =[
                            'price'=>$data['product']['variants'][$i]['price'],
                            'sku'=>$data['product']['variants'][$i]['sku'] ,
                            'option1' =>"Default Title",
                            'grams' =>$data['product']['variants'][$i]['grams'] ,
                            'inventory_policy' =>$data['product']['variants'][$i]['inventory_policy'] ,
                            'weight' =>$data['product']['variants'][$i]['weight'] ,
                            'weight_unit' =>$data['product']['variants'][$i]['weight_unit'],
                            'inventory_management' =>$data['product']['variants'][$i]['inventory_management'],
                            'barcode'=>$barcode[$i]->unique_barcode
                        ];
                    }else{
                        $variant_data[$i] =[
                            'price'=>$data['product']['variants'][$i]['price'],
                            'sku'=>$data['product']['variants'][$i]['sku'] ,
                            'option1' => $data['product']['variants'][$i]['title'],
                            'grams' =>$data['product']['variants'][$i]['grams'] ,
                            'inventory_policy' =>$data['product']['variants'][$i]['inventory_policy'] ,
                            'weight' =>$data['product']['variants'][$i]['weight'] ,
                            'weight_unit' =>$data['product']['variants'][$i]['weight_unit'],
                            'inventory_management' =>$data['product']['variants'][$i]['inventory_management'] ,
                            'barcode'=>$barcode[$i]->unique_barcode
                            
                        ];
                    }
                    
                }
                

                $images_data =[];
                $counter=0;

                if (count( $data['product']['images'] ) >1) {
                    
                    for ($j=0 ; $j < count( $data['product']['images'] ) ; $j++) { 
                    
                        if ($data['product']['images'][$j]['id'] != $data['product']['image']['id'] ) {

                            $images_data [$counter]['src']= $data['product']['images'][$j]['src'] ;
                            $counter++;
                            
                            
                        }
                        
                    }
                } 
                    
                
                $body_2= [
                'product' => [   'title' => $data['product']['title'],
                                    'body_html'=> $data['product']['body_html'] ,
                                    'product_type'=> $data['product']['product_type'],
                                    'handle'=> $data['product']['handle'],
                                    'published_scope'=> $data['product']['published_scope'],
                                    'status'=> $data['product']['status'],
                                    'taASs'=> $data['product']['tags'],
                                    'vendor'=> $data['product']['vendor'] ,
                                    'images' => $images_data ,
                                    'variants' => $variant_data
                                ]
                ];
                 

                $body_2 = json_encode($body_2);
                
                $URI_Response_2 = $client->request('POST', $URI_2 , ['body' => $body_2]);
                    
                $URI_Responssssss = json_decode($URI_Response_2->getBody(), true);

                $image = $this->image_new_product( $URI_Responssssss['product']['id'] , $data['product'],array_search($store,$this->country_to_store)); 
                
                $shopify_product_data = $this->get_shopify_product_data($URI_Responssssss['product']['id'],$store);

                $product=$shopify_product_data['product'];

                if (isset($product['image']['src'])) {
                    $image = $product['image']['src'];
                } else {
                    $image = "";
                }

                $product_data = [
                    'product_title' => $product['title'],
                    'product_id' => $product['id'],
                    'product_type' => $product['product_type'],
                    'product_tags' => $product['tags'],
                    'created_at' => date("Y-m-d H:i:s", strtotime($product['created_at'])),
                    'store' => $store,
                    'status' => $product['status'],
                    'number_of_variants' => count($product['variants']),
                    'product_cover_image' => $image
                ];
                $id = DB::table('stock')->insertGetId($product_data);

                $counter=0;
                foreach ($product['variants'] as $variant) {

                    $variant_data = [
                        'product_id' => $id,
                        'variant_id' => $variant['id'],
                        'variant_title' => $variant['title'],
                        'variant_price' => $variant['price'],
                        'variant_sku' => $variant['sku'],
                        'variant_image' => $variant['image_id'],
                        'variant_inventory_id' => $variant['inventory_item_id'],
                        'variant_quantity' => $variant['inventory_quantity'],
                        'variant_all_quantity' => $variant['inventory_quantity'],
                        'unique_barcode'=>$barcode[$counter]->unique_barcode

                    ];
                    $variant_id = DB::table('variants')->insertGetId($variant_data);
                    $counter =$counter +1;
                }

                return 'success';
            } catch (\Throwable $th) {
                
                DB::insert('insert into errors (message,shipment_number,status,system_name) values (?,?,?,?)', [$th, $product_id,"","smth wrong duplicated to - ".$store]);

                return 'Fail';
            }
        
        
    }

    function image_new_product( $new_product_id , $data_of_source_product,$country){
      
        $shopify_token = DB::table('config')->where('keyy', $this->country_to_store[$country])->get()[0]->value;
        $store_myshopify_url = DB::table('config')->where('keyy', $this->country_to_store[$country] . '_myshopify')->get()[0]->value;
        
        $client = new guzzle([
                'headers' => [
                    'Content-Type' => 'application/json',
                    'X-Shopify-Access-Token' => $shopify_token,
                    'debug' => true,
                ],
                "ssl" => [
                    "verify_peer" => false,
                    "verify_peer_name" => false,
                ],
        ]);

      
        try {
            $URI_2 = $store_myshopify_url . '/admin/api/2023-04/products/' . $new_product_id . '/images.json';
          
            $body_2['image']= array (
                'id' => $new_product_id,
                'src'=> $data_of_source_product['image']['src'] ,
                'position'=> $data_of_source_product['image']['position'],
                'height'=> $data_of_source_product['image']['height'],
                'width'=> $data_of_source_product['image']['width'],
                'save'=> true,
            );
                            
                         
            $body_2 = json_encode($body_2);
            
            $URI_Response_2 = $client->request('POST', $URI_2 , ['body' => $body_2]);
            
            $URI_Responssssss = json_decode($URI_Response_2->getBody(), true); 
            return $URI_Responssssss;
            
        }catch (\Throwable $th) {
            return $th;
        } 
    
    }

    public function export_sales_report($from, $to)
    {
        try {

            $titles = ['A' => 'Product Name', 'B' => 'Variant Name', 'C' => 'Variant SKU', 'D' => 'Variant Price',
                'E' => 'New for Stock', 'F' => 'Return Item', 'G' => 'Shpoify Return', 'H' => 'Total In',
                'I' => 'Shopify', 'J' => 'kshopina Original', 'K' => 'Amazon', 'L' => 'Jumia',
                'M' => 'Noon', 'N' => 'Offline', 'O' => 'Total Out',
                'P' => 'Total Price', 'Q' => 'Varient Created at',
            ];

            $orders = $this->export_stock_orders($from, $to);

            $numoforders = count($orders);

            $previous = null;
            $new = 0;

            $all_variants = [];
            $variants_data = [];
            $variants_fixed_data = [];

            $stock_template = ['New for stock' => 0, 'Return item' => 0, 'Shopify_return' => 0,
                'Shopify' => 0, 'Kshopina Original' => 0, 'Jumia' => 0, 'Amazon' => 0, 'Noon' => 0, 'Offline' => 0,
            ];

            for ($i = 0; $i < $numoforders; $i++) {

                $new = $orders[$i]->variant_id;

                if ($new != $previous) {

                    $variants_fixed_data[$orders[$i]->variant_id] = ['product title' => $orders[$i]->product_title, 'variant title' => $orders[$i]->variant_title,
                        'variant sku' => $orders[$i]->variant_sku, 'variant price' => $orders[$i]->variant_price, 'operation' => $orders[$i]->operation,
                        'variant created at' => $orders[$i]->created_at,
                    ];

                    $variants_data = [];

                    $variants_data[$orders[$i]->operation_side] = $orders[$i]->adjustment;
                    $variants_data['product title'] = $orders[$i]->product_title;
                    $variants_data['variant title'] = $orders[$i]->variant_title;
                    $variants_data['variant sku'] = $orders[$i]->variant_sku;
                    $variants_data['variant price'] = $orders[$i]->variant_price;
                    $variants_data['operation'] = $orders[$i]->operation;
                    $variants_data['variant created at'] = $orders[$i]->created_at;

                    $all_variants[$new] = $variants_data;

                } else {

                    // $all_variants[$previous] = $variants_data;

                    foreach ($all_variants[$previous] as $key => $value) {

                        if ($key == $orders[$i]->operation_side) {

                            $variants_data[$key] = $value + $orders[$i]->adjustment;

                        } elseif ($key != $orders[$i]->operation_side) {

                            $variants_data[$orders[$i]->operation_side] = $orders[$i]->adjustment;

                        }

                        $all_variants[$previous] = $variants_data;

                    }

                }

                $previous = $new;

            }

            $spreadsheet1 = new \PhpOffice\PhpSpreadsheet\Spreadsheet();

            $row_1 = 2;

            $spreadsheet1->getActiveSheet()->setTitle('Stock_report');

            foreach ($titles as $key => $value) {
                $spreadsheet1->getActiveSheet()->setCellValue($key . '1', $value);
            }

            $all_data = [];

            foreach ($all_variants as $variant_id => $values) {

                $data['product title'] = $values['product title'];
                $data['variant title'] = $values['variant title'];
                $data['variant sku'] = $values['variant sku'];
                $data['variant price'] = $values['variant price'];

                foreach ($values as $variant_source => $count_of_source) {

                    if (array_key_exists($variant_source, $stock_template)) {
                        $stock_template[$variant_source] = $count_of_source;
                    } else {
                        $stock_template[$variant_source] = 0;
                    }

                }

                $data['New for stock'] = $stock_template['New for stock'];
                $data['Return item'] = $stock_template['Return item'];
                $data['Shopify_return'] = $stock_template['Shopify_return'];

                $total_in = $stock_template['New for stock'] + $stock_template['Return item'] + $stock_template['Shopify_return'];

                $data['total_in'] = $total_in;
                $rate_in = $stock_template['Return item'] + $stock_template['Shopify_return'];

                $data['Shopify'] = $stock_template['Shopify'];
                $data['Kshopina Original'] = $stock_template['Kshopina Original'];
                $data['Jumia'] = $stock_template['Jumia'];
                $data['Amazon'] = $stock_template['Amazon'];
                $data['Noon'] = $stock_template['Noon'];
                $data['Offline'] = $stock_template['Offline'];

                $total_out = $stock_template['Shopify'] + $stock_template['Kshopina Original'] + $stock_template['Jumia'] + $stock_template['Amazon'] + $stock_template['Noon'] + $stock_template['Offline'];

                $data['total_out'] = $total_out;
                $data['total_price'] = $total_out * $values['variant price'];
                $data['date'] = date("Y-m-d H:i:s", strtotime($values['variant created at']));

                $data['rate'] = $total_out - $rate_in;

                $all_data[$variant_id] = $data;

                $stock_template = ['New for stock' => 0, 'Return item' => 0, 'Shopify_return' => 0,
                    'Shopify' => 0, 'Kshopina Original' => 0, 'Jumia' => 0, 'Amazon' => 0, 'Noon' => 0, 'Offline' => 0,
                ];

            }

            foreach ($all_data as $key => $row) {
                $all_data_name[$key] = $row['rate'];
            }

            array_multisort($all_data_name, SORT_DESC, $all_data);

            foreach ($all_data as $key => $row) {

                $final_data[0] = $row['product title'];
                $final_data[1] = $row['variant title'];
                $final_data[2] = $row['variant sku'];
                $final_data[3] = $row['variant price'];
                $final_data[4] = $row['New for stock'];
                $final_data[5] = $row['Return item'];
                $final_data[6] = $row['Shopify_return'];
                $final_data[7] = $row['total_in'];
                $final_data[8] = $row['Shopify'];
                $final_data[9] = $row['Kshopina Original'];
                $final_data[10] = $row['Amazon'];
                $final_data[11] = $row['Jumia'];
                $final_data[12] = $row['Noon'];
                $final_data[13] = $row['Offline'];
                $final_data[14] = $row['total_out'];
                $final_data[15] = $row['total_price'];
                $final_data[16] = $row['date'];

                $col = array_keys($titles);

                for ($i = 0; $i < count($final_data); $i++) {
                    $spreadsheet1->getActiveSheet()->setCellValue($col[$i] . $row_1, $final_data[$i]);
                }

                $row_1++;
            }

            $name = date('Y-m-d--h-i-sa');
            $writer = new Xlsx($spreadsheet1);

            if (!file_exists(public_path('uploads/stock_reports'))) {
                mkdir(public_path('uploads/stock_reports'), 0777, true);
            }

            $writer->save(public_path('/uploads' . '/stock_reports/file' . $name . '.xlsx'));
            unset($reader);

            $path = 'uploads' . '/stock_reports/file' . $name . '.xlsx';

            return $path;
        } catch (\Throwable $th) {
            return $th;
        }

    }

    public function export_products_filters($route_name ,$store_name ,$filter_name){
        
        $titles = ['A' => 'Product Name', 'B' => 'Product Type', 'C' => 'No. of variants', 'D' => 'Created at' ,
            'E' => 'Variant Name','F' => 'Variant SKU', 'G' => 'Variant Quantity', 'H' => 'Variant Price'
        ];

        $orders = $this->export_products_filters_db($route_name ,$store_name ,$filter_name);

        $numoforders = count($orders);

        $row_1 = 2;
        $col = array_keys($titles);

        $previous = null;
        $new = 0;
        $product_ids = [];

        $spreadsheet1 = new \PhpOffice\PhpSpreadsheet\Spreadsheet();

        foreach ($titles as $key => $value) {
            $spreadsheet1->getActiveSheet()->setCellValue($key . '1', $value);
        }

        for ($row = 0; $row < $numoforders; $row++) {

            $data=[];
            $new = $orders[$row]->product_id;

              if ( !in_array($orders[$row]->product_id , $product_ids)) {
                array_push($product_ids, $orders[$row]->product_id);
            }

            if ($new != $previous) {
                
                $data[0]=$orders[$row]->product_title;
                $data[1]=$orders[$row]->product_type;
                $data[2]=$orders[$row]->number_of_variants;
                $data[3]=$orders[$row]->created_at;
                $data[4]=$orders[$row]->variant_title;
                $data[5]=$orders[$row]->variant_sku;
                $data[6]=$orders[$row]->variant_quantity;
                $data[7]=$orders[$row]->variant_price;
            } else {
                $data[0]='';
                $data[1]='';
                $data[2]='';
                $data[3]='';
                $data[4]=$orders[$row]->variant_title;
                $data[5]=$orders[$row]->variant_sku;
                $data[6]=$orders[$row]->variant_quantity;
                $data[7]=$orders[$row]->variant_price;
            }
            
            $spreadsheet1->getActiveSheet()->setTitle($route_name. '_' .count($product_ids)); 

            for ($i = 0; $i < count($data); $i++) {
                $spreadsheet1->getActiveSheet()->setCellValue($col[$i] . $row_1, $data[$i]);
            }

            $row_1++;
            $previous = $new;
        }

        $name = $store_name.'_'.date('d--h-i-sa');
        $writer = new Xlsx($spreadsheet1);

        if (!file_exists(public_path('uploads/stock_products_export'))) {
            mkdir(public_path('uploads/stock_products_export'), 0777, true);
        }

        $writer->save(public_path('/uploads' . '/stock_products_export/file' . $name . '.xlsx'));
        unset($reader);

        $path = 'uploads' . '/stock_products_export/file' . $name . '.xlsx';

        return $path;
    }

    public function export_products_filters_db($route_name ,$store_name ,$filter_name){

        if ($route_name == 'products') {

            if ( $filter_name == 'All' ) {

                return DB::select('SELECT stock.product_title  ,  stock.product_type , stock.number_of_variants , sum(variants.variant_quantity) as quantity_all , stock.created_at , stock.product_id ,
                variants.variant_title , variants.variant_sku ,  variants.variant_quantity , variants.variant_price ,variants.id as variant_id , stock.id as product_id
                FROM kshopina.stock inner join kshopina.variants 
                on stock.id = variants.product_id where stock.store =? group by  stock.product_id ,variants.id  ', [$store_name]);

            } else {

                return DB::select('SELECT stock.product_title  ,  stock.product_type , stock.number_of_variants , sum(variants.variant_quantity) as quantity_all ,  stock.created_at , stock.product_id ,
                variants.variant_title , variants.variant_sku ,  variants.variant_quantity , variants.variant_price ,variants.id as variant_id , stock.id as product_id
                FROM kshopina.stock inner join kshopina.variants 
                on stock.id = variants.product_id where stock.store = ? AND stock.product_type = ? group by stock.product_id ,variants.id ', [$store_name , $filter_name]);

            }
           
        } else if($route_name == 'pre_alert') {

            if ( $filter_name == 'All' ) {

                return DB::select('SELECT stock.product_title  ,  stock.product_type , stock.number_of_variants , sum(variants.variant_quantity) as quantity_all ,  stock.created_at , stock.product_id ,
                variants.variant_title , variants.variant_sku ,  variants.variant_quantity , variants.variant_price ,variants.id as variant_id , stock.id as product_id
                FROM kshopina.stock inner join kshopina.variants  
                on stock.id = variants.product_id where stock.store =? group by  stock.product_id ,variants.id Having sum(variants.variant_quantity) <= 2  ', [$store_name]);

            } else {

                return DB::select('SELECT stock.product_title  ,  stock.product_type , stock.number_of_variants , sum(variants.variant_quantity) as quantity_all ,  stock.created_at , stock.product_id ,
                variants.variant_title , variants.variant_sku ,  variants.variant_quantity , variants.variant_price ,variants.id as variant_id , stock.id as product_id
                FROM kshopina.stock inner join kshopina.variants 
                on stock.id = variants.product_id where stock.store = ? AND stock.product_type = ? group by  stock.product_id ,variants.id  Having sum(variants.variant_quantity) <= 2 ',
                 [$store_name , $filter_name]);

            }

        } else {

            if ( $filter_name == 'All' ) {

                return DB::select('SELECT stock.product_title  ,  stock.product_type , stock.number_of_variants , sum(variants.variant_quantity) as quantity_all ,  stock.created_at , stock.product_id ,
                variants.variant_title , variants.variant_sku ,  variants.variant_quantity , variants.variant_price ,variants.id as variant_id , stock.id as product_id
                FROM kshopina.stock inner join kshopina.variants 
                on stock.id = variants.product_id where stock.store =? group by  stock.product_id ,variants.id Having sum(variants.variant_quantity) == 0  ', [$store_name]);

            } else {

                return DB::select('SELECT stock.product_title  ,  stock.product_type , stock.number_of_variants , sum(variants.variant_quantity) as quantity_all ,  stock.created_at , stock.product_id ,
                variants.variant_title , variants.variant_sku ,  variants.variant_quantity , variants.variant_price ,variants.id as variant_id , stock.id as product_id
                FROM kshopina.stock inner join kshopina.variants 
                on stock.id = variants.product_id where stock.store = ? AND stock.product_type = ? group by stock.product_id ,variants.id  Having sum(variants.variant_quantity) == 0 ',
                 [$store_name , $filter_name]);

            }

        }
        



    }


    public function generate_unique_barcode()
    {

    }

    public function get_products_data_by_order_number($order_number){

        $products = DB::select('SELECT order_products.country,order_products.product_id,order_products.store,order_products.quantity,order_products.price,order_products.variant_id,
                order_products.id,order_products.product_title,order_products.product_type,order_products.product_cover_image,order_products.status,
                variant_title,variant_sku,unique_barcode
         from (SELECT order_items.country,order_items.product_id,order_items.store,order_items.quantity,order_items.price,order_items.variant_id,
                stock.id,product_title,product_type,product_cover_image,status
         from (SELECT orders.country,items.product_id,items.store,items.quantity,items.price,variant_id
                from  kshopina.orders
                inner join items
                on orders.order_number = items.order_id where orders.order_number = ?) as order_items inner join stock 
                on order_items.product_id = stock.product_id and order_items.store = stock.store) as order_products inner join variants 
                on order_products.id =variants.product_id and order_products.variant_id = variants.variant_id; ',[$order_number]);

        return  $products; 

    }
    public function get_products_data_by_barcode($barcode){

        $product =DB::select('SELECT * FROM products inner join stock on stock.product_id = products.product_id where barcode = ?; ', [$barcode]);

        $variants = DB::select('SELECT * FROM variants where product_id = ?; ', [$product[0]->id]);
        
        return [$product,$variants];
    }

    public function get_products_data_by_shopify_product_id($shopify_product_id){

        $product =DB::select('SELECT * FROM stock where product_id = ?; ', [$shopify_product_id]);

        $variants = DB::select('SELECT * FROM variants where product_id = ?; ', [$product[0]->id]);
        
        return [$product,$variants];
    }
    
    public function search_by_unique_barcode($unique_barcode){

        return DB::select('SELECT store,stock.product_id FROM stock inner join variants on stock.id =variants.product_id where unique_barcode = ? group by variants.product_id;', [$unique_barcode]);

    }
    public function tp_submit_question($order_number,$question,$name,$phone_number){

        date_default_timezone_set('Africa/Cairo');
        $date = date('Y-m-d H:i:s', time());

        $data = [
            'name' => $name,
            'phone_number' => $phone_number,
            'order_number' => $order_number,
            'question' => $question,
            'submited_at'  => $date
        ];

        DB::table('tp_questions')->insert($data);
    }
}
