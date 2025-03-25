@extends('layouts.app')

@section('title', 'Error del Servidor')

@section('body')
    <div class="relative h-screen w-screen overflow-hidden bg-[#607d8b]">
        <div class="absolute inset-0 z-0 flex items-center justify-center">
            <img src="{{ asset('images/error/500-server.png') }}" alt="Background" 
                 class="h-64 w-64 object-contain" />
            <div class="absolute inset-0 bg-gray-700/60"></div>
        </div>

        <div class="relative z-10 h-full w-full flex flex-col items-center justify-center text-white">
            <div class="text-center p-8 max-w-xl mx-4 bg-white/10 backdrop-blur-sm rounded-2xl border border-white/20">
                <div class="mb-6">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-20 w-20 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                    </svg>
                </div>
                
                <h1 class="text-8xl font-black mb-2">500</h1>
                <h2 class="text-4xl font-bold mb-6">Error del Servidor</h2>
                
                <p class="text-xl mb-8 leading-relaxed">
                    Algo salió mal en nuestro servidor. Nuestro equipo ha sido notificado y estamos trabajando para solucionarlo.
                </p>
                
                <a href="{{ route('welcome') }}" class="inline-flex items-center px-8 py-3 bg-white text-gray-700 font-semibold rounded-lg hover:bg-gray-100 transition-all duration-300 transform hover:scale-[1.02] shadow-lg hover:shadow-xl">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M9.707 14.707a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 1.414L7.414 9H15a1 1 0 110 2H7.414l2.293 2.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                    </svg>
                    Volver al inicio
                </a>
            </div>
        </div>
    </div>
@endsection