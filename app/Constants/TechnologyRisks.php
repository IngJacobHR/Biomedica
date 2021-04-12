<?php

namespace App\Constants;

class TechnologyRisks
{
    public const Mlow= 'Muy bajo';
    public const Low = 'Bajo';
    public const Moderate = 'Moderado';
    public const High= 'Alto';


    public static function toArray(): array
    {
        return
        [
            self::Mlow,
            self::Low,
            self::Moderate,
            self::High,
        ];
    }
}
