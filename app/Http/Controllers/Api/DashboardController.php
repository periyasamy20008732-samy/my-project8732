<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Sales;
use App\Models\Customer;
use App\Models\Order;
use App\Models\User;
use App\Models\Item;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\Store;
use App\Models\Units;
use App\Models\Warehouse;



class DashboardController extends Controller
{
    // public function getDashboard()
    // {
    //     try {
    //         $user = auth()->user();

    //         // Date ranges
    //         $currentStart = Carbon::now()->subDays(6)->startOfDay();
    //         $previousStart = Carbon::now()->subDays(13)->startOfDay();
    //         $previousEnd = Carbon::now()->subDays(7)->endOfDay();

    //         // Base query
    //         $salesQuery = Sales::query();
    //         if (!in_array($user->user_level, [1, 4])) {
    //             $salesQuery->where('created_by', $user->id);
    //         }

    //         // Current Period Totals 
    //         $query = DB::table('sales');

    //         if (in_array($user->user_level, [1, 4])) {
    //             // admin sees all sales
    //         } else {
    //             $query->where('user_id', $user->id);
    //         }

    //         // If you're using date range:
    //         $query->whereBetween('created_at', [
    //             now()->startOfMonth(),
    //             now()->endOfMonth()
    //         ]);

    //         $currentSales = $query->sum('grand_total');
    //         $currentDue = (clone $salesQuery)
    //             ->whereBetween('created_at', [$currentStart, now()])
    //             ->sum('customer_total_due');

    //         $currentItems = Item::when(!in_array($user->user_level, [1, 4]), function ($q) use ($user) {
    //             $q->whereIn('id', function ($sub) use ($user) {
    //                 $sub->select('product_id')
    //                     ->from('order_items')
    //                     ->whereIn('order_id', Order::where('user_id', $user->id)->pluck('id'));
    //             });
    //         })->count();

    //         $currentCustomers = Customer::when(!in_array($user->user_level, [1, 4]), function ($q) use ($user) {
    //             $q->where('created_by', $user->id);
    //         })->count();

    //         // Previous Period Totals 
    //         $previousSales = (clone $salesQuery)
    //             ->whereBetween('created_at', [$previousStart, $previousEnd])
    //             ->sum('grand_total');

    //         $previousDue = (clone $salesQuery)
    //             ->whereBetween('created_at', [$previousStart, $previousEnd])
    //             ->sum('customer_total_due');

    //         $previousItems = Item::when(!in_array($user->user_level, [1, 4]), function ($q) use ($user) {
    //             $q->whereIn('id', function ($sub) use ($user) {
    //                 $sub->select('product_id')
    //                     ->from('order_items')
    //                     ->whereIn('order_id', Order::where('user_id', $user->id)->pluck('id'));
    //             });
    //         })
    //             ->whereBetween('created_at', [$previousStart, $previousEnd])
    //             ->count();

    //         $previousCustomers = Customer::when(!in_array($user->user_level, [1, 4]), function ($q) use ($user) {
    //             $q->where('created_by', $user->id);
    //         })
    //             ->whereBetween('created_at', [$previousStart, $previousEnd])
    //             ->count();

    //         // Percentage Change 
    //         $salesChange = $this->calcChange($currentSales, $previousSales);
    //         $dueChange = $this->calcChange($currentDue, $previousDue);
    //         $itemsChange = $this->calcChange($currentItems, $previousItems);
    //         $customersChange = $this->calcChange($currentCustomers, $previousCustomers);

    //         // Sales Overview (Last 7 Days) 
    //         $salesOverview = (clone $salesQuery)
    //             ->selectRaw('DATE(created_at) as date, SUM(grand_total) as total')
    //             ->where('created_at', '>=', $currentStart)
    //             ->groupBy('date')
    //             ->orderBy('date', 'asc')
    //             ->get();

    //         // Recent Transactions 
    //         $recentTransactions = (clone $salesQuery)
    //             ->with('customer:id,customer_name,email')
    //             ->latest()
    //             ->take(7)
    //             ->get(['id', 'customer_id', 'grand_total', 'customer_total_due', 'status', 'created_at']);

