<?php

return [

    'authLoginForm' => [
        'rules' => [
            'email' => 'required|email',
            'password' => 'required|min:5',
        ],
        'messages' => [
            'email.required' =>'test',
            'email.email' =>'test',

        ]/*'messages' => [
            'email.required' => __('The email field is required.'),
            'email.email' => __('The email field must be in email format.'),
            'password.required' => __('The password field is required.'),
            'password.min:5' => __('The password field must be at least 5 characters.'),
        ]*/
    ],

];
