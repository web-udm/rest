<?php

namespace App\Serializers;

use Spatie\ArrayToXml\ArrayToXml;

/**
 * @package App\Serializers
 */
class XmlSerializer implements Serializer
{
    /**
     * @param array $data
     *
     * @return string
     */
    public function serialize(array $data): string
    {
        return ArrayToXml::convert($data);
    }
}
