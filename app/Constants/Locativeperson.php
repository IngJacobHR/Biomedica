<?php

namespace App\Constants;

class Locativeperson
{
    public const Person1= 'Yeison Betancourt';
    public const Person2 = 'Fabio Imba';
    public const Person3 = 'Jhon Jimenez';
    public const Person4 = 'Sebastian Florez';
    public const Person5 = 'Eric Quejada';
    public const Person6 = 'Brayan Escobar';
    public const Person7 = 'Clinica del frio';
    public const Person8 = 'Xanthia';

    public static function toArray(): array
    {
        return
        [
            self::Person1,
            self::Person2,
            self::Person3,
            self::Person4,
            self::Person5,
            self::Person6,
            self::Person7,
            self::Person8,

        ];
    }
}
