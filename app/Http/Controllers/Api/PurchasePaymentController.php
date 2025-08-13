<?php




namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PurchasePayment;

class PurchasePaymentController extends Controller
{

    // View all Purchase Payment
    public function index()
    {
        $purchasepayment = PurchasePayment::all();
        //$result= User::find($id);return response()->json($packages);

        if ($purchasepayment->isEmpty()) {

            return response()->json([
                'message' => 'Purchase Payment Details Not Found',
                'data' => [],
                'status' => 0
            ], 200);
        } else {

            return response()->json([
                'message' => 'Purchase Payment List',
                'data' => $purchasepayment,
                'status' => 1
            ], 200);
        }
    }
    public function store(Request $request)
    {
        $purchasepayment = PurchasePayment::create($request->all());
        return response()->json([
            'status' => 1,
            'message' => 'Purchase Payment Details Created',
            'data' => $purchasepayment
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $purchasepayment = PurchasePayment::findOrFail($id);

        $purchasepayment->update($request->all());

        return response()->json([
            'status' => '1',
            'message' => 'Purchase Payment Details updated successfully',
            'data' => $purchasepayment
        ]);
    }
}
