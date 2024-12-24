<x-guest-layout>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <x-authentication-card>
        <x-slot name="logo">
            {{-- <x-authentication-card-logo /> --}}
        </x-slot>

        <x-validation-errors class="mb-4" />

        <div class="mt-7 bg-white border border-gray-200 rounded-xl shadow-sm">
            <div class="p-4 sm:p-7">
                <div class="text-center">
                    <a 
                    class="decoration-2 font-medium"
                    href="/">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
                        </svg>                                           
                    </a>
                    <h1 class="block text-2xl font-bold text-gray-800">Crear cuenta</h1>
                    <p class="mt-2 text-sm text-gray-600">
                        ¿Ya tienes una cuenta?
                        <a class="text-blue-600 decoration-2 focus:outline-none font-medium"
                            href="/login">
                            Inicia sesión aquí
                        </a>
                    </p>
                </div>

                <div class="mt-5">

                    <!-- Form -->
                    <form method="POST" action="{{ route('register') }}" x-data="{ isSubmitting: false }" autocomplete="off"
                        @submit="isSubmitting = true">
                        @csrf

                        <div class="grid gap-y-4">

                            <input type="text" name="dummy-field" style="display: none;" autocomplete="off">

                            <div>
                                <x-label for="name" value="{{ __('Nombre(s)') }}" />
                                <x-input id="name" class="block mt-1 w-full" type="text" name="name" required
                                    autofocus autocomplete="new-name" />
                            </div>

                            <div class="mt-4">
                                <x-label for="surnames" value="{{ __('Apellido(s)') }}" />
                                <x-input id="surnames" class="block mt-1 w-full" type="text" name="surnames"
                                    required autofocus autocomplete="new-surnames" />
                            </div>

                            <div class="mt-4">
                                <x-label for="phone" value="{{ __('Teléfono') }}" />
                                <x-input id="phone" class="block mt-1 w-full" type="tel" name="phone" required
                                    autofocus autocomplete="new-phone" />
                            </div>

                            <div class="mt-4">
                                <x-label for="email" value="{{ __('Email') }}" />
                                <x-input id="email" class="block mt-1 w-full" type="email" name="email" required
                                autocomplete="new-email" />
                            </div>

                            <div class="mt-4">
                                <x-label for="password" value="{{ __('Password') }}" />
                                <div class="flex items-center mt-1 border rounded-md">
                                    <x-input id="password" class="flex-1 px-3 py-2 border-none focus:ring-0"
                                        type="password" name="password" required autocomplete="off" />
                                    <i class="bi bi-eye-slash cursor-pointer px-3 text-gray-500" id="togglePassword"
                                        onclick="togglePasswordVisibility()"></i>
                                </div>
                            </div>

                            <!-- Strong Password -->
                            <div class="max-w-sm">
                                <div class="flex">
                                    <div class="relative flex-1">
                                        <div id="hs-strong-password-popover"
                                            class="hidden absolute z-10 w-full bg-white shadow-md rounded-lg p-4">
                                            <div id="hs-strong-password-in-popover"
                                                data-hs-strong-password='{
                                                "target": "#password",
                                                "hints": "#hs-strong-password-popover",
                                                {{-- "stripClasses": "hs-strong-password:opacity-100 hs-strong-password-accepted:bg-teal-500 h-2 flex-auto rounded-full bg-blue-500 opacity-50 mx-1", --}}
                                                "mode": "popover",
                                                 "minLength": "8"
                                                }'
                                                class="flex -mx-1">
                                            </div>

                                            <h4 class="text-sm font-semibold text-gray-800">
                                                La contraseña debe contener:
                                            </h4>

                                            <ul class="space-y-1 text-sm text-gray-500">
                                                <li data-hs-strong-password-hints-rule-text="min-length"
                                                    class="hs-strong-password-active:text-teal-500 flex items-center gap-x-2">
                                                    <span class="hidden" data-check="">
                                                        <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg"
                                                            width="24" height="24" viewBox="0 0 24 24"
                                                            fill="none" stroke="currentColor" stroke-width="2"
                                                            stroke-linecap="round" stroke-linejoin="round">
                                                            <polyline points="20 6 9 17 4 12"></polyline>
                                                        </svg>
                                                    </span>
                                                    <span data-uncheck="">
                                                        <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg"
                                                            width="24" height="24" viewBox="0 0 24 24"
                                                            fill="none" stroke="currentColor" stroke-width="2"
                                                            stroke-linecap="round" stroke-linejoin="round">
                                                            <path d="M18 6 6 18"></path>
                                                            <path d="m6 6 12 12"></path>
                                                        </svg>
                                                    </span>
                                                    El número mínimo de caracteres es 8.
                                                </li>
                                                <li data-hs-strong-password-hints-rule-text="lowercase"
                                                    class="hs-strong-password-active:text-teal-500 flex items-center gap-x-2">
                                                    <span class="hidden" data-check="">
                                                        <svg class="shrink-0 size-4"
                                                            xmlns="http://www.w3.org/2000/svg" width="24"
                                                            height="24" viewBox="0 0 24 24" fill="none"
                                                            stroke="currentColor" stroke-width="2"
                                                            stroke-linecap="round" stroke-linejoin="round">
                                                            <polyline points="20 6 9 17 4 12"></polyline>
                                                        </svg>
                                                    </span>
                                                    <span data-uncheck="">
                                                        <svg class="shrink-0 size-4"
                                                            xmlns="http://www.w3.org/2000/svg" width="24"
                                                            height="24" viewBox="0 0 24 24" fill="none"
                                                            stroke="currentColor" stroke-width="2"
                                                            stroke-linecap="round" stroke-linejoin="round">
                                                            <path d="M18 6 6 18"></path>
                                                            <path d="m6 6 12 12"></path>
                                                        </svg>
                                                    </span>
                                                    Debe contener minúsculas.
                                                </li>
                                                <li data-hs-strong-password-hints-rule-text="uppercase"
                                                    class="hs-strong-password-active:text-teal-500 flex items-center gap-x-2">
                                                    <span class="hidden" data-check="">
                                                        <svg class="shrink-0 size-4"
                                                            xmlns="http://www.w3.org/2000/svg" width="24"
                                                            height="24" viewBox="0 0 24 24" fill="none"
                                                            stroke="currentColor" stroke-width="2"
                                                            stroke-linecap="round" stroke-linejoin="round">
                                                            <polyline points="20 6 9 17 4 12"></polyline>
                                                        </svg>
                                                    </span>
                                                    <span data-uncheck="">
                                                        <svg class="shrink-0 size-4"
                                                            xmlns="http://www.w3.org/2000/svg" width="24"
                                                            height="24" viewBox="0 0 24 24" fill="none"
                                                            stroke="currentColor" stroke-width="2"
                                                            stroke-linecap="round" stroke-linejoin="round">
                                                            <path d="M18 6 6 18"></path>
                                                            <path d="m6 6 12 12"></path>
                                                        </svg>
                                                    </span>
                                                    Debe contener mayúsculas.
                                                </li>
                                                <li data-hs-strong-password-hints-rule-text="numbers"
                                                    class="hs-strong-password-active:text-teal-500 flex items-center gap-x-2">
                                                    <span class="hidden" data-check="">
                                                        <svg class="shrink-0 size-4"
                                                            xmlns="http://www.w3.org/2000/svg" width="24"
                                                            height="24" viewBox="0 0 24 24" fill="none"
                                                            stroke="currentColor" stroke-width="2"
                                                            stroke-linecap="round" stroke-linejoin="round">
                                                            <polyline points="20 6 9 17 4 12"></polyline>
                                                        </svg>
                                                    </span>
                                                    <span data-uncheck="">
                                                        <svg class="shrink-0 size-4"
                                                            xmlns="http://www.w3.org/2000/svg" width="24"
                                                            height="24" viewBox="0 0 24 24" fill="none"
                                                            stroke="currentColor" stroke-width="2"
                                                            stroke-linecap="round" stroke-linejoin="round">
                                                            <path d="M18 6 6 18"></path>
                                                            <path d="m6 6 12 12"></path>
                                                        </svg>
                                                    </span>
                                                    Debe contener números.
                                                </li>
                                                <li data-hs-strong-password-hints-rule-text="special-characters"
                                                    class="hs-strong-password-active:text-teal-500 flex items-center gap-x-2">
                                                    <span class="hidden" data-check="">
                                                        <svg class="shrink-0 size-4"
                                                            xmlns="http://www.w3.org/2000/svg" width="24"
                                                            height="24" viewBox="0 0 24 24" fill="none"
                                                            stroke="currentColor" stroke-width="2"
                                                            stroke-linecap="round" stroke-linejoin="round">
                                                            <polyline points="20 6 9 17 4 12"></polyline>
                                                        </svg>
                                                    </span>
                                                    <span data-uncheck="">
                                                        <svg class="shrink-0 size-4"
                                                            xmlns="http://www.w3.org/2000/svg" width="24"
                                                            height="24" viewBox="0 0 24 24" fill="none"
                                                            stroke="currentColor" stroke-width="2"
                                                            stroke-linecap="round" stroke-linejoin="round">
                                                            <path d="M18 6 6 18"></path>
                                                            <path d="m6 6 12 12"></path>
                                                        </svg>
                                                    </span>
                                                    Debe contener caracteres especiales.
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Strong Password -->

                            <div class="mt-4">
                                <x-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                                <x-input id="password_confirmation" class="block mt-1 w-full" type="password"
                                    name="password_confirmation" required autocomplete="off" />
                            </div>

                            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                                <div class="mt-4">
                                    <x-label for="terms">
                                        <div class="flex items-center">
                                            <x-checkbox name="terms" id="terms" required />

                                            <div class="ms-2">
                                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                                    'terms_of_service' =>
                                                        '<a target="_blank" href="' .
                                                        route('terms.show') .
                                                        '" class="text-blue-600 decoration-2 focus:outline-none font-medium">' .
                                                        __('Terms of Service') .
                                                        '</a>',
                                                    'privacy_policy' =>
                                                        '<a target="_blank" href="' .
                                                        route('policy.show') .
                                                        '" class="text-blue-600 decoration-2 focus:outline-none font-medium">' .
                                                        __('Privacy Policy') .
                                                        '</a>',
                                                ]) !!}
                                            </div>
                                        </div>
                                    </x-label>
                                </div>
                            @endif

                            <!-- Spinner -->
                            <div class="flex flex-auto flex-col justify-center items-center" x-show="isSubmitting"
                                style="display: none;">
                                <div class="animate-spin inline-block size-6 border-[3px] border-current border-t-transparent text-blue-600 rounded-full dark:text-blue-500"
                                    role="status" aria-label="loading">
                                    <span class="sr-only">Loading...</span>
                                </div>
                            </div>

                            <button type="submit"
                                class="w-full py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-none focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">
                                Registrar
                            </button>
                        </div>
                    </form>
                    <!-- End Form -->
                </div>
            </div>
        </div>
    </x-authentication-card>
    <script src="{{ asset('js/auth/toggle-password.js') }}"></script>
    {{-- <script src="{{ asset('js/auth/dev-tools.js') }}"></script> --}}
</x-guest-layout>
