<?php

namespace App\Http\Controllers\ApiControllers;

use App\Http\Controllers\Api\BaseController;
use Illuminate\Http\Request;

class ApiRequestTest extends BaseController {
    public function post(Request $request){
        return $this->sendResponse(200, $request->all());
    }
}