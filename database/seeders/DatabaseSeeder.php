<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User; 
use Illuminate\Support\Facades\Hash; 
use Database\Seeders\ProductoSeeder; 

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // 1. CREACIÓN DEL USUARIO ADMINISTRADOR (Obligatorio para entrar al panel)
        User::create([
            'name' => 'admin',
            'email' => 'admin@ejemplo.com',
            'password' => Hash::make('password'), 
            'tipo_usuario' => 1, // CLAVE: 1 = Admin
            'saldo' => 999999, // Dinero para pruebas
        ]);
        
        // 2. CREACIÓN DE 10 USUARIOS CLIENTE DE PRUEBA
      // User::factory(10)->create(); 
        
        // 3.LLAMADA AL SEEDER DE PRODUCTOS
        $this->call(ProductoSeeder::class);
    }
}