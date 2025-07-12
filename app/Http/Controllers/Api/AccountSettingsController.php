<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AccountSettings;

class AccountSettingsController extends Controller
{
    public function index()
    {
        $account = AccountSettings::all();


        if ($account->isEmpty()) {

            return response()->json([
                'message' => 'Detail Not Found',
                'data' => [],
                'status' => 0
            ], 200);

        } else {

            return response()->json([
                'message' => 'account List',
                'data' => $account,
                'status' => 1
            ], 200);

        }
    }

    // Store a new AcAccount
    public function store(Request $request)
    {


        $account = AccountSettings::create($request->all());

        return response()->json([
            'message' => 'AcAccount created successfully',
            'data' => $account
        ], 201);
    }

    // Update an existing AcAccount
    public function update(Request $request, $id)
    {
        $account = AccountSettings::findOrFail($id);

        $account->update($request->all());

        return response()->json([
            'message' => 'AcAccount Details updated successfully',
            'data' => $account
        ]);
    }

    // View a single AcAccount
    public function show($id)
    {
        $account = AccountSettings::findOrFail($id);
        return response()->json($account);
    }
    public function destroy($id)
    {
        $account = AccountSettings::findOrFail($id);
        $account->delete();
        return response()->json(['message' => 'AcAccount deleted']);
    }
}