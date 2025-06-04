<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Operacion;

class DashboardController extends Controller
{
    public function index()
    {
        // --- Cálculo del Balance Total ---
        $totalIngresos = Operacion::where('tipo_operacion', 'Ingreso')->sum('monto');
        $totalGastos = Operacion::where('tipo_operacion', 'Gasto')->sum('monto');
        $balanceTotal = $totalIngresos - $totalGastos;

        // --- ELIMINADA LA DEFINICIÓN DE $balancePercentage ---
        // $balancePercentage = 0.0;

        // Pasamos solo los datos que se usarán en la vista
        return view('dashboard', compact('balanceTotal')); // Eliminada 'balancePercentage'
    }
}