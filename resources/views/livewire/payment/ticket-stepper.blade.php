<div>
    {{-- @section('content') --}}
    <div class="p-6 bg-gray-100 min-h-screen">
        <!-- Paso 1: Formulario de Búsqueda -->
        @if ($currentStep == 1)
            <div class="max-w-4xl mx-auto bg-white p-8 rounded-lg shadow-lg">
                <h2 class="text-2xl font-bold mb-6 text-center">Busca tu corrida</h2>
                <div class="space-y-4">
                    <select wire:model="origen" class="w-full p-2 border border-gray-300 rounded-lg">
                        <option value="">Selecciona un origen</option>
                        @foreach ($origenes as $origen)
                            <option value="{{ $origen->id }}">{{ $origen->nombre }}</option>
                        @endforeach
                    </select>

                    <select wire:model="destino" class="w-full p-2 border border-gray-300 rounded-lg">
                        <option value="">Selecciona un destino</option>
                        @foreach ($destinos as $destino)
                            <option value="{{ $destino->id }}">{{ $destino->nombre }}</option>
                        @endforeach
                    </select>

                    <input type="date" wire:model="fecha" class="w-full p-2 border border-gray-300 rounded-lg">

                    <select wire:model="horario" class="w-full p-2 border border-gray-300 rounded-lg">
                        <option value="">Selecciona un horario</option>
                        @foreach ($horarios as $horario)
                            <option value="{{ $horario->id }}">
                                {{ \Carbon\Carbon::parse($horario->hora)->format('h:i A') }}</option>
                        @endforeach
                    </select>

                    <button wire:click="loadCorridasDisponibles"
                        class="w-full bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">
                        Buscar Corridas
                    </button>
                </div>
            </div>
        @endif

        <!-- Paso 2: Lista de Corridas Disponibles -->
        @if ($currentStep == 2)
            <div class="max-w-4xl mx-auto bg-white p-8 rounded-lg shadow-lg">
                <h2 class="text-2xl font-bold mb-6 text-center">Corridas Disponibles</h2>

                @if ($corridasDisponibles->isEmpty())
                    <div class="mt-6 p-4 bg-yellow-100 border border-yellow-400 text-yellow-700 rounded-lg">
                        No se encontraron corridas con las características seleccionadas. Por favor, intenta con otros
                        filtros.
                    </div>
                @else
                    <ul class="mt-6 space-y-2">
                        @foreach ($corridasDisponibles as $corrida)
                            <li wire:click="selectCorrida({{ $corrida->id }})"
                                class="p-4 bg-gray-50 rounded-lg cursor-pointer hover:bg-gray-100">
                                <div class="flex justify-between items-center">
                                    <div>
                                        <p class="font-semibold">{{ $corrida->ruta->origen->nombre }} →
                                            {{ $corrida->ruta->destino->nombre }}</p>
                                        <p class="text-sm text-gray-600">
                                            {{ \Carbon\Carbon::parse($corrida->fecha)->format('d/m/Y') }} -
                                            {{ \Carbon\Carbon::parse($corrida->horario->hora)->format('h:i A') }}</p>
                                    </div>
                                    <span class="text-blue-500 font-bold">Seleccionar</span>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
        @endif

        <!-- Paso 2: Selección del Número de Boletos -->
        @if ($currentStep == 3)
            <div class="max-w-4xl mx-auto bg-white p-8 rounded-lg shadow-lg">
                <h2 class="text-2xl font-bold mb-6 text-center">Selecciona el Número de Boletos</h2>
                <div class="space-y-4">
                    @foreach ($tiposBoleto as $tipo)
                        <div class="flex items-center justify-between">
                            <label class="font-medium">{{ $tipo->tipo }}</label>
                            <div class="flex items-center space-x-2">
                                <!-- Botón para disminuir la cantidad -->
                                <button wire:click="decrementarBoleto({{ $tipo->id }})"
                                    class="p-2 bg-gray-200 rounded-lg hover:bg-gray-300">
                                    -
                                </button>
                                <!-- Cantidad actual -->
                                <span class="w-8 text-center">{{ $cantidadBoletos[$tipo->id] ?? 0 }}</span>
                                <!-- Botón para aumentar la cantidad -->
                                <button wire:click="incrementarBoleto({{ $tipo->id }})"
                                    class="p-2 bg-gray-200 rounded-lg hover:bg-gray-300">
                                    +
                                </button>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-6 text-right">
                    <strong class="text-lg">Precio Total:</strong>
                    <span class="text-xl font-bold text-blue-600">${{ $precioTotal }}</span>
                </div>
            </div>
        @endif

        <!-- Paso 3: Selección de Asientos -->
        @if ($currentStep == 4)
            <div class="max-w-4xl mx-auto bg-white p-8 rounded-lg shadow-lg">
                <h2 class="text-2xl font-bold mb-6 text-center">Selecciona tus Asientos</h2>
                <div class="mt-6 text-right">
                    <strong class="text-lg">Precio Total:</strong>
                    <span class="text-xl font-bold text-blue-600">${{ $precioTotal }}</span>
                </div>

                <!-- Indicador del boleto actual -->
                @if ($boletoActual < array_sum($cantidadBoletos))
                    @php
                        $tiposExpandido = [];
                        foreach ($cantidadBoletos as $tipoId => $cantidad) {
                            for ($i = 0; $i < $cantidad; $i++) {
                                $tiposExpandido[] = $tipoId;
                            }
                        }
                    
                        $tipoBoletoActual = isset($tiposExpandido[$boletoActual]) ? $tiposBoleto->firstWhere('id', $tiposExpandido[$boletoActual]) : null;
                    @endphp
                    @if ($tipoBoletoActual)
                        <div class="bg-blue-100 border border-blue-400 text-blue-700 px-4 py-3 rounded mb-4">
                            Seleccionando asiento para el boleto {{ $boletoActual + 1 }} de tipo
                            {{ $tipoBoletoActual->tipo }}.
                        </div>
                    @endif
                @else
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                        Todos los asientos han sido seleccionados.
                    </div>
                @endif

                <!-- Mensaje de error -->
                @if (session()->has('error'))
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                        {{ session('error') }}
                    </div>
                @endif

                <!-- Grid de asientos -->
                <div class="grid grid-cols-4 gap-4">
                    @foreach ($asientosDisponibles as $asiento)
                        @php
                            $estilo = '';
                            if ($asiento['estatus_asiento'] === 'ocupado') {
                                $estilo = 'bg-red-500 cursor-not-allowed';
                            } elseif ($asiento['estatus_asiento'] === 'silla_ruedas') {
                                $estilo = 'bg-purple-500';
                            } elseif (in_array($asiento['id'], $asientosSeleccionados)) {
                                $estilo = 'bg-green-500';
                            } else {
                                $estilo = 'bg-blue-500 hover:bg-blue-600';
                            }
                        @endphp
                        <button wire:click="selectAsiento({{ $asiento['id'] }})"
                            class="p-4 rounded-lg text-white font-bold {{ $estilo }}"
                            @if ($asiento['estatus_asiento'] === 'ocupado') disabled @endif>
                            {{ $asiento['numero_asiento'] }}
                        </button>
                    @endforeach
                </div>
            </div>
        @endif

        <!-- Paso 5: Resumen de la Compra -->
        @if ($currentStep == 5)
            <div class="max-w-4xl mx-auto bg-white p-8 rounded-lg shadow-lg">
                <h2 class="text-2xl font-bold mb-6 text-center">Resumen de tu Compra</h2>
                <div class="space-y-4">
                    <!-- Detalle de la partida -->
                    <div>
                        <p class="font-semibold">{{ $resumenCorrida['origen'] }} → {{ $resumenCorrida['destino'] }}
                        </p>
                        <p class="text-sm text-gray-600">
                            {{ \Carbon\Carbon::parse($resumenCorrida['fecha'])->format('d/m/Y') }} -
                            {{ \Carbon\Carbon::parse($resumenCorrida['hora'])->format('h:i A') }}
                        </p>
                    </div>

                    <!-- Resumen de boletos y asientos -->
                    <div>
                        <strong>Boletos y Asientos:</strong>
                        <ul class="mt-2 space-y-2">
                            @foreach ($resumenBoletos as $boleto)
                                <li class="bg-gray-50 p-3 rounded-lg">
                                    <span class="font-medium">{{ $boleto['tipo_boleto'] }}</span> -
                                    <span>Asiento: {{ $boleto['asiento'] }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    <p><strong>Precio Total:</strong> ${{ $precioTotal }}</p>
                </div>

                <x-filament::button
                    wire:click="confirmarCompra"
                    icon="heroicon-m-check"
                    icon-position="after"
                    class="mt-3 w-full inline-block rounded-full border border-green-600 bg-green-500 p-3 hover:bg-gradient-to-r hover:from-green-600 hover:to-green-500 hover:text-white focus:outline-none focus:ring active:text-green-500">
                    Confirmar Compra
                </x-filament::button>
            </div>
        @endif

        <!-- Controles de Navegación -->
        <div class="flex justify-between mt-6 max-w-4xl mx-auto">
            @if ($currentStep > 1)
                <button wire:click="previousStep" class="bg-gray-500 text-white px-6 py-2 rounded-lg hover:bg-gray-600">
                    Anterior
                </button>
            @endif
            @if ($currentStep < 5 and $currentStep != 1)
                <button wire:click="nextStep" class="bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600">
                    Siguiente
                </button>
            @endif
        </div>
    </div>
    {{-- @endsection --}}
</div>
