<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SubscriptionPurchase;
use Carbon\Carbon;

class SubscriptionPurchaseController extends Controller
{
    public function index()
    {
        try {
            $user = auth()->user();

            if (in_array($user->user_level, [1, 4])) {
                // Admin: show all purchases with package & payment info
                $subscription = SubscriptionPurchase::with(['package', 'payment'])->get();
            } else {
                $hasPurchase = SubscriptionPurchase::where('user_id', $user->id)->exists();

                if (!$hasPurchase) {
                    return response()->json([
                        'message' => 'You have not purchased any subscriptions yet',
                        'status'  => 0,
                        'data'    => []
                    ]);
                }

                $subscription = SubscriptionPurchase::with(['package', 'payment'])
                    ->where('user_id', $user->id)
                    ->get()
                    ->filter(function ($purchase) {
                        if (!$purchase->package) {
                            return false;
                        }
                        $expiryDate = Carbon::parse($purchase->created_at)
                            ->addDays($purchase->package->validity_date);
                        return now()->lte($expiryDate);
                    })
                    ->values();
            }

            return response()->json([
                'message' => 'SubscriptionPurchase Detail Fetch Successfully',
                'status'  => 1,
                'data'    => $subscription->map(function ($purchase) {
                    return [
                        'package_id'     => $purchase->package_id,
                        'package_name'   => optional($purchase->package)->package_name,
                        'validity_days'  => optional($purchase->package)->validity_date,
                        'if_webpanel'  => optional($purchase->package)->if_webpanel,
                        'if_android'  => optional($purchase->package)->if_android,
                        'if_ios'  => optional($purchase->package)->if_ios,
                        'if_windows'  => optional($purchase->package)->if_windows,
                        'price'  => optional($purchase->package)->price,
                        'if_customerapp'  => optional($purchase->package)->if_customerapp,
                        'if_deliveryapp'  => optional($purchase->package)->if_deliveryapp,
                        'if_exicutiveapp'  => optional($purchase->package)->if_exicutiveapp,
                        'if_multistore'  => optional($purchase->package)->if_multistore,
                        'if_numberof_store'  => optional($purchase->package)->if_numberof_store,
                        'purchase_date'  => $purchase->created_at->format('Y-m-d'),
                        'expiry_date'    => Carbon::parse($purchase->created_at)
                            ->addDays(optional($purchase->package)->validity_date ?? 0)
                            ->format('Y-m-d'),
                        'payment_id'     => $purchase->payment_id,
                        'payment_price'          => optional($purchase->payment)->price,
                        'payment_status'   => optional($purchase->payment)->payment_status,
                        'payment_date'   => optional($purchase->payment)->created_at
                            ? $purchase->payment->created_at->format('Y-m-d H:i:s')
                            : null
                    ];
                })
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status'  => 0,
                'message' => 'Failed to retrieve SubscriptionPurchase data',
                'error'   => $e->getMessage()
            ], 500);
        }
    }
}
