<?php

namespace App\Http\Traits;


trait ApiValidation
{
    public $storeProductForm = [
        'rules' => [
            'name' => 'required|min:3',
            'desc' => 'required',
            'price' => 'required|numeric',
            'seller_phone' => 'required|numeric',
            'owner_id' => 'required|numeric',
            'category_id' => 'required|numeric'
        ],
        'messages' => [
            'name.required' => 'اسم المنتج مطلوب',
            'desc.required' => 'تفاصيل المنتج مطلوب',
            'name.min' => 'الاسم المطلوب لابد ان يكون اكثر من 3 احرف',
            'seller_phone.required' => 'رقم الهاتف مطلوب',
            'price.required' => 'سعر المنتج مطلوب',
            'price.numeric' => 'السعر لابد ان يكون ارقام',
            'seller_phone.numeric' => 'الهاتف لابد ان يكون ارقام',
            'owner_id.required' => 'صاحب المنتج مطلوب',
            'category_id.required' => 'تصنيف المنتج مطلوب',
        ]
    ];
    public $updateProfileForm = [
        'rules' => [
            'name' => 'required|min:3',
            'email' => 'required',
            'phone' => 'required|numeric',
            'birth_date' => 'required|date'
        ],
        'messages' => [
            'name.required' => 'اسم المستخدم مطلوب',
            'name.min' => 'الاسم المطلوب لابد ان يكون اكثر من 3 احرف',
            'phone.required' => 'رقم الهاتف مطلوب',
            'email.required' => 'البريد الإلكتروني مطلوب',
            'email.unique' => 'البريد الالكتروني موجود بالفعل',
            'phone.unique' => 'رقم الهاتف موجود بالفعل',
            'birth_date.required' => 'تاريخ ميلاد المستخدم مطلوب',
            'phone.numeric' => 'الهاتف لابد ان يكون ارقام',
            'birth_date.date' => 'تاريخ الميلاد لابد ان يكون بصيغة التاريخ',
        ]
    ];
    public $registerForm = [
        'rules' => [
            'name' => 'required|min:3',
            'phone' => 'required|numeric|unique:users,phone',
        ],
        'messages' => [
            'name.required' => 'اسم المستخدم مطلوب',
            'name.min' => 'الاسم المطلوب لابد ان يكون اكثر من 3 احرف',
            'phone.required' => 'رقم الهاتف مطلوب',
            'phone.unique' => 'رقم الهاتف موجود بالفعل',
            'phone.numeric' => 'الهاتف لابد ان يكون ارقام',
        ]
    ];
    public $addressForm = [
        'rules' => [
            'address_id' => 'filled|numeric',
            'title' => 'required|min:3',
            'address_type' => 'required',
            'city' => 'required',
            'street' => 'required'
        ],
        'messages' => [
            'title.required' => 'اسم العنوان مطلوب',
            'title.min' => 'العنوان لابد ان يكون اكثر من 3 احرف',
            'address_type.required' => 'تصنيف العنوان مطلوب',
            'city.required' => 'المدية مطلوبة',
            'street.required' => 'اسم المنطقة او الشارع مطلوب',
        ]
    ];
    public $addRatingForm = [
        'rules' => [
            'provider_id' => 'required|numeric',
            'desc' => 'required|min:3',
            'value' => 'required|numeric'
        ],
        'messages' => [
            'desc.required' => 'من فضلك ادخل  تفاصيل التقييم',
            'desc.min' => 'تفاصيل التقييم لابد ان تكون اكثر من 3 احرف',
            'value.required' => 'من فضلك ادخل  قيمة التقييم',
            'value.numeric' => 'قيمة التقييم لابد ان تكون رقم',
        ]
    ];
}
