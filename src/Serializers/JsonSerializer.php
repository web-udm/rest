<?php

namespace App\Serializers;

class JsonSerializer
{
    /**
     * @param array $data
     * @return string
     */
    public function serialize(array $data): string
    {
        return json_encode($data);
    }
}
