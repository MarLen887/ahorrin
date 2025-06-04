@extends('plantilla')

@section('contenido')
<div class="seccion-principal"> <div class="row mt-3">
        <div class="col-md-4 offset-md-4">
            <div class="d-grid mx-auto">
                <button class="btn btn-color-custom-darkblue" data-op="1" data-bs-toggle="modal" data-bs-target="#modalBancos"
                    onclick="openModal(1)"> {{-- Llama a openModal para modo Añadir --}}
                    <i class="fa-solid fa-plus"></i> Añadir Banco
                </button>
            </div>
        </div>
    </div>

    {{-- Mensajes de éxito o error (si usas with('success', ...) o with('error', ...) en el controlador) --}}
    @if (session('success'))
        <div class="alert alert-success mt-3 text-center" role="alert">
            {{ session('success') }}
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger mt-3 text-center" role="alert">
            {{ session('error') }}
        </div>
    @endif
    {{-- Muestra errores de validación si existen --}}
    @if ($errors->any())
        <div class="alert alert-danger mt-3">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="row mt-3">
        <div class="col-12 col-lg-8 offset-0 offset-lg-2">
            <div class="table-responsive">
                <table class="table table-bordered table-hover tabla-estilizada">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nombre del Banco</th>
                            <th>Tipo de Tarjeta</th>
                            <th></th> {{-- Columna para botón de Editar --}}
                            <th></th> {{-- Columna para botón de Eliminar --}}
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        @php $i = 1; @endphp
                        @isset($bancos)
                            @forelse ($bancos as $banco) {{-- Usamos @forelse para el caso de 0 registros --}}
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $banco->nombre }}</td>
                                    <td>{{ $banco->tipo_tarjeta == 'D' ? 'Débito' : 'Crédito' }}</td>
                                    <td>
                                        <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modalBancos"
                                            onclick="openModal(2, '{{ $banco->id }}', '{{ $banco->nombre }}', '{{ $banco->tipo_tarjeta }}')">
                                            <i class="fa-solid fa-pen"></i>
                                        </button>
                                    </td>
                                    <td>
                                        <form method="POST" action="{{ route('bancos.destroy', $banco->id) }}">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="btn btn-danger delete-btn">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">No hay bancos registrados.</td>
                                </tr>
                            @endforelse
                        @else
                            <tr>
                                <td colspan="5" class="text-center">No hay bancos registrados.</td>
                            </tr>
                        @endisset
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalBancos" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <label class="h5" id="titulo_modal_bancos">Añadir Banco</label>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="frmBanco" method="POST" action="">
                    @csrf
                    {{-- Campo oculto para simular método PUT/PATCH para actualizaciones --}}
                    <input type="hidden" name="_method" id="form_method" value="POST"> {{-- Valor inicial es POST --}}
                    <input type="hidden" id="id_banco" name="id_banco"> {{-- Para enviar el ID del banco en edición --}}

                    {{-- Campo Nombre del Banco --}}
                    <div class="input-group mb-3">
                        <span class="input-group-text"><i class="fa-solid fa-building-columns"></i></span>
                        <input type="text" name="nombre" id="nombre_banco" class="form-control" placeholder="Nombre del Banco" required>
                    </div>

                    {{-- Campo Tipo de Tarjeta --}}
                    <div class="input-group mb-3">
                        <span class="input-group-text"><i class="fa-solid fa-credit-card"></i></span>
                        <select name="tipo_tarjeta" id="tipo_tarjeta_banco" class="form-control" required>
                            <option value="">Seleccione Tipo de Tarjeta</option>
                            <option value="D">Débito</option>
                            <option value="C">Crédito</option>
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

@endsection

@section('scripts')
<script>
    // Función central para controlar la apertura del modal (crear o editar)
    function openModal(op, id = null, nombre = null, tipoTarjeta = null) {
        const modalTitle = document.getElementById('titulo_modal_bancos');
        const form = document.getElementById('frmBanco');
        const inputNombre = document.getElementById('nombre_banco');
        const inputTipoTarjeta = document.getElementById('tipo_tarjeta_banco');
        const inputId = document.getElementById('id_banco');
        const formMethod = document.getElementById('form_method');

        // Log para depuración: Ver qué valores recibe la función
        console.log('openModal llamado. Operación:', op);
        console.log('ID recibido:', id);
        console.log('Nombre recibido:', nombre);
        console.log('Tipo de Tarjeta recibido:', tipoTarjeta);

        if (op === 1) { // Modo: Añadir nuevo banco
            modalTitle.innerText = 'Añadir Banco';
            form.action = "{{ route('bancos.store') }}"; // La acción del formulario es la ruta de creación (POST)
            formMethod.value = 'POST'; // El campo oculto _method es POST
            inputNombre.value = ''; // Limpia el campo de nombre
            inputTipoTarjeta.value = ''; // Limpia el select (selecciona la opción vacía)
            inputId.value = ''; // Limpia el ID oculto
        } else if (op === 2) { // Modo: Editar banco existente
            modalTitle.innerText = 'Editar Banco';
            form.action = "{{ url('bancos') }}/" + id; // La acción del formulario es la ruta de actualización (PUT/PATCH con ID)
            formMethod.value = 'PUT'; // ¡CRUCIAL! Cambia el campo oculto _method a PUT
            inputNombre.value = nombre; // Precarga el nombre del banco
            inputTipoTarjeta.value = tipoTarjeta; // Precarga el tipo de tarjeta (D o C)
            inputId.value = id; // Establece el ID del banco en el campo oculto
            // Log para depuración: Confirmar que el valor se asignó al select
            console.log('Valor asignado al select de Tipo de Tarjeta:', inputTipoTarjeta.value);
        }
    }

    // Script para manejar la confirmación de eliminación con SweetAlert2
    document.addEventListener('DOMContentLoaded', function () {
        const deleteButtons = document.querySelectorAll('.delete-btn');
        deleteButtons.forEach(button => {
            button.addEventListener('click', function (event) {
                event.preventDefault(); // Evita que el formulario se envíe inmediatamente
                const form = this.closest('form');
                Swal.fire({
                    title: '¿Estás seguro?',
                    text: "¡No podrás revertir esto!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sí, eliminarlo!',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit(); // Envía el formulario si el usuario confirma
                    }
                });
            });
        });
    });

    // Opcional: Script para cerrar el modal después de un envío exitoso
    // Si tu controlador redirige con un mensaje de éxito, el modal ya estará cerrado al recargar la página.
    // Esto es más útil para formularios enviados con AJAX.
    // var modalElement = document.getElementById('modalBancos');
    // var modal = new bootstrap.Modal(modalElement);
    // @if(session('success'))
    //     modal.hide(); // Oculta el modal si hay un mensaje de éxito
    // @endif
</script>
@endsection