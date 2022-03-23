<?php

namespace Tests\Unit\Serializers\Helpers;

class StringHelper
{
    /**
     * Удаляет пробельные символы.
     * Нужен для того, чтобы привести ожидаемые и полученные сериализированные данные к одному виду.
     *
     * @param string $string
     * @return string
     */
    public function cutSpacesAndBreaks(string $string): string
    {
        return preg_replace('#\s#', '', $string);
    }
}