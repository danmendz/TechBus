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

                <a href="{{ route('auth.redirection', 'google') }}" type="button" class="mt-2 w-full py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 focus:outline-none focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-800 dark:focus:bg-neutral-800">
                    <svg class="w-4 h-auto" width="46" height="47" viewBox="0 0 46 47" fill="none">
                        <path d="M46 24.0287C46 22.09 45.8533 20.68 45.5013 19.2112H23.4694V27.9356H36.4069C36.1429 30.1094 34.7347 33.37 31.5957 35.5731L31.5663 35.8669L38.5191 41.2719L38.9885 41.3306C43.4477 37.2181 46 31.1669 46 24.0287Z" fill="#4285F4"/>
                        <path d="M23.4694 47C29.8061 47 35.1161 44.9144 39.0179 41.3012L31.625 35.5437C29.6301 36.9244 26.9898 37.8937 23.4987 37.8937C17.2793 37.8937 12.0281 33.7812 10.1505 28.1412L9.88649 28.1706L2.61097 33.7812L2.52296 34.0456C6.36608 41.7125 14.287 47 23.4694 47Z" fill="#34A853"/>
                        <path d="M10.1212 28.1413C9.62245 26.6725 9.32908 25.1156 9.32908 23.5C9.32908 21.8844 9.62245 20.3275 10.0918 18.8588V18.5356L2.75765 12.8369L2.52296 12.9544C0.909439 16.1269 0 19.7106 0 23.5C0 27.2894 0.909439 30.8731 2.49362 34.0456L10.1212 28.1413Z" fill="#FBBC05"/>
                        <path d="M23.4694 9.07688C27.8699 9.07688 30.8622 10.9863 32.5344 12.5725L39.1645 6.11C35.0867 2.32063 29.8061 0 23.4694 0C14.287 0 6.36607 5.2875 2.49362 12.9544L10.0918 18.8588C11.9987 13.1894 17.25 9.07688 23.4694 9.07688Z" fill="#EB4335"/>
                    </svg>
                    Registrarse con Google
                </a>

                <div class="py-3 flex items-center text-xs text-gray-400 uppercase before:flex-1 before:border-t before:border-gray-200 before:me-6 after:flex-1 after:border-t after:border-gray-200 after:ms-6 dark:text-neutral-500 dark:before:border-neutral-600 dark:after:border-neutral-600">o</div>

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
