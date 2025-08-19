<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BusinessProfile;
use Illuminate\Support\Facades\Validator;

class BusinessProfileController extends Controller
{

    public function store(Request $request)
    {
        $request->validate([
            'profileImagePath' => 'sometimes|file|image|max:2048',
            'signatureImagePath' => 'sometimes|file|image|max:2048'
        ]);

        $file = $request->file('profileImagePath');
        $directory = 'storage/public/profile/';
        $imageName = time() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path($directory), $imageName);

        $file1 = $request->file('signatureImagePath');
        $directory1 = 'storage/public/profile/';
        $imageName1 = time() . '.' . $file1->getClientOriginalExtension();
        $file1->move(public_path($directory1), $imageName1);

        $data = $request->all();
        $data['profileImagePath'] = $directory . $imageName;
        $data['signatureImagePath'] = $directory1 . $imageName1;
        $data['user_id'] = auth()->id();
        $data['store_id'] = auth()->user()->store_id;


        //  $store = Store::create($request->all());
        $profile = BusinessProfile::create($data);

        return response()->json([
            'status' => 1,
            'message' => 'Business Profile created successfully',
            'data' => $profile
        ], 200);
    }


    public function profileshow()
    {
        try {
            $user = auth()->user();

            $invoicesettings = BusinessProfile::where('user_id', $user->id)->get();


            return response()->json([
                'message' => 'BusinessProfile Detail Fetch Successfully',
                'status' => 1,
                'data' => $invoicesettings
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 0,
                'message' => 'Failed to retrieve BusinessProfile: Unauthorozied or data not found',
            ], 500);
        }
    }

    public function profileupdate(Request $request, $id)
    {
        $profile = BusinessProfile::find($id);

        if (!$profile) {
            return response()->json([
                'status'  => false,
                'message' => 'Data not found.'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'bussiness_name' => 'required|string|max:255',
            'email'         => 'nullable|email',
            'phone'         => 'nullable|string|max:20',
            'address'       => 'nullable|string|max:500',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status'  => false,
                'message' => 'Validation failed',
                'errors'  => $validator->errors()
            ], 422);
        }

        $data = $request->only($profile->getFillable());
        $profile->update($data);
        $profile->refresh();

        return response()->json([
            'status'  => true,
            'message' => 'Business Profile updated successfully.',
            'data'    => $profile
        ], 200);
    }
}
