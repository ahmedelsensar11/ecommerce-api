<?php
namespace App\Http\Traits;


use Illuminate\Http\JsonResponse;

trait ApiResponse {

    public function successResponse($data): JsonResponse
    {
        return response()->json([
            'status_msg'=>'success',
            'status_code'=>200,
            'data'=>$data
        ],200);
    }


    public function failedResponse($status_code, $data): JsonResponse
    {
        return response()->json([
            'status_msg'=>'failed',
            'status_code'=>$status_code,
            'data'=>$data
        ],400);
    }

}
