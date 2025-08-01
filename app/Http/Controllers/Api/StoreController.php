<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller; // ✅ This line is required
use Illuminate\Http\Request;
use App\Models\Store;
use App\Models\Warehouse;
use App\Models\Customer;
use App\Models\AcAccount;
class StoreController extends Controller
{

    public function index(Request $request)
    {
        $storeCode = $request->input('store_code'); // Get store_code from Postman

        if ($storeCode) {
            $store = Store::where('store_code', $storeCode)->get();

            if (!$store) {
                return response()->json([
                    'message' => 'Store Not Found',
                    'data' => [],
                    'status' => 0
                ], 200);
            }

            return response()->json([
                'message' => 'Store Details',
                'data' => $store,
                'status' => 1
            ], 200);
        }

        // If no store_code is passed, return all stores
        $stores = Store::all();
        $totalstores = $stores->count();

        if ($stores->isEmpty()) {
            return response()->json([
                'message' => 'No Stores Found',
                'data' => [],
                'status' => 0
            ], 200);
        }

        return response()->json([
            'message' => 'Store List',
            'data' => $stores,
            'totalstore'=> $totalstores,
            'status' => 1
        ], 200);
    }


    // Store a new store
    public function store(Request $request)
    {
         $request->validate([
        'store_code' => 'required|string',
        'slug' => 'required|string',
        'store_logo' => 'sometimes|file|image|max:2048'
        
      
    ]);
         $existingStore = Store::where('store_code', $request->store_code)
                          ->orWhere('slug', $request->slug)
                          ->first();

    if ($existingStore) {
        return response()->json([
            'status' => 0,
            'message' => 'Store already exists with given store code or slug.',
            'data' => $existingStore
        ], 409); // 409 Conflict
    }
        $file = $request->file('store_logo');
        $directory = 'storage/public/store/';
        $imageName = time() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path($directory), $imageName);

        $data = $request->all();
        $data['store_logo'] = $directory . $imageName;

      //  $store = Store::create($request->all());
        $store = store::create($data);

        if ($store) {
            $account = AcAccount::create($request->all());
        }

        return response()->json([
            'status' => 1,
            'message' => 'Store created successfully',
            'data' => $store
        ], 200);
    }

    // Update an existing Store
    public function update(Request $request, $id)
    {
        $store = Store::findOrFail($id);

        $store->update($request->all());

        return response()->json([
            'status' => 1,
            'message' => 'Store Details updated successfully',
            'data' => $store
        ]);
    }

    // View a single Store
    public function show($id)
    {
        $store = Store::findOrFail($id);
        return response()->json($store);
    }
    public function destroy($id)
    {
        $store = Store::findOrFail($id);
        $store->delete();
        return response()->json(['message' => 'Store deleted']);
    }


    public function single_show(Request $request)
    {
        $storeid = $request->query('store_code');
        //  $userid = $request->query('user_id');

        $store = Store::where('store_code', $storeid)
            // ->where('user_id', $userid)
            ->get();

        if ($store->isNotEmpty()) {
            return response()->json([
                'message' => 'Store Detail',
                'data' => $store,
                'status' => 1
            ], 200);
        }

        return response()->json([
            'message' => 'Store Detail Not Found',
            'data' => [],
            'status' => 0
        ], 404);
    }

}