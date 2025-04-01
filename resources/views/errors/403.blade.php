@extends('layouts.error')

@section('title', 'Acceso Prohibido')

@section('body')
    <div class="h-screen w-screen flex items-center justify-center bg-[#d32f2f]">
        <div class="absolute inset-0 z-0 flex items-center justify-center">
            <img src="{{ asset('images/error/403-forbidden.png') }}" alt="Background" 
                 class="h-64 w-64 object-contain" />
            <div class="absolute inset-0 bg-red-800/60"></div>
        </div>

        <div class="relative z-10 h-full w-full flex flex-col items-center justify-center text-white">
            <div class="text-center p-8 max-w-xl mx-4 bg-white/10 backdrop-blur-sm rounded-2xl border border-white/20">
                <div class="mb-6">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-20 w-20 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M5.636 5.636l3.536 3.536m0 5.656l-3.536 3.536" />
                    </svg>
                </div>
                
                <h1 class="text-8xl font-black mb-2">403</h1>
                <h2 class="text-4xl font-bold mb-6">Acceso Prohibido</h2>
                
                <p class="text-xl mb-8 leading-relaxed">
                    No tienes permiso para acceder a este recurso. Contacta al administrador si crees que esto es un error.
                </p>
                
                <a href="{{ route('welcome') }}" class="inline-flex items-center px-8 py-3 bg-white text-red-600 font-semibold rounded-lg hover:bg-gray-100 transition-all duration-300 transform hover:scale-[1.02] shadow-lg hover:shadow-xl">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M9.707 14.707a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 1.414L7.414 9H15a1 1 0 110 2H7.414l2.293 2.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                    </svg>
                    Volver al inicio
                </a>
            </div>
        </div>
    </div>
@endsection