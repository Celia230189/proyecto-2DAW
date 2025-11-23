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
        Schema::create('carrito_compras', function (Blueprint $table) {
            $table->id();
            
            // Clave Foránea de Usuario.
            $table->foreignId('id_user')
                  ->constrained('users')
                  ->onDelete('cascade'); // Si el usuario se borra, se borra su carrito.
            
            // Clave Foránea de Producto.
            $table->foreignId('id_producto')
                  ->constrained('productos')
                  ->onDelete('cascade'); // Si el producto se borra, se elimina del carrito.
            
            // Cantidad como 'integer'.
            $table->integer('cantidad')->default(1);
            
            // Añadimos una restricción única: un usuario no puede tener dos filas del mismo producto,
            $table->unique(['id_user', 'id_producto']);
            
            $table->timestamps();
        });
    }

    /**
     * Revierte las migraciones (Borra la tabla).
     */
    public function down()
    {
        // Rellenamos el método down.
        Schema::dropIfExists('carrito_compras');
    }
};