<div class="w-full mx-auto p-6 bg-white shadow-md rounded-lg">
    @if (session('message'))
        <div class="mb-4 p-3 bg-green-500 text-green-700 border-l-4 border-green-500 rounded">
            {{ session('message') }}
        </div>
    @endif

    @if (session('error'))
        <div class="mb-4 p-3 bg-red-500 text-red-700 border-l-4 border-red-500 rounded">
            {{ session('error') }}
        </div>
    @endif

    <div class="flex flex-col md:flex-row gap-6">
        <!-- Contenedor de usuarios normales -->
        <div class="flex-1">
            <form class="space-y-4">
                <x-filament::button 
                    wire:click="toggleSelectAll"
                    color="gray"
                    :icon="count($selectedNumbers) === count($users) ? 'heroicon-m-x-mark' : 'heroicon-m-check'"
                    icon-position="after">
                    {{ count($selectedNumbers) === count($users) ? 'Desmarcar Todos' : 'Seleccionar Todos' }}
                </x-filament::button>

                <div class="grid gap-2 overflow-x-auto">
                    @foreach ($users as $user)
                        <div class="flex items-center gap-2 border border-gray-300 rounded-lg p-2 shadow-sm">
                            <span class="inline-block flex-1">{{ $user['name'] }} {{ $user['surnames'] }} - {{ $user['phone'] }}</span>
                            <x-filament::input.checkbox 
                                wire:model="selectedNumbers"
                                :value="$user['phone']"
                                class="border-gray-400 focus:ring-primary-500"
                            />
                        </div>
                    @endforeach
                </div>                

                <x-filament::button
                    wire:click="sendMessagesWhatsapp"
                    icon="heroicon-m-chat-bubble-bottom-center"
                    icon-position="after">
                    Enviar Mensajes De WhatsApp
                </x-filament::button>
            </form>
        </div>

        <!-- Contenedor de usuarios con errores -->
        <div class="flex-1">
            <h3 class="text-lg font-semibold text-gray-700 mb-2">Error al enviar mensaje de WhatsApp</h3>

            <form class="space-y-4">
                <x-filament::button 
                    wire:click="toggleSelectAllFailed"
                    color="gray"
                    :icon="count($selectedFailedNumbers) === count($failedNumbers) ? 'heroicon-m-x-mark' : 'heroicon-m-check'"
                    icon-position="after">
                    {{ count($selectedFailedNumbers) === count($failedNumbers) ? 'Desmarcar Todos' : 'Seleccionar Todos' }}
                </x-filament::button>

                <div class="grid gap-2 overflow-x-auto">
                    @foreach ($failedNumbers as $userId)
                        @php
                            $failedUser = collect($users)->firstWhere('id', $userId);
                        @endphp
                        <div class="flex items-center gap-2 border border-gray-300 rounded-lg p-2 shadow-sm">
                            <span class="inline-block flex-1">{{ $failedUser['name'] ?? 'Desconocido' }} {{ $failedUser['surnames'] ?? '' }} - {{ $failedUser['email'] ?? 'Sin correo' }}</span>
                            <x-filament::input.checkbox
                                wire:model="selectedFailedNumbers"
                                :value="$userId"
                                class="border-gray-400 focus:ring-primary-500"
                            />
                        </div>
                    @endforeach
                </div>

                <x-filament::button
                    wire:click="sendMessagesEmail"
                    icon="heroicon-m-envelope"
                    icon-position="after">
                    Enviar Mensajes De Email
                </x-filament::button>
            </form>
        </div>
    </div>
</div>