<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class AuthController extends ApiParentController
{
    public function test(){
        return $this->successResponse('works');
    }
    public function register(Request $request): JsonResponse
    {
        try {
            if (isset($request->birth_date)){
                $request->birth_date = date('Y-m-d', strtotime($request->birth_date));
            }
            //validation
            $validator = Validator::make($request->all(), $this->registerForm['rules'], $this->registerForm['messages']);
            if ($validator->fails()) {
                return $this->failedResponse(400, $validator->errors()->first());
            }
            //create a new user
            $user = User::create([
                'name' =>ucfirst($request->name),
                'gender' => $request->gender ?? null,
                'birth_date' => $request->birth_date ?? null,
                'phone' => $request->phone ,
                'otp' => 1234 //rand(1000,9999),
            ]);
            //create user token
            $token = $user->createToken($user->name . '-token')->plainTextToken;
            //send otp
            $msg = $user->otp . '%20is%20your%20Orders%20Maps%20verification%20code.Thanks';
            $this->sendSms($user->phone, $msg);
            //response
            $response = [
                'user' => $user,
                'token' => $token
            ];
            return $this->successResponse($response);
        } catch (\Exception $e) {
            return $this->failedResponse($e->getCode(), $e->getMessage());
        }
    }

    public function login(Request $request): JsonResponse
    {
        return $this->successResponse('works');
        try {
            //validation
            $validator = Validator::make($request->all(), ['phone' => 'required'], ['phone.required' => 'رقم الهاتف مطلوب']);
            if ($validator->fails()) {
                return $this->failedResponse(400, $validator->errors()->first());
            }
            $user = User::where('phone', $request->phone)->first();
            if ($user == null) {
                return $this->failedResponse(400, 'هذا الحساب غير موجود oop');
            }
            //create user token
            $token = $user->createToken($user->phone . '-token')->plainTextToken;
            //send otp
            $user->otp = 1234; //rand(1000,9999);
            $user->save();
            $msg = $user->otp . '%20is%20your%20Orders%20Maps%20verification%20code.Thanks';
            //response
            $response = [
                'user' => $user,
                'token' => $token
            ];
            return $this->successResponse($response);
        } catch (\Exception $e) {
            return $this->failedResponse($e->getCode(), $e->getMessage());
        }
    }

    private function sendSms($mobile, $message)
    {
        $senderID = 'Event';
        $url = 'https://smsmisr.com/api/webapi/?username=LHTGjbnB&password=ovknbTdrwK&language=1&sender=' . $senderID . '&mobile=' . $mobile . '&message=' . $message;
        $fields = [];
        $fields_string = '';
        foreach ($fields as $key => $value) {
            $fields_string .= $key . '=' . $value . '&';
        }
        rtrim($fields_string, '&');
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, count($fields));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        $result = curl_exec($ch);
        curl_close($ch);
    }

    public function resend(): JsonResponse
    {
        try {
            $user = User::findOrFail(Auth::id());
            $user->otp = 1234; //rand(1000,9999);
            if ($user->save()) {
                $msg = $user->otp . '%20is%20your%20Orders%20Maps%20verification%20code';
                //$this->sendSms($user->phone, $msg);
                return $this->successResponse('تم ارسال كود جديد');
            }
            return $this->failedResponse(400, 'حدث خطأ ما');
        } catch (\Exception $e) {
            return $this->failedResponse($e->getCode(), $e->getMessage());
        }
    }

    public function verify(Request $request): JsonResponse
    {
        //return $this->successResponse($request->all());
        try {
            $user = User::where(['id' => Auth::id(), 'otp' => $request->otp])->first();
            if (!$user) {
                return $this->failedResponse(400, 'هذا الكود غير صحيح');
            }
            return $this->successResponse('verified');
        } catch (\Exception $e) {
            return $this->failedResponse($e->getCode(), $e->getMessage());
        }
    }

    public function logout(): JsonResponse
    {
        try {
            \auth()->user()->tokens()->delete();
            return $this->successResponse('تم تسجيل الخروج');
        } catch (\Exception $e) {
            return $this->failedResponse($e->getCode(), $e->getMessage());
        }
    }

    public function storeFcmToken(Request $request): JsonResponse
    {
        try {
            if (empty($request->fcm_token)){
                return $this->failedResponse(400, 'invalid fcm token');
            }
            $user = User::findOrFail(Auth::id());
            $user->fcm_token = $request->fcm_token;
            $user->save();
            return $this->successResponse('تم تسجيل الرمز بنجاح');
        } catch (\Exception $e) {
            return $this->failedResponse($e->getCode(), $e->getMessage());
        }
    }

}
