<?php

namespace App\Responses;

use Symfony\Component\HttpFoundation\JsonResponse;

class ErrorJsonResponse extends JsonResponse
{
    /**
     * ErrorJsonResponse constructor.
     *
     * @param string $status
     * @param string $message
     * @param array  $headers
     */
    public function __construct(string $status, string $message, array $headers = [])
    {
        $arrayData = array_merge(
            ['code' => $status,],
            ['message' => $message],
        );

        parent::__construct($arrayData, $status, $headers);
    }
}
