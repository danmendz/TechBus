<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>ADO</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <!-- Google CSE Script -->
    <script async src="https://cse.google.com/cse.js?cx={{ config('services.google.search_engine') }}"></script>

    <!-- Styles -->
    <link href="{{ asset('css/general/styles.css') }}" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    @include('utilities.header')

    <div class="max-w-[85rem] mx-auto px-4 sm:px-6 lg:px-8 mt-8">
        <!-- Grid Container -->
        <div class="grid md:grid-cols-2 gap-4 md:gap-8 xl:gap-20 items-stretch">
            <!-- Columna 1: Texto y Formulario -->
            <div class="flex flex-col">
                <div
                    class="inline-block bg-blue-100 text-blue-800 text-sm font-semibold px-4 py-2 rounded-full shadow">
                    ⭐ 100% Seguridad y Comodidad en tu viaje
                </div>
                <h1 class="mt-4 text-4xl font-bold text-gray-900 sm:text-5xl lg:text-6xl leading-tight">
                    Encuentra tu mejor <span class="text-blue-600">destino</span> con <span
                        class="text-blue-600">ADO</span>
                </h1>
                <p class="mt-3 text-lg text-gray-700">"Viaja con comodidad, seguridad y aprovecha nuestras ofertas
                    exclusivas. Descubre nuevos destinos con la confianza que solo ADO puede ofrecerte".</p>

                <div class="mt-6 animate__animated" data-animation="animate__fadeInLeft">
                    <h2 class="text-2xl font-bold text-gray-800">
                        De tu teléfono a tu destino favorito
                    </h2>
                </div>

                <div class="bg-white p-6 rounded-lg shadow-lg mt-6 h-full" id="formulario-boletos">
                    <!-- Formulario siempre visible -->
                    <form id="search-form" class="space-y-4 animate__animated" data-animation="animate__fadeInUp">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="origin" class="block text-sm font-medium text-gray-700">Origen</label>
                                <select id="origin" name="origin"
                                    class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm">
                                    <option value="ciudad-mexico">Ciudad de México</option>
                                    <option value="puebla">Puebla</option>
                                    <option value="guadalajara">Guadalajara</option>
                                </select>
                            </div>
                            <div>
                                <label for="destination" class="block text-sm font-medium text-gray-700">Destino</label>
                                <select id="destination" name="destination"
                                    class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm">
                                    <option value="oaxaca">Oaxaca</option>
                                    <option value="veracruz">Veracruz</option>
                                    <option value="monterrey">Monterrey</option>
                                </select>
                            </div>
                        </div>
                        
                        <!-- Nueva estructura para Fecha y Horario en la misma línea -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="departure-date" class="block text-sm font-medium text-gray-700">Fecha</label>
                                <input type="date" id="departure-date" name="departure_date"
                                    class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm">
                            </div>
                            <div>
                                <label for="time" class="block text-sm font-medium text-gray-700">Horario</label>
                                <select id="time" name="time"
                                    class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm">
                                    <option value="08:00">08:00 AM</option>
                                    <option value="10:00">10:00 AM</option>
                                    <option value="12:00">12:00 PM</option>
                                    <option value="14:00">02:00 PM</option>
                                    <option value="16:00">04:00 PM</option>
                                    <option value="18:00">06:00 PM</option>
                                </select>
                            </div>
                        </div>
                
                        <div class="mt-6">
                            <button type="button" id="search-button"
                                class="w-full bg-blue-600 text-white p-3 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                Buscar Viaje
                            </button>
                        </div>
                    </form>
                </div>                
                <!-- End Formulario de Búsqueda -->
            </div>
            <!-- End Contenido Principal -->

            <!-- Contenedor del objeto 3D -->
            <div class="relative rounded animate__animated" id="container3D" data-animation="animate__fadeInRight">
                <canvas class="absolute top-0 left-0 w-full h-full"></canvas>
                <img class="w-full h-full object-cover rounded-md" src="{{ asset('images/enterprise/ADO-font.jpg') }}"
                    alt="Hero Image">
            </div>
        </div>
    </div>
