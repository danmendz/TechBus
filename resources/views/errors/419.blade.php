@extends('layouts.error')

@section('title', 'Página Expirada')

@section('body')
    <div class="relative h-screen w-screen overflow-hidden bg-[#0061a0]">
        <!-- Full screen background image - Capa principal -->
        <div class="absolute inset-0 z-0 flex items-center justify-center">
            <img src="{{ asset('images/error/419-expired.png') }}" alt="Background" 
                 class="h-64 w-64 object-contain" /> <!-- Tamaño ajustable (h-64 = 16rem = 256px) -->
            <div class="absolute inset-0 bg-blue-600/70"></div> <!-- Overlay para mejorar contraste -->
        </div>

        <!-- Content overlay -->
        <div class="relative z-10 h-full w-full flex flex-col items-center justify-center text-white">
            <div class="text-center p-8 max-w-xl mx-4 bg-white/10 backdrop-blur-sm rounded-2xl border border-white/20">
                <div class="mb-6 animate-pulse">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-20 w-20 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                
                <h1 class="text-8xl font-black mb-2">419</h1>
                <h2 class="text-4xl font-bold mb-6">¡Oops! Tiempo agotado</h2>
                
                <p class="text-xl mb-8 leading-relaxed">
                    Tu sesión ha caducado por inactividad. Por favor, recarga la página o inicia sesión nuevamente.
                </p>
                
                <a href="{{ route('welcome') }}" class="inline-flex items-center px-8 py-3 bg-white text-blue-600 font-semibold rounded-lg hover:bg-gray-100 transition-all duration-300 transform hover:scale-[1.02] shadow-lg hover:shadow-xl">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M9.707 14.707a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 1.414L7.414 9H15a1 1 0 110 2H7.414l2.293 2.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                    </svg>
                    Volver al inicio
                </a>
            </div>
        </div>
    </div>
@endsection