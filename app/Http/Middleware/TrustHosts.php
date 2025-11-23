<?php

namespace App\Http\Middleware;

use Illuminate\Http\Middleware\TrustHosts as Middleware;


// Middleware que define los patrones de hosts que deben ser confiables para la aplicación
class TrustHosts extends Middleware
{
    /**
     * Obtiene los patrones de hosts que deben ser confiables.
     * Por defecto, confía en todos los subdominios de la URL de la aplicación.
     *
     * @return array<int, string|null>
     */
    public function hosts()
    {
        return [
            // Confía en todos los subdominios de la URL principal de la aplicación
            $this->allSubdomainsOfApplicationUrl(),
        ];
    }
}
