<?php

namespace Tests\Unit\Builders;

use App\Builders\ResponseBuilder;
use App\Entities\EntitiesCollection;
use App\Entities\EntityInterface;
use App\Responses\BaseResponse;
use App\Responses\EntitiesResponse;
use App\Responses\EntityResponse;
use PHPUnit\Framework\TestCase;
use Tests\Unit\Serializers\Helpers\StringHelper;

class ResponseBuilderTest extends TestCase
{
    public function testBuildJsonBaseResponse()
    {
        $stringHelper    = new StringHelper();
        $responseBuilder = new ResponseBuilder();
        $baseResponse    = $responseBuilder->createBaseResponse(404, 'Error');

        $expectedResponseBody              = file_get_contents(__DIR__ . '/data/base_response.json');
        $expectedResponseBodyWithoutSpaces = $stringHelper->cutSpacesAndBreaks($expectedResponseBody);

        $this->assertInstanceOf(BaseResponse::class, $baseResponse);
        $this->assertEquals(404, $baseResponse->getStatusCode());
        $this->assertEquals(
            $expectedResponseBodyWithoutSpaces,
            $stringHelper->cutSpacesAndBreaks($baseResponse->getContent())
        );
    }

    public function testBuildXmlBaseResponse()
    {
        $stringHelper    = new StringHelper();
        $responseBuilder = new ResponseBuilder();
        $baseResponse    = $responseBuilder->createBaseResponse(404, 'Error', 'xml');

        $expectedResponseBody              = file_get_contents(__DIR__ . '/data/base_response.xml');
        $expectedResponseBodyWithoutSpaces = $stringHelper->cutSpacesAndBreaks($expectedResponseBody);

        $this->assertInstanceOf(BaseResponse::class, $baseResponse);
        $this->assertEquals(404, $baseResponse->getStatusCode());
        $this->assertEquals(
            $expectedResponseBodyWithoutSpaces,
            $stringHelper->cutSpacesAndBreaks($baseResponse->getContent())
        );
    }

    public function testBuildJsonEntityResponse()
    {
        $stringHelper    = new StringHelper();
        $responseBuilder = new ResponseBuilder();
        $entity          = $this->createEntity();
        $entityResponse  = $responseBuilder->createEntityResponse($entity);

        $expectedResponseBody              = file_get_contents(__DIR__ . '/data/entity_response.json');
        $expectedResponseBodyWithoutSpaces = $stringHelper->cutSpacesAndBreaks($expectedResponseBody);

        $this->assertInstanceOf(EntityResponse::class, $entityResponse);
        $this->assertEquals(200, $entityResponse->getStatusCode());
        $this->assertEquals(
            $expectedResponseBodyWithoutSpaces,
            $stringHelper->cutSpacesAndBreaks($entityResponse->getContent())
        );
    }

    public function testBuildXmlEntityResponse()
    {
        $stringHelper    = new StringHelper();
        $responseBuilder = new ResponseBuilder();
        $entity          = $this->createEntity();
        $entityResponse  = $responseBuilder->createEntityResponse($entity, 'xml');

        $expectedResponseBody              = file_get_contents(__DIR__ . '/data/entity_response.xml');
        $expectedResponseBodyWithoutSpaces = $stringHelper->cutSpacesAndBreaks($expectedResponseBody);

        $this->assertInstanceOf(EntityResponse::class, $entityResponse);
        $this->assertEquals(200, $entityResponse->getStatusCode());
        $this->assertEquals(
            $expectedResponseBodyWithoutSpaces,
            $stringHelper->cutSpacesAndBreaks($entityResponse->getContent())
        );
    }

    public function testBuildJsonEntitiesResponse()
    {
        $stringHelper       = new StringHelper();
        $responseBuilder    = new ResponseBuilder();
        $entitiesCollection = $this->createEntityCollection();
        $entitiesResponse   = $responseBuilder->createEntitiesResponse($entitiesCollection, [
            "page"               => 1,
            "page_total_count"   => 2,
            "entity_limit"       => 3,
            "entity_total_count" => 4,
        ]);

        $expectedResponseBody              = file_get_contents(__DIR__ . '/data/entities_response.json');
        $expectedResponseBodyWithoutSpaces = $stringHelper->cutSpacesAndBreaks($expectedResponseBody);

        $this->assertInstanceOf(EntitiesResponse::class, $entitiesResponse);
        $this->assertEquals(200, $entitiesResponse->getStatusCode());
        $this->assertEquals(
            $expectedResponseBodyWithoutSpaces,
            $stringHelper->cutSpacesAndBreaks($entitiesResponse->getContent())
        );
    }

    public function testBuildXmlEntitiesResponse()
    {
        $stringHelper       = new StringHelper();
        $responseBuilder    = new ResponseBuilder();
        $entitiesCollection = $this->createEntityCollection();
        $entitiesResponse   = $responseBuilder->createEntitiesResponse($entitiesCollection, [
            "page"               => 1,
            "page_total_count"   => 2,
            "entity_limit"       => 3,
            "entity_total_count" => 4,
        ], 'xml');

        $expectedResponseBody              = file_get_contents(__DIR__ . '/data/entities_response.xml');
        $expectedResponseBodyWithoutSpaces = $stringHelper->cutSpacesAndBreaks($expectedResponseBody);

        $this->assertInstanceOf(EntitiesResponse::class, $entitiesResponse);
        $this->assertEquals(200, $entitiesResponse->getStatusCode());
        $this->assertEquals(
            $expectedResponseBodyWithoutSpaces,
            $stringHelper->cutSpacesAndBreaks($entitiesResponse->getContent())
        );
    }

    /**
     * @return EntityInterface
     */
    private function createEntity()
    {
        return new class implements EntityInterface {
            private $firstname = 'Artem';
            private $surname   = 'Ivanov';

            public function toArray(): array
            {
                return [
                    'firstname' => $this->firstname,
                    'surname'   => $this->surname,
                ];
            }
        };
    }

    /**
     * @return EntitiesCollection
     */
    private function createEntityCollection()
    {
        $entity1 = $this->createEntity();
        $entity2 = $this->createEntity();

        return new class($entity1, $entity2) implements EntitiesCollection {
            private $entities;

            public function __construct(EntityInterface ...$entities)
            {
                $this->entities = $entities;
            }

            public function add(EntityInterface $entity): void
            {
            }

            public function all(): array
            {
                return $this->entities;
            }
        };
    }
}