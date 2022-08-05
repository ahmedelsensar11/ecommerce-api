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
            //create user api token
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
        try {
            //validation
            $validator = Validator::make($request->all(), $this->loginForm['rules']);
            if ($validator->fails()) {
                return $this->failedResponse(400, $validator->errors()->first());
            }
            //check credentials
            $credentials = ['email' => $request->email, 'password' => $request->password];
            if (Auth::attempt($credentials)) {
                //create user api token
                $token = Auth::user()->createToken($request->email . '-token')->plainTextToken;
                //response
                $response = [
                    'user' => Auth::user(),
                    'token' => $token
                ];
                return $this->successResponse($response);
            }
             return $this->failedResponse(400,'The provided credentials do not match our records.');

        } catch (\Exception $e) {
            return $this->failedResponse($e->getCode(), $e->getMessage());
        }
    }

    public function logout(): JsonResponse
    {
        try {
            \auth()->user()->tokens()->delete();
            return $this->successResponse('logged out');
        } catch (\Exception $e) {
            return $this->failedResponse($e->getCode(), $e->getMessage());
        }
    }

}
