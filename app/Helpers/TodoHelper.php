<?php

namespace App\Helpers;

class TodoHelper
{

    const DB_TIMESTAMP_FORMAT = \DateTimeInterface::RFC3339_EXTENDED;
    const DB_TIMESTAMP_CAST = 'datetime:' . \DateTimeInterface::RFC3339_EXTENDED;

    static function formatDbTimestamp(\DateTimeInterface $dateTime)
    {
        return $dateTime->format(self::DB_TIMESTAMP_FORMAT);
    }
}
