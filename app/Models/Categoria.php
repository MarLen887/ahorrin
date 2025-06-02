<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;

    // Define el nombre de la tabla si no sigue la convención de Laravel
    protected $table = 'categorias';

    // Define las columnas que pueden ser asignadas masivamente (fillable)
    protected $fillable = [
        'establecimiento',
        'tipo_categoria',
    ];

    // Si tu tabla no usa las columnas 'created_at' y 'updated_at', establece $timestamps en false.
    // En tu migración para 'categorias' sí incluimos $table->timestamps();,
    // por lo tanto, no es necesario establecer $timestamps = false; a menos que las hayas eliminado manualmente de la migración.
    // public $timestamps = false; // Descomentar si no usas created_at y updated_at
}