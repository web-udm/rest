<?php

namespace App\Builders;

use App\Entities\EntityInterface;
use App\Responses\BaseResponse;

class ResponseBuilder
{
    public function createBaseResponse(
        int $code,
        string $message,
        string $type = 'json',
        array $headers = []
    ) {
        $content = $this->serialize([
            'code' => $code,
            'message' => $message
        ], $type);

        $headers = array_merge($headers, $this->getContentType($type));

        return new BaseResponse($content, $code, $headers);
    }

    public function createEntityResponse(
        EntityInterface $entity,
        int $code = 200,
        string $message = "User successfully fetched",
        string $type = 'json',
        array $headers = ['Content-Type' => 'application/json']
    ) {

    }

    public function createEntitiesResponse(
        EntityInterface $entities,
        array $metadata,
        int $code = 200,
        string $message = "Users successfully fetched",
        string $type = 'json',
        array $headers = ['Content-Type' => 'application/json']
    ) {

    }

    private function serialize(array $data, string $type)
    {
        $serializerName = "\App\Serializers\{$type}Serializer";

        if (class_exists($serializerName)) {
            return $serializerName->serialize($data);
        }

        throw new \Exception("Для типа $type не найден подходящий сериалайзер");
    }

    private function getContentType(string $type)
    {

    }
}