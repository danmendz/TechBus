@props(['action' => 'submit'])

<div 
    x-on:recaptcha.window="execute"
    x-data="{
        execute() {
            grecaptcha.ready(() => {
                grecaptcha.execute('{{ config('services.recaptcha.site_key') }}', { 
                action: '{{ $action }}' })
                .then((token) => {
                    $wire.set('registerCreate.recaptchaToken', token);
                    $wire.submit();

                }).catch((error) => {
                    console.error('reCAPTCHA error:', error);
                });
            });
        }
    }"
>
    <input type="hidden" wire:model="recaptchaToken">
</div>