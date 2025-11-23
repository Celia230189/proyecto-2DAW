<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            
            // 'text' para descripciones largas
            $table->text('descripcion'); 
            
            $table->string('tipo');
            $table->string('categoria_prenda')->nullable();
            $table->string('genero');
            $table->string('marca');
            
            // 'decimal' para dinero
            // Ejemplo: 999999.99
            $table->decimal('precio', 8, 2); 
            
            // 'integer' para valoración (números del 1 al 5)
            $table->integer('valoracion')->nullable()->default(5);
            
            // Imágenes como string porque guarda la ruta
            $table->string('imagen')->default('img/productos/default.jpg');
            $table->string('img2')->default('img/productos/default.jpg');
            $table->string('img3')->default('img/productos/default.jpg');
            $table->string('img4')->default('img/productos/default.jpg');
            
            $table->string('etiquetas')->nullable();
            $table->timestamps();
        });
    }

    // Rellenamos el método down para poder borrar la tabla si hace falta
    public function down()
    {
        Schema::dropIfExists('productos');
    }
};