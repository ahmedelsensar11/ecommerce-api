<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Traits\ApiResponse;
use App\Http\Traits\ApiValidation;
use App\Http\Traits\SaveImages;


class ApiParentController extends Controller
{
    use ApiResponse, ApiValidation, SaveImages;

}
