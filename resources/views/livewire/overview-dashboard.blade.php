<div class="bg-gray-50 min-h-screen">
    <!-- Contenido principal -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Componente de estadísticas -->
        <div class="mb-10">
            <livewire:user-stats-dashboard />
        </div>

        <!-- Sección de acciones rápidas -->
        <section class="mb-12">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-2xl font-bold text-gray-900">Acciones rápidas</h2>
                <div class="hidden sm:block h-px flex-1 bg-gray-200 ml-4"></div>
            </div>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
                <!-- Tarjeta Reservar viaje -->
                <a href="{{ route('buy.tickets') }}" class="group relative bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden transition-all hover:shadow-md hover:-translate-y-1">
                    <div class="absolute inset-0 bg-gradient-to-br from-blue-50 to-white opacity-0 group-hover:opacity-100 transition-opacity"></div>
                    <div class="relative p-6 text-center">
                        <div class="mx-auto flex items-center justify-center h-14 w-14 rounded-xl bg-blue-100 text-blue-600 mb-4 transition-all group-hover:bg-blue-600 group-hover:text-white">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-1">Reservar viaje</h3>
                        <p class="text-sm text-gray-500">Encuentra tu próximo destino</p>
                        <div class="mt-4 inline-flex items-center text-sm font-medium text-blue-600 group-hover:text-blue-700">
                            Comenzar
                            <svg class="ml-1 h-4 w-4 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </div>
                    </div>
                </a>

                <!-- Tarjeta Mis tickets -->
                <a href="{{ route('my.tickets') }}" class="group relative bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden transition-all hover:shadow-md hover:-translate-y-1">
                    <div class="absolute inset-0 bg-gradient-to-br from-blue-50 to-white opacity-0 group-hover:opacity-100 transition-opacity"></div>
                    <div class="relative p-6 text-center">
                        <div class="mx-auto flex items-center justify-center h-14 w-14 rounded-xl bg-blue-100 text-blue-600 mb-4 transition-all group-hover:bg-blue-600 group-hover:text-white">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-1">Mis tickets</h3>
                        <p class="text-sm text-gray-500">Revisa tus boletos comprados</p>
                        <div class="mt-4 inline-flex items-center text-sm font-medium text-blue-600 group-hover:text-blue-700">
                            Ver todos
                            <svg class="ml-1 h-4 w-4 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </div>
                    </div>
                </a>

                <!-- Tarjeta Mi perfil -->
                <a href="{{ route('profile.show') }}" class="group relative bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden transition-all hover:shadow-md hover:-translate-y-1">
                    <div class="absolute inset-0 bg-gradient-to-br from-blue-50 to-white opacity-0 group-hover:opacity-100 transition-opacity"></div>
                    <div class="relative p-6 text-center">
                        <div class="mx-auto flex items-center justify-center h-14 w-14 rounded-xl bg-blue-100 text-blue-600 mb-4 transition-all group-hover:bg-blue-600 group-hover:text-white">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-1">Mi perfil</h3>
                        <p class="text-sm text-gray-500">Actualiza tu información</p>
                        <div class="mt-4 inline-flex items-center text-sm font-medium text-blue-600 group-hover:text-blue-700">
                            Editar
                            <svg class="ml-1 h-4 w-4 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </div>
                    </div>
                </a>

                <!-- Tarjeta Ayuda -->
                <a href="#" class="group relative bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden transition-all hover:shadow-md hover:-translate-y-1">
                    <div class="absolute inset-0 bg-gradient-to-br from-blue-50 to-white opacity-0 group-hover:opacity-100 transition-opacity"></div>
                    <div class="relative p-6 text-center">
                        <div class="mx-auto flex items-center justify-center h-14 w-14 rounded-xl bg-blue-100 text-blue-600 mb-4 transition-all group-hover:bg-blue-500 group-hover:text-white">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-1">Ayuda</h3>
                        <p class="text-sm text-gray-500">Preguntas frecuentes</p>
                        <div class="mt-4 inline-flex items-center text-sm font-medium text-blue-600 group-hover:text-blue-700">
                            Consultar
                            <svg class="ml-1 h-4 w-4 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </div>
                    </div>
                </a>
            </div>
        </section>

        <!-- Sección de promociones -->
        <section class="mb-10">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-2xl font-bold text-gray-900">Promociones especiales</h2>
                <div class="hidden sm:block h-px flex-1 bg-gray-200 ml-4"></div>
            </div>
            
            <div class="relative rounded-2xl overflow-hidden">
                <div class="absolute inset-0 bg-gradient-to-r from-blue-600 to-blue-500 opacity-95"></div>
                <div class="relative px-6 py-8 sm:px-10 sm:py-12">
                    <div class="flex flex-col lg:flex-row items-center">
                        <div class="flex-1 text-center lg:text-left mb-6 lg:mb-0">
                            <h3 class="text-xl sm:text-2xl font-bold text-white mb-3">¡Descuento exclusivo del 20%!</h3>
                            <p class="text-blue-100 mb-4">Aprovecha esta oferta limitada para tu próximo viaje</p>
                            <div class="inline-flex items-center px-3 py-2 rounded-lg bg-blue-700 bg-opacity-50 border border-blue-400 border-opacity-50">
                                <span class="font-mono font-bold text-white">VIAJE2023</span>
                                <button class="ml-2 p-1 rounded-full hover:bg-blue-600 transition-colors">
                                    <svg class="h-4 w-4 text-blue-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                        <div class="lg:ml-8">
                            <a href="{{ route('buy.tickets') }}" class="inline-flex items-center px-5 py-3 border border-transparent text-base font-medium rounded-xl shadow-sm text-blue-700 bg-white hover:bg-blue-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-white transition-colors">
                                Aplicar ahora
                                <svg class="ml-2 -mr-1 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
</div>