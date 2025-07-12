<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ac_Transactions;

class Ac_TransactionsController extends Controller
{
    public function index()
    {
        $account = Ac_Transactions::all();


        if ($account->isEmpty()) {

            return response()->json([
                'message' => 'Detail Not Found',
                'data' => [],
                'status' => 0
            ], 200);

        } else {

            return response()->json([
                'message' => ' Ac Transactions List',
                'data' => $account,
                'status' => 1
            ], 200);

        }
    }

    // Store a new AcAccount
    public function store(Request $request)
    {


        $account = Ac_Transactions::create($request->all());

        return response()->json([
            'message' => ' Ac Transactions created successfully',
            'data' => $account
        ], 201);
    }

    // Update an existing AcAccount
    public function update(Request $request, $id)
    {
        $account = Ac_Transactions::findOrFail($id);

        $account->update($request->all());

        return response()->json([
            'message' => ' Ac Transactions Details updated successfully',
            'data' => $account
        ]);
    }

    // View a single AcAccount
    public function show($id)
    {
        $account = Ac_Transactions::findOrFail($id);
        return response()->json($account);
    }
    public function destroy($id)
    {
        $account = Ac_Transactions::findOrFail($id);
        $account->delete();
        return response()->json(['message' => ' Ac Transactions deleted']);
    }
}