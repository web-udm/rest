<?php

namespace App\HeadersFactory;

use App\Exceptions\UnknownResponseType;
use App\HeadersFactory\Base\HeadersFactoryInterface;

/**
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
            $headers = [
                'content-type' => 'application/json',
            ];
        } elseif ($responseType === static::XML_RESPONSE) {
            $headers = [
                'content-type' => 'text/xml',
            ];
        } else {
            throw new UnknownResponseType();
        }

        return $headers;
    }
}
