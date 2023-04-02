<?php

namespace App\Helpers;

class Response
{
    static function json($status, $message, $data = [])
    {
        return response()->json([
            'status_bool' => $status == 200 || $status == 201 ? true : false,
            'status_code' => $status,
            'message' => $message,
            'data' => $data
        ], $status);
    }
}
