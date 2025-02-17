<div class="max-w-lg mx-auto p-6 bg-white shadow-md rounded-lg">
    <h2 class="text-xl font-semibold text-gray-700 mb-4">Enviar Mensajes de WhatsApp</h2>

    @if (session('message'))
        <div class="mb-4 p-3 bg-green-100 text-green-700 border-l-4 border-green-500 rounded">
            {{ session('message') }}
        </div>
    @endif

    @if (session('error'))
        <div class="mb-4 p-3 bg-red-100 text-red-700 border-l-4 border-red-500 rounded">
            {{ session('error') }}
        </div>
    @endif

    <form wire:submit.prevent="sendMessages" class="space-y-4">
        <!-- Botón para marcar/desmarcar todos -->
        <button type="button" wire:click="toggleSelectAll" 
            class="w-40 bg-gray-200 hover:bg-gray-300 text-gray-700 font-semibold py-2 px-4 rounded-lg transition mb-4">
            {{ count($selectedNumbers) === count($phoneNumbers) ? 'Desmarcar Todos' : 'Marcar Todos' }}
        </button>

        <div class="grid gap-2">
            @foreach ($phoneNumbers as $phoneNumber)
                <label class="flex items-center space-x-2 bg-gray-100 p-2 rounded-lg shadow-sm">
                    <input type="checkbox" wire:model="selectedNumbers" value="{{ $phoneNumber }}" 
                        class="w-5 h-5 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                    <span class="text-gray-700">{{ $phoneNumber }}</span>
                </label>
            @endforeach
        </div>

        <button type="submit" 
            class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg transition">
            📩 Enviar Mensajes
        </button>
    </form>
</div>