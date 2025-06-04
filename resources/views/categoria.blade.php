@extends('plantilla')

@section('contenido')
<div class="seccion-principal"> <!-- div para el fondo -->
    <div class="row mt-3">
        <div class="col-md-4 offset-md-4">
            <div class="d-grid mx-auto">
                <button class="btn btn-color-custom-darkblue" data-op="1" data-bs-toggle="modal" data-bs-target="#modalCategorias"
                    onclick="openModal(1)"> {{-- Llama a openModal para modo Añadir --}}
                    <i class="fa-solid fa-plus"></i> Añadir Categoría
                </button>
            </div>
        </div>
    </div>

    {{-- Mensajes de éxito o error --}}
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
                            <th>Establecimiento</th> {{-- Cambiado de 'Nombre de la Categoría' --}}
                            <th>Tipo de Categoría</th> {{-- Nuevo campo --}}
                            <th></th> {{-- Columna para botón de Editar --}}
                            <th></th> {{-- Columna para botón de Eliminar --}}
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        @php $i = 1; @endphp
                        @isset($categorias)
                            @forelse ($categorias as $categoria)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $categoria->establecimiento }}</td> {{-- Muestra establecimiento --}}
                                    <td>{{ $categoria->tipo_categoria }}</td> {{-- Muestra tipo_categoria --}}
                                    <td>
                                        <!-- Botón editar: Envía ID, Establecimiento y Tipo de Categoría al JavaScript -->
                                        <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modalCategorias"
                                            onclick="openModal(2, '{{ $categoria->id }}', '{{ $categoria->establecimiento }}', '{{ $categoria->tipo_categoria }}')">
                                            <i class="fa-solid fa-pen"></i>
                                        </button>
                                    </td>
                                    <td>
                                        <!-- Botón eliminar: Formulario DELETE -->
                                        <form method="POST" action="{{ route('categorias.destroy', $categoria->id) }}">
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
                                    <td colspan="5" class="text-center">No hay categorías registradas.</td> {{-- Colspan ajustado a 5 --}}
                                </tr>
                            @endforelse
                        @else
                            <tr>
                                <td colspan="5" class="text-center">No hay categorías registradas.</td>
                            </tr>
                        @endisset
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal para Añadir/Editar Categoría -->
<div class="modal fade" id="modalCategorias" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <label class="h5" id="titulo_modal_categorias">Añadir Categoría</label>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="frmCategoria" method="POST" action="">
                    @csrf
                    {{-- Campo oculto para simular método PUT/PATCH --}}
                    <input type="hidden" name="_method" id="form_method" value="POST">
                    <input type="hidden" id="id_categoria" name="id_categoria">

                    {{-- Campo Establecimiento --}}
                    <div class="input-group mb-3">
                        <span class="input-group-text"><i class="fa-solid fa-store"></i></span> {{-- Icono sugerido para establecimiento --}}
                        <input type="text" name="establecimiento" id="establecimiento_categoria" class="form-control" placeholder="Establecimiento" required>
                    </div>

                    {{-- Campo Tipo de Categoría --}}
                    <div class="input-group mb-3">
                        <span class="input-group-text"><i class="fa-solid fa-list-alt"></i></span> {{-- Icono sugerido para tipo de categoría --}}
                        <input type="text" name="tipo_categoria" id="tipo_categoria_input" class="form-control" placeholder="Tipo de Categoría" required>
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
    // Ahora recibe 'establecimiento' y 'tipoCategoria'
    function openModal(op, id = null, establecimiento = null, tipoCategoria = null) {
        const modalTitle = document.getElementById('titulo_modal_categorias');
        const form = document.getElementById('frmCategoria');
        const inputEstablecimiento = document.getElementById('establecimiento_categoria'); // Referencia al campo establecimiento
        const inputTipoCategoria = document.getElementById('tipo_categoria_input'); // Referencia al campo tipo_categoria
        const inputId = document.getElementById('id_categoria');
        const formMethod = document.getElementById('form_method');

        // Log para depuración
        console.log('openModal Categoria llamado. Operación:', op);
        console.log('ID recibido:', id);
        console.log('Establecimiento recibido:', establecimiento);
        console.log('Tipo de Categoría recibido:', tipoCategoria);

        if (op === 1) { // Modo: Añadir nueva categoría
            modalTitle.innerText = 'Añadir Categoría';
            form.action = "{{ route('categorias.store') }}";
            formMethod.value = 'POST';
            inputEstablecimiento.value = ''; // Limpia el campo
            inputTipoCategoria.value = ''; // Limpia el campo
            inputId.value = '';
        } else if (op === 2) { // Modo: Editar categoría existente
            modalTitle.innerText = 'Editar Categoría';
            form.action = "{{ url('categorias') }}/" + id;
            formMethod.value = 'PUT';
            inputEstablecimiento.value = establecimiento; // Precarga establecimiento
            inputTipoCategoria.value = tipoCategoria; // Precarga tipo_categoria
            inputId.value = id;
            console.log('Valores precargados: Establecimiento:', inputEstablecimiento.value, 'Tipo Categoría:', inputTipoCategoria.value);
        }
    }

    // Script para manejar la confirmación de eliminación con SweetAlert2
    document.addEventListener('DOMContentLoaded', function () {
        const deleteButtons = document.querySelectorAll('.delete-btn');
        deleteButtons.forEach(button => {
            button.addEventListener('click', function (event) {
                event.preventDefault();
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
                        form.submit();
                    }
                });
            });
        });
    });
</script>
@endsection