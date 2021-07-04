<?php

namespace App\Responses;

use Symfony\Component\HttpFoundation\JsonResponse;

class ErrorResponse extends JsonResponse
{
    public function __construct(string $status, string $message, array $headers = [])
    {
        $arrayData = array_merge(
            ['code' => $status,],
            ['message' => $message],
        );

        parent::__construct($arrayData, $status, $headers);
    }
}