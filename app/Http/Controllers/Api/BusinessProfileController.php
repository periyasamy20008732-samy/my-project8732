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


      //  $store = Store::create($request->all());
        $profile = BusinessProfile::create($data);

        return response()->json([
            'status' => 1,
            'message' => 'Business Profile created successfully',
            'data' => $profile
        ], 200);
    }

    
    public function profileshow(string $id)
    {
        $profile = BusinessProfile::find($id);

        if (!$profile) {
            return response()->json([
                'status'  => 0,
                'message' => 'Business Profile not found.',
                'data'    => null
            ], 404);
        }

        return response()->json([
            'status'  => 1,
            'message' => 'Business Profile retrieved successfully.',
            'data'    => $profile
        ], 200);
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

        // Define your validation rules here
        $validator = Validator::make($request->all(), [
            // Replace with actual fields you expect to update
           
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

        return response()->json([
            'status'  => true,
            'message' => 'Business Profile updated successfully.',
            'data'    => $profile
        ]);
    }
}