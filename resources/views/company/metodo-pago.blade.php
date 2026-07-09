<x-guest-layout>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <!-- Google CSE Script -->
    <script async src="https://cse.google.com/cse.js?cx=b4f2947b021ac4b02"></script>

    @include('utilities.header')

    <div class="bg-gray-100 py-12">
        <div class="max-w-6xl mx-auto px-6">
            <!-- Título Principal -->
            <h1 class="text-5xl font-extrabold text-center text-gray-900 border-b-4 border-blue-500 inline-block pb-2 animate__animated"
                data-animation="animate__fadeInDown">
                Métodos de Pago
            </h1>

            <!-- Subtítulo -->
            <p class="text-center text-lg text-gray-700 mt-4 animate__animated" data-animation="animate__fadeInUp">
                ¡Lo más fácil de viajar, es pagar! Hemos creado una nueva experiencia para que elijas entre cientos de
                destinos
                con promociones y distintos métodos de pago por internet.
            </p>

            <!-- Información sobre Métodos de Pago -->
            <section class="mt-12 bg-white p-6 rounded-lg shadow-lg animate__animated"
                data-animation="animate__fadeInLeft">
                <h2 class="text-3xl font-semibold text-gray-800 border-l-4 border-blue-500 pl-4">
                    Opciones de Pago Disponibles
                </h2>
                <p class="text-gray-600 mt-2">
                    A continuación, te informamos sobre las diferentes formas de pago al momento de realizar una compra
                    en nuestro sitio web o en la aplicación móvil.
                </p>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-6">
                    <!-- Tarjeta de Crédito/Débito -->
                    <div class="p-4 bg-gray-50 rounded-lg shadow animate__animated" data-animation="animate__fadeInUp">
                        <span class="text-blue-600 text-4xl">💳</span>
                        <h3 class="text-xl font-bold text-gray-800 mt-2">Tarjeta de Crédito/Débito</h3>
                        <p class="text-gray-700 text-md mt-2">
                            Aceptamos tarjetas VISA y MasterCard con autorización vigente.
                        </p>
                    </div>

                    <!-- Pago Digital -->
                    <div class="p-4 bg-gray-50 rounded-lg shadow animate__animated" data-animation="animate__fadeInUp">
                        <span class="text-green-600 text-4xl">📲</span>
                        <h3 class="text-xl font-bold text-gray-800 mt-2">Pagos Digitales</h3>
                        <p class="text-gray-700 text-md mt-2">
                            Puedes pagar con PayPal, MercadoPago y Stripe de forma segura.
                        </p>
                    </div>

                    <!-- Transferencias Bancarias -->
                    <div class="p-4 bg-gray-50 rounded-lg shadow animate__animated" data-animation="animate__fadeInUp">
                        <span class="text-purple-600 text-4xl">🏦</span>
                        <h3 class="text-xl font-bold text-gray-800 mt-2">Transferencia Bancaria</h3>
                        <p class="text-gray-700 text-md mt-2">
                            Realiza pagos mediante CLABE y SPEI en bancos participantes.
                        </p>
                    </div>

                    <!-- Pago en Efectivo -->
                    <div class="p-4 bg-gray-50 rounded-lg shadow animate__animated" data-animation="animate__fadeInUp">
                        <span class="text-red-600 text-4xl">💵</span>
                        <h3 class="text-xl font-bold text-gray-800 mt-2">Pago en Efectivo</h3>
                        <p class="text-gray-700 text-md mt-2">
                            Disponible en OXXO Pay y tiendas afiliadas.
                        </p>
                    </div>
                </div>
            </section>

            <!-- Proceso de Pago con Tarjeta -->
            <section class="mt-8 bg-white p-6 rounded-lg shadow-lg animate__animated"
                data-animation="animate__fadeInRight">
                <h2 class="text-3xl font-semibold text-gray-800 border-l-4 border-green-500 pl-4">
                    ¿Cómo pagar con Tarjeta de Crédito o Débito?
                </h2>
                <ol class="list-decimal list-inside text-gray-700 text-lg mt-4 space-y-2">
                    <li>Selecciona la opción de pago con tarjeta.</li>
                    <li>Ingresa los datos solicitados de la tarjeta.</li>
                    <li>Acepta nuestros <a href="#" class="text-blue-500 underline">Términos y Condiciones</a> y
                        <a href="#" class="text-blue-500 underline">Aviso de Privacidad</a>.
                    </li>
                    <li>Presiona el botón <span class="font-bold text-green-600">PAGAR</span>.</li>
                    <li>Es posible que tu banco solicite una verificación de identidad.</li>
                </ol>
                <p class="text-gray-600 mt-4">
                    Una vez aprobado el pago, podrás imprimir o guardar tus boletos en tu dispositivo móvil.
                </p>
            </section>
        </div>
    </div>

    @include('utilities.footer')

    <!-- Scripts para Animaciones -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const animatedElements = document.querySelectorAll('.animate__animated');
            const observer = new IntersectionObserver((entries) => {
                entries.forEach((entry) => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add(entry.target.dataset.animation);
                        observer.unobserve(entry.target);
                    }
                });
            }, {
                threshold: 0.5
            });

            animatedElements.forEach((element) => {
                observer.observe(element);
            });
        });
    </script>
</x-guest-layout>
