<?php

namespace AchyutN\LaravelHelpers\Controller;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Log;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;

class ApiBaseController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
    public function api_success($data,$message)
    {
        return response()->json([
            'status' => 200,
            'data' => $data,
            'message' => $message
        ], 200);
    }

    public function api_error($data)
    {
        Log::error($data);
        return response()->json([
            'status' => $data->getCode(),
            'data' => [],
            'message' => $data->getMessage()
        ], $data->getCode());
    }
}
