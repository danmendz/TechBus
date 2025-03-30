<div>
    <x-guest-layout>
        <x-authentication-card>
            <x-validation-errors class="mb-4" />
            @session('status')
                <div class="mb-4 font-medium text-sm text-green-600">
                    {{ $value }}
                </div>
            @endsession

            <x-slot name="logo"></x-slot>

            <div class="mt-7 bg-white border border-gray-200 rounded-xl shadow-sm">
                <div class="px-4 py-2 sm:py-3 text-center">
                    <a class="decoration-2 font-medium" href="/" title="Inicio">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
                        </svg>
                    </a>
                    <h1 class="block text-2xl font-bold text-gray-800">Crear cuenta</h1>
                    <p class="mt-2 text-sm text-gray-600">
                        ¿Ya tienes una cuenta?
                        <a class="text-blue-600 decoration-2 focus:outline-none font-medium"
                            href="{{ route('login') }}">
                            Inicia sesión aquí
                        </a>
                    </p>
                </div>

                <x-socialite-auth />

                <h1
                    class="p-3 flex items-center text-sm text-gray-400 uppercase before:flex-1 before:me-6 after:flex-1 after:ms-6 dark:text-neutral-500">
                    Paso {{ $currentStep }} de {{ $totalSteps }}
                </h1>

                @if ($currentStep === 1)
                    <div class="px-4 py-3">
                        <div class="grid gap-y-4">
                            <div>
                                <x-label for="name" class="required" value="Nombre(s)" />
                                <x-input wire:model="registerCreate.name" id="name" class="block mt-1 w-full" type="text"
                                    required autocomplete="name" />
                                <x-input-error for="registerCreate.name" />
                            </div>

                            <div>
                                <x-label for="surnames" class="required" value="Apellido(s)" />
                                <x-input wire:model="registerCreate.surnames" id="surnames" class="block mt-1 w-full" type="text"
                                    required autocomplete="surnames" />
                                <x-input-error for="registerCreate.surnames" />
                            </div>

                            <div>
                                <x-label for="phone" class="required" value="Teléfono" />
                                <div class="flex gap-4">
                                    <div class="w-1/3">
                                        <select wire:model="registerCreate.countryCode" id="countryCode" required
                                            class="block mt-1 w-full rounded-md border-gray-300 shadow-sm">
                                            @foreach ($registerCreate->countryCodes as $code => $prefix)
                                                <option value="{{ $prefix }}" @if($prefix == $registerCreate->countryCode) selected @endif>
                                                    {{ $code }} ({{ $prefix }})
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="w-2/3">
                                        <x-input wire:model="registerCreate.phone" id="phone" class="block mt-1 w-full"
                                            type="tel" required autocomplete="phone" />
                                    </div>
                                </div>
                                <x-input-error for="registerCreate.phone" />
                            </div>
                        </div>
                    </div>
                @elseif($currentStep === 2)
                    <div class="px-4 py-3">
                        <div class="grid gap-y-4">
                            <div>
                                <x-label for="email" class="required" value="Email" />
                                <x-input wire:model="registerCreate.email" id="email" class="block mt-1 w-full" type="email"
                                    required autocomplete="off" />
                                <x-input-error for="registerCreate.email" />
                            </div>

                            <div>
                                <x-label for="password" class="required" value="Contraseña" />
                                <div class="flex items-center border rounded-md">
                                    <x-input wire:model="registerCreate.password" id="password"
                                        class="flex-1 px-3 py-2 border-none focus:ring-0" type="password" required
                                        autocomplete="off" />
                                    <i wire:ignore class="bi bi-eye-slash cursor-pointer px-3 text-gray-500"
                                        id="togglePassword" onclick="togglePasswordVisibility()"
                                        aria-label="Mostrar u ocultar contraseña"></i>
                                </div>
                                <x-input-error for="registerCreate.password" />
                            </div>

                            <!-- Strong Password -->
                            <div class="max-w-sm" x-data="{}" x-init="HSStrongPassword.autoInit()" wire:ignore>
                                <div class="flex">
                                    <div class="relative flex-1">
                                        <div id="hs-strong-password-popover"
                                            class="hidden absolute z-10 w-full bg-white shadow-md rounded-lg p-4">
                                            <div id="hs-strong-password-in-popover"
                                                data-hs-strong-password='{
                                                "target": "#password",
                                                "hints": "#hs-strong-password-popover",
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
                                                        <svg class="shrink-0 size-4"
                                                            xmlns="http://www.w3.org/2000/svg" width="24"
                                                            height="24" viewBox="0 0 24 24" fill="none"
                                                            stroke="currentColor" stroke-width="2"
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

                            <div>
                                <x-label for="password_confirmation" class="required" value="Confirmar contraseña" />
                                <x-input wire:model="registerCreate.password_confirmation" id="password_confirmation"
                                    class="block mt-1 w-full" type="password" required autocomplete="off" />
                                <x-input-error for="registerCreate.password_confirmation" />
                            </div>

                            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                                <div class="mt-2">
                                    <x-label for="terms">
                                        <div class="flex items-center">
                                            <x-checkbox wire:model="registerCreate.terms" name="terms" id="terms" required />

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
                                    <x-input-error for="registerCreate.terms" />
                                </div>
                            @endif

                            <!-- Google Recaptcha for Livewire-->
                            <x-recaptcha-livewire action="register" />
                            
                            <!-- Spinner -->
                            <div class="mx-auto w-1/2 p-4" wire:loading wire:target="submit">
                                <div class="flex justify-center items-center h-full">
                                    <div class="animate-spin inline-block size-7 border-[3px] border-current border-t-transparent text-blue-600 rounded-full dark:text-blue-500"
                                        role="status" aria-label="loading">
                                        <span class="sr-only">Loading...</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                <div class="w-full flex justify-between items-center my-3">
                    @if ($currentStep > 1)
                        <x-filament::button 
                            wire:click="decrementStep" 
                            icon="heroicon-m-arrow-left"
                            class="ml-5 rounded-full border border-blue-600 bg-blue-600 p-3 text-white hover:bg-blue-500 focus:ring">
                            Atrás
                        </x-filament::button>
                    @endif

                    @if ($currentStep < $totalSteps)
                        <div class="w-full flex justify-end mr-4">
                            <x-filament::button 
                                wire:click.prevent="incrementStep"
                                wire:loading.attr="disabled"
                                icon="heroicon-m-arrow-right"
                                icon-position="after"
                                class="rounded-full border border-blue-600 bg-blue-600 p-3 text-white hover:bg-blue-500 focus:ring"
                                id="nextStep">
                                Siguiente
                            </x-filament::button>
                        </div>
                    @endif

                    @if ($currentStep === $totalSteps)
                        <x-filament::button 
                            x-on:click="$dispatch('recaptcha')"
                            icon="heroicon-m-check-badge"
                            icon-position="after"
                            class="mr-4 rounded-full border border-blue-600 bg-blue-600 p-3 text-white hover:bg-blue-500 focus:ring">
                            Registrar
                        </x-filament::button>
                    @endif
                </div>
            </div>
        </x-authentication-card>
    </x-guest-layout>
</div>
