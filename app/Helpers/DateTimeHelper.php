<?php

namespace App\Helpers;

class DateTimeHelper
{
    public static function formatForDateTimeLocal($dateTime)
    {
        return $dateTime ? date('Y-m-d\TH:i', strtotime($dateTime)) : '';
    }
}
