<?php

namespace App\HeadersFactory;

use App\HeadersFactory\Base\HeadersFactoryInterface;

/**
 * Class HeadersFactory
 * @package App\HeadersFactory
 */
class HeadersFactory implements HeadersFactoryInterface
{
    public const XML_RESPONSE  = 'xml';
    public const JSON_RESPONSE = 'json';

    /**
     * @inheritdoc
     */
    public function create(string $responseType): array
    {
        if ($responseType === static::JSON_RESPONSE) {
            $headers = [];
        } elseif ($responseType === static::XML_RESPONSE) {
            $headers = [];
        } else {
            $headers = [];
        }

        return $headers;
    }
}
