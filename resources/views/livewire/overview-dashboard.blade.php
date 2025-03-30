<div>
    <div class="min-h-screen">
        <!-- Contenido principal -->
        <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <!-- Estadísticas rápidas -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <!-- Tarjeta de próximos viajes -->
                <div class="bg-white overflow-hidden shadow rounded-lg">
                    <div class="px-4 py-5 sm:p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 bg-blue-500 rounded-md p-3">
                                <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 truncate">Próximos viajes</dt>
                                    <dd>
                                        <div class="text-lg font-medium text-gray-900">2</div>
                                    </dd>
                                </dl>
                            </div>
                        </div>
                        <div class="mt-4">
                            <a href="{{ route('my.tickets') }}" class="text-sm font-medium text-blue-600 hover:text-blue-500">
                                Ver todos
                                <span aria-hidden="true">→</span>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Tarjeta de viajes recientes -->
                <div class="bg-white overflow-hidden shadow rounded-lg">
                    <div class="px-4 py-5 sm:p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 bg-green-500 rounded-md p-3">
                                <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 truncate">Viajes completados</dt>
                                    <dd>
                                        <div class="text-lg font-medium text-gray-900">5</div>
                                    </dd>
                                </dl>
                            </div>
                        </div>
                        <div class="mt-4">
                            <a href="" class="text-sm font-medium text-green-600 hover:text-green-500">
                                Ver historial
                                <span aria-hidden="true">→</span>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Tarjeta de favoritos -->
                <div class="bg-white overflow-hidden shadow rounded-lg">
                    <div class="px-4 py-5 sm:p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 bg-purple-500 rounded-md p-3">
                                <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                </svg>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 truncate">Rutas favoritas</dt>
                                    <dd>
                                        <div class="text-lg font-medium text-gray-900">3</div>
                                    </dd>
                                </dl>
                            </div>
                        </div>
                        <div class="mt-4">
                            <a href="" class="text-sm font-medium text-purple-600 hover:text-purple-500">
                                Gestionar favoritos
                                <span aria-hidden="true">→</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sección de próximos viajes -->
            <div class="mb-8">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-xl font-bold text-gray-900">Tus próximos viajes</h2>
                    <a href="{{ route('buy.tickets') }}" class="text-sm font-medium text-blue-600 hover:text-blue-500">
                        Reservar nuevo viaje
                    </a>
                </div>

                <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                    <ul class="divide-y divide-gray-200">
                        <!-- Viaje 1 -->
                        <li>
                            <div class="px-4 py-4 sm:px-6">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center">
                                        <div class="min-w-0 flex-1 flex items-center">
                                            <div class="flex-shrink-0 bg-blue-100 rounded-md p-2 mr-4">
                                                <svg class="h-6 w-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                </svg>
                                            </div>
                                            <div>
                                                <p class="text-sm font-medium text-blue-600 truncate">
                                                    Ciudad de México → Guadalajara
                                                </p>
                                                <p class="text-sm text-gray-500">
                                                    <time datetime="2023-06-15">15 Junio, 2023</time> • 08:30 AM
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="ml-4 flex-shrink-0">
                                        <a href="" class="font-medium text-blue-600 hover:text-blue-500">
                                            Ver detalles
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </li>

                        <!-- Viaje 2 -->
                        <li>
                            <div class="px-4 py-4 sm:px-6">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center">
                                        <div class="min-w-0 flex-1 flex items-center">
                                            <div class="flex-shrink-0 bg-blue-100 rounded-md p-2 mr-4">
                                                <svg class="h-6 w-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                </svg>
                                            </div>
                                            <div>
                                                <p class="text-sm font-medium text-blue-600 truncate">
                                                    Monterrey → Cancún
                                                </p>
                                                <p class="text-sm text-gray-500">
                                                    <time datetime="2023-06-22">22 Junio, 2023</time> • 10:15 AM
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="ml-4 flex-shrink-0">
                                        <a href="" class="font-medium text-blue-600 hover:text-blue-500">
                                            Ver detalles
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Sección de acciones rápidas -->
            <div class="mb-8">
                <h2 class="text-xl font-bold text-gray-900 mb-4">Acciones rápidas</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                    <a href="" class="bg-white overflow-hidden shadow rounded-lg p-6 text-center hover:bg-gray-50 transition">
                        <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-md bg-blue-100 text-blue-600">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                            </svg>
                        </div>
                        <h3 class="mt-4 text-sm font-medium text-gray-900">Reservar viaje</h3>
                        <p class="mt-1 text-sm text-gray-500">Encuentra tu próximo destino</p>
                    </a>

                    <a href="{{ route('my.tickets') }}" class="bg-white overflow-hidden shadow rounded-lg p-6 text-center hover:bg-gray-50 transition">
                        <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-md bg-green-100 text-green-600">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path>
                            </svg>
                        </div>
                        <h3 class="mt-4 text-sm font-medium text-gray-900">Mis tickets</h3>
                        <p class="mt-1 text-sm text-gray-500">Revisa tus boletos comprados</p>
                    </a>

                    <a href="" class="bg-white overflow-hidden shadow rounded-lg p-6 text-center hover:bg-gray-50 transition">
                        <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-md bg-purple-100 text-purple-600">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                        <h3 class="mt-4 text-sm font-medium text-gray-900">Mi perfil</h3>
                        <p class="mt-1 text-sm text-gray-500">Actualiza tu información</p>
                    </a>

                    <a href="" class="bg-white overflow-hidden shadow rounded-lg p-6 text-center hover:bg-gray-50 transition">
                        <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-md bg-yellow-100 text-yellow-600">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <h3 class="mt-4 text-sm font-medium text-gray-900">Ayuda</h3>
                        <p class="mt-1 text-sm text-gray-500">Preguntas frecuentes</p>
                    </a>
                </div>
            </div>

            <!-- Sección de promociones -->
            <div class="mb-8">
                <h2 class="text-xl font-bold text-gray-900 mb-4">Promociones especiales</h2>
                <div class="bg-gradient-to-r from-blue-600 to-blue-500 rounded-xl shadow-lg overflow-hidden">
                    <div class="p-6 sm:p-8">
                        <div class="flex flex-col sm:flex-row items-center">
                            <div class="flex-1 text-center sm:text-left">
                                <h3 class="text-xl font-bold text-white mb-2">¡Descuento del 20% en tu próximo viaje!</h3>
                                <p class="text-blue-100 mb-4 sm:mb-0">Usa el código <span class="font-mono bg-blue-700 px-2 py-1 rounded">VIAJE2023</span> al reservar</p>
                            </div>
                            <div class="sm:ml-4">
                                <a href="" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-blue-700 bg-white hover:bg-blue-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                    Aplicar ahora
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>
