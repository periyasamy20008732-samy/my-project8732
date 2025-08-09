<?php

namespace App\Http\Controllers\api;

use Exception;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Log;
use App\Models\Purchase;
use App\Models\PurchaseItem;
use App\Models\Sales;
use App\Models\SalesItem;

class storeReportController extends Controller
{
    /**
     * Get store IDs for current user
     */
    private function getUserStoreIds(Request $request)
    {
        $user = auth()->user();
        $storeId =$request->input('store_id');

        if ($storeId) {
            return [trim($storeId)];
        }

        if (!empty($user->store_id) && $user->store_id !== '0') {
            return [trim($user->store_id)];
        }

        return DB::table('store')
            ->where('user_id', $user->id)
            ->pluck('id')
            ->map(fn($id) => (string)$id)
            ->toArray();
    }

    public function purchase_report(Request $request)
    {
        try {
            $request->validate([
                'from_date' => 'required|date',
                'to_date'   => 'required|date',
                'supplier_id' => 'nullable|integer',
            ]);

            $storeIds = $this->getUserStoreIds($request);
            if (empty($storeIds)) {
                return $this->noStoreResponse();
            }

            $from = Carbon::parse($request->from_date)->startOfDay();
            $to   = Carbon::parse($request->to_date)->endOfDay();

            $query = Purchase::with(['store', 'supplier'])
                ->whereIn('store_id', $storeIds)
                ->whereBetween('purchase_date', [$from, $to]);

            if ($request->filled('supplier_id')) {
                $query->where('supplier_id', $request->supplier_id);
            }

            $results = $query->get();

            return $this->formatPurchaseResponse($results);
        } catch (Exception $e) {
            Log::error("Purchase report error: " . $e->getMessage(), ['trace' => $e->getTraceAsString()]);
            return $this->errorResponse($e);
        }
    }

    public function sales_report(Request $request)
    {
        try {

            $request->validate([
                'from_date' => 'required|date',
                'to_date'   => 'required|date',
                'customer_id' => 'nullable|integer',
            ]);

            $storeIds = $this->getUserStoreIds($request);
            if (empty($storeIds)) {
                return $this->noStoreResponse();
            }

            $from = Carbon::parse($request->from_date)->startOfDay();
            $to   = Carbon::parse($request->to_date)->endOfDay();

            $query = Sales::with(['store', 'customer'])
                ->whereIn('store_id', $storeIds)
                ->whereBetween('sales_date', [$from, $to]);

            if ($request->filled('customer_id')) {
                $query->where('customer_id', $request->customer_id);
            }

            $results = $query->get();

            return $this->formatSalesResponse($results);
        } catch (Exception $e) {
            Log::error("Sales report error: " . $e->getMessage(), ['trace' => $e->getTraceAsString()]);
            return $this->errorResponse($e);
        }
    }

    public function purchase_item_report(Request $request)
    {
        try {
            $request->validate([
                'from_date' => 'required|date',
                'to_date'   => 'required|date',
                'item_id'   => 'nullable|integer',
            ]);

            $storeIds = $this->getUserStoreIds($request);
            if (empty($storeIds)) {
                return $this->noStoreResponse();
            }

            $from = Carbon::parse($request->from_date)->startOfDay();
            $to   = Carbon::parse($request->to_date)->endOfDay();

            $query = PurchaseItem::with(['store', 'item'])
                ->whereIn('store_id', $storeIds)
                ->whereBetween('created_at', [$from, $to]);

            if ($request->filled('item_id')) {
                $query->where('item_id', $request->item_id);
            }

            $results = $query->get();

            return $this->formatPurchaseItemResponse($results);
        } catch (Exception $e) {
            Log::error("Purchase item report error: " . $e->getMessage(), ['trace' => $e->getTraceAsString()]);
            return $this->errorResponse($e);
        }
    }

