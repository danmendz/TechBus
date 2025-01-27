<div class="col-span-6 sm:col-span-4">
    <x-label for="phone" value="{{ __('Teléfono') }}" />
    <div class="flex gap-4">
        <!-- Columna para el código de país -->
        <div class="w-1/2">
            <select wire:model="countryCode" id="countryCode" required class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                {{-- <option value="52">MX (52)</option> --}}
                @foreach ($countryCodes as $code => $prefix)
                    <option value="{{ $prefix }}">{{ $code }} ({{ $prefix }})</option>
                @endforeach
            </select>
        </div>

        <!-- Columna para el número de teléfono -->
        <div class="w-3/4">
            <x-input wire:model="state.phone" id="phone" class="block mt-1 w-full" type="tel"
                name="phone" required autofocus autocomplete="phone" />
        </div>
    </div>
</div>