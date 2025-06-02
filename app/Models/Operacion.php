<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo; // Importa BelongsTo para definir relaciones

class Operacion extends Model
{
    use HasFactory;

    // Define el nombre de la tabla si no sigue la convención de Laravel
    protected $table = 'operaciones';

    // Define las columnas que pueden ser asignadas masivamente (fillable)
    protected $fillable = [
        'tipo_operacion',
        'tipo_pago',
        'monto',
        'fecha',
        'categoria_id', // Incluye las claves foráneas aquí
        'usuario_id',
        'banco_id',
    ];

    // Si tu tabla no usa las columnas 'created_at' y 'updated_at', establece $timestamps en false.
    // En tu migración para 'operaciones' sí incluimos $table->timestamps();,
    // por lo tanto, no es necesario establecer $timestamps = false; a menos que las hayas eliminado manualmente de la migración.
    // public $timestamps = false; // Descomentar si no usas created_at y updated_at

    /**
     * Define la relación: Una operación pertenece a una categoría.
     */
    public function categoria(): BelongsTo
    {
        return $this->belongsTo(Categoria::class, 'categoria_id');
    }

    /**
     * Define la relación: Una operación pertenece a un usuario.
     */
    public function usuario(): BelongsTo
    {
        // Asume que tu modelo de usuario es 'User' y que la clave foránea es 'usuario_id'
        // Si tu modelo de usuario está en otra ruta o se llama diferente (ej. App\Models\MiUsuario), ajústalo.
        return $this->belongsTo(User::class, 'usuario_id');
    }

    /**
     * Define la relación: Una operación pertenece a un banco.
     */
    public function banco(): BelongsTo
    {
        return $this->belongsTo(Banco::class, 'banco_id');
    }
}