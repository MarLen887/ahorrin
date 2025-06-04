<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('plantilla');
});
Route::get('/', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard.index');
Route::resource('bancos', App\Http\Controllers\BancoController::class);
Route::resource('operaciones', App\Http\Controllers\OperacionController::class);
// ¡CRÍTICO: Añade o verifica esta línea para Categorías!
Route::resource('categorias', App\Http\Controllers\CategoriaController::class);
