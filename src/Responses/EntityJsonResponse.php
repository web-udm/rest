<?php

namespace App\Responses;

use App\Entities\EntityInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

class EntityJsonResponse extends JsonResponse
{
    /**
     * @param EntityInterface $entity
     * @param string          $status
     * @param string          $message
     * @param array           $headers
     */
    public function __construct(EntityInterface $entity, string $status, string $message, array $headers = [])
    {
        $arrayData = array_merge(
            ['code' => $status,],
            ['message' => $message],
            ['entity' => $entity->toArray()]
        );

        parent::__construct($arrayData, $status, $headers);
    }
}
