<?php

namespace AchyutN\Controller;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;

class ApiBaseController extends Controller
{
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
