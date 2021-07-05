<?php

namespace App\Builders;

use App\Entities\EntityInterface;
use App\Responses\BaseResponse;
use App\Responses\EntitiesResponse;
use App\Responses\EntityResponse;

class ResponseBuilder
{
    private const CONTENT_TYPES = [
        'json' => ['Content-type' => 'text/json'],
        'xml' => ['Content-type' => 'text/xml']
    ];

    public function createBaseResponse(
        int $code,
        string $message,
        string $type = 'json',
        array $headers = []
    ): BaseResponse {
        $content = $this->serialize(['code' => $code, 'message' => $message], $type);
        $headers = array_merge($headers, $this->getContentType($type));

        return new BaseResponse($content, $code, $headers);
    }

    public function createEntityResponse(
        EntityInterface $entity,
        int $code = 200,
        string $message = "User successfully fetched",
        string $type = 'json',
        array $headers = ['Content-Type' => 'application/json']
    ): EntityResponse {
        $content = $this->serialize([
            'code' => $code,
            'message' => $message,
            'entity' => $entity->toArray()
        ], $type);
        $headers = array_merge($headers, $this->getContentType($type));

        return new EntityResponse($content, $code, $headers);
    }

    public function createEntitiesResponse(
        EntityInterface $entities,
        array $metadata,
        int $code = 200,
        string $message = "Users successfully fetched",
        string $type = 'json',
        array $headers = ['Content-Type' => 'application/json']
    ): EntitiesResponse {

    }

    private function serialize(array $data, string $type): string
    {
        $serializerName = '\App\Serializers\\' . ucfirst($type) . 'Serializer';

        if (class_exists($serializerName)) {
            return (new $serializerName())->serialize($data);
        }

        throw new \Exception("Для типа $type не найден подходящий сериалайзер");
    }

    private function getContentType(string $type): array
    {
        return self::CONTENT_TYPES[$type] ?: [];
    }
}