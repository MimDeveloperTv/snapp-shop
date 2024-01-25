<?php

namespace App\Services;


use App\Services\Ghasedak\Ghasedak;
use App\Services\KavehNegar\KavehNegar;

class ServiceFactory
{
    public const GHASEDAK = 'GHASEDAK';
    public const KAVEH_NEGAR = 'KAVEH_NEGAR';

    public const SERVICES = [
        self::GHASEDAK => Ghasedak::class,
        self::KAVEH_NEGAR => KavehNegar::class,
    ];

    public static function make($service): Service
    {
        return app(static::SERVICES[$service]);
    }

}
