<?php

namespace App\SerializerFactory\Base;

use App\Exceptions\UnknownSerializerType;
use App\Serializers\Serializer;

/**
 * Interface SerializerFactoryInterface
 * @package App\SerializerFactory
 */
interface SerializerFactoryInterface
{
    /**
     * @param string $type
     *
     * @return Serializer
     * @throws UnknownSerializerType
     */
    public function create(string $type): Serializer;
}
