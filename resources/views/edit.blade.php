@extends('plantilla') {

@section('contenido')
    <div class="container mt-4">
        <h2>Editar Operación</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Formulario para editar la operación --}}
        {{-- action debe apuntar a la ruta de update para el recurso, usando el ID de la operación --}}
        {{-- method debe ser POST, y Laravel lo interceptará como PUT/PATCH gracias a @method('PUT') --}}
        <form action="{{ route('operaciones.update', $operacion->id) }}" method="POST">
            @csrf
            @method('PUT') {{-- Esto es crucial para que Laravel lo interprete como una petición PUT --}}

            {{-- Tipo de Operación --}}
            <div class="mb-3">
                <label for="tipo_operacion" class="form-label">Tipo de Operación</label>
                <select name="tipo_operacion" id="tipo_operacion" class="form-control" required>
                    <option value="">Seleccione Tipo de Operación</option>
                    <option value="Ingreso" {{ $operacion->tipo_operacion == 'Ingreso' ? 'selected' : '' }}>Ingreso</option>
                    <option value="Gasto" {{ $operacion->tipo_operacion == 'Gasto' ? 'selected' : '' }}>Gasto</option>
                </select>
            </div>

            {{-- Tipo de Pago --}}
            <div class="mb-3">
                <label for="tipo_pago" class="form-label">Tipo de Pago</label>
                <select name="tipo_pago" id="tipo_pago" class="form-control" required>
                    <option value="">Seleccione Tipo de Pago</option>
                    <option value="Tarjeta" {{ $operacion->tipo_pago == 'Tarjeta' ? 'selected' : '' }}>Tarjeta</option>
                    <option value="Efectivo" {{ $operacion->tipo_pago == 'Efectivo' ? 'selected' : '' }}>Efectivo</option>
                </select>
            </div>

            {{-- MONTO --}}
            <div class="mb-3">
                <label for="monto" class="form-label">Monto</label>
                <input type="number" name="monto" id="monto" step="0.01" class="form-control" placeholder="Monto"
                    value="{{ old('monto', $operacion->monto) }}" required>
            </div>

            {{-- Fecha --}}
            <div class="mb-3">
                <label for="fecha" class="form-label">Fecha</label>
                <input type="date" name="fecha" id="fecha" class="form-control" placeholder="Fecha"
                    value="{{ old('fecha', $operacion->fecha) }}" required>
            </div>

            {{-- Categoría --}}
            <div class="mb-3">
                <label for="categoria_id" class="form-label">Categoría</label>
                <select name="categoria_id" id="categoria_id" class="form-control" required>
                    <option value="">Seleccione una Categoría</option>
                    @foreach ($categorias as $categoria)
                        <option value="{{ $categoria->id }}" {{ $operacion->categoria_id == $categoria->id ? 'selected' : '' }}>
                            {{ $categoria->tipo_categoria }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Banco --}}
            <div class="mb-3">
                <label for="banco_id" class="form-label">Banco</label>
                <select name="banco_id" id="banco_id" class="form-control" required>
                    <option value="">Seleccione un Banco</option>
                    @foreach ($bancos as $banco)
                        <option value="{{ $banco->id }}" {{ $operacion->banco_id == $banco->id ? 'selected' : '' }}>
                            {{ $banco->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
            <a href="{{ route('operaciones.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
@endsection