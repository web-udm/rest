<?php

namespace App\Serializers;

/**
 * Interface Serializer
 * @package App\Serializers
 */
interface Serializer
{
    /**
     * @param array $data
     *
     * @return string
     */
    public function serialize(array $data): string;
}
