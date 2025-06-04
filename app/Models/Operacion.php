<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Operacion extends Model
{
    use HasFactory;

    protected $table = 'operaciones';

    protected $primaryKey = 'id';

    protected $keyType = 'int';

    public $incrementing = true;

    protected $fillable = [
        'tipo_operacion',
        'tipo_pago',
        'monto',
        'fecha',
        'categoria_id',
        'banco_id',
    ];

    // Si tu tabla no usa las columnas 'created_at' y 'updated_at', establece $timestamps en false.
    // Como tu migración sí las incluye, no hay necesidad de descomentar esta línea.
    // public $timestamps = false;

    /**
     * Define la relación: Una operación pertenece a una categoría.
     */
    public function categoria(): BelongsTo
    {
        return $this->belongsTo(Categoria::class, 'categoria_id');
    }

    /**
     * Define la relación: Una operación pertenece a un banco.
     */
    public function banco(): BelongsTo
    {
        return $this->belongsTo(Banco::class, 'banco_id');
    }
}