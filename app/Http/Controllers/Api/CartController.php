<?php

namespace App\Http\Controllers\Api;

use App\Models\Product;
use App\Models\Store;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class CartController extends ApiParentController
{

    // please note that the request will be in json format (array of objects)
    // each object will contain the product id and quantity
    //EX: [{"product_id":2 , "quantity":1},{"product_id":3 , "quantity":2}]
    //note : the product quantity will not decrease after calculate the cart
    public function calcInvoice(Request $request): JsonResponse
    {
        try {
            //validation
            if (!is_array($request->all())){
                return $this->failedResponse(400,'request must be in array of objects');
            }
            $product_prices = 0 ;
            $total_product_VAT = 0 ;
            $store_IDs = [];
            foreach ($request->all() as $item){
                $item  = (array) $item;
                //validation
                $validator = Validator::make($item, ['product_id' => 'required', 'quantity' => 'required|numeric|min:1']);
                if ($validator->fails()) {
                    return $this->failedResponse(400, $validator->errors()->first());
                }
                //get product
                $product = Product::findOrFail($item['product_id']);
                //check product availability
                if (!$product->available || $item['quantity'] > $product->quantity){
                    return $this->failedResponse(400,'Unavailable quantity for '.$product->name.' at this time!');
                }
                //calc prices
                $product_prices += $this->getProductPrice($product, $item['quantity']);
                //calc vat
                $total_product_VAT += $this->getProductVAT($product, $item['quantity']);
                //save store_id in storeIDs array
                if (!in_array($product->store->id, $store_IDs)){
                    $store_IDs[] = $product->store->id;
                }
            }
            //calc shipping cost
            $shipping_cost = $this->getShippingCost($store_IDs);
            $invoice_details = $this->getInvoiceDetails($product_prices, $total_product_VAT, $shipping_cost);
            return $this->successResponse($invoice_details);
        } catch (\Exception $e) {
            return $this->failedResponse($e->getCode(), $e->getMessage());
        }
    }

    public function getProductPrice(Product $product, $quantity):float
    {
        return $product->price * $quantity;
    }

    public function getProductVAT(Product $product, $quantity):float
    {
        if (!$product->store->vat_included){
            $product_vat_percent = $product->store->vat_percentage / 100 ;
            $product_vat = $product_vat_percent * $product->price;
            return round($quantity * $product_vat,2);
        }
        return 0;
    }

    public function getShippingCost(Array $store_IDs):float
    {
        $shipping_cost = 0;
        foreach ($store_IDs as $store_id){
            $store = Store::findOrFail($store_id);
            $shipping_cost += $store->shipping_cost;
        }
        return $shipping_cost;
    }

    public function getInvoiceDetails($product_prices, $product_VATs, $shipping_costs): array
    {
        $invoice_details = [];
        $total_cost = $product_prices + $product_VATs + $shipping_costs;
        $invoice_details['Product Prices'] = $product_prices;
        $invoice_details['VAT'] = $product_VATs;
        $invoice_details['Total Shipping Cost'] = $shipping_costs;
        $invoice_details['Total Cost'] = round($total_cost,2);
        return $invoice_details ;
    }

}
