<?php

namespace Tests\Unit\Builders;

use App\Builders\ResponseBuilder;
use App\HeadersFactory\HeadersFactory;
use App\Entities\EntitiesMetaData;
use App\Entities\EntityCollection;
use App\SerializerFactory\SerializerFactory;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Response;
use Tests\Unit\Serializers\Helpers\StringHelper;
use App\Entities\Entity;

class ResponseBuilderTest extends TestCase
{
    public function testBuildJsonBaseResponse()
    {
        $stringHelper    = new StringHelper();
        $responseBuilder = new ResponseBuilder(new SerializerFactory(), new HeadersFactory());

        $baseResponse = $responseBuilder->createBaseResponse(404, 'Error');

        $expectedResponseBody              = file_get_contents(__DIR__ . '/data/base_response.json');
        $expectedResponseBodyWithoutSpaces = $stringHelper->cutSpacesAndBreaks($expectedResponseBody);

        $this->assertInstanceOf(Response::class, $baseResponse);
        $this->assertEquals(404, $baseResponse->getStatusCode());
        $this->assertEquals(
            $expectedResponseBodyWithoutSpaces,
            $stringHelper->cutSpacesAndBreaks($baseResponse->getContent())
        );
        $this->assertEquals(
            'application/json', $baseResponse->headers->get('content-type')
        );
    }

    public function testBuildXmlBaseResponse()
    {
        $stringHelper    = new StringHelper();
        $responseBuilder = new ResponseBuilder(new SerializerFactory(), new HeadersFactory());
        $responseBuilder->setResponseType('xml');
        $baseResponse = $responseBuilder->createBaseResponse(404, 'Error');

        $expectedResponseBody              = file_get_contents(__DIR__ . '/data/base_response.xml');
        $expectedResponseBodyWithoutSpaces = $stringHelper->cutSpacesAndBreaks($expectedResponseBody);

        $this->assertInstanceOf(Response::class, $baseResponse);
        $this->assertEquals(404, $baseResponse->getStatusCode());
        $this->assertEquals(
            $expectedResponseBodyWithoutSpaces,
            $stringHelper->cutSpacesAndBreaks($baseResponse->getContent())
        );
        $this->assertEquals(
            'text/xml', $baseResponse->headers->get('content-type')
        );
    }

    public function testBuildJsonEntityResponse()
    {
        $stringHelper    = new StringHelper();
        $responseBuilder = new ResponseBuilder(new SerializerFactory(), new HeadersFactory());
        $entity          = $this->createEntity();
        $entityResponse  = $responseBuilder->createEntityResponse($entity, 200, 'Entity successfully fetched');

        $expectedResponseBody              = file_get_contents(__DIR__ . '/data/entity_response.json');
        $expectedResponseBodyWithoutSpaces = $stringHelper->cutSpacesAndBreaks($expectedResponseBody);

        $this->assertInstanceOf(Response::class, $entityResponse);
        $this->assertEquals(200, $entityResponse->getStatusCode());
        $this->assertEquals(
            $expectedResponseBodyWithoutSpaces,
            $stringHelper->cutSpacesAndBreaks($entityResponse->getContent())
        );
        $this->assertEquals(
            'application/json', $entityResponse->headers->get('content-type')
        );
    }

    public function testBuildXmlEntityResponse()
    {
        $stringHelper    = new StringHelper();
        $responseBuilder = new ResponseBuilder(new SerializerFactory(), new HeadersFactory());
        $responseBuilder->setResponseType('xml');
        $entity         = $this->createEntity();
        $entityResponse = $responseBuilder->createEntityResponse(
            $entity,
            200,
            'Entity successfully fetched'
        );

        $expectedResponseBody              = file_get_contents(__DIR__ . '/data/entity_response.xml');
        $expectedResponseBodyWithoutSpaces = $stringHelper->cutSpacesAndBreaks($expectedResponseBody);

        $this->assertInstanceOf(Response::class, $entityResponse);
        $this->assertEquals(200, $entityResponse->getStatusCode());
        $this->assertEquals(
            $expectedResponseBodyWithoutSpaces,
            $stringHelper->cutSpacesAndBreaks($entityResponse->getContent())
        );
        $this->assertEquals(
            'text/xml', $entityResponse->headers->get('content-type')
        );
    }

    public function testBuildJsonEntitiesResponse()
    {
        $stringHelper       = new StringHelper();
        $responseBuilder    = new ResponseBuilder(new SerializerFactory(), new HeadersFactory());
        $entitiesCollection = new EntityCollection();
        $entitiesCollection
            ->addEntity($this->createEntity())
            ->addEntity($this->createEntity());
        $entitiesMetaData = new EntitiesMetaData(2, 3, 4,1);

        $entitiesResponse = $responseBuilder->createEntitiesResponse(
            200,
            'Entities successfully fetched',
            $entitiesCollection,
            $entitiesMetaData
        );

        $expectedResponseBody              = file_get_contents(__DIR__ . '/data/entities_response.json');
        $expectedResponseBodyWithoutSpaces = $stringHelper->cutSpacesAndBreaks($expectedResponseBody);

        $this->assertInstanceOf(Response::class, $entitiesResponse);
        $this->assertEquals(200, $entitiesResponse->getStatusCode());
        $this->assertEquals(
            $expectedResponseBodyWithoutSpaces,
            $stringHelper->cutSpacesAndBreaks($entitiesResponse->getContent())
        );
        $this->assertEquals(
            'application/json', $entitiesResponse->headers->get('content-type')
        );
    }

    public function testBuildXmlEntitiesResponse()
    {
        $stringHelper       = new StringHelper();
        $responseBuilder    = new ResponseBuilder(new SerializerFactory(), new HeadersFactory());
        $responseBuilder->setResponseType('xml');
        $entitiesCollection = new EntityCollection();
        $entitiesCollection
            ->addEntity($this->createEntity())
            ->addEntity($this->createEntity());
        $entitiesMetaData = new EntitiesMetaData(2, 3, 4,1);

        $entitiesResponse = $responseBuilder->createEntitiesResponse(
            200,
            'Entities successfully fetched',
            $entitiesCollection,
            $entitiesMetaData
        );

        $expectedResponseBody              = file_get_contents(__DIR__ . '/data/entities_response.xml');
        $expectedResponseBodyWithoutSpaces = $stringHelper->cutSpacesAndBreaks($expectedResponseBody);

        $this->assertInstanceOf(Response::class, $entitiesResponse);
        $this->assertEquals(200, $entitiesResponse->getStatusCode());
        $this->assertEquals(
            $expectedResponseBodyWithoutSpaces,
            $stringHelper->cutSpacesAndBreaks($entitiesResponse->getContent())
        );
        $this->assertEquals(
            'text/xml', $entitiesResponse->headers->get('content-type')
        );
    }

    /**
     * @return Entity
     */
    private function createEntity()
    {
        return new class implements Entity {
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
}