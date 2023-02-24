<?php

namespace App\Http\Controllers\Api\V1;

use SimpleXMLElement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class InventoryController extends Controller
{
    public function qrcode($id)
    {
        $inventory = Http::get('http://127.0.0.1:8000/api/inventories/qrcode_json/' . $id)['data'];

        $xml = new SimpleXMLElement('<inventory/>');
        $item = $xml->addChild('item');
        $item->addChild('inventory_no', $inventory['inventory_no']);
        $item->addChild('asset', $inventory['asset_name']);
        $item->addChild('category', $inventory['category_name']);
        $item->addChild('brand', $inventory['brand_name']);
        $item->addChild('model', $inventory['model_asset']);
        $item->addChild('sn', $inventory['serial_no']);
        $item->addChild('pn', $inventory['part_no']);
        $item->addChild('qty', $inventory['quantity']);
        $item->addChild('inventory_status', $inventory['inventory_status']);
        $item->addChild('transfer_status', $inventory['transfer_status']);
        $item->addChild('project_code', $inventory['project_code']);
        $item->addChild('project_name', $inventory['project_name']);
        $item->addChild('department', $inventory['dept_name']);
        $item->addChild('location_name', $inventory['location_name']);
        $item->addChild('pic', $inventory['fullname']);
        $item->addChild('nik', $inventory['nik']);
        $item->addChild('input_date', date('d-M-Y', strtotime($inventory['input_date'])));
        return response($xml->asXML(), 200)
            ->header('Content-Type', 'application/xml');
    }
}
