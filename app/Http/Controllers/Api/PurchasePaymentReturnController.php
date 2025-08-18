<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\PurchaseReturn;

use App\Models\PurchasePaymentReturn;
use App\Models\PurchaseItem;
use App\Models\Ac_Transactions;
use App\Models\AcAccount;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;



class PurchasePaymentReturnController extends Controller
{

    // View all Purchase Payment

    public function index()
    {
        try {
            $user = Auth::user();

            if (!$user) {
                return response()->json([
                    'message' => 'Unauthorized',
                    'data' => [],
                    'status' => 0
                ], 401);
            }


            if (in_array($user->user_level, [1, 4])) {
                $purchasepayment_return = PurchasePaymentReturn::orderBy('id', 'desc')->get();
            } else {

                $purchasepayment_return = PurchasePaymentReturn::where('created_by', $user->id)
                    ->orderBy('id', 'desc')
                    ->get();
            }

            if ($purchasepayment_return->isEmpty()) {
                return response()->json([
                    'message' => 'Purchase Payment Return Details Not Found',
                    'data' => [],
                    'status' => 0
                ], 200);
            }

            return response()->json([
                'message' => 'Purchase Payment Return List',
                'data' => $purchasepayment_return,
                'status' => 1
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'data' => [],
                'status' => 0
            ], 500);
        }
    }


    /**
     * Store a new purchase payment return
     */

