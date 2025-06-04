<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('operaciones', function (Blueprint $table) {
            $table->id(); // Equivale a INT, AUTO_INCREMENT, Primary Key
            $table->enum('tipo_operacion', ['Ingreso', 'Gasto']); // ENUM('Ingreso','Gasto')
            $table->enum('tipo_pago', ['Tarjeta', 'Efectivo']); // ENUM('Tarjeta','Efectivo')
            $table->decimal('monto', 10, 2); // DECIMAL(10,2)
            $table->date('fecha'); // DATE

            // Claves foráneas:
            // Para id_categoria, cambiaremos a 'categoria_id' para seguir la convención de Laravel
            $table->foreignId('categoria_id')->constrained('categorias')->onDelete('cascade');
            $table->foreignId('banco_id')->constrained('bancos')->onDelete('cascade');

            $table->timestamps(); // Crea columnas created_at y updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('operaciones');
    }
};