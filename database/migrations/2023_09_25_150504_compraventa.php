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
        Schema::create('compraventas', function (Blueprint $table) {
            $table->id();
            
            // Clave Foránea de Usuario.
            // Conecta con la tabla 'users' para saber quién es el vendedor.
            $table->foreignId('id_user')
                  ->constrained('users')
                  ->onDelete('cascade'); // Si el usuario se borra, se borran sus anuncios de venta.
            
            $table->string('nombre_producto');
            
            // 'text' para descripciones largas.
            $table->text('descripcion_producto');
            
            // 'decimal' para el precio.
            $table->decimal('precio', 8, 2);
            
            $table->string('imagen')->default('img/compraventa/default.jpg');
            $table->string('contacto');
            $table->timestamps();
        });
    }

    /**
     * Revierte las migraciones (Borra la tabla).
     */
    public function down()
    {
        // Rellenamos el método down.
        Schema::dropIfExists('compraventas');
    }
};