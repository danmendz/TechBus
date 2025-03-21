<x-guest-layout>
    <!DOCTYPE html>
    <html lang="es">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Resultados de Búsqueda</title>
        <!-- Google CSE Script -->
        <script async src="https://cse.google.com/cse.js?cx=b4f2947b021ac4b02"></script>
        <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
        <link href="{{ asset('css/general/styles.css') }}" rel="stylesheet">

    </head>
    @include('utilities.header')

    <body class="bg-gray-100">
        <div class="max-w-[85rem] mx-auto px-4 sm:px-6 lg:px-8 mt-8">
            <h1 class="text-5xl font-extrabold text-center text-gray-900 border-b-4 border-blue-500 inline-block pb-2">
                Boletos Disponibles</h1>
            <div id="results-container" class="space-y-4 mt-12">
                <!-- Aquí se mostrarán los boletos disponibles -->
            </div>
        </div>

        <script>
            document.addEventListener("DOMContentLoaded", function() {
                console.log("✅ DOM completamente cargado.");

                // Recuperar datos del Local Storage
                const searchData = JSON.parse(localStorage.getItem('searchData'));

                // Si no hay datos, mostrar un mensaje
                if (!searchData) {
                    console.log("❌ No se encontraron datos de búsqueda en el Local Storage.");
                    document.getElementById("results-container").innerHTML =
                        '<p class="text-gray-600">No se encontraron datos de búsqueda.</p>';
                    return;
                }

                // Obtener los parámetros de búsqueda
                const origin = searchData.origin || "Desconocido";
                const destination = searchData.destination || "Desconocido";
                const departureDate = searchData.departureDate || "Fecha no seleccionada";
                const time = searchData.time || "Horario no seleccionado";

                // Validar y formatear la fecha
                let formattedDate = "Fecha no seleccionada"; // Valor por defecto
                if (departureDate && departureDate.split('-').length === 3) {
                    // Si la fecha está en formato YYYY-MM-DD, formatearla a DD-MM-YYYY
                    formattedDate = departureDate.split('-').reverse().join('-');
                } else {
                    console.warn("⚠️ Formato de fecha no válido:", departureDate);
                }

                console.log("📌 Parámetros obtenidos del Local Storage:");
                console.log("Origen:", origin);
                console.log("Destino:", destination);
                console.log("Fecha de salida:", formattedDate); // Mostrar la fecha formateada
                console.log("Horario:", time);

                // Simulación de datos de boletos
                const tickets = [{
                        origen: origin,
                        destino: destination,
                        fecha: formattedDate, // Usar la fecha formateada
                        horaSalida: time, // Usamos el horario seleccionado
                        horaLlegada: "03:10 AM", // Simulación de horario de llegada
                        precio: 655,
                        disponibles: 2
                    },
                    {
                        origen: origin,
                        destino: destination,
                        fecha: formattedDate, // Usar la fecha formateada
                        horaSalida: time, // Usamos el horario seleccionado
                        horaLlegada: "08:30 AM", // Simulación de horario de llegada
                        precio: 1175,
                        disponibles: 3
                    }
                ];

                console.log("🎫 Datos de boletos disponibles:", tickets);

                // Mostrar los resultados en el DOM
                const resultsContainer = document.getElementById("results-container");

                // Limpiar el contenedor antes de agregar nuevos boletos
                resultsContainer.innerHTML = "";

                if (tickets.length > 0) {
                    tickets.forEach((ticket, index) => {
                        console.log("📝 Agregando boleto:", ticket);

                        const ticketElement = document.createElement("div");
                        ticketElement.className =
                            "ticket animate__animated animate__fadeInUp"; // Agregar animación
                        ticketElement.style.animationDelay =
                            `${index * 0.2}s`; // Retraso para animación escalonada
                        ticketElement.innerHTML = `
                <h3 class="text-2xl font-bold text-blue-600">${ticket.origen} → ${ticket.destino}</h3>
                <div class="grid grid-cols-2 gap-4 mt-4">
                    <div>
                        <p class="text-gray-600"><strong>Fecha:</strong> ${ticket.fecha}</p>
                        <p class="text-gray-600"><strong>Salida:</strong> ${ticket.horaSalida}</p>
                        <p class="text-gray-600"><strong>Llegada:</strong> ${ticket.horaLlegada}</p>
                    </div>
                    <div>
                        <p class="text-gray-600"><strong>Precio:</strong> <span class="text-green-600 font-bold">$${ticket.precio} MXN</span></p>
                        <p class="text-gray-600"><strong>Boletos disponibles:</strong> <span class="text-blue-600 font-bold">${ticket.disponibles}</span></p>
                    </div>
                </div>
                <button class="mt-4 w-full bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition duration-300">
                    Comprar
                </button>
            `;
                        resultsContainer.appendChild(ticketElement);
                    });
                } else {
                    console.log("❌ No se encontraron boletos.");
                    resultsContainer.innerHTML = '<p class="text-gray-600">No se encontraron boletos disponibles.</p>';
                }
            });
        </script>

        @include('utilities.footer')
    </body>

    </html>
</x-guest-layout>