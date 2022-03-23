<?php

namespace Tests\Unit\Factories;

use App\Exceptions\UnknownSerializerType;
use App\SerializerFactory\SerializerFactory;
use App\Serializers\JsonSerializer;
use App\Serializers\XmlSerializer;
use PHPUnit\Framework\TestCase;

class SerializerFactoryTest extends TestCase
{
    public function testCreateJsonSerializer()
    {
        $serializerFactory = new SerializerFactory();
        $serializer        = $serializerFactory->create('json');

        $this->assertInstanceOf(JsonSerializer::class, $serializer);
    }

    public function testCreateXmlSerializer()
    {
        $serializerFactory = new SerializerFactory();
        $serializer        = $serializerFactory->create('xml');

        $this->assertInstanceOf(XmlSerializer::class, $serializer);
    }

    public function testCreateNonExistentSerializer()
    {
        $serializerFactory = new SerializerFactory();

        $this->expectException(UnknownSerializerType::class);

        $serializerFactory->create('broken_type');
    }
}