<?php

namespace App\Builders;

use App\Entities\EntityInterface;

class ResponseBuilder
{
    public function createBaseResponse(
        int $code,
        string $message,
        string $type = 'json',
        array $headers = []
    ): BaseResponse {

    }

    public function createEntityResponse(
        int $code,
        string $message,
        EntityInterface $entity,
        string $type = 'json',
        array $headers = []
    ) {

    }

    public function createEntitiesResponse(
        int $code,
        string $message,
        EntityInterface $entities,
        array $metadata,
        string $type = 'json',
        array $headers = []
    ) {

    }
}