<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Warehouse;
use App\Models\Store;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Supplier;
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

                $store = Store::create([
                    'user_id' => $result->id,
                    'store_name' => 'Default Store',
                ]);

                Warehouse::firstOrCreate(attributes: [
                    'user_id' => $result->id,
                    'store_id' => $store->id,
                    'warehouse_name' => 'Main Warehouse',
                ]);

                Brand::firstOrCreate([
                    'store_id' => $store->id,
                    'brand_name' => 'Default Brand',
                ]);

                Category::firstOrCreate([
                    'store_id' => $store->id,
                    'category_name' => 'Default Category',
                ]);

                Customer::firstOrCreate([
                    'user_id' => $result->id,
                    'store_id' => $store->id,
                    'customer_name' => 'Walking Customer',
                    //  'type' => 'walking',
                ]);

                Supplier::firstOrCreate([
                    //'user_id' => $result->id,
                    'store_id' => $store->id,
                    'supplier_name' => 'Default Supplier',
                ]);

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
                    'status' => true,
                    'message' => 'User Register Successfully',
                    'access_token' => $token,
                    'data' => $result,
                    'is_existing_user' => true
                ], 200);
            } else {
                return response()->json([

                    'message' => 'Internal server error',
                    'status' => false,
                ], 500);
            }
        }
    }


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
                    'status' => true,
                    'message' => 'User Login Successful.',
                    'access_token' => $token,
                    'data' => $user->toArray(),
                    'redirect_to' => '/user/home',
                    'is_existing_user' => true



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

        // Store OTP temporarily (in cache, not DB)
        cache()->put('otp_' . $request->mobile, [
            'otp' => $otp,
            'expires_at' => $expiresAt
        ], $expiresAt);

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

        $cached = cache()->get('otp_' . $request->mobile);

        if (!$cached || $cached['otp'] != $request->otp || now()->greaterThan($cached['expires_at'])) {
            return response()->json([
                'status' => false,
                'message' => 'Invalid or expired OTP.'
            ], 401);
        }

        // OTP is valid — now check if mobile exists in DB
        $user = User::where('mobile', $request->mobile)->first();

        // Clear OTP after use
        cache()->forget('otp_' . $request->mobile);

        if ($user) {
            // Generate login token
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
            // No user exists — redirect to registration
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
            $user = auth()->user(); // token-authenticated user


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

            if (!$user) {
                return response()->json([
                    'success' => false,
                    'is_logged_in' => false,
                    'user_exists' => false,
                    'message' => 'Session expired or invalid. Please login.',
                    'status' => 401,
                ], 401);
            }

            $userData = User::find($user->id);

            if (!$userData) {
                return response()->json([
                    'success' => false,
                    'is_logged_in' => false,
                    'user_exists' => false,
                    'message' => 'User does not exist.',
                    'status' => 404,
                ], 404);
            }

            if ($userData->is_blocked || $userData->status === 'inactive' || $userData->deleted_at) {
                return response()->json([
                    'success' => true,
                    'is_logged_in' => false,
                    'user_exists' => true,
                    'user_blocked' => true,
                    'message' => 'User is blocked or deactivated.',
                    'status' => 403,
                ], 403);
            }

            $settings = Settings::first();

            if ($settings && ($settings->maintenance_mode == 1 || $settings->app_maintenance_mode == 1)) {

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

                    'settings' => $settings,
                ],
                'status' => 200,
            ], 200);
        } catch (\Exception $e) {
            Log::error('CheckSession Error: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString(),
            ]);


            return response()->json([
                'success' => false,
                'message' => 'Internal server error. Please try again later.',
                'status' => 500
            ], 500);
        }
    }


    public function logout(Request $request)
    {
        // Revoke current token
        $request->user()->token()->revoke();

        return response()->json([
            'status' => true,
            'message' => 'Logged out successfully.'
        ]);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'password' => 'required|min:8|confirmed',
            'password_confirmation' => 'required'
        ]);

        $user = Auth::user(); // Authenticated user via token

        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'Unauthorized',
            ], 401);
        }

        $user->password = md5($request->password);
        $user->save();

        return response()->json([
            'status' => true,
            'message' => 'Password reset successfully.',
        ]);
    }


    public function getStoreUsers(Request $request)
    {
        $authUser = auth()->user();
        $storeId = $request->query('store_id');

        $finalUsers = collect();

        if ($storeId) {
            $storeId = trim($storeId);

            // Fetch store name
            $storeName = DB::table('store')
                ->where('id', $storeId)
                ->value('store_name');

            // Fetch users who belong to this store
            $storeUsers = DB::table('users')
                ->where('store_id', $storeId)
                ->get()
                ->map(function ($user) use ($storeName) {
                    $user->store_name = $storeName;
                    return $user;
                });

            // Fetch the store owner (user_id from store table)
            $storeOwnerId = DB::table('store')
                ->where('id', $storeId)
                ->value('user_id');

            if ($storeOwnerId) {
                $storeOwner = DB::table('users')->where('id', $storeOwnerId)->first();
                if ($storeOwner) {
                    $storeOwner->store_name = $storeName;
                    $finalUsers->push($storeOwner);
                }
            }

            $finalUsers = $finalUsers->merge($storeUsers)->unique('id')->values();
        } else {
            // Get all store IDs owned by this user
            $storeIds = DB::table('store')
                ->where('user_id', $authUser->id)
                ->pluck('id')
                ->toArray();

            if (empty($storeIds)) {
                return response()->json([
                    'message' => 'No stores found for this user',
                    'data' => [],
                    'total' => 0,
                    'status' => 0,
                ], 200);
            }

            // Get store names mapped by ID
            $stores = DB::table('store')
                ->whereIn('id', $storeIds)
                ->pluck('store_name', 'id'); // [id => store_name]

            // Get users who belong to these stores
            $storeUsers = DB::table('users')
                ->whereIn('store_id', $storeIds)
                ->get()
                ->map(function ($user) use ($stores) {
                    $user->store_name = $stores[$user->store_id] ?? null;
                    return $user;
                });

            $finalUsers = $storeUsers;
        }

        return response()->json([
            'message' => 'Store users fetched successfully',
            'data' => $finalUsers,
            'total' => $finalUsers->count(),
            'status' => 1,
        ], 200);
    }

}
