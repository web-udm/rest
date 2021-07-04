<?php

namespace Tests\Unit\Builders;

use App\Builders\ResponseBuilder;
use App\Responses\BaseResponse;
use PHPUnit\Framework\TestCase;

class ResponseBuilderTest extends TestCase
{
    public function testBuildJsonBaseResponse()
    {
        $responseBuilder = new ResponseBuilder();
        $baseResponse = $responseBuilder->createBaseResponse(404, 'Error');

        $this->assertInstanceOf(BaseResponse::class, $baseResponse);
        $this->assertEquals(404, $baseResponse->getStatusCode());
        $this->assertEquals(require 'data/base_response.json', $baseResponse->getContent());
    }

    public function testBuildXmlBaseResponse()
    {

    }

    public function testBuildJsonEntityResponse()
    {

    }

    public function testBuildXmlEntityResponse()
    {

    }

    public function testBuildJsonEntitiesResponse()
    {

    }

    public function testBuildXmlEntitiesResponse()
    {

    }
}