    public function sales_item_report(Request $request)
    {
        try {
            $request->validate([
                'from_date' => 'required|date',
                'to_date'   => 'required|date',
                'item_id'   => 'nullable|integer',
            ]);

            $storeIds = $this->getUserStoreIds($request);
            if (empty($storeIds)) {
                return $this->noStoreResponse();
            }

            $from = Carbon::parse($request->from_date)->startOfDay();
            $to   = Carbon::parse($request->to_date)->endOfDay();

            $query = SalesItem::with(['store', 'item'])
                ->whereIn('store_id', $storeIds)
                ->whereBetween('created_at', [$from, $to]);

            if ($request->filled('item_id')) {
                $query->where('item_id', $request->item_id);
            }

            $results = $query->get();

            return $this->formatSalesItemResponse($results);
        } catch (Exception $e) {
            Log::error("Sales item report error: " . $e->getMessage(), ['trace' => $e->getTraceAsString()]);
            return $this->errorResponse($e);
        }
    }

    private function noStoreResponse()
    {
        return response()->json([
            'message' => 'No stores found for this user',
            'data'    => [],
            'status'  => 0
        ]);
    }

    private function errorResponse(Exception $e)
    {
        return response()->json([
            'message' => 'An error occurred while processing your request.',
            'error'   => $e->getMessage(),
            'status'  => 0
        ], 500);
    }

    /**
     * Formatters for each type
     */
    private function formatPurchaseResponse($results)
    {
        if ($results->isEmpty()) {
            return $this->emptyResponse();
        }

        $data = $results->map(fn($item) => [
            'id' => $item->id,
            'store_id' => $item->store_id,
            'store_name' => optional($item->store)->store_name,
            'supplier_id' => $item->supplier_id,
            'supplier_name' => optional($item->supplier)->supplier_name,
            'purchase_code' => $item->purchase_code,
            'grand_total' => $item->grand_total,
            'paid_amount' => $item->paid_amount,
            'balance' => $item->grand_total - $item->paid_amount,
            'purchase_date' => $item->purchase_date,
        ]);

        return response()->json([
            'message' => 'Purchase report fetched successfully',
            'data'    => $data,
            'status'  => 1
        ]);
    }

    private function formatSalesResponse($results)
    {
        if ($results->isEmpty()) {
            return $this->emptyResponse();
        }

        $data = $results->map(fn($item) => [
            'id' => $item->id,
            'store_id' => $item->store_id,
            'store_name' => optional($item->store)->store_name,
            'customer_id' => $item->customer_id,
            'customer_name' => optional($item->customer)->customer_name,
            'sales_code' => $item->sales_code,
            'grand_total' => $item->grand_total,
            'paid_amount' => $item->paid_amount,
            'balance' => $item->grand_total - $item->paid_amount,
            'sales_date' => $item->sales_date,
        ]);

        return response()->json([
            'message' => 'Sales report fetched successfully',
            'data'    => $data,
            'status'  => 1
        ]);
    }

    private function formatPurchaseItemResponse($results)
    {
        if ($results->isEmpty()) {
            return $this->emptyResponse();
        }

        $data = $results->map(fn($item) => [
            'id' => $item->id,
            'store_name' => optional($item->store)->store_name,
            'item_name' => optional($item->item)->item_name,
            'purchase_qty' => $item->purchase_qty,
            'price_per_unit' => $item->price_per_unit,
            'discount_amt' => $item->discount_amt,
            'total' => $item->total_cost,
            'purchase_date' => $item->created_at,
        ]);

        return response()->json([
            'message' => 'Purchase item report fetched successfully',
            'data'    => $data,
            'status'  => 1
        ]);
    }

    private function formatSalesItemResponse($results)
    {
        if ($results->isEmpty()) {
            return $this->emptyResponse();
        }

        $data = $results->map(fn($item) => [
            'id' => $item->id,
            'store_name' => optional($item->store)->store_name,
            'item_name' => optional($item->item)->item_name,
            'sales_qty' => $item->sales_qty,
            'price_per_unit' => $item->price_per_unit,
            'discount_amt' => $item->discount_amt,
            'total' => $item->total_cost,
            'sales_date' => $item->created_at,
        ]);

        return response()->json([
            'message' => 'Sales item report fetched successfully',
            'data'    => $data,
            'status'  => 1
        ]);
    }

    private function emptyResponse()
    {
        return response()->json([
            'message' => 'No records found.',
            'data'    => [],
            'status'  => 0
        ]);
    }
}
