<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// Si en el futuro necesitas interactuar con tus modelos de Banco, Operacion o Categoria,
// descomentarías las siguientes líneas:
// use App\Models\Banco;
// use App\Models\Operacion;
// use App\Models\Categoria;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource (o la vista principal del dashboard).
     */
    public function index()
    {
        // Aquí vamos a simular los datos por ahora,
        // pero en un proyecto real, estos datos vendrían de tu base de datos.

        $balanceTotal = 149.868; // Ejemplo de balance total
        $balancePercentage = 49.89; // Ejemplo de porcentaje de cambio (positivo)

        // Datos de ejemplo para las "tarjetas" o cuentas individuales
        $tarjetas = [
            ['id' => 1, 'color' => 'purple', 'monto_actual' => 25.895325, 'monto_anterior' => 8.89, 'cambio_porcentaje' => 89.759, 'tipo_cambio' => 4.88],
            ['id' => 2, 'color' => 'red', 'monto_actual' => 15.789325, 'monto_anterior' => 5.85, 'cambio_porcentaje' => 54.724, 'tipo_cambio' => 54.23],
            ['id' => 3, 'color' => 'gray', 'monto_actual' => 5.679121, 'monto_anterior' => 2.65, 'cambio_porcentaje' => 5.385, 'tipo_cambio' => -5.93], // Ejemplo de porcentaje negativo
        ];

        // Pasamos los datos a la vista
        return view('dashboard', compact('balanceTotal', 'balancePercentage', 'tarjetas'));
    }

    // Puedes añadir otros métodos aquí si el dashboard necesitara más funcionalidades
    // como mostrar detalles de una tarjeta específica, etc.
}