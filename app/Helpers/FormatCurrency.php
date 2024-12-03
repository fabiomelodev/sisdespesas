<?php

namespace App\Helpers;

class FormatCurrency
{
    public static function getFormatCurrency($value): string
    {
        return 'R$ ' . number_format((float) $value, 2, ',', '.');
    }
}
