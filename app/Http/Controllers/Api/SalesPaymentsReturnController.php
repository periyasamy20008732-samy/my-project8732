<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SalesPaymentsReturn;
use App\Models\SalesReturn;
use App\Models\Ac_Transactions;
use App\Models\AcAccount;
use Illuminate\Support\Facades\DB;

class SalesPaymentsReturnController extends Controller
{

    public function index()
    {
        try {
            $user = auth()->user();

            if (in_array($user->user_level, [1, 4])) {

                $payment = SalesPaymentsReturn::all();
            } else {

                $payment = SalesPaymentsReturn::where('created_by', $user->id)->get();
            }

            return response()->json([
                'message' => 'SalesPaymentsReturn Detail Fetch Successfully',
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
            'store_id'        => 'required|integer',
            'return_id' => 'required|integer',
            'customer_id'     => 'required|integer',
            'payment_date'    => 'required|date',
            'payment_type'    => 'required|string',
            'payment'   => 'required|numeric|min:0',
            'account_id'      => 'required|integer',
            'payment_note'    => 'nullable|string',
        ]);

        DB::beginTransaction();
        try {
            $totalReturn = SalesReturn::where('id', $data['return_id'])
                ->sum('grand_total');

            if ($totalReturn <= 0) {
                throw new \Exception("No return items found for Sales Return ID: {$data['return_id']}");
            }

            $paymentReturn = SalesPaymentsReturn::create([
                'count_id'        => 1,
                'payment_code'    => 'SPR-' . time(),
                'store_id'        => $data['store_id'],
                'return_id' => $data['return_id'],
                'payment_date'    => $data['payment_date'],
                'payment_type'    => $data['payment_type'],
                'payment'          => $data['payment'],
                'payment_note'    => $data['payment_note'] ?? null,
                'status'          => 1,
                'account_id'      => $data['account_id'],
                'customer_id'     => $data['customer_id'],
                'short_code'      => 'SALERETPAY',
                'created_by'      => auth()->id(),
            ]);

            if ($data['payment'] >= $totalReturn) {
                // Full refund or Over refund
                $debitAmt  = $totalReturn;
                $creditAmt = $data['payment'] - $totalReturn;
            } else {
                // Partial refund
                $debitAmt  = $data['payment'];                // refunded amount
                $creditAmt = $totalReturn - $data['payment']; // still payable
            }

            Ac_Transactions::create([
                'store_id'                   => $data['store_id'],
                'payment_code'               => $paymentReturn->payment_code,
                'transaction_date'           => $data['payment_date'],
                'transaction_type'           => 'sales_payment_return',
                'debit_account_id'           => $data['customer_id'], // customer receives refund
                'credit_account_id'          => $data['account_id'],  // your bank/cash decreases
                'debit_amt'                  => $debitAmt,
                'credit_amt'                 => $creditAmt,
                'note'                       => $data['payment_note'] ?? null,
                'ref_salespaymentsreturn_id' => $paymentReturn->id,
                'customer_id'                => $data['customer_id'],
                'short_code'                 => 'SALERETPAY',
                'created_by'                 => auth()->id(),
            ]);

            $account = AcAccount::find($data['account_id']);
            if ($account) {
                $account->balance -= $data['payment']; // refund reduces balance
                $account->save();
            }

            DB::commit();
            return response()->json([
                'success'       => true,
                'message'       => 'Sales Payment Return recorded successfully',
                'total_return'  => $totalReturn,
                'payment'        => $data['payment'],
                'debit_amt'     => $debitAmt,
                'credit_amt'    => $creditAmt
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function update(Request $request, $id)
    {
        $paymentReturn = SalesPaymentsReturn::findOrFail($id);

        $data = $request->validate([
            'payment_date'  => 'required|date',
            'payment_type'  => 'required|string',
            'payment' => 'required|numeric|min:0',
            'payment_note'  => 'nullable|string',
            'account_id'    => 'required|integer',

        ]);

        DB::beginTransaction();
        try {
            $totalReturn = SalesReturn::where('id', $paymentReturn->return_id)
                ->sum('grand_total');

            if ($totalReturn <= 0) {
                throw new \Exception("No return items found for Sales Return ID: {$paymentReturn->return_id}");
            }

            $paymentReturn->update($data);

            if ($data['payment'] >= $totalReturn) {
                $debitAmt  = $totalReturn;
                $creditAmt = $data['payment'] - $totalReturn;
            } else {
                $debitAmt  = $data['payment'];
                $creditAmt = $totalReturn - $data['payment'];
            }

            $transaction = Ac_Transactions::where('ref_salespaymentsreturn_id', $paymentReturn->id)->first();
            if ($transaction) {
                $transaction->update([
                    'transaction_date' => $data['payment_date'],
                    'debit_amt'        => $debitAmt,
                    'credit_amt'       => $creditAmt,
                    'note'             => $data['payment_note'] ?? null,
                ]);
            }

            $account = AcAccount::find($data['account_id']);
            if ($account) {
                $account->balance -= $data['payment'];
                $account->save();
            }

            DB::commit();
            return response()->json([
                'success'       => true,
                'message'       => 'Sales Payment Return updated successfully',
                'total_return'  => $totalReturn,
                'refund'        => $data['payment'],
                'debit_amt'     => $debitAmt,
                'credit_amt'    => $creditAmt
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }



    // View a single SalesItem
    public function show($id)
    {
        $salesitem = SalesPaymentsReturn::findOrFail($id);
        return response()->json($salesitem);
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $payment = SalesPaymentsReturn::findOrFail($id);

            // Reverse account balance
            $account = AcAccount::find($payment->account_id);
            if ($account) {
                $account->balance += $payment->payment;
                $account->save();
            }

            // Delete related transaction
            Ac_Transactions::where('ref_salespaymentsreturn_id', $payment->id)->delete();

            // Delete payment record
            $payment->delete();

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Sales Payment Return deleted successfully'
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
