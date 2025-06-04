<?php

namespace App\Http\Controllers;

use App\Models\Operacion;    // Importa el modelo Operacion
use App\Models\Categoria;    // Necesario para el select de categorías
use App\Models\User;         // Necesario para el select de usuarios (si aplica)
use App\Models\Banco;        // Necesario para el select de bancos
use Illuminate\Http\Request;

class OperacionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Carga las relaciones para mostrar el nombre de la categoría, usuario y banco
        $operaciones = Operacion::with(['categoria', 'usuario', 'banco'])->get();
        $bancos = Banco::all();
        $categorias = Categoria::all();
        return view('operaciones', compact('categorias','bancos','operaciones'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Se necesitan las categorías, usuarios y bancos para los selects en el formulario
        $categorias = Categoria::all();
        $users = User::all(); // Asumiendo que usas el modelo User por defecto
        $bancos = Banco::all();
        return view('operaciones.create', compact('categorias', 'users', 'bancos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         //dd($request->all());
      $request->validate([
            'tipo_operacion' => 'required|in:Ingreso,Gasto',
            'tipo_pago' => 'required|in:Tarjeta,Efectivo',
            'monto' => 'required|numeric|min:0.01',
            'fecha' => 'required|date',
            'categoria_id' => 'required|exists:categorias,id', // Valida que la categoría exista
           'usuario_id' => 'required|exists:users,id',       // Valida que el usuario exista
            'banco_id' => 'required|exists:bancos,id',         // Valida que el banco exista
        ]);

        Operacion::create($request->all());

        return redirect()->route('operaciones.index')
                         ->with('success', 'Operación creada exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Operacion $operacion)
    {
        // Carga las relaciones para mostrar el nombre de la categoría, usuario y banco
        $operacion->load(['categoria', 'usuario', 'banco']);
        return view('operaciones.show', compact('operacion'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Operacion $operacion)
    {
        $categorias = Categoria::all();
        $users = User::all();
        $bancos = Banco::all();
        return view('operaciones.edit', compact('operacion', 'categorias', 'users', 'bancos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Operacion $operacion)
    {
        $request->validate([
            'tipo_operacion' => 'required|in:Ingreso,Gasto',
            'tipo_pago' => 'required|in:Tarjeta,Efectivo',
            'monto' => 'required|numeric|min:0.01',
            'fecha' => 'required|date',
            'categoria_id' => 'required|exists:categorias,id',
            'usuario_id' => 'required|exists:users,id',
            'banco_id' => 'required|exists:bancos,id',
        ]);

        $operacion->update($request->all());

        return redirect()->route('operaciones')
                         ->with('success', 'Operación actualizada exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Operacion $operacion)
    {
        $operacion->delete();

        return redirect()->route('operaciones')
                         ->with('success', 'Operación eliminada exitosamente.');
    }
}