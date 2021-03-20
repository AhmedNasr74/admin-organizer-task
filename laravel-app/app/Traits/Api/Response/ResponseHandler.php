<?php

namespace App\Traits\Api\Response;



trait ResponseHandler {

    public function responseError($msg = "Bad Request" , $statusCode = 400)
    {

        return response()->json([
            'success' =>false,
            'message' => $msg,
            'data' => (object)[],
        ] , $statusCode);
    }
    public function responseSuccess($msg = "successful" , $statusCode = 200)
    {

        return response()->json([
            'success' =>true,
            'message' => $msg,
            'data' => (object)[],
        ] , $statusCode);
    }
    public function responseData($value , $msg = "successful" , $statusCode = 200)
    {
        return response()->json([
            'success' => $statusCode == 200,
            'message' => $msg,
            'data' => $value
        ] , $statusCode);
    }
}
