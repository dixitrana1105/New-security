<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ApiFaceScanController extends Controller
{
    /**
     * Handle the face scan request.
     */
    // public function faceScan(Request $request)
    // {

    //     // dd($request->all());
    //     $validator = Validator::make($request->all(), [
    //         'building_id' => 'required',
    //         'building_type' => 'required',
    //         'file' => 'required|file',
    //     ]);

    //     if ($validator->fails()) {
    //         return response()->json([
    //             'status' => 'error',
    //             'errors' => $validator->errors()
    //         ], 422);
    //     }

    //     $request = [
    //         'building_id' => $request->input('building_id'),
    //         'building_type' => $request->input('building_type'),
    //         'file' => $request->file('file'),
    //     ];

    //     $response = app(\App\Http\Controllers\Api::class)->controller_detect_face($request);

    //     return $response;
    // }

    public function faceScan(Request $request)
{
    $validator = Validator::make($request->all(), [
        'building_id' => 'required',
        'building_type' => 'required',
        'file' => 'required|file',
    ]);

    if ($validator->fails()) {
        return response()->json([
            'status' => 'error',
            'errors' => $validator->errors()
        ], 422);
    }

    // Directly pass the request object
    $response = app(\App\Http\Controllers\Api::class)->controller_detect_face($request);

    return $response;
}


public function handleVisitorData($visitorData)
{
    
    // dd($visitorData);
    \Log::info('Received Visitor Data: ', $visitorData);

    // You can also return a response if needed
    return response()->json([
        'status' => 'success',
        'message' => 'Visitor data processed successfully.',
    ]);
}


}
