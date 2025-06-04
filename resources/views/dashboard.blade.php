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
        <div class="balance-percentage @if(($balancePercentage ?? 0) >= 0) positive @else negative @endif">
            {{ number_format($balancePercentage ?? 0, 2) }}%
        </div>
        <div class="balance-actions">
            <span class="action-label">Mostrar menos</span>
            <i class="fa-solid fa-chevron-down action-icon"></i>
            <span class="action-time">Hace 24h</span>
            <i class="fa-solid fa-chevron-down action-icon"></i>
        </div>
    </div>

    <div class="card-list">
        @php
            $tarjetas = [
                ['id' => 1, 'color' => 'purple', 'monto_actual' => 25.895325, 'monto_anterior' => 8.89, 'cambio_porcentaje' => 89.759, 'tipo_cambio' => 4.88],
                ['id' => 2, 'color' => 'red', 'monto_actual' => 15.789325, 'monto_anterior' => 5.85, 'cambio_porcentaje' => 54.724, 'tipo_cambio' => 54.23],
                ['id' => 3, 'color' => 'gray', 'monto_actual' => 5.679121, 'monto_anterior' => 2.65, 'cambio_porcentaje' => 5.385, 'tipo_cambio' => -5.93],
            ];
        @endphp

        @foreach ($tarjetas as $tarjeta)
        <div class="card-item">
            <div class="card-icon-wrapper card-icon-{{ $tarjeta['color'] }}">
                <i class="fa-solid fa-dollar-sign"></i>
            </div>
            <div class="card-amounts">
                <div class="card-current-amount">${{ number_format($tarjeta['monto_actual'], 6) }}</div>
                <div class="card-prev-amount">${{ number_format($tarjeta['monto_anterior'], 2) }}</div>
            </div>
            <div class="card-percentage @if($tarjeta['tipo_cambio'] >= 0) positive @else negative @endif">
                <div class="card-percentage-main">${{ number_format($tarjeta['cambio_porcentaje'], 3) }}</div>
                <div class="card-percentage-change">{{ number_format($tarjeta['tipo_cambio'], 2) }}%</div>
            </div>
        </div>
        @endforeach
    </div>


    {{-- FIN BARRA DE NAVEGACIÓN INFERIOR --}}

</div>
@endsection

@section('scripts')
<script>
    console.log('Dashboard cargado con éxito.');
</script>
@endsection