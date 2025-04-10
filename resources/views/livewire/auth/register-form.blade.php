<div>
    <x-guest-layout>
        <x-authentication-card>
            {{-- <x-validation-errors class="mb-4" /> --}}
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

                <div class="px-4 py-3">
                    <form wire:submit.prevent="submit" class="space-y-6"
                        x-data="registrationForm()"
                        @submit.prevent="isSubmitting = false"
                        @recaptcha-error.window="isSubmitting = false">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    
                            {{-- Nombre --}}
                            <div>
                                <x-label for="name" value="Nombre(s)" class="required"/>
                                <x-input wire:model.live="registerCreate.name" id="name" type="text" autocomplete="name" class="block mt-1 w-full" placeholder="Ej. Daniel"/>
                                <x-input-error for="registerCreate.name" />
                            </div>
                    
                            {{-- Apellidos --}}
                            <div>
                                <x-label for="surnames" value="Apellido(s)" class="required"/>
                                <x-input wire:model.live="registerCreate.surnames" id="surnames" type="text" autocomplete="surnames" class="block mt-1 w-full" placeholder="Ej. Pérez"/>
                                <x-input-error for="registerCreate.surnames" />
                            </div>
                    
                            {{-- Teléfono --}}
                            <div class="md:col-span-2">
                                <x-label for="phone" value="Teléfono" class="required"/>
                                <div class="flex gap-4">
                                    <div class="w-1/3">
                                        <select wire:model="registerCreate.countryCode" id="countryCode" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm">
                                            @foreach ($registerCreate->countryCodes as $code => $prefix)
                                                <option value="{{ $prefix }}">{{ $code }} ({{ $prefix }})</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="w-2/3">
                                        <x-input 
                                            wire:model="registerCreate.phone" 
                                            id="phone" 
                                            type="tel" 
                                            autocomplete="phone"
                                            placeholder="Ej. 2212345678"
                                            class="block mt-1 w-full"
                                            x-on:input="validatePhone()"
                                            x-bind:class="isPhoneValid ? 'block mt-1 w-full' : 'block mt-1 w-full border-red-500'"
                                        />
                                        <x-input-error for="registerCreate.phone" />
                                        <p x-show="!isPhoneValid" class="text-red-500 text-sm mt-1">El teléfono debe tener 10 dígitos.</p>
                                    </div>                                    
                                </div>
                            </div>
                    
                            {{-- Email --}}
                            <div>
                                <x-label for="email" value="Email" class="required"/>
                                <x-input 
                                    wire:model="registerCreate.email" 
                                    id="email" 
                                    type="email" 
                                    autocomplete="email"
                                    placeholder="Ejemplo@gmail.com"
                                    class="block mt-1 w-full"
                                    x-on:input="validateEmail()"
                                    x-bind:class="isEmailValid ? 'block mt-1 w-full' : 'block mt-1 w-full border-red-500'"
                                />
                                <x-input-error for="registerCreate.email" />
                                <p x-show="!isEmailValid" class="text-red-500 text-sm mt-1">Ingresa un email válido.</p>
                            </div>

                            {{-- Contraseña --}}
                            <div>
                                <x-label for="password" value="Contraseña" class="required"/>
                                <x-input 
                                    wire:model.live="registerCreate.password"
                                    id="password" 
                                    type="password" 
                                    autocomplete="new-password" 
                                    placeholder="Ingresa una contraseña segura"
                                    class="block mt-1 w-full"
                                    x-on:input="validatePassword()"
                                    x-on:focus="showPasswordRules = true"
                                    x-on:blur="showPasswordRules = false"
                                />
                                <x-input-error for="registerCreate.password" />
                                <div
                                    x-show="showPasswordRules"
                                    x-transition
                                    class="absolute bg-white border border-gray-300 rounded-lg shadow p-4 mt-2 w-[%50] z-20"
                                    x-cloak
                                >
                                    <p x-bind:class="hasMinLength ? 'text-green-500 text-sm' : 'text-red-500 text-sm'">
                                        ✓ Mínimo 8 caracteres
                                    </p>
                                    <p x-bind:class="hasUppercase ? 'text-green-500 text-sm' : 'text-red-500 text-sm'">
                                        ✓ Al menos una mayúscula
                                    </p>
                                    <p x-bind:class="hasNumber ? 'text-green-500 text-sm' : 'text-red-500 text-sm'">
                                        ✓ Al menos un número
                                    </p>
                                    <p x-bind:class="hasSymbol ? 'text-green-500 text-sm' : 'text-red-500 text-sm'">
                                        ✓ Al menos un símbolo o carácter especial
                                    </p>
                                    <p x-bind:class="noConsecutiveNumbers ? 'text-green-500 text-sm' : 'text-red-500 text-sm'">
                                        ✓ No debe tener números consecutivos
                                    </p>
                                    <p x-bind:class="noConsecutiveLetters ? 'text-green-500 text-sm' : 'text-red-500 text-sm'">
                                        ✓ No debe tener letras consecutivas
                                    </p>
                                </div>
                            </div>

                            {{-- Confirmar contraseña --}}
                            <div>
                                <x-label for="password_confirmation" value="Confirmar Contraseña" class="required"/>
                                <x-input 
                                    wire:model.live="registerCreate.password_confirmation" 
                                    id="password_confirmation" 
                                    type="password" 
                                    autocomplete="new-password"
                                    placeholder="Repite la contraseña"
                                    class="block mt-1 w-full"
                                />
                                <x-input-error for="registerCreate.password_confirmation" />
                            </div>

                            {{-- Términos --}}
                            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                                <div class="md:col-span-2">
                                    <x-checkbox 
                                        wire:model.live="registerCreate.terms" 
                                        id="terms" 
                                        x-model="termsAccepted"
                                    />
                                    <label for="terms">
                                        {!! __('Acepto los :terms_of_service y la :privacy_policy', [
                                            'terms_of_service' => '<a target="_blank" href="' . route('terms.show') . '" class="underline">Términos</a>',
                                            'privacy_policy' => '<a target="_blank" href="' . route('policy.show') . '" class="underline">Política</a>',
                                        ]) !!}
                                    </label>
                                    <x-input-error for="registerCreate.terms" />
                                </div>
                            @endif
                    
                            {{-- Recaptcha --}}
                            <div class="md:col-span-2">
                                <x-recaptcha-livewire action="register" />
                            </div>
                    
                            {{-- Botón --}}
                            <div class="md:col-span-2">
                                <x-filament::button 
                                    x-on:click="$dispatch('recaptcha')"
                                    class="w-full rounded-full border border-blue-600 bg-blue-600 p-3 text-white hover:bg-blue-500 focus:ring">
                                    Registrar
                                </x-filament::button>
                            </div>
                    
                        </div>
                    </form>
                </div>
            </div>
        </x-authentication-card>
    </x-guest-layout>