</body>

</html>
<!-- Carousel -->
<div class="mt-12 overflow-hidden w-full bg-white rounded-lg shadow-md">
    <div class="flex items-center gap-5 animate-marquee whitespace-nowrap">
        <img src="{{ asset('images/marquee/beach.jpg') }}" alt="Destino" class="h-24 rounded-lg">
        <img src="{{ asset('images/marquee/atlixco.jpg') }}" alt="Destino" class="h-24 rounded-lg">
        <img src="{{ asset('images/marquee/chichen-itza.jpg') }}" alt="Destino" class="h-24 rounded-lg">
        <img src="{{ asset('images/marquee/maya.jpg') }}" alt="Destino" class="h-24 rounded-lg">
        <img src="{{ asset('images/marquee/mexico.jpg') }}" alt="Destino" class="h-24 rounded-lg">
        <img src="{{ asset('images/marquee/puebla.jpg') }}" alt="Destino" class="h-24 rounded-lg">
        <img src="{{ asset('images/marquee/pueblo.jpg') }}" alt="Destino" class="h-24 rounded-lg">
        <img src="{{ asset('images/marquee/pyramid.jpg') }}" alt="Destino" class="h-24 rounded-lg">

        <img src="{{ asset('images/marquee/beach.jpg') }}" alt="Destino" class="h-24 rounded-lg">
        <img src="{{ asset('images/marquee/atlixco.jpg') }}" alt="Destino" class="h-24 rounded-lg">
        <img src="{{ asset('images/marquee/chichen-itza.jpg') }}" alt="Destino" class="h-24 rounded-lg">
        <img src="{{ asset('images/marquee/maya.jpg') }}" alt="Destino" class="h-24 rounded-lg">
        <img src="{{ asset('images/marquee/mexico.jpg') }}" alt="Destino" class="h-24 rounded-lg">
        <img src="{{ asset('images/marquee/puebla.jpg') }}" alt="Destino" class="h-24 rounded-lg">
        <img src="{{ asset('images/marquee/pueblo.jpg') }}" alt="Destino" class="h-24 rounded-lg">
        <img src="{{ asset('images/marquee/pyramid.jpg') }}" alt="Destino" class="h-24 rounded-lg">
    </div>
</div>
<!-- End Carousel -->

<!-- Destinos populares -->
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <h2 class="text-3xl font-bold text-gray-800 text-center animate__animated animate__flipInX">
        Explora nuestros destinos más populares
    </h2>

    <div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Destino 1: Oaxaca -->
        <div class="bg-white p-6 rounded-lg shadow-lg transition-transform duration-300 hover:scale-105">
            <img src="{{ asset('images/destinations/oaxaca.jpg') }}" alt="Oaxaca"
                class="w-full h-48 object-cover rounded-lg">
            <h3 class="mt-4 text-xl font-semibold text-gray-800">Oaxaca</h3>
            <p class="mt-2 text-gray-600">Descubre la riqueza cultural y gastronómica de Oaxaca.</p>
            <button onclick="openModal('oaxaca')" class="mt-4 inline-block text-blue-600 hover:underline">Ver
                más</button>
        </div>

        <!-- Destino 2: Veracruz -->
        <div class="bg-white p-6 rounded-lg shadow-lg transition-transform duration-300 hover:scale-105">
            <img src="{{ asset('images/destinations/veracruz.jpg') }}" alt="Veracruz"
                class="w-full h-48 object-cover rounded-lg">
            <h3 class="mt-4 text-xl font-semibold text-gray-800">Veracruz</h3>
            <p class="mt-2 text-gray-600">Disfruta de las playas y la música tradicional de Veracruz.</p>
            <button onclick="openModal('veracruz')" class="mt-4 inline-block text-blue-600 hover:underline">Ver
                más</button>
        </div>

        <!-- Destino 3: Monterrey -->
        <div class="bg-white p-6 rounded-lg shadow-lg transition-transform duration-300 hover:scale-105">
            <img src="{{ asset('images/destinations/monterrey.jpg') }}" alt="Monterrey"
                class="w-full h-48 object-cover rounded-lg">
            <h3 class="mt-4 text-xl font-semibold text-gray-800">Monterrey</h3>
            <p class="mt-2 text-gray-600">Vive la modernidad y la naturaleza en Monterrey.</p>
            <button onclick="openModal('monterrey')" class="mt-4 inline-block text-blue-600 hover:underline">Ver
                más</button>
        </div>
    </div>
