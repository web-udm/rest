<?php

namespace App\HeadersFactory\Base;

/**
 * Interface HeadersFactoryInterface
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
