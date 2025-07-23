<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Settings;
use Illuminate\Support\Facades\Validator;

class SettingsController extends Controller
{
    public function settingshow(string $id)
    {
        $setting = Settings::find($id);

        if (!$setting) {
            return response()->json([
                'status'  => 0,
                'message' => 'Setting not found.',
                'data'    => null
            ], 404);
        }

        return response()->json([
            'status'  => 1,
            'message' => 'Setting retrieved successfully.',
            'data'    => $setting
        ], 200);
    }

    public function settingsupdate(Request $request, $id)
    {
        $settings = Settings::find($id);

        if (!$settings) {
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

        $data = $request->only($settings->getFillable());
        $settings->update($data);

        return response()->json([
            'status'  => true,
            'message' => 'Data updated successfully.',
            'data'    => $settings
        ]);
    }
}