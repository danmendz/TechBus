<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>ADO</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Styles -->
        <link href="{{ asset('css/general/styles.css') }}" rel="stylesheet">

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body>
        <div class="absolute top-0 inset-x-0 h-12 bg-[#0061a0] z-10"></div>
    
        <!-- HEADER -->
        <header
            class="sticky top-4 inset-x-0 flex flex-wrap md:justify-start md:flex-nowrap z-50 w-full before:absolute before:inset-0 before:max-w-[66rem] before:mx-2 before:lg:mx-auto before:rounded-[26px] before:bg-neutral-600/30 before:backdrop-blur-md">
            <nav
                class="relative max-w-[66rem] w-full py-2.5 ps-5 pe-2 md:flex md:items-center md:justify-between md:py-0 mx-2 lg:mx-auto">
                <div class="flex items-center justify-between">
                    <!-- Logo -->
                    <a class="flex-none rounded-md text-xl inline-block font-semibold focus:outline-none focus:opacity-80"
                        href="../templates/agency/index.html" aria-label="ADO">
                        <img class="w-20 h-auto rounded-md" src="{{ asset('images/enterprise/ADO-logo-white.png') }}" alt="Logo">
                    </a>
                    <!-- End Logo -->
    
                    <div class="md:hidden">
                        <button type="button"
                            class="hs-collapse-toggle size-8 flex justify-center items-center text-sm font-semibold rounded-full bg-neutral-800 text-white disabled:opacity-50 disabled:pointer-events-none"
                            id="hs-navbar-floating-dark-collapse" aria-expanded="false"
                            aria-controls="hs-navbar-floating-dark" aria-label="Toggle navigation"
                            data-hs-collapse="#hs-navbar-floating-dark">
                            <svg class="hs-collapse-open:hidden shrink-0 size-4" xmlns="http://www.w3.org/2000/svg"
                                width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="3" x2="21" y1="6" y2="6" />
                                <line x1="3" x2="21" y1="12" y2="12" />
                                <line x1="3" x2="21" y1="18" y2="18" />
                            </svg>
                            <svg class="hs-collapse-open:block hidden shrink-0 size-4" xmlns="http://www.w3.org/2000/svg"
                                width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M18 6 6 18" />
                                <path d="m6 6 12 12" />
                            </svg>
                        </button>
                    </div>
                </div>
    
                <!-- Collapse -->
                <div id="hs-navbar-floating-dark"
                    class="hs-collapse hidden overflow-hidden transition-all duration-300 basis-full grow md:block"
                    aria-labelledby="hs-navbar-floating-dark-collapse">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-end py-2 md:py-0 md:ps-7">
                        <a class="p-3 ps-px sm:px-3 md:py-4 text-sm text-white hover:text-neutral-600 focus:outline-none focus:text-neutral-600"
                            href="../templates/agency/index.html" aria-current="page">Inicio</a>
                        <a class="p-3 ps-px sm:px-3 md:py-4 text-sm text-white hover:text-neutral-600 focus:outline-none focus:text-neutral-600"
                            href="#">Terminales</a>
                        <a class="p-3 ps-px sm:px-3 md:py-4 text-sm text-white hover:text-neutral-600 focus:outline-none focus:text-neutral-600"
                            href="#">Destinos</a>
                        <a class="p-3 ps-px sm:px-3 md:py-4 text-sm text-white hover:text-neutral-600 focus:outline-none focus:text-neutral-600"
                            href="#">Mis viajes</a>
    
                        <div
                            class="hs-dropdown [--strategy:static] md:[--strategy:fixed] [--adaptive:none] [--is-collapse:true] md:[--is-collapse:false] p-3 ps-px sm:px-3 md:py-4">
                            <button id="hs-dropdown-floating-dark" type="button"
                                class="hs-dropdown-toggle flex items-center w-full text-sm text-white hover:text-neutral-600 focus:outline-none focus:text-neutral-600"
                                aria-haspopup="menu" aria-expanded="false" aria-label="Dropdown">
                                Sobre nosotros
                                <svg class="hs-dropdown-open:-rotate-180 md:hs-dropdown-open:rotate-0 duration-300 shrink-0 ms-auto md:ms-1 size-4"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <path d="m6 9 6 6 6-6" />
                                </svg>
                            </button>
    
                            <div class="hs-dropdown-menu transition-[opacity,margin] duration-[0.1ms] md:duration-[150ms] hs-dropdown-open:opacity-100 opacity-0 md:w-48 hidden z-10 bg-neutral-800 md:shadow-md rounded-lg before:absolute top-full before:-top-5 before:start-0 before:w-full before:h-5"
                                role="menu" aria-orientation="vertical" aria-labelledby="hs-dropdown-floating-dark">
                                <div class="py-1 md:px-1 space-y-1">
                                    <a class="flex items-center gap-x-3.5 py-2 md:px-3 rounded-lg text-sm text-white hover:text-neutral-300 focus:outline-none focus:text-neutral-300"
                                        href="#">
                                        About
                                    </a>
                                    <div
                                        class="hs-dropdown [--strategy:static] md:[--strategy:absolute] [--adaptive:none] md:[--trigger:hover] [--is-collapse:true] md:[--is-collapse:false] relative">
                                        <button id="hs-dropdown-floating-dark-sub" type="button"
                                            class="hs-dropdown-toggle w-full flex justify-between items-center py-2 md:px-3 text-sm text-white hover:text-neutral-300 focus:outline-none focus:text-neutral-300"
                                            aria-haspopup="menu" aria-expanded="false" aria-label="Dropdown">
                                            Sub Menu
                                            <svg class="hs-dropdown-open:-rotate-180 md:hs-dropdown-open:-rotate-90 md:-rotate-90 duration-300 shrink-0 ms-2 size-4"
                                                xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="m6 9 6 6 6-6" />
                                            </svg>
                                        </button>
    
                                        <div class="hs-dropdown-menu transition-[opacity,margin] duration-[0.1ms] md:duration-[150ms] hs-dropdown-open:opacity-100 opacity-0 md:w-48 hidden z-10 bg-neutral-800 md:shadow-md rounded-lg before:absolute before:-end-5 before:top-0 before:h-full before:w-5 !mx-[10px] top-0 end-full"
                                            role="menu" aria-orientation="vertical"
                                            aria-labelledby="hs-dropdown-floating-dark-sub">
                                            <div class="py-1 md:px-1 space-y-1">
                                                <a class="flex items-center gap-x-3.5 py-2 md:px-3 rounded-lg text-sm text-white hover:text-neutral-300 focus:outline-none focus:text-neutral-300"
                                                    href="#">
                                                    About
                                                </a>
                                                <a class="flex items-center gap-x-3.5 py-2 md:px-3 rounded-lg text-sm text-white hover:text-neutral-300 focus:outline-none focus:text-neutral-300"
                                                    href="#">
                                                    Downloads
                                                </a>
                                                <a class="flex items-center gap-x-3.5 py-2 md:px-3 rounded-lg text-sm text-white hover:text-neutral-300 focus:outline-none focus:text-neutral-300"
                                                    href="#">
                                                    Team Account
                                                </a>
                                            </div>
                                        </div>
                                    </div>
    
                                    <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-white hover:text-neutral-300 focus:outline-none focus:text-neutral-300"
                                        href="#">
                                        Downloads
                                    </a>
                                    <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-white hover:text-neutral-300 focus:outline-none focus:text-neutral-300"
                                        href="#">
                                        Team Account
                                    </a>
                                </div>
                            </div>
                        </div>
    
                        <div>
                            <a type="button" href="/login"
                                class="group inline-flex items-center gap-x-2 py-2 px-3 bg-blue-600 text-white hover:bg-blue-700 font-medium text-sm rounded-full focus:outline-none">
                                Iniciar sesión
                                {{-- <x-tabler-brand-youtube /> --}}
                            </a>
                        </div>
                    </div>
                </div>
                <!-- End Collapse -->
            </nav>
        </header>
        <!-- END HEADER -->
    
        {{-- <div class="flex justify-end mt-4">
            <x-dark-toggle-button />
          </div> --}}
    
        <!-- Hero -->
        <div class="max-w-[85rem] mx-auto px-4 sm:px-6 lg:px-8 mt-8">
            <!-- Grid -->
            <div class="grid md:grid-cols-2 gap-4 md:gap-8 xl:gap-20 md:items-center">
                <div>
                    <h1 class="block text-3xl font-bold text-gray-800 sm:text-4xl lg:text-6xl lg:leading-tight">Comienza tu
                        viaje con <span class="text-blue-600">ADO</span></h1>
                    <p class="mt-3 text-lg text-gray-800">"Realiza el viaje de tus sueños con tu familia, disfrutando de
                        comodidad y
                        seguridad en cada kilómetro. ¡Aprovecha nuestras ofertas exclusivas y viaja con confianza!".
                    </p>
    
                    <!-- Buttons -->
                    <div class="mt-4 grid gap-3 w-full sm:inline-flex">
                        <a type="button" href="/register"
                            class="group inline-flex items-center gap-x-2 py-2 px-3 bg-blue-700 text-white hover:bg-blue-600 font-medium text-sm rounded-full focus:outline-none">
                            Regístrate
                            <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24"
                                height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="m9 18 6-6-6-6" />
                            </svg>
                        </a>
                    </div>
                    <!-- End Buttons -->
    
                    <!-- Images -->
                    <div class="mt-4 grid grid-cols-3 gap-x-5">
                        <div class="py-2">
                            <img class="w-full h-48 object-cover rounded-lg" src="{{ asset('images/hero/playa.jpg') }}"
                                alt="Playa">
                        </div>
    
                        <div class="py-2">
                            <img class="w-full h-48 object-cover rounded-lg" src="{{ asset('images/hero/piramide.jpg') }}"
                                alt="Pirámide">
                        </div>
    
                        <div class="py-2">
                            <img class="w-full h-48 object-cover rounded-lg" src="{{ asset('images/hero/pueblo.jpg') }}"
                                alt="Pirámide">
                        </div>
                    </div>
                    <!-- End images -->
                </div>
    
                <!-- Col -->
                <div class="relative ">
                    <img class="w-full h-full object-cover rounded-md" src="{{ asset('images/enterprise/ADO-font.jpeg') }}"
                        alt="Hero Image">
                </div>
                <!-- End Col -->
    
            </div>
            <!-- End Grid -->
        </div>
        <!-- End Hero -->
    
        <!-- Carousel -->
        <div class="mt-12 overflow-hidden w-full bg-white rounded-lg shadow-md">
            <div class="flex items-center gap-5 animate-marquee whitespace-nowrap">
                <img src="{{ asset('images/marquee/beach1.jpg') }}" alt="Image 1" class="h-24 rounded-lg">
                <img src="{{ asset('images/marquee/beach2.jpg') }}" alt="Image 2" class="h-24 rounded-lg">
                <img src="{{ asset('images/marquee/mexico.jpg') }}" alt="Image 3" class="h-24 rounded-lg">
                <img src="{{ asset('images/marquee/newyork.jpg') }}" alt="Image 4" class="h-24 rounded-lg">
                <img src="{{ asset('images/marquee/pyramid.jpg') }}" alt="Image 5" class="h-24 rounded-lg">
    
                <img src="{{ asset('images/marquee/beach1.jpg') }}" alt="Image 1" class="h-24 rounded-lg">
                <img src="{{ asset('images/marquee/beach2.jpg') }}" alt="Image 2" class="h-24 rounded-lg">
                <img src="{{ asset('images/marquee/mexico.jpg') }}" alt="Image 3" class="h-24 rounded-lg">
                <img src="{{ asset('images/marquee/newyork.jpg') }}" alt="Image 4" class="h-24 rounded-lg">
                <img src="{{ asset('images/marquee/pyramid.jpg') }}" alt="Image 5" class="h-24 rounded-lg">
    
                <img src="{{ asset('images/marquee/beach1.jpg') }}" alt="Image 1" class="h-24 rounded-lg">
                <img src="{{ asset('images/marquee/beach2.jpg') }}" alt="Image 2" class="h-24 rounded-lg">
                <img src="{{ asset('images/marquee/mexico.jpg') }}" alt="Image 3" class="h-24 rounded-lg">
                <img src="{{ asset('images/marquee/newyork.jpg') }}" alt="Image 4" class="h-24 rounded-lg">
                <img src="{{ asset('images/marquee/pyramid.jpg') }}" alt="Image 5" class="h-24 rounded-lg">
            </div>
        </div>
        <!-- End Carousel -->
    
        <!-- Pricing -->
        <div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
            <!-- Title -->
            <div class="max-w-2xl mx-auto text-center mb-10 lg:mb-14">
                <h2 class="text-2xl font-bold md:text-4xl md:leading-tight">Encuentra tu boleto ideal</h2>
                <p class="mt-1 text-gray-600">Paga con la tarjeta de credito de tu preferencia.</p>
            </div>
            <!-- End Title -->
    
            <!-- Grid -->
            <div
                class="relative before:absolute before:inset-0 before:-z-[1] before:bg-[radial-gradient(closest-side,theme(colors.gray.300),transparent)] mt-12">
                <div class="grid gap-px sm:grid-cols-2 lg:grid-cols-4 lg:items-center">
    
                    <!-- Card -->
                    <div class="flex flex-col h-full text-center">
                        <div class="bg-white pt-8 pb-5 px-8">
                            <h4 class="font-bold font-medium text-lg text-gray-800">Niño</h4>
                        </div>
    
                        <!-- Select -->
                        <div class="bg-white px-6 py-2">
                            <select
                                class="w-32 text-sm text-gray-800 bg-white border border-gray-300 rounded-lg py-1 px-3 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-blue-600">
                                <option class="text-gray-800" value="1user">Económico</option>
                                <option class="text-gray-800" value="planfeatures">Primera clase</option>
                            </select>
                        </div>
    
                        <div class="h-full bg-white lg:mt-px lg:py-5 px-8">
                            <span class="mt-7 font-bold text-5xl text-gray-800">
                                <span class="font-bold text-2xl -me-2">$</span>
                                40
                            </span>
                        </div>
    
                        <!-- Contador y botón "+" -->
                        <div class="bg-white py-4 px-8 flex justify-center items-center">
                            <button id="addButton2" class="text-xl text-gray-800 bg-gray-200 rounded-full px-2 py-1">
                                +
                            </button>
                            <p id="counter2" class="ml-3 text-gray-800">Cantidad: 0</p>
                        </div>
    
                        <!-- Botón "comprar" -->
                        <div class="bg-white py-8 px-8">
                            <a class="py-3 px-4 w-full inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg border border-blue-600 text-blue-600 hover:border-blue-500 hover:text-blue-500 focus:outline-none focus:border-blue-500 focus:text-blue-500 disabled:opacity-50 disabled:pointer-events-none"
                                href="#">
                                Comprar
                            </a>
                        </div>
                    </div>
                    <!-- End Card -->
    
                    <!-- Card 2 -->
                    <div class="flex flex-col h-full text-center">
                        <div class="bg-white pt-8 pb-5 px-8">
                            <h4 class="font-bold font-medium text-lg text-gray-800">Tercera edad</h4>
                        </div>
    
                        <!-- Select -->
                        <div class="bg-white px-6 py-2">
                            <select
                                class="w-32 text-sm text-gray-800 bg-white border border-gray-300 rounded-lg py-1 px-3 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-blue-600">
                                <option class="text-gray-800" value="1user">Económico</option>
                                <option class="text-gray-800" value="planfeatures">Primera clase</option>
                            </select>
                        </div>
    
                        <div class="h-full bg-white lg:mt-px lg:py-5 px-8">
                            <span class="mt-7 font-bold text-5xl text-gray-800">
                                <span class="font-bold text-2xl -me-2">$</span>
                                55
                            </span>
                        </div>
    
                        <!-- Contador y botón "+" -->
                        <div class="bg-white py-4 px-8 flex justify-center items-center">
                            <button id="addButton2" class="text-xl text-gray-800 bg-gray-200 rounded-full px-2 py-1">
                                +
                            </button>
                            <p id="counter2" class="ml-3 text-gray-800">Cantidad: 0</p>
                        </div>
    
                        <!-- Botón "comprar" -->
                        <div class="bg-white py-8 px-8">
                            <a class="py-3 px-4 w-full inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg border border-blue-600 text-blue-600 hover:border-blue-500 hover:text-blue-500 focus:outline-none focus:border-blue-500 focus:text-blue-500 disabled:opacity-50 disabled:pointer-events-none"
                                href="#">
                                Comprar
                            </a>
                        </div>
                    </div>
                    <!-- End Card -->
    
                    <!-- Card 2 -->
                    <div class="flex flex-col h-full text-center">
                        <div class="bg-white pt-8 pb-5 px-8">
                            <h4 class="font-bold font-medium text-lg text-gray-800">Estudiante</h4>
                        </div>
    
                        <!-- Select -->
                        <div class="bg-white px-6 py-2">
                            <select
                                class="w-32 text-sm text-gray-800 bg-white border border-gray-300 rounded-lg py-1 px-3 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-blue-600">
                                <option class="text-gray-800" value="1user">Económico</option>
                                <option class="text-gray-800" value="planfeatures">Primera clase</option>
                            </select>
                        </div>
    
                        <div class="h-full bg-white lg:mt-px lg:py-5 px-8">
                            <span class="mt-7 font-bold text-5xl text-gray-800">
                                <span class="font-bold text-2xl -me-2">$</span>
                                70
                            </span>
                        </div>
    
                        <!-- Contador y botón "+" -->
                        <div class="bg-white py-4 px-8 flex justify-center items-center">
                            <button id="addButton2" class="text-xl text-gray-800 bg-gray-200 rounded-full px-2 py-1">
                                +
                            </button>
                            <p id="counter2" class="ml-3 text-gray-800">Cantidad: 0</p>
                        </div>
    
                        <!-- Botón "comprar" -->
                        <div class="bg-white py-8 px-8">
                            <a class="py-3 px-4 w-full inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg border border-blue-600 text-blue-600 hover:border-blue-500 hover:text-blue-500 focus:outline-none focus:border-blue-500 focus:text-blue-500 disabled:opacity-50 disabled:pointer-events-none"
                                href="#">
                                Comprar
                            </a>
                        </div>
                    </div>
                    <!-- End Card -->
    
                    <!-- Card 2 -->
                    <div class="flex flex-col h-full text-center">
                        <div class="bg-white pt-8 pb-5 px-8">
                            <h4 class="font-bold font-medium text-lg text-gray-800">Adulto</h4>
                        </div>
    
                        <!-- Select -->
                        <div class="bg-white px-6 py-2">
                            <select
                                class="w-32 text-sm text-gray-800 bg-white border border-gray-300 rounded-lg py-1 px-3 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-blue-600">
                                <option class="text-gray-800" value="1user">Económico</option>
                                <option class="text-gray-800" value="planfeatures">Primera clase</option>
                            </select>
                        </div>
    
                        <div class="h-full bg-white lg:mt-px lg:py-5 px-8">
                            <span class="mt-7 font-bold text-5xl text-gray-800">
                                <span class="font-bold text-2xl -me-2">$</span>
                                120
                            </span>
                        </div>
    
                        <!-- Contador y botón "+" -->
                        <div class="bg-white py-4 px-8 flex justify-center items-center">
                            <button id="addButton2" class="text-xl text-gray-800 bg-gray-200 rounded-full px-2 py-1">
                                +
                            </button>
                            <p id="counter2" class="ml-3 text-gray-800">Cantidad: 0</p>
                        </div>
    
                        <!-- Botón "comprar" -->
                        <div class="bg-white py-8 px-8">
                            <a class="py-3 px-4 w-full inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg border border-blue-600 text-blue-600 hover:border-blue-500 hover:text-blue-500 focus:outline-none focus:border-blue-500 focus:text-blue-500 disabled:opacity-50 disabled:pointer-events-none"
                                href="#">
                                Comprar
                            </a>
                        </div>
                    </div>
                    <!-- End Card -->
    
                </div>
            </div>
    
    
            <!-- Comparison table -->
            <div class="mt-20">
                <div id="hs-pricing-comparision-content"
                    class="hs-collapse hidden w-full overflow-hidden transition-[height] duration-300"
                    aria-labelledby="hs-pricing-comparision">
                    <!-- xs to lg -->
                    <div class="space-y-24 lg:hidden">
                        <section>
                            <div class="px-4 mb-4">
                                <h2 class="text-lg leading-6 font-medium text-gray-800">Free</h2>
                            </div>
    
                            <table class="w-full">
                                <caption
                                    class="bg-gray-50 border-t border-gray-200 py-3 px-4 text-sm font-bold text-gray-800 text-start">
                                    Financial data
                                </caption>
    
                                <thead>
                                    <tr>
                                        <th class="sr-only" scope="col">Feature</th>
                                        <th class="sr-only" scope="col">Included</th>
                                    </tr>
                                </thead>
    
                                <tbody class="divide-y divide-gray-200">
                                    <tr class="border-t border-gray-200">
                                        <th class="py-5 px-4 text-sm font-normal text-gray-600 text-start whitespace-nowrap"
                                            scope="row">Open/High/Low/Close</th>
                                        <td class="py-5 pe-4">
                                            <!-- Check -->
                                            <svg class="shrink-0 ms-auto size-5 text-blue-600"
                                                xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <polyline points="20 6 9 17 4 12" />
                                            </svg>
                                            <!-- End Solid Check -->
                                            <span class="sr-only">Yes</span>
                                        </td>
                                    </tr>
    
                                    <tr class="border-t border-gray-200">
                                        <th class="py-5 px-4 text-sm font-normal text-gray-600 text-start whitespace-nowrap"
                                            scope="row">Price-volume difference indicator</th>
                                        <td class="py-5 pe-4">
                                            <!-- Minus -->
                                            <svg class="shrink-0 ms-auto size-5 text-gray-400"
                                                xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M5 12h14" />
                                            </svg>
                                            <!-- Minus -->
                                            <span class="sr-only">No</span>
                                        </td>
                                    </tr>
                                </tbody>
    
                            </table>
    
                            <table class="w-full">
                                <caption
                                    class="bg-gray-50 border-t border-gray-200 py-3 px-4 text-sm font-bold text-gray-800 text-start">
                                    On-chain data
                                </caption>
    
                                <thead>
                                    <tr>
                                        <th class="sr-only" scope="col">Feature</th>
                                        <th class="sr-only" scope="col">Included</th>
                                    </tr>
                                </thead>
    
                                <tbody class="divide-y divide-gray-200">
                                    <tr class="border-t border-gray-200">
                                        <th class="py-5 px-4 text-sm font-normal text-gray-600 text-start whitespace-nowrap"
                                            scope="row">Network growth</th>
                                        <td class="py-5 pe-4">
                                            <!-- Minus -->
                                            <svg class="shrink-0 ms-auto size-5 text-gray-400"
                                                xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M5 12h14" />
                                            </svg>
                                            <!-- Minus -->
                                            <span class="sr-only">No</span>
                                        </td>
                                    </tr>
    
                                    <tr class="border-t border-gray-200">
                                        <th class="py-5 px-4 text-sm font-normal text-gray-600 text-start whitespace-nowrap"
                                            scope="row">Average token age consumed</th>
                                        <td class="py-5 pe-4">
                                            <!-- Check -->
                                            <svg class="shrink-0 ms-auto size-5 text-blue-600"
                                                xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <polyline points="20 6 9 17 4 12" />
                                            </svg>
                                            <!-- End Solid Check -->
                                            <span class="sr-only">Yes</span>
                                        </td>
                                    </tr>
    
                                </tbody>
                            </table>
                        </section>
                    </div>
                    <!-- End xs to lg -->
    
                    <!-- lg+ -->
                    <div class="hidden lg:block">
                        <table class="w-full h-px">
                            <caption class="sr-only">
                                Pricing plan comparison
                            </caption>
                            <thead class="sticky top-0 inset-x-0 bg-white">
                                <tr>
                                    <th class="py-4 ps-6 pe-6 text-sm font-medium text-gray-800 text-start"
                                        scope="col">
                                        <span class="sr-only">Feature by</span>
                                        <span class="">Plans</span>
                                    </th>
    
                                    <th class="w-1/4 py-4 px-6 text-lg leading-6 font-medium text-gray-800 text-center"
                                        scope="col">Free</th>
                                    <th class="w-1/4 py-4 px-6 text-lg leading-6 font-medium text-gray-800 text-center"
                                        scope="col">Startup</th>
                                    <th class="w-1/4 py-4 px-6 text-lg leading-6 font-medium text-gray-800 text-center"
                                        scope="col">Team</th>
                                    <th class="w-1/4 py-4 px-6 text-lg leading-6 font-medium text-gray-800 text-center"
                                        scope="col">Enterprise</th>
                                </tr>
                            </thead>
                            <tbody class="border-t border-gray-200 divide-y divide-gray-200">
                                <tr>
                                    <th class="py-3 ps-6 bg-gray-50 font-bold text-gray-800 text-start" colspan="5"
                                        scope="colgroup">Financial data</th>
                                </tr>
    
                                <tr>
                                    <th class="py-5 ps-6 pe-6 text-sm font-normal text-gray-600 text-start whitespace-nowrap"
                                        scope="row">Open/High/Low/Close</th>
    
                                    <td class="py-5 px-6">
                                        <!-- Check -->
                                        <svg class="mx-auto shrink-0 size-5 text-blue-600"
                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round">
                                            <polyline points="20 6 9 17 4 12" />
                                        </svg>
                                        <!-- End Solid Check -->
                                        <span class="sr-only">Included in Free</span>
                                    </td>
    
                                    <td class="py-5 px-6">
                                        <!-- Check -->
                                        <svg class="mx-auto shrink-0 size-5 text-blue-600"
                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round">
                                            <polyline points="20 6 9 17 4 12" />
                                        </svg>
                                        <!-- End Solid Check -->
                                        <span class="sr-only">Included in Startup</span>
                                    </td>
    
                                    <td class="py-5 px-6">
                                        <!-- Check -->
                                        <svg class="mx-auto shrink-0 size-5 text-blue-600"
                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round">
                                            <polyline points="20 6 9 17 4 12" />
                                        </svg>
                                        <!-- End Solid Check -->
                                        <span class="sr-only">Included in Team</span>
                                    </td>
    
                                    <td class="py-5 px-6">
                                        <!-- Check -->
                                        <svg class="mx-auto shrink-0 size-5 text-blue-600"
                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round">
                                            <polyline points="20 6 9 17 4 12" />
                                        </svg>
                                        <!-- End Solid Check -->
                                        <span class="sr-only">Included in Enterprise</span>
                                    </td>
                                </tr>
    
                                <tr>
                                    <th class="py-5 ps-6 pe-6 text-sm font-normal text-gray-600 text-start whitespace-nowrap"
                                        scope="row">Price-volume difference indicator</th>
    
                                    <td class="py-5 px-6">
                                        <!-- Minus -->
                                        <svg class="mx-auto shrink-0 size-5 text-gray-400"
                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M5 12h14" />
                                        </svg>
                                        <!-- Minus -->
                                        <span class="sr-only">Not included in Free</span>
                                    </td>
    
                                    <td class="py-5 px-6">
                                        <!-- Check -->
                                        <svg class="mx-auto shrink-0 size-5 text-blue-600"
                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round">
                                            <polyline points="20 6 9 17 4 12" />
                                        </svg>
                                        <!-- End Solid Check -->
                                        <span class="sr-only">Included in Startup</span>
                                    </td>
    
                                    <td class="py-5 px-6">
                                        <!-- Check -->
                                        <svg class="mx-auto shrink-0 size-5 text-blue-600"
                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round">
                                            <polyline points="20 6 9 17 4 12" />
                                        </svg>
                                        <!-- End Solid Check -->
                                        <span class="sr-only">Included in Team</span>
                                    </td>
    
                                    <td class="py-5 px-6">
                                        <!-- Check -->
                                        <svg class="mx-auto shrink-0 size-5 text-blue-600"
                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round">
                                            <polyline points="20 6 9 17 4 12" />
                                        </svg>
                                        <!-- End Solid Check -->
                                        <span class="sr-only">Included in Enterprise</span>
                                    </td>
                                </tr>
    
                                <tr>
                                    <th class="py-3 ps-6 bg-gray-50 font-bold text-gray-800 text-start" colspan="5"
                                        scope="colgroup">On-chain data</th>
                                </tr>
    
                                <tr>
                                    <th class="py-5 ps-6 pe-6 text-sm font-normal text-gray-600 text-start whitespace-nowrap"
                                        scope="row">Average token age consumed</th>
    
                                    <td class="py-5 px-6">
                                        <!-- Check -->
                                        <svg class="mx-auto shrink-0 size-5 text-blue-600"
                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round">
                                            <polyline points="20 6 9 17 4 12" />
                                        </svg>
                                        <!-- End Solid Check -->
                                        <span class="sr-only">Not included in Free</span>
                                    </td>
    
                                    <td class="py-5 px-6">
                                        <!-- Check -->
                                        <svg class="mx-auto shrink-0 size-5 text-gray-400"
                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M5 12h14" />
                                        </svg>
                                        <!-- End Solid Check -->
                                        <span class="sr-only">Included in Startup</span>
                                    </td>
    
                                    <td class="py-5 px-6">
                                        <!-- Check -->
                                        <svg class="mx-auto shrink-0 size-5 text-blue-600"
                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round">
                                            <polyline points="20 6 9 17 4 12" />
                                        </svg>
                                        <!-- End Solid Check -->
                                        <span class="sr-only">Included in Team</span>
                                    </td>
    
                                    <td class="py-5 px-6">
                                        <!-- Check -->
                                        <svg class="mx-auto shrink-0 size-5 text-blue-600"
                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round">
                                            <polyline points="20 6 9 17 4 12" />
                                        </svg>
                                        <!-- End Solid Check -->
                                        <span class="sr-only">Included in Enterprise</span>
                                    </td>
                                </tr>
    
                                <tr>
                                    <th class="py-5 ps-6 pe-6 text-sm font-normal text-gray-600 text-start whitespace-nowrap"
                                        scope="row">Exchange flow</th>
    
                                    <td class="py-5 px-6">
                                        <!-- Minus -->
                                        <svg class="mx-auto shrink-0 size-5 text-gray-400"
                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M5 12h14" />
                                        </svg>
                                        <!-- Minus -->
                                        <span class="sr-only">Not included in Free</span>
                                    </td>
    
                                    <td class="py-5 px-6">
                                        <!-- Check -->
                                        <svg class="mx-auto shrink-0 size-5 text-gray-400"
                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M5 12h14" />
                                        </svg>
                                        <!-- End Solid Check -->
                                        <span class="sr-only">Included in Startup</span>
                                    </td>
    
                                    <td class="py-5 px-6">
                                        <!-- Check -->
                                        <svg class="mx-auto shrink-0 size-5 text-blue-600"
                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round">
                                            <polyline points="20 6 9 17 4 12" />
                                        </svg>
                                        <!-- End Solid Check -->
                                        <span class="sr-only">Included in Team</span>
                                    </td>
    
                                    <td class="py-5 px-6">
                                        <!-- Check -->
                                        <svg class="mx-auto shrink-0 size-5 text-blue-600"
                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round">
                                            <polyline points="20 6 9 17 4 12" />
                                        </svg>
                                        <!-- End Solid Check -->
                                        <span class="sr-only">Included in Enterprise</span>
                                    </td>
                                </tr>
    
                            </tbody>
                        </table>
                    </div>
                    <!-- End lg+ -->
                </div>
    
                <div class="text-center mt-12">
                    <button type="button"
                        class="hs-collapse-toggle py-3 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-full border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 focus:outline-none focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none"
                        id="hs-pricing-comparision" aria-expanded="false" aria-controls="hs-pricing-comparision-content"
                        data-hs-collapse="#hs-pricing-comparision-content">
                        <span class="hs-collapse-open:hidden block">Ver comparación de precios</span>
                        <span class="hs-collapse-open:block hidden">Ocultar comparación de precios</span>
                        <svg class="hs-collapse-open:rotate-180 shrink-0 size-4" xmlns="http://www.w3.org/2000/svg"
                            width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="m6 9 6 6 6-6" />
                        </svg>
                    </button>
                </div>
            </div>
            <!-- End Comparison table -->
        </div>
        <!-- End Pricing -->
    
        <!-- ========== FOOTER ========== -->
        <footer class="mt-auto w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto">
            <!-- Grid -->
            <div class="text-center">
                <div>
                    <a class="flex-none text-xl font-semibold text-black" href="#" aria-label="Brand">ADO</a>
                </div>
                <!-- End Col -->
    
                <div class="mt-3">
                    <p class="text-gray-500">Somos parte de la familia<a
                            class="text-blue-600 decoration-2 hover:underline focus:outline-none focus:underline font-medium"
                            href="#">Technova</a>.</p>
                    <p class="text-gray-500">
                        © Todos los derechos reservados 2024.
                    </p>
                </div>
    
                <!-- Social Brands -->
                <div class="mt-3 space-x-2">
                    <a class="size-8 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-full border border-transparent text-gray-500 hover:bg-gray-50 focus:outline-none focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none"
                        href="#">
                        <svg class="shrink-0 size-3.5" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                            fill="currentColor" viewBox="0 0 16 16">
                            <path
                                d="M15.545 6.558a9.42 9.42 0 0 1 .139 1.626c0 2.434-.87 4.492-2.384 5.885h.002C11.978 15.292 10.158 16 8 16A8 8 0 1 1 8 0a7.689 7.689 0 0 1 5.352 2.082l-2.284 2.284A4.347 4.347 0 0 0 8 3.166c-2.087 0-3.86 1.408-4.492 3.304a4.792 4.792 0 0 0 0 3.063h.003c.635 1.893 2.405 3.301 4.492 3.301 1.078 0 2.004-.276 2.722-.764h-.003a3.702 3.702 0 0 0 1.599-2.431H8v-3.08h7.545z" />
                        </svg>
                    </a>
                    <a class="size-8 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-full border border-transparent text-gray-500 hover:bg-gray-50 focus:outline-none focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none"
                        href="#">
                        <svg class="shrink-0 size-3.5" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                            fill="currentColor" viewBox="0 0 16 16">
                            <path
                                d="M5.026 15c6.038 0 9.341-5.003 9.341-9.334 0-.14 0-.282-.006-.422A6.685 6.685 0 0 0 16 3.542a6.658 6.658 0 0 1-1.889.518 3.301 3.301 0 0 0 1.447-1.817 6.533 6.533 0 0 1-2.087.793A3.286 3.286 0 0 0 7.875 6.03a9.325 9.325 0 0 1-6.767-3.429 3.289 3.289 0 0 0 1.018 4.382A3.323 3.323 0 0 1 .64 6.575v.045a3.288 3.288 0 0 0 2.632 3.218 3.203 3.203 0 0 1-.865.115 3.23 3.23 0 0 1-.614-.057 3.283 3.283 0 0 0 3.067 2.277A6.588 6.588 0 0 1 .78 13.58a6.32 6.32 0 0 1-.78-.045A9.344 9.344 0 0 0 5.026 15z" />
                        </svg>
                    </a>
                    <a class="size-8 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-full border border-transparent text-gray-500 hover:bg-gray-50 focus:outline-none focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none"
                        href="#">
                        <svg class="shrink-0 size-3.5" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                            fill="currentColor" viewBox="0 0 16 16">
                            <path
                                d="M8 0C3.58 0 0 3.58 0 8c0 3.54 2.29 6.53 5.47 7.59.4.07.55-.17.55-.38 0-.19-.01-.82-.01-1.49-2.01.37-2.53-.49-2.69-.94-.09-.23-.48-.94-.82-1.13-.28-.15-.68-.52-.01-.53.63-.01 1.08.58 1.23.82.72 1.21 1.87.87 2.33.66.07-.52.28-.87.51-1.07-1.78-.2-3.64-.89-3.64-3.95 0-.87.31-1.59.82-2.15-.08-.2-.36-1.02.08-2.12 0 0 .67-.21 2.2.82.64-.18 1.32-.27 2-.27.68 0 1.36.09 2 .27 1.53-1.04 2.2-.82 2.2-.82.44 1.1.16 1.92.08 2.12.51.56.82 1.27.82 2.15 0 3.07-1.87 3.75-3.65 3.95.29.25.54.73.54 1.48 0 1.07-.01 1.93-.01 2.2 0 .21.15.46.55.38A8.012 8.012 0 0 0 16 8c0-4.42-3.58-8-8-8z" />
                        </svg>
                    </a>
                    <a class="size-8 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-full border border-transparent text-gray-500 hover:bg-gray-50 focus:outline-none focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none"
                        href="#">
                        <svg class="shrink-0 size-3.5" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                            fill="currentColor" viewBox="0 0 16 16">
                            <path
                                d="M3.362 10.11c0 .926-.756 1.681-1.681 1.681S0 11.036 0 10.111C0 9.186.756 8.43 1.68 8.43h1.682v1.68zm.846 0c0-.924.756-1.68 1.681-1.68s1.681.756 1.681 1.68v4.21c0 .924-.756 1.68-1.68 1.68a1.685 1.685 0 0 1-1.682-1.68v-4.21zM5.89 3.362c-.926 0-1.682-.756-1.682-1.681S4.964 0 5.89 0s1.68.756 1.68 1.68v1.682H5.89zm0 .846c.924 0 1.68.756 1.68 1.681S6.814 7.57 5.89 7.57H1.68C.757 7.57 0 6.814 0 5.89c0-.926.756-1.682 1.68-1.682h4.21zm6.749 1.682c0-.926.755-1.682 1.68-1.682.925 0 1.681.756 1.681 1.681s-.756 1.681-1.68 1.681h-1.681V5.89zm-.848 0c0 .924-.755 1.68-1.68 1.68A1.685 1.685 0 0 1 8.43 5.89V1.68C8.43.757 9.186 0 10.11 0c.926 0 1.681.756 1.681 1.68v4.21zm-1.681 6.748c.926 0 1.682.756 1.682 1.681S11.036 16 10.11 16s-1.681-.756-1.681-1.68v-1.682h1.68zm0-.847c-.924 0-1.68-.755-1.68-1.68 0-.925.756-1.681 1.68-1.681h4.21c.924 0 1.68.756 1.68 1.68 0 .926-.756 1.681-1.68 1.681h-4.21z" />
                        </svg>
                    </a>
                </div>
                <!-- End Social Brands -->
            </div>
            <!-- End Grid -->
        </footer>
        <!-- ========== END FOOTER ========== -->
        <script src="./node_modules/preline/dist/preline.js"></script>
    </body>
    
    </html>