</section>

<!-- Modal -->
<div id="modal" class="fixed inset-0 bg-black bg-opacity-50 hidden justify-center items-center p-4 z-50">
    <div class="bg-white rounded-lg w-full max-w-3xl p-6 overflow-y-auto max-h-[90vh] relative">
        <!-- Botón para cerrar el modal -->
        <button onclick="closeModal()" class="absolute top-4 right-4 text-gray-600 hover:text-gray-800">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>

        <!-- Contenido dinámico del modal -->
        <div id="modal-content">
            <!-- Carrusel -->
            <div class="swiper-container">
                <div class="swiper-wrapper">
                    <!-- Las imágenes se cargarán dinámicamente aquí -->
                </div>
                <!-- Paginación y flechas de navegación -->
                <div class="swiper-pagination"></div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>

            <!-- Información del destino -->
            <div id="modal-info" class="mt-6 text-center">
                <h3 id="modal-title" class="text-2xl font-bold text-gray-800"></h3>
                <p id="modal-description" class="mt-2 text-gray-600"></p>
            </div>
        </div>
    </div>
</div>
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
<script>
    // Datos de los destinos (puedes obtenerlos de una API o base de datos)
    const destinations = {
        oaxaca: {
            title: "Oaxaca",
            description: "Descubre la riqueza cultural y gastronómica de Oaxaca. Visita Monte Albán, el Templo de Santo Domingo y disfruta de sus deliciosos moles.",
            images: [
                "{{ asset('images/destinations/oaxaca1.jpg') }}",
                "{{ asset('images/destinations/oaxaca2.jpg') }}",
                "{{ asset('images/destinations/oaxaca3.jpg') }}",
                "{{ asset('images/destinations/oaxaca4.jpg') }}"
            ]
        },
        veracruz: {
            title: "Veracruz",
            description: "Disfruta de las playas y la música tradicional de Veracruz. Explora el puerto, el acuario y la hermosa costa veracruzana.",
            images: [
                "{{ asset('images/destinations/veracruz1.jpg') }}",
                "{{ asset('images/destinations/veracruz2.jpg') }}",
                "{{ asset('images/destinations/veracruz3.jpg') }}",
                "{{ asset('images/destinations/veracruz4.jpg') }}"
            ]
        },
        monterrey: {
            title: "Monterrey",
            description: "Vive la modernidad y la naturaleza en Monterrey. Visita el Cerro de la Silla, el Parque Fundidora y disfruta de su deliciosa carne asada.",
            images: [
                "{{ asset('images/destinations/monterrey1.jpg') }}",
                "{{ asset('images/destinations/monterrey2.jpg') }}",
                "{{ asset('images/destinations/monterrey3.jpg') }}",
                "{{ asset('images/destinations/monterrey4.jpg') }}"
            ]
        }
    };

    // Función para abrir el modal con animación
    function openModal(destination) {
        const modal = document.getElementById('modal');
        const modalTitle = document.getElementById('modal-title');
        const modalDescription = document.getElementById('modal-description');
        const swiperWrapper = document.querySelector('.swiper-wrapper');

        // Cargar datos del destino
        const data = destinations[destination];
        modalTitle.textContent = data.title;
        modalDescription.textContent = data.description;

        // Limpiar el carrusel
        swiperWrapper.innerHTML = '';

        // Agregar imágenes al carrusel
        data.images.forEach(image => {
            swiperWrapper.innerHTML += `
                <div class="swiper-slide">
                    <img src="${image}" alt="${data.title}" class="w-full h-64 object-cover rounded-lg">
                </div>
            `;
        });

        // Aseguramos que la inicialización de Swiper se haga después de que las imágenes estén cargadas
        setTimeout(() => {
            // Inicializar Swiper con una sola imagen visible
            new Swiper('.swiper-container', {
                loop: true,
                autoplay: {
                    delay: 3000,
                    disableOnInteraction: false,
                },
                slidesPerView: 1, // Solo una imagen visible a la vez
                spaceBetween: 10, // Espacio entre las imágenes
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                },
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
            });
        }, 100);

        // Mostrar el modal con animación
        modal.classList.add('show');
    }

    // Función para cerrar el modal con animación
    function closeModal() {
        const modal = document.getElementById('modal');
        modal.classList.remove('show');
    }
