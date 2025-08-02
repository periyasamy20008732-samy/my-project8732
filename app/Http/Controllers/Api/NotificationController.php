<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Notification;

class NotificationController extends Controller
{
    //
    public function store(Request $request){
        $notification= Notification::create($request->all());
         return response()->json([
            'status' => 1,
            'message' => 'Notification created successfully',
            'data' => $notification
        ], 200);
    }
}