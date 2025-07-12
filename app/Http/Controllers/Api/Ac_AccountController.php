<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AcAccount;

class Ac_AccountController extends Controller
{
    public function index()
    {
        $account = AcAccount::all();
        

                if ($account->isEmpty()) {

                    return response()->json([
                        'message' => 'Detail Not Found',
                         'data'=>[],                       
                        'status' => 0
                    ], 200);

                }else{
                     
                     return response()->json([
                        'message' => 'account List',
                        'data'=>$account,
                        'status' => 1
                    ], 200);
                    
                }
    }

    // Store a new AcAccount
    public function store(Request $request)
    {
       

        $account = AcAccount::create($request->all());

        return response()->json([
            'message' => 'AcAccount created successfully',
            'data' => $account
        ], 201);
    }

    // Update an existing AcAccount
    public function update(Request $request, $id)
    {
        $account= AcAccount::findOrFail($id);

        $account->update($request->all());

        return response()->json([
            'message' => 'AcAccount Details updated successfully',
            'data' => $account
        ]);
    }

    // View a single AcAccount
    public function show($id)
    {
        $account = AcAccount::findOrFail($id);
        return response()->json($account);
    }
      public function destroy($id)
    {
        $account = AcAccount::findOrFail($id);
        $account->delete();
        return response()->json(['message' => 'AcAccount deleted']);
    }
}




