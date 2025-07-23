<?php
// Resusable helper functions

use Illuminate\Support\Str;


// Reusable API response function

function apiResponseWithStatusCode($data, $status, $message, $user, $statusCode)
{
    $response = [];
    $response['status'] = $status;
    $response['message'] = $message;
    if ($user) {
        $response['user'] = $user;
    }
    $response['data'] = $data;
    return  response()->json($response, $statusCode);
}

// for service response
function apiServiceResponse($data, $status, $message)
{
    return (object)[
        'status' => $status,
        'message' => $message,
        'data' => $data
    ];
}

// generate key for system use
function generateQuoteKey($perfix): string
{
    return $perfix . Str::random(10);
}
