@extends('plantilla')
@section('contenido')
 <div class="seccion-principal"> <!--div para el fondo-->
    <div class="row mt-3">
        <div class="col-md-4 offset-md-4">
            <div class="d-grid mx-auto">
                <button class="btn btn-color-custom-darkblue" data-op="1" data-bs-toggle="modal" data-bs-target="#modalOperacion">
                    <i class="fa-solid fa-plus"></i> Añadir
                </button>
            </div>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-12 col-lg-8 offset-0 offset-lg-2">
            <div class="table-responsive">
                <table class="table table-bordered table-hover tabla-estilizada">
                    <thead>
                        <tr>
                        <th>#</th>
                        <th>Tipo de pago</th>
                        <th>Banco</th>
                        <th>Monto</th>
                        <th>Fecha</th>
                        <th>Establecimiento</th>
                        <th>Categoría</th>
                        <th></th>
                        </tr>
                    </thead>
                      <tbody class="table-group-divider">
                        @php $i=1;
                            
                        @endphp
                        @foreach ($operaciones as $row)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $row->operaciones }}</td>
                                <td><!--botón editar-->
                                    <a href="{{ url('operaciones',[$row]) }}" class="btn btn-warning"><i class="fa-solid fa-pen"></i></a>
                                </td>
                                <td><!--botón editar-->
                                   <form method="POST" action="{{ url('operaciones', [$row]) }}">
                                    @method("delete")
                                    @csrf
                                    <button class="btn btn-danger"><i class="fa-solid fa-trash"></i></button>
                                </form> 
                                </td>
                            </tr>
                        @endforeach
                      </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modalOperacion" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <label class="h5" id="titulo_modal">Añadir Operación</label>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="frmOperacion" method="POST" action="{{url("operaciones")}}">
          @csrf
           {{-- Tipo de Operación --}}
    <div class="input-group mb-3">
        <span class="input-group-text"><i class="fa-solid fa-exchange-alt"></i></span> {{-- Icono sugerido --}}
        <select name="tipo_operacion" class="form-control" required>
            <option value="">Seleccione Tipo de Operación</option>
            <option value="Ingreso">Ingreso</option>
            <option value="Gasto">Gasto</option>
        </select>
    </div>
          {{-- Tipo de Pago --}}
    <div class="input-group mb-3">
        <span class="input-group-text"><i class="fa-solid fa-wallet"></i></span>
        <select name="tipo_pago" class="form-control" required>
            <option value="">Seleccione Tipo de Pago</option>
            <option value="Tarjeta">Tarjeta</option>
            <option value="Efectivo">Efectivo</option>
        </select>
    </div>
          {{-- Banco --}}
    <div class="input-group mb-3">
        <span class="input-group-text"><i class="fa-solid fa-credit-card"></i></span>
        <select name="banco_id" class="form-control" required>
            <option value="">Seleccione un Banco</option>
            @isset($bancos)
                @foreach ($bancos as $row)
                    <option value="{{ $row->id }}">{{ $row->bancos }}</option>
            @endisset
        </select>
    </div>
     {{-- MONTO --}}
           <div class="input-group mb-3">
        <span class="input-group-text"><i class="fa-solid fa-dollar-sign"></i></span>
        <input type="number" name="monto" step="0.01" class="form-control" placeholder="Monto" required> {{-- Añadido step="0.01" para decimales --}}
    </div>
 {{-- fecha --}}
    <div class="input-group mb-3">
        <span class="input-group-text"><i class="fa-solid fa-calendar-days"></i></span>
        <input type="date" name="fecha" class="form-control" placeholder="Fecha" required>
    </div>
          {{-- Categoría --}}
    <div class="input-group mb-3">
        <span class="input-group-text"><i class="fa-solid fa-table"></i></span>
        <select name="categoria_id" class="form-control" required>
            <option value="">Seleccione una Categoría</option>
            {{-- Asumiendo que pasas $categorias a esta vista --}}
            @isset($categorias) {{-- Verifica si la variable $categorias existe --}}
                @foreach ($categorias as $categoria)
                    <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option> {{-- Ajusta 'nombre' al campo correcto --}}
                @endforeach
            @endisset
        </select>
    {{-- Campo oculto para usuario_id si no lo manejas automáticamente en el backend y lo necesitas del form --}}
    {{-- Si lo manejas con Auth::id() en el backend, no necesitas esto. --}}
    {{-- @auth
        <input type="hidden" name="usuario_id" value="{{ Auth::id() }}">
    @endauth --}}
          <div class="d-flex gap-4 col-12 mx-auto justify-content-center">
            <button class="btn btn-color-custom-cerulean"> Guardar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

</div
@endsection