</script>

<!-- Beneficios -->
<section class="bg-blue-50 py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Título con animación -->
        <h2 class="text-3xl font-bold text-gray-800 text-center animate__animated" data-animation="animate__zoomIn">
            ¿Por qué elegir ADO?
        </h2>

        <!-- Grid de beneficios -->
        <div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Beneficio 1: Seguridad -->
            <div class="text-center animate__animated" data-animation="animate__flipInY">
                <svg class="mx-auto size-12 text-blue-600 animate__animated" data-animation="animate__rubberBand"
                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <h3 class="mt-4 text-lg font-semibold text-gray-800 animate__animated"
                    data-animation="animate__fadeInLeft">Seguridad</h3>
                <p class="mt-2 text-gray-600 animate__animated" data-animation="animate__fadeInRight">Viaja con la
                    tranquilidad de saber que estás en buenas manos.</p>
            </div>

            <!-- Beneficio 2: Confort -->
            <div class="text-center animate__animated" data-animation="animate__flipInY" data-delay="1s">
                <svg class="mx-auto size-12 text-blue-600 animate__animated" data-animation="animate__swing"
                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
                <h3 class="mt-4 text-lg font-semibold text-gray-800 animate__animated"
                    data-animation="animate__fadeInLeft">Confort</h3>
                <p class="mt-2 text-gray-600 animate__animated" data-animation="animate__fadeInRight">Disfruta de
                    asientos cómodos y amplios en nuestros modernos autobuses.</p>
            </div>

            <!-- Beneficio 3: Puntualidad -->
            <div class="text-center animate__animated" data-animation="animate__flipInY" data-delay="2s">
                <svg class="mx-auto size-12 text-blue-600 animate__animated" data-animation="animate__tada"
                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6l4 2" />
                </svg>
                <h3 class="mt-4 text-lg font-semibold text-gray-800 animate__animated"
                    data-animation="animate__fadeInLeft">Puntualidad</h3>
                <p class="mt-2 text-gray-600 animate__animated" data-animation="animate__fadeInRight">Nos aseguramos
                    de que llegues a tu destino a tiempo.</p>
            </div>

            <!-- Beneficio 4: Accesibilidad -->
            <div class="text-center animate__animated" data-animation="animate__flipInY" data-delay="3s">
                <svg class="mx-auto size-12 text-blue-600 animate__animated" data-animation="animate__rubberBand"
                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                <h3 class="mt-4 text-lg font-semibold text-gray-800 animate__animated"
                    data-animation="animate__fadeInLeft">Accesibilidad</h3>
                <p class="mt-2 text-gray-600 animate__animated" data-animation="animate__fadeInRight">Contamos con
                    accesos y servicios especiales para personas con movilidad reducida.</p>
            </div>

            <!-- Beneficio 5: Servicio a Bordo -->
            <div class="text-center animate__animated" data-animation="animate__flipInY">
                <svg class="mx-auto size-12 text-blue-600 animate__animated" data-animation="animate__swing"
                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M19 3l-4 4m0 0l-4 4m4-4h-8m8 4v8h-8v-8" />
                </svg>
                <h3 class="mt-4 text-lg font-semibold text-gray-800 animate__animated"
                    data-animation="animate__fadeInLeft">Servicio a Bordo</h3>
                <p class="mt-2 text-gray-600 animate__animated" data-animation="animate__fadeInRight">Disfruta de
                    snacks, bebidas y Wi-Fi durante tu viaje para hacer tu trayecto más placentero.</p>
            </div>

            <!-- Beneficio 6: Viaje Económico -->
            <div class="text-center animate__animated" data-animation="animate__flipInY">
                <svg class="mx-auto size-12 text-blue-600 animate__animated" data-animation="animate__tada"
                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5l7 7 7-7z" />
                </svg>
                <h3 class="mt-4 text-lg font-semibold text-gray-800 animate__animated"
                    data-animation="animate__fadeInLeft">Viaje Económico</h3>
                <p class="mt-2 text-gray-600 animate__animated" data-animation="animate__fadeInRight">Ofrecemos
                    tarifas accesibles para que puedas viajar sin preocuparte por el presupuesto.</p>
            </div>
        </div>

        <!-- Call-to-Action (CTA) -->
        <div class="mt-12 text-center">
            <a href="#formulario-boletos"
                class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition duration-300 animate__animated animate__pulse animate__infinite">
                Reserva tu viaje ahora
            </a>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Selecciona todos los elementos con la clase animate__animated
            const animatedElements = document.querySelectorAll('.animate__animated');

            // Configura el IntersectionObserver
            const observer = new IntersectionObserver((entries) => {
                entries.forEach((entry) => {
                    if (entry.isIntersecting) {
                        const animationClass = entry.target.dataset.animation;
                        const delay = entry.target.dataset.delay ||
                        '0s'; // Obtiene el retraso o usa 0s por defecto

                        // Aplica la animación y el retraso
                        entry.target.style.animationDelay = delay;
                        entry.target.classList.add(animationClass);
                    }
                });
            }, {
                threshold: 0.5 // Activa la animación cuando el 50% del elemento está visible
            });

            // Observa cada elemento
            animatedElements.forEach((element) => {
                observer.observe(element);
            });
        });
    </script>
