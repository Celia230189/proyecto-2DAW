<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::updateOrCreate(
            ['email' => 'admin@ejemplo.com'],
            [
                'name' => 'admin',
                'password' => Hash::make(env('ADMIN_PASSWORD', 'password')),
                'tipo_usuario' => 1, // 1 para admin
                'saldo' => 0,
            ]
        );
    }
}