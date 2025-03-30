@php
    $estilo = '';
    $tooltip = '';
    if ($asiento['estatus_asiento'] === 'ocupado') {
        $estilo = 'bg-red-500 cursor-not-allowed';
        $tooltip = 'Asiento ocupado';
    } elseif ($asiento['estatus_asiento'] === 'no disponible') {
        $estilo = 'bg-gray-500 hover:bg-gray-600';
        $tooltip = 'Asiento no disponible';
    } elseif (in_array($asiento['id'], $asientosSeleccionados)) {
        $estilo = 'bg-green-500 hover:bg-green-600';
        $tooltip = 'Asiento seleccionado';
    } else {
        $estilo = 'bg-blue-500 hover:bg-blue-600';
        $tooltip = 'Asiento disponible';
    }
@endphp

<button wire:click="selectAsiento({{ $asiento['id'] }})"
    class="p-3 rounded-lg text-white font-bold {{ $estilo }} transition transform hover:scale-105 relative group"
    @if ($asiento['estatus_asiento'] === 'ocupado') disabled @endif
    title="{{ $tooltip }}">
    {{ $asiento['numero_asiento'] }}
    <span class="absolute -top-8 left-1/2 transform -translate-x-1/2 bg-black text-white text-xs px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition-opacity">
        {{ $tooltip }}
    </span>
</button>