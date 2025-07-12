<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Services\SmsService;

use Carbon\Carbon;


class UserController extends Controller
{

    /**
     * Store a newly created resource in storage.
     */
    public function register(Request $request)
    {


        $validator = Validator::make(
            $request->all(),
            [

                'name' => ['required'],
                'email' => ['email', 'unique:users,email'],
                'country_code' => ['required'],
                'mobile' => ['required', 'numeric', 'unique:users,mobile'],
                'password' => ['required', 'min:8', 'confirmed'],
                'password_confirmation' => ['required']


            ]
        );


        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 400); // or 422, your choice
        } else {

            $data = [
                'user_level' => $request->user_level,
                'store_id' => $request->store_id,
                'name' => $request->name,
                'email' => $request->email,
                'country_code' => $request->country_code,
                'mobile' => $request->mobile,
                //'password'=>Hash::make($request->password)
                'license_key' => $randomInt = rand(1000, 9999),
                'password' => md5($request->password)
            ];

            DB::beginTransaction();

            try {

                $result = User::create($data);
                DB::Commit();
                $token = $result->createToken('access_token')->accessToken;

            } catch (\Exception $e) {
                DB::rollBack();
                // p($e->getMessage());
                echo '<pre>';
                print_r($e->getMessage());
                echo '</pre>';
                $result = null;
            }
            if ($result != null) {
                //ok

                return response()->json([
                    'access_token' => $token,
                    'data' => $result,
                    'message' => 'User Register Successfully',
                    'status' => 1
                ], 200);

            } else {
                return response()->json([

                    'message' => 'Internal server error',
                    'status' => 1
                ], 500);

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
        } else {

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

    public function getUser(string $id)
    {


        $result = User::find($id);

        if (is_null($result)) {

            return response()->json([
                'message' => 'User Not Found',
                'data' => null,
                'status' => 0
            ], 200);

        } else {

            return response()->json([
                'message' => 'Details Found',
                'data' => $result,
                'status' => 1
            ], 200);

        }

    }




    public function update(Request $request, $id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'User not found.'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => ['required'],
            'email' => ['required', 'email', 'unique:users,email,' . $id],
            'country_code' => ['required'],
            'mobile' => ['required', 'numeric', 'unique:users,mobile,' . $id],
            'password' => ['nullable', 'min:6']
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        // Only update fillable fields
        $data = $request->only($user->getFillable());

        // Hash password if provided
        if (!empty($request->password)) {
            $data['password'] = md5($request->password);
        } else {
            unset($data['password']); // Prevent null overwrite
        }

        $user->update($data);

        return response()->json([
            'status' => true,
            'message' => 'User details updated successfully.',
            'data' => $user
        ]);
    }

    /*
        public function sendOtp(Request $request, SmsService $smsService)
        {
            $validator = Validator::make($request->all(), [
                'name'       => 'required|string|max:255|unique:users,name',
                'mobile'      => 'required|string|max:20|unique:users,mobile',
                'email'       => 'nullable|email|max:255|unique:users,email',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validation failed',
                    'errors' => $validator->errors()
                ], 422);
            }

            $otp = str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);


            $config  = DB::table('site_config')->where('id', 1)->first();
            $message = str_replace('{code}', $otp, $config->sms_msg ?? 'Your OTP code is {code}');
            $smsResponse = $smsService->send($request->mobile, $message);

            return response()->json([
                'status' => true,
                'message' => 'OTP sent. Verify to register your account.',
                'otp' => app()->environment('local') ? $otp : null,
                'sms_response' => $smsResponse
            ]);
        }*/
    //public function sendOtp(Request $request)
    /* public function sendOtp(Request $request, SmsService $smsService)
       {
           $request->validate([
               'mobile' => 'required'
           ]);

           $otp = rand(100000, 999999);
           $expiresAt = now()->addMinutes(5);

           // Store or update OTP
           $data=User::updateOrCreate(
               ['mobile' => $request->mobile],
               ['otp' => $otp, 'expires_at' => $expiresAt],
               [ 'license_key'=>$randomInt = rand(1000, 9999)]
           );

           DB::beginTransaction();

                               try{

                                   $result= User::create($data);
                                   DB::Commit();
                                   $token=$result->createToken('access_token')->accessToken;

                               }catch(\Exception $e){
                                       DB::rollBack();
                                      // p($e->getMessage());
                                      echo'<pre>';
                                      print_r   ($e->getMessage());
                                      echo '</pre>';
                                       $result=null;
                               }

           $config  = DB::table('site_config')->where('id', 1)->first();
           $message = str_replace('{code}', $otp, $config->sms_msg ?? 'Your OTP code is {code}');
           $smsResponse = $smsService->send($request->mobile, $message);

           return response()->json([
                'access_token'=>$token,
               'status' => true,
               'message' => 'OTP sent. Verify to register your account.',
               'otp' => app()->environment('local') ? $otp : null,
               'sms_response' => $smsResponse
           ]);
         //  return response()->json(['message' => 'OTP sent successfully','data' => $result]);
       } */

    public function sendOtp(Request $request, SmsService $smsService)
    {
        $request->validate([
            'mobile' => 'required'
        ]);

        $otp = rand(100000, 999999);
        $expiresAt = now()->addMinutes(5);

        // Store or update OTP in separate table
        \DB::table('users')->updateOrInsert(
            ['mobile' => $request->mobile],
            [
                'otp' => $otp,
                'expires_at' => $expiresAt,
                'created_at' => now(),
                'updated_at' => now()
            ]
        );

        $user = User::where('mobile', $request->mobile)->first();

        // Send SMS
        $config = DB::table('site_config')->where('id', 1)->first();
        $message = str_replace('{code}', $otp, $config->sms_msg ?? 'Your OTP code is {code}');
        $smsResponse = $smsService->send($request->mobile, $message);

        $token = null;
        if ($user) {
            // Existing user, issue token
            // $token = $user->createToken('access_token')->plainTextToken;

            //  $token=$user->createToken('access_token')->accessToken;
        }

        return response()->json([
            'access_token' => $token,
            'status' => true,
            'message' => 'OTP sent. Verify to proceed.',
            'otp' => app()->environment('local') ? $otp : null,
            'sms_response' => $smsResponse,
            'is_existing_user' => $user ? true : false
        ]);
    }

    public function verifyOtp(Request $request)
    {
        $request->validate([
            'mobile' => 'required',
            'otp' => 'required'
        ]);

        $otpRecord = DB::table('users')
            ->where('mobile', $request->mobile)
            ->where('otp', $request->otp)
            ->where('expires_at', '>', now())
            ->first();

        if (!$otpRecord) {
            return response()->json(['message' => 'Invalid or expired OTP'], 401);
        }

        $user = User::where('mobile', $request->mobile)->first();

        if ($user) {
            // $token = $user->createToken('access_token')->plainTextToken;
            $token = $user->createToken('access_token')->accessToken;
            return response()->json([
                'access_token' => $token,
                'message' => 'Login successful',
                'redirect_to' => '/user/home'
            ]);
        } else {
            return response()->json([
                'message' => 'OTP verified. Redirect to registration.',
                'redirect_to' => '/register'
            ]);
        }
    }

    public function veriffyOtp(Request $request)
    {
        $request->validate([
            'mobile' => 'required',
            'otp' => 'required'
        ]);

        $record = User::where('mobile', $request->mobile)
            ->where('otp', $request->otp)
            ->where('expires_at', '>', now())
            ->first();

        if (!$record) {
            return response()->json(['message' => 'Invalid or expired OTP'], 401);
        }

        // OTP is valid, check if user exists
        $user = User::where('mobile', $request->mobile)->first();

        if ($user) {
            // Log the user in (if desired)
            // Auth::login($user);

            return response()->json(['redirect_to' => '/user/home']); // existing user
        } else {
            return response()->json(['redirect_to' => '/register']); // new user
        }
    }
}