<?php

namespace App\Http\Traits;


trait ApiValidation
{
    public $registerForm = [
        'rules' =>[
            'name' => 'required|min:2',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|min:4|unique:users,phone',
            'password' => 'required|confirmed|min:5',
            'is_merchant' => 'required|numeric|max:1',
        ],
        'messages'=>[
            'is_merchant.required' => 'The is_merchant field is required',
            'is_merchant.*' => 'The is_merchant value must be 0 or 1',
        ]
    ];

    public $loginForm = [
        'rules' =>[
            'email' => 'required|email',
            'password' => 'required|min:5',
        ]
    ];

    public $vatStatusForm = [
        'rules' =>[
            'store_id' => 'required',
            'vat_included' => 'required|numeric|max:1',
        ],
        'messages'=>[
            'vat_included.*' => 'The vat_included value must be 0 or 1',
        ]
    ];

    public $addProductForm = [
        'rules' =>[
            'name' => 'required|min:2',
            'desc' => 'required',
            'quantity' => 'required|numeric',
            'price' => 'required|numeric',
        ]
    ];

    public $addMultiLangProductForm = [
        'rules' =>[
            'product_id' => 'required',
            'locale' => 'required',
            'attribute' => 'required',
            'value' => 'required',
        ]
    ];
}