</section>

<!-- Testimonios -->
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <!-- Título con animación -->
    <h2 class="text-3xl font-bold text-gray-800 text-center animate__animated" data-animation="animate__fadeIn">
        Lo que dicen nuestros clientes
    </h2>

    <!-- Grid de testimonios -->
    <div class="mt-8 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <!-- Testimonio 1 -->
        <div class="bg-white p-6 rounded-lg shadow-lg testimonio-card animate__animated"
            data-animation="animate__fadeInUp">
            <div class="flex items-center">
                <img src="{{ asset('images/customers/customer-1.jpg') }}" alt="Cliente 1" class="w-12 h-12 rounded-full">
                <div class="ml-4">
                    <p class="text-gray-600">"Excelente servicio, muy puntual y cómodo. ¡Volveré a viajar con ADO!"</p>
                    <div class="mt-2 flex items-center">
                        <span class="text-yellow-500">★★★★★</span>
                        <span class="ml-2 text-gray-800">- Cliente 1</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Testimonio 2 -->
        <div class="bg-white p-6 rounded-lg shadow-lg testimonio-card animate__animated"
            data-animation="animate__fadeInUp">
            <div class="flex items-center">
                <img src="{{ asset('images/customers/customer-2.jpg') }}" alt="Cliente 2" class="w-12 h-12 rounded-full">
                <div class="ml-4">
                    <p class="text-gray-600">"El servicio a bordo es increíble. Me encantó la atención y la comodidad."
                    </p>
                    <div class="mt-2 flex items-center">
                        <span class="text-yellow-500">★★★★★</span>
                        <span class="ml-2 text-gray-800">- Cliente 2</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Testimonio 3 -->
        <div class="bg-white p-6 rounded-lg shadow-lg testimonio-card animate__animated"
            data-animation="animate__fadeInUp">
            <div class="flex items-center">
                <img src="{{ asset('images/customers/customer-3.jpg') }}" alt="Cliente 3" class="w-12 h-12 rounded-full">
                <div class="ml-4">
                    <p class="text-gray-600">"Viajar con ADO es siempre una experiencia agradable. Lo recomiendo."</p>
                    <div class="mt-2 flex items-center">
                        <span class="text-yellow-500">★★★★★</span>
                        <span class="ml-2 text-gray-800">- Cliente 3</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Testimonio 4 -->
        <div class="bg-white p-6 rounded-lg shadow-lg testimonio-card animate__animated"
            data-animation="animate__fadeInUp">
            <div class="flex items-center">
                <img src="{{ asset('images/customers/customer-4.jpg') }}" alt="Cliente 4" class="w-12 h-12 rounded-full">
                <div class="ml-4">
                    <p class="text-gray-600">"Los precios son accesibles y el servicio es de primera. ¡Gracias ADO!"
                    </p>
                    <div class="mt-2 flex items-center">
                        <span class="text-yellow-500">★★★★★</span>
                        <span class="ml-2 text-gray-800">- Cliente 4</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Testimonio 5 -->
        <div class="bg-white p-6 rounded-lg shadow-lg testimonio-card animate__animated"
            data-animation="animate__fadeInUp">
            <div class="flex items-center">
                <img src="{{ asset('images/customers/customer-5.jpg') }}" alt="Cliente 5" class="w-12 h-12 rounded-full">
                <div class="ml-4">
                    <p class="text-gray-600">"La puntualidad es impresionante. Nunca he tenido problemas con los
                        horarios."</p>
                    <div class="mt-2 flex items-center">
                        <span class="text-yellow-500">★★★★★</span>
                        <span class="ml-2 text-gray-800">- Cliente 5</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Testimonio 6 -->
        <div class="bg-white p-6 rounded-lg shadow-lg testimonio-card animate__animated"
            data-animation="animate__fadeInUp">
            <div class="flex items-center">
                <img src="{{ asset('images/customers/customer-6.jpg') }}" alt="Cliente 6" class="w-12 h-12 rounded-full">
                <div class="ml-4">
                    <p class="text-gray-600">"El Wi-Fi a bordo es un gran plus. Me permite trabajar mientras viajo."
                    </p>
                    <div class="mt-2 flex items-center">
                        <span class="text-yellow-500">★★★★★</span>
                        <span class="ml-2 text-gray-800">- Cliente 6</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@include('utilities.footer')

