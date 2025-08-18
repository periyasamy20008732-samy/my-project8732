<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Models\PurchasePayment;
use App\Models\Ac_Transactions;
use App\Models\AcAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\PurchaseItem;
use Exception;

class PurchasePaymentController extends Controller
{

    public function index()
    {
        try {
            $user = auth()->user();

            if (in_array($user->user_level, [1, 4])) {

                $payment = PurchasePayment::all();
            } else {

                $payment = PurchasePayment::where('created_by', $user->id)->get();
            }

            return response()->json([
                'message' => 'PurchasePayment Detail Fetch Successfully',
                'status' => 1,
                'data' => $payment
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 0,
                'message' => 'Failed to retrieve Sales: Unauthorozied or data not found',
            ], 500);
        }
    }



    public function store(Request $request)
    {
        $data = $request->validate([
            'store_id'      => 'required|integer',
            'purchase_id'   => 'required|integer',
            'supplier_id'   => 'required|integer',
            'payment_date'  => 'required|date',
            'payment_type'  => 'required|string',
            'payment'       => 'required|numeric|min:0',
            'account_id'    => 'required|integer',
            'payment_note'  => 'nullable|string',
        ]);

        DB::beginTransaction();
        try {

            $totalCost = PurchaseItem::where('purchase_id', $data['purchase_id'])
                ->sum('total_cost');

            if ($totalCost <= 0) {
                throw new \Exception("No purchase items found for purchase ID: {$data['purchase_id']}");
            }


            $payment = PurchasePayment::create([
                'count_id'      => 1,
                'payment_code'  => 'PP-' . time(),
                'store_id'      => $data['store_id'],
                'purchase_id'   => $data['purchase_id'],
                'payment_date'  => $data['payment_date'],
                'payment_type'  => $data['payment_type'],
                'payment'       => $data['payment'],
                'payment_note'  => $data['payment_note'] ?? null,
                'status'        => 1,
                'account_id'    => $data['account_id'],
                'supplier_id'   => $data['supplier_id'],
                'short_code'    => 'PURPAY',
                'created_by'    => auth()->id(),
            ]);


            if ($data['payment'] >= $totalCost) {
                // Full payment or Overpayment
                $debitAmt  = $totalCost;
                $creditAmt = $data['payment'] - $totalCost;
            } else {
                // Underpayment
                $debitAmt  = $data['payment'];               // paid amount
                $creditAmt = $totalCost - $data['payment'];  // remaining payable
            }


            Ac_Transactions::create([
                'store_id'                => $data['store_id'],
                'payment_code'            => $payment->payment_code,
                'transaction_date'        => $data['payment_date'],
                'transaction_type'        => 'purchase_payment',
                'debit_account_id'        => $data['supplier_id'],
                'credit_account_id'       => $data['account_id'],
                'debit_amt'               => $debitAmt,
                'credit_amt'              => $creditAmt,
                'note'                    => $data['payment_note'] ?? null,
                'ref_purchasepayments_id' => $payment->id,
                'supplier_id'             => $data['supplier_id'],
                'short_code'              => 'PURPAY',
                'created_by'              => auth()->id(),
            ]);


            $account = AcAccount::find($data['account_id']);
            if ($account) {
                $account->balance -= $data['payment'];  // subtract paid amount
                $account->save();
            }

            DB::commit();
            return response()->json([
                'success'    => true,
                'message'    => 'Purchase Payment recorded successfully',
                'total_cost' => $totalCost,
                'paid'       => $data['payment'],
                'debit_amt'  => $debitAmt,
                'credit_amt' => $creditAmt
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }
    public function update(Request $request, $id)
    {
        $payment = PurchasePayment::findOrFail($id);

        $data = $request->validate([
            'payment_date' => 'required|date',
            'payment_type' => 'required|string',
            'payment'      => 'required|numeric|min:0',
            'payment_note' => 'nullable|string',
        ]);

        DB::beginTransaction();
        try {

            $totalCost = PurchaseItem::where('purchase_id', $payment->purchase_id)
                ->sum('total_cost');

            if ($totalCost <= 0) {
                throw new \Exception("No purchase items found for purchase ID: {$payment->purchase_id}");
            }


            $payment->update($data);


            if ($data['payment'] >= $totalCost) {
                // Full or overpayment
                $debitAmt  = $totalCost;
                $creditAmt = $data['payment'] - $totalCost;
            } else {
                // Underpayment
                $debitAmt  = $data['payment'];
                $creditAmt = $data['payment'] - $totalCost;
            }


            $transaction = Ac_Transactions::where('ref_purchasepayments_id', $payment->id)->first();
            if ($transaction) {
                $transaction->update([
                    'transaction_date' => $data['payment_date'],
                    'debit_amt'        => $debitAmt,
                    'credit_amt'       => $creditAmt,
                    'note'             => $data['payment_note'] ?? null,
                ]);
            }

            DB::commit();
            return response()->json([
                'success'    => true,
                'message'    => 'Purchase Payment updated successfully',
                'total_cost' => $totalCost,
                'paid'       => $data['payment'],
                'debit_amt'  => $debitAmt,
                'credit_amt' => $creditAmt
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }



    public function show($id)
    {
        $payment = PurchasePayment::with(['supplier', 'account'])->findOrFail($id);
        return response()->json($payment);
    }
    /**
     * Delete a purchase payment
     */
    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $payment = PurchasePayment::findOrFail($id);


            Ac_Transactions::where('ref_purchasepayments_id', $payment->id)->delete();


            $account = AcAccount::find($payment->account_id);
            if ($account) {
                $account->balance += $payment->payment; // reverse payment
                $account->save();
            }

            $payment->delete();
            DB::commit();

            return response()->json(['success' => true, 'message' => 'Purchase Payment deleted successfully']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }
}
