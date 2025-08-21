<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Models\PurchasePayment;
use App\Models\Ac_Transactions;
use App\Models\AcAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\PurchaseItem;
use App\Models\Supplier;
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
                'created_by'    => auth()->user()->id,
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
            \Log::error('Purchase Payment Error', [
                'message' => $e->getMessage(),
                'file'    => $e->getFile(),
                'line'    => $e->getLine(),
                'trace'   => $e->getTraceAsString(),
            ]);
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
                'file'    => $e->getFile(),
                'line'    => $e->getLine(),
                'trace'   => $e->getTraceAsString(),
            ], 500);
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

    public function paymentOut(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'supplier_id'  => 'required|integer|exists:supplier,id',
            'payment'      => 'required|numeric|min:0.01',
            'payment_date' => 'required|date',
            'purchase_id'  => 'nullable|integer|exists:purchase,id',
            'payment_type' => 'nullable|string|max:50', // Cash/Card/UPI/Cheque etc.
            'payment_note' => 'nullable|string',
            'account_id'   => 'nullable|integer',
            'store_id'     => 'nullable|integer', // allow override
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => false, 'errors' => $validator->errors()], 422);
        }

        // Effective store id resolution
        $user = auth()->user();
        $explicitStoreId = $request->input('store_id');

        if (!empty($explicitStoreId)) {
            $effectiveStoreId = (int) $explicitStoreId;
        } elseif (!empty($user->store_id) && $user->store_id != '0') {
            $effectiveStoreId = (int) $user->store_id;
        } else {
            $effectiveStoreId = (int) DB::table('store')
                ->where('user_id', $user->id)
                ->value('id');
        }

        if (empty($effectiveStoreId)) {
            return response()->json([
                'status'  => false,
                'message' => 'No valid store found for this user',
            ], 400);
        }

        $supplier = Supplier::find($request->supplier_id);
        if (!$supplier) {
            return response()->json(['status' => false, 'message' => 'Supplier not found'], 404);
        }

        // business rule: don’t allow overpay against supplier due (if you track it)
        if (!is_null($supplier->purchase_due) && $request->payment > $supplier->purchase_due) {
            return response()->json(['status' => false, 'message' => 'Payment exceeds supplier due'], 400);
        }

        // Create Purchase Payment
        $payment = PurchasePayment::create([
            'payment_code' => 'PP-' . time(),                 // simple unique code
            'store_id'     => $effectiveStoreId,
            'purchase_id'  => $request->purchase_id,          // nullable
            'payment_date' => $request->payment_date,
            'payment_type' => $request->payment_type ?? 'Cash',
            'payment'      => $request->payment,
            'payment_note' => $request->payment_note,
            'status'       => 1,
            'account_id'   => $request->account_id,
            'supplier_id'  => $request->supplier_id,
            'short_code'   => 'PURCPAY',
            'created_by'   => $user->id,
        ]);

        // Update Supplier Balance (if you maintain it)
        if (!is_null($supplier->purchase_due)) {
            $supplier->purchase_due = max(0, $supplier->purchase_due - $request->payment);
            $supplier->save();
        }

        return response()->json([
            'status'  => true,
            'message' => 'Payment Out recorded',
            'data'    => $payment,
        ], 201);
    }

    public function getPaymentOut(Request $request)
    {
        $user = auth()->user();
        $storeId = $request->query('store_id');

        // Determine effective store IDs
        $storeIds = [];
        if ($storeId) {
            $storeIds = [trim($storeId)];
        } elseif (!empty($user->store_id) && $user->store_id != '0' && $user->store_id != 0) {
            $storeIds = [trim($user->store_id)];
        } else {
            $storeIds = DB::table('store')
                ->where('user_id', $user->id)
                ->pluck('id')
                ->map(fn($id) => (string)$id)
                ->toArray();
        }

        if (empty($storeIds)) {
            return response()->json([
                'message' => 'No stores found for this user',
                'data'    => [],
                'total'   => 0,
                'status'  => 0,
            ], 200);
        }

        $payments = PurchasePayment::with(['purchase', 'supplier'])
            ->whereIn('store_id', $storeIds)
            ->orderBy('payment_date', 'desc')
            ->get()
            ->map(function ($p) {
                return [
                    // payment fields
                    'id'           => $p->id,
                    'payment_code' => $p->payment_code,
                    'store_id'     => $p->store_id,
                    'purchase_id'  => $p->purchase_id,
                    'payment_date' => $p->payment_date,
                    'payment_type' => $p->payment_type, // Cash/Card/UPI/Cheque
                    'payment'      => $p->payment,
                    'payment_note' => $p->payment_note,
                    'status'       => $p->status,
                    'account_id'   => $p->account_id,
                    'short_code'   => $p->short_code,
                    'created_by'   => $p->created_by,

                    // supplier flattened
                    'supplier_id'    => $p->supplier?->id,
                    'supplier_name'  => $p->supplier?->supplier_name,
                    'supplier_phone' => $p->supplier?->phone,
                    'supplier_mobile' => $p->supplier?->mobile,
                    'supplier_email' => $p->supplier?->email,
                    'supplier_address' => $p->supplier?->address,

                    // optional purchase details (flatten minimally, keep IDs lean)
                    'purchase_ref'   => $p->purchase?->invoice_no ?? $p->purchase?->reference_no ?? null,
                ];
            });

        return response()->json([
            'status' => 1,
            'total'  => $payments->count(),
            'data'   => $payments,
        ]);
    }
}
