<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class AuthController extends ApiParentController
{

    public function register(Request $request): JsonResponse
    {
        try {
            //validation
            $validator = Validator::make($request->all(), $this->registerForm['rules'], $this->registerForm['messages']);
            if ($validator->fails()) {
                return $this->failedResponse(400, $validator->errors()->first());
            }
            //create a new user
            $user = User::create([
                'name' =>ucfirst($request->name),
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'phone' => $request->phone,
                'is_merchant' => $request->is_merchant
            ]);
            //create user token
            $token = $user->createToken($user->name . '-token')->plainTextToken;
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

    public function logout(): JsonResponse
    {
        try {
            \auth()->user()->tokens()->delete();
            return $this->successResponse('تم تسجيل الخروج');
        } catch (\Exception $e) {
            return $this->failedResponse($e->getCode(), $e->getMessage());
        }
    }

}
