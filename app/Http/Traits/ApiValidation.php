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

}
