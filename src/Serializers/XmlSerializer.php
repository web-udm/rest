<?php

namespace App\Serializers;

use Spatie\ArrayToXml\ArrayToXml;

class XmlSerializer
{
    public function serialize(array $data): string
    {
        return ArrayToXml::convert($data);
    }
}