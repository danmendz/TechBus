@extends('layouts.app')

@section('title', 'Demasiadas Solicitudes')

@section('body')
    <div class="relative h-screen w-screen overflow-hidden bg-[#795548]">
        <div class="absolute inset-0 z-0 flex items-center justify-center">
            <img src="{{ asset('images/error/500-server.png') }}" alt="Background" 
                 class="h-64 w-64 object-contain" />
            <div class="absolute inset-0 bg-brown-700/60"></div>
        </div>

        <div class="relative z-10 h-full w-full flex flex-col items-center justify-center text-white">
            <div class="text-center p-8 max-w-xl mx-4 bg-white/10 backdrop-blur-sm rounded-2xl border border-white/20">
                <div class="mb-6">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-20 w-20 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                </div>
                
                <h1 class="text-8xl font-black mb-2">429</h1>
                <h2 class="text-4xl font-bold mb-6">Demasiadas Solicitudes</h2>
                
                <p class="text-xl mb-8 leading-relaxed">
                    Has realizado demasiadas solicitudes en poco tiempo. Por favor, espera unos minutos antes de intentarlo nuevamente.
                </p>
                
                <div class="flex flex-col items-center">
                    <div class="w-full bg-white/20 rounded-full h-2.5 mb-4">
                        <div class="bg-white h-2.5 rounded-full animate-pulse" style="width: 45%"></div>
                    </div>
                    <a href="{{ route('welcome') }}" class="inline-flex items-center px-8 py-3 bg-white text-brown-700 font-semibold rounded-lg hover:bg-gray-100 transition-all duration-300 transform hover:scale-[1.02] shadow-lg hover:shadow-xl">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M9.707 14.707a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 1.414L7.414 9H15a1 1 0 110 2H7.414l2.293 2.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                        </svg>
                        Volver al inicio
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection