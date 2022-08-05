<?php

namespace App\Http\Controllers\Api;


use App\Models\Store;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class StoreController extends ApiParentController
{

    public function setStoreName(Request $request): JsonResponse
    {
        try {
            //validation
            $validator = Validator::make($request->all(), ['store_id' => 'required', 'store_name' => 'required']);
            if ($validator->fails()) {
                return $this->failedResponse(400, $validator->errors()->first());
            }
            //find the auth merchant store
            $store = Store::where(['merchant_id'=>Auth::id(),'id'=>$request->store_id])->first();
            if (empty($store)){
                return $this->failedResponse(400,'the merchant store is not found');
            }
            $store->name = $request->store_name;
            $store->save();
            return $this->successResponse('store name is updated successfully');
        } catch (\Exception $e) {
            return $this->failedResponse($e->getCode(), $e->getMessage());
        }
    }

    public function updateVatStatus(Request $request): JsonResponse
    {
        try {
            //validation
            $validator = Validator::make($request->all(), $this->vatStatusForm['rules'], $this->vatStatusForm['messages']);
            if ($validator->fails()) {
                return $this->failedResponse(400, $validator->errors()->first());
            }
            //find the auth merchant store
            $store = Store::where(['merchant_id'=>Auth::id(),'id'=>$request->store_id])->first();
            if (empty($store)){
                return $this->failedResponse(400,'the merchant store is not found');
            }
            $store->vat_included = $request->vat_included;
            $store->save();
            return $this->successResponse('vat status is updated successfully');
        } catch (\Exception $e) {
            return $this->failedResponse($e->getCode(), $e->getMessage());
        }
    }

    public function setShippingCost(Request $request): JsonResponse
    {
        try {
            //validation
            $validator = Validator::make($request->all(), ['store_id' => 'required', 'shipping_cost' => 'required|numeric']);
            if ($validator->fails()) {
                return $this->failedResponse(400, $validator->errors()->first());
            }
            //find the auth merchant store
            $store = Store::where(['merchant_id'=>Auth::id(),'id'=>$request->store_id])->first();
            if (empty($store)){
                return $this->failedResponse(400,'the merchant store is not found');
            }
            $store->shipping_cost = $request->shipping_cost;
            $store->save();
            return $this->successResponse('shipping cost is updated successfully');
        } catch (\Exception $e) {
            return $this->failedResponse($e->getCode(), $e->getMessage());
        }
    }

    public function setVatPercentage(Request $request): JsonResponse
    {
        try {
            //validation
            $validator = Validator::make($request->all(), ['store_id' => 'required', 'percentage' => 'required|numeric']);
            if ($validator->fails()) {
                return $this->failedResponse(400, $validator->errors()->first());
            }
            //find the auth merchant store
            $store = Store::where(['merchant_id'=>Auth::id(),'id'=>$request->store_id])->first();
            if (!empty($store)){
                if ($store->vat_included == 1){
                    return $this->failedResponse(400,'VAT is included in product prices by default');
                }
                $store->vat_percentage = $request->percentage;
                $store->save();
                return $this->successResponse('VAT percentage is updated successfully');
            }
            return $this->failedResponse(400,'the merchant store is not found');
        } catch (\Exception $e) {
            return $this->failedResponse($e->getCode(), $e->getMessage());
        }
    }

}
