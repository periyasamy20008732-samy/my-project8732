<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;


class UserController extends Controller
{
    
    /**
     * Store a newly created resource in storage.
     */
    public function register(Request $request)
    {
     

        $validator = Validator::make($request->all(),
        [
              
                'name'=>['required'],          
                'email'=>['email', 'unique:users,email'],
                'country_code'=>['required'], 
                'mobile' => ['required', 'numeric', 'unique:users,mobile'],
                'password'=>['required','min:8','confirmed'],
                'password_confirmation'=>['required']       
                    

        ]);


                    if ($validator->fails()) {
                        return response()->json([
                            'success' => false,
                            'errors' => $validator->errors()
                        ], 400); // or 422, your choice
                    }else{

                        $data=[
                                    'user_level'=>$request->user_level,
                                    'store_id'=>$request->store_id,
                                    'name'=>$request->name,
                                    'email'=>$request->email,
                                    'country_code'=>$request->country_code,
                                    'mobile'=>$request->mobile,
                                    //'password'=>Hash::make($request->password)
                                    'password'=>md5($request->password)
                                ];

                                DB::beginTransaction();

                            try{

                                $result= User::create($data);
                                DB::Commit();
                                $token=$result->createToken('access_token')->accessToken;

                            }catch(\Exception $e){
                                    DB::rollBack();
                                    p($e->getMessage());
                                    $result=null;
                            }
                            if($result!= null){
                            //ok
                        
                            return response()->json([
                                'access_token'=>$token,
                                'data'=>$result,
                                'message'=>'User Register Successfully',
                                'status'=>1
                            ],200);

                            }else{
                                    return response()->json([
                                        
                                            'message'=>'Internal server error',
                                            'status'=>1
                                        ],500);

                            }

                    }

    }

    /**
     * Display the specified resource.
     */

            public function login(Request $request)
            {
           
                $validator = Validator::make($request->all(), [
                    'country_code' => ['required'],
                    'mobile' => ['required', 'numeric'],
                    'password' => ['required']
                ]);
            
                if ($validator->fails()) {
                    return response()->json([
                        'success' => false,
                        'errors' => $validator->errors()
                    ], 422);
                }else{

                // Fetch user matching credentials
                $user = User::where('country_code', $request->country_code)
                            ->where('mobile', $request->mobile)
                            ->where('password', md5($request->password))
                            ->first();

                if ($user) {
                    // If using Passport and it's configured properly
                    if (method_exists($user, 'createToken')) {
                        $token = $user->createToken('auth_token')->accessToken;
                    } else {
                        $token = null; // or generate token your way if needed
                    }

                    return response()->json([
                        'access_token' => $token,
                        'user' => $user,
                        'message' => 'User login successfully',
                        'status' => 1
                    ], 200);
                } else {
                    return response()->json([
                        'message' => 'Invalid credentials',
                        'status' => 0
                    ], 401);
                }

                }

            }


            /**
             * geting user data
             */

             public function getUser(string $id){

              
                $result= User::find($id);

                if(is_null($result)){

                    return response()->json([
                        'message' => 'User Not Found',
                         'data'=>$null,                       
                        'status' => 0
                    ], 200);

                }else{
                     
                     return response()->json([
                        'message' => 'Details Found',
                        'data'=>$result,
                        'status' => 1
                    ], 200);
                    
                }

             }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
