<?php

namespace App\Helpers;

class StringHelper
{
    /**
     * @param string $text
     * @return string|string[]|null
     */
    public static function formatNumbers(string $text)
    {
        return preg_replace('/\(|\)|\s+|\-|\/|\./i', '', $text);
    }
}