    //         return response()->json([
    //             'success' => true,
    //             'business_overview' => [
    //                 'total_sales' => $currentSales,
    //                 'sales_change' => $salesChange['value'],
    //                 'sales_change_type' => $salesChange['type'],

    //                 'total_due' => $currentDue,
    //                 'due_change' => $dueChange['value'],
    //                 'due_change_type' => $dueChange['type'],

    //                 'total_items' => $currentItems,
    //                 'items_change' => $itemsChange['value'],
    //                 'items_change_type' => $itemsChange['type'],

    //                 'total_customers' => $currentCustomers,
    //                 'customers_change' => $customersChange['value'],
    //                 'customers_change_type' => $customersChange['type']
    //             ],
    //             'sales_overview_last_7_days' => $salesOverview,
    //             'recent_transactions' => $recentTransactions
    //         ], 200);
    //     } catch (\Exception $e) {
    //         Log::error('Dashboard fetch failed: ' . $e->getMessage());
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'Something went wrong while fetching the dashboard data.',
    //             'error' => $e->getMessage()
    //         ], 500);
    //     }
    // }


    public function getDashboard()
    {
        try {
            $user = auth()->user();
            $isAdmin = in_array($user->user_level, [1, 4]);

            // Date ranges
            $currentStart = now()->subDays(6)->startOfDay();
            $previousStart = now()->subDays(13)->startOfDay();
            $previousEnd = now()->subDays(7)->endOfDay();

            // Sales query base
            $salesQuery = Sales::query();
            if (!$isAdmin) {
                $salesQuery->where('created_by', $user->id);
            }

            // Current period totals
            $currentSales = (clone $salesQuery)
                ->whereBetween('created_at', [now()->startOfMonth(), now()->endOfMonth()])
                ->sum('grand_total');

            $currentDue = (clone $salesQuery)
                ->whereBetween('created_at', [$currentStart, now()])
                ->sum('customer_total_due');

            $currentItems = Item::when(!$isAdmin, function ($q) use ($user) {
                $q->whereIn('id', function ($sub) use ($user) {
                    $sub->select('product_id')
                        ->from('order_items')
                        ->whereIn('order_id', Order::where('user_id', $user->id));
                });
            })
                ->whereBetween('created_at', [$currentStart, now()])
                ->count();

            $currentCustomers = Customer::when(!$isAdmin, function ($q) use ($user) {
                $q->where('created_by', $user->id);
            })
                ->whereBetween('created_at', [$currentStart, now()])
                ->count();

            // Previous period totals
            $previousSales = (clone $salesQuery)
                ->whereBetween('created_at', [$previousStart, $previousEnd])
                ->sum('grand_total');

            $previousDue = (clone $salesQuery)
                ->whereBetween('created_at', [$previousStart, $previousEnd])
                ->sum('customer_total_due');

            $previousItems = Item::when(!$isAdmin, function ($q) use ($user) {
                $q->whereIn('id', function ($sub) use ($user) {
                    $sub->select('product_id')
                        ->from('order_items')
                        ->whereIn('order_id', Order::where('user_id', $user->id));
                });
            })
                ->whereBetween('created_at', [$previousStart, $previousEnd])
                ->count();

            $previousCustomers = Customer::when(!$isAdmin, function ($q) use ($user) {
                $q->where('created_by', $user->id);
            })
                ->whereBetween('created_at', [$previousStart, $previousEnd])
                ->count();

            // Percentage change
            $salesChange = $this->calcChange($currentSales, $previousSales);
            $dueChange = $this->calcChange($currentDue, $previousDue);
            $itemsChange = $this->calcChange($currentItems, $previousItems);
            $customersChange = $this->calcChange($currentCustomers, $previousCustomers);

            // Sales overview (last 7 days)
            $salesOverview = (clone $salesQuery)
                ->selectRaw('DATE(created_at) as date, SUM(grand_total) as total')
                ->where('created_at', '>=', $currentStart)
                ->groupBy('date')
                ->orderBy('date')
                ->get();

            // Recent transactions
            $recentTransactions = (clone $salesQuery)
                ->with('customer:id,customer_name,email')
                ->latest()
                ->take(7)
                ->get(['id', 'customer_id', 'grand_total', 'customer_total_due', 'status', 'created_at']);

            return response()->json([
                'success' => true,
                'business_overview' => [
                    'total_sales' => $currentSales,
                    'sales_change' => $salesChange['value'],
                    'sales_change_type' => $salesChange['type'],

                    'total_due' => $currentDue,
                    'due_change' => $dueChange['value'],
                    'due_change_type' => $dueChange['type'],

                    'total_items' => $currentItems,
                    'items_change' => $itemsChange['value'],
                    'items_change_type' => $itemsChange['type'],

                    'total_customers' => $currentCustomers,
                    'customers_change' => $customersChange['value'],
                    'customers_change_type' => $customersChange['type'],
                ],
                'sales_overview_last_7_days' => $salesOverview,
                'recent_transactions' => $recentTransactions,
            ]);
        } catch (\Exception $e) {
            Log::error('Dashboard fetch failed', ['exception' => $e]);

            return response()->json([
                'success' => false,
                'message' => 'Something went wrong while fetching the dashboard data.',
            ], 500);
        }
    }

