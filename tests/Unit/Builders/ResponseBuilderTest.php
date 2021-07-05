<?php

namespace Tests\Unit\Builders;

use App\Builders\ResponseBuilder;
use App\Entities\EntityInterface;
use App\Responses\BaseResponse;
use App\Responses\EntityResponse;
use PHPUnit\Framework\TestCase;
use Tests\Unit\Serializers\Helpers\StringHelper;

class ResponseBuilderTest extends TestCase
{
    public function testBuildJsonBaseResponse()
    {
        $stringHelper = new StringHelper();
        $responseBuilder = new ResponseBuilder();
        $baseResponse = $responseBuilder->createBaseResponse(404, 'Error');

        $expectedResponseBody = file_get_contents(__DIR__ . '/data/base_response.json');
        $expectedResponseBodyWithoutSpaces = $stringHelper->cutSpacesAndBreaks($expectedResponseBody);

        $this->assertInstanceOf(BaseResponse::class, $baseResponse);
        $this->assertEquals(404, $baseResponse->getStatusCode());
        $this->assertEquals($expectedResponseBodyWithoutSpaces,
            $stringHelper->cutSpacesAndBreaks($baseResponse->getContent())
        );
    }

    public function testBuildXmlBaseResponse()
    {
        $stringHelper = new StringHelper();
        $responseBuilder = new ResponseBuilder();
        $baseResponse = $responseBuilder->createBaseResponse(404, 'Error', 'xml');

        $expectedResponseBody = file_get_contents(__DIR__ . '/data/base_response.xml');
        $expectedResponseBodyWithoutSpaces = $stringHelper->cutSpacesAndBreaks($expectedResponseBody);

        $this->assertInstanceOf(BaseResponse::class, $baseResponse);
        $this->assertEquals(404, $baseResponse->getStatusCode());
        $this->assertEquals($expectedResponseBodyWithoutSpaces,
            $stringHelper->cutSpacesAndBreaks($baseResponse->getContent())
        );
    }

    public function testBuildJsonEntityResponse()
    {
        $stringHelper = new StringHelper();
        $responseBuilder = new ResponseBuilder();
        $entity = $this->createEntity();
        $entityResponse = $responseBuilder->createEntityResponse($entity);

        $expectedResponseBody = file_get_contents(__DIR__ . '/data/entity_response.json');
        $expectedResponseBodyWithoutSpaces = $stringHelper->cutSpacesAndBreaks($expectedResponseBody);

        $this->assertInstanceOf(EntityResponse::class, $entityResponse);
        $this->assertEquals(200, $entityResponse->getStatusCode());
        $this->assertEquals($expectedResponseBodyWithoutSpaces,
            $stringHelper->cutSpacesAndBreaks($entityResponse->getContent())
        );;
    }

    public function testBuildXmlEntityResponse()
    {
        $stringHelper = new StringHelper();
        $responseBuilder = new ResponseBuilder();
        $entity = $this->createEntity();
        $entityResponse = $responseBuilder->createEntityResponse($entity);

        $expectedResponseBody = file_get_contents(__DIR__ . '/data/entity_response.json');
        $expectedResponseBodyWithoutSpaces = $stringHelper->cutSpacesAndBreaks($expectedResponseBody);

        $this->assertInstanceOf(EntityResponse::class, $entityResponse);
        $this->assertEquals(200, $entityResponse->getStatusCode());
        $this->assertEquals($expectedResponseBodyWithoutSpaces,
            $stringHelper->cutSpacesAndBreaks($entityResponse->getContent())
        );;
    }

    public function testBuildJsonEntitiesResponse()
    {

    }

    public function testBuildXmlEntitiesResponse()
    {

    }

    private function createEntity(): EntityInterface
    {
        return new class implements EntityInterface {
            private $firstname = 'Artem';
            private $surname = 'Ivanov';

            public function toArray(): array
            {
                return [
                    'firstname' => $this->firstname,
                    'surname' => $this->surname
                ];
            }
        };
    }
}