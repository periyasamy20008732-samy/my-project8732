<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Settings;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Services\SmsService;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
class UserController extends Controller
{
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




    public function getUser(string $id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'User not found.',
                'data' => null
            ], 404);
        }

        return response()->json([
            'status' => true,
            'message' => 'User details found.',
            'data' => $user
        ]);
    }

    public function sendOtp(Request $request, SmsService $smsService)
    {
        $request->validate(['mobile' => 'required']);

        $otp = rand(1000, 9999);
        $expiresAt = now()->addMinutes(5);

        // Save OTP in user_otps table (recommended) or users table temporarily
        DB::table('users')->updateOrInsert(
            ['mobile' => $request->mobile],
            ['otp' => $otp, 'expires_at' => $expiresAt, 'created_at' => now(), 'updated_at' => now()]
        );

        $message = str_replace('{code}', $otp, DB::table('site_config')->value('sms_msg') ?? 'Your OTP code is {code}');
        $smsResponse = $smsService->send($request->mobile, $message);

        return response()->json([
            'status' => true,
            'message' => 'OTP sent successfully.',
            'otp' => app()->environment('local') ? $otp : null,
            'sms_response' => $smsResponse
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
            return response()->json([
                'status' => false,
                'message' => 'Invalid or expired OTP.'
            ], 401);
        }

        $user = User::where('mobile', $request->mobile)->first();

        if ($user) {
            $token = $user->createToken('access_token')->accessToken;

            return response()->json([
                'status' => true,
                'message' => 'OTP verified. Login successful.',
                'access_token' => $token,
                'data' => $user,
                'redirect_to' => '/user/home',
                'is_existing_user' => true
            ]);
        } else {
            return response()->json([
                'status' => true,
                'message' => 'OTP verified. Redirect to registration.',
                'redirect_to' => '/register',
                'is_existing_user' => false
            ]);
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

        $data = $request->only($user->getFillable());

        // Hash password if provided
        if (!empty($request->password)) {
            $data['password'] = Hash::make($request->password);
        } else {
            unset($data['password']);
        }

        // Handle image upload
        if ($request->hasFile('profile_image')) {
            $file = $request->file('profile_image');
            $directory = 'uploads/';
            $imageName = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path($directory), $imageName);
            $data['profile_image'] = $directory . $imageName;
        }

        $user->update($data);

        return response()->json([
            'status' => true,
            'message' => 'User details updated successfully.',
            'data' => $user
        ]);
    }



public function checkSession(Request $request)
{
    try {
        $user = auth()->user(); // Auth from token (e.g., Laravel Passport)

        if (!$user) {
            return response()->json([
                'success' => false,
                'is_logged_in' => false,
                'user_exists' => false,
                'message' => 'Session expired or invalid. Please login.',
                'status' => 401
            ], 401);
        }

        $userData = User::find($user->id); // or $user if already loaded

        if (!$userData) {
            return response()->json([
                'success' => false,
                'is_logged_in' => false,
                'user_exists' => false,
                'message' => 'User does not exist.',
                'status' => 404
            ], 404);
        }

        if ($userData->is_blocked || $userData->status == 'inactive' || $userData->deleted_at) {
            return response()->json([
                'success' => true,
                'is_logged_in' => false,
                'user_exists' => true,
                'user_blocked' => true,
                'message' => 'User is blocked or deactivated.',
                'status' => 403
            ], 403);
        }

        $settings = Settings::first();

        if ($settings->maintenance_mode == 1 || $settings->app_maintenance_mode == 1) {
            return response()->json([
                'success' => true,
                'is_logged_in' => false,
                'user_exists' => true,
                'maintenance' => true,
                'message' => 'App is under maintenance.',
                'status' => 503
            ], 503);
        }

        return response()->json([
            'success' => true,
            'message' => 'User is logged in.',
            'is_logged_in' => true,
            'user_exists' => true,
            'user_blocked' => false,
            'user' => [
                'id' => $userData->id,
                'name' => $userData->name,
                'email' => $userData->email,
                'mobile' => $userData->mobile,
                'profile_image' => $userData->profile_image ?? '',
                'status' => $userData->status,
            ],
            'settings' => [
               // 'latest_version' => $settings->app_version,
                //'announcement' => $settings->site_description ?? '',
                'settings' => $settings,
            ],
            'status' => 200
        ]);

    } catch (\Exception $e) {
        \Log::error('CheckSession Error: ' . $e->getMessage());

        return response()->json([
            'success' => false,
            'message' => 'Internal server error. Please try again later.',
            'status' => 500
        ], 500);
    }
}



}