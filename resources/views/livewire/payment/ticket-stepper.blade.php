<div>
    <x-alpine-notifications />
    <div class="min-h-screen bg-gradient-to-b from-blue-50 to-white">
        <!-- Barra de progreso -->
        <div class="bg-white shadow-sm">
            <div class="max-w-4xl mx-auto px-4 py-3">
                <div class="flex items-center justify-between">
                    @foreach([1, 2, 3, 4, 5] as $step)
                        <div class="flex flex-col items-center">
                            <div class="w-10 h-10 rounded-full flex items-center justify-center 
                                {{ $currentStep >= $step ? 'bg-blue-600 text-white' : 'bg-gray-200 text-gray-600' }}
                                {{ $currentStep == $step ? 'ring-4 ring-blue-300' : '' }}">
                                {{ $step }}
                            </div>
                            <span class="text-xs mt-1 font-medium {{ $currentStep >= $step ? 'text-blue-600' : 'text-gray-500' }}">
                                @if($step == 1) Búsqueda
                                @elseif($step == 2) Corridas
                                @elseif($step == 3) Boletos
                                @elseif($step == 4) Asientos
                                @else Resumen
                                @endif
                            </span>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Contenido principal -->
        <div class="p-6">
            <!-- Paso 1: Formulario de Búsqueda -->
            @if ($currentStep == 1)
                <div class="max-w-2xl mx-auto bg-white p-8 rounded-xl shadow-md border border-gray-100">
                    <h2 class="text-3xl font-bold mb-6 text-center text-blue-800">Busca tu corrida</h2>
                    <div class="space-y-5">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Origen</label>
                            <select wire:model="origen" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                                <option value="">Selecciona un origen</option>
                                @foreach ($origenes as $origen)
                                    <option value="{{ $origen->id }}">{{ $origen->nombre }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Destino</label>
                            <select wire:model="destino" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                                <option value="">Selecciona un destino</option>
                                @foreach ($destinos as $destino)
                                    <option value="{{ $destino->id }}">{{ $destino->nombre }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Fecha</label>
                            <input type="date" wire:model="fecha" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Horario</label>
                            <select wire:model="horario" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                                <option value="">Selecciona un horario</option>
                                @foreach ($horarios as $horario)
                                    <option value="{{ $horario->id }}">
                                        {{ \Carbon\Carbon::parse($horario->hora)->format('h:i A') }}</option>
                                @endforeach
                            </select>
                        </div>

                        <x-filament::button 
                            wire:click="loadCorridasDisponibles"
                            icon="heroicon-m-arrow-right"
                            icon-position="after"
                            class="w-full bg-gradient-to-r from-blue-600 to-blue-500 text-white px-4 py-3 rounded-lg hover:from-blue-700 hover:to-blue-600 transition-all shadow-md font-medium"
                            >
                            Siguiente
                        </x-filament::button>
                    </div>
                </div>
            @endif

            <!-- Paso 2: Lista de Corridas Disponibles -->
            @if ($currentStep == 2)
                <div class="max-w-2xl mx-auto bg-white p-8 rounded-xl shadow-md border border-gray-100">
                    <h2 class="text-3xl font-bold mb-6 text-center text-blue-800">Corridas Disponibles</h2>

                    @if ($corridasDisponibles->isEmpty())
                        <div class="mt-6 p-4 bg-yellow-50 border border-yellow-200 text-yellow-700 rounded-lg">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                </svg>
                                <span>No se encontraron corridas con las características seleccionadas.</span>
                            </div>
                        </div>
                    @else
                        <ul class="mt-6 space-y-3">
                            @foreach ($corridasDisponibles as $corrida)
                                <li wire:click="selectCorrida({{ $corrida->id }})"
                                    class="p-4 border border-gray-200 rounded-lg cursor-pointer hover:border-blue-300 hover:bg-blue-50 transition group">
                                    <div class="flex justify-between items-center">
                                        <div>
                                            <p class="font-semibold text-lg group-hover:text-blue-700 transition">
                                                {{ $corrida->ruta->origen->nombre }} → {{ $corrida->ruta->destino->nombre }}
                                            </p>
                                            <p class="text-sm text-gray-600">
                                                {{ \Carbon\Carbon::parse($corrida->fecha)->format('d/m/Y') }} -
                                                {{ \Carbon\Carbon::parse($corrida->horario->hora)->format('h:i A') }}
                                            </p>
                                        </div>
                                        <span class="text-blue-500 font-bold flex items-center">
                                            Seleccionar
                                            <svg class="w-5 h-5 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                            </svg>
                                        </span>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            @endif

            <!-- Paso 3: Selección del Número de Boletos -->
            @if ($currentStep == 3)
                <div class="max-w-2xl mx-auto bg-white p-8 rounded-xl shadow-md border border-gray-100">
                    <h2 class="text-3xl font-bold mb-6 text-center text-blue-800">Selecciona tus Boletos</h2>
                    <div class="space-y-6">
                        @foreach ($tiposBoleto as $tipo)
                            <div class="flex items-center justify-between p-4 border border-gray-200 rounded-lg hover:border-blue-300 transition">
                                <div>
                                    <label class="font-medium text-gray-800">{{ $tipo->tipo }}</label>
                                    <p class="text-sm text-gray-500 mt-1">${{ number_format($tipo->precio, 2) }} c/u</p>
                                </div>
                                <div class="flex items-center space-x-3">
                                    <!-- Botón para disminuir la cantidad -->
                                    <button wire:click="decrementarBoleto({{ $tipo->id }})"
                                        class="w-10 h-10 bg-gray-100 rounded-lg hover:bg-gray-200 flex items-center justify-center transition">
                                        <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4" />
                                        </svg>
                                    </button>
                                    <!-- Cantidad actual -->
                                    <span class="w-10 text-center text-lg font-medium">{{ $cantidadBoletos[$tipo->id] ?? 0 }}</span>
                                    <!-- Botón para aumentar la cantidad -->
                                    <button wire:click="incrementarBoleto({{ $tipo->id }})"
                                        class="w-10 h-10 bg-gray-100 rounded-lg hover:bg-gray-200 flex items-center justify-center transition">
                                        <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="mt-8 p-4 bg-blue-50 rounded-lg border border-blue-100">
                        <div class="flex justify-between items-center">
                            <strong class="text-lg text-gray-700">Precio Total:</strong>
                            <span class="text-2xl font-bold text-blue-600">${{ number_format($precioTotal, 2) }}</span>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Paso 4: Selección de Asientos -->
            @if ($currentStep == 4)
            <div class="max-w-4xl mx-auto bg-white p-8 rounded-xl shadow-md border border-gray-100">
                <h2 class="text-3xl font-bold mb-6 text-center text-blue-800">Selecciona tus Asientos</h2>
                
                <div class="mb-6 p-4 bg-blue-50 rounded-lg border border-blue-100">
                    <div class="flex justify-between items-center">
                        <strong class="text-lg text-gray-700">Precio Total:</strong>
                        <span class="text-2xl font-bold text-blue-600">${{ number_format($precioTotal, 2) }}</span>
                    </div>
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
                        <div class="bg-blue-100 border border-blue-200 text-blue-800 px-4 py-3 rounded-lg mb-6 flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2h-1V9z" clip-rule="evenodd" />
                            </svg>
                            <span>Seleccionando asiento para el boleto {{ $boletoActual + 1 }} de tipo <strong>{{ $tipoBoletoActual->tipo }}</strong>.</span>
                        </div>
                    @endif
                @else
                    <div class="bg-green-100 border border-green-200 text-green-800 px-4 py-3 rounded-lg mb-6 flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                        <span>Todos los asientos han sido seleccionados.</span>
                    </div>
                @endif

                <!-- Mensaje de error -->
                @if (session()->has('error'))
                    <div class="bg-red-100 border border-red-200 text-red-800 px-4 py-3 rounded-lg mb-6 flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                        </svg>
                        {{ session('error') }}
                    </div>
                @endif

                <!-- Leyenda de asientos -->
                <div class="mb-6 flex flex-wrap gap-3 justify-center">
                    <div class="flex items-center">
                        <div class="w-4 h-4 bg-blue-500 rounded mr-1"></div>
                        <span class="text-xs text-gray-600">Disponible</span>
                    </div>
                    <div class="flex items-center">
                        <div class="w-4 h-4 bg-green-500 rounded mr-1"></div>
                        <span class="text-xs text-gray-600">Seleccionado</span>
                    </div>
                    <div class="flex items-center">
                        <div class="w-4 h-4 bg-red-500 rounded mr-1"></div>
                        <span class="text-xs text-gray-600">Ocupado</span>
                    </div>
                    <div class="flex items-center">
                        <div class="w-4 h-4 bg-gray-500 rounded mr-1"></div>
                        <span class="text-xs text-gray-600">No disponible</span>
                    </div>
                    <div class="flex items-center">
                        <div class="w-4 h-4 bg-yellow-500 rounded mr-1"></div>
                        <span class="text-xs text-gray-600">Conductor</span>
                    </div>
                </div>

                <!-- Representación del autobús -->
                <div class="border-4 border-gray-800 rounded-lg p-6 relative bg-gray-100">
                    <!-- Parte frontal del autobús -->
                    <div class="absolute top-0 left-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-white px-4 text-gray-800 font-bold text-sm">
                        PARTE DELANTERA
                    </div>
                    
                    <!-- Asiento del conductor -->
                    <div class="absolute left-6 top-4">
                        <div class="p-3 rounded-lg bg-yellow-500 text-white font-bold text-center cursor-not-allowed" title="Asiento del conductor">
                            <x-heroicon-o-user class="w-6 h-6 mx-auto"/>
                        </div>
                    </div>

                    <!-- Pasillo central -->
                    <div class="h-full w-16 bg-gray-300 absolute left-1/2 transform -translate-x-1/2"></div>

                    <!-- Bloques de asientos -->
                    <div class="flex justify-between h-64">
                        <!-- Asientos izquierdos (2-2) -->
                        <div class="w-5/12 flex flex-col justify-between mt-14">
                            <div class="grid grid-cols-2 gap-3">
                                @foreach($asientosDisponibles->take(8) as $asiento)
                                    @if($loop->odd)
                                        @include('partials.asiento', ['asiento' => $asiento])
                                    @endif
                                @endforeach
                            </div>
                            <div class="grid grid-cols-2 gap-3 mt-4">
                                @foreach($asientosDisponibles->slice(8, 8) as $asiento)
                                    @if($loop->odd)
                                        @include('partials.asiento', ['asiento' => $asiento])
                                    @endif
                                @endforeach
                            </div>
                        </div>

                        <!-- Asientos derechos (2-2) -->
                        <div class="w-5/12 flex flex-col justify-between">
                            <div class="grid grid-cols-2 gap-3">
                                @foreach($asientosDisponibles->take(8) as $asiento)
                                    @if($loop->even)
                                        @include('partials.asiento', ['asiento' => $asiento])
                                    @endif
                                @endforeach
                            </div>
                            <div class="grid grid-cols-2 gap-3 mt-4">
                                @foreach($asientosDisponibles->slice(8, 8) as $asiento)
                                    @if($loop->even)
                                        @include('partials.asiento', ['asiento' => $asiento])
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <!-- Parte trasera del autobús -->
                    <div class="absolute bottom-0 left-1/2 transform -translate-x-1/2 translate-y-1/2 bg-white px-4 text-gray-800 font-bold text-sm">
                        PARTE TRASERA
                    </div>
                </div>
            </div>
            @endif

            <!-- Paso 5: Resumen de la Compra -->
            @if ($currentStep == 5)
                <div class="max-w-2xl mx-auto bg-white p-8 rounded-xl shadow-md border border-gray-100">
                    <h2 class="text-3xl font-bold mb-6 text-center text-blue-800">Resumen de tu Compra</h2>
                    
                    <div class="mb-8 p-6 bg-blue-50 rounded-xl border border-blue-100">
                        <!-- Detalle de la partida -->
                        <div class="mb-4 pb-4 border-b border-blue-200">
                            <h3 class="text-lg font-semibold text-blue-700 mb-2">Detalles del Viaje</h3>
                            <div class="flex items-center">
                                <svg class="w-6 h-6 text-blue-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                <div>
                                    <p class="font-semibold">{{ $resumenCorrida['origen'] }} → {{ $resumenCorrida['destino'] }}</p>
                                    <p class="text-sm text-gray-600">
                                        {{ \Carbon\Carbon::parse($resumenCorrida['fecha'])->format('d/m/Y') }} -
                                        {{ \Carbon\Carbon::parse($resumenCorrida['hora'])->format('h:i A') }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Resumen de boletos y asientos -->
                        <div class="mb-4">
                            <h3 class="text-lg font-semibold text-blue-700 mb-3">Detalles de los Boletos</h3>
                            <ul class="space-y-3">
                                @foreach ($resumenBoletos as $boleto)
                                    <li class="bg-white p-3 rounded-lg border border-gray-200 flex justify-between items-center">
                                        <div>
                                            <span class="font-medium">{{ $boleto['tipo_boleto'] }}</span>
                                            <span class="text-gray-500 mx-2">•</span>
                                            <span>Asiento {{ $boleto['asiento'] }}</span>
                                        </div>
                                        {{-- <span class="font-bold text-blue-600">${{ number_format($boleto['precio'], 2) }}</span> --}}
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        <div class="pt-4 border-t border-blue-200">
                            <div class="flex justify-between items-center">
                                <span class="text-lg font-semibold text-gray-700">Total a pagar:</span>
                                <span class="text-2xl font-bold text-blue-600">${{ number_format($precioTotal, 2) }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="flex flex-col sm:flex-row gap-3">
                        <x-filament::button 
                            wire:click="previousStep"
                            icon="heroicon-m-arrow-left"
                            icon-position="before"
                            class="flex-1 bg-gray-500 text-gray-800 px-6 py-3 rounded-lg hover:bg-gray-400 transition font-medium flex items-center justify-center"
                            >
                            Volver
                        </x-filament::button>
                        <x-filament::button 
                            wire:click="confirmarCompra"
                            icon="heroicon-m-arrow-right"
                            icon-position="after"
                            class="flex-1 bg-gradient-to-r from-green-600 to-green-500 text-white px-6 py-3 rounded-lg hover:from-green-700 hover:to-green-600 transition font-medium shadow-md flex items-center justify-center"
                            >
                            Confirmar Compra
                        </x-filament::button>
                    </div>
                </div>
            @endif

            <!-- Controles de Navegación -->
            @if ($currentStep > 1 && $currentStep < 5)
                <div class="flex justify-between mt-8 max-w-2xl mx-auto">
                        <x-filament::button 
                            wire:click="previousStep"
                            icon="heroicon-m-arrow-left"
                            icon-position="before"
                            class="bg-gray-500 text-gray-800 px-6 py-2 rounded-lg hover:bg-gray-400 transition font-medium flex items-center"
                            >
                            Anterior
                        </x-filament::button>
                    @if ($currentStep < 4 || ($currentStep == 4 && $boletoActual >= array_sum($cantidadBoletos)))
                        <x-filament::button 
                            wire:click="nextStep"
                            icon="heroicon-m-arrow-right"
                            icon-position="after"
                            class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition font-medium flex items-center"
                            >
                            Siguiente
                        </x-filament::button>
                    @endif
                </div>
            @endif
        </div>
    </div>
</div>