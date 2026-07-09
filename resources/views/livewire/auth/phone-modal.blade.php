<div>
    @if ($showModal)
        <div class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-75 z-50">
            <div class="bg-white p-6 rounded-lg shadow-lg w-96">
                <h2 class="text-lg font-semibold mb-4">Agregar número de teléfono</h2>

                <!-- Componente de entrada de teléfono con validación -->
                <div class="col-span-6 sm:col-span-4">
                    <x-label for="phone" value="{{ __('Teléfono') }}" />
                    <div class="flex gap-4">
                        <!-- Código de país -->
                        <div class="w-1/2">
                            <select wire:model="countryCode" id="countryCode" required
                                class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                @foreach ($countryCodes as $code => $prefix)
                                    <option value="{{ $prefix }}">{{ $code }} ({{ $prefix }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Número de teléfono -->
                        <div class="w-3/4">
                            <x-input wire:model="phone" id="phone"
                                class="block mt-1 w-full @error('phone') border-red-500 @enderror" type="tel"
                                name="phone" required autofocus autocomplete="phone" />

                            @error('phone')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Botón de Guardar -->
                <x-filament::button wire:click="savePhone" icon="heroicon-m-check" icon-position="after"
                    class="bg-blue-600 text-white hover:bg-blue-700 w-full mt-3">
                    Guardar
                </x-filament::button>
            </div>
        </div>
    @endif
</div>