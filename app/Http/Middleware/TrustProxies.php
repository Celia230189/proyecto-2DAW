<?php

namespace App\Http\Middleware;

use Illuminate\Http\Middleware\TrustProxies as Middleware;
use Illuminate\Http\Request;


// Middleware que define los proxies de confianza y los encabezados a usar para detectar proxies
class TrustProxies extends Middleware
{
    /**
     * Lista de proxies de confianza para esta aplicación.
     * Puedes especificar aquí las IPs o rangos de proxies que consideras seguros.
     *
     * @var array<int, string>|string|null
     */
    protected $proxies;

    /**
     * Encabezados que deben usarse para detectar proxies.
     * Incluye los encabezados estándar y de AWS ELB.
     *
     * @var int
     */
    protected $headers =
        Request::HEADER_X_FORWARDED_FOR |
        Request::HEADER_X_FORWARDED_HOST |
        Request::HEADER_X_FORWARDED_PORT |
        Request::HEADER_X_FORWARDED_PROTO |
        Request::HEADER_X_FORWARDED_AWS_ELB;
}
