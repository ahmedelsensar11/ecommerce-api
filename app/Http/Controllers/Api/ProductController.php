<?php

namespace App\Http\Controllers\Api;


use App\Models\Product;
use App\Models\ProductLocalization;
use App\Models\Store;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class ProductController extends ApiParentController
{
    public function addProduct(Request $request): JsonResponse
    {
        try {
            //validation
            $validator = Validator::make($request->all(), $this->addProductForm['rules']);
            if ($validator->fails()) {
                return $this->failedResponse(400, $validator->errors()->first());
            }
            //find the auth merchant store
            $store = Store::where(['merchant_id'=>Auth::id()])->first();
            if (!empty($store)){
                $product = new Product();
                $product->name = $request->name;
                $product->desc = $request->desc;
                $product->price = $request->price;
                $product->store_id = $store->id;
                $product->quantity = $request->quantity;
                $product->save();
                return $this->successResponse('A new product added successfully');
            }
            return $this->failedResponse(400,'the merchant store is not found');
        } catch (\Exception $e) {
            return $this->failedResponse($e->getCode(), $e->getMessage());
        }
    }

    public function addMultiLangProductDetails(Request $request): JsonResponse
    {
        try {
            //validation
            $validator = Validator::make($request->all(), $this->addMultiLangProductForm['rules']);
            if ($validator->fails()) {
                return $this->failedResponse(400, $validator->errors()->first());
            }
            //insert data
            $productLocale = new ProductLocalization();
            $productLocale->product_id = $request->product_id;
            $productLocale->locale = $request->locale;
            $productLocale->attribute = $request->attribute;
            $productLocale->value = $request->value;
            $productLocale->save();
            return $this->successResponse('success');
        } catch (\Exception $e) {
            return $this->failedResponse($e->getCode(), $e->getMessage());
        }
    }

}
