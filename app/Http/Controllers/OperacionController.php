<?php

namespace App\Http\Controllers;

use App\Models\Operacion;     // Importa el modelo Operacion
use App\Models\Categoria;     // Necesario para el select de categorías
use App\Models\Banco;         // Necesario para el select de bancos
use Illuminate\Http\Request;
// use App\Models\User; // Ya no necesitas importar User si no lo usas en el controlador

class OperacionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Carga las operaciones e incluye las relaciones 'categoria' y 'banco'
        $operaciones = Operacion::with(['categoria', 'banco'])->get();

        // También necesitas pasar las categorías y bancos para el modal "Añadir Operación"
        $categorias = Categoria::all();
        $bancos = Banco::all();

        return view('operaciones', compact('categorias', 'bancos', 'operaciones'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Se necesitan las categorías y bancos para los selects en el formulario
        $categorias = Categoria::all();
        $bancos = Banco::all();
        // Eliminamos 'users' y la referencia a 'users' en compact
        return view('operaciones.create', compact('categorias', 'bancos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all()); // Puedes descomentar para depurar el request

        $request->validate([
            'tipo_operacion' => 'required|in:Ingreso,Gasto',
            'tipo_pago' => 'required|in:Tarjeta,Efectivo',
            'monto' => 'required|numeric|min:0.01',
            'fecha' => 'required|date',
            'categoria_id' => 'required|exists:categorias,id', // Valida que la categoría exista
            'banco_id' => 'required|exists:bancos,id',         // Valida que el banco exista
        ]);

        Operacion::create($request->all());

        return redirect()->route('operaciones.index') // Asegúrate de que el nombre de la ruta sea 'operaciones.index'
            ->with('success', 'Operación creada exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Operacion $operacion)
    {
        // Carga las relaciones para mostrar el nombre de la categoría y banco
        $operacion->load(['categoria', 'banco']);
        return view('operaciones.show', compact('operacion'));
    }

    public function edit($id)
    {
        $operacion = Operacion::find($id);
        if (!$operacion) {
            return redirect()->route('operaciones.index')
                ->with('error', 'Operación no encontrada para editar.');
        }

        $categorias = Categoria::all();
        $bancos = Banco::all();
        return view('edit', compact('operacion', 'categorias', 'bancos'));
    }

    public function update(Request $request, $id)
    {
        $operacion = Operacion::find($id);
        if (!$operacion) {
            return redirect()->route('operaciones.index')
                ->with('error', 'Operación no encontrada para actualizar.');
        }
        $request->validate([
            'tipo_operacion' => 'required|in:Ingreso,Gasto',
            'tipo_pago' => 'required|in:Tarjeta,Efectivo',
            'monto' => 'required|numeric|min:0.01',
            'fecha' => 'required|date',
            'categoria_id' => 'required|exists:categorias,id',
            'banco_id' => 'required|exists:bancos,id',
        ]);
        $operacion->update($request->all());
        return redirect()->route('operaciones.index')
            ->with('success', 'Operación actualizada exitosamente.');
    }

    public function destroy(Operacion $operacion)
    {
        $operacion->delete();

        return redirect()->route('operaciones.index')
            ->with('success', 'Operación eliminada exitosamente.');
    }
}
