<?php

namespace Tests\Unit\Factories;

use App\HeadersFactory\HeadersFactory;
use PHPUnit\Framework\TestCase;

class HeadersFactoryTest extends TestCase
{
    public function testJsonType()
    {
        $headersFactory = new HeadersFactory();
        $header = $headersFactory->create('json');

        $this->assertEquals(['content-type' => 'application/json'], $header);
    }

    public function testXmlType()
    {
        $headersFactory = new HeadersFactory();
        $header = $headersFactory->create('xml');

        $this->assertEquals(['content-type' => 'text/xml'], $header);
    }

    public function testIncorrectType()
    {
        $headersFactory = new HeadersFactory();

        $this->expectException($headersFactory->create('invalid_type'));
    }
}