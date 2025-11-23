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
    
        Schema::create('detalles_pedidos', function (Blueprint $table) {
            $table->id();
            
            // Clave Foránea de Usuario.
            $table->foreignId('id_user')
                  ->constrained('users') // Conecta con la tabla 'users'
                  ->onDelete('cascade'); // Si el usuario se borra, se borran sus pedidos.
            
            // Decimal para el dinero.
            $table->decimal('precio_total', 8, 2); 
            
            $table->string('pais');
            $table->string('ciudad');
            
            // Text para la dirección larga.
            $table->text('direccion'); 
            
            $table->timestamps();
        });
    }

    /**
     * Revierte las migraciones (Borra la tabla).
     */
    public function down()
    {
        // Rellenamos el método down.
        Schema::dropIfExists('detalles_pedido');
    }
};