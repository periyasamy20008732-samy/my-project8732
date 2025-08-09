<?php

namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Store;
use App\Models\Warehouse;
use App\Models\Category;
use App\Models\Brand;
use App\Models\SubCategory;
use App\Models\Tax;
use App\Models\Units;
use Illuminate\Support\Facades\Log;


use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Validator;

class ItemController extends Controller
{

    public function create(Request $request)
    {
        $item = Item::all();
        $stores = Store::all();
        $warehouses = Warehouse::all();
        $categories = Category::all();
        $brands = Brand::all();
        //  $subCategories = SubCategory::all();
        $taxes = Tax::all();
        $units = Units::all();
        return view('store.add-item', compact(
            'item',
            'stores',
            'warehouses',
            'categories',
            'brands',
            'taxes',
            'units'
        ));
    }
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Item::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('status', function ($row) {
                    return $row->status == 1
                        ? '<span class="badge badge-linesuccess">Active</span>'
                        : '<span class="badge badge-linedanger">Inactive</span>';
                })
                ->addColumn('action', function ($row) {
                    return '
                  
                  <div class="action-table-data">
                  <div class="edit-delete-action">
                  <a class="me-2 p-2  view-btn" data-id="' . $row->id . '" ><i data-feather="eye" class="text-secondary" style="width: 18px; height: 18px;"></i></i></a> 
                  <a class="me-2 p-2  edit-btn" data-id="' . $row->id . '"  ><i data-feather="edit" class="text-info" style="width: 18px; height: 18px;"></i></a> 

                  <form id="delete-form-' . $row->id . '" action="' . route('store.items.destroy', $row->id) . '" method="POST" style="display:inline;">
                  ' . csrf_field() . method_field('DELETE') . '
                  <a class="confirm-text p-2  delete-btn" data-id="' . $row->id . '"  ><i data-feather="trash-2"  class="text-danger" style="width: 18px; height: 18px;"></i></a> 
                  </form>
                  
                </div>
                </div>';
                })
                ->rawColumns(['status', 'action'])
                ->make(true);
        }
        $item = Item::all();
        return view('store.item', compact('item'));
    }

    /**
     * Store a new customer.
     */
    /*  public function store(Request $request)
    {
        $validator = Validator::make(

            $request->all(),
            [
                'item_name' => 'required|string|max:255',
                'store_id' => 'required|string|max:255',
                'category_id' => 'required|string|max:255',
                'brand_id' => 'required|string|max:255',
                'SKU' => 'required|string|max:255',
                'HSN_code' => 'required|string|max:255',
                'Item_code' => 'required|string|max:255',
                'Barcode' => 'required|string|max:255',
                'Unit' => 'required|string|max:255',
                'Purchase_price' => 'required|string|max:255',
                'Tax_type' => 'required|string|max:255',
                'Tax_rate' => 'required|string|max:255',
                'Sales_Price' => 'required|string|max:255',
                'Discount_type' => 'required|string|max:255',
                'Discount' => 'required|string|max:255',
                'MRP' => 'required|string|max:255',
                'Profit_margin' => 'required|string|max:255',
                'Warehouse' => 'required|string|max:255',
                'Opening_Stock' => 'required|string|max:255',
                'quantity' => 'required|string|max:255',
                'Alert_Quantity' => 'required|string|max:255',
                'Description' => 'required|string|max:255',
                'images.*' => 'image|mimes:jpeg,png,jpg,gif'
            ]
        );
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = $request->only([
            'item_name',
            'store_id',
            'category_id',
            'brand_id',
            'SKU',
            'HSN_code',
            'Item_code',
            'Barcode',
            'Unit',
            'Purchase_price',
            'Tax_type',
            'Tax_rate',
            'Sales_Price',
            'Discount_type',
            'Discount',
            'MRP',
            'Profit_margin',
            'Warehouse',
            'Opening_Stock',
            'quantity',
            'Description',
            'Alert_Quantity',
        ]);



        if ($request->hasFile('images')) {
            $images = $request->file('images');
            $imagePaths = [];

            foreach ($images as $image) {
                $filename = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                $path = $image->storeAs('uploads', $filename, 'public');
                $imagePaths[] = 'storage/' . $path;
            }

            // Save as JSON
            $data['item_image'] = json_encode($imagePaths);
        }

        dd([
            'has_images' => $request->hasFile('images'),
            'images' => $request->file('images'),
            'all_input' => $request->all()
        ]);
        $item = Item::create($data);

        return redirect()->route('store.items.index')->with('success', 'Item created successfully.');
    } */

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'item_name' => 'required|string|max:255',
            'store_id' => 'required|string|max:255',
            'category_id' => 'required|string|max:255',
            'brand_id' => 'required|string|max:255',
            'SKU' => 'required|string|max:255',
            'HSN_code' => 'required|string|max:255',
            'Item_code' => 'required|string|max:255',
            'Barcode' => 'required|string|max:255',
            'Unit' => 'required|string|max:255',
            'Purchase_price' => 'required|string|max:255',
            'Tax_type' => 'required|string|max:255',
            'Tax_rate' => 'required|string|max:255',
            'Sales_Price' => 'required|string|max:255',
            'Discount_type' => 'required|string|max:255',
            'Discount' => 'required|string|max:255',
            'MRP' => 'required|string|max:255',
            'Profit_margin' => 'required|string|max:255',
            'Warehouse' => 'required|string|max:255',
            'Opening_Stock' => 'required|string|max:255',
            'quantity' => 'required|string|max:255',
            'Alert_Quantity' => 'required|string|max:255',
            'Description' => 'required|string|max:255',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif'
            //'images.*' => 'sometimes|file|image|nullable',

        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = $request->only([
            'item_name',
            'store_id',
            'category_id',
            'brand_id',
            'SKU',
            'HSN_code',
            'Item_code',
            'Barcode',
            'Unit',
            'Purchase_price',
            'Tax_type',
            'Tax_rate',
            'Sales_Price',
            'Discount_type',
            'Discount',
            'MRP',
            'Profit_margin',
            'Warehouse',
            'Opening_Stock',
            'quantity',
            'Description',
            'Alert_Quantity',
        ]);

        // Handle image upload
        if ($request->hasFile('images')) {
            $images = $request->file('images');
            $imagePaths = [];

            foreach ($images as $image) {
                $filename = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                $path = $image->storeAs('uploads', $filename, 'public');
                $imagePaths[] = 'storage/' . $path;
            }

            $data['item_image'] = json_encode($imagePaths);
        }

        Item::create($data);

        return redirect()->route('store.items.index')->with('success', 'Item created successfully.');
    }


    /**
     * Get item info for edit modal via AJAX.
     */
    public function show($id)
    {
        $item = Item::findOrFail($id);
        return response()->json($item);
    }

    /**
     * Update item details.
     */

    public function update(Request $request, $id)
    {
        $item = Item::findOrFail($id);

        $validatedData = $request->validate([
            'customer_name' => 'required|string|max:255',
            'email' => 'string|max:255',
            'country_id' => 'required|string|max:255',
            'mobile' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'postcode' => 'required|string|max:255',
            'attachment_2' => 'sometimes|file|image|nullable',
        ]);

        // Handle image upload if present
        if ($request->hasFile('attachment_2')) {
            $file = $request->file('attachment_2');
            $directory = 'storage/item/';
            $imageName = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path($directory), $imageName);
            $validatedData['attachment_2'] = $directory . $imageName;
        }

        $item->fill($validatedData)->save();

        return redirect()->route('store.items.index')->with('success', 'Item updated successfully.');
    }


    /**
     * Delete customer.
     */
    public function destroy($id)
    {
        Item::destroy($id);
        return redirect()->back()->with('success', 'Item deleted successfully.');
    }

    public function add_category(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'category_name' => 'required|string|max:255',
                'slug' => 'required|string',
                'description' => 'string',
            ]
        );

        $data = $request->all();
        $data['status'] = $request->input('status', 1);
        $category = Category::create($data);
        return redirect()->route('store.items.create')->with('success', 'Category created successfully.');
    }

    public function add_brand(Request $request)
    {

        $validator = Validator::make(

            $request->all(),
            [
                'brand_name' => 'required|string|max:255|unique:brands,brand_name',
                'status' => 'required|numeric',
                'brand_image' => 'sometimes|file|image|nullable',

            ]
        );
        $data = $request->all();
        $brand = Brand::create($data);
        return redirect()->route('store.items.create')->with('success', 'Brand created successfully.');
    }
    public function add_unit(Request $request)
    {

        $validator = Validator::make(

            $request->all(),
            [
                'unit_name' => 'required',
                'unit_value' => 'required|string',
                'description' => 'string',
            ]
        );
        $data = $request->all();
        $brand = Brand::create($data);
        return redirect()->route('store.items.create')->with('success', 'Unit created successfully.');
    }




    public function getwarehouse(Request $request)
    {
        $store_id = $request->store_id;

        if ($store_id) {
            $warehouses = Warehouse::where('store_id', $store_id)->get(['id', 'warehouse_name']);
        } else {
            $warehouses = Warehouse::all(['id', 'warehouse_name']);
        }

        return response()->json($warehouses);
    }
}
