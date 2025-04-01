<div class="space-y-8">
    <!-- Tarjetas de Estadísticas -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Tarjeta de próximos viajes -->
        <div class="bg-gradient-to-br from-blue-50 to-white rounded-2xl shadow-sm border border-blue-100 overflow-hidden transition-all hover:shadow-md hover:-translate-y-1">
            <div class="px-5 py-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0 bg-blue-500/10 rounded-xl p-3">
                        <svg class="h-8 w-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <div class="ml-5">
                        <h3 class="text-sm font-medium text-gray-500">Próximos viajes</h3>
                        <p class="text-2xl font-semibold text-gray-900 mt-1">{{ $upcomingTripsCount }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tarjeta de viajes completados -->
        <div class="bg-gradient-to-br from-blue-50 to-white rounded-2xl shadow-sm border border-blue-100 overflow-hidden transition-all hover:shadow-md hover:-translate-y-1">
            <div class="px-5 py-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0 bg-blue-500/10 rounded-xl p-3">
                        <svg class="h-8 w-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div class="ml-5">
                        <h3 class="text-sm font-medium text-gray-500">Viajes completados</h3>
                        <p class="text-2xl font-semibold text-gray-900 mt-1">{{ $completedTripsCount }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tarjeta de favoritos -->
        <div class="bg-gradient-to-br from-blue-50 to-white rounded-2xl shadow-sm border border-blue-100 overflow-hidden transition-all hover:shadow-md hover:-translate-y-1">
            <div class="px-5 py-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0 bg-blue-500/10 rounded-xl p-3">
                        <svg class="h-8 w-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                        </svg>
                    </div>
                    <div class="ml-5">
                        <h3 class="text-sm font-medium text-gray-500">Rutas favoritas</h3>
                        <p class="text-2xl font-semibold text-gray-900 mt-1">{{ $favoriteRoutesCount }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Sección de próximos viajes -->
    <div class="space-y-4">
        <div class="flex justify-between items-center">
            <h2 class="text-2xl font-bold text-gray-900">Tus próximos viajes</h2>
            <a href="{{ route('buy.tickets') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-full shadow-sm text-white bg-blue-600 hover:bg-blue-700 transition-colors">
                <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
                Nuevo viaje
            </a>
        </div>

        @if(count($upcomingTrips) > 0)
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <ul class="divide-y divide-gray-100">
                    @foreach($upcomingTrips as $trip)
                        <li class="hover:bg-gray-50 transition-colors">
                            <div class="px-6 py-5">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center space-x-4">
                                        <div class="flex-shrink-0 bg-blue-100 rounded-xl p-3">
                                            <svg class="h-7 w-7 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                            </svg>
                                        </div>
                                        <div>
                                            <h3 class="text-lg font-medium text-gray-900">
                                                {{ $trip['origen'] }} → {{ $trip['destino'] }}
                                            </h3>
                                            <div class="flex items-center mt-1 text-sm text-gray-500">
                                                <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                </svg>
                                                <span>{{ \Carbon\Carbon::parse($trip['fecha'])->translatedFormat('l, d M Y') }} • {{ $trip['hora_salida'] }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <a href="{{ route('ticket.details', ['id' => $trip['ticket_id']]) }}" class="inline-flex items-center px-3 py-1.5 border border-gray-300 shadow-sm text-sm font-medium rounded-full text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                                        Ver detalles
                                        <svg class="ml-1 -mr-0.5 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        @else
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden text-center p-10">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <h3 class="mt-2 text-lg font-medium text-gray-900">No tienes viajes programados</h3>
                <p class="mt-1 text-sm text-gray-500">Empieza a planear tu próximo viaje hoy mismo.</p>
                <div class="mt-6">
                    <a href="{{ route('buy.tickets') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-full shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                        <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Reservar viaje
                    </a>
                </div>
            </div>
        @endif
    </div>
</div>