<!-- Scripts -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Formulario de busqueda para corridas
        const searchButton = document.getElementById('search-button');
        if (searchButton) {
            searchButton.addEventListener('click', function() {
                // Verificar si el usuario está autenticado
                const isAuthenticated = {{ auth()->check() ? 'true' : 'false' }};

                if (!isAuthenticated) {
                    alert('Debes iniciar sesión para realizar una búsqueda.');
                    window.location.href = "{{ route('login') }}";
                    return;
                }

                // Obtener los valores del formulario
                const origin = document.getElementById('origin').value;
                const destination = document.getElementById('destination').value;
                const departureDate = document.getElementById('departure-date').value;
                const time = document.getElementById('time').value;

                // Validar que todos los campos estén llenos
                if (!origin || !destination || !departureDate || !time) {
                    alert('Por favor, rellena todos los campos obligatorios.');
                    return;
                }

                // Crear un objeto con los datos de búsqueda
                const searchData = {
                    origin,
                    destination,
                    departureDate,
                    time,
                };

                // Guardar en Local Storage
                localStorage.setItem('searchData', JSON.stringify(searchData));


                // Redirigir a la página de resultados con los parámetros de búsqueda
                window.location.href =
                    `/resultados?origin=${origin}&destination=${destination}&departureDate=${departureDate}&time=${time}`;
            });
        }
    });
</script>

<script src="./node_modules/preline/dist/preline.js"></script>
<script type="module" src="{{ asset('js/app/bus-animation.js') }} "></script>

<!-- Swiper JS -->
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

</body>

</html>
