@extends('plantilla')

@section('contenido')
<div class="seccion-principal dashboard-container">
    <div class="header-dashboard">
        <h1 class="header-title">MI CARTERA INTELIGENTE</h1>
    </div>

    <div class="card-balance-total">
        <div class="balance-header">
            <span class="balance-label">Balance Total</span>
            <i class="fa-solid fa-wallet card-icon"></i>
        </div>
        <div class="balance-amount">
            ${{ number_format($balanceTotal ?? 0, 3, '.', ',') }}
        </div>
        {{-- SECCIÓN DEL PORCENTAJE ELIMINADA --}}
        {{--
        <div class="balance-percentage @if(($balancePercentage ?? 0) >= 0) positive @else negative @endif">
            {{ number_format($balancePercentage ?? 0, 2) }}%
        </div>
        --}}
        <div class="balance-actions">
            <span class="action-label">Mostrar menos</span>
            <i class="fa-solid fa-chevron-down action-icon"></i>
            <span class="action-time">Hace 24h</span>
            <i class="fa-solid fa-chevron-down action-icon"></i>
        </div>
    </div>

    {{-- Resto del contenido del dashboard (sin la card-list) --}}


</div>
@endsection

@section('scripts')
<script>
    console.log('Dashboard cargado con éxito.');
</script>
@endsection