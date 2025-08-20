<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SalesPayments;
use Illuminate\Support\Facades\DB;
use App\Models\Ac_Transactions;
use App\Models\AcAccount;
use App\Models\SalesItem;

class SalesPaymentsController extends Controller
{


    public function index()
    {
        try {
            $user = auth()->user();

            if (in_array($user->user_level, [1, 4])) {

                $payment = SalesPayments::all();
            } else {

                $payment = SalesPayments::where('created_by', $user->id)->get();
            }

            return response()->json([
                'message' => 'SalesPayments Detail Fetch Successfully',
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
            'store_id'     => 'required|integer',
            'sales_id'     => 'required|integer',
            'customer_id'  => 'required|integer',
            'payment_date' => 'required|date',
            'payment_type' => 'required|string',
            'payment'      => 'required|numeric|min:0',
            'account_id'   => 'required|integer',
            'payment_note' => 'nullable|string',
        ]);

        DB::beginTransaction();
        try {
            $totalCost = SalesItem::where('sales_id', $data['sales_id'])
                ->sum('total_cost');

            if ($totalCost <= 0) {
                throw new \Exception("No sales items found for sales ID: {$data['sales_id']}");
            }

            $payment = SalesPayments::create([
                'count_id'     => 1,
                'payment_code' => 'SP-' . time(),
                'store_id'     => $data['store_id'],
                'sales_id'     => $data['sales_id'],
                'payment_date' => $data['payment_date'],
                'payment_type' => $data['payment_type'],
                'payment'      => $data['payment'],
                'payment_note' => $data['payment_note'] ?? null,
                'status'       => 1,
                'account_id'   => $data['account_id'],
                'customer_id'  => $data['customer_id'],
                'short_code'   => 'SALEPAY',
                'created_by'   => auth()->id(),
            ]);

            if ($data['payment'] >= $totalCost) {
                // Full payment or Overpayment
                $creditAmt = $totalCost;
                $debitAmt  = $data['payment'] - $totalCost;
            } else {
                // Underpayment
                $creditAmt = $data['payment'];                // received amount
                $debitAmt  = $totalCost - $data['payment'];   // balance receivable
            }

            Ac_Transactions::create([
                'store_id'               => $data['store_id'],
                'payment_code'           => $payment->payment_code,
                'transaction_date'       => $data['payment_date'],
                'transaction_type'       => 'sales_payment',
                'debit_account_id'       => $data['account_id'],  // cash/bank increases
                'credit_account_id'      => $data['customer_id'], // customer decreases
                'debit_amt'              => $creditAmt,
                'credit_amt'             => $creditAmt,
                'note'                   => $data['payment_note'] ?? null,
                'ref_salespayments_id'   => $payment->id,
                'customer_id'            => $data['customer_id'],
                'short_code'             => 'SALEPAY',
                'created_by'             => auth()->id(),
            ]);

            $account = AcAccount::find($data['account_id']);
            if ($account) {
                $account->balance += $data['payment']; // Add to account (cash/bank)
                $account->save();
            }

            DB::commit();
            return response()->json([
                'success'    => true,
                'message'    => 'Sales Payment recorded successfully',
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
        $payment = SalesPayments::findOrFail($id);

        $data = $request->validate([
            'payment_date' => 'required|date',
            'payment_type' => 'required|string',
            'payment'      => 'required|numeric|min:0',
            'payment_note' => 'nullable|string',
        ]);

        DB::beginTransaction();
        try {
            $totalCost = SalesItem::where('sales_id', $payment->sales_id)
                ->sum('total_cost');

            if ($totalCost <= 0) {
                throw new \Exception("No sales items found for sales ID: {$payment->sales_id}");
            }

            $payment->update($data);

            if ($data['payment'] >= $totalCost) {
                // Full or Overpayment
                $creditAmt = $totalCost;
                $debitAmt  = $data['payment'] - $totalCost;
            } else {
                // Underpayment
                $creditAmt = $data['payment'];
                $debitAmt  = $totalCost - $data['payment'];
            }

            $transaction = Ac_Transactions::where('ref_salespayments_id', $payment->id)->first();
            if ($transaction) {
                $transaction->update([
                    'transaction_date' => $data['payment_date'],
                    'debit_amt'        => $creditAmt,
                    'credit_amt'       => $creditAmt,
                    'note'             => $data['payment_note'] ?? null,
                ]);
            }

            DB::commit();
            return response()->json([
                'success'    => true,
                'message'    => 'Sales Payment updated successfully',
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

    // View a single SalesItem
    public function show($id)
    {
        $salesitem = SalesPayments::findOrFail($id);
        return response()->json($salesitem);
    }


    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $payment = SalesPayments::findOrFail($id);


            Ac_Transactions::where('ref_salespayments_id', $payment->id)->delete();


            $account = AcAccount::find($payment->account_id);
            if ($account) {
                $account->balance -= $payment->payment; // reverse payment
                $account->save();
            }

            $payment->delete();
            DB::commit();

            return response()->json(['success' => true, 'message' => 'Sales Payment deleted successfully']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }
}
