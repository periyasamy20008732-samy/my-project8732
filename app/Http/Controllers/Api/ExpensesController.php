<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Expenses;
use App\Models\AcAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ExpensesController extends Controller
{

    public function index()
    {
        try {
            $user = auth()->user();

            if (in_array($user->user_level, [1, 4])) {

                $payment = Expenses::all();
            } else {

                $payment = Expenses::where('created_by', $user->id)->get();
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
        $validator = Validator::make($request->all(), [
            'store_id'      => 'required|integer',
            'expense_code'  => 'required|string|max:50',
            'category_id'   => 'required|integer',
            'expense_date'  => 'required|date',
            'expense_amt'   => 'required|numeric|min:0',
            'payment_type'  => 'required|string|max:50',
            'account_id'    => 'required|integer|exists:ac_accounts,id',
            // 'status'        => 1
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors'  => $validator->errors()
            ], 422);
        }

        try {
            DB::beginTransaction();

            // create expense

            $data = $request->all();
            $data['created_by'] = auth()->id();
            $data['status'] = 'active';
            $expense = Expenses::create($data);

            // deduct from account balance
            $account = AcAccount::findOrFail($request->account_id);
            $account->balance -= $request->expense_amt;
            $account->expense_id = $expense->id;
            $account->save();

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Expense created successfully',
                'data'    => $expense
            ], 201);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("Expense store error: " . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Failed to create expense'
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $expense = Expenses::findOrFail($id);

            $validator = Validator::make($request->all(), [
                'expense_code'  => 'sometimes|string|max:50',
                'category_id'   => 'sometimes|integer',
                'expense_date'  => 'sometimes|date',
                'expense_amt'   => 'sometimes|numeric|min:0',
                'payment_type'  => 'sometimes|string|max:50',
                'account_id'    => 'sometimes|integer|exists:ac_accounts,id',

            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'errors'  => $validator->errors()
                ], 422);
            }

            DB::beginTransaction();

            // old values
            $oldAmount   = $expense->expense_amt;
            $oldAccountId = $expense->account_id;

            // update fields
            $expense->update($request->all());

            // if account changed
            if ($request->has('account_id') && $oldAccountId != $expense->account_id) {
                // refund old account
                $oldAccount = AcAccount::find($oldAccountId);
                if ($oldAccount) {
                    $oldAccount->balance += $oldAmount;
                    $oldAccount->save();
                }

                // deduct new account
                $newAccount = AcAccount::findOrFail($expense->account_id);
                $newAccount->balance -= $expense->expense_amt;
                $newAccount->save();
            } elseif ($request->has('expense_amt')) {
                // same account, only amount changed
                $diff = $expense->expense_amt - $oldAmount;

                $account = AcAccount::findOrFail($expense->account_id);
                $account->balance -= $diff; // deduct or refund difference
                $account->save();
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Expense updated & account adjusted successfully',
                'data'    => $expense
            ], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("Expense update error: " . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Failed to update expense'
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $expense = Expenses::findOrFail($id);
            $expense->delete();

            return response()->json([
                'success' => true,
                'message' => 'Expense deleted successfully'
            ], 200);
        } catch (\Exception $e) {
            Log::error("Expense delete error: " . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Failed to delete expense'
            ], 500);
        }
    }
}
