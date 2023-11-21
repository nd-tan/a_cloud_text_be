<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function responseSuccess($data, $httpStatusCode = 200)
    {
        return response()->json(
            [
                'data' => $data,
                'status' => $httpStatusCode
            ],
            $httpStatusCode
        );
    }

    public function responseError($error, $httpStatusCode = 400)
    {
        return response()->json(
            [
                'error' => $error,
                'status' => $httpStatusCode
            ],
            $httpStatusCode
        );
    }
}
