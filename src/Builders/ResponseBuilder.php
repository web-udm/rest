<?php

namespace App\Builders;

use App\Entities\EntitiesCollection;
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

    /**
     * @param int $code
     * @param string $message
     * @param string $type
     * @param array $headers
     * @return BaseResponse
     * @throws \Exception
     */
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

    /**
     * @param EntityInterface $entity
     * @param string $type
     * @param int $code
     * @param string $message
     * @param array $headers
     * @return EntityResponse
     * @throws \Exception
     */
    public function createEntityResponse(
        EntityInterface $entity,
        string $type = 'json',
        int $code = 200,
        string $message = "User successfully fetched",
        array $headers = []
    ): EntityResponse {
        $content = $this->serialize([
            'code' => $code,
            'message' => $message,
            'entity' => $entity->toArray()
        ], $type);
        $headers = array_merge($headers, $this->getContentType($type));

        return new EntityResponse($content, $code, $headers);
    }

    /**
     * @param EntitiesCollection $entities
     * @param array $metadata
     * @param string $type
     * @param int $code
     * @param string $message
     * @param array $headers
     * @return EntitiesResponse
     * @throws \Exception
     */
    public function createEntitiesResponse(
        EntitiesCollection $entities,
        array $metadata = [],
        string $type = 'json',
        int $code = 200,
        string $message = "Users successfully fetched",
        array $headers = []
    ): EntitiesResponse {
        $entitiesArray = array_reduce($entities->all(), function (array $carry, EntityInterface $item) {
            $carry[] = $item->toArray();
            return $carry;
        }, []);

        $content = $this->serialize([
            'code' => $code,
            'message' => $message,
            'meta' => $metadata,
            'entities' => $entitiesArray
        ], $type);

        $headers = array_merge($headers, $this->getContentType($type));

        return new EntitiesResponse($content, $code, $headers);
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
