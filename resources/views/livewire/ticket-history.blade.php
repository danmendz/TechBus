<div class="max-w-6xl mx-auto p-4 sm:p-6">
    @if($tickets->isEmpty())
        <div class="flex flex-col items-center justify-center min-h-[50vh] text-center py-12 px-4">
            <div class="relative w-72 h-72 mb-6">
                <img src="{{ asset('images/utilities/empty-car.png') }}" alt="Sin tickets" class="w-full h-full object-contain">
                <div class="absolute -bottom-2 -right-2 bg-blue-100 rounded-full p-4 animate-bounce">
                    <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5l7 7-7 7M5 5l7 7-7 7"></path>
                    </svg>
                </div>
            </div>
            <h3 class="text-2xl font-bold text-gray-800 mb-2">¡No hay tickets aún!</h3>
            <p class="text-gray-600 max-w-md mb-6">Explora nuestras rutas disponibles y reserva tu próximo viaje con comodidad.</p>
            <a href="{{ route('buy.tickets') }}" class="px-6 py-3 bg-gradient-to-r from-blue-600 to-blue-500 text-white rounded-lg shadow-md hover:from-blue-700 hover:to-blue-600 transition-all font-medium flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                </svg>
                Buscar viajes
            </a>
        </div>
    @else
        <div class="mb-6 flex justify-between items-center">
            <h2 class="text-2xl sm:text-3xl font-bold text-gray-800">Mis Tickets de Viaje</h2>
            <div class="text-sm text-gray-500">
                <span class="hidden sm:inline">Mostrando</span> {{ $tickets->count() }} {{ $tickets->count() === 1 ? 'ticket' : 'tickets' }}
            </div>
        </div>

        <div class="grid md:grid-cols-2 gap-6">
            @foreach($tickets as $ticket)
                @php
                    $detalles = json_decode($ticket->detalles_compra, true);
                    $total = array_sum(array_map(function($boleto) use ($detalles) {
                        return $detalles['precios'][$boleto['tipo_boleto']]['precio_total'];
                    }, $detalles['resumen_boletos']));
                @endphp

                <div class="bg-white border border-gray-200 rounded-xl overflow-hidden shadow-sm hover:shadow-md transition-all">
                    <!-- Encabezado con gradiente -->
                    <div class="bg-gradient-to-r from-blue-600 to-blue-500 p-4 text-white">
                        <div class="flex justify-between items-start">
                            <div>
                                <h3 class="text-lg font-bold">Ticket #{{ $ticket->codigo_referencia }}</h3>
                                <p class="text-sm opacity-90 flex items-center mt-1">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                    {{ $ticket->created_at->format('d/m/Y H:i') }}
                                </p>
                            </div>
                            <span class="px-2 py-1 bg-white bg-opacity-20 rounded-full text-xs font-medium">
                                {{ $ticket->created_at->diffForHumans() }}
                            </span>
                        </div>
                    </div>

                    <!-- Cuerpo del ticket -->
                    <div class="p-5">
                        <!-- Ruta y horario -->
                        <div class="mb-5">
                            <div class="flex items-start">
                                <div class="mr-4 text-blue-500">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-gray-700 mb-1">Ruta del viaje</h4>
                                    <p class="text-gray-800 font-medium mb-2">
                                        {{ $detalles['detalles_corrida']['origen'] }} → {{ $detalles['detalles_corrida']['destino'] }}
                                    </p>
                                    <div class="flex items-center text-sm text-gray-500">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                        {{ \Carbon\Carbon::createFromFormat('Y-m-d', $detalles['detalles_corrida']['fecha'])->format('d M, Y') }}
                                        <span class="mx-2">•</span>
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        {{ \Carbon\Carbon::createFromFormat('H:i:s', substr($detalles['detalles_corrida']['hora'], 0, 8))->format('h:i A') }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Detalle de boletos -->
                        <div class="mb-5">
                            <h4 class="font-semibold text-gray-700 mb-3 flex items-center">
                                <svg class="w-5 h-5 text-blue-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path>
                                </svg>
                                Detalle de Boletos
                            </h4>
                            <ul class="space-y-3">
                                @foreach($detalles['resumen_boletos'] as $boleto)
                                    <li class="flex justify-between items-center p-2 bg-gray-50 rounded-lg">
                                        <div class="flex items-center">
                                            <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center mr-3">
                                                <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                                </svg>
                                            </div>
                                            <div>
                                                <span class="font-medium text-gray-800">{{ $boleto['cantidad'] }} × {{ $boleto['tipo_boleto'] }}</span>
                                                <span class="block text-xs text-gray-500">Asiento: {{ $boleto['asiento'] }}</span>
                                            </div>
                                        </div>
                                        <span class="font-semibold text-blue-600">${{ number_format($detalles['precios'][$boleto['tipo_boleto']]['precio_total'], 2) }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        <!-- Total y acciones -->
                        <div class="pt-4 border-t border-gray-200">
                            <div class="flex justify-between items-center">
                                <div class="flex items-center text-gray-700">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <span class="font-medium">Total pagado:</span>
                                </div>
                                <div class="flex items-center">
                                    <span class="text-xl font-bold text-green-600 mr-3">${{ number_format($total, 2) }}</span>
                                    <button wire:click="downloadTicket('{{ $ticket->id }}')" 
                                            class="p-2 bg-blue-600 text-white rounded-full hover:bg-blue-700 transition flex items-center justify-center shadow-md"
                                            title="Descargar ticket">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>