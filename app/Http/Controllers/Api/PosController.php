<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AccountSettings;
use App\Models\Brand;
use App\Models\Category;
use App\Models\settings;
use App\Models\countrysettings;
use App\Models\Customer;
use App\Models\Item;
use App\Models\Store;
use App\Models\Tax;
use App\Models\Units;
use App\Models\Warehouse;

class PosController extends Controller
{
    public function index(Request $request)
    {
        $warehouses = Warehouse::where('status', '1')->get();
        $stores = Store::where('status', '1')->get();
        $units = Units::where('status', '1')->get();
        $customers = Customer::all();
        $categories = Category::where('status', '1')->get();
        $countries = countrysettings::all();
        $brands = Brand::where('status', '1')->get();
        $logo = settings::all();
        $taxes = Tax::where('status', '1')->get();
        $item = Item::find($request->input('id'));
        $accounts = AccountSettings::all();

        return response()->json([
            'status' => true,
            'message' => 'POS data fetched successfully',
            'data' => [
                'customers' => $customers,
                'stores' => $stores,
                'warehouses' => $warehouses,
                'taxes' => $taxes,
                'units' => $units,
                'accounts' => $accounts,
                'brands' => $brands,
                'categories' => $categories,
                'item' => $item,
                'countries' => $countries,
                'logo' => $logo,
            ]
        ]);
    }
}