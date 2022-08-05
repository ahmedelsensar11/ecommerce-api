<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class MerchantUser{

    /**
     * Handle an incoming request.
     *
     * @param  Request  $request
     * @param  Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     *
     */
    public function handle(Request $request, Closure $next)
    {
        //if not merchant user
        if (Auth::user()->is_merchant != 1){
            return \response()->json([
                'status'=>'failed',
                'code'=>407,
                'data'=>'Only merchants can perform this request!'
            ],407);
        }
        return $next($request);
    }
}
