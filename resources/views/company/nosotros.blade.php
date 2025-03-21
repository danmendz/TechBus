<x-guest-layout>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <!-- Google CSE Script -->
    <script async src="https://cse.google.com/cse.js?cx=b4f2947b021ac4b02"></script>
    @include('utilities.header')

    <div class="bg-gray-100 min-h-screen py-12">
        <div class="max-w-6xl mx-auto px-6">
            <!-- Título Principal -->
            <h1
                class="text-5xl font-extrabold text-center text-gray-900 border-b-4 border-blue-500 inline-block pb-2 animate__animated animate__fadeInDown">
                Sobre Nosotros
            </h1>

            <!-- Sección: Nuestro Equipo -->
            <section class="mt-12 bg-white p-6 rounded-lg shadow-lg animate__animated"
                data-animation="animate__fadeInLeft">
                <h2 class="text-3xl font-semibold text-gray-800 border-l-4 border-blue-500 pl-4">Nuestro Equipo</h2>
                <p class="text-gray-700 mt-3 text-lg leading-relaxed">
                    Contamos con un equipo de profesionales en tecnología y transporte, comprometidos con brindar
                    una plataforma segura y eficiente.
                </p>
            </section>

            <!-- Sección: Tecnología e Innovación -->
            <section class="mt-8 bg-white p-6 rounded-lg shadow-lg animate__animated"
                data-animation="animate__fadeInRight">
                <h2 class="text-3xl font-semibold text-gray-800 border-l-4 border-green-500 pl-4">Tecnología e
                    Innovación</h2>
                <p class="text-gray-700 mt-3 text-lg leading-relaxed">
                    Utilizamos tecnologías de última generación como
                    <span class="font-bold text-blue-600">Laravel, SQL Server</span> y
                    <span class="font-bold text-green-600">APIs de integración con WhatsApp</span>
                    para ofrecer una experiencia rápida y segura.
                </p>
            </section>

            <!-- Sección: Contáctanos -->
            <section class="mt-8 bg-white p-6 rounded-lg shadow-lg animate__animated"
                data-animation="animate__fadeInUp">
                <h2 class="text-3xl font-semibold text-gray-800 border-l-4 border-red-500 pl-4">Contáctanos</h2>
                <div class="mt-4 space-y-4">
                    <div class="flex items-center gap-4">
                        <span class="text-red-500 text-2xl">📍</span>
                        <p class="text-gray-700 text-lg">Calle Ejemplo #123, Ciudad</p>
                    </div>
                    <div class="flex items-center gap-4">
                        <span class="text-blue-500 text-2xl">📧</span>
                        <a href="mailto:contacto@empresa.com"
                            class="text-blue-600 text-lg hover:underline">contacto@empresa.com</a>
                    </div>
                    <div class="flex items-center gap-4">
                        <span class="text-green-500 text-2xl">📞</span>
                        <p class="text-gray-700 text-lg">+52 123 456 7890</p>
                    </div>
                </div>
            </section>
        </div>
    </div>

    @include('utilities.footer')

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
