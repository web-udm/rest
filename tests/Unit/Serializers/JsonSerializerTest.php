<?php

namespace Tests\Unit\Serializers;

use App\Serializers\JsonSerializer;
use PHPUnit\Framework\TestCase;

class JsonSerializerTest extends TestCase
{
    public function testSerialize()
    {
        $jsonSerializer = new JsonSerializer();
        $rawData = ['param1' => 'value', 'param2' => 2];
        $serializedData = $jsonSerializer->serialize($rawData);

        $this->assertEquals(file_get_contents(__DIR__ . '/data/json_data.json'), $serializedData);
    }
}