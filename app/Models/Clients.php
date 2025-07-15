<?php

namespace App\Models;

use DateTime;
use GuzzleHttp\Client as guzzle;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Milon\Barcode\Facades\DNS1DFacade;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Clients extends Model
{
    use HasFactory;

    protected $status;

    public function __construct()
    {
        $this->status = ['Verified' => 0, 'Fulfilled' => 1, 'Dispatched' => 2, 'Kshopina_Warehouse' => 3, 'Delivery' => 4, 'Delivered' => 5, 'Refused' => 6];
    }

    public function get_client_shipment($user_id, $page)
    {
        $shipments_per_page = 15;
        $offset = ($page - 1) * $shipments_per_page;

        $shipments = DB::select('SELECT
        shipment.shipment_id,shipment.order_number, shipment.order_value, shipment.order_amount, shipment.payment ,
                 shipment.products_description,shipment.customer_name, shipment.customer_email,  shipment.customer_phone,shipment.customer_country ,
                 shipment.customer_city,shipment.customer_area,  shipment.customer_postal_code,shipment.customer_request ,
                 shipment.shipment_upload_date,shipment.ksp_number,shipment.barcode_image_name,shipment.barcode_status,shipment.barcode_scaned_at,
                 shipment.weight,shipment.pieces,shipment.volume_weight,shipment.chargeable_weight,shipment.tracking_number,shipment.awb_created_at,
                 shipment.awb_printed_at,shipment.status,shipment.active,shipment.shipment_dispatched_at,shipment.shipment_in_hub_at,
                 shipment.shipment_delivery_at,shipment.shipment_delivered_at,shipment.city_name,countries.name as country_name,shipment.name , shipment.email, shipment.phone_number, shipment.country , shipment.city , shipment.area , shipment.address_number
                     FROM kshopina.countries INNER JOIN
                (SELECT
                shipment.shipment_id,shipment.order_number, shipment.order_value, shipment.order_amount, shipment.payment ,
                 shipment.products_description,shipment.customer_name, shipment.customer_email,  shipment.customer_phone,shipment.customer_country ,
                 shipment.customer_city,shipment.customer_area,  shipment.customer_postal_code,shipment.customer_request ,
                 shipment.shipment_upload_date,shipment.ksp_number,shipment.barcode_image_name,shipment.barcode_status,shipment.barcode_scaned_at,
                 shipment.weight,shipment.pieces,shipment.volume_weight,shipment.chargeable_weight,shipment.tracking_number,shipment.awb_created_at,
                 shipment.awb_printed_at,shipment.status,shipment.active,shipment.shipment_dispatched_at,shipment.shipment_in_hub_at,
                shipment.shipment_delivery_at,shipment.shipment_delivered_at,cities.name as city_name,shipment.name , shipment.email, shipment.phone_number, shipment.country , shipment.city , shipment.area , shipment.address_number
                FROM kshopina.cities INNER JOIN
                ( SELECT
                shipments.shipment_id,shipments.order_number, shipments.order_value, shipments.order_amount, shipments.payment ,
                 shipments.products_description,shipments.customer_name, shipments.customer_email,  shipments.customer_phone,shipments.customer_country ,
                 shipments.customer_city,shipments.customer_area,  shipments.customer_postal_code,shipments.customer_request ,
                 shipments.shipment_upload_date,shipments.ksp_number,shipments.barcode_image_name,shipments.barcode_status,shipments.barcode_scaned_at,
                 shipments.weight,shipments.pieces,shipments.volume_weight,shipments.chargeable_weight,shipments.tracking_number,shipments.awb_created_at,
                 shipments.awb_printed_at,shipments.status,shipments.active,shipments.shipment_dispatched_at,shipments.shipment_in_hub_at,
                 shipments.shipment_delivery_at,shipments.shipment_delivered_at,users.name , users.email, users.phone_number, users.country , users.city , users.area , users.address_number
                FROM kshopina.shipments INNER JOIN
                kshopina.users ON shipments.shipper_id = users.id where shipments.shipper_id = ? LIMIT ?, ?) as shipment ON cities.id = shipment.customer_city) as shipment
                ON countries.id = shipment.customer_country;', [$user_id, $offset, $shipments_per_page]);

        $number_of_shipments = DB::select('SELECT COUNT(shipment_id) AS NumberOfShipments FROM shipments where shipments.shipper_id =? AND shipments.active < ?', [$user_id, 3]);

        return [$shipments, $number_of_shipments];
    }
    public function get_country_city($country_id)
    {
        return DB::select('SELECT countries.id,countries.country_code,cities.id as city_id,cities.name
        FROM kshopina.countries
        INNER JOIN kshopina.cities
        ON countries.id = cities.country_id
        WHERE countries.id = ? AND countries.status = ? AND cities.status = ? ;', [$country_id, 1, 1]);
    }

    public function submit_shipper_info($data)
    {

        date_default_timezone_set('Africa/Cairo');
        $date = date('Y-m-d H:i:s', time());

        DB::table('users')
            ->where('id', $data['id_number'])
            ->update([
                'phone_number' => $data['phone'],
                'country' => 'Korea',
                'city' => $data['city'],
                'area' => $data['area'],
                'address_number' => $data['postalCode'],
                'active' => 0,
                'complete' => 1,
                'completed_at' => $date,
            ]);

    }

    public function create_new_order($data)
    {
        date_default_timezone_set('Africa/Cairo');
        $date = date('Y-m-d H:i:s', time());

        $table = ['order_number' => 'order_number', 'order_value' => 'order_value', 'order_amount' => 'order_amount', 'payment_type' => 'payment',
            'products_description' => 'products_description', 'customer_name' => 'customer_name', 'customer_email' => 'customer_email', 'customer_phone' => 'customer_phone', 'customer_country' => 'customer_country',
            'customer_city' => 'customer_city', 'customer_request' => 'customer_request', 'customer_area' => 'customer_area', 'customer_address_number' => 'customer_postal_code','customer_address_details' => 'customer_address_details'];

        foreach ($data as $key => $value) {
            if ($key == '_token' || $key == 'customer_country_code') {
                continue;
            } else if ($key == 'customer_phone') {
                $query[$table[$key]] = $data['customer_country_code'] . $value;
            } else {
                $query[$table[$key]] = $value;
            }

        }

        $query['shipper_id'] = Auth::user()->id;
        $query['shipment_upload_date'] = $date;
        $query['active'] = 0;
        $query['status'] = 0;

        return DB::table('shipments')->insertGetId($query);

    }
    public function generate_ksp($country, $shipment_id)
    {
        $ksp = 'KSP';

        //country
        $ksp = $ksp . $country;

        //shipper_id
        if (Auth::user()->shipper_id < 10) {
            $ksp = $ksp . '0' . Auth::user()->shipper_id;
        } else {
            $ksp = $ksp . Auth::user()->shipper_id;
        }

        //shipment_id

        if ($shipment_id < 10) {
            $ksp = $ksp . '00' . $shipment_id;
        } elseif ($shipment_id >= 10 && $shipment_id < 100) {
            $ksp = $ksp . '0' . $shipment_id;
        } else {
            $ksp = $ksp . $shipment_id;
        }

        return $ksp;
    }
    public function generate_barcode($ksp_number)
    {
        if (!file_exists(public_path('uploads/barcodes'))) {
            mkdir(public_path('uploads/barcodes'), 0777, true);
        }

        $imageName = 'bar-' . Auth::user()->shipper_id . '-' . time() . '.png';
        $output_file = '/barcodes/' . $imageName;

        $url = public_path('uploads') . $output_file;

        $image = DNS1DFacade::getBarcodePNG($ksp_number, 'C39', 1, 50, array(1, 1, 1), true);

        Storage::disk('public')->put($output_file, base64_decode($image));

        return $imageName;
    }

    public function upload_barcode($shipment_id, $ksp_number, $barcode_image_name)
    {

        DB::table('shipments')
            ->where('shipment_id', $shipment_id)
            ->update([
                'ksp_number' => $ksp_number,
                'barcode_image_name' => $barcode_image_name,
                'barcode_status' => 0,
            ]);
    }
    public function update_status_date($shipments, $column)
    {
        date_default_timezone_set('Africa/Cairo');
        $date = date('Y-m-d H:i:s', time());

        foreach ($shipments as $shipment_id => $value) {

            if ($value == 3) {
                if ($column == 'barcode_scaned_at') {
                    DB::table('shipments')->where('shipment_id', $shipment_id)
                        ->update(['barcode_status' => 1, $column => $date]);
                } else {
                    DB::table('shipments')->where('shipment_id', $shipment_id)
                        ->update([$column => $date]);
                }

            }

        }
    }

    public function get_shipment_by_ksp($ksp_number)
    {
        return DB::select('SELECT * from shipments where ksp_number = ?  ', [$ksp_number]);
    }
    public function get_shipment_by_id($shipment_id)
    {
        return DB::select('SELECT shipment.chargeable_weight, shipment.shipment_id, shipment.order_value, shipment.order_amount, shipment.order_number , shipment.payment , shipment.products_description,
        shipment.customer_name, shipment.customer_email,  shipment.customer_phone,shipment.customer_city, shipment.customer_area,  shipment.customer_postal_code,shipment.customer_address_details,
        shipment.customer_request,shipment.customer_country ,shipment.ksp_number , shipment.shipment_upload_date,
        shipment.name , shipment.email, shipment.phone_number, shipment.country , shipment.city , shipment.area , shipment.address_number ,cities.name as customer_city_name
             FROM kshopina.cities
        INNER JOIN (SELECT shipments.chargeable_weight, shipments.shipment_id, shipments.order_value, shipments.order_amount, shipments.order_number , shipments.payment , shipments.products_description,
        shipments.customer_name, shipments.customer_email,  shipments.customer_phone,shipments.customer_city, shipments.customer_area,  shipments.customer_postal_code,shipments.customer_address_details,
        shipments.customer_request,shipments.customer_country ,shipments.ksp_number , shipments.shipment_upload_date,  users.name , users.email, users.phone_number,
        users.country , users.city , users.area , users.address_number FROM kshopina.shipments
        INNER JOIN kshopina.users ON shipments.shipper_id = users.id where shipments.shipment_id = ? ) as shipment ON cities.id = shipment.customer_city;', [$shipment_id]);
    }
    public function delete_client_shipment($shipment_id)
    {
        $shipment = DB::select('select * from shipments where shipment_id = ?', [$shipment_id]);

        if ($shipment != null && $shipment != []) {
            if ($shipment[0]->status == 0) {
                DB::update('update shipments set active = ? where shipment_id = ?', [3, $shipment_id]);
                return ['success', 'Shipment has been deleted successfully'];
            } else {
                return ['fail', 'You are not permitted to delete this shipment!'];
            }
        } else {
            return ['fail', 'invalid shipment id!'];
        }

    }

    public function get_warehouse_shipmments($page, $filters)
    {
        $rules = "";
        $new_filters = $filters;

        //country
        if ($filters['customer_country'] != 'All' && $filters['customer_country'] != '') {
            $country = DB::select('select * from countries where name = ?', [$filters['customer_country']]);
            if ($country != [] && $country != null) {
                $new_filters['customer_country'] = $country[0]->id;
            } else {
                $new_filters['customer_country'] = 'All';
            }
        }

        //status
        $status = [
            'waiting' => '0'
            , 'recieved' => '1'
            , 'ready' => '2'
            , 'dispatched' => '3'
            , 'hub' => '4'
            , 'ofd' => '5'
            , 'delivered' => '6'
            , 'refused' => '7'];

        try {
            $new_filters['status'] = $status[$new_filters['status']];
        } catch (\Throwable $th) {
            $new_filters['status'] = "All";
        }

        foreach ($new_filters as $key => $value) {
            if ($key == 'shipment_upload_date' && $value != 'All' && $value != "") {
                if (date('Y-m-d H:i:s', strtotime($new_filters['shipment_upload_date'])) == "1970-01-01 00:00:00") {
                    continue;
                }
                if ($rules == "") {
                    $rules = $rules . "shipments." . $key . ' LIKE ' . '"' . $value . '%' . '"';
                } else {
                    $rules = $rules . " AND " . "shipments." . $key . ' LIKE ' . '"' . $value . '%' . '"';
                }
            } elseif ($value != 'All' && $value != "") {
                if ($rules == "") {
                    $rules = $rules . "shipments." . $key . '=' . $value;
                } else {
                    $rules = $rules . " AND " . "shipments." . $key . '=' . $value;
                }
            }
        }
        $shipments_per_page = 15;
        $offset = ($page - 1) * $shipments_per_page;

        /*         $city = DB::select('SELECT * from cities ');
         */

        if ($rules == "") {
            $rules = 'shipments.status > 0';
        }
        $shipments = DB::select(
            'SELECT
        shipment.shipment_id,shipment.order_number, shipment.order_value, shipment.order_amount, shipment.payment ,
                 shipment.products_description,shipment.customer_name, shipment.customer_email,  shipment.customer_phone,shipment.customer_country ,
                 shipment.customer_city,shipment.customer_area,  shipment.customer_postal_code,shipment.customer_request ,
                 shipment.shipment_upload_date,shipment.ksp_number,shipment.barcode_image_name,shipment.barcode_status,shipment.barcode_scaned_at,
                 shipment.weight,shipment.pieces,shipment.volume_weight,shipment.chargeable_weight,shipment.tracking_number,shipment.awb_created_at,
                 shipment.awb_printed_at,shipment.status,shipment.active,shipment.shipment_dispatched_at,shipment.shipment_in_hub_at,
                 shipment.shipment_delivery_at,shipment.shipment_delivered_at,shipment.name,shipment.city_name,countries.name as country_name
                     FROM kshopina.countries INNER JOIN
                (SELECT
                shipment.shipment_id,shipment.order_number, shipment.order_value, shipment.order_amount, shipment.payment ,
                 shipment.products_description,shipment.customer_name, shipment.customer_email,  shipment.customer_phone,shipment.customer_country ,
                 shipment.customer_city,shipment.customer_area,  shipment.customer_postal_code,shipment.customer_request ,
                 shipment.shipment_upload_date,shipment.ksp_number,shipment.barcode_image_name,shipment.barcode_status,shipment.barcode_scaned_at,
                 shipment.weight,shipment.pieces,shipment.volume_weight,shipment.chargeable_weight,shipment.tracking_number,shipment.awb_created_at,
                 shipment.awb_printed_at,shipment.status,shipment.active,shipment.shipment_dispatched_at,shipment.shipment_in_hub_at,
                shipment.shipment_delivery_at,shipment.shipment_delivered_at,shipment.name,cities.name as city_name
                FROM kshopina.cities INNER JOIN
                ( SELECT
                shipments.shipment_id,shipments.order_number, shipments.order_value, shipments.order_amount, shipments.payment ,
                 shipments.products_description,shipments.customer_name, shipments.customer_email,  shipments.customer_phone,shipments.customer_country ,
                 shipments.customer_city,shipments.customer_area,  shipments.customer_postal_code,shipments.customer_request ,
                 shipments.shipment_upload_date,shipments.ksp_number,shipments.barcode_image_name,shipments.barcode_status,shipments.barcode_scaned_at,
                 shipments.weight,shipments.pieces,shipments.volume_weight,shipments.chargeable_weight,shipments.tracking_number,shipments.awb_created_at,
                 shipments.awb_printed_at,shipments.status,shipments.active,shipments.shipment_dispatched_at,shipments.shipment_in_hub_at,
                 shipments.shipment_delivery_at,shipments.shipment_delivered_at,users.name
                FROM kshopina.shipments INNER JOIN
                kshopina.users ON shipments.shipper_id = users.id WHERE ' . $rules . ' LIMIT ?, ?) as shipment ON cities.id = shipment.customer_city) as shipment
                ON countries.id = shipment.customer_country;', [$offset, $shipments_per_page]);

        $number_of_shipments = DB::select('SELECT COUNT(shipment_id) AS NumberOfShipments FROM shipments where ' . $rules, );

        return [$shipments, $number_of_shipments];

    }
    public function scanBarcodes_details($ksp_number)
    {

        $city = DB::select('SELECT * from cities ');

        $shipments = DB::select('SELECT shipments.shipment_id, shipments.shipper_id ,shipments.order_value, shipments.order_amount, shipments.order_number , shipments.payment , shipments.products_description,
        shipments.customer_name, shipments.customer_email,  shipments.customer_phone,shipments.customer_city, shipments.customer_area,  shipments.customer_postal_code,
        shipments.customer_request,shipments.customer_country ,shipments.ksp_number , shipments.shipment_upload_date, shipments.weight, shipments.pieces , shipments.volume_weight ,
        shipments.chargeable_weight , shipments.tracking_number , shipments.status , shipments.active ,
         users.name
          FROM shipments
          INNER JOIN users
          ON shipments.shipper_id = users.id
          WHERE shipments.ksp_number = ? ;', [$ksp_number]);

        return [$shipments, $city];

    }
    public function get_pending_shipments($page)
    {

        $shipments_per_page = 15;
        $offset = ($page - 1) * $shipments_per_page;

        $shipments = DB::select('SELECT
        shipment.shipment_id,shipment.order_number, shipment.order_value, shipment.order_amount, shipment.payment ,
                 shipment.products_description,shipment.customer_name, shipment.customer_email,  shipment.customer_phone,shipment.customer_country ,
                 shipment.customer_city,shipment.customer_area,  shipment.customer_postal_code,shipment.customer_request ,
                 shipment.shipment_upload_date,shipment.ksp_number,shipment.barcode_image_name,shipment.barcode_status,shipment.barcode_scaned_at,
                 shipment.weight,shipment.pieces,shipment.volume_weight,shipment.chargeable_weight,shipment.tracking_number,shipment.awb_created_at,
                 shipment.awb_printed_at,shipment.status,shipment.active,shipment.shipment_dispatched_at,shipment.shipment_in_hub_at,
                 shipment.shipment_delivery_at,shipment.shipment_delivered_at,shipment.name,shipment.city_name,countries.name as country_name
                     FROM kshopina.countries INNER JOIN
                (SELECT
                shipment.shipment_id,shipment.order_number, shipment.order_value, shipment.order_amount, shipment.payment ,
                 shipment.products_description,shipment.customer_name, shipment.customer_email,  shipment.customer_phone,shipment.customer_country ,
                 shipment.customer_city,shipment.customer_area,  shipment.customer_postal_code,shipment.customer_request ,
                 shipment.shipment_upload_date,shipment.ksp_number,shipment.barcode_image_name,shipment.barcode_status,shipment.barcode_scaned_at,
                 shipment.weight,shipment.pieces,shipment.volume_weight,shipment.chargeable_weight,shipment.tracking_number,shipment.awb_created_at,
                 shipment.awb_printed_at,shipment.status,shipment.active,shipment.shipment_dispatched_at,shipment.shipment_in_hub_at,
                shipment.shipment_delivery_at,shipment.shipment_delivered_at,shipment.name,cities.name as city_name
                FROM kshopina.cities INNER JOIN
                ( SELECT
                shipments.shipment_id,shipments.order_number, shipments.order_value, shipments.order_amount, shipments.payment ,
                 shipments.products_description,shipments.customer_name, shipments.customer_email,  shipments.customer_phone,shipments.customer_country ,
                 shipments.customer_city,shipments.customer_area,  shipments.customer_postal_code,shipments.customer_request ,
                 shipments.shipment_upload_date,shipments.ksp_number,shipments.barcode_image_name,shipments.barcode_status,shipments.barcode_scaned_at,
                 shipments.weight,shipments.pieces,shipments.volume_weight,shipments.chargeable_weight,shipments.tracking_number,shipments.awb_created_at,
                 shipments.awb_printed_at,shipments.status,shipments.active,shipments.shipment_dispatched_at,shipments.shipment_in_hub_at,
                 shipments.shipment_delivery_at,shipments.shipment_delivered_at,users.name
                FROM kshopina.shipments INNER JOIN
                kshopina.users ON shipments.shipper_id = users.id WHERE shipments.status = ? LIMIT ?, ? ) as shipment ON cities.id = shipment.customer_city) as shipment
                ON countries.id = shipment.customer_country;', [1, $offset, $shipments_per_page]);

        $number_of_shipments = DB::select('SELECT COUNT(shipment_id) AS NumberOfShipments FROM shipments where shipments.status = ?', [1]);

        return [$shipments, $number_of_shipments];

    }

    public function get_shipments($shipment_id)
    {

        /* $country = DB::select('SELECT countries.name , countries.country_code FROM countries
        INNER JOIN shipments ON shipments.customer_country=countries.id WHERE shipments.status = ? AND shipments.shipment_id = ?  ;', [1, $shipment_id]);

        $city = DB::select('SELECT cities.name FROM cities
        INNER JOIN shipments ON shipments.customer_city=cities.id WHERE shipments.status = ? AND shipments.shipment_id = ?  ;', [1, $shipment_id]);
         */
        $payment_method = ['COD', 'CREDIT CARD'];

        $shipments = DB::select(
            'SELECT
        shipment.shipment_id,shipment.order_number, shipment.order_value, shipment.order_amount, shipment.payment ,
                 shipment.products_description,shipment.customer_name, shipment.customer_email,  shipment.customer_phone,shipment.customer_country ,
                 shipment.customer_city,shipment.customer_area,  shipment.customer_postal_code,shipment.customer_request ,
                 shipment.shipment_upload_date,shipment.ksp_number,shipment.barcode_image_name,shipment.barcode_status,shipment.barcode_scaned_at,
                 shipment.weight,shipment.pieces,shipment.volume_weight,shipment.chargeable_weight,shipment.tracking_number,shipment.awb_created_at,
                 shipment.awb_printed_at,shipment.status,shipment.active,shipment.shipment_dispatched_at,shipment.shipment_in_hub_at,
                 shipment.shipment_delivery_at,shipment.shipment_delivered_at,shipment.city_name,countries.name as country_name,shipment.name , shipment.email, shipment.phone_number, shipment.country , shipment.city , shipment.area , shipment.address_number
                     FROM kshopina.countries INNER JOIN
                (SELECT
                shipment.shipment_id,shipment.order_number, shipment.order_value, shipment.order_amount, shipment.payment ,
                 shipment.products_description,shipment.customer_name, shipment.customer_email,  shipment.customer_phone,shipment.customer_country ,
                 shipment.customer_city,shipment.customer_area,  shipment.customer_postal_code,shipment.customer_request ,
                 shipment.shipment_upload_date,shipment.ksp_number,shipment.barcode_image_name,shipment.barcode_status,shipment.barcode_scaned_at,
                 shipment.weight,shipment.pieces,shipment.volume_weight,shipment.chargeable_weight,shipment.tracking_number,shipment.awb_created_at,
                 shipment.awb_printed_at,shipment.status,shipment.active,shipment.shipment_dispatched_at,shipment.shipment_in_hub_at,
                shipment.shipment_delivery_at,shipment.shipment_delivered_at,cities.name as city_name,shipment.name , shipment.email, shipment.phone_number, shipment.country , shipment.city , shipment.area , shipment.address_number
                FROM kshopina.cities INNER JOIN
                ( SELECT
                shipments.shipment_id,shipments.order_number, shipments.order_value, shipments.order_amount, shipments.payment ,
                 shipments.products_description,shipments.customer_name, shipments.customer_email,  shipments.customer_phone,shipments.customer_country ,
                 shipments.customer_city,shipments.customer_area,  shipments.customer_postal_code,shipments.customer_request ,
                 shipments.shipment_upload_date,shipments.ksp_number,shipments.barcode_image_name,shipments.barcode_status,shipments.barcode_scaned_at,
                 shipments.weight,shipments.pieces,shipments.volume_weight,shipments.chargeable_weight,shipments.tracking_number,shipments.awb_created_at,
                 shipments.awb_printed_at,shipments.status,shipments.active,shipments.shipment_dispatched_at,shipments.shipment_in_hub_at,
                 shipments.shipment_delivery_at,shipments.shipment_delivered_at,users.name , users.email, users.phone_number, users.country , users.city , users.area , users.address_number
                FROM kshopina.shipments INNER JOIN
                kshopina.users ON shipments.shipper_id = users.id WHERE shipments.status = ? AND shipments.shipment_id = ?) as shipment ON cities.id = shipment.customer_city) as shipment
                ON countries.id = shipment.customer_country;', [1, $shipment_id]);

        return [$shipments, $payment_method];

    }
    public function change_shipment_status($shipments, $status)
    {

        foreach ($shipments as $shipment_id => $value) {

            if ($value == 3) {
                DB::table('shipments')->where('shipment_id', $shipment_id)
                    ->update(['status' => $status]);
            }

        }

    }
    public function create_glt($shipment_data, $additional_data)
    {

        if ($shipment_data->payment == 0) {
            $payment = 'COD';
        } else {
            $payment = 'CC';
        }

        $client = new guzzle([
            'headers' => [
                'Authorization' => 'Basic a3Nob3BpbmE6YXNkZjEyMzQ=',
                'Content-Type' => 'application/json',
            ],
        ]);
        $URI = 'https://api.gltmena.com/api/create/order';

        $body = [
            "orders" => [[

                "referenceNumber" => $shipment_data->order_number,
                "pieces" => $additional_data['pieces'],
                "description" => $shipment_data->products_description,
                "codAmount" => $shipment_data->order_amount,
                "paymentType" => $payment,
                "clientComments" => $shipment_data->customer_request,
                "sender" => $shipment_data->name,
                "senderInformation" => [
                    "city" => [
                        "name" => "Seoul",
                    ],
                    "address" => "Korea",
                    "contactNumber" => $shipment_data->phone_number,
                ],
                "value" => $shipment_data->order_value,
                "customer" => [
                    "name" => $shipment_data->customer_name,
                    "customerAddresses" => [
                        "city" => [
                            "name" => $shipment_data->customer_city_name,
                        ],
                        "address" => $shipment_data->customer_address_details,
                        "areaName" => $shipment_data->customer_area,
                    ],
                    "mobile1" => $shipment_data->customer_phone,
                ],
                "weight" => $additional_data['chargeable_weight'],
            ]],
        ];

        $body = json_encode($body);
        $URI_Response = $client->request('POST', $URI, ['body' => $body]);
        $URI_Response = json_decode($URI_Response->getBody(), true);

        return $URI_Response;
    }
    public function download_glt($awb)
    {
           
        $client = new guzzle([
            'headers' => [
                'Authorization' => 'Basic a3Nob3BpbmE6YXNkZjEyMzQ=',
                'Content-Type' => 'application/json',
            ],
        ]);
        $URI = 'https://api.gltmena.com/api/get/awb?orderid=' . $awb;
      

        $URI_Response = $client->request('POST', $URI);
        header("Content-Disposition: attachment; filename=".$awb.".pdf"); 

       return $URI_Response->getBody()->getContents();
        
    }
    public function awb_printed($awb)
    {
        date_default_timezone_set('Africa/Cairo');
        $date = date('Y-m-d H:i:s', time());

        DB::table('shipments')->where('tracking_number', $awb)->update([
            'awb_printed_at' => $date,
        ]);
    }

    public function add_additional_data($additional_data, $tracking_number, $shipment_id)
    {
        date_default_timezone_set('Africa/Cairo');
        $date = date('Y-m-d H:i:s', time());

        DB::table('shipments')->where('shipment_id', $shipment_id)->update(['weight' => $additional_data['weight'],
            'pieces' => $additional_data['pieces'],
            'volume_weight' => $additional_data['volume_weight'],
            'chargeable_weight' => $additional_data['chargeable_weight'],
            'tracking_number' => $tracking_number,
            'awb_created_at' => $date,
        ]);
    }
    public function get_accounts($page)
    {
        $shipments_per_page = 15;
        $offset = ($page - 1) * $shipments_per_page;

        $accounts = DB::select('SELECT * from users where type = ? LIMIT ?, ?', [1, $offset, $shipments_per_page]);

        $number_of_accounts = DB::select('SELECT COUNT(id) AS NumberOfAccounts FROM users where users.type = ?', [1]);

        return [$accounts, $number_of_accounts];
    }

    public function get_vendors_shipments($page)
    {

        $shipments_per_page = 15;
        $offset = ($page - 1) * $shipments_per_page;

        $shipments = DB::select('SELECT shipments.shipper_id,users.created_at,users.email,users.phone_number,users.active,users.name,COUNT(id) AS NumberOfShipments
        FROM kshopina.shipments
        INNER JOIN kshopina.users ON (users.id = shipments.shipper_id )
        GROUP BY users.id order by created_at DESC');

        $received_shipments = DB::select('SELECT shipments.shipper_id,users.created_at,users.email,users.phone_number,users.active,users.name,COUNT(id) AS NumberOfShipments
        FROM kshopina.shipments
        INNER JOIN kshopina.users ON (users.id = shipments.shipper_id ) where shipments.status >= 1
        GROUP BY users.id order by created_at DESC');
        $query = '(';

        $first = 0;
        foreach ($shipments as $shipment) {
            if ($first == 0) {
                $query = $query . $shipment->shipper_id;
                $first = 1;
            } else {
                $query = $query . ',' . $shipment->shipper_id;

            }
        }
        $query = $query . ')';

        if ($query == "()") {
            $all_shipments= [];
        } else {
            $all_shipments = DB::select('SELECT * from shipments where shipper_id IN ' . $query);
        }
        

        return [$shipments, $received_shipments, $all_shipments];
    }
    public function get_shipments_of_vendor($page, $shipper_id)
    {

        $shipments_per_page = 15;
        $offset = ($page - 1) * $shipments_per_page;

        $shipments = DB::select('SELECT shipments.shipper_id,users.created_at,users.email,users.phone_number,users.active,users.name,COUNT(id) AS NumberOfShipments
        FROM kshopina.shipments
        INNER JOIN kshopina.users ON (users.id = shipments.shipper_id )
        GROUP BY users.id order by created_at DESC');

        $received_shipments = DB::select('SELECT shipments.shipper_id,users.created_at,users.email,users.phone_number,users.active,users.name,COUNT(id) AS NumberOfShipments
        FROM kshopina.shipments
        INNER JOIN kshopina.users ON (users.id = shipments.shipper_id ) where shipments.status >= 1
        GROUP BY users.id order by created_at DESC');

        return [$shipments, $received_shipments];
    }
    public function toggle_users_active($id, $active)
    {
        if ($active == 0) {
            DB::table('users')->where('id', $id)->update(['active' => 1]);
        } else {
            DB::table('users')->where('id', $id)->update(['active' => 0]);
        }

    }

    //tracking
    public function update_domestic_status($shipments)
    {
        $update = 0;
        foreach ($shipments as $key => $shipment) {
            if ((($shipment->status >= 3 && $shipment->status < 5) || $shipment->status == 6) && !empty($shipment->tracking_number)) {
                $update = 1;
                //KSA

                /* if ($shipment->customer_country == 1) {
                    $this->update_GLT_status($shipment->tracking_number, $shipment->shipment_id, $shipment->status, $shipment->shipment_delivered_at,'KSA');
                } */
               /*  elseif ($shipment->customer_country == 1) {
                    $this->update_GLT_status($shipment->tracking_number, $shipment->shipment_id, $shipment->status, $shipment->shipment_delivered_at,'KSA');
                } */

            }

        }
        if ($update == 0) {
            return false;
        }
        return true;
    }
    /* public function update_GLT_status($tracking_number, $shipment_id, $shipment_status, $delivered_at,$country)
    {
        $keys=['KSA'=>"a3Nob3BpbmE6YXNkZjEyMzQ=",'UAE'=>"S1NIT1BJTkFVQUU6S1NIT1BJTkExMjM=","KSA_TEST"=>"a3Nob3BpbmF0ZXN0OnF3ZTMyMWFzZA=="];

        date_default_timezone_set('Asia/Riyadh');
        $date = date('Y-m-d', time());

        $client = new guzzle([
            'headers' => [
                'Authorization' => 'Basic '.$keys[$country],
                'Content-Type' => 'application/json',
            ],
        ]);
        $URI = 'https://api.gltmena.com/api/order/check/statuses?timezone=Asia/Riyadh&from=2022-03-1&to='.$date;

        $body = [
            "id" => $tracking_number,
        ];

        $body = json_encode($body);
        try {
            $URI_Response = $client->request('POST', $URI, ['body' => $body]);
            $URI_Response = json_decode($URI_Response->getBody(), true);
        } catch (\Throwable $th) {

            DB::table('errors')->insert(['shipment_number' => $shipment_id, 'system_name' => 'GLT_TRACKING', 'status' => 'Fail', 'message' => $th->getMessage()]);
            return (['response' => 'fail', 'message' => $th->getMessage()]);

        }

        $hub = 0;
        $ready = 0;
        $arrive = 0;
        $status = 0;
        $query = [];
        $dates = [];
        $update = 0;
        if ($shipment_status == 6 && $delivered_at != null && $delivered_at != "") {

            date_default_timezone_set('Africa/Cairo');
            $now = date('Y-m-d H:i:s', time());

            $date1 = new DateTime($delivered_at);
            $date2 = new DateTime($now);
            $interval = $date1->diff($date2);

            //3 days for refused order untill the connection broken
            if ($interval->d < 3) {
                $update = 1;
            } else {
                $update = 2;
            }
        }
        if ($update != 2) {

            if ($URI_Response['status'] == 'success') {
                if (isset($URI_Response['data']['orders']) && $URI_Response['data']['orders'] != []) {

                    $URI_Response = $URI_Response['data']['orders'];

                    foreach ($URI_Response as $key => $value) {
                        if ($value->id == $tracking_number) {

                            foreach ($value['events'] as $key => $record) {
    
                                if ($record['status'] == 'RECEIVED_IN_HUB' ||$record['status'] == 'PICKED'  && $hub == 0) {
                                    $hub = 1;
            
                                    $status = $this->status['Kshopina_Warehouse'];
                                    $dates['shipment_in_hub_at'] = date("Y-m-d H:i:s", strtotime($record['createdAt']));
            
                                    $query['status'] = $status;
                                    $query['shipment_in_hub_at'] = $dates['shipment_in_hub_at'];
            
                                } elseif ($record['status'] == 'OUT_FOR_DELIVERY' && $ready == 0) {
                                    $ready = 1;
            
                                    $status = $this->status['Delivery'];
                                    $dates['shipment_delivery_at'] = date("Y-m-d H:i:s", strtotime($record['createdAt']));
            
                                    $query['status'] = $status;
                                    $query['shipment_delivery_at'] = $dates['shipment_delivery_at'];
            
                                } elseif ($record['status'] == 'DELIVERED' ) {
                                    $arrive = 1;
            
                                    $status = $this->status['Delivered'];
                                    $dates['shipment_delivered_at'] = date("Y-m-d H:i:s", strtotime($record['createdAt']));
            
                                    $query['status'] = $status;
                                    $query['shipment_delivered_at'] = $dates['shipment_delivered_at'];
            
                                } elseif ($record['status'] == 'NOT_DELIVERED' ) {
                                    $arrive = 1;
            
                                    $status = $this->status['Refused'];;
                                    $dates['shipment_delivered_at'] = date("Y-m-d H:i:s", strtotime($record['createdAt']));
            
                                    $query['status'] = $status;
                                    $query['shipment_delivered_at'] = $dates['shipment_delivered_at'];
            
                                } elseif ($record['status'] == 'OUT_FOR_DELIVERY' && $update == 1) {
                                    
                                    $status = $this->status['Delivery'];
                                    $dates['shipment_delivery_at'] = date("Y-m-d H:i:s", strtotime($record['createdAt']));
            
                                    $query['status'] = $status;
                                    $query['shipment_delivery_at'] = $dates['shipment_delivery_at'];
                                    $query['shipment_delivered_at'] = null;
            
                                } elseif ($record['status'] == 'DELIVERED' && $update == 1) {
                                    $status = $this->status['Delivered'];
                                    $dates['shipment_delivered_at'] = date("Y-m-d H:i:s", strtotime($record['createdAt']));
            
                                    $query['status'] = $status;
                                    $query['shipment_delivered_at'] = $dates['shipment_delivered_at'];
            
                                } elseif ($record['status'] == 'NOT_DELIVERED' && $update == 1) {
                                    $status = $this->status['Refused'];
                                    $dates['shipment_delivered_at'] = date("Y-m-d H:i:s", strtotime($record['createdAt']));
            
                                    $query['status'] = $status;
                                    $query['shipment_delivered_at'] = $dates['shipment_delivered_at'];
            
                                }
                                /* else{
                                    $query['status'] = $this->get_shipment_by_id($shipment_id)[0]->status;
                    
                                    }
                                    
                        }
                        
                    }
                    
    
                }
                    if ($query != []) {
                        DB::table('shipments')->where('shipment_id', $shipment_id)->update($query);
    
                        return (['response' => 'success', 'status' => $status, 'dates' => $dates]);
                    }
                } else {
                    DB::table('errors')->insert(['shipment_number' => $tracking_number, 'system_name' => 'GLT_TRACKING', 'status' => $URI_Response['status'], 'message' => "Can not find the GLT tracking number"]);
                }
                
               
            } else {
                DB::table('errors')->insert(['shipment_number' => $tracking_number, 'system_name' => 'GLT_TRACKING', 'status' => $URI_Response['status'], 'message' => $URI_Response['message']]);
                return (['response' => 'fail', 'message' => $URI_Response['message']]);
            }
        }
    } */

    public function shipment_like_staff($value)
    {
        $value = $value . '%';
        return DB::select(
            'SELECT
        shipment.shipment_id,shipment.order_number, shipment.order_value, shipment.order_amount, shipment.payment ,
                 shipment.products_description,shipment.customer_name, shipment.customer_email,  shipment.customer_phone,shipment.customer_country ,
                 shipment.customer_city,shipment.customer_area,  shipment.customer_postal_code,shipment.customer_request ,
                 shipment.shipment_upload_date,shipment.ksp_number,shipment.barcode_image_name,shipment.barcode_status,shipment.barcode_scaned_at,
                 shipment.weight,shipment.pieces,shipment.volume_weight,shipment.chargeable_weight,shipment.tracking_number,shipment.awb_created_at,
                 shipment.awb_printed_at,shipment.status,shipment.active,shipment.shipment_dispatched_at,shipment.shipment_in_hub_at,
                 shipment.shipment_delivery_at,shipment.shipment_delivered_at,shipment.name,shipment.city_name,countries.name as country_name
                     FROM kshopina.countries INNER JOIN
                (SELECT
                shipment.shipment_id,shipment.order_number, shipment.order_value, shipment.order_amount, shipment.payment ,
                 shipment.products_description,shipment.customer_name, shipment.customer_email,  shipment.customer_phone,shipment.customer_country ,
                 shipment.customer_city,shipment.customer_area,  shipment.customer_postal_code,shipment.customer_request ,
                 shipment.shipment_upload_date,shipment.ksp_number,shipment.barcode_image_name,shipment.barcode_status,shipment.barcode_scaned_at,
                 shipment.weight,shipment.pieces,shipment.volume_weight,shipment.chargeable_weight,shipment.tracking_number,shipment.awb_created_at,
                 shipment.awb_printed_at,shipment.status,shipment.active,shipment.shipment_dispatched_at,shipment.shipment_in_hub_at,
                shipment.shipment_delivery_at,shipment.shipment_delivered_at,shipment.name,cities.name as city_name
                FROM kshopina.cities INNER JOIN
                ( SELECT
                shipments.shipment_id,shipments.order_number, shipments.order_value, shipments.order_amount, shipments.payment ,
                 shipments.products_description,shipments.customer_name, shipments.customer_email,  shipments.customer_phone,shipments.customer_country ,
                 shipments.customer_city,shipments.customer_area,  shipments.customer_postal_code,shipments.customer_request ,
                 shipments.shipment_upload_date,shipments.ksp_number,shipments.barcode_image_name,shipments.barcode_status,shipments.barcode_scaned_at,
                 shipments.weight,shipments.pieces,shipments.volume_weight,shipments.chargeable_weight,shipments.tracking_number,shipments.awb_created_at,
                 shipments.awb_printed_at,shipments.status,shipments.active,shipments.shipment_dispatched_at,shipments.shipment_in_hub_at,
                 shipments.shipment_delivery_at,shipments.shipment_delivered_at,users.name
                FROM kshopina.shipments INNER JOIN
                kshopina.users ON shipments.shipper_id = users.id WHERE ksp_number LIKE "' . $value . '") as shipment ON cities.id = shipment.customer_city) as shipment
                ON countries.id = shipment.customer_country;');

    }

    public function shipment_like_client($value, $user)
    {
        $value = $value . '%';

        return DB::select(
            'SELECT
        shipment.shipment_id,shipment.order_number, shipment.order_value, shipment.order_amount, shipment.payment ,
                 shipment.products_description,shipment.customer_name, shipment.customer_email,  shipment.customer_phone,shipment.customer_country ,
                 shipment.customer_city,shipment.customer_area,  shipment.customer_postal_code,shipment.customer_request ,
                 shipment.shipment_upload_date,shipment.ksp_number,shipment.barcode_image_name,shipment.barcode_status,shipment.barcode_scaned_at,
                 shipment.weight,shipment.pieces,shipment.volume_weight,shipment.chargeable_weight,shipment.tracking_number,shipment.awb_created_at,
                 shipment.awb_printed_at,shipment.status,shipment.active,shipment.shipment_dispatched_at,shipment.shipment_in_hub_at,
                 shipment.shipment_delivery_at,shipment.shipment_delivered_at,shipment.name,shipment.city_name,countries.name as country_name
                     FROM kshopina.countries INNER JOIN
                (SELECT
                shipment.shipment_id,shipment.order_number, shipment.order_value, shipment.order_amount, shipment.payment ,
                 shipment.products_description,shipment.customer_name, shipment.customer_email,  shipment.customer_phone,shipment.customer_country ,
                 shipment.customer_city,shipment.customer_area,  shipment.customer_postal_code,shipment.customer_request ,
                 shipment.shipment_upload_date,shipment.ksp_number,shipment.barcode_image_name,shipment.barcode_status,shipment.barcode_scaned_at,
                 shipment.weight,shipment.pieces,shipment.volume_weight,shipment.chargeable_weight,shipment.tracking_number,shipment.awb_created_at,
                 shipment.awb_printed_at,shipment.status,shipment.active,shipment.shipment_dispatched_at,shipment.shipment_in_hub_at,
                shipment.shipment_delivery_at,shipment.shipment_delivered_at,shipment.name,cities.name as city_name
                FROM kshopina.cities INNER JOIN
                ( SELECT
                shipments.shipment_id,shipments.order_number, shipments.order_value, shipments.order_amount, shipments.payment ,
                 shipments.products_description,shipments.customer_name, shipments.customer_email,  shipments.customer_phone,shipments.customer_country ,
                 shipments.customer_city,shipments.customer_area,  shipments.customer_postal_code,shipments.customer_request ,
                 shipments.shipment_upload_date,shipments.ksp_number,shipments.barcode_image_name,shipments.barcode_status,shipments.barcode_scaned_at,
                 shipments.weight,shipments.pieces,shipments.volume_weight,shipments.chargeable_weight,shipments.tracking_number,shipments.awb_created_at,
                 shipments.awb_printed_at,shipments.status,shipments.active,shipments.shipment_dispatched_at,shipments.shipment_in_hub_at,
                 shipments.shipment_delivery_at,shipments.shipment_delivered_at,users.name
                FROM kshopina.shipments INNER JOIN
                kshopina.users ON shipments.shipper_id = users.id WHERE shipments.shipper_id = ? AND ksp_number LIKE "' . $value . '" ) as shipment ON cities.id = shipment.customer_city) as shipment
                ON countries.id = shipment.customer_country;', [$user]);

    }

    public function get_shipment_for_staff_search($ksp_number)
    {

        $shipments = DB::select(
            'SELECT
        shipment.shipment_id,shipment.order_number, shipment.order_value, shipment.order_amount, shipment.payment ,
                 shipment.products_description,shipment.customer_name, shipment.customer_email,  shipment.customer_phone,shipment.customer_country ,
                 shipment.customer_city,shipment.customer_area,  shipment.customer_postal_code,shipment.customer_request ,
                 shipment.shipment_upload_date,shipment.ksp_number,shipment.barcode_image_name,shipment.barcode_status,shipment.barcode_scaned_at,
                 shipment.weight,shipment.pieces,shipment.volume_weight,shipment.chargeable_weight,shipment.tracking_number,shipment.awb_created_at,
                 shipment.awb_printed_at,shipment.status,shipment.active,shipment.shipment_dispatched_at,shipment.shipment_in_hub_at,
                 shipment.shipment_delivery_at,shipment.shipment_delivered_at,shipment.city_name,countries.name as country_name,shipment.name , shipment.email, shipment.phone_number, shipment.country , shipment.city , shipment.area , shipment.address_number
                     FROM kshopina.countries INNER JOIN
                (SELECT
                shipment.shipment_id,shipment.order_number, shipment.order_value, shipment.order_amount, shipment.payment ,
                 shipment.products_description,shipment.customer_name, shipment.customer_email,  shipment.customer_phone,shipment.customer_country ,
                 shipment.customer_city,shipment.customer_area,  shipment.customer_postal_code,shipment.customer_request ,
                 shipment.shipment_upload_date,shipment.ksp_number,shipment.barcode_image_name,shipment.barcode_status,shipment.barcode_scaned_at,
                 shipment.weight,shipment.pieces,shipment.volume_weight,shipment.chargeable_weight,shipment.tracking_number,shipment.awb_created_at,
                 shipment.awb_printed_at,shipment.status,shipment.active,shipment.shipment_dispatched_at,shipment.shipment_in_hub_at,
                shipment.shipment_delivery_at,shipment.shipment_delivered_at,cities.name as city_name,shipment.name , shipment.email, shipment.phone_number, shipment.country , shipment.city , shipment.area , shipment.address_number
                FROM kshopina.cities INNER JOIN
                ( SELECT
                shipments.shipment_id,shipments.order_number, shipments.order_value, shipments.order_amount, shipments.payment ,
                 shipments.products_description,shipments.customer_name, shipments.customer_email,  shipments.customer_phone,shipments.customer_country ,
                 shipments.customer_city,shipments.customer_area,  shipments.customer_postal_code,shipments.customer_request ,
                 shipments.shipment_upload_date,shipments.ksp_number,shipments.barcode_image_name,shipments.barcode_status,shipments.barcode_scaned_at,
                 shipments.weight,shipments.pieces,shipments.volume_weight,shipments.chargeable_weight,shipments.tracking_number,shipments.awb_created_at,
                 shipments.awb_printed_at,shipments.status,shipments.active,shipments.shipment_dispatched_at,shipments.shipment_in_hub_at,
                 shipments.shipment_delivery_at,shipments.shipment_delivered_at,users.name , users.email, users.phone_number, users.country , users.city , users.area , users.address_number
                FROM kshopina.shipments INNER JOIN
                kshopina.users ON shipments.shipper_id = users.id WHERE shipments.ksp_number = ?) as shipment ON cities.id = shipment.customer_city) as shipment
                ON countries.id = shipment.customer_country;', [$ksp_number]);

        return $shipments;

    }

    public function get_shipment_for_client_search($user_id, $ksp_number)
    {

        $shipments =
        DB::select(
            'SELECT
        shipment.shipment_id,shipment.order_number, shipment.order_value, shipment.order_amount, shipment.payment ,
                 shipment.products_description,shipment.customer_name, shipment.customer_email,  shipment.customer_phone,shipment.customer_country ,
                 shipment.customer_city,shipment.customer_area,  shipment.customer_postal_code,shipment.customer_request ,
                 shipment.shipment_upload_date,shipment.ksp_number,shipment.barcode_image_name,shipment.barcode_status,shipment.barcode_scaned_at,
                 shipment.weight,shipment.pieces,shipment.volume_weight,shipment.chargeable_weight,shipment.tracking_number,shipment.awb_created_at,
                 shipment.awb_printed_at,shipment.status,shipment.active,shipment.shipment_dispatched_at,shipment.shipment_in_hub_at,
                 shipment.shipment_delivery_at,shipment.shipment_delivered_at,shipment.city_name,countries.name as country_name,shipment.name , shipment.email, shipment.phone_number, shipment.country , shipment.city , shipment.area , shipment.address_number
                     FROM kshopina.countries INNER JOIN
                (SELECT
                shipment.shipment_id,shipment.order_number, shipment.order_value, shipment.order_amount, shipment.payment ,
                 shipment.products_description,shipment.customer_name, shipment.customer_email,  shipment.customer_phone,shipment.customer_country ,
                 shipment.customer_city,shipment.customer_area,  shipment.customer_postal_code,shipment.customer_request ,
                 shipment.shipment_upload_date,shipment.ksp_number,shipment.barcode_image_name,shipment.barcode_status,shipment.barcode_scaned_at,
                 shipment.weight,shipment.pieces,shipment.volume_weight,shipment.chargeable_weight,shipment.tracking_number,shipment.awb_created_at,
                 shipment.awb_printed_at,shipment.status,shipment.active,shipment.shipment_dispatched_at,shipment.shipment_in_hub_at,
                shipment.shipment_delivery_at,shipment.shipment_delivered_at,cities.name as city_name,shipment.name , shipment.email, shipment.phone_number, shipment.country , shipment.city , shipment.area , shipment.address_number
                FROM kshopina.cities INNER JOIN
                ( SELECT
                shipments.shipment_id,shipments.order_number, shipments.order_value, shipments.order_amount, shipments.payment ,
                 shipments.products_description,shipments.customer_name, shipments.customer_email,  shipments.customer_phone,shipments.customer_country ,
                 shipments.customer_city,shipments.customer_area,  shipments.customer_postal_code,shipments.customer_request ,
                 shipments.shipment_upload_date,shipments.ksp_number,shipments.barcode_image_name,shipments.barcode_status,shipments.barcode_scaned_at,
                 shipments.weight,shipments.pieces,shipments.volume_weight,shipments.chargeable_weight,shipments.tracking_number,shipments.awb_created_at,
                 shipments.awb_printed_at,shipments.status,shipments.active,shipments.shipment_dispatched_at,shipments.shipment_in_hub_at,
                 shipments.shipment_delivery_at,shipments.shipment_delivered_at,users.name , users.email, users.phone_number, users.country , users.city , users.area , users.address_number
                FROM kshopina.shipments INNER JOIN
                kshopina.users ON shipments.shipper_id = users.id where shipments.shipper_id = ? AND shipments.ksp_number = ? ) as shipment ON cities.id = shipment.customer_city) as shipment
                ON countries.id = shipment.customer_country;', [$user_id, $ksp_number]);

        return $shipments;
    }

    public function import($file, $client)
    {
        date_default_timezone_set('Africa/Cairo');

        $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader('Xlsx');
        $reader->setReadDataOnly(true);
        $spreadsheet = $reader->load($file);

        $worksheet = $spreadsheet->getActiveSheet();

        $highestRow = $worksheet->getHighestRow();
        $highestColumn = $worksheet->getHighestColumn();

        $dataArray = $spreadsheet->getActiveSheet()
            ->rangeToArray(
                'A1:' . $highestColumn . $highestRow, // The worksheet range that we want to retrieve
                null, // Value that should be returned for empty cells
                true, // Should formulas be calculated (the equivalent of getCalculatedValue() for each cell)
                true, // Should values be formatted (the equivalent of getFormattedValue() for each cell)
                true// Should the array be indexed by cell row and cell column
            );
        // remove empty rows
        $dataArray = array_map('array_filter', $dataArray);
        $dataArray = array_filter($dataArray);
        $payment_method = ['COD', 'CREDIT CARD'];
        $payment_ids = ['COD' => 0, 'CREDIT CARD' => 1];

//save source file
        if (!file_exists(public_path('uploads/vendors/source_files'))) {
            mkdir(public_path('uploads/vendors/source_files'), 0777, true);
        }
        if (!file_exists(public_path('uploads/vendors/result_files'))) {
            mkdir(public_path('uploads/vendors/result_files'), 0777, true);
        }
        $source_file_Name = 'source_' . Auth::user()->shipper_id . '_' . time() . '.xlsx';

        $file->move(public_path('uploads/vendors/source_files'), $source_file_Name);
//

$test=[];
        $orders = ['success' => 0, 'failed' => 0];

        $errors = ['template' => 'Invalid template, There is an error with entering the data!', 'empty_cells' => 'There are empty cells!', 'invalid' => 'Invalid Input ',
            'payment_amount' => 'Amount should equal to zero when you choose CREDIT CARD ', 'dublicate' => 'You can not Enter two orders with the same order number',
            'country' => 'We do not currently deliver to this country', 'city' => 'Invalid city name!', 'payment' => 'Invalid payment method',
            'empty_amount' => 'Amount should not equal to zero'];

        $result = [];

        $table = ['order_number' => 'A', 'order_value' => 'B', 'order_amount' => 'C', 'payment' => 'D', 'products_description' => 'E', 'customer_name' => 'F',
            'customer_email' => 'G', 'customer_phone' => 'H', 'customer_country' => 'I', 'customer_city' => 'J', 'customer_area' => 'K',
            'customer_postal_code' => 'L', 'customer_request' => 'M'];

        $titles = ['Order number' => 'A', 'Order Value' => 'B'
            , 'Amount' => 'C'
            , 'Payment Type' => 'D'
            , 'Products Description' => 'E'
            , 'Customer Name' => 'F'
            , 'Customer Email' => 'G'
            , 'Customer Phone' => 'H'
            , 'Country' => 'I'
            , 'City' => 'J'
            , 'Address Area' => 'K'
            , 'Postal Code' => 'L'
            , 'Request' => 'M'];

        $mandatory_cells = ['Order number' => 'A', 'Order Value' => 'B'
            , 'Amount' => 'C'
            , 'Payment Type' => 'D'
            , 'Products Description' => 'E'
            , 'Customer Name' => 'F'
            , 'Customer Email' => 'G'
            , 'Customer Phone' => 'H'
            , 'Country' => 'I'
            , 'City' => 'J'
            , 'Address Area' => 'K'];

        $result_file_counter = 2;
        //case_1
        if (
            $dataArray[1][$titles['Order number']] != 'Order Number' || $dataArray[1][$titles['Order Value']] != 'Order Value' || $dataArray[1][$titles['Amount']] != 'Amount' || $dataArray[1][$titles['Payment Type']] != 'Payment Type' ||
            $dataArray[1][$titles['Products Description']] != 'Products Description' || $dataArray[1][$titles['Customer Name']] != 'Customer Name' || $dataArray[1][$titles['Customer Email']] != 'Customer Email' || $dataArray[1][$titles['Customer Phone']] != 'Customer Phone' || $dataArray[1][$titles['Country']] != 'Country' ||
            $dataArray[1][$titles['City']] != 'City' || $dataArray[1][$titles['Address Area']] != 'Address Area' || $dataArray[1][$titles['Postal Code']] != 'Postal Code' || $dataArray[1][$titles['Request']] != 'Request'
        ) {
            unset($reader);

            return ['status' => 'fail', 'message' => $errors['template']];

        }

        // remove title row
        array_shift($dataArray);
        //

        //create the result file
        $spreadsheet1 = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $spreadsheet1->getActiveSheet()->setTitle('Orders');

        $spreadsheet1->getSheet(0)->setCellValue('A1', 'Order Number');
        $spreadsheet1->getSheet(0)->setCellValue('B1', 'Country');
        $spreadsheet1->getSheet(0)->setCellValue('C1', 'City');
        $spreadsheet1->getSheet(0)->setCellValue('D1', 'Payment');
        $spreadsheet1->getSheet(0)->setCellValue('E1', 'Status');
        $spreadsheet1->getSheet(0)->setCellValue('F1', 'KSP NO.');
        $spreadsheet1->getSheet(0)->setCellValue('G1', 'Tracking url');
        //
        /* if (!isset($element[$titles['Amount']])) {
        return
        } */
        foreach ($dataArray as $element) {

            /*  if ((!isset($element[$titles['Amount']]))) {
            $element[$titles['Amount']] = 0;
            }  */
/*             $row_keys = array_keys($element);
 */
            //payment method  && empty cells
            foreach ($mandatory_cells as $title => $cell_number) {
                if (!isset($element[$cell_number]) && $cell_number != $titles['Amount'] && $cell_number != $titles['Payment Type']) {
                    $orders['failed'] = $orders['failed'] + 1;

                    $result = ['status' => 'fail', 'error' => $errors['empty_cells']];
                    break;
                } elseif ($cell_number == $titles['Payment Type'] && (!isset($element[$cell_number]) || ($element[$titles['Payment Type']] != $payment_method[0] && $element[$titles['Payment Type']] != $payment_method[1]))) {
                    $orders['failed'] = $orders['failed'] + 1;
                    $result = ['status' => 'fail', 'error' => $errors['payment']];
                    break;
                } elseif ($cell_number == $titles['Amount'] && (!isset($element[$cell_number]) && $element[$titles['Payment Type']] == $payment_method[0])) {
                    $orders['failed'] = $orders['failed'] + 1;
                    $result = ['status' => 'fail', 'error' => $errors['empty_amount']];
                    break;
                } elseif ($cell_number == $titles['Amount'] && (isset($element[$cell_number]) && $element[$titles['Payment Type']] == $payment_method[1])) {
                    $orders['failed'] = $orders['failed'] + 1;
                    $result = ['status' => 'fail', 'error' => $errors['payment_amount']];
                    break;
                }

            }

            if ($result == [] && $element[$titles['Payment Type']] == $payment_method[1]) {
                $element[$titles['Amount']] = 0;
            }
            /* if (empty($element[$titles['Order number']]) || empty($element[$titles['Order Value']]) || empty($element[$titles['Amount']] ) || empty($element[$titles['Payment Type']]) ||
            empty($element[$titles['Products Description']]) || empty($element[$titles['Customer Name']]) || empty($element[$titles['Customer Email']]) ||
            empty($element[$titles['Customer Phone']]) || empty($element[$titles['Country']]) || empty($element[$titles['City']]) || empty($element[$titles['Address Area']])) {

            $orders['failed'] = $orders['failed'] + 1;

            $result = ['status' => 'fail', 'error' => $errors['empty_cells']];
            } */

            if ($result == []) {

                //country
                $country = DB::select('SELECT * from countries where name = ? AND status = ?', [$element[$titles['Country']], 1]);

                if ($country != [] && $country != null && isset($country[0])) {
                    //city
                    $city = DB::select('SELECT * from cities where name = ? AND country_id = ?', [$element[$titles['City']], $country[0]->id]);

                    if ($city == [] && $city == null && !isset($city[0])) {

                        $orders['failed'] = $orders['failed'] + 1;
                        $result = ['status' => 'fail', 'error' => $errors['city']];
                    }
                    //
                } else {
                    $orders['failed'] = $orders['failed'] + 1;
                    $result = ['status' => 'fail', 'error' => $errors['country']];
                }
                //

                //shipments
                $shipment = DB::select('SELECT * from shipments where shipper_id = ? AND order_number = ?', [$client, $element[$titles['Order number']]]);

                if ($shipment != [] && $shipment != null) {

                    $orders['failed'] = $orders['failed'] + 1;
                    $result = ['status' => 'fail', 'error' => $errors['dublicate']];
                }
                //

                //
            }
     
            // add to database and get id

            if ($result == []) {

                foreach ($table as $key => $value) {
                    if ($key == 'payment') {
                        $query[$key] = $payment_ids[$element[$value]];
                    } elseif ($key == 'customer_country') {
                        $query[$key] = $country[0]->id;
                    } elseif ($key == 'customer_city') {
                        $query[$key] = $city[0]->id;
                    } else {
                        $query[$key] = $element[$value];

                    }
                }

                $date = date('Y-m-d H:i:s', time());

                $query['shipper_id'] = Auth::user()->id;
                $query['shipment_upload_date'] = $date;
                $query['active'] = 0;
                $query['status'] = 0;

                $shipment_id = DB::table('shipments')->insertGetId($query);
                //

                // generate ksp
                $ksp_number = $this->generate_ksp($country[0]->id, $shipment_id);
                //

                // generate barcode
                $barcode_image_name = $this->generate_barcode($ksp_number);

                $this->upload_barcode($shipment_id, $ksp_number, $barcode_image_name);
                //
                $result = ['status' => 'success', 'message' => 'Order created successfully'];

                $orders['success'] = $orders['success'] + 1;

            }

            $spreadsheet1->getSheet(0)->setCellValue('A' . $result_file_counter, $element[$titles['Order number']]);
            $spreadsheet1->getSheet(0)->setCellValue('B' . $result_file_counter, $element[$titles['Country']]);
            $spreadsheet1->getSheet(0)->setCellValue('C' . $result_file_counter, $element[$titles['City']]);
            $spreadsheet1->getSheet(0)->setCellValue('D' . $result_file_counter, $element[$titles['Payment Type']]);

            if ($result['status'] == 'fail') {
                $spreadsheet1->getSheet(0)->setCellValue('E' . $result_file_counter, $result['error']);
                $spreadsheet1->getSheet(0)->setCellValue('F' . $result_file_counter, 'N/A');
                $spreadsheet1->getSheet(0)->setCellValue('G' . $result_file_counter, 'N/A');
            } else {
                $spreadsheet1->getSheet(0)->setCellValue('E' . $result_file_counter, $result['message']);
                $spreadsheet1->getSheet(0)->setCellValue('F' . $result_file_counter, $ksp_number);
                $spreadsheet1->getSheet(0)->setCellValue('G' . $result_file_counter, url('') . '/' . "track/shipment?kspNumber=" . $ksp_number);
            }
            $result_file_counter=$result_file_counter+1;
            $result = [];
        }

        $writer = new Xlsx($spreadsheet1);

        if (!file_exists(public_path('uploads/vendors/result_files'))) {
            mkdir(public_path('uploads/vendors/result_files'), 0777, true);
        }
        $result_file_Name = 'result_' . Auth::user()->shipper_id . '_' . time() . '.xlsx';

        $writer->save(public_path('uploads/vendors/result_files/' . $result_file_Name));

        //
        unset($reader);

        return ['status' => 'success', 'message' => '(' . $orders['success'] . ') Order Created Successfully , (' . $orders['failed'] . ') Order ERROR',
            'number_of_shipments' => $orders['success'] + $orders['failed'], 'result_file_name' => $result_file_Name, 'source_file_new_name' => $source_file_Name];

    }
    public function checking_order_already_exist($data)
    {

        $shipments_of_user = DB::select('SELECT * from shipments where shipper_id = ? AND order_number = ?', [Auth::user()->id , $data['order_number']]);

        return $shipments_of_user;
    }

    public function validate_vendor_with_shipment($ksp,$order_number)
    {
        $shipment=DB::select('SELECT * from shipments where ksp_number = ? AND order_number = ?', [$ksp , $order_number]);

        if ($shipment==[] || $shipment==null) {
            return [false];
        } else {
            return [true,$shipment];
        }

    }
    public function add_upload_file_history($shipper_id, $source_file_name, $source_file_new_name, $number_of_shipments, $message, $result_file_name, $status)
    {
        date_default_timezone_set('Africa/Cairo');
        $date = date('Y-m-d H:i:s', time());

        DB::insert('insert into vendors_files (shipper_id, source_file_name,source_file_new_name,number_of_shipments,message,result_file_name,file_uploaded_at,status) values (?,?, ?,?, ?,?,?,?)'
            , [$shipper_id, $source_file_name, $source_file_new_name, $number_of_shipments, $message, $result_file_name, $date, $status]);

    }
    public function add_shipment_file_history($user_id,$user_name, $source_file_name, $source_file_new_name, $number_of_shipments, $message, $result_file_name, $status,$system_name)
    {
        date_default_timezone_set('Africa/Cairo');
        $date = date('Y-m-d H:i:s', time());

        DB::insert('insert into awb_files (user_id,user_name, source_file_name,source_file_new_name,number_of_shipments,message,result_file_name,file_uploaded_at,status,system_name) values (?,?,?,?, ?,?, ?,?,?,?)'
            , [$user_id,$user_name, $source_file_name, $source_file_new_name, $number_of_shipments, $message, $result_file_name, $date, $status,$system_name]);

    }

    public function get_history_of_vendor_bulk_uploading($shipper_id, $page)
    {
        $shipments_per_page = 15;
        $offset = ($page - 1) * $shipments_per_page;

        $files = DB::select('SELECT * from vendors_files where shipper_id = ? order by file_uploaded_at DESC LIMIT ?, ?', [$shipper_id, $offset, $shipments_per_page]);

        $number_of_files = DB::select('SELECT COUNT(vendors_files_id) AS NumberOfFiles FROM vendors_files where shipper_id = ?', [$shipper_id]);

        return [$files, $number_of_files];
    }
    public function get_history_of_awb_bulk_uploading($user_id, $page,$system_name)
    {
        $shipments_per_page = 15;
        $offset = ($page - 1) * $shipments_per_page;

        $files = DB::select('SELECT * from awb_files where user_id = ? AND system_name = ? order by file_uploaded_at DESC LIMIT ?, ?', [$user_id,$system_name, $offset, $shipments_per_page]);

        $number_of_files = DB::select('SELECT COUNT(user_id) AS NumberOfFiles FROM awb_files where user_id = ? AND system_name = ?', [$user_id,$system_name]);

        return [$files, $number_of_files];
    }
    public function insert_user_url($user_url)
    {
        DB::update('update users set form_url = ? where id = ?', [$user_url, Auth::user()->id]);

        return $user_url;

    }
    /* public function get_user_url($client)
    {
    return DB::select('select form_url from shipments where shipper_id = ?', [$client]);
    } */

    public function add_claim($ksp_number, $claim, $shipper_id, $customer_email)
    {
        date_default_timezone_set('Africa/Cairo');
        $date = date('Y-m-d H:i:s', time());

        return DB::insert('INSERT  into claims (shipper_id,shipper_email,ksp_number,claim,created_at) values (?, ?, ?, ?, ?)', [$shipper_id, $customer_email, $ksp_number, $claim, $date]);

    }

}
