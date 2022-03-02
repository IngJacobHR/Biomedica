<?php

namespace App\Constants;

class SupportFrequency
{
    public const frequency_one = 'Cuatrimestral';
    public const frequency_two = 'Semestral';
    public const frequency_three = 'Anual';



    public static function toArray(): array
    {
        return
        [
            self::frequency_one,
            self::frequency_two,
            self::frequency_three,
        ];
    }
}
