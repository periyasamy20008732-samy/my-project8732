<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
//use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function register(Request $request)
    {
        //
        //  $validated= $request->validate([
        //     'user_level'=>['required'],
        //     'name'=>['required'],
        //     //'email'=>['email','unique:users,email'],         
        //     //'mobile'=>['required','mobile','unique:users,mobile'],
        //     'password'=>['required','min:8','confirmed'],
        //     'password_confirmation'=>['required']

        // ]);
        // p($request);


echo'<pre>';
print_r($request);
echo'</pre>';

        // die();
        //  $validated= Validator::make($request->all(),[
        //    'user_level'=>['required'],
        //     'name'=>['required'],
        //     'email'=>['email','unique:users,email'],         
        //     'mobile'=>['required','mobile','unique:users,mobile'],
        //     'password'=>['required','min:8','confirmed'],
        //     'password_confirmation'=>['required']
        //  ]);
        // if($validated->fails()){

        //     return response()->json($validated->messages(),400);

        // }else{

        //     $date=[
        //         'user_level'=>$request->user_level,
        //         'name'=>$request->name,
        //         'email'=>$request->email,
        //         'mobile'=>$request->mobile,
        //         'password'=>Hash::make($request->password)
        //     ];

        //     DB::beginTransaction();

        // try{

        //     User::create($data);
        //     DB::Commit();
        //     $token=$user->createToken('access_token')->accessToken;

        // }catch(\Exception $e){
        //         DB::rollBack();
        //         p($e->getMessage());
        // }
            
        // }


        // $user=User::create($validatedData);
        // $token=$user->createToken('access_token')->accessToken;

        // return response()->json([
        //     'access_token'=>$token,
        //     'data'=>$user,
        //     'message'=>'User Register Successfully',
        //     'status'=>1
        // ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
  public function login(Request $request)
{
    // Validate request
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
    }

    // Find the user
    $user = User::where([
        'country_code' => $request->country_code,
        'mobile' => $request->mobile
    ])->first();

    // Check if user exists and password matches
    if ($user && Hash::check($request->password, $user->password)) {

        // Create token if Passport is set up correctly
        $token = $user->createToken('auth_token')->accessToken;

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
