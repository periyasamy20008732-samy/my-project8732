<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Purchase;
use App\Models\PurchaseItem;
use App\Models\Sales;
use App\Models\SalesItem;

class ReportController extends Controller
{
    public function time_index(Request $request)
    {
        $request->validate([
            'from_date' => 'required|date',
            'to_date' => 'required|date',
        ]);

        $from = $request->from_date;
        $to = $request->to_date;

        $data = Purchase::with(['store', 'supplier'])
            ->whereBetween('purchase_date', [$from, $to])
            ->get();

        if ($data->isEmpty()) {
            return response()->json([
                'message' => 'Detail Not Found',
                'data' => [],
                'status' => 0
            ]);
        }

        // Optional: Clean response format (just name instead of full model)
        $transformed = $data->map(function ($item) {
            return [
                'id' => $item->id,
                'store_id' => $item->store_id,
                'store_name' => optional($item->store)->store_name,
                'supplier_id' => $item->supplier_id,
                'supplier_name' => optional($item->supplier)->supplier_name,
                'purchase_code' => $item->purchase_code,
                'reference_no' => $item->reference_no,
                'grand_total' => $item->grand_total,
                'paid_amount' => $item->paid_amount,
                'balance' => $item->grand_total - $item->paid_amount,
                'purchase_date' => $item->purchase_date,
                // add other fields as needed...
            ];
        });

        return response()->json([
            'message' => 'Report fetched successfully',
            'data' => $transformed,
            'status' => 1
        ]);
    }

    public function supplier_index(Request $request)
    {
        $request->validate([
            'store_id' => 'required',
            'supplier_id' => 'required'
            //  'to_date' => 'required|after_or_equal:from_date',   
        ]);

        $supplier_id = $request->supplier_id;
        // $to = $request->to_date;

        //  $data = Purchase::where('supplier_id', $supplier_id)->get();
        $data = Purchase::with(['store', 'supplier'])
            ->whereRaw("STR_TO_DATE(purchase_date, '%d/%m/%Y') BETWEEN ? AND ?", [
                $request->from_date,
                $request->to_date
            ]);

        if ($data->isEmpty()) {

            return response()->json([
                'message' => 'Detail Not Found',
                'data' => [],
                'status' => 0
            ], 204);
        } else {


            // Optional: Clean response format (just name instead of full model)
            $transformed = $data->map(function ($item) {
                return [
                    'id' => $item->id,
                    'store_id' => $item->store_id,
                    'store_name' => optional($item->store)->store_name,
                    'supplier_id' => $item->supplier_id,
                    'supplier_name' => optional($item->supplier)->supplier_name,
                    'purchase_code' => $item->purchase_code,
                    'reference_no' => $item->reference_no,
                    'grand_total' => $item->grand_total,
                    'paid_amount' => $item->paid_amount,
                    'balance' => $item->grand_total - $item->paid_amount,
                    'purchase_date' => $item->purchase_date,
                    // add other fields as needed...
                ];
            });
            return response()->json([
                'message' => 'Report fetched successfully',
                'data' => $transformed,
            ]);
        }
    }


    /*   public function purchase_report(Request $request)
      {
          $request->validate([
              'from_date' => 'required|date',
              'to_date' => 'required|date',
              'store_id' => 'required|integer',
              'supplier_id' => 'required|integer',
          ]);

          $query = Purchase::with(['store', 'supplier'])
              ->whereRaw("STR_TO_DATE(purchase_date, '%d/%m/%Y') BETWEEN ? AND ?", [
                  $request->from_date,
                  $request->to_date
              ]);

          if ($request->store_id) {
              $query->where('store_id', $request->store_id);
          }

          if ($request->supplier_id) {
              $query->where('supplier_id', $request->supplier_id);
          }

          $results = $query->get();

          if ($results->isEmpty()) {
              return response()->json([
                  'message' => 'No matching purchase records found.',
                  'data' => [],
                  'status' => 0
              ], 200);
          } */
    /*  $transformed = $query->map(function ($item) {
          return [
              'id' => $item->id,
              'store_id' => $item->store_id,
              'store_name' => optional($item->store)->store_name,
              'supplier_id' => $item->supplier_id,
              'supplier_name' => optional($item->supplier)->supplier_name,
              'purchase_code' => $item->purchase_code,
              'reference_no' => $item->reference_no,
              'grand_total' => $item->grand_total,
              'paid_amount' => $item->paid_amount,
              'balance' => $item->grand_total - $item->paid_amount,
              'purchase_date' => $item->purchase_date,
              // add other fields as needed...
          ];
      });
    return response()->json([
        'message' => 'Purchase report data',
        'data' => $results,
    ]);
}*/


