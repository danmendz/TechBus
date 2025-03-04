<div class="w-full mx-auto p-6 bg-white shadow-md rounded-lg">
    <!-- Mensajes de éxito/error -->
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

    <!-- Contenedor principal con grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Sección izquierda: Selección y edición de notificación -->
        <div class="space-y-4">
            <!-- Dropdown para seleccionar la notificación -->
            <div>
                <label for="selectedNotificationId" class="block text-sm font-medium text-gray-700">
                    Seleccionar Notificación
                </label>
                <select wire:model="selectedNotificationId" id="selectedNotificationId" 
                    class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm 
                    focus:outline-none focus:ring-primary-500 focus:border-primary-500 sm:text-sm">
                    <option value="">Seleccione una notificación</option>
                    @foreach ($notifications as $notification)
                        <option value="{{ $notification->id }}">{{ $notification->estatus_notificacion }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Botón Verificar -->
            <x-filament::button 
                wire:click="loadNotificationData"
                icon="heroicon-m-check"
                icon-position="after">
                Verificar
            </x-filament::button>

            <!-- Formulario de notificación -->
            <div class="grid grid-cols-1 gap-4">
                <div>
                    <label for="estatus_notificacion" class="block text-sm font-medium text-gray-700">Estatus</label>
                    <input wire:model="notificationForm.estatus_notificacion" type="text" id="estatus_notificacion" 
                        class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm 
                        focus:outline-none focus:ring-primary-500 focus:border-primary-500 sm:text-sm">
                </div>

                <div>
                    <label for="motivo" class="block text-sm font-medium text-gray-700">Motivo</label>
                    <input wire:model="notificationForm.motivo" type="text" id="motivo" 
                        class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm 
                        focus:outline-none focus:ring-primary-500 focus:border-primary-500 sm:text-sm">
                </div>

                <div>
                    <label for="imagen" class="block text-sm font-medium text-gray-700">Imagen</label>
                    <input wire:model="notificationForm.imagen" type="text" id="imagen" 
                        class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm 
                        focus:outline-none focus:ring-primary-500 focus:border-primary-500 sm:text-sm">
                </div>
            </div>
        </div>

        <!-- Sección derecha: Listado de usuarios y envío de mensajes -->
        <div class="space-y-6">
            <!-- Usuarios normales -->
            <div class="p-4 bg-gray-50 rounded-lg shadow-md">
                <h3 class="text-lg font-semibold text-gray-700 mb-2">Usuarios Registrados</h3>

                <x-filament::button 
                    wire:click="toggleSelectAll"
                    color="gray"
                    :icon="count($selectedNumbers) === count($users) ? 'heroicon-m-x-mark' : 'heroicon-m-check'"
                    icon-position="after">
                    {{ count($selectedNumbers) === count($users) ? 'Desmarcar Todos' : 'Seleccionar Todos' }}
                </x-filament::button>

                <div class="grid gap-2 overflow-x-auto mt-3 mb-5">
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
                    icon="heroicon-m-paper-airplane"
                    icon-position="after">
                    Enviar Mensajes De WhatsApp
                </x-filament::button>
            </div>

            <!-- Usuarios con errores -->
            <div class="p-4 bg-gray-50 rounded-lg shadow-md">
                <h3 class="text-lg font-semibold text-gray-700 mb-2">Usuarios con Errores</h3>

                <x-filament::button 
                    wire:click="toggleSelectAllFailed"
                    color="gray"
                    :icon="count($selectedFailedNumbers) === count($failedNumbers) ? 'heroicon-m-x-mark' : 'heroicon-m-check'"
                    icon-position="after">
                    {{ count($selectedFailedNumbers) === count($failedNumbers) ? 'Desmarcar Todos' : 'Seleccionar Todos' }}
                </x-filament::button>

                <div class="grid gap-2 overflow-x-auto mt-3 mb-3">
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
            </div>
        </div>
    </div>
</div>