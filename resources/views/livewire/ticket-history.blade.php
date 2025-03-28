<div class="max-w-4xl mx-auto p-6">
    @if($tickets->isEmpty())
        <div class="flex flex-col items-center justify-center text-center">
            <img src="{{ asset('images/utilities/empty-car.png') }}" alt="Sin tickets" class="w-80 h-auto mb-4">
            <p class="text-gray-500 text-lg">Aún no has comprado ningún ticket. ¡Explora y reserva tu próximo viaje!</p>
        </div>
    @else
        <div class="grid md:grid-cols-2 gap-6">
            @foreach($tickets as $ticket)
                <div class="bg-white border rounded-xl p-5 shadow-lg transition-transform transform hover:scale-105">
                    <div class="flex justify-between items-start">
                        <div>
                            <h3 class="text-lg font-bold text-gray-800">Ticket:</h3>
                            <h4 class="text-lg font-bold text-gray-800">#{{ $ticket->codigo_referencia }}</h4>
                            <p class="text-sm text-gray-500 flex items-center">
                                <x-heroicon-o-calendar-days class="w-5 h-5 text-gray-400 mr-1" />
                                Comprado el: {{ $ticket->created_at->format('d/m/Y H:i') }}
                            </p>
                        </div>
                        <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-xs">
                            {{ $ticket->created_at->diffForHumans() }}
                        </span>
                    </div>

                    @php
                        $detalles = json_decode($ticket->detalles_compra, true);
                    @endphp

                    <div class="mt-4">
                        <h4 class="font-semibold text-gray-700 flex items-center">
                            <x-heroicon-o-map class="w-5 h-5 text-gray-500 mr-1" />
                            Viaje:
                        </h4>
                        <p class="text-gray-600 mb-2">{{ $detalles['detalles_corrida']['origen'] }} → {{ $detalles['detalles_corrida']['destino'] }}</p>

                        <h4 class="font-semibold text-gray-700 flex items-center">
                            <x-heroicon-o-calendar-days class="w-5 h-5 text-gray-500 mr-1" />
                            Fecha:
                        </h4>
                        <p class="text-gray-500 flex items-center">
                            {{ \Carbon\Carbon::createFromFormat('Y-m-d', $detalles['detalles_corrida']['fecha'])->format('F d, Y') }} | 
                            <x-heroicon-o-clock class="w-5 h-5 text-gray-400 mx-1" />
                            {{ \Carbon\Carbon::createFromFormat('H:i:s', substr($detalles['detalles_corrida']['hora'], 0, 8))->format('h:i A') }}
                        </p>
                    </div>

                    <div class="mt-4">
                        <h4 class="font-semibold text-gray-700 flex items-center">
                            <x-heroicon-o-ticket class="w-5 h-5 text-gray-500 mr-1" />
                            Boletos:
                        </h4>
                        <ul class="list-none">
                            @foreach($detalles['resumen_boletos'] as $boleto)
                                <li class="text-gray-600 flex items-center">
                                    <x-heroicon-o-check-circle class="w-5 h-5 text-green-500 mr-1" />
                                    <span class="ml-2">{{ $boleto['cantidad'] }} × {{ $boleto['tipo_boleto'] }} 
                                    (Asiento: {{ $boleto['asiento'] }}) 
                                    - <span class="font-semibold">${{ number_format($detalles['precios'][$boleto['tipo_boleto']]['precio_total'], 2) }}</span>
                                    </span>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    <div class="mt-4 pt-3 border-t flex justify-between items-center">
                        <span class="text-gray-600 flex items-center">
                            <x-heroicon-o-currency-dollar class="w-5 h-5 text-gray-500 mr-1" />
                            Total:
                        </span>
                        <div class="flex items-center gap-2">
                            <span class="text-lg font-bold text-green-600">
                                ${{ number_format(array_sum(array_map(function($boleto) use ($detalles) {
                                    return $detalles['precios'][$boleto['tipo_boleto']]['precio_total'];
                                }, $detalles['resumen_boletos'])), 2) }}
                            </span>
                            <!-- Botón de descarga -->
                            <button wire:click="downloadTicket('{{ $ticket->id }}')" 
                                    class="ml-2 px-3 py-1 bg-blue-600 text-white rounded hover:bg-blue-700 transition flex items-center">
                                <x-heroicon-o-arrow-down-tray class="w-4 h-4 mr-1" />
                                Ticket
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>