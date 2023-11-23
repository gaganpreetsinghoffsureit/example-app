<?php

namespace App\Helpers;


final class ResponseHelper
{
    /**
     * Success Response Class that use in every success API 
     *
     **/
    public static function success(string $message, $result)
    {
        return response()->json(
            [
                'success' => true,
                'message' => $message,
                'data' => $result
            ],
            200
        );
    }


    /**
     * Error Response Class that use in every Error API 
     *
     **/
    public static function error(string $message, $result, $status = 400)
    {
        return response()->json(
            [
                'success' => false,
                'message' => $message,
                'data' => $result
            ],
            $status
        );
    }
}
