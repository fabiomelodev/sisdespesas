<?php

namespace App\Helpers;

class CalculateValue
{
    public static function getCalculatePercetangeValue(string $value, string $percentage): string
    {
        $result = ($value / 100) * $percentage;

        return FormatCurrency::getFormatCurrency($result);
    }
}