    public function purchase_report(Request $request)
    {
        $request->validate([
            'from_date' => 'required|date',
            'to_date' => 'required|date',
            'store_id' => 'required|integer',
            'supplier_id' => 'required|integer',
        ]);

        try {
            // Use Carbon to parse safely
            $fromDate = Carbon::parse($request->from_date)->format('Y-m-d');
            $toDate = Carbon::parse($request->to_date)->format('Y-m-d');
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Invalid date format.',
                'error' => $e->getMessage(),
                'status' => 0
            ], 400);
        }

        $results = Purchase::with(['store', 'supplier'])
            ->whereBetween('purchase_date', [$fromDate, $toDate])
            ->where('store_id', $request->store_id)
            ->where('supplier_id', $request->supplier_id)
            ->get();

        if ($results->isEmpty()) {
            return response()->json([
                'message' => 'No matching purchase records found.',
                'data' => [],
                'status' => 0
            ], 200);
        }

        $transformed = $results->map(function ($item) {
            return [
                'id' => $item->id,
                'store_id' => $item->store_id,
                'store_name' => optional($item->store)->store_name,
                'supplier_id' => $item->supplier_id,
                'supplier_name' => optional($item->supplier)->supplier_name,
                'purchase_code' => $item->purchase_code,
                'reference_no' => $item->reference_no,
                'grand_total' => $item->grand_total,
                'paid_amount' => $item->paid_amount,
                'balance' => $item->grand_total - $item->paid_amount,
                'purchase_date' => $item->purchase_date,
                // add other fields as needed...
            ];
        });

        return response()->json([
            'message' => 'Purchase report generated successfully.',
            'data' => $transformed,
            'status' => 1
        ], 200);
    }

    public function sale_report(Request $request)
    {
        $request->validate([
            'from_date' => 'required|date',
            'to_date' => 'required|date|after_or_equal:from_date',
            'store_id' => 'required|integer',
            'customer_id' => 'required|integer',
        ]);

        $query = Sales::with(['store', 'customer']);

        $request->from_date;
        $request->to_date;


        if ($request->store_id) {
            $query->where('store_id', $request->store_id);
        }

        if ($request->customer_id) {
            $query->where('customer_id', $request->customer_id);
        }

        $results = $query->get();

        if ($results->isEmpty()) {
            return response()->json([
                'message' => 'No matching sales records found.',
                'data' => [],
                'status' => 0
            ], 200);
        }

        $transformed = $results->map(function ($item) {
            return [
                'id' => $item->id,
                'store_id' => $item->store_id,
                'store_name' => optional($item->store)->store_name,
                'customer_id' => $item->customer_id,
                'customer_name' => optional($item->customer)->customer_name,
                'sales_code' => $item->sales_code,
                'reference_no' => $item->reference_no,
                'grand_total' => $item->grand_total,
                'paid_amount' => $item->paid_amount,
                'balance' => $item->grand_total - $item->paid_amount,
                'sales_date' => $item->sales_date,
                // add other fields as needed...
            ];
        });


        return response()->json([
            'message' => 'sales report data',
            'data' => $transformed,
        ]);
    }

    public function sale_index(Request $request)
    {
        $request->validate([
            'from_date' => 'required|date',
            'to_date' => 'required|date',
        ]);

        $from = $request->from_date;
        $to = $request->to_date;

        $data = Sales::with(['store', 'customer'])
            ->whereBetween('created_at', [$from, $to])
            ->get();

        if ($data->isEmpty()) {
            return response()->json([
                'message' => 'Detail Not Found',
                'data' => [],
                'status' => 0
            ]);
        }

        // Optional: Clean response format (just name instead of full model)
        $transformed = $data->map(function ($item) {
            return [
                'id' => $item->id,
                'store_id' => $item->store_id,
                'store_name' => optional($item->store)->store_name,
                'customer_id' => $item->customer_id,
                'customer_name' => optional($item->customer)->customer_name,
                'sales_code' => $item->sales_code,
                'reference_no' => $item->reference_no,
                'grand_total' => $item->grand_total,
                'paid_amount' => $item->paid_amount,
                'balance' => $item->grand_total - $item->paid_amount,
                'sales_date' => $item->sales_date,
                // add other fields as needed...
            ];
        });

        return response()->json([
            'message' => 'Report fetched successfully',
            'data' => $transformed,
            'status' => 1
        ]);
    }

    public function sale_item(Request $request)
    {
        $request->validate([
            'from_date' => 'required|date',
            'to_date' => 'required|date|after_or_equal:from_date',
            'store_id' => 'required|integer',
            'item_id' => 'required|integer',
        ]);

        $query = SalesItem::with(['store', 'item']);

        $request->from_date;
        $request->to_date;


        if ($request->store_id) {
            $query->where('store_id', $request->store_id);
        }

        if ($request->item_id) {
            $query->where('item_id', $request->item_id);
        }

        $results = $query->get();

        if ($results->isEmpty()) {
            return response()->json([
                'message' => 'No matching sales records found.',
                'data' => [],
                'status' => 0
            ], 200);
        }

        $transformed = $results->map(function ($item) {
            // GST  String to decimal converstion
            $gstString = $item->tax_type;
            preg_match('/(\d+(\.\d+)?)/', $gstString, $matches);
            $gstValue = $matches[0]; // "18"
            $gstDecimal = $gstValue / 100; // 0.18

            // intentify N value
            $mul = $item->price_per_unit * $item->sales_qty; //single_price * Qty

            //calculte GST {N+(N*GST)/100}
            $N = ($mul * $gstDecimal); //N*GST
            $gst = $mul + $N;  // {N+(N*GST)/100}

            //total amount
            $total = $gst - $item->discount_amt;
            return [
                'id' => $item->id,
                'store_name' => optional($item->store)->store_name,
                'item_name' => optional($item->item)->item_name,
                'sales_id' => $item->sales_id,
                'price_per_unit' => $item->price_per_unit,
                'sales_qty' => $item->sales_qty,
                'discount_amt' => $item->discount_amt,
                'total' => $total,
                'sales_date' => $item->created_at,
                //  'item_id' => $item->item_id,
                //  'store_id' => $item->store_id,
                // 'reference_no' => $item->reference_no,
                // 'grand_total' => $item->grand_total,
                //'gst' => $gst,
                // add other fields as needed...

            ];
        });


        return response()->json([
            'message' => 'sales report data',
            'data' => $transformed,
        ]);
    }


}