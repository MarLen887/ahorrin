<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banco extends Model
{
    use HasFactory;

    // Define el nombre de la tabla si no sigue la convención de Laravel (plural del nombre del modelo)
    // En este caso, 'bancos' es el plural de 'Banco', así que no es estrictamente necesario,
    // pero es bueno saber que existe para cuando los nombres no coinciden.
    protected $table = 'bancos';

    // Define las columnas que pueden ser asignadas masivamente (fillable)
    // Estas son las columnas que esperas recibir de un formulario o una API para crear/actualizar un registro.
    protected $fillable = [
        'nombre',
        'tipo_tarjeta',
    ];

    // Si tu tabla no usa las columnas 'created_at' y 'updated_at', establece $timestamps en false.
    // En tu migración para 'bancos' sí incluimos $table->timestamps();,
    // por lo tanto, no es necesario establecer $timestamps = false; a menos que las hayas eliminado manualmente de la migración.
    // Si la migración incluye timestamps, puedes quitar o comentar la línea siguiente.
    // public $timestamps = false; // Descomentar si no usas created_at y updated_at
}