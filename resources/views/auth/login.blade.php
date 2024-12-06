<x-guest-layout>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <x-authentication-card>
        <x-slot name="logo">
            {{-- <x-authentication-card-logo /> --}}
        </x-slot>

        <x-validation-errors class="mb-4" />

        @session('status')
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ $value }}
            </div>
        @endsession

        <div class="mt-7 bg-white border border-gray-200 rounded-xl shadow-sm">
            <div class="p-4 sm:p-7">
                <div class="text-center">
                    <h1 class="block text-2xl font-bold text-gray-800">Iniciar sesión</h1>
                    <p class="mt-2 text-sm text-gray-600">
                        ¿No tienes una cuenta?
                        <a class="text-blue-600 decoration-2 hover:underline focus:outline-none focus:underline font-medium"
                            href="/register">
                            Regístrate aquí
                        </a>
                    </p>
                </div>

                <div class="mt-5">

                    <!-- Form -->
                    <form method="POST" action="{{ route('login') }}" x-data="{ isSubmitting: false }" @submit="isSubmitting = true">
                        @csrf

                        <div class="grid gap-y-4">
                            <!-- Form Group -->
                            <div>
                                <label for="email" class="block text-sm mb-2">
                                    Correo electrónico
                                </label>
                                <div class="relative">
                                    <input type="email" id="email" name="email" autofocus
                                        autocomplete="off"
                                        class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none"
                                        required>
                                </div>
                            </div>
                            <!-- End Form Group -->

                            <!-- Form Group -->
                            <div>
                                <div class="flex justify-between items-center">
                                    <label for="password" class="block text-sm mb-2">
                                        Contraseña
                                    </label>
                                    @if (Route::has('password.request'))
                                        <a class="inline-flex items-center gap-x-1 text-sm text-blue-600 decoration-2 hover:underline focus:outline-none focus:underline font-medium"
                                            href="{{ route('password.request') }}">
                                            ¿Olvidaste tu contraseña?
                                        </a>
                                    @endif
                                </div>

                                <div class="relative">
                                    <div class="flex items-center mt-1 border rounded-md">
                                        <input type="password" id="password" name="password"
                                        autocomplete="off"
                                        class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none"
                                        required>
                                        <i class="bi bi-eye-slash cursor-pointer px-3 text-gray-500" id="togglePassword" onclick="togglePasswordVisibility()"></i>
                                    </div>
                                </div>
                                
                            </div>
                            <!-- End Form Group -->

                            <!-- Checkbox -->
                            <div class="flex items-center">
                                <div class="flex">
                                    <input id="remember-me" name="remember-me" type="checkbox"
                                        class="shrink-0 mt-0.5 border-gray-200 rounded text-blue-600 focus:ring-blue-500">
                                </div>
                                <div class="ms-3">
                                    <label for="remember-me" class="text-sm">Recuerdame</label>
                                </div>
                            </div>
                            <!-- End Checkbox -->

                            <!-- Spinner -->
                            <div class="flex flex-auto flex-col justify-center items-center" x-show="isSubmitting" style="display: none;">
                                <div class="animate-spin inline-block size-6 border-[3px] border-current border-t-transparent text-blue-600 rounded-full dark:text-blue-500" role="status" aria-label="loading">
                                    <span class="sr-only">Loading...</span>
                                </div>
                            </div>

                            <button type="submit"
                                class="w-full py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-none focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">
                                Iniciar sesión
                            </button>
                        </div>
                    </form>
                    <!-- End Form -->
                </div>
            </div>
        </div>

    </x-authentication-card>
    <script src="{{ asset('js/auth/toggle-password.js') }}"></script>
    <script src="{{ asset('js/auth/dev-tools.js') }}"></script>
</x-guest-layout>