@extends('layouts.app')

@section('title', 'No Autorizado')

@section('body')
    <div class="relative h-screen w-screen overflow-hidden bg-[#3f51b5]">
        <div class="absolute inset-0 z-0 flex items-center justify-center">
			<img src="{{ asset('images/error/500-server.png') }}" alt="Background" 
			class="h-64 w-64 object-contain" />
            <div class="absolute inset-0 bg-indigo-700/60"></div>
        </div>

        <div class="relative z-10 h-full w-full flex flex-col items-center justify-center text-white">
            <div class="text-center p-8 max-w-xl mx-4 bg-white/10 backdrop-blur-sm rounded-2xl border border-white/20">
                <div class="mb-6">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-20 w-20 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                    </svg>
                </div>
                
                <h1 class="text-8xl font-black mb-2">401</h1>
                <h2 class="text-4xl font-bold mb-6">No Autorizado</h2>
                
                <p class="text-xl mb-8 leading-relaxed">
                    Debes autenticarte para acceder a este recurso. Por favor, inicia sesión con tus credenciales.
                </p>
                
                <div class="flex flex-col space-y-4">
                    <a href="{{ route('login') }}" class="inline-flex items-center justify-center px-8 py-3 bg-white text-indigo-600 font-semibold rounded-lg hover:bg-gray-100 transition-all duration-300 transform hover:scale-[1.02] shadow-lg hover:shadow-xl">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                        </svg>
                        Iniciar Sesión
                    </a>
                    <a href="{{ route('welcome') }}" class="inline-flex items-center justify-center px-8 py-3 bg-transparent border border-white text-white font-semibold rounded-lg hover:bg-white/10 transition-all duration-300">
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