<?php

namespace App\Constants;

class Locativeperson
{
    public const Person1= 'Elkin Garcia';
    public const Person2 = 'Fabio Imba';
    public const Person3 = 'Yuliana Carmona';
    public const Person4 = 'Elkin Garcia-Fabio Imba';
    public const Person5 = 'Ricardo Rubio';



    public static function toArray(): array
    {
        return
        [
            self::Person1,
            self::Person2,
            self::Person3,
            self::Person4,
            self::Person5,

        ];
    }
}
