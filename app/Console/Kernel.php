<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define la programación de comandos de la aplicación.
     * Aquí puedes programar tareas automáticas usando el programador de Laravel.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // Ejemplo: programa el comando 'inspire' para que se ejecute cada hora
        // $schedule->command('inspire')->hourly();
    }

    /**
     * Registra los comandos personalizados de la aplicación.
     * Carga los comandos definidos en el directorio Commands y el archivo de rutas de consola.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
