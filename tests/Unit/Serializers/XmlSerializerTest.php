<?php

namespace Tests\Unit\Serializers;

use App\Serializers\XmlSerializer;
use PHPUnit\Framework\TestCase;
use Tests\Unit\Serializers\Helpers\StringHelper;

class XmlSerializerTest extends TestCase
{
    public function testSerialize()
    {
        $stringHelper = new StringHelper();

        $xmlSerializer = new XmlSerializer();
        $rawData = ['param1' => 'value', 'param2' => 2];

        $serializedData = $xmlSerializer->serialize($rawData);
        $serializedDataWithoutSpaces = $stringHelper->cutSpacesAndBreaks($serializedData);

        $expectedResult = file_get_contents(__DIR__ . '/data/xml_data.xml');
        $expectedResultWithoutSpaces = $stringHelper->cutSpacesAndBreaks($expectedResult);

        $this->assertEquals(($expectedResultWithoutSpaces), $serializedDataWithoutSpaces);
    }
}