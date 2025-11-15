<?php


// Definimos el espacio de nombres para la consola de la aplicación
namespace App\Console;


// Importamos las clases necesarias para la programación de comandos y el núcleo de la consola
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;


// Clase Kernel que extiende el núcleo de la consola de Laravel
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
        // Carga todos los comandos personalizados ubicados en app/Console/Commands
        $this->load(__DIR__.'/Commands');

        // Incluye las rutas de comandos definidas en routes/console.php
        require base_path('routes/console.php');
    }
}
