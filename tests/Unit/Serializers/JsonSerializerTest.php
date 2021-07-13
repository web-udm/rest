<?php

namespace Tests\Unit\Serializers;

use App\Serializers\JsonSerializer;
use PHPUnit\Framework\TestCase;
use Tests\Unit\Serializers\Helpers\StringHelper;

class JsonSerializerTest extends TestCase
{
    public function testSerialize()
    {
        $stringHelper   = new StringHelper();
        $jsonSerializer = new JsonSerializer();
        $rawData        = ['param1' => 'value', 'param2' => 2];

        $serializedData              = $jsonSerializer->serialize($rawData);
        $serializedDataWithoutSpaces = $stringHelper->cutSpacesAndBreaks($serializedData);

        $expectedData              = file_get_contents(__DIR__ . '/data/json_data.json');
        $expectedDataWithoutSpaces = $stringHelper->cutSpacesAndBreaks($expectedData);

        $this->assertEquals($serializedDataWithoutSpaces, $expectedDataWithoutSpaces);
    }
}