    private function calcChange($current, $previous)
    {
        if ($previous == 0) {
            if ($current > 0) return ['value' => 100, 'type' => 'up'];
            return ['value' => 0, 'type' => 'no-change'];
        }
        $change = round((($current - $previous) / $previous) * 100, 2);
        return ['value' => abs($change), 'type' => $change > 0 ? 'up' : ($change < 0 ? 'down' : 'no-change')];
    }




    public function search(Request $request)
    {
        try {
            $request->validate([
                'data' => 'required|string|max:255'
            ]);

            $term = strtolower($request->data);
            $user = auth()->user();
            $isFullAccess = in_array($user->user_level, [1, 4]);

            // --- STORES ---
            $stores = Store::query()
                ->when(!$isFullAccess, fn($q) => $q->where('user_id', $user->id))
                ->get()
                ->filter(function ($store) use ($term) {
                    return str_contains(strtolower($store->store_name), $term) ||
                        str_contains(strtolower($store->store_code), $term);
                })
                ->values()
                ->take(10);

            // --- WAREHOUSES ---
            $warehouses = Warehouse::query()
                ->when(!$isFullAccess, fn($q) => $q->where('user_id', $user->id))
                ->get()
                ->filter(function ($warehouse) use ($term) {
                    return str_contains(strtolower($warehouse->warehouse_name), $term) ||
                        str_contains(strtolower($warehouse->warehouse_type), $term);
                })
                ->values()
                ->take(10);

            // --- ITEMS ---
            $items = Item::query()
                ->when(!$isFullAccess, fn($q) => $q->where('user_id', $user->id))
                ->get()
                ->filter(function ($item) use ($term) {
                    return str_contains(strtolower($item->item_name), $term) ||
                        str_contains(strtolower($item->SKU), $term);
                })
                ->values()
                ->take(10);



            return response()->json([
                'status' => 1,
                'message' => 'Search results fetched successfully',
                'data' => [
                    'stores' => $stores,
                    'warehouses' => $warehouses,
                    'items' => $items,

                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 0,
                'message' => 'Something went wrong: ' . $e->getMessage(),
                'data' => []
            ], 500);
        }
    }


    /*   public function item_dashboard()
   {

        $customers = Customer::latest()->get();
        $totalCustomers = $customers->count();
        $packages = Packages::latest()->get();
        $totalPackage = $packages->count();
    }*/

    public function item_dashboard()
    {
        try {
            $user = auth()->user();

            if (in_array($user->user_level, [1, 4])) {

                $item = Item::all();
            } else {

                //  $item = Item::all();
                $item = Item::where('user_id', $user->id)->get();
                $totalitem = $item->count();

                // $unit = Units::where('store_id', $item->store_id)->get();
                // $categories = Category::where('store_id', $item->store_id)->get();
                // $brand = Brand::where('store_id', $item->store_id)->get();
            }

            return response()->json([
                'message' => 'Detail Fetch Successfully',
                'status' => 1,
                'data' => $item,
                'totalitem' => $totalitem


            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 0,
                'message' => 'Failed to retrieve Sales: Unauthorozied or data not found',
            ], 500);
        }
    }
}
