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
                <table class="table table-bordered table-hover">
                    
                </table>
            </div>
        </div>
    </div>
</div
@endsection