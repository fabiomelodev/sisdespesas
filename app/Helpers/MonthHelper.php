<?php

namespace App\Helpers;

use Carbon\Carbon;

class MonthHelper
{
    public static function getMonths(): array
    {
        return [
            1  => 'Janeiro',
            2  => 'Fevereiro',
            3  => 'Março',
            4  => 'Abril',
            5  => 'Maio',
            6  => 'Junho',
            7  => 'Julho',
            8  => 'Agosto',
            9  => 'Setembro',
            10 => 'Outubro',
            11 => 'Novembro',
            12 => 'Dezembro'
        ];
    }

    public static function getMonthCurrent(): string
    {
        $month = Carbon::now()->month;

        return static::getMonths()[$month];
    }

    public static function getMonth($month): string
    {
        return static::getMonths()[$month];
    }
}
