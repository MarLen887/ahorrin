@extends('plantilla')
@section('contenido')
 <div class="seccion-principal"> <!--div para el fondo-->
    <div class="row mt-3">
        <div class="col-md-4 offset-md-4">
            <div class="d-grid mx-auto">
                <button class="btn btn-color-custom-darkblue" data-op="1" data-bs-toggle="modal" data-bs-target="#modalBancos">
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
                        @php $id=1;
                            
                        @endphp
                        @foreach ($categorias as $row)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $row->categoria }}</td>
                                <td><!--botón editar-->
                                    <a href="{{ url('categorias',[$row]) }}" class="btn btn-warning"><i class="fa-solid fa-pen"></i></a>
                                </td>
                                <td><!--botón editar-->
                                   <form method="POST" action="{{ url('categorias', [$row]) }}">
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
    <div class="modal fade" id="modalBancos" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <label class="h5" id="titulo_modal">Añadir Categoría</label>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="frmCategorias" method="POST" action="{{url("categorias")}}">
          @csrf
          <div class="input-group mb-3">
            <span class="input-group-text"><i class="fa-solid fa-wallet"></i></span>
            <input type="text" name="pipo_pago" class="form-control" maxlength="50" placeholder="Tipo de pago" required>
          </div>
           <div class="input-group mb-3">
            <span class="input-group-text"><i class="fa-solid fa-credit-card"></i></i></span>
            <input type="text" name="banco" class="form-control" maxlength="50" placeholder="Banco" required>
          </div>
           <div class="input-group mb-3">
            <span class="input-group-text"><i class="fa-solid fa-dollar-sign"></i></span>
            <input type="number" name="monto" class="form-control" maxlength="50" placeholder="Monto" required>
          </div>
           <div class="input-group mb-3">
            <span class="input-group-text"><i class="fa-solid fa-calendar-days"></i></span>
            <input type="date" name="fecha" class="form-control" maxlength="50" placeholder="Fecha" required>
          </div>
           <div class="input-group mb-3">
            <span class="input-group-text"><i class="fa-solid fa-hotel"></i></span>
            <input type="text" name="establecimiento" class="form-control" maxlength="50" placeholder="Establecimiento" required>
          </div>
           <div class="input-group mb-3">
            <span class="input-group-text"><i class="fa-solid fa-table"></i></span>
            <input type="text" name="categoria" class="form-control" maxlength="50" placeholder="Categoría" required>
          </div>
          <div class="d-flex gap-4 col-12 mx-auto justify-content-center">
            <button type="button" id="btnCerrar" class="btn btn-color-custom-darkblue" data-bs-dismiss="modal">Cerrar</button>
            <button class="btn btn-color-custom-cerulean"><i class="fa-solid fa-floppy-disk"></i> Guardar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

</div
@endsection