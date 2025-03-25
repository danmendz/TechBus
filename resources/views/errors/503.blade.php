@extends('layouts.app')

@section('title', 'Servicio No Disponible')

@section('body')
    <div class="relative h-screen w-screen overflow-hidden bg-[#ff9800]">
        <div class="absolute inset-0 z-0 flex items-center justify-center">
            <img src="{{ asset('images/error/500-server.png') }}" alt="Background" 
                 class="h-64 w-64 object-contain" />
            <div class="absolute inset-0 bg-orange-600/60"></div>
        </div>

        <div class="relative z-10 h-full w-full flex flex-col items-center justify-center text-white">
            <div class="text-center p-8 max-w-xl mx-4 bg-white/10 backdrop-blur-sm rounded-2xl border border-white/20">
                <div class="mb-6 animate-pulse">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-20 w-20 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                
                <h1 class="text-8xl font-black mb-2">503</h1>
                <h2 class="text-4xl font-bold mb-6">Servicio No Disponible</h2>
                
                <p class="text-xl mb-8 leading-relaxed">
                    Estamos realizando tareas de mantenimiento. Por favor, vuelve a intentarlo más tarde.
                </p>
                
                <div class="flex justify-center space-x-4">
                    <a href="{{ route('welcome') }}" class="inline-flex items-center px-6 py-2 bg-white/20 border border-white text-white font-semibold rounded-lg hover:bg-white/30 transition-all duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                        </svg>
                        Volver
                    </a>
                    <a href="{{ route('welcome') }}" class="inline-flex items-center px-6 py-2 bg-white text-orange-600 font-semibold rounded-lg hover:bg-gray-100 transition-all duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd" />
                        </svg>
                        Reintentar
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection