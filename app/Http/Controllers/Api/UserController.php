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
use App\Models\InvoiceSettings;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Services\SmsService;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

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
                'status' => 'active',
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
                $lastInvoiceNo = InvoiceSettings::max('start_number') ?? 0;
                $nextInvoiceNo = $lastInvoiceNo + 1;

                $start_number = str_pad($nextInvoiceNo, 3, '0', STR_PAD_LEFT);
                InvoiceSettings::firstOrCreate([
                    'user_id' => $result->id,
                    'store_id' => $store->id,
                    'start_number' => $start_number,
                    'business_name' => 'Default Bussiness',
                    'invoice_notes' => 'Default Invoice'

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

                $user = User::with(['userLevel'])->find($result->id);

                return response()->json([
                    'status' => true,
                    'message' => 'User Register Successfully',
                    'access_token' => $token,
                    'token_type' => 'Bearer',
                    'expires_in' => 3600,
                    'data' => $user,
                    'redirect_to' => '/homepage',
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
                    'status' => true,
                    'message' => 'User Login Successful.',
                    'access_token' => $token,
                    'token_type' => 'Bearer',
                    'expires_in' => 3600,
                    'data' => $user,
                    'redirect_to' => '/homepage',
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
        try {
            $request->validate([
                'mobile' => 'required',
                'country_code' => 'required|string',
                'otp' => 'required'
            ]);


            $mobile = $request->mobile;
            $cacheKey = 'otp_' . $mobile;
            $cached = cache()->get($cacheKey);

            // Check if OTP exists, matches, and is not expired
            if (!$cached) {
                return response()->json([
                    'status' => false,
                    'message' => 'OTP not found. Please request a new OTP.',
                    'errors' => ['otp' => ['OTP has expired or not been generated']]
                ], 400);
            }

            if ($cached['otp'] != $request->otp) {
                return response()->json([
                    'status' => false,
                    'message' => 'Invalid OTP entered.',
                    'errors' => ['otp' => ['The OTP code is incorrect']]
                ], 401);
            }

            if (now()->greaterThan($cached['expires_at'])) {
                cache()->forget($cacheKey); // Clean up expired OTP
                return response()->json([
                    'status' => false,
                    'message' => 'OTP has expired. Please request a new one.',
                    'errors' => ['otp' => ['OTP has expired']]
                ], 401);
            }

            // OTP is valid — now check if mobile exists in DB
            $user = User::where('mobile', $mobile)->first();

            // Clear OTP after successful verification
            cache()->forget($cacheKey);

            if ($user) {
                // Check if user is active
                if ($user->status != 'active') {
                    return response()->json([
                        'status' => false,
                        'message' => 'Your account is not active. Please contact support.',
                        'errors' => ['account' => ['User account is inactive']]
                    ], 403);
                }

                // Generate login token
                $token = $user->createToken('access_token')->accessToken;

                return response()->json([
                    'status' => true,
                    'message' => 'OTP verified successfully. Login successful.',
                    'access_token' => $token,
                    'token_type' => 'Bearer',
                    'expires_in' => 3600, // 1 hour in seconds
                    'data' => $user,
                    'redirect_to' => '/homepage',
                    'is_existing_user' => true
                ], 200);
            } else {
                // No user exists — redirect to registration
                return response()->json([
                    'status' => true,
                    'message' => 'OTP verified successfully. Please complete your registration.',
                    'redirect_to' => '/register',
                    'is_existing_user' => false,
                    'mobile' => $mobile // Include mobile for registration form
                ], 200);
            }
        } catch (ValidationException $e) {
            // Handle validation errors
            return response()->json([
                'status' => false,
                'message' => 'Validation failed.',
                'errors' => $e->errors()
            ], 422);
        } catch (Exception $e) {
            // Log the error for debugging
            Log::error('OTP Verification Error: ' . $e->getMessage(), [
                'mobile' => $request->mobile ?? 'unknown',
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'status' => false,
                'message' => 'An unexpected error occurred. Please try again.',
                'error' => config('app.debug') ? $e->getMessage() : 'Server error'
            ], 500);
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
                    'status' => 503,
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
                'status' => 500,
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
            // Get store names maped by ID
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
