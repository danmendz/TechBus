@props(['action' => 'submit'])

<div 
    x-on:recaptcha.window="execute"
    x-data="{
        execute() {
            grecaptcha.ready(() => {
                grecaptcha.execute('{{ config('services.recaptcha.site_key') }}', { 
                    action: '{{ $action }}' 
                }).then((token) => {
                    this.$refs.recaptchaToken.value = token;
                    this.$el.closest('form').submit();

                }).catch((error) => {
                    console.error('reCAPTCHA error:', error);
                    this.isSubmitting = false;
                });
            });
        },
        isSubmitting: false
    }"    
>
    <input type="hidden" name="recaptchaToken" x-ref="recaptchaToken">
</div>