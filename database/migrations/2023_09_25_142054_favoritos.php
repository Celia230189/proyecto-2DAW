<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Ejecuta las migraciones (Crea la tabla).
     */
    public function up()
    {
        Schema::create('favoritos', function (Blueprint $table) {
            $table->id();
            
            // Clave Foránea de Usuario.
            // Aseguramos que el ID existe en la tabla 'users'.
            $table->foreignId('id_user')
                  ->constrained('users')
                  ->onDelete('cascade'); // Si el usuario se borra, se borran sus favoritos.
            
            // Clave Foránea de Producto.
            // Aseguramos que el ID existe en la tabla 'productos'.
            $table->foreignId('id_producto')
                  ->constrained('productos')
                  ->onDelete('cascade'); // Si el producto se borra, se borran los favoritos.

            // Añadimos una restricción única: un usuario no puede marcar dos veces el mismo producto.
            $table->unique(['id_user', 'id_producto']); 

            $table->timestamps();
        });
    }

    /**
     * Revierte las migraciones (Borra la tabla).
     */
    public function down()
    {
        Schema::dropIfExists('favoritos');
    }
};