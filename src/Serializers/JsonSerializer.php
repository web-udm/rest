<?php

namespace App\Serializers;

/**
 * @package App\Serializers
 */
class JsonSerializer implements Serializer
{
    /**
     * @param array $data
     *
     * @return string
     */
    public function serialize(array $data): string
    {
        return json_encode($data);
    }
}
