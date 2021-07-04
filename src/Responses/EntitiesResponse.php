<?php

namespace App\Responses;

use App\Entities\EntityInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

class EntitiesJsonResponse extends JsonResponse
{
    /**
     * @param EntityInterface[] $entities
     */
    public function __construct(array $entities, string $status, string $message, array $metaData, array $headers = [])
    {
        $entitiesArray = array_reduce($entities, function(array $carry, EntityInterface $item) {
            return array_merge($carry, $item->toArray());
        }, []);

        $arrayData = array_merge(
            ['code' => $status,],
            ['message' => $message],
            ['meta' => $metaData],
            ['entities' => $entitiesArray]
        );

        parent::__construct($arrayData, $status, $headers);
    }
}