<?php

namespace App\Constants;

class TechnologyService
{
    public const Inservice= 'En servicio';
    public const Outservice = 'Fuera de servicio';
    public const Notfound = 'No encontrado';
    public const Disabled = 'Deshabilitado';




    public static function toArray(): array
    {
        return
        [
            self::Inservice,
            self::Outservice,
            self::Notfound,
            self::Disabled,

        ];
    }
}
