<?php

namespace App\HeadersFactory\Base;

/**
 * @package App\HeadersFactory
 */
interface HeadersFactoryInterface
{
    /**
     * @param string $responseType
     *
     * @return array
     */
    public function create(string $responseType): array;
}
