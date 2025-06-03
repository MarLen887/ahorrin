<?php

namespace App\Http\Controllers;

use App\Models\Banco; // Importa el modelo Banco
use Illuminate\Http\Request;

class BancoController extends Controller
{
    /**
     * Display a listing of the resource.
     * Muestra una lista de los recursos (todos los bancos).
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bancos = Banco::all(); // Obtiene todos los registros de la tabla 'bancos'
        return view('bancos', compact('bancos')); // Retorna una vista (debes crearla) con los bancos
    }

    /**
     * Show the form for creating a new resource.
     * Muestra el formulario para crear un nuevo recurso (un nuevo banco).
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('bancos.create'); // Retorna la vista del formulario de creación
    }

    /**
     * Store a newly created resource in storage.
     * Guarda un recurso recién creado en el almacenamiento (la base de datos).
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validación de los datos del formulario
        $request->validate([
            'nombre' => 'required|string|max:255',
            'tipo_tarjeta' => 'required|in:D,C', // Asegura que sea 'D' o 'C'
        ]);

        // Crea un nuevo registro de Banco con los datos validados
        Banco::create($request->all());

        // Redirecciona al listado de bancos con un mensaje de éxito
        return redirect()->route('bancos.index')
                         ->with('success', 'Banco creado exitosamente.');
    }

    /**
     * Display the specified resource.
     * Muestra el recurso especificado (un banco individual).
     *
     * @param  \App\Models\Banco  $banco
     * @return \Illuminate\Http\Response
     */
    public function show(Banco $banco)
    {
        return view('bancos.show', compact('banco')); // Retorna la vista para mostrar un banco específico
    }

    /**
     * Show the form for editing the specified resource.
     * Muestra el formulario para editar el recurso especificado (un banco existente).
     *
     * @param  \App\Models\Banco  $banco
     * @return \Illuminate\Http\Response
     */
    public function edit(Banco $banco)
    {
        return view('bancos.edit', compact('banco')); // Retorna la vista del formulario de edición
    }

    /**
     * Update the specified resource in storage.
     * Actualiza el recurso especificado en el almacenamiento (la base de datos).
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Banco  $banco
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Banco $banco)
    {
        // Validación de los datos del formulario
        $request->validate([
            'nombre' => 'required|string|max:255',
            'tipo_tarjeta' => 'required|in:D,C',
        ]);

        // Actualiza el registro de Banco con los datos validados
        $banco->update($request->all());

        // Redirecciona al listado de bancos con un mensaje de éxito
        return redirect()->route('bancos.index')
                         ->with('success', 'Banco actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     * Elimina el recurso especificado del almacenamiento (la base de datos).
     *
     * @param  \App\Models\Banco  $banco
     * @return \Illuminate\Http\Response
     */
    public function destroy(Banco $banco)
    {
        $banco->delete(); // Elimina el registro del banco

        // Redirecciona al listado de bancos con un mensaje de éxito
        return redirect()->route('bancos.index')
                         ->with('success', 'Banco eliminado exitosamente.');
    }
}