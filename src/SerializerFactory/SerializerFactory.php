<?php

namespace App\SerializerFactory;

use App\Exceptions\UnknownSerializerType;
use App\SerializerFactory\Base\SerializerFactoryInterface;
use App\Serializers\Serializer;

/**
 * @package App\SerializerFactory
 */
class SerializerFactory implements SerializerFactoryInterface
{
    /**
     * @inheritDoc
     */
    public function create(string $type): Serializer
    {
        $serializerName = '\App\Serializers\\' . ucfirst($type) . 'Serializer';

        if (class_exists($serializerName)) {
            return new $serializerName();
        }

        throw new UnknownSerializerType("Type '$type' cannot be used");
    }
}
