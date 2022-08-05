<?php
namespace App\Http\Traits;


use Illuminate\Http\JsonResponse;

trait ApiResponse {

    public function successResponse($data): JsonResponse
    {
        return response()->json([
            'status'=>'success',
            'code'=>200,
            'data'=>$data
        ],200);
    }


    public function failedResponse($status_code, $data): JsonResponse
    {
        return response()->json([
            'status'=>'failed',
            'code'=>$status_code,
            'data'=>$data
        ],400);
    }

}
