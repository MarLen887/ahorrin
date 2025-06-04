@extends('plantilla')
@section('contenido')
    <div class="seccion-principal"> <div class="row mt-3">
            <div class="col-md-4 offset-md-4">
                <div class="d-grid mx-auto">
                    <button class="btn btn-color-custom-darkblue" data-op="1" data-bs-toggle="modal"
                        data-bs-target="#modalOperacion">
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
                                <th>Tipo de Operación</th>
                                <th>Tipo de Pago</th>
                                <th>Monto</th>
                                <th>Fecha</th>
                                <th>Categoría</th>
                                <th>Banco</th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody class="table-group-divider">
                            @php $i = 1; @endphp
                            @foreach ($operaciones as $row)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $row->tipo_operacion }}</td>
                                    <td>{{ $row->tipo_pago }}</td>
                                    <td>{{ number_format($row->monto, 2, '.', ',') }}</td> {{-- Formatear el monto --}}
                                    <td>{{ \Carbon\Carbon::parse($row->fecha)->format('d/m/Y') }}</td> {{-- Formatear la fecha --}}
                                    <td>{{ $row->categoria->tipo_categoria ?? 'N/A' }}</td> {{-- Accede al nombre de la categoría --}}
                                    <td>{{ $row->banco->nombre ?? 'N/A' }}</td> {{-- Accede al nombre del banco --}}
                                    <td><a href="{{ url('operaciones', [$row->id, 'edit']) }}" class="btn btn-warning"><i
                                                class="fa-solid fa-pen"></i></a>
                                    </td>
                                    <td><form method="POST" action="{{ url('operaciones', [$row->id]) }}">
                                            @method('delete')
                                            @csrf
                                            <button type="submit" class="btn btn-danger"><i class="fa-solid fa-trash"></i></button>
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
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form id="frmOperacion" method="POST" action="{{ url('operaciones') }}">
                            @csrf
                            {{-- Tipo de Operación --}}
                            <div class="input-group mb-3">
                                <span class="input-group-text"><i class="fa-solid fa-exchange-alt"></i></span>
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

                            {{-- MONTO --}}
                            <div class="input-group mb-3">
                                <span class="input-group-text"><i class="fa-solid fa-dollar-sign"></i></span>
                                <input type="number" name="monto" step="0.01" class="form-control" placeholder="Monto"
                                    required>
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
                                    @isset($categorias)
                                        @foreach ($categorias as $categoria) {{-- Cambiado $row a $categoria para claridad --}}
                                            <option value="{{ $categoria->id }}">{{ $categoria->tipo_categoria }}</option>
                                        @endforeach
                                    @endisset
                                </select>
                            </div>

                            {{-- Banco --}}
                            <div class="input-group mb-3">
                                <span class="input-group-text"><i class="fa-solid fa-credit-card"></i></span>
                                <select name="banco_id" class="form-control" required>
                                    <option value="">Seleccione un Banco</option>
                                    @isset($bancos)
                                        @foreach ($bancos as $banco) {{-- Cambiado $row a $banco para claridad --}}
                                            <option value="{{ $banco->id }}">{{ $banco->nombre }}</option>
                                        @endforeach
                                    @endisset
                                </select>
                            </div>
                            <div class="d-flex gap-4 col-12 mx-auto justify-content-center">
                                <button type="submit" class="btn btn-color-custom-cerulean"> Guardar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div> @endsection