</div>
<script>
    function registrationForm() {
        return {
            isSubmitting: false,
            emailRegex: /^[^\s@]+@[^\s@]+\.[^\s@]+$/,
            phoneRegex: /^\d+$/,
            isEmailValid: true,
            isPhoneValid: true,
            hasMinLength: false,
            hasUppercase: false,
            hasNumber: false,
            hasSymbol: false,
            noConsecutiveNumbers: true,
            noConsecutiveLetters: true,
            termsAccepted: false,
            showPasswordRules: false,

            validateEmail() {
                this.isEmailValid = this.emailRegex.test(this.$wire.registerCreate.email);
            },
            validatePhone() {
                this.isPhoneValid = this.phoneRegex.test(this.$wire.registerCreate.phone) && this.$wire.registerCreate.phone.length === 10;
            },
            validatePassword() {
                const pass = this.$wire.registerCreate.password || '';
                this.hasMinLength = pass.length >= 8;
                this.hasUppercase = /[A-Z]/.test(pass);
                this.hasNumber = /\d/.test(pass);
                this.hasSymbol = /[\W_]/.test(pass);
                this.noConsecutiveNumbers = !/012|123|234|345|456|567|678|789|890|1234|2345|3456|4567|5678|6789/.test(pass);
                this.noConsecutiveLetters = !/abc|bcd|cde|def|efg|fgh|ghi|hij|ijk|jkl|klm|lmn|mno|nop|opq|pqr|qrs|rst|stu|tuv|uvw|vwx|wxy|xyz/.test(pass.toLowerCase());
            },
            termsRequired() {
                return {{ Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature() ? 'true' : 'false' }};
            }

        }
    }

</script>
