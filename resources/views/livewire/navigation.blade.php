<div x-init="HSStaticMethods.autoInit()">
    <!-- Breadcrumb -->
    <div class="sticky top-0 inset-x-0 z-20 bg-white border-y px-4 sm:px-6 lg:px-8 lg:hidden">
        <div class="flex items-center py-2">
            <!-- Navigation Toggle -->
            <button type="button"
                class="size-8 flex justify-center items-center gap-x-2 border border-gray-200 text-gray-800 hover:text-gray-500 rounded-lg focus:outline-none focus:text-gray-500 disabled:opacity-50 disabled:pointer-events-none"
                aria-haspopup="dialog" aria-expanded="false" aria-controls="hs-application-sidebar"
                aria-label="Toggle navigation" data-hs-overlay="#hs-application-sidebar">
                <span class="sr-only">Toggle Navigation</span>
                <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round">
                    <rect width="18" height="18" x="3" y="3" rx="2" />
                    <path d="M15 3v18" />
                    <path d="m8 9 3 3-3 3" />
                </svg>
            </button>
            <!-- End Navigation Toggle -->

            <!-- Breadcrumb -->
            <ol class="ms-3 flex items-center whitespace-nowrap">
                <li class="flex items-center text-sm text-gray-800">
                    Menú
                    <svg class="shrink-0 mx-3 overflow-visible size-2.5 text-gray-400" width="16" height="16"
                        viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M5 1L10.6869 7.16086C10.8637 7.35239 10.8637 7.64761 10.6869 7.83914L5 14"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                    </svg>
                </li>
                @foreach ($breadcrumb as $item)
                    <li class="flex items-center text-sm text-gray-800">
                        {{ $item }}
                        @if (!$loop->last)
                            <svg class="shrink-0 mx-3 overflow-visible size-2.5 text-gray-400" width="16" height="16"
                                viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M5 1L10.6869 7.16086C10.8637 7.35239 10.8637 7.64761 10.6869 7.83914L5 14"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                            </svg>
                        @endif
                    </li>
                @endforeach
            </ol>
            <!-- End Breadcrumb -->
        </div>
    </div>
    <!-- End Breadcrumb -->

    <!-- Sidebar -->
    <div id="hs-application-sidebar"
        class="hs-overlay  [--auto-close:lg]
    hs-overlay-open:translate-x-0
    -translate-x-full transition-all duration-300 transform
    w-[260px] h-full
    hidden
    fixed inset-y-0 start-0 z-[60]
    bg-white border-e border-gray-200
    lg:block lg:translate-x-0 lg:end-auto lg:bottom-0
   "
        role="dialog" tabindex="-1" aria-label="Sidebar">
        <div class="relative flex flex-col h-full max-h-full">
            <div class="px-6 pt-4 flex items-center">
                <!-- Logo -->
                <div class="max-w-[200px] break-words">
                    <a class="flex-none rounded-xl text-xl inline-block font-semibold focus:outline-none focus:opacity-80 text-wrap"
                        href="/" aria-label="Preline">
                        <span class="text-gray-700 dark:text-gray-200">Bienvenido(a), </span>
                        <span class="text-blue-500 dark:text-blue-400 font-bold text-2xl break-words"
                            x-data="{{ json_encode(['name' => auth()->user()->name]) }}"
                            x-text="name"
                            x-on:profile-updated.window="name = $event.detail.name">
                        </span>
                    </a>
                </div>                
                <!-- End Logo -->

                <div class="hidden lg:block ms-2">

                </div>
            </div>

            <!-- Content -->
            <div
                class="h-full overflow-y-auto [&::-webkit-scrollbar]:w-2 [&::-webkit-scrollbar-thumb]:rounded-full [&::-webkit-scrollbar-track]:bg-gray-100 [&::-webkit-scrollbar-thumb]:bg-gray-300">
                <nav class="hs-accordion-group p-3 w-full flex flex-col flex-wrap" data-hs-accordion-always-open>
                    <ul class="flex flex-col space-y-1">
                        <li class="flex items-center gap-x-3.5 py-2 px-2.5 bg-gray-100 text-sm text-gray-800 rounded-lg hover:bg-gray-100 focus:outline-none focus:bg-gray-100 relative">
                            <!-- Imagen del usuario -->
                            <img 
                                src="{{ Auth::user()->profile_photo_path 
                                    ? (Str::startsWith(Auth::user()->profile_photo_path, ['http', 'https']) 
                                        ? Auth::user()->profile_photo_path 
                                        : asset('storage/' . Auth::user()->profile_photo_path)) 
                                    : 'https://www.gravatar.com/avatar/' . md5(strtolower(trim(Auth::user()->email))) . '?d=mp' }}" 
                                class="w-10 h-10 rounded-full object-cover"
                            />                        
                        
                            <!-- Acordeón de "Mi cuenta" -->
                            <div class="hs-accordion flex-grow" id="account-accordion">
                                <button type="button"
                                    class="hs-accordion-toggle w-full text-start flex items-center gap-x-3.5 py-2 px-2.5 text-sm text-gray-800 rounded-lg hover:bg-gray-100 focus:outline-none focus:bg-gray-100"
                                    aria-expanded="true" aria-controls="account-accordion-child">
                                    Mi cuenta
                        
                                    <svg class="hs-accordion-active:block ms-auto hidden size-4"
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path d="m18 15-6-6-6 6" />
                                    </svg>
                        
                                    <svg class="hs-accordion-active:hidden ms-auto block size-4"
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path d="m6 9 6 6 6-6" />
                                    </svg>
                                </button>
                        
                                <!-- Contenido del acordeón -->
                                <div id="account-accordion-child"
                                    class="hs-accordion-content w-44 h-22 overflow-hidden transition-[height] duration-300 hidden absolute top-full right-0 bg-white shadow-md rounded-lg mt-1 z-10"
                                    role="region" aria-labelledby="account-accordion">
                                    <ul class="ps-8 pb-3 pt-1 space-y-1">
                                        <li class="w-full">
                                            <x-nav-link :href="route('profile.show')" wire:navigate :active="request()->routeIs('profile.show')">
                                                {{ __('Profile') }}
                                            </x-nav-link>
                                        </li>

                                        @if(auth()->user() && auth()->user()->type !== 'cliente')
                                            <li class="w-full">
                                                <x-nav-link href="/gestion">
                                                    {{ __('Panel de administración') }}
                                                </x-nav-link>
                                            </li>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        </li>
                        <li
                            class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm text-gray-800 rounded-lg hover:bg-gray-100 focus:outline-none focus:bg-gray-100">
                            <x-heroicon-o-home class="w-5 h-5 text-gray-500" />
                            <x-nav-link :href="route('welcome')" :active="request()->routeIs('welcome')">
                                {{ __('Inicio') }}
                            </x-nav-link>
                        </li>
                        <li
                            class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm text-gray-800 rounded-lg hover:bg-gray-100 focus:outline-none focus:bg-gray-100">
                            <x-heroicon-o-chart-bar-square class="w-5 h-5 text-gray-500" />
                            <x-nav-link :href="route('dashboard')" wire:navigate :active="request()->routeIs('dashboard')">
                                {{ __('Dashboard') }}
                            </x-nav-link>
                        </li>
                        <li
                            class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm text-gray-800 rounded-lg hover:bg-gray-100 focus:outline-none focus:bg-gray-100">
                            <x-heroicon-o-ticket class="w-5 h-5 text-gray-500" />
                            <x-nav-link :href="route('my.tickets')" wire:navigate :active="request()->routeIs('my.tickets')">
                                {{ __('Mis boletos') }}
                            </x-nav-link>
                        </li>
                        <li
                            class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm text-gray-800 rounded-lg hover:bg-gray-100 focus:outline-none focus:bg-gray-100">
                            <x-heroicon-o-currency-dollar class="w-5 h-5 text-gray-500" />
                            <x-nav-link :href="route('buy.tickets')" wire:navigate :active="request()->routeIs('buy.tickets')">
                                {{ __('Comprar boletos') }}
                            </x-nav-link>
                        </li>

                        <li class="flex items-center justify-center gap-x-3.5 py-2 px-2.5">
                            <x-filament::button
                                wire:click="logout"
                                icon="heroicon-m-arrow-left-start-on-rectangle"
                                icon-position="after"
                                class="bg-red-600 text-white hover:bg-red-700 w-full">
                                Finalizar sesión
                            </x-filament::button>
                        </li>
                        
                    </ul>
                </nav>
            </div>
            <!-- End Content -->
        </div>
    </div>
    <!-- End Sidebar -->

    <!-- Content -->
    <div class="w-full pt-10 px-4 sm:px-6 md:px-8 lg:ps-72 bg-white">
        @if(session('success') || session('error') || session('warning'))
            <div 
                x-data="{ show: true }" 
                x-show="show" 
                x-transition.duration.500ms
                x-init="setTimeout(() => show = false, 5000)" 
                class="fixed top-5 right-5 z-50 max-w-xs w-full"
            >
                @if(session('success'))
                    <div class="flex items-center gap-3 bg-green-100 border-l-4 border-green-500 text-green-800 p-4 shadow-lg rounded-lg">
                        <x-heroicon-o-check-circle class="w-6 h-6 text-green-600" />
                        <div class="flex-1">
                            <strong class="block">Éxito</strong>
                            <span>{{ session('success') }}</span>
                        </div>
                        <button @click="show = false" class="text-green-700 hover:text-green-900 transition">
                            <x-heroicon-o-x-mark class="w-5 h-5" />
                        </button>
                    </div>
                @elseif(session('error'))
                    <div class="flex items-center gap-3 bg-red-100 border-l-4 border-red-500 text-red-800 p-4 shadow-lg rounded-lg">
                        <x-heroicon-o-x-circle class="w-6 h-6 text-red-600" />
                        <div class="flex-1">
                            <strong class="block">Error</strong>
                            <span>{{ session('error') }}</span>
                        </div>
                        <button @click="show = false" class="text-red-700 hover:text-red-900 transition">
                            <x-heroicon-o-x-mark class="w-5 h-5" />
                        </button>
                    </div>
                @elseif(session('warning'))
                    <div class="flex items-center gap-3 bg-yellow-100 border-l-4 border-yellow-500 text-yellow-800 p-4 shadow-lg rounded-lg">
                        <x-heroicon-o-exclamation-triangle class="w-6 h-6 text-yellow-600" />
                        <div class="flex-1">
                            <strong class="block">Advertencia</strong>
                            <span>{{ session('warning') }}</span>
                        </div>
                        <button @click="show = false" class="text-yellow-700 hover:text-yellow-900 transition">
                            <x-heroicon-o-x-mark class="w-5 h-5" />
                        </button>
                    </div>
                @endif
            </div>
        @endif

        @yield('content')
    </div>
    <!-- End Content -->
</div>
