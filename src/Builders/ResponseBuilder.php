<?php

namespace App\Builders;

use App\Entities\EntitiesMetaData;
use App\Entities\EntityCollection;
use App\Exceptions\UnknownSerializerType;
use App\HeadersFactory\Base\HeadersFactoryInterface;
use App\Entities\Entity;
use App\SerializerFactory\Base\SerializerFactoryInterface;
use App\Serializers\Serializer;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class ResponseBuilder
 * @package App\Builders
 */
class ResponseBuilder
{
    private const DEFAULT_RESPONSE_TYPE = 'json';

    private Serializer                 $serializer;
    private SerializerFactoryInterface $serializerFactory;
    private HeadersFactoryInterface    $headersFactory;
    private array                      $headers;

    /**
     * ResponseBuilder constructor.
     *
     * @param SerializerFactoryInterface $serializerFactory
     * @param HeadersFactoryInterface    $headersFactory
     *
     * @throws UnknownSerializerType
     */
    public function __construct(SerializerFactoryInterface $serializerFactory, HeadersFactoryInterface $headersFactory)
    {
        $this->serializerFactory = $serializerFactory;
        $this->headersFactory    = $headersFactory;

        $this->headers    = $this->headersFactory->create(self::DEFAULT_RESPONSE_TYPE);
        $this->serializer = $this->serializerFactory->create(self::DEFAULT_RESPONSE_TYPE);
    }

    /**
     * @param string $responseType
     *
     * @return $this
     * @throws UnknownSerializerType
     */
    public function setResponseType(string $responseType): self
    {
        $this->headers    = $this->headersFactory->create($responseType);
        $this->serializer = $this->serializerFactory->create($responseType);

        return $this;
    }

    /**
     * @param int    $code
     * @param string $message
     *
     * @return Response
     */
    public function createBaseResponse(int $code, string $message): Response
    {
        $content = $this->serializer->serialize([
            'code'    => $code,
            'message' => $message,
        ]);

        return new Response($content, $code, $this->headers);
    }

    /**
     * @param Entity $entity
     * @param int    $code
     * @param string $message
     *
     * @return Response
     */
    public function createEntityResponse(Entity $entity, int $code, string $message): Response
    {
        $content = $this->serializer->serialize([
            'code'    => $code,
            'message' => $message,
            'entity'  => $entity->toArray(),
        ]);

        return new Response($content, $code, $this->headers);
    }

    /**
     * @param int              $code
     * @param string           $message
     * @param EntityCollection $entities
     * @param EntitiesMetaData $metaData
     *
     * @return Response
     */
    public function createEntitiesResponse(int $code, string $message, EntityCollection $entities, EntitiesMetaData $metaData): Response
    {
        $content = $this->serializer->serialize([
            'code'     => $code,
            'message'  => $message,
            'meta'     => $metaData->toArray(),
            'entities' => $entities->getAllAsArray(),
        ]);

        return new Response($content, $code, $this->headers);
    }
}
