<?php

namespace App\Http\Traits;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

trait SaveImages{

    public function saveRequestFile(Model $model, Request $request, $store_path, $key){
        if($request->file($key)) {
            $fileName = time().'_'.$request->file($key)->getClientOriginalName();
            $filePath =$request->file($key)->storeAs($store_path, $fileName, 'public');
            $model->$key = $filePath;
        }
    }

}
