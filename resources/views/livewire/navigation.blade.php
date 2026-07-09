<div x-init="HSStaticMethods.autoInit()">
    <!-- Breadcrumb -->
    <div class="sticky top-0 inset-x-0 z-20 bg-white border-y px-4 sm:px-6 lg:px-8 lg:hidden">
        <div class="flex items-center py-2">
            <!-- Navigation Toggle -->
            <button type="button"
                class="flex justify-center items-center gap-x-2 border border-gray-200 text-gray-800 hover:text-gray-500 rounded-lg focus:outline-none focus:text-gray-500 disabled:opacity-50 disabled:pointer-events-none"
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
        class="hs-overlay [--auto-close:lg] hs-overlay-open:translate-x-0 -translate-x-full transition-all duration-300 transform w-[260px] h-full hidden fixed inset-y-0 start-0 z-[60] bg-white border-e border-gray-200 lg:block lg:translate-x-0 lg:end-auto lg:bottom-0"
        role="dialog" tabindex="-1" aria-label="Sidebar">
        <div class="relative flex flex-col h-full max-h-full">
            <!-- User Profile Section -->
            <div class="px-6 pt-6 pb-4 flex items-center gap-3 border-b border-gray-100 bg-gradient-to-r from-blue-600 to-blue-500 opacity-95 text-white font-bold rounded-lg shadow-md">
                <!-- User Avatar -->
                <div class="shrink-0">
                    <a href="{{ route('profile.show') }}">
                        <img 
                            src="{{ Auth::user()->profile_photo_path 
                                ? (Str::startsWith(Auth::user()->profile_photo_path, ['http', 'https']) 
                                    ? Auth::user()->profile_photo_path 
                                    : Storage::url(Auth::user()->profile_photo_path)) 
                                : 'https://www.gravatar.com/avatar/' . md5(strtolower(trim(Auth::user()->email))) . '?d=mp' }}" 
                            class="w-14 h-14 rounded-full object-cover border-2 border-green-500 hover:border-white transition-colors"
                            alt="User profile"
                        />
                    </a>
                </div>

                <!-- User Info -->
                <div class="min-w-0">
                    <p class="text-sm font-medium text-gray-200">Bienvenido(a)</p>
                    <p class="text-lg font-semibold text-white truncate" 
                        x-data="{{ json_encode(['name' => auth()->user()->name]) }}"
                        x-text="name"
                        x-on:profile-updated.window="name = $event.detail.name">
                    </p>
                </div>
            </div>

            <!-- Content -->
            <div class="h-full overflow-y-auto">
                <nav class="hs-accordion-group p-3 w-full flex flex-col" data-hs-accordion-always-open>
                    <ul class="flex flex-col space-y-1">
                        <!-- Account Dropdown -->
                        <li class="hs-accordion" id="account-accordion">
                            <button type="button"
                                class="hs-accordion-toggle w-full flex items-center gap-x-3 py-2.5 px-3 text-sm font-medium text-gray-700 rounded-lg hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-100 transition-colors"
                                aria-expanded="true" aria-controls="account-accordion-child">
                                <x-heroicon-o-user class="w-5 h-5 text-gray-500" />
                                <span class="flex-1 text-left">Mi cuenta</span>
                                <svg class="hs-accordion-active:rotate-180 ms-auto size-4 text-gray-500 transition-transform"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <path d="m6 9 6 6 6-6" />
                                </svg>
                            </button>

                            <div id="account-accordion-child"
                                class="hs-accordion-content w-full overflow-hidden transition-[height] duration-300 hidden"
                                role="region" aria-labelledby="account-accordion">
                                <ul class="pt-1 ps-8 space-y-1">
                                    <li>
                                        <x-nav-link :href="route('profile.show')" wire:navigate :active="request()->routeIs('profile.show')" class="!px-2 ml-2 !py-1.5">
                                            {{ __('Perfil') }}
                                        </x-nav-link>
                                    </li>

                                    @if(auth()->user() && auth()->user()->type !== 'cliente')
                                        <li>
                                            <x-nav-link href="/gestion" class="!px-2 ml-2 !py-1.5">
                                                {{ __('Administración') }}
                                            </x-nav-link>
                                        </li>
                                    @endif
                                </ul>
                            </div>
                        </li>

                        <!-- Otras opciones -->
                        <li class="flex items-center gap-x-3.5 py-2 px-2.5 texm text-gray-800 rounded-lg hover:bg-blue-50 focus:outline-none focus:bg-blue-100">
                            <x-heroicon-o-home class="w-5 h-5 text-gray-500" />
                            <x-nav-link :href="route('welcome')" :active="request()->routeIs('welcome')">Inicio</x-nav-link>
                        </li>
                        <li class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm text-gray-800 rounded-lg hover:bg-blue-50 focus:outline-none focus:bg-blue-100">
                            <x-heroicon-o-chart-bar-square class="w-5 h-5 text-grat-sy-500" />
                            <x-nav-link :href="route('dashboard')" wire:navigate :active="request()->routeIs('dashboard')">Panel</x-nav-link>
                        </li>
                        <li class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm text-gray-800 rounded-lg hover:bg-blue-50 focus:outline-none focus:bg-blue-100">
                            <x-heroicon-o-ticket class="w-5 h-5 text-gray-500" />
                            <x-nav-link :href="route('my.tickets')" wire:navigate :active="request()->routeIs('my.tickets')">Mis boletos</x-nav-link>
                        </li>
                        <li class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm text-gray-800 rounded-lg hover:bg-blue-50 focus:outline-none focus:bg-blue-100">
                            <x-heroicon-o-currency-dollar class="w-5 h-5 text-gray-500" />
                            <x-nav-link :href="route('buy.tickets')" wire:navigate :active="request()->routeIs('buy.tickets')">Comprar boletos</x-nav-link>
                        </li>
                        <li class="flex items-center justify-center gap-x-3.5 py-2 px-2.5">
                            <x-filament::button wire:click="logout" icon="heroicon-m-arrow-left-start-on-rectangle" icon-position="after" class="bg-red-600 text-white hover:bg-red-700 w-full">Finalizar sesión</x-filament::button>
                        </li>
                    </ul>
                </nav>
            </div>
            <!-- End Content -->
        </div>
    </div>
    <!-- End Sidebar -->

    <!-- Content -->
    <div class="w-full pt-4 px-4 sm:px-6 md:px-8 lg:ps-72 bg-white">
        <x-alpine-notifications />
        @yield('content')
    </div>
    <!-- End Content -->
</div>