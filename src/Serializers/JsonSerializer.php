<?php

namespace App\Serializers;

class JsonSerializer
{
    public function serialize(array $data): string
    {
        return json_encode($data);
    }
}