    public function store(Request $request)
    {
        $data = $request->validate([
            'store_id'      => 'required|integer',
            'purchase_id'   => 'required|integer',
            'return_id'     => 'required|integer',
            'supplier_id'   => 'required|integer',
            'payment_date'  => 'required|date',
            'payment_type'  => 'required|string',
            'payment'       => 'required|numeric|min:0',
            'account_id'    => 'required|integer',
            'payment_note'  => 'nullable|string',
        ]);

        DB::beginTransaction();
        try {

            $purchaseReturn = PurchaseReturn::find($data['return_id']);

            if (!$purchaseReturn) {
                throw new \Exception("No purchase return found for return ID: {$data['return_id']}");
            }


            $totalReturn = $purchaseReturn->grand_total;


            $payment = PurchasePaymentReturn::create([
                'count_id'     => 1,
                'payment_code' => 'PPR-' . time(),
                'store_id'     => $data['store_id'],
                'purchase_id'  => $data['purchase_id'],
                'return_id'    => $data['return_id'],
                'payment_date' => $data['payment_date'],
                'payment_type' => $data['payment_type'],
                'payment'      => $data['payment'],
                'payment_note' => $data['payment_note'] ?? null,
                'status'       => 1,
                'account_id'   => $data['account_id'],
                'supplier_id'  => $data['supplier_id'],
                'short_code'   => 'PURPAYRET',
                'created_by'   => auth()->id(),
            ]);


            if ($data['payment'] < $totalReturn) {
                $debitAmt  = $data['payment'];
                $creditAmt = -1 * ($totalReturn - $data['payment']);
            } else {
                $debitAmt  = $totalReturn;
                $creditAmt = $data['payment'] - $totalReturn;
            }


            Ac_Transactions::create([
                'store_id'                 => $data['store_id'],
                'payment_code'             => $payment->payment_code,
                'transaction_date'         => $data['payment_date'],
                'transaction_type'         => 'purchase_payment_return',
                'debit_account_id'         => $data['supplier_id'],
                'credit_account_id'        => $data['account_id'],
                'debit_amt'                => $debitAmt,
                'credit_amt'               => $creditAmt,
                'note'                     => $data['payment_note'] ?? null,
                'ref_purchasepaymentsreturn_id'  => $payment->id,
                'supplier_id'              => $data['supplier_id'],
                'short_code'               => 'PURPAYRET',
                'created_by'               => auth()->id(),
            ]);


            $account = AcAccount::find($data['account_id']);
            if ($account) {
                $account->balance += $data['payment'];
                $account->save();
            }

            DB::commit();

            return response()->json([
                'success'     => true,
                'message'     => 'Purchase Payment Return recorded successfully',
                'grand_total'  => $totalReturn,
                'paid'        => $data['payment'],
                'debit_amt'   => $debitAmt,
                'credit_amt'  => $creditAmt
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'store_id'      => 'required|integer',
            'purchase_id'   => 'required|integer',
            'return_id'     => 'required|integer',
            'supplier_id'   => 'required|integer',
            'payment_date'  => 'required|date',
            'payment_type'  => 'required|string',
            'payment'       => 'required|numeric|min:0',
            'account_id'    => 'required|integer',
            'payment_note'  => 'nullable|string',
        ]);

        DB::beginTransaction();
        try {

            $payment = PurchasePaymentReturn::findOrFail($id);

            $purchaseReturn = PurchaseReturn::find($data['return_id']);
            if (!$purchaseReturn) {
                throw new \Exception("No purchase return found for return ID: {$data['return_id']}");
            }

            $totalReturn = $purchaseReturn->grand_total;


            $payment->update([
                'store_id'     => $data['store_id'],
                'purchase_id'  => $data['purchase_id'],
                'return_id'    => $data['return_id'],
                'payment_date' => $data['payment_date'],
                'payment_type' => $data['payment_type'],
                'payment'      => $data['payment'],
                'payment_note' => $data['payment_note'] ?? null,
                'status'       => 1,
                'account_id'   => $data['account_id'],
                'supplier_id'  => $data['supplier_id'],
                'short_code'   => 'PURPAYRET',
                'created_by'   => auth()->id(),
            ]);

            if ($data['payment'] < $totalReturn) {
                $debitAmt  = $data['payment'];
                $creditAmt = -1 * ($totalReturn - $data['payment']);
            } else {
                $debitAmt  = $totalReturn;
                $creditAmt = $data['payment'] - $totalReturn;
            }


            $transaction = Ac_Transactions::where('ref_purchasepayments_id', $payment->id)->first();
            if ($transaction) {
                $transaction->update([
                    'store_id'                 => $data['store_id'],
                    'transaction_date'         => $data['payment_date'],
                    'transaction_type'         => 'purchase_payment_return',
                    'debit_account_id'         => $data['supplier_id'],
                    'credit_account_id'        => $data['account_id'],
                    'debit_amt'                => $debitAmt,
                    'credit_amt'               => $creditAmt,
                    'note'                     => $data['payment_note'] ?? null,
                    'supplier_id'              => $data['supplier_id'],
                    'short_code'               => 'PURPAYRET',
                    'created_by'               => auth()->id(),
                ]);
            } else {
                Ac_Transactions::create([
                    'store_id'                 => $data['store_id'],
                    'payment_code'             => $payment->payment_code,
                    'transaction_date'         => $data['payment_date'],
                    'transaction_type'         => 'purchase_payment_return',
                    'debit_account_id'         => $data['supplier_id'],
                    'credit_account_id'        => $data['account_id'],
                    'debit_amt'                => $debitAmt,
                    'credit_amt'               => $creditAmt,
                    'note'                     => $data['payment_note'] ?? null,
                    'ref_purchasepaymentsreturn_id'  => $payment->id,
                    'supplier_id'              => $data['supplier_id'],
                    'short_code'               => 'PURPAYRET',
                    'created_by'               => auth()->id(),
                ]);
            }


            $account = AcAccount::find($data['account_id']);
            if ($account) {
                $account->balance += $data['payment'];
                $account->save();
            }

            DB::commit();

            return response()->json([
                'success'     => true,
                'message'     => 'Purchase Payment Return updated successfully',
                'grand_total' => $totalReturn,
                'paid'        => $data['payment'],
                'debit_amt'   => $debitAmt,
                'credit_amt'  => $creditAmt
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }
    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $payment = PurchasePaymentReturn::findOrFail($id);

            // Reverse account balance
            $account = AcAccount::find($payment->account_id);
            if ($account) {
                $account->balance -= $payment->payment;
                $account->save();
            }

            // Delete related transaction
            Ac_Transactions::where('ref_purchasepaymentsreturn_id', $payment->id)->delete();

            // Delete payment record
            $payment->delete();

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Purchase Payment Return deleted successfully'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
