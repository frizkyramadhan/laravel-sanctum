<?php

namespace App\Http\Controllers\Api\V1;

use SimpleXMLElement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class InventoryController extends Controller
{
    public function qrcodeJson($id)
    {
        $inventory = DB::connection('mysql_araim.v2')
            ->table('inventories')
            ->leftJoin('employees', 'inventories.employee_id', '=', 'employees.id')
            ->leftJoin('assets', 'inventories.asset_id', '=', 'assets.id')
            ->leftJoin('categories', 'assets.category_id', '=', 'categories.id')
            ->leftJoin('brands', 'inventories.brand_id', '=', 'brands.id')
            ->leftJoin('projects', 'inventories.project_id', '=', 'projects.id')
            ->leftJoin('departments', 'inventories.department_id', '=', 'departments.id')
            ->leftJoin('locations', 'inventories.location_id', '=', 'locations.id')
            ->select('inventories.*', 'employees.nik', 'employees.fullname', 'assets.asset_name', 'brands.brand_name', 'projects.project_code', 'projects.project_name', 'departments.dept_name', 'locations.location_name', 'categories.category_name')
            ->where('inventories.id', $id)
            ->first();

        // dd($inventory->first());

        $xml = new SimpleXMLElement('<inventory/>');
        $item = $xml->addChild('item');
        $item->addChild('inventory_no', $inventory->inventory_no);
        $item->addChild('asset_name', $inventory->asset_name);
        $item->addChild('category_name', $inventory->category_name);
        $item->addChild('location_name', $inventory->location_name);
        $item->addChild('person_in_charge', $inventory->fullname);

        // return response()->json($inventory);
        return response($xml->asXML(), 200)
            ->header('Content-Type', 'application/xml